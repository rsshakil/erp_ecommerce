<?php

namespace App\Http\Controllers\API\Purchase;
use App\Http\Resources\API\PurchaseResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseHistory;
use App\Services\CommonService;
use App\Services\HelperService;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use DB;
use App\User;
class PurchaseController extends Controller
{
    
    private $request;
    private $status_filter_where=[];
    private $where_array=[];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $this->request= $request;
        $search = $this->request->search;
        $dataSorting = $this->request->sorting == 'false'?10:$this->request->sorting;
        $data =$search == 'false'?Purchase::orderBy('purchases_id', 'desc')->paginate($dataSorting):Purchase::where(function($query) use($search){
            $query->Where('client_id', $this->request->client_id);
            $query->orWhere('invoice_no', 'LIKE', "%{$search}%");

            })->orderBy('purchases_id', 'desc')->paginate($dataSorting);
     return PurchaseResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:users,id',
            'contact_id' => 'required|integer|exists:contacts,contact_id',
            "product_items" => "required|array|min:1",
        ]);

        if ($validator->fails()) {
            
            return response()->json(array('result' => 400, 'message' => $validator->errors()->first()));
        }
        DB::beginTransaction();
        try {
            $client_id = $request->client_id;
            $items = $request->product_items;
            $merchntCode = str_pad($client_id,3,"0",STR_PAD_LEFT );
            $invoice_no = strtotime(now()).$merchntCode;
            $purchase = [
                'client_id'=>$request->client_id,
                'contact_id'=>$request->contact_id,
                'invoice_no'=>$invoice_no,
                'total_quantity'=>$request->total_quantity,
                'total_amount'=>$request->total_amount,
                'total_paid_amount'=>$request->total_paid_amount,
                'total_due_amount'=>$request->total_due_amount,
            ];
            $purchase_id = Purchase::insertGetId($purchase);
            $blanceInfo = CommonService::blanceUpdate($request->client_id,2,$request->total_paid_amount);

            foreach($items as $item){
               
                PurchaseHistory::insert([
                    'purchases_id'=>$purchase_id,
                    'product_id'=>$item['product_id'],
                    'item_quantity'=>$item['item_quantity'],
                    'item_cost_price'=>$item['cost_price'],
                ]);
                $stockInfo = CommonService::stockInfo($request->client_id,$item['product_id']);
                if(!empty($stockInfo)){
                    $stockQty = $stockInfo->stock_quantity+$item['item_quantity'];
                }else{
                    $stockQty = $item['item_quantity'];
                }
                DB::table('stock_details')->updateOrInsert(['client_id' => $request->client_id, 'product_id' => $item['product_id']],
                    [
                        'stock_quantity'=>$stockQty,
                        'purchase_price'=>$item['cost_price'],
                        'selling_price'=>CommonService::getSellingPrice($item['cost_price']),
                    ]);
            }
            DB::commit(); 
            return response()->json(array('result' => 200, 'message' => 'Add purchase successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error(print_r($e->getMessage(), true));
            Log::error(print_r($e->getTraceAsString(), true));
            return response()->json(array('result' => 400, 'message' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function history(Request $request){
        try{
            $clientInfo = User::select('users.*','users_details.first_name','users_details.last_name','users_details.phone')->leftJoin('users_details','users_details.user_id','users.id')->where('users.id',$request->client_id)->first();
            $result = PurchaseHistory::join('purchases','purchase_histories.purchases_id','purchases.purchases_id')
            ->LeftJoin('products','products.product_id','purchase_histories.product_id')
            ->LeftJoin('contacts','contacts.contact_id','purchases.contact_id')
            ->LeftJoin('image_controls','image_controls.product_id','products.product_id')
            ->LeftJoin('product_categories','product_categories.product_categorie_id','products.category_id')
            ->where('purchase_histories.purchases_id',$request->purchase_id)->groupBy('purchases_history_id')->get();
            return response()->json(array('result' => 200,'products'=>$result, 'clientInfo'=>$clientInfo, 'message' => 'Purchase history list'));
            
        } catch (\Exception $e) {
           
            Log::error(print_r($e->getMessage(), true));
            Log::error(print_r($e->getTraceAsString(), true));
            return response()->json(array('result' => 400, 'message' => $e->getMessage()));
        }
    }

    public function purchase_invoice_update(Request $request){
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:users,id',
            "info" => "required|array|min:1",
        ]);

        if ($validator->fails()) {
            return response()->json(array('result' => 400, 'message' => $validator->errors()->first()));
        }
        DB::beginTransaction();
        try{
            $client_id = $request->client_id;
            $sell_info = $request->info;
            $i = 0;
            foreach($sell_info as $sales){
                Log::error(print_r($sales, true));
                $orginal_sell_info = PurchaseHistory::where([
                    'purchases_id'=>$sales['purchases_id'],
                    'product_id'=>$sales['product_id']
                ])->first();
                $orginal_sell_info = collect($orginal_sell_info)->toArray();
                Log::error(print_r($orginal_sell_info, true));
                if($sales['item_quantity']!=$orginal_sell_info['item_quantity']){
                    if($sales['item_quantity']>$orginal_sell_info['item_quantity']){
                        //subtract from stck
                        $qty_diff = $sales['item_quantity']-$orginal_sell_info['item_quantity'];

                        DB::table('stock_details')->where(['client_id' => $request->client_id, 'product_id' => $sales['product_id']])->update([
                        'stock_quantity'=>DB::raw('stock_quantity + '.$qty_diff)
                        ]);

                        Purchase::where('purchases_id',$sales['purchases_id'])->update([
                            'total_quantity'=>DB::raw('total_quantity + '.$qty_diff),
                            'total_amount'=>DB::raw('total_amount + '.$qty_diff*$sales['item_cost_price']),
                            'total_due_amount'=>DB::raw('total_due_amount + '.$qty_diff*$sales['item_cost_price']),
                        ]);

                    }else{
                        $qty_diff = $orginal_sell_info['item_quantity']-$sales['item_quantity'];
                        //add to stock
                        Log::error(print_r("qty_diff", true));
                        Log::error(print_r($qty_diff, true));
                        DB::table('stock_details')->where(['client_id' => $request->client_id, 'product_id' => $sales['product_id']])->update([
                            'stock_quantity'=>DB::raw('stock_quantity - '.$qty_diff)
                        ]);
                        Purchase::where('purchases_id',$sales['purchases_id'])->update([
                            'total_quantity'=>DB::raw('total_quantity - '.$qty_diff),
                            'total_amount'=>DB::raw('total_amount - '.$qty_diff*$sales['item_cost_price']),
                            'total_due_amount'=>DB::raw('total_due_amount - '.$qty_diff*$sales['item_cost_price']),
                        ]);
                    }
                    PurchaseHistory::where([
                        'purchases_id'=>$sales['purchases_id'],
                        'product_id'=>$sales['product_id']
                    ])->update([
                        'item_quantity'=>$sales['item_quantity'],
                    ]);
                }
                $i++;
            }
            DB::commit(); 
            return response()->json(array('result' => 200));
           
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error(print_r($e->getMessage(), true));
            Log::error(print_r($e->getTraceAsString(), true));
            return response()->json(array('result' => 400, 'message' => $e->getMessage()));
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

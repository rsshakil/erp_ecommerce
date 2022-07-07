<?php

namespace App\Http\Controllers\API\Sell;
use App\Http\Resources\API\SellResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sell;
use App\SellHistory;
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
class SellController extends Controller
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
        $data =$search == 'false'?Sell::Where('client_id', $this->request->client_id)->orderBy('sell_id', 'desc')->paginate($dataSorting):Sell::where(function($query) use($search){
            $query->orWhere('invoice_no', 'LIKE', "%{$search}%");
        })->Where('client_id', $this->request->client_id)->orderBy('sell_id', 'desc')->paginate($dataSorting);
        return SellResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:users,id',
            'contact_id' => 'required|integer|exists:contacts,contact_id',
            "product_items" => "required|array|min:1",
        ]);

        if ($validator->fails()) {
            
            return response()->json(array('result' => 400, 'message' => $validator->errors()->first()));
        }
        $items = $request->product_items;
        foreach($items as $item){
            $stockInfos = CommonService::stockInfo($request->client_id,$item['product_id']);
            if(empty($stockInfos) || $stockInfos->stock_quantity<$item['item_quantity']){
                return response()->json(array('result' => 400, 'message' => 'Insuficient Stock Quantity'));
            }
        }
        DB::beginTransaction();
        try {
            $client_id = $request->client_id;
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
            $sell_id = Sell::insertGetId($purchase);
            $blanceInfo = CommonService::blanceUpdate($request->client_id,1,$request->total_paid_amount);

            foreach($items as $item){
               
                SellHistory::insert([
                    'sell_id'=>$sell_id,
                    'product_id'=>$item['product_id'],
                    'item_quantity'=>$item['item_quantity'],
                    'item_cost_price'=>$item['cost_price'],
                    'item_selling_price'=>$item['selling_price'],
                ]);
                $stockInfo = CommonService::stockInfo($request->client_id,$item['product_id']);
                if(!empty($stockInfo)){
                    $stockQty = $stockInfo->stock_quantity-$item['item_quantity'];
                }
                DB::table('stock_details')->updateOrInsert(['client_id' => $request->client_id, 'product_id' => $item['product_id']],
                    [
                        'stock_quantity'=>$stockQty
                    ]);
            }
            DB::commit(); 
            return response()->json(array('result' => 200, 'message' => 'Add Sales successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error(print_r($e->getMessage(), true));
            Log::error(print_r($e->getTraceAsString(), true));
            return response()->json(array('result' => 400, 'message' => $e->getMessage()));
        }
    }

    public function history(Request $request){
        try{
            $clientInfo = User::select('users.*','users_details.first_name','users_details.last_name','users_details.phone')->leftJoin('users_details','users_details.user_id','users.id')->where('users.id',$request->client_id)->first();
           $result = SellHistory::join('sells','sell_histories.sell_id','sells.sell_id')
            ->LeftJoin('products','products.product_id','sell_histories.product_id')
            ->LeftJoin('contacts','contacts.contact_id','sells.contact_id')
            ->LeftJoin('image_controls','image_controls.product_id','products.product_id')
            ->LeftJoin('product_categories','product_categories.product_categorie_id','products.category_id')
            ->where('sell_histories.sell_id',$request->sell_id)->groupBy('sell_history_id')->get();
            return response()->json(array('result' => 200,'products'=>$result, 'clientInfo'=>$clientInfo, 'message' => 'Sell history list'));
            
        } catch (\Exception $e) {
           
            Log::error(print_r($e->getMessage(), true));
            Log::error(print_r($e->getTraceAsString(), true));
            return response()->json(array('result' => 400, 'message' => $e->getMessage()));
        }
    } 

    public function sellInvoiceUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:users,id',
            "sell_info" => "required|array|min:1",
        ]);

        if ($validator->fails()) {
            return response()->json(array('result' => 400, 'message' => $validator->errors()->first()));
        }
        DB::beginTransaction();
        try{
            $client_id = $request->client_id;
            $sell_info = $request->sell_info;
            //$orginal_sell_info = $request->orginal_sell_info;
            $i = 0;
            foreach($sell_info as $sales){
                Log::error(print_r($sales, true));
                $orginal_sell_info = SellHistory::where([
                    'sell_id'=>$sales['sell_id'],
                    'product_id'=>$sales['product_id']
                ])->first();
                $orginal_sell_info = collect($orginal_sell_info)->toArray();
                Log::error(print_r($orginal_sell_info, true));
                if($sales['item_quantity']!=$orginal_sell_info['item_quantity']){
                    if($sales['item_quantity']>$orginal_sell_info['item_quantity']){
                        //subtract from stck
                        $qty_diff = $sales['item_quantity']-$orginal_sell_info['item_quantity'];

                        DB::table('stock_details')->where(['client_id' => $request->client_id, 'product_id' => $sales['product_id']])->update([
                        'stock_quantity'=>DB::raw('stock_quantity - '.$qty_diff)
                        ]);

                        Sell::where('sell_id',$sales['sell_id'])->update([
                            'total_quantity'=>DB::raw('total_quantity + '.$qty_diff),
                            'total_amount'=>DB::raw('total_amount + '.$qty_diff*$sales['item_selling_price']),
                            'total_due_amount'=>DB::raw('total_due_amount + '.$qty_diff*$sales['item_selling_price']),
                        ]);

                        


                    }else{
                        $qty_diff = $orginal_sell_info['item_quantity']-$sales['item_quantity'];
                        //add to stock
                        Log::error(print_r("qty_diff", true));
                        Log::error(print_r($qty_diff, true));
                        DB::table('stock_details')->where(['client_id' => $request->client_id, 'product_id' => $sales['product_id']])->update([
                            'stock_quantity'=>DB::raw('stock_quantity + '.$qty_diff)
                        ]);
                        Sell::where('sell_id',$sales['sell_id'])->update([
                            'total_quantity'=>DB::raw('total_quantity - '.$qty_diff),
                            'total_amount'=>DB::raw('total_amount - '.$qty_diff*$sales['item_selling_price']),
                            'total_due_amount'=>DB::raw('total_due_amount - '.$qty_diff*$sales['item_selling_price']),
                        ]);
                    }
                    SellHistory::where([
                        'sell_id'=>$sales['sell_id'],
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

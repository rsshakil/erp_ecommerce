<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\API\BlancePayResource;
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
use App\product\product_category;
use App\Sell;
use App\Purchase;
use App\AmountPayment;
class BlancePayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;

      $query =AmountPayment::select(
            'amount',
            'amount_payments_id',
            'bank_name',
            'checque_no',
            'amount_payments.type',
            'amount_payments_id',
            'phone',
            'mobile',
            'full_name'
        )
        ->join('contacts','amount_payments.contact_id','contacts.contact_id')
        ->where('amount_payments.client_id',$request->client_id);
        $search = $request->search;
        if($search != 'false'){
            $query->where('contacts.full_name', 'LIKE', "%{$search}%");
            $query->orWhere('amount_payments.type', 'LIKE', "%{$search}%");
        }

        $data = $query->orderBy('amount_payments.amount_payments_id','DESC')
        ->paginate($dataSorting);
      
       return BlancePayResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
        AmountPayment::insert($request->all());
        $stockInfo = CommonService::blanceUpdate($request->client_id,$request->type,$request->amount);
        $incDec = $request->amount;
        if($request->type==1){
            $sellDueList = Sell::where('client_id',$request->client_id)->where('contact_id',$request->contact_id)->where('total_due_amount','!=' , '0.00')->orderBy('sell_id','ASC')->get();
            if($sellDueList){
                foreach($sellDueList as $sales){
                    if($incDec>$sales->total_due_amount){
                        $incDec = $incDec-$sales->total_due_amount;
                        Sell::where('sell_id',$sales->sell_id)->update(['total_due_amount'=>0,'total_paid_amount'=>$sales->total_paid_amount+$sales->total_due_amount]);
                    }else{
                        Sell::where('sell_id',$sales->sell_id)->update(['total_due_amount'=>$sales->total_due_amount-$incDec,'total_paid_amount'=>$sales->total_paid_amount+$incDec]);
                        break;
                    }
                }
            }
        }else{
            $purchaseDueList = Purchase::where('client_id',$request->client_id)->where('contact_id',$request->contact_id)->where('total_due_amount','!=' , '0.00')->orderBy('purchases_id','ASC')->get();
            if($purchaseDueList){
                foreach($purchaseDueList as $sales){
                    if($incDec>$sales->total_due_amount){
                        $incDec = $incDec-$sales->total_due_amount;
                        Purchase::where('purchases_id',$sales->purchases_id)->update(['total_due_amount'=>0,'total_paid_amount'=>$sales->total_paid_amount+$sales->total_due_amount]);
                    }else{
                        Purchase::where('purchases_id',$sales->purchases_id)->update(['total_due_amount'=>$sales->total_due_amount-$incDec,'total_paid_amount'=>$sales->total_paid_amount+$incDec]);
                        break;
                    }
                }
            }

        }
        DB::commit(); 
        return response()->json([
            'status'  => 'success',
            'message' => 'Payment/receive has been success!',
            'icon'    => 'times',
         ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error(print_r($e->getMessage(), true));
            Log::error(print_r($e->getTraceAsString(), true));
            return response()->json(array('result' => 400, 
            'status'  => 'error',
            'icon'    => 'times',
            'message' => $e->getMessage()));
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

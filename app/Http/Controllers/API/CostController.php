<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\API\CostResouce;

use App\Purchase;
use App\StockDetails;
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
use App\category;
use App\cost;
class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?cost::orderBy('cost_id', 'desc')->paginate($dataSorting):cost::where(function($query) use($search){
            $query->orWhere('cost_name', 'LIKE', "%{$search}%");
        })->orderBy('cost_id', 'desc')->paginate($dataSorting);
      
       return CostResouce::collection($data);
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
            $data = array();
            $data['client_id']= $request->client_id;
            $data['category_id']= $request->cat_id;
            $data['cost_name']= $request->cost_name;
            $data['cost_amount']= $request->cost_amount;
            $cost = cost::insert($data);
            $blanceInfo = CommonService::blanceUpdate($request->client_id,2,$request->cost_amount);
            DB::commit(); 
            return response()->json([
            'status'  => 'success',
            'message' => 'Cost has been created!',
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
        $cost = cost::where('cost_id',$id)->first();
        return new CostResouce($cost);
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
        $data = array();
        $data['category_id']= $request->cat_id;
        $data['cost_name']= $request->cost_name;
        $data['cost_amount']= $request->cost_amount;

        $data = cost::where('cost_id',$id)->update($data); 

        return response()->json([
            'status'  => 'success',
            'message' => 'Cost has been updated!',
            'icon'    => 'times',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = cost::where('cost_id',$id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Cost has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}

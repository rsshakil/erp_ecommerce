<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\API\MyDueListResource;
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
class MyDueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;

      $query =Purchase::select(
            DB::raw('SUM(total_quantity) AS sum_of_total_quantity'),
            DB::raw('SUM(total_amount) AS sum_of_total_amount'),
            DB::raw('SUM(total_paid_amount) AS sum_of_total_paid_amount'),
            DB::raw('SUM(total_due_amount) AS sum_of_total_due_amount'),
            DB::raw('SUM(total_discount_amount) AS sum_of_total_discount_amount'),
            'purchases_id',
            'phone',
            'mobile',
            'full_name'
        )
        ->join('contacts','purchases.contact_id','contacts.contact_id')
        ->where('purchases.client_id',$request->client_id);
        $search = $request->search;
        if($search != 'false'){
            $query->where('contacts.full_name', 'LIKE', "%{$search}%");
        }

        $data = $query->groupBy('purchases.contact_id')
        ->orderBy('purchases.purchases_id','DESC')
        ->paginate($dataSorting);
      
       return MyDueListResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

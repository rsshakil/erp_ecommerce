<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\API\StockResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

class StockController extends Controller
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
        $query = StockDetails::join('products','products.product_id','stock_details.product_id')
        ->join('product_categories','product_categories.product_categorie_id','products.category_id');
        $query->Where('stock_details.client_id', $this->request->client_id);
        
        if($search != 'false'){
            $query->orWhere('products.product_name', 'LIKE', "%{$search}%");
        }
        
        $data = $query->orderBy('stock_details.product_id', 'desc')->paginate($dataSorting);
        return StockResource::collection($data);
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

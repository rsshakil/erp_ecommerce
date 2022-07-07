<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\API\CategoryResouce;

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

class CategoryController extends Controller
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
        $data =$search == 'false'?category::orderBy('cat_id', 'desc')->paginate($dataSorting):category::where(function($query) use($search){
            $query->orWhere('cat_name', 'LIKE', "%{$search}%");
        })->orderBy('cat_id', 'desc')->paginate($dataSorting);
      
       return CategoryResouce::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();
        $data['cat_name']= $request->cat_name;
        $data['client_id']= $request->client_id;
        $category = category::insert($data);

        return response()->json([
           'status'  => 'success',
           'message' => 'Category has been created!',
           'icon'    => 'times',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = category::where('cat_id',$id)->first();
        return new CategoryResouce($category);
    }
    public function cost_category_list($client_id)
    {
        $category = category::where('client_id',$client_id)->get();
        return CategoryResouce::collection($category);
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
        $data['cat_name']= $request->cat_name;

        $data = category::where('cat_id',$id)->update($data); 

        return response()->json([
            'status'  => 'success',
            'message' => 'Category has been updated!',
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
        $delete = category::where('cat_id',$id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Category has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}

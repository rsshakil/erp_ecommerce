<?php

namespace App\Http\Controllers\API\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\product\product;
use App\product\product_category;
use App\product\type_control;
use App\product\mall_control;
use App\product\city_control;
use App\product\branch_control;
use DB;
use Auth;
class ProductcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $result = product_category::where('status','1')->where('client_id',$request->client_id)->groupBy('category_name')->get();
        return response()->json(['category_list'=>$result]);
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
    public function all_subcategory_by_category_id($category_id)
    {
        //
        $cat_info = product_category::where('product_categorie_id',$category_id)->first();
        $result = product_category::where('status','1')->where('category_name',$cat_info->category_name)->groupBy('sub_category_name')->get();
        return response()->json(['sub_category_list'=>$result]);
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

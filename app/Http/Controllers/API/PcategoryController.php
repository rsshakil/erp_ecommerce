<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\API\PcategoryResource;
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


class PcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $request->all();
        $search = $request->search;
       $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?product_category::orderBy('product_categorie_id', 'desc')->where('client_id',$request->client_id)->paginate($dataSorting):product_category::where(function($query) use($search){
            $query->orWhere('category_name', 'LIKE', "%{$search}%");
        })->where('client_id',$request->client_id)->orderBy('product_categorie_id', 'desc')->paginate($dataSorting);
      
       return PcategoryResource::collection($data);
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
        $data['category_name']= $request->cat_name;
        $data['sub_category_name']= $request->sub_cat_name;
        $data['client_id']= $request->client_id;
        $category = product_category::insert($data);

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
        $category = product_category::where('product_categorie_id',$id)->first();
        return new PcategoryResource($category);
    }
    public function category_list($client_id)
    {
        $category = product_category::where('client_id',$client_id)->get();
        return PcategoryResource::collection($category);
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
        $data['category_name']= $request->cat_name;
        $data['sub_category_name']= $request->sub_cat_name;


        $data = product_category::where('product_categorie_id',$id)->update($data); 

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
        $delete = product_category::where('product_categorie_id',$id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Category has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}

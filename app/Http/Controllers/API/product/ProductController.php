<?php

namespace App\Http\Controllers\API\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use App\User;
use App\StockDetails;
use App\product\product;
use App\product\product_attribute_qty;
use App\product\product_category;
use App\product\type_control;
use App\product\mall_control;
use App\product\city_control;
use App\product\branch_control;
use App\image\image_control;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_image($inPath,$outPath)
    { //Download images from remote server
        $in=    fopen($inPath, "rb");
        $out=   fopen($outPath, "wb");
        while ($chunk = fread($in,8192))
        {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);
    }
    public function add_product_to_db(Request $request)
    {




        DB::beginTransaction();
        try {
        $review_list = '';
        $support_list = '';
        $client_id =$request->client_id;
        $user_id =$request->user_id;
        $warehouse_id = 1;
        $barCode = '';

        
        


        if(!empty($request->review_item_lists)){
            foreach($request->review_item_lists as $value){
                // print_r($value);exit;
                $review_list .= $value['review_item'].';';
            }
            $review_list = rtrim($review_list, ';');
        }
        if(!empty($request->support_item_lists)){
            foreach($request->support_item_lists as $value){
                // print_r($value);exit;
                $support_list .= $value['support_item'].';';
            }
            $support_list = rtrim($support_list, ';');
        }
        $product_code = '';
        $barCode = '';
        if($request->selected_item_type==0){
            $product_code = $request->singleitem['item_code'];
        }else{
            $product_code = $request->multipleitem['item_code'];
        }
        $merchntCode = str_pad($client_id,3,"0",STR_PAD_LEFT );
        $barCode = strtotime(now()).$merchntCode;
        $product_type = ($request->product_type==1?'Goods':'Nothing');
      
        $product_info = array();
        $product_attr_info = array();
        $product_img_info = array();


       


        if (product::where('product_code', '=', $product_code)->exists()) {
            return response()->json(['title'=>"Exists!",'message' =>'product exists', 'class_name' => 'error','success'=>'','error'=>1]);
        }

        $product_info['client_id']=$client_id;
        $product_info['contact_id']=$request->contact_id['contact_id'];
        // $product_info['merchant_shop_id']=1;
        $product_info['category_id']=$request->selected_product_categorie_id['product_categorie_id'];
        // $product_info['sub_category_id']=$request->selected_sub_product_categorie_id['product_categorie_id'];
        // $product_info['brand_id']=$request->selected_brand_id['type_control_id'];
        // $product_info['manufacturer_id']=$request->selected_manufacture_id['type_control_id'];
        $product_info['product_code']=$product_code;
        $product_info['barcode']=$barCode;
        $product_info['product_name']=$request->product_name;
        $product_info['unit']='';
        $product_info['product_description']=($request->description_type==0?$request->editorData:'');
        $product_info['warrranty']=$request->warrenty;
        $product_info['product_includes']='test';
        $product_info['protfolio']='';
        $product_info['product_type']=$product_type;   
        $product_info['min_qty']=$request->min_qty;
        $product_info['instruction_list']='';
        $product_info['review_list']=$review_list;
        $product_info['support_list']=$support_list;
        $product_info['entry_by']=$request->user_id;

        $product_info['p_diemension']=$request->singleitem['diemension'];
        $product_info['p_weight']=$request->singleitem['weight'];
        $product_info['p_quantity']=0;
        $product_info['p_qty_left']=0;
        $product_info['p_price']=$request->singleitem['retail_price'];
        $product_info['p_cost_price']=$request->singleitem['cost_price'];
        $product_info['p_wholesale_price']=$request->singleitem['wholesale_price'];
        $product_info['p_avg_price']=$request->singleitem['cost_price'];


        $product_id = product::insertGetId($product_info);
        StockDetails::insert([
            'client_id' => $client_id,
            'product_id' => $product_id,
            'stock_quantity'=>0,
        ]);
        //Image process
        $destinationPath = public_path().'/images/products/';
        if(count($request->img_lists)>0){
            foreach($request->img_lists as $imgs){
                $fileName = time() .rand(1000,99999). '.png';
                $image = $imgs['img'];
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
              
                 $file = file_put_contents($destinationPath.$fileName, base64_decode($image));
                 $product_img_info['product_id']=$product_id;
                 $product_img_info['image']=$fileName;
                 image_control::insert($product_img_info);
            }
            product::where('product_id',$product_id)->update(['prodcut_image'=>$fileName]);
        }
       
        // img insert
        

        // attr insert
        if($request->selected_item_type==0){
            //this single item           
            $product_attr_info['product_id']=$product_id;
            // $product_attr_info['warehouse_id']=$warehouse_id;
            $product_attr_info['diemension']=$request->singleitem['diemension'];
            $product_attr_info['weight']=$request->singleitem['weight'];
            $product_attr_info['quantity']=0;
            $product_attr_info['qty_left']=0;
            $product_attr_info['price']=$request->singleitem['retail_price'];
            $product_attr_info['cost_price']=$request->singleitem['cost_price'];
            $product_attr_info['wholesale_price']=$request->singleitem['wholesale_price'];
            $product_attr_info['avg_price']=$request->singleitem['cost_price'];
            product_attribute_qty::insert($product_attr_info);
        }else{
             //this multiple item 
            foreach($request->multipleitem['product_attributes'] as $value){
                $product_attr_info['product_id']=$product_id;
                // $product_attr_info['warehouse_id']=$warehouse_id;
                $product_attr_info['color']=$value['color'];
                $product_attr_info['size']=$value['size'];
                $product_attr_info['diemension']=$value['diemension'];
                $product_attr_info['weight']=$value['weight'];
                $product_attr_info['quantity']=0;
                $product_attr_info['qty_left']=0;
                $product_attr_info['price']=$value['retail_price'];
                $product_attr_info['cost_price']=$value['cost_price'];
                $product_attr_info['wholesale_price']=$value['wholesale_price'];
                $product_attr_info['avg_price']=$value['cost_price'];
                product_attribute_qty::insert($product_attr_info);
            }
        }
        DB::commit(); 

        return response()->json(array('result' => 200, 'message' => 'Product Insert successfully'));
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
    //get all marchnt_product
    public function get_all_client_products(Request $request){
        
        $client_id=$request->client_id;
        $q = product::select('products.*',
        'product_categories.category_name')
        ->leftJoin('product_attribute_qties','product_attribute_qties.product_id','=','products.product_id')
        ->leftJoin('product_categories','product_categories.product_categorie_id','=','products.category_id');
        // ->leftJoin('product_categories as product_sub_category','product_sub_category.product_categorie_id','=','products.sub_category_id')
        // ->leftJoin('type_controls as product_brands','product_brands.type_control_id','=','products.brand_id')
        // ->leftJoin('type_controls as product_manufacturers','product_manufacturers.type_control_id','=','products.manufacturer_id');
        if($client_id){
            $q->where('products.client_id',$client_id);
        }
        $q->groupBy('products.product_id');
        $result = $q->orderBy('products.product_id','DESC')->get();
        return response()->json(['products'=>$result]);
    }
    //get all marchnt_product
    public function get_product_by_id(Request $request){
        
        $client_id=$request->client_id;
        $product_id=$request->product_id;
        $q = product::select('products.*','product_attribute_qties.*',
        'product_categories.category_name')
        ->leftJoin('product_attribute_qties','product_attribute_qties.product_id','=','products.product_id')
        // ->leftJoin('branch_controls','branch_controls.branch_control_id','=','products.merchant_shop_id')
        // ->leftJoin('image_controls','image_controls.product_id','=','products.product_id')
        ->leftJoin('product_categories','product_categories.product_categorie_id','=','products.category_id');
        // ->leftJoin('product_categories as product_sub_category','product_sub_category.product_categorie_id','=','products.sub_category_id')
        // ->leftJoin('type_controls as product_brands','product_brands.type_control_id','=','products.brand_id')
        // ->leftJoin('type_controls as product_manufacturers','product_manufacturers.type_control_id','=','products.manufacturer_id');
        if($client_id){
            $q->where('products.client_id',$client_id);
        }
        if($product_id){
            $q->where('products.product_id',$product_id);
        }
        $q->groupBy('products.product_id');
        $result = $q->orderBy('products.product_id','DESC')->first();
        return response()->json(['products'=>$result]);
    }
    //get all marchnt_product
    public function get_all_products_name_id(Request $request){
        
        $client_id=$request->client_id;
        $type=$request->type;
        $q = product::select('products.product_id','product_name','prodcut_image');
        if($type==2){
            $q->join('stock_details',function($join){
                $join->on('products.product_id','=','stock_details.product_id');
                $join->where('stock_details.stock_quantity','>',0);
            });
        }
        if($client_id){
            $q->where('products.client_id',$client_id);
        }
        
        $q->groupBy('products.product_id');
        $result = $q->orderBy('products.product_id','DESC')->get();
        return response()->json(['products'=>$result]);
    }



     //get all marchnt_product categories
     public function get_all_merchant_product_categories(){
        $result = User::find(5)->get_merchant_product_categories;
        return response()->json(['product_categories'=>$result]);
    }

     //get all marchnt_brand manufact
     public function get_all_merchant_brand_manufacturers(){
        $result = User::find(5)->get_merchant_brands;
        return response()->json(['brand_manufacturers'=>$result]);
    }

     //get all marchnt_brand manufact
     public function get_all_merchant_shops(){
        $result = User::find(5)->get_merchant_shops;
        return response()->json(['shops'=>$result]);
    }
 
}

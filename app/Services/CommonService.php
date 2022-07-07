<?php

namespace App\Services;

use App\StockDetails;
use App\BlanceSheet;
use Illuminate\Support\Facades\Auth;

class CommonService
{
    public static function stockInfo($client_id,$product_id)
    {
        return StockDetails::where(['client_id'=>$client_id, 'product_id'=>$product_id])->orderBy('stock_detail_id')->first();
    }
    public static function getSellingPrice($cost_price,$profit_percent=20)
    {
        return round(($cost_price*$profit_percent/100)+$cost_price);
    }
    public static function isAvaiableInStock($client_id,$product_id,$requestQty)
    {
        $stoInfo = self::stockInfo($client_id,$product_id);
        return $stoInfo->stock_quantity>$requestQty?true:false;
    }
    public static function blanceUpdate($client_id,$type,$amount)
    {
        $stoInfo = BlanceSheet::where('client_id',$client_id)->first();
        if($stoInfo){
            if($type==1){
                $amounts = $stoInfo->total_amount+$amount;
            }else{
                $amounts = $stoInfo->total_amount-$amount;
            }
            $stoInfo = BlanceSheet::where('client_id',$client_id)->update(['total_amount'=>$amounts]);
        }else{
            if($type==1){
                $amounts = $amount;
            }else{
                $amounts = -$amount;
            }
            $stoInfo = BlanceSheet::insert(['total_amount'=>$amounts,'client_id'=>$client_id]);

        }
        return $stoInfo;
    }

    public static function getClientId(){
       return Auth::user()->clientid;
    }
}

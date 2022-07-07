<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ReportController extends Controller
{
public function get_all_stock_report(Request $request){
    $client_id = $request->client_id;
    $total_sales_info = DB::table('sells')
    ->select(
        DB::raw('SUM(total_quantity) AS sum_of_total_quantity'),
        DB::raw('SUM(total_amount) AS sum_of_total_amount'),
        DB::raw('SUM(total_paid_amount) AS sum_of_total_paid_amount'),
        DB::raw('SUM(total_due_amount) AS sum_of_total_due_amount'),
        DB::raw('SUM(total_discount_amount) AS sum_of_total_discount_amount')
        )
    ->where('client_id',$client_id)->first();
    $total_buy_info = DB::table('purchases')
    ->select(
        DB::raw('SUM(total_quantity) AS sum_of_total_quantity'),
        DB::raw('SUM(total_amount) AS sum_of_total_amount'),
        DB::raw('SUM(total_paid_amount) AS sum_of_total_paid_amount'),
        DB::raw('SUM(total_due_amount) AS sum_of_total_due_amount'),
        DB::raw('SUM(total_discount_amount) AS sum_of_total_discount_amount')
        )
    ->where('client_id',$client_id)->first();
   
    $total_stock_quantity = DB::table('stock_details')
    ->select(
        DB::raw('SUM(stock_quantity) AS sum_of_stock_total_quantity'),
        DB::raw('SUM(stock_quantity*purchase_price) AS sum_of_total_purchase_price'),
        DB::raw('SUM(stock_quantity*selling_price) AS sum_of_total_selling_price')
        )
    ->where('client_id',$client_id)->first();
   
    $total_blanceInfo = DB::table('blance_sheets')
    ->where('client_id',$client_id)->first();
    $reports = ['total_sales_info'=>$total_sales_info,
    'total_buy_info'=>$total_buy_info,
    'total_stock_quantity'=>$total_stock_quantity,
    'total_blanceInfo'=>$total_blanceInfo,
    ];
    return response()->json(['reports'=>$reports]);


}
public function get_all_stock_report_with_filter(Request $request){
    $client_id = $request->client_id;
    $start_date = $request->start_date;
    $end_date = $request->end_date;
    $total_sales_info = DB::table('sells')
    ->select(
        DB::raw('SUM(total_quantity) AS sum_of_total_quantity'),
        DB::raw('SUM(total_amount) AS sum_of_total_amount'),
        DB::raw('SUM(total_paid_amount) AS sum_of_total_paid_amount'),
        DB::raw('SUM(total_due_amount) AS sum_of_total_due_amount'),
        DB::raw('SUM(total_discount_amount) AS sum_of_total_discount_amount')
        )
    ->where('client_id',$client_id)
    ->whereDate('created_at', '>=', $start_date)
    ->whereDate('created_at', '<=', $end_date)
    ->first();
    $total_buy_info = DB::table('purchases')
    ->select(
        DB::raw('SUM(total_quantity) AS sum_of_total_quantity'),
        DB::raw('SUM(total_amount) AS sum_of_total_amount'),
        DB::raw('SUM(total_paid_amount) AS sum_of_total_paid_amount'),
        DB::raw('SUM(total_due_amount) AS sum_of_total_due_amount'),
        DB::raw('SUM(total_discount_amount) AS sum_of_total_discount_amount')
        )
    ->where('client_id',$client_id)
    ->whereDate('created_at', '>=', $start_date)
    ->whereDate('created_at', '<=', $end_date)
    ->first();
    $reports = ['total_sales_info'=>$total_sales_info,
    'total_buy_info'=>$total_buy_info
    ];
    return response()->json(['reports'=>$reports]);

}
}

<?php

namespace App\Http\Controllers\API\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\contact\contact;
use App\contact\contact_detail;
use App\Services\CommonService;
use App\Services\HelperService;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;
class ContactController extends Controller
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

    public function get_all_contact_list(Request $request){
        try{     
            $client_id = $request->client_id;
            $result = contact::where('client_id',$client_id)->get();
            return response()->json(['contact_list'=>$result]);
        } catch (\Exception $e) {
           // DB::rollback();
            Log::error(print_r($e->getMessage(), true));
            Log::error(print_r($e->getTraceAsString(), true));
            return response()->json(array('result' => 400, 
            'status'  => 'error',
            'icon'    => 'times',
            'message' => $e->getMessage()));
        }
    }
}

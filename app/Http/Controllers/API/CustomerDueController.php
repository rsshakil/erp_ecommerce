<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\API\CustomerDueListResource;
use App\Services\CommonService;
use App\Services\HelperService;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use DB;
use App\User;
use App\users_details;
use App\product\product_category;
use App\Sell;
use App\Purchase;
use App\contact\contact;
use App\contact\contact_detail;
class CustomerDueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;

      $query =Sell::select(
            DB::raw('SUM(total_quantity) AS sum_of_total_quantity'),
            DB::raw('SUM(total_amount) AS sum_of_total_amount'),
            DB::raw('SUM(total_paid_amount) AS sum_of_total_paid_amount'),
            DB::raw('SUM(total_due_amount) AS sum_of_total_due_amount'),
            DB::raw('SUM(total_discount_amount) AS sum_of_total_discount_amount'),
            'sell_id',
            'phone',
            'mobile',
            'full_name'
        )
        ->join('contacts','sells.contact_id','contacts.contact_id')
        ->where('sells.client_id',$request->client_id);
        $search = $request->search;
        if($search != 'false'){
            $query->where('contacts.full_name', 'LIKE', "%{$search}%");
        }

        $data = $query->groupBy('sells.contact_id')
        ->orderBy('sells.sell_id','DESC')
        ->paginate($dataSorting);
      
       return CustomerDueListResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'phone' => 'required',
            "full_name" => "required|",
        ]);

        if ($validator->fails()) {
            
            return response()->json(array('result' => 400, 'message' => $validator->errors()->first()));
        }
        DB::beginTransaction();
        try {

            $name = $request->phone;
            $email = $request->email;
            $password = $request->phone;
            $roles = 'Admin';
    
            $hash_password = Hash::make($password);
            $user_exist = User::where('email', $email)->first();
            if ($user_exist) {
                return redirect()->back()
                     ->with("message","Your info duplicate found")
                     ->with("message_type","danger");
            } else {
                $user = new User;
                $user->name = $name;
                $user->email = $email;
                $user->password = $hash_password;
                $user->save();
                $last_user_id = $user->id;
                $user_details = new users_details;
                $user_details->user_id = $last_user_id;
                $user_details->save();
                $users = User::findOrFail($last_user_id);
    
                // $roles = $request->roles;
                $role = Role::find($roles);
                $user_role = User::findOrFail($last_user_id);
                $user_role->syncRoles();
                $user_role->assignRole($roles);
            }

            $data = array();
            $data['user_id']= $last_user_id;
            $data['phone']= $request->phone;
            $data['mobile']= $request->phone;
            $data['email']= $request->email;
            $data['client_id']= $request->client_id;
            $data['address1']= $request->address1;
            $data['full_name']= $request->full_name;
            contact::insert($data);
            DB::commit(); 
            return response()->json([
                'status'  => 'success',
                'message' => 'customer has been created!',
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

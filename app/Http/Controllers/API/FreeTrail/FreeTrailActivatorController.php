<?php

namespace App\Http\Controllers\API\FreeTrail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AllUsedFunction;
use App\User;
use App\users_details;
use App\product\branch_control;
use App\contact\contact;
use App\contact\contact_detail;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use DB;

class FreeTrailActivatorController extends Controller
{

    private $all_used_functions;
    
    public function __construct()
    {
        $this->all_used_functions = new AllUsedFunction();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($activator_id=null)
    {
        $title = "Dashboard";
        $active = 'dashboard';

        return view('backend.layouts.activator', compact('title', 'active'));
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
        // return $request->all();
        /*insert user if not exist*/

        $this->validate($request, [
'fname'=>'required',
'branch'=>'required',
'warehouse'=>'required',
'address'=>'required',
'address2'=>'required',
'city'=>'required',
'country'=>'required',
'phones'=>'required',
'currency'=>'required',
'language'=>'required',
'timezone'=>'required',
'sname'=>'required',
'user_name'=>'required',
'password'=>'required',
'co_password'=>'required',
'title'=>'required',
'representative'=>'required',
'username'=>'required',
'mobile'=>'required',
        ]);

        $name = $request->username;
        $email = $request->user_name;
        $password = $request->password;
        $roles = 'Admin';

        $hash_password = Hash::make($password);
        $user_exist = User::where('email', $email)->first();
        if ($user_exist) {
            return redirect()->back()
                 ->with("message","Your company info duplicate found")
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
            //$users->assignRole('User');
            // $permission_id = $request->permissions;
            // $permission = Permission::all();
            // $users->revokePermissionTo($permission);
            //$users->syncPermissions($permission_id);
            // return response()->json(['title'=>"Created!",'message' =>"created", 'class_name' => 'success']);
            branch_control::insert(['client_id'=>$last_user_id,
            'com_name'=>$request->fname,
            'br_name'=>$request->branch,
            'wh_name'=>$request->warehouse,
            'status'=>'0',
            'entry_by'=>$last_user_id,
            ]);

            $contact_id = contact::insertGetId([
                    'client_id'=>$last_user_id,
                    'company_id'=>$request->sname,
                    'user_id'=>$last_user_id,
                    'lang'=>$request->language,
                    'currency'=>$request->currency,
                    'timezone'=>$request->timezone,
                    'title'=>$request->title,
                    'full_name'=>$request->representative,
                    'contact_person_name'=>$request->representative,
                    'contact_person_mobile'=>$request->mobile,
                    'warehouse'=>$request->warehouse,
                    'address1'=>$request->address,
                    'address2'=>$request->address2,
                    'city'=>$request->city,
                    'country'=>$request->country,
                    'phone'=>$request->mobile,
                    'mobile'=>$request->mobile,
                    'email'=>$email,
                    'type'=>'Client',
                    'status'=>'0',
                    'entry_by'=>$last_user_id,
            ]);
            return redirect()->back()
                 ->with("message","Your Registration has been successfull")
                 ->with("message_type","success");

        }
        return redirect()->back()
        ->with("message","Your content is not valid")
        ->with("message_type","danger");
        /*insert user if not exist*/

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

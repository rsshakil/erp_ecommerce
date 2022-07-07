<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use App\users_details;
use App\contact\contact;
use App\contact\contact_detail;
use App\product\product;
use Auth;
class User extends Authenticatable
{
    use Notifiable,HasRoles;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * Get the phone record associated with the user.
     */
    // public function userDetailsRel()
    // {
    //     // return $this->hasOne('App\users_details', 'user_id');
    //     return $this->hasOne('App\users_details', 'user_id', 'id');
    // }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function getFirstNameAttribute() 
    public function getImageAttribute() 
    {
        $user_id= Auth::user()->id;
        $user_details = users_details::where('user_id', $user_id)->first();
        if($user_details){
            $image_name = $user_details->image;
        } else {
            $image_name = null;
        }        
        return $image_name;
    }
    public function getClientIdAttribute() 
    {
        $user_id= Auth::user()->id;
        $contact = contact::where('user_id', $user_id)->first();
       
        if($contact){
            $client_id  = $contact->client_id;
        } else {
            $client_id  = 2;
        }        
        return $client_id;
    }
    // For check permission like can in vue 
    public function getAllPermissionsAttribute() {
        $permissions = [];
          foreach (Permission::all() as $permission) {
            if (Auth::user()->can($permission->name)) {
              $permissions[] = $permission->name;
            }
          }
        return $permissions;
     }

    //get all merchant product
    public function get_merchant_products(){
      return $this->hasMany('App\product\product','client_id','id');
    }

    //get all merchant product
    public function get_merchant_product_categories(){
      return $this->hasMany('App\product\product_category','client_id','id');
    }
    //get all merchant brand manufact
    public function get_merchant_brands(){
      return $this->hasMany('App\product\type_control','client_id','id');
    }
    //get all merchant 
    public function get_merchant_shops(){
      return $this->hasMany('App\product\branch_control','client_id','id');
    }
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Authentication Route
// Route::group(['middleware'=>'MyMiddleWire'],function(){
	Route::group(
		[
			'middleware' => 'api'
		],
		function ($router) {
			//Route::resource('pcategory', '\App\Http\Controllers\API\PcategoryController');
		Route::apiResources([
			'role' => 'API\RoleController',
			'permission' => 'API\PermissionController',
			'users' => 'API\UsersController',
			'sell' => 'API\Sell\SellController',
			'returnsell' => 'API\Sell\SellController',
			'purchase' => 'API\Purchase\PurchaseController',
			'stocks' => 'API\StockController',
			'category' => 'API\CategoryController',
			'pcategory' => 'API\PcategoryController',
			'cost' => 'API\CostController',
			'customerdues' => 'API\CustomerDueController',
			'mydues' => 'API\MyDueController',
			'myblance' => 'API\MyBlanceController',
			'payments' => 'API\BlancePayController',

	]);
});
		Route::get('/all_users_roles', 'API\AssignRoleModel@allUsersAndRoles');
		Route::get('/get_roles/{id}', 'API\AssignRoleModel@getRoleById');
		Route::post('/assign_role_to_user', 'API\AssignRoleModel@assignModelRole');

		Route::get('/all_users_permissions', 'API\AssignPermissionModel@allUsersAndPermissions');
		Route::get('/get_permission_model/{id}', 'API\AssignPermissionModel@getPermissionModel');
		Route::post('/assign_permission_to_user', 'API\AssignPermissionModel@assignPermissionToModel');

		Route::post('/get_permission_for_roles', 'API\AssignPermissionModel@getPermissionsByRole');
		Route::post('/permissions_by_users', 'API\AssignPermissionModel@getPermissionsByUser');
		Route::post('/change_password', 'API\UsersController@changePassword');

		Route::get('/user_details/{user_id}', 'API\UsersController@userDetails');
		Route::post('/users_update', 'API\UsersController@update');

		Route::get('/home_lang_data', 'API\LanguageController@homeLangData');
		Route::post('/get_all_products','API\product\ProductController@get_all_client_products');
		Route::post('/get_all_products_name_id','API\product\ProductController@get_all_products_name_id');
		Route::post('/get_product_by_id','API\product\ProductController@get_product_by_id');
		Route::get('/get_all_product_category','API\product\ProductcategoryController@index');
		Route::get('/get_all_product_sub_category/{category_id}','API\product\ProductcategoryController@all_subcategory_by_category_id');
		Route::post('store', 'ImageController@store');
		Route::post('add_product_to_db', 'API\product\ProductController@add_product_to_db');
		Route::post('purchase_history', 'API\Purchase\PurchaseController@history');
		Route::post('purchase_invoice_update', 'API\Purchase\PurchaseController@purchase_invoice_update');
		Route::post('sell_history', 'API\Sell\SellController@history');
		Route::post('sell_invoice_update', 'API\Sell\SellController@sellInvoiceUpdate');

		Route::get('/get_all_product_brand','API\product\BrandController@index');
		Route::get('/get_all_product_manufacturer','API\product\ManufacturerController@index');
		Route::get('/get_all_contact_list','API\Contact\ContactController@get_all_contact_list');
		Route::get('/cost_category_list/{client_id}','API\CategoryController@cost_category_list');
		Route::post('/register-company', 'API\FreeTrail\FreeTrailActivatorController@store');
		Route::post('/get_all_stock_report', 'API\ReportController@get_all_stock_report');
		Route::post('/get_all_stock_report_with_filter', 'API\ReportController@get_all_stock_report_with_filter');
		// Route::post('/permission_check', 'API\PermissionController@check');

	// });

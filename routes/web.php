<?php


//-------------------company portal Routes------------------------------------------------------
Route::get('/', function () {
    return view('companyportal.login');
});

Route::get('/login', function () {
    return view('companyportal.login');
});

Route::post('/check_login_details','CompanyController@check_login_details');
Route::get('/lost_password','ResturantController@lost_password');
Route::get('/recover_password/{token}','ResturantController@recover_password');
Route::post('/reset_password_submit','ResturantController@reset_password_submit');



//---------------------------------------Company Auth Routes------------------------------------------
Route::group(['middleware' => ['auth:sender_infos','backHistory']], function()
{
    //----------Company Dashboard----------------------
    Route::get('/customer_dashboard/{id}','CompanyController@customer_dashboard');
    Route::post('/customer_chart_orders','CompanyController@customer_chart_orders')->name('customer_chart_orders');
    //----------Company Orders----------------------
    Route::get('customer_create_order/{id}','CompanyController@customer_create_order');
    Route::post('customer_add_order','CompanyController@customer_add_order');
    Route::get('customer_all_orders/{id}','CompanyController@customer_all_orders');
    Route::get('customer_to_be_pickedup/{id}','CompanyController@customer_to_be_pickedup');
    Route::get('customer_to_be_delivered/{id}','CompanyController@customer_to_be_delivered');
    Route::get('customer_lost_and_damages/{id}','CompanyController@customer_lost_and_damages');
    Route::get('customer_delivered/{id}','CompanyController@customer_delivered');
    Route::get('customer_to_be_returned/{id}','CompanyController@customer_to_be_returned');
    Route::get('customer_rtos/{id}','CompanyController@customer_rtos');
    Route::get('customer_cancelled/{id}','CompanyController@customer_cancelled');
    Route::get('customer_view_order_details/{id}','CompanyController@customer_view_order_details');
    Route::get('customer_logout','CompanyController@customer_logout');
    Route::get('/customer_change_password','CompanyController@customer_change_password');
    Route::post('/customer_change_password_submit','CompanyController@customer_change_password_submit');
    
});

//---------------------------------------Admin Auth Routes------------------------------------------

Route::get('/admin_login','AdminController@login');
Route::post('/login_submit','AdminController@login_submit');
Route::get('/forgot_password','AdminController@forgot_password');
Route::post('/forgot_password_submit','AdminController@forgot_password_submit');

Route::group(['middleware' => ['auth:admin','backHistory']], function()
{
    //----------admin logout----------------------
    Route::get('/logout','AdminController@logout');

    //----------admin Dashboard--------------------
    Route::get('/admin_dashboard','AdminController@dashboard');
    Route::get('/chart_orders','AdminController@chart_orders')->name('chart_orders');

    //----------admin Dashboard--------------------
    Route::get('/create_shipment_size','ShipmentSizeController@create_shipment_size');
    Route::post('/register_shipment_size','ShipmentSizeController@register_shipment_size');
    Route::get('/get_all_shipment_sizes','ShipmentSizeController@get_all_shipment_sizes');
    Route::get('/delete_shipment_size/{id}','ShipmentSizeController@delete_shipment_size');
    Route::get('/edit_shipment_size/{id}','ShipmentSizeController@edit_shipment_size');
    Route::post('/update_shipment_size','ShipmentSizeController@update_shipment_size');
    
    //----------admin Order Routes--------------------
    Route::get('all_orders','OrderController@all_orders');
    Route::get('to_be_pickedup','OrderController@to_be_pickedup');
    Route::get('to_be_delivered','OrderController@to_be_delivered');
    Route::get('lost_and_damages','OrderController@lost_and_damages');
    Route::get('delivered','OrderController@delivered');
    Route::get('to_be_returned','OrderController@to_be_returned');
    Route::get('rtos','OrderController@rtos');
    Route::get('cancelled','OrderController@cancelled');
    
    //----------admin Create Order Routes--------------------
    Route::get('create_order','OrderController@create_order');
    Route::post('add_order','OrderController@add_order');
    Route::post('get_sender_all_info','CompanyController@get_sender_all_info')->name('get_sender_all_info');
    Route::get('view_order_details/{id}','OrderController@view_order_details');
    
    //----------admin Excel Order Routes--------------------
    Route::get('upload_orders','OrderController@upload_orders');
    Route::post('upload_excel_orders','OrderController@upload_excel_orders');
    
    
    //----------admin change order status routes---------------
    Route::get('mark_as_to_be_picked_up/{id}','OrderController@mark_as_to_be_picked_up');
    Route::get('mark_as_to_be_delivered/{id}','OrderController@mark_as_to_be_delivered');
    Route::get('mark_as_lost_and_damages/{id}','OrderController@mark_as_lost_and_damages');
    Route::get('mark_as_delivered/{id}','OrderController@mark_as_delivered');
    Route::get('mark_as_to_be_returned/{id}','OrderController@mark_as_to_be_returned');
    Route::get('mark_as_rto/{id}','OrderController@mark_as_rto');
    Route::get('mark_as_cancel_order/{id}','OrderController@mark_as_cancel_order');
    Route::get('assign_delivery_boy','OrderController@assign_delivery_boy');
    Route::get('assigned_delivery_boy/{order_id}/{delivery_boy_id}','OrderController@assigned_delivery_boy');
    Route::get('printable_order/{id}','OrderController@printable_order');
    
    //----------admin create company Routes--------------------
    Route::get('create_company','CompanyController@create_company');
    Route::post('add_company','CompanyController@add_company');
    Route::get('get_all_companies','CompanyController@get_all_companies');
    Route::get('edit_company/{id}','CompanyController@edit_company');
    Route::get('delete_company/{id}','CompanyController@delete_company');
    Route::post('update_company','CompanyController@update_company');
    
    
    //----------admin Profile-----------------------
    Route::get('/change_password','AdminController@change_password');
    Route::post('/change_password_submit','AdminController@change_password_submit');
    
    //----------admin create deliveryboy--------------------
    Route::get('/create_delivery_boy','DeliveryBoyController@create_delivery_boy');
    Route::post('/add_delivery_boy','DeliveryBoyController@add_delivery_boy');
    Route::get('/get_all_delivery_boys','DeliveryBoyController@get_all_delivery_boys');
    Route::get('/delete_delivery_boy/{id}','DeliveryBoyController@delete_delivery_boy');
    Route::get('/edit_delivery_boy/{id}','DeliveryBoyController@edit_delivery_boy');
    Route::post('/update_delivery_boy','DeliveryBoyController@update_delivery_boy');
    
    //----------admin create bank--------------------
    Route::get('/create_bank','BankController@create_bank');
    Route::get('/get_all_bank_details','BankController@get_all_bank_details');
    Route::get('/delete_bank_details/{id}','BankController@delete_bank_details');
    Route::get('/edit_bank_details/{id}','BankController@edit_bank_details');
    Route::post('/update_bank_details','BankController@update_bank_details');
    Route::post('/add_bank_details','BankController@add_bank_details');
    
});	


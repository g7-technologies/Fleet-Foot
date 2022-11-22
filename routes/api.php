<?php

use Illuminate\Http\Request;

Route::post('/delivery_boy_login','API\DeliveryBoyController@delivery_boy_login');

Route::post('/delivery_boy_change_email','API\DeliveryBoyController@delivery_boy_change_email');

Route::post('/delivery_boy_change_phone','API\DeliveryBoyController@delivery_boy_change_phone');

Route::post('/delivery_boy_change_password','API\DeliveryBoyController@delivery_boy_change_password');

Route::post('/mark_as_to_be_delivered','API\DeliveryBoyController@mark_as_to_be_delivered');

Route::post('/mark_as_lost_and_damages','API\DeliveryBoyController@mark_as_lost_and_damages');

Route::post('/mark_as_delivered','API\DeliveryBoyController@mark_as_delivered');

Route::post('/mark_as_to_be_returned','API\DeliveryBoyController@mark_as_to_be_returned');

Route::post('/mark_as_rto','API\DeliveryBoyController@mark_as_rto');

Route::post('/parcel_to_be_picked','API\DeliveryBoyController@parcel_to_be_picked');

Route::post('/parcel_to_be_delivered','API\DeliveryBoyController@parcel_to_be_delivered');
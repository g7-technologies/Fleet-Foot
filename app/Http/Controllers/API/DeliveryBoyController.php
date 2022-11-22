<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use DB;
use App\Order;
use App\SenderInfo;
use App\DeliveryBoy;
use App\ParcelInfo;
use App\ShipmentSize;
use App\DropOffLocations;

class DeliveryBoyController extends Controller
{
    public function delivery_boy_login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $delivery_boy = DeliveryBoy::where('email','=',$request->email)->where('status','=',1)->first();
        
        if($delivery_boy)
        {
            if(password_verify($request->password, $delivery_boy->password))
            {
                return response()->json(['error' => false,'user' => $delivery_boy,'success_msg' => 'Logged In successfully']);
            }
            else
            {
                return response()->json(['error' => true,'error_msg' => 'Login failed, invalid credentials']);
            }
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'No User Found..!']);
        }          
    }
    
    public function delivery_boy_change_password(Request $request)
    {
        $rules = [
            'new_password' => 'required',
            'old_password' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $delivery_boy = DeliveryBoy::where('id','=',$request->delivery_boy_id)->first();
        
        if(password_verify($request->old_password, $delivery_boy->password))
        {
            $delivery_boy->password = Hash::make($request->new_password);
            $delivery_boy->save();
            
            return response()->json(['error' => false,'user' => $delivery_boy,'success_msg' => 'Password Updated Successfully!']);
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'Password incorrect..Please Try Again!']);
        }
    }
    
    public function delivery_boy_change_phone(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $phone_count = DeliveryBoy::where('contact','=',$request->phone)->where('id','!=',$request->delivery_boy_id)->get();
        
        if(count($phone_count) > 0)
        {
            return response()->json(['error'=> true, 'error_msg' => 'Phone already exists']);
        }
        
        $delivery_boy = DeliveryBoy::where('id','=',$request->delivery_boy_id)->first();
        $delivery_boy->contact = $request->phone;
        $delivery_boy->save();
        
        return response()->json(['error' => false,'user' => $delivery_boy,'success_msg' => 'Phone Number changed']);
    }
    
    public function delivery_boy_change_email(Request $request)
    {
        $rules = [
            'email' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $email_count = DeliveryBoy::where('email','=',$request->email)->where('id','!=',$request->delivery_boy_id)->get();
        
        if(count($email_count) > 0){
            return response()->json(['error'=> true, 'error_msg' => 'Email already exists']);
        }
        
        $delivery_boy = DeliveryBoy::where('id','=',$request->delivery_boy_id)->first();
        $delivery_boy->email = $request->email;
        $delivery_boy->save();

        return response()->json(['error' => false,'user' => $delivery_boy,'success_msg' => 'Email changed']);
    }
    
    public function mark_as_to_be_delivered(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $order = Order::where('id','=',$request->order_id)->first();
        
        if($order->delivery_boy_id == $request->delivery_boy_id)
        {
            $order->status = 2;
            
            if($order->save())
            {
                return response()->json(['error'=> false, 'success_msg' => 'Status Changed Successfully']);
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => 'Unable to change status. Try again..!']);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'You are not authorised for this action']);
        }
    }
    
    public function mark_as_lost_and_damages(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $order = Order::where('id','=',$request->order_id)->first();
        
        if($order->delivery_boy_id == $request->delivery_boy_id)
        {
            $order->status = 3;
            
            if($order->save())
            {
                return response()->json(['error'=> false, 'success_msg' => 'Status Changed Successfully']);
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => 'Unable to change status. Try again..!']);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'You are not authorised for this action']);
        }
    }
    
    public function mark_as_delivered(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $order = Order::where('id','=',$request->order_id)->first();
        
        if($order->delivery_boy_id == $request->delivery_boy_id)
        {
            $order->status = 4;
            
            if($order->save())
            {
                return response()->json(['error'=> false, 'success_msg' => 'Status Changed Successfully']);
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => 'Unable to change status. Try again..!']);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'You are not authorised for this action']);
        }
    }
    
    public function mark_as_to_be_returned(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $order = Order::where('id','=',$request->order_id)->first();
        
        if($order->delivery_boy_id == $request->delivery_boy_id)
        {
            $order->status = 5;
            
            if($order->save())
            {
                return response()->json(['error'=> false, 'success_msg' => 'Status Changed Successfully']);
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => 'Unable to change status. Try again..!']);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'You are not authorised for this action']);
        }
    }
    
    public function mark_as_rto(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $order = Order::where('id','=',$request->order_id)->first();
        
        if($order->delivery_boy_id == $request->delivery_boy_id)
        {
            $order->status = 6;
            
            if($order->save())
            {
                return response()->json(['error'=> false, 'success_msg' => 'Status Changed Successfully']);
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => 'Unable to change status. Try again..!']);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'You are not authorised for this action']);
        }
    }
    
    public function parcel_to_be_picked(Request $request)
    {
       $rules = [
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $orders_to_be_picked = Order::with(['parcel_info','sender_info','drop_off_location','delivery_boy','shipment_size'])->where('status','=',1)->where('delivery_boy_id','=',$request->delivery_boy_id)->get();
        
        return response()->json(['error' => false,'success_msg' => 'Orders Retrieved','orders_to_be_picked' => $orders_to_be_picked]);
    }
    
    public function parcel_to_be_delivered(Request $request)
    {
       $rules = [
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $orders_to_be_picked = Order::with(['parcel_info','sender_info','drop_off_location','delivery_boy','shipment_size'])->where('status','=',2)->where('delivery_boy_id','=',$request->delivery_boy_id)->get();
        
        return response()->json(['error' => false,'success_msg' => 'Orders Retrieved','orders_to_be_delivered' => $orders_to_be_picked]);
    }
    
    public function parcel_info(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'delivery_boy_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $order = Order::with(['parcel_info','sender_info','drop_off_location','delivery_boy','shipment_size'])->where('order_id','=',$request->order_id)->first();
        
        if($order->delivery_boy_id == $request->delivery_boy_id)
        {
            return response()->json(['error'=> false, 'success_msg' => 'Detail fetched Successfully','Order_info' => $order]);
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'You are not authorised for this action']);
        }
    }
}



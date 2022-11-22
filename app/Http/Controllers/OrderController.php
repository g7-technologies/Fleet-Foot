<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Order;
use App\SenderInfo;
use App\DeliveryBoy;
use App\ParcelInfo;
use App\DropOffLocations;
use DB;

class OrderController extends Controller
{
    
    public function all_orders()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->get();
        
        return view('order.all_orders',compact('orders'));
    }
    
    public function to_be_pickedup()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('status','=',1)->where('delivery_boy_id','!=',0)->get();
        
        return view('order.to_be_pickedup',compact('orders'));
    }
    
    public function to_be_delivered()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('status','=',2)->where('delivery_boy_id','!=',0)->get();
        
        return view('order.to_be_delivered',compact('orders'));
    }
    
    public function lost_and_damages()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('status','=',3)->where('delivery_boy_id','!=',0)->get();
        
        return view('order.lost_and_damages',compact('orders'));
    }
    
    public function delivered()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('status','=',4)->where('delivery_boy_id','!=',0)->get();
        
        return view('order.delivered',compact('orders'));
    }
    
    public function to_be_returned()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('status','=',5)->where('delivery_boy_id','!=',0)->get();
        
        return view('order.to_be_returned',compact('orders'));
    }
    
    public function rtos()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('status','=',6)->where('delivery_boy_id','!=',0)->get();
        
        return view('order.rtos',compact('orders'));
    }
    
    public function cancelled()
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('status','=',7)->where('delivery_boy_id','!=',0)->get();
        
        return view('order.cancelled',compact('orders'));
    }
    
    public function create_order()
    {
        $companies = SenderInfo::where('status','=',1)->get();
        $delivery_boy = DeliveryBoy::where('status','=',1)->get();
        return view('order.create_order',compact('companies','delivery_boy'));
    }
    
    public function add_order(Request $request)
    {
        $parcel_infos = ParcelInfo::create([
            'item_value' => $request->item_value,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'actual_weight' => $request->actual_weight,
            'chargeable_weight' => $request->chargeable_weight,
            'status' => 1
        ]);
        
        if(!$parcel_infos)
        {
            return redirect('/create_order')->with('error_msg', 'Unable to creat order. Try Again..!');
        }
        
        
        $drop_off_locations = DropOffLocations::create([
            'receipt_name' => $request->receiver_name,
            'phone_code' => $request->receiver_phone_code,
            'phone_number' => $request->receiver_phone_number,
            'country' => $request->receiver_country,
            'city' => $request->receiver_city,
            'address' => $request->receiver_address,
            'status' => 1
        ]);
        
        if(!$drop_off_locations)
        {
            $parcel_infos->delete();
            return redirect('/create_order')->with('error_msg', 'Unable to creat order. Try Again..!');
        }
        
        $orders = Order::create([
            'order_id' => uniqid(),
            'shipment_method' => $request->shipment_method,
            'service_type' => $request->service_type,
            'cod' => $request->amount,
            'is_fragile' => $request->is_fragile,
            'delivery_boy_id' => $request->delivery_boy_id,
            'drop_off_location_id' => $drop_off_locations->id,
            'parcel_info_id' => $parcel_infos->id,
            'sender_info_id' => $request->sender,
            'shipment_size_id' => 1,
            'status' => 1
        ]);
        
        if(!$orders)
        {
            $parcel_infos->delete();
            $drop_off_locations->delete();
            return redirect('/create_order')->with('error_msg', 'Unable to creat order. Try Again..!');
        }
        else
        {
            if($request->item_description)
            {
                $parcel_infos->item_description = $request->item_description;
                $parcel_infos->save();
            }
            
            if($request->reference_id)
            {
                $drop_off_locations->refrence_id = $request->reference_id;
                $drop_off_locations->save();
            }
            
            if($request->receiver_email)
            {
                $drop_off_locations->receipt_email = $request->receiver_email;
                $drop_off_locations->save();
            }
            
            if($request->receiver_region)
            {
                $drop_off_locations->region = $request->receiver_region;
                $drop_off_locations->save();
            }
            
            if($request->receiver_street)
            {
                $drop_off_locations->street = $request->receiver_street;
                $drop_off_locations->save();
            }
            
            if($request->receiver_building_villa)
            {
                $drop_off_locations->building_villa = $request->receiver_building_villa;
                $drop_off_locations->save();
            }
            
            if($request->receiver_residential_type)
            {
                $drop_off_locations->address_type = $request->receiver_residential_type;
                $drop_off_locations->save();
            }
            
            if($request->receiver_office_appartment)
            {
                $drop_off_locations->office_apartment = $request->receiver_office_appartment;
                $drop_off_locations->save();
            }
            
            if($request->receiver_nearest_land_mark)
            {
                $drop_off_locations->nearest_land_mark = $request->receiver_nearest_land_mark;
                $drop_off_locations->save();
            }
            
            if($request->description)
            {
                $orders->description = $request->description;
                $orders->save();
            }
            
            if($request->paid_by)
            {
                $orders->paid_by = $request->paid_by;
                $orders->save();
            }
            
            if($request->quantity)
            {
                $orders->quantity = $request->quantity;
                $orders->save();
            }
            
            if($request->alternate_phone1)
            {
                $orders->alternate_phone1 = $request->alternate_phone1;
                $orders->save();
            }
            
            if($request->alternate_phone2)
            {
                $orders->alternate_phone2 = $request->alternate_phone2;
                $orders->save();
            }
            
            if($request->not_delivered)
            {
                $orders->not_delivered = $request->not_delivered;
                $orders->save();
            }
            
            return redirect('/create_order')->with('success_msg', 'Order Created Successfully');
        }
    }
    
    public function view_order_details($id)
    {
        $order = Order::with(['parcel_info','sender_info','drop_off_location','delivery_boy','shipment_size'])->where('id','=',$id)->first();
        
        return view('order.view_order_details',compact('order'));
    }
    
    public function mark_as_to_be_picked_up($id)
    {
        $order = Order::where('id','=',$id)->first();
        $order->status = 1;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Status Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to change status. Try Again..!');
        }
    }
    
    public function mark_as_to_be_delivered($id)
    {
        $order = Order::where('id','=',$id)->first();
        $order->status = 2;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Status Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to change status. Try Again..!');
        }
    }
    
    public function mark_as_lost_and_damages($id)
    {
        $order = Order::where('id','=',$id)->first();
        $order->status = 3;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Status Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to change status. Try Again..!');
        }
    }
    
    public function mark_as_delivered($id)
    {
        $order = Order::where('id','=',$id)->first();
        $order->status = 4;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Status Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to change status. Try Again..!');
        }
    }
    
    public function mark_as_to_be_returned($id)
    {
        $order = Order::where('id','=',$id)->first();
        $order->status = 5;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Status Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to change status. Try Again..!');
        }
    }
    
    public function mark_as_rto($id)
    {
        $order = Order::where('id','=',$id)->first();
        $order->status = 6;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Status Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to change status. Try Again..!');
        }
    }
    
    public function mark_as_cancel_order($id)
    {
        $order = Order::where('id','=',$id)->first();
        $order->status = 7;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Status Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to change status. Try Again..!');
        }
    }
    
    public function assign_delivery_boy()
    {
        
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('delivery_boy_id','=',0)->get();
        $delivery_boy = DeliveryBoy::where('status','=',1)->get();
        
        return view('order.assign_delivery_boy',compact('orders','delivery_boy'));
    }
    
    public function assigned_delivery_boy($order_id,$delivery_boy_id)
    {
        $order = Order::where('delivery_boy_id','=',0)->where('id','=',$order_id)->first();
        $order->delivery_boy_id = $delivery_boy_id;
        
        if($order->save())
        {
            return redirect()->back()->with('success_msg','Order Assigned Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to assign order. Try Again..!');
        }
    }
    
    public function printable_order($id)
    {
        $order = Order::with(['parcel_info','sender_info','drop_off_location','delivery_boy','shipment_size'])->where('id','=',$id)->first();
        
        return view('order.printable_order',compact('order'));
    }
    
    public function upload_orders()
    {
        return view('order.upload_orders');
    }
    
    public function upload_excel_orders(Request $request)
    {
        dd($request);
    }
    
}

<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\ShipmentSize;
use DB;

class ShipmentSizeController extends Controller
{
    
    public function create_shipment_size()
    {
        return view('shipmentSize.create_shipment_size');
    }
    
    public function register_shipment_size(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'chargeable_weight' => 'required|numeric'
        ]);
        
        $shipment_size = ShipmentSize::create([
            'name'=> str_replace("'", '', $request->name),
            'measuring_unit'=> 'cm/kg',
            'length'=> $request->length,
            'width'=> $request->width,
            'height'=> $request->height,
            'chargeable_weight'=> $request->chargeable_weight,
            'status'=> 1
        ]);
        
        if($shipment_size)
        {
            return redirect('/create_shipment_size')->with('success_msg', 'Shipment Size Created Successfully');   
        }
        else
        {
            return redirect('/create_shipment_size')->with('error_msg', 'Unable to create shipment size. Please Try Again..!');   
        }
    }
    
    public function get_all_shipment_sizes()
    {
        $shipment_sizes = ShipmentSize::where('status','=',1)->orderBy('id', 'DESC')->get();
        return view('shipmentSize.get_all_shipment_sizes',compact('shipment_sizes'));
    }
    
    public function delete_shipment_size($id)
    {
        $shipment_size = ShipmentSize::where('id','=',$id)->first();
        $shipment_size->status = 0;
        $shipment_size->save();
        
        if($shipment_size)
        {
            return redirect('/get_all_shipment_sizes')->with('success_msg', 'Shipment Size Deleted Successfully');   
        }
        else
        {
            return redirect('/get_all_shipment_sizes')->with('error_msg', 'Unable to delete shipment size. Please Try Again..!');   
        }
    }
    
    public function edit_shipment_size($id)
    {
        $shipment_size = ShipmentSize::where('id','=',$id)->first();
        return view('shipmentSize.edit_shipment_size',compact('shipment_size'));
    }
    
    public function update_shipment_size(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'chargeable_weight' => 'required|numeric'
        ]);
        
        $shipment_size = ShipmentSize::where('id','=',$request->id)->first();
        
        $shipment_size->name = str_replace("'", '', $request->name);
        $shipment_size->length = $request->length;
        $shipment_size->width = $request->width;
        $shipment_size->height = $request->height;
        $shipment_size->chargeable_weight = $request->chargeable_weight;
        
        if($shipment_size->save())
        {
            return redirect('/get_all_shipment_sizes')->with('success_msg', 'Shipment Size Updated Successfully');   
        }
        else
        {
            return redirect('/get_all_shipment_sizes')->with('error_msg', 'Unable to update shipment size. Please Try Again..!');   
        }
    }
    
    
    public function register_deliveryboy(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|max:18'
        ]);
        
        $email_count = DeliveryBoy::where('email','=',$request->email)->get();
        
        if(count($email_count) > 0){
            return view('deliveryboy.create_deliveryboys')->with('message','Email already exists!');
        }
        
        $phone_count = DeliveryBoy::where('phone','=',$request->phone)->get();
        
        if(count($phone_count) > 0){
            return view('deliveryboy.create_deliveryboys')->with('message','Phone already exists');
        }
        
        $deliveryboy = DeliveryBoy::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phone'=> $request->phone,
            'device_id'=> 0
        ]);
        
        return redirect('/get_active_deliveryboys');
    }
}

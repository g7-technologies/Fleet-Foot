<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\DeliveryBoy;
use DB;

class DeliveryBoyController extends Controller
{
    
    public function create_delivery_boy()
    {
        return view('deliveryboy.create_delivery_boy');
    }
    
    public function add_delivery_boy(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'password'=>'required',
            'address'=>'required'
        ]);
        
        
        $deliveryboy = DeliveryBoy::create([
            'name'=> $request->name,
            'contact'=> $request->contact,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'address'=> $request->address,
            'status'=> 1
        ]);
        
        if($deliveryboy)
        {
            return redirect('/create_delivery_boy')->with('success_msg', 'Delivery Boy Created Successfully');
        }
        else
        {
            return redirect('/create_delivery_boy')->with('error_msg', 'Unable to create Delivery Boy. Please Try Again..!');
        }
    }
    
    public function get_all_delivery_boys()
    {
        $deliveryboys = DeliveryBoy::where('status','=',1)->get();
        return view('deliveryboy.get_all_delivery_boys',compact('deliveryboys'));
    }
    
    public function edit_delivery_boy($id)
    {
        $deliveryboy = DeliveryBoy::where('id','=',$id)->first();
        return view('deliveryboy.edit_delivery_boy',compact('deliveryboy'));
    }
    
    public function delete_delivery_boy($id)
    {
        $deliveryboy = DeliveryBoy::where('id','=',$id)->first();
        $deliveryboy->status = 0;
        
        if($deliveryboy->save())
        {
            return redirect('/get_all_delivery_boys')->with('success_msg', 'Delivery Boy Deleted Successfully');   
        }
        else
        {
            return redirect('/get_all_delivery_boys')->with('error_msg', 'Unable to delete Delivery Boy. Please Try Again..!');   
        }
    }
    
    public function update_delivery_boy(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'address'=>'required'
        ]);
        
        $deliveryboy = DeliveryBoy::where('id','=',$request->id)->first();
        
        $deliveryboy->name = $request->name;
        $deliveryboy->contact = $request->contact;
        $deliveryboy->email = $request->email;
        $deliveryboy->address = $request->address;
        
        if($request->password != null || $request->password != '')
        {
            $deliveryboy->password = Hash::make($request->password);
        }
        
        if($deliveryboy->save())
        {
            return redirect('/get_all_delivery_boys')->with('success_msg', 'Delivery Boy Updated Successfully');   
        }
        else
        {
            return redirect('/get_all_delivery_boys')->with('error_msg', 'Unable to update Delivery Boy. Please Try Again..!');   
        }
    }
}

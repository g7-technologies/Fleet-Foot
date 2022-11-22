<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\SenderInfo;
use App\Order;
use App\ParcelInfo;
use App\DropOffLocations;
use App\DeliveryBoy;
use App\ShipmentSize;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompanyController extends Controller
{
    
    public function create_company()
    {
        return view('company.create_company');
    }
    
    public function add_company(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone_code' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'password' => 'required',
            'country' => 'required',
            'city' => 'required',
            'region' => 'required',
            'street' => 'required',
            'address' => 'required',
            'building_villa' => 'required',
            'office_apartment' => 'required',
            'residential_type' => 'required',
            'nearest_land_mark' => 'required'
        ]);
        
        $sender_info = SenderInfo::create([
            'name' => $request->name,
            'phone_code' => $request->phone_code,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'city' => $request->city,
            'region' => $request->region,
            'street' => $request->street,
            'address' => $request->address,
            'building_villa' => $request->building_villa,
            'office_apartment' => $request->office_apartment,
            'residential_type' => $request->residential_type,
            'nearest_land_mark' => $request->nearest_land_mark,
            'status' => 1
        ]);
        
        if($sender_info)
        {
            return redirect('/create_company')->with('success_msg', 'Company Created Successfully');   
        }
        else
        {
            return redirect('/create_company')->with('error_msg', 'Unable to create Company. Please Try Again..!');   
        }
    }
    
    public function get_all_companies()
    {
        $companies = SenderInfo::where('status','=',1)->get();
        return view('company.get_all_companies',compact('companies'));
    }
    
    public function edit_company($id)
    {
        $company = SenderInfo::where('id','=',$id)->first();
        return view('company.edit_company',compact('company'));
    }
    
    public function delete_company($id)
    {
        $company = SenderInfo::where('id','=',$id)->first();
        $company->status=0;
        
        if($company->save())
        {
            return redirect('/get_all_companies')->with('success_msg', 'Company Deleted Successfully');   
        }
        else
        {
            return redirect('/get_all_companies')->with('error_msg', 'Unable to delete Company. Please Try Again..!');   
        }
    }
    
    public function update_company(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone_code' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'country' => 'required',
            'city' => 'required',
            'region' => 'required',
            'street' => 'required',
            'address' => 'required',
            'building_villa' => 'required',
            'office_apartment' => 'required',
            'residential_type' => 'required',
            'nearest_land_mark' => 'required'
        ]);
        
        $company = SenderInfo::where('id','=',$request->id)->first();
        
        $company->name = $request->name;
        $company->phone_code = $request->phone_code;
        $company->phone_number = $request->phone_number;
        $company->email = $request->email;
        $company->country = $request->country;
        $company->city = $request->city;
        $company->region = $request->region;
        $company->street = $request->street;
        $company->address = $request->address;
        $company->building_villa = $request->building_villa;
        $company->office_apartment = $request->office_apartment;
        $company->residential_type = $request->residential_type;
        $company->nearest_land_mark = $request->nearest_land_mark;
        
        if($company->password != null || $company->password != '')
        {
            $company->password = $request->password;
        }
        
        if($company->save())
        {
            return redirect('/get_all_companies')->with('success_msg', 'Company Updated Successfully');   
        }
        else
        {
            return redirect('/get_all_companies')->with('error_msg', 'Unable to update Company. Please Try Again..!');   
        }
    }
    
    public function get_sender_all_info(Request $request)
    {
        $company = SenderInfo::where('id','=',$request->id)->first();
        
        if($company)
        {
            return response()->json(['error' => false,'success_msg' => 'data fetched!','company'=>$company]);   
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'no data fetched!']);   
        }
    }
    
    public function check_login_details(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $email = $request->email;
		$password = $request->password;
		
		$company = SenderInfo::where(['email' => $email])->first();
		
		if($company)
		{
			if(Auth::guard('sender_infos')->attempt(['email'=> $email, 'password' => $password]))
			{
				return redirect('/customer_dashboard/'.$company->id);
			}
            else
            {
                return redirect('/')->with('message', 'Invalid Credentials!');
            }
        }
        else
        {
            return redirect('/')->with('message', 'You are not authorized!');
        }
    }
    
    public function customer_dashboard($id)
    {
        $total_orders = Order::where('sender_info_id','=',$id)->count();
        $domestic_orders = Order::where('shipment_method','=','Domestic')->where('sender_info_id','=',$id)->count();
        $international_orders = Order::where('shipment_method','=','International')->where('sender_info_id','=',$id)->count();
        $unassigned_orders = Order::where('delivery_boy_id','=','0')->where('sender_info_id','=',$id)->count();
        $to_be_picked_up_orders = Order::where('delivery_boy_id','!=','0')->where('status','=',1)->where('sender_info_id','=',$id)->count();
        $to_be_delivered_orders = Order::where('status','=',2)->where('sender_info_id','=',$id)->count();
        $lost_and_damages_orders = Order::where('status','=',3)->where('sender_info_id','=',$id)->count();
        $delivered_orders = Order::where('status','=',4)->where('sender_info_id','=',$id)->count();
        $to_be_returned_orders = Order::where('status','=',5)->where('sender_info_id','=',$id)->count();
        $rots_orders = Order::where('status','=',6)->where('sender_info_id','=',$id)->count();
        $cancelled_orders = Order::where('status','=',7)->where('sender_info_id','=',$id)->count();
        return view('companyportal.dashboard',compact('total_orders','domestic_orders','international_orders','unassigned_orders','to_be_picked_up_orders','to_be_delivered_orders','lost_and_damages_orders','delivered_orders','to_be_returned_orders','rots_orders','cancelled_orders'));
    }
    
    public function customer_chart_orders(Request $request)
    {
        $months = [];
        $unassigned_orders = [];
        $to_be_picked_up_orders = [];
        $to_be_delivered_orders = [];
        $lost_and_damages_orders = [];
        $delivered_orders = [];
        $to_be_returned_orders = [];
        $rots_orders = [];
        $cancelled_orders = [];
        
        for($i=0;$i<6;$i++)
        {
            $month = Carbon::now()->addMonths(-1*$i)->format('M Y');
            
            $unassigned_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as unassigned_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND delivery_boy_id = 0 AND sender_info_id = '$request->id'"));
            $to_be_picked_up_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as to_be_picked_up_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 1 AND delivery_boy_id != 0 AND sender_info_id = '$request->id'"));
            $to_be_delivered_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as to_be_delivered_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 2 AND sender_info_id = '$request->id'"));
            $lost_and_damages_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as lost_and_damages_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 3 AND sender_info_id = '$request->id'"));
            $delivered_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as delivered_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 4 AND sender_info_id = '$request->id'"));
            $to_be_returned_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as to_be_returned_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 5 AND sender_info_id = '$request->id'"));
            $rots_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as rots_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 6 AND sender_info_id = '$request->id'"));
            $cancelled_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as cancelled_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 7 AND sender_info_id = '$request->id'"));
            
            array_push($unassigned_orders,$unassigned_orders_per_month[0]->unassigned_orders_per_month);
            array_push($to_be_picked_up_orders,$to_be_picked_up_orders_per_month[0]->to_be_picked_up_orders_per_month);
            array_push($to_be_delivered_orders,$to_be_delivered_orders_per_month[0]->to_be_delivered_orders_per_month);
            array_push($lost_and_damages_orders,$lost_and_damages_orders_per_month[0]->lost_and_damages_orders_per_month);
            array_push($delivered_orders,$delivered_orders_per_month[0]->delivered_orders_per_month);
            array_push($to_be_returned_orders,$to_be_returned_orders_per_month[0]->to_be_returned_orders_per_month);
            array_push($rots_orders,$rots_orders_per_month[0]->rots_orders_per_month);
            array_push($cancelled_orders,$cancelled_orders_per_month[0]->cancelled_orders_per_month);
            array_push($months,$month);
        }
        
        $chart_orders = array(
            'months'=> $months,
            'unassigned_orders'=> $unassigned_orders,
            'to_be_picked_up_orders'=> $to_be_picked_up_orders,
            'to_be_delivered_orders'=> $to_be_delivered_orders,
            'lost_and_damages_orders'=> $lost_and_damages_orders,
            'delivered_orders'=> $delivered_orders,
            'to_be_returned_orders'=> $to_be_returned_orders,
            'rots_orders'=> $rots_orders,
            'cancelled_orders'=> $cancelled_orders
        );
        
        return $chart_orders;
    }
    
    public function customer_all_orders($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->get();
        
        return view('companyportal.all_orders',compact('orders'));
    }
    
    public function customer_to_be_pickedup($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->where('status','=',1)->get();
        
        return view('companyportal.to_be_pickedup',compact('orders'));
    }
    
    public function customer_to_be_delivered($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->where('status','=',2)->get();
        
        return view('companyportal.to_be_delivered',compact('orders'));
    }
    
    public function customer_lost_and_damages($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->where('status','=',3)->get();
        
        return view('companyportal.lost_and_damages',compact('orders'));
    }
    
    public function customer_delivered($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->where('status','=',4)->get();
        
        return view('companyportal.delivered',compact('orders'));
    }
    
    public function customer_to_be_returned($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->where('status','=',5)->get();
        
        return view('companyportal.to_be_returned',compact('orders'));
    }
    
    public function customer_rtos($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->where('status','=',6)->get();
        
        return view('companyportal.rtos',compact('orders'));
    }
    
    public function customer_cancelled($id)
    {
        $orders = Order::with(['parcel_info','sender_info','drop_off_location'])->where('sender_info_id','=',$id)->where('status','=',7)->get();
        
        return view('companyportal.cancelled',compact('orders'));
    }
    
    public function customer_create_order($id)
    {
        $companies = SenderInfo::where('status','=',1)->where('id','=',$id)->first();
        return view('companyportal.create_order',compact('companies'));
    }
    
    public function customer_add_order(Request $request)
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
            return redirect('/customer_create_order/'.$request->sender)->with('error_msg', 'Unable to creat order. Try Again..!');
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
            return redirect('/customer_create_order/'.$request->sender)->with('error_msg', 'Unable to creat order. Try Again..!');
        }
        
        $orders = Order::create([
            'order_id' => uniqid(),
            'shipment_method' => $request->shipment_method,
            'service_type' => $request->service_type,
            'cod' => $request->amount,
            'is_fragile' => $request->is_fragile,
            'delivery_boy_id' => 0,
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
            return redirect('/customer_create_order/'.$request->sender)->with('error_msg', 'Unable to creat order. Try Again..!');
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
            
            return redirect('/customer_create_order/'.$request->sender)->with('success_msg', 'Order Created Successfully');
        }
    }
    
    public function customer_view_order_details($id)
    {
        $order = Order::with(['parcel_info','sender_info','drop_off_location','delivery_boy','shipment_size'])->where('id','=',$id)->first();
        
        return view('companyportal.view_order_details',compact('order'));
    }
    
    public function customer_logout()
    {
        Auth::logout();
    	return redirect('/');
    }
    
    public function customer_change_password()
    {
        return view('companyportal.change_password');
    }
    
    public function customer_change_password_submit(Request $request)
    {
        $this->validate($request,[
            'company_id' => 'required',
            'currentpassword' => 'required',
            'newpassword' => 'required',
            'newpassword_confirmation' => 'required'
        ]);
        
        $resturant = SenderInfo::where('id','=',$request->company_id)->first();
        
        if(!($request->newpassword == $request->newpassword_confirmation)){
            return redirect()->back()->with("error","Your mew password does not matches with the confirm new password. Please try again.");
        }
        else if (!(password_verify($request->currentpassword, $resturant->password)))
        {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        else
        {
            $resturant->password = Hash::make($request->newpassword);
            $resturant->save();
            
            return redirect()->back()->with("success","Password changed successfully !");
        }
    }
    
    
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPassRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Notifications\passwordResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Order;
use App\SenderInfo;
use App\ParcelInfo;
use App\DeliveryBoy;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function login()
    {
    	return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
        ]);
        
        $email = $request->email;
		$password = $request->password;
		
		$admin = Admin::where(['email' => $email])->first();
		
		if($admin)
		{
			if(Auth::guard('admin')->attempt(['email'=> $email, 'password' => $password]))
			{
				return redirect('/admin_dashboard');
			}
            else
            {
                return redirect('/admin_login')->with('message', 'Invalid Credentials!');
            }
        }
        else
        {
            return redirect('/admin_login')->with('message', 'You are not authorized!');
        }
    }

    public function dashboard()
    {
        $total_customer = SenderInfo::where('status','=',1)->count();
        $total_orders = Order::count();
        $domestic_orders = Order::where('shipment_method','=','Domestic')->count();
        $international_orders = Order::where('shipment_method','=','International')->count();
        $unassigned_orders = Order::where('delivery_boy_id','=','0')->count();
        $to_be_picked_up_orders = Order::where('delivery_boy_id','!=','0')->where('status','=',1)->count();
        $to_be_delivered_orders = Order::where('status','=',2)->count();
        $lost_and_damages_orders = Order::where('status','=',3)->count();
        $delivered_orders = Order::where('status','=',4)->count();
        $to_be_returned_orders = Order::where('status','=',5)->count();
        $rots_orders = Order::where('status','=',6)->count();
        $cancelled_orders = Order::where('status','=',7)->count();
        
        return view('admin.dashboard',compact('total_customer','total_orders','domestic_orders','international_orders','unassigned_orders','to_be_picked_up_orders','to_be_delivered_orders','lost_and_damages_orders','delivered_orders','to_be_returned_orders','rots_orders','cancelled_orders'));
    }
    
    public function chart_orders()
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
            
            $unassigned_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as unassigned_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND delivery_boy_id = 0"));
            $to_be_picked_up_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as to_be_picked_up_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 1 AND delivery_boy_id != 0"));
            $to_be_delivered_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as to_be_delivered_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 2"));
            $lost_and_damages_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as lost_and_damages_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 3"));
            $delivered_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as delivered_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 4"));
            $to_be_returned_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as to_be_returned_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 5"));
            $rots_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as rots_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 6"));
            $cancelled_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as cancelled_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 7"));
            
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

    public function logout()
    {
    	Auth::logout();
    	return redirect('/admin_login');
    }

    public function admin_profile($id)
    {
        $admin = Admin::find($id);
        return view('profiles.admin_profile', compact('admin'));
    }

    public function update_profile_submit(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|min:3|max:20',
            'phone' => 'required|numeric|min:11|unique:admins',
        ]);

        $admin = \App\Admin::find($request->id);

       
        
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->save();

        return redirect('/admin_profile/'.$request->id)->with('message','Admin Profile Has Been Updated Successfully!');
    }

    public function forgot_password()
    {
        return view('admin.forgot_password');
    }

    public function forgot_password_submit(Request $request)
    {
        $email = $request->email;
       
        $user = Admin::whereEmail($email)->first();
        if($user != '') {
            $password = \Str::random(10);
            $user->password = bcrypt($password);
            $user->save();
            
            $to = $user->email;
            $from = 'woke_shee@gmail.com';
            $subject = 'Your New Password for TappedN, Please change it ASAP';
            $message = $password;
            $headers = 'From: woke_shee@gmail.com'."\r\n".
            'Reply-To: woke_shee@gmail.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            return response()->json(['success'=> "New System Generated Password sended to this email!"]);
        }else{
            return response()->json(['error'=> 'Email Doesn"t Exist']);
        }
    }

    public function change_password()
    {
        return view('admin.change_password');
    }
    
    public function change_password_submit(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) 
        {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
        {
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        
        return redirect()->back()->with("success","Password changed successfully !");
    }

   

}

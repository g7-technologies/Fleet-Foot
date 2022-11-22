<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Bank;
use App\SenderInfo;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    
    public function create_bank()
    {
        $company = SenderInfo::where('status','=',1)->get();
        return view('bank.create_bank',compact('company'));
    }
    
    public function add_bank_details(Request $request)
    {
        $this->validate($request,[
            'sender_id' => 'required',
            'account_number' => 'required',
            'account_title' => 'required',
            'bank_name' => 'required',
            'branch' => 'required'
        ]);
        
        $bank = Bank::create([
            'sender_id' => $request->sender_id,
            'account_number' => $request->account_number,
            'account_title' => $request->account_title,
            'bank_name' => $request->bank_name,
            'branch' => $request->branch,
            'status' => 1
        ]);
        
        if($bank)
        {
            return redirect('/create_bank')->with('success_msg', 'Bank Created Successfully');   
        }
        else
        {
            return redirect('/create_bank')->with('error_msg', 'Unable to create Bank. Please Try Again..!');   
        }
    }
    
    public function get_all_bank_details()
    {
        $bank_details = Bank::with(['sender_details'])->where('status','=',1)->get();
        
        return view('bank.get_all_bank_details',compact('bank_details'));
    }
    
    public function edit_bank_details($id)
    {
        $company = SenderInfo::where('status','=',1)->get();
        $bank_detail = Bank::where('id','=',$id)->where('status','=',1)->first();
        
        return view('bank.edit_bank_details',compact('bank_detail','company'));
    }
    
    public function update_bank_details(Request $request)
    {
        $bank = Bank::where('status','=',1)->where('id','=',$request->id)->first();
        $bank->sender_id = $request->sender_id;
        $bank->account_number = $request->account_number;
        $bank->account_title = $request->account_title;
        $bank->bank_name = $request->bank_name;
        $bank->branch = $request->branch;
        $bank->status = 1;
        
        if($bank->save())
        {
            return redirect('/get_all_bank_details')->with('success_msg', 'Bank Details Updated Successfully');   
        }
        else
        {
            return redirect('/get_all_bank_details')->with('error_msg', 'Unable to update Bank details. Please Try Again..!');   
        }
    }
    
    public function delete_bank_details($id)
    {
        $bank = Bank::where('status','=',1)->where('id','=',$id)->first();
        $bank->status = 0;
        
        if($bank->save())
        {
            return redirect('/get_all_bank_details')->with('success_msg', 'Bank Deleted Successfully');   
        }
        else
        {
            return redirect('/get_all_bank_details')->with('error_msg', 'Unable to delete Bank. Please Try Again..!');   
        }
    }
}

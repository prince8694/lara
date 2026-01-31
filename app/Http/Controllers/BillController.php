<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
class BillController extends Controller
{
    public function addbill(Request $request){
        $request->validate([
            'house_no'=>'required|exists:homes,id',
            'user_id'=>'required|exists:users,id',
            'bill'=>'required',
            'amount'=>'required|numeric',
            'bill_month'=>'required'
        ]);
        // Logic to save the bill details to the database
        // Assuming you have a Bill model
        $bill = new Bill();
        $bill->home_id = $request->house_no;
        $bill->bill_type = $request->bill;
        $bill->amount = $request->amount;
        $bill->month = $request->bill_month;
        $bill->generated_by = $request->user_id;
        $bill->save();

        if($bill){
            return back()->with('success', 'Bill added successfully...');
        }else{
            return back()->with('error', 'Failed to add bill...');
        }
    }

    public function dltbill($id){
        $bill=Bill::find($id);
        if($bill){
            $bill->delete();
            return back()->with('success', 'Bill revoked successfully...');
        }else{
            return back()->with('error', 'Bill not found...');
        }
    }
    public function showbill(){
        $userId = auth()->user()->id;
        $bills = Bill::where('generated_by', $userId)->orderBy('created_at', 'desc')->get();
        return view('show_bills', compact('bills'));
    }
}
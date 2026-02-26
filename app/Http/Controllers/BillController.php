<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Requests\BillRequest;
use App\Services\BillService;

class BillController extends Controller
{
    public function addbill(BillRequest $request){
        $request=$request->validated();
        // Logic to save the bill details to the database
        // Assuming you have a Bill model
        $billService = new BillService();
        $billService->addBill($request);

        if($billService){
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

    public function showmybill($id){
        $bills = Bill::where('home_id', $id)->orderBy('created_at', 'desc')->get();
        return view('showmybills', compact('bills'));
    }

    public function paybill($id){
        $bill = Bill::find($id);
        if($bill){
            $bill->status = 'paid';
            $bill->save();
            return back()->with('success', 'Bill paid successfully...');
        }
    }


    public function fetchbill(Request $request){
        $request->validate([
            'filter'=>'required'
        ]);
        $filter = $request->input('filter');
        return view('fetch_bill', compact('filter'));
    }
}
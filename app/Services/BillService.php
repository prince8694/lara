<?php

namespace App\Services;

use App\Models\Bill;

class BillService
{
 public function addBill($request){
        $bill = new Bill();
        $bill->home_id = $request['house_no'];
        $bill->bill_type = $request['bill'];
        $bill->amount = $request['amount'];
        $bill->month = $request['bill_month'];
        $bill->generated_by = $request['user_id'];
        $bill->save();
 }

}
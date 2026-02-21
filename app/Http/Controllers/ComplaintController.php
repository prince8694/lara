<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
class ComplaintController extends Controller
{
    public function complaintform(){
        return view('complaint');
    }

    public function complaintstore(Request $request){
        $request->validate([
            'category' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        $complaint =new Complaint();
        $complaint-> category = $request->category;
        $complaint-> description = $request->description;
        $complaint-> user_id = $request->user_id;
        $complaint->save();
        return back()->with('success', 'Complaint registered successfully.');
    }

    public function complaintDone($id){
        $complaint = Complaint::find($id);
        if ($complaint) {
            $complaint->status = 'resolved';
            $complaint->save();
            return back()->with('success', 'Complaint marked as resolved.');
        } else {
            return back()->with('error', 'Complaint not found.');
        }
    }
}

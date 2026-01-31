<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
class EventController extends Controller
{
    public function eventfun(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'nullable',
            'date'=>'required|date',
            'time'=>'required',
            'location'=>'nullable',
            'host_id'=>'required|exists:users,id'
        ]);
        // Logic to save the event details to the database
        // Assuming you have an Event model
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->host_id = $request->host_id;
        $event->save();

        if($event){
            return back()->with('success', 'Event created successfully...');
        }else{
            return back()->with('error', 'Failed to create event...');
        }
    }
}

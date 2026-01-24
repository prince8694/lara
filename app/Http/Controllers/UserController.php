<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Home;

class UserController extends Controller
{
    public function loginpage(){
        if(auth()->check()){
            return redirect()->route('admin.dash');
        }
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function saveuser(Request $request){
        $data = $request->validate([
            'name' =>'required',
            'email'=>'required|email|unique:users,email',
            'house_no'=>'nullable',
            'password'=> 'required',
            'user_type'=>'nullable',
            'role'=>'nullable',
            'committee'=>'nullable'
        ]);
        $user=User::create($data);
        if($request['user_type']=='owner'){
            Home::where('house_no',$request->house_no)->update(['owner_id'=>$user->id,'house_status'=>'1']);
        }
        if($user){
        return back()->with('success', 'Registered');
        }else{
            return back()->with('error', 'errors');
        }
    } 

    public function login(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password' => 'required'
        ]);
        if(auth()->attempt(['email'=>$request->email,'password'=> $request->password])){
            
                $committee=User::where('committee','=','1')->get();
                return redirect()->route('admin.dash')->with('success', 'Welcome to the Admin Panel');
            }
            return back()->with('error', 'incorrect credentials');

    }
// admin page display function
    public function admin(){
        
        $holders=User::where('user_type','=','owner')->get();
        $committee = User::where('committee','=','1')->get();
        $homes = Home::all();
        $vacantHomes= Home::where('house_status','0')->get();
        $occupiedHomes =Home::where('house_status','1')->get();
        return view('admin_dashboard', compact('committee', 'homes','vacantHomes','occupiedHomes','holders'));
    }
    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('home')->with('success','User logged out...');
    }
// committe page 
    public function editholder(){
        $holder=User::where('user_type','=','owner')->get();
        return view('editholder',compact('holder'));
    }
}


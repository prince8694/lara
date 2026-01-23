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
            'email'=>'required',
            'house_no'=>'nullable',
            'password'=> 'required',
            'user_type'=>'nullable',
            'role'=>'nullable',
            'committee'=>'nullable'
        ]);
        User::create($data);
        return back()->with('success', 'Registered');
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
        $committee = User::where('committee','=','1')->get();
        $homes = Home::all();
        return view('admin_dashboard', compact('committee', 'homes'));
    }
    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('home')->with('success','User logged out...');
    }
// committe page 
    public function showcommitte(){
        $committee=User::where('committee','=','1')->get();
        return view('committe',compact('committee','homes'));
    }
}


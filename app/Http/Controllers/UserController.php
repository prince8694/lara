<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function loginpage(){
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
                $committe=User::where('committee','=','1')->get();
                return redirect()->route('admin.dash')->with('success', 'Welcome to the Admin Panel');
            }
            return back()->with('error', 'incorrect credentials');

    }

    public function admin(){
        return view('admin_dashboard');
    }
    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('home')->with('success','User logged out...');
    }

    public function showcommitte(){
        $committe=User::where('committee','=','1')->get();
        return view('admin_dashboard',compact('committe'));
    }
}


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
        if($request['user_type']=='member'){
            $user=User::where('house_no',$request->house_no)->count();
            if($user==0){
                return back()->with('error', 'Property doesnot have an owner...');
            }
        }
        $user=User::create($data);
        if($request['user_type']=='owner'){
            Home::where('house_no',$request->house_no)->update(['owner_id'=>$user->id,'house_status'=>'1']);
        }
        if($user){
        return back()->with('success', 'Registered Successfully...');
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
        
        $holders=User::whereIn('user_type',['owner','member'])->orderBy('house_no', 'asc')->get();
        $committee = User::where('committee','=','1')->get();
        $homes = Home::orderBy('house_no', 'asc')->get();;
        $vacantHomes= Home::where('house_status','0')->get();
        $occupiedHomes =Home::where('house_status','1')->get();
        return view('admin_dashboard', compact('committee', 'homes','vacantHomes','occupiedHomes','holders'));
    }
    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('home')->with('success','User logged out...');
    }
// edit page
    public function editholder($id){
        $holder=User::find($id);
        return view('editholder',compact('holder'));
    }
// update holder
    public function updateholder(Request $request){
        $validated = $request->validate([
            'id'=>'required|exists:users,id',
            'name' =>'required',
            'email'=>'required|email|unique:users,email'
        ]);
        User::where('id',$validated['id'])->update([
            'name'=>$validated['name'],
            'email'=>$validated['email']
        ]);
        return redirect()->route('admin.dash')->with('success','Updated successfully...');
    }

    public function dltholder($id){
        Home::where('owner_id',$id)->update(['owner_id'=>null,'house_status'=>'0']);
        $user = User::find($id);
        if($user){
            $user->delete();
            return back()->with('success', 'User deleted successfully.');
        }else{
            return back()->with('error', 'Cant delete...');
        }
    }
    
}


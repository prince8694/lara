<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Home;
use App\Models\Complaint;
use App\Models\Event;
use App\Models\Bill;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use App\Mail\UserCreatedMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller{


    public function loginpage(){
        if(auth()->check()){
            return redirect()->route('admin.dash');
        }
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function saveuser(StoreUserRequest $request){
        $data = $request->validated();
        if($request['user_type']=='member'){
            $user=User::where('house_no',$request->house_no)->count();
            if($user==0){
                return back()->with('error', 'Property doesnot have an owner...');
            }else{
                $data['user_type']='member';
                $data['house_no']=$request->house_no;
            }
        }
        $user=User::create($data);
        Mail::to($user->email)->send(new UserCreatedMail($user));
        if($request['user_type']=='owner'){
            Home::where('house_no',$request->house_no)->update(['owner_id'=>$user->id,'house_status'=>'1']);
        }
        if($user){
        return back()->with('success', 'Registered Successfully...');
        }else{
            return back()->with('error', 'errors');
        }
    } 

    public function login(LoginRequest $request){
        $request->validated();
        if(auth()->attempt(['email'=>$request->email,'password'=> $request->password])){
            if(auth()->user()->user_type == 'committee'){
                return redirect()->route('admin.dash')->with('success', 'Welcome to the Admin Panel');
            }else if(auth()->user()->user_type == 'owner' || auth()->user()->user_type == 'member'){
                $house_no = auth()->user()->house_no;
                return redirect()->route('userhome',$house_no)->with('success', 'Welcome to the Admin Panel');
            }
        }
            return back()->with('error', 'incorrect credentials');

    }
// admin page display function
    public function admin(){
        if(!auth()->check()){
    return redirect()->route('loginform');
    }
    if(auth()->user()->user_type != 'committee'){
        return redirect()->route('userhome', auth()->user()->house_no)->with('error', 'Unauthorized access');
    }
        $bills = Bill::orderBy('created_at', 'desc')->get();
        $holders=User::whereIn('user_type',['owner','member'])->orderBy('house_no', 'asc')->paginate(10); //users where user type is owner or member order by house no
        $staffs=User::where('user_type','=','Staff')->get();
        $committee = User::where('committee','=','1')->get();
        $homes = Home::orderBy('house_no', 'asc')->get();;
        $vacantHomes= Home::where('house_status','0')->get();
        $occupiedHomes =Home::where('house_status','1')->get();
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        return view('admin_dashboard', compact('committee', 'homes','vacantHomes','occupiedHomes','holders','staffs', 'bills', 'complaints'));
    }
    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('index')->with('success','User logged out...');
    }

    public function home($house_no){
        $members=User::whereIn('user_type',['owner','member'])->where('house_no',$house_no)->get();
        $events=Event::all();
        return view('home', compact('members', 'events'));
    }

        public function adminhome(){
        return view('home');
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
            'email'=>'nullable'
        ]);
        User::where('id',$validated['id'])->update([
            'name'=>$validated['name'],
            'email'=>$validated['email']
        ]); //insert into users set () where id= $validated['id']
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
    public function changeowner($homeid){
        $home=Home::find($homeid);
        $home_no=$home->house_no;
        $members=User::where('house_no',$home_no)->get();
        return view('change_owner', compact('members', 'home_no'));
    }

    public function updateowner(Request $request){
        $validated = $request->validate([
            'owner_id'=>'required',
        ]);
        $home_no = $request->input('home_no');
        Home::where('house_no', $home_no)->update([
            'owner_id'=>$validated['owner_id']
        ]);
        User::find($validated['owner_id'])->update([
            'user_type'=>'owner'
        ]);
        User::where('house_no', $home_no)->where('id', '!=', $validated['owner_id'])->update([
            'user_type'=>'member'
        ]);
        return redirect()->route('admin.dash')->with('success','Owner updated successfully...');

    }

    public function addMember(){
        return view('addmember');
    }
    
}


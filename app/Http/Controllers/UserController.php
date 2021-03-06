<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        //get all user and related compnay that not been deleted and present them to view
        switch(Auth::user()->type){
            case 'Super':
                $users = User::join('companies','companies.id','users.company_id')->where('users.id','!=',Auth::user()->id)->select('users.*','companies.name')->get();
                break;
            case 'Admin':
                $users = User::join('companies','companies.id','users.company_id')->where('users.company_id',Auth::user()->company_id)->where('users.id','!=',Auth::user()->id)->select('users.*','companies.name')->get();
                break;
            default:
                dd('error');
                break;
        }
        $companies = company::get();
        return view('users', compact('users','companies'));
    }
    public function store(Request $req){
        $validated = Validator::make($req->all(), [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'username' => 'required|unique:users',
            'email' => 'required|max:100',
            'company_id' => 'required',
        ]);
        if ($validated->fails()) {
            return redirect()->back()
            ->withErrors($validated)
            ->withInput();
        }
        $user = new User();
        $user->firstname = $req->post('firstname');
        $user->lastname = $req->post('lastname');
        $user->username = $req->post('username');
        $user->email = $req->post('email');
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->type = 'User';
        $user->company_id = $req->post('company_id');
        $user->save();

        $log = new Log();
        $log->model = 'User';
        $log->action = 'Added new USer  ID:'.$user->id;
        $log->completed_by = Auth::user()->id;
        $log->save();
        return redirect()->back()->with('success','Action Successful');
    }
    public function update(Request $req){
        $validated = Validator::make($req->all(), [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'username' => 'required|unique:users',
            'email' => 'required|max:100',
            'company_id' => 'required',
        ]);
        if ($validated->fails()) {
            return redirect()->back()
            ->withErrors($validated)
            ->withInput();
        }
        $user = User::find($req->post('id'));
        $user->firstname = $req->post('firstname');
        $user->lastname = $req->post('lastname');
        $user->username = $req->post('username');
        $user->email = $req->post('email');
        $user->company_id = $req->post('company_id');
        $user->save();

        $log = new Log();
        $log->model = 'User';
        $log->action = 'Updated User  ID:'.$user->id;
        $log->completed_by = Auth::user()->id;
        $log->save();
        return redirect()->back()->with('success','Action Successful');
    }
    public function delete(Request $req){
        $user = User::find($req->post('del_user_id'));
        $user->delete();
        $log = new Log();
        $log->model = 'User';
        $log->action = 'Deleted User  ID:'.$req->post('del_user_id');
        $log->completed_by = Auth::user()->id;
        $log->save();
        return redirect()->back()->with('success','Action Successful');
    }
    public function updateProfile(Request $req){
        $validated = Validator::make($req->all(), [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'username' => 'required|unique:users',
            'email' => 'required|max:100',
            'password' => 'required|min:8',
        ]);
        if ($validated->fails()) {
            return redirect()->back()
            ->withErrors($validated)
            ->withInput();
        }
        $user = User::find(Auth::user()->id);
        $user->firstname = $req->post('firstname');
        $user->lastname = $req->post('lastname');
        $user->username = $req->post('username');
        $user->email = $req->post('email');
        $user->password = Hash::make($req->post('password'));
        $user->save();
        $log = new Log();
        $log->model = 'User';
        $log->action = 'Updated User Profile ID:'.$user->id;
        $log->completed_by = Auth::user()->id;
        $log->save();
        return redirect()->back()->with('success','Action Successful');
    }
}

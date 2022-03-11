<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index(){
        //get all companies that not been deleted and present them to view
        switch(Auth::user()->type){
            case 'Super':
                $users = User::join('companies','companies.id','users.company_id')->select('users.*','companies.name')->get();
                break;
            case 'Admin':
                $users = User::join('companies','companies.id','users.company_id')->where('users.company_id',Auth::user()->company_id)->select('users.*','companies.name')->get();
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

        return redirect()->back()->with('success','Action Successful');
    }
    public function update(Request $req){
        // dd($req->all());
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

        return redirect()->back()->with('success','Action Successful');
    }
    public function delete(Request $req){
        dd($req->all());
    }
}

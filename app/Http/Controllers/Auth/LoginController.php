<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Artisan;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \Artisan::call('migrate');
        $this->middleware('guest')->except('logout');
    }
    public function setup(){
        $firstUser = User::first();
        if($firstUser == null){
            return view('setup');
        }else{
            return view('auth.register');
        }


    }
    public function RegisterSuperAdmin(Request $req){
        $validated = $req->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|max:16',
        ]);

        if(!$validated){
            dd('failed');
        }else{
            $user = new User();
            $user->firstname = $req->post('firstname');
            $user->lastname = $req->post('lastname');
            $user->username = $req->post('username');
            $user->email = $req->post('email');
            $user->type = 'Super';
            $user->company_id = '0';
            $user->password = Hash::make($req->post('password'));
            $user->save();
            // $data = company::newFactory();
            // dd($data);
            \Artisan::call('db:seed');

            return view('auth.login')->with('message','Set up Successful');
        }
    }
    // protected function redirectTo()
    // {
    //     switch(Auth::user()->type){
    //         case 'Super':
    //             return '/path';
    //             break;
    //         case 'Admin':
    //             break;
    //         case 'User':
    //             break;
    //         default:
    //             break;
    //     }

    // }

}

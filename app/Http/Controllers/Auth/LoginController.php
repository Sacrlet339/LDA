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
use Validator;
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
            return view('welcome');
        }


    }
    public function RegisterSuperAdmin(Request $req){
        $validated = Validator::make($req->all(),[
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|max:16',
        ]);

        if ($validated->fails()) {

            return redirect()->back()

            ->withErrors($validated)

            ->withInput();


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

            //seed database
            \Artisan::call('db:seed');

            return view('auth.login')->with('success','System Set up Successful');
        }
    }


}

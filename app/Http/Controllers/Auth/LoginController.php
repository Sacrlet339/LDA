<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Artisan;
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
        $this->middleware('guest')->except('logout');
    }
    public function setup(){
        // \Artisan::call('make:migration add_type_to_users_table --table=users');
        \Artisan::call('migrate');
        // dd('cache clear successfully');
        // $data = User::get();
        // dd($data);
        return view('setup');
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
            $user->username = $req->post('username');
            $user->email = $req->post('email');
            $user->type = 'Super Admin';
            $user->password = Hash::make($req->post('password'));
            $user->save();
            dd('users saved.');




            return view('auth.login')->with('message','Set up Successful');
        }
    }
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
// dd($credentials['email']);
        $user = User::where('users.email','Ezra')->orWhere('users.username','Ezra')->first();
       $authenticate =  Hash::check($credentials['password'], $user->password);
        // dd($authenticate);
        if($authenticate){
            Auth::login($user);
            // dd(Auth::user());
            $request->session()->regenerate();

            return view('home')->with('name',Auth::user->username);
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.here',
            ]);
        }
        // if (Auth::attempt($credentials)) {

        // }


    }
}

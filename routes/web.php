<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'setup'])->name('step up');
// Route::post('/signin', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('sign in');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/RegisterSuperAdmin',[App\Http\Controllers\Auth\LoginController::class, 'RegisterSuperAdmin'])->name('Register super admin');
Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('view companies');
Route::post('/postCompany', [App\Http\Controllers\CompanyController::class, 'store'])->name('post company');
Route::post('/updateCompany', [App\Http\Controllers\CompanyController::class, 'update'])->name('update company');
Route::post('/deleteCompany', [App\Http\Controllers\CompanyController::class, 'delete'])->name('delete company');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('view users');
Route::post('/postUser', [App\Http\Controllers\UserController::class, 'store'])->name('post user');
Route::post('/updateUser', [App\Http\Controllers\UserController::class, 'update'])->name('update user');
Route::post('/deleteUser', [App\Http\Controllers\UserController::class, 'delete'])->name('delete user');
Route::get('/profile', function () { return view('profile'); })->name('profile');
Route::post('/profile',  [App\Http\Controllers\UserController::class, 'updateProfile'])->name('update profile');
Route::get('/logs', [App\Http\Controllers\LogController::class, 'index'])->name('logs');


Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://third-party-app.com/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://passport-app.test/oauth/authorize?'.$query);
});

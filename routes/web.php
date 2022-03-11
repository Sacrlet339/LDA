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
Route::get('/viewCompany', [App\Http\Controllers\CompanyController::class, 'edit'])->name('view company');
Route::post('/updateCompany', [App\Http\Controllers\CompanyController::class, 'update'])->name('update company');


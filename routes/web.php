<?php

use App\Http\Controllers\Backend\StudentAuthController;
use App\Http\Controllers\Backend\StudentDashbordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

//Start student backend login
Route::get('login/admin', [StudentAuthController::class, 'studentLoginForm'])->name('studentLogin');
Route::post('student-login', [StudentAuthController::class, 'studentLogins']);
//End student backend login

//Start Route group for auth
Route::group(['middleware'=>'student'], function(){
    Route::get('admin/dashbord', [StudentDashbordController::class, 'studentDashbord'])->name('studentDashbord');
    Route::get('admin/logout', [StudentAuthController::class, 'studentLogout'])->name('studentLogout');
});
//End Route group for auth

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

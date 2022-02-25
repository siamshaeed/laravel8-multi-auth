<?php

use App\Http\Controllers\Backend\StudentAuthController;
use App\Http\Controllers\Backend\StudentDashbordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Laravel Default Auth this route
Route::get('/', function () {
    return view('welcome');
});

//This is student group route
Route::prefix('student')->group(function(){

    //Start Student Login, registration, logout useing multi-auth-gaurd
    Route::get('login/admin', [StudentAuthController::class, 'studentLoginForm'])->name('studentLogin');
    Route::post('student-login', [StudentAuthController::class, 'studentLogins']);

    Route::group(['middleware'=>'student'], function(){
        Route::get('admin/dashbord', [StudentDashbordController::class, 'studentDashbord'])->name('studentDashbord');
        Route::get('admin/logout', [StudentAuthController::class, 'studentLogout'])->name('studentLogout');
    });
    //End Student Login, registration, logout useing multi-auth-gaurd

});

Route::prefix('teacher')->group(function(){

    //Start Teacher Login, registration, logout useing multi-auth-gaurd

    //End Teacher Login, registration, logout useing multi-auth-gaurd

});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

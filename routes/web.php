<?php

use App\Http\Controllers\Backend\StudentAuthController;
use App\Http\Controllers\Backend\StudentDashbordController;
use App\Http\Controllers\TeacherAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Laravel Default Auth this route
Route::get('/', function () {
    return view('welcome');
});

//This is student group route
Route::prefix('student')->group(function () {

    //Start Student Login, registration, logout useing multi-auth-gaurd

    // Registration
    Route::get('registration', [StudentAuthController::class, 'getRegistration'])->name('student.registration');
    Route::post('registration', [StudentAuthController::class, 'postRegistration'])->name('student.post.registration');

    // Login
    Route::get('login', [StudentAuthController::class, 'getLogin'])->name('student.login');
    Route::post('login', [StudentAuthController::class, 'postLogin']);

    // Student Middleware
    Route::group(['middleware' => 'student'], function () {
        Route::get('admin/dashbord', [StudentDashbordController::class, 'studentDashbord'])->name('studentDashbord');
        Route::get('admin/logout', [StudentAuthController::class, 'studentLogout'])->name('studentLogout');
    });

    //End Student Login, registration, logout useing multi-auth-gaurd

});

Route::prefix('teacher')->group(function () {

    //Start Teacher Login, registration, logout useing multi-auth-gaurd

    // Registration
    Route::get('registration', [TeacherAuthController::class, 'getRegistration'])->name('teacher.registration');
    Route::post('registration', [TeacherAuthController::class, 'postRegistration'])->name('teacher.post.registration');


    // Login
    Route::get('login', [TeacherAuthController::class, 'getLogin'])->name('teacher.login');
    Route::post('login', [TeacherAuthController::class, 'postLogin']);

    // Teacher Middleware
    Route::group(['middleware' => 'teacher'], function () {
        Route::get('dashbord', [TeacherAuthController::class, 'teacherDashbord'])->name('teacherDashbord');
        Route::get('logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');
    });

    //End Teacher Login, registration, logout useing multi-auth-gaurd

});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

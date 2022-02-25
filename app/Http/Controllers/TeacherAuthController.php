<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAuthController extends Controller
{

    public function getLogin()
    {
        return view('teacherBackend.login.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'phone'     => 'required',
            'password'  => 'required',
        ]);

        // teacher phone and password match
        if (Auth::guard('teacher')->attempt([
            'phone'         =>  $request->phone,
            'password'      =>  $request->password,
        ])) {
            return redirect('teacher/dashbord');
        } else {
            session()->flash('message', 'Invalid Email or Password');
            return redirect()->back();
        }
    }

    public function teacherDashbord()
    {
        return view('teacherBackend.dashbord.dashbord');
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login');
    }
}

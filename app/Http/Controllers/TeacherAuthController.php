<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherAuthController extends Controller
{
    public function getRegistration()
    {
        return view('teacherBackend.registration.registration');
    }

    public function postRegistration(Request $request)
    {
        $rule = [
            'name'  => 'required',
            'phone'  => 'required',
            'password'  => 'required',
        ];

        $this->validate($request, $rule);

        $teacher = new  \App\Models\Teacher();
        $teacher->name      = $request->name;
        $teacher->phone     = $request->phone;
        $teacher->password  = bcrypt($request->password);
        $teacher->save();

        session()->flash('message', 'Registration Done');
        return redirect()->route('teacher.login');
    }

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

    public function getChengePassword()
    {
        return view('teacherBackend.password.login');
    }

    // Teacher password chenge
    public function updateChengePassword(Request $request)
    {

        $request->validate([
            'old_password'      =>  'required|min:6|max:20',
            'new_password'      =>  'required|min:6|max:20',
            'confirm_password'  =>  'required|same:new_password'
        ]);

        $current_user = auth()->guard('teacher')->user();

        if (Hash::check($request->old_password, $current_user->password)) {
            $current_user->update([
                'password'  => bcrypt($request->new_password)
            ]);
            session()->flash('message', 'Password successfully update');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old password does not matched');
            return redirect()->route('teacher.login');
        }
    }
}

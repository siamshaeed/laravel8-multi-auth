<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class StudentAuthController extends Controller
{
    public function getRegistration()
    {
        return view('studentBackend.registration.registration');
    }

    public function postRegistration(Request $request)
    {
        $rule = [
            'name'  => 'required',
            'email'  => 'required',
            'password'  => 'required',
        ];

        $this->validate($request, $rule);

        $student = new  Student();
        $student->name      = $request->name;
        $student->email     = $request->email;
        $student->password  = bcrypt($request->password);
        $student->save();

        session()->flash('message', 'Registration Done');
        return redirect()->route('student.login');
    }

    public function getLogin()
    {
        return view('studentBackend.adminStudent.admin_login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('student/admin/dashbord');
        } else {
            session()->flash('message', 'Invalid Email or Password');
            return redirect()->back();
        }
    }

    public function studentLogout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }
}

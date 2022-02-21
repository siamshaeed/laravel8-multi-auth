<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class StudentAuthController extends Controller
{
    public function studentLoginForm(){
        return view('studentBackend.adminStudent.admin_login');
    }

    public function studentLogins(Request $request){
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if(Auth::guard('student')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('admin/dashbord');
        }else{
            session()->flash('message', 'Invalid Email or Password');
            return redirect()->back();
        }
    }
}

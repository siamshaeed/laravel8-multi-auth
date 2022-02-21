<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    public function studentLogin(){
        return view('studentBackend.adminStudent.admin_login');
    }
}

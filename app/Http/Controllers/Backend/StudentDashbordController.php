<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentDashbordController extends Controller
{
    public function studentDashbord(){
        return view('studentBackend.dashbord.student_dashbord');
    }
}

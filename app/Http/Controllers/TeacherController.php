<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:teacher','verifiedTeacher']);

    }

    public function index(){
        // if(Auth::guard('teacher')->check()){

            return view('teacher.teacher');
        // }
        
        // return redirect()->route('teacher.login');
    }
}

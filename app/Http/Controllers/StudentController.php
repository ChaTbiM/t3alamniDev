<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:student', 'verifiedStudent']);
    }

    public function index()
    {
        // if(Auth::guard('student')->check()){

        return view('student.student');
        // }

        // return redirect()->route('student.login');
    }
}

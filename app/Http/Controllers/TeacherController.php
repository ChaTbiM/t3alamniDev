<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

use App\Teacher;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:teacher','verifiedTeacher']);

    }

    public function index(){
        // if(Auth::guard('teacher')->check()){
        //    dd(Auth::user()->hasRole('full-time'));
    
            return view('teacher.teacher');
        // }
        
        // return redirect()->route('teacher.login');
    }
}

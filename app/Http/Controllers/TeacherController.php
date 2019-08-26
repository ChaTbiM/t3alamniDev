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
            
            

            $fixedSessions = json_encode(auth::user()->fixedSessions);
            $simpleSessions = json_encode(auth::user()->simpleSessions);
            $groups = auth::user()->groups;

            // dd($groups[0]->module->name);
            $modules = [];

            
            foreach($groups as $group){
                array_push($modules, array("module"=> $group->module->name, "groupId"=>$group->id ));
            }   

            $modules = json_encode($modules);

           
            
            return view('teacher.teacher' , [
                'fixedSessions' => $fixedSessions,
                'simpleSessions' => $simpleSessions,
                'modules' => $modules,
            ]);


        // }
        
        // return redirect()->route('teacher.login');
    }
    
}

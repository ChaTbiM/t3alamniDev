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
        $this->middleware(['auth:teacher', 'verifiedTeacher']);
    }

    public function index()
    {
        // if(Auth::guard('teacher')->check()){
        //    dd(Auth::user()->hasRole('full-time'));

        // if (auth::user()->fixedSessions) {
        //     dd(sizeof(auth::user()->fixedSessions));
        // } else {
        //     dd('he dont have');
        // }

        $fixedSessions = json_encode(auth::user()->fixedSessions);
        $simpleSessions = json_encode(auth::user()->simpleSessions);
        $groups = auth::user()->groups;
        $modules = [];
        $id = json_encode(Auth::id());
        foreach ($groups as $group) {
            array_push($modules, array(
                "module" => $group->module->name,
                "groupId" => $group->id
            ));
        }

        $modules = json_encode($modules);

        return view('teacher.teacher', [
            'id' => $id,
            'fixedSessions' => $fixedSessions,
            'simpleSessions' => $simpleSessions,
            'modules' => $modules
        ]);

        // }

        // return redirect()->route('teacher.login');
    }

    public function addFixed(Request $request)
    {
        // if ($request->time) {
        return response()->json([$request->all()]);
        // }

        // return response()->json('didnt work');
    }

    //test upload
    // public function testIndex(Request $request)
    // {
    //     return view('teacher.test');
    // }

    // public function testUpload(Request $request)
    // {
    //     dd($request->file('filew'));
    // }
}

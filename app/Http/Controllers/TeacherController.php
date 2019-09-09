<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

use App\Teacher;
use App\Document;
use App\FixedSession;
use App\SimpleSession;

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
        // dd(auth::user()->toArray()['fixed_sessions']);
        $groups = auth::user()->groups;
        $modules = [];

        $test = json_encode([]);

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
            'modules' => $modules,
            'test' => $test
        ]);

        // }

        // return redirect()->route('teacher.login');
    }

    public function addFixed(Request $request)
    {
        // FixedSession::create([$request->all()]);

        FixedSession::create([
            // 'type' => 'fixed',
            //worked
            'state' => $request->state,
            'time' => $request->time,
            'date' => $request->date,
            'duration' => $request->duration,
            'group_id' => $request->group_id,
            'teacher_id' => $request->teacher_id
        ]);

        // $model = new Document();

        $file = $request->file('file');
        // $ext = $file->getClientOriginalExtension();
        // $type = $file->getType($ext);
        $path = $request->file('file')->store('/public');

        $id = (int) $request->id;
        if ($path) {
            return Document::create([
                // 'type' => 'fixed',
                //worked
                'title' => $request->fileName,
                'url' => $path,
                'fixed_session_id' => $id,
                'simple_session_id' => null
            ]);
        } else {
            return 'success withou file';
        }
    }

    public function addSimple(Request $request)
    {
        SimpleSession::create([
            'state' => $request->state,
            'subject' => $request->subject,
            'cycle' => $request->cycle,
            'specialty' => $request->specialty,
            'year' => $request->year,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'duration' => $request->duration,
            'nb_places' => $request->nb_places,
            'price' => $request->price,
            'mark' => null,
            'end_registration' => null,
            'teacher_id' => $request->teacher_id,
            ''
        ]);

        $file = $request->file('file');
        // $ext = $file->getClientOriginalExtension();
        // $type = $file->getType($ext);
        $path = $request->file('file')->store('/public');

        $id = (int) $request->id;
        if ($path) {
            return Document::create([
                // 'type' => 'fixed',
                //worked
                'title' => $request->fileName,
                'url' => $path,
                'fixed_session_id' => $id,
                'simple_session_id' => null
            ]);
        } else {
            return 'success withou file';
        }
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

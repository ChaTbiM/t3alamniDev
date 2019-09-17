<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

use App\Teacher;
use App\Student;
use App\Document;
use App\FixedSession;
use App\SimpleSession;
use App\joinGroup;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

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
        return view('teacher.teacher');
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

        $id = (int) $request->id;
        if ($request->has('file')) {
            $path = $request->file('file')->store('/public');
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

    public function getFixed(Request $request)
    {
        $fixedSessions = json_encode(auth::user()->fixedSessions);
        // dd(auth::user()->toArray()['fixed_sessions']);
        $groups = Auth::user()->groups;
        $modules = [];
        foreach ($groups as $group) {
            array_push($modules, array(
                "module" => $group->module->name,
                "groupId" => $group->id,
                "groupName" => $group->name_of_group
            ));
        }

        $id = json_encode(auth::user()->id);

        $modules = json_encode($modules);

        $data = [
            'fixedSessions' => $fixedSessions,
            'modules' => $modules,
            'id' => $id
        ];
        return response()->json($data, 200);
    }

    public function getSimple(Request $request)
    {
        $simpleSessions = json_encode(auth::user()->simpleSessions);

        return response()->json($simpleSessions, 200);
    }

    public function getID(Request $request)
    {
    }

    public function search(Request $request)
    {
        $name = $request->search;
        $selectedGroup = $request->selectedGroup;
        $output = '';
        if ($request->ajax()) {
            $joined = joinGroup::query()
                ->where('group_id', '=', $selectedGroup)
                ->get();
            $joinedId = [];
            if (!$joined->isEmpty()) {
                foreach ($joined as $key => $element) {
                    array_push($joinedId, $element->id);
                }
            }

            $students = Student::query()
                ->whereNotIn('id', $joinedId)
                ->where(function ($query) use ($name) {
                    $query
                        ->where('first_name', 'like', '%' . $name . '%')
                        ->orWhere('last_name', 'like', '%' . $name . '%');
                })
                ->get();

            if (!$students->isEmpty()) {
                // foreach ($students as $key => $student) {
                //     $output .=
                //         '<tr class="tr" id="searched-students">' .
                //         '<td class="tdd">' .
                //         $student->first_name .
                //         '</td>' .
                //         '<td  class="tdd" >' .
                //         $student->last_name .
                //         '</td>' .
                //         '<td class="add tdd" ><i style="color:green" class="fas fa-plus">  </i></td>' .
                //         '</tr>';
                // }

                return response()->json($students, 200);
            }
        }
    }

    public function createStudent(Request $request)
    {
        if ($request->ajax()) {
            $student = Student::create([
                'name' => $request['user_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'age' => $request['age'],
                'cycle' => $request['cycle'],
                'year' => (int) $request['year'],
                'specialty' => $request['specialty']
            ]);

            joinGroup::create([
                'nb_absences' => 0,
                'is_paid' => 0,
                'is_validated' => 0,
                'time' => $request->time,
                'date' => $request->date,
                'group_id' => (int) $request->group_id,
                'student_id' => $student->id
            ]);

            return response()->json('worked', 200);
        }
    }
}

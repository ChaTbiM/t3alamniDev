<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

use App\joinGroup;
use App\Student;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:teacher', 'verifiedTeacher']);
    }

    public function getStudents(Request $request)
    {
        $groups = Auth::user()->groups;
        // if (sizeof($data)) {
        // return response()->json($groups, 200);
        $data = [];
        foreach ($groups as $group) {
            $info = joinGroup::where('group_id', $group->id)->get();
            if (!$info->isEmpty()) {
                $info->toArray();
                foreach ($info as $item) {
                    $first_name = Student::find($item['student_id'])
                        ->first_name;
                    $last_name = Student::find($item['student_id'])->last_name;
                    $item['first_name'] = $first_name;
                    $item['last_name'] = $last_name;
                }
                array_push(
                    $data,
                    $info
                    // array(
                    //     'info' => $info,
                    //     'group_id' => $group->id
                    // )
                );
            } else {
                continue;
            }
        }
        $res = [];

        return response()->json($data, 200);
        // }
    }
}

<?php

use Illuminate\Database\Seeder;
// use Carbon\Carbon
use App\JoinGroup;
class JoinGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, true, false, 1, 1]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, "07:00:00", "2019-09-02", true, false, 1, 2]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, "07:00:00", "2019-09-02", true, false, 1, 3]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, "07:00:00", "2019-09-02", true, true, 1, 4]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, "07:00:00", "2019-09-02", true, true, 1, 5]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, "07:00:00", "2019-09-02", true, true, 1, 6]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, "07:00:00", "2019-09-02", false, false, 1, 7]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [2, "07:00:00", "2019-09-02", false, false, 1, 8]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [3, "07:00:00", "2019-09-02", false, false, 1, 9]
        );

        DB::insert(
            'insert into join_groups (nb_absences,time,date,is_paid,is_validated,group_id,student_id) values (?,?,?, ?,?,?,?)',
            [0, "07:00:00", "2019-09-02", false, true, 1, 10]
        );
    }
}

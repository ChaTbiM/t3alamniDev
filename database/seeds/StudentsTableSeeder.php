<?php

use Illuminate\Database\Seeder;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Student;
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student',
                'student@student.com',
                Hash::make('student12'),
                'student',
                'studenti',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student1',
                'student1@student.com',
                Hash::make('student12'),
                'student1',
                'studenti1',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student2',
                'student2@student.com',
                Hash::make('student12'),
                'student2',
                'studenti2',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student3',
                'student3@student.com',
                Hash::make('student12'),
                'student3',
                'studenti3',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student4',
                'student4@student.com',
                Hash::make('student12'),
                'student4',
                'studenti4',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student5',
                'student5@student.com',
                Hash::make('student12'),
                'student5',
                'studenti5',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student6',
                'student6@student.com',
                Hash::make('student12'),
                'student6',
                'studenti6',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student7',
                'student7@student.com',
                Hash::make('student12'),
                'student7',
                'studenti7',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student8',
                'student8@student.com',
                Hash::make('student12'),
                'student8',
                'studenti8',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        DB::insert(
            'insert into students (name,email,password,first_name,last_name,age,cycle,year,specialty) values (?, ?,?,?,?,?,?,?,?)',
            [
                'student9',
                'student9@student.com',
                Hash::make('student12'),
                'student9',
                'studenti9',
                '16',
                'lycee',
                3,
                'nature sciences and biology'
            ]
        );

        Student::find(1)->assignRole('student');
        Student::find(2)->assignRole('student');
        Student::find(3)->assignRole('student');
        Student::find(4)->assignRole('student');
        Student::find(5)->assignRole('student');
        Student::find(6)->assignRole('student');
        Student::find(7)->assignRole('student');
        Student::find(8)->assignRole('student');
        Student::find(9)->assignRole('student');
        Student::find(10)->assignRole('student');
    }
}

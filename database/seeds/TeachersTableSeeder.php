<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::insert('insert into teachers (user_name, email,passowrd,age) values (?, ?,?,?)', ['teacher', 'teacherfull@teacher.com' , Hash::make])
        Teacher::create([
            'user_name' => 'teacher',
            'email' => 'teacherfull@teacher.com',
            'password' => Hash::make('teacher12'),
            'email_verified_at' => Carbon::now(),
            'age' => 28
        ]);

        Teacher::create([
            'user_name' => 'teacher',
            'email' => 'teacherpart@teacher.com',
            'password' => Hash::make('teacher12'),
            'email_verified_at' => Carbon::now(),

            'age' => 19
        ]);

        Teacher::find(1)->assignRole('full-time');
        Teacher::find(2)->assignRole('part-time');
    }
}

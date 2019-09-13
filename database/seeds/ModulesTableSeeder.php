<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(
            'insert into modules (name,designation,group_id,simple_session_id) values (?, ?,?,?)',
            ['math', 'math', 1, null]
        );

        DB::insert(
            'insert into modules (name,designation,group_id,simple_session_id) values (?, ?,?,?)',
            ['math', 'math', 2, null]
        );

        DB::insert(
            'insert into modules (name,designation,group_id,simple_session_id) values (?, ?,?,?)',
            ['math', 'math', 3, null]
        );

        DB::insert(
            'insert into modules (name,designation,group_id,simple_session_id) values (?, ?,?,?)',
            ['physique', 'physique', 4, null]
        );

        DB::insert(
            'insert into modules (name,designation,group_id,simple_session_id) values (?, ?,?,?)',
            ['physique', 'physique', 5, null]
        );

        DB::insert(
            'insert into modules (name,designation,group_id,simple_session_id) values (?, ?,?,?)',
            ['physique', 'physique', 6, null]
        );
    }
}

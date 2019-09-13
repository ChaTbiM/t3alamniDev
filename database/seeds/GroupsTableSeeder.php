<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(
            'insert into groups (number, monthly_price,nb_places,cycle,specialty,name_of_group,year,teacher_id) values (?, ?,?,?,?,?,?,?)',
            [
                1,
                1500,
                10,
                'lycee',
                'nature sciences and biology',
                'math 3as',
                3,
                1
            ]
        );

        DB::insert(
            'insert into groups (number, monthly_price,nb_places,cycle,specialty,name_of_group,year,teacher_id) values (?, ?,?,?,?,?,?,?)',
            [
                2,
                1500,
                10,
                'lycee',
                'nature sciences and biology',
                'math 2as',
                2,
                1
            ]
        );

        DB::insert(
            'insert into groups (number, monthly_price,nb_places,cycle,specialty,name_of_group,year,teacher_id) values (?, ?,?,?,?,?,?,?)',
            [
                3,
                1500,
                10,
                'lycee',
                'nature sciences and biology',
                'math 1as',
                1,
                1
            ]
        );

        DB::insert(
            'insert into groups (number, monthly_price,nb_places,cycle,specialty,name_of_group,year,teacher_id) values (?, ?,?,?,?,?,?,?)',
            [
                4,
                1500,
                10,
                'lycee',
                'nature sciences and biology',
                'phsyique 3as',
                3,
                1
            ]
        );

        DB::insert(
            'insert into groups (number, monthly_price,nb_places,cycle,specialty,name_of_group,year,teacher_id) values (?, ?,?,?,?,?,?,?)',
            [
                5,
                1500,
                10,
                'lycee',
                'nature sciences and biology',
                'phsyique 2as',
                2,
                1
            ]
        );

        DB::insert(
            'insert into groups (number, monthly_price,nb_places,cycle,specialty,name_of_group,year,teacher_id) values (?,?, ?,?,?,?,?,?)',
            [
                6,
                1500,
                10,
                'lycee',
                'nature sciences and biology',
                'phsyique 1as',
                1,
                1
            ]
        );
    }
}

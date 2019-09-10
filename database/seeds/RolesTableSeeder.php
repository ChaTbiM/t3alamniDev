<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[
            \Spatie\Permission\PermissionRegistrar::class
        ]->forgetCachedPermissions();

        //Teachers Roles
        $role = Role::create([
            'guard_name' => 'teacher',
            'name' => 'full-time'
        ]);
        $role = Role::create([
            'guard_name' => 'teacher',
            'name' => 'part-time'
        ]);
        //Students Roles
        $role = Role::create(['guard_name' => 'student', 'name' => 'student']);
        $role = Role::create(['guard_name' => 'student', 'name' => 'parent']);
    }
}

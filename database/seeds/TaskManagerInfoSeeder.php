<?php

use Illuminate\Database\Seeder;
use App\User;
use App\TaskManager\Models\Role;
use App\TaskManager\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TaskManagerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User admin
        $useradmin = User::create([
            'name' => 'Admin',
            'email' => 'guillermo.rdz.91@gmail.com',
            'password' => Hash::make('admin1234')
        ]);
        $roleadmin = Role::create([
            'name' => 'Admin',
            'description' => 'Admin User',
            'isAdmin' => true
        ]);

        $useradmin->roles()->sync([$roleadmin->id]);

        /*
        $permissionAll = [];

        $permission = Permission::create([
            'name' => 'List user',
            'slug' => 'user.list',
            'desription' => 'List all users'
        ]);

        $permissionAll[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Show user',
            'slug' => 'user.show',
            'desription' => 'Show user'
        ]);

        $permissionAll[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Edit user',
            'slug' => 'user.edit',
            'desription' => 'Edit user'
        ]);

        $permissionAll[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Destroy user',
            'slug' => 'user.destroy',
            'desription' => 'Destroy user'
        ]);

        $permissionAll[] = $permission->id;

        $roleadmin->permissions()->sync($permissionAll);*/
    }
}

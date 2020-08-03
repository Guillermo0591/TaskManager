<?php

use Illuminate\Database\Seeder;
use App\User;
use App\TaskManager\Models\Role;
use App\TaskManager\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\TaskManager\Models\Task;
use App\TaskManager\Models\TaskStatus;
use App\TaskManager\Models\Tag;
use App\TaskManager\Models\TagGroup;

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
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234')
        ]);

        $roleadmin = Role::create([
            'name' => 'Admin',
            'description' => 'Admin User',
            'isAdmin' => true
        ]);

        $useradmin->roles()->sync([$roleadmin->id]);

        // Standar User
        $standaruser = User::create([
            'name' => 'Guillermo Rodriguez',
            'email' => 'g_rodriguez@outlook.es',
            'password' => Hash::make('test1234')
        ]);

        $rolestandar = Role::create([
            'name' => 'Standard',
            'description' => 'Standard User',
            'isAdmin' => false
        ]);

        $standaruser->roles()->sync([$rolestandar->id]);

        $permission_standard = [];

        $permission = Permission::create([
            'name' => 'List task',
            'slug' => 'task.index',
            'description' => 'List all task'
        ]);

        $permission_standard[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Show task',
            'slug' => 'task.show',
            'description' => 'Show task'
        ]);

        $permission_standard[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Edit task',
            'slug' => 'task.edit',
            'description' => 'Edit task'
        ]);

        $permission_standard[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Destroy task',
            'slug' => 'task.destroy',
            'description' => 'Destroy task'
        ]);

        $permission_standard[] = $permission->id;

        $rolestandar->permissions()->sync($permission_standard);

        //Status
        $tagstatus1 = TaskStatus::create([
            'name' => 'New',
            'description' => ''
        ]);

        $tagstatus2 = TaskStatus::create([
            'name' => 'In Progress',
            'description' => ''
        ]);

        $tagstatus3 = TaskStatus::create([
            'name' => 'Review',
            'description' => ''
        ]);

        $tagstatus4 = TaskStatus::create([
            'name' => 'Done',
            'description' => ''
        ]);

        //Tag groups
        $taggroup1 = TagGroup::create([
            'name' => 'Type',
            'description' => 'Type of the tag'
            ]
        );

        $taggroup2 = TagGroup::create([
                'name' => 'Source',
                'description' => 'Source where the tag was discovered'
            ]
        );

        $taggroup3 = TagGroup::create([
                'name' => 'Location',
                'description' => 'Tag place'
            ]
        );

        // Tags
        $tag1 = Tag::create([
            'name' => 'Fix',
            'description' => '',
            'tag_group_id' => 1,
        ]);

        $tag2 = Tag::create([
            'name' => 'Improvement',
            'description' => '',
            'tag_group_id' => 1,
        ]);

        $tag3 = Tag::create([
            'name' => 'New',
            'description' => '',
            'tag_group_id' => 1,
        ]);

        $tag4 = Tag::create([
            'name' => 'Reported',
            'description' => '',
            'tag_group_id' => 2,
        ]);

        $tag5 = Tag::create([
            'name' => 'Discovered',
            'description' => '',
            'tag_group_id' => 2,
        ]);

        $tag6 = Tag::create([
            'name' => 'Internal',
            'description' => '',
            'tag_group_id' => 3,
        ]);

        $tag7 = Tag::create([
            'name' => 'External',
            'description' => '',
            'tag_group_id' => 3,
        ]);

    }
}

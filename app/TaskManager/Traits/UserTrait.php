<?php


namespace App\TaskManager\Traits;


trait UserTrait
{
    public function roles()
    {
        return $this->belongsToMany('App\TaskManager\Models\Role')->withTimestamps();
    }

    public function havePermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role['isAdmin'] == true) {
                return true;
            }

            foreach ($role->permissions as $perm) {
                if ($perm->slug == $permission) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getIsAdmin()
    {
        foreach ($this->roles as $role) {
            if ($role['isAdmin'] == true) {
                return true;
            }
        }
        return false;
    }
}

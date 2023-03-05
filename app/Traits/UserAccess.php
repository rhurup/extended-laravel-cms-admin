<?php

namespace App\Traits;

use App\Models\Users\UsersRoles;
use App\Models\Users\UsersRolesPermissions;
use App\Models\Users\UsersRolesPermissionsMap;
use App\Models\Users\UsersRolesMap;

/**
 * Trait UserAccess
 * This trait lifts heavy permission and role logic off from the User model.
 * It does not cover everything, but provides a set of simple methods to check a users access.
 *
 * Example usage:
 * - $granted = User::hasPermission(52);
 * - $granted = User::hasPermission(AclPermissions::find(52));
 * - $granted = User::hasPermission('my_jobs');
 * - $isInRole = User::hasRole(10);
 * - $isInRole = User::hasRole(AclRole::find(10));
 * - $isInRole = User::hasRole('system');
 *
 * @package App\Traits
 */
trait UserAccess
{
    /**
     * Return the users role
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(UsersRoles::class, UsersRolesMap::class);

    }


    /**
     * Return the users permissions.
     * If you want a cached version, use $user->role->permissions instead.
     *
     * @return mixed
     */
    public function permissions()
    {
        return $this->hasManyThrough(UsersRolesPermissions::class, UsersRolesPermissionsMap::class);
    }


    /**
     * Check if User has a Role associated.
     *
     * @param array $rolesToCheck The roles to check.
     * @return bool
     * @throws \ReflectionException
     */
    public function hasRoleIds(array $rolesToCheck)
    {
        $hasRole = false;

        $userroles = $this->roles;
        if (!$userroles) {
            return $hasRole;
        }

        foreach ($userroles as $userrole){
            if (!in_array($userrole->id, $rolesToCheck)) {
                continue;
            }
            $hasRole = $userrole->id;
        }

        return $hasRole;
    }

    /**
     * Check if User has a Role associated.
     *
     * @param string $rolename The role to check.
     * @return bool
     * @throws \ReflectionException
     */
    public function hasRole(string $rolename)
    {
        $hasRole = false;

        $userroles = $this->roles;
        if (!$userroles) {
            return $hasRole;
        }

        $roles = UsersRoles::all();

        foreach ($roles as $role) {
            if ($role->name != $rolename) {
                continue;
            }

            foreach ($userroles as $userrole){
                if ($role->name == $userrole->name) {
                    $hasRole = true;
                    break;
                }
            }
        }

        return $hasRole;
    }


    /**
     * Check if User has a permission associated.
     *
     * @param string $permissionname The permission to check.
     * @param string $permissiongroup The permission group to check.
     * @return bool
     */
    public function hasPermission(string $permissionname, string $permissiongroup = 'system')
    {
        $hasPermission = false;

        $userroles = $this->roles;

        if (!$userroles) {
            return $hasPermission;
        }

        foreach ($userroles as $userrole){

            $permissions = $userrole->permissions ?? [];

            foreach ($permissions as $permission) {
                if ($permission->group != $permissiongroup) {
                    continue;
                }

                if ($permission->key != $permissionname) {
                    continue;
                }

                $hasPermission = true;
                break;
            }
        }

        return $hasPermission;
    }


    /**
     * Add roles to this user
     *
     * @param id|array of role ids ..$input
     */
    public function addRole(...$input)
    {
        // Flatten input, look up models and discard non-existing models
        $roles = collect($input)->flatten()->map(function ($value) {
            return UsersRoles::find((int)$value);
        })->reject(function ($value) {
            return empty($value);
        });

        $this->roles()->attach($roles->pluck('id'));

    }


    /**
     * Remove role from this user
     *
     * @param id|array of role ids ...$input
     */
    public function removeRole(...$input)
    {
        // Flatten input, look up models and discard non-existing models
        $roles = collect($input)->flatten()->map(function ($value) {
            return UsersRoles::find((int)$value);
        })->reject(function ($value) {
            return empty($value);
        });

        $this->roles()->detach($roles->pluck('id'));
    }


    /**
     * Reset this user to have only these roles
     *
     * @param id|array of role ids ...$input
     */
    public function setRoles(...$input)
    {
        // Flatten input, look up models and discard non-existing models
        $roles = collect($input)->flatten()->map(function ($value) {
            return UsersRoles::find((int)$value);
        })->reject(function ($value) {
            return empty($value);
        });

        $this->roles()->sync($roles->pluck('id'));

    }
}

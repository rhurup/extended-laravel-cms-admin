<?php

namespace App\Models\Users;

use App\Models\BaseModel;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;

class UsersRoles extends BaseModel
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    public $hidden = [
        'created_at',
        'updated_at',
    ];


    /**
     * Get the permissions this role has
     *
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(UsersRolesPermissions::class, UsersRolesPermissionsMap::class, 'role_id', 'permission_id');
    }


    /**
     * Get the users having this role
     *
     * @return hasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(Users::class,UsersRolesMap::class);
    }
    /**
     * Add permissions to this role
     *
     * @param id|array of permission ids ..$input
     */
    public function addPermission(...$input)
    {
        // Flatten input, look up models and discard non-existing models
        $permissions = collect($input)->flatten()->map(function ($value) {
            return UsersRolesPermissions::find((int)$value);
        })->reject(function ($value) {
            return empty($value);
        });

        try {
            $this->permissions()->attach($permissions->pluck('id'));
        } catch (Exception $e) {
            // If one of the elements exists in advance, we could get a Duplicate entry exception. Lets not use that
        }
    }


    /**
     * Remove permissions from this role
     *
     * @param id|array of permission ids ...$input
     */
    public function removePermission(...$input)
    {
        // Flatten input, look up models and discard non-existing models
        $permissions = collect($input)->flatten()->map(function ($value) {
            return UsersRolesPermissions::find((int)$value);
        })->reject(function ($value) {
            return empty($value);
        });

        $this->permissions()->detach($permissions->pluck('id'));
    }


    /**
     * Reset this role to have only these permissions
     *
     * @param id|array of permission ids ...$input
     */
    public function setPermissions(...$input)
    {
        // Flatten input, look up models and discard non-existing models
        $permissions = collect($input)->flatten()->map(function ($value) {
            return UsersRolesPermissions::find((int)$value);
        })->reject(function ($value) {
            return empty($value);
        });

        $this->permissions()->sync($permissions->pluck('id'));
    }
}

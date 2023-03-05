<?php

namespace App\Models\Users;

use App\Models\BaseModel;

class UsersRolesPermissionsMap extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'users_roles_permissions_map';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission_id',
        'role_id',
    ];


    /**
     * Get the permission this map belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo(UsersRolesPermissions::class);
    }


    /**
     * Get the role this map belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(UsersRolesMap::class);
    }
}

<?php

namespace App\Models\Users;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UsersRolesPermissions extends BaseModel
{

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'users_roles_permissions';

    /**
     * @var array
     */
    protected $fillable = [
        'group',
        'key',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    public $hidden = [
        'pivot',
        'created_at',
        'updated_at',
    ];


    /**
     * Get the roles this permission exists in
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(UsersRolesMap::class, UsersRolesPermissionsMap::class, 'permission_id', 'role_id');
    }
}

<?php

namespace App\Models\Users;

use App\Models\BaseModel;

class UsersRolesMap extends BaseModel
{

    protected $fillable = [
        'user_id',
        'role_id',
    ];
    /**
     * Get the user this map belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Users::class);
    }


    /**
     * Get the role this map belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(UsersRoles::class);
    }

}

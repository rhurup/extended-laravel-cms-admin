<?php

namespace App\Models\Users;

use App\Models\BaseModel;

class UsersResetPassword extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'users_reset_password';

    protected $primaryKey = 'email';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime|now'
    ];


    /**
     * Get the user this map belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Users::class, 'email', 'email');
    }

}

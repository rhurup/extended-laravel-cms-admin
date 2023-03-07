<?php

namespace App\Models\Users;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersProfile extends BaseModel
{
    protected $fillable = [
        'users_id',
        'address',
        'address_2',
        'zip',
        'city',
        'country_id',
        'phone',
        'birthday',
    ];
    /**
     * Get the user this map belongs to
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Users::class);
    }

}

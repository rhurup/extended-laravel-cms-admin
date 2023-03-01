<?php

namespace App\Models\Content;

use App\Services\ContentService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentModules extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'content_modules';

    /**
     * The attributes that aren't mass assignable.
     * Note: Empty array means nothing is guarded and all attributes are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function getPagesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setPagesAttribute($value)
    {
        $this->attributes['pages'] = implode(',', $value);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function(ContentModules $model)
        {
            if ($model->created_at === null)
            {
                $model->created_at = Carbon::now();
            }
            if ($model->updated_at === null)
            {
                $model->updated_at = Carbon::now();
            }
        });

        static::saving(function(ContentModules $model)
        {
            $model->updated_at = Carbon::now();
        });
    }

    public static function byContentId($id){
        return static::query()
            ->whereRaw("find_in_set('$id',pages)")
            ->orWhere("pages", "LIKE", "%*%");
    }
}

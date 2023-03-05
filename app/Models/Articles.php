<?php

namespace App\Models;

use App\Services\ContentService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
    use HasFactory, SoftDeletes;

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


    public static function boot()
    {
        parent::boot();

        static::creating(function(Articles $model)
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

        static::saving(function(Articles $model)
        {
            if($model->status === null){
                $model->status = ContentService::LOCKED_STATUS;
            }
            $model->updated_at = Carbon::now();
        });
    }


    public static function findBySlug($slug){
        return static::query()->where("slug", $slug)->first();
    }

}

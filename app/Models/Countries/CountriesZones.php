<?php

namespace App\Models\Countries;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesZones extends BaseModel
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'countries_zones';

    protected $fillable = [
        'country_id',
        'zone_name'
    ];

    public function countries()
    {
        return $this->belongsTo(Countries::class, "country_id", "id");
    }

}

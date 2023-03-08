<?php

namespace App\Models\Countries;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesZonesTimezones extends BaseModel
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'countries_zones_timezone';

}

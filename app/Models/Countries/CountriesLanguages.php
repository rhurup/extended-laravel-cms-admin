<?php

namespace App\Models\Countries;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesLanguages extends BaseModel
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'countries_languages';

    protected $fillable = [
        'country_id',
        'lang',
        'langType'
    ];

    public function countries()
    {
        return $this->belongsTo(Countries::class, "country_id", "id");
    }
}

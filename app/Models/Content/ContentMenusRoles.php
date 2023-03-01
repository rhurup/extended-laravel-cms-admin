<?php

namespace App\Models\Content;

use App\Services\ContentService;
use Carbon\Carbon;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentMenusRoles extends Model
{
    use HasFactory;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'content_menus_roles';


}

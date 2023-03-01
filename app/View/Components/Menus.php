<?php

namespace App\View\Components;

use App\Models\Content\ContentArticles;
use App\Models\Content\ContentMenus;
use App\Models\Content\ContentModules;
use App\Services\ContentService;
use Closure;
use Encore\Admin\Facades\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Menus extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        public string $position
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menu = new ContentMenus();

        return view('layout.menu', ['menu' => $menu->menu() ?? []]);
    }
}

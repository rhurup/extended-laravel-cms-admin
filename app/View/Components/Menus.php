<?php

namespace App\View\Components;

use App\Models\Content\Menu;
use Closure;
use Illuminate\Contracts\View\View;
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
        $menu = new Menu();

        return view('layout.menu', ['menu' => $menu->menu() ?? []]);
    }
}

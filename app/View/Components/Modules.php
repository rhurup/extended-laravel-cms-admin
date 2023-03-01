<?php

namespace App\View\Components;

use App\Models\Content\ContentArticles;
use App\Models\Content\ContentModules;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Modules extends Component
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
        $request_path = Request::path();
        if(in_array($request_path, ['', '/'])){
            $request_path = 'home';
        }
        $content = ContentArticles::where("slug", $request_path)->first();

        if(!$content){
            $content = ContentArticles::where("slug", "404")->first();
        }

        $modules = ContentModules::byContentId($content->id)->where("position", $this->position)->get();

        return view('layout.modules', ['modules' => $modules ?? []]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Menu;
use App\Services\ContentService;
use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request, $slug){
        $article = Articles::findBySlug($slug);
        $menu = Menu::where('uri', $request->path)->first();

        if(!$article){
            $article = Articles::findBySlug('404');
            return response()->view('content.content', ['menu' => $menu, "content" => $article], 404);
        }

        if(ContentService::checkPermissions($article, $menu)){
            $article = Articles::findBySlug('403');
            return response()->view('content.content', ['menu' => $menu, "content" => $article], 403);
        }

        return view("content.content", ['menu' => $menu, "content" => $article]);
    }

    public function home(Request $request){

        $menu = Admin::menu();

        $content = Articles::findBySlug("home");

        if(!$content){
            $content = Articles::findBySlug('404');
            return response()->view('content.content', ['menu' => $menu, "content" => $content], 404);
        }

        return view("content.content", ['menu' => $menu, "content" => $content]);
    }
}

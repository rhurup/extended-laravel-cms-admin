<?php

namespace App\Http\Controllers\Content;

use App\Models\Content\Articles;
use App\Models\Content\Menu;
use App\Services\ContentService;
use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request, $slug){

        echo "<pre>";
        var_dump($request->path());
        echo "</pre>";
        exit;


        $menu = Admin::menu();
        $article = Articles::findBySlug($slug);
        $menu = Menu::findByUrl($request->path);

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

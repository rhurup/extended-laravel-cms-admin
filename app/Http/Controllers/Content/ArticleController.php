<?php

namespace App\Http\Controllers\Content;

use App\Models\Content\ContentArticles;
use App\Models\Content\ContentMenus;
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
        $article = ContentArticles::findBySlug($slug);
        $menu = ContentMenus::findByUrl($request->path);

        if(!$article){
            $article = ContentArticles::findBySlug('404');
            return response()->view('content.content', ['menu' => $menu, "content" => $article], 404);
        }

        if(ContentService::checkPermissions($article, $menu)){
            $article = ContentArticles::findBySlug('403');
            return response()->view('content.content', ['menu' => $menu, "content" => $article], 403);
        }

        return view("content.content", ['menu' => $menu, "content" => $article]);
    }

    public function home(Request $request){

        $menu = Admin::menu();

        $content = ContentArticles::findBySlug("home");

        if(!$content){
            $content = ContentArticles::findBySlug('404');
            return response()->view('content.content', ['menu' => $menu, "content" => $content], 404);
        }

        return view("content.content", ['menu' => $menu, "content" => $content]);
    }
}

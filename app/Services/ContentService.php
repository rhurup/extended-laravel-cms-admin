<?php

namespace App\Services;

use App\Models\Content\Articles;
use App\Models\Content\Menu;
use Illuminate\Support\Facades\Auth;

class ContentService
{

    const ACTIVE_STATUS = 1;
    const LOCKED_STATUS = 2;
    const DEFAULT_COLS = 12;

    public static function getLockedStatus(){
        return self::LOCKED_STATUS;
    }

    public static function getPages(){

        $pages = Articles::get()->toArray();
        $pages[] = ['id' => '*', 'title' => 'All'];
        $pages = collect($pages)->reverse()->mapWithKeys(function (array $item, int $key) {
            return [$item['id'] => $item['title']];
        })->all();



        return $pages;
    }

    public static function getStatuses(){

        return [
            -1 => __('content.status_trashed'),
            0 => __('content.status_inactive'),
            1 => __('content.status_active'),
            2 => __('content.status_locked'),
        ];
    }

    public static function getPositions(){

        return [
            'top' => __('Top'),
            'bottom' => __('Bottom'),
            'footer' => __('Footer')
        ];
    }

    public static function getModulesLayouts(){

        return [
            'raw' => __('Raw'),
            'card' => __('Card')
        ];
    }

    public static function getBootstrapGrid(){
        return [
            2 => __('content.2_cols'),
            3 => __('content.3_cols'),
            4 => __('content.4_cols'),
            6 => __('content.6_cols'),
            8 => __('content.8_cols'),
            10 => __('content.10_cols'),
            12 => __('content.12_cols'),
        ];
    }

    public static function checkPermissions($article, $menu){

        if(!$article || $menu){
            return false;
        }

        $role = false;
        if(Auth::user() == null){
            $role = '*';
        }


//
//        if(Auth::user() != null){
//            if(Auth::user()->($article->roles)){
//                $content = Articles::findBySlug('403');
//                return response()->view('content.content', ['menu' => $menu, "content" => $content], 403);
//            }
//        }


    }

}

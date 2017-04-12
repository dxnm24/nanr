<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //slider
        if(Cache::has('viewsliders')) {
            $viewsliders = Cache::get('viewsliders');
        } else {
            $viewsliders = DB::table('sliders')
                ->select('id', 'name', 'url', 'image')
                ->where('status', ACTIVE)
                ->where('type', SLIDER2)
                ->limit(PAGINATE_SLIDER)
                ->orderByRaw(DB::raw("position = '0', position"))
                ->orderBy('id', 'desc')
                ->get();
            Cache::forever('viewsliders', $viewsliders);
        }
        view()->share('sliders', $viewsliders);
        //middle
        if(Cache::has('viewmiddlearchives')) {
            $viewmiddlearchives = Cache::get('viewmiddlearchives');
        } else {
            $viewmiddlearchives = DB::table('sliders')
                ->select('id', 'name', 'url', 'image')
                ->where('status', ACTIVE)
                ->where('type', SLIDER3)
                ->limit(PAGINATE_MIDDLE)
                ->orderByRaw(DB::raw("position = '0', position"))
                ->orderBy('id', 'desc')
                ->get();
            Cache::forever('viewmiddlearchives', $viewmiddlearchives);
        }
        view()->share('middlearchives', $viewmiddlearchives);
        //post data
        if(Cache::has('viewlatesarchives')) {
            $viewlatesarchives = Cache::get('viewlatesarchives');
        } else {
            $viewlatesarchives = self::getArchives();
            Cache::forever('viewlatesarchives', $viewlatesarchives);
        }
        view()->share('latesarchives', $viewlatesarchives);
        if(Cache::has('viewpopulararchives')) {
            $viewpopulararchives = Cache::get('viewpopulararchives');
        } else {
            $viewpopulararchives = self::getArchives('view','desc');
            Cache::forever('viewpopulararchives', $viewpopulararchives);
        }
        view()->share('populararchives', $viewpopulararchives);
        //get config data
        if(Cache::has('configsite')) {
            $config = Cache::get('configsite');
        } else {
            $config = DB::table('configs')->first();
            Cache::forever('configsite', $config);
        }
        view()->share('configcode', $config->code);
        view()->share('configfbappid', $config->facebook_app_id);
        view()->share('configcredit', $config->credit);
        //all menu
        //current url
        $currentUrl = url()->current();
        if(Cache::has('menutype1'.$currentUrl)) {
            $menutype1 = Cache::get('menutype1'.$currentUrl);
        } else {
            $menutype1 = self::getMenu();
            Cache::forever('menutype1'.$currentUrl, $menutype1);
        }
        view()->share('topmenu', $menutype1);
        if(Cache::has('menutype2'.$currentUrl)) {
            $menutype2 = Cache::get('menutype2'.$currentUrl);
        } else {
            $menutype2 = self::getMenu(MENUTYPE2);
            Cache::forever('menutype2'.$currentUrl, $menutype2);
        }
        view()->share('sidemenu', $menutype2);
        // self::getMenus(MENUTYPE2, 'sidemenu');
        // self::getMenus(MENUTYPE3, 'bottommenu');
        self::getMenus(MENUTYPE4, 'mobilemenu');
    }

    private function getArchives($orderColumn = 'start_date', $orderSort = 'desc', $limit = PAGINATE_SIDE)
    {
        $data = DB::table('posts')
            ->select('id', 'name', 'slug', 'summary', 'image')
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->limit($limit)
            ->orderBy($orderColumn, $orderSort)
            ->get();
        return $data;
    }

    private function getMenus($type, $name)
    {
        $cacheName = 'menu_'.$type.'_'.$name;
        if(Cache::has($cacheName)) {
            $menu = Cache::get($cacheName);
        } else {
            $menu = DB::table('menus')
                ->where('type', $type)
                ->where('status', ACTIVE)
                ->orderByRaw(DB::raw("position = '0', position"))
                ->orderBy('name')
                ->get();
            Cache::forever($cacheName, $menu);
        }
        view()->share($name, $menu);
    }

    private function getMenu($type=MENUTYPE1)
    {
        $data = DB::table('menus')
            ->select('id', 'name', 'url', 'parent_id', 'level', 'position')
            ->where('type', $type)
            ->where('status', ACTIVE)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name')
            ->get();
        if($type==MENUTYPE1) {
            $output = '<ul class="menu">';
        } elseif($type==MENUTYPE2) {
            $output = '<ul class="sidemenu">';
        } else {
            $output = '<ul>';
        }
        $output .= self::_visit($data, $type);
        $output .= '</ul>';
        return $output;
    }
    private function _visit($data, $type=MENUTYPE1, $parentId=0)
    {
        $output = '';
        $sub = self::_sub($data, $parentId);
        if(count($sub) > 0) {
            foreach($sub as $value) {
                $hasChild = self::_hasChild($value->id);
                $classHasChild = ($hasChild)?' class="hasChild"':'';
                $output .= '<li '.checkCurrent(url($value->url)).$classHasChild.'><a href="'.url($value->url).'">'.$value->name.'</a>';
                if($hasChild) {
                    if($type==MENUTYPE1) {
                        $output .= '<ul class="submenu">';
                    } else {
                        $output .= '<ul>';
                    }
                    $output .= self::_visit($data, $type, $value->id);
                    $output .= '</ul></li>';    
                } else {
                    $output .= '</li>';
                }
            }
        }
        return $output;
    }
    private function _sub($data, $parentId)
    {
        $sub = array();
        if(isset($data)) {
            foreach($data as $key => $value) {
                if ($value->parent_id == $parentId) {$sub[$key] = $value;}
            }
        }
        return $sub;
    }
    private function _hasChild($id)
    {
        $data = DB::table('menus')
            ->where('parent_id', $id)
            ->where('status', ACTIVE)
            ->first();
        if($data) {
            return true;
        } else {
            return null;
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

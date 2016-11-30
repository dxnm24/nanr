<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'url', 'parent_id', 'level', 'type', 'icon', 'image', 'position', 'status', 'lang',
    ];
    public static function getListMenu($currentId=null)
    {
    	$menus = self::where('status', ACTIVE);
    	if($currentId == null) {
    		$menus = $menus->lists('name', 'id')->toArray();
    	} else {
    		$menus = $menus->where('id', '!=' , $currentId)->lists('name', 'id')->toArray();
    	}
    	return array_merge(['0'=>'Không'], $menus);
    }
}

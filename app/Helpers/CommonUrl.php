<?php 
namespace App\Helpers;

class CommonUrl
{
	static function getUrl($slug, $withDomain = null)
    {
        if($withDomain != null) {
            return '/'.$slug;    
        }
        return url($slug);
    }
    static function getUrl2($slug1, $slug2, $withDomain = null)
    {
    	if($withDomain != null) {
    	   return '/'.$slug1.'/'.$slug2;	
    	}
        return url($slug1.'/'.$slug2);
    }
    static function getUrlPostTag($slug, $withDomain = null)
    {
    	if($withDomain != null) {
    	   return '/tag/'.$slug;	
    	}
        return url('tag/'.$slug);
    }
    
}
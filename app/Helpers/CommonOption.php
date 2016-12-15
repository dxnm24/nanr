<?php 
namespace App\Helpers;

class CommonOption
{
	//status
    static function statusArray()
    {
        return array(ACTIVE=>'Kích hoạt', INACTIVE=>'Không kích hoạt');
    }
    static function getStatus($status=ACTIVE)
    {
    	$array = self::statusArray();
        if($status == ACTIVE) {
            return '<span style="color: green;">'.$array[$status].'</span>';
        } else {
            return '<span style="color: red;">'.$array[$status].'</span>';
        }
    }
    //language
    static function langArray()
    {
        return array(VI=>'Tiếng việt'); //, VI=>'Tiếng việt', EN=>'Tiếng anh'
    }
    static function getLang($lang=VI)
    {
    	$array = self::langArray();
        return $array[$lang];
    }
    //menu
    static function menuTypeArray()
    {
        return array(
            MENUTYPE1=>'Menu đầu trang', 
            MENUTYPE2=>'Menu cột bên', 
            // MENUTYPE3=>'Menu cuối trang',
            MENUTYPE4=>'Menu mobile',
        );
    }
    static function getMenuType($menuType=ACTIVE)
    {
        $array = self::menuTypeArray();
        return $array[$menuType];
    }
    //type
    static function typePostArray()
    {
        return array(POST=>'Post');
    }
    static function getTypePost($type=POST)
    {
        $array = self::typePostArray();
        return $array[$type];
    }
    //role admin
    static function roleArray()
    {
        return array(ADMIN=>'Admin'); //, EDITOR=>'Editor'
    }
    static function getRole($roleId=ADMIN)
    {
        $array = self::roleArray();
        return $array[$roleId];
    }
    //ad position
    static function adPositionArray()
    {
        return array(
            //all site
            1 => 'Header - PC',
            2 => 'Header - Mobile',
            3 => 'Footer - PC',
            4 => 'Footer - Mobile',
            5 => 'Sidebar Top - PC',
            6 => 'Sidebar Top- Mobile',
            7 => 'Sidebar Bottom - PC',
            8 => 'Sidebar Bottom - Mobile',
            9 => 'Phía trên bài viết - PC',
            10 => 'Phía trên bài viết - Mobile',
            11 => 'Phía dưới bài viết - PC',
            12 => 'Phía dưới bài viết - Mobile',
            
        );
    }
    static function getAdPosition($adPosition)
    {
        $array = self::adPositionArray();
        return $array[$adPosition];
    }
    //sort by Post type
    static function postSortByArray()
    {
        return array(
            'start_date' => 'Mặc định (Ngày đăng giảm dần)',
            'view' => 'Lượt view giảm dần',

        );
    }
    static function getPostSortBy($sortBy)
    {
        $array = self::postSortByArray();
        return $array[$sortBy];
    }
    //slider
    static function sliderTypeArray()
    {
        return array(
            SLIDER1=>'Slider đầu trang', 
            SLIDER2=>'Slider cuối trang', 
            SLIDER3=>'Hot Tips', 
        );
    }
    static function getSliderType($sliderType=SLIDER1)
    {
        $array = self::sliderTypeArray();
        return $array[$sliderType];
    }
    //type display (kieu hien thi cua 1 box type tren trang chu)
    static function displayTypeArray()
    {
        return array(
            DISPLAY_TYPE_0=>'Kiểu 0 (Mặc định)', 
            DISPLAY_TYPE_1=>'Kiểu 1', 
            DISPLAY_TYPE_2=>'Kiểu 2', 
            DISPLAY_TYPE_3=>'Kiểu 3', 
            DISPLAY_TYPE_4=>'Kiểu 4', 
            DISPLAY_TYPE_5=>'Kiểu 5', 
        );
    }
    static function getDisplayType($displayType=1)
    {
        $array = self::displayTypeArray();
        return $array[$displayType];
    }
}
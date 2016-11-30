<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\CommonVideo;
use DB;

class TestController extends Controller
{
    public function index()
    {
    	// $link = 'https://photos.google.com/share/AF1QipMzuyRjE-xZJ8g6GHdDkka3RT0i4-CN84sWCJS9oenpCPA3xc70yhQ1RxHrUOAJ7Q/photo/AF1QipOK5kRr5x-zPWdjVAIwbR08p6cGAsPKfWRWyDyA?key=Smx4T0hVNVp0dTUyUWNpckFwbU1KVGx4dHdaT2p3';
    	// $link = 'https://drive.google.com/file/d/0B77yw2zOQcK_MGhYWHB3aENISlk/view?usp=sharing';
    	// $link = 'http://www.nhaccuatui.com/bai-hat/vo-nguoi-ta-phan-manh-quynh.DRfuHT6Q2LvC.html';
    	// $link = 'http://v.nhaccuatui.com/hoat-hinh/ore-monogatari.kxRUGM6dVwee.html?key=83VGzE8kC2qx9';
    	// $link = 'https://www.youtube.com/watch?v=qGRU3sRbaYw';
    	// $link = 'https://www.facebook.com/LeoMessi/videos/vb.176063032413299/1183588781660714/?type=2&theater';
    	// $result = CommonVideo::getLinkFacebookVideo($link);
    	// dd($result);
    }

}
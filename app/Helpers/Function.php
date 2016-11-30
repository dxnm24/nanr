<?php 
use Jenssegers\Agent\Agent;

function getDevice($device = null)
{
    if(isset($device)) {
        return $device;
    }
    //agent check tablet mobile desktop
    $agent = new Agent();
    if($agent->isMobile() || $agent->isTablet()) {
        return MOBILE;
    } else {
        return PC;
    }
}
function getDevice2($device = null)
{
    if(isset($device)) {
        return $device;
    }
    //agent check tablet mobile desktop
    $agent = new Agent();
    if($agent->isMobile()) {
        return MOBILE;
    } elseif($agent->isTablet()) {
        return TABLET;
    } else {
        return PC;
    }
}
function trimRequest($request)
{
    $input = $request->all();
    // use a closure here because array_walk_recursive passes
    // two params to the callback, the item + the key. If you were to just
    // call trim directly, you could end up inadvertently trimming things off
    // your array values, and pulling your hair out to figure out why.
    array_walk_recursive($input, function(&$in) {
        $in = trim($in);
    });
    $request->merge($input);
}
// show 0 for null
function getZero($number = null)
{
	if($number != '') {
		return $number;
	}
	return 0;
}
//cut trim text
function limit_text($text, $len) {
    if (strlen($text) < $len) {
        return $text;
    }
    $text_words = explode(' ', $text);
    $out = null;
    foreach ($text_words as $word) {
        if ((strlen($word) > $len) && $out == null) {

            return substr($word, 0, $len) . "...";
        }
        if ((strlen($out) + strlen($word)) > $len) {
            return $out . "...";
        }
        $out.=" " . $word;
    }
    return $out;
}
//check current menu
function checkCurrent($url, $home=null)
{
    $currentUrl = Request::url();
    if($home != null) {
        if ($currentUrl == $url) {
            return 'class=current';
        }
    } else {
        $segment1 = Request::segment(1);
        if ($currentUrl == $url && $segment1 != null) {
            return 'class=current';
        }
    }
    return;
}
//check file exist
function remoteFileExists($url) {
    $curl = curl_init($url);
    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);
    //do request
    $result = curl_exec($curl);
    $ret = false;
    //if request did not fail
    if ($result !== false) {
        //if request was ok, check response code
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200) {
            $ret = true;
        }
    }
    curl_close($curl);
    return $ret;
}
//Get image dimensions facebook og:image
function getImageDimensionsOg($image='')
{
    $currentUrl = url()->current();
    if(strpos($currentUrl, 'localhost')) {
        return;
    }
    if(!empty($image)) {
        $imageUrl = url($image);
        $checkFile = remoteFileExists($imageUrl);
        if($checkFile === false) {
            return;
        }
        list($width, $height) = getimagesize($imageUrl);
        $string = '<meta property="og:image:width" content="'.$width.'" /><meta property="og:image:height" content="'.$height.'" />';
        return $string;
    }
    return;
}
// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
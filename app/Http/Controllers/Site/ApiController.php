<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Cache;

class ApiController extends Controller
{
    // request: page (phan trang), kind (kieu sap xep du lieu: moi nhat 0 / null, xem nhieu 1)
    public function getlistpost(Request $request)
    {
        // define type
        $type = [];
        //check page
        $page = isset($request->page)?$request->page:1;
        //cache name
        $cacheName = 'apiforapp_listpost_';
        if(isset($request->type)) {
            $cacheName .= $request->type.'_';
            //get type by id
            $type = DB::table('post_types')
                ->select('id', 'name', 'slug')
                ->where('id', $request->type)
                ->where('status', ACTIVE)
                ->first();
        }
        if(isset($request->kind) && $request->kind == 1) {
            $cacheName .= 'popular_'.$page;
            $sortby = 'view';
        } else {
            $cacheName .= 'latest_'.$page;
            $sortby = 'start_date';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return response()->json(Cache::get($cacheName));
        }
        //query
        $posts = DB::table('posts')
            ->select('id', 'name', 'slug', 'image');
        if(isset($request->type)) {
            $posts = $posts->where('type_main_id', $request->type);
        }
        $posts = $posts->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->orderBy($sortby, 'desc')
            ->paginate(10);
        $data = ['type' => $type, 'posts' => $posts];
        //put cache
        Cache::forever($cacheName, $data);
        return response()->json($data);
        // $data = User::orderBy('id', 'asc')->get();
        // return response(['data' => $data], 200);
    }

    public function getpost($id)
    {
        //cache name
        if(isset($id)) {
            $cacheName = 'apiforapp_post_'.$id;
        } else {
            return null;
        }
        //get cache
        if(Cache::has($cacheName)) {
            return response()->json(Cache::get($cacheName));
        }
        //query
        $post = DB::table('posts')
            ->select('id', 'name', 'slug', 'type_main_id', 'description', 'image', 'post_material')
            ->where('id', $id)
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->first();
        if(count($post) > 0) {
            // convert image
            // $post->image = self::imageBase64Encode(url($post->image));
            // convert name
            $post->name = mb_convert_case($post->name, MB_CASE_TITLE, "UTF-8");
            // material
            if(!empty($post->post_material)) {
                $postMaterialData = explode(',', $post->post_material);
                $postMaterial = null;
                foreach($postMaterialData as $key => $value) {
                    $materialData = DB::table('posts')
                        ->select('id', 'name', 'material', 'material_image')
                        ->where('id', $value)
                        ->where('status', ACTIVE)
                        ->where('start_date', '<=', date('Y-m-d H:i:s'))
                        ->first();
                    if(count($materialData) > 0) {
                        $postMaterial[$key]['id'] = $materialData->id;
                        $postMaterial[$key]['name'] = $materialData->name;
                        $postMaterial[$key]['material'] = $materialData->material;
                        $postMaterial[$key]['material_image'] = $materialData->material_image;
                    }
                }
                if(count($postMaterial) > 0) {
                    $postMaterialHtml = '<p><strong class="block">Thành Phần Nguyên Liệu</strong></p><div class="row wrap gutter justify-center material">';
                    foreach($postMaterial as $value) {
                        $postMaterialHtml .= '
                            <div class="width-1of3"><a href="/#/post/'.$value['id'].'">
                                <img src="'.url($value['material_image']).'" alt="'.$value['name'].'" class="round-borders shadow-2" >
                                <p>'.$value['material'].'</p>
                            </a></div>
                        ';
                    }
                    $postMaterialHtml .= '</div>';
                    $post->description = $postMaterialHtml . $post->description;
                }
            }
            // get all img src to change 
            // $srcImg = self::getSrcImg($post->description);
            //get type by id
            $type = DB::table('post_types')
                ->select('id', 'name')
                ->where('id', $post->type_main_id)
                ->where('status', ACTIVE)
                ->first();
            //get link for bai truoc, bai sau
            $prevPost = DB::table('posts')
                ->select('id')
                ->where('id', '<', $post->id)
                ->where('status', ACTIVE)
                ->where('start_date', '<=', date('Y-m-d H:i:s'))
                ->orderBy('id', 'desc')
                ->take(1)->first();
            $nextPost = DB::table('posts')
                ->select('id')
                ->where('id', '>', $post->id)
                ->where('status', ACTIVE)
                ->where('start_date', '<=', date('Y-m-d H:i:s'))
                ->orderBy('id', 'asc')
                ->take(1)->first();
        } else {
            $type = null;
            $prevPost = null;
            $nextPost = null;
        }
        //get data array
        $data = ['type' => $type, 'post' => $post, 'prevPost' => $prevPost, 'nextPost' => $nextPost];
        //put cache
        Cache::forever($cacheName, $data);
        return response()->json($data);
    }

    public function getposttype()
    {
        //cache name
        $cacheName = 'apiforapp_posttype';
        //get cache
        if(Cache::has($cacheName)) {
            return response()->json(Cache::get($cacheName));
        }
        //query
        $data = DB::table('post_types')
            ->select('id', 'name')
            ->where('status', ACTIVE)
            ->get();
        //put cache
        Cache::forever($cacheName, $data);
        return response()->json($data);
    }

    private function convertAllSrcImgToBase64Encode($srcImg = array())
    {
        $srcImgBase64 = array();
        if(!empty($srcImg)) {
            foreach($srcImg as $value) {
                $srcImgBase64[] = self::imageBase64Encode($value);
            }
        }
        return $srcImgBase64;
    }

    private function imageBase64Encode($url = '')
    {
        $type = pathinfo($url, PATHINFO_EXTENSION);
        // $data = file_get_contents($url);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);

        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    private function getSrcImg($htmlContent = '')
    {
        // read all image tags into an array
        preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
        for ($i = 0; $i < count($imgTags[0]); $i++) {
          // get the source string
          preg_match('/src="([^"]+)/i',$imgTags[0][$i], $imgage);
          // remove opening 'src=' tag, can`t get the regex right
          $origImageSrc[] = str_ireplace( 'src="', '',  $imgage[0]);
        }
        // will output all your img src's within the html string
        return $origImageSrc;
    }

}

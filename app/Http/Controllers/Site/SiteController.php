<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Cache;
use App\Helpers\CommonMethod;
use Validator;
use App\Models\Contact;

class SiteController extends Controller
{
    public function index()
    {
        //cache name
        $cacheName = 'index';
        $device = getDevice();
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        $data = DB::table('post_types')
            ->select('id', 'name', 'slug', 'parent_id', 'relation_id', 'summary', 'type', 'display', 'limited', 'sort_by')
            ->where('status', ACTIVE)
            ->where('home', ACTIVE)
            ->where('display', '!=', DISPLAY_TYPE_3)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name', 'asc')
            ->get();
        if(count($data) > 0) {
            foreach($data as $key => $value) {
                // post limit item for type box in index page
                if(!empty($value->limited) && $value->limited > 0) {
                    $typeLimit = $value->limited;
                } elseif($value->display == DISPLAY_TYPE_1) {
                    $typeLimit = PAGINATE_BOX_1;
                } elseif($value->display == DISPLAY_TYPE_2) {
                    $typeLimit = PAGINATE_BOX_2;
                } elseif($value->display == DISPLAY_TYPE_3) {
                    $typeLimit = PAGINATE_BOX_3;
                } elseif($value->display == DISPLAY_TYPE_4) {
                    $typeLimit = PAGINATE_BOX_4;
                }elseif($value->display == DISPLAY_TYPE_5) {
                    $typeLimit = PAGINATE_BOX_5;
                } else {
                    $typeLimit = PAGINATE_BOX;
                }
                //chi hien thi the loai (khong co 2 tab)
                $value->posts = $this->getPostByRelationsQuery('type', $value->id, $value->sort_by)->take($typeLimit)->get();
                // neu the loai nay la con cua the loai khac (co parent_id khac 0) thi lay ra the loai cha cua no
                if($value->parent_id != 0) {
                    $parentTypeData = self::getPostTypeById($value->parent_id);
                    $value->parentType = $parentTypeData;
                } else {
                    $value->parentType = null;
                }
                // kieu 2: chia 2 cot, display:2 cot trai, display:3 cot phai. Neu la cot trai, thi tim cot phai luon
                if($value->display == DISPLAY_TYPE_2) {
                    // typeRelation: display:3 cot phai
                    $displayRelation = DB::table('post_types')
                        ->select('id', 'name', 'slug', 'parent_id', 'relation_id', 'summary', 'type', 'display', 'limited', 'sort_by')
                        ->where('status', ACTIVE)
                        ->where('home', ACTIVE)
                        ->where('display', DISPLAY_TYPE_3)
                        ->where('relation_id', $value->id)
                        ->first();
                    if($displayRelation) {
                        $value->typeRelation = $displayRelation;
                        $value->typeRelation->posts = $this->getPostByRelationsQuery('type', $displayRelation->id, $displayRelation->sort_by)->take(PAGINATE_BOX_3)->get();
                        if($value->typeRelation->parent_id != 0) {
                            $parentTypeData = self::getPostTypeById($value->typeRelation->parent_id);
                            $value->typeRelation->parentType = $parentTypeData;
                        } else {
                            $value->typeRelation->parentType = null;
                        }
                    } else {
                        $value->typeRelation = null;
                    }
                } else {
                    $value->typeRelation = null;
                }
                
            }
        }
        //seo meta
        $seo = DB::table('configs')->where('status', ACTIVE)->first();
        //homesliders
        $homesliders = DB::table('sliders')
            ->select('id', 'name', 'url', 'image')
            ->where('status', ACTIVE)
            ->where('type', SLIDER1)
            ->limit(PAGINATE_HOMESLIDER)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('id', 'desc')
            ->get();
        //put cache
        $html = view('site.index', ['data' => $data, 'seo' => $seo, 'homesliders' => $homesliders])->render();
        Cache::forever($cacheName, $html);
        //return view
        return view('site.index', ['data' => $data, 'seo' => $seo, 'homesliders' => $homesliders]);
    }
    public function tag(Request $request, $slug)
    {
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'tag_'.$slug.'_'.$page;
        $device = getDevice();
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        $tag = DB::table('post_tags')
            ->select('id', 'name', 'slug', 'summary', 'description', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'meta_image')
            ->where('slug', $slug)
            ->where('status', ACTIVE)
            ->first();
        // posts tags
        if(isset($tag)) {
            $data = $this->getPostByRelationsQuery('tag', $tag->id)->paginate(PAGINATE);
            if($data->total() > 0) {
                //auto meta tag for seo
                $tagName = mb_convert_case($tag->name, MB_CASE_TITLE, "UTF-8");
                if(empty($tag->meta_title)) {
                    if($page > 1) {
                        $tag->meta_title = $tagName.' trang '.$page.' | Nauanngonre.com';
                    } else {
                        $tag->meta_title = $tagName.' | Nauanngonre.com';
                    }
                }
                if(empty($tag->meta_keyword)) {
                    $tagNameNoLatin = CommonMethod::convert_string_vi_to_en($tagName);
                    $tag->meta_keyword = $tagNameNoLatin.','.$tagName;
                }
                if(empty($tag->meta_description)) {
                    $tag->meta_description = $tagName;
                }
                //put cache
                $html = view('site.post.tag', ['data' => $data, 'tag' => $tag])->render();
                Cache::forever($cacheName, $html);
                //return view
                return view('site.post.tag', ['data' => $data, 'tag' => $tag]);
            }
        }
        return response()->view('errors.404', [], 404);
    }
    public function page(Request $request, $slug)
    {
        self::forgetCache('lien-he');
        //
        trimRequest($request);
        $device = getDevice();
        //update count view post
        DB::table('posts')->where('slug', $slug)->increment('view');
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'page_'.$slug.'_'.$page;
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        // IF SLUG IS PAGE
        //query
        $singlePage = DB::table('pages')->where('slug', $slug)->where('status', ACTIVE)->first();
        // page
        if(isset($singlePage)) {
            $singlePage->summary = CommonMethod::replaceText($singlePage->summary);
            //put cache
            $html = view('site.page', ['data' => $singlePage])->render();
            Cache::forever($cacheName, $html);
            //return view
            return view('site.page', ['data' => $singlePage]);
        }        
        // IF SLUG IS TYPE
        //query
        $type = $this->getPostTypeBySlug($slug);
        // post type
        if(isset($type)) {
            if($type->grid == ACTIVE) {
                $paginateNumber = PAGINATE;
            } else {
                $paginateNumber = PAGINATE_GRID;
            }
            $paginate = 1;
            $data = $this->getPostByRelationsQuery('type', $type->id)->paginate($paginateNumber);
            $total = count($data);
            if($total > 0) {
                //auto meta tag for seo
                $typeName = mb_convert_case($type->name, MB_CASE_TITLE, "UTF-8");
                if(empty($type->meta_title)) {
                    if($page > 1) {
                        $type->meta_title = $typeName.' trang '.$page.' | Nauanngonre.com';
                    } else {
                        $type->meta_title = $typeName.' | Nauanngonre.com';
                    }
                }
                if(empty($type->meta_keyword)) {
                    $typeNameNoLatin = CommonMethod::convert_string_vi_to_en($typeName);
                    $type->meta_keyword = $typeNameNoLatin.','.$typeName;
                }
                if(empty($type->meta_description)) {
                    $type->meta_description = $typeName;
                }
                //put cache
                $html = view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate])->render();
                Cache::forever($cacheName, $html);
                //return view
                return view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate]);
            }
        }
        // IF SLUG IS A POST
        // post
        $post = DB::table('posts')
            ->where('posts.slug', $slug)
            ->where('posts.status', ACTIVE)
            ->where('posts.start_date', '<=', date('Y-m-d H:i:s'))
            ->first();
        if($post) {
            //list tags
            $tags = DB::table('post_tags')
                ->join('post_tag_relations', 'post_tags.id', '=', 'post_tag_relations.tag_id')
                ->select('post_tags.id', 'post_tags.name', 'post_tags.slug')
                ->where('post_tag_relations.post_id', $post->id)
                ->where('post_tags.status', ACTIVE)
                ->orderBy('post_tags.name')
                ->get();
            //list seri
            $postSeriesQuery = $this->getPostTypeQuery($post->seri, [$post->id]);
            $postSeries = $postSeriesQuery->get();
            $postSeriesIds = $postSeriesQuery->pluck('id');
            //list type
            $existPostIds = array_prepend($postSeriesIds, $post->id);
            $postTypesQuery = $this->getPostTypeQuery($post->type_main_id, $existPostIds);
            $postTypes = $postTypesQuery->get();
            $postTypesIds = $postTypesQuery->pluck('id');
            //list related
            $existPostIds2 = $existPostIds + $postTypesIds;
            $postRelatedQuery = $this->getPostTypeQuery($post->related, $existPostIds2);
            $postRelated = $postRelatedQuery->get();
            //FIRST: type, seri, related
            $typeMain = $this->getPostTypeById($post->type_main_id);
            $related = $this->getPostTypeById($post->related);
            $seri = $this->getPostTypeById($post->seri);
            //seri parent
            if($seri) {
                $seriParent = $this->getPostTypeById($seri->parent_id);
            } else {
                $seriParent = null;
            }
            //parent type of typeMain if exist
            if($typeMain->parent_id > 0) {
                $typeMainParent = $this->getPostTypeById($typeMain->parent_id);
            } else {
                $typeMainParent = null;
            }
            // material
            if(!empty($post->post_material)) {
                $postMaterialData = explode(',', $post->post_material);
                $postMaterial = null;
                foreach($postMaterialData as $key => $value) {
                    $materialData = DB::table('posts')->select('id', 'name', 'slug', 'material', 'material_image')->where('id', $value)->where('status', ACTIVE)->first();
                    if(count($materialData) > 0) {
                        $postMaterial[$key]['id'] = $materialData->id;
                        $postMaterial[$key]['name'] = $materialData->name;
                        $postMaterial[$key]['slug'] = $materialData->slug;
                        $postMaterial[$key]['material'] = $materialData->material;
                        $postMaterial[$key]['material_image'] = $materialData->material_image;
                    }
                }
            } else {
                $postMaterial = null;
            }
            //auto meta tag for seo
            $postName = mb_convert_case($post->name, MB_CASE_TITLE, "UTF-8");
            if(empty($post->meta_title)) {
                $post->meta_title = $postName.' | Nauanngonre.com';
            }
            if(empty($post->meta_keyword)) {
                $postNameNoLatin = CommonMethod::convert_string_vi_to_en($postName);
                $post->meta_keyword = $postName.','.$postNameNoLatin;
            }
            if(empty($post->meta_description)) {
                $post->meta_description = limit_text(strip_tags($post->summary), 200);
            }
            //put cache
            $html = view('site.post.show', [
                    'post' => $post, 
                    'tags' => $tags, 
                    'postTypes' => $postTypes, 
                    'postSeries' => $postSeries, 
                    'postRelated' => $postRelated, 
                    'typeMain' => $typeMain, 
                    'related' => $related, 
                    'seri' => $seri, 
                    'seriParent' => $seriParent, 
                    'typeMainParent' => $typeMainParent, 
                    'postMaterial' => $postMaterial, 
                ])->render();
            Cache::forever($cacheName, $html);
            //return view
            return view('site.post.show', [
                    'post' => $post, 
                    'tags' => $tags, 
                    'postTypes' => $postTypes, 
                    'postSeries' => $postSeries, 
                    'postRelated' => $postRelated, 
                    'typeMain' => $typeMain, 
                    'related' => $related, 
                    'seri' => $seri, 
                    'seriParent' => $seriParent, 
                    'typeMainParent' => $typeMainParent, 
                    'postMaterial' => $postMaterial, 
                ]);
        }
        return response()->view('errors.404', [], 404);
    }
    public function page2(Request $request, $slug1, $slug2)
    {
        trimRequest($request);
        $device = getDevice();
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'page_'.$slug1.'_'.$slug2.'_'.$page;
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        $type = $this->getPostTypeBySlug($slug2, 1);
        $typeParent = $this->getPostTypeBySlug($slug1);
        if(isset($type) && isset($typeParent) && ($typeParent->id == $type->parent_id)) {
            $paginate = 1;
            $data = $this->getPostByRelationsQuery('type', $type->id)->paginate(PAGINATE);
            $total = count($data);
            if($total > 0) {
                $seriParent = $this->getPostTypeById($type->parent_id);
                //auto meta tag for seo
                $typeName = mb_convert_case($type->name, MB_CASE_TITLE, "UTF-8");
                if(empty($type->meta_title)) {
                    if($page > 1) {
                        $type->meta_title = $typeName.' trang '.$page.' | Nauanngonre.com';
                    } else {
                        $type->meta_title = $typeName.' | Nauanngonre.com';
                    }
                }
                if(empty($type->meta_keyword)) {
                    $typeNameNoLatin = CommonMethod::convert_string_vi_to_en($typeName);
                    $type->meta_keyword = $typeNameNoLatin.','.$typeName;
                }
                if(empty($type->meta_description)) {
                    $type->meta_description = $typeName;
                }
                //put cache
                $html = view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate, 'seriParent' => $seriParent])->render();
                Cache::forever($cacheName, $html);
                //return view
                return view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate, 'seriParent' => $seriParent]);
            }
        }
        return response()->view('errors.404', [], 404);
    }
    public function search(Request $request)
    {
        $search = array();
        trimRequest($request);
        if($request->name == '') {
            return view('site.post.search', ['data' => null, 'request' => $request, 'search' => $search]);
        }
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'search_'.$request->name.'_'.$page;
        $device = getDevice();
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        // post
        $slug = CommonMethod::convert_string_vi_to_en($request->name);
        $slug = mb_strtolower(preg_replace('/[^a-zA-Z0-9]+/i', '-', $slug));
        $data = DB::table('posts')
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->where('slug', 'like', '%'.$slug.'%')
            ->orderBy('start_date', 'desc')
            ->paginate(PAGINATE);
        //auto meta tag for seo
        if($page > 1) {
            $search['meta_title'] = 'Tìm kiếm: '.$request->name.' trang '.$page.' | Nauanngonre.com';
        } else {
            $search['meta_title'] = 'Tìm kiếm: '.$request->name.' | Nauanngonre.com';
        }
        $search['meta_keyword'] = $request->name;
        $search['meta_description'] = $request->name;
        //put cache
        $html = view('site.post.search', ['data' => $data->appends($request->except('page')), 'request' => $request, 'search' => $search])->render();
        Cache::forever($cacheName, $html);
        //return view
        return view('site.post.search', ['data' => $data->appends($request->except('page')), 'request' => $request, 'search' => $search]);
    }
    public function sitemap()
    {
        ///cache name
        $cacheName = 'sitemap';
        //get cache
        if(Cache::has($cacheName)) {
            $content = Cache::get($cacheName);
            return response($content)->header('Content-Type', 'text/xml;charset=utf-8');
        }
        //query
        //put cache
        $html = view('site.sitemap')->render();
        Cache::forever($cacheName, $html);
        //return view
        $content = view('site.sitemap');
        return response($content)->header('Content-Type', 'text/xml;charset=utf-8');
    }
    private function getPostTypeQuery($id, $ids)
    {
        $data = DB::table('posts')
            ->join('post_type_relations', 'posts.id', '=', 'post_type_relations.post_id')
            ->select('posts.id', 'posts.name', 'posts.slug', 'posts.image', 'posts.summary', 'posts.type', 'posts.created_at')
            ->where('post_type_relations.type_id', $id)
            ->where('posts.status', ACTIVE)
            ->where('posts.start_date', '<=', date('Y-m-d H:i:s'))
            ->whereNotIn('post_type_relations.post_id', $ids)
            ->orderBy('posts.start_date', 'desc')
            ->take(PAGINATE_BOX);
        return $data;
    }
    private function getPostTypeByParentIdQuery($id)
    {
        return DB::table('post_types')
            ->select('id', 'name', 'slug', 'parent_id', 'relation_id', 'summary', 'image', 'type', 'display', 'grid')
            ->where('status', ACTIVE)
            ->where('parent_id', $id)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name', 'asc');
    }
    private function getPostTypeById($id)
    {
        return DB::table('post_types')
            ->select('id', 'name', 'slug', 'parent_id', 'relation_id', 'summary', 'image', 'type', 'display', 'grid')
            ->where('id', $id)
            ->where('status', ACTIVE)
            ->first();
    }
    private function getPostTypeBySlug($slug, $hasParentId = null)
    {
        $result = DB::table('post_types')
            ->select('id', 'name', 'slug', 'parent_id', 'relation_id', 'summary', 'description', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'meta_image', 'type', 'display', 'grid')
            ->where('slug', $slug)
            ->where('status', ACTIVE);
        if($hasParentId) {
            $result = $result->where('parent_id', '!=', 0);
        } else {
            $result = $result->where('parent_id', 0);
        }
        return $result->first();
    }
    private function getPostByTypeQuery($id, $orderColumn = 'start_date', $orderSort = 'desc')
    {
        $data = DB::table('posts')
            ->select('id', 'name', 'slug', 'image', 'summary', 'type', 'created_at')
            ->where('type_main_id', $id)
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->orderBy($orderColumn, $orderSort);
        return $data;
    }
    private function getPostByRelationsQuery($element, $id, $orderColumn = 'start_date', $orderSort = 'desc')
    {
        $data = DB::table('posts')
            ->join('post_'.$element.'_relations', 'posts.id', '=', 'post_'.$element.'_relations.post_id')
            // ->join('post_'.$element.'s', 'post_'.$element.'_relations.'.$element.'_id', '=', 'post_'.$element.'s.id')
            ->select('posts.id', 'posts.name', 'posts.slug', 'posts.image', 'posts.summary', 'posts.type', 'posts.created_at')
            ->where('post_'.$element.'_relations.'.$element.'_id', $id)
            ->where('posts.status', ACTIVE)
            ->where('posts.start_date', '<=', date('Y-m-d H:i:s'))
            ->orderBy('posts.'.$orderColumn, $orderSort);
        return $data;
    }
    /* 
    * contact
    */
    public function contact(Request $request)
    {
        self::forgetCache('lien-he');
        //
        $ip = get_client_ip();
        $now = strtotime(date('Y-m-d H:i:s'));
        $range = 60; //second
        $time = $now - $range;
        $past = date('Y-m-d H:i:s', $time);
        // check ip with time
        $checkIP = DB::table('contacts')->where('ip', $ip)->where('created_at', '>', $past)->count();
        if($checkIP > 0) {
            return redirect()->back()->with('warning', 'Hệ thống đang bận. Xin bạn hãy thử lại sau ít phút.');
        }
        //
        trimRequest($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'max:255',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'tel' => $request->tel,
                'msg' => $request->msg,
                'ip' => $ip,
            ]);
        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi thông tin liên hệ cho chúng tôi.');
    }
    // remove cache page if exist message validator
    private function forgetCache($slug) {
        //delete cache for contact page before redirect to remove message validator
        $cacheName = 'page_'.$slug.'_1';
        $cacheNameMobile = 'page_'.$slug.'_1_mobile';
        Cache::forget($cacheName);
        Cache::forget($cacheNameMobile);
    }
}

<?php 
	$device = getDevice2();
	$countPost = count($post);
	if($countPost > 0) {
		$title = ($post->meta_title!='')?$post->meta_title:$post->name;
		$h1 = $post->name;
		$isPost = true;
		$is404 = false;
		$meta_title = $post->meta_title;
		$meta_keyword = $post->meta_keyword;
		$meta_description = $post->meta_description;
		$meta_image = $post->meta_image;
	} else {
		$title = PAGENOTFOUND;
		$h1 = PAGENOTFOUND;
		$isPost = false;
		$is404 = true;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
	}
	$extendData = array(
			'isPost' => $isPost,
			'is404' => $is404,
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box">
	<div class="row column">
		<?php
			if(isset($typeMainParent)) {
				$breadcrumb = array(
					['name' => $typeMainParent->name, 'link' => url($typeMainParent->slug)],
					['name' => $typeMain->name, 'link' => url($typeMainParent->slug.'/'.$typeMain->slug)],
					['name' => $h1, 'link' => '']
				);
			} else {
				$breadcrumb = array(
					['name' => $typeMain->name, 'link' => url($typeMain->slug)],
					['name' => $h1, 'link' => '']
				);
			}
		?>
		@include('site.common.breadcrumb', $breadcrumb)
	</div>
	<div class="row column box-title post-title">
		<h1>{!! $h1 !!}</h1>
	</div>
	<div class="row column">
		<div class="postinfo">
			<div class="info">
				<div class="row">
					<div class="column description">{!! $post->description !!}</div>
					<div class="column description">
						@include('site.common.social')
					</div>
				</div>
			</div>

			@if(count($tags) > 0)
			<div class="tags">
				<!-- <div class="tags-icon"><i class="fa fa-tags" aria-hidden="true"></i> Chuyên mục</div> -->
				<ul>
					@foreach($tags as $value)
					<li><h2><a href="{{ url('tag/'.$value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2></li>
					@endforeach
				</ul>
			</div>
			@endif

			<div class="fb-comments" data-numposts="5"></div>

			@include('site.post.related', ['data' => $seri, 'postData' => $postSeries, 'dataSeri' => $seriParent])
			@include('site.post.related', ['data' => $typeMain, 'postData' => $postTypes])
			@include('site.post.related', ['data' => $related, 'postData' => $postRelated])

		</div>
	</div>
</div>
@endsection
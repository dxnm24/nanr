<?php 
	if($data->total() > 0) {
		$title = ($tag->meta_title!='')?$tag->meta_title:$tag->name;
		$h1 = $tag->name;
		$is404 = false;
		$meta_title = $tag->meta_title;
		$meta_keyword = $tag->meta_keyword;
		$meta_description = $tag->meta_description;
		$meta_image = $tag->meta_image;
	} else {
		$title = PAGENOTFOUND;
		$h1 = PAGENOTFOUND;
		$is404 = true;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
	}
	$extendData = array(
			'is404' => $is404,
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
			'pagePrev' => isset($data)?$data->previousPageUrl():null,
			'pageNext' => isset($data)?$data->nextPageUrl():null
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box">
	<div class="row column">
		<?php
			$breadcrumb = array(
				['name' => $h1, 'link' => '']
			);
		?>
		@include('site.common.breadcrumb', $breadcrumb)
	</div>
	<div class="row column box-title">
		<h1>{!! $h1 !!}</h1>
	</div>
	@if($tag->summary != '' || $tag->description != '')
	<div class="row column">
		@if($tag->summary != '')
		<p class="summary">{!! $tag->summary !!}</p>
		@endif
		@if($tag->description != '')
		<div class="description">{!! $tag->description !!}</div>
		@endif
	</div>
	@endif
	@include('site.post.boxList', array('data' => $data))
	<div class="row column">
		@include('site.common.paginate', ['paginator' => $data])
	</div>
</div>
@endsection
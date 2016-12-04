<?php 
	if(isset($isHotOrNew)) {
		$metaPrefix = $type->name.' | ';
	} else {
		$metaPrefix = '';
	}
	if($total > 0) {
		$title = ($type->meta_title!='')?$type->meta_title:$type->name;
		$h1 = $type->name;
		$is404 = false;
		$meta_title = $metaPrefix.$type->meta_title;
		$meta_keyword = $metaPrefix.$type->meta_keyword;
		$meta_description = $metaPrefix.$type->meta_description;
		$meta_image = $type->meta_image;
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
			'pagePrev' => isset($paginate)?$data->previousPageUrl():null,
			'pageNext' => isset($paginate)?$data->nextPageUrl():null
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box">
	<div class="row column">
		<?php
			if(isset($seriParent)) {
				$breadcrumb = array(
					['name' => $seriParent->name, 'link' => url($seriParent->slug)],
					['name' => $h1, 'link' => '']
				);
			} else {
				$breadcrumb = array(
					['name' => $h1, 'link' => '']
				);
			}
		?>
		@include('site.common.breadcrumb', $breadcrumb)
	</div>
	<div class="row column box-title">
		<h1>{!! $h1 !!}</h1>
	</div>
	@if($type->summary != '' || $type->description != '')
	<div class="row column">
		@if($type->summary != '')
		<p class="summary">{!! $type->summary !!}</p>
		@endif
		@if($type->description != '')
		<div class="description">{!! $type->description !!}</div>
		@endif
	</div>
	@endif
	@if($type->grid == ACTIVE)
	@include('site.post.boxList', array('data' => $data, 'type' => $type))
	@else
	@include('site.post.boxGrid', array('data' => $data, 'type' => $type))
	@endif
	@if(isset($paginate))
	<div class="row column">
		@include('site.common.paginate', ['paginator' => $data])
	</div>
	@endif
</div>
@endsection
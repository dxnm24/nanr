<?php 
	$device = getDevice2();
	$countPost = count($data);
	if($countPost > 0) {
		$title = ($data->meta_title!='')?$data->meta_title:$data->name;
		$h1 = $data->name;
		$is404 = false;
		$meta_title = $data->meta_title;
		$meta_keyword = $data->meta_keyword;
		$meta_description = $data->meta_description;
		$meta_image = $data->meta_image;
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
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box">
	<div class="row column box-title post-title">
		<h1>{!! $h1 !!}</h1>
	</div>
	<div class="row column">
		@include('site.common.errors')
		<div class="info">
			<div class="row">
				<div class="column description">{!! $data->summary !!}</div>
				<div class="column description">{!! $data->description !!}</div>
			</div>
		</div>
	</div>
</div>
@endsection
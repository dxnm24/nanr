<?php 
	$extendData = array(
			'is404' => true,
			'meta_title' => '',
			'meta_keyword' => '',
			'meta_description' => '',
			'meta_image' => '',
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', PAGENOTFOUND)

@section('content')
<div class="box">
	<div class="row column box-title">
		<h1>{{ PAGENOTFOUND }}</h1>
	</div>
	<div class="row column">
		<p>Đường dẫn không tồn tại hoặc đã bị xóa. Xin mời bạn theo dõi các nội dung khác <a href="/"><strong>tại đây</strong></a></p>
	</div>
</div>
@endsection
<?php 
	if(isset($seo)) {
		$title = ($seo->meta_title)?$seo->meta_title:'Trang chủ';
		$meta_title = $seo->meta_title;
		$meta_keyword = $seo->meta_keyword;
		$meta_description = $seo->meta_description;
		$meta_image = $seo->meta_image;
		$isHome = true;
		$is404 = false;
	} else {
		$title = PAGENOTFOUND;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
		$isHome = false;
		$is404 = true;
	}
	$extendData = array(
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
			'isHome' => $isHome,
			'is404' => $is404,
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
@if(count($data) > 0)
	@foreach($data as $key => $value)
		@if(count($value->posts) > 0)
			<?php $url = url($value->slug); ?>

			{{-- check display --}}
			{{-- type 0 --}}
			@if($value->display == 0)
			<div class="box">
				<div class="row column box-title box-title-hr">
					<h3>{!! $value->name !!}</h3>
					<a href="{{ $url }}" class="btn-seemore float-right hide-for-small-only"><span>Xem thêm</span></a>
				</div>
				<div class="box-inner">
				@include('site.post.box', array('data' => $value->posts, 'type' => $value))
				</div>
				<div class="row column show-for-small-only box-seemore">
					<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
				</div>
			</div>
			@endif
			
			{{-- type 1 --}}
			@if($value->display == 1)
			<div class="box">
				<div class="row column box-title box-title-hr">
					<h3>{!! $value->name !!}</h3>
				</div>
				<div class="box-inner">
				@include('site.post.box1', array('data' => $value->posts, 'type' => $value))
				</div>
				<div class="row column show-for-small-only box-seemore">
					<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
				</div>
			</div>
			@endif

			{{-- type 2 --}}
			@if($value->display == 2)
			<div class="box">
				<div class="row column box-title box-title-hr">
					<h3>{!! $value->name !!}</h3>
				</div>
				<div class="box-inner">
				@include('site.post.box2', array('data' => $value->posts, 'type' => $value))
				</div>
				<div class="row column show-for-small-only box-seemore">
					<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
				</div>
			</div>
			@endif

			{{-- type 3 --}}
			@if($value->display == 3)
			<div class="box">
				<div class="row column box-title box-title-hr">
					<h3>{!! $value->name !!}</h3>
				</div>
				<div class="box-inner">
				@include('site.post.box3', array('data' => $value->posts, 'type' => $value))
				</div>
				<div class="row column show-for-small-only box-seemore">
					<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
				</div>
			</div>
			@endif

			{{-- type 4 --}}
			@if($value->display == 4)
			<div class="box">
				<div class="row column box-title box-title-hr">
					<h3>{!! $value->name !!}</h3>
				</div>
				<div class="box-inner">
				@include('site.post.box4', array('data' => $value->posts, 'type' => $value))
				</div>
				<div class="row column show-for-small-only box-seemore">
					<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
				</div>
			</div>
			@endif

			<div class="clearfix"></div>

		@endif
	@endforeach
@endif
@endsection
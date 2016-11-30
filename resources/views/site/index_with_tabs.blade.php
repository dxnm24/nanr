<?php 
	if(isset($seo)) {
		$title = ($seo->meta_title)?$seo->meta_title:'Trang chủ';
		$meta_title = $seo->meta_title;
		$meta_keyword = $seo->meta_keyword;
		$meta_description = $seo->meta_description;
		$meta_image = $seo->meta_image;
	} else {
		$title = 'Trang chủ';
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
	}
	$extendData = array(
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
@if(count($data) > 0)
	@foreach($data as $key => $value)
		@if(count($value->post) > 0)
			<?php $url = url($value->slug); ?>
			@if(count($value->post2) == 0)
			<div class="box">
				<div class="row column box-title box-title-hr">
					<h3>{!! $value->name !!}</h3>
					<a href="{{ $url }}" class="btn-seemore float-right hide-for-small-only"><span>Xem thêm</span></a>
				</div>
				<div class="box-inner">
				@include('site.post.box', array('data' => $value->post, 'type' => $value))
				</div>
				<div class="row column show-for-small-only box-seemore">
					<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
				</div>
			</div>
			@else
			<?php 
				$urlBest = url($value->slug.'-hay-nhat');
				$urlLatest = url($value->slug.'-moi-nhat');
			?>
			<div class="box">
				<ul class="box-tabs clearfix" data-tabs id="box-tabs-{{ $value->id }}">
					<li class="tabs-title is-active">
						<h3><a href="#{{ $value->slug.'-hay-nhat' }}" aria-selected="true" rel="nofollow">{!! $value->name !!} hay nhất</a></h3>
					</li>
					<li class="tabs-title">
						<h3><a href="#{{ $value->slug.'-moi-nhat' }}" rel="nofollow">{!! $value->name !!} mới nhất</a></h3>
					</li>
				</ul>
				<div class="box-inner" data-tabs-content="box-tabs-{{ $value->id }}">
					<div class="tabs-panel is-active" id="{{ $value->slug.'-hay-nhat' }}">
						<a href="{{ $urlBest }}" class="btn-seemore float-right hide-for-small-only" rel="nofollow"><span>Xem thêm</span></a>
						<div class="clearfix"></div>
						@include('site.post.box', array('data' => $value->post2))
					</div>
					<div class="tabs-panel" id="{{ $value->slug.'-moi-nhat' }}">
						<a href="{{ $urlLatest }}" class="btn-seemore float-right hide-for-small-only" rel="nofollow"><span>Xem thêm</span></a>
						<div class="clearfix"></div>
						@include('site.post.box', array('data' => $value->post))
					</div>
				</div>
				<div class="row column show-for-small-only box-seemore">
					<a href="{{ $urlBest }}" class="btn-seemore" rel="nofollow">Xem {!! $value->name !!} hay nhất<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
					<a href="{{ $urlLatest }}" class="btn-seemore" rel="nofollow">Xem {!! $value->name !!} mới nhất<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
					<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
				</div>
			</div>
			@endif
		@endif
	@endforeach
@endif
@endsection
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
			<?php 
				if($value->parentType) {
					$url = url($value->parentType->slug.'/'.$value->slug);
				} else {
					$url = url($value->slug);
				}
			?>

			{{-- check display --}}
			{{-- type 0 --}}
			@if($value->display == 0)
			<div class="box box0">
				<div class="row column box-title box-title-hr display-title">
					<h3><a href="{{ $url }}" title="{!! $value->name !!}"><span class="display-title-link">{!! $value->name !!}</span><span class="display-title-rss"><i class="fa fa-rss" aria-hidden="true"></i></span></a></h3>
				</div>
				<div class="box-inner">
				@include('site.post.box', array('type' => $value))
				</div>
			</div>
			@endif
			
			{{-- type 1 --}}
			@if($value->display == 1)
			<div class="box box1">
				<div class="row column box-title box-title-hr display-title">
					<h3><a href="{{ $url }}" title="{!! $value->name !!}"><span class="display-title-link">{!! $value->name !!}</span><span class="display-title-rss"><i class="fa fa-rss" aria-hidden="true"></i></span></a></h3>
				</div>
				<div class="box-inner">
				@include('site.post.box1', array('type' => $value))
				</div>
			</div>
			@endif

			{{-- type 2 + 3:typeRelation --}}
			@if($value->display == 2)
			<div class="box">
				<div class="row">
					<div class="medium-6 columns box2">
						<div class="box-title box-title-hr display-title">
							<h3><a href="{{ $url }}" title="{!! $value->name !!}"><span class="display-title-link">{!! $value->name !!}</span><span class="display-title-rss"><i class="fa fa-rss" aria-hidden="true"></i></span></a></h3>
						</div>
						<div class="box-inner">
						@include('site.post.box2', array('type' => $value))
						</div>
					</div>
					<div class="medium-6 columns box3">
						@if($value->typeRelation)
						<?php 
							if($value->typeRelation->parentType) {
								$url2 = url($value->typeRelation->parentType->slug.'/'.$value->typeRelation->slug);
							} else {
								$url2 = url($value->typeRelation->slug);
							}
						?>
						<div class="box-title box-title-hr display-title">
							<h3><a href="{{ $url2 }}" title="{!! $value->typeRelation->name !!}"><span class="display-title-link">{!! $value->typeRelation->name !!}</span><span class="display-title-rss"><i class="fa fa-rss" aria-hidden="true"></i></span></a></h3>
						</div>
						<div class="box-inner">
						@include('site.post.box3', array('type' => $value->typeRelation))
						</div>
						@endif
					</div>
				</div>
			</div>
			@endif

			{{-- type 4 --}}
			@if($value->display == 4)
			<div class="box box4">
				<div class="row column box-title box-title-hr display-title">
					<h3><a href="{{ $url }}" title="{!! $value->name !!}"><span class="display-title-link">{!! $value->name !!}</span><span class="display-title-rss"><i class="fa fa-rss" aria-hidden="true"></i></span></a></h3>
				</div>
				<div class="box-inner">
				@include('site.post.box4', array('type' => $value))
				</div>
			</div>
			@endif

			{{-- type 5 --}}
			@if($value->display == 5)
			<div class="box box5">
				<div class="row column box-title box-title-hr display-title">
					<h3><a href="{{ $url }}" title="{!! $value->name !!}"><span class="display-title-link">{!! $value->name !!}</span><span class="display-title-rss"><i class="fa fa-rss" aria-hidden="true"></i></span></a></h3>
				</div>
				<div class="box-inner">
				@include('site.post.box5', array('type' => $value))
				</div>
			</div>
			@endif

			<div class="clearfix"></div>

		@endif
	@endforeach
@endif
@endsection
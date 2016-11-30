<?php $device = getDevice2(); ?>
@if($device != MOBILE)
<div class="side">
	<div class="search">
		<div class="row column">
			<form action="{{ route('site.search') }}" method="GET" class="search-form">
				<div class="input-group">
					<input name="name" type="text" value="" class="input-group-field" id="searchtext" placeholder="Tìm kiếm">
					<div class="input-group-button">
						<a class="button" onclick="$('.search-form').submit()"><i class="fa fa-search" aria-hidden="true"></i></a>
					</div>
				</div>
	        </form>
		</div>
	</div>
</div>
@endif
@include('site.common.ad', ['posPc' => 5, 'posMobile' => 6])

<div class="side side-tabs">
	<ul class="box-tabs clearfix" data-tabs id="box-tabs-side">
		<li class="tabs-title is-active">
			<h3><a href="#tab1" aria-selected="true" rel="nofollow">Mới nhất</a></h3>
		</li>
		<li class="tabs-title">
			<h3><a href="#tab2" rel="nofollow">Chuyên mục</a></h3>
		</li>
	</ul>
	<div class="box-inner box-tabs-inner" data-tabs-content="box-tabs-side">
		<div class="tabs-panel is-active" id="tab1">
			@if($latesarchives)
			<div class="mup">
				@foreach($latesarchives as $key => $value)
				<?php 
					// $thumbnail = str_replace('/images/', '/thumbs/', $value->image);
					// $thumbnail = str_replace('/thumb/', '/', $thumbnail);
				?>
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img src="{{ $value->image }}" alt="{!! $value->name !!}" />
					<span>{!! $value->name !!}</span>
				</a>
				<p>{!! $value->summary !!}</p>
				@endforeach
			</div>
			@endif
		</div>
		<div class="tabs-panel" id="tab2">
			{!! $sidemenu !!}
		</div>
	</div>
</div>

@include('site.common.ad', ['posPc' => 7, 'posMobile' => 8])

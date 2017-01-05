<?php $device = getDevice2(); ?>
@if($device == MOBILE)
<header>
	<div class="mobile-topbar">
		<div class="row">
			<div class="small-3 columns">
				<a class="mobile-menuopen" data-toggle="mobile-menubox" aria-controls="mobile-menubox" aria-haspopup="true" tabindex="0"><i class="fa fa-bars" aria-hidden="true"></i></a>
			</div>
			<div class="small-9 columns">
				<a href="{{ url('/') }}" class="logo"><img src="/img/logo.png" alt="Nấu Ăn Ngon Rẻ" /></a>
			</div>
		</div>
	</div>
</header>
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
<div class="full reveal mobile-menubox" id="mobile-menubox" data-reveal>
	<div class="mobile-menubox-head">
		<strong class="mobile-title mmh-left">Danh mục</strong>
		<a class="mmh-right" data-close aria-label="Close modal"><i class="fa fa-times" aria-hidden="true"></i> Đóng Menu</a>
		<div class="clearfix"></div>
	</div>
	<ul class="mobile-menu">
		@if($mobilemenu)
      		@foreach($mobilemenu as $key => $value)
				<li {{ checkCurrent(url($value->url)) }}><a href="{{ $value->url }}">{!! $value->name !!}</a></li>
			@endforeach
		@endif
		<li class="mobile-li-close"><a class="mobile-menuclose" data-close aria-label="Close modal"><i class="fa fa-times" aria-hidden="true"></i> Đóng Menu</a></li>
  	</ul>
</div>
@else
<header class="show-for-medium">
	<div class="row column">
		<a href="{{ url('/') }}" class="logo"><img src="/img/logo.png" alt="Nấu Ăn Ngon Rẻ" /></a>
		
	</div>
	<div class="row column">{!! $topmenu !!}</div>
</header>
@endif
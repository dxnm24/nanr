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
			<a href="#tab1" aria-selected="true" rel="nofollow">Mới nhất</a>
		</li>
		<li class="tabs-title">
			<a href="#tab2" rel="nofollow">Đọc nhiều</a>
		</li>
		<li class="tabs-title">
			<a href="#tab3" rel="nofollow">Chuyên mục</a>
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
				<div class="pum">
					<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
						<img src="{{ url($value->image) }}" alt="{!! $value->name !!}" />
						<h3>{!! $value->name !!}</h3>
					</a>
					<p>{!! limit_text($value->summary, 200) !!}</p>
				</div>
				@endforeach
			</div>
			@endif
		</div>
		<div class="tabs-panel" id="tab2">
			@if($populararchives)
			<div class="mup">
				@foreach($populararchives as $key => $value)
				<?php 
					// $thumbnail = str_replace('/images/', '/thumbs/', $value->image);
					// $thumbnail = str_replace('/thumb/', '/', $thumbnail);
				?>
				<div class="pum">
					<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
						<img src="{{ url($value->image) }}" alt="{!! $value->name !!}" />
						<h3>{!! $value->name !!}</h3>
					</a>
					<p>{!! limit_text($value->summary, 200) !!}</p>
				</div>
				@endforeach
			</div>
			@endif
		</div>
		<div class="tabs-panel" id="tab3">
			{!! $sidemenu !!}
		</div>
	</div>
</div>

@include('site.common.ad', ['posPc' => 7, 'posMobile' => 8])

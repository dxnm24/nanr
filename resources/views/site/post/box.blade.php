<?php 
	if(isset($data[0]->seri) && $data[0]->seri == ACTIVE) {
	// if(isset($data->seri) && $data->seri == ACTIVE) {
		$checkSeri = true;
		$seriClass = ' class=seri';
		$url0 = url($type->slug.'/'.$data[0]->slug);
	} else {
		$checkSeri = false;
		$seriClass = '';
		$url0 = url($data[0]->slug);
	}
?>
<div class="row box-large">
	<div class="medium-3 columns">
		<div class="item">
			<a href="{{ $url0 }}" title="{!! $data[0]->name !!}"{{ $seriClass }}>
				@if($checkSeri == true)
				<span><img alt="{!! $data[0]->name !!}" title="{!! $data[0]->name !!}" data-src="{{ url($data[0]->image) }}" class="lazyload"></span>
				@else
				<img alt="{!! $data[0]->name !!}" title="{!! $data[0]->name !!}" data-src="{{ url($data[0]->image) }}" class="lazyload">
				@endif
			</a>
		</div>
	</div>
	<div class="medium-9 columns">
		<h2><a href="{{ $url0 }}" title="{!! $data[0]->name !!}">{!! $data[0]->name !!}</a></h2>
		<p>{!! $data[0]->summary !!}</p>
	</div>
</div>
<div class="row small-up-2 medium-up-4 large-up-5">
	@foreach($data as $key => $value)
	<?php 
		if(isset($value->seri) && $value->seri == ACTIVE) {
		// if(isset($data->seri) && $data->seri == ACTIVE) {
			$checkSeri = true;
			$seriClass = ' class=seri';
			$url = url($type->slug.'/'.$value->slug);
		} else {
			$checkSeri = false;
			$seriClass = '';
			$url = url($value->slug);
		}
	?>
	@if($key>0)
	<div class="column">
		<div class="callout item">
			<a href="{{ $url }}" title="{!! $value->name !!}"{{ $seriClass }}>
				@if($checkSeri == true)
				<span><img alt="{!! $value->name !!}" title="{!! $value->name !!}" data-src="{{ url($value->image) }}" class="lazyload"></span>
				@else
				<img alt="{!! $value->name !!}" title="{!! $value->name !!}" data-src="{{ url($value->image) }}" class="lazyload">
				@endif
			</a>
			<h2><a href="{{ $url }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
		</div>
	</div>
	@endif
	@endforeach
</div>
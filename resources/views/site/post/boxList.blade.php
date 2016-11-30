<div class="box-large">
	@foreach($data as $key => $value)
	<?php 
		// if(isset($value->seri) && $value->seri == ACTIVE) {
		if(isset($data->seri) && $data->seri == ACTIVE) {
			$checkSeri = true;
			$seriClass = ' class=seri';
			$url = url($type->slug.'/'.$value->slug);
		} else {
			$checkSeri = false;
			$seriClass = '';
			$url = url($value->slug);
		}
	?>
	<div class="box-large-item">
		<div class="row">
			<div class="medium-3 columns">
				<div class="item">
					<a href="{{ $url }}" title="{!! $value->name !!}"{{ $seriClass }}>
						@if($checkSeri == true)
						<span><img alt="{!! $value->name !!}" title="{!! $value->name !!}" data-src="{{ url($value->image) }}" class="lazyload"></span>
						@else
						<img alt="{!! $value->name !!}" title="{!! $value->name !!}" data-src="{{ url($value->image) }}" class="lazyload">
						@endif
					</a>
				</div>
			</div>
			<div class="medium-9 columns">
				<h2><a href="{{ $url }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
				<p>{!! $value->summary !!}</p>
			</div>
		</div>
	</div>
	@endforeach
</div>
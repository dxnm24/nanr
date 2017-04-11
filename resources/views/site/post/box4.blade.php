<?php 
	$data = $type->posts;
?>
<div class="row small-up-1 medium-up-3 large-up-3">
	@foreach($data as $key => $value)
	<div class="column">
		<div class="callout post-grid clearfix">
			<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
				<img src="{{ url($value->image) }}" alt="{!! $value->name !!}" />
				<h3>{!! $value->name !!}</h3>
			</a>
		</div>
	</div>
	@endforeach
</div>

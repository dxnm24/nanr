@if($middlearchives)
<div class="side">
	<h3 class="middle-title">Hot tips</h3>
	<div class="middle">
		@foreach($middlearchives as $key => $value)
		<a href="{{ url($value->url) }}" title="{!! $value->name !!}">
			<img src="{{ $value->image }}" alt="{!! $value->name !!}" />
			<span>{!! $value->name !!}</span>
		</a>
		@endforeach
	</div>
</div>
@endif

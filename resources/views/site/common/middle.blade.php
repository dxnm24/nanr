@if($middlearchives)
<div class="side">
	<h3 class="middle-title">Nổi Bật</h3>
	<div class="middle">
		@foreach($middlearchives as $key => $value)
		<a href="{{ url($value->url) }}" title="{!! $value->name !!}">
			<img src="{{ $value->image }}" alt="{!! $value->name !!}" />
			<h3>{!! $value->name !!}</h3>
		</a>
		@endforeach
	</div>
</div>
@endif

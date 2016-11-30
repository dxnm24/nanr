@if($populararchives)
<div class="side">
	<h3 class="middle-title">Đọc nhiều</h3>
	<div class="middle">
		@foreach($populararchives as $key => $value)
		<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
			<img src="{{ $value->image }}" alt="{!! $value->name !!}" />
			<span>{!! $value->name !!}</span>
		</a>
		@endforeach
	</div>
</div>
@endif

<div class="row small-up-1 medium-up-3 large-up-3 box3">
	@foreach($data as $key => $value)
	<div class="column">
		<div class="callout box3-item">
			<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
				<img src="{{ $value->image }}" alt="{!! $value->name !!}" />
				<span>{!! $value->name !!}</span>
			</a>
			<span><i class="fa fa-clock-o"></i>{!! date('d-m-Y', strtotime($value->created_at)) !!}</span>
		</div>
	</div>
	@endforeach
</div>
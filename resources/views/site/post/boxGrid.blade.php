<div class="box-grid">
	<div class="row small-up-1 medium-up-2 large-up-2">
		@foreach($data as $key => $value)
		<div class="column">
			<div class="callout item">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img alt="{!! $value->name !!}" title="{!! $value->name !!}" src="{{ url($value->image) }}">
				</a>
				<div class="item-content">
					<h2><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
					<p>{!! $value->summary !!}</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
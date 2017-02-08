<div class="box-list">
	@foreach($data as $key => $value)
	<div class="row">
		<div class="medium-5 columns">
			<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
				<img src="{{ url($value->image) }}" alt="{!! $value->name !!}" />
			</a>
		</div>
		<div class="medium-7 columns">
			<div class="post-large">
				<h2><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
				<p>{!! $value->summary !!}</p>
			</div>
		</div>
		<div class="columns"><div class="xhr"></div></div>
	</div>
	@endforeach
</div>
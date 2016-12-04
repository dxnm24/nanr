<?php 
	$data = $type->posts;
?>
<div class="row">
	<div class="medium-6 columns">
		<a href="{{ url($data[0]->slug) }}" title="{!! $data[0]->name !!}">
			<img src="{{ $data[0]->image }}" alt="{!! $data[0]->name !!}" />
		</a>
	</div>
	<div class="medium-6 columns">
		<div class="post-large">
			<a href="{{ url($data[0]->slug) }}" title="{!! $data[0]->name !!}">
				<span>{!! $data[0]->name !!}</span>
			</a>
			<p>{!! $data[0]->summary !!}</p>
		</div>
	</div>
</div>
<div class="xhr"></div>
<div class="row small-up-1 medium-up-2 large-up-2">
	@foreach($data as $key => $value)
	@if($key>0)
	<?php 
		$thumbnail = str_replace('/images/', '/thumbs/', $value->image);
		$thumbnail = str_replace('/thumb/', '/', $thumbnail);
	?>
	<div class="column">
		<div class="callout post-list clearfix">
			<div class="post-image">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img src="{{ $thumbnail }}" alt="{!! $value->name !!}" />
				</a>
			</div>
			<div class="post-title">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a>
			</div>
		</div>
	</div>
	@endif
	@endforeach
</div>

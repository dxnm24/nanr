<?php 
	$data = $type->posts;
?>
<div class="post-large">
	<a href="{{ url($data[0]->slug) }}" title="{!! $data[0]->name !!}">
		<img src="{{ $data[0]->image }}" alt="{!! $data[0]->name !!}" />
		<span>{!! $data[0]->name !!}</span>
	</a>
	<p>{!! $data[0]->summary !!}</p>
</div>
@foreach($data as $key => $value)
@if($key > 0)
<?php 
	$thumbnail = str_replace('/images/', '/thumbs/', $value->image);
	$thumbnail = str_replace('/thumb/', '/', $thumbnail);
?>
<div class="post-list clearfix">
	<div class="post-image">
		<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
			<img src="{{ $thumbnail }}" alt="{!! $value->name !!}" />
		</a>
	</div>
	<div class="post-title">
		<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a>
	</div>
</div>
@endif
@endforeach

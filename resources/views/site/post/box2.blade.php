<?php 
	$data = $type->posts;
?>
<div class="post-large">
	<a href="{{ url($data[0]->slug) }}" title="{!! $data[0]->name !!}">
		<img src="{{ url($data[0]->image) }}" alt="{!! $data[0]->name !!}" />
		<h2>{!! $data[0]->name !!}</h2>
	</a>
	<p>{!! limit_text($data[0]->summary, 200) !!}</p>
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
			<img src="{{ url($thumbnail) }}" alt="{!! $value->name !!}" />
		</a>
	</div>
	<div class="post-title">
		<h2><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
	</div>
</div>
@endif
@endforeach

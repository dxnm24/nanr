<?php 
	$data = $type->posts;
?>
@foreach($data as $key => $value)
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
		<h3><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h3>
	</div>
</div>
@endforeach

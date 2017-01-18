<?php 
	if(isset($type) && $type->posts) {
		$data = $type->posts;	
	}
?>
<div class="row small-up-1 medium-up-2 large-up-2">
	@foreach($data as $key => $value)
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
				<h2><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
			</div>
		</div>
	</div>
	@endforeach
</div>

<div class="row box4">
	<div class="medium-5 columns">
		<div class="box4-first-image">
			<a href="{{ url($data[0]->slug) }}" title="{!! $data[0]->name !!}">
				<img src="{{ $data[0]->image }}" alt="{!! $data[0]->name !!}" />
			</a>
		</div>
	</div>
	<div class="medium-7 columns">
		<div class="box4-first-title">
			<a href="{{ url($data[0]->slug) }}" title="{!! $data[0]->name !!}">
				<span>{!! $data[0]->name !!}</span>
			</a>
			<span><i class="fa fa-clock-o"></i>{!! date('d-m-Y', strtotime($data[0]->created_at)) !!}</span>
			<p>{!! $data[0]->summary !!}</p>
		</div>
	</div>
</div>
<div class="row small-up-1 medium-up-2 large-up-2 box4">
	@foreach($data as $key => $value)
	@if($key>0)
	<?php 
		$thumbnail = str_replace('/images/', '/thumbs/', $value->image);
		$thumbnail = str_replace('/thumb/', '/', $thumbnail);
	?>
	<div class="column">
		<div class="callout box4-item">
			<div class="box4-item-image">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img src="{{ $thumbnail }}" alt="{!! $value->name !!}" />
				</a>
			</div>
			<div class="box4-item-title">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a>
				<span><i class="fa fa-clock-o"></i>{!! date('d-m-Y', strtotime($value->created_at)) !!}</span>
			</div>
		</div>
	</div>
	@endif
	@endforeach
</div>

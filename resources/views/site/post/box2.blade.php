<div class="row box2">
	<div class="medium-6 columns">
		<div class="box2-first">
			<a href="{{ url($data[0]->slug) }}" title="{!! $data[0]->name !!}">
				<img src="{{ $data[0]->image }}" alt="{!! $data[0]->name !!}" />
				<span>{!! $data[0]->name !!}</span>
			</a>
			<span><i class="fa fa-clock-o"></i>{!! date('d-m-Y', strtotime($data[0]->created_at)) !!}</span>
			<p>{!! $data[0]->summary !!}</p>
			@foreach($data as $key => $value)
			@if($key > 0 && $key < 3)
			<?php 
				$thumbnail = str_replace('/images/', '/thumbs/', $value->image);
				$thumbnail = str_replace('/thumb/', '/', $thumbnail);
			?>
			<div class="box2-item">
				<div class="box2-image">
					<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
						<img src="{{ $thumbnail }}" alt="{!! $value->name !!}" />
					</a>
				</div>
				<div class="box2-title">
					<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a>
					<span><i class="fa fa-clock-o"></i>{!! date('d-m-Y', strtotime($value->created_at)) !!}</span>
				</div>
			</div>
			@endif
			@endforeach
		</div>
	</div>
	<div class="medium-6 columns">
		@foreach($data as $key => $value)
		@if($key > 2)
		<?php 
			$thumbnail = str_replace('/images/', '/thumbs/', $value->image);
			$thumbnail = str_replace('/thumb/', '/', $thumbnail);
		?>
		<div class="box2-item">
			<div class="box2-image">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img src="{{ $thumbnail }}" alt="{!! $value->name !!}" />
				</a>
			</div>
			<div class="box2-title">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a>
				<span><i class="fa fa-clock-o"></i>{!! date('d-m-Y', strtotime($value->created_at)) !!}</span>
			</div>
		</div>
		@endif
		@endforeach
	</div>
	
</div>
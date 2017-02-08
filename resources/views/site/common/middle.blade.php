@if($middlearchives)
<div class="side">
	<h3 class="middle-title">Nổi Bật</h3>
	<div class="middle">
		@foreach($middlearchives as $key => $value)
		<?php 
          if($value->image != '') {
            $basename = pathinfo($value->image, PATHINFO_BASENAME);
            $dirname = pathinfo($value->image, PATHINFO_DIRNAME);
            $thumbnail = $dirname . '/thumb/' . $basename;
          }
        ?>
		<a href="{{ url($value->url) }}" title="{!! $value->name !!}">
			<img src="{{ url($thumbnail) }}" alt="{!! $value->name !!}" />
			<h3>{!! $value->name !!}</h3>
		</a>
		@endforeach
	</div>
</div>
@endif

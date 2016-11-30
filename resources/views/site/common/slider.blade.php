@if($sliders)
<div class="mix">
  <div class="row">
    <div class="column">
      <div class="swiper-container">
          <div class="swiper-wrapper">
            @foreach($sliders as $key => $value)
              <div class="swiper-slide"><a href="{{ url($value->url) }}" title="{!! $value->name !!}"><img src="{{ $value->image }}" alt="{!! $value->name !!}" /><p>{!! $value->name !!}</p></a></div>
            @endforeach
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
      </div>
    </div>
  </div>
</div>
@endif
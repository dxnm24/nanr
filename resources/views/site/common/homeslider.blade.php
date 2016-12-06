<!-- This code works without jquery library. -->
<script src="{{ asset('js/jssor.slider-21.1.6.min.js') }}"></script>
<script type="text/javascript">jssor_1_slider_init=function(){var jssor_1_options={$AutoPlay:!0,$ArrowNavigatorOptions:{$Class:$JssorArrowNavigator$},$ThumbnailNavigatorOptions:{$Class:$JssorThumbnailNavigator$,$Cols:5,$SpacingX:4,$SpacingY:4,$Orientation:2,$Align:0}};var jssor_1_slider=new $JssorSlider$("jssor_1",jssor_1_options);function ScaleSlider(){var refSize=jssor_1_slider.$Elmt.parentNode.clientWidth;if(refSize){refSize=Math.min(refSize,1170);jssor_1_slider.$ScaleWidth(refSize)}
else{window.setTimeout(ScaleSlider,30)}}
ScaleSlider();$Jssor$.$AddEvent(window,"load",ScaleSlider);$Jssor$.$AddEvent(window,"resize",ScaleSlider);$Jssor$.$AddEvent(window,"orientationchange",ScaleSlider)};</script>
<style>.jssora02l,.jssora02r{display:block;position:absolute;width:55px;height:55px;cursor:pointer;background:url(img/a02.png) no-repeat;overflow:hidden}.jssora02l{background-position:-3px -33px}.jssora02r{background-position:-63px -33px}.jssora02l:hover{background-position:-123px -33px}.jssora02r:hover{background-position:-183px -33px}.jssora02l.jssora02ldn{background-position:-3px -33px}.jssora02r.jssora02rdn{background-position:-63px -33px}.jssora02l.jssora02lds{background-position:-3px -33px;opacity:.3;pointer-events:none}.jssora02r.jssora02rds{background-position:-63px -33px;opacity:.3;pointer-events:none}.jssort11 .p{position:absolute;top:0;left:0;width:385px;height:73px;background:transparent}.jssort11 .tp{position:absolute;top:0;left:0;width:100%;height:100%;border:none}.jssort11 .i,.jssort11 .pav:hover .i{position:absolute;top:3px;left:3px;width:100px;height:67px}* html .jssort11 .i{width:62px;height:32px}.jssort11 .pav .i{border:white 1px solid}.jssort11 .t,.jssort11 .pav:hover .t{position:absolute;top:10px;left:110px;width:270px;height:66px;color:#0a0a0a;font-size:0.938rem}.jssort11 .pav .t,.jssort11 .p:hover .t{color:#262626}.jssort11 .p:hover .t,.jssort11 .pav:hover .t,.jssort11 .p:hover,.jssort11 .pav:hover{background:#eee}.jssort11 .pav,.jssort11 .p.pdn{background:#eee}.st{position:absolute;bottom:0;background:rgba(0,0,0,.4);padding:10px}.st a{color:#fff;font-size:24px}</style>
<div style="margin-top: 15px;">
  <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1170px; height: 380px; overflow: hidden; visibility: hidden; background-color: transparent;">
      <!-- Loading Screen -->
      <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
          <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
          <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
      </div>
      <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; right: 15px; width: 775px; height: 380px; overflow: hidden;">
        @foreach($homesliders as $key => $value)
          <?php 
            $thumbnail = str_replace('/images/', '/thumbs/', $value->image);
            $styleDisplayNone = ($key > 0)?' style="display: none;"':'';
          ?>
          <div data-p="112.50" {!! $styleDisplayNone !!}>
              <img data-u="image" src="{{ $value->image }}" alt="{!! $value->name !!}" />
              <p class="st"><a href="{{ url($value->url) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></p>
              <div data-u="thumb">
                  <img class="i" src="{{ $thumbnail }}" alt="{!! $value->name !!}" />
                  <div class="t">{!! $value->name !!}</div>
              </div>
          </div>
        @endforeach
      </div>
      <!-- Thumbnail Navigator -->
      <div data-u="thumbnavigator" class="jssort11" style="position:absolute;right:0;top:0px;font-family:Arial, Helvetica, sans-serif;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;width:385px;height:380px;" data-autocenter="2">
          <!-- Thumbnail Item Skin Begin -->
          <div data-u="slides" style="cursor: pointer;">
              <div data-u="prototype" class="p">
                  <div data-u="thumbnailtemplate" class="tp"></div>
              </div>
          </div>
          <!-- Thumbnail Item Skin End -->
      </div>
      <!-- Arrow Navigator -->
      <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
      <span data-u="arrowright" class="jssora02r" style="top:0px;right:405px;width:55px;height:55px;" data-autocenter="2"></span>
  </div>
</div>
<script type="text/javascript">jssor_1_slider_init();</script>
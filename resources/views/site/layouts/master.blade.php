@include('site.common.head')
<body>

@if(isset($isPost) && $isPost == true && isset($configfbappid) && $configfbappid != '')
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{{ $configfbappid }}',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
@endif


<div class="row column">
  <div class="container">

  @include('site.common.top')

  <div class="main">

    <?php $device = getDevice2(); ?>
    @if(isset($isHome) && $isHome == true && $device != MOBILE && isset($homesliders) && count($homesliders) > 0)
    @include('site.common.homeslider', ['homesliders' => $homesliders])
    @endif

    @include('site.common.ad', ['posPc' => 1, 'posMobile' => 2])

    <div class="row">
    	<div class="medium-7 columns">
    		<div class="content">
          @if(!isset($isHome) || $isHome != true || $device != MOBILE)
    			@yield('content')
          @endif
    		</div>
    	</div>
      <div class="medium-3 medium-push-2 columns">
        @include('site.common.side')
      </div>
      <div class="medium-2 medium-pull-3 columns">
        @include('site.common.middle')
      </div>
    	
    </div>

    @include('site.common.ad', ['posPc' => 3, 'posMobile' => 4])

  </div>

  @include('site.common.slider')

  @include('site.common.bottom')

  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

@if($data && count($postData) > 0)
<?php 
	if(isset($dataSeri)) {
		$url = url($dataSeri->slug.'/'.$data->slug); 	
	} else {
		$url = url($data->slug); 
	}
?>
<div class="posttypes">
	<div class="row column box-title box-title-hr">
		<h3>{!! $data->name !!}</h3>
		<a href="{{ $url }}" class="btn-seemore float-right hide-for-small-only"><span>Xem thêm</span></a>
	</div>
	<div class="box-inner">
	@include('site.post.box', array('data' => $postData))
	</div>
	<div class="row column show-for-small-only box-seemore">
		<a href="{{ $url }}" class="btn-seemore">Xem thêm<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
	</div>
</div>
@endif
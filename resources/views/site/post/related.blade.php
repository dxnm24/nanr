@if($data && count($postData) > 0)
<div class="posttypes">
	<div class="row column box-title box-title-hr display-title">
		<h3><a href="{{ $typeMainUrl }}" title="{!! $data->name !!}"><span class="display-title-link">{!! $data->name !!}</span><span class="display-title-rss"><i class="fa fa-rss" aria-hidden="true"></i></span></a></h3>
	</div>
	<div class="box-inner">
	@include('site.post.box', array('data' => $postData))
	</div>
</div>
@endif

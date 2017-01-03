@if(isset($isCreate))
<?php 
	$dataMaterial = CommonPost::getArrayPostMaterial();
?>
<div class="box-body table-responsive no-padding">
	<h4>Thành phần</h4>
	<div class="overflow-box">
		@if($dataMaterial)
			{!! Form::select('post_material[]', $dataMaterial, old('post_material'), array('class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select a Metarial', 'style' => 'width: 100%;')) !!}
		@else
			<i>Chưa có thành phần/nguyên liệu nào</i>
		@endif
	</div>
</div>
@elseif(isset($isEdit))
<?php 
	$dataMaterial = CommonPost::getArrayPostMaterial($data->id);
	$issetPostMaterial = CommonPost::issetPostMaterial($data->id);
?>
<div class="box-body table-responsive no-padding">
	<h4>Thành phần</h4>
	<div class="overflow-box">
		@if($dataMaterial)
			{!! Form::select('post_material[]', $dataMaterial, $issetPostMaterial, array('class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select a Metarial', 'style' => 'width: 100%;')) !!}
		@else
			<i>Chưa có thành phần/nguyên liệu nào</i>
		@endif
	</div>
</div>
@endif
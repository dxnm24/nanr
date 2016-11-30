<?php 
	$posPc = isset($posPc)?$posPc:null;
	$postMobile = isset($postMobile)?$postMobile:null;
?>
@if(getDevice() == PC)
	{!! CommonQuery::getAdByPosition($posPc) !!}
@else
	{!! CommonQuery::getAdByPosition($postMobile) !!}
@endif
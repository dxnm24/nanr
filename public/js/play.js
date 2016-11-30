var thegame_width=0;
var thegame_height=0;
var thegame_minwidth=0;
var thegame_minheight=0;
var SimilarGamesDivWidth;
var ShowSimilarGamesDiv=false;

$(window).resize(function(){
	UpdateGameSize();
});

function UpdateGameSize(){
	var Width;
	if($(window).width()>720) Width=$(window).width()-132; else	Width = $(window).width();
	var Height = $(window).height();
	
	if(thegame_width==0 || thegame_height==0){
		thegame_width=Width;
		thegame_height=Height;
	}
	var TheGameWidth;
	var TheGameHeight;
	var ScreenRatio=Width/Height;
	var GameRatio=thegame_width/thegame_height;
	if( ScreenRatio > GameRatio ){
		TheGameHeight=Height;
		TheGameWidth=parseInt(thegame_width*TheGameHeight/thegame_height);
	}else{
		TheGameWidth=Width;
		TheGameHeight=parseInt(thegame_height*TheGameWidth/thegame_width);
	}
	$("#game-container").width(TheGameWidth);	
	$("#game-container").height(TheGameHeight);
	$("#my-iframe").width($("#game-container").width());
	$("#my-iframe").height($("#game-container").height());

	if(($(window).width()-TheGameWidth>130)){
		SimilarGamesDivWidth=$(window).width()-TheGameWidth-30;
		ShowSimilarGamesDiv=true;
	}else{
		if(parseInt($(window).width()/2)>150){
			SimilarGamesDivWidth=300;
		}else{
			SimilarGamesDivWidth=parseInt($(window).width()/2);
		}
		ShowSimilarGamesDiv=false;
	}
	
	var MarginLeft;
	if(ShowSimilarGamesDiv){
		MarginLeft=20+SimilarGamesDivWidth;
	}else{
		MarginLeft=parseInt(($(window).width()-TheGameWidth)/2);
	}
	var MarginTop=parseInt(($(window).height()-TheGameHeight)/2);
	$("#game-container").css({
		"margin-left":	MarginLeft+"px",
		"margin-top":	MarginTop+"px"
	});	
			
}

$(function () {
	$(window).trigger('resize');
	$('#menushow').click(function(){
		$('#menubox').attr('style', 'display: block;')
	});
	$('#menuhide').click(function(){
		$('#menubox').attr('style', 'display: none;')
	});
});

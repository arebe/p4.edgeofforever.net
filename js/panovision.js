/*** Global variables ***/
// canvas
var context;
var canvas;
var photo_url;

// load page
$(document).ready(function(){
	console.log('ready!');
	//$('#canvas').attr("height", screen.availHeight );  
	$('#canvas').addClass('default_background');
	canvas = document.getElementById('canvas'),
	context = canvas.getContext('2d');
//	var context_width = $(context).width();
//	console.log("canvas width: " + context_width);
	// test loading image
	var pano_img = new Image();
	pano_img.onload = function(){
		console.log("image width: " + pano_img.width);
		context.drawImage(pano_img, -pano_img.width/2, -pano_img.height/2);
	}
	pano_img.src = photo_url;
	var pano_scale = slider();
	console.log("pano scale: " + pano_scale);

	//context.scale(pano_scale, pano_scale);
});

function input_url(params){
	photo_url = params['photo_url'];
}

function slider() {
	var slider_value;
	$( "#slider-range-max" ).slider({
		range: "max",
		min: 1,
		max: 100,
		value: 50,
		slide: function( event, ui ) {
			$( "#amount" ).val( ui.value );
			slider_value = ui.value;
			console.log("slider value: " + slider_value);
		}
	});
	$( "#amount" ).val( $( "#slider-range-max" ).slider( "value" ) );
	return(slider_value);
}
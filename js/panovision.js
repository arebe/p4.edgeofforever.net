/*** Global variables ***/
// canvas
var context;
var canvas;
var photo_url;
var pano_scale;
var pano_img = new Image();
var pano_x;
var pano_y;

// load page
$(document).ready(function(){
	console.log('ready!');
	//$('#canvas').attr("height", screen.availHeight );  
	$('#canvas').addClass('default_background');
	canvas = document.getElementById('canvas'),
	context = canvas.getContext('2d');	
	pano_img.onload = function(){
		console.log("image width: " + pano_img.width);
		// initialize image to display centered on canvas
		pano_x = -pano_img.width/2;
		pano_y = -pano_img.height/2;
		context.drawImage(pano_img, pano_x, pano_y);
	}
	pano_img.src = photo_url;
	zoom_slider();
	
});

function input_url(params){
	photo_url = params['photo_url'];
}

function zoom_slider() {
	var slider_value;
	$( "#zoom_slider" ).slider({
		range: "min",
		min: 1,
		max: 100,
		value: 100,
		slide: function( event, ui ) {
			$( "#zoom" ).val( ui.value );
			slider_value = ui.value;
			console.log("slider value: " + slider_value);
			refresh_scale();
		}
	});
	$( "#zoom" ).val( $( "#zoom_slider" ).slider( "value" ) );
}

function refresh_scale(){
	pano_scale = $("#zoom_slider").slider("value") / 100;	
    console.log("pano scale: " + pano_scale);
	draw_canvas();
}

function draw_canvas(){
	//clear canvas
	canvas.width = canvas.width;
	context.scale(pano_scale, pano_scale);
	context.drawImage(pano_img, pano_x, pano_y);
}
	
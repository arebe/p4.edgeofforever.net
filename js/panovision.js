/*** Global variables ***/
// canvas
var context;
var canvas;
var canvas_width = 900;
var canvas_height = 600;
// photo-related
var photo_url;
var pano_scale;
var pano_img = new Image();
// interactions and display
var pano_x;
var pano_y;
var start_x;
var start_y;

// load page
$(document).ready(function(){
	console.log('ready!');
	//$('#canvas').attr("height", screen.availHeight );  
	$('#canvas').addClass('default_background');
	canvas = document.getElementById('canvas'),
	context = canvas.getContext('2d');	
	pano_img.onload = function(){
		console.log("image width: " + pano_img.width);
		pano_scale = 1;
		start_x = 0;
		start_y = 0;
		pano_x = start_x;
		pano_y = start_y;
		context.drawImage(pano_img, pano_x, pano_y, pano_img.width, pano_img.height, 0, 0, pano_img.width, pano_img.height);
		pan_sliders();
	}
	pano_img.src = photo_url;
	zoom_slider();
});

function input_url(params){
	photo_url = params['photo_url'];
}

function zoom_slider() {
	$( "#zoom_slider" ).slider({
		range: "min",
		min: 1,
		max: 100,
		value: 100,
		slide: function( event, ui ) {
			$( "#zoom" ).val( ui.value );
			refresh_scale();
		}
	});
	$( "#zoom" ).val( $( "#zoom_slider" ).slider( "value" ) );
}

function refresh_scale(){
	pano_scale = $("#zoom_slider").slider("value") / 100;	
    draw_canvas();
}

function pan_sliders(){
	$("#x_pan_slider").slider({
		range: "min",
		min: 0,
		max:  pano_img.width, 
		value: start_x,
		slide: function( event, ui){
			$("#horiz").val(ui.value);
			refresh_pan();
		}
	});
	$("horiz").val($("#x_pan_slider").slider("value"));
	$("#y_pan_slider").slider({
		range: "min",
		min: 0,
		max: pano_img.height, 
		value: start_y,
		slide: function( event, ui){
			$("#vert").val(ui.value);
			refresh_pan();
		}
	});
	$("vert").val($("#y_pan_slider").slider("value"));
}

function refresh_pan(){
	pano_x = $("#x_pan_slider").slider("value");
	pano_y = $("#y_pan_slider").slider("value");
	draw_canvas();
}


function draw_canvas(){
	//clear canvas
	canvas.width = canvas.width;
	context.scale(pano_scale, pano_scale);
	context.drawImage(pano_img, pano_x, pano_y, pano_img.width, pano_img.height, 0, 0, pano_img.width, pano_img.height);
}
	
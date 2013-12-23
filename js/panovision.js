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
var toggle_pan;
var drag_on;
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
		toggle_pan = 0;
		drag_on = 0;
		console.log("image width: " + pano_img.width);
		// initialize image to display centered on canvas
		/*start_x = (pano_img.width/2) - (canvas_width/2);
		start_y = (pano_img.height/2) - (canvas_height/2);*/
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


// canvas interactions: dragging
// this isn't working...trying other methodsz
/*$("#canvas").mousedown(function(e){
	if(toggle_pan == 1){
		drag_on = 1;
		start_x = e.clientX;
		start_y = e.clientY;
	}
});

$("#canvas").mousemove(function (e){
	if(drag_on){
		var delta_x = e.clientX - start_x;
		var delta_y = e.clientY - start_y;
		console.log("delta X: " + delta_x + " delta Y: " + delta_y);
		pano_x += delta_x;
		pano_y += delta_y;
		draw_canvas();
	}
});

$("#canvas").mouseup(function(e){
	drag_on = 0;
});*/


function draw_canvas(){
	//clear canvas
	canvas.width = canvas.width;
	context.scale(pano_scale, pano_scale);
	context.drawImage(pano_img, pano_x, pano_y, pano_img.width, pano_img.height, 0, 0, pano_img.width, pano_img.height);
}
	
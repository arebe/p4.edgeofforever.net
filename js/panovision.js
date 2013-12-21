/*** Global variables ***/
// canvas
var context;
var canvas;

// load page
$(document).ready(function(){
	console.log('ready!');
	$('#canvas').addClass('default_background');
	canvas = document.getElementById('canvas'),
	context = canvas.getContext('2d');
	// test loading image
	var pano_img = new Image();
	context.drawImage(pano_img, 0, 0);
	pano_img.src = "<?=$post['photo_url']?>";
});
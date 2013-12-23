<article>
	<?php if($post['photo_url'] != NULL): ?>
		<div class="pano_photo">
			<canvas id='canvas'>
				<div id='no_canvas'>
					Your browser does not seem to support HTML5 canvas :( <br/>
					Download
					the <a href="http://www.mozilla.org/en-US/firefox/fx/">latest
					version of Firefox</a>.
				</div>
			</canvas>

<p>
<label for="zoom">Drag to zoom:</label>
<input type="text" id="zoom" style="border:0; color:#f6931f; font-weight:bold; width: 50px">
</p>
<div id="zoom_slider"></div>

<p>
<label for="horiz">Horizontal pan:</label>
<input type="text" id="horiz" style="border:0; color:#f6931f; font-weight:bold; width: 50px">
<div id="x_pan_slider"></div>
</p>

<p>
<label for="vert">Vertical pan:</label>
<input type="text" id="vert" style="border:0; color:#f6931f; font-weight:bold; width: 50px">
<div id="y_pan_slider"></div>
</p>
<br><br>
<!-- scaled photo for reference -->
			<a href='<?=$post['photo_url']?>'><img src='<?=$post['photo_url']?>'
			width='900' alt='<?=$post['content']?>' border=0></a>


		</div>
	<?php else: ?>
		<h3 class="no_photo">No photo for this post</h3>
	<?php endif; ?>
	<div class="posts_view">
		<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		   <?=Time::display($post['created'])?>
		</time>
		<p><?=$post['content']?></p>
	</div>
	<!-- View comments on the post -->
	<?php foreach($comments as $comment): ?>
		<div class="posts_comment">
		<div class="comment_box">

		<time datetime="<?=Time::display($comment['created'],'Y-m-d G:i')?>">
		   <?=Time::display($comment['created'])?>
		</time>
		<h1><span class="comment_user"><?=$comment['first_name']?> <?=$comment['last_name']?></span> said:</h1>
	   	<p><?=$comment['content']?></p>

		<!-- Delete comment if it belongs to logged-in user -->
		<?php if($user_id == $comment['comment_user_id']): ?>
			<form method='POST' action='/posts/p_comment_del/<?=$comment['comment_id']?>'>
				<input type='submit' value='Delete comment'>
			</form> 
		<?php endif; ?>
		</div>
	<?php endforeach; ?>
	<!-- Add a new comment -->
	<?php if($user): ?>
	<form method='POST' action='/posts/p_comment/<?=$post['post_id']?>'>
		<label for='content'>Comment:</label><br>
	    <textarea name='content' id='content' class='wide_text'></textarea>
		<br><br>
	    <input type='submit' value='Post comment'>
	</form> 
	<?php endif; ?>
	<!-- Display message if not logged in -->
   <?php if(!$user): ?>
		<div class='no_photo'>Log in to leave comments.</div>
   <?php endif; ?>
</div>
</article>
<!-- script to send photo url to js canvas app -->
<script type="text/javascript">
	$(function() {
		input_url(<?php echo json_encode($params); ?>);
	});
</script>

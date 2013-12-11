<article>
	<?php if($post['photo_url'] != NULL): ?>
		<div class="pano_photo">
			<a href='<?=$post['photo_url']?>'><img src='<?=$post['photo_url']?>' width='900' alt='<?=$post['content']?>' border=0></a>
		</div>
	<?php else: ?>
		<h3 class="no_photo">No photo for this post</h3>
	<?php endif; ?>
	<div class="posts_view">
		<time datetime="<?Time::display($post['created'],'Y-m-d G:i')?>">
		   <?=Time::display($post['created'])?>
		</time>
		<p><?=$post['content']?></p>
	</div>
	<!-- View comments on the post -->
	<?php foreach($comments as $comment): ?>
		<div class="posts_comment">
		<div class="comment_box">

		<time datetime="<?Time::display($comment['created'],'Y-m-d G:i')?>">
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
	    <textarea name='content' id='content'></textarea>
		<br><br>
	    <input type='submit' value='Post comment'>
	</form> 
<?php endif; ?>
</div>
</article>

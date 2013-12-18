<h1>This is the profile for <span class="post_user"><?=$first_name?> <?=$last_name?></span></h1>
<img src=<?=$profile_pic?>  width='150'>



<!-- show most recent 5 posts from this user -->
<div id='profile_posts'>
   Most recent panos:
   <?php foreach($posts as $post): ?>
	<article>
        <div class="profile_posts_box">
        <p>
        <div class="profile_posts_thumbnail">
		<a href='/posts/view/<?=$post['post_id']?>'>
			<img src='<?=$post['photo_url']?>' border=0 width=300 height=120>
		</a>
        </div>
		</div>
	</article>
   <?php endforeach; ?>
</div>

<form method = 'POST' action = '/users/edit' class='<?=$edit_profile?>'>
	<input type = 'submit' value = 'Edit profile'>
</form>
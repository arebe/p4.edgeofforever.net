<?php foreach($users as $user): ?>
	<!-- Show thumb of profile pic -->
	<img src=<?=$user['profile_pic']?> width="30">

    <!-- Print this user's name -->
	<a href = '/users/profile/<?=$user['user_id']?>'>    
		<?=$user['first_name']?> <?=$user['last_name']?>
	</a>
    <!-- If there exists a connection with this user, show a unfollow link -->
   <?php if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    <?php endif; ?>

    <br><br>

<?php endforeach; ?>

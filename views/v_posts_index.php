<!-- Display message if there are no posts -->
<?php if(count($posts) == 0): ?>
	<div class='no_photo'>Follow other users to see their photos in your stream.</div>
<?php endif; ?>

<?php foreach($posts as $post): ?>
	<article>
        <div class="posts_box">
        <p>
        <div class="posts_thumbnail">
        <img src='<?=$post['photo_url']?>' width=300 height=120 alt='<?=$post['content']?>'>
        </div>
        <h1 class="posts_index"><span class="post_user"><?=$post['first_name']?> <?=$post['last_name']?></span> posted:</h1>
        <p><?=$post['content']?></p>

	<!-- View the post -->
        <form method = 'POST' action = '/posts/view/<?=$post['post_id']?>'>
        <input type = 'submit' value = 'View post'>
        </form>

        <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
         <?=Time::display($post['created'])?>
        </time>
        </div>
	</article>
<?php endforeach; ?>

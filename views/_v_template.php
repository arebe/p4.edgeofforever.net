<!DOCTYPE html>
<html>
<head>
	<title><?php if (isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="/css/app.css" type="text/css">
	<link rel="stylesheet" href="/css/main.css" type="text/css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			
	<!-- Controller Specific JS/CSS -->
	<?php if (isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	<header>
		<a href="/"><h1>PanoBlog</h1></a>
	</header>
<nav>
	<ul>
	  <li><a href='/posts'>Panostream</a></li>
	  <!-- Menu for those who are logged in -->
		<?php if($user): ?>
			<li><a href='/users/profile/<?=$user->user_id?>'>My Profile</a></li>
			<li><a href='/posts/add'>Add a Post</a></li>
			<li><a href='/posts/users'>List of Users</a></li>
			<li><a href='/users/logout'>Log out</a></li>
			<?php else: ?>
			<!-- Menu options for everyone else -->
			<li><a href='/users/signup'>Sign up</a></li>
			<li><a href='/users/login'>Log in</a></li>
		<?php endif; ?>
	</ul>
</nav>
<br><br>

	<?php if (isset($content)) echo $content; ?>

	<?php if (isset($client_files_body)) echo $client_files_body; ?>

	<!-- run javascript after page has loaded -->
	<script src="/js/main.js"></script>		

<footer>
	<small>&copy; Copyright 2013 Edge of Forever Studios</small>
</footer>

</body>
</html>

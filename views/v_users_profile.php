<h1>This is the profile for <?=$user->first_name?></h1>
<pre>
   <?php print_r($profile_pic); ?> 
</pre>

   <img src=<?=$user->profile_pic?>  width='150'>

<form method = 'POST' action = '/users/edit'>
	<input type = 'submit' value = 'Edit profile'>
</form>
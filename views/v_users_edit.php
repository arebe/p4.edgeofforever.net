<form method='POST' action='/users/p_update'>
   Email / login: <?=$email?>
	<br><br>

   First name: <?=$first_name?><br>
   Change first name to: <input type='text' name='first_name'>
	<br><br>

   Last name: <?=$last_name?></br>
   Change last name to: <input type='text' name='last_name'>
	<br><br>

   Change password: <input type='password' name='password'>
   <br><br>

	<input type='submit' value='Update user profile'>
	<br><br>

</form>

<form method='POST' enctype="multipart/form-data" action='/users/p_upload/'>
	
	<input type='file' name='upload'>
	<input type='submit' value="Upload profile picture">

<form>

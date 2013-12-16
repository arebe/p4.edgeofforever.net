<form method='POST' action='/users/p_signup'>
   <?php if($error=="blank"): ?>
		<div class='error'>
		   Sign up failed. Please supply a valid email and password.
		</div>
		<br>
   <?php endif; ?>

   <?php if($error=="duplicate"): ?>
		<div class='error'>
		   Sign up failed. Someone has already registered that email address.
		</div>
		<br>
   <?php endif; ?>

    First Name<br>
    <input type='text' name='first_name'>
    <div id='first_name_error'>Please enter first name (30 char max).</div> 
    <br><br>

    Last Name<br>
    <input type='text' name='last_name'>
    <div id='last_name_error'>Please enter last name (30 char max).</div> 
    <br><br>

    Email<br>
    <input type='text' name='email'>
	<div id='email_error'>Please enter valid email address.</div> 
    <br><br>

    Password<br>
    <input type='password' name='password'>
    <div id='password_error'>Please enter password (5 chars min).</div>
    <br><br>

    <div id='submit_button'><input type='submit' value='Sign up'></div>

</form>

<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function signup($error = NULL) {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";
			$this->template->content->error = $error;

        # Render template
            echo $this->template;

    }

    public function p_signup() {
	  // check for empty fields
	  if(empty($_POST['email']) || empty($_POST['password'])):
		Router::redirect("/users/signup/blank");
	  endif;
	  // check for duplicate email in db
	  $q = "SELECT user_id
		FROM users
		WHERE email = '".$_POST['email']."'";
	  $user_id = DB::instance(DB_NAME)->select_field($q);
	  if($user_id):
		Router::redirect("/users/signup/duplicate");
	  endif;
	  // add user to db
	  $_POST['created'] = Time::now();
	  $_POST['modified'] = Time::now();
	  $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	  $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
	  $_POST['profile_pic'] = "/uploads/avatars/example.gif";
	  $user_id = DB::instance(DB_NAME)->insert('users', $_POST);
	  // automatically follow self
	  $data = Array(
			  "created" => Time::now(), 
			  "user_id" => $user_id, 
			  "user_id_followed" => $user_id
			  );
	  DB::instance(DB_NAME)->insert('users_users', $data);
	  Router::redirect("/users/login");
    }

	public function login($error = NULL){
	  $this->template->content = View::instance('v_users_login');
	  $this->template->title = "Login";
	  $this->template->content->error = $error;
	  echo $this->template;
	}

	public function p_login(){
	  // Sanitize user entered data
	  $_POST = DB::instance(DB_NAME)->sanitize($_POST);
	  // Hash the submitted password
	  $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);	
	  // Search db for email/password and retrieve token
	  $q = "SELECT token
		FROM users
		WHERE email = '".$_POST['email']."'
		AND password = '".$_POST['password']."'";
	  $token = DB::instance(DB_NAME)->select_field($q);
	  // if token isn't found: failed login
	  if(!$token){
		//send them back to login page
		Router::redirect("login/error");
	  }
	  else {
		setcookie("token", $token, strtotime('+1 year'), '/');
		Router::redirect("/posts/index");
	  }
	}
	
	public function logout() {
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

	    $data = Array("token" => $new_token);

		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
	    setcookie("token", "", strtotime('-1 year'), '/');

		Router::redirect("/");
	}
	
	public function profile($profile_user_id){
	  if(!$this->user){
		Router::redirect('/users/login');
	  }
	  // query the db for this user
	  $q = 'SELECT *
			FROM users
			WHERE user_id = '.$profile_user_id;
	  $profile_user = DB::instance(DB_NAME)->select_row($q);
	  $profile_pic = $profile_user['profile_pic'];
	  $this->template->content = View::instance('v_users_profile');
	  $this->template->content->first_name = $profile_user['first_name'];
	  $this->template->content->last_name = $profile_user['last_name'];
	  $this->template->content->profile_pic = $profile_pic;
	  $this->template->title = "Profile of ".$profile_user['first_name'];

	  // if this is the profile for the logged in user, show "edit profile" button
	  if($this->user->user_id == $profile_user_id):
		$this->template->content->edit_profile = 'display_button';
	  else:
		$this->template->content->edit_profile = 'no_button';
	  endif;

	  // query db for list of 5 recent posts by this user
	  $q = 'SELECT 
				post_id,
			    content,
				photo_url,
				created,
	            user_id
	        FROM posts
			WHERE user_id = '.$profile_user_id.'
			ORDER BY created DESC
			LIMIT 5';
      // run query
	  $posts = DB::instance(DB_NAME)->select_rows($q);
      // pass data to view
	  $this->template->content->posts = $posts;
	  //	  	  echo print_r( $profile_pic);	  
      echo $this->template;
	}
	
	public function edit(){
	  if(!$this->user){
		Router::redirect('/users/login');
	  }
	  $this->template->content = View::instance('v_users_edit');
	  $this->template->title = "Edit profile";
	  $this->template->content->email = $this->user->email;
	  $this->template->content->first_name = $this->user->first_name;
	  $this->template->content->last_name = $this->user->last_name;
	  echo $this->template;
	}

	public function p_upload(){
	  Upload::upload($_FILES, "/uploads/avatars/", array("jpg", "jpeg", "gif", "png"), "profile-".$this->user->user_id);
	  $filename = $_FILES['upload']['name'];
	  $extension = substr($filename, strrpos($filename, '.'));
	  $data = Array("profile_pic" => "/uploads/avatars/profile-".$this->user->user_id.$extension);
	  DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");
	  Router::redirect('/users/profile/'.$this->user->user_id);
	}

	public function p_update(){
	  // update first name, if one is entered
	  if($_POST['first_name']):
		$data = Array("first_name" => $_POST['first_name']);
		DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");
	  endif;

	  // update last name, if one is entered
	  if($_POST['last_name']):
		$data = Array("last_name" => $_POST['last_name']);
		DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");
	  endif;

	  // update password, if one is entered
	  if($_POST['password']):
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		$data = Array("password" => $_POST['password']);
		DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");
	  endif;

	  Router::redirect('/users/profile/'.$this->user->user_id);
    }

} # eoc
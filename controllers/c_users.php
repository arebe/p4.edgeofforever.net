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
	  $_POST['created'] = Time::now();
	  $_POST['modified'] = Time::now();
	  $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	  $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
	  $_POST['profile_pic'] = "/uploads/avatars/example.gif";
	  $user_id = DB::instance(DB_NAME)->insert('users', $_POST);
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
		Router::redirect("/");
	  }
	}
	
	public function logout() {
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

	    $data = Array("token" => $new_token);

		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
	    setcookie("token", "", strtotime('-1 year'), '/');

		Router::redirect("/");
	}
	
	public function profile($user_name = NULL){
	  if(!$this->user){
		Router::redirect('/users/login');
	  }
	  
	  $profile_pic = new Image(APP_PATH.$this->user->profile_pic);
	  $this->template->content = View::instance('v_users_profile');
	  $this->template->title = "Profile of ".$this->user->first_name;
	  echo $this->template;
	}
	
	public function edit(){
	  if(!$this->user){
		Router::redirect('/users/login');
	  }
	  $this->template->content = View::instance('v_users_edit');
	  $this->template->title = "Edit profile";
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

} # eoc
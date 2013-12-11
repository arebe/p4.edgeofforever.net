<?php

class posts_controller extends base_controller{
  public function __construct(){
	parent::__construct();
	/*	if(!$this->user){
	  die("Members only. <a href='/users/login'>Log in.</a>");
	  }*/
  }


  public function add(){
	if(!$this->user){
	  die("Members only. <a href='/users/login'>Log in.</a>");
	  }
	$this->template->content = View::instance('v_posts_add');
	$this->template->title = "New post";
	echo $this->template;
  }

  public function p_add(){
	// Associate this post with this user
	$_POST['user_id'] = $this->user->user_id;

	// Timestamp for creation and mod
	$_POST['created'] = Time::now();
	$_POST['modified'] = Time::now();

	// Insert post content -- insert function sanitizes data
	DB::instance(DB_NAME)->insert('posts', $_POST);
	Router::redirect("/posts");
  }

  public function index(){
	// the View
	$this->template->content = View::instance('v_posts_index');
	$this->template->title = "Posts";
	// query based on followed users for those logged in
	if(!$this->user):
		$q = 'SELECT
				posts.post_id,
			    posts.content,
				posts.photo_url,
				posts.created,
	            posts.user_id AS post_user_id,
			    users.first_name,
				users.last_name
	        FROM posts
			INNER JOIN users
				ON posts.user_id = users.user_id
				ORDER BY posts.created DESC';
	 else:
		$q = 'SELECT 
				posts.post_id,
			    posts.content,
				posts.photo_url,
				posts.created,
	            posts.user_id AS post_user_id,
		        users_users.user_id AS follower_id,
			    users.first_name,
				users.last_name
	        FROM posts
		    INNER JOIN users_users 
			    ON posts.user_id = users_users.user_id_followed
	        INNER JOIN users 
		        ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id.'
			ORDER BY posts.created DESC';
		endif;
	// run query
	$posts = DB::instance(DB_NAME)->select_rows($q);
	// pass data to view
	$this->template->content->posts = $posts;
	echo $this->template;
  }

  public function users(){
	if(!$this->user):
  	  die("Members only. <a href='/users/login'>Log in.</a>");
	endif;
	//set up view
	$this->template->content = View::instance("v_posts_users");
	$this->template->title = "Users";
	// query for all users
	$q = "SELECT * 
		FROM users";
	$users = DB::instance(DB_NAME)->select_rows($q);
	// query for connections to current user
	$q = "SELECT *
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
		// query using array_select to return an array of connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		$this->template->content->connections = $connections;
	$this->template->content->users = $users;	
	echo $this->template;
  }

  public function follow($user_id_followed){
	// prep data array to be inserted
	$data = Array(
				  "created" => Time::now(), 
				  "user_id" => $this->user->user_id, 
				  "user_id_followed" => $user_id_followed
				  );
	DB::instance(DB_NAME)->insert('users_users', $data);
	Router::redirect("/posts/users");
  }

  public function unfollow($user_id_followed){
	// delete this connection
	$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
	DB::instance(DB_NAME)->delete('users_users', $where_condition);
	Router::redirect("/posts/users");
  }

  public function view($post_id){
	// display a page with a single post
	// linked from index (posts) page
	$this->template->content = View::instance('v_posts_view');
	$this->template->title = "Blog post";
	// query the db for the post's id
	$q = 'SELECT *
		FROM posts
		WHERE post_id = '.$post_id;
	$post = DB::instance(DB_NAME)->select_row($q);
	// query db for comments associated w post
	$q = 'SELECT 
			comments.comment_id,
			comments.post_id,
			comments.content,
			comments.user_id AS comment_user_id, 
			users.first_name,
			users.last_name
		FROM comments
		INNER JOIN users
			ON comments.user_id = users.user_id
		WHERE comments.post_id = '.$post_id;
	$comments = DB::instance(DB_NAME)->select_rows($q);
	// pass data to view
	$this->template->content->post = $post;
	$this->template->content->comments = $comments;
	$this->template->content->user_id = $this->user->user_id;
	echo $this->template;
  }

  public function p_comment($post_id){
	// Associate this comment with this post & user
	$_POST['post_id'] = $post_id;
	$_POST['user_id'] = $this->user->user_id;

	// Timestamp for creation and mod
	$_POST['created'] = Time::now();

	// Insert post content -- insert function sanitizes data
	DB::instance(DB_NAME)->insert('comments', $_POST);
	Router::redirect("/posts/view/".$post_id);
  }

  public function p_comment_del($comment_id){
	// query db for post id for comment (for redirection)
	$q = 'SELECT
			post_id
		 FROM comments
		 WHERE comment_id = '.$comment_id;
	$post_id = DB::instance(DB_NAME)->select_field($q);
	// delete comment
	DB::instance(DB_NAME)->delete('comments', "WHERE comment_id = ".$comment_id);
	// redirect to post
	Router::redirect("/posts/view/".$post_id);
  }
}

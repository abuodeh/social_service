<?php 

	class SocialService extends CI_Controller
	{
		function __construct()
        {
            parent::__construct();
			$this->load->database();
            $this->load->model('CommentsModel');
            $this->load->model('UsersModel');
            $this->load->model('PostsModel');
			$this->load->library('session');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('upload');
			$this->load->helper('url');
        }

		public function index()
		{
			if(isset($_SESSION['email'])){
				$this->postView();
			}
			else{
				$this->load->view('users/login-view');
			}

		}
		
		public function postView()
		{
			if(isset($_SESSION['email'])){
				$this->data['posts'] = $this->PostsModel->getPosts();
				$this->data['comments'] = $this->CommentsModel->getComments();
				$this->load->view('blogs/posts_view',$this->data);
			}
			else{
				$this->load->view('users/login-view');
			}
		}
		
		public function login()
		{
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == TRUE)
			 {
				$email=$_POST['email'];
				$password=$_POST['password'];
			    $this->check = $this->UsersModel->login($email,$password);
				if($this->check == "true")
				{
					$this->session->set_userdata('email', $email);
					$this->info = $this->UsersModel->getInfo($email);
					$this->session->set_userdata('name', $this->info['name']);
					$this->session->set_userdata('id', $this->info['id']);
					$this->postView();
				}
				else{
					if(isset($_SESSION['email'])){
						$this->postView();
					}
					else{
						$this->data['note'] = "Email or Password incorrect";
						$this->load->view('users/login-view',$this->data);
					}
				}
			 }
			 else
			 {
					if(isset($_SESSION['email'])){
					$this->postView();
					}
					else{
						$this->load->view('users/login-view');
					}
			 }
			
		}
		
		public function logOut()
		{
			unset(
					$_SESSION['email'],
					$_SESSION['name'],
					$_SESSION['id']
			);
			$this->load->view('users/login-view');
		}
		
		public function registerView()
		{	
			if(isset($_SESSION['email'])){
				$this->postView();
			}
			else{
				$this->load->view('users/register_view'); 
			}
			
		}
	
		public function post()
		{
			$this->form_validation->set_rules('post', 'Post', 'required');
			if ($this->form_validation->run() == TRUE)
			 {
				 $post=$_POST['post'];
				 $this->PostsModel->addPost($post);
				 $this->postView();
			 }
			else{
				$this->postView();
			}
		}
		
		public function register()
		{	
		
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('name', 'User Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == TRUE)
			 {
				$email=$_POST['email'];
				$password=$_POST['password'];
				$name=$_POST['name'];
				$this->check = $this->UsersModel->register($name,$email,$password);
				if($this->check == "true")
				{
					$this->session->set_userdata('email', $email);
					$this->info = $this->UsersModel->getInfo($email);
					$this->session->set_userdata('name', $this->info['name']);
					$this->session->set_userdata('id', $this->info['id']);
					$this->postView();
				}
				else{
					$this->load->helper('form');
					$this->data['note'] = "email is used before";
					$this->load->view('users/register_view',$this->data);
				}
		    }
			else{
				$this->load->helper('form');
				$this->load->view('users/register_view'); 
			}
		}
	
		public function deletePost()
		{
			if(isset($_SESSION['email'])){
				$post_id = $this->uri->segment(3);
				$user_id = $this->uri->segment(4);
				if($user_id == $this->session->id)
				{
					$this->PostsModel->deletePost($post_id);
					$this->postView();
				}
				else
				{
					$this->postView();
				}
			}
			else
			{
				$this->postView();
			}
		}
		
		public function deleteComment()
		{
			if(isset($_SESSION['email'])){
				$comment_id = $this->uri->segment(3);
				$user_id = $this->uri->segment(4);
				if($user_id == $this->session->id)
				{
					$this->CommentsModel->deleteComment($comment_id);
					$this->postView();
				}
				else
				{
					$this->postView();
				}
			}
			else
			{
				$this->postView();
			}
		}
		
		public function comment()
		{
			
			if(isset($_SESSION['email']))
			{
				$this->form_validation->set_rules('comment', 'Comment', 'required');
				if ($this->form_validation->run() == TRUE)
				{
					$post_id = $this->uri->segment(3);
					$comment = $_POST['comment'];
					$user_id = $this->session->id;
					$this->CommentsModel->addComment($post_id,$comment,$user_id);
					$this->postView();
				}
				else
				{
					$this->postView();
				}
			}
			else
			{
				$this->postView();
			}
			
		}
	
		public function upload()
		{
			
		}
	}
?>
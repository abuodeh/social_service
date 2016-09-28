<?php 

	class UsersController extends CI_Controller
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

		/*
		    check the session if it exist to view the post page otherwise the login page
			@author Soad Abuodeh
		*/
		public function index()
		{
			if(isset($_SESSION['email'])){
				$this->postView();
			}
			else{
				$this->load->view('users/login-view');
			}

		}
		
		/*
		    check the session if it exist to view the post page with posts and comment otherwise the login page
			@author Soad Abuodeh
		*/
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
		
		/*
		    get email and password from user and check it if it true set the sessions and view the post page
			else view again the login page
			@author Soad Abuodeh
		*/
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
		
		/*
		    unset the sessions and view the login page
			@author Soad Abuodeh
		*/
		public function logOut()
		{
			unset(
					$_SESSION['email'],
					$_SESSION['name'],
					$_SESSION['id']
			);
			$this->load->view('users/login-view');
		}
		
		/*
		    check the session if it exist to view the post page otherwise the register page
			@author Soad Abuodeh
		*/
		public function registerView()
		{	
			if(isset($_SESSION['email'])){
				$this->postView();
			}
			else{
				$this->load->view('users/register_view'); 
			}
			
		}
		
		/*
		    get email,password and user name from user and insert it to DB 
			@author Soad Abuodeh
		*/
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
	
	}
?>
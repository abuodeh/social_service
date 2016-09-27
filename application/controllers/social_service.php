<?php 

	class Social_service extends CI_Controller
	{
		function __construct()
        {
            parent::__construct();
			$this->load->database();
            $this->load->model('social_service_model');
			$this->load->library('session');
			$this->load->helper('form');
			$this->load->library('session');
			$this->load->library('form_validation');

        }

		public function index()
		{
			if(isset($_SESSION['email'])){
				$this->post_view();
			}
			else{
				$this->load->view('login-view');
			}

		}
		
		public function post_view()
		{
			if(isset($_SESSION['email'])){
				$this->data['posts'] = $this->social_service_model->get_posts();
				$this->data['comments'] = $this->social_service_model->get_comments();
				$this->load->view('posts_view',$this->data);
			}
			else{
				$this->load->view('login-view');
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
			    $this->check = $this->social_service_model->login($email,$password);
				if($this->check == "true")
				{
					$this->session->set_userdata('email', $email);
					$this->info = $this->social_service_model->get_info($email);
					$this->session->set_userdata('name', $this->info['name']);
					$this->session->set_userdata('id', $this->info['id']);
					$this->post_view();
				}
				else{
					if(isset($_SESSION['email'])){
						$this->post_view();
					}
					else{
						$this->data['note'] = "Email or Password incorrect";
						$this->load->view('login-view',$this->data);
					}
				}
			 }
			 else
			 {
					if(isset($_SESSION['email'])){
					$this->post_view();
					}
					else{
						$this->load->view('login-view');
					}
			 }
			
		}
		
		public function log_out()
		{
			unset(
					$_SESSION['email'],
					$_SESSION['name'],
					$_SESSION['id']
			);
			$this->load->view('login-view');
		}
		
		public function register_view()
		{	
			if(isset($_SESSION['email'])){
				$this->post_view();
			}
			else{
				$this->load->view('register_view'); 
			}
			
		}
	
		public function post()
		{
			$this->form_validation->set_rules('post', 'Post', 'required');
			if ($this->form_validation->run() == TRUE)
			 {
				 $post=$_POST['post'];
				 $this->social_service_model->add_post($post);
				 $this->post_view();
			 }
			else{
				$this->post_view();
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
				$this->check = $this->social_service_model->register($name,$email,$password);
				if($this->check == "true")
				{
					$this->session->set_userdata('email', $email);
					$this->info = $this->social_service_model->get_info($email);
					$this->session->set_userdata('name', $this->info['name']);
					$this->session->set_userdata('id', $this->info['id']);
					$this->post_view();
				}
				else{
					$this->load->helper('form');
					$this->data['note'] = "email is used before";
					$this->load->view('register_view',$this->data);
				}
		    }
			else{
				$this->load->helper('form');
				$this->load->view('register_view'); 
			}
		}
	
		public function delete()
		{
			if(isset($_SESSION['email'])){
				$post_id = $this->uri->segment(3);
				if($post_id == $this->session->id)
				{
					$this->social_service_model->delete_post($post_id);
					$this->post_view();
				}
				else
				{
					$this->post_view();
				}
			}
			else
			{
				$this->post_view();
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
					$this->social_service_model->add_comment($post_id,$comment,$user_id);
					$this->post_view();
				}
				else
				{
					$this->post_view();
				}
			}
			else
			{
				$this->post_view();
			}
			
		}
	}
?>
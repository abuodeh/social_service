<?php 

	class PlogsController extends CI_Controller
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
		
		
		
		public function logOut()
		{
			unset(
					$_SESSION['email'],
					$_SESSION['name'],
					$_SESSION['id']
			);
			$this->load->view('users/login-view');
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
			if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
				
				if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					 $insertUserData = $this->PostsModel->insert_image($Picture);
                }else{
                    $picture = '';
                }
            }else{
                $picture = '';
				echo "1";
            }
			$this->postView();
		}
	}
?>
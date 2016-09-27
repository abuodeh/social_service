<?php
	class Social_service_model extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
        }

		public function login($email,$password)
		{
			$this->db->select('count(*)'); 
			$this->db->from('information');
			$this->db->where('email',$email);
			$this->db->where('password',$password);
			$query=$this->db->get();
			$query = $query->row_array();
			
			if ($query['count(*)'] == 1) {
				return "true";
			} else {
				return "false";
			}
		}

		public function register($name,$email,$password)
		{
			
			if($this->check_email($email))
			{
				$this->name = $name;
				$this->email = $email;
				$this->password = $password;
				$result = $this->db->insert('information', $this);
				if ($result) {
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		
		public function check_email($email)
		{
			$this->db->select('count(*)'); 
			$this->db->from('information');
			$this->db->where('email',$email);
			$query=$this->db->get();
			$query = $query->row_array();
			
			if ($query['count(*)'] == 1) {
				return false;
			} else {
				return true;
			}
		}
		
		public function add_post($post)
		{
				$this->user_id = $this->session->id;
				$this->post = $post;
				$result = $this->db->insert('posts', $this);
				if ($result) {
					return true;
				}
				else{
					return false;
				}
		}
		
		public function get_info($email)
		{
			$this->db->select('id,name'); 
			$this->db->from('information');
			$this->db->where('email',$email);
			$query=$this->db->get();
			$query = $query->row_array();
			return $query;
		}
	
		public function get_posts()
		{
			$query = $this->db->query('SELECT posts.post,posts.id,posts.time,posts.user_id,
										information.name
										FROM posts
										INNER JOIN information
										ON posts.user_id=information.id
										order by posts.id DESC;');
			$query = $query->result_array();
			return $query;
			
		}
		
		public function get_comments()
		{
			$query = $this->db->query('SELECT comments.comment,comments.post_id,comments.id,comments.time,comments.user_id,
										information.name
										FROM comments
										INNER JOIN information
										ON comments.user_id=information.id
										order by comments.id DESC;');
			$query = $query->result_array();
			return $query;
		}
		
		public function get_user_name($id)
		{
			$this->db->select('name'); 
			$this->db->from('information');
			$this->db->where('id',$id);
			$query=$this->db->get();
			$query = $query->row_array();
			return $query;
		}
	
		public function delete_post($post_id)
		{
			$this->db->where('id', $post_id);
			$this->db->delete('posts');
			$this->db->where('post_id', $post_id);
			$this->db->delete('comments');			
		}
		
		public function add_comment($post_id,$comment,$user_id)
		{
			$this->user_id = $user_id;
			$this->comment = $comment;
			$this->post_id = $post_id;
			
			$result = $this->db->insert('comments', $this);
			if ($result) {
				return true;
			}
			else{
				return false;
			}
		}
	}
?>
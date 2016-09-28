<?php	
	class PostsModel extends CI_Model
	{
		protected $table_users = 'information';
		public function __construct()
        {
            parent::__construct();
        }
		
		/*
		    add post to the database
			parameter $post string
			return boolean value (true if there's no error while adding to DB)
			@author Soad Abuodeh
		*/
		public function addPost($post)
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
	
		/*
		    Get all posts in the database 
			Return query array for the result
			@author Soad Abuodeh
		*/
		public function getPosts()
		{
			$query = $this->db->query('SELECT posts.post,posts.check_image,posts.image,posts.id,posts.time,posts.user_id,'.
										$this->table_users.'.name
										FROM posts
										INNER JOIN '.$this->table_users.'
										ON posts.user_id='.$this->table_users.'.id
										order by posts.id DESC;');
			$query = $query->result_array();
			return $query;
			
		}
		
		/*
		    delete the post in the database by his id all comments for this post
			parameter $post_id integer
			@author Soad Abuodeh
		*/
		public function deletePost($post_id)
		{
			//check if the post image or not
			$this->db->select('check_image,image'); 
			$this->db->from('posts');
			$this->db->where('id',$post_id);
			$query=$this->db->get();
			$query = $query->row_array();
			if($query['check_image'] == 1)
			{
				unlink("uploads/images/".$query['image']);
			}
			$this->db->where('id', $post_id);
			$this->db->delete('posts');
			
			$this->db->where('post_id', $post_id);
			$this->db->delete('comments');			
		}
		
		/*
		    insert the image name to the DB 
			parameter $picture string 
			@author Soad Abuodeh
		*/
		public function insert_image($picture)
		{
			$this->user_id = $this->session->id;
			$this->check_image = 1;
			$this->image = $picture;
			
			$insert = $this->db->insert('posts',$this);
		}
					
	}
?>
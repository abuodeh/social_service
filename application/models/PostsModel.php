<?php	
	class PostsModel extends CI_Model
	{
		protected $table_users = 'information';
		public function __construct()
        {
            parent::__construct();
        }
		
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
	
		public function getPosts()
		{
			$query = $this->db->query('SELECT posts.post,posts.id,posts.time,posts.user_id,'.
										$this->table_users.'.name
										FROM posts
										INNER JOIN '.$this->table_users.'
										ON posts.user_id='.$this->table_users.'.id
										order by posts.id DESC;');
			$query = $query->result_array();
			return $query;
			
		}
	
		public function deletePost($post_id)
		{
			$this->db->where('id', $post_id);
			$this->db->delete('posts');
			$this->db->where('post_id', $post_id);
			$this->db->delete('comments');			
		}
		
					
	}
?>
<?php
	class CommentsModel extends CI_Model
	{
		
		protected $table_users = 'information';
		public function __construct()
        {
            parent::__construct();
        }

		/*
		    Get all comments in the database 
			Return query array for the result
			@author Soad Abuodeh
		*/
		public function getComments()
		{
			$query = $this->db->query('SELECT comments.comment,comments.post_id,comments.id,comments.time,comments.user_id,
										'.$this->table_users.'.name
										FROM comments
										INNER JOIN '.$this->table_users.'
										ON comments.user_id='.$this->table_users.'.id
										order by comments.id DESC;');
			$query = $query->result_array();
			return $query;
		}
		
		/*
		    delete the comment in the database by his id
			parameter $comment_id integer
			@author Soad Abuodeh
		*/
		public function deleteComment($comment_id)
		{
			$this->db->where('id', $comment_id);
			$this->db->delete('comments');			
		}
		
		/*
		    add comment to the database
			parameter $post_id integer
					  $comment text
					  $user_id integer
			return boolean value (true if there's no error while adding to DB)
			@author Soad Abuodeh
		*/
		public function addComment($post_id,$comment,$user_id)
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
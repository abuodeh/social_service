<?php
	class UsersModel extends CI_Model
	{
		protected $table_users = 'information';
		public function __construct()
        {
            parent::__construct();
        }

		public function login($email,$password)
		{
			$this->db->select('count(*)'); 
			$this->db->from($this->table_users);
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
			
			if($this->checkEmail($email))
			{
				$this->name = $name;
				$this->email = $email;
				$this->password = $password;
				$result = $this->db->insert($this->table_users, $this);
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
		
		public function checkEmail($email)
		{
			$this->db->select('count(*)'); 
			$this->db->from($this->table_users);
			$this->db->where('email',$email);
			$query=$this->db->get();
			$query = $query->row_array();
			
			if ($query['count(*)'] == 1) {
				return false;
			} else {
				return true;
			}
		}
		
		public function getInfo($email)
		{
			$this->db->select('id,name'); 
			$this->db->from($this->table_users);
			$this->db->where('email',$email);
			$query=$this->db->get();
			$query = $query->row_array();
			return $query;
		}
	
		public function getUserName($id)
		{
			$this->db->select('name'); 
			$this->db->from($this->table_users);
			$this->db->where('id',$id);
			$query=$this->db->get();
			$query = $query->row_array();
			return $query;
		}
	
		
	}
?>
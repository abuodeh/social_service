<?php
	class UsersModel extends CI_Model
	{
		protected $table_users = 'information';
		public function __construct()
        {
            parent::__construct();
        }

		/*
		    check the informations for the user (email and password ) if they exist in the DB or not
			parameter $email string
			parameter $password string
			return boolean value (true if the email or password incorrect)
			@author Soad Abuodeh
		*/
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

		/*
		    insert the informations for the new user (email and password and his name) to the DB
			parameter $email string
			parameter $name string
			parameter $password string
			return boolean value (false if error happened while insert)
			@author Soad Abuodeh
		*/
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
		
		/*
		    check the email if exist in the DB or not
			parameter $email string
			return boolean value (true if email exist and false otherwise)
			@author Soad Abuodeh
		*/
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
		
		/*
		    get the information for the user by his email from the DB
			parameter $email string
			return query as array to the result
			@author Soad Abuodeh
		*/
		public function getInfo($email)
		{
			$this->db->select('id,name'); 
			$this->db->from($this->table_users);
			$this->db->where('email',$email);
			$query=$this->db->get();
			$query = $query->row_array();
			return $query;
		}
		
		/*
		    get user name by his id from the DB
			parameter $id integer
			return query as array to the result
			@author Soad Abuodeh
		*/
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
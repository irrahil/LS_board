<?php
class lars_user_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	//Получение пользователя по его логину
	public function get_user($userlogin, $userpass) {
		$hash_pass = hash("sha256", $userpass);
		$query = $this->db->get_where('users', array('user_login' => $userlogin, 'user_pass' => $hash_pass) );
		return $query->row_array();
	}
	
	//Регистрация пользователя в системе
	public function reg_user($userlogin, $userpass, $email, $username = NULL) {
	
	}
}


?>
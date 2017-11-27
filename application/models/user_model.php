<?php
class user_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	
	
	//Регистрация пользователя в системе
	public function reg_user($userlogin, $userpass, $email, $username = NULL, $isadmin = false) {
		$this->db->set('user_login', base64_encode($userlogin) );
		$this->db->set('user_pass', hash('sha256', $userpass + $userlogin, false) );
		if ($username != NULL )
			$this->db->set('user_name', base64_encode($username) );
		$this->db->set('user_email', base64_encode($email) );
		
		if ($this->config->item('app_group_mode') ) 
			$this->db->set('is_admin', $isadmin);
		$query = $this->db->insert('users');
		if ($query = 1)
			return true;
		return false;
	}
	
	
	
	//Проверка пользователя с данными логином и паролем
	public function check_user($userlogin, $userpass) {
		$query_cond = array(
							'user_login' => base64_encode($userlogin),
							'user_pass'  => hash('sha256', $userpass + $userlogin, false)
							);
		$query = $this->db->get_where('users', $query_cond);
		if (count($query->result() ) > 0 ) {
			return true;
		}
		return false;
	}
	
	
	
	//Получение идентификатора пользователя
	public function get_user_id($userlogin) {
		$query_cond = array('user_login' => base64_encode($userlogin) );
		$query = $this->db->get_where('users', $query_cond);
		if (count($query->result() ) == 1 ) {
			return $query->result()[0]->user_id;
		}
		return -1;
	}
	
	
	
	//Отправка запроса на восстановление через email
	public function restore_pass_req($userlogin, $email) {
		$query_cond = array(
							'user_login' => base64_encode($userlogin),
							'user_email'  => base64_encode($email)
							);
		$query = $this->db->get_where('users', $query_cond);
		if (count($query->result() ) > 0 ) {
			//TODO Отправка запроса на восстановление через email
			return true;
		}
		return false;
	}
	
	
	
	//Восстановление доступа через email
	public function restore_pass($userlogin, $token, $userpass) {
		//TODO восстановление доступа через email
	}
	
	
	
	//Изменение данных пользователя
	public function edit_user_info($user_id, $userlogin = null, $userpass = null, $email = null, $name = null, $isadmin = false) {
		if ($userlogin != null)
			$this->db->set('user_login', base64_encode($userlogin) );
		if ($userpass != null AND $userlogin != null)
			$this->db->set('user_pass', hash('sha256', $userpass + $userlogin, false) );
		if ($email != null)
			$this->db->set('user_email', base64_encode($email) );
		if ($name != null)
			$this->db->set('user_name', base64_encode($name) );
		
		if ($this->config->item('app_group_mode') ) 
			$this->db->set('is_admin', $isadmin);
		$this->db->where('user_id', $user_id);
		$res = $this->db->update('users');
		if ($res == 1)
			return true;
		return false;
	}
	
	
	
	//Получение данных о пользователе
	public function get_user_info($user_id = null, $last = false) {
		if ($user_id != null)
			$this->db->where('user_id', $user_id);
		if ($last) {
			$this->db->order_by('user_id', 'DESC');
		}
		else
			$this->db->order_by('user_id', 'ASC');
		$res = $this->db->get('users')->result();
		$data = array();
		foreach ($res as $res_str) {
			$obj = array(
						'user_id' 			=> $res_str->user_id,
						'user_login' 		=> base64_decode($res_str->user_login),
						'user_name' 		=> base64_decode($res_str->user_name),
						'user_email'		=> base64_decode($res_str->user_email)
						);
			if ($this->config->item('app_group_mode') ) 
				$obj['is_admin'] = $res_str->is_admin;
			array_push($data, $obj);
		}
		return $data;
	}
	
	
	public function delete_user($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->delete('users');
	}
}


?>
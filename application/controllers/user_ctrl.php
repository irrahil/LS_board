<?php
define('VERIFY_CODE', '56f47bae13');

class user_ctrl extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}
	
	
	public function view($page = 'login_view', $data = NULL ) {
		if ($data == NULL) 
			$data = array();
		#print_r($data);
		if ($this->session->user_name)
			$data['username'] = $this->session->user_name;
		//drawing form
        $this->load->view('templates/header_view', $data);
		if ($this->session->user_id != false) 
			$this->load->view('templates/menu_view', $data);
        $this->load->view('user_module/'.$page, $data);
        $this->load->view('templates/footer_view', $data);
	}
	
	
	
	
	////////////////////////////////////////////////////////////////////////////////////////
	//		ОБРАБОТЧИКИ
	
	
	#public function registry($username, $userpass, $email, $verify_code, $name = NULL) {
	public function reg_user() {
		#echo 'enter reg_user';
		$username = $this->input->post('username');
		$userpass = $this->input->post('password');
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$verify_code = $this->input->post('verify_code');
		$passhash = hash('sha256', $userpass + $username, false);
		#print($username);
		if ($verify_code !== VERIFY_CODE)
			return;
		$result = $this->user_model->reg_user($username, $passhash, $email, $name);
		if (!$result) {
			$this->view('error_registry');
		}
		else {
			$data['reg_success'] = true;
			$data['reg_username'] = $username;
			$this->view('main', $data);
		}
	}
	
	
	
	//Функция входа в систему
	public function login() {
		$username = $this->input->post('username');
		$userpass = $this->input->post('userpass');
		$passhash = hash('sha256', $userpass + $username, false);
		if ($this->user_model->check_user($username, $passhash) ) {
			$user_id =  $this->user_model->get_user_id($username);
			$this->session->set_userdata('user_id', $user_id);
			$this->session->set_userdata('user_name', $this->user_model->get_user_info($user_id)['name'] );
			header("Location: /index.php/board");
		}
		else {
			$data['login_failed'] = true;
			$this->view('main', $data);
		}
	}
	
	
	//Функция запроса на восстановление пароля
	public function restore_pass_req() {
		$username 	= $this->input->post('username');
		$email		= $this->input->post('email');
		
	}
	
	
	//Функция восстановления пароля
	public function restore_pass() {
		
	}
	
	
	//Изменение данных о пользователе
	public function edit_user_info() {
		$cur_user_id	=	$this->session->user_id;
		if ($cur_user_id == false)
			return;
		if ($this->input->post('userlogin_edit') )
			$userlogin = $this->input->post('userlogin');
		else
			$userlogin = null;
		if ($this->input->post('userpass_edit') )
			$userpass = hash('sha256', $this->input->post('userpass') );
		else
			$userpass = null;
		if ($this->input->post('email_edit') )
			$email = $this->input->post('email');
		else
			$email = null;
		if ($this->input->post('name_edit') )
			$name = $this->input->post('name');
		else
			$name = null;
		
		
		$res = $this->user_model->edit_user_info($cur_user_id, $userlogin, $userpass, $email, $name);
		if (!$res) {
			$form_data = $this->user_model->get_user_id($cur_user_id);
			$form_data['error'] = 'Ошибка при редактировании данных. Попробуйте позже! ';
			$this->view('user_view', $form_data);
		}
		else
			$this->get_user_info();
	}
	
	
	
	public function get_user_info() {
		$cur_user_id	=	$this->session->user_id;
		#print_r($cur_user_id);
		if ($cur_user_id != false) {
			$this->view('user_view', $this->user_model->get_user_info($cur_user_id) );  
		}
	}
	
}

?>
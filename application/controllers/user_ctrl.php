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
		$data['app_group_mode'] = $this->config->item('app_group_mode');
		if ($this->session->user_name)
			$data['username'] = $this->session->user_name;
		if ($this->session->admin)
			$data['admin']	= true;
		//drawing form
        $this->load->view('templates/Header_view', $data);
		if ($this->session->user_id != false) {
			if ($page == 'login_view')
				header("Location: /board");
			$this->load->view('templates/Menu_view', $data);
		}
        $this->load->view('user_module/'.ucfirst($page), $data);
        $this->load->view('templates/Footer_view', $data);
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
		#print($username);
		if ($verify_code !== VERIFY_CODE) {
			$this->view('error_registry_view');
			return;
		}
		$result = $this->user_model->reg_user($username, $userpass, $email, $name);
		if (!$result) {
			$this->view('error_registry_view', null);
		}
		else {
			$data['reg_success'] = true;
			$data['reg_username'] = $username;
			$this->view('login_view', $data);
		}
	}
	
	
	
	//Функция входа в систему
	public function login() {
		$username = $this->input->post('username');
		$userpass = $this->input->post('userpass');
		if ($this->user_model->check_user($username, $userpass) ) {
			$user_id =  $this->user_model->get_user_id($username);
			$user_info = $this->user_model->get_user_info($user_id)[0];
			$this->session->set_userdata('user_id', $user_id);
			$this->session->set_userdata('user_name', $user_info['user_name'] );
			if ($this->config->item('app_group_mode') )
				$this->session->set_userdata('admin', $user_info['is_admin']);
			header("Location: /board");
		}
		else {
			$data['login_failed'] = true;
			$this->view('login_view', $data);
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
			$userpass = $this->input->post('userpass');
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
			$userdata = $this->user_model->get_user_info($cur_user_id)[0];
			$data = array();
			$data['user_id'] = $userdata['user_id'];
			$data['userlogin'] = $userdata['user_login'];
			$data['email'] = $userdata['user_email'];
			$data['user_name'] = $userdata['user_name'];
			$this->view('user_view', $data );  
		}
	}
	
	
	public function exit_from_app() {
		$this->session->sess_destroy();
		header("Location: /");
	}
	
}

?>
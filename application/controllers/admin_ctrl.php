<?php

class admin_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('admin_model');
		$this->load->model('board_model');
		$this->load->model('user_model');
	}
	
	
	public function view($page = 'admin_panel', $data = NULL) {
		$module = 'admin_module';
		if ($data == NULL) 
			$data = array();
		$data['app_group_mode'] = $this->config->item('app_group_mode');
		if (!$this->config->item('app_group_mode') ) {
			header("Location: /");
			exit;
		}
		if ($this->session->user_name)
			$data['username'] = $this->session->user_name;
		if (!$this->session->admin) {
			header("Location: /");
			exit;
		}
		
		if ($page == 'new_user_view') {
			
		}
		if ($page == 'edit_user_view') {
			$params['user_id'] = $this->input->get('user_id');
			$data['user'] = $this->user_model->get_user_info($params['user_id']);
		}
		if ($page == 'users_list_view') {
			$data['users'] = $this->user_model->get_user_info();
		}
		
		if ($page == 'new_group_view') {
			$data['user_list'] = $this->user_model->get_user_info();
		}
		if ($page == 'edit_group_view') {
			$params['group_id'] = $this->input->get('group_id');
			$data['user_list'] = $this->user_model->get_user_info();
			$data['group'] = $this->admin_model->work_group('get', $params);
		}
		if ($page == 'groups_list_view') {
			$params['group_only'] = true;
			$data['groups'] = $this->admin_model->work_group('get', $params);
		}
		
		if ($page == 'new_status') {
			$module = 'board_module';
			$page = 'new_status_view';
		}
		if ($page == 'statuses') {
			$module = 'board_module';
			$page = 'status_list_view';
			$data['status_list'] = $this->board_model->work_status('get');
		}
		if ($page == 'status') {
			$module = 'board_module';
			$page = 'edit_status_view';
			$params['status_id'] = $this->input->get('status_id');
			$data['status_info'] = $this->board_model->work_status('get', $params);
		}
		
		
		if ($page == 'admin_panel_view') {
			$data['monitor'] = $this->admin_model->work_monitor('get');
		}
		
        $this->load->view('templates/header_view', $data);
		$this->load->view('templates/admin_menu_view', $data);
		$this->load->view($module.'/'.$page, $data);
        $this->load->view('templates/footer_view', $data);
	}
	
	
	
	/////////////////////////////////////////////////////////////////////////////
	//				ОБРАБОТЧИКИ
	
	private function check_admin_access() {
		//Выкидывает в главное меню, если текущий пользователь не является администратором
		if (empty($this->session->user_id) ) {
				header("Location: /");
				exit;
			}
			#$params['user_id'] = $this->session->user_id;
			if (!$this->user_model->get_user_info($this->session->user_id)[0]['is_admin'] ) {
				header("Location: /");
				exit;
			}
			return true;
	}
	
	
	public function admin_new_user() {
		$this->check_admin_access();
		$params['user_login'] 	= $this->input->post('user_login');
		$params['user_pass'] 	= $this->input->post('user_pass');
		$params['user_email'] 	= $this->input->post('user_email');
		$params['user_name'] 	= $this->input->post('user_name');
		$params['is_admin']		= $this->input->post('is_admin');
		if ($params['is_admin'] == null)
			$params['is_admin'] = false;
		$this->user_model->reg_user($params['user_login'], $params['user_pass'], $params['user_email'], $params['user_name'], $params['is_admin']);
		header("Location: /users");
	}
	
	public function admin_edit_user() {
		$this->check_admin_access();
		$params['user_id']			= $this->input->post('user_id');
		$edit_login 	= $this->input->post('userlogin_edit');
		$edit_pass 		= $this->input->post('userpass_edit');
		$edit_email		= $this->input->post('email_edit');
		$edit_name		= $this->input->post('name_edit');
		$edit_admin		= $this->input->post('is_admin_edit');
		print_r($edit_admin == "true");
		if ($edit_login == "true")
			$params['user_login'] 	= $this->input->post('user_login');
		else
			$params['user_login'] 	= null;
		if ($edit_pass == "true")
			$params['user_pass'] 	= $this->input->post('user_pass');
		else
			$params['user_pass'] 	= null;
		if ($edit_email == "true")
			$params['user_email'] 	= $this->input->post('user_email');
		else
			$params['user_email'] 	= null;
		if ($edit_name == "true")
			$params['user_name'] 	= $this->input->post('user_name');
		else
			$params['user_name'] 	= null;
		if ($edit_admin == "true")
			$params['is_admin']		= $this->input->post('is_admin');
			if ($params['is_admin'] == 'on')
				$params['is_admin'] = true;
		else
			$params['is_admin'] 	= false;
		$this->user_model->edit_user_info($params['user_id'], $params['user_login'], $params['user_pass'], $params['user_email'], $params['user_name'], $params['is_admin']);
		header("Location: /users");
	}
	
	public function admin_delete_user() {
		$this->check_admin_access();
		$params['user_id']			= $this->input->get('user_id');
		$this->user_model->delete_user($params['user_id']);
		header("Location: /users");
	}
	
	
	
	public function admin_new_group() {
		$this->check_admin_access();
		$params['group_name'] = $this->input->post('group_name');
		$params['role_users'] = $this->input->post('role_users');
		$this->admin_model->work_group('new', $params);
		header("Location: /groups");
	}
	
	public function admin_edit_group() {
		$this->check_admin_access();
		$params['group_id']	  = $this->input->post('group_id');
		$params['group_name'] = $this->input->post('group_name');
		$params['role_users'] = $this->input->post('role_users');
		$this->admin_model->work_group('edit', $params);
		header("Location: /groups");
	}
	
	public function admin_delete_group() {
		$this->check_admin_access();
		$params['group_id']	  = $this->input->get('group_id');
		$this->admin_model->work_group('delete', $params);
		header("Location: /groups");
	}
}

?>
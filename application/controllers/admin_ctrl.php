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
	
}

?>
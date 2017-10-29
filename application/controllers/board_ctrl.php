<?php

class board_ctrl extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('board_model');
	}
	
	
	
	public function view($page = 'main_view', $data = NULL) {
		
		if ($data == NULL) 
			$data = array();
		#print_r($data);
		if ($this->session->user_name)
			$data['username'] = $this->session->user_name;
		//drawing form
        $this->load->view('templates/header_view', $data);
		if ($this->session->user_id != false) 
			$this->load->view('templates/menu_view', $data);
		if ($page == 'new_task_view') {
			$data['categories'] = $this->board_model->work_category('get');
		}
        $this->load->view('board_module/'.$page, $data);
        $this->load->view('templates/footer_view', $data);
		
	}
	
	
	public function add_new_task() {
			$params = array();
			$params['task_name'] 		= $this->input->post('taskname');
			if ($this->input->post('taskcategory') !== 0)
				$params['task_cat'] 	= $this->input->post('taskcategory');
			$params['task_priority']	= $this->input->post('taskpriority');
			$cmd = 'new';
			$this->board_model->work_task($cmd, $params);
		header("Location: /index.php/board");
	}
	
	
	
	public function edit_task() {
		
	}
	
	
	
	public function delete_task() {
		
	}
	
	
	
	public function add_new_category() {
		$params = array();
		$params['category'] = $this->input->post('categoryname');
		$cmd = 'new';
		$this->board_model->work_category($cmd, $params);
		header("Location: /index.php/board");
	}
	
	
	
	
	public function edit_category() {
		
	}
	
	
	
	
	public function delete_category() {
		
	}
	
	
	
	public function add_new_schedule() {
		
	}
	
	
	
	
	public function edit_schedule() {
		
	}
	
	
	
	
	public function delete_schedule() {
		
	}
	
	
	
	public function add_new_status() {
		$params = array();
		$params['statusname'] = $this->input->post('statusname');
		$params['color'] = $this->input->post('statuscolor');
		$cmd = 'new';
		$this->board_model->work_status($cmd, $params);
		header("Location: /index.php/board");
	}
	
	
	
	
	public function edit_status() {
		
	}
	
	
	
	
	public function delete_status() {
		
	}
}

?>
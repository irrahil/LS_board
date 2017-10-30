<?php

class board_ctrl extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('board_model');
		$this->load->model('user_model');
	}
	
	
	
	public function view($page = 'main_view', $data = NULL) {
		
		if ($data == NULL) 
			$data = array();
		
		if ($this->session->user_name)
			$data['username'] = $this->session->user_name;
		//drawing form
        $this->load->view('templates/header_view', $data);
		if ($this->session->user_id != false) 
			$this->load->view('templates/menu_view', $data);
		
		if ($page == 'new_task_view') {
			$data['categories'] = $this->board_model->work_category('get');
		}
		if ($page == 'new_category_view') {
				$data['user_list'] = $this->user_model->get_user_info();
		}
		
		
        $this->load->view('board_module/'.$page, $data);
        $this->load->view('templates/footer_view', $data);
		
	}
	
	
	
	////////////////////////////////////////////////////////////////////////////////////
	//				ОБРАБОТЧИКИ
	
	
	public function add_new_task() {
			$params = array();
			$params['task_name'] 		= $this->input->post('taskname');
			if ($this->input->post('taskcategory') !== 0)
				$params['task_category'] 	= $this->input->post('taskcategory');
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
		$params['category_name'] = $this->input->post('categoryname');
		if ($this->input->post('categoryaccess') != NULL )
			$params['category_access'] = $this->input->post('categoryaccess');
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
		$params['status_name'] = $this->input->post('statusname');
		$params['status_color'] = $this->input->post('statuscolor');
		$cmd = 'new';
		$this->board_model->work_status($cmd, $params);
		header("Location: /index.php/board");
	}

	public function edit_status() {
		
	}

	public function delete_status() {
		
	}
	
	
	
	public function add_board_entry() {
		
	}
	
	public function edit_board_entry() {
		
	}
	
	public function delete_board_entry() {
		
	}
}

?>
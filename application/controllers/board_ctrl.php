<?php

class board_ctrl extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('board_model');
	}
	
	
	
	public function view($page = 'board', $data = NULL) {
		
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
}

?>
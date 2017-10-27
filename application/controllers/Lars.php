<?php
class Lars extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->session->set_userdata('ip', $this->input->ip_address() );
	}
	
	public function view($page = 'main') {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
			show_404();
        }
		
		
		//Отрисовка
        $this->load->view('templates/lars_header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/lars_footer', $data);
	}
}
?>

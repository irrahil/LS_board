<?php
define("SECURITY", true);

class board_ctrl extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('board_model');
		$this->load->model('user_model');
		if ($this->config->item('app_group_mode') )
			$this->load->model('admin_model');
		$this->load->helper('cookie');
	}
	
	
	
	private function make_cookie_name($page, $filter) {
		return $page + "_" + $filter;
	}
	
	
	private function make_filters($page_name, $params) {
		
		$d = date_create('now', new DateTimeZone('Europe/Moscow') );
		$day_begin 		= get_cookie($this->make_cookie_name($page_name, 'day_begin') );
		$day_end 		= get_cookie($this->make_cookie_name($page_name, 'day_end') );
		$time_begin 	= get_cookie($this->make_cookie_name($page_name, 'time_begin') );
		$time_end 		= get_cookie($this->make_cookie_name($page_name, 'time_end') );
		$user_name 		= get_cookie($this->make_cookie_name($page_name, 'user_name') );
		$category_name 	= get_cookie($this->make_cookie_name($page_name, 'category_name') );
		
		switch($page_name) {
			case 'board': {
				if (isset($day_begin) ) 
					$params['day_begin'] = $day_begin;
				if (isset($day_end) )
					$params['day_end']	= $day_end;
				if (isset($time_begin) )
					$params['time_begin'] = $time_begin;
				if (isset($time_end) )
					$params['time_end'] = $time_end;
				if (isset($user_name) )
					$params['user_name'] = $user_name;
				break;
			}
			default: break;
		}
	}
	
	
	
	public function view($page = 'main_view', $data = NULL) {
		
		if ($data == NULL) 
			$data = array();
		$data['app_group_mode'] = $this->config->item('app_group_mode');
		$data['small_style'] = false;
		$params = array();
		if ($this->session->user_name)
			$data['username'] = $this->session->user_name;
		if ($this->session->admin)
			$data['admin']	= true;
		//drawing form
        $this->load->view('templates/Header_view', $data);
		if ($this->session->user_id != false) 
			$this->load->view('templates/Menu_view', $data);
		else if (SECURITY) {
			header("Location: /");
			exit;
		}
		$this->load->view('templates/Header2_view', $data);
		
		if ($page == 'new_task_view') {
			$data['categories'] = $this->board_model->work_category('get');
		}
		if ($page == 'new_category_view') {
			$data['user_list'] = $this->user_model->get_user_info();
			if ($this->config->item('app_group_mode') ) {
				$params['group_only'] = true;
				$data['group_list'] = $this->admin_model->work_group('get', $params);
			}
		}
		
		if ($page == 'new_status_view') {
			if ($this->config->item('app_group_mode') ) {
				if ($this->session->admin)
					header('Location: /admin/new_status');
				else {
					header("Location: /");
					exit;
				}
			}
		}
		if ($page == 'status_list_view') {
			if ($this->config->item('app_group_mode') ) {
				if ($this->session->admin)
					header('Location: /admin/statuses');
				else {
					header("Location: /");
					exit;
				}
			}
			$data['status_list'] = $this->board_model->work_status('get');
		}
		if ($page == 'edit_status_view') {
			if ($this->config->item('app_group_mode') ) {
				if ($this->session->admin) {
					$params['status_id'] = $this->input->get('status_id');
					header('Location: /admin/status?status_id='.$params['status_id']);
				} else {
					header("Location: /");
					exit;
				}
			}
			$params['status_id'] = $this->input->get('status_id');
			$data['status_info'] = $this->board_model->work_status('get', $params);
		}
		
		if ($page == 'category_list_view') {
			$params['user_id'] = $this->session->user_id;
			$data['category_list'] = $this->board_model->work_category('get', $params);
		}
		if ($page == 'edit_category_view') {
			$params['category_id'] = $this->input->get('category_id');
			$params['user_id'] = $this->session->user_id;
			$data['category_info'] = $this->board_model->work_category('get', $params);
			$data['user_list'] = $this->user_model->get_user_info();
			if ($this->config->item('app_group_mode') ) {
				$params['group_only'] = true;
				$data['group_list'] = $this->admin_model->work_group('get', $params);
			}
		}
		
		if ($page == 'task_list_view') {
			$params['user_id'] = $this->session->user_id;
			$data['task_list'] = $this->board_model->work_task('get', $params);
		}
		if ($page == 'edit_task_view') {
			$params['user_id'] = $this->session->user_id;
			$params['task_id'] = $this->input->get('task_id');
			$data['task_info'] = $this->board_model->work_task('get', $params);
			$data['categories'] = $this->board_model->work_category('get');
			$data['statuses'] = $this->board_model->work_status('get');
		}
		
		
		if ($page == 'schedule_list_view') {
			$data['schedule_list'] = $this->board_model->work_schedules('get');
		}
		if ($page == 'edit_schedule_view') {
			$params['rec_id'] = $this->input->get('rec_id');
			$params['user_id'] = $this->session->user_id;
			$data['schedule_info'] = $this->board_model->work_schedules('get', $params);
		}
		
		
		if ($page == 'new_board_entry_view') {
			$data['status_list'] = $this->board_model->work_status('get');
			$params['user_id'] = $this->session->user_id;
			$data['schedule_list'] = $this->board_model->work_schedules('get', $params);
			$data['task_list'] = $this->board_model->work_task('get', $params);
		}
		if ($page == 'edit_board_entry_view') {
			$data['status_list'] = $this->board_model->work_status('get');
			$params['user_id'] = $this->session->user_id;
			$data['task_list'] = $this->board_model->work_task('get', $params);
			$data['schedule_list'] = $this->board_model->work_schedules('get', $params);
			$params['rec_id'] = $this->input->get('rec_id');
			$data['entry_info'] = $this->board_model->work_board_entry('get', $params);
		}
		
		
		if ($page == 'main_view') {
			$params = array();
			// if ($this->input->cookie('board_show_all_days') != null) {
				// $d = date_create('now', new DateTimeZone('Europe/Moscow') );
				// $d->modify("-3 day");
				// $params['day_begin'] = $d->format("Y-m-d");
				// $d->modify("+4 day");
				// $params['day_end'] =  $d->format("Y-m-d");
			// }
			//FILTERS
			$this->make_filters('board', $params);
			#$data['days'] = $this->board_model->work_board_entry('get', $params);
			#print_r($data['days']);
			#$params = array();
			$params['user_id'] = $this->session->user_id;
			$data['board_info'] = $this->board_model->work_board_entry('get', $params);
		}
		
		
		
		
        $this->load->view('board_module/'.ucfirst($page), $data);
        $this->load->view('templates/Footer_view', $data);
		
	}
	
	
	
	////////////////////////////////////////////////////////////////////////////////////
	//				ОБРАБОТЧИКИ
	
	
	public function add_new_task() {
		$params = array();
		$params['task_name'] 		= htmlspecialchars($this->input->post('taskname'), ENT_QUOTES);
		//if ($this->input->post('taskcategory') !== 0)
		$params['task_category'] 	= $this->input->post('taskcategory');
		$params['task_priority']	= $this->input->post('taskpriority');
		$this->board_model->work_task('new', $params);
		header("Location: /tasks");
	}
	
	public function edit_task() {
		$params = array();
		$params['task_name'] 		= htmlspecialchars($this->input->post('taskname'), ENT_QUOTES);
		//if ($this->input->post('taskcategory') !== 0)
		$params['task_category'] 	= $this->input->post('taskcategory');
		$params['task_priority']	= $this->input->post('taskpriority');
		$params['task_id']			= $this->input->post('task_id');
		if ($this->input->post('task_status') !== 0)
			$params['task_status']		= $this->input->post('task_status');
		$this->board_model->work_task('edit', $params);
		header("Location: /tasks");
	}
	
	public function delete_task() {
		$params['task_id'] = $this->input->get('task_id');
		$this->board_model->work_task('delete', $params);
		header("Location: /tasks");
	}
	
	
	
	public function add_new_category() {
		$params = array();
		$params['category_name'] = htmlspecialchars($this->input->post('categoryname'), ENT_QUOTES);
		if ($this->input->post('categoryaccess') != NULL )
			$params['category_access'] = $this->input->post('user_access');
		if ($this->config->item('app_group_mode') ) {
			if ($this->input->post('group_access') != NULL)
				$params['group_access'] = $this->input->post('group_access');
		}
		$params['user_id'] = $this->session->user_id;
		$cmd = 'new';
		$this->board_model->work_category($cmd, $params);
		header("Location: /categories");
	}
	
	public function edit_category() {
		$params = array();
		$params['category_name'] = htmlspecialchars($this->input->post('categoryname'), ENT_QUOTES);
		$params['category_id'] = $this->input->post('category_id');
		if ($this->input->post('categoryaccess') != NULL )
			$params['category_access'] = $this->input->post('categoryaccess');
		if ($this->config->item('app_group_mode') ) {
			if ($this->input->post('group_access') != NULL)
				$params['group_access'] = $this->input->post('group_access');
		}
		$params['user_id'] = $this->session->user_id;
		$this->board_model->work_category('edit', $params);
		header("Location: /categories");
	}
	
	public function delete_category() {
		$params['category_id'] = $this->input->get('category_id');
		$params['user_id'] = $this->session->user_id;
		$this->board_model->work_category('delete', $params);
		header("Location: /categories");
	}
	
	
	
	public function add_new_schedule() {
		$params['user_id'] = $this->session->user_id;
		//TODO валидация параметров даты / времени на корректность
		$params['schedule_date'] = $this->input->post('schedule_date');
		$params['schedule_time_begin'] = $this->input->post('schedule_time_begin');
		$params['schedule_time_end'] = $this->input->post('schedule_time_end');
		$params['comments']	= htmlspecialchars($this->input->post('comments'), ENT_QUOTES);
		#print_r($params);
		$this->board_model->work_schedules('new', $params);
		header("Location: /schedules");
	}
	
	public function edit_schedule() {
		if ($this->input->post('user_id') == $this->session->user_id)
			$params['user_id'] = $this->input->post('user_id');
		else
			return;
		//TODO валидация параметров даты / времени на корректность
		$params['schedule_date'] = $this->input->post('schedule_date');
		$params['schedule_time_begin'] = $this->input->post('schedule_time_begin');
		$params['schedule_time_end'] = $this->input->post('schedule_time_end');
		$params['comments']	= htmlspecialchars($this->input->post('comments'), ENT_QUOTES);
		$params['rec_id'] = $this->input->post('rec_id');
		#print_r($params);
		$this->board_model->work_schedules('edit', $params);
		header("Location: /schedules");
	}

	public function delete_schedule() {
		$params['user_id'] = $this->session->user_id;
		$params['rec_id'] = $this->input->get('rec_id');
		$this->board_model->work_schedules('delete', $params);
		header("Location: /schedules");
	}
	
	
	
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
	
	
	public function add_new_status() {
		if ($this->config->item('app_group_mode') ) {
			$this->check_admin_access();
		}
		$params = array();
		$params['status_name'] = htmlspecialchars($this->input->post('statusname'), ENT_QUOTES);
		$params['status_color'] = $this->input->post('statuscolor');
		$this->board_model->work_status('new', $params);
		header("Location: /statuses");
	}

	public function edit_status() {
		if ($this->config->item('app_group_mode') ) {
			$this->check_admin_access();
		}
		$params = array();
		$params['status_id'] = $this->input->post('statusid');
		$params['status_name'] = htmlspecialchars($this->input->post('statusname'), ENT_QUOTES);
		$params['status_color'] = $this->input->post('statuscolor');
		$this->board_model->work_status('edit', $params);
		header("Location: /statuses");
	}

	public function delete_status() {
		if ($this->config->item('app_group_mode') ) {
			$this->check_admin_access();
		}
		$params = array();
		$params['status_id'] = $this->input->get('status_id');
		$this->board_model->work_status('delete', $params);
		header("Location: /statuses");
	}
	
	
	
	public function add_board_entry() {
		$params['user_id'] = $this->session->user_id;
		$params['schedule_id'] = $this->input->post('schedule_id');
		$params['task_id']	= $this->input->post('task_id');
		$params['status_id'] = $this->input->post('status_id');
		$this->board_model->work_board_entry('new', $params);
		header("Location: /board");
	}
	
	public function edit_board_entry() {
		$params['user_id'] = $this->session->user_id;
		$params['schedule_id'] = $this->input->post('schedule_id');
		$params['task_id']	= $this->input->post('task_id');
		$params['status_id'] = $this->input->post('status_id');
		$params['rec_id']	= $this->input->post('rec_id');
		$this->board_model->work_board_entry('edit', $params);
		header("Location: /board");
	}
	
	public function delete_board_entry() {
		$params['rec_id']	= $this->input->get('rec_id');
		$params['user_id'] = $this->session->user_id;
		#print_r($params);
		$this->board_model->work_board_entry('delete', $params);
			header("Location: /board");
	}
	
	
	
	public function add_filter($page, $filter, $value) {
		set_cookie($this->make_cookie_name($page, $filter), $value, 3600, $this->config->base_url);
	}
}

?>
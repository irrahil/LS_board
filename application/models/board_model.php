<?php

class board_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	
	
	public function work_task($cmd, $params) {
		
	}
	
	
	
	public function work_category($cmd, $params) {
		
	}
	
	
	
	public function work_status($cmd, $params) {
		
		
	}
	
	
	
	public function work_schedules($cmd, $params) {
		
		
	}
	
	
	
	public function board($date_begin, $date_end, $user_id) {
		$this->db->select('board.rec_id, board.datetime_begin, board.datetime_end, users.user_name');
		$this->db->from('board');
		$this->db->where('datetime_begin >', $date_begin);
		$this->db->where('datetime_end <', $date_end);
		$this->db->join('users', 'users.user_id = board.user_id');
	}
}

?>
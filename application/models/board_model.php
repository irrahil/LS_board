<?php

class board_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	
	
	public function work_task($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				$this->db->set('task_name', base64_encode($params['task_name']) );
				$this->db->set('category', $params['task_cat'] );
				$this->db->set('task_priority', $params['task_priority'] );
				$this->db->insert('tasks');
				break;
			}
			
			case 'edit': {
				$this->db->set('task_name', base64_encode($params['task_name']) );
				$this->db->set('category', $params['task_cat'] );
				$this->db->set('task_priority', $params['task_priority'] );
				$this->db->set('task_status', $params['task_status'] );  
				$this->db->where('task_id', $params['id'] );
				$this->db->update('tasks');
				break;
			}
			
			
			case 'delete': {
				break;
			}
			
			case 'get': {
				if (isset($params['id']) )
					$this->db->where('task_id', $params['id']);
				break; 
			}
			
			default: break;
		}
	}
	
	
	
	public function work_category($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				$this->db->set('category_name', base64_encode($params['category']) );
				$this->db->insert('task_category');
				break;
			}
			
			case 'edit': {
				$this->db->set('category_name', base64_encode($params['category']) );
				$this->db->where('category_id', $params['id'] );
				$this->db->update('task_category');
				break;
			}
			
			
			case 'delete': {
				break;
			}
			
			case 'get': {
				if (isset($params['id']) )
					$this->db->where('category_id', $params['id']);
				if (isset($params['category']) )
					$this->db->where('category_name', base64_encode($params['category']) );
				$res = $this->db->get('task_category')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'category_id' => $res_str->category_id,
									'category_name' => base64_decode($res_str->category_name)
								);
					array_push($data, $obj);
				}
				return $data;
			}
			
			default: break;
		}
	}
	
	
	
	public function work_status($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				$this->db->set('status_name', base64_encode($params['statusname']) );
				$this->db->set('status_color', $params['color'] );
				$this->db->insert('statuses');
				break;
			}
			
			case 'edit': {
				$this->db->set('status_name', base64_encode($params['statusname']) );
				$this->db->set('status_color', $params['color'] );
				$this->db->where('status_id', $params['id'] );
				$this->db->update('statuses');
				break;
			}
			
			
			case 'delete': {
				break;
			}
			
			case 'get': {
				
			}
			
			default: break;
		}		
	}
	
	
	
	public function work_schedules($cmd, $params = null) {
		
		
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
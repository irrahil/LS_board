<?php

class board_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	
	
	public function work_task($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				$this->db->set('task_name', base64_encode($params['task_name']) );
				$this->db->set('task_category', $params['task_category'] );
				$this->db->set('task_priority', $params['task_priority'] );
				$this->db->insert('tasks');
				break;
			}
			
			case 'edit': {
				$this->db->set('task_name', base64_encode($params['task_name']) );
				$this->db->set('task_category', $params['task_category'] );
				$this->db->set('task_priority', $params['task_priority'] );
				$this->db->set('task_status', $params['task_status'] );  
				$this->db->where('task_id', $params['task_id'] );
				$this->db->update('tasks');
				break;
			}
			
			
			case 'delete': {
				$this->db->where('task_id', $params['task_id']);
				$this->db->delete('tasks');
				break;
			}
			
			case 'get': {
				if (isset($params['task_id']) )
					$this->db->where('tasks.task_id', $params['task_id']);
				if (isset($params['category_id'] ) )
					$this->db->where('category_id', $params['category_id'] );
				if (isset($params['task_status'] ) )
					$this->db->where('task_status', $params['task_status'] );
				if (isset($params['task_priority'] ) )
					$this->db->where('task_priority', $params['task_priority'] );
				$this->db->select('tasks.task_id, 
								   tasks.task_name, 
								   statuses.status_name, 
								   tasks.task_priority, 
								   task_category.category_id, 
								   task_category.category_name');
				$this->db->join('statuses', 'tasks.task_status = statuses.status_id', 'left');
				$this->db->join('task_category', 'tasks.task_category = task_category.category_id', 'left');
				$res = $this->db->get('tasks')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'task_id' 		=> $res_str->task_id,
									'task_name' 	=> base64_decode($res_str->task_name),
									'status_name' 	=> base64_decode($res_str->status_name),
									'task_priority'	=> $res_str->task_priority,
									'category_id'	=> $res_str->category_id,
									'category_name'	=> $res_str->category_name
								);
					array_push($data, $obj);
				}
				return $data;
			}
			
			default: break;
		}
	}
	
	
	
	public function work_category($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				$this->db->set('category_name', base64_encode($params['category_name']) );
				$this->db->insert('task_category');
				$this->db->where('category_name', base64_encode($params['category_name']) );
				$this->db->select('category_id');
				$res = $this->db->get('task_category')->result();
				if (isset($params['category_access'] ) ) {
					foreach($params['category_access'] as $access_user) {
						$this->db->set('user_id', $access_user);
						$this->db->set('category_id', $res[0]->category_id);
						$this->db->insert('user_access');
					}
				}
				break;
			}
			
			case 'edit': {
				$this->db->set('category_name', base64_encode($params['category_name']) );
				$this->db->where('category_id', $params['category_id'] );
				$this->db->update('task_category');
				break;
			}
			
			
			case 'delete': {
				$this->db->where('category_id', $params['category_id']);
				$this->db->delete('task_category');
				break;
			}
			
			case 'get': {
				if (isset($params['category_id']) )
					$this->db->where('category_id', $params['category_id']);
				if (isset($params['category_name']) )
					$this->db->where('category_name', base64_encode($params['category_name']) );
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
				$this->db->set('status_name', base64_encode($params['status_name']) );
				$this->db->set('status_color', $params['status_color'] );
				$this->db->insert('statuses');
				break;
			}
			
			case 'edit': {
				$this->db->set('status_name', base64_encode($params['status_name']) );
				$this->db->set('status_color', $params['status_color'] );
				$this->db->where('status_id', $params['status_id'] );
				$this->db->update('statuses');
				break;
			}
			
			
			case 'delete': {
				$this->db->where('status_id', $params['status_id']);
				$this->db->delete('statuses');
				break;
			}
			
			case 'get': {
				if (isset($params['status_id']) )
					$this->db->where('status_id', $params['status_id']);
				$res = $this->db->get('statuses')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'status_id' 		=> $res_str->status_id,
									'status_name' 		=> base64_decode($res_str->status_name),
									'status_color' 		=> $res_str->status_color
								);
					array_push($data, $obj);
				}
				return $data;
			}
			
			default: break;
		}		
	}
	
	
	
	public function work_schedules($cmd, $params = null) {
		
		switch ($cmd) {
			case 'new': {
				$this->db->set('user_id', $params['user_id']);
				$this->db->set('schedule_date', $params['schedule_date']);
				$this->db->set('schedule_time_begin', $params['schedule_time_begin'] );
				$this->db->set('schedule_time_end', $params['schedule_time_end'] );
				if (isset($params['comments'] ) )
					$this->db->set('comments', base64_encode($params['comments']) );
				$this->db->insert('schedules');
				break;
			}
			
			case 'edit': {
				$this->db->set('schedule_date', $params['schedule_date']);
				$this->db->set('schedule_time_begin', $params['schedule_time_begin'] );
				$this->db->set('schedule_time_end', $params['schedule_time_end'] );
				if (isset($params['comments'] ) )
					$this->db->set('comments', base64_encode($params['comments']) );
				$this->db->where('rec_id', $params['rec_id'] );
				$this->db->update('schedules');
				break;
			}
			
			
			case 'delete': {
				$this->db->where('rec_id', $params['rec_id']);
				$this->db->delete('schedules');
				break;
			}
			
			case 'get': {
				if (isset($params['rec_id']) )
					$this->db->where('rec_id', $params['rec_id']);
				if (isset($params['user_id'] ) )
					$this->db->where('user_id', $params['user_id']);
				if (isset($params['schedule_date'] ) )
					$this->db->where('schedule_date', $params['schedule_date'] );
				$res = $this->db->get('schedules')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'rec_id' 				=> $res_str->rec_id,
									'user_id' 				=> $res_str->user_id,
									'schedule_date'			=> $res_str->schedule_date,
									'schedule_time_begin'	=> $res_str->schedule_time_begin,
									'schedule_time_end'		=> $res_str->schedule_time_end,
									'comments'				=> $res_str->comments
								);
					array_push($data, $obj);
				}
				return $data;
			}
			
			default: break;
		}
		
	}
	
	
	
	
	public function work_board_entry($cmd, $params = null) {
		
		switch ($cmd) {
			case 'new': {
				$this->db->set('datetime_begin', $params['datetime_begin']);
				$this->db->set('datetime_end', $params['datetime_end']);
				$this->db->set('user_id', $params['user_id'] );
				$this->db->set('task_id', $params['task_id'] );
				if (isset($params['status_id'] ) )
					$this->db->set('status_id', $params['status_id']);
				$this->db->insert('board');
				break;
			}
			
			case 'edit': {
				$this->db->set('datetime_begin', $params['datetime_begin']);
				$this->db->set('datetime_end', $params['datetime_end']);
				$this->db->set('user_id', $params['user_id'] );
				$this->db->set('task_id', $params['task_id'] );
				if (isset($params['status_id'] ) )
					$this->db->set('status_id', $params['status_id']);
				$this->db->where('rec_id', $params['rec_id'] );
				$this->db->update('board');
				break;
			}
			
			
			case 'delete': {
				$this->db->where('rec_id', $params['rec_id']);
				$this->db->delete('board');
				break;
			}
			
			case 'get': {
				if (isset($params['rec_id']) )
					$this->db->where('rec_id', $params['rec_id']);
				if (isset($params['user_id'] ) )
					$this->db->where('user_id', $params['user_id']);
				$this->db->select('
									board.rec_id,
									board.user_id,
									board.datetime_begin,
									board.datetime_end,
									tasks.task_name,
									tasks.task_id,
									statuses.status_name,
									board.status_id
								  ');
				$this->db->join('tasks', 'tasks.task_id = board.task_id', 'left');
				$this->db->join('statuses', 'statuses.status_id = board.status_id' );
				$res = $this->db->get('board')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'rec_id' 				=> $res_str->rec_id,
									'user_id' 				=> $res_str->user_id,
									'datetime_begin'		=> $res_str->datetime_begin,
									'datetime_end'			=> $res_str->datetime_end,
									'task_id'				=> $res_str->task_id,
									'status_id'				=> $res_str->status_id,
									'task_name'				=> base64_decode($res_str->task_name),
									'status_name'			=> base64_decode($res_str->status_name)
								);
					array_push($data, $obj);
				}
				return $data;
			}
			
			default: break;
		}
		
	}
	
	
	
	public function board($date_begin, $date_end, $user_id = null) {
		$this->db->select('board.rec_id, 
						   board.datetime_begin, 
						   board.datetime_end,
						   board.user_id, 
						   tasks.task_id, 
						   tasks.task_name, 
						   statuses.status_name,
						   statuses.status_color, 
						   task_category.category_name
						   ');
		#$this->db->from('board');
		$this->db->where('datetime_begin >', $date_begin);
		$this->db->where('datetime_end <', $date_end);
		if ($iser_id != null)
			$this->db->where('user_id', $user_id);
		$this->db->join('tasks', 'board.task_id = tasks.task_id', 'left');
		$this->db->join('statuses', 'tasks.task_status = statuses.status_id', 'left');
		$this->db->join('task_category', 'tasks.task_category = task_category.category_id', 'left');
		$result = $this->db->get('board')->result();
		print_r($result);
	}
}

?>
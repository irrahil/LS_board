<?php

class board_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	private function get_user_conds($params = null) {
		if ($this->config->item('app_group_mode') ) {
			$this->db->	group_start()
							->where('user_access.access_id', $params['user_id'] )
							->where('user_access.is_group', false)
						#->group_end()
						->or_group_start()
							->where('user_access.is_group', true)
							->where('roles.user_id', $params['user_id'])
						->group_end();
			$this->db->join('roles', 'roles.group_id = user_access.access_id AND user_access.is_group = 1', 'left');
		} else {
			$this->db->group_start();
				$this->db->where('user_access.access_id', $params['user_id']);
				$this->db->where('user_access.is_group', false);
			#$this->db->group_end();
		}
		$this->db->or_where('task_category.owner_id', $params['user_id'])
				 ->group_end();
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
				if (isset($params['task_status'] ) )
					$this->db->set('task_status', $params['task_status'] ); 
				else
					$this->db->set('task_status', 'null');
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
				//SELECT
				$this->db->select('tasks.task_id, 
								   tasks.task_name,
								   statuses.status_id,
								   statuses.status_name, 
								   tasks.task_priority, 
								   task_category.category_id, 
								   task_category.category_name,
								   statuses.status_color');
				//JOIN
				$this->db->join('statuses', 'tasks.task_status = statuses.status_id', 'left');
				$this->db->join('task_category', 'tasks.task_category = task_category.category_id', 'left');
				$this->db->join('user_access', 'user_access.category_id = tasks.task_category', 'left');
				
				//WHERE
				if (isset($params['task_id']) )
					$this->db->where('tasks.task_id', $params['task_id']);
				if (isset($params['category_id'] ) )
					$this->db->where('category_id', $params['category_id'] );
				if (isset($params['task_status'] ) )
					$this->db->where('task_status', $params['task_status'] );
				if (isset($params['task_priority'] ) )
					$this->db->where('task_priority', $params['task_priority'] );
				if (!isset($params['admin']) ) {
					$this->get_user_conds($params);
				}
				$this->db->distinct();
				//ORDER BY
				$this->db->order_by('tasks.task_priority');
				$this->db->order_by('task_category.category_id');
				
				$res = $this->db->get('tasks')->result();
				#print_r($res);
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'task_id' 		=> $res_str->task_id,
									'task_name' 	=> base64_decode($res_str->task_name),
									'status_id'		=> $res_str->status_id,
									'status_name' 	=> base64_decode($res_str->status_name),
									'task_priority'	=> $res_str->task_priority,
									'category_id'	=> $res_str->category_id,
									'category_name'	=> base64_decode($res_str->category_name),
									'status_color' 	=> $res_str->status_color
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
				$this->db->set('owner_id', $params['user_id'] );
				$this->db->insert('task_category');
				$this->db->where('category_name', base64_encode($params['category_name']) );
				$this->db->select('category_id');
				$cat_id = $this->db->get('task_category')->result()[0]->category_id;
				if (isset($params['category_access'] ) ) {
					foreach($params['category_access'] as $access_user) {
						if ($access_user == $params['user_id'] )
							continue;
						$this->db->set('access_id', $access_user);
						$this->db->set('category_id', $cat_id);
						$this->db->set('is_group', false);
						$this->db->insert('user_access');
					}
				}
				if ($this->config->item('app_group_mode') ) {
					if (isset($params['group_access'] ) ) {
						foreach($params['group_access'] as $access_group) {
							$this->db->set('access_id', $access_group);
							$this->db->set('category_id', $cat_id);
							$this->db->set('is_group', true);
							$this->db->insert('user_access');
						}
					}
				}
				break;
			}
			
			case 'edit': {
				$this->db->select('owner_id');
				$this->db->where('category_id', $params['category_id']);
				$this->db->where('owner_id', $params['user_id'] );
				$res = $this->db->get('task_category')->result();
				if (empty($res) )
					break;
				$this->db->set('category_name', base64_encode($params['category_name']) );
				$this->db->where('category_id', $params['category_id']);
				$this->db->update('task_category');
				
				if (isset($params['category_access'] ) ) {
					//Очищаем таблицу доступа перед перезаписью
					$this->db->where('category_id', $params['category_id']);
					$this->db->where('is_group', false);
					$this->db->delete('user_access');
					//Перезаписываем таблицу доступа
					foreach($params['category_access'] as $access_user) {
						if ($access_user == $params['user_id'] )
							continue;
						$this->db->set('access_id', $access_user);
						$this->db->set('category_id', $params['category_id']);
						$this->db->set('is_group', false);
						$this->db->insert('user_access');
					}
				}
				
				if ($this->config->item('app_group_mode') ) {
					$this->db->where('category_id', $params['category_id']);
					$this->db->where('is_group', true);
					$this->db->delete('user_access');
					if (isset($params['group_access'] ) ) {
						foreach($params['group_access'] as $access_group) {
							$this->db->set('access_id', $access_group);
							$this->db->set('category_id', $params['category_id']);
							$this->db->set('is_group', true);
							$this->db->insert('user_access');
						}
					}
				}
				break;
			}
			
			
			case 'delete': {
				$this->db->select('owner_id');
				$this->db->where('category_id', $params['category_id']);
				$this->db->where('owner_id', $params['user_id'] );
				$res = $this->db->get('task_category')->result();
				if (empty($res) )
					break;
				$this->db->where('category_id', $params['category_id']);
				$this->db->delete('user_access');
				$this->db->where('category_id', $params['category_id']);
				$this->db->delete('task_category');
				
				break;
			}
			
			case 'get': {
				if (isset($params['category_id']) )
					$category_list = false;
				else
					$category_list = true;
				
				//SELECT
				$this->db->select('task_category.category_id, task_category.category_name');
				
				//Вариант отбора по конкретной категории
				
				//JOIN
				$this->db->join('user_access', 'user_access.category_id = task_category.category_id', 'left');
					
				
				//WHERE
				if (!$category_list)
					$this->db->where('task_category.category_id', $params['category_id']);
				if (isset($params['category_name']) )
					$this->db->where('task_category.category_name', base64_encode($params['category_name']) );
				
				if (isset($params['user_id'] ) ) {
					// if ($this->config->item('app_group_mode') ) {
						// $this->db->	group_start()
										// ->where('user_access.access_id', $params['user_id'] )
										// ->where('user_access.is_group', false)
									// ->group_end()
									// ->or_group_start()
										// ->where('user_access.is_group', true)
										// ->where('roles.user_id', $params['user_id'])
								// ->group_end();
						// $this->db->join('roles', 'roles.group_id = user_access.access_id AND user_access.is_group = 1', 'left');
					// } else {
						// $this->db->where('user_access.access_id', $params['user_id']);
						// $this->db->where('user_access.is_group', false);
					// }
					// $this->db->or_group_start()
								// ->where('task_category.owner_id', $params['user_id'])
							 // ->group_end();
					$this->get_user_conds($params);
				}
				$this->db->distinct();
				
				
				$res = $this->db->get('task_category')->result();
				#print_r($res);
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'category_id' => $res_str->category_id,
									'category_name' => base64_decode($res_str->category_name)
								);
					
					array_push($data, $obj);
				}
				if (!$category_list) {
					$this->db->select('user_access.access_id');
					$this->db->where('user_access.category_id', $params['category_id']);
					$this->db->where('user_access.is_group', false);
					$res = $this->db->get('user_access')->result();
					$users = array();
					foreach ($res as $user_str) {
						$obj = array('user_id' => $user_str->access_id);
						array_push($users, $obj);
					}
					$data['user_access'] = $users;
					
					$this->db->select('user_access.access_id');
					$this->db->where('user_access.category_id', $params['category_id']);
					$this->db->where('user_access.is_group', true);
					$res = $this->db->get('user_access')->result();
					$groups = array();
					foreach ($res as $user_str) {
						$obj = array('group_id' => $user_str->access_id);
						array_push($groups, $obj);
					}
					$data['group_access'] = $groups;
				}
				#print_r($data);
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
				$this->db->where('user_id', $params['user_id']);
				$this->db->update('schedules');
				break;
			}
			
			
			case 'delete': {
				$this->db->where('rec_id', $params['rec_id']);
				$this->db->where('user_id', $params['user_id']);
				$this->db->delete('schedules');
				break;
			}
			
			case 'get': {
				if (isset($params['rec_id']) )
					$this->db->where('schedules.rec_id', $params['rec_id']);
				if (isset($params['user_id'] ) )
					$this->db->where('schedules.user_id', $params['user_id']);
				if (isset($params['schedule_date'] ) )
					$this->db->where('schedules.schedule_date', $params['schedule_date'] );
				$this->db->select('
									schedules.rec_id,
									schedules.user_id,
									schedules.schedule_date,
									schedules.schedule_time_begin,
									schedules.schedule_time_end,
									schedules.comments,
									users.user_name
								  ');
				$this->db->join('users', 'users.user_id = schedules.user_id');
				$this->db->order_by('schedules.schedule_date', 'ASC');
				$res = $this->db->get('schedules')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'rec_id' 				=> $res_str->rec_id,
									'user_id' 				=> $res_str->user_id,
									'schedule_date'			=> $res_str->schedule_date,
									'schedule_time_begin'	=> $res_str->schedule_time_begin,
									'schedule_time_end'		=> $res_str->schedule_time_end,
									'comments'				=> base64_decode($res_str->comments),
									'user_name'				=> base64_decode($res_str->user_name)
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
				$this->db->set('schedule_id', $params['schedule_id']);
				$this->db->set('user_id', $params['user_id'] );
				$this->db->set('task_id', $params['task_id'] );
				$this->db->set('status_id', $params['status_id']);
				$this->db->insert('board');
				break;
			}
			
			case 'edit': {
				$this->db->set('schedule_id', $params['schedule_id']);
				$this->db->set('user_id', $params['user_id'] );
				$this->db->set('task_id', $params['task_id'] );
				$this->db->set('status_id', $params['status_id']);
				$this->db->where('rec_id', $params['rec_id'] );
				$this->db->where('user_id', $params['user_id']);
				$this->db->update('board');
				//Динамически меняем статус задачи в соответствии с записью на доске
				$this->db->set('task_status', $params['status_id']);
				$this->db->where('task_id', $params['task_id']);
				$this->db->update('tasks');
				
				break;
			}
			
			
			case 'delete': {
				$this->db->where('rec_id', $params['rec_id']);
				$this->db->where('user_id', $params['user_id']);
				$this->db->delete('board');
				break;
			}
			
			case 'get': {
				//SELECT
				$this->db->select('
									board.rec_id,
									board.user_id,
									schedules.rec_id AS schedule_id,
									schedules.schedule_date,
									schedules.schedule_time_begin,
									schedules.schedule_time_end,
									tasks.task_id,
									board.status_id,
									tasks.task_name,
									statuses.status_name,
									statuses.status_color,
									users.user_name,
									task_category.category_name
								  ');
				
				
				//JOIN
				$this->db->join('tasks', 'tasks.task_id = board.task_id', 'left');
				$this->db->join('task_category', 'task_category.category_id = tasks.task_category', 'left');
				$this->db->join('statuses', 'statuses.status_id = board.status_id' );
				$this->db->join('users', 'users.user_id = board.user_id');
				$this->db->join('schedules', 'schedules.rec_id = board.schedule_id');
				$this->db->join('user_access', 'user_access.category_id = task_category.category_id', 'left');
				
				//WHERE
				if (isset($params['rec_id']) )
					$this->db->where('board.rec_id', $params['rec_id']);
				
				if (isset($params['user_id'] ) ) {
					$this->get_user_conds($params);
					// 
					// if ($this->config->item('app_group_mode') ) {
						// $this->db->	group_start()
										// ->where('user_access.access_id', $params['user_id'] )
										// ->where('user_access.is_group', false)
									// ->group_end()
									// ->or_group_start()
										// ->where('user_access.is_group', true)
										// ->where('roles.user_id', $params['user_id'])
								// ->group_end();
						// $this->db->join('roles', 'roles.group_id = user_access.access_id AND user_access.is_group = 1', 'left');
					// } else {
						// $this->db->where('user_access.access_id', $params['user_id']);
						// $this->db->where('user_access.is_group', false);
					// }
					// $this->db->or_group_start()
								// ->where('task_category.owner_id', $params['user_id'])
							 // ->group_end();
				}
					
				if (isset($params['date_begin'] ) )
					$this->db->where('schedules.schedule_time_begin >= ', $params['date_begin']);
				if (isset($params['date_end'] ) )
					$this->db->where('schedules.schedule_time_end <= ', $params['date_end']);
				if (isset($params['day_begin'] ) AND isset($params['day_end']) ) {
					$this->db->where('schedule_date >=', $params['day_begin']);
					$this->db->where('schedule_date <=', $params['day_end']);
				}
				
				//ORDER BY
				$this->db->order_by('schedules.schedule_date', 'ASC');
				$this->db->order_by('board.user_id', 'ASC');
				$this->db->order_by('board.rec_id', 'ASC');
				$this->db->distinct();
				
				//FROM
				#print_r($this->db->get_compiled_select('board') );
				$res = $this->db->get('board')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'rec_id' 				=> $res_str->rec_id,
									'user_id' 				=> $res_str->user_id,
									'schedule_date'			=> $res_str->schedule_date,
									'schedule_time_begin'	=> $res_str->schedule_time_begin,
									'schedule_time_end'		=> $res_str->schedule_time_end,
									'task_id'				=> $res_str->task_id,
									'status_id'				=> $res_str->status_id,
									'task_name'				=> base64_decode($res_str->task_name),
									'status_name'			=> base64_decode($res_str->status_name),
									'status_color'			=> $res_str->status_color,
									'user_name'				=> base64_decode($res_str->user_name),
									'category_name'			=> base64_decode($res_str->category_name),
									'schedule_id'			=> $res_str->schedule_id
								);
					array_push($data, $obj);
				}
				return $data;
			}
			
			default: break;
		}
		
	}
	
	
	
}

?>
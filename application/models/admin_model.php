<?php

class admin_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
		$this->load->model('user_model');
		$this->load->model('board_model');
	}
	
	
	
	public function work_group($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				$this->db->set('group_name', base64_encode($params['group_name']) );
				$this->db->insert('groups');
				
				$this->db->where('group_name', base64_encode($params['group_name']) );
				$this->db->select('group_id');
				$res = $this->db->get('groups')->result();
				if (isset($params['role_users'] ) ) {
					foreach($params['role_users'] as $user_id) {
						$this->db->set('user_id', $user_id);
						$this->db->set('group_id', $res[0]->group_id);
						$this->db->insert('roles');
					}
				}
				break;
			}
			
			case 'edit': {
				$this->db->set('group_name', base64_encode($params['group_name']) );
				$this->db->where('group_id', $params['group_id']);
				$this->db->update('groups');
				if (isset($params['role_users'] ) ) {
					//Очищаем таблицу доступа перед перезаписью
					$this->db->where('group_id', $params['group_id']);
					$this->db->delete('groups');
					//Перезаписываем таблицу доступа
					foreach($params['role_users'] as $user_id) {
						$this->db->set('user_id', $user_id);
						$this->db->set('group_id', $res[0]->group_id);
						$this->db->insert('roles');
					}
				}
				
				break;
			}
			
			
			case 'delete': {
				$this->db->where('group_id', $params['group_id']);
				$this->db->delete('groups');
				break;
			}
			
			case 'get': {
				if (isset($params['group_id'] ) )
					$this->db->where('group_id', $params['group_id'] );
				if (isset($params['group_only'] ) ) {
					$this->db->select('groups.group_id, groups.group_name');
					$this->db->distinct();
				} else {
					$this->db->select('groups.group_id, groups.group_name, roles.user_id, users.user_name');
					$this->db->join('roles', 'roles.group_id = groups.group_id');
					$this->db->join('users', 'roles.user_id = users.user_id');
				}
				$this->db->order_by('groups.group_id', 'ASC');
				$res = $this->db->get('groups')->result();
				$data = array();
				if (isset($params['group_only'] ) ) {
					foreach ($res as $res_str) {
						$obj = array(
										'group_id' => $res_str->group_id,
										'group_name' => $res_str->group_name //base64_decode($res_str->group_name)
									);
						array_push($data, $obj);
					}
				} else {
					foreach ($res as $res_str) {
						$obj = array(
										'group_id' => $res_str->group_id,
										'group_name' => $res_str->group_name, //base64_decode($res_str->group_name)
										'user_id' => $res_str->user_id,
										'user_name' => base64_decode($res_str->user_name) 
									);
						array_push($data, $obj);
					}
				}
				return $data;
			}
			
			default: break;
		}
	}
	
	
	
	
	public function work_users($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				//Заглушка. Вся регистрация передается в модель user_model
				break;
			}
			
			case 'edit': {
				//Заглушка. Вся работа с пользователями передается в модель user_model
				break;
			}
			
			
			case 'delete': {
				if (!isset($params['user_id'] ) )
					break;
				$this->db->set('user_id', $params['user_id'] );
				$this->db->delete('users');
				break;
			}
			
			case 'get': {
				//Заглушка. Вся работа с пользователями передается в модель user_model
				break;
			}
			
			default: break;
		}
	}
	
	
	
	
	
	public function work_monitor($cmd, $params = null) {
		switch ($cmd) {
			case 'new': {
				
				break;
			}
			
			case 'edit': {
				
				break;
			}
			
			
			case 'delete': {
				
				break;
			}
			
			case 'get': {
				$data = array();
				$data['users_count'] = count($this->user_model->get_user_info() );
				$params['group_only'] = true;
				$params['admin']		= true;
				$data['groups_count']	= count($this->work_group('get', $params) );
				$data['last_user']	= $this->user_model->get_user_info(null, true)[0];
				$data['cat_count']	= count($this->board_model->work_category('get') );
				$data['task_count']	= count($this->board_model->work_task('get', $params) );
				$data['schedules_count'] = count($this->board_model->work_schedules('get') );
				return $data;
				break;
			}
			
			default: break;
		}
	}
	
	
}

?>
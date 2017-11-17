<?php

class board_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
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
				$this->db->set('group_name', base64_encode($params['group_name']) )
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
				$this->db->select('groups.group_id, groups.group_name, roles.user_id, users.user_name');
				$this->db->join('roles', 'roles.group_id = groups.group_id');
				$this->db->join('users', 'roles.user_id = users.user_id');
				$this->db->order_by('groups.group_id', 'ASC');
				$res = $this->db->get('groups')->result();
				$data = array();
				foreach ($res as $res_str) {
					$obj = array(
									'group_id' => $res_str->group_id,
									'group_name' => base64_decode($res_str->group_name)
								);
					array_push($data, $obj);
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
				
				//$res = $this->db->get('')->result();
				//$data = array();
				//foreach ($res as $res_str) {
				//	$obj = array(
				//					
				//				);
				//	array_push($data, $obj);
				//}
				//return $data;
				break;
			}
			
			default: break;
		}
	}
	
	
}

?>
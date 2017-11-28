<?php

class Install_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	
    // public static function read($filename)
    // {
        // $config = include $filename;
        // return $config;
    // }
    public static function save_config($filename, array $config)
    {
		$new_config = "<?php ";
		if ($config['init_base'] == 0)
			$new_config.= '$config[\'init_base\'] = false; ';
		else
			$new_config.= '$config[\'init_base\'] = true; ';
		if ($config['app_group_mode'] == 0)
			$new_config.= '$config[\'app_group_mode\'] = false; ';
		else
			$new_config.= '$config[\'app_group_mode\'] = true; ';
		$new_config.= "?>";
		file_put_contents($filename, $new_config);
    }
	
	public function install_database() {
		//USERS Table
		$init_users_table_query = "
			CREATE TABLE IF NOT EXISTS `users` (
				`user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				`user_login` varchar(255) CHARACTER SET latin1 NOT NULL,
				`user_pass` varchar(255) CHARACTER SET latin1 NOT NULL,
				`user_name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
				`user_email` varchar(100) CHARACTER SET latin1 NOT NULL,
				`is_admin` tinyint(1) NOT NULL DEFAULT '0',
				PRIMARY KEY (`user_id`),
				UNIQUE KEY `user_id` (`user_id`),
				UNIQUE KEY `user_login` (`user_login`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_users_table_query);
		
		//GROUPS table
		$init_groups_table_query = "
			CREATE TABLE IF NOT EXISTS `groups` (
				`group_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				`group_name` varchar(255) NOT NULL,
				PRIMARY KEY (`group_id`),
				UNIQUE KEY `group_id` (`group_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_groups_table_query);
		
		//ROLES table
		$init_roles_table_query = "
			CREATE TABLE IF NOT EXISTS `roles` (
				`group_id` bigint(20) unsigned NOT NULL,
				`user_id` bigint(20) unsigned NOT NULL,
				PRIMARY KEY (`group_id`,`user_id`),
				KEY `FK_roles_2` (`user_id`),
				CONSTRAINT `FK_roles_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
				CONSTRAINT `FK_roles_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_roles_table_query);
		
		//RESTORES table
		$init_restores_table_query = "
			CREATE TABLE IF NOT EXISTS `restore_list` (
				`restore_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				`user_id` bigint(20) unsigned NOT NULL,
				`token` text NOT NULL,
				`is_used` tinyint(1) NOT NULL,
				PRIMARY KEY (`restore_id`),
				UNIQUE KEY `restore_id` (`restore_id`),
				KEY `FK_restore_list_1` (`user_id`),
				CONSTRAINT `FK_restore_list_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_restores_table_query);
		
		//TASK CATEGORIES table
		$init_task_categories_table_query = "
			CREATE TABLE IF NOT EXISTS `task_category` (
				`category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				`category_name` varchar(255) NOT NULL,
				`owner_id` bigint(20) unsigned NOT NULL,
				PRIMARY KEY (`category_id`),
				UNIQUE KEY `category_id` (`category_id`),
				UNIQUE KEY `cat_index` (`category_name`),
				KEY `FK_task_category_1` (`owner_id`),
				CONSTRAINT `FK_task_category_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_task_categories_table_query);
		
		//USER ACCESS table
		$init_user_access_table_query = "
			CREATE TABLE IF NOT EXISTS `user_access` (
				`access_id` bigint(20) unsigned NOT NULL,
				`category_id` bigint(20) unsigned NOT NULL,
				`is_group` tinyint(1) NOT NULL DEFAULT '0',
				PRIMARY KEY (`access_id`,`category_id`,`is_group`) USING BTREE,
				KEY `FK_user_access_2` (`category_id`),
				CONSTRAINT `FK_user_access_2` FOREIGN KEY (`category_id`) REFERENCES `task_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_user_access_table_query);
		
		//STATUSES table
		$init_status_table_query = "
			CREATE TABLE IF NOT EXISTS `statuses` (
				`status_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				`status_name` varchar(100) NOT NULL,
				`status_color` varchar(10) DEFAULT NULL,
				PRIMARY KEY (`status_id`),
				UNIQUE KEY `status_id` (`status_id`),
				UNIQUE KEY `unique_status` (`status_name`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_status_table_query);
		
		//TASKS table
		$init_tasks_table_query = "
			CREATE TABLE IF NOT EXISTS `tasks` (
				`task_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				`task_category` bigint(20) unsigned NOT NULL,
				`task_name` varchar(255) DEFAULT NULL,
				`task_priority` int(11) DEFAULT NULL,
				`task_status` bigint(20) unsigned DEFAULT NULL,
				PRIMARY KEY (`task_id`),
				UNIQUE KEY `task_id` (`task_id`),
				KEY `FK_tasks_1` (`task_status`),
				KEY `FK_tasks_2` (`task_category`),
				CONSTRAINT `FK_tasks_1` FOREIGN KEY (`task_status`) REFERENCES `statuses` (`status_id`) ON DELETE SET NULL ON UPDATE SET NULL,
				CONSTRAINT `FK_tasks_2` FOREIGN KEY (`task_category`) REFERENCES `task_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_tasks_table_query);
		
		//SCHEDULES table
		$init_schedules_table_query = "
			CREATE TABLE IF NOT EXISTS `schedules` (
				`user_id` bigint(20) unsigned NOT NULL,
				`schedule_date` date NOT NULL,
				`schedule_time_begin` time NOT NULL,
				`schedule_time_end` time NOT NULL,
				`comments` text,
				`rec_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`rec_id`) USING BTREE,
				UNIQUE KEY `rec_id` (`rec_id`),
				UNIQUE KEY `user_id` (`user_id`,`schedule_date`,`schedule_time_begin`) USING BTREE,
				CONSTRAINT `FK_schedules_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		";
		$this->db->simple_query($init_schedules_table_query);
		
		//BOARD table
		$init_board_table_query = "
			CREATE TABLE IF NOT EXISTS `board` (
				`rec_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				`user_id` bigint(20) unsigned NOT NULL,
				`task_id` bigint(20) unsigned NOT NULL,
				`status_id` bigint(20) unsigned DEFAULT NULL,
				`schedule_id` bigint(20) unsigned NOT NULL,
				PRIMARY KEY (`rec_id`),
				UNIQUE KEY `rec_id` (`rec_id`),
				KEY `FK_board_1` (`user_id`),
				KEY `FK_board_2` (`status_id`) USING BTREE,
				KEY `FK_board_3` (`task_id`) USING BTREE,
				KEY `FK_board_4` (`schedule_id`),
				CONSTRAINT `FK_board_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
				CONSTRAINT `FK_board_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE SET NULL ON UPDATE SET NULL,
				CONSTRAINT `FK_board_3` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
				CONSTRAINT `FK_board_4` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`rec_id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
		";
		$this->db->simple_query($init_board_table_query);
		
		return true;
		
	}
	
}

?>
<?php
	#print_r($monitor);
?>


<div class="form_monitor">
	<div class="form_monitor_panel">
		<div class="form_monitor_label">
			Количество пользователей:
		</div>
		<div class="form_monitor_content">
			<?php echo $monitor['users_count'];?>
		</div>
	</div>
	
	<div class="form_monitor_panel">
		<div class="form_monitor_label">
			Количество групп:
		</div>
		<div class="form_monitor_content">
			<?php echo $monitor['groups_count'];?>
		</div>
	</div>
	
	<div class="form_monitor_panel">
		<div class="form_monitor_label">
			Последний зарегистрировавшийся пользователь:
		</div>
		<div class="form_monitor_content">
			<?php echo 'ID: ', $monitor['last_user']['user_id'];
				  echo ' логин: ', $monitor['last_user']['user_login'];
				  echo ' имя пользователя: ', $monitor['last_user']['user_name'];
			?>
		</div>
	</div>
	
	<div class="form_monitor_panel">
		<div class="form_monitor_label">
			Количество категорий задач:
		</div>
		<div class="form_monitor_content">
			<?php echo $monitor['cat_count'];?>
		</div>
	</div>
	
	<div class="form_monitor_panel">
		<div class="form_monitor_label">
			Количество задач:
		</div>
		<div class="form_monitor_content">
			<?php echo $monitor['task_count'];?>
		</div>
	</div>
	
	<div class="form_monitor_panel">
		<div class="form_monitor_label">
			Количество записей расписания:
		</div>
		<div class="form_monitor_content">
			<?php echo $monitor['schedules_count'];?>
		</div>
	</div>
	
</div>
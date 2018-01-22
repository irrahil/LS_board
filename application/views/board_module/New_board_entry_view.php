<?php #print_r($schedule_list); print_r($task_list); print_r($status_list); ?>
<div class="cat_form">
	<div class="cat_form_header">
		Новая запись на доске
	</div>
	<form method=post action="/index.php/cmd_new_entry">
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Запись расписания:
		</div>	
		<div class="cat_form_field">
			<select name="schedule_id">
				<?php 
					foreach ($schedule_list as $record) {
						echo '<option value=', $record['rec_id'];
						#if ($task_info[0]['status_id'] == $record['rec_id'])
						#	echo ' selected';
					echo '>', $record['schedule_date'] , ": ", $record['schedule_time_begin'], " - ", $record['schedule_time_end'], "</option>";
					}
				?>
			</select>
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Задача:
		</div>	
		<div class="cat_form_field">
			<select name="task_id">
				<?php 
					foreach ($task_list as $task) {
						echo '<option value=', $task['task_id'];
						#if ($task_info[0]['status_id'] == $status['status_id'])
						#	echo ' selected';
						echo '>', $task['task_name'] , " (", $task['category_name'], ") [", $task['status_name'], "]</option>";
					}
				?>
			</select>
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Статус задачи:
		</div>	
		<div class="cat_form_field">
			<select name="status_id">
				<?php 
					foreach ($status_list as $status) {
						echo '<option value=', $status['status_id'];
						#if ($task_info[0]['status_id'] == $status['status_id'])
						#	echo ' selected';
						echo '><font color="', $status['status_color'], '">', $status['status_name'] , "</font></option>";
					}
				?>
			</select>
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_button">
			<input type=submit value="Добавить новый элемент">
		</div>
	</div>
	
	</form>
</div>
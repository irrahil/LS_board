<?php #print_r($task_info); ?>

<div class="cat_form">
	<div class="cat_form_header">
		Задача
	</div>
	<form method=post action="/index.php/cmd_edit_task">
	<input type=hidden name="task_id" value="<?php echo $task_info[0]['task_id']; ?>"
	<div class="cat_form_str">
		<div class="cat_form_label">
			Наименование:
		</div>	
		<div class="cat_form_field">
			<input type=text name="taskname" value="<?php echo $task_info[0]['task_name']; ?>">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Статус:
		</div>	
		<div class="cat_form_field">
			<select name="task_status">
				<option value=0>--</option>
				<?php
				foreach ($statuses as $status) {
					echo '<option value=', $status['status_id'];
					if ($task_info[0]['status_id'] == $status['status_id'])
						echo ' selected';
					echo '>', $status['status_name'] , "</option>";
				}
			?>
			</select>
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Категория:
		</div>	
		<div class="cat_form_field">
			<select name="taskcategory">
			<option value=0>--</option>
			<?php
				foreach ($categories as $category) {
					echo '<option value=', $category['category_id'];
					if ($task_info[0]['category_id'] == $category['category_id'])
						echo ' selected';
					echo '>', $category['category_name'] , "</option>";
				}
			?>
			</select>
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Приоритет:
		</div>	
		<div class="cat_form_field">
			<input type=number name="taskpriority" value="<?php echo $task_info[0]['task_priority']; ?>">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_button">
			<input type=submit value="Изменить элемент">
		</div>
	</div>
	
	</form>
</div>
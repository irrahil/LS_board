<?php #print_r($schedule_info) ?>
<div class="cat_form">
	<div class="cat_form_header">
		Запись в расписании ID №<?php echo $schedule_info[0]['rec_id']; ?>
	</div>
	<form method=post action="/index.php/cmd_edit_schedule">
	<input type=hidden name="rec_id" value="<?php echo $schedule_info[0]['rec_id']; ?>">
	<input type=hidden name="user_id" value="<?php echo $schedule_info[0]['user_id']; ?>">
	<div class="cat_form_str">
		<div class="cat_form_label">
			Дата:
		</div>	
		<div class="cat_form_field">
			<input type=date name="schedule_date" class="date" placeholder="yyyy-mm-dd" value="<?php echo $schedule_info[0]['schedule_date']; ?>">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Время начала:
		</div>	
		<div class="cat_form_field">
			<input type="time" name="schedule_time_begin" class="time" placeholder="hh:mm:ss" value="<?php echo $schedule_info[0]['schedule_time_begin']; ?>">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Время окончания:
		</div>	
		<div class="cat_form_field">
			<input type=time name="schedule_time_end" class="time" placeholder="hh:mm:ss" value="<?php echo $schedule_info[0]['schedule_time_end']; ?>">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Комментарии:
		</div>	
		<div class="cat_form_field">
			<input type=text name="comments" value="<?php echo $schedule_info[0]['comments']; ?>">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_button">
			<input type=submit value="Изменить элемент">
		</div>
	</div>
	
	</form>
</div>
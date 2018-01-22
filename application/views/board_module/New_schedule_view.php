<div class="cat_form">
	<div class="cat_form_header">
		Новая запись в расписании
	</div>
	<form method=post action="/index.php/cmd_new_schedule">
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Дата:
		</div>	
		<div class="cat_form_field">
			<input type=date name="schedule_date" class="date" placeholder="yyyy-mm-dd">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Время начала:
		</div>	
		<div class="cat_form_field">
			<input type="time" name="schedule_time_begin" class="time" placeholder="hh:mm:ss">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Время окончания:
		</div>	
		<div class="cat_form_field">
			<input type=time name="schedule_time_end" class="time" placeholder="hh:mm:ss">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Комментарии:
		</div>	
		<div class="cat_form_field">
			<input type=text name="comments" value="">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_button">
			<input type=submit value="Добавить новый элемент">
		</div>
	</div>
	
	</form>
</div>
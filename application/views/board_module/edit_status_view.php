<div class="cat_form">
	<div class="cat_form_header">
		Элемент справочника "Статусы задач"
	</div>
	<form method=post action="/index.php/cmd_edit_status">
	<input type=hidden name="statusid" value="<?php echo $status_info[0]['status_id'];?>">
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Наименование:
		</div>
		
		<div class="cat_form_field">
			<input type=text name="statusname" value="<?php echo $status_info[0]['status_name'];?>">
		</div>
	
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Цвет:
		</div>
		
		<div class="cat_form_field">
			<input type=color name="statuscolor" value="<?php echo $status_info[0]['status_color'];?>">
		</div>
	
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_button">
			<input type=submit value="Изменить">
		</div>
	</div>
	</form>
</div>
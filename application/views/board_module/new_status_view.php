<div class="cat_form">
	<div class="cat_form_header">
		Новый элемент справочника "Статусы задач"
	</div>
	<form method=post action="/index.php/cmd_new_status">
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Наименование:
		</div>
		
		<div class="cat_form_field">
			<input type=text name="statusname" value="">
		</div>
	
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Цвет:
		</div>
		
		<div class="cat_form_field">
			<input type=color name="statuscolor" value="#000000">
		</div>
	
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_button">
			<input type=submit value="Добавить новый элемент">
		</div>
	</div>
	</form>
</div>
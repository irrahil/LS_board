<div class="cat_form">
	<div class="cat_form_header">
		Новая задача
	</div>
	<form method=post action="/index.php/cmd_new_task">
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Наименование:
		</div>	
		<div class="cat_form_field">
			<input type=text name="taskname" value="">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_label">
			Категория:
		</div>	
		<div class="cat_form_field">
			<select name="taskcategory">
			<option value=0 selected>--</option>
			<?php
				foreach ($categories as $category) {
					echo '<option value="', $category['category_id'] ,'">', $category['category_name'] , "</option>";
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
			<input type=number name="taskpriority" value="">
		</div>
	</div>
	
	<div class="cat_form_str">
		<div class="cat_form_button">
			<input type=submit value="Добавить новый элемент">
		</div>
	</div>
	
	</form>
</div>
<div class="cat_form">
	<div class="cat_form_header">
		Новый элемент справочника "Категории задач"
	</div>
	<form method=post action="/index.php/cmd_new_category">
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Наименование:
		</div>
		
		<div class="cat_form_field">
			<input type=text name="categoryname" value="">
		</div>
	
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Права доступа к категории:
		</div>
		
		<div class="cat_form_label">
			Пользователи:
		</div>
		<div class="cat_form_field">
			<select name="user_access[]" multiple size=10>
				<?php foreach ($user_list as $user) {
					echo '<option value="', $user['user_id'], '">', $user['user_name'] ,'</option>';
				}
				?>
			</select>
		</div>
		<?php 
			if ($app_group_mode) {
				echo 
				'
					<div class="cat_form_label">
						Группы пользователей:
					</div>
					<div class="cat_form_field">
						<select name="group_access[]" multiple size=10>
				';
				foreach ($group_list as $group) {
					echo '<option value="', $group['group_id'], '">', $group['group_name'] ,'</option>';
				}
				echo 
				'
						</select>
					</div>
				';
			}
		?>
		
		
		
		
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_button">
			<input type=submit value="Добавить новый элемент">
		</div>
	</div>
	</form>
</div>
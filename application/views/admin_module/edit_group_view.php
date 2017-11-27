<div class="cat_form">
	<div class="cat_form_header">
		Элемент справочника "Группа пользоваетелй"
	</div>
	<form method=post action="/cmd_edit_group">
	<input type=hidden name="group_id" value="<?php echo $group[0]['group_id']; ?>">
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Наименование:
		</div>
		
		<div class="cat_form_field">
			<input type=text name="group_name" value="<?php echo $group[0]['group_name']; ?>">
		</div>
	
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Пользователи в группе:
		</div>
		<div class="cat_form_field">
			<select name="role_users[]" multiple size=10>
				<?php foreach ($user_list as $user) {
					echo '<option value=', $user['user_id'];
					if (array_search($user['user_id'], array_column($group, 'user_id') ) !== FALSE)
						echo ' selected'; 
					echo '>', $user['user_name'] ,'</option>';
				}
				?>
			</select>
		</div>
		
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_button">
			<input type=submit value="Изменить элемент">
		</div>
	</div>
	</form>
</div>
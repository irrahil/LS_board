<?php #print_r($category_info );
	if (!isset($category_info) )
		header("Location: /index.php/categories");	
?>

<div class="cat_form">
	<div class="cat_form_header">
		Элемент справочника "Категории задач"
	</div>
	<form method=post action="/index.php/cmd_edit_category">
	<input type=hidden name="category_id" value="<?php echo $category_info[0]['category_id']; ?>">
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Наименование:
		</div>
		
		<div class="cat_form_field">
			<input type=text name="categoryname" value="<?php echo $category_info[0]['category_name']; ?>">
		</div>
	
	</div>
	
	<div class="cat_form_str">
	
		<div class="cat_form_label">
			Права доступа к категории:
		</div>
		
		<div class="cat_form_field">
			<select name="categoryaccess[]" multiple size=10>
				<?php foreach ($user_list as $user) {
					echo '<option value=', $user['user_id'];
					if (array_search($user['user_id'], array_column($category_info, 'user_access') ) !== false )
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
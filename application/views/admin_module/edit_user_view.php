<div class="user_form">
	<form method=post action="/cmd_edit_user">
	<div class="user_form_str">
	
		<div class="user_form_label">
			Логин:
		</div>
		<input type=hidden name="user_id" value="<?php echo $user[0]['user_id']; ?>">
		<div class="user_form_field">
			<input type=hidden name=userlogin_edit value=false>
			<input type=text name=user_login value="<?php echo $user[0]['user_login']; ?>" onchange="activateField('userlogin_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Пароль:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=userpass_edit value=false>
			<input type=password name=user_pass value="aaaaaaaaaaaa" onchange="activateField('userpass_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Электронная почта:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=email_edit value=false>
			<input type=text name=user_email value="<?php echo $user[0]['user_email']; ?>" onchange="activateField('email_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Имя:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=name_edit value=false>
			<input type=text name=user_name value="<?php echo $user[0]['user_name']; ?>" onchange="activateField('name_edit');">
		</div>
	
	</div>
	<div class="user_form_str">
	
		<div class="user_form_label">
			Права администратора:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=is_admin_edit value=false>
			<input type=checkbox name=is_admin <?php if($user[0]['is_admin']) echo 'checked'; ?> onchange="activateField('is_admin_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_button">
			<input type=submit value="Изменить">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_button">
			<a href=/board>Назад</a>	
		</div>
	
	</div>
	</form>
</div>
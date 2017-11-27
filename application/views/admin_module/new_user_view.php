<div class="user_form">
	<form method=post action="/cmd_new_user">
	<div class="user_form_str">
	
		<div class="user_form_label">
			Логин:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=userlogin_edit value=false>
			<input type=text name=user_login value="" onchange="activateField('userlogin_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Пароль:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=userpass_edit value=false>
			<input type=password name=user_pass value="" onchange="activateField('userpass_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Электронная почта:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=email_edit value=false>
			<input type=text name=user_email value="" onchange="activateField('email_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Имя:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=name_edit value=false>
			<input type=text name=user_name value="" onchange="activateField('name_edit');">
		</div>
	
	</div>
	<div class="user_form_str">
	
		<div class="user_form_label">
			Права администратора:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=is_admin_edit value=false>
			<input type=checkbox name=is_admin onchange="activateField('is_admin_edit');">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_button">
			<input type=submit value="Добавить">
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_button">
			<a href=/board>Назад</a>	
		</div>
	
	</div>
	</form>
</div>
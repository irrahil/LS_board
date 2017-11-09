<div class="user_form">
	<form method=post action="/index.php/cmd_edit_user">
	<div class="user_form_str">
	
		<div class="user_form_label">
			Логин:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=userlogin_edit value=false>
			<input type=text name=userlogin value="<?php echo $userlogin; ?>" disabled=true>
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Пароль:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=userpass_edit value=false>
			<input type=password name=userpass value="aaaaaaaaaaaa" disabled=true>
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Электронная почта:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=email_edit value=false>
			<input type=text name=email value="<?php echo $email; ?>" disabled=true>
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_label">
			Имя:
		</div>
		
		<div class="user_form_field">
			<input type=hidden name=name_edit value=false>
			<input type=text name=name value="<?php echo $username; ?>" disabled=true>
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_button">
			<input type=submit value="Изменить" disabled=true>
		</div>
	
	</div>
	
	<div class="user_form_str">
	
		<div class="user_form_button">
			<a href=/board>Назад</a>	
		</div>
	
	</div>
	</form>
</div>
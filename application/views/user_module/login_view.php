<?php
	if (isset($reg_success) ) {
		echo '<div class="main_message">Пользователь ',$reg_username, ' успешно зарегистрирован. Пожалуйста, войдите под своим именем и паролем<</div>';
	}
	if (isset($login_failed) ) {
		echo '<div class="main_message">Некорректно указан логин и / или пароль!</div>';
	}
?>

	<div class="form_css">
	<h2>Вход</h2>
	<form method = "post" action="/index.php/cmd_reg_user" class = "main-form">
	
	<div class="form_str">
		 <!-- <div class="form_col">
			Логин:
		</div>  -->
		<div class="form_col">
			<input type="text" name="username" value="" placeholder = "Логин">
			<label for="username"></label>
		</div>
	</div>
	
	<div class="form_str">
		<!--<div class="form_col">
			Пароль:
		</div>  -->
		<div class="form_col">
			<input type = "password" name = "password" value="" placeholder = "Пароль">
			<label for="password"></label>
		</div>
	</div>

	<div class="form_str_last">
		<input type = "submit" value="Войти" class = "login">
	</div>

	<div class="form_str_last">
		<a href="/registry" class = "registr">Зарегистрироваться</a>
	</div>
	</form>

</div>
<?php
	if (isset($reg_success) ) {
		echo '<div class="main_message">Пользователь ',$reg_username, ' успешно зарегистрирован. Пожалуйста, войдите под своим именем и паролем<</div>';
	}
	if (isset($login_failed) ) {
		echo '<div class="main_message">Некорректно указан логин и / или пароль!</div>';
	}
?>

<div class="main_block">
	<div class="form_css">
		<form method=post action="/index.php/cmd_login">
			<div class="form_str">
				<div class="form_col">
					Логин:
				</div>
				<div class="form_col">
					<input type=text name=username value="">
				</div>
			</div>
			<div class="form_str">
				<div class="form_col">
					Пароль:
				</div>
				<div class="form_col">
					<input type=password name=userpass value="">
				</div>
			</div>
			<div class="form_str">
				<input type=submit value="Войти">
			</div>
			<div class="form_str">
				<a href="/registry">Зарегистрироваться</a>
			</div>
		</form>
	</div>
		
</div>
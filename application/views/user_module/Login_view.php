<?php
	if (isset($reg_success) ) {
		echo '<div class="main_message">Пользователь ',$reg_username, ' успешно зарегистрирован. Пожалуйста, войдите под своим именем и паролем<</div>';
	}
	if (isset($login_failed) ) {
		echo '<div class="main_message">Некорректно указан логин и / или пароль!</div>';
	}
?>
	
	    <div class="container_log">
				<div class="main_form" style="width:420px; min-height:200px;">
			    	<div>
						<h2>Вход</h2>

						<form method = "post" action="/cmd_login" id="date"></form>

						<div>
							<input type="text" name="username" value="" placeholder = "Логин" class="form_input" form="date">
							<label for="username"></label>
						</div>

						<div>
							<input type = "password" name = "password" value="" placeholder = "Пароль" class="form_input" form="date">
							<label for="password"></label>
						</div>

						<div>
							<input type = "submit" value="Войти" class = "form_button" form="date" style="width: 175px;">
						</div>

						<div>
							<a href ="/registry" class = "form_button" form="date">Зарегистрироваться</a>
						</div>

					</div>
				</div>
			</div>
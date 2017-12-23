<div class="form_css">
<h2>Регистрация</h2>
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


<div class="form_str">
	<!--<div class="form_col">
		Повторный пароль:
	</div>  -->
	<div class="form_col">
		<input type = "password" name = "password_check" value="" placeholder = "Повторите пароль">
		<label for="password_check"></label>
	</div>
</div>

<div class="form_str">
	<!--<div class="form_col">
		email:
	</div>  -->
	<div class="form_col">
		<input type = "text" name = "email" value="" placeholder = "email">
		<label for="email"></label>
	</div>
</div>

<div class="form_str">
	<!--<div class="form_col">
		Имя для отображения:
	</div>  -->
	<div class="form_col">
		<input type = "text" name = "name" value="" placeholder = "Имя для отображения">
		<label for="name"></label>
	</div>
</div>

<div class="form_str">
	<!--<div class="form_col">
		Код доступа:
	</div>  -->
	<div class="form_col">
		<input type = "text" name = "verify_code" value="" placeholder = "Код доступа" >
		<label for="verify_code"></label>
	</div>
</div>

<div class="form_str_last">
	<input type = "submit" value="Зарегистрироваться" class = "registr">
	<div><a href="/"><img src="http://www.pixic.ru/i/q0G184a726m4C7o2.png" class = "icon_back"></a></div>
</div>
</form>

</div>
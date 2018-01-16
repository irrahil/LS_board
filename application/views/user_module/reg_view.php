<div class="container_log">
				<div class="main_form" style="width:420px; min-height:200px;">
					<div>
						<h2 class="form_head">Регистрация</h2>
						<form method = "post" action="/index.php/cmd_reg_user" id="date_reg"></form>



						<div>
							<input type="text" name="username" value="" placeholder = "Логин" class="form_input" form="date_reg">
							<label for="username"></label>
						</div>

						<div>
							<input type = "password" name = "password" value="" placeholder = "Пароль" class="form_input" form="date_reg">
							<label for="password"></label>
						</div>


						<div>
							<input type = "password" name = "password_check" value="" placeholder = "Повторите пароль" class="form_input" form="date_reg">
							<label for="password_check"></label>
						</div>

						<div>
							<input type = "text" name = "email" value="" placeholder = "email" class="form_input" form="date_reg">
							<label for="email"></label>
						</div>


						<div>
							<input type = "text" name = "name" value="" placeholder = "Имя для отображения" class="form_input" form="date_reg">
							<label for="name"></label>
						</div>

						<div>
							<input type = "text" name = "verify_code" value="" placeholder = "Код доступа" class="form_input" form="date_reg">
							<label for="verify_code"></label>
						</div>
						<div>
							<input type = "submit" value="Зарегистрироваться" class="form_button" form="date_reg"><!--class = "registr"  -->
							<a href="#" form="date_reg" class = "icon_back"><img src="image/icon.png" alt="" style="vertical-align: middle;"></a>
						</div>

					</div>
				</div>
			</div>
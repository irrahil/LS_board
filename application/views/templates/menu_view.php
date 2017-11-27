<div class=menu>
	<div class="menu_header">
		<div class="menu_field">
			Панель управления
		</div>
		<div class="menu_field">
			Здравствуйте, <a href=/profile><?php echo $username; ?></a>
		</div>
	</div>
	
	<div class="menu_button">
		<a href=/board>На главную</a>
	</div>
	<div class="menu_button">
		<a href=/categories>Категории задач</a>
	</div>
	<div class="menu_button">
		<a href=/tasks>Задачи</a>
	</div>
	<?php 
		if (!$app_group_mode )
		echo '
			<div class="menu_button">
				<a href=/index.php/statuses>Статусы задач</a>
			</div>
	'; ?>
	<div class="menu_button">
		<a href=/schedules>Расписание</a>
	</div>
	<div class="menu_button">
		<a href=/new_board_entry>Добавить новую запись на доску</a>
	</div>
	<?php
		if (isset($admin) && $admin )  
			echo '
				<div class="menu_button">
					<a href=/admin>Админ-панель</a>
				</div>
				';
	?>
	<div class="menu_button">
		<a href=/cmd_exit>Выход</a>
	</div>
</div>
<nav>
<ul class="menu">
		<li class="menu-button fon" style='background-image: url(/image/profile.png)'>
		<div class="menu-button__profil">
		Пользователь: <span class="menu-button__profil__name">Артём</span><br>
		Задачи на сегодня:  <span class="menu-button__profil__q">2</span><br>
		Мои задачи<br>
		Мое расписание<br>
		
		Добавить задачу<br>
		Выделить время<br>
		</div>
		</li>
	
	    <li class="menu-button fon">
	    	<a href="/board">На главную</a>
    	</li>
	    <li class="menu-button fon">
		    <a href=/categories>Категории задач</a>
	    </li>
	    <li class="menu-button fon">
		    <a href=/tasks>Задачи</a>
	    </li>
	    <?php 
		if (!$app_group_mode )
		echo '
			<li class="menu-button fon">
				<a href=/statuses>Статусы задач</a>
			</li>
	    '; ?>
    	<li class="menu-button fon">
		    <a href=/schedules>Расписание</a>
	    </li>
	    <!--	Ненужная более кнопка
		<li class="menu-button fon">
	    	<a href=/new_board_entry>Добавить задачу</a>
	    </li>
		-->
    	<li class="menu-button fon" style='background-image: url(/image/can.png)'>
		    <a href=/cmd_exit><img src="/image/close-btn.png" alt="Выход"> </a>
	    </li>
	</ul>
</nav>

<nav>
<ul class="menu">
		<li class="menu-button fon" style='background-image: url(/image/profile.png)'>
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
	    <li class="menu-button fon">
	    	<a href=/new_board_entry>Добавить задачу</a>
	    </li>
    	<li class="menu-button fon" style='background-image: url(/image/can.png)'>
		    <a href=/cmd_exit>Выход</a>
	    </li>
	</ul>
</nav>

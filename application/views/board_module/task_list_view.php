<!-- <?php #print_r($task_list); ?>
	
	<div class="list_new_item">
		<a href=/index.php/new_task>Добавить новую задачу</a>
	</div>

<?php foreach ($task_list as $task) : ?>

	<div class="list_item" style="color: <?php echo $task['status_color']; ?>;">
		<div class="list_col">
			<?php echo 'Наименование: ' ,$task['task_name']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Статус: ' ,$task['status_name']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Категория: ' ,$task['category_name']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Приоритет: ' ,$task['task_priority']; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/task?task_id=', $task['task_id'] , '>Edit</a>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/cmd_delete_task?task_id=', $task['task_id'] , '>Delete</a>'; ?>
		</div>
	</div>

<?php endforeach;?> 
-->

<div class="main_form">
				<section class="main">

					<div class="form_list_item list_item">
						<div class="cell ce"><?php echo '' ,$task['task_name']; ?></div>
						<div class="cell ce"><?php echo 'Категория: ' ,$task['category_name']; ?></div>
						<div class="cell ce block_green"><?php echo 'Статус: ' ,$task['status_name']; ?></div>
						<div class="ce cell_icons">
							<div class="edit"><?php echo '<a href=/task?task_id=', $task['task_id'] , '><img src="image/icon_edit.png" alt=""></a>'; ?></div>
							<div class="delete"><?php echo '<a href=/cmd_delete_task?task_id=', $task['task_id'] , '><img src="image/icon_delete.png" alt=""></a>'; ?></div>
						</div>
					</div>

					<div class="form_list_item list_item">
						<div class="cell ce">Настройки работы DNS</div>
						<div class="cell ce">Консул</div>
						<div class="cell ce block_orange"></div>
						<div class="ce cell_icons">
							<div class="edit"><img src="image/icon_edit.png" alt=""></div>
							<div class="delete"><img src="image/icon_delete.png" alt=""></div>
						</div>
					</div>


					<div class="form_list_item list_item">
						<div class="cell ce">Системы контроля за кодом и изменениями</div>
						<div class="cell ce">Разработка Веб приложений</div>
						<div class="cell ce block_grey"></div>
						<div class="ce cell_icons">
							<div class="edit"><img src="image/icon_edit.png" alt=""></div>
							<div class="delete"><img src="image/icon_delete.png" alt=""></div>
						</div>
					</div>


					<div class="form_list_item list_item">
						<div class="ce cell">Тестовая работа</div>
						<div class="ce cell">Тестирование</div>
						<div class="ce cell block_red"></div>
						<div class="ce cell_icons">
							<div class="edit"><img src="image/icon_edit.png" alt=""></div>
							<div class="delete"><img src="image/icon_delete.png" alt=""></div>
						</div>
					</div>
				</section>

				<aside class='sidebar'>
					<form action="" method="post" class='container_search'>
						<input type="search" name="" placeholder="поиск" class="form_search" />
						<input type="submit" name="" value="" class="search_icon" />
					</form>

					<a href="#" class=""><button class='form_button' style='width:100%'>Добавить</button></a><br>
				</aside>
			</div>


<!-- <?php #print_r($task_list); ?>
	
	<div class="list_new_item">
		<a href=/index.php/new_task>Добавить новую задачу</a>
	</div>

-->

<div class="main_form">
				<section class="main">
				
				<?php foreach ($task_list as $task) : ?>

					<div class="form_list_item list_item">
						<div class="cell ce"><?php echo '' ,$task['task_name']; ?></div>
						<div class="cell ce"><?php echo 'Категория: ' ,$task['category_name']; ?></div>
						<div class="cell ce block_color" style="background-color: <?php echo $task['status_color'];?>;"><?php //echo 'Статус: ' ,$task['status_name']; ?></div>
						<div class="ce cell_icons">
							<div class="edit"><?php echo '<a href=/task?task_id=', $task['task_id'] , '><img src="image/icon_edit.png" alt=""></a>'; ?></div>
							<div class="delete"><?php echo '<a href=/cmd_delete_task?task_id=', $task['task_id'] , '><img src="image/icon_delete.png" alt=""></a>'; ?></div>
						</div>
					</div>

				<?php endforeach;?> 
				
				</section>

				<aside class='sidebar'>
					<form action="" method="post" class='container_search'>
						<input type="search" name="" placeholder="поиск" class="form_search" />
						<input type="submit" name="" value="" class="search_icon" />
					</form>

					<a href="#" class=""><button class='form_button' style='width:100%'>Добавить</button></a><br>
				</aside>
			</div>


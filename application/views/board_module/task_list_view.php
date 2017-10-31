	<?php #print_r($task_list); ?>
	
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
			<?php echo '<a href=/index.php/task?task_id=', $task['task_id'] , '>Edit</a>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/index.php/cmd_delete_task?task_id=', $task['task_id'] , '>Delete</a>'; ?>
		</div>
	</div>

<?php endforeach;?>
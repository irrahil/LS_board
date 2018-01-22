	<?php #print_r($schedule_list); ?>
	
	<div class="list_new_item">
		<a href=/index.php/new_entry>Добавить новую запись в расписание</a>
	</div>

<?php foreach ($schedule_list as $record) : ?>

	<div class="list_item">
		<div class="list_col">
			<?php echo 'Пользователь: ' ,$record['user_name']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Дата: ' ,$record['schedule_date']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Время начала: ' ,$record['schedule_time_begin']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Время окончания: ' ,$record['schedule_time_end']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Комментарии: ' ,$record['comments']; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/user_entry?rec_id=', $record['rec_id'] , '>Edit</a>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/cmd_delete_schedule?rec_id=', $record['rec_id'] , '>Delete</a>'; ?>
		</div>
	</div>

<?php endforeach;?>
<div class="content-white">
<?php #print_r($schedule_list); ?>
	
	<div class="list_new_item page__add-new">
		<span>Добавить новую запись в расписание</span>
		<a class="add-btn" href=/index.php/new_entry>Добавить</a>
	</div>
	<div class="page-schedule__items">
	<?php foreach ($schedule_list as $record) : ?>
	  <div class="page-schedule__list-wrap">
			<div class="list_item page-schedule__list">
				<div class="list_col">
					<?php echo '' ,$record['schedule_date']; ?>
				</div>
				<div class="list_col">
					<div class="list_col-item">
						<?php echo '' ,$record['user_name']; ?>
					</div>
					
					<?php echo '' ,$record['schedule_time_begin']; ?>
					<?php echo ' - '?>
					<?php echo '' ,$record['schedule_time_end']; ?>
				</div>
				<div class="list_col">
					<?php echo 'Комментарии: ' ,$record['comments']; ?>
				</div>
				<div class="list_ctrl page-schedule__edit">
					<?php echo '<a href=/user_entry?rec_id=', $record['rec_id'] , '>
					<img src="image/icon_edit.png" alt="Редактировать">
					</a>'; ?>

					<?php echo '<a href=/cmd_delete_schedule?rec_id=', $record['rec_id'] , '>
					<img src="image/icon_delete.png" alt="Удалить">
					</a>'; ?>
				</div>
			</div>			
		</div>


	<?php endforeach;?>
	</div>
</div>
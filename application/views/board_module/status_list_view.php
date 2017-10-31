	<div class="list_new_item">
		<a href=/index.php/new_status>Добавить новый статус</a>
	</div>

<?php foreach ($status_list as $status) : ?>

	<div class="list_item">
		<div class="list_col">
			<?php echo '<font color="', $status['status_color'], '">' ,$status['status_name'], '</font>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/index.php/status?status_id=', $status['status_id'] , '>Edit</a>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/index.php/cmd_delete_status?status_id=', $status['status_id'] , '>Delete</a>'; ?>
		</div>
	</div>

<?php endforeach;?>
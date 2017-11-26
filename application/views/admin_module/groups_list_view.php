<?php #print_r($groups); ?>

<div class="list_new_item">
		<a href=/index.php/new_task>Добавить новую группу</a>
	</div>

<?php foreach ($groups as $group) : ?>
	<div class="list_item">
		<div class="list_col">
			<?php echo 'ID: ' ,$group['group_id']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Логин: ' ,$group['group_name']; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href="/groups?group_id=', $group['group_id'] , '">Edit</a>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href="/cmd_delete_group?group_id=', $group['group_id'] , '">Delete</a>'; ?>
		</div>
	</div>

<?php endforeach;?>
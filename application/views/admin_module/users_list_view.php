<?php #print_r($users); ?>

<div class="list_new_item">
		<a href=/index.php/new_user>Добавить нового пользователя вручную</a>
	</div>

<?php foreach ($users as $user) : ?>
	<div class="list_item">
		<div class="list_col">
			<?php echo 'ID: ' ,$user['user_id']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Логин: ' ,$user['user_login']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Имя пользователя: ' ,$user['user_name']; ?>
		</div>
		<div class="list_col">
			<?php echo 'Почта: ' ,$user['user_email']; ?>
		</div>
		<div class="list_col">
			<?php if ($user['is_admin']) { echo 'Администратор'; } ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/edit_user?user_id=', $user['user_id'] , '>Edit</a>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/cmd_delete_user?user_id=', $user['user_id'] , '>Delete</a>'; ?>
		</div>
	</div>

<?php endforeach;?>
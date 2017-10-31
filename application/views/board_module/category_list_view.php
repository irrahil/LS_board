	<?php #print_r($category_list); ?>
	
	<div class="list_new_item">
		<a href=/index.php/new_cat>Добавить новую категорию задач</a>
	</div>

<?php foreach ($category_list as $category) : ?>

	<div class="list_item">
		<div class="list_col">
			<?php echo 'Наименование: ' ,$category['category_name']; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/index.php/cat?category_id=', $category['category_id'] , '>Edit</a>'; ?>
		</div>
		<div class="list_ctrl">
			<?php echo '<a href=/index.php/cmd_delete_category?category_id=', $category['category_id'] , '>Delete</a>'; ?>
		</div>
	</div>

<?php endforeach;?>
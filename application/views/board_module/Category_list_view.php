<div class="content-white">
		<?php #print_r($category_list); ?>
		
		<div class="list_new_item page__add-new">
			<span>Добавить новую категорию задач</span>
			<a class="add-btn" href=/index.php/new_cat>Добавить</a>
		</div>

	<?php foreach ($category_list as $category) : ?>

		<div class="list_item page-cat__list_item ">
			<div class="list_col page-cat__list_col">
				<?php echo ' ' ,$category['category_name']; ?>
			</div>
			<div class="list_col-username">
				<?php echo ' ' ,$category['category_name']; ?>
			</div>
			<!-- вставить поле Пользователь -->
			<div class="list_ctrl btns">
				<?php echo '<a href=/cat?category_id=', $category['category_id'] , '>
				<img src="image/icon_edit.png" alt="Редактировать">
				</a>'; ?>
			</div>
			<div class="list_ctrl btns">
				<?php echo '<a href=/cmd_delete_category?category_id=', $category['category_id'] , '>
				<img src="image/icon_delete.png" alt="Удалить">
				</a>'; ?>
			</div>
		</div>

	<?php endforeach;?>
</div>

<?php #print_r($board_info); ?>

<div class="main_form">


	<section class="main">
		<?php foreach($board_info AS $board_entry) : ?>
			<tr style="color: <?php echo $board_entry['status_color']; ?>; 
				<?php if ($board_entry['schedule_date'] == date_create("now", new DateTimeZone("Europe/Moscow") )->format("Y-m-d") )
				echo " font-weight: bold;";
				else
					echo " font-size: 80%;";
				?>">
				<div class="form_list_item">
					<div class="cell"><?php echo $board_entry['user_name']; ?></div>
					<div class="cell"><?php echo $board_entry['schedule_date']; ?></div>
					<div class="cell"><?php echo $board_entry['schedule_time_begin'], ' - ', $board_entry['schedule_time_end']; ?>
						
					</div>
					<div class="cell"><?php echo $board_entry['task_name'], ' (', $board_entry['category_name'], ')'; ?></div>
					<div class="cell_icons">
						<div class="edit"><?php echo '<a href="/board_entry?rec_id=', $board_entry['rec_id'], '"><img src="image/icon_edit.png" alt=""></a>'; ?></div>
						<div class="delete"><?php echo '<a href="/cmd_delete_entry?rec_id=', $board_entry['rec_id'], '"><img src="image/icon_delete.png" alt=""></a>'; ?></div>
					</div>
				</div>
			<div class="navigation__arrows">
				<a href="#"><i class="icon icon-left" aria-hidden="true"></i></a>
				<a href="#"><i class="icon icon-right" aria-hidden="true"></i></a>
			</div>
			<?php endforeach; ?>	
			
			
	</section>


	<aside class='sidebar'>
		<form action="" method="post" class='container_search'>
			<input type="search" name="" placeholder="поиск" class="form_search" />
			<input type="submit" name="" value="" class="search_icon" />
		</form>

		<a href=/index.php/new_board_entry><button class='form_button' style='width:100%'>Добавить</button></a><br>

		<select name="filter_list" class="form_filter">
			<option value="none">--Фильтр--</option>
			<option value="user_name">Имя пользователя</option>
			<option value="date_time">Дата и время</option>
		</select>
		<input type="text" name="filter_value" id="user_name_filter" value="">
		<input type="date" name="filter_value" class="date" id="date_begin_filter">
		<input type="date" name="filter_value" class="date" id="date_end_filter">
		<input type="time" name="filter_value" class="time" id="time_begin_filter">
		<input type="time" name="filter_value" class="time" id="time_end_filter">
		
	</aside>

		</div>
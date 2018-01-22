<!-- <?php #print_r($board_info); ?>

<div class="board">

	<table border=1 width=100%>
		<?php foreach($board_info AS $board_entry) : ?>
			<tr style="color: <?php echo $board_entry['status_color']; ?>; 
				      <?php if ($board_entry['schedule_date'] == date_create("now", new DateTimeZone("Europe/Moscow") )->format("Y-m-d") )
								echo " font-weight: bold;";
							else
								echo " font-size: 80%;";
					  ?>">
				<td>
					<?php echo $board_entry['schedule_date']; ?>
				</td>
				<td>
					<?php echo $board_entry['user_name']; ?>
				</td>
				<td>
					<?php echo $board_entry['schedule_time_begin'], ' - ', $board_entry['schedule_time_end']; ?>
				</td>
				<td>
					<?php echo $board_entry['task_name'], ' (', $board_entry['category_name'], ')'; ?>
				</td>
				<td>
					<?php echo #'<font color="', $board_entry['status_color'], '">', 
								$board_entry['status_name']
								#, '</font>'; ?>
				</td>
				<td>
					<?php echo '<a href="/board_entry?rec_id=', $board_entry['rec_id'], '">Edit</a>'; ?>
				</td>
				<td>
					<?php echo '<a href="/cmd_delete_entry?rec_id=', $board_entry['rec_id'], '">Delete</a>'; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>

</div> -->

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
			<?php endforeach; ?>	
			</section>


			<aside class='sidebar'>
				<form action="" method="post" class='container_search'>
					<input type="search" name="" placeholder="поиск" class="form_search" />
					<input type="submit" name="" value="" class="search_icon" />
				</form>

				<a href=/index.php/new_board_entry><button class='form_button' style='width:100%'>Добавить</button></a><br>

				<select name="carlist" form="carform" class="form_filter">
					<option>--Фильтр--</option>
					<option>Имя пользователя</option>
					<option>Дата и время</option>
				</select>
				<input type="text" id="user_name" value="">
				<input type="date" name="" id="date_begin">
				<input type="date" name="" id="date_end">
				<input type="time" name="" id="time_begin">
				<input type="time" name="" id="time_end">
				
			</aside>

		</div>
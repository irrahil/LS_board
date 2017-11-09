<?php #print_r($board_info); ?>

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

</div>
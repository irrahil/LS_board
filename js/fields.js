function activateField(fieldName) {
	document.getElementsByName(fieldName)[0].value = true;
}



function changeFilterVisible(filter_name) {
	var filter_values = document.getElementsByName('filter_value');
	for (var i = 0; i < filter_values.length; i++)
		filter_values[i].style.display = 'none';
	
	var filter_value = this.value;
	if (filter_value == "user_name") {
		document.getElementById('user_name_filter').style.display = 'block';
	}
	if (filter_value == 'date_time') {
		document.getElementById('date_begin_filter').style.display = 'block';
		document.getElementById('date_end_filter').style.display = 'block';
		document.getElementById('time_begin_filter').style.display = 'block';
		document.getElementById('time_end_filter').style.display = 'block';
	}
}
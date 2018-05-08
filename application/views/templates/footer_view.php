            </div>
	        <div class="right_board"></div>
	        </div>  <!-- class="middle" -->
        <div class="bottom_board">
            <!--<hr><em>&copy; 2018</em>-->
        </div>
      
	</div>
		

<!--JAVA SCRIPT-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="/libs/slick/slick.min.js"></script>
	
	</body>
	
	
	<script>
		var date = document.getElementsByClassName('date'),
			time = document.getElementsByClassName('time');
		for(var i = 0; i < date.length; i++) {
			date[i].addEventListener('keyup', test);
			date[i].addEventListener('change', check_date);
		}
		for(var i = 0; i < time.length; i++) {
			time[i].addEventListener('keyup', test);
			time[i].addEventListener('change', check_time);
		}
		var filter_list = document.getElementsByName('filter_list');
		for (var i = 0; i < filter_list.length; i++) 
			filter_list[i].addEventListener('change', changeFilterVisible);
		
		changeFilterVisible();
		
		function test() {
		   var value = this.value; 
			var rep = /[\.;"'a-zA-Zа-яА-Я]/; 
			if (rep.test(value)) { 
				value = value.replace(rep, ''); 
				this.value = value; 
			} 
		}
		function check_time() {
		  var reg_exp = /^\d{2}:\d{2}:\d{2}$/;
		  var reg_exp2 = /^\d{2}:\d{2}$/;
			if(reg_exp.test(this.value) || reg_exp2.test(this.value) ) {
				return true;
			} else {
				alert("Время следует ввести в формате hh:mm:ss");
				this.value = "";
				return false;
			}
		}
		function check_date() {
		  var reg_exp = /^\d{4}-\d{2}-\d{2}$/;
			if(reg_exp.test(this.value)) {
				return true;
			} else {
				alert("Дату следует ввести в формате yyyy-mm-dd");
				this.value = "";
				return false;
			}
		}

		$(document).ready(function(){
      $('.page-schedule__items').slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
				dots: false,
				prevArrow: '<i class="icon icon-left slider-arrows slider-arrow-left"></i>',
    		nextArrow: '<i class="icon icon-right slider-arrows slider-arrow-right"></i>',
				rows: 2,
				slidesPerRow: 3,
			});
    });
	</script>
</html>
$('input:radio[name="type"]').change(function(){
        if (this.checked && this.value == 'painting') {
			$(".paint").show();
			$(".draw").hide();
			$(".sculpt").hide();
			$(".print").hide();
        }else if (this.checked && this.value == 'drawing'){
			$(".paint").hide();
			$(".draw").show();
			$(".sculpt").hide();
			$(".print").hide();
		}else if (this.checked && this.value == 'sculpture'){
			$(".paint").hide();
			$(".draw").hide();
			$(".sculpt").show();
			$(".print").hide();
		}else if (this.checked && this.value == 'printmaking'){
			$(".paint").hide();
			$(".draw").hide();
			$(".sculpt").hide();
			$(".print").show();
		}
});


$(document).ready(function() {
	//Initially the extra forms will be hidden.
	$('.paint').hide();
	$('.draw').hide();
	$('.sculpt').hide();
	$('.print').hide();
	
});
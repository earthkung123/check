	function getMajor(val) {
	$.ajax({
	type: "POST",
	url: "get_major.php",
	data:'Faculty_ID='+val,
	success: function(data){
	$("#major-list").html(data);
	}
	});
	}
	function clearYears(val) {
		$.ajax({
			type: "POST",
			url: "clear_year.php",
			data:'Faculty_ID='+val,
			success: function(data){
			$("#year-list").html(data);
		}
	});
	}
	function getYears(val) {
		$.ajax({
			type: "POST",
			url: "get_year.php",
			data:'Major_ID='+val,
			success: function(data){
			$("#year-list").html(data);
		}
	});
	}

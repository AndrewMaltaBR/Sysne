$("#login").submit(function (e) {
	e.preventDefault();
	var data = getData($('#login :input'));
	$.ajax({
		url: "http://localhost/sysne/api/rest.php",
		type: "POST",
		data: data,
		success: function(json) {
			$('#login input[name="return"]').val(json);
			if(json != 0) {
				$("#login").unbind().submit();
			}
		}
	});
});

function getData(inputs) {
	var data = {};
	inputs.each(function() {
		if($(this).is("input"))
			data[$(this).attr("name")] = $(this).val();
	});
	return data;
}
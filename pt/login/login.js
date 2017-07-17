$(function(){
	$("#login").validate();
});

$("#login").submit(function (e) {
	e.preventDefault();
	var data = getData($('#login :input'));
	if(data != null)
		$.ajax({
			url: "http://localhost/sysne/api/rest.php",
			type: "POST",
			data: data,
			success: function(json) {
				$('#login input[name="return"]').val(json);
				console.log(json);
				if(json == 0) {
				}
				else if(json == -1) {
				}
				else if(JSON.parse(json)) {
					$("#login").unbind().submit();
				}
			}
		});
});

function getData(inputs) {
	var data = {};
	var empty = false;
	inputs.each(function() {
		if($(this).is("input")) {
			if(!$(this).val())
				empty = true;
			else
				data[$(this).attr("name")] = $(this).val();
		}
	});
	if(empty)
		data = null;
	return data;
}
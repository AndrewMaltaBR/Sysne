$(function(){
	$("#cadastro").validate();
});


$("#cadastro").submit(function (e) {
	e.preventDefault();
	var data = getData($('#cadastro :input'));
	if(data != null && data.senha == data.senha2)
		$.ajax({
			url: "http://localhost/sysne/api/rest.php",
			type: "POST",
			data: data,
			success: function(json) {
				$('#cadastro input[name="return"]').val(json);
				if(JSON.parse(json)) {
					$("#cadastro").unbind().submit();
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
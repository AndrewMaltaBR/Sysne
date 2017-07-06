$("#cadastro").submit(function (e) {
	e.preventDefault();
	var data = getData($('#cadastro :input'));
	if(data.senha == data.senha2)
		$.ajax({
			url: "http://localhost/sysne/api/rest.php",
			type: "POST",
			data: data,
			success: function(json) {
				if(json != 0) {
					setSession(json);
					window.location.replace("../index.php");
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
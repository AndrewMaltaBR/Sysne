$(function(){
	$("#cadastro").validate({
			rules: {
				senha2: {
					equalTo: "[name='senha']"
				},
			},
			messages: {
				senha2: {
					equalTo: "As senhas não correspondem."
				}
			}
		});
});
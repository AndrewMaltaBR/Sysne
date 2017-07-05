$.ajax({
	url: "http://olar.esy.es/api/rest.php",
	type: "POST",
	data: {
		method: "select_planos"
	},
	success: function(data) {
		data = JSON.parse(data);
		
		for(var i=0;i<data.length;i++) {
			$("#pt_nome"+(i+1)).html(data[i].pt_nome);
			$("#pt_descricao"+(i+1)).html(data[i].pt_descricao);
			$("#en_nome"+(i+1)).html(data[i].pt_nome);
			$("#en_descricao"+(i+1)).html(data[i].pt_descricao);
			$("#produtos"+(i+1)).html(data[i].produtos+" produtos");
			$("#vendedores"+(i+1)).html(data[i].vendedores+" vendedores");
			$("#valor"+(i+1)).html("R$ "+data[i].valor+" mensais");
		}
	}
});
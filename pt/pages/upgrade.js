$.ajax({
	url: "http://olar.esy.es/api/rest.php",
	type: "POST",
	data: {
		method: "select_planos"
	},
	success: function(data) {
		data = JSON.parse(data);
		
		for(var i=0;i<data.length;i++) {
			$("#planos").append("<label class=\"radio\">"+
                "<input type=\"radio\" name=\"id_plano\" value=\""+data[i].id_plano+"\" required />"
                "<div class=\"inner\">"+
                  "<h3 class=\"title\"><div class=\"logo dark\" style=\"width: 28px;height: 28px;\"></div>"+data[i].pt_nome+"</h3>"+
                  "<p>"+data[i].pt_descricao+"</p>"+
                  "<p id=\"produtos"+i+"\">Produtos: </p>";
                  "<p id=\"vendedores"+i+"\">vendedores: </p>";
                  "<p id=\"valor"+i+"\"></p>";
                "</div>"+
             "</label>");
			if(data[i].produtos != 99)
				$("#produtos"+i).append(data[i].produtos);
			else
				$("#produtos"+i).append("ilimitado");
		}
	}
});
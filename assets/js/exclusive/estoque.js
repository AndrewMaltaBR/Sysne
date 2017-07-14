$("title").html("Sysne - Estoque");

$.get("../session/get_session.php",function (session) {
	if(session != 0) {
		session = JSON.parse(session);
		$.ajax({
			url: "http://localhost/sysne/api/rest.php",
			type: "POST",
			data: {
				class: "empresa",
				method: "select_produtos",
				id_empresa: session.id_empresa
			},
			success: function(data) {
				var produto = JSON.parse(data);
				
				if(produto.length == 0)
					$("#estoque").html("Sem produtos");
				for(var i=0;i<produto.length;i++) {
					$("#estoque").append('<section class="card product">'+
										    '<div class="title">'+produto[i].nome+'</div>'+
										    '<div class="image" style="background-image: url(\'../assets/img/'+produto[i].imagem+'\');"></div>'+
										    '<div class="col-1 details">'+produto[i].descricao+'</div>'+
										    '<div class="col-2">'+
										      '<div class="preco">R$ '+produto[i].preco+'</div>'+
										      '<div class="quantidade">Quantidade: '+produto[i].quantidade+'</div>'+
										    '</div>'+
										  '</section>');
				}
			}
		});
	}
});


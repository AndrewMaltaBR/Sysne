$(function(){

	$("[data-target='confirmar-venda']").click(function(){
		var id_venda = $(this).attr("id_venda");
		$("#confirmar-venda-form input[name='id_venda']").attr("value",id_venda);
	});

	$("#filtro").keyup(function(){
	    var texto = $(this).val();
	    $(".accordion").each(function(){
			var resultado = $(this).text().toUpperCase().indexOf(texto.toUpperCase());
			if(resultado < 0) {
				$(this).fadeOut();
			}else {
				$(this).fadeIn();
			}
	    });

	});
});
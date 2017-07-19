$(function(){
	$("#cad-produto-form").validate();

	$("#filtro").keyup(function(){
	    var texto = $(this).val();
	    $(".product").each(function(){
			var resultado = $(this).text().toUpperCase().indexOf(texto.toUpperCase());
			if(resultado < 0) {
				$(this).fadeOut();
			}else {
				$(this).fadeIn();
			}
	    });

	});
});
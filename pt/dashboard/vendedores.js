$(function(){
	$("#cad-vendedor-form").validate({
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

	$("[data-target='edit-vendedor']").click(function(){
		var id_vendedor = $(this).attr("id_vendedor");
		$("#edit-vendedor-form input[name='id_vendedor']").attr("value",id_vendedor);
		var json = $("input#vendedor"+id_vendedor).val();
		var vendedor = JSON.parse(json);
		$("#edit-vendedor-form input[name='nome']").attr("value",vendedor.nome);
		$("#edit-vendedor-form input[name='email']").attr("value",vendedor.email);
	});

	$("[data-target='bloquear-vendedor']").click(function(){
		var id_vendedor = $(this).attr("id_vendedor");
		$("#bloquear-vendedor-form input[name='id_vendedor']").attr("value",id_vendedor);
	});

	$("[data-target='desbloquear-vendedor']").click(function(){
		var id_vendedor = $(this).attr("id_vendedor");
		$("#desbloquear-vendedor-form input[name='id_vendedor']").attr("value",id_vendedor);
	});

	$("#filtro").keyup(function(){
	    var texto = $(this).val();
	    $("tr.vendedor").each(function(){
			var resultado = $(this).text().toUpperCase().indexOf(texto.toUpperCase());
			if(resultado < 0) {
				$(this).fadeOut();
			}else {
				$(this).fadeIn();
			}
	    });

	});
});
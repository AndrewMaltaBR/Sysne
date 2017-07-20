$(function(){
	$("#cad-produto-form").validate();
	$("#edit-produto-form").validate();
	$("#entrada-produto-form").validate();

	$("[data-target='edit-produto']").click(function(){
		var id_produto = $(this).attr("id_produto");
		$("#edit-produto-form input[name='id_produto']").attr("value",id_produto);
		var json = $("input#produto"+id_produto).val();
		var produto = JSON.parse(json);
		$("#edit-produto-form input[name='nome']").attr("value",produto.nome);
		$("#edit-produto-form input[name='descricao']").attr("value",produto.descricao);
		$("#edit-produto-form input[name='valor']").attr("value",produto.valor);
		$("#edit-produto-form input[name='unidade_medida']").attr("value",produto.unidade_medida);
		$("#edit-produto-form img.preview").attr("src","../../assets/img/upload/"+produto.imagem);
	});

	$("#edit-produto-form input[type='file']").change(function(){
		$("#edit-produto-form input[name='mudar_imagem']").attr('checked', true);
	});

	$("[data-target='entrada-produto']").click(function(){
		var id_produto = $(this).attr("id_produto");
		$("#entrada-produto-form input[name='id_produto']").attr("value",id_produto);
	});

	$("[data-target='bloquear-produto']").click(function(){
		var id_produto = $(this).attr("id_produto");
		$("#bloquear-produto-form input[name='id_produto']").attr("value",id_produto);
	});

	$("[data-target='desbloquear-produto']").click(function(){
		var id_produto = $(this).attr("id_produto");
		$("#desbloquear-produto-form input[name='id_produto']").attr("value",id_produto);
	});

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
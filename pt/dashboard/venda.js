$(function(){
	$("#cad-venda-form").validate();


	$("[id_produto]").click(function(){
		var id_produto = $(this).attr("id_produto");
		var produto = JSON.parse($("input#produto"+id_produto).val());
		var inputs = $("#inputs");
		$("#inputs").append('<tr id="td-'+id_produto+'">'+
								'<td><a class="btn little" id_produto_dismiss='+produto.id_produto+'><i class="fa fa-times" style="margin: 0;"></i></a>&nbsp;'+produto.nome+'</td>'+
								'<td><input type="number" style="margin:0" max="'+produto.quantidade+'" name="quantidade-'+id_produto+'" placeholder="Quantidade" required/></td>'+
								'<td><input type="hidden" name="valor-'+id_produto+'" value="'+produto.valor+'"/>R$ '+produto.valor+' '+produto.unidade_medida+'</td>'+
								'<td id="total-'+id_produto+'">R$ 0.00</td>'+
							'</tr>');
		$(this).closest(".card").fadeOut().addClass("hide");

		$("[id_produto_dismiss]").click(function(){
			var id_produto = $(this).attr("id_produto_dismiss");
			$("[id_produto='"+id_produto+"']").closest(".card").fadeIn().removeClass("hide");
			$("tr#td-"+id_produto).remove();
			setTotal();
		});

		$("input[name^='quantidade-']").keyup(function(){
			setTotal();
		});
	});

	function setTotal() {
		var total = 0;
    	$("input[name^='quantidade-']").each(function(){
    		var texto = $(this).attr("name");
	    	var id_produto = texto.split("-");
	    	id_produto = id_produto[1];
	    	var valor = 0;
	    	if(parseFloat($("input[name='quantidade-"+id_produto+"']").val()))
	    		valor = parseFloat($("input[name='quantidade-"+id_produto+"']").val()) * parseFloat($("input[name='valor-"+id_produto+"']").val())
	    	valor = parseFloat(Math.round(valor * 100) / 100).toFixed(2);
	    	$("td#total-"+id_produto).html("R$ "+valor);
	    	total += parseFloat(valor);
    	});
    	$("#total").html("Total: R$ "+total);
	}

	$("#filtro").keyup(function(){
	    var texto = $(this).val();
	    $(".card:not(.hide)").each(function(){
			var resultado = $(this).text().toUpperCase().indexOf(texto.toUpperCase());
			if(resultado < 0) {
				$(this).fadeOut();
			}else {
				$(this).fadeIn();
			}
	    });

	});
});
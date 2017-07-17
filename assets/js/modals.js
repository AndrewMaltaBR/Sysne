/* modal events */

$("[data-toggle='modal']").on('click',function (){
	var id_modal = $(this).attr("data-target");
	$("#"+id_modal).addClass("show");
});

$(".modal *").on('click',function(e) {
	e.stopPropagation();
});

$(".modal").on('click',function(e){
	$(this).removeClass("show");
	$(this).find("form")[0].reset();
});

$("[data-close='modal']").on('click',function(){
	$(this).closest(".modal").removeClass("show");
	$(this).closest(".modal").find("form")[0].reset();
});
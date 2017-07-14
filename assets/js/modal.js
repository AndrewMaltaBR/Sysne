/* modal events */

$("[data-toggle='modal']").on('click',function (){
	var id_modal = $(this).attr("data-target");
	console.log(this);
	$("#"+id_modal).addClass("show");
});

$(".modal *").on('click',function(e) {
	e.stopPropagation();
});

$(".modal").on('click',function(e){
	$(this).removeClass("show");
});

$("[data-close='modal']").on('click',function(){
	$(this).closest(".modal").removeClass("show");
});
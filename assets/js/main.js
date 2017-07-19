/* nav events */

$(".btn-nav").click(function () {
	var nav = $(".nav");
	var main = $(".main");

	nav.toggleClass("show");
	main.toggleClass("show");
});

$("[page]").click(function () {
	page = $(this).attr("page");
	loadCurrentPage();
});

/* refresh */

$("[refresh]").click(function(){
	location.reload();
});

/* image upload */

$("label.image-upload input[type='file']").change(function(){
	if (typeof (FileReader) != "undefined") {
        var img = $(this).closest("label.image-upload").children("img.preview");
        var reader = new FileReader();
        reader.onload = function (e) {
			img.attr("src",e.target.result);
        }
        reader.readAsDataURL($(this)[0].files[0]);
    }
});

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
	$(this).find(".preview").attr("src","../assets/img/upload.png");
});

$("[data-close='modal']").on('click',function(){
	$(this).closest(".modal").removeClass("show");
	$(this).closest(".modal").find("form")[0].reset();
	$(this).closest(".modal").find("img.preview").attr("src","../assets/img/upload.png");
});

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
	$(this).find(".preview").attr("src","../../assets/img/upload.png");
});

$("[data-close='modal']").on('click',function(){
	$(this).closest(".modal").removeClass("show");
	$(this).closest(".modal").find("form")[0].reset();
	$(this).closest(".modal").find("img.preview").attr("src","../../assets/img/upload.png");
});

/* functions */
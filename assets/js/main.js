/* initialize */

var page = "estatisticas";
var session = null;
loadCurrentPage();

$.get("../session/get_session.php",function(json){
	session = JSON.parse(json);
});

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
	loadCurrentPage();
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

/* functions */

function loadCurrentPage() {
	$(".main").load("pages/"+page+".php",function(response, status, xhr) {
		if(status != "error") {
			$(".nav a.active").removeClass("active");
			$(".nav a[page='"+page+"']").addClass("active");
		}
	});
}

function getData(inputs) {
	var data = {};
	var empty = false;
	inputs.each(function() {
		if($(this).is("input")) {
			if(!$(this).val())
				empty = true;
			else
				data[$(this).attr("name")] = $(this).val();
		}
	});
	if(empty)
		data = null;
	return data;
}
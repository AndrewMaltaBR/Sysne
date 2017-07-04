/* initialize */

var page = "estatisticas";
loadCurrentPage();

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

/* functions */

function loadCurrentPage() {
	$(".main").load("pages/"+page+".php",function(response, status, xhr) {
		if(status != "error") {
			$(".nav a.active").removeClass("active");
			$(".nav a[page='"+page+"']").addClass("active");
		}
	});
}
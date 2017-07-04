
/* nav events */

$(".btn-nav").click(function () {
	var nav = $(".nav");
	var main = $(".main");

	nav.toggleClass("show");
	main.toggleClass("show");
});
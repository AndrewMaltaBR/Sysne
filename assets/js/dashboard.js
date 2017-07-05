/* scroll events */

$(window).scroll(function () {
	var scroll = window.pageYOffset;
	if(scroll > 5)
		$(".header").addClass("scroll");
	else
		$(".header").removeClass("scroll");
});
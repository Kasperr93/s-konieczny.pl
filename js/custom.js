/* ============ NAVBAR TRANSPARENT TO SOLID ============ */
$(document).ready(function() {
	$(window).scroll(function() {

		if ($(this).scrollTop() > 300) {
			$('.navbar').addClass('solid');
		} else {
			$('.navbar').removeClass('solid');
		}
	});
});

/* ============ CLOSE MOBILE NAV ON CLICK ============ */
$(document).ready(function() {
	$(document).click(function(event) {
		var clickOver = $(event.target);
		var _opened = $(".navbar-collapse").hasClass("show");

		if (_opened === true && !clickOver.hasClass("navbar-toggler")) {
			$(".navbar-toggler").click();
		}
	});
});

/* ============ SMOOTH SCROLLING TO LINKS ============ */
$(document).ready(function() {
	$("a").on('click', function(event) {

		if (this.hash !== "") {
			event.preventDefault();

			var hash = this.hash;
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 800, function() {
				window.location.hash = hash;
			});
		}
	});
});

/* ============ BOUNCING DOWN ARROW ============ */
$(document).ready(function() {
	$(window).scroll(function() {
		$(".arrow").css("opacity", 1 - $(window).scrollTop() / 200);
	});
});

/* ============ CLIENTS CAROUSEL ============ */
$(document).ready(function() {
	$("#clients-slider").owlCarousel({
		items: 2,
		autoplay: true,
		smartSpeed: 1700,
		loop: true,
		autoplayHoverPause: true,

		responsive : {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
		}
	});
});

/* ============ TOP SCROLL ============ */
$(document).ready(function() {
	$(window).scroll(function() {
		if ($(this).scrollTop() > 500) {
			$('.top-scroll').fadeIn();
		} else {
			$('.top-scroll').fadeOut();
		}
	});
});
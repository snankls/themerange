(function($) {
	
	"use strict";
	
	var partners_js = function($scope, $) {
		
		// Odometer
		var swiperClientLogo = new Swiper(".client_logo_carousel", {
			loop: true,
			speed: 2000,
			freeMode: true,
			centeredSlides: true,
			allowTouchMove: true,
			autoplay: {
				delay: 1,
				disableOnInteraction: true,
			},
			breakpoints: {
				376: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 4,
				},
				1025: {
					slidesPerView: 7,
				},
			},
		});
		
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-partners.default', partners_js);
    });	

})(window.jQuery);
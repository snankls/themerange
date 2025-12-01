(function($) {
	
	"use strict";
	var slider_js = function($scope, $) {
		
		// Main Slider
		var slider = new Swiper('.tr-swiper', {
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			autoplay: {
				enabled: true,
				delay: 6000
			},
			// Navigation arrows
			navigation: {
				nextEl: '.main-slider-next',
				prevEl: '.main-slider-prev',
				clickable: true,
			},
			//Pagination
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			speed: 500,
			breakpoints: {
				'1600': {
					slidesPerView: 1,
				},
				'1200': {
					slidesPerView: 1,
				},
				'992': {
					slidesPerView: 1,
				},
				'768': {
					slidesPerView: 1,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});
		
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-slider.default', slider_js);
    });	

})(window.jQuery);
(function($) {
	
	"use strict";
	var swiper_js = function($scope, $) {
		
		// swiper slider
		function trSwiper() {
			if ($(".tr-swiper").length) {
			  $(".tr-swiper").each(function () {
				let elm = $(this);
				let options = elm.data('swiper-options');
				let thmSwiperSlider = new Swiper(elm, options);
			  });
			}
		  }
		  
		  trSwiper();
		
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-slider.default', swiper_js);
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-gallery.default', swiper_js);
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-team.default', swiper_js);
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-services.default', swiper_js);
    });	

})(window.jQuery);
(function($) {
	
	"use strict";
	
	var facts_counter_js = function($scope, $) {
		
		// Odometer
		if ($(".odometer").length) {
			$('.odometer').appear();
			$('.odometer').appear(function(){
				var odo = $(".odometer");
				odo.each(function() {
					var countNumber = $(this).attr("data-count");
					$(this).html(countNumber);
				});
				window.odometerOptions = {
					format: 'd',
				};
			});
		}
		
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-facts_counter.default', facts_counter_js);
    });	

})(window.jQuery);
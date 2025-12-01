(function($) {
	
	"use strict";
	
	var load_more_js = function($scope, $) {
		
		$(document).ready(function($) {
			$(document).on('click', '.load-more', function(e) {
				e.preventDefault();
				
				var button = $(this);
				var paged = button.data('paged');
				var total_pages = button.data('total_pages');
				var atts = button.closest('.tr-news-v1').data('atts');
				
				$.ajax({
					url: themerange_params.ajaxurl,
					type: 'POST',
					data: {
						action: 'tr_blogs_load_items',
						paged: paged,
						atts: atts
					},
					beforeSend: function() {
						button.text(atts.loading_text);
					},
					success: function(response) {
						if (response) {
							button.closest('.auto-container').find('.blogs').append(response);
							button.data('paged', paged + 1);
							if (paged + 1 > total_pages) {
								button.remove();
							} else {
								button.text(atts.load_more_text);
							}
						} else {
							button.remove();
						}
					}
				});
			});
		});
		
	};
	
	$(window).on('elementor/frontend/init', function () {
    	elementorFrontend.hooks.addAction('frontend/element_ready/tr-news.default', load_more_js);
    });	

})(window.jQuery);

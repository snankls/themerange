(function($) {
	
	"use strict";
	
	var countdown_js = function($scope, $) {
		
		//Event Countdown Timer
		if($('.time-countdown').length){  
			$('.time-countdown').each(function() {
			var $this = $(this), finalDate = $(this).data('countdown');
			$this.countdown(finalDate, function(event) {
				var $this = $(this).html(event.strftime('' + '<div class="counter-column"><span class="count">%D</span>Days</div> ' + '<div class="counter-column"><span class="count">%H</span>Hours</div>  ' + '<div class="counter-column"><span class="count">%M</span>Minutes</div>  ' + '<div class="counter-column"><span class="count">%S</span>Seconds</div>'));
			});
		 });
		}
	
		if($('.clock-wrapper').length){  
			(function(){
				//generate clock animations
				var now       = new Date(),
					hourDeg   = now.getHours() / 12 * 360 + now.getMinutes() / 60 * 30,
					minuteDeg = now.getMinutes() / 60 * 360 + now.getSeconds() / 60 * 6,
					secondDeg = now.getSeconds() / 60 * 360,
					stylesDeg = [
						"@-webkit-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
						"@-webkit-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
						"@-webkit-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}",
						"@-moz-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
						"@-moz-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
						"@-moz-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}"
					].join("");
				document.getElementById("clock-animations").innerHTML = stylesDeg;
			})();
		}
		
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tr-countdown.default', countdown_js);
    });	

})(window.jQuery);
(function($) {
    "use strict";
    
    var marqueeInitialized = {
        design_one: false,
        design_two: false,
        design_three: false
    };

    var marquee_js = function($scope, $) {
        
        var design_one = $('#tr-marquee-v1-main');
        var design_two = $('#tr-marquee-v2-main');
        var design_three = $('#tr-marquee-v3-main');
        
        if (design_one.length && !marqueeInitialized.design_one) {
            marqueeInitialized.design_one = true;

            var item_speed1_1 = $('#tr-marquee-v1-1').data('speed');
            var item_gap1_1 = $('#tr-marquee-v1-1').data('gap');
            var item_direction1_1 = $('#tr-marquee-v1-1').data('direction');
            
            var item_speed1_2 = $('#tr-marquee-v1-2').data('speed');
            var item_gap1_2 = $('#tr-marquee-v1-2').data('gap');
            var item_direction1_2 = $('#tr-marquee-v1-2').data('direction');
            
            $('.tr-marquee-v1-1').marquee({
                speed: item_speed1_1,
                gap: item_gap1_1,
                delayBeforeStart: 0,
                direction: item_direction1_1,
                duplicated: true,
                pauseOnHover: true,
                startVisible: true,
            });
            
            $('.tr-marquee-v1-2').marquee({
                speed: item_speed1_2,
                gap: item_gap1_2,
                delayBeforeStart: 0,
                direction: item_direction1_2,
                duplicated: true,
                pauseOnHover: true,
                startVisible: true,
            });
        }
        
        if (design_two.length && !marqueeInitialized.design_two) {
            marqueeInitialized.design_two = true;

            var item_speed2 = $('#tr-marquee-v2').data('speed');
            var item_gap2 = $('#tr-marquee-v2').data('gap');
            var item_direction2 = $('#tr-marquee-v2').data('direction');
            
            $('.tr-marquee-v2').marquee({
                speed: item_speed2,
                gap: item_gap2,
                delayBeforeStart: 0,
                direction: item_direction2,
                duplicated: true,
                pauseOnHover: true,
                startVisible: true,
            });
        }
        
        if (design_three.length && !marqueeInitialized.design_three) {
            marqueeInitialized.design_three = true;

            var item_speed3 = $('#tr-marquee-v3').data('speed');
            var item_gap3 = $('#tr-marquee-v3').data('gap');
            var item_direction3 = $('#tr-marquee-v3').data('direction');
            
            $('.tr-marquee-v3').marquee({
                speed: item_speed3,
                gap: item_gap3,
                delayBeforeStart: 0,
                direction: item_direction3,
                duplicated: true,
                pauseOnHover: true,
                startVisible: true,
            });
        }
    };
    
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tr-marquee.default', marquee_js);
    });

})(window.jQuery);

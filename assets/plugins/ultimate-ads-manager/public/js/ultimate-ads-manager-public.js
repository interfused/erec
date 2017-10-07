(function( $ ) {
	'use strict';

    var links  = $('.codeneric_uam_link');

    function send(type, ad_id, callback) {

        var uuid = localStorage.getItem('cc_uam_uuid');

        if(uuid === null)
            uuid = undefined;

        $.post(ajaxurl,
            { action: 'codeneric_ad_event', type:type, uuid:uuid, ad_id:ad_id, ad_slide_id:42 }, function (res) {
                console.log(res);
                
                if(uuid === undefined && res.uuid !== undefined)
                    localStorage.setItem('cc_uam_uuid', res.uuid)

                if(typeof callback === 'function')
                    callback()
            });
    }

    links.on('click',function (e) {
        e.preventDefault();
        var ad_id = parseInt($(this).attr('data-id'));

        send('click', ad_id);

        window.open($(this).attr('href'), '_blank');
    });

    function isVisible($elem) {
        var $window = $(window);

        return ($elem.offset().top + $elem.outerHeight() <= $window.scrollTop() + $window.innerHeight());
    }


    var scrollTimer, lastScrollFireTime = 0;
    function ping() {

        // Throttle the scroll event
        var minScrollTime = 200;
        var now = new Date().getTime();

        function processScroll() {
            /**
             * actual logic
             * **/

            var seenAll = true;

            links.each(function(i,elem) {
                var $elem = $(elem);
                var seen = $elem.data('seen');

                if(seen !== true)
                    seenAll = false;

                if (seen === undefined && isVisible($elem) ) {
                    console.log("VISIBLE");
                    $elem.data('seen', true);
                    // track view
                    var ad_id = parseInt($elem.attr('data-id'));
                    send('view', ad_id);
                }
            });

            // unbind scroll event if all ads were visible at least once
            if(seenAll)
                $(window).unbind('scroll.cc_uam');
        }

        // throttle scroll logic
        if (!scrollTimer) {
            if (now - lastScrollFireTime > (3 * minScrollTime)) {
                processScroll();   // fire immediately on first scroll
                lastScrollFireTime = now;
            }
            scrollTimer = setTimeout(function() {
                scrollTimer = null;
                lastScrollFireTime = new Date().getTime();
                processScroll();
            }, minScrollTime);
        }




    }

    $(window).on('scroll.cc_uam', ping);
    ping();
})( jQuery );

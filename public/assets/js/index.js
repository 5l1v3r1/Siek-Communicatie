$(function() {

    /* Quick selectors */
    var $nav = $('nav');
    var $player = $('header div.vertical a.arrow.litebox');

    /**
     * Parralax scrolling and litebox
     * (desktops only, buggy on mobile)
     */
    if ((IS_MOBILE || IS_TABLET) == false) {

        /**
         * Litebox initialisation
         */
        $('.litebox').liteBox();

        /**
         * Turn the media play button into a down button on activation (with css)
         * Then turn it back upon click again
         */
        $player.click(function() {
            $(this).addClass('hidden');
            $(this).next('a').removeClass('hidden').transit({
                'rotate' : '90deg'
            });
        });
        $player.next('a').click(function() {
            $(this).transit({
                'rotate' : '0deg'
            }, function() {
                $(this).addClass('hidden');
                $(this).prev('a').removeClass('hidden');
            });
        });
    }

    /* Waypoints */
    var aboutWaypoint = new Waypoint({
        element: document.getElementById('what'),
        offset : '150px',
        handler: function(direction) {
            if (direction === 'down') {
                if ($nav.hasClass('transparent')) $nav.removeClass('transparent');
                $player.removeClass('hidden');
                $player.next('a').addClass('hidden').css('transform', 'rotate(0deg)');
            }else {
                if ($nav.hasClass('transparent') == false) $nav.addClass('transparent');
            }
        }
    });

    /* Smooth scrolling to anchors */
    $('a[href^="#"]').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top - $('nav').height() - 1
        }, 950, 'easeInOutCubic');
        return false;
    });
});
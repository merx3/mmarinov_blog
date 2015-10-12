/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

$(function() {
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    // facebook share button functionality
    $('.post-share.facebook').click(function(e){
        e.preventDefault();
        FB.ui({
            method: 'feed',
            name: $(this).data('name'),
            link: $(this).attr('href'),             
            caption: $(this).data('caption'),
            description: $(this).data('description')
        });
    });

    // share buttons slide effect
    $( window ).resize(function() {
        if(window.screen.width > 820) {
            $("aside div.share-button .slide-link").hover(
                function(){$(this).stop(true, false).animate({ 'padding-right': '85px' }, 500)},
                function(){$(this).stop(true, false).animate({ 'padding-right': '0' }, 500)}
            );
            $('.fixed-social').css('right', '');
        } else {
            $("aside div.share-button .slide-link").unbind('mouseenter mouseleave')
            $('.open-fixed-social').click(function() {
                $('.fixed-social').animate({
                    right: '-90px'
                }, 500, function() {});
                $('.mobile-fixed-social').animate({
                    right: '50px'
                }, 500, function() {});
                $('.open-fixed-social').hide();
                $('.close-fixed-social').show();
            });

            $('.close-fixed-social').click(function() {
                $('.fixed-social').animate({
                    right: '-140px'
                }, 500, function() {});
                $('.mobile-fixed-social').animate({
                    right: '0px'
                }, 500, function() {});
                $('.open-fixed-social').show();
                $('.close-fixed-social').hide();
            });
        }
    }).resize();
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

// hover effect on Articles
$( '.dropdown' ).hover(
    function(){
        $(this).children('.sub-menu').slideDown(400, stop());
    },
    function(){
        $(this).children('.sub-menu').slideUp(400, stop());
    }
);

function stop(){
    $('.sub-menu').stop(true, true);
}

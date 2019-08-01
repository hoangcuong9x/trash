// Portfolio Tab
"use strict";
jQuery(document)
    .ready(function(a) {
    function SetResizeContent() {
        var minheight = $(window).height();
        $(".featured-slider-images").css('min-height', minheight);
    }
    //SetResizeContent();
       a(".os-animation")
            .each(function() {
                var b = a(this),
                    c = b.attr("data-os-animation"),
                    d = b.attr("data-os-animation-delay");
                    //fadeInUp
                    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    // some code..
                    c="fadeInUp";
                    }
                b.css("-webkit-animation-delay", d), b.css("-moz-animation-delay", d), b.css("animation-delay", d), b.waypoint(function() {
                    a(this)
                        .addClass("animated")
                        .addClass(c)
                }, {
                    triggerOnce: !0,
                    offset: "100%"
                })
            });
 
    });
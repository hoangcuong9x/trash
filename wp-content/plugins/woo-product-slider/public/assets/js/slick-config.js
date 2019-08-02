jQuery(document).ready(function ($) {

    $('.wps-product-section').each(function (index) {

        var custom_id = $(this).attr('id');

        if (custom_id != '') {
            jQuery('#' + custom_id).slick({
                infinite: true,
                prevArrow: "<div class='slick-prev'><i class='sp-wps-font-icon icon-angle-left'></i></div>",
                nextArrow: "<div class='slick-next'><i class='sp-wps-font-icon icon-angle-right'></i></div>",
                slidesToScroll: 1,

            }); // Slick end

        }
    });

});

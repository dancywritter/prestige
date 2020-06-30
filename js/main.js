jQuery(document).ready(function ($) {
    jQuery('.client-slider').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1
    });

    // Add smooth scrolling to all links
    jQuery("a.primary-btn.appointment-btn").on('click', function (event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            jQuery('html, body').animate({
                scrollTop: jQuery(hash).offset().top
            }, 800, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });

    jQuery('a.menu-toggle').on('click', function (e) {
        e.preventDefault();
        jQuery(this).next('.menu-main-menu-container').addClass('opened');
    });
    jQuery('a#close-menu').on('click', function (e) {
        e.preventDefault();
        jQuery(this).parent('.menu-main-menu-container').removeClass('opened');
    });
});
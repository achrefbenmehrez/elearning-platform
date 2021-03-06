jQuery(document).ready(function($) {

    'use strict';
    //***************************
    // Sticky Header Function
    //***************************
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 170) {
            jQuery('body').addClass("wm-sticky");
        } else {
            jQuery('body').removeClass("wm-sticky");
        }
    });

    //***************************
    // BannerOne Functions
    //***************************
    jQuery('.wm-banner-one-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.wm-banner-one-nav'
    });
    jQuery('.wm-banner-one-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.wm-banner-one-for',
        dots: false,
        vertical: true,
        prevArrow: "<span class='slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        centerMode: false,
        focusOnSelect: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    vertical: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    vertical: true,
                }
            },
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    vertical: true,
                }
            },
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    vertical: true,
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    vertical: true,
                }
            }
        ],
    });
    //***************************
    // LatestEvent Functions
    //***************************
    jQuery('.wm-banner-three').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        dots: true,
        arrows: false,
        fade: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    //***************************
    // LatestEvent Functions
    //***************************
    jQuery('.wm-event-latest-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // Testimonial Functions
    //***************************
    jQuery('.wm-testimonial-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // Partner Functions
    //***************************
    jQuery('.wm-partners-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // BannerSlider Functions
    //***************************
    jQuery('.wm-banner-two').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        arrows: false,
        fade: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    jQuery('.wm-banner-four').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        arrows: false,
        fade: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // ServiceSlider Functions
    //***************************
    jQuery('.wm-service-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        fade: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // UpcomingEvent Functions
    //***************************
    jQuery('.wm-upcoming-event-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
            }
        ]
    });
    //***************************
    // Testimonial Functions
    //***************************
    jQuery('.wm-thumb-testimonial').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // RecentList Functions
    //***************************
    jQuery('.wm-recent-list-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        vertical: true,
        centerMode: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // Testimonial Functions
    //***************************
    jQuery('.wm-testimonial-navslider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
            }
        ]
    });
    //***************************
    // Partner Two Functions
    //***************************
    jQuery('.wm-partners-slider-two').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    jQuery('.wm-partners-slider-classic').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //***************************
    // Partner Two Functions
    //***************************
    jQuery('.wm-ourprofessors-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //********************************
    // TestimonialModren Functions
    //********************************
    jQuery('.wm-modren-testimonial-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow: "<span class='slick-arrow slick-arrow-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='slick-arrow slick-arrow-right'><i class='fas fa-arrow-right'></i></span>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    //***************************
    // Click to Top Button
    //***************************
    jQuery('.backtop-btn').on("click", function() {
        jQuery('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    //***************************
    // Inc-Dec Function
    //***************************
    jQuery(function() {
        jQuery("#wm-inc").click(function() {
            jQuery(":text[name='qty']").val(Number($(":text[name='qty']").val()) + 1);
        });
        jQuery("#wm-dec").click(function() {
            jQuery(":text[name='qty']").val(Number($(":text[name='qty']").val()) - 1);
        });
    });
    jQuery(function() {
        jQuery("#wm-incs").click(function() {
            jQuery(":text[name='qtys']").val(Number($(":text[name='qtys']").val()) + 1);
        });
        jQuery("#wm-decs").click(function() {
            jQuery(":text[name='qtys']").val(Number($(":text[name='qtys']").val()) - 1);
        });
    });
    jQuery(function() {
        jQuery("#wm-incd").click(function() {
            jQuery(":text[name='qtyd']").val(Number($(":text[name='qtyd']").val()) + 1);
        });
        jQuery("#wm-decd").click(function() {
            jQuery(":text[name='qtyd']").val(Number($(":text[name='qtyd']").val()) - 1);
        });
    });

    //***************************
    // PrettyPhoto Function
    //***************************
    jQuery("area[data-rel^='prettyPhoto']").prettyPhoto();

    jQuery(".gallery:first a[data-rel^='prettyPhoto']").prettyPhoto({
        animation_speed: 'normal',
        theme: 'facebook',
        social_tools: '',
        slideshow: 3000,
        autoplay_slideshow: false
    });
    jQuery(".gallery:gt(0) a[data-rel^='prettyPhoto']").prettyPhoto({
        animation_speed: 'fast',
        slideshow: 10000,
        hideflash: true
    });

    jQuery("#custom_content a[data-rel^='prettyPhoto']:first").prettyPhoto({
        custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
        changepicturecallback: function() {
            initialize();
        }
    });

    jQuery("#custom_content a[data-rel^='prettyPhoto']:last").prettyPhoto({
        custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
        changepicturecallback: function() {
            _bsap.exec();
        }
    });

    //***************************
    // Skills Function
    //***************************
    jQuery('.skillbar').each(function() {
        jQuery(this).appear(function() {
            jQuery(this).find('.count-bar').animate({
                width: jQuery(this).attr('data-percent')
            }, 3000);
            var percent = jQuery(this).attr('data-percent');
            jQuery(this).find('.count').html('<span>' + percent + '</span>');
        });
    });

    jQuery('[data-toggle="tooltip"]').tooltip();

    //***************************
    // CartToggle Function
    //***************************
    jQuery('a.wm-cartbtn').on("click", function() {
        jQuery('.wm-cart-box').slideToggle('slow');
        return false;
    });
    jQuery('html').on("click", function() { jQuery(".wm-cart-box").fadeOut(); });
    jQuery('.wm-navicons,.wm-cartsection').on("click", function(event) { event.stopPropagation(); });

    //***************************
    // LoginToggleClass Function
    //***************************
    jQuery('.wm-modallogin-form p a').on("click", function() {
        jQuery('.modal-body').toggleClass('wm-login-toggle');
        return false;
    });



});

//***************************
// News FilterAble Function
//***************************
jQuery(function($) {
    $('.wm-filterable li,.wm-filterable-link li').on("click", function(event) {
        event.preventDefault();
        var target = $(this).find('>a').prop('hash');
        $('html, body').animate({
            scrollTop: $(target).offset().top
        }, 500);
    });
    $("a.preview").prettyPhoto({
        social_tools: false
    });
    $(window).on('load', function() {
        $portfolio = $('.wm-gallery,.wm-our-professors');
        $portfolio.isotope({
            itemSelector: 'li',
            layoutMode: 'fitRows',
        });
        $portfolio_selectors = $('.wm-filterable li a,.wm-filterable-link li a');
        $portfolio_selectors.on('click', function() {
            $portfolio_selectors.removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $portfolio.isotope({
                filter: selector
            });
            return false;
        });
    });
});
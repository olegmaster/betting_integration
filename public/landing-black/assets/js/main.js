/*************************************************************************
    Template Name: Canopus
    Template URI: https://themeforest.net/user/tortoiz
    Description: A 'Canopus – Multipurpose HTML5 Template' is perfect if you like a clean and modern design. This theme is ideal for Agency, Freelancer, App, Gym, Resturant, Business, citytour, book, Hotel, Portfolio, and those who need an easy, attractive and effective way to share their work with clients.
    Author: tortoiz
    Version: 1.0
    Author URI: http://tortoizthemes.com
    
    
    Note: style js.
*************************************************************************/
/*
    01. Scroll top
    02. Mobile Menu
    03. Sticky Header
    04. Parallax Background
    05. Aos Initializ
    06. Count Down
    07. Brands Slider
    08. Protfolio Carousel
    09. Testimonail
    10. Tumbnail Carousel
    11. Restaurant Gallery
    12. Gallery Popup
    13. Youtube video trigger 
    14. Nav scroll
 
==================================================
[ End table content ]
==================================================*/


(function($) {
    'use strict';
    
    var canopusApp = { 
        /* ---------------------------------------------
            01. Scroll top
         --------------------------------------------- */
        scroll_top: function () {
            $("body").append("<a href='#top' id='scroll-top' class='topbutton btn-hide'><span class='fa fa-angle-double-up'></span></a>");
            var $scrolltop = $('#scroll-top');
            $(window).on('scroll', function () {
                if ($(this).scrollTop() > $(this).height()) {
                    $scrolltop
                        .addClass('btn-show')
                        .removeClass('btn-hide');
                } else {
                    $scrolltop
                        .addClass('btn-hide')
                        .removeClass('btn-show');
                }
            });
            $("a[href='#top']").on('click', function () {
                $("html, body").animate({
                    scrollTop: 0
                }, "normal");
                return false;
            });
        },
        
        
        /* ---------------------------------------------
            02. Mobile Menu
        --------------------------------------------- */
        mobile_menu: function () {
            // mobile Menu
            //-------------------------------
            $('.site-navigation .mainmenu-wrap nav').meanmenu({
                meanMenuClose: 'X',
                meanMenuCloseSize: '18px',
                meanScreenWidth: '992',
                meanExpandableChildren: true,
                meanMenuContainer: '.mobile-menu'
            }); 
            if ($('.menu.right-menu').length) {
                var mobileLeftMenu = $('.site-header .navigation-area .mainmenu-wrap .menu.right-menu ul li').clone().appendTo('.mobile-menu .mean-bar .mean-nav ul');
            }
        },
        
        
        /*-------------------------------------------
            03. Sticky Header
        --------------------------------------------- */
        sticky_header: function() {
            if ($('#sticky-header').length) {
                var stickyMenu = $('.site-header').clone().appendTo('#sticky-header');
                $(window).on('scroll', function() {
                    var w = $(window).width();
                    if (w > 992) {
                        if ($(this).scrollTop() > 350) {
                            $('#sticky-header').slideDown(500);
                        } else {
                            $('#sticky-header').slideUp(500);
                        }
                    }
                });
            } 
        },
        
        
        /*-------------------------------------------
            04. Parallax Background
        --------------------------------------------- */
        bg_parallax: function () {
            if ($('.bg-parallax').length) {
                $('.bg-parallax').parallax("30%", -0.25);
            }
        },
        
        
        /*-------------------------------------------
            05. Aos Initializ
        --------------------------------------------- */
        aos_initializ: function () {
            AOS.init({
                anchorPlacement: 'top-bottom',
                disable: window.innerWidth < 1200,
            });
        },
        
        
        /* ---------------------------------------------
            06. Count Down
        --------------------------------------------- */
        count_down: function() {
            if ($('#countdown').length) {
                $('#countdown').syotimer({
                    year: 2020,
                    month: 12,
                    day: 9,
                    hour: 20,
                    minute: 30
                }); 
            }
        },
        
        
        /* ---------------------------------------------
            07. Brands Slider
         --------------------------------------------- */
        brands_slider: function() {
            if ($('.brands-list').length) {
                $('.brands-list').owlCarousel({
                    center: false,
                    items: 3,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    margin: 0,
                    singleItem: false,
                    loop: true,
                    nav: true,
                    navText : ["",""],
                    responsive: {
                        320: {
                            items: 1
                        },
                        577: {
                            items: 2
                        },
                        993: {
                            items: 3
                        }
                    }
                });  
            }
        },
        
        
        /* ---------------------------------------------
            08. Protfolio Carousel
         --------------------------------------------- */
        protfolio_carousel: function() {
            if ($('.protfolio-carousel').length) {
                $('.protfolio-carousel').owlCarousel({
                    center: false,
                    items: 5,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    margin: 50,
                    singleItem: false,
                    loop: true,
                    nav: false,
                    dots: true,
                    responsive: {
                        280: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        800: {
                            items: 2
                        },
                        1200: {
                            items: 2
                        },
                        1400: {
                            items: 3
                        }
                    }
                }); 
            }
        },
        
        
        /* ---------------------------------------------
            09. Testimonail
        --------------------------------------------- */
        testimonial: function () {
            if ($('.testimonial-carousel-2').length) {
                $('.testimonial-carousel-2').owlCarousel({
                    center: false,
                    items: 2,
                    autoplay: true,
                    singleItem: true,
                    smartSpeed:500,
                    loop: true,
                    margin: 30,
                    nav: false,
                    dots: true,
                    responsive: {
                        280: {
                            items: 1
                        },
                        768: {
                            items: 1
                        },
                        800: {
                            items: 1
                        },
                        1000: {
                            items: 2
                        },
                        1400: {
                            items: 2
                        }
                    }
                }); 
            }
            
            if ($('.testimonial-carousel').length) {
                $('.testimonial-carousel').owlCarousel({
                    center: false,
                    items: 1,
                    margin: 0,
                    autoplay: true,
                    singleItem: true,
                    smartSpeed:500,
                    loop: true,
                    nav: false,
                    dots: true
                }); 
            }
        },
        
        
        /* ---------------------------------------------
            10. Tumbnail Carousel
        --------------------------------------------- */
        thumbnail_carousel: function () {
            if ($('.about-thumb-carousel').length) {
                $('.about-thumb-carousel').owlCarousel({
                    center: false,
                    items: 1,
                    margin: 0,
                    autoplay: true,
                    singleItem: true,
                    smartSpeed:500,
                    loop: true,
                    nav: false,
                    dots: true
                }); 
            }
            
            if ($('.room-gallery-carousel').length) {
                $('.room-gallery-carousel').owlCarousel({
                    items: 2,
                    center: true,
                    margin: 100,
                    autoplay: false,
                    singleItem: true,
                    smartSpeed:500,
                    loop: true,
                    nav: false,
                    dots: false
                }); 
            }
        },
        
        
        /* ---------------------------------------------
            11. Restaurant Gallery
        --------------------------------------------- */
        restaurant_gallery: function() {
            var $gallery_items = $('.restaurant-gallery-carousel');
            var item = 3;
            if ($gallery_items.length) {
                $gallery_items.owlCarousel({
                    center: false,
                    items: item,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    singleItem: false,
                    loop: true,
                    margin: 30,
                    responsive: {
                        280: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1400: {
                            items: item
                        }
                    }
                });
            }
            $('.restaurant-gallery-section .btn-links-area .btn-prev').click(function() {
                $gallery_items.trigger('prev.owl.carousel');
            });
            $('.restaurant-gallery-section .btn-links-area .btn-next').click(function() {
                $gallery_items.trigger('next.owl.carousel');
            });
        },
        
        
        /* ---------------------------------------------
            12. Gallery Popup
        --------------------------------------------- */
        gallery_popup: function () {
            $('.gallery-item').magnificPopup({
                type: 'image',
                removalDelay: 300,
                mainClass: 'mfp-with-zoom',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true, 
                    duration: 300, 
                    easing: 'ease-in', 
                    opener: function (openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                }
            });
        },
        
        /*-------------------------------------------
            13. Youtube video trigger 
        --------------------------------------------- */
        youtube_video: function() {
            $('.video-btn').yu2fvl();    
        },
        
        
        /*-------------------------------------------
            14. Nav scroll
        --------------------------------------------- */
        nav_scroller: function() {
            if ($('.arrow-bottom').length) {
                $('.arrow-bottom').navScroll({
                    mobileDropdown: true,
                    mobileBreakpoint: 991,
                    scrollSpy: false,
                });
            }
            if ($('.site-header').length) {
                $('.menu ul, .mean-nav ul').navScroll({
                    mobileDropdown: true,
                    mobileBreakpoint: 991,
                    scrollSpy: true,
                    navHeight: 82,
                });
            } 
        },
    
    
        /* ---------------------------------------------
         function initializ
         --------------------------------------------- */
        initializ: function() {          
            canopusApp.scroll_top();         
            canopusApp.mobile_menu();         
            canopusApp.sticky_header();         
            canopusApp.bg_parallax();         
            canopusApp.aos_initializ();        
            canopusApp.count_down();        
            canopusApp.brands_slider();         
            canopusApp.protfolio_carousel();         
            canopusApp.testimonial();        
            canopusApp.thumbnail_carousel();        
            canopusApp.restaurant_gallery();        
            canopusApp.gallery_popup();          
            canopusApp.youtube_video();        
            canopusApp.nav_scroller();         
        }
    };

    /* ---------------------------------------------
     Document ready function
     --------------------------------------------- */
    $(function() {
        canopusApp.initializ();
    }); 
    

})(jQuery);

(function($){
    (function fn() {
        fn.now = +new Date;
        $(window).on('load', function() {
            if (+new Date - fn.now < 500) { 
                setTimeout(fn, 500);
            }
            // Image Carousel
            if( $('.rawb-image-carousel').length > 0 ) {
                $('.rawb-image-carousel').each(function(index){
                    var instance = $(this).data('instance');
                    slideshowInstance(instance);
                });

                function slideshowInstance(instance) {
                    var obj = window['imagecarousel' + instance];

                    var sid = obj.id,
                        item = obj.items,
                        navigation = (obj.navigation == "true"),
                        pagination = (obj.pagination == "true"),
                        autoplay = (obj.autoplay == "true"),
                        smartspeed = obj.smartspeed,
                        fluidspeed = obj.fluidspeed,
                        autowidth = (obj.autowidth == "true"),
                        lazyload = (obj.lazyload == "true"),
                        mergefit = (obj.mergefit == "true"),
                        center = (obj.center == "true"),
                        slidesmobile = obj.slidesmobile,
                        slidestablet = obj.slidestablet,
                        loop = obj.loop,
                        margin = obj.margin;

                    var owl = $('#' + sid);

                    owl.owlCarousel({
                        items: item,
                        margin: parseInt(margin),
                        nav: navigation,
                        dots: pagination,
                        autoplay: autoplay,
                        smartSpeed: smartspeed,
                        fluidSpeed: fluidspeed,
                        loop: loop,
                        lazyLoad: lazyload,
                        center: center,
                        mergeFit: mergefit,
                        autoWidth: autowidth,
                        responsive: {
                            0: {
                                items: slidesmobile,
                                nav: navigation
                            },
                            768: {
                                items: slidestablet,
                                nav: navigation
                            },
                            1024: {
                                items: item,
                                nav: navigation
                            }
                        }
                    });
                }
            }

            // Testimonial
            if ($('.rawb-testimonial').length > 0) {
                $('.rawb-testimonial').each(function (index) {
                    var instance = $(this).data('instance');
                    testimonialInstance(instance);
                });

                function testimonialInstance(instance) {
                    var obj = window['testimonial' + instance];

                    var sid = obj.id,
                        item = obj.items,
                        navigation = (obj.navigation == "true"),
                        pagination = (obj.pagination == "true"),
                        autoplay = (obj.autoplay == "true"),
                        smartspeed = obj.duration,
                        fluidspeed = obj.speed,
                        lazyload = (obj.lazyload == "true"),
                        autowidth = (obj.autowidth == "true"),
                        mergefit = (obj.mergefit == "true"),
                        center = (obj.center == "true"),
                        slidesmobile = obj.slidesMobile,
                        slidestablet = obj.slidesTablet,
                        loop = (obj.loop == "true"),
                        margin = obj.margin;

                    var owl = $('#' + sid);

                    owl.owlCarousel({
                        items: item,
                        margin: parseInt(margin),
                        nav: navigation,
                        dots: pagination,
                        autoplay: autoplay,
                        smartSpeed: smartspeed,
                        fluidSpeed: fluidspeed,
                        loop: loop,
                        lazyLoad: lazyload,
                        center: center,
                        mergeFit: mergefit,
                        autoWidth: autowidth,
                        responsive: {
                            0: {
                                items: slidesmobile,
                                nav: navigation
                            },
                            768: {
                                items: slidestablet,
                                nav: navigation
                            },
                            1024: {
                                items: item,
                                nav: navigation
                            }
                        }
                    });
                }
            }         
        });
    })();
})(jQuery);

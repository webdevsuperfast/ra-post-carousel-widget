(function($){
    (function fn() {
        $(function() {
            // Post Carousel
            if ($('.ra-post-carousel').length > 0) {
                $('.ra-post-carousel').each(function (index) {
                    var instance = $(this).data('instance');
                    carouselInstance(instance);
                });

                function carouselInstance(instance) {
                    var obj = window['postcarousel' + instance];
                    
                    var sid = obj.id,
                        item = obj.items,
                        navigation = (obj.navigation === "true"),
                        pagination = (obj.pagination === "true"),
                        autoplay = (obj.autoplay === "true"),
                        smartspeed = obj.duration,
                        autoheight = (obj.autoheight === "true"),
                        autowidth = (obj.autowidth === "true"),
                        center = (obj.center === "true"),
                        slidesmobile = obj.slidesMobile,
                        slidestablet = obj.slidesTablet,
                        loop = (obj.loop === "true");

                    var owl = $('#' + sid);

                    owl.slick({
                        slidesToShow: item,
                        arrows: navigation,
                        dots: pagination,
                        autoplay: autoplay,
                        speed: smartspeed,
                        infinite: loop,
                        adaptiveHeight: autoheight,
                        centerMode: center,
                        variableWidth: autowidth,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: item,
                                    arrows: navigation
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: slidestablet,
                                    arrows: navigation
                                }
                            },
                            {
                                breakpoint: 0,
                                settings: {
                                    slidesToShow: slidesmobile,
                                    arrows: navigation
                                }
                            }
                        ]
                    });
                }
            }       
        });
    })();
})(jQuery);

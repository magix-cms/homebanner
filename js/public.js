/* Add this block to the global.js file of your theme and you want to use owl-carousel for your slideshow */
if($(".owl-slideshow").length > 0 && $.fn.owlCarousel !== undefined) {
    $(".owl-slideshow > .owl-carousel").owlCarousel(Object.assign({},owlOptions,{
        items: 1,
        margin: 0,
        dots: true,
        dotsData: true,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        animateOut: 'fadeOut',
        dotsContainer: '.owl-slideshow-dots',
        navContainer: '.owl-slideshow-nav'
    }));
    $(".owl-slideshow .owl-dot").on('click', function() {
        $(".owl-slideshow > .owl-carousel").trigger('to.owl.carousel', $(this).index());
    });
}
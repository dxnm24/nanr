$(document).foundation();
var swiper = new Swiper('.swiper-container', {
pagination: '.swiper-pagination',
paginationClickable: true,
slidesPerView: 5,
spaceBetween: 15,
autoplay: 4500,
nextButton: '.swiper-button-next',
prevButton: '.swiper-button-prev',
breakpoints: {
    1024: {
        slidesPerView: 4,
        spaceBetween: 15
    },
    768: {
        slidesPerView: 3,
        spaceBetween: 10
    },
    640: {
        slidesPerView: 2,
        spaceBetween: 5
    },
    320: {
        slidesPerView: 1,
        spaceBetween: 5
    }
}
});
gototop();
function gototop()
{
    // $(".gotop").hide();
    $(window).scroll(function() {
        if ($(this).scrollTop() > 10) {
            $('.gotop').addClass('gototop');
            // $('.gotop').fadeIn();
        } else {
            $('.gotop').removeClass('gototop');
            // $('.gotop').fadeOut();
        }
    });
    $('.gotop').click(function() {
        $('body,html').animate({scrollTop: 4}, 300);
        return false;
    });
}
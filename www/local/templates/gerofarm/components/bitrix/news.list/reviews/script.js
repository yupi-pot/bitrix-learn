if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initReviews);
} else {
    initReviews();
}

function initReviews() {
    new Swiper('.reviews-swiper', {
        centeredSlides: true,
        slidesPerView: 'auto',
        spaceBetween: 0,
        initialSlide: 1,
        grabCursor: true,
        pagination: {
            el: '.reviews-swiper__pagination',
            clickable: true,
        },
    });
}

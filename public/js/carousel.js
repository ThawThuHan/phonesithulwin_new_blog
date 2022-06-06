var swiper1 = new Swiper(".mySwiper1", {
    slidesPerView: 2,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination2",
        clickable: true,
    },
    autoplay: {
        delay: 2700,
    },
    loop: true,
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetweenSlides: 50
        },
        999: {
            slidesPerView: 2,
            spaceBetweenSlides: 50
        }
    }
});
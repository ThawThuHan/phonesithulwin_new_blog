var swiper1 = new Swiper(".mySwiper1", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination2",
        clickable: true,
    },
    autoplay: {
        delay: 4000,
    },
    loop: true,
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetweenSlides: 50
        },
        999: {
            slidesPerView: 3,
            spaceBetweenSlides: 50
        }
    }
});
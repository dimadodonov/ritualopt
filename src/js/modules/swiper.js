import Swiper from 'swiper/swiper-bundle.min';

export default () => {
    if (window.innerWidth < 480) {
    } else {
    }

    const galleryThumbs = new Swiper('.product-slider-thumbs', {
        spaceBetween: 13,
        slidesPerView: 4,
        freeMode: true,
        direction: 'vertical',
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        autoHeight: true, //enable auto height
    });
    const galleryTop = new Swiper('.product-slider', {
        spaceBetween: 0,
        // navigation: {
        //     nextEl: '.swiper-btn-next',
        //     prevEl: '.swiper-btn-prev',
        // },
        thumbs: {
            swiper: galleryThumbs,
        },
    });

    const loopHits = new Swiper('.loop-slider', {
        slidesPerView: 2,
        spaceBetween: 10,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.loop-swiper-button-next',
            prevEl: '.loop-swiper-button-prev',
        },
        lazy: true,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2,
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 2,
            },
            // when window width is >= 640px
            640: {
                slidesPerView: 5,
            },
        },
    });
};

(function ($) {
    'use strict';

    const swipers = [];
    const $desktopImage = $('#desktopSlideImage');

    function syncDesktopImage(swiper) {
        const image = $(swiper.slides[swiper.activeIndex]).data('image');
        if (!image || !$desktopImage.length) {
            return;
        }

        $desktopImage.addClass('is-changing');
        window.setTimeout(function () {
            $desktopImage.attr('src', image).removeClass('is-changing');
        }, 140);
    }

    $('.js-slide-swiper').each(function () {
        const slider = this;
        const swiper = new Swiper(slider, {
            loop: false,
            speed: 550,
            autoHeight: true,
            pagination: {
                el: slider.querySelector('.swiper-pagination'),
                clickable: true,
            },
            navigation: {
                nextEl: slider.querySelector('.swiper-button-next'),
                prevEl: slider.querySelector('.swiper-button-prev'),
            },
            on: {
                init: function () {
                    if ($(slider).closest('.d-none').length === 0 && window.innerWidth >= 992) {
                        syncDesktopImage(this);
                    }
                },
                slideChange: function () {
                    if (window.innerWidth >= 992 && $(slider).closest('.tab-pane').hasClass('active')) {
                        syncDesktopImage(this);
                    }
                },
            },
        });

        swipers.push(swiper);
    });

    $('[data-bs-toggle="pill"]').on('shown.bs.tab', function (event) {
        const paneSelector = $(event.target).data('bs-target');
        const activeSwiper = $(paneSelector).find('.js-slide-swiper')[0];

        swipers.forEach(function (swiper) {
            swiper.update();
        });

        if (activeSwiper && activeSwiper.swiper) {
            activeSwiper.swiper.slideTo(0, 0);
            syncDesktopImage(activeSwiper.swiper);
        }
    });

    $('.accordion-collapse').on('shown.bs.collapse', function () {
        $(this).find('.js-slide-swiper').each(function () {
            if (this.swiper) {
                this.swiper.update();
            }
        });
    });
})(jQuery);


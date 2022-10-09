import $ from 'jquery';
import Inputmask from 'inputmask';
import { Notyf } from 'notyf';
import fancybox from '@fancyapps/fancybox';
import Swiper from 'swiper/swiper-bundle.min';

export default () => {
    (function ($) {
        $('.product_type_variable.btn-order-loop').on('click', function (e) {
            e.preventDefault();
            const productId = $(this).attr('data-product_id');
            ajaxId(productId);
        });

        function ajaxId(id) {
            var data = {
                action: 'add_product',
                id: id,
                nonce: search_form.nonce,
            };
            $.ajax({
                url: search_form.ajaxurl,
                data: data,
                type: 'POST',
                dataType: 'json',
                beforeSend: function (xhr) {
                    console.log('Ищем...');
                    const productPopupLoader =
                        '<div class="popup-product__loader"></div>';
                    $('body').append(productPopupLoader);
                    $('.popup-product__overlay').show();
                },
                success: function (data) {
                    console.log();
                    const productPopup = $('.popup-product');
                    productPopup.find('.popup-product__content').html(data.out);
                    productPopup
                        .find('form.variations_form')
                        .wc_variation_form();
                },
                error: function () {
                    console.log('error', arguments);
                },
                complete: function (xhr) {
                    console.log('Готово...');
                    $('body').find('.popup-product__loader').remove();
                    $('.popup-product').show();
                    $('.popup-product__overlay').show();

                    const galleryThumbs = new Swiper('.product-slider-thumbs', {
                        spaceBetween: 16,
                        slidesPerView: 'auto',
                        freeMode: true,
                        watchSlidesVisibility: true,
                        watchSlidesProgress: true,
                        autoHeight: true, //enable auto height
                        breakpoints: {
                            // when window width is >= 320px
                            320: {
                                spaceBetween: 10,
                            },
                            // when window width is >= 480px
                            480: {
                                spaceBetween: 10,
                            },
                            // when window width is >= 640px
                            640: {
                                spaceBetween: 16,
                            },
                        },
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
                },
            });
        }

        $(document).on('click', '.popup-product__overlay', function () {
            $(this).hide();
            $('.popup-product').hide().find('.popup-product__content').html('');
        });

        $(document).on('click', '.popup-product__close', function () {
            $('.popup-product__overlay').hide();
            $('.popup-product').hide().find('.popup-product__content').html('');
        });

        $(document).on(
            'show_variation',
            '.popup-product .single_variation_wrap',
            function (event, variation) {
                // if (variation.image.url) {
                //     const variationImage =
                //         '<div class="swiper-slide">' +
                //         '<a href="' +
                //         variation.image.url +
                //         '" data-fancybox="gallery"><figure class="product-slider-big__item">' +
                //         '<img src="' +
                //         variation.image.url +
                //         '" loading="lazy"></figure></a>' +
                //         '</div>';
                //     // $('p.price').html(variation.price_html);
                //     $('.product-slider-big .swiper-slide')
                //         .first()
                //         .html(variationImage);
                // }
                console.log(variation);
            }
        );

        const hitsLi = $('.hits ul li');
        if (hitsLi) {
            hitsLi.on('click', function () {
                if (hitsLi.hasClass('active')) {
                    hitsLi.removeClass('active');
                }
                $(this).addClass('active');
            });
        }
        $('.search input').on('keyup', function () {
            var search = $(this).val();
            if (search.length < 3) {
                return false;
            }
            var data = {
                s: search,
                action: 'search_ajax',
                nonce: search_form.nonce,
            };
            $.ajax({
                url: search_form.ajaxurl,
                data: data,
                type: 'POST',
                dataType: 'json',
                beforeSend: function (xhr) {
                    $('.search-panel__loader').show();
                    $('.search-panel__close').hide();
                    $('.search-panel__search').hide();
                    console.log('Ищем...');
                },
                success: function (data) {
                    if (data.out) {
                        $('.search-result').show().html(data.out);
                    }
                    $('.search-panel__close').show();
                },
                error: function () {
                    console.log('error', arguments);
                },
                complete: function (xhr) {
                    function hideLoader() {
                        $('.search-panel__loader').hide();
                        $('.search-panel__close').show();
                    }

                    setTimeout(hideLoader, 500);
                },
            });
            console.log(search);
        });

        $('.search-panel__close').on('click', function () {
            $(this).hide();
            $('.search-panel__search').show();
            $('.search-result').hide();
            $('.search input').empty().val('');
        });

        $(document).on('mouseup', function (e) {
            // событие клика по веб-документу
            var div = $('.header-search'); // тут указываем ID элемента
            if (
                !div.is(e.target) && // если клик был не по нашему блоку
                div.has(e.target).length === 0
            ) {
                // и не по его дочерним элементам
                // $('.search_form_clear').hide();
                $('#search_form_result').hide();
                $('#search_form_result').empty();
                // $('.searchform input[name="s"]').val('').change();
            }
        });

        $('[data-fancybox]').fancybox({
            clickOutside: 'close',
            buttons: [
                //"zoom",
                //"share",
                //"slideShow",
                //"fullScreen",
                //"download",
                //"thumbs",
                'close',
            ],
            protect: true, // РїРѕР»СЊР·РѕРІР°С‚РµР»СЊ РЅРµ РјРѕР¶РµС‚ СЃРѕС…СЂР°РЅРёС‚СЊ РёР·РѕР±СЂР°Р¶РµРЅРёРµ
            // toolbar  : false // СѓР±СЂР°Р»Рё РїР°РЅРµР»СЊ РёРЅСЃС‚СЂСѓРјРµРЅС‚РѕРІ
            mobile: {
                clickContent: 'close',
                clickSlide: 'close',
            },
        });
        var proQty = $('.pro-qty');
        // proQty.append('<div class="inc qty-btn">+</div>');
        // proQty.append('<div class= "dec qty-btn">-</div>');
        $('body').on('click', '.qty-btn', function (e) {
            e.preventDefault();
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            var step = $button.parent().find('input').attr('step');
            const btnOrder = $('.btn-order');
            if (!oldValue) {
                oldValue = 50;
            }
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + +step;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > +step) {
                    var newVal = parseFloat(oldValue) - +step;
                } else {
                    newVal = step;
                }
            }
            $button.parent().find('input').val(newVal).change();
            btnOrder.attr('data-quantity', newVal);
        });

        $(document).on('click', '.qty-btn', function () {
            $("[name='update_cart']").trigger('click');
        });

        $('div.woocommerce').on('change', '.qty', function () {
            const minValue = $(this).attr('min');
            const count = $(this).val();

            if (+count <= +minValue) {
                $(this).val(minValue);
                // return false;
                $("[name='update_cart']").trigger('click');
            } else {
                $("[name='update_cart']").trigger('click');
            }
        });

        $('.woocommerce').on('change', '.qty', function () {
            const minValue = $(this).attr('min');
            const count = $(this).val();

            if (+count <= +minValue) {
                $(this).val(minValue);
                // return false;
            }
        });

        $('.variations-btn .attached').on('click', function () {
            if ($(this).hasClass('active')) {
                return;
            }

            var el = $(this),
                name = el.text(),
                val = el.data('value'),
                parent = el.parents('.variations-btn').data('id');

            $('.variations-btn .attached').removeClass('active');
            el.addClass('active');

            $('#' + parent).val(val);
            $('#' + parent).change();
        });

        $('.single_variation_wrap').on(
            'show_variation',
            function (event, variation) {
                if (variation.image.url) {
                    const variationImage =
                        '<div class="swiper-slide">' +
                        '<a href="' +
                        variation.image.url +
                        '" data-fancybox="gallery"><figure class="product-slider-big__item">' +
                        '<img src="' +
                        variation.image.url +
                        '" loading="lazy"></figure></a>' +
                        '</div>';
                    // $('p.price').html(variation.price_html);
                    $('.product-slider-big .swiper-slide')
                        .first()
                        .html(variationImage);
                }
                // console.log(variation);
            }
        );
    })(jQuery.noConflict());

    const tel = new Inputmask('+7 (999) 999-99-99');
    tel.mask(document.querySelectorAll('input[type="tel"]'));

    const navSubmenuA = document.querySelectorAll('.menu-item-has-children a');
    navSubmenuA.forEach((navSubmenuA) => {
        const navSubmenuArrow = document.createElement('div');
        navSubmenuArrow.classList.add('menu-item-children-btn');

        navSubmenuA.appendChild(navSubmenuArrow);
    });

    function login() {
        const loginForm = document.getElementById('login');
        const registerForm = document.getElementById('register');

        if (loginForm) {
            const wcNoticesWrap = document.querySelector(
                '.woocommerce-notices-wrapper'
            );
            if (localStorage.getItem('register') !== null) {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
            } else {
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
            }
            document
                .querySelector('.login-link-reg')
                .addEventListener('click', () => {
                    loginForm.classList.remove('active');
                    registerForm.classList.add('active');
                    localStorage.setItem('register', 'yes');
                });

            document
                .querySelector('.login-link-login')
                .addEventListener('click', () => {
                    loginForm.classList.add('active');
                    registerForm.classList.remove('active');
                    localStorage.removeItem('register');
                    wcNoticesWrap.innerHTML = '';
                });
        }
    }
    login();
};

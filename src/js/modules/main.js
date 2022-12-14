import $ from 'jquery';
import Inputmask from 'inputmask';
import { Notyf } from 'notyf';
import fancybox from '@fancyapps/fancybox';
import Swiper from 'swiper/swiper-bundle.min';

export default () => {
    (function ($) {
        $(document).on(
            'click',
            '.product_type_variable.btn-order-loop',
            function (e) {
                e.preventDefault();
                const productId = $(this).attr('data-product_id');
                ajaxId(productId);
            }
        );

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
                    const productPopupLoader =
                        '<div class="popup-product__loader"></div>';
                    $('body').append(productPopupLoader);
                    $('.popup-product__overlay').show();
                },
                success: function (data) {
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
                    $('body').find('.popup-product__loader').remove();
                    $('.popup-product').show();
                    $('.popup-product__overlay').show();
                    $('.popup-product-btn').css('display', 'flex');

                    const galleryTop = new Swiper('.product-slider', {
                        spaceBetween: 0,
                        // navigation: {
                        //     nextEl: '.swiper-btn-next',
                        //     prevEl: '.swiper-btn-prev',
                        // }
                    });
                },
            });
        }

        // ?????????????????? popup ?????? ?????????? ???? .popup-product__overlay
        $(document).on('click', '.popup-product__overlay', function () {
            $(this).hide();
            $('.popup-product').hide().find('.popup-product__content').html('');
        });

        // ?????????????????? popup ?????? ?????????? ???? .popup-product__close
        $(document).on('click', '.popup-product__close', function () {
            $('.popup-product__overlay').hide();
            $('.popup-product').hide().find('.popup-product__content').html('');
        });

        // ?????????????????????? variation ?? ?????????? .popup-product .single_variation_wrap
        $(document).on(
            'show_variation',
            '.popup-product .single_variation_wrap',
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
                    $('.product-slider-big .swiper-slide')
                        .first()
                        .html(variationImage);
                }
                $('p.price').html(variation.price_html);
                $('.popup-product-btn').attr(
                    'data-variation-id',
                    variation.variation_id
                );
                console.log(variation);
            }
        );

        $(document).on('click', '.product-variable-ajax', function (e) {
            e.preventDefault();

            const productId = $(this).attr('data-product-id'),
                quantity = $(this).attr('data-quantity'),
                variationId = $(this).attr('data-variation-id');

            if (variationId != 0 || variationId < 0) {
                ajaxAddProduct(productId, quantity, variationId);
            } else {
                alert(
                    '???????????????? ?????????? ???????????? ?????????? ?????? ?????????????????????? ?? ???????? ??????????????.'
                );
            }
        });

        function ajaxAddProduct(productId, quantity, variationId) {
            var data = {
                action: 'add_product_in_popup',
                productId: productId,
                quantity: quantity,
                variationId: variationId,
                nonce: search_form.nonce,
            };
            $.ajax({
                url: search_form.ajaxurl,
                data: data,
                type: 'POST',
                dataType: 'json',
                beforeSend: function (xhr) {
                    const productPopupLoader =
                        '<div class="popup-product__loader"></div>';
                    $('.popup-product-btn').addClass('loading');
                },
                success: function (data) {},
                error: function () {
                    console.log('error', arguments);
                },
                complete: function (xhr) {
                    $('.popup-product-btn').removeClass('loading');
                    $('.popup-product').hide();
                    $('.popup-product__overlay').hide();
                    $('.popup-product__content').html('');
                    $(document.body).trigger('wc_fragment_refresh');
                },
            });
        }

        // $(document.body).on('added_to_cart', function () {
        //     alert('testing!');
        // });

        // ?????????????????? ???????? ?????? ?????????????????? ??????????????????
        const hitsLi = $('.hits ul li');
        if (hitsLi) {
            hitsLi.on('click', function () {
                if (hitsLi.hasClass('active')) {
                    hitsLi.removeClass('active');
                }
                $(this).addClass('active');
            });
        }

        // Ajax ?????????? ???? ??????????????
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
                    console.log('????????...');
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

        // ?????????????? ?????????? ?????? ?????????? ???? .search-panel__close
        $('.search-panel__close').on('click', function () {
            $(this).hide();
            $('.search-panel__search').show();
            $('.search-result').hide();
            $('.search input').empty().val('');
        });

        // ?????????????? ?????????? ?????? ?????????? ?????? #search_form_result
        $(document).on('mouseup', function (e) {
            // ?????????????? ?????????? ???? ??????-??????????????????
            var div = $('.header-search'); // ?????? ?????????????????? ID ????????????????
            if (
                !div.is(e.target) && // ???????? ???????? ?????? ???? ???? ???????????? ??????????
                div.has(e.target).length === 0
            ) {
                // ?? ???? ???? ?????? ???????????????? ??????????????????
                // $('.search_form_clear').hide();
                $('#search_form_result').hide();
                $('#search_form_result').empty();
                // $('.searchform input[name="s"]').val('').change();
            }
        });

        // Init Gallery Product Images
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
            protect: true, // ????????????????????????????????????????????????? ???????? ????????????????????? ?????????????????????????????????????? ????????????????????????????????????????????
            // toolbar  : false // ???????????????????????? ???????????????????????? ??????????????????????????????????????????????????
            mobile: {
                clickContent: 'close',
                clickSlide: 'close',
            },
        });

        // ?????????????????? ???????????? ??????-???? ?? ???????????????? ????????????
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

        // ?????????????????????????? ?????????????????? ?????????????? ?????? ?????????????????? ????-???? ???????????? ?? ??????????????
        $(document).on('click', '.qty-btn', function () {
            $("[name='update_cart']").trigger('click');
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
                    $('p.price').html(variation.price_html);
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
};

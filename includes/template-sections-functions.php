<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

if ( ! function_exists( 'hook_header' ) ) {
    /**
     * Display Hooks Header
     */
    function hook_header() {         
        ?>
        <header class="header">
            <div class="header__wrap">
                <?php if(is_home()) { ?><div class="header-logo"><?php } else { ?><a class="header-logo" href="<?php echo site_url(); ?>"><?php }; ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/files/icons/svg/logo.svg" alt="<?php echo get_bloginfo( 'title' ); ?>">
                <?php if(is_home()) { ?></div><?php } else { ?></a><?php }; ?>

                <div class="header-contacts">
                    <div class="header-phone">
                        <a class="header-phone__wrpa" href="tel:+79260400495">
                            <div class="header-phone__icon"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--phone"/></svg></div>
                            <div class="header-phone__number">+7 926 040-04-95</div>
                        </a>
                        <span>Пн-Пт, с 09:00 до 17:00</span>
                    </div>
                    <div class="header-mail">
                        <a class="header-phone__wrpa" href="mailto:r-vitrina@mail.ru">
                            <div class="header-phone__icon"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--phone"/></svg></div>
                            <div class="header-phone__number">r-vitrina@mail.ru</div>
                        </a>
                    </div>
                </div>

                <div class="header-shop">
                    <a class="header-shop__item header-favorite" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
                        <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--favorite"/></svg>
                        <?php $favoriteWcwl = yith_wcwl_count_all_products(); ?>
                        <div class="count yith-wcwl-items-count <?php if ($favoriteWcwl > 0) { echo ' active';} ?>"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></div>
                    </a>
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="header-shop__item">
                        <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--user"/></svg>
                    </a>
                    <a class="header-shop__item header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                        <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--cart"/></svg>
                        <?php $cartEmpty = wp_kses_data(WC()->cart->get_cart_contents_count()); ?>
                            <div class="count cart-customlocation<?php if ($cartEmpty > 0) { echo ' active';} ?>"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></div>
                    </a>
                </div>
            </div>
        </header>
    <?php }
}

if ( ! function_exists( 'hook_nav' ) ) {
    /**
     * Display Hooks Nav
     */
    function hook_nav() { ?>
        <nav class="nav">
            <ul>
                <li><a href="<?php echo site_url(); ?>">Главная</a></li>
                <li><a href="<?php echo site_url('/about'); ?>">О компании</a></li>
            </ul>
            <div id="search" class="search">
                <div class="search-panel">
                    <form id="search_form" class="search-form" method="post" action="search_ajax" onsubmit="return false;">
                        <input class="search-form__field" type="text" value="" name="s" placeholder="Поиск продукции" />
                    </form>
                    <div class="search-panel__icon search-panel__search"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--search"/></svg></div>
                    <div class="search-panel__icon search-panel__loader"><img src="<?php echo get_template_directory_uri(); ?>/assets/files/icons/svg/icon--loader.svg" alt=""></div>
                    <div class="search-panel__icon search-panel__close"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--close"/></svg></div>
                </div>
                <div class="search-result">
                </div>
            </div>
            <ul>
                <li><a href="<?php echo site_url('/delivery'); ?>">Оплата и Доставка</a></li>
                <li><a href="<?php echo site_url('/contacts'); ?>">Контакты</a></li>
            </ul>
        </nav>
    <?php }
}

if ( ! function_exists( 'hook_footer' ) ) {
    /**
     * Display Hooks Footer
     */
    function hook_footer() {
        ?>
            <footer id="footer" class="footer">
                <div class="container">
                    <div class="footer__wrap">
                        <div class="footer__col">
                            <?php footer_one(); ?>
                        </div>
                        <div class="footer__col">
                            <?php footer_two(); ?>
                        </div>
                        <div class="footer__col">
                            <?php footer_three(); ?>
                        </div>
                        <div class="footer__col">
                            <div class="footer-nav">
                                <ul>
                                    <li class="footer-nav__head">
                                        <a>Связаться с нами</a>
                                    </li>
                                    <li>
                                        <a href="tel:+79260400495">+7 (926) 040-04-95</a>
                                        <small>Пн-Пт, с 09:00 до 17:00</small>
                                    </li>
                                    <li>
                                        <a href="mailto:r-vitrina@mail.ru">r-vitrina@mail.ru</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer__bottom">
                        <div class="footer-copy">
                            <div class="footer-copy__item">Ритуальная Витрина</div>
                            <div class="footer-copy__item">2010 — <?php echo date('Y'); ?> © Ритуальная Витрина — изготовление и поставка ритуальной продукции оптом</div>                            
                        </div>
                        <a class="footer-dev" href="https://mitroliti.ru/" target="_blank" title="Сайт разработан в компании - mitroliti">Разработано в <strong>Mitroliti</strong>.</a>
                    </div>
                </div>
            </footer>
        <?php
    }
}


if ( ! function_exists( 'hook_page_before' ) ) {
    /**
     * Display Hooks PAge Before
     */
    function hook_page_before() {
        ?>
        <div class="page__wrapper">
          <main class="main">
        <?php
    }
}

if ( ! function_exists( 'hook_page_after' ) ) {
    /**
     * Display Hooks Page after
     */
    function hook_page_after() {
        ?>
          </main>
        </div>
        <?php
    }
}

if ( ! function_exists( 'hook_intro' ) ) {
    /**
     * Display Hooks intro
     */
    function hook_intro() { ?>
        <section class="section section-category">
            <div class="container">
                <div class="section-category__wrap">
                    <aside class="aside aside-nav">
                        <?php aside_menu_primary(); ?>
                    </aside>
                    <div class="category">
                        <div class="category__wrap">
                            <div class="category-item">
                                <div class="category-item__title">Венки <br>ритуальные</div>
                                <div class="category-item__image">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-1.webp" type="image/webp">
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-1.jpg" type="image/jpg">
                                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-1.jpg" alt="">
                                    </picture>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-item__title">Венки <br>ритуальные</div>
                                <div class="category-item__image">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-2.webp" type="image/webp">
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-2.jpg" type="image/jpg">
                                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-2.jpg" alt="">
                                    </picture>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-item__title">Венки <br>ритуальные</div>
                                <div class="category-item__image">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-3.webp" type="image/webp">
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-3.jpg" type="image/jpg">
                                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-3.jpg" alt="">
                                    </picture>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-item__title">Венки <br>ритуальные</div>
                                <div class="category-item__image">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-4.webp" type="image/webp">
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-4.jpg" type="image/jpg">
                                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-4.jpg" alt="">
                                    </picture>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-item__title">Венки <br>ритуальные</div>
                                <div class="category-item__image">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-5.webp" type="image/webp">
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-5.jpg" type="image/jpg">
                                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-5.jpg" alt="">
                                    </picture>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-item__title">Венки <br>ритуальные</div>
                                <div class="category-item__image">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-6.webp" type="image/webp">
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-6.jpg" type="image/jpg">
                                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/category/category-6.jpg" alt="">
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-edge edge__horizon">
            <div class="section__wrap">
                <div class="edge__wrap">
                    <div class="edge-item edge-item__col-3">
                        <div class="edge-item__horizon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--delivery-big"/></svg>
                        </div>
                        <div class="edge-item__desc">
                            <span>Отправляем в <strong>регионы через транспортные компании</strong></span>
                        </div>
                    </div>
                    <div class="edge-item edge-item__col-3">
                        <div class="edge-item__horizon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--delivery"/></svg>
                        </div>
                        <div class="edge-item__desc">
                            <span>Доставка в <strong>радиусе 1000 км доставляем собственными силами</strong></span>
                        </div>
                    </div>
                    <div class="edge-item edge-item__col-3">
                        <div class="edge-item__horizon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--businessman"/></svg>
                        </div>
                        <div class="edge-item__desc">
                            <span>Занимаемся <strong>только оптовой торговлей, работаем с ИП и Юр лицами: ООО, ЗАО</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-hits hits">
            <div class="container">
                <div class="hits__title">
                    <h2>Хиты продаж</h2>
                    <ul>
                        <li class="active" data-term="Венки">Венки</li>
                        <li class="" data-term="Корзины">Корзины</li>
                        <li class="" data-term="Цветы">Цветы</li>
                        <li class="" data-term="Гробы">Гробы</li>
                    </ul>
                </div>
                <div class="hits-tabs">
                    <?php
                        $args = array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => 10,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                ),
                            ),
                        );

                        $hitsLoop = new WP_Query( $args );

                        if ($hitsLoop->have_posts()) : ?>

                            <div class="loop products">
                                <div class="loop__wrap loop-slider swiper">
                                    <div class="swiper-wrapper">

                                    <?php while ($hitsLoop->have_posts()) :

                                        $hitsLoop->the_post();

                                        echo '<div class="swiper-slide">';

                                        wc_get_template_part( 'content', 'product-slider' );

                                        echo '</div>';

                                    endwhile; ?>

                                    </div>
                                    <div class="loop-swiper-button">
                                        <div class="loop-swiper-button-arrow loop-swiper-button-prev"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--loop-next"/></svg></div>
                                        <div class="loop-swiper-button-arrow loop-swiper-button-next"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--loop-next"/></svg></div>
                                    </div>
								    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        
                        <?php endif; ?>

                        <?php wp_reset_query(); // Remember to reset
                    ?>
                </div>
            </div>
        </section>
    <?php }
}

if ( ! function_exists( 'hook_home_category' ) ) {
    /**
     * Display Hooks Home Category
     */
    function hook_home_category() { 
        
        $category = get_field('category', 'option');

        if($category) :

        ?>
        <section class="section section-category category">
            <div class="category__wrap">
                <div class="category__row">
                    <?php
                        foreach($category as $category_item) :
                        $category_img = $category_item['category_img'];
                        $category_title = $category_item['category_title'];
                        $category_url = $category_item['category_url'];
                    ?>
                    <a class="category-item" href="<?php if($category_url) { echo esc_html($category_url); } ?>">
                        <div class="category-item__title"><?php echo $category_title; ?></div>
                        <div class="category-item__image">
                            <?php echo wp_get_attachment_image($category_img, 'full'); ?>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    
        endif;

    }
}

if ( ! function_exists( 'hook_edge' ) ) {
    /**
     * Display Hooks Edge
     */
    function hook_edge() { ?>
        <section class="section section-edge edge">
            <div class="section__wrap">
                <div class="section__title section__title-center">
                    <h2>Наши преимущества</h2>
                </div>
                <div class="edge__wrap">
                    <div class="edge-item edge-item__col-4">
                        <div class="edge-item__icon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--edge-warehouse"/></svg>
                        </div>
                        <div class="edge-item__title">Собственное производство <br>и склад</div>
                        <div class="edge-item__subtitle">Весь предлагаемый нами ассортимент товара всегда доступен и актуален</div>
                    </div>
                    <div class="edge-item edge-item__col-4">
                        <div class="edge-item__icon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--edge-quality"/></svg>
                        </div>
                        <div class="edge-item__title">Качественное сырье</div>
                        <div class="edge-item__subtitle">Изготовленная нами продукция всегда отличается приятным внешним видом и новизной</div>
                    </div>
                    <div class="edge-item edge-item__col-4">
                        <div class="edge-item__icon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--edge-florist"/></svg>
                        </div>
                        <div class="edge-item__title">Мы отлично знаем свое дело!</div>
                        <div class="edge-item__subtitle">В нашей команде работают профессиональные флористы</div>
                    </div>
                    <div class="edge-item edge-item__col-4">
                        <div class="edge-item__icon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--edge-delivery"/></svg>
                        </div>
                        <div class="edge-item__title">Доставка</div>
                        <div class="edge-item__subtitle">Мы осуществляем бесплатную доставку по Москве и М.О.</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-edge edge">
            <div class="section__wrap">
                <div class="section__title section__title-center">
                    <h2>Наши дипломы</h2>
                </div>
                <div class="edge__wrap">
                    <div class="edge-item edge-item__col-4">
                        <a class="edge-item__image" href="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-1.jpg" data-fancybox="doc">
                            <picture>
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-1.webp" type="image/webp">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-1.jpg" type="image/jpg">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-1.jpg" alt="Диплом за участие в выставке «Некрополь 2013» г. Находка">
                            </picture>
                        </a>
                        <div class="edge-item__title">Диплом за участие в выставке «Некрополь 2013»</div>
                        <div class="edge-item__subtitle">г. Находка</div>
                    </div>
                    <div class="edge-item edge-item__col-4">
                        <a class="edge-item__image" href="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-2.jpg" data-fancybox="doc">
                            <picture>
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-2.webp" type="image/webp">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-2.jpg" type="image/jpg">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-2.jpg" alt="Диплом за участие в выставке «Некрополь 2013» г. Находка">
                            </picture>
                        </a>
                        <div class="edge-item__title">Конкурс «Золотая Медаль» Номинация: Цветы, фоны, венки. Выставка «Некрополь 2013»</div>
                        <div class="edge-item__subtitle">г. Находка</div>
                    </div>
                    <div class="edge-item edge-item__col-4">
                        <a class="edge-item__image" href="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-3.jpg" data-fancybox="doc">
                            <picture>
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-3.webp" type="image/webp">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-3.jpg" type="image/jpg">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-3.jpg" alt="Диплом за участие в выставке «Некрополь 2013» г. Находка">
                            </picture>
                        </a>
                        <div class="edge-item__title">Конкурс «Золотая Медаль» Номинация: Цветы, фоны, венки. Выставка «Некрополь 2014»</div>
                        <div class="edge-item__subtitle"> г. Москва</div>
                    </div>
                    <div class="edge-item edge-item__col-4">
                        <a class="edge-item__image" href="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-4.jpg" data-fancybox="doc">
                            <picture>
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-4.webp" type="image/webp">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-4.jpg" type="image/jpg">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-4.jpg" alt="Диплом за участие в выставке «Некрополь 2013» г. Находка">
                            </picture>
                        </a>
                        <div class="edge-item__title">I Место, VI Специализированная выставка «Белый Тополь 2014»</div>
                        <div class="edge-item__subtitle"> г. Новосибирск</div>
                    </div>
                    <!-- <div class="edge-item edge-item__col-4">
                        <a class="edge-item__image" href="<?php //echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-5.jpg" data-fancybox="doc">
                            <picture>
                                <source srcset="<?php //echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-5.webp" type="image/webp">
                                <source srcset="<?php //echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-5.jpg" type="image/jpg">
                                <img loading="lazy" src="<?php //echo get_template_directory_uri(); ?>/assets/images/section/doc/doc-5.jpg" alt="Диплом за участие в выставке «Некрополь 2013» г. Находка">
                            </picture>
                        </a>
                        <div class="edge-item__title">I Место, VI Специализированная выставка «Белый Тополь 2014» </div>
                        <div class="edge-item__subtitle">г. Новосибирск</div>
                    </div> -->
                </div>
            </div>
        </section>
    <?php }
}

if ( ! function_exists( 'hook_head_code' ) ) {

    add_filter('wp_body_open', 'hook_head_code');
    /**
     * Display Hooks Head Code
     */
    function hook_head_code() {}
}

if ( ! function_exists( 'google_analytics' ) ) {
    add_filter('wp_head', 'google_analytics');
    function google_analytics() { ?>
    <?php }
}

if ( ! function_exists( 'yandex_metrika' ) ) {
    add_filter('wp_footer', 'yandex_metrika');
    function yandex_metrika() {
        ?>
        <?php
    }
}

if ( ! function_exists( 'hook_gotop' ) ) {
    // add_filter('wp_footer', 'hook_gotop');
    /**
     * Display Hooks gotop
     */
    function hook_gotop() {
    }
}

if ( ! function_exists( 'hook_popup' ) ) {
    add_filter('wp_footer', 'hook_popup');
    /**
     * Display Hooks hook_popup
     */
    function hook_popup() { ?>
        <div id="popup_product" class="popup popup-product">
            <div class="popup-product__wrap">
                <div class="popup-product__close">
                    <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--close"/></svg>
                </div>
                <div class="popup-product__content">

                </div>
            </div>
        </div>
        <div class="popup-product__overlay"></div>
    <?php }
}

if ( ! function_exists( 'hook_fixed_btn' ) ) {
    // add_filter('wp_footer', 'hook_fixed_btn');
    /**
     * Display Hooks hook_fixed_btn
     */
    function hook_fixed_btn() {
        $cartEmpty = wp_kses_data(WC()->cart->get_cart_contents_count());
        ?>
        <div class="fixed-btn">
            <?php if(!is_cart()) { ?>
            <a class="fixed-btn__item" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                <div class="fixed-btn__inner">
                    <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--cart"/></svg>
                    <div class="count cart-customlocation<?php if ($cartEmpty > 0) { echo ' active';} ?>"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></div>
                </div>
            </a>
            <?php echo do_shortcode('[yith_wcwl_items_count]'); ?>
            <?php } ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'hook_variable_product_add' ) ) {
    add_filter('wp_footer', 'hook_variable_product_add');
    /**
     * Display Hooks hook_variable_product_add
     */
    function hook_variable_product_add() {
        echo '<div id="variable_product_add" class="variable_product_add"></div>';
    }
}
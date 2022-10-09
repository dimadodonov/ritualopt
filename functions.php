<?php

require get_template_directory() . '/includes/enqueue_script_style.php';
// require get_template_directory() . '/includes/widget-areas.php';
//require get_template_directory() . '/includes/helpers.php';
// require get_template_directory() . '/includes/post-type.php';

/**
 * Implement the add thumbnail Post and Product.
 */
require get_template_directory() . '/includes/thumbnail.php';

/**
 * Подключаем файл с подключением хуков
 */
require get_template_directory() . '/includes/template-hooks.php';

/**
 * Подключаем файл с настройками для блоков
 */
require get_template_directory() . '/includes/template-sections-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/includes/template-functions.php';

/**
 * Navigations .
 */
require get_template_directory() . '/includes/navigations.php';


/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {

    /**
     * Load Ajax file.
     */
    require get_template_directory() . '/includes/ajax-search.php';
    require get_template_directory() . '/includes/ajax.php';

    require get_template_directory() . '/includes/woocommerce.php';
    require get_template_directory() . '/includes/woocommerce-fields.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions-cart.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions-account.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions-archive.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions-product.php';
    require get_template_directory() . '/woocommerce/includes/wc-function_checkount.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions-btn.php';
    require get_template_directory() . '/woocommerce/includes/wc-function-product-cart.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions-breadcrumb.php';
    require get_template_directory() . '/woocommerce/includes/wc-functions-remove.php';
    // require get_template_directory() . '/woocommerce/includes/wc-template-function.php';
}
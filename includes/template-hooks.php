<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

/**
 * Header hooks
 *
 * @see  hook_header
 */

add_action( 'hook_header', 'hook_header',                       10 );
add_action( 'hook_header', 'hook_nav',                          20 );

/**
 * Home Page hooks
 *
 * @see  hook_page_before
 * @see  hook_page_after
 */

add_action( 'hook_home', 'hook_page_before',                    10 );
add_action( 'hook_home', 'hook_intro',                          10 );
add_action( 'hook_home', 'hook_edge',                          10 );
add_action( 'hook_home', 'hook_page_after',                     80 );


/**
 * Footer hooks
 *
 * @see  hook_order_popup
 * @see  hook_footer
 * @see  hook_fixed_btn
 */

add_action( 'hook_footer', 'hook_footer',                       30 );
// add_action( 'hook_footer', 'hook_fixed_btn',                       30 );
<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Настройки сайта',
		'menu_title'	=> 'Настройки сайта',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Навигация по каталогу',
		'menu_title'	=> 'Навигация по каталогу',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Footer Settings',
	// 	'menu_title'	=> 'Footer',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));
	
}



/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );
add_theme_support( 'woocommerce' );

//        add_theme_support( 'wc-product-gallery-zoom' );
//        add_theme_support( 'wc-product-gallery-lightbox' );
//        add_theme_support( 'wc-product-gallery-slider' );

// disable flexslider js
function flex_dequeue_script() {
    wp_dequeue_script( 'flexslider' );
}
add_action( 'wp_print_scripts', 'flex_dequeue_script', 100 );

// disable zoom jquery js file
function zoom_dequeue_script() {
    wp_dequeue_script( 'zoom' );
}
add_action( 'wp_print_scripts', 'zoom_dequeue_script', 100 );

// disable photoswipe js file
function photoswipe_dequeue_script() {
    wp_dequeue_script( 'photoswipe-ui-default' );
}
add_action( 'wp_print_scripts', 'photoswipe_dequeue_script', 100 );

// Включаем миниатюры в записях
add_theme_support('post-thumbnails');

// Отключение scaling & Disabling the scaling
add_filter( 'big_image_size_threshold', '__return_false' );


## Добавляем свой размер для миниатюр
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'product', 1024, 1024, true );
}

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter('get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

function filter_ptags_on_images($content)
{
    // do a regular expression replace...
    // find all p tags that have just
    // <p>maybe some white space<img all stuff up to /> then maybe whitespace </p>
    // replace it with just the image tag...
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    // now pass that through and do the same for iframes...
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}

// we want it to be run after the autop stuff... 10 is default.
add_filter('the_content', 'filter_ptags_on_images');

/**
 * Filter for adding wrappers around embedded objects
 */
function responsive_embeds( $content ) {
	$content = preg_replace( "/<object/Si", '<div class="embed-container"><object', $content );
	$content = preg_replace( "/<\/object>/Si", '</object></div>', $content );
	
	/**
	 * Added iframe filtering, iframes are bad.
	 */
	$content = preg_replace( "/<iframe.+?src=\"(.+?)\"/Si", '<div class="embed-container"><iframe src="\1" frameborder="0" allowfullscreen>', $content );
	$content = preg_replace( "/<\/iframe>/Si", '</iframe></div>', $content );

	return $content;
}

add_filter( 'the_content', 'responsive_embeds' );
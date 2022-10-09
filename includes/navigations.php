<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}


register_nav_menus( array(
    'general' => 'Меню для компьютера',
    'footer' => 'Меню в подвале',
    'cat' => 'Категории товаров',
    'aside' => 'Сайтбар'
));


function header_menu_general() {
    wp_nav_menu( array(
        'theme_location' => 'general',
        'menu_id' => 'general_menu',
        'menu_class'      => 'nav-header__wrap',
	    'container'       => 'nav',
        'container_class' => 'nav nav-header',
        'container_id'    => '',
    ));
}

function header_mob_general() {
    wp_nav_menu( array(
        'theme_location' => 'footer',
        'menu_id' => 'header_mob_general',
        'menu_class'      => '',
	    'container'       => 'div',
        'container_class' => 'header_mob_general',
        'container_id'    => '',
    ));
}


function footer_menu_general() {
    wp_nav_menu( array(
        'theme_location' => 'footer',
        'menu_id' => 'footer_nav',
        'menu_class'      => '',
	    'container'       => 'div',
        'container_class' => 'footer-nav',
        'container_id'    => '',
    ));
}

function header_mob_cat() {
    wp_nav_menu( array(
        'theme_location' => 'cat',
        'menu_id' => 'header_mob_cat',
        'menu_class'      => '',
	    'container'       => 'div',
        'container_class' => 'header_mob_cat',
        'container_id'    => '',
    ));
}

function main_menu_cat() {
    wp_nav_menu( array(
        'theme_location' => 'cat',
        'menu_id' => 'cat_menu',
	    'container'       => 'nav',
        'container_class' => 'nav',
        'container_id'    => '',
        'menu_class'      => 'nav-cat-menu',
    ));
}

function aside_menu_primary() {
    wp_nav_menu( array(
        'theme_location' => 'aside',
        'menu_id' => 'aside_menu',
	    'container'       => 'div',
        'container_class' => 'aside-nav',
        'container_id'    => '',
        'menu_class'      => 'aside-nav',
        'menu_id'         => '',
    ));
}
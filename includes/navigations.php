<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}


register_nav_menus( array(
    'general' => 'Меню для компьютера',
    'footer_one' => 'Меню в подвале 1',
    'footer_two' => 'Меню в подвале 2',
    'footer_three' => 'Меню в подвале 3',
    'footer_nav' => 'Мобильное меню в подвале',
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

function footer_one() {
    wp_nav_menu( array(
        'theme_location' => 'footer_one',
        'menu_id' => 'footer_one',
        'menu_class'      => '',
	    'container'       => 'div',
        'container_class' => 'footer-nav',
        'container_id'    => '',
    ));
}
function footer_two() {
    wp_nav_menu( array(
        'theme_location' => 'footer_two',
        'menu_id' => 'footer_two',
        'menu_class'      => '',
	    'container'       => 'div',
        'container_class' => 'footer-nav',
        'container_id'    => '',
    ));
}
function footer_three() {
    wp_nav_menu( array(
        'theme_location' => 'footer_three',
        'menu_id' => 'footer_three',
        'menu_class'      => '',
	    'container'       => 'div',
        'container_class' => 'footer-nav',
        'container_id'    => '',
    ));
}


function footer_menu_general() {
    wp_nav_menu( array(
        'theme_location' => 'footer_nav',
        'menu_id' => 'footer_nav',
        'menu_class'      => 'footer-menu__cat',
	    'container'       => 'div',
        'container_class' => 'footer-nav footer-nav__cat',
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
        'menu_class'      => 'cat_menu',
	    'container'       => 'div',
        'container_class' => 'footer-nav footer-nav__cat',
        'container_id'    => '',
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
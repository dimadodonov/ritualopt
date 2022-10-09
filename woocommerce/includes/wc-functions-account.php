<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}


add_filter ( 'woocommerce_account_menu_items', 'custom_my_account_links' );
function custom_my_account_links( $menu_links ){
 
	unset( $menu_links['downloads'] ); // Disable Downloads
 
	//unset( $menu_links['dashboard'] ); // Remove Dashboard
	//unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	//unset( $menu_links['orders'] ); // Remove Orders
	//unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link
 
	return $menu_links;
 
}

add_filter ( 'woocommerce_account_menu_items', 'custom_my_account_rename_links' );
 
function custom_my_account_rename_links( $menu_links ){
 
	// $menu_links['TAB ID HERE'] = 'NEW TAB NAME HERE';
	$menu_links['dashboard'] = 'Мой аккаунт';
	$menu_links['orders'] = 'Недавние заказы';
	$menu_links['edit-account'] = 'Изменить данные';
	$menu_links['edit-address'] = 'Изменить адрес';
 
	return $menu_links;
}

// Add term and conditions check box on registration form
add_action( 'woocommerce_register_form', 'add_terms_and_conditions_to_registration', 20 );
function add_terms_and_conditions_to_registration() {

    if ( wc_get_page_id( 'terms' ) > 0 && is_account_page() ) {
        ?>
        <p class="form-row terms wc-terms-and-conditions">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" /> <span><?php printf( __( 'Согласен c <a href="%s" target="_blank" class="woocommerce-terms-and-conditions-link"> политикой конфиденциальности</a>', 'woocommerce' ), esc_url( wc_get_page_permalink( 'terms' ) ) ); ?></span> <span class="required">*</span>
            </label>
            <input type="hidden" name="terms-field" value="1" />
        </p>
    <?php
    }
}

// Validate required term and conditions check box
add_action( 'woocommerce_register_post', 'terms_and_conditions_validation', 20, 3 );
function terms_and_conditions_validation( $username, $email, $validation_errors ) {
    if ( ! isset( $_POST['terms'] ) )
        $validation_errors->add( 'terms_error', __( 'Не согласен c
политикой конфиденциальности', 'woocommerce' ) );

    return $validation_errors;
}

add_filter( 'woocommerce_get_terms_and_conditions_checkbox_text', '__return_false' );


/*
 * Change the order of the endpoints that appear in My Account Page - WooCommerce 2.6
 * The first item in the array is the custom endpoint URL - ie http://mydomain.com/my-account/my-custom-endpoint
 * Alongside it are the names of the list item Menu name that corresponds to the URL, change these to suit
 */

function wpb_woo_my_account_order() {
	$myorder = array(
		'dashboard'          => __( 'Мой аккаунт', 'woocommerce' ),
		'orders'             => __( 'Заказы', 'woocommerce' ),
		'edit-address'       => __( 'Адрес доставки', 'woocommerce' ),
		'edit-account'       => __( 'Личные данные', 'woocommerce' ),
		'customer-logout'    => __( 'Logout', 'woocommerce' ),
	);

	return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );


// Display the mobile phone field
// add_action( 'woocommerce_edit_account_form_start', 'add_billing_mobile_phone_to_edit_account_form' ); // At start
// add_action( 'woocommerce_edit_account_form', 'add_billing_mobile_phone_to_edit_account_form' ); // After existing fields
function add_billing_mobile_phone_to_edit_account_form() {
    $user = wp_get_current_user();
    ?>
     <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="billing_mobile_phone"><?php _e( 'Mobile phone', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--phone input-text" name="billing_mobile_phone" id="billing_mobile_phone" value="<?php echo esc_attr( $user->billing_mobile_phone ); ?>" />
    </p>
    <?php
}
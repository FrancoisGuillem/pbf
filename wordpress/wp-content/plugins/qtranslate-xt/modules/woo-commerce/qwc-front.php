<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function qwc_add_filters_front() {

    remove_filter( 'get_post_metadata', 'qtranxf_filter_postmeta', 5 );
    add_filter( 'get_post_metadata', 'qwc_filter_postmeta', 5, 4 );

    $use_filters = array(
        /* one-argument filters */
        'wp_mail_from_name'                                 => 20,
        'woocommerce_order_item_display_meta_value'         => 20,
        'woocommerce_order_details_after_order_table_items' => 20,
        'woocommerce_page_title'                            => 20,
        'woocommerce_short_description'                     => 20,
        'woocommerce_variation_option_name'                 => 20,

        /* two-argument filters */
        'woocommerce_attribute_label'                       => 20,
        'woocommerce_cart_shipping_method_full_label'       => 20,
        'woocommerce_cart_tax_totals'                       => 20,
        'woocommerce_email_footer_text'                     => 20,
        'woocommerce_gateway_description'                   => 20,
        'woocommerce_gateway_title'                         => 20,
        'woocommerce_gateway_icon'                          => 20,
        'woocommerce_order_item_name'                       => 20,
        'woocommerce_order_shipping_to_display'             => 20,
        'woocommerce_order_get_tax_totals'                  => 20,
        'woocommerce_product_title'                         => 20,
        'woocommerce_rate_label'                            => 20,

        /* three-argument filters */
        'woocommerce_attribute'                             => 20,
        'woocommerce_cart_item_name'                        => 20,
        'woocommerce_cart_item_thumbnail'                   => 20,
        'woocommerce_order_subtotal_to_display'             => 20,

        /* four-argument filters */
        'woocommerce_format_content'                        => 20,
        //function wc_format_content in woocommerce/includes/wc-formatting-functions.php

        //not in front
        //'woocommerce_email_get_option' => 0
    );

    foreach ( $use_filters as $name => $priority ) {
        add_filter( $name, 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', $priority );
    }

    add_filter( 'woocommerce_paypal_args', 'qwc_paypal_args' );
    add_filter( 'woocommerce_product_get_attributes', 'qwc_product_get_attributes', 5 );
    //no need add_filter( 'woocommerce_product_default_attributes', 'qwc_product_default_attributes', 5 );

    //below do not seem to need

    //foreach ( $url_filters as $name => $priority ) {
    //	add_filter( $name, 'qtranxf_convertURL', $priority );
    //}

    /* Fix the product categories and tags (displayed above the "additional informations" tab) *
    add_filter( 'wp_get_object_terms', function ( $terms ) {
        foreach ( $terms as $term ) {
            if ( $term->taxonomy == 'product_cat' || $term->taxonomy == 'product_tag' ) {
                $term->name = qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage( $term->name );
            }
        }

        return $terms;
    } );

    /* Fix the product attributes (displayed in the "additional informations" tab) *
    add_filter( 'woocommerce_attribute', function ( $text ) {
        $values = explode( ', ', $text );
        foreach ( $values as $i => $val ) {
            $values[ $i ] = qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage( $val );
        }

        return implode( ', ', $values );
    } );
    */
}

function qwc_filter_postmeta( $original_value, $object_id, $meta_key = '', $single = false ) {
    //qtranxf_dbg_log_if($object_id==58,'qwc_filter_postmeta: $object_id='.$object_id.' $meta_key:',$meta_key);
    switch ( $meta_key ) {
        case '_product_attributes':
            return $original_value;
        default:
            return qtranxf_filter_postmeta( $original_value, $object_id, $meta_key, $single );
    }
}

/**
 * Store the current WordPress language along with the order, so we know later on which language the customer used while ordering
 * Called with
 * do_action( 'woocommerce_checkout_update_order_meta', $order_id, $this->posted );
 * in /woocommerce/includes/class-wc-checkout.php
 */
add_action( 'woocommerce_checkout_update_order_meta', 'save_post_qwc_store_language', 100 );
function save_post_qwc_store_language( $order_id ) {
    global $q_config;
    add_post_meta( $order_id, '_user_language', $q_config['language'], true );
}

function qwc_product_get_attributes( $attributes ) {
    //only 'value' needs to be translated at front end
    foreach ( $attributes as $key => $attribute ) {
        if ( ! isset( $attribute['value'] ) ) {
            continue;
        }
        $attributes[ $key ]['value'] = qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage( $attribute['value'] );
    }

    return $attributes;
}

function qwc_paypal_args( $args ) {
    //if(!isset($args['country']))
    $args['lc'] = get_locale();

    //unset($args['country']);
    return $args;
}

/**
 * Dealing with webhooks, which should always send information in Raw ML format
 */
if ( wp_doing_cron() ) {

    function qwc_deliver_webhook_async( $webhook_id, $arg ) {
        //qtranxf_dbg_log('qwc_deliver_webhook_async: $webhook_id=',$webhook_id);

        $page_configs = qtranxf_get_front_page_config();
        //qtranxf_dbg_log('$page_configs: ', $page_configs);
        if ( ! empty( $page_configs['']['filters'] ) ) {
            qtranxf_remove_filters( $page_configs['']['filters'] );
        }

        remove_filter( 'get_post_metadata', 'qtranxf_filter_postmeta', 5 );
        remove_filter( 'the_posts', 'qtranxf_postsFilter', 5 );
        remove_action( 'pre_get_posts', 'qtranxf_pre_get_posts', 99 );

        remove_filter( 'get_term', 'qtranxf_useTermLib', 0 );
        remove_filter( 'get_terms', 'qtranxf_useTermLib', 0 );
        //add_filter('get_term', 'qtranxf_useAdminTermLibJoin', 20);
        //add_filter('get_terms', 'qtranxf_useAdminTermLibJoin', 20);
    }

    add_action( 'woocommerce_deliver_webhook_async', 'qwc_deliver_webhook_async', 5, 2 );

} else {
    qwc_add_filters_front();
}

/**
 * Dealing with mini-cart cache in internal browser storage.
 *
 * @param array $cart wc variable holding contents of the cart without language information.
 *
 * @return string cart hash with language information
 */
function qwc_get_cart_hash( $cart ) {
    $lang = qtranxf_getLanguage();
    $hash = md5( json_encode( $cart ) . $lang );

    return $hash;
}

/**
 * Dealing with mini-cart cache in internal browser storage.
 * Sets 'woocommerce_cart_hash' cookie.
 *
 * @param array $cart wc variable holding contents of the cart without language information.
 */
function qwc_set_cookies_cart_hash( $cart ) {
    $hash = qwc_get_cart_hash( $cart );
    wc_setcookie( 'woocommerce_cart_hash', $hash );
}

/**
 * Dealing with mini-cart cache in internal browser storage.
 * Response to action 'woocommerce_cart_loaded_from_session'.
 *
 * @param WC_Cart $wc_cart wc object without language information.
 */
function qwc_cart_loaded_from_session( $wc_cart ) {
    if ( headers_sent() ) {
        return;
    }
    $cart = $wc_cart->get_cart_for_session();
    qwc_set_cookies_cart_hash( $cart );
}

add_action( 'woocommerce_cart_loaded_from_session', 'qwc_cart_loaded_from_session', 5 );

/**
 * Dealing with mini-cart cache in internal browser storage.
 * Response to action 'woocommerce_set_cart_cookies', which overwrites the default WC cart hash and cookies.
 *
 * @param bool $set is true if cookies need to be set, otherwse they are unset in calling function.
 */
function qwc_set_cart_cookies( $set ) {
    if ( $set ) {
        $wc      = WC();
        $wc_cart = $wc->cart;
        $cart    = $wc_cart->get_cart_for_session();
        qwc_set_cookies_cart_hash( $cart );
    }
}

add_action( 'woocommerce_set_cart_cookies', 'qwc_set_cart_cookies' );

/**
 * Dealing with mini-cart cache in internal browser storage.
 * Response to action 'woocommerce_cart_hash' which overwrites the default WC cart hash and cookies.
 *
 * @param string $hash default WC hash.
 * @param array $cart wc variable holding contents of the cart without language information.
 *
 * @return string cart hash with language information
 */
function qwc_cart_hash( $hash, $cart ) {
    $hash = qwc_get_cart_hash( $cart );
    if ( ! headers_sent() ) {
        wc_setcookie( 'woocommerce_cart_hash', $hash );
    }

    return $hash;
}

add_filter( 'woocommerce_cart_hash', 'qwc_cart_hash', 5, 2 );

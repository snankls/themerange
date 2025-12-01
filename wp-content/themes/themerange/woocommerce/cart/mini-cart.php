<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version     9.4.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if(  WC()->cart->get_cart() ):
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) { ?>
        
    <div class="post-block mini-cart">
        <div class="inner-box">
            <div class="image <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                if ( ! $_product->is_visible() )
                    echo esc_attr($thumbnail);
                else
                    printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail ); ?>
            </div>
            
            <h6>
                <?php if ( ! $_product->is_visible() )
                    echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                else
                    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
                ?>
                
                <?php echo apply_filters(
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span class="icon fa fa-remove"></span></a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        esc_html__( 'Remove this item', 'themerange' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                    ),
                    $cart_item_key
                ); ?>
            </h6>
            
            <div class="quantity-text"><?php echo wp_kses_post($cart_item['quantity']); ?> x <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></div>
        </div>
    </div>	

<?php }
	}
	else: ?>

    <div class="post-block mini-cart">
        <p><?php esc_html_e( 'There is no item in your cart', 'themerange' ); ?></p>
    </div>

<?php endif; ?>

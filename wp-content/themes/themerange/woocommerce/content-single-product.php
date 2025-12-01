<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
	 $allowed_tags = wp_kses_allowed_html('post');
?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="upper-box">
    	<div class="row clearfix">
            
            <div class="shop-detail_gallery-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
					<?php
                        /**
                         * woocommerce_before_single_product_summary hook.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                </div>
        	</div>
            
            <div class="shop-detail_content-column summary col-lg-6 col-md-12 col-sm-12">
        		
                <div class="inner-column">
                    <?php woocommerce_template_single_title(); ?>
                    <!-- Rating -->
                    <div class="shop-detail_rating">
                        <?php woocommerce_template_single_rating(); ?>
                    </div>
                    <?php woocommerce_template_single_price(); ?>
                    <div class="shop-detail_text"><?php woocommerce_template_single_excerpt(); ?></div>
                    
                    <div class="shop-detail_list">
                    	<?php woocommerce_template_single_meta(); ?>
                    </div>
                    
                    <div class="button-box">
                        <!-- Button Box -->
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>
                </div>
                
            </div><!-- .summary -->
    	</div>
    </div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div><!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' ); ?>
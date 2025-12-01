<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<?php $theme_options = themerange_get_theme_options();
global $woocommerce_loop;
                    
if( absint($theme_options['tr_product_columns']) > 0 ){
	$woocommerce_loop['columns'] = absint($theme_options['tr_product_columns']);
}

if($woocommerce_loop['columns'] == 3)
	$column = 'shop-item col-xl-4 col-lg-6 col-md-6 col-sm-12';
else if($woocommerce_loop['columns'] == 4)
	$column = 'shop-item col-xl-3 col-lg-6 col-md-6 col-sm-12'; ?>

<section <?php wc_product_class( $column, $product ); ?> data-product_id="<?php echo esc_attr($product->get_id()); ?>">
    <div class="inner-box">
        
        <?php if( $theme_options['tr_product_thumbnail'] ): ?>
        <div class="image">
        	<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
            <a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>" class="overlay-link"></a>
            
            <?php woocommerce_template_loop_product_thumbnail(); ?>
            <div class="overlay-box">
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                <ul class="cart-option">
                    <li><a href="<?php echo esc_url($image[0]); ?>" class="fa-solid fa-expand fa-fw"></a></li>
                    <li><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>" class="fa-solid fa-cart-plus fa-fw"></a></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="lower-content">
        	<?php if( $theme_options['tr_product_rating'] ): ?>
            <div class="rating">
                <?php woocommerce_template_loop_rating(); ?>
            </div>
            <?php endif; ?>
            
            <?php if( $theme_options['tr_product_title'] ): ?>
            <h3><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h3>
            <?php endif; ?>
                
			<?php if( $theme_options['tr_product_desc'] ) : ?>
            <div class="content">
                <?php themerange_the_excerpt_max_words($theme_options['tr_product_desc_words'], '', true, '...', true); ?>
            </div>
            <?php endif; ?>
            
            <div class="d-flex justify-content-between align-items-center flex-wrap">
            	<?php if( $theme_options['tr_product_price'] ): ?>
                	<?php woocommerce_template_loop_price(); ?>
                <?php endif; ?>
                
                <?php if( $theme_options['tr_product_button'] ) : ?>
                <!-- Cart -->
                <a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>" class="cart"><span class="icon flaticon-shopping-cart-1"></span></a>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</section>

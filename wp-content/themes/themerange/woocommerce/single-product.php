<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); 

$theme_options = themerange_get_theme_options();

$extra_class = '';
$page_column_class = themerange_page_layout_columns_class($theme_options['tr_prod_layout']);

$show_banner = $theme_options['tr_prod_breadcrumb'];
$layout_view = $theme_options['tr_shop_detail_layout'];
$background_image = $theme_options['tr_shop_detail_background_image']['url'];
$show_single_title = $theme_options['tr_shop_detail_title'];
$single_custom_name = !empty($theme_options['tr_shop_detail_custom_name']) ? $theme_options['tr_shop_detail_custom_name'] : get_the_title();
$single_breadcrumb = $theme_options['tr_enable_shop_detail_breadcrumb'];

themerange_single_banner($show_banner, $layout_view, $background_image, $show_single_title, $single_custom_name, $single_breadcrumb);
?>

<!-- Shop Detail -->
<section class="shop-detail">
    <div class="auto-container">
        <div class="row clearfix">
        
            <!-- Left Sidebar -->
            <?php if( $page_column_class['left_sidebar'] ): ?>
            <div id="left-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
                <aside>
                <?php if( is_active_sidebar($theme_options['tr_prod_left_sidebar']) ): ?>
                    <?php dynamic_sidebar( $theme_options['tr_prod_left_sidebar'] ); ?>
                <?php endif; ?>
                </aside>
            </div>
            <?php endif; ?>	
            
            <div class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
                <div class="site-content">
					<?php
                        /**
                         * woocommerce_before_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                         * @hooked woocommerce_breadcrumb - 20
                         */
                        do_action( 'woocommerce_before_main_content' );
                    ?>
                
                        <?php while ( have_posts() ) : the_post(); ?>
                
                            <?php wc_get_template_part( 'content', 'single-product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                
                    <?php
                        /**
                         * woocommerce_after_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        do_action( 'woocommerce_after_main_content' );
                    ?>
                </div>
            </div>
            
            <!-- Right Sidebar -->
            <?php if( $page_column_class['right_sidebar'] ): ?>
            <div id="right-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
                <aside>
                    <?php if( is_active_sidebar($theme_options['tr_prod_right_sidebar']) ): ?>
                        <?php dynamic_sidebar( $theme_options['tr_prod_right_sidebar'] ); ?>
                    <?php endif; ?>
                </aside>
            </div>
            <?php endif; ?>

	    </div>
    </div>
</section>
<?php get_footer(); ?>
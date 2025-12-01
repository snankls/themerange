<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$extra_class = '';
$theme_options = themerange_get_theme_options();
$grid_list_default = !empty($theme_options['tr_product_grid_list_toggle']) ? $theme_options['tr_prod_grid_list_toggle_default'] : 'grid';
$page_column_class = themerange_page_layout_columns_class($theme_options['tr_product_layout']);
$show_banner = $theme_options['tr_enable_shop_banner'];
$layout_view = $theme_options['tr_shop_layout'];
$background_image = $theme_options['tr_shop_background_image']['url'];
$show_single_title = $theme_options['tr_shop_title'];
$single_custom_name = !empty($theme_options['tr_shop_custom_name']) ? $theme_options['tr_shop_custom_name'] : get_the_title();
$single_breadcrumb = $theme_options['tr_enable_shop_breadcrumb'];

themerange_banner($show_banner, $layout_view, $background_image, $show_single_title, $single_custom_name, $single_breadcrumb);
?>

<!-- Sidebar Page Container -->
<div class="page-container <?php echo esc_attr($extra_class) ?>">
    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">
            
                <!-- Left Sidebar -->
                <?php if( $page_column_class['left_sidebar'] ): ?>
                <div id="left-sidebar" class="tr-sidebar sidebar-side left-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
                    <aside class="sidebar sticky-top">
						<?php if( is_active_sidebar($theme_options['tr_product_left_sidebar']) ){
                            dynamic_sidebar( $theme_options['tr_product_left_sidebar'] );
                        } ?>
                    </aside>
                </div>
                <?php endif; ?>	
                
                <?php
                    /**
                     * woocommerce_before_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    //do_action( 'woocommerce_before_main_content' );
                ?>
                <div id="main-content" class="content-side shop-products <?php echo esc_attr($page_column_class['main_class']); ?> ">	
                    <div id="primary" class="shop-section">
                    	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                        	
                            <!-- Filter Box -->
                            <div class="filter-box">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <?php
										/**
										 * woocommerce_before_shop_loop hook
										 *
										 * @hooked woocommerce_result_count - 20
										 * @hooked woocommerce_catalog_ordering - 30
										 */
										do_action( 'woocommerce_before_shop_loop' );
									?>
                                </div>
                            </div>
                            
                        <?php endif; ?>
                    
                        <?php //do_action( 'woocommerce_archive_description' ); ?>
            
                            <?php if ( woocommerce_product_loop() ) : ?>

                                <?php  global $woocommerce_loop; ?>
                                
                                <div class="woocommerce main-products <?php echo esc_attr( $grid_list_default ); ?>">
                                    <?php woocommerce_product_loop_start(); ?>
                                    
                                    <div class="row clearfix">
                                      <?php   if( wc_get_loop_prop( 'total' ) ){
                                            while ( have_posts() ){
                                                the_post();
                            
                                                do_action( 'woocommerce_shop_loop' );
                                            
                                                wc_get_template_part( 'content', 'product' );
                                            }
                                        } ?>
                                    </div>
                        
                                    <?php woocommerce_product_loop_end(); ?>
                                </div>
                                
                                <div class="after-loop-wrapper"><?php do_action( 'woocommerce_after_shop_loop' ); ?></div>
                                
                            <?php else: ?>
                    
                                <?php do_action( 'woocommerce_no_products_found' ); ?>
                    
                            <?php endif; ?>
                    
                        <?php
                            /**
                             * woocommerce_after_main_content hook
                             *
                             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                             */
                            //do_action( 'woocommerce_after_main_content' );
                        ?>
                	</div>
            	</div>
                
                <!-- Right Sidebar -->
                <?php if( $page_column_class['right_sidebar'] ): ?>
                <div id="right-sidebar" class="tr-sidebar sidebar-side right-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">	
                    <aside class="sidebar sticky-top">
						<?php if( is_active_sidebar($theme_options['tr_product_right_sidebar']) ){
                            dynamic_sidebar( $theme_options['tr_product_right_sidebar'] );
                        } ?>
                    </aside>
                </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
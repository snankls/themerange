<?php
/*************************************************
* WooCommerce Custom Hook                        *
**************************************************/

/*** Shop - Category ***/

/* Remove hook */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//Product Per Page
add_filter('loop_shop_per_page', 'themerange_change_products_per_page_shop');
function themerange_change_products_per_page_shop(){
    if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( isset($_GET['per_page']) && absint($_GET['per_page']) > 0 ){
			return absint($_GET['per_page']);
		}
		$per_page = absint( themerange_get_theme_options('tr_product_per_page') );
        if( $per_page ){
            return $per_page;
        }
    }
}

//Related Products
add_filter('woocommerce_output_related_products_args', 'themerange_related_products_args');
function themerange_related_products_args( $args ){
	$args['posts_per_page'] = 3;
	$args['columns'] = 1;
	return $args;
}

//Quantity Input hooks
add_action('woocommerce_before_quantity_input_field', 'themerange_before_quantity_input_field', 1);
function themerange_before_quantity_input_field(){ ?>
	<label class="tr-screen-reader-text"><?php esc_html_e('Quantity', 'themerange'); ?></label>
	<div class="quantity number-button d-flex">
		<input type="button" value="-" class="minus" />
	<?php
}

add_action('woocommerce_after_quantity_input_field', 'themerange_after_quantity_input_field', 99);
function themerange_after_quantity_input_field(){ ?>
		<input type="button" value="+" class="plus" />
	</div>
	<?php
}

//Sale Tags
add_filter('woocommerce_sale_flash', 'lw_hide_sale_flash');
function lw_hide_sale_flash()
{
	return false;
}

add_action('woocommerce_after_shop_loop_item_title', 'themerange_template_loop_product_label', 1);
add_action('woocommerce_product_thumbnails', 'themerange_template_loop_product_label', 99);
function themerange_template_loop_product_label(){
	global $product;
	$theme_options = themerange_get_theme_options();
	?>
	<div class="product-label">
	<?php 
	if( $product->is_in_stock() ){
		//New label
		if( $theme_options['tr_product_show_new_label'] ){
			$now = current_time( 'timestamp', true );
			$post_date = get_post_time('U', true);
			$num_day = (int)( ( $now - $post_date ) / ( 3600*24 ) );
			$num_day_setting = absint( $theme_options['tr_product_show_new_label_time'] );
			if( $num_day <= $num_day_setting ){
				echo '<span class="new"><span>'.esc_html($theme_options['tr_product_new_label_text']).'</span></span>';
			}
		}
		
		//Sale label
		if( $product->is_on_sale() ){
			if( $theme_options['tr_show_sale_label_as'] != 'text' ){
				if( $product->get_type() == 'variable' ){
					$regular_price = $product->get_variation_regular_price('max');
					$sale_price = $product->get_variation_sale_price('min');
				}
				else{
					$regular_price = $product->get_regular_price();
					$sale_price = $product->get_price();
				}
				if( $regular_price ){
					if( $theme_options['tr_show_sale_label_as'] == 'number' ){
						$_off_price = round($regular_price - $sale_price, wc_get_price_decimals());
						$price_display = '-' . sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $_off_price);
						echo '<span class="onsale amount" data-original="'.$price_display.'"><span>'.$price_display.'</span></span>';
					}
					if( $theme_options['tr_show_sale_label_as'] == 'percent' ){
						echo '<span class="onsale percent"><span>-'.themerange_calc_discount_percent($regular_price, $sale_price).'%</span></span>';
					}
				}
			}
			else{
				echo '<span class="onsale"><span>'.esc_html($theme_options['tr_product_sale_label_text']).'</span></span>';
			}
		}
		
		//Hot label
		if( $product->is_featured() ){
			echo '<span class="featured"><span>'.esc_html($theme_options['tr_product_feature_label_text']).'</span></span>';
		}
	}
	else{ //Out of stock
		echo '<span class="out-of-stock"><span>'.esc_html($theme_options['tr_product_out_of_stock_label_text']).'</span></span>';
	}
	?>
	</div>
	<?php
}

function themerange_calc_discount_percent($regular_price, $sale_price){
	return ( 1 - round($sale_price / $regular_price, 2) ) * 100;
}

?>
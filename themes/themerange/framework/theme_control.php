<?php 
/*** Template Redirect ***/
add_action('template_redirect', 'themerange_template_redirect');
function themerange_template_redirect(){
	global $wp_query, $post;
	
	/* Get Page Options */
	if( is_page() || is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( is_page() ){
			$page_id = $post->ID;
		}
		$page_options = themerange_set_global_page_options( get_the_ID() );
		
		if( $page_options['tr_layout_fullwidth'] != 'default' ){
			themerange_change_theme_options('tr_layout_fullwidth', $page_options['tr_layout_fullwidth']);
			if( $page_options['tr_layout_fullwidth'] ){
				themerange_change_theme_options('tr_header_layout_fullwidth', $page_options['tr_header_layout_fullwidth']);
				themerange_change_theme_options('tr_main_content_layout_fullwidth', $page_options['tr_main_content_layout_fullwidth']);
			}
		}

		if( $page_options['tr_layout_style'] != 'default' ){
			themerange_change_theme_options('tr_layout_style', $page_options['tr_layout_style']);
		}
		
		if( $page_options['tr_header_layout'] != 'default' ){
			themerange_change_theme_options('tr_header_layout', $page_options['tr_header_layout']);
		}
		
		if( $page_options['tr_breadcrumb_layout'] != 'default' ){
			themerange_change_theme_options('tr_breadcrumb_layout', $page_options['tr_breadcrumb_layout']);
		}
		
		if( $page_options['tr_bg_parallax'] != 'default' ){
			themerange_change_theme_options('tr_bg_parallax', $page_options['tr_bg_parallax']);
		}
		
		if( trim($page_options['tr_logo']) != '' ){
			themerange_change_theme_options('tr_logo', $page_options['tr_logo']);
		}
		
		if( $page_options['header_block'] ){
			themerange_change_theme_options('header_block', $page_options['header_block']);
		}
		
		if( $page_options['footer_block'] ){
			themerange_change_theme_options('footer_block', $page_options['footer_block']);
		}
	}
	
	/* Single post */
	if( is_singular('post') ){
		/* Remove hooks on Related and Featured products */
		
		$post_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$post_data[$key] = $value[0];
			}
		}
		
		if( isset($post_data['tr_post_layout']) && $post_data['tr_post_layout'] != '0' ){
			themerange_change_theme_options('tr_blog_details_layout', $post_data['tr_post_layout']);
		}
		if( isset($post_data['tr_post_left_sidebar']) && $post_data['tr_post_left_sidebar'] != '0' ){
			themerange_change_theme_options('tr_blog_details_left_sidebar', $post_data['tr_post_left_sidebar']);
		}
		if( isset($post_data['tr_post_right_sidebar']) && $post_data['tr_post_right_sidebar'] != '0' ){
			themerange_change_theme_options('tr_blog_details_right_sidebar', $post_data['tr_post_right_sidebar']);
		}
		if( isset($post_data['tr_bg_breadcrumbs']) && $post_data['tr_bg_breadcrumbs'] != '' ){
			themerange_change_theme_options('tr_bg_breadcrumbs', $post_data['tr_bg_breadcrumbs']);
		}
	}
	
	/* Single Portfolio */
	if( is_singular('tr_portfolio') ){
		$portfolio_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$portfolio_data[$key] = $value[0];
			}
		}
		
		if( isset($portfolio_data['tr_portfolio_custom_field']) && $portfolio_data['tr_portfolio_custom_field'] == 1 ){
			if( isset($portfolio_data['tr_portfolio_custom_field_title']) ){
				themerange_change_theme_options('tr_portfolio_custom_field_title', $portfolio_data['tr_portfolio_custom_field_title']);
			}
			if( isset($portfolio_data['tr_portfolio_custom_field_content']) ){
				themerange_change_theme_options('tr_portfolio_custom_field_content', $portfolio_data['tr_portfolio_custom_field_content']);
			}
		}
		
		if( themerange_get_theme_options('tr_portfolio_thumbnail_style') == 'gallery' && wp_is_mobile() ){
			themerange_change_theme_options('tr_portfolio_thumbnail_style', 'slider');
		}
	}
	
	/* 404 template */
	if( is_404() ){
		$page_id = themerange_get_theme_options('tr_404_page');

		if( $page_id ){
			wp_redirect(get_permalink($page_id));
		}
	}
	
	/* Right to left */
	if( is_rtl() ){
		themerange_change_theme_options('tr_enable_rtl', 1);
	}
}

add_filter('single_template', 'themerange_change_single_portfolio_template');
function themerange_change_single_portfolio_template( $single_template ){
	
	if( is_singular('tr_portfolio') && locate_template('single-portfolio.php') ){
		$single_template = locate_template('single-portfolio.php');
	}
	
	return $single_template;
}
?>
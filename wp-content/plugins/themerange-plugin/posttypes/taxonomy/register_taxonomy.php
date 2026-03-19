<?php add_action( 'init', 'tr_register_taxonomy' );
function tr_register_taxonomy() {
	if (function_exists('themerange_get_theme_options')) {
		$themerange_theme_options = themerange_get_theme_options();
	} else {
		$themerange_theme_options = [];
	}
	
	//Services Taxonomy
	$services_cat_name = !empty($themerange_theme_options['tr_services_cat_name']) ? $themerange_theme_options['tr_services_cat_name'] : __('Services Category', 'themerange');
	$services_cat_slug = !empty($themerange_theme_options['tr_services_cat_slug']) ? $themerange_theme_options['tr_services_cat_slug'] : '';
	$args = array(
		'labels' => array(
			'name'                => __( $services_cat_name, 'themerange' ),
			'singular_name'       => __( $services_cat_name, 'themerange' ),
			'menu_name'           => __( $services_cat_name, 'themerange' ),
			'search_items'        => __( 'Search Categories', 'themerange' ),
			'all_items'           => __( 'All Categories', 'themerange' ),
			'parent_item'         => __( 'Parent Category', 'themerange' ),
			'parent_item_colon'   => __( 'Parent Category:', 'themerange' ),
			'edit_item'           => __( 'Edit Category', 'themerange' ),
			'update_item'         => __( 'Update Category', 'themerange' ),
			'add_new_item'        => __( 'Add New Category', 'themerange' ),
			'new_item_name'       => __( 'New Category Name', 'themerange' ),
		),
		'public' 				=> true,
		'hierarchical' 			=> true,
		'show_ui' 				=> true,
		'show_admin_column' 	=> true,
		'query_var' 			=> true,
		'show_in_nav_menus' 	=> false,
		'show_tagcloud' 		=> false,
		'rewrite'            	=> array( 'slug' => $services_cat_slug ),
	);
	
	register_taxonomy('services_cat', 'tr_services', $args);
	
	
	//Portfolio Taxonomy
	$portfolio_cat_name = !empty($themerange_theme_options['tr_portfolio_cat_name']) ? $themerange_theme_options['tr_portfolio_cat_name'] : __('Portfolio Category', 'themerange');
	$portfolio_cat_slug = !empty($themerange_theme_options['tr_portfolio_cat_slug']) ? $themerange_theme_options['tr_portfolio_cat_slug'] : '';
	$args = array(
		'labels' => array(
			'name'                => __( $portfolio_cat_name, 'themerange' ),
			'singular_name'       => __( $portfolio_cat_name, 'themerange' ),
			'menu_name'           => __( $portfolio_cat_name, 'themerange' ),
			'search_items'        => __( 'Search Categories', 'themerange' ),
			'all_items'           => __( 'All Categories', 'themerange' ),
			'parent_item'         => __( 'Parent Category', 'themerange' ),
			'parent_item_colon'   => __( 'Parent Category:', 'themerange' ),
			'edit_item'           => __( 'Edit Category', 'themerange' ),
			'update_item'         => __( 'Update Category', 'themerange' ),
			'add_new_item'        => __( 'Add New Category', 'themerange' ),
			'new_item_name'       => __( 'New Category Name', 'themerange' ),
		),
		'public' 				=> true,
		'hierarchical' 			=> true,
		'show_ui' 				=> true,
		'show_admin_column' 	=> true,
		'query_var' 			=> true,
		'show_in_nav_menus' 	=> false,
		'show_tagcloud' 		=> false,
		'rewrite'            	=> array( 'slug' => $portfolio_cat_slug ),
	);
	
	register_taxonomy('portfolio_cat', 'tr_portfolio', $args);
	
	
	//Classes Taxonomy
	$classes_cat_name = !empty($themerange_theme_options['tr_classes_cat_name']) ? $themerange_theme_options['tr_classes_cat_name'] : __('Classes Category', 'themerange');
	$classes_cat_slug = !empty($themerange_theme_options['tr_classes_cat_slug']) ? $themerange_theme_options['tr_classes_cat_slug'] : '';
	$args = array(
		'labels' => array(
			'name'                => __( $classes_cat_name, 'themerange' ),
			'singular_name'       => __( $classes_cat_name, 'themerange' ),
			'menu_name'           => __( $classes_cat_name, 'themerange' ),
			'search_items'        => __( 'Search Categories', 'themerange' ),
			'all_items'           => __( 'All Categories', 'themerange' ),
			'parent_item'         => __( 'Parent Category', 'themerange' ),
			'parent_item_colon'   => __( 'Parent Category:', 'themerange' ),
			'edit_item'           => __( 'Edit Category', 'themerange' ),
			'update_item'         => __( 'Update Category', 'themerange' ),
			'add_new_item'        => __( 'Add New Category', 'themerange' ),
			'new_item_name'       => __( 'New Category Name', 'themerange' ),
		),
		'public' 				=> true,
		'hierarchical' 			=> true,
		'show_ui' 				=> true,
		'show_admin_column' 	=> true,
		'query_var' 			=> true,
		'show_in_nav_menus' 	=> false,
		'show_tagcloud' 		=> false,
		'rewrite'            	=> array( 'slug' => $classes_cat_slug ),
	);
	
	register_taxonomy('classes_cat', 'tr_classes', $args);
}

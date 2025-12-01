<?php /*** TR Header Builder ***/
if( !class_exists('TR_Header_Builder') ){
	class TR_Header_Builder{
		public $post_type;
		
		function __construct(){
			$this->post_type = 'header_block';
			add_action('init', array($this, 'register_post_type'));
		}
		
		function register_post_type(){
			if (function_exists('themerange_get_theme_options')) {
				$themerange_theme_options = themerange_get_theme_options();
			} else {
				$themerange_theme_options = [];
			}
			
			$header_builder_name = !empty($themerange_theme_options['tr_header_block_name']) ? $themerange_theme_options['tr_header_block_name'] : __('Header Builder', 'themerange');
			
			$labels = array(
				'name' 				=> esc_html_x( $header_builder_name, 'post type general name', 'themerange' ),
				'singular_name' 	=> esc_html_x(  $header_builder_name, 'post type singular name', 'themerange' ),
				'add_new' 			=> esc_html_x( 'Add New', 'mega_menu', 'themerange' ),
				'add_new_item' 		=> __( 'Add New', 'themerange' ),
				'edit_item' 		=> __( "Edit $header_builder_name", 'themerange' ),
				'new_item' 			=> __( "New $header_builder_name", 'themerange' ),
				'all_items' 		=> __( "All $header_builder_name", 'themerange' ),
				'view_item' 		=> __( "View $header_builder_name", 'themerange' ),
				'search_items' 		=> __( "Search $header_builder_name", 'themerange' ),
				'not_found' 		=> __( "No $header_builder_name Found", 'themerange' ),
				'not_found_in_trash'=> __( "No $header_builder_name Found In Trash", 'themerange' ),
				'parent_item_colon' => '',
				'menu_name' 		=> __( $header_builder_name, 'themerange' ),
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> true,
				'exclude_from_search' => true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array( 'slug' => $this->post_type ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> false,
				'hierarchical' 		=> false,
				'supports' 			=> array( 'title', 'editor', 'revisions' ),
				'menu_position' 	=> 32,
				'menu_icon' 		=> 'dashicons-welcome-widgets-menus',
			);
			register_post_type( $this->post_type, $args );
		}
	}
}
new TR_Header_Builder();

/*** TR Footer Builder ***/
if( !class_exists('TR_Footer_Builder') ){
	class TR_Footer_Builder{
		public $post_type;
		
		function __construct(){
			$this->post_type = 'footer_block';
			add_action('init', array($this, 'register_post_type'));
		}
		
		function register_post_type(){
			if (function_exists('themerange_get_theme_options')) {
				$themerange_theme_options = themerange_get_theme_options();
			} else {
				$themerange_theme_options = [];
			}
			
			$footer_builder_name = !empty($themerange_theme_options['tr_footer_block_name']) ? $themerange_theme_options['tr_footer_block_name'] : __('Footer Builder', 'themerange');
			
			$labels = array(
				'name' 				=> esc_html_x( $footer_builder_name, 'post type general name', 'themerange' ),
				'singular_name' 	=> esc_html_x(  $footer_builder_name, 'post type singular name', 'themerange' ),
				'add_new' 			=> esc_html_x( 'Add New', 'mega_menu', 'themerange' ),
				'add_new_item' 		=> __( 'Add New', 'themerange' ),
				'edit_item' 		=> __( "Edit $footer_builder_name", 'themerange' ),
				'new_item' 			=> __( "New $footer_builder_name", 'themerange' ),
				'all_items' 		=> __( "All $footer_builder_name", 'themerange' ),
				'view_item' 		=> __( "View $footer_builder_name", 'themerange' ),
				'search_items' 		=> __( "Search $footer_builder_name", 'themerange' ),
				'not_found' 		=> __( "No $footer_builder_name Found", 'themerange' ),
				'not_found_in_trash'=> __( "No $footer_builder_name Found In Trash", 'themerange' ),
				'parent_item_colon' => '',
				'menu_name' 		=> __( $footer_builder_name, 'themerange' ),
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array( 'slug' => $this->post_type ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> 'footer_block',
				'hierarchical' 		=> false,
				'supports' 			=> array( 'title', 'editor', 'revisions' ),
				'menu_position' 	=> 32,
				'menu_icon' 		=> 'dashicons-welcome-widgets-menus',
			);
			register_post_type( $this->post_type, $args );
		}
	}
}
new TR_Footer_Builder();

/*** TR Mega Menu ***/
if( !class_exists('TR_Mega_Menus') ){
	class TR_Mega_Menus{
		public $post_type = 'mega_menu';
		
		function __construct(){
			add_action( 'init', array($this, 'register_post_type') );
		}
		
		function register_post_type(){
			if (function_exists('themerange_get_theme_options')) {
				$themerange_theme_options = themerange_get_theme_options();
			} else {
				$themerange_theme_options = [];
			}
			
			$megamenu_name = !empty($themerange_theme_options['tr_mega_menu_name']) ? $themerange_theme_options['tr_mega_menu_name'] : __('Mega Menu', 'themerange');
			
			$labels = array(
				'name' 				=> esc_html_x( $megamenu_name, 'post type general name', 'themerange' ),
				'singular_name' 	=> esc_html_x(  $megamenu_name, 'post type singular name', 'themerange' ),
				'add_new' 			=> esc_html_x( 'Add New', 'mega_menu', 'themerange' ),
				'add_new_item' 		=> __( 'Add New', 'themerange' ),
				'edit_item' 		=> __( "Edit $megamenu_name", 'themerange' ),
				'new_item' 			=> __( "New $megamenu_name", 'themerange' ),
				'all_items' 		=> __( "All $megamenu_name", 'themerange' ),
				'view_item' 		=> __( "View $megamenu_name", 'themerange' ),
				'search_items' 		=> __( "Search $megamenu_name", 'themerange' ),
				'not_found' 		=> __( "No $megamenu_name Found", 'themerange' ),
				'not_found_in_trash'=> __( "No $megamenu_name Found In Trash", 'themerange' ),
				'parent_item_colon' => '',
				'menu_name' 		=> __( $megamenu_name, 'themerange' ),
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> true,
				'exclude_from_search' => true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array( 'slug' => $this->post_type ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> false,
				'hierarchical' 		=> false,
				'supports' 			=> array( 'title', 'editor', 'revisions' ),
				'menu_position' 	=> 32,
				'menu_icon' 		=> 'dashicons-align-center',
			);
			register_post_type( $this->post_type, $args );
		}
	}
}
new TR_Mega_Menus();
?>
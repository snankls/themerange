<?php 
/**
 * Plugin Name: ThemeRange Plugin
 * Plugin URI: http://themerange.net/
 * Description: Add shortcodes and custom post types for the ThemeRange Theme
 * Version: 1.1
 * Author: ThemeRange Team
 * Author URI: http://themerange.net/
 */

if( !defined('THEMERANGE_VERSION') ){
	define('THEMERANGE_VERSION', '1.1');
}

if( !defined('THEMERANGE_DIR') ){
	define('THEMERANGE_DIR', plugin_dir_path( __FILE__ ));
}

if( !defined('THEMERANGE_URL') ){
	define('THEMERANGE_URL', plugin_dir_url( __FILE__ ));
}

class ThemeRange_Plugin {

	function __construct() {
		$this->load_language_file();
		$this->include_files();
		$this->register_posttype();
		$this->register_widgets();
		
		/* Allow HTML in Category Descriptions */
		remove_filter('pre_term_description', 'wp_filter_kses');
		remove_filter('pre_link_description', 'wp_filter_kses');
		remove_filter('pre_link_notes', 'wp_filter_kses');
		remove_filter('term_description', 'wp_kses_data');
		
		/* Don't support custom header */
		add_action('after_setup_theme', array($this, 'remove_theme_support_custom_header'), 99 );
		
		/* Template redirect */
		add_action('template_redirect', array($this, 'template_redirect'));
		
		// Shortcode
		add_filter('the_content', array($this, 'remove_extra_p_tag'));
		add_filter('widget_text', array($this, 'remove_extra_p_tag'));
		add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
		add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));
		add_action('admin_init', array($this, 'themerange_add_mime_types_conditionally'));
	}
	
	function load_language_file() {
		load_plugin_textdomain('themerange', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	function include_files() {
		require_once('includes/functions.php');
		require_once('class-elementor.php');
		require_once('class-shortcodes.php');
		require_once('includes/instagram.php');
		require_once('metaboxes/metaboxes.php');
		require_once('importer/importer.php');
		//require_once('ads-banner.php');
		
		if ( ! class_exists( 'Redux' ) ) {
			require_once ('thirdparty/redux-framework/redux-framework.php');
		}
		if ( ! class_exists( 'WP_Importer' ) ) {
			require_once ('thirdparty/ocdi/one-click-demo-import.php');
		}
	}
	
	// Posttype
	function register_posttype() {
		$file_names = array('services', 'portfolio', 'classes', 'hf_builder');
		foreach( $file_names as $file_name ){
			$file = plugin_dir_path( __FILE__ ) . '/posttypes/' . $file_name . '.php';
			if( file_exists($file) ){
				require_once($file);
			}
		}
		require_once('posttypes/taxonomy/register_taxonomy.php');
	}
	
	// Widgets
	function register_widgets() {
		$file_names = array('news');
		foreach( $file_names as $file_name ){
			$file = plugin_dir_path( __FILE__ ) . '/widgets/' . $file_name . '.php';
			if( file_exists($file) ){
				require_once($file);
			}
		}
	}
	
	function remove_theme_support_custom_header() {
		remove_theme_support( 'custom-header' );
	}
	
	function template_redirect() {
		if( is_singular('product') ){
			add_filter('wp_get_attachment_image_attributes', array($this, 'unset_srcset_on_cloudzoom'), 9999);
			add_filter('wp_calculate_image_sizes', '__return_false', 9999);
			add_filter('wp_calculate_image_srcset', '__return_false', 9999);
			remove_filter('the_content', 'wp_make_content_images_responsive');
		}
	}
	
	function unset_srcset_on_cloudzoom( $attr ) {
		if( isset($attr['sizes']) ){
			unset($attr['sizes']);
		}
		if( isset($attr['srcset']) ){
			unset($attr['srcset']);
		}
		return $attr;
	}
	
	function remove_extra_p_tag( $content ) {
	
		$block = join("|", array('tr_button'));
		/* opening tag */
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			
		/* closing tag */
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	 
		return $rep;
	}
	
	function register_scripts() {
		$css_dir = THEMERANGE_URL . '/assets/css/';
		$js_dir = THEMERANGE_URL . '/assets/js/';
		
		wp_deregister_style( 'swiper' );
		wp_dequeue_style( 'swiper' );
		wp_enqueue_style( 'swiper', $css_dir . 'swiper-bundle.css', array(), THEMERANGE_VERSION );
		
		wp_deregister_script( 'swiper' );
		wp_dequeue_script( 'swiper' );
		wp_enqueue_script( 'swiper-js', $js_dir . 'swiper-bundle.js', array(), THEMERANGE_VERSION );
	}
	
	function register_admin_scripts() {
		global $post_type;
		$css_dir = THEMERANGE_URL.'assets/css';
		
		wp_enqueue_style( 'tr-admin-style', $css_dir . '/admin.css', array(), THEMERANGE_VERSION );
	}
	
	// Ensure this runs only in the admin area
	function themerange_add_mime_types_conditionally() {
		// Check if we're in the admin area and on the specific theme options page
		if ( is_admin() && isset($_GET['page']) && $_GET['page'] == 'themeoptions' ) {
			// Add the filter to allow additional MIME types
			add_filter('upload_mimes', array($this, 'themerange_allow_upload_font_files'));
		}
	}
	
	// Function to allow additional MIME types
	function themerange_allow_upload_font_files( $existing_mimes = array() ) {
		// Add custom MIME types
		$existing_mimes['svg'] = 'image/svg+xml';
		$existing_mimes['eot'] = 'application/vnd.ms-fontobject';
		$existing_mimes['ttf'] = 'font/ttf';
		$existing_mimes['woff'] = 'font/woff';
		$existing_mimes['woff2'] = 'font/woff2';
		
		return $existing_mimes;
	}
	
}

new ThemeRange_Plugin();
?>

<?php  
if( !defined('ABSPATH') ){
    exit; // Exit if accessed directly.
}

class TR_Elementor_Addons {
	
	function __construct() {
		require_once 'elementor/ajax-functions.php';
		
		add_action('elementor/elements/categories_registered', array($this, 'add_category'));
		add_action('elementor/elements/categories_registered', array($this, 'reorder_categories'), 99);
		add_action('elementor/widgets/widgets_registered', array($this, 'include_widgets'));
		add_action('elementor/editor/before_enqueue_styles', array($this, 'editor_before_enqueue_styles'));
		add_action('elementor/editor/after_register_scripts', array($this, 'editor_after_register_scripts'));
		add_action('elementor/controls/controls_registered', array($this, 'register_controls'));
	}
	
	function editor_before_enqueue_styles() {
		$css_dir = plugin_dir_url(__FILE__) . 'assets/css';
		
		wp_enqueue_style('tr-admin-style', $css_dir . '/admin.css', array(), THEMERANGE_VERSION);
	}
	
	function register_controls() {
		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
	}
	
	function add_category() {
		Elementor\Plugin::instance()->elements_manager->add_category(
			'tr-elements',
			array(
				'title' => esc_html__('TR Elements', 'themerange'),
				'icon' => 'tr-custom-icon'
			)
		);
	}
	
	// Function to reorder categories
	function reorder_categories($elements_manager) {
		// Get the registered categories
		$categories = $elements_manager->get_categories();
		
		// Move the custom category to the beginning
		if (isset($categories['tr-elements'])) {
			$tr_elements = $categories['tr-elements'];
			unset($categories['tr-elements']);
			$categories = array('tr-elements' => $tr_elements) + $categories;
		}
	
		// Clear the existing categories and set the new order
		$reflection = new ReflectionClass($elements_manager);
		$property = $reflection->getProperty('categories');
		$property->setAccessible(true);
		$property->setValue($elements_manager, $categories);
	}
	
	function include_widgets($widgets_manager) {
		require_once 'elementor/base.php';
		
		// Shortcodes
		$shortcodes = array(
			'slider',
			'about_us',
			'features',
			'marquee',
			'services',
			'portfolio',
			'technology',
			'team',
			'partners',
			
			'button',
			'form',
			'heading',
			'icon',
			'icon_box',
			'image',
			'listing',
			'text',

			/*'services',
			'facts_counter',
			'gallery',
			'skills',
			'testimonials',
			'news',
			'price_table',
			'timetable_schedule',
			'faqs',
			'classes',
			'bmi_calculator',
			'bmi_table',
			'contact_info',*/
		);
		
		$shortcodes = apply_filters('tr_shortcodes_array', $shortcodes);
		foreach ($shortcodes as $element) {
			$path = plugin_dir_path(__FILE__) . '/elementor/shortcode/' . $element . '.php';
			if (file_exists($path)) {
				require_once $path;
			}
		}
		
	}
}

// Instantiate the class
new TR_Elementor_Addons();

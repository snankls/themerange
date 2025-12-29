<?php 
/*** Redux Framework ***/
require_once get_template_directory().'/admin/init.php';

/*** Theme Framework ***/
require_once get_template_directory().'/framework/init.php';

/*** Activate Theme ***/
add_action('admin_init', 'themerange_theme_activation');
function themerange_theme_activation(){
	global $pagenow;
	if( is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']) )
	{
		$elementor_cpt_support = get_option( 'elementor_cpt_support', array( 'page', 'post' ) );
		
		if( !in_array( 'tr_services', $elementor_cpt_support ) ){
			$elementor_cpt_support[] = 'tr_services';
		}
		if( !in_array( 'tr_portfolio', $elementor_cpt_support ) ){
			$elementor_cpt_support[] = 'tr_portfolio';
		}
		if( !in_array( 'tr_team', $elementor_cpt_support ) ){
			$elementor_cpt_support[] = 'tr_team';
		}
		if( !in_array( 'tr_classes', $elementor_cpt_support ) ){
			$elementor_cpt_support[] = 'tr_classes';
		}
		if( !in_array( 'header_block', $elementor_cpt_support ) ){
			$elementor_cpt_support[] = 'header_block';
		}
		if( !in_array( 'footer_block', $elementor_cpt_support ) ){
			$elementor_cpt_support[] = 'footer_block';
		}
		if( !in_array( 'mega_menu', $elementor_cpt_support ) ){
			$elementor_cpt_support[] = 'mega_menu';
		}
		update_option( 'elementor_cpt_support', $elementor_cpt_support );
	}
}

/*** Theme Setup ***/
function themerange_theme_setup(){
    /* Add editor-style.css file*/
    add_editor_style();

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'html5', array( 
        'comment-list', 
        'comment-form', 
        'search-form', 
        'gallery', 
        'caption',
        'style',
        'script'
    ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'custom-background', array(
        'default-color' => '',
        'default-image' => ''
    ) );
    remove_theme_support( 'widgets-block-editor' );

    global $content_width;
    if ( ! isset( $content_width ) ){ $content_width = 1200; }

    // Delay translation loading until init
    add_action('init', function() {
        load_theme_textdomain( 'themerange', get_template_directory() . '/languages' );
    });

    /* Register Menu Location */
    register_nav_menus(array(
        'primary'      => esc_html__( 'Primary Menu', 'themerange' ),
        'mobile_menu'  => esc_html__( 'Mobile Menu', 'themerange' ),
        'onepage_menu' => esc_html__( 'One Page Menu', 'themerange' ),
    ));
}
add_action( 'after_setup_theme', 'themerange_theme_setup');

/*** Add Image Size ***/
function themerange_add_image_size(){
	add_image_size('services_490x700', 490, 700, true); //Services V1
	add_image_size('team_370x500', 370, 500, true); //Team V1, V3
	add_image_size('news_670x770', 670, 770, true); //News V1 Big
	add_image_size('news_470x370', 470, 370, true); //News V1 Small
	add_image_size('news_570x370', 570, 370, true); //News V2
	add_image_size('news_370x425', 370, 425, true); //News V3
	add_image_size('services_480x700', 480, 700, true); //Services V2
	add_image_size('team_480x700', 480, 700, true); //Team V2
	add_image_size('portfolio_570x480', 570, 480, true); //Portfolio V1
	add_image_size('portfolio_570x650', 570, 650, true); //Portfolio V1
}
add_action('init', 'themerange_add_image_size');

/*** Get Theme Version ***/
function themerange_get_theme_version(){
	$theme = wp_get_theme();
	if( $theme->parent() ){
		return $theme->parent()->get('Version');
	}
	else{
		return $theme->get('Version');
	}
}

/*** Register Front End Scripts  ***/
function themerange_register_scripts(){
	$theme_version = themerange_get_theme_version();
	$theme_options = themerange_get_theme_options();
	
	//Stylesheet
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), $theme_version );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.css', array(), $theme_version );
	wp_enqueue_style( 'magnific', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), $theme_version );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome-pro.css', array(), $theme_version );
	wp_enqueue_style( 'spacing', get_template_directory_uri() . '/assets/css/spacing.css', array(), $theme_version );
	wp_enqueue_style( 'themerange-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'themerange-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version );
	wp_enqueue_style( 'themerange-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), $theme_version );
	//wp_enqueue_style( 'themerange-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), $theme_version );
	
	//Scripts
	wp_enqueue_script( 'jquery-ui-core');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap-bundle.js', array(), $theme_version, true );
	wp_enqueue_script( 'bootstrap-dropdown', get_template_directory_uri() . '/assets/js/plugin.js', array(), $theme_version, true );
	wp_enqueue_script( 'parallax', get_template_directory_uri() . '/assets/js/three.js', array(), $theme_version, true );
	wp_enqueue_script( 'parallax-scroll', get_template_directory_uri() . '/assets/js/hover-effect.umd.js', array(), $theme_version, true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/split-type.js', array(), $theme_version, true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/swiper-bundle.js', array(), $theme_version, true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/swiper-gl.js', array(), $theme_version, true );
	wp_enqueue_script( 'appear', get_template_directory_uri() . '/assets/js/effect-slicer.js', array(), $theme_version, true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array(), $theme_version, true );
	wp_enqueue_script( 'odometers', get_template_directory_uri() . '/assets/js/nice-select.js', array(), $theme_version, true );
	wp_enqueue_script( 'circularProgressBar', get_template_directory_uri() . '/assets/js/purecounter.js', array(), $theme_version, true );
	wp_enqueue_script( 'circularProgressBar', get_template_directory_uri() . '/assets/js/isotope-pkgd.js', array(), $theme_version, true );
	wp_enqueue_script( 'circularProgressBar', get_template_directory_uri() . '/assets/js/imagesloaded-pkgd.js', array(), $theme_version, true );
	wp_enqueue_script( 'circularProgressBar', get_template_directory_uri() . '/assets/js/backtop.js', array(), $theme_version, true );
	wp_enqueue_script( 'circularProgressBar', get_template_directory_uri() . '/assets/js/ajax-form.js', array(), $theme_version, true );
	wp_enqueue_script( 'circularProgressBar', get_template_directory_uri() . '/assets/js/slider-init.js', array(), $theme_version, true );
	wp_enqueue_script( 'circularProgressBar', get_template_directory_uri() . '/assets/js/tp-cursor.js', array(), $theme_version, true );
	wp_enqueue_script( 'themerange-script', get_template_directory_uri() . ' /assets/js/script.js', array('jquery'), $theme_version, true );
	
	//Preloader
	if( themerange_enable_loading_screen() ){
		wp_enqueue_script( 'themerange-loading-screen', get_template_directory_uri() . '/admin/assets/js/loading-screen.js', array('jquery'), $theme_version, false );
		wp_localize_script( 'themerange-loading-screen', 'tr_loading_screen_opt', array('loading_image' => themerange_get_loading_screen_image()) );
	}
	
	//Comments
	if( is_singular() && comments_open() && get_option( 'thread_comments' ) ){ 	
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Load default google fonts */
	wp_enqueue_style( 'themerange-google-fonts-Russo-One', '//fonts.googleapis.com/css?family=Russo+One&display=swap' );
	wp_enqueue_style( 'themerange-google-fonts-Manrope', '//fonts.googleapis.com/css?family=Manrope:wght@300,400,500,600,700,800&display=swap' );
	
	/* Custom JS */
	if( $custom_js = themerange_get_theme_options('tr_custom_javascript_code') ){
		wp_add_inline_script( 'themerange-script', trim( $custom_js ) );
	}
}
add_action('wp_enqueue_scripts', 'themerange_register_scripts', 1000);

/* Loading Screen */
function themerange_enable_loading_screen(){
	global $post;
	$theme_options = themerange_get_theme_options();
	if( empty($theme_options['tr_loading_screen']) ){
		return false;
	}
	
	$enabled = false;
	
	$loading_screen_in = $theme_options['tr_display_loading_screen_in'];
	switch( $loading_screen_in ){
		case 'all-pages':
			if( is_page() ){
				$exclude_pages = !empty($theme_options['tr_loading_screen_exclude_pages'])?$theme_options['tr_loading_screen_exclude_pages']:array();
				if( isset($post->ID) && !in_array($post->ID, $exclude_pages) ){
					$enabled = true;
				}
			}
			else{
				$enabled = true;
			}
		break;
		case 'homepage-only':
			if( is_home() || is_front_page() ){
				$enabled = true;
			}
		break;
		case 'specific-pages':
			if( is_page() ){
				$specific_pages = !empty($theme_options['tr_loading_screen_specific_pages'])?$theme_options['tr_loading_screen_specific_pages']:array();
				if( isset($post->ID) && in_array($post->ID, $specific_pages) ){
					$enabled = true;
				}
			}
		break;
	}

	return apply_filters('themerange_enable_loading_screen', $enabled);
}

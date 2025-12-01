<?php
add_action('init', 'themerange_get_default_theme_options');
function themerange_get_default_theme_options(){
	global $themerange_theme_options;
	if( empty( $themerange_theme_options ) ){
		include get_template_directory() . '/admin/options.php';
		foreach( $option_fields as $fields ){
			foreach( $fields as $field ){
				if( in_array($field['type'], array('section', 'info')) ){
					continue;
				}
				if( isset($field['default']) ){
					$themerange_theme_options[ $field['id'] ] = $field['default'];
				}
			}
		}
	}
}

function themerange_change_theme_options( $key, $value ){
	global $themerange_theme_options;
	if( isset( $themerange_theme_options[$key] ) ){
		$themerange_theme_options[$key] = $value;
	}
}

add_filter('redux/validate/themerange_theme_options/defaults', 'themerange_set_default_color_options_on_reset');
add_filter('redux/validate/themerange_theme_options/defaults_section', 'themerange_set_default_color_options_on_reset');
function themerange_set_default_color_options_on_reset( $options_defaults ){
	if( isset($options_defaults['tr_color_scheme']) ){
		$preset_colors = array();
		include get_template_directory() . '/admin/preset-colors/' . $options_defaults['tr_color_scheme'] . '.php';
		foreach( $preset_colors as $key => $value ){
			if( isset($options_defaults[$key]) ){
				$options_defaults[$key] = $value;
			}
		}
	}
	return $options_defaults;
}

add_filter('redux/themerange_theme_options/localize', 'themerange_remove_redux_ads', 99);
function themerange_remove_redux_ads( $localize_data ){
	if( isset($localize_data['rAds']) ){
		$localize_data['rAds'] = '';
	}
	return $localize_data;
}

function themerange_get_header_block_options(){
	$header_blocks = array('0' => esc_html__('Select Header', 'themerange'));
	$args = array(
		'post_type'			=> 'header_block',
		'post_status'	 	=> 'publish',
		'posts_per_page' 	=> -1,
		'order_by'			=> 'ID',
		'order'				=> 'ASC',
	);

	$posts = new WP_Query($args);

	if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
		foreach( $posts->posts as $p ){
			$header_blocks[$p->ID] = $p->post_title;
		}
	}

	wp_reset_postdata();
	
	return $header_blocks;
}

function themerange_get_footer_block_options(){
	$footer_blocks = array('0' => esc_html__('Select Footer', 'themerange'));
	$args = array(
		'post_type'			=> 'footer_block',
		'post_status'	 	=> 'publish',
		'posts_per_page'	=> -1,
		'order_by'			=> 'ID',
		'order'				=> 'ASC',
	);

	$posts = new WP_Query($args);

	if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
		foreach( $posts->posts as $p ){
			$footer_blocks[$p->ID] = $p->post_title;
		}
	}

	wp_reset_postdata();
	
	return $footer_blocks;
}

//Phone Number
function tr_phone_number($phone)
{
    $phone = preg_replace('/[^\dxX]/', '', $phone);
    return $phone;
}

//Social Icons Get
function tr_social_icons($social_icons = '') {
	$theme_options = themerange_get_theme_options();
	$icon_name = isset($theme_options['tr_icon_name']) ? $theme_options['tr_icon_name'] : '';
	$icon_link = isset($theme_options['tr_icon_link']) ? $theme_options['tr_icon_link'] : '';
	
	if(is_array($icon_name) || is_object($icon_name)) {
		$social_icons = [];
		foreach($icon_name as $key => $value) {
			$opt = [];
			$opt[] = $value;
			$opt[] = $icon_link[$key];
			
			$social_icons[] = $opt;
		}
	}
	return $social_icons;
}

//Category Widget
//Add Span and count move into anchor
function themerange_category_list( $list ) {
    //remove ul tags
    $list = str_replace( '<ul>', '', $list );
    $list = str_replace( '</ul>', '', $list );
	
    //move count inside a tags
    $list = str_replace( '</a> (', '<span>[ ', $list );
    $list = str_replace( ')', ' ]</span></a>', $list );
    return $list;
}
add_filter( 'wp_list_categories', 'themerange_category_list' );

//Remove Bracket
function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '', $variable);
   $variable = str_replace(')', '', $variable);
   return $variable;
}
add_filter('wp_list_categories', 'categories_postcount_filter');

//Archives Widget
function themerange_archives_list( $list ) {
    //remove ul tags
    $list = str_replace( '<ul>', '', $list );
    $list = str_replace( '</ul>', '', $list );
	
    //move count inside a tags
    $list = str_replace( '</a>&nbsp;(', '<span>[ ', $list );
    $list = str_replace( ')', ' ]</span></a>', $list );
    return $list;
}
add_filter('get_archives_link', 'themerange_archives_list');

//Remove Bracket
function archives_postcount_filter ($variable) {
   $variable = str_replace('(', '', $variable);
   $variable = str_replace(')', '', $variable);
   return $variable;
}
add_filter('get_archives_link', 'archives_postcount_filter');


//register_block_style
function themerange_register_block_styles() {
    // Register a new block style for the paragraph block
    register_block_style(
        'core/paragraph',
        array(
            'name'  => 'fancy-paragraph',
            'label' => __('Fancy Paragraph', 'themerange'),
        )
    );

    // Register another block style for the image block
    register_block_style(
        'core/image',
        array(
            'name'  => 'rounded-image',
            'label' => __('Rounded Image', 'themerange'),
        )
    );
}
add_action('init', 'themerange_register_block_styles');

//register_block_pattern
function themerange_register_block_patterns() {
    // Check if the function exists to avoid errors in older versions of WordPress
    if ( function_exists( 'register_block_pattern' ) ) {
        // Register a custom block pattern
        register_block_pattern(
            'themerange/fancy-heading-paragraph',
            array(
                'title'       => __( 'Fancy Heading and Paragraph', 'themerange' ),
                'description' => _x( 'A heading followed by a fancy paragraph.', 'Block pattern description', 'themerange' ),
                'content'     => "<!-- wp:heading --><h2>" . __( 'This is a fancy heading', 'themerange' ) . "</h2><!-- /wp:heading -->\n<!-- wp:paragraph {\"className\":\"is-style-fancy-paragraph\"} --><p class=\"is-style-fancy-paragraph\">" . __( 'This is a fancy paragraph with a custom style.', 'themerange' ) . "</p><!-- /wp:paragraph -->",
                'categories'  => array( 'text' ),
            )
        );

        // Register another block pattern
        register_block_pattern(
            'themerange/image-gallery',
            array(
                'title'       => __( 'Image Gallery', 'themerange' ),
                'description' => _x( 'A gallery of images in a grid layout.', 'Block pattern description', 'themerange' ),
                'content'     => "<!-- wp:gallery {\"ids\":[1,2,3,4]} /-->",
                'categories'  => array( 'gallery' ),
            )
        );
    }
}
add_action( 'init', 'themerange_register_block_patterns' );
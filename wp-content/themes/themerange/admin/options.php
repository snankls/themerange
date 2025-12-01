<?php
$redux_url = '';
if( class_exists('ReduxFramework') ){
	$redux_url = ReduxFramework::$_url;
}

if( !defined('WP_PERMALINK') ){
	define( 'WP_PERMALINK', admin_url().'options-permalink.php' );
}

//Social Icons
$social_icons = array(
	'fa-adn'					=> 'adn',
	'fa-android'				=> 'Android',
	'fa-apple'					=> 'Apple',
	'fa-behance'				=> 'Behance',
	'fa-behance-square'			=> 'Behance Square',
	'fa-bitbucket'				=> 'Bitbucket',
	'fa-btc'					=> 'Bitcoin',
	'fa-css3'					=> 'CSS3',
	'fa-delicious'				=> 'Delicious',
	'fa-deviantart'				=> 'Deviantart',
	'fa-dribbble'				=> 'Dribbble',
	'fa-dropbox'				=> 'Dropbox',
	'fa-drupal'					=> 'Drupal',
	'fa-empire'					=> 'Empire',
	'fa-facebook-f'				=> 'Facebook',
	'fa-facebook'				=> 'Facebook Square',
	'fa-foursquare'				=> 'Four Square',
	'fa-git-square'				=> 'Git Square',
	'fa-github'					=> 'Github',
	'fa-github-alt'				=> 'Github Alt',
	'fa-github-square'			=> 'Github Square',
	'fa-gittip'					=> 'Git Tip',
	'fa-google'					=> 'Google',
	'fa-google-plus-square'		=> 'Google Plus Square',
	'fa-hacker-news'			=> 'Hacker News',
	'fa-html5'					=> 'HTML5',
	'fa-instagram'				=> 'Instagram',
	'fa-joomla'					=> 'Joomla',
	'fa-jsfiddle'				=> 'Js Fiddle',
	'fa-linkedin'				=> 'LinkedIn',
	'fa-linkedin-square'		=> 'LinkedIn Square',
	'fa-linux'					=> 'Linux',
	'fa-maxcdn'					=> 'MaxCDN',
	'fa-openid'					=> 'OpenID',
	'fa-pagelines'				=> 'Page Lines',
	'fa-pied-piper'				=> 'Pied Piper',
	'fa-pinterest'				=> 'Pinterest',
	'fa-pinterest-square'		=> 'Pinterest Square',
	'fa-qq'						=> 'QQ',
	'fa-rebel'					=> 'Rebel',
	'fa-reddit'					=> 'Reddit',
	'fa-reddit-square'			=> 'Reddit Square',
	'fa-renren'					=> 'Ren Ren' ,
	'fa-share-alt'				=> 'Share Alt',
	'fa-share-alt-square'		=> 'Share Square',
	'fa-skype'					=> 'Skype',
	'fa-slack'					=> 'Slack',
	'fa-soundcloud'				=> 'Sound Cloud',
	'fa-spotify'				=> 'Spotify',
	'fa-stack-exchange'			=> 'Stack Exchange',
	'fa-stack-overflow'			=> 'Stack Overflow',
	'fa-steam'					=> 'Steam',
	'fa-steam-square'			=> 'Steam Square',
	'fa-stumbleupon'			=> 'Stumble Upon',
	'fa-stumbleupon-circle'		=> 'Stumble Upon Circle',
	'fa-tencent-weibo'			=> 'Tencent Weibo',
	'fa-tiktok'					=> 'Tiktok',
	'fa-trello'					=> 'Trello',
	'fa-tumblr'					=> 'Tumblr',
	'fa-tumblr-square'			=> 'Tumblr Square',
	'fa-twitter'				=> 'Twitter',
	'fa-twitter'				=> 'TwitterX',
	'fa-twitter-square'			=> 'Twitter Square',
	'fa-vimeo-square'			=> 'Vimeo Square',
	'fa-vine'					=> 'Vine',
	'fa-vk'						=> 'VK',
	'fa-weibo'					=> 'Weibo',
	'fa-weixin'					=> 'Weixin',
	'fa-whatsapp'				=> 'Whatsapp',
	'fa-windows'				=> 'Windows',
	'fa-wordpress'				=> 'WordPress',
	'fa-xing'					=> 'Xing',
	'fa-xing-square'			=> 'Xing Square',
	'fa-yahoo'					=> 'Yahoo',
	'fa-yelp'					=> 'Yelp',
	'fa-youtube'				=> 'YouTube',
	'fa-youtube-play'			=> 'YouTube Play',
	'fa-youtube-square'			=> 'YouTube Square',
);

$logo_url			= get_template_directory_uri() . '/assets/images/logo.svg';
$logo_light_url		= get_template_directory_uri() . '/assets/images/logo-3.png';
$favicon_url		= get_template_directory_uri() . '/assets/images/favicon.png';
$header_sidebar		= get_template_directory_uri() . '/assets/images/resource/about-1.jpg';

//Header Layout
$header_layout_options = array();
$header_image_folder = get_template_directory_uri() . '/admin/assets/images/headers/';
for( $i = 1; $i <= 3; $i++ ){
	$header_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Header Layout %s', 'themerange'), $i),
		'img' => $header_image_folder . 'header_v'.$i.'.png'
	);
}

//Preloader
$loading_screen_options = array();
$loading_image_folder = get_template_directory_uri() . '/admin/assets/images/preloader/';
for( $i = 1; $i <= 12; $i++ ){
	$loading_screen_options[$i] = array(
		'alt'  => sprintf(esc_html__('Preloader %s', 'themerange'), $i),
		'img' => $loading_image_folder . 'preloader-'.$i.'.svg'
	);
}

//Banner
$breadcrumb_layout_options = array();
$breadcrumb_image_folder = get_template_directory_uri() . '/admin/assets/images/breadcrumbs/';
for( $i = 1; $i <= 1; $i++ ){
	$breadcrumb_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'themerange'), $i),
		'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.png'
	);
}

$sidebar_options = array();
$default_sidebars = themerange_get_list_sidebars();
if( is_array($default_sidebars) ){
	foreach( $default_sidebars as $key => $_sidebar ){
		$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
	}
}

//Button Style
$button_style = array(
	'one' => esc_html__('Button One', 'themerange'),
	'two' => esc_html__('Button Two', 'themerange'),
	'three' => esc_html__('Button Three', 'themerange'),
);

//Product Loading Image
$product_loading_image = get_template_directory_uri() . '/assets/images/icons/prod_loading.gif';

$option_fields = array();

/*** General Tab ***/
$option_fields['general'] = array(
	//Sticky Header
	array(
		'id'       => 'section-sticky-header',
		'type'     => 'section',
		'title'    => esc_html__( 'Sticky Header', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       	=> 'tr_enable_sticky_header',
		'type'     	=> 'switch',
		'title'    	=> esc_html__( 'Sticky Header', 'themerange' ),
		'subtitle' 	=> '',
		'default'  	=> true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	
	//Cursor Pointer
	array(
		'id'       	=> 'section-pointer',
		'type'     	=> 'section',
		'title'    	=> esc_html__( 'Cursor Pointer', 'themerange' ),
		'subtitle' 	=> '',
		'indent'   	=> false
	),
	array(
		'id'       	=> 'tr_enable_pointer',
		'type'     	=> 'switch',
		'title'    	=> esc_html__( 'Cursor Pointer', 'themerange' ),
		'subtitle'	=> '',
		'default'	=> false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	
	//RTL
	array(
		'id'       => 'section-rtl',
		'type'     => 'section',
		'title'    => esc_html__( 'Right To Left', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_enable_rtl',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Right To Left', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	
	//Disable Right Click
	array(
		'id'       => 'section-disable-right-click',
		'type'     => 'section',
		'title'    => esc_html__( 'Disable Right Click', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_enable_right_click',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Right Click', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	
	//Back to Top
	array(
		'id'       => 'section-back-to-top-button',
		'type'     => 'section',
		'title'    => esc_html__( 'Back To Top Button', 'themerange' ),
		'subtitle' => '',
		'indent'   => false,
	),
	array(
		'id'       => 'tr_back_to_top',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Back To Top Button', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_back_to_top_mobile',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Back To Top Button On Mobile', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	
	//Preloader
	array(
		'id'       => 'section-loading-screen',
		'type'     => 'section',
		'title'    => esc_html__( 'Loading Screen', 'themerange' ),
		'subtitle' => '',
		'indent'   => false,
	),
	array(
		'id'       => 'tr_loading_screen',
		'type'     => 'switch',
		'title'    => esc_html__( 'Loading Screen', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
	),
	array(
		'id'       => 'tr_loading_image',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Loading Image', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $loading_screen_options,
		'default'  => '1',
		'required'	=> array( 'tr_loading_screen', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_custom_loading_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Custom Loading Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => '',
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required'	=> array( 'tr_loading_screen', 'equals', '1' ),
	),
	array(
		'id'       	=> 'tr_display_loading_screen_in',
		'type'     => 'select',
		'title'    => esc_html__( 'Display Loading Screen In', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => array(
			'all-pages' 		=> esc_html__( 'All Pages', 'themerange' ),
			'homepage-only' 	=> esc_html__( 'Homepage Only', 'themerange' ),
			'specific-pages' 	=> esc_html__( 'Specific Pages', 'themerange' )
		),
		'default'  => 'all-pages',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
		'required'	=> array( 'tr_loading_screen', 'equals', '1' ),
	),
	array(
		'id'       	=> 'tr_loading_screen_exclude_pages',
		'type'     => 'select',
		'title'    => esc_html__( 'Exclude Pages', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'data'     => 'pages',
		'multi'    => true,
		'default'	=> '',
		'required'	=> array( 'tr_display_loading_screen_in', 'equals', 'all-pages' ),
	),
	array(
		'id'       	=> 'tr_loading_screen_specific_pages',
		'type'     => 'select',
		'title'    => esc_html__( 'Specific Pages', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'data'     => 'pages',
		'multi'    => true,
		'default'	=> '',
		'required'	=> array( 'tr_display_loading_screen_in', 'equals', 'specific-pages' ),
	)
);

/*** Logo Tab ***/
$option_fields['logo'] = array(
	array(
		'id'       => 'tr_favicon',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Favicon', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a PNG, JPG, JPEG or ICO image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => $favicon_url ),
	),
	array(
		'id'       => 'tr_logo',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Logo', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select an image file for the main dark logo', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => $logo_url ),
	),
	array(
		'id'       => 'tr_logo_mobile',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Mobile Logo', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Display this logo on mobile', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => $logo_url ),
	),
	array(
		'id'       => 'logo_width',
		'type'     => 'text',
		'url'      => true,
		'title'    => esc_html__( 'Logo Width', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'themerange' ),
		'default'  => '174'
	),
	array(
		'id'       => 'device_logo_width',
		'type'     => 'text',
		'url'      => true,
		'title'    => esc_html__( 'Logo Width on Device', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'themerange' ),
		'default'  => '42'
	),
	array(
		'id'       => 'text_logo',
		'type'     => 'text',
		'title'    => esc_html__( 'Text Logo', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'default'  => 'Themerange'
	),
);

/*** Header Tab ***/
$option_fields['header'] = array(
	array(
		'id'       => 'header_builder_switcher',
		'type'     => 'select',
		'title'    => esc_html__( 'Select Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => array(
			'th' => 'Theme Header',
			'eh' => 'Elementor Header',
		),
		'default'  => 'th',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	
	//Elementor Header
	array(
		'id'       	=> 'el_header_layout',
		'type'     => 'select',
		'title'    => esc_html__( 'Header Builder', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => themerange_get_header_block_options(),
		'default'  => '0',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
		'required'	=> array('header_builder_switcher', 'equals', 'eh'),
	),
	
	//Theme Header
	array(
		'id'       => 'tr_header_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Header Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $header_layout_options,
		'default'  => 'v1',
		'required'	=> array( 'header_builder_switcher', 'equals', 'th' ),
	),
	
	//Search
	array(
		'id'       => 'tr_enable_search',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Search', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_header_layout', 'equals', array('v1', 'v2') ),
	),
	array(
		'id'       	=> 'tr_search_layout',
		'type'     => 'select',
		'title'    => esc_html__( 'Search Layout', 'themerange' ),
		'desc'     => '',
		'options'  => array(
			'layout1' => esc_html__( 'Layout 1', 'themerange' ),
			'layout2' => esc_html__( 'Layout 2', 'themerange' ),
		),
		'default'  => 'layout1',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
		'required'	=> array( 'tr_enable_search', 'equals', '1' ),
	),
	
	//Button
	array(
		'id'       => 'tr_header_enable_button',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Button', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_header_layout', 'equals', 'v1' ),
	),
	array(
		'id'       	=> 'tr_header_button_style',
		'type'     => 'select',
		'title'    => esc_html__( 'Button Style', 'themerange' ),
		'options'  => $button_style,
		'default'  => 'one',
		'required'	=> array( 'tr_header_enable_button', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_header_button_name',
		'type'     => 'text',
		'title'    => esc_html__( 'Button Name', 'themerange' ),
		'default'  => esc_html__( '', 'themerange' ),
		'required'	=> array( 'tr_header_enable_button', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_header_button_link',
		'type'     => 'text',
		'title'    => esc_html__( 'Button Link', 'themerange' ),
		'default'  => '',
		'required'	=> array( 'tr_header_enable_button', 'equals', '1' ),
	),
	
	//Top Bar
	array(
		'id'       => 'tr_enable_top_bar',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Top Bar', 'themerange' ),
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_header_layout', 'equals', 'v2' ),
	),
	
	//Address
	array(
		'id'       => 'tr_enable_address',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Address', 'themerange' ),
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_enable_top_bar', 'equals', true ),
	),
	array(
		'id'       => 'tr_header_address',
		'type'     => 'text',
		'title'    => esc_html__( 'Address', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_enable_address', 'equals', true ),
	),
	
	//Phone Number
	array(
		'id'       => 'tr_enable_phone_number',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Phone Number', 'themerange' ),
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_enable_top_bar', 'equals', true ),
	),
	array(
		'id'       => 'tr_header_phone_number',
		'type'     => 'text',
		'title'    => esc_html__( 'Header Phone Number', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_enable_phone_number', 'equals', true ),
	),
	
	//Email Address
	array(
		'id'       => 'tr_enable_email_address',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Email Address', 'themerange' ),
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_enable_top_bar', 'equals', true ),
	),
	array(
		'id'       => 'tr_header_email_address',
		'type'     => 'text',
		'title'    => esc_html__( 'Header Email Address', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_enable_email_address', 'equals', true ),
	),
	
	//Social Icons
	array(
		'id'       => 'tr_enable_social_icons',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Social Icons', 'themerange' ),
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_enable_top_bar', 'equals', true ),
	),
	
	//Helpline
	array(
		'id'       => 'tr_enable_helpline_number',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Helpline', 'themerange' ),
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'tr_header_layout', 'equals', array('v2','v3') ),
	),
	array(
		'id'       => 'tr_header_helpline_text',
		'type'     => 'text',
		'title'    => esc_html__( 'Helpline Text', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_enable_helpline_number', 'equals', true ),
	),
	array(
		'id'       => 'tr_header_helpline_number',
		'type'     => 'text',
		'title'    => esc_html__( 'Header Helpline', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_enable_helpline_number', 'equals', true ),
	),
	
	//Mobile Search
	array(
		'id'       => 'tr_enable_mobile_search',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Mobile Search', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required'	=> array( 'header_builder_switcher', 'equals', 'th' ),
	),
);

/*** Header Sidebar Tab ***/
$option_fields['header_sidebar'] = array(
	array(
		'id'       => 'tr_show_header_sidebar',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Header Sidebar', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_header_sidebar_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required' => array( 'tr_show_header_sidebar', 'equals', true ),
	),
	array(
		'id'       => 'tr_header_sidebar_title',
		'type'     => 'text',
		'title'    => esc_html__( 'Title', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required' => array( 'tr_show_header_sidebar', 'equals', true ),
	),
	array(
		'id'       => 'tr_header_sidebar_text',
		'type'     => 'textarea',
		'title'    => esc_html__( 'Text', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required' => array( 'tr_show_header_sidebar', 'equals', true ),
	),
	array(
		'id'       => 'tr_header_sidebar_feature_list',
		'type'     => 'textarea',
		'title'    => esc_html__( 'Feature List', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required' => array( 'tr_show_header_sidebar', 'equals', true ),
	),
	array(
		'id'       => 'tr_show_header_sidebar_social_icons',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Social Icons', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required' => array( 'tr_show_header_sidebar', 'equals', true ),
	),
);

/*** Banner Tab ***/
$option_fields['banner'] = array(
	array(
		'id'       => 'tr_show_banner',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Banner', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_breadcrumb_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Banner Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $breadcrumb_layout_options,
		'default'  => 'v1',
		'required' => array( 'tr_show_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_enable_breadcrumb_background_image',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Banner Background Image', 'themerange' ),
		'subtitle' => esc_html__( 'You can set background image', 'themerange' ),
		'default'  => false,
		'required' => array( 'tr_show_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_bg_breadcrumbs',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Banner Background Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default background image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required' => array( 'tr_enable_breadcrumb_background_image', 'equals', true ),
	),
	array(
		'id'       => 'tr_bg_parallax',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Banner Background Parallax', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required' => array( 'tr_show_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_enable_breadcrumb',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Breadcrumbs', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_show_banner', 'equals', true ),
	),
	
	//Portfolio
	array(
		'id'       => 'section-portfolio',
		'type'     => 'section',
		'title'    => esc_html__( 'Portfolio Details', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_enable_portfolio_banner',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Banner', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_portfolio_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Breadcrumb Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $breadcrumb_layout_options,
		'default'  => 'v1',
		'required'	=> array( 'tr_enable_portfolio_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_portfolio_background_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Breadcrumbs Background Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default background image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required'	=> array( 'tr_enable_portfolio_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_portfolio_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Portfolio Banner Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_portfolio_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_portfolio_custom_name',
		'type'     => 'text',
		'title'    => esc_html__( 'Portfolio Banner Title', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_portfolio_title', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_enable_portfolio_breadcrumb',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Portfolio Breadcrumbs', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_portfolio_banner', 'equals', true ),
	),
);

/*** Footer Tab ***/
$option_fields['footer'] = array(
	//Elementor Footer
	array(
		'id'       => 'el_footer_block',
		'type'     => 'select',
		'title'    => esc_html__( 'Footer Block', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => themerange_get_footer_block_options(),
		'default'  => '0',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	
	//Copyright
	array(
		'id'       => 'copyright',
		'type'     => 'textarea',
		'title'    => esc_html__( 'Copyright', 'themerange' ),
		'subtitle' => esc_html__( 'You can add copyright', 'themerange' ),
		'desc'     => '',
		'default'  => '',
	),
);

/*** 404 Page Tab ***/
$option_fields['error'] = array(
	array( 
		'id'       	=> 'tr_404_page',
		'type'      => 'select',
		'title'     => esc_html__( '404 Page', 'themerange' ),
		'subtitle'  => esc_html__( 'Select the page which displays the 404 page', 'themerange' ),
		'desc'      => '',
		'data'    	=> 'pages',
		'default'	=> ''
	),
	
	//404
	array(
		'id'       => 'tr_enable_404_banner',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable 404 Banner', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required' => array( 'tr_404_page', 'equals', '' ),
	),
	array(
		'id'       => 'tr_404_banner_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Breadcrumb Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $breadcrumb_layout_options,
		'default'  => 'v1',
		'required'	=> array( 'tr_enable_404_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_404_banner_background_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Breadcrumbs Background Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default background image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required'	=> array( 'tr_enable_404_banner', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_404_banner_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable 404 Banner Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_404_banner', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_404_banner_custom_name',
		'type'     => 'text',
		'title'    => esc_html__( 'Banner Title', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_404_banner_title', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_enable_404_banner_breadcrumb',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable 404 Breadcrumbs', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_404_banner', 'equals', '1' ),
	),
	
	//404 Content
	array(
		'id' => 'tr_404_title',
		'type' => 'text',
		'title' => esc_html__( '404 Title', 'themerange' ),
		'required' => array( 'tr_404_page', 'equals', '' ),
	),
	array(
		'id' => 'tr_404_text',
		'type' => 'textarea',
		'title' => esc_html__( '404 Text', 'themerange' ),
		'required' => array( 'tr_404_page', 'equals', '' ),
	),
	array(
		'id' => 'tr_404_description',
		'type' => 'textarea',
		'title' => esc_html__( '404 Description', 'themerange' ),
		'required' => array( 'tr_404_page', 'equals', '' ),
	),
	
	//Button
	array(
		'id'       => 'tr_enable_404_button',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable 404 Button', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
		'required' => array( 'tr_404_page', 'equals', '' ),
	),
	array(
		'id'       	=> 'tr_404_button_style',
		'type'     => 'select',
		'title'    => esc_html__( 'Button Style', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $button_style,
		'default'  => 'three',
		'required' => array( 'tr_enable_404_button', 'equals', true ),
	),
	array(
		'id'       => 'tr_404_button',
		'type'     => 'text',
		'title'    => esc_html__( 'Button Label', 'themerange' ),
		'default'  => esc_html__( 'Go to Home', 'themerange' ),
		'required' => array( 'tr_enable_404_button', 'equals', true ),
	),
);

/*** Social Icons Tab ***/
$option_fields['social'] = array(
	array(
		'id'         => 'tr_repeater',
		'type'       => 'repeater',
		'title'      => __( 'Social Icons', 'themerange' ),
		'subtitle'   => __( '', 'themerange' ),
		'desc'       => __( '', 'themerange' ),
		'fields'     => array(
			array(
				'id'        => 'tr_icon_name',
				'type'      => 'select',
				'title'		=> __( 'Select Icon', 'themerange' ),
				'options'   => $social_icons,
			),
			array(
				'id'	=> 'tr_icon_link',
				'type'	=> 'text',
				'title'	=> __( 'URL', 'themerange' ),
				'placeholder'	=> __( 'https://themerange.net/', 'themerange' ),
			),
		)
	),
);

/*** Blog Tab ***/
$option_fields['blog'] = array(
	array(
		'id'       => 'section-blog',
		'type'     => 'section',
		'title'    => esc_html__( 'Blog', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_enable_blog_banner',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Banner', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_banner_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Breadcrumb Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $breadcrumb_layout_options,
		'default'  => 'v1',
		'required'	=> array( 'tr_enable_blog_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_background_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Breadcrumbs Background Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default background image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required'	=> array( 'tr_enable_blog_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Blog Detail Banner Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_blog_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_custom_name',
		'type'     => 'text',
		'title'    => esc_html__( 'Blog Detail Banner Title', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_blog_title', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_enable_blog_breadcrumb',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Blog Breadcrumbs', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_blog_title', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Blog Layout', 'themerange' ),
		'subtitle' => esc_html__( 'This option is available when Front page displays the latest posts', 'themerange' ),
		'desc'     => '',
		'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'themerange'),
				'img' => $redux_url . 'assets/img/1col.png'
			),
			'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'themerange'),
				'img' => $redux_url . 'assets/img/2cl.png'
			),
			'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'themerange'),
				'img' => $redux_url . 'assets/img/2cr.png'
			),
			'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'themerange'),
				'img' => $redux_url . 'assets/img/3cm.png'
			)
		),
		'default'  => '0-1-1'
	),
	array(
		'id'       => 'tr_blog_left_sidebar',
		'type'     => 'select',
		'title'    => esc_html__( 'Left Sidebar', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $sidebar_options,
		'default'  => 'blog-sidebar',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'       => 'tr_blog_right_sidebar',
		'type'     => 'select',
		'title'    => esc_html__( 'Right Sidebar', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $sidebar_options,
		'default'  => 'default-sidebar',
		'select2'  => array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'       => 'tr_blog_thumbnail',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Thumbnail', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	
	//Blog Meta
	array(
		'id'       => 'tr_blog_date',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Date', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_author',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Author', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_category',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Category', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_comment',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Comment', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	
	//Content
	array(
		'id'       => 'tr_blog_detail_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Detail Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_excerpt',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Excerpt', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_excerpt_strip_tags',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Excerpt Strip All Tags', 'themerange' ),
		'subtitle' => esc_html__( 'Strip all html tags in Excerpt', 'themerange' ),
		'default'  => false,
		'required' => array( 'tr_blog_excerpt', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_read_more',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Read More Button', 'themerange' ),
		'subtitle' => '',
		'default'  => 'false',
		'on'	   => esc_html__( 'Show', 'themerange' ),
		'off'	   => esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       	=> 'tr_blog_button_style',
		'type'     => 'select',
		'title'    => esc_html__( 'Button Style', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $button_style,
		'default'  => 'two',
		'required' => array( 'tr_blog_read_more', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_read_more_button',
		'type'     => 'text',
		'title'    => esc_html__( 'Blog Read More Name', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'default'  => esc_html__( 'Read More', 'themerange' ),
		'required' => array( 'tr_blog_read_more', 'equals', '1' ),
	),
	
	//Blog Details
	array(
		'id'       => 'section-blog-details',
		'type'     => 'section',
		'title'    => esc_html__( 'Blog Details', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_enable_blog_detail_banner',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Banner', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_detail_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Breadcrumb Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $breadcrumb_layout_options,
		'default'  => 'v1',
		'required'	=> array( 'tr_enable_blog_detail_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_detail_background_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Breadcrumbs Background Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default background image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required'	=> array( 'tr_enable_blog_detail_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_detail_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Blog Detail Banner Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_blog_detail_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_detail_custom_name',
		'type'     => 'text',
		'title'    => esc_html__( 'Blog Detail Banner Title', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_blog_detail_title', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_enable_blog_detail_breadcrumb',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Blog Detail Breadcrumbs', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_blog_detail_title', 'equals', true ),
	),
	array(
		'id'       => 'tr_blog_details_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Blog Details Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'themerange'),
				'img' => $redux_url . 'assets/img/1col.png'
			),
			'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'themerange'),
				'img' => $redux_url . 'assets/img/2cl.png'
			),
			'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'themerange'),
				'img' => $redux_url . 'assets/img/2cr.png'
			),
			'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'themerange'),
				'img' => $redux_url . 'assets/img/3cm.png'
			)
		),
		'default'  => '0-1-0',
	),
	array(
		'id'       	=> 'tr_blog_details_left_sidebar',
		'type'     => 'select',
		'title'    => esc_html__( 'Left Sidebar', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $sidebar_options,
		'default'  => 'blog-detail-sidebar',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
		'required'	=> array( 'tr_blog_details_layout', 'equals', array('1-1-0', '1-1-1') ),
	),
	array(
		'id'       	=> 'tr_blog_details_right_sidebar',
		'type'     => 'select',
		'title'    => esc_html__( 'Right Sidebar', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $sidebar_options,
		'default'  => 'blog-detail-sidebar',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
		'required'	=> array( 'tr_blog_details_layout', 'equals', array('0-1-1', '1-1-1') ),
	),
	array(
		'id'       => 'tr_blog_details_thumbnail',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Thumbnail', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_details_date',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Date', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_details_author',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Author', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_details_categories',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Categories', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_details_comment',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Comment', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_details_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_details_content',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Content', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_details_tags',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Tags', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       	=> 'tr_blog_details_tag_title',
		'type'     	=> 'text',
		'title'    	=> esc_html__( 'Tags Title', 'themerange' ),
		'subtitle' 	=> esc_html__( 'You can add your tag title', 'themerange' ),
		'desc'     	=> '',
		'default'  	=> esc_html__( 'Tags:', 'themerange' ),
		'required'	=> array( 'tr_blog_details_tags', 'equals', '1' ),
	),
	array(
		'id'       	=> 'tr_blog_details_author_box',
		'type'     	=> 'switch',
		'title'    	=> esc_html__( 'Blog Author Box', 'themerange' ),
		'subtitle' 	=> '',
		'default'  	=> true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       	=> 'tr_blog_details_comment_form',
		'type'     	=> 'switch',
		'title'    	=> esc_html__( 'Blog Comment Form', 'themerange' ),
		'subtitle' 	=> '',
		'default'  	=> true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       	=> 'tr_blog_details_comment_title',
		'type'     	=> 'text',
		'title'    	=> esc_html__( 'Comment Title', 'themerange' ),
		'default'	=> esc_html__( 'Leave a reply here', 'themerange' ),
		'required'	=> array( 'tr_blog_details_comment_form', 'equals', '1' ),
	),
	array(
		'id'       	=> 'tr_blog_details_comment_name',
		'type'     	=> 'text',
		'title'    	=> esc_html__( 'Comment Name Placeholder', 'themerange' ),
		'default'	=> esc_html__( 'Name', 'themerange' ),
		'required'	=> array( 'tr_blog_details_comment_form', 'equals', '1' ),
	),
	array(
		'id'        => 'tr_blog_details_comment_email',
		'type'      => 'text',
		'title'     => esc_html__( 'Comment Email Placeholder', 'themerange' ),
		'default'	=> esc_html__( 'Email', 'themerange' ),
		'required'	=> array( 'tr_blog_details_comment_form', 'equals', '1' ),
	),
	array(
		'id'        => 'tr_blog_details_comment_textarea',
		'type'      => 'text',
		'title'     => esc_html__( 'Comment Textarea Placeholder', 'themerange' ),
		'default'	=> esc_html__( 'Tye Comment here', 'themerange' ),
		'required'	=> array( 'tr_blog_details_comment_form', 'equals', '1' ),
	),
	array(
		'id'        => 'tr_blog_details_comment_label_submit',
		'type'      => 'text',
		'title'     => esc_html__( 'Comment Button Name', 'themerange' ),
		'default'	=> esc_html__( 'Post Comment', 'themerange' ),
		'required'	=> array( 'tr_blog_details_comment_form', 'equals', '1' ),
	),
	
	
	//Post Share
	array(
		'id'       => 'section-blog-share',
		'type'     => 'section',
		'title'    => esc_html__( 'Blog Share', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_blog_details_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Blog Sharing', 'themerange' ),
		'subtitle' => '',
		'default'  => false,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'       => 'tr_blog_facebook_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Show Facebook Post Share', 'themerange' ),
		'subtitle' => esc_html__( 'Enable to show Post Share to Facebook', 'themerange' ),
		'default'  => false,
		'indent'   => true,
		'required' => array( 'tr_blog_details_sharing', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_twitter_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Show Twitter Post Share', 'themerange' ),
		'subtitle' => esc_html__( 'Enable to show Post Share to Twitter', 'themerange' ),
		'default'  => false,
		'indent'   => true,
		'required' => array( 'tr_blog_details_sharing', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_linkedin_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Show Linkedin Post Share', 'themerange' ),
		'subtitle' => esc_html__( 'Enable to show Post Share to Linkedin', 'themerange' ),
		'default'  => false,
		'indent'   => true,
		'required' => array( 'tr_blog_details_sharing', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_pinterest_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Show Pinterest Post Share', 'themerange' ),
		'subtitle' => esc_html__( 'Enable to show Post Share to Pinterest', 'themerange' ),
		'default'  => false,
		'indent'   => true,
		'required' => array( 'tr_blog_details_sharing', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_reddit_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Show Reddit Post Share', 'themerange' ),
		'subtitle' => esc_html__( 'Enable to show Post Share to Reddit', 'themerange' ),
		'default'  => false,
		'indent'   => true,
		'required' => array( 'tr_blog_details_sharing', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_tumblr_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Show Tumblr Post Share', 'themerange' ),
		'subtitle' => esc_html__( 'Enable to show Post Share to Tumblr', 'themerange' ),
		'default'  => false,
		'indent'   => true,
		'required' => array( 'tr_blog_details_sharing', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_blog_digg_sharing',
		'type'     => 'switch',
		'title'    => esc_html__( 'Show Digg Post Share', 'themerange' ),
		'subtitle' => esc_html__( 'Enable to show Post Share to Digg', 'themerange' ),
		'default'  => false,
		'indent'   => true,
		'required' => array( 'tr_blog_details_sharing', 'equals', '1' ),
	),
);

/*** Post Type Slug Tab ***/
$option_fields['cpt_slug'] = array(
	//Info
	array(
		'id'       => 'section-cpt-info',
		'type'     => 'info',
		'title'    => esc_html__( 'Note:', 'themerange' ),
		'subtitle' => 'Please update the <a href="'.WP_PERMALINK.'" target="_blank">permalink</a> after change the fields.',
		'indent'   => false
	),
	
	//Services
	array(
		'id'       => 'section-cpt-services',
		'type'     => 'section',
		'title'    => esc_html__( 'Services', 'themerange' ),
		'subtitle' => '',
		'indent'   => false,
	),
	array(
		'id' => 'tr_services_name',
		'type' => 'text',
		'title' => esc_html__( 'Services Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Services', 'themerange' ),
	),
	array(
		'id' => 'tr_services_slug',
		'type' => 'text',
		'title' => esc_html__( 'Services Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: services', 'themerange' ),
	),
	array(
		'id' => 'tr_services_cat_name',
		'type' => 'text',
		'title' => esc_html__( 'Services Category Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Services Category', 'themerange' ),
	),
	array(
		'id' => 'tr_services_cat_slug',
		'type' => 'text',
		'title' => esc_html__( 'Services Category Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: services_cat', 'themerange' ),
	),
	
	//Team
	array(
		'id'       => 'section-cpt-team',
		'type'     => 'section',
		'title'    => esc_html__( 'Team', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id' => 'tr_team_name',
		'type' => 'text',
		'title' => esc_html__( 'Team Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Team', 'themerange' ),
	),
	array(
		'id' => 'tr_team_slug',
		'type' => 'text',
		'title' => esc_html__( 'Team Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: team', 'themerange' ),
	),
	array(
		'id' => 'tr_team_cat_name',
		'type' => 'text',
		'title' => esc_html__( 'Team Category Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Team Category', 'themerange' ),
	),
	array(
		'id' => 'tr_team_cat_slug',
		'type' => 'text',
		'title' => esc_html__( 'Team Category Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: team_cat', 'themerange' ),
	),
	
	//Portfolio
	array(
		'id'       => 'section-cpt-portfolio',
		'type'     => 'section',
		'title'    => esc_html__( 'Portfolio', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id' => 'tr_portfolio_name',
		'type' => 'text',
		'title' => esc_html__( 'Portfolio Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Portfolio', 'themerange' ),
	),
	array(
		'id' => 'tr_portfolio_slug',
		'type' => 'text',
		'title' => esc_html__( 'Portfolio Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: portfolio', 'themerange' ),
	),
	array(
		'id' => 'tr_portfolio_cat_name',
		'type' => 'text',
		'title' => esc_html__( 'Portfolio Category Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Portfolio Category', 'themerange' ),
	),
	array(
		'id' => 'tr_portfolio_cat_slug',
		'type' => 'text',
		'title' => esc_html__( 'Portfolio Category Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: portfolio_cat', 'themerange' ),
	),
	
	//Classes
	array(
		'id'       => 'section-cpt-classes',
		'type'     => 'section',
		'title'    => esc_html__( 'Classes', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id' => 'tr_classes_name',
		'type' => 'text',
		'title' => esc_html__( 'Classes Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Classes', 'themerange' ),
	),
	array(
		'id' => 'tr_classes_slug',
		'type' => 'text',
		'title' => esc_html__( 'Classes Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: classes', 'themerange' ),
	),
	array(
		'id' => 'tr_classes_cat_name',
		'type' => 'text',
		'title' => esc_html__( 'Classes Category Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Classes Category', 'themerange' ),
	),
	array(
		'id' => 'tr_classes_cat_slug',
		'type' => 'text',
		'title' => esc_html__( 'Classes Category Slug', 'themerange' ),
		'subtitle' => esc_html__( 'Default: classes_cat', 'themerange' ),
	),
	
	//Header Builder
	array(
		'id'       => 'section-cpt-header-builder',
		'type'     => 'section',
		'title'    => esc_html__( 'Header Builder', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id' => 'tr_header_block_name',
		'type' => 'text',
		'title' => esc_html__( 'Header Builder Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Header Builder', 'themerange' ),
	),
	
	//Footer Builder
	array(
		'id'       => 'section-cpt-footer-builder',
		'type'     => 'section',
		'title'    => esc_html__( 'Footer Builder', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id' => 'tr_footer_block_name',
		'type' => 'text',
		'title' => esc_html__( 'Footer Builder Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Footer Builder', 'themerange' ),
	),
	
	//Mega Menu
	array(
		'id'       => 'section-cpt-mega-menu',
		'type'     => 'section',
		'title'    => esc_html__( 'Mega Menu', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id' => 'tr_mega_menu_name',
		'type' => 'text',
		'title' => esc_html__( 'Mega Menu Name', 'themerange' ),
		'subtitle' => esc_html__( 'Default: Mega Menu', 'themerange' ),
	),
);

/*** WooCommerce Tab ***/
$option_fields['woocommerce'] = array(
	array(
		'id'       => 'section-shop-banner',
		'type'     => 'section',
		'title'    => esc_html__( 'Shop Banner', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_enable_shop_banner',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Banner', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_shop_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Breadcrumb Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $breadcrumb_layout_options,
		'default'  => 'v1',
		'required'	=> array( 'tr_enable_shop_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_shop_background_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Breadcrumbs Background Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default background image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required'	=> array( 'tr_enable_shop_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_shop_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Shop Banner Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_shop_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_shop_custom_name',
		'type'     => 'text',
		'title'    => esc_html__( 'Shop Banner Title', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_shop_title', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_enable_shop_breadcrumb',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Shop Breadcrumbs', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_shop_banner', 'equals', true ),
	),
	array(
		'id'       => 'section-shop',
		'type'     => 'section',
		'title'    => esc_html__( 'Shop Details', 'themerange' ),
		'subtitle' => '',
		'indent'   => false
	),
	array(
		'id'       => 'tr_enable_shop_detail_banner',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable/Disable Banner', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'on'		=> esc_html__( 'Enable', 'themerange' ),
		'off'		=> esc_html__( 'Disable', 'themerange' ),
	),
	array(
		'id'       => 'tr_shop_detail_layout',
		'type'     => 'image_select',
		'title'    => esc_html__( 'Breadcrumb Layout', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $breadcrumb_layout_options,
		'default'  => 'v1',
		'required'	=> array( 'tr_enable_shop_detail_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_shop_detail_background_image',
		'type'     => 'media',
		'url'      => true,
		'title'    => esc_html__( 'Breadcrumbs Background Image', 'themerange' ),
		'desc'     => '',
		'subtitle' => esc_html__( 'Select a new image to override the default background image', 'themerange' ),
		'readonly' => false,
		'default'  => array( 'url' => '' ),
		'required'	=> array( 'tr_enable_shop_detail_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_shop_detail_title',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Shop Banner Title', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_shop_detail_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_shop_detail_custom_name',
		'type'     => 'text',
		'title'    => esc_html__( 'Shop Banner Title', 'themerange' ),
		'desc'     => '',
		'default'  => '',
		'required'	=> array( 'tr_shop_detail_title', 'equals', '1' ),
	),
	array(
		'id'       => 'tr_enable_shop_detail_breadcrumb',
		'type'     => 'switch',
		'title'    => esc_html__( 'Enable Shop Breadcrumbs', 'themerange' ),
		'subtitle' => '',
		'default'  => true,
		'required'	=> array( 'tr_enable_shop_detail_banner', 'equals', true ),
	),
	array(
		'id'       => 'tr_product_label_style',
		'type'     => 'select',
		'title'    => esc_html__( 'Product Label Style', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => array(
			'rectangle' 	=> esc_html__( 'Rectangle', 'themerange' ),
			'square' 		=> esc_html__( 'Square', 'themerange' ),
			'circle' 		=> esc_html__( 'Circle', 'themerange' ),
		),
		'default'  => 'rectangle',
		'select2'  => array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'        => 'tr_product_feature_label_text',
		'type'      => 'text',
		'title'     => esc_html__( 'Product Feature Label Text', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'default'   => esc_html__( 'Hot', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_out_of_stock_label_text',
		'type'      => 'text',
		'title'     => esc_html__( 'Product Out Of Stock Label Text', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'default'   => esc_html__( 'Sold out', 'themerange' ),
	),
	array(
		'id'       	=> 'tr_show_sale_label_as',
		'type'      => 'select',
		'title'     => esc_html__( 'Show Sale Label As', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'options'   => array(
			'text' 		=> esc_html__( 'Text', 'themerange' ),
			'number' 	=> esc_html__( 'Number', 'themerange' ),
			'percent' 	=> esc_html__( 'Percent', 'themerange' ),
		),
		'default'  => 'percent',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'        => 'tr_product_sale_label_text',
		'type'      => 'text',
		'title'     => esc_html__( 'Product Sale Label Text', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'default'   => esc_html__( 'Sale', 'themerange' ),
		'required'	=> array( 'tr_show_sale_label_as', 'equals', 'text' ),
	),
	array(
		'id'       => 'section-product-label',
		'type'     => 'section',
		'title'    => esc_html__( 'Product Label', 'themerange' ),
		'subtitle' => '',
		'indent'   => false,
	),
	array(
		'id'        => 'tr_product_show_new_label',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product New Label', 'themerange' ),
		'subtitle'  => '',
		'default'   => false,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_new_label_text',
		'type'      => 'text',
		'title'     => esc_html__( 'Product New Label Text', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'default'   => esc_html__( 'New', 'themerange' ),
		'required'	=> array( 'tr_product_show_new_label', 'equals', '1' ),
	),
	array(
		'id'        => 'tr_product_show_new_label_time',
		'type'      => 'text',
		'title'     => esc_html__( 'Product New Label Time', 'themerange' ),
		'subtitle'  => esc_html__( 'Number of days which you want to show New label since product is published', 'themerange' ),
		'desc'      => '',
		'default'   => '30',
		'required'	=> array( 'tr_product_show_new_label', 'equals', '1' ),
	),
);

/*** Shop/Product Category Tab ***/
$option_fields['shop-product-category'] = array(
	array(
		'id'        => 'tr_product_layout',
		'type'      => 'image_select',
		'title'     => esc_html__( 'Shop/Product Category Layout', 'themerange' ),
		'subtitle'  => esc_html__( 'Sidebar is only available if Filter Widget Area is disabled', 'themerange' ),
		'desc'      => '',
		'options'   => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'themerange'),
				'img'  => $redux_url . 'assets/img/1col.png',
			),
			'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'themerange'),
				'img'  => $redux_url . 'assets/img/2cl.png',
			),
			'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'themerange'),
				'img'  => $redux_url . 'assets/img/2cr.png',
			),
			'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'themerange'),
				'img'  => $redux_url . 'assets/img/3cm.png',
			)
		),
		'default'  => '0-1-1'
	),
	array(
		'id'        => 'tr_product_left_sidebar',
		'type'      => 'select',
		'title'     => esc_html__( 'Left Sidebar', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'options'   => $sidebar_options,
		'default'   => 'product-sidebar',
		'select2'   => array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'        => 'tr_product_right_sidebar',
		'type'      => 'select',
		'title'     => esc_html__( 'Right Sidebar', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'options'   => $sidebar_options,
		'default'   => 'product-sidebar',
		'select2'   => array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'		=> 'tr_product_columns',
		'type'		=> 'select',
		'title'		=> esc_html__( 'Product Columns', 'themerange' ),
		'subtitle'	=> '',
		'desc'		=> '',
		'options'	=> array(
			'3'		=> '3',
			'4'		=> '4',
		),
		'default'	=> '3',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'        => 'tr_product_per_page',
		'type'      => 'text',
		'title'     => esc_html__( 'Products Per Page', 'themerange' ),
		'subtitle'  => esc_html__( 'Number of products per page', 'themerange' ),
		'desc'      => '',
		'default'   => '9',
	),
	array(
		'id'        => 'tr_product_thumbnail',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product Thumbnail', 'themerange' ),
		'subtitle'  => '',
		'default'   => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_title',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product Title', 'themerange' ),
		'subtitle'  => '',
		'default'   => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_price',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product Price', 'themerange' ),
		'subtitle'  => '',
		'default'   => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_rating',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product Rating', 'themerange' ),
		'subtitle'  => '',
		'default'   => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_desc',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product Short Description', 'themerange' ),
		'subtitle'  => '',
		'default'   => false,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_desc_words',
		'type'      => 'text',
		'title'     => esc_html__( 'Product Short Description - Limit Words', 'themerange' ),
		'subtitle'  => esc_html__( 'It is also used for product shortcode', 'themerange' ),
		'desc'      => '',
		'default'   => '8',
		'required'	=> array( 'tr_product_desc', 'equals', true ),
	),
	array(
		'id'        => 'tr_product_button',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product Button', 'themerange' ),
		'subtitle'  => '',
		'default'   => true,
		'on'		=> esc_html__( 'Show', 'themerange' ),
		'off'		=> esc_html__( 'Hide', 'themerange' ),
	),
	array(
		'id'        => 'tr_product_button_name',
		'type'      => 'text',
		'title'     => esc_html__( 'Product Button Name', 'themerange' ),
		'desc'      => '',
		'default'   => esc_html__( 'View Details', 'themerange' ),
		'required'	=> array( 'tr_product_button', 'equals', true ),
	),
	array(
		'id'        => 'tr_product_button_style',
		'type'      => 'select',
		'title'     => esc_html__( 'Product Button Style', 'themerange' ),
		'subtitle' => '',
		'desc'     => '',
		'options'  => $button_style,
		'default'  => 'two',
		'required' => array( 'tr_product_button', 'equals', true ),
	),
);

/*** Product Details Tab ***/
$option_fields['product-details'] = array(
	array(
		'id'        => 'tr_prod_layout',
		'type'      => 'image_select',
		'title'     => esc_html__( 'Product Layout', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'options'   => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'themerange'),
				'img'  => $redux_url . 'assets/img/1col.png',
			),
			'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'themerange'),
				'img'  => $redux_url . 'assets/img/2cl.png',
			),
			'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'themerange'),
				'img'  => $redux_url . 'assets/img/2cr.png',
			),
			'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'themerange'),
				'img'  => $redux_url . 'assets/img/3cm.png',
			),
		),
		'default'  => '0-1-0'
	),
	array(
		'id'       	=> 'tr_prod_left_sidebar',
		'type'      => 'select',
		'title'     => esc_html__( 'Left Sidebar', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'options'   => $sidebar_options,
		'default'   => 'product-detail-sidebar',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'       	=> 'tr_prod_right_sidebar',
		'type'      => 'select',
		'title'     => esc_html__( 'Right Sidebar', 'themerange' ),
		'subtitle'  => '',
		'desc'      => '',
		'options'   => $sidebar_options,
		'default'   => 'product-detail-sidebar',
		'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity'),
	),
	array(
		'id'        => 'tr_prod_breadcrumb',
		'type'      => 'switch',
		'title'     => esc_html__( 'Product Breadcrumb', 'themerange' ),
		'subtitle'  => '',
		'default'   => true,
	),
);

/*** Color Settings Tab ***/
$option_fields['color-setting'] = array(
	array(
		'id'       => 'tr_primary_color',
		'type'     => 'color',
		'title'    => esc_html__( 'Primary Color', 'themerange' ),
		'default'  => '#DF0303',
	),
	array(
		'id'       => 'tr_color_two',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Two', 'themerange' ),
		'default'  => '#1E1E1E',
	),
	array(
		'id'       => 'tr_color_three',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Three', 'themerange' ),
		'default'  => '#AAAAAA',
	),
	array(
		'id'       => 'tr_color_four',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Four', 'themerange' ),
		'default'  => '#666666',
	),
	array(
		'id'       => 'tr_color_five',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Five', 'themerange' ),
		'default'  => '#343434',
	),
	array(
		'id'       => 'tr_color_six',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Six', 'themerange' ),
		'default'  => '#D9D9D9',
	),
	array(
		'id'       => 'tr_color_seven',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Seven', 'themerange' ),
		'default'  => '#999999',
	),
	array(
		'id'       => 'tr_color_eight',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Eight', 'themerange' ),
		'default'  => '#858585',
	),
	array(
		'id'       => 'tr_color_nine',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Nine', 'themerange' ),
		'default'  => '#B5B2B2',
	),
	array(
		'id'       => 'tr_color_ten',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Ten', 'themerange' ),
		'default'  => '#2E2E2E',
	),
	array(
		'id'       => 'tr_color_eleven',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Eleven', 'themerange' ),
		'default'  => '#161616',
	),
	array(
		'id'       => 'tr_color_twelve',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Twelve', 'themerange' ),
		'default'  => '#484746',
	),
	array(
		'id'       => 'tr_color_thirteen',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Thirteen', 'themerange' ),
		'default'  => '#222222',
	),
	array(
		'id'       => 'tr_color_fourteen',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Fourteen', 'themerange' ),
		'default'  => '#1C1C1C',
	),
	array(
		'id'       => 'tr_color_fifteen',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Fifteen', 'themerange' ),
		'default'  => '#0A0A0A',
	),
	array(
		'id'       => 'tr_color_sixteen',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Sixteen', 'themerange' ),
		'default'  => '#111111',
	),
	array(
		'id'       => 'tr_color_seventeen',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Seventeen', 'themerange' ),
		'default'  => '#F5F5F5',
	),
	array(
		'id'       => 'tr_color_eighteen',
		'type'     => 'color',
		'title'    => esc_html__( 'Color Eighteen', 'themerange' ),
		'default'  => '#1F1F1F',
	),
);

/*** Custom Code Tab ***/
$option_fields['custom-code'] = array(
	array(
		'id'       => 'tr_custom_css_code',
		'type'     => 'ace_editor',
		'title'    => esc_html__( 'Custom CSS Code', 'themerange' ),
		'subtitle' => '',
		'mode'     => 'css',
		'theme'    => 'monokai',
		'desc'     => '',
		'default'  => ''
	),
	array(
		'id'       => 'tr_custom_javascript_code',
		'type'     => 'ace_editor',
		'title'    => esc_html__( 'Custom Javascript Code', 'themerange' ),
		'subtitle' => '',
		'mode'     => 'javascript',
		'theme'    => 'monokai',
		'desc'     => '',
		'default'  => ''
	)
);
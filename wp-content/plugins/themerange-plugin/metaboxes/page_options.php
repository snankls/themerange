<?php
$options = array();
$default_sidebars = function_exists('themerange_get_list_sidebars')? themerange_get_list_sidebars(): array();
$sidebar_options = array();
foreach( $default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

/* Get list menus */
$menus = array('0' => esc_html__('Default', 'themerange'));

$args = array(
	'taxonomy'		=> 'nav_menu',
	'hide_empty'	=> true,
);

$nav_terms = get_terms( $args );

if( is_array($nav_terms) ){
	foreach( $nav_terms as $term ){
		$menus[$term->term_id] = $term->name;
	}
}

/* Get list Footer Blocks */
$header_builder = function_exists('themerange_get_header_block_options')? themerange_get_header_block_options(): array();
$header_builder['0'] = esc_html__('Default', 'themerange');

/* Get list Footer Blocks */
$footer_builder = function_exists('themerange_get_footer_block_options')? themerange_get_footer_block_options(): array();
$footer_builder['0'] = esc_html__('Default', 'themerange');

//Header Layouts
function tr_header_layouts() {
	$header_layouts = array(
		'header_v1' => __('Header Layout V1', 'themerange'),
	);
	
	return $header_layouts;
}

//Page Layout
$options[] = array(
	'id'		=> 'page_layout_heading',
	'label'		=> esc_html__('Page Layout', 'themerange'),
	'desc'		=> '',
	'type'		=> 'heading',
);
$options[] = array(
	'id'		=> 'page_layout',
	'label'		=> esc_html__('Page Layout', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> array(
		'0-1-0'  => esc_html__('Fullwidth', 'themerange'),
		'1-1-0' => esc_html__('Left Sidebar', 'themerange'),
		'0-1-1' => esc_html__('Right Sidebar', 'themerange'),
		'1-1-1' => esc_html__('Left & Right Sidebar', 'themerange'),
	),
);

$options[] = array(
	'id'		=> 'left_sidebar',
	'label'		=> esc_html__('Left Sidebar', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> $sidebar_options,
);

$options[] = array(
	'id'		=> 'right_sidebar',
	'label'		=> esc_html__('Right Sidebar', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> $sidebar_options,
);

$options[] = array(
	'id'		=> 'page_theme',
	'label'		=> esc_html__('Page Theme', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> array(
		'light-layout'	=> esc_html__('Light', 'themerange'),
		'dark-layout'	=> esc_html__('Dark', 'themerange'),
	),
);


//Header Layout
$options[] = array(
	'id'		=> 'header_heading',
	'label'		=> esc_html__('Page Header', 'themerange'),
	'desc'		=> '',
	'type'		=> 'heading',
);
$options[] = array(
	'id'		=> 'header_builder_switcher',
	'label'		=> esc_html__('Page Header Layout', 'themerange'),
	'desc'		=> '',
	'default'	=> 'th',
	'type'		=> 'select',
	'options'	=> array(
		'nh' => esc_html__('No Header', 'themerange'),
		'th' => esc_html__('Theme Header', 'themerange'),
		'eh' => esc_html__('Header Builder', 'themerange'),
	),
);	
$options[] = array(
	'id'		=> 'header_layout',
	'label'		=> esc_html__('Header Layout', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> tr_header_layouts(),
	'required' => array('tr_header_builder_switcher', 'equals', 'th'),
);	
$options[] = array(
	'id'		=> 'header_block',
	'label'		=> esc_html__('Header Builder', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> $header_builder,
	'required' => array( 'theme_header_layout', 'equals', 'eh' ),
);


//Page Banner
$options[] = array(
	'id'		=> 'breadcrumb_heading',
	'label'		=> esc_html__('Page Banner', 'themerange'),
	'desc'		=> '',
	'type'		=> 'heading',
);
$options[] = array(
	'id'		=> 'show_banner',
	'label'		=> esc_html__('Show Banner', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> array(
		'1'		=> esc_html__('Yes', 'themerange'),
		'0'		=> esc_html__('No', 'themerange'),
	),
);
$options[] = array(
	'id'		=> 'breadcrumb_layout',
	'label'		=> esc_html__('Banner Layout', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'default'	=> 'v1',
	'options'	=> array(
		'v1' => esc_html__('Banner Layout 1', 'themerange'),
	),
);
$options[] = array(
	'id'		=> 'show_page_title',
	'label'		=> esc_html__('Show Page Title', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> array(
		'1'		=> esc_html__('Yes', 'themerange'),
		'0'		=> esc_html__('No', 'themerange'),
	)
);
$options[] = array(
	'id'		=> 'show_page_name',
	'label'		=> esc_html__('Show Page Title Name', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'show_breadcrumb',
	'label'		=> esc_html__('Show Page Breadcrumb', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> array(
		'1'		=> esc_html__('Yes', 'themerange'),
		'0'		=> esc_html__('No', 'themerange'),
	)
);
$options[] = array(
	'id'		=> 'breadcrumb_bg_parallax',
	'label'		=> esc_html__('Banner Background Parallax', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> array(
		'1'		=> esc_html__('Yes', 'themerange'),
		'0'		=> esc_html__('No', 'themerange'),
	),
	'default'	=> '0',
);
$options[] = array(
	'id'		=> 'bg_breadcrumbs',
	'label'		=> esc_html__('Banner Background Image', 'themerange'),
	'desc'		=> '',
	'type'		=> 'upload',
);


//Page Footer
$options[] = array(
	'id'		=> 'footer_heading',
	'label'		=> esc_html__('Page Footer', 'themerange'),
	'desc'		=> '',
	'type'		=> 'heading',
);
$options[] = array(
	'id'		=> 'footer_block',
	'label'		=> esc_html__('Footer Builder', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> $footer_builder,
);
?>
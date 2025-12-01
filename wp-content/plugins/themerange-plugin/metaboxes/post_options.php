<?php 
$options = array();
$default_sidebars = function_exists('themerange_get_list_sidebars')? themerange_get_list_sidebars(): array();
$sidebar_options = array(
	'0'	=> esc_html__('Default', 'themerange'),
);
foreach( $default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

wp_reset_postdata();

$options[] = array(
	'id'	=> 'post_layout_heading',
	'label'	=> esc_html__('Post Layout', 'themerange'),
	'desc'	=> '',
	'type'	=> 'heading',
);

$options[] = array(
	'id'		=> 'post_layout',
	'label'	=> esc_html__('Post Layout', 'themerange'),
	'desc'		=> '',
	'type'		=> 'select',
	'options'	=> array(
		'0'			=> esc_html__('Default', 'themerange'),
		'0-1-0'  	=> esc_html__('Fullwidth', 'themerange'),
		'1-1-0' 	=> esc_html__('Left Sidebar', 'themerange'),
		'0-1-1' 	=> esc_html__('Right Sidebar', 'themerange'),
		'1-1-1' 	=> esc_html__('Left & Right Sidebar', 'themerange'),
	),
);

$options[] = array(
	'id'		=> 'post_left_sidebar'
	,'label'	=> esc_html__('Left Sidebar', 'themerange')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);
			
$options[] = array(
	'id'		=> 'post_right_sidebar'
	,'label'	=> esc_html__('Right Sidebar', 'themerange')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);
			
$options[] = array(
	'id'		=> 'bg_breadcrumbs'
	,'label'	=> esc_html__('Breadcrumb Background Image', 'themerange')
	,'desc'		=> ''
	,'type'		=> 'upload'
);	
?>

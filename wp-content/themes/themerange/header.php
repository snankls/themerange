<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />

<link rel="profile" href="//gmpg.org/xfn/11" />
<?php 
themerange_theme_favicon();
wp_head(); 
?>
</head>
<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
	wp_body_open();
}

$theme_options = themerange_get_theme_options();
$page_options = themerange_get_page_options();
?>

<div class="page-wrapper <?php echo esc_attr(themerange_get_page_options('tr_page_theme')); ?>">
	
    <?php if($theme_options['tr_enable_pointer']) : ?>
    <!-- Cursor -->
    <div class="cursor"></div>
	<div class="cursor-follower"></div>
	<!-- Cursor End -->
 	<?php endif; ?>
    
    <?php if(themerange_get_page_options('tr_header_builder_switcher') != 'nh')
	{
		//Page Options
		if(themerange_get_page_options('tr_header_builder_switcher') == 'th')
		{
			themerange_get_header_template($theme_options['tr_header_layout']);
		}
		else if( themerange_get_page_options('tr_header_builder_switcher') == 'eh')
		{
			themerange_get_header_content( $theme_options['tr_header_block'] );
		}
		
		//Theme Options
		elseif (themerange_get_theme_options('header_builder_switcher') == 'eh')
		{
			themerange_get_header_content( $theme_options['el_header_layout'] );
		}
		else if (themerange_get_theme_options('header_builder_switcher') == 'th')
		{
			themerange_get_header_template($theme_options['tr_header_layout']);
		}
	}
	?>
	
	<?php do_action('themerange_before_main_content'); ?>

	<!-- Main Body - Start -->
    <main class="page_content">
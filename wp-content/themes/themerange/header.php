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
    <!-- loading-area-start -->
	<div class="loader-wrap">
		<svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
			<path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
		</svg>
		<div class="loader-wrap-heading">
			<div class="load-text">
			<span>T</span>
			<span>H</span>
			<span>E</span>
			<span>M</span>
			<span>E</span>
			<span>R</span>
			<span>A</span>
			<span>N</span>
			<span>G</span>
			<span>E</span>
			</div>
		</div>
	</div>
	<!-- loading-area-end -->
 	<?php endif; ?>

	<?php
		// Check if a specific header block is set in page options
		if (!empty($page_options['tr_header_block'])) {
			themerange_get_header_content($page_options['tr_header_block']);
		}
		// Check if a specific header block is set in theme options
		else if (!empty($theme_options['el_header_block'])) {
			themerange_get_header_content($theme_options['el_header_block']);
		}
		// Include the default header if no specific header block is set
		else {
			require_once get_template_directory() . '/templates/header/header.php';
		}
	?>
    
	<?php do_action('themerange_before_main_content'); ?>

	<!-- Main Body - Start -->
    <main class="page_content">
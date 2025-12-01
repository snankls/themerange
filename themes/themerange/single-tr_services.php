<?php get_header();
$theme_options = themerange_get_theme_options();

$show_banner = $theme_options['tr_enable_services_banner'];
$layout_view = $theme_options['tr_services_layout'];
$background_image = $theme_options['tr_services_background_image']['url'];
$show_single_title = $theme_options['tr_services_title'];
$single_custom_name = !empty($theme_options['tr_services_custom_name']) ? $theme_options['tr_services_custom_name'] : get_the_title();
$single_breadcrumb = $theme_options['tr_enable_services_breadcrumb'];

themerange_single_banner($show_banner, $layout_view, $background_image, $show_single_title, $single_custom_name, $single_breadcrumb);
?>

<?php the_content(); ?>

<?php get_footer(); ?>
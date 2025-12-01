<?php
/* Template Name: Default Elementor Page */

get_header();
$page_options = themerange_get_page_options();

$extra_class = '';
$page_options['tr_show_page_breadcrumb'] = '';
$page_column_class = themerange_page_layout_columns_class($page_options['tr_page_layout']);

$show_banner = $page_options['tr_show_banner'];
$banner_layout = $page_options['tr_breadcrumb_layout'];
$bg_img = $page_options['tr_bg_breadcrumbs'];
$show_page_title = ( !is_home() && !is_front_page() && $page_options['tr_show_page_title'] );
$show_page_name = !empty($page_options['tr_show_page_name']) ? $page_options['tr_show_page_name'] : get_the_title();
$page_breadcrumb = $page_options['tr_show_breadcrumb'];
$parallex = false;
if( $show_banner || $show_page_title ){
	$extra_class = 'show_breadcrumb_'.themerange_get_theme_options('tr_breadcrumb_layout');
}

themerange_banner($show_banner, $banner_layout, $bg_img, $show_page_title, $show_page_name, $page_breadcrumb, $parallex, $extra_class);
?>

<!-- Sidebar Page Container -->
<div class="page-content">
	<?php while ( have_posts() ): the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>

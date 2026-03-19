<?php 
get_header();

$theme_options = themerange_get_theme_options();
$classes = array();
$classes[] = 'show_breadcrumb_' . $theme_options['tr_breadcrumb_layout'];

$show_banner = $theme_options['tr_enable_404_banner'];
$layout_view = $theme_options['tr_404_banner_layout'];
$background_image = $theme_options['tr_404_banner_background_image']['url'];
$show_single_title = $theme_options['tr_404_banner_title'];
$single_custom_name = !empty($theme_options['tr_404_banner_custom_name']) ? $theme_options['tr_404_banner_custom_name'] : get_the_title();
$single_breadcrumb = $theme_options['tr_enable_404_banner_breadcrumb'];

//404 Banner Title
if ( empty( $single_custom_name ) ) {
    $single_custom_name = __( 'Not Found', 'themerange' );
}

themerange_single_banner($show_banner, $layout_view, $background_image, $show_single_title, $single_custom_name, $single_breadcrumb);
?>

<!-- error area start -->
<div class="tp-error-area pt-190 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
            <div class="tp-error-wrapper text-center">
                <h4 class="tp-error-title"><?php esc_html_e( 'Oops!', 'themerange' ); ?></h4>
                <h1><?php esc_html_e( '404', 'themerange' ); ?></h1>
                <div class="tp-error-content">
                    <h4 class="tp-error-title-sm"><?php esc_html_e( 'Something went Wrong...', 'themerange' ); ?></h4>
                    <p><?php esc_html_e( '404', 'themerange' ); ?>Sorry, we couldn't find your page.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="tp-btn"><?php esc_html_e( 'Back to Home', 'themerange' ); ?></a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- error area end -->

<?php get_footer(); ?>
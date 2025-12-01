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

<!-- Error Section -->
<div class="error-section <?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="auto-container">
        <div class="content">
            <h1><?php echo wp_kses( $theme_options['tr_404_title'], true ) ? wp_kses( $theme_options['tr_404_title'], true ) : esc_html_e( '404', 'themerange' ); ?></h1>
            <h2><?php echo wp_kses( $theme_options['tr_404_text'], true ) ? wp_kses( $theme_options['tr_404_text'], true ) : esc_html_e( 'Oops... It looks like you ‘re lost !', 'themerange' ); ?></h2>
            <div class="text"><?php echo wp_kses( $theme_options['tr_404_description'], true ) ? wp_kses( $theme_options['tr_404_description'], true ) : esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'themerange' ); ?></div>
            
            <?php if ($theme_options['tr_enable_404_button']): ?>
            <!-- Button Box -->
            <div class="button-box text-center">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="theme-btn btn-style-<?php if($theme_options['tr_404_button_style']) echo esc_attr($theme_options['tr_404_button_style']); else echo 'three'; ?>">
                    <span class="btn-wrap">
                        <span class="text-one"><?php echo wp_kses( $theme_options['tr_404_button'], true ) ? wp_kses( $theme_options['tr_404_button'], true ) : esc_html_e( 'Back to Home Page', 'themerange' ); ?></span>
                        <span class="text-two"><?php echo wp_kses( $theme_options['tr_404_button'], true ) ? wp_kses( $theme_options['tr_404_button'], true ) : esc_html_e( 'Back to Home Page', 'themerange' ); ?></span>
                    </span>
                </a>
            </div> 
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Error Section -->

<?php get_footer(); ?>
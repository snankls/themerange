<?php 
get_header();
$theme_options = themerange_get_theme_options();
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
                    <p><?php esc_html_e( 'Sorry, we couldn\'t find your page.', 'themerange' ); ?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="tp-btn"><?php esc_html_e( 'Back to Home', 'themerange' ); ?></a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- error area end -->

<?php get_footer(); ?>
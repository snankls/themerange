<?php
/**
 * Blog Main File.
 *
 * @package TRANGE
 * @author  ThemeRange
 * @version 1.0
 */

get_header();
global $wp_query;
$data  = \TRANGE\Includes\Classes\Common::instance()->data( 'blog' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'right';
$sidebar = ( $sidebar ) ? $sidebar : 'default-sidebar';
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-lg-8 col-md-12 col-sm-12';
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
?>
	
<?php if ( class_exists( '\Elementor\Plugin' )):?>
	<?php do_action( 'trange_banner', $data );?>
<?php else: ?>
<!--Page Title-->
<section class="page-title">
    <div class="auto-container">
        <h1><?php echo esc_html_e( 'Blog', 'trange' ); ?></h1>
        <ul class="page-breadcrumb">
            <?php echo trange_the_breadcrumb(); ?>
        </ul>
    </div>
</section>
<!--End Page Title-->
<?php endif;?>

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

			<!--Sidebar Start-->
			<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'trange_sidebar', $data );
				}
			?>

			<div class="content-side <?php echo esc_attr( $class ); ?>">
				<div class="home-blogs">
					<div class="thm-unit-test">

						<?php
							while ( have_posts() ) :
								the_post();
								trange_template_load( 'templates/blog/blog.php', compact( 'data' ) );
							endwhile;
							wp_reset_postdata();
						?>

					</div>

					<!--Pagination-->
                    <div class="styled-pagination-two">
						<?php trange_the_pagination( $wp_query->max_num_pages ); ?>
                    </div>
				</div>        
			</div>

			<!--Sidebar Start-->
			<?php
				if ( $data->get( 'layout' ) == 'right' ) {
					do_action( 'trange_sidebar', $data );
				}
			?>

		</div>
	</div>
</div> 
<!--End blog area--> 
<?php
}
get_footer();

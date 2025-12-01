<?php get_header();
$page_options = themerange_get_page_options();

$extra_class = '';
$page_options['tr_show_page_breadcrumb'] = '';
$page_column_class = themerange_page_layout_columns_class($page_options['tr_page_layout']);

$show_banner = $page_options['tr_show_banner'];
$banner_layout = $page_options['tr_breadcrumb_layout'];
$bg_img = $page_options['tr_bg_breadcrumbs'];
$show_page_title = ( !is_home() && !is_front_page() && $page_options['tr_show_page_title'] );
$show_page_name = !empty($page_options['tr_show_page_name']) ? $page_options['tr_show_page_name'] : get_the_title();
$page_breadcrumb = !empty($page_options['tr_show_breadcrumb']) ? $page_options['tr_show_breadcrumb'] : '';
$parallex = false;
if( $show_banner || $show_page_title ){
	$extra_class = 'show_breadcrumb_'.themerange_get_theme_options('tr_breadcrumb_layout');
}

themerange_banner($show_banner, $banner_layout, $bg_img, $show_page_title, $show_page_name, $page_breadcrumb, $parallex, $extra_class);
?>

<!-- Sidebar Page Container -->
<div class="sidebar-page-container <?php echo esc_attr($extra_class) ?>">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Left Sidebar -->
            <?php if( $page_column_class['left_sidebar'] ): ?>
                <div id="left-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
                    <aside>
                    <?php if( is_active_sidebar($page_options['tr_left_sidebar']) ): ?>
                        <?php dynamic_sidebar($page_options['tr_left_sidebar']); ?>
                    <?php endif; ?>
                    </aside>
                </div>
            <?php endif; ?>
            
            <!-- Main Content -->
            <div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">
                <div id="primary" class="site-content">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="thm-unit-test">
                            <?php 
                                if( have_posts() ) the_post();
                                the_content();
                            ?>
                            <div class="clearfix"></div>
                            
                            <?php $defaults = array(
                                'before' => '<div class="paginate-links">' . esc_html__( 'Pages:', 'themerange' ),
                                'after'  => '</div>',
                            );
                            wp_link_pages( $defaults ); ?>
                            
                        </div>
                        <?php 
                        /* If comments are open or we have at least one comment, load up the comment template. */
                        if ( comments_open() || get_comments_number() ) :
                            comments_template( '', true );
                        endif;
                        ?>
                    </article>
                </div>
            </div>
            
            <!-- Right Sidebar -->
            <?php if( $page_column_class['right_sidebar'] ): ?>
                <div id="right-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
                    <aside>
                    <?php if( is_active_sidebar($page_options['tr_right_sidebar'])): ?>
                        <?php dynamic_sidebar($page_options['tr_right_sidebar']); ?>
                    <?php endif; ?>
                    </aside>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
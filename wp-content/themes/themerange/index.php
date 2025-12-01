<?php get_header();

$theme_options = themerange_get_theme_options();

$page_column_class = themerange_page_layout_columns_class($theme_options['tr_blog_layout'], $theme_options['tr_blog_left_sidebar'], $theme_options['tr_blog_right_sidebar']);

if( is_search() )
	themerange_banner(true, true, '', true, esc_html__( 'Search Results for: ', 'themerange' ) . get_search_query());
else
	themerange_banner(true, true, '', true, esc_html__( 'Our Blog ', 'themerange' ), true);
?>
<!-- Sidebar Page Container -->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Left Sidebar -->
            <?php if( $page_column_class['left_sidebar'] ): ?>
            <aside id="left-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
                <?php dynamic_sidebar( $theme_options['tr_blog_left_sidebar'] ); ?>
            </aside>
            <?php endif; ?>
            
            <div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
                <div id="primary" class="site-content">
                    <div class="thm-unit-test">
						<?php
                            if( have_posts() ):
                                echo '<div class="list-posts">';
                                while( have_posts() ) : the_post();
                                    get_template_part( 'content', get_post_format() ); 
                                endwhile;
                                wp_reset_postdata();
                                echo '</div>';
                            else:
                                echo '<div class="alert alert-error">';
                                    echo '<h3>'.esc_html__('Sorry. There are no posts to display!', 'themerange').'</h3>';
                                    echo '<p>'.esc_html__('Try researching for something else.', 'themerange').'</p>';
                                echo '</div>';
                                echo '<div class="search-wrapper">';
                                    get_search_form();
                                echo '</div>';
                            endif;
                            
                            themerange_pagination();
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- Right Sidebar -->
            <?php if( $page_column_class['right_sidebar'] ): ?>
            <aside id="right-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
                <?php dynamic_sidebar( $theme_options['tr_blog_right_sidebar'] ); ?>
            </aside>
            <?php endif; ?>
    	</div>
    </div>
</div>
<?php get_footer(); ?>
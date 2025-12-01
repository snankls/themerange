<?php
get_header();

$theme_options = themerange_get_theme_options();

$page_column_class = themerange_page_layout_columns_class( $theme_options['tr_blog_layout'], $theme_options['tr_blog_left_sidebar'], $theme_options['tr_blog_right_sidebar'] );

$show_banner = $theme_options['tr_enable_blog_banner'];
$show_page_title = $theme_options['tr_blog_title'];
$page_title = '';

if( $show_page_title ){
	switch( true ){
		case is_day():
			$page_title = esc_html__( 'Day: ', 'themerange' ) . get_the_date();
		break;
		case is_month():
			$page_title = esc_html__( 'Month: ', 'themerange' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'themerange' ) );
		break;
		case is_year():
			$page_title = esc_html__( 'Year: ', 'themerange' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'themerange' ) );
		break;
		case is_search():
			$page_title = esc_html__( 'Search Results for: ', 'themerange' ) . get_search_query();
		break;
		case is_tag():
			$page_title = esc_html__( 'Tag: ', 'themerange' ) . single_tag_title( '', false );
		break;
		case is_category():
			$page_title = esc_html__( 'Category: ', 'themerange' ) . single_cat_title( '', false );
		break;
		case is_404():
			$page_title = esc_html__( 'OOPS! FILE NOT FOUND', 'themerange' );
		break;
		default:
			$page_title = esc_html__( 'Archives', 'themerange' );
		break;
	}
}

$layout_view = $theme_options['tr_blog_banner_layout'];
$background_image = $theme_options['tr_blog_background_image']['url'];
$page_breadcrumb = $theme_options['tr_enable_blog_breadcrumb'];
$page_custom_name = !empty($theme_options['tr_blog_custom_name']) ? $theme_options['tr_blog_custom_name'] : $page_title;

themerange_single_banner($show_banner, $layout_view, $background_image, $page_title, $page_custom_name, $page_breadcrumb);
?>

<!-- Sidebar Page Container -->
<div class="sidebar-page-container page-template archive-template">
    <div class="auto-container">
        <div class="row clearfix">
	
            <!-- Left Sidebar -->
            <?php if( $page_column_class['left_sidebar'] ): ?>
                <div id="left-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
                    <aside>
                        <?php dynamic_sidebar( $theme_options['tr_blog_left_sidebar'] ); ?>
                    </aside>
                </div>
            <?php endif; ?>	
            
            <!-- Main Content -->
            <div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
                <div id="primary" class="site-content">
                
                    <?php	
                        if( have_posts() ):
                            echo '<div class="list-posts">';
                            while( have_posts() ) : the_post();
                                get_template_part( 'content', get_post_format() ); 
                            endwhile;
                            echo '</div>';
                        else:
                            echo '<div class="alert alert-error">'.esc_html__('Sorry. There are no posts to display', 'themerange').'</div>';
                        endif;
                        
                        themerange_pagination();
                    ?>
                    
                </div>
            </div>
            
            <!-- Right Sidebar -->
            <?php if( $page_column_class['right_sidebar'] ): ?>
                <div id="right-sidebar" class="tr-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
                    <aside>
                        <?php dynamic_sidebar( $theme_options['tr_blog_right_sidebar'] ); ?>
                    </aside>
                </div>
            <?php endif; ?>
		
        </div>
    </div>
</div>

<?php
get_footer();

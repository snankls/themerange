<?php
/**
 *	Template Name: Blog Template
 */	
get_header();

global $post;
setup_postdata($post);

$page_options = themerange_get_page_options();
$page_column_class = themerange_page_layout_columns_class( apply_filters('themerange_blog_page_layout', $page_options['tr_page_layout']) );

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
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Left Sidebar -->
            <?php if( $page_column_class['left_sidebar'] ): ?>
                <div id="left-sidebar" class="tr-sidebar sidebar-side <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
                	<aside class="sidebar sticky-top">
                    <?php if( is_active_sidebar($page_options['tr_left_sidebar']) ): ?>
                        <?php dynamic_sidebar( $page_options['tr_left_sidebar'] ); ?>
                    <?php endif; ?>
                    </aside>
                </div>
            <?php endif; ?>			
            
            <div id="main-content" class="content-side <?php echo esc_attr($page_column_class['main_class']); ?>">	
                <div id="primary" class="blog-classic">
                    
                    <?php if( get_the_content() ): ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php the_content(); ?>
                    </article>
                    <?php endif; ?>
                    
                    <?php $paged = 1;
                        if( is_paged() ){
                            $paged = get_query_var('page');
                            if( !$paged ){
                                $paged = get_query_var('paged');
                            }
                        }
                        
                        $args = array(
                            'post_type' => 'post',
                            'paged' => $paged,
                        );
                            
                        $args = apply_filters('themerange_blog_template_query_args', $args);
                        
                        $posts = new WP_Query( $args );
                        if( $posts->have_posts() ):
                            echo '<div class="list-posts">';
                            while( $posts->have_posts() ) : $posts->the_post();
                                
                                get_template_part( 'content', get_post_format() ); 
        
                            endwhile;
                            echo '</div>';
                            
                            wp_reset_postdata();
                        else:
                            echo '<div class="alert alert-error">'.esc_html__('Sorry. There are no posts to display', 'themerange').'</div>';
                        endif;
                        
                        themerange_blog_pagination($posts);
                    ?>
        
                </div>
            </div>
            
            <!-- Right Sidebar -->
            <?php if( $page_column_class['right_sidebar'] ): ?>
                <div id="left-sidebar" class="tr-sidebar sidebar-side <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
                	<aside class="sidebar sticky-top">
                    <?php if( is_active_sidebar($page_options['tr_right_sidebar']) ): ?>
                        <?php dynamic_sidebar( $page_options['tr_right_sidebar'] ); ?>
                    <?php endif; ?>
                    </aside>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div><!-- #container -->
<?php get_footer(); ?>
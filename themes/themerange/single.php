<?php 
get_header();

global $post;
setup_postdata($post);

$theme_options = themerange_get_theme_options();

$extra_classes = array();

$page_column_class = themerange_page_layout_columns_class($theme_options['tr_blog_details_layout'], $theme_options['tr_blog_details_left_sidebar'], $theme_options['tr_blog_details_right_sidebar']);

$show_banner = $theme_options['tr_enable_blog_detail_banner'];
$layout_view = $theme_options['tr_blog_detail_layout'];
$background_image = $theme_options['tr_blog_detail_background_image']['url'];
$show_single_title = $theme_options['tr_blog_detail_title'];
$single_custom_name = !empty($theme_options['tr_blog_detail_custom_name']) ? $theme_options['tr_blog_detail_custom_name'] : get_the_title();
$single_breadcrumb = $theme_options['tr_enable_blog_detail_breadcrumb'];

themerange_single_banner($show_banner, $layout_view, $background_image, $show_single_title, $single_custom_name, $single_breadcrumb);
if( $single_breadcrumb || $show_single_title ){
	$extra_classes[] = 'show_breadcrumb_'.$theme_options['tr_breadcrumb_layout'];
}
?>

<!-- Sidebar Page Container -->
<div class="sidebar-page-container <?php echo esc_attr(implode(' ', $extra_classes)) ?>">
    <div class="auto-container">
        <div class="row clearfix">
        
        	<!-- Left Sidebar -->
            <?php if( $page_column_class['left_sidebar'] ): ?>
            <div id="left-sidebar" class="sidebar-side tr-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
                <aside class="sidebar sticky-top">
                    <?php dynamic_sidebar( $theme_options['tr_blog_details_left_sidebar'] ); ?>
                </aside>
            </div>
            <?php endif; ?>	
            <!-- end left sidebar -->
            
            <!-- Content Side -->
            <div class="content-side <?php echo esc_attr($page_column_class['main_class']); ?>">
            	<?php global $post;
				while ( have_posts() ) : the_post(); ?>
                <div class="thm-unit-test">
                	<div class="blog-detail">
						<div class="blog-detail_inner">
                        	<?php if( $theme_options['tr_blog_details_thumbnail'] ): ?>
							<div class="blog-detail_image">
								<?php the_post_thumbnail('full'); ?>
							</div>
                            <?php endif; ?>
                            
							<div class="blog-detail_content">
								<div class="blog-detail_title">
									<?php if( $theme_options['tr_blog_details_categories'] ): ?><?php the_category(', '); ?><?php endif; ?>
                                    
                                    <?php if( $theme_options['tr_blog_details_date'] ): ?>
                                    <span><?php echo get_the_date('M d, Y'); ?></span>
                                    <?php endif; ?>
                                </div>
                                    
                                <?php if( $theme_options['tr_blog_details_title'] ) : ?>
                                <h4 class="blog-detail_heading"><?php the_title(); ?></h4>
                                <?php endif; ?>
                                
                                <?php if( $theme_options['tr_blog_details_author'] || $theme_options['tr_blog_details_comment'] ) : ?>
								<ul class="blog-detail_meta">
                                	<?php if( $theme_options['tr_blog_details_author'] ): ?>
                                    <li><span class="icon fa-regular fa-user fa-fw"></span><?php the_author_posts_link(); ?></li>
                                    <?php endif; ?>
									
                                    <?php if( $theme_options['tr_blog_details_comment'] ): ?>
                                    <li><a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>"><span class="icon fa-regular fa-comment fa-fw"></span><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a></li>
                                    <?php endif; ?>
								</ul>
                                <?php endif; ?>
								
                                <?php if( $theme_options['tr_blog_details_content'] ) : ?>
                                <?php the_content(); ?>
                                <div class="clearfix"></div>
                                <?php endif; ?>
                                
                                <?php if( $theme_options['tr_blog_details_tags'] || ( function_exists('tr_template_social_sharing') && $theme_options['tr_blog_details_sharing'] ) ): ?>
								<!-- Post Share Options-->
								<div class="post-share-options">
									<div class="post-share-inner d-flex justify-content-between flex-wrap">
                                    	<?php if( $theme_options['tr_blog_details_tags'] ): 
                                        $tags_title = isset($theme_options['tr_blog_details_tag_title']) ? $theme_options['tr_blog_details_tag_title'] : __('<span>Tags:</span>', 'themerange'); ?>
										<div class="post-tags"><?php echo tr_the_tags($tags_title); ?></div>
										<?php endif; ?>
                                        
                                        <?php if( function_exists('tr_template_social_sharing') && $theme_options['tr_blog_details_sharing'] ): ?>
                                       	<?php tr_template_social_sharing(); ?>
                                        <?php endif; ?>
									</div>
								</div>
                                <?php endif; ?>
							</div>
						</div>
                        
                        <?php if( $theme_options['tr_blog_details_author_box'] ) : ?>
                        <!-- Author Box -->
                        <div class="blog-author-post">
							<div class="blog-author-post_inner">
								<div class="blog-detail_author-image">
                                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), 150, 'mystery' ); ?>
                                </div>
                                <h5><?php the_author(); ?></h5> <?php echo themerange_get_user_role( get_the_author_meta('ID') ); ?>
                                <div class="text"><?php the_author_meta( 'description' ); ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
						<!-- Comment Form -->
						<div class="contact-form">	
							<?php if( $theme_options['tr_blog_details_comment_form'] && ( comments_open() || get_comments_number() ) ){
								comments_template( '', true );
							} ?>
						</div>
					</div>
                </div>
                <?php endwhile; ?>
            </div>
            
            <!-- Right Sidebar -->
            <?php if( $page_column_class['right_sidebar'] ): ?>
            <div id="right-sidebar" class="sidebar-side tr-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
                <aside class="sidebar sticky-top">
                    <?php dynamic_sidebar( $theme_options['tr_blog_details_right_sidebar'] ); ?>
                </aside>
            </div>
            <?php endif; ?>
            <!-- end right sidebar -->
            
        </div>
    </div>
</div>
<?php get_footer(); ?>
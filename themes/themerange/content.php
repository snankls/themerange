<?php global $post;
$theme_options = themerange_get_theme_options();
$post_format = get_post_format();
$post_class = array( 'news-block_two style-two' );
if( is_sticky() && !is_paged() ){
	$post_class[] = 'sticky';
}
?>

<!-- News Block One -->
<article <?php post_class($post_class) ?>>
    <div class="news-block_two style-two">
        <div class="news-block_two-inner">
            <?php if( $theme_options['tr_blog_thumbnail'] ){ ?>
            <div class="news-block_two-image">
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a>
            </div>
			<?php } ?>
            
            <div class="news-block_two-content">
                <div class="news-block_two-title"><?php the_category(', '); ?> <span><?php echo get_the_date('M d, y'); ?></span></div>
                <h4 class="news-block_two-heading"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <div class="news-block_two-lower">
                    <ul class="news-block_two-meta">
                        <?php if( $theme_options['tr_blog_author'] ): ?>
                        <li><span class="icon fa-regular fa-user fa-fw"></span><?php the_author_posts_link(); ?></li>
                        <?php endif; ?>
                        
                        <?php if( $theme_options['tr_blog_comment'] ): ?>
                        <li><span class="icon fa-regular fa-comment fa-fw"></span>
                            <a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>">
                                <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    
                    <?php if( $theme_options['tr_blog_excerpt'] ): ?>
                    <div class="news-block_two-text">
                        <?php the_excerpt();
                            wp_link_pages();
                        ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="d-flex justify-content-end">
                    	<a href="<?php the_permalink() ?>" class="news-block_two-moe"><?php echo wp_kses($theme_options['tr_blog_read_more_button'], true); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

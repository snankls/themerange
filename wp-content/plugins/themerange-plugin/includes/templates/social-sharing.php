<?php $tr_theme_options = themerange_get_theme_options();
	$sharing_title = isset($tr_theme_options['tr_blog_details_sharing_title']) ? $tr_theme_options['tr_blog_details_sharing_title'] : __('Share:', 'themerange');
	
	global $post;
	$PostID = get_the_id();
	$PostName = $post-> post_name;
?>

<ul class="social-links">
	<?php if( $tr_theme_options['tr_blog_facebook_sharing'] ) : ?>
    <li><a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink($PostID)); ?>" target="_blank" class="fa-brands fa-facebook-f fa-fw"></a></li>
    <?php endif; ?>
    
    <?php if( $tr_theme_options['tr_blog_twitter_sharing'] ) : ?>
    <li><a href="https://twitter.com/share?url=<?php echo esc_url(get_permalink($PostID)); ?>&text=<?php echo esc_attr($post_slug=$PostName); ?>" target="_blank" class="fa-brands fa-twitter fa-fw"></a></li>
    <?php endif; ?>
    
    <?php if( $tr_theme_options['tr_blog_linkedin_sharing'] ) : ?>
    <li><a href="http://www.linkedin.com/shareArticle?url=<?php echo esc_url(get_permalink($PostID)); ?>&title=<?php echo esc_attr($post_slug=$PostName); ?>" target="_blank" class="fa-brands fa fa-linkedin-in fa-fw"></a></li>
    <?php endif; ?>
    
    <?php if( $tr_theme_options['tr_blog_pinterest_sharing'] ) : ?>
    <li><a href="https://pinterest.com/pin/create/bookmarklet/?url=<?php echo esc_url(get_permalink($PostID)); ?>&description=<?php echo esc_attr($post_slug=$PostName); ?>" target="_blank" class="fa-brands fa fa-pinterest fa-fw"></a></li>
    <?php endif; ?>
    
    <?php if( $tr_theme_options['tr_blog_reddit_sharing'] ) : ?>
    <li><a href="http://reddit.com/submit?url=<?php echo esc_url(get_permalink($PostID)); ?>&title=<?php echo esc_attr($post_slug=$PostName); ?>" target="_blank" class="fa-brands fa fa-reddit fa-fw"></a></li>
    <?php endif; ?>
    
    <?php if( $tr_theme_options['tr_blog_tumblr_sharing'] ) : ?>
    <li><a href="http://www.tumblr.com/share/link?url=<?php echo esc_url(get_permalink($PostID)); ?>&name=<?php echo esc_attr($post_slug=$PostName); ?>" target="_blank" class="fa-brands fa fa-tumblr fa-fw"></a></li>
    <?php endif; ?>
    
    <?php if( $tr_theme_options['tr_blog_digg_sharing'] ) : ?>
    <li><a href="http://digg.com/submit?url=<?php echo esc_url(get_permalink($PostID)); ?>&title=<?php echo esc_attr($post_slug=$PostName); ?>" target="_blank" class="fa-brands fa fa-digg fa-fw"></a></li>
    <?php endif; ?>
</ul>

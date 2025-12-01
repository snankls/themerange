<?php
if (!function_exists('tr_get_blog_items_content')) {
    function tr_get_blog_items_content($atts = array(), $posts = null) {
        global $post;
        $allowed_html = tr_allowed_html();

        $is_ajax_frontend = wp_doing_ajax() && isset($_POST['action']) && $_POST['action'] == 'tr_blogs_load_items';
        if ($is_ajax_frontend) {
            if (!isset($_POST['atts'])) {
                die('0');
            }

            $atts = $_POST['atts'];
            $paged = isset($_POST['paged']) ? absint($_POST['paged']) : 1;

            extract($atts);

            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page' => $limit,
                'orderby' => $orderby,
                'order' => $order,
                'paged' => $paged,
                'tax_query' => array()
            );
			
			if (is_array($categories)) {
				$cat_list = implode(',', $categories);
			}
			
            if ($categories) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'category',
                    'terms' => explode(',', $cat_list),
                    'field' => 'slug',
                );
            }
			
            $posts = new WP_Query($args);
            ob_start();
        }

        extract($atts);
		
        if ($posts->have_posts()):
            if ($show_columns == '3column')
                $column_class = 'col-lg-4 col-md-6 col-sm-12';
            else if ($show_columns == '4column')
                $column_class = 'col-lg-3 col-md-6 col-sm-12';
            else if ($show_columns == '5column')
                $column_class = 'col-lg-5ths col-md-6 col-sm-12';
            else if ($show_columns == '6column')
                $column_class = 'col-lg-2 col-md-6 col-sm-12';
            else
                $column_class = 'col-lg-6 col-md-6 col-sm-12';

            $custom_date_format = empty($custom_date_format) ? 'F j, Y' : $custom_date_format;
            $format_options = [
                'default' => 'F j, Y',
                '0' => 'F j, Y',
                '1' => 'Y-m-d',
                '2' => 'm/d/Y',
                '3' => 'd/m/Y',
                'custom' => $custom_date_format,
            ];
			
            while ($posts->have_posts()): $posts->the_post(); ?>
                <div class="news-block_two <?php echo esc_attr($column_class); ?>">
                    <div class="news-block_two-inner">
                        <?php if ($show_thumbnail): ?>
                            <div class="news-block_two-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('news_570x370'); ?></a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="news-block_two-content">
                            <?php if ($show_category or $show_date): ?>
                                <div class="news-block_two-title">
                                    <?php if ($show_category): the_category(', '); endif; ?>
                                    <?php if ($show_date): ?>
                                        <span><?php echo get_the_time($format_options[$date_format]); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($show_title): ?>
                                <h4 class="news-block_two-heading">
                                    <?php if ($show_link): ?>
                                        <a href="<?php the_permalink(); ?>">
                                    <?php endif; ?>
                                    <?php echo get_the_title(); ?>
                                    <?php if ($show_link): ?>
                                        </a>
                                    <?php endif; ?>
                                </h4>
                            <?php endif; ?>
                            
                            <?php if ($show_excerpt): ?>
                            <div class="news-block_two-text">
                            	<?php themerange_the_excerpt_max_words($excerpt_words, '', true, '...', true); ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="news-block_two-lower d-flex justify-content-between flex-wrap">
                                <ul class="news-block_two-meta">
                                    <?php if ($show_author): ?>
                                        <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><?php the_author(); ?></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if ($show_comment): ?>
                                        <li><a href="<?php echo esc_url(get_permalink($post->ID) . '#comments'); ?>"><?php comments_number('0 comments', '1 comment', '% comments'); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                                
                                <?php if ($show_readmore): ?>
                                    <a href="<?php the_permalink(); ?>" class="news-block_two-more"><?php echo wp_kses($btn_name, $allowed_html); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        endif;

        wp_reset_postdata();

        if ($is_ajax_frontend) {
            die(ob_get_clean());
        }
    }
	
	add_action('wp_ajax_tr_blogs_load_items', 'tr_get_blog_items_content');
    add_action('wp_ajax_nopriv_tr_blogs_load_items', 'tr_get_blog_items_content');
}

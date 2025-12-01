<?php
add_action('widgets_init', 'tr_blogs_load_widgets');

function tr_blogs_load_widgets()
{
	register_widget('TR_Blogs_Widget');
}

if( !class_exists('TR_Blogs_Widget') ){
	class TR_Blogs_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'tr-blogs-widget', 'description' => esc_html__('Display news on site', 'themerange'));
			parent::__construct('tr_blogs', esc_html__('TR - News', 'themerange'), $widgetOps);
		}

		function widget( $args, $instance ) {
			extract($args);
			$defaults = $this->get_default_values();
			$instance = wp_parse_args( $instance, $defaults );
			extract( $instance );
			$title = apply_filters('widget_title', $title);
			
			$args = array(
				'post_type'				=> 'post',
				'ignore_sticky_posts'	=> 1,
				'post_status'			=> 'publish',
				'posts_per_page'		=> $limit,
				'order'					=> $order,
				'orderby'				=> $orderby,
			);
			
			if( is_array($categories) && count($categories) > 0 ){
				$args['category__in'] = $categories;
			}
			
			global $post;
			$posts = new WP_Query($args);
			if( $posts->have_posts() ):
				$num_posts = $posts->post_count;
				echo $before_widget;
				
				if( $title ){
					echo $before_title . $title . $after_title;
				}
				?>
                <div class="post-widget">
                    <div class="content">
                        <?php while( $posts->have_posts() ): 
                        $posts->the_post(); ?>
                            <div class="post">
                                <?php if( $show_thumbnail ): ?>
                                <div class="thumb">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('news_86x86'); ?></a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if( $show_title ): ?>
                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                <?php endif; ?>
                                
                                <?php if( $show_excerpt && function_exists('themerange_the_excerpt_max_words') ): ?>
                                <div class="excerpt">
                                    <?php themerange_the_excerpt_max_words($excerpt_words, $post); ?>
                                </div>
                                <?php endif; ?>
                                
                                <?php if( $show_date ): ?>
                                <div class="post-date"><?php the_time( get_option('date_format') ); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
				</div>
				
				<?php
				echo $after_widget;
			endif;
			
			wp_reset_postdata();
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 				= strip_tags($new_instance['title']);
			$instance['limit'] 				= absint($new_instance['limit']);
			$instance['order'] 				= $new_instance['order'];
			$instance['orderby'] 			= $new_instance['orderby'];
			$instance['categories'] 		= isset($new_instance['categories']) ? $new_instance['categories'] : array();
			$instance['show_thumbnail'] 	= empty($new_instance['show_thumbnail']) ? 0 : 1;
			$instance['show_title'] 		= empty($new_instance['show_title']) ? 0 : 1;
			$instance['show_date'] 			= empty($new_instance['show_date']) ? 0 : 1;
			$instance['show_excerpt'] 		= empty($new_instance['show_excerpt']) ? 0 : 1;
			$instance['excerpt_words'] 		= absint($new_instance['excerpt_words']);
			
			if( $instance['row'] > $instance['limit'] ){
				$instance['row'] = $instance['limit'];
			}
			return $instance;
		}

		function get_default_values(){
			return array(
				'title' 			=> 'Recent Post',
				'limit'				=> 3,
				'order'				=> 'desc',
				'orderby'			=> 'date',
				'categories'		=> array(),
				'show_thumbnail' 	=> 1,
				'show_title' 		=> 1,
				'show_date' 		=> 1,
				'show_excerpt'		=> 0,
				'excerpt_words'		=> 8,
			);
		}
		
		function form( $instance ) {
			
			$defaults = $this->get_default_values();
			$instance = wp_parse_args( (array) $instance, $defaults );	
			
			$categories = $this->get_list_categories(0);
			if( !is_array($instance['categories']) ){
				$instance['categories'] = array();
			}
			
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'themerange'); ?> </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_html_e('Number of posts', 'themerange'); ?> </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="number" min="0" value="<?php echo esc_attr($instance['limit']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order by', 'themerange'); ?> </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
                <option value="none" <?php selected('none', $instance['orderby']); ?>><?php esc_html_e('None', 'themerange'); ?></option>
                <option value="ID" <?php selected('ID', $instance['orderby']); ?>><?php esc_html_e('ID', 'themerange'); ?></option>
                <option value="title" <?php selected('title', $instance['orderby']); ?>><?php esc_html_e('Title', 'themerange'); ?></option>
                <option value="date" <?php selected('date', $instance['orderby']); ?>><?php esc_html_e('Date', 'themerange'); ?></option>
                <option value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>><?php esc_html_e('Comment count', 'themerange'); ?></option>
                <option value="rand" <?php selected('rand', $instance['orderby']); ?>><?php esc_html_e('Random', 'themerange'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Order', 'themerange'); ?> </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('order')); ?>" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
                <option value="asc" <?php selected('asc', $instance['order']); ?>><?php esc_html_e('Ascending', 'themerange'); ?></option>
                <option value="desc" <?php selected('desc', $instance['order']); ?>><?php esc_html_e('Descending', 'themerange'); ?></option>
            </select>
        </p>
        <p>
            <label><?php esc_html_e('Select categories', 'themerange'); ?></label>
            <div class="categorydiv">
                <div class="tabs-panel">
                    <ul class="categorychecklist">
                        <?php foreach($categories as $cat){ ?>
                        <li>
                            <label>
                                <input type="checkbox" name="<?php echo esc_attr($this->get_field_name('categories')); ?>[<?php esc_attr($cat->term_id); ?>]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id,$instance['categories']))?'checked':''; ?> />
                                <?php echo esc_html($cat->name); ?>
                            </label>
                            <?php $this->get_list_sub_categories($cat->term_id, $instance); ?>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </p>
        <p>
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>" name="<?php echo esc_attr($this->get_field_name('show_thumbnail')); ?>" value="1" <?php echo ($instance['show_thumbnail'])?'checked':''; ?> />
            <label for="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>"><?php esc_html_e('Show Post Thumbnail', 'themerange'); ?></label>
        </p>
        <p>
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_title')); ?>" name="<?php echo esc_attr($this->get_field_name('show_title')); ?>" value="1" <?php echo ($instance['show_title'])?'checked':''; ?> />
            <label for="<?php echo esc_attr($this->get_field_id('show_title')); ?>"><?php esc_html_e('Show Post Title', 'themerange'); ?></label>
        </p>
        <p>
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" value="1" <?php echo ($instance['show_date'])?'checked':''; ?> />
            <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e('Show Post Date', 'themerange'); ?></label>
        </p>
        <p>
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_excerpt')); ?>" name="<?php echo esc_attr($this->get_field_name('show_excerpt')); ?>" value="1" <?php echo ($instance['show_excerpt'])?'checked':''; ?> />
            <label for="<?php echo esc_attr($this->get_field_id('show_excerpt')); ?>"><?php esc_html_e('Show Post Excerpt', 'themerange'); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('excerpt_words')); ?>"><?php esc_html_e('Number of words in excerpt', 'themerange'); ?> </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('excerpt_words')); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_words')); ?>" type="number" min="0" value="<?php echo esc_attr($instance['excerpt_words']); ?>" />
        </p>
        
        <?php 
		}
		
		function get_list_categories( $cat_parent_id ){
			$args = array(
				'hierarchical'		=> 1,
				'parent'			=> $cat_parent_id,
				'title_li'			=> '',
				'child_of'			=> 0,
			);
			$cats = get_categories($args);
			return $cats;
		}
		
		function get_list_sub_categories( $cat_parent_id, $instance ){
			$sub_categories = $this->get_list_categories($cat_parent_id); 
			if( count($sub_categories) > 0){
			?>
				<ul class="children">
					<?php foreach( $sub_categories as $sub_cat ){ ?>
						<li>
							<label>
								<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('categories')); ?>[<?php esc_attr($sub_cat->term_id); ?>]" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id,$instance['categories']))?'checked':''; ?> />
								<?php echo esc_html($sub_cat->name); ?>
							</label>
							<?php $this->get_list_sub_categories($sub_cat->term_id, $instance); ?>
						</li>
					<?php } ?>
				</ul>
			<?php }
		}	
	}
}

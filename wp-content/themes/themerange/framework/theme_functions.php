<?php 
function themerange_get_loading_screen_image(){
	$tr_theme_options = themerange_get_theme_options();
	$loading_image = $tr_theme_options['tr_custom_loading_image']['url'];
	if( !$loading_image ){
		$loading_image = get_template_directory_uri() . '/admin/assets/images/preloader/loading_' . $tr_theme_options['tr_loading_image'] . '.svg';
	}
	return $loading_image;
}

function themerange_get_last_save_theme_options(){
	$transients = get_option('themerange_theme_options-transients', array());
	if( isset($transients['last_save']) ){
		return $transients['last_save'];
	}
	return time();
}

/*** Register Back End Scripts ***/
function themerange_register_admin_scripts(){
	$theme_version = themerange_get_theme_version();
	
	wp_enqueue_media();
	
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), $theme_version );
	wp_enqueue_style( 'themerange-admin-style', get_template_directory_uri() . '/admin/assets/css/admin_style.css', array(), $theme_version );
	wp_enqueue_script( 'themerange-admin-script', get_template_directory_uri() . '/admin/assets/js/admin_main.js', array('jquery'), $theme_version, true );
	
	$admin_texts = array(
		'select_images' 			=> esc_html__('Select Images', 'themerange'),
		'use_images' 				=> esc_html__('Use images', 'themerange'),
		'choose_an_image' 			=> esc_html__('Choose an image', 'themerange'),
		'use_image' 				=> esc_html__('Use image', 'themerange'),
		'delete_sidebar_confirm' 	=> esc_html__('Do you want to delete this sidebar?', 'themerange'),
		'delete_sidebar_failed' 	=> esc_html__('Cant delete the sidebar. Please try again!', 'themerange')
	);
	wp_localize_script('themerange-admin-script', 'themerange_admin_texts', $admin_texts);
}
add_action('admin_enqueue_scripts', 'themerange_register_admin_scripts');

/*** Global Page Options ***/
if( !function_exists('themerange_set_global_page_options') ){
	function themerange_set_global_page_options( $page_id = 0 ){
		global $themerange_page_options;
		$post_custom = get_post_custom( $page_id );
		if( !is_array($post_custom) ){
			$post_custom = array();
		}
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$themerange_page_options[$key] = $value[0];
			}
		}
		
		$default_options = array(
			'tr_layout_fullwidth'					=> 'default',
			'tr_header_layout_fullwidth'			=> 1,
			'tr_main_content_layout_fullwidth'		=> 1,
			'tr_layout_style'						=> 'default',
			'tr_page_layout'						=> '0-1-0',
			'tr_left_sidebar'						=> '',
			'tr_right_sidebar'						=> '',
			'tr_header_layout'						=> 'default',
			'tr_header_transparent'					=> 0,
			'tr_header_text_color'					=> 'default',
			'tr_menu_id'							=> 0,
			'tr_vertical_menu_id'					=> 0,
			'tr_display_vertical_menu_by_default'	=> 0,
			'tr_breadcrumb_layout'					=> 'default',
			'tr_bg_parallax'						=> 'default',
			'tr_bg_breadcrumbs'						=> '',
			'tr_logo'								=> '',
			'tr_logo_mobile'						=> '',
			'tr_logo_sticky'						=> '',
			'tr_show_banner'						=> 1,
			'tr_show_page_title'					=> 1,
			'tr_page_slider'						=> 0,
			'tr_page_slider_position'				=> 'before_main_content',
			'tr_rev_slider'							=> 0,
			'header_block'							=> 0,
			'footer_block'							=> 0,
		);
		$themerange_page_options = array_merge($default_options, (array) $themerange_page_options);
		return $themerange_page_options;
	}
}

if( !function_exists('themerange_get_page_options') ){
	function themerange_get_page_options( $key = '', $default = '' ){
		global $themerange_page_options;
		if( !$key ){
			return $themerange_page_options;
		}
		else if( isset($themerange_page_options[$key]) ){
			return $themerange_page_options[$key];
		}
		else{
			return $default;
		}
	}
}

/*** Vertical Menu Heading ***/
if( !function_exists ('themerange_get_vertical_menu_heading') ){
	function themerange_get_vertical_menu_heading(){
		if( is_page() ){
			global $post;

			$menu_id = get_post_meta( $post->ID, 'tr_vertical_menu_id', true );
			
			if( $menu_id ){
				$menu = wp_get_nav_menu_object( $menu_id );
				
				if( isset( $menu->name ) ){
					return $menu->name;
				}
			}
		}

		$locations = get_nav_menu_locations();
		if( isset($locations['vertical']) ){
			$menu = wp_get_nav_menu_object($locations['vertical']);
			if( isset( $menu->name ) ){
				return $menu->name;
			}
		}

		return esc_html__('Shop by category', 'themerange');
	}
}

/*** Top Header Menu ***/
if( !function_exists('themerange_top_header_menu') ){
	function themerange_top_header_menu(){
		if( has_nav_menu( 'top_header' ) ){
			do_action('themerange_before_top_header_menu');
			wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'top-header-menu', 'theme_location' => 'top_header', 'depth' => 1 ) );
			do_action('themerange_after_top_header_menu');
		}
	}
}

/*** Get excerpt ***/
if( !function_exists ('themerange_string_limit_words') ){
	function themerange_string_limit_words($string, $word_limit){
		$words = explode(' ', $string, ($word_limit + 1));
		if( count($words) > $word_limit ){
			array_pop($words);
		}
		return implode(' ', $words);
	}
}

if( !function_exists ('themerange_the_excerpt_max_words') ){
	function themerange_the_excerpt_max_words( $word_limit = -1, $post = '', $strip_tags = true, $extra_str = '', $echo = true ) {
		if( $post ){
			$excerpt = themerange_get_the_excerpt_by_id($post->ID);
		}
		else{
			$excerpt = get_the_excerpt();
		}
			
		if( !is_array($strip_tags) && $strip_tags ){
			$excerpt = wp_strip_all_tags($excerpt);
			$excerpt = strip_shortcodes($excerpt);
		}
		
		if( is_array($strip_tags) ){
			$excerpt = wp_kses($excerpt, $strip_tags); // allow, not strip
		}
			
		if( $word_limit != -1 ){
			$result = themerange_string_limit_words($excerpt, $word_limit);
			if( $result != $excerpt ){
				$result .= $extra_str;
			}
		}	
		else{
			$result = $excerpt;
		}
			
		if( $echo ){
			echo do_shortcode($result);
		}
		
		return $result;
	}
}

if( !function_exists('themerange_get_the_excerpt_by_id') ){
	function themerange_get_the_excerpt_by_id( $post_id = 0 )
	{
		global $wpdb;
		$query = "SELECT post_excerpt, post_content FROM $wpdb->posts WHERE ID = %d LIMIT 1";
		$result = $wpdb->get_results( $wpdb->prepare($query, $post_id), ARRAY_A );
		if( $result[0]['post_excerpt'] ){
			return $result[0]['post_excerpt'];
		}
		else{
			$content = $result[0]['post_content'];
			if( false !== strpos( $content, '<!--nextpage-->' ) ){
				$pages = explode( '<!--nextpage-->', $content );
				return $pages[0];
			}
			return $content;
		}
	}
}

/* Get User Role */
if( !function_exists('themerange_get_user_role') ){
	function themerange_get_user_role( $user_id ){
		global $wpdb;
		$user = get_userdata( $user_id );
		$capabilities = $user->{$wpdb->prefix . 'capabilities'};
		if( empty($capabilities) ){
			return '';
		}
		if ( !isset( $wp_roles ) ){
			$wp_roles = new WP_Roles();
		}
		foreach ( $wp_roles->role_names as $role => $name ) {
			if ( array_key_exists( $role, $capabilities ) ) {
				return $role;
			}
		}
		return '';
	}
}

/*** Page Layout Columns Class ***/
if( !function_exists('themerange_page_layout_columns_class') ){
	function themerange_page_layout_columns_class($page_column, $left_sidebar_name = '', $right_sidebar_name = ''){
		$data = array();
		
		if( empty($page_column) ){
			$page_column = '0-1-0';
		}
		
		$layout_config = explode('-', $page_column);
		$left_sidebar = (int)$layout_config[0];
		$right_sidebar = (int)$layout_config[2];
		
		if( $left_sidebar_name && !is_active_sidebar( $left_sidebar_name ) ){
			$left_sidebar = 0;
		}
		
		if( $right_sidebar_name && !is_active_sidebar( $right_sidebar_name ) ){
			$right_sidebar = 0;
		}
		
		$main_class = ($left_sidebar + $right_sidebar) == 2 ? 'col-lg-4 col-md-12 col-sm-12' : ( ($left_sidebar + $right_sidebar) == 1 ? 'col-lg-8 col-md-12 col-sm-12' : 'col-lg-12 col-md-12 col-sm-12' );			
		
		$data['left_sidebar'] = $left_sidebar;
		$data['right_sidebar'] = $right_sidebar;
		$data['main_class'] = $main_class;
		$data['left_sidebar_class'] = 'col-lg-4 col-md-12 col-sm-12';
		$data['right_sidebar_class'] = 'col-lg-4 col-md-12 col-sm-12';
		
		return $data;
	}
}

/*** Get Portfolio Page Info ***/
function themerange_get_gallery_page_info( $return_url = false ){
	$page_id = themerange_get_theme_options('tr_gallery_page');
	if( $page_id ){
		if( $return_url ){
			return get_permalink($page_id);
		}
		else{
			$page = get_post( $page_id );
			if( $page ){
				return array( 'title' => $page->post_title, 'url' => get_permalink($page_id) );
			}
		}
	}
	return '';
}

/*** Breadcrumbs ***/
if( !function_exists('themerange_breadcrumbs') ){
	function themerange_breadcrumbs(){
		$delimiter_char = "::";
		
		$allowed_html = array(
			'a'		=> array('href' => array(), 'title' => array()),
			'span'	=> array('class' => array()),
			'div'	=> array('class' => array()),
		);
		$output = '';

		$delimiter = '<span class="brn_arrow">'.$delimiter_char.'</span>';
		
		$ar_title = array(
			'home'		=> __('Home', 'themerange'),
			'search' 	=> __('Search results for ', 'themerange'),
			'404' 		=> __('Error 404', 'themerange'),
			'tagged' 	=> __('Tagged ', 'themerange'),
			'author' 	=> __('Articles posted by ', 'themerange'),
			'page' 		=> __('Page', 'themerange'),
		);
	  
		$before = '<span class="current">'; /* tag before the current crumb */
		$after = '</span>'; /* tag after the current crumb */
		global $wp_rewrite, $post;
		$rewriteUrl = $wp_rewrite->using_permalinks();
		if( !is_home() && !is_front_page() || is_paged() ){
			$output .= '<div class="bread-crumb clearfix">';
	 
			$homeLink = esc_url( home_url('/') ); 
			$output .= '<a href="' . $homeLink . '">' . $ar_title['home'] . '</a> ' . $delimiter . ' ';
	 
			if( is_category() ){
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if( $thisCat->parent != 0 ){ 
					$output .= get_category_parents($parentCat, true, ' ' . $delimiter . ' ');
				}
				$output .= $before . single_cat_title('', false) . $after;
			}
			elseif( is_search() ){
				$output .= $before . $ar_title['search'] . '"' . get_search_query() . '"' . $after;
			}elseif( is_day() ){
				$output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				$output .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				$output .= $before . get_the_time('d') . $after;
			}elseif( is_month() ){
				$output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				$output .= $before . get_the_time('F') . $after;
			}elseif( is_year() ){
				$output .= $before . get_the_time('Y') . $after;
			}elseif( is_single() && !is_attachment() ){
				if( get_post_type() != 'post' ){
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$post_type_name = $post_type->labels->singular_name;
					if( is_singular('ts_portfolio') ){
						$portfolio_page_info = themerange_get_portfolio_page_info();
						if( $portfolio_page_info ){
							$post_type_name = $portfolio_page_info['title'];
							$portfolio_url = $portfolio_page_info['url'];
						}
					}
					if( $rewriteUrl ){
						$output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . $slug['slug'] . '/') . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}else{
						$output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . '?post_type=' . get_post_type()) . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}
					$output .= $before . get_the_title() . $after;
			    }else{
					$cat = get_the_category(); $cat = $cat[0];
					$output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
					$output .= $before . get_the_title() . $after;
			    }
			}elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
				$post_type = get_post_type_object(get_post_type());
				
				$slug = $post_type->rewrite;
				$post_type_name = $post_type->labels->singular_name;
			    if( isset($slug['slug']) && $slug['slug'] == 'portfolio' ){
					$portfolio_page_info = themerange_get_portfolio_page_info();
					if( $portfolio_page_info ){
						$post_type_name = $portfolio_page_info['title'];
						$portfolio_url = $portfolio_page_info['url'];
					}
			    }
				if( is_tag() ){
					$output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
				}
				elseif( is_taxonomy_hierarchical(get_query_var('taxonomy')) ){
					if( $rewriteUrl ){
						$output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . $slug['slug'] . '/') . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}else{
						$output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . '?post_type=' . get_post_type()) . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}			
					
					$curTaxanomy = get_query_var('taxonomy');
					$curTerm = get_query_var( 'term' );
					$termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
					$pushPrintArr = array();
					if( $termNow !== false ){
						while( (int)$termNow->parent != 0 ){
							$parentTerm = get_term((int)$termNow->parent,get_query_var('taxonomy'));
							array_push($pushPrintArr,'<a href="' . get_term_link((int)$parentTerm->term_id,$curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
							$curTerm = $parentTerm->name;
							$termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
						}
					}
					$pushPrintArr = array_reverse($pushPrintArr);
					array_push($pushPrintArr,$before  . get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->name  . $after);
					$output .= implode($pushPrintArr);
				}else{
					$output .= $before . $post_type_name . $after;
				}
			}elseif( is_attachment() ){
				if( (int)$post->post_parent > 0 ){
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID);
					if( count($cat) > 0 ){
						$cat = $cat[0];
						$output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
					}
					$output .= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				}
				$output .= $before . get_the_title() . $after;
			}elseif( is_page() && !$post->post_parent ){
				$output .= $before . get_the_title() . $after;
			}elseif( is_page() && $post->post_parent ){
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while( $parent_id ){
					$page = get_post($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
			    }
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach( $breadcrumbs as $crumb ){
					$output .= $crumb . ' ' . $delimiter . ' ';
				}
				$output .= $before . get_the_title() . $after;
			}elseif( is_tag() ){
				$output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
			}elseif( is_author() ){
				global $author;
				$userdata = get_userdata($author);
				$output .= $before . $ar_title['author'] . $userdata->display_name . $after;
			}elseif( is_404() ){
				$output .= $before . $ar_title['404'] . $after;
			}
			if( get_query_var('paged') || get_query_var('page') ){
				if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
					$output .= $before .' ('; 
				}
				$output .= $ar_title['page'] . ' ' . ( get_query_var('paged')?get_query_var('paged'):get_query_var('page') );
				if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
					$output .= ')'. $after; 
				}
			}
			$output .= '</div>';
	    }
		
		echo wp_kses($output, $allowed_html);
		
		wp_reset_postdata();
	}
}

if( !function_exists('themerange_banner') ){
	function themerange_banner( $show_banner = false, $layout_view = false, $background_image = false, $show_page_title = false, $page_title = '', $page_breadcrumb = false, $parallex = '', $extra_class = 'class="page_title mb-0 text-white"'){
		$tr_theme_options = themerange_get_theme_options();
		if( $show_banner )
		{
			$bg_url = $tr_theme_options['tr_bg_breadcrumbs']['url'];
			$breadcrumb_bg_option = !empty($bg_url) ? $bg_url : $background_image;
			$breadcrumb_bg = '';
			$classes = array();
				
			$classes[] = 'page-title breadcrumb-' . $tr_theme_options['tr_breadcrumb_layout'];
			$classes[] = $show_banner?'':'no-breadcrumb';
			$classes[] = $show_page_title?'':'no-title';
			
			//if( $breadcrumb_bg_option == '' )
				$breadcrumb_bg = get_template_directory_uri() . '/assets/images/background/page-banner.svg';
			// else
			// 	$breadcrumb_bg = $breadcrumb_bg_option;
					
			// $style = '';
			// if( $breadcrumb_bg != '' ){
			// 	$parallex = ($tr_theme_options['tr_bg_parallax'] != 0) ? $tr_theme_options['tr_bg_parallax'] : $parallex;
			// 	$style = 'style="background-image: url('. esc_url($breadcrumb_bg) .')"';
			// 	if( $parallex ){
			// 		$classes[] = 'tr-breadcrumb-parallax';
			// 	}
			// }
			
			if( $show_page_title ){
				$page_title = '<h1 class="page_title mt-0 mb-0 text-white">' . $page_title . '</h1>';
			}
			
			echo '<section class="page_banner_section text-center '.esc_attr(implode(' ', array_filter($classes))).'" style="background-image: url('. esc_url($breadcrumb_bg) .')">
				<div class="container">
					<div class="heading_focus_text text-white"><span class="badge bg-secondary">ThemeRange</span> 😍</div>
					'.$page_title;
				
				$page_breadcrumb = ($tr_theme_options['tr_enable_breadcrumb'] == 1) ? $tr_theme_options['tr_enable_breadcrumb'] : $page_breadcrumb;
				if( $page_breadcrumb ){
					themerange_breadcrumbs();
				}
			echo '</div>
			</section>';
		}
	}
}

//Single Page Banner
if( !function_exists('themerange_single_banner') ){
	function themerange_single_banner($show_banner = '', $background_image = '', $show_single_title = '', $single_custom_name = '', $single_breadcrumb = '', $parallex = '', $extra_class = ''){
			
		$tr_theme_options = themerange_get_theme_options();
		if( $show_banner ){
			$breadcrumb_bg_option = !empty($background_image)?$background_image:$background_image;
			$breadcrumb_bg = '';
			
			$classes = array();
			$classes[] = 'page_banner_section text-center';
			$classes[] = $show_banner?'':'no-breadcrumb';
			$classes[] = $show_single_title?'':'no-title';
			
			if( $breadcrumb_bg_option == '' )
				$breadcrumb_bg = get_template_directory_uri() . '/assets/images/breadcrumbs/breadcrumb.svg';
			else
				$breadcrumb_bg = $breadcrumb_bg_option;
			
			$style = '';
			if( $breadcrumb_bg != '' ){
				$parallex = ($tr_theme_options['tr_bg_parallax'] != 0) ? $tr_theme_options['tr_bg_parallax'] : $parallex;
				$style = 'style="background-image: url('. esc_url($breadcrumb_bg) .')"';
				if( $parallex ){
					$classes[] = 'tr-breadcrumb-parallax';
				}
			}
			
			echo '<section class="'.esc_attr(implode(' ', array_filter($classes))).'" '.$style.'>
				<div class="container">';
				
				if( $show_single_title ){
					echo '<h1 class="page_title mb-0 text-white">'.$single_custom_name.'</h1>';
				}
				
				$page_breadcrumb = ($tr_theme_options['tr_enable_breadcrumb'] != 0) ? $tr_theme_options['tr_enable_breadcrumb'] : $page_breadcrumb;
				if( $single_breadcrumb ){
					themerange_breadcrumbs();
				}
				
				echo '</div>
			</section>';
		}
	}
}

/*** Pagination ***/
if( !function_exists('themerange_blog_pagination') ){
	function themerange_blog_pagination( $query = null, $args = array() ){
		global $wp_query;
		
		$allowed_html = array(
			'ul' => array(
				'class' => array()
			),
			'ol' => array(
				'class' => array()
			),
			'li'=> array(
				'class' => array()
			),
			'a'=> array(
				'class' => array()
			),
			'i'=> array(
				'class' => array()
			),
			'span'=> array(
				'class' => array()
			),
		);

		$default_args = array(
			'format'		=> '',
			'add_args'		=> false,
			'prev_text'		=> '<span class="fa fa-angle-double-left"></span>',
			'next_text'		=> '<span class="fa fa-angle-double-right"></span>',
			'end_size'		=> 3,
			'mid_size'		=> 3,
			'prev_next'		=> true,
			'paged'			=> '',
		);

		$args = wp_parse_args( $args, $default_args );

		$max_num_pages = $wp_query->max_num_pages;
		$paged = $wp_query->get( 'paged' );
		if( $query != null ){
			$max_num_pages = $query->max_num_pages;
			$paged = $query->get( 'paged' );
		}
		if( !$paged ){
			$paged = 1;
		}
		?>
		<nav class="ts-pagination">
			<?php
			$pagination = paginate_links( array(
				'base'			=> esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
				'format'		=> $args['format'],
				'add_args'		=> $args['add_args'],
				'current'		=> $args['paged'] ? $args['paged'] : max( 1, $paged ) ,
				'total'			=> $max_num_pages,
				'prev_text'		=> $args['prev_text'],
				'next_text'		=> $args['next_text'],
				'type'			=> 'list',
				'end_size'		=> $args['end_size'],
				'mid_size'		=> $args['mid_size'],
				'prev_next'		=> $args['prev_next'],
			) );
			$pagination = str_replace("<ul class='page-numbers'>", '<ul class="styled-pagination text-center">', $pagination);
			
			echo wp_kses($pagination, $allowed_html);
			?>
		</nav>
		<?php
	}
}

/*** Pagination ***/
if( !function_exists('themerange_pagination') ){
	function themerange_pagination(){
		global $wp_query;
		
		$allowed_html = array(
			'ul' => array(
				'class' => array()
			),
			'ol' => array(
				'class' => array()
			),
			'li'=> array(
				'class' => array()
			),
			'a'=> array(
				'class' => array()
			),
			'i'=> array(
				'class' => array()
			),
			'span'=> array(
				'class' => array()
			),
		);
		
		$big = 999999999;
		$pagination = paginate_links(array(
			'base'		=> str_replace($big, '%#%', get_pagenum_link($big)),
			'format'	=> '?paged=%#%',
			'current'	=> max(1, get_query_var('paged')),
			'total'		=> $wp_query->max_num_pages,
			'prev_text'	=> '<span class="fa fa-angle-double-left"></span>',
			'next_text'	=> '<span class="fa fa-angle-double-right"></span>',
			'type'		=> 'list',
	
		));
		$pagination = str_replace("<ul class='page-numbers'>", '<ul class="styled-pagination text-center">', $pagination);
		
		echo wp_kses($pagination, $allowed_html);
	}
}

/*** Favicon ***/
if( !function_exists('themerange_theme_favicon') ){
	function themerange_theme_favicon(){
		if( function_exists('wp_site_icon') && function_exists('has_site_icon') && has_site_icon() ){
			return;
		}
		$favicon_option = themerange_get_theme_options('tr_favicon');
		$favicon = is_array($favicon_option)?$favicon_option['url']:$favicon_option;
		if( $favicon ): ?>
			<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
		<?php
		endif;
	}
}

/*** Logo ***/
if( !function_exists('themerange_theme_logo') ){
	function themerange_theme_logo($logo){
		$tr_theme_options = themerange_get_theme_options();
		$logo_image = is_array($tr_theme_options['tr_logo'])?$tr_theme_options['tr_logo']['url']:$tr_theme_options['tr_logo'];
		$logo_image_mobile = is_array($tr_theme_options['tr_logo_mobile'])?$tr_theme_options['tr_logo_mobile']['url']:$tr_theme_options['tr_logo_mobile'];
		$logo_text = $tr_theme_options['text_logo'];
		
		if( !$logo_image_mobile ){
			$logo_image_mobile = $logo_image;
		}
		if( !$logo_text ){
			$logo_text = get_bloginfo('name');
		}
		?>
		
        <a href="<?php echo esc_url( home_url('/') ); ?>">
        <?php if($logo == 'normal') :
			if( $logo_image ): ?>
            <img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="normal-logo" />
        <?php endif;
		endif; ?>
        
        <?php if($logo == 'mobile') :
			if( $logo_image_mobile ): ?>
            <img src="<?php echo esc_url($logo_image_mobile); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="mobile-logo" />
        <?php endif;
		endif; ?>
        
        <?php if( !$logo_image ):
            echo esc_html($logo_text);
        endif; ?>
        </a>
        
		<?php
	}
}

/*** Pingback URL ***/
add_action('wp_head', 'themerange_pingback_header');
if( !function_exists('themerange_pingback_header') ){
	function themerange_pingback_header(){
		if( is_singular() && pings_open() ){
		?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
		}
	}
}

/*** Header Template ***/
if( !function_exists('themerange_get_header_template') ){
	function themerange_get_header_template($layout){
		if ( $layout == 'header_v1' ) {
			get_template_part( 'templates/headers/header-v1' );
		} elseif ( $layout == 'header_v2' ) {
			get_template_part( 'templates/headers/header-v2' );
		} elseif ( $layout == 'header_v3' ) {
			get_template_part( 'templates/headers/header-v3' );
		} elseif ( $layout == 'header_v4' ) {
			get_template_part( 'templates/headers/header-v4' );
		} elseif ( $layout == 'onepage_v1' ) {
			get_template_part( 'templates/onepager/header-onepager-v1' );
		} elseif ( $layout == 'onepage_v2' ) {
			get_template_part( 'templates/onepager/header-onepager-v2' );
		} elseif ( $layout == 'onepage_v3' ) {
			get_template_part( 'templates/onepager/header-onepager-v3' );
		} else {
			get_template_part( 'templates/headers/header-v1' );
		}
	}
}

if( !function_exists('themerange_get_header_content') ){
	function themerange_get_header_content( $header_block_id = 0 ){
		if( class_exists('Elementor\Plugin') && in_array( 'header_block', get_option( 'elementor_cpt_support', array() ) ) ){
			echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $header_block_id );
		} else {
			$post = get_post( $header_block_id );
			if( is_object( $post ) ){
				echo do_shortcode( $post->post_content );
			}
		}
	}
}

/*** Footer Template ***/
if( !function_exists('themerange_get_footer_content') ){
	function themerange_get_footer_content( $footer_block_id = 0 ){
		if( class_exists('Elementor\Plugin') && in_array( 'footer_block', get_option( 'elementor_cpt_support', array() ) ) ){
			echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $footer_block_id );
		}
		else{
			$post = get_post( $footer_block_id );
			if( is_object( $post ) ){
				echo do_shortcode( $post->post_content );
			}
		}
	}
}

/* Ajax search */
add_action( 'wp_ajax_themerange_ajax_search', 'themerange_ajax_search' );
add_action( 'wp_ajax_nopriv_themerange_ajax_search', 'themerange_ajax_search' );
if( !function_exists('themerange_ajax_search') ){
	function themerange_ajax_search(){
		global $wpdb, $post;
		
		$taxonomy = 'category';
		$post_type = 'post';
		
		$num_result = (int)themerange_get_theme_options('tr_ajax_search_number_result');
		$desc_limit_words = (int)themerange_get_theme_options('tr_prod_cat_desc_words');
		
		$allowed_html = array(
			'ul' => array(
				'class' => array()
			),
			'ol' => array(
				'class' => array()
			),
			'li'=> array(
				'class' => array()
			)
		);
		
		$search_string = stripslashes($_POST['search_string']);
		$category = isset($_POST['category'])? $_POST['category']: '';
		
		$args = array(
			'post_type'			=> $post_type,
			'post_status'		=> 'publish',
			's'					=> $search_string,
			'postr_per_page'	=> $num_result,
			'tax_query'			=> array(),
		);
		
		if( $category != '' ){
			$args['tax_query'][] = array(
				'taxonomy'  => $taxonomy,
				'terms'	=> $category,
				'field'	=> 'slug',
			);
		}
		
		$results = new WP_Query($args);
		
		if( $results->have_posts() ){
			$extra_class = '';
			if( isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count ){
				$extra_class = 'has-view-all';
			}
			
			$html = '<ul class="product_list_widget '.$extra_class.'">';
			while( $results->have_posts() ){
				$results->the_post();
				$link = get_permalink($post->ID);
				
				$image = '';
				if( $post_type == 'product' ){
					$product = wc_get_product($post->ID);
					$image = $product->get_image();
					$rating = $product->get_average_rating();
					$count   = $product->get_rating_count();
				}
				else if( has_post_thumbnail($post->ID) ){
					$image = get_the_post_thumbnail($post->ID, 'thumbnail');
				}
				
				$html .= '<li>';
					$html .= '<div class="tr-wg-thumbnail">';
						$html .= '<a href="'.esc_url($link).'">'. $image .'</a>';
					$html .= '</div>';
					$html .= '<div class="tr-wg-meta">';
						$html .= '<a href="'.esc_url($link).'" class="title">'. themerange_search_highlight_string($post->post_title, $search_string) .'</a>';
						$html .= '<div class="description">'. themerange_the_excerpt_max_words($desc_limit_words, '', $allowed_html, '', false) .'</div>';
						if( $post_type == 'product' ){
							if( $price_html = $product->get_price_html() ){
								$html .= '<span class="price">'. $price_html .'</span>';
							}
							if( $rating ){
								$html .= '<span class="rating">'. wc_get_rating_html( $rating, $count ) .'</span>';
							}
						}
					$html .= '</div>';
				$html .= '</li>';
			}
			$html .= '</ul>';
			
			if( isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count ){
				$view_all_text = sprintf( esc_html__('View all %d results', 'themerange'), $results->found_posts );
				
				$html .= '<div class="view-all-wrapper">';
					$html .= '<a href="#">'. $view_all_text .'</a>';
				$html .= '</div>';
			}
			
			wp_reset_postdata();
			
			$return = array();
			$html = '<div class="search-content">'.$html.'</div>';
			$return['html'] = $html;
			$return['search_string'] = $search_string;
			die( json_encode($return) );
		}
		
		$return = array();
		$return['html'] = '<p>'.esc_html__('No products were found', 'themerange').'</p>';
		$return['search_string'] = $search_string;
		die( json_encode($return) );
	}
}

if( !function_exists('themerange_search_highlight_string') ){
	function themerange_search_highlight_string($string, $search_string){
		$new_string = '';
		$pos_left = stripos($string, $search_string);
		if( $pos_left !== false ){
			$pos_right = $pos_left + strlen($search_string);
			$new_string_right = substr($string, $pos_right);
			$search_string_insensitive = substr($string, $pos_left, strlen($search_string));
			$new_string_left = stristr($string, $search_string, true);
			$new_string = $new_string_left . '<span class="hightlight">' . $search_string_insensitive . '</span>' . $new_string_right;
		}
		else{
			$new_string = $string;
		}
		return $new_string;
	}
}

/* Get post comment count */
if( !function_exists('themerange_get_post_comment_count') ){
	function themerange_get_post_comment_count( $post_id = 0 ){
		global $post;
		if( !$post_id ){
			$post_id = $post->ID;
		}
		
		$comments_count = wp_count_comments($post_id); 
		return $comments_count->approved;
	}
}

/* Install Required Plugins */
add_action( 'tgmpa_register', 'themerange_register_required_plugins' );
function themerange_register_required_plugins(){
	$protocol  = is_ssl() ? 'https' : 'http';
	$theme_uri = $protocol.'://plugins.themerange.net/themerange-plugin';
	$plugin_uri	= $theme_uri.'.zip';
	$file_path	= $theme_uri.'.php';
	
    $plugins = array(
		array(
			'name'               => esc_html__( 'Themerange Plugin', 'themerange' ),
			'slug'               => 'themerange-plugin',
			'source'             => $plugin_uri,
			'required'           => true,
			'force_deactivation' => false,
			'file_path'          => $file_path,
            'version'            => '1.0',
		),
		array(
			'name' => esc_html__('Classic Editor', 'themerange'),
			'slug' => 'classic-editor',
			'required' => true,
		),
		array(
			'name' => esc_html__('Contact Form 7', 'themerange'),
			'slug' => 'contact-form-7',
			'required' => true,
		),
		array(
			'name' => esc_html__('Mailchimp', 'themerange'),
			'slug' => 'mailchimp-for-wp',
			'required' => true,
		),
		array(
			'name' => esc_html__( 'Elementor', 'themerange' ),
			'slug' => 'elementor',
			'required' => true,
		),
		array(
			'name' => esc_html__( 'WooCommerce', 'themerange' ),
			'slug' => 'woocommerce',
			'required' => true,
		),
    );

    $config = array(
		'id'           	=> 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

    tgmpa( $plugins, $config );
}

function tr_the_tags( $before = '', $sep = '', $after = '' ) {
	
	$before = '<span>'.$before.'</span>';
	$the_tags = get_the_tag_list( $before, $sep, $after );

	if ( ! is_wp_error( $the_tags ) ) {
		echo wp_kses($the_tags, true);
	}
}

//Button Style
function tr_button_style() {
	return array(
		'big' => esc_html__('Button Big', 'themerange'),
		'one' => esc_html__('Button One', 'themerange'),
		'two' => esc_html__('Button Two', 'themerange'),
		'three' => esc_html__('Button Three', 'themerange'),
	);
}
//Theme Button Style
function tr_button($btn_style, $btn_name, $btn_link) {
	return $button = '<div class="tr-button">
		<a href="'.$btn_link.'" class="theme-btn btn-style-'.$btn_style.'">
			<span class="btn-wrap">
				<span class="text-one">'.$btn_name.' <i class="fa-solid fa-plus fa-fw"></i></span>
				<span class="text-two">'.$btn_name.' <i class="fa-solid fa-plus fa-fw"></i></span>
			</span>
		</a>
	</div>';
}


//Get Theme Options
function themerange_get_theme_options( $key = '', $default = '' ){
	global $themerange_theme_options;
	
	if( !$key ){
		return $themerange_theme_options;
	}
	else if( isset($themerange_theme_options[$key]) ){
		return $themerange_theme_options[$key];
	}
	else{
		return $default;
	}
}
?>
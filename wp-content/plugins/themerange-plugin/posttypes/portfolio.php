<?php /*** TR Portfolio ***/
if( !class_exists('TR_Portfolio') ){
	class TR_Portfolio{
	
		public $post_type;
		public $thumb_size_name;
		public $thumb_size_array;
		public $like_meta_key = '_tr_portfolio_like_num';
		public $like_user_meta_key = '_tr_portfolio_likes';
		
		function __construct(){
			$this->post_type = 'tr_portfolio';
			add_action('init', array($this, 'register_post_type'));
			
			if( is_admin() ){
				add_filter('manage_'.$this->post_type.'_posts_columns', array($this, 'custom_column_headers'), 10);
				add_action('manage_'.$this->post_type.'_posts_custom_column', array($this, 'custom_columns'), 10, 2);
			}
			
			/* Ajax update like */
			add_action('wp_ajax_tr_portfolio_update_like', array($this, 'update_like'));
			add_action('wp_ajax_nopriv_tr_portfolio_update_like', array($this, 'update_like'));
			
			/* Register field permalink */
			add_action('load-options-permalink.php', array($this, 'register_custom_fields'));
		}
		
		function register_post_type(){
			if (function_exists('themerange_get_theme_options')) {
				$themerange_theme_options = themerange_get_theme_options();
			} else {
				$themerange_theme_options = [];
			}
			
			$portfolio_name = !empty($themerange_theme_options['tr_portfolio_name']) ? $themerange_theme_options['tr_portfolio_name'] : __('Portfolio', 'themerange');
			
			//Post and Cat Slug
			$post_slug = get_option('tr_portfolio_permalink');
			$portfolio_slug = !empty($themerange_theme_options['tr_portfolio_slug']) ? $themerange_theme_options['tr_portfolio_slug'] : '';
			
			$args = array(
				'labels' => array(
					'menu_name' 			=> __($portfolio_name, 'themerange'),
					'name' 					=> esc_html_x($portfolio_name, 'post type general name','themerange' ),
					'singular_name' 		=> esc_html_x($portfolio_name, 'post type singular name','themerange' ),
					'all_items' 			=> __( "All $portfolio_name", 'themerange' ),
					'add_new' 				=> __( "Add $portfolio_name", 'Team','themerange' ),
					'add_new_item' 			=> __( "Add $portfolio_name", 'themerange' ),
					'edit_item' 			=> __( "Edit $portfolio_name", 'themerange' ),
					'new_item' 				=> __( "New $portfolio_name", 'themerange' ),
					'view_item' 			=> __( "View $portfolio_name", 'themerange' ),
					'search_items' 			=> __( "Search $portfolio_name", 'themerange' ),
					'not_found' 			=> __( "No $portfolio_name found", 'themerange' ),
					'not_found_in_trash' 	=> __( "No $portfolio_name found in Trash", 'themerange' ),
					'parent_item_colon' 	=> '',
				),
				'singular_label' 		=> __($portfolio_name, 'themerange'),
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_ui' 				=> true,
				'show_in_menu' 			=> true,
				'capability_type' 		=> 'post',
				'hierarchical' 			=> false,
				'supports'  			=> array('title', 'editor', 'thumbnail', 'revisions'),
				'has_archive' 			=> false,
				'rewrite' 				=> array('slug' => $portfolio_slug, 'with_front' => true),
				'query_var' 			=> false,
				'menu_position' 		=> 26,
				'menu_icon' 			=> 'dashicons-format-portfolio',
			);

			if( $post_slug ){
				$args['rewrite']['slug'] = sanitize_title_with_dashes( $post_slug );
			}

			register_post_type($this->post_type, $args);	
		}
		
		function get_portfolio( $args = array() ){
			$defaults = array(
				'limit' 	=> 5,
				'orderby'	=> 'menu_order',
				'order' 	=> 'DESC',
				'id' 		=> 0,
				'category' 	=> 0,
				'size' 		=> $this->thumb_size_name,
			);

			$args = wp_parse_args($args, $defaults);

			$query_args = array();
			$query_args['post_type'] = $this->post_type;
			$query_args['posts_per_page'] = $args['limit'];
			$query_args['orderby'] = $args['orderby'];
			$query_args['order'] = $args['order'];

			if ( is_numeric($args['id']) && (intval($args['id']) > 0) ) {
				$query_args['p'] = intval( $args['id'] );
			}

			/* Whitelist checks */
			if ( !in_array($query_args['orderby'], array( 'none', 'ID', 'author', 'title', 'date', 'modified', 'parent', 'rand', 'comment_count', 'menu_order', 'meta_value', 'meta_value_num' )) ) {
				$query_args['orderby'] = 'date';
			}

			if ( !in_array( $query_args['order'], array( 'ASC', 'DESC' ) ) ) {
				$query_args['order'] = 'DESC';
			}

			if ( !in_array( $query_args['post_type'], get_post_types() ) ) {
				$query_args['post_type'] = $this->post_type;
			}
			
			$tax_field_type = '';
			/* If the category ID is specified */
			if ( is_numeric( $args['category'] ) && 0 < intval( $args['category'] ) ) {
				$tax_field_type = 'id';
			}

			/* If the category slug is specified */
			if ( !is_numeric( $args['category'] ) && is_string( $args['category'] ) ) {
				$tax_field_type = 'slug';
			}

			/* Setup the taxonomy query */
			if ( '' != $tax_field_type ) {
				$term = $args['category'];
				if ( is_string( $term ) ) { $term = esc_html( $term ); } else { $term = intval( $term ); }
				$query_args['tax_query'] = array( array( 'taxonomy' => 'portfolio_cat', 'field' => $tax_field_type, 'terms' => array( $term ) ) );
			}

			/* The Query */
			$query = get_posts( $query_args );

			/* The Display */
			if ( !is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {
				foreach ( $query as $k => $v ) {
					$meta = get_post_custom( $v->ID );

					/* Get the image */
					$query[$k]->image = $this->get_image( $v->ID, $args['size'] );

					/* Get custom meta data */
				}
			} else {
				$query = false;
			}

			return $query;
		}
		
		function get_image( $id, $size = '' ){
			$response = '';

			if ( has_post_thumbnail( $id ) ) {
				if ( ( is_int( $size ) || ( 0 < intval( $size ) ) ) && ! is_array( $size ) ) {
					$size = array( intval( $size ), intval( $size ) );
				} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
					$size = $this->thumb_size_array;
				}
				$response = get_the_post_thumbnail( intval( $id ), $size );
			}

			return $response;
		}
		
		function custom_columns( $column_name, $id ){
			global $wpdb, $post;

			$meta = get_post_custom( $id );
			switch ( $column_name ) {
				case 'image':
					$value = '';
					$value = $this->get_image( $id, 40 );
					echo $value;
				break;
				default:
				break;

			}
		}
		
		function custom_column_headers( $defaults ){
			$new_columns = array( 'image' => __( 'Image', 'themerange' ) );
			$last_item = '';
			if( isset($defaults['date']) ) { unset($defaults['date']); }
			if( count($defaults) > 2 ) {
				$last_item = array_slice($defaults, -1);
				array_pop($defaults);
			}
			
			$defaults = array_merge($defaults, $new_columns);
			if( $last_item != '' ) {
				foreach ( $last_item as $k => $v ) {
					$defaults[$k] = $v;
					break;
				}
			}

			return $defaults;
		}
		
		function get_like( $post_id = 0 ){
			global $post;
			if( !$post_id ){
				return 0;
			}
			$like_num = get_post_meta($post_id, $this->like_meta_key, true);
			$like_num = apply_filters('tr_portfolio_like_num', $like_num, $post_id);
			return absint($like_num);
		}
		
		function update_like(){
			if( !is_user_logged_in() ){
				die('');
			}
			
			if( isset($_POST['post_id']) ){
				$post_id = $_POST['post_id'];
				$like_num = $this->get_like( $post_id );
				if( $this->user_already_like( $post_id ) ){ /* Unlike */
					$like_num--;
					$this->user_update_like($post_id, false);
				}
				else{
					$like_num++;
					$this->user_update_like($post_id, true);
				}
				update_post_meta($post_id, $this->like_meta_key, $like_num);
				die((string)$like_num);
			}
			
			die('');
		}
		
		function user_already_like( $post_id ){
			if( is_user_logged_in() ){
				$user_id = get_current_user_id();
				$user_likes = get_user_meta($user_id, $this->like_user_meta_key, true);
				$user_likes = maybe_unserialize( $user_likes );
				if( is_array($user_likes) && in_array($post_id, $user_likes) ){
					return true;
				}
			}
			return apply_filters('tr_portfolio_already_like', false, $post_id);
		}
		
		function user_update_like( $post_id, $is_like = true ){
			if( is_user_logged_in() ){
				$user_id = get_current_user_id();
				$user_likes = get_user_meta($user_id, $this->like_user_meta_key, true);
				$user_likes = maybe_unserialize( $user_likes );
				if( $is_like ){
					if( !is_array($user_likes) ){
						$user_likes = array();
					}
					$user_likes[] = $post_id;
				}
				else{ /* Unlike */
					if( is_array($user_likes) && in_array($post_id, $user_likes) ){
						$key = array_search($post_id, $user_likes);
						unset($user_likes[$key]);
						$user_likes = array_values($user_likes);
					}
				}
				$user_likes = serialize($user_likes);
				update_user_meta($user_id, $this->like_user_meta_key, $user_likes);
			}
		}

		function register_custom_fields (){
			if( isset($_POST['tr_portfolio_permalink']) ){
				update_option('tr_portfolio_permalink', sanitize_title_with_dashes($_POST['tr_portfolio_permalink']) );
			}

			if( isset($_POST['tr_portfolio_category_permalink']) ){
				update_option('tr_portfolio_category_permalink', sanitize_title_with_dashes($_POST['tr_portfolio_category_permalink']) );
			}

			add_settings_section('tr_portfolio_section', __('Portfolio permalinks', 'themerange'), array( $this, 'portfolio_section_callback'), 'permalink'); 
			add_settings_field('tr_portfolio_permalink', __('Custom base', 'themerange') , array($this, 'permalink_field_callback'), 'permalink', 'tr_portfolio_section');
			add_settings_field('tr_portfolio_category_permalink', __('Category base', 'themerange') , array($this, 'permalink_category_field_callback'), 'permalink', 'tr_portfolio_section');
		}

		function permalink_field_callback() {
			$option = get_option('tr_portfolio_permalink');

			echo '<input type="text" value="' . esc_attr( $option ) . '" name="tr_portfolio_permalink" id="tr_portfolio_permalink" class="regular-text" />';
		}

		function permalink_category_field_callback() {
			$option = get_option('tr_portfolio_category_permalink');

			echo '<input type="text" value="' . esc_attr( $option ) . '" name="tr_portfolio_category_permalink" id="tr_portfolio_category_permalink" class="regular-text" />';
		}

		function portfolio_section_callback() {
			echo __('If you want to change the permalink of the portfolio, please fill in the field below', 'themerange');
		}
	}
}
global $tr_portfolio;
$tr_portfolio = new TR_Portfolio();
?>
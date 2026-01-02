<?php /*** TR Team ***/
if( !class_exists('TR_Teams') ){
	class TR_Teams{
	
		public $post_type;
		public $thumb_size_name;
		public $thumb_size_array;
		
		function __construct(){
			$this->post_type = 'tr_team';
			add_action('init', array($this, 'register_post_type'));
			
			if( is_admin() ){
				add_filter('manage_'.$this->post_type.'_posts_columns', array($this, 'custom_column_headers'), 10);
				add_action('manage_'.$this->post_type.'_posts_custom_column', array($this, 'custom_columns'), 10, 2);
			}
		}
		
		function register_post_type(){
			if (function_exists('avtar_get_theme_options')) {
                $avtar_theme_options = avtar_get_theme_options();
            } else {
                $avtar_theme_options = [];
            }
			
			$team_name = !empty($avtar_theme_options['tr_team_name']) ? $avtar_theme_options['tr_team_name'] : __('Team', 'themerange');
			
			//Post and Cat Slug
			$post_slug = get_option('tr_team_permalink');
			$team_slug = !empty($avtar_theme_options['tr_team_slug']) ? $avtar_theme_options['tr_team_slug'] : '';
			
			$labels = array(
				'name' 				=> esc_html_x( $team_name, 'post type general name', 'themerange' ),
				'singular_name' 	=> esc_html_x( $team_name, 'post type singular name', 'themerange' ),
				'add_new' 			=> esc_html_x( 'Add New', $team_name, 'themerange' ),
				'add_new_item' 		=> __( "Add New $team_name", 'themerange' ),
				'edit_item' 		=> __( "Edit $team_name", 'themerange' ),
				'new_item' 			=> __( "New $team_name", 'themerange' ),
				'all_items' 		=> __( "All $team_name", 'themerange' ),
				'view_item' 		=> __( "View $team_name", 'themerange' ),
				'search_items' 		=> __( "Search $team_name", 'themerange' ),
				'not_found' 		=> __( "No $team_name Found", 'themerange' ),
				'not_found_in_trash'=> __( "No $team_name Found In Trash", 'themerange' ),
				'parent_item_colon' => '',
				'menu_name' 		=> __( $team_name, 'themerange' )
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array('slug' => $team_slug, 'with_front' => true),
				'capability_type' 	=> 'post',
				'has_archive' 		=> 'tr_team',
				'hierarchical' 		=> false,
				'supports' 			=> array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions'),
				'menu_position' 	=> 26,
				'menu_icon' 		=> 'dashicons-admin-users'
			);
			register_post_type( $this->post_type, $args );
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
			if( isset($defaults['title']) ) { $defaults['title'] = __('Member name', 'themerange'); }
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
		
	}
}
global $tr_team_members;
$tr_team_members = new TR_Teams();
?>
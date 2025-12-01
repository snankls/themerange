<?php if( !class_exists('TR_Importer') ){
	class TR_Importer{

		function __construct(){
			add_filter( 'ocdi/plugin_page_title', array($this, 'import_notice') );
			add_filter( 'ocdi/plugin_page_setup', array($this, 'import_page_setup') );
			add_action( 'ocdi/before_widgets_import', array($this, 'before_widgets_import') );
			add_filter( 'ocdi/import_files', array($this, 'import_files') );
			add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
			add_action( 'ocdi/after_import', array($this, 'after_import_setup') );
			
			if( wp_doing_ajax() && isset($_POST['action']) && 'ocdi_import_demo_data' == $_POST['action'] ){
				add_filter('upload_mimes', array($this, 'allow_upload_font_files'));
			}
		}
		
		function import_notice( $plugin_title ){
			$allowed_html = array(
				'a' => array( 'href' => array(), 'target' => array() )
			);
			ob_start();
			?>
			<div class="tr-ocdi-notice-info">
				<p>
					<i class="fas fa-exclamation-circle"></i>
					<span><?php echo wp_kses( __('If you have any problem with importer, please read this article <a href="https://ocdi.com/import-issues/" target="_blank">https://ocdi.com/import-issues/</a> and check your hosting configuration, or contact our support team here <a href="mailto:support@themerange.net">support@themerange.net</a>.', 'themerange'), $allowed_html ); ?></span>
				</p>
			</div>
			<?php
			$plugin_title .= ob_get_clean();
			return $plugin_title;
		}
		
		function allow_upload_font_files( $existing_mimes = array() ){
			$existing_mimes['svg'] = 'font/svg';
			return $existing_mimes;
		}
		
		function import_page_setup( $default_settings ){
			$default_settings['parent_slug'] = 'themes.php';
			$default_settings['page_title']  = esc_html__( 'Import Demo Content' , 'themerange' );
			$default_settings['menu_title']  = esc_html__( 'Demo Import' , 'themerange' );
			$default_settings['capability']  = 'import';
			$default_settings['menu_slug']   = 'themerange-importer';
			return $default_settings;
		}
		
		function before_widgets_import(){
			global $wp_registered_sidebars;
			$file_path = dirname(__FILE__) . '/data/custom_sidebars.txt';
			if( file_exists($file_path) ){
				$file_url = plugin_dir_url(__FILE__) . 'data/custom_sidebars.txt';
				$custom_sidebars = wp_remote_get( $file_url );
				$custom_sidebars = maybe_unserialize( trim( $custom_sidebars['body'] ) );
				update_option('tr_custom_sidebars', $custom_sidebars);
				
				if( is_array($custom_sidebars) && !empty($custom_sidebars) ){
					foreach( $custom_sidebars as $name ){
						$custom_sidebar = array(
							'name' 			=> ''.$name.'',
							'id' 			=> sanitize_title($name),
							'description' 	=> '',
							'class'			=> 'tr-custom-sidebar',
						);
						if( !isset($wp_registered_sidebars[$custom_sidebar['id']]) ){
							$wp_registered_sidebars[$custom_sidebar['id']] = $custom_sidebar;
						}
					}
				}
			}
		}
		
		function import_files(){
			return array(
				array(
					'import_file_name'			=> 'Demo Import',
					'import_file_url'			=> plugin_dir_url( __FILE__ ) . 'data/content.xml',
					'import_widget_file_url'	=> plugin_dir_url( __FILE__ ) . 'data/widgets.wie',
					'import_redux'				=> array(
						array(
							'file_url'    => plugin_dir_url( __FILE__ ) . 'data/theme_options.json',
							'option_name' => 'themerange_theme_options',
						),
					)
				)
			);
		}
		
		function after_import_setup(){
			set_time_limit(0);
			$this->menu_locations();
			$this->set_homepage();
			$this->change_url();
			$this->set_elementor_site_settings();
			$this->update_menu_term_count();
		}
		
		function get_post_by_title($post_title, $post_type = 'page'){
			$query = new WP_Query(
				array(
					'post_type'              => $post_type,
					'title'                  => $post_title,
					'post_status'            => 'publish',
					'posts_per_page'         => 1,
					'no_found_rows'          => true,
					'ignore_sticky_posts'    => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'orderby'                => 'post_date ID',
					'order'                  => 'ASC',
				)
			);
		 
			if( ! empty( $query->post ) ){
				return $query->post;
			}
			return null;
		}
		
		/* Menu Locations */
		function menu_locations(){
			$locations = get_theme_mod( 'nav_menu_locations' );
			$menus = wp_get_nav_menus();

			if( $menus ){
				foreach( $menus as $menu ){
					if( $menu->name == 'Main Menu' ){
						$locations['primary'] = $menu->term_id;
					}
					if( $menu->name == 'Mobile Menu' ){
						$locations['mobile_menu'] = $menu->term_id;
					}
					if( $menu->name == 'One Page Menu' ){
						$locations['onepage_menu'] = $menu->term_id;
					}
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );
		}
		
		/* Set Homepage */
		function set_homepage(){
			$homepage = $this->get_post_by_title( 'HomePage 01' );
			if( isset( $homepage->ID ) ){
				update_option('show_on_front', 'page');
				update_option('page_on_front', $homepage->ID);
			}
		}
		
		/* Change url */
		function change_url(){
			global $wpdb;
			$wp_prefix = $wpdb->prefix;
			$import_url = 'https://wp.themerange.net/themerange';
			$site_url = get_option( 'siteurl', '' );
			$wpdb->query("update `{$wp_prefix}posts` set `guid` = replace(`guid`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}posts` set `post_content` = replace(`post_content`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}posts` set `post_excerpt` = replace(`post_excerpt`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}posts` set `post_title` = replace(`post_title`, '{$import_url}', '{$site_url}') where post_type='nav_menu_item';");
			$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . str_replace( '/', '\\\/', $import_url ) . "', '" . str_replace( '/', '\\\/', $site_url ) . "') where `meta_key` = '_elementor_data';");
			
			$option_name = 'themerange_theme_options';
			$option_ids = array( 
				'tr_logo',
				'tr_favicon',
				'tr_custom_loading_image',
				'tr_bg_breadcrumbs',
			);
			$tr_theme_options = get_option($option_name);
			if( is_array($tr_theme_options) ){
				foreach( $option_ids as $option_id ){
					if( isset($tr_theme_options[$option_id]) ){
						$tr_theme_options[$option_id] = str_replace($import_url, $site_url, $tr_theme_options[$option_id]);
					}
				}
				update_option($option_name, $tr_theme_options);
			}
			
			/* Update Widgets */
			$widgets = array(
				'media_image'	=> array('url', 'link_url'),
				'text'			=> array('text')
			);
			foreach( $widgets as $base => $fields ){
				$widget_instances = get_option( 'widget_' . $base, array() );
				if( is_array($widget_instances) ){
					foreach( $widget_instances as $number => $instance ){
						if( $number == '_multiwidget' ){
							continue;
						}
						foreach( $fields as $field ){
							if( isset($widget_instances[$number][$field]) ){
								$widget_instances[$number][$field] = str_replace($import_url, $site_url, $widget_instances[$number][$field]);
							}
						}
					}
					update_option( 'widget_' . $base, $widget_instances );
				}
			}
		}
		
		/* Set Elementor Site Settings */
		function set_elementor_site_settings(){
			$id = 0;
			
			$args = array(
				'post_type' 		=> 'elementor_library',
				'post_status' 		=> 'public',
				'posts_per_page'	=> 1,
				'orderby'			=> 'date',
				'order'				=> 'ASC', /* Date is not changed when import. Use imported post */
			);
			
			$posts = new WP_Query( $args );
			if( $posts->have_posts() ){
				$id = $posts->post->ID;
				update_option('elementor_active_kit', $id);
			}
			
			if( $id ){ /* Fixed width, space, ... if query does not return the imported post */
				$page_settings = get_post_meta($id, '_elementor_page_settings', true);
			
				if( !is_array($page_settings) ){
					$page_settings = array();
				}
					
				if( !isset($page_settings['container_width']) ){
					$page_settings['container_width'] = array();
				}
				
				$page_settings['container_width']['unit'] = 'px';
				$page_settings['container_width']['size'] = 1230;
				$page_settings['container_width']['sizes'] = array();
				
				if( !isset($page_settings['space_between_widgets']) ){
					$page_settings['space_between_widgets'] = array();
				}
				
				$page_settings['space_between_widgets']['unit'] = 'px';
				$page_settings['space_between_widgets']['size'] = 20;
				$page_settings['space_between_widgets']['sizes'] = array();
				
				$page_settings['page_title_selector'] = 'h1.entry-title';
				
				update_post_meta($id, '_elementor_page_settings', $page_settings);
			}
			
			/* Use color, font from theme */
			update_option('elementor_disable_color_schemes', 'yes');
			update_option('elementor_disable_typography_schemes', 'yes');
		}
		
		/* Update Menu Term Count - Keep this function until One Click Demo Import fixed */
		function update_menu_term_count(){
			$args = array(
				'taxonomy'		=> 'nav_menu',
				'hide_empty'	=> 0,
				'fields'		=> 'ids',
			);
			$menus = get_terms( $args );
			if( is_array($menus) ){
				wp_update_term_count_now( $menus, 'nav_menu' );
			}
		}
	}
	new TR_Importer();
}
?>
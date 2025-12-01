<?php 
/* Control show - update menu data */
if( !class_exists('Themerange_Mega_Menu') ){
	class Themerange_Mega_Menu{
		private $delete_css_transient = true;
		
		function __construct() {
			add_filter( 'wp_edit_nav_menu_walker', array($this, 'show_custom_fields') );
			add_action( 'wp_update_nav_menu_item', array($this, 'save_custom_fields'), 10, 3 );
            add_filter( 'wp_setup_nav_menu_item', array($this, 'add_data_to_custom_fields') );
			add_filter( 'wp_nav_menu_objects', array($this, 'modify_nav_items') );
		}
		
		function show_custom_fields(){
			return 'Themerange_Custom_Mega_Menu';
		}
		
		function save_custom_fields( $menu_id, $menu_item_db_id, $args ){
			if ( isset($_REQUEST['menu-item-tr-is-megamenu'][$menu_item_db_id]) && is_array($_REQUEST['menu-item-tr-is-megamenu']) ) {
				$tr_is_megamenu = $_REQUEST['menu-item-tr-is-megamenu'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_tr_is_megamenu', $tr_is_megamenu );
			}
			else{
				update_post_meta( $menu_item_db_id, '_menu_item_tr_is_megamenu', 0 );
			}
			
			if ( isset($_REQUEST['menu-item-tr-megamenu-column']) && is_array($_REQUEST['menu-item-tr-megamenu-column']) ) {
				$tr_megamenu_column = $_REQUEST['menu-item-tr-megamenu-column'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_tr_megamenu_column', $tr_megamenu_column );
			}
			
			if ( isset($_REQUEST['menu-item-tr-megamenu-id']) && is_array($_REQUEST['menu-item-tr-megamenu-id']) ) {
				$tr_megamenu_id = $_REQUEST['menu-item-tr-megamenu-id'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_tr_megamenu_id', $tr_megamenu_id );
			}
			
			/* Delete transient */
			if( $this->delete_css_transient ){
				set_transient('tr_mega_menu_custom_css', 0, MONTH_IN_SECONDS);
				$this->delete_css_transient = false;
			}
		}
		
		function add_data_to_custom_fields( $menu_item ){
			$menu_item->tr_sub_label_text = get_post_meta( $menu_item->ID, '_menu_item_tr_sub_label_text', true );
			$menu_item->tr_sub_label_bg_color = get_post_meta( $menu_item->ID, '_menu_item_tr_sub_label_bg_color', true );
			$menu_item->tr_is_megamenu = get_post_meta( $menu_item->ID, '_menu_item_tr_is_megamenu', true );
			$menu_item->tr_megamenu_column = get_post_meta( $menu_item->ID, '_menu_item_tr_megamenu_column', true );
			return $menu_item;
		}
		
		public static function select_mega_menu_html( $item_id ){
			$fid = 'edit-menu-item-tr-megamenu-id-' . $item_id;
			$name = 'menu-item-tr-megamenu-id[' . $item_id . ']';
			$selected = get_post_meta( $item_id, '_menu_item_tr_megamenu_id', true );
			
			$cache_key = 'tr_list_mega_menu_options';
			$options = wp_cache_get( $cache_key );
			
			if( $options === false ){
				$options = array();
				
				$args = array(
					'post_type'			=> 'mega_menu',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1,
				);
				
				$query = new WP_Query( $args );
				
				if( $query->have_posts() ){
					foreach( $query->posts as $p ){
						$options[$p->ID] = $p->post_title;
					}
				}
				
				wp_cache_set( $cache_key, $options );
			}
			?>
			<select id="<?php echo esc_attr($fid); ?>" name="<?php echo esc_attr($name); ?>" class="edit-menu-item-tr-megamenu-id widefat">
				<option value=""></option>
				<?php
				foreach( $options as $id => $text ){
					?>
					<option value="<?php echo esc_attr($id); ?>" <?php selected($selected, $id); ?>><?php echo esc_html($text); ?></option>
					<?php
				}
				?>
			</select>
			<?php
		}
		
		function has_sub( $menu_item_id, &$items ){
			$sub_count = 0;
			foreach( $items as $item ){
				if( $item->menu_item_parent && $item->menu_item_parent == $menu_item_id ){
				   $sub_count++;
				}
			}
			return $sub_count;
		}
		
		function modify_nav_items( $items ){
			foreach( $items as $item ){
				if( $sub_count = $this->has_sub( $item->ID, $items ) ){
					$item->sub_count = $sub_count; 
				}
				else{
					$item->sub_count = 0;
				}
			}
			return $items;    
		}
	}
}
new Themerange_Mega_Menu();

/* Custom Html Menu Item */
if( !class_exists('Themerange_Custom_Mega_Menu') ){
	class Themerange_Custom_Mega_Menu extends Walker_Nav_Menu{
		function __construct(){
		
		}
		
		function start_lvl(&$output, $depth = 0, $args = array()){}
		
		function end_lvl(&$output, $depth = 0, $args = array()){}
		
		/* Display html */
		function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
			
			ob_start();
			
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( esc_html__( '%s (Invalid)','themerange' ), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( esc_html__('%s (Pending)','themerange'), $item->title );
			}

			$title = empty( $item->label ) ? $title : $item->label;

			?>
			<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><?php echo esc_html( $title ); ?></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo wp_nonce_url(
										esc_url(
											add_query_arg(
												array(
													'action' => 'move-up-menu-item',
													'menu-item' => $item_id,
												),
												remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
											)
										),
										'move-menu_item'
									);
								?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','themerange'); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo wp_nonce_url(
										esc_url(
											add_query_arg(
												array(
													'action' => 'move-down-menu-item',
													'menu-item' => $item_id,
												),
												remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
											)
										),
										'move-menu_item'
									);
								?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','themerange'); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item','themerange'); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
							?>"><?php esc_html_e( 'Edit Menu Item','themerange' ); ?></a>
						</span>
					</dt>
				</dl>

				<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'URL','themerange' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Navigation Label','themerange' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Title Attribute','themerange' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php esc_html_e( 'Open link in a new window/tab','themerange' ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'CSS Classes (optional)','themerange' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Link Relationship (XFN)','themerange' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Description','themerange' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','themerange'); ?></span>
						</label>
					</p>        
					<?php
					/*
					 * This is the added fields
					 */
					do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args ); /* Compatible with the Nav Menu Roles plugin */
					?>
					
					<p class="field-tr-is-megamenu description description-wide tr-custom-menu tr-active-lv0">
						<label for="edit-menu-item-tr-is-megamenu-<?php echo esc_attr($item_id); ?>">
							<?php $tr_is_megamenu = (int)$item->tr_is_megamenu;?>
							<input value="1" type="checkbox" id="edit-menu-item-tr-is-megamenu-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tr-is-megamenu" name="menu-item-tr-is-megamenu[<?php echo esc_attr($item_id); ?>]" <?php checked($tr_is_megamenu, 1); ?> />
							<?php esc_html_e('Enable Mega Menu', 'themerange'); ?>
						</label>
					</p>
					
					<p class="field-wide-widget description description-thin tr-custom-menu tr-active-lv0">
						<label for="edit-menu-item-tr-megamenu-id-<?php echo esc_attr($item_id); ?>">
							<span class="description"><?php esc_html_e('Select Mega Menu', 'themerange'); ?></span>
							<?php Themerange_Mega_Menu::select_mega_menu_html( $item_id ); ?>
						</label>
					</p>
					
					<p class="field-tr-megamenu-column description description-thin tr-custom-menu tr-active-lv0">
						<label for="edit-menu-item-tr-megamenu-column-<?php echo esc_attr($item_id); ?>">
							<?php $tr_megamenu_column = esc_attr( $item->tr_megamenu_column );?>
							<?php esc_html_e( 'Columns','themerange' ); ?><br />
							<select id="edit-menu-item-tr-megamenu-column-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tr-megamenu-column" name="menu-item-tr-megamenu-column[<?php echo esc_attr($item_id); ?>]">
							   <option value="0" <?php selected(0, $tr_megamenu_column); ?> ><?php esc_html_e('Fullwidth', 'themerange') ?></option>
							   <option value="1" <?php selected(1, $tr_megamenu_column); ?> ><?php esc_html_e('1 column', 'themerange') ?></option>
							   <option value="2" <?php selected(2, $tr_megamenu_column); ?> ><?php esc_html_e('2 columns', 'themerange') ?></option>
							   <option value="3" <?php selected(3, $tr_megamenu_column); ?> ><?php esc_html_e('3 columns', 'themerange') ?></option>
							   <option value="4" <?php selected(4, $tr_megamenu_column); ?> ><?php esc_html_e('4 columns', 'themerange') ?></option>
							</select> 
						</label>
					</p>
					
					<?php
					/*
					 * end the added fields
					 */
					?>
					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( esc_html__('Original: %s','themerange'), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
						echo wp_nonce_url(
							esc_url(
								add_query_arg(
									array(
										'action' => 'delete-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
								)
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php esc_html_e('Remove','themerange'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
							?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel','themerange'); ?></a>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			
			$output .= ob_get_clean();
		}
	}
}

/* Display Menu on Frontend */
if( !class_exists('Themerange_Walker_Nav_Menu') ){
	class Themerange_Walker_Nav_Menu extends Walker_Nav_Menu{
		public $parent_is_megamenu;
		
		function __construct(){}
	
		function start_lvl( &$output, $depth = 0, $args = array() ){
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}
		
		function end_lvl( &$output, $depth = 0, $args = array() ){
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}
		
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$item_output = '';
			
			$sub_label_text = get_post_meta( $item->ID, '_menu_item_tr_sub_label_text', true );
			$is_megamenu = get_post_meta( $item->ID, '_menu_item_tr_is_megamenu', true );
			$megamenu_column = get_post_meta( $item->ID, '_menu_item_tr_megamenu_column', true );
			$megamenu_id = get_post_meta( $item->ID, '_menu_item_tr_megamenu_id', true );
			
			if( !$megamenu_id ){
				$is_megamenu = false;
			}
			
			if( $depth === 0 ){
				$this->parent_is_megamenu = $is_megamenu;
			}
			
			/* Parent menu and sub normal menus */
			if( $depth === 0 || ( $depth > 0 && !$this->parent_is_megamenu ) ){
				$atts = array();
				$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
				$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
				$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
				$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
				
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
					
				if( is_object($args) && isset($args->before) ){
					$item_output = $args->before;
				}else{
					$item_output = '';
				}
				
				$item_output .= "\n{$indent}\t<a". $attributes .'>';
				
				if( !isset($item->title) || strlen($item->title) <= 0 ){
					$item->title = $item->post_title;
				}
				$title = apply_filters( 'the_title', $item->title, $item->ID );
				
				if( is_object($args) && isset($args->link_before) && isset($args->link_after) ){
					$item_output .= $args->link_before . $title . $args->link_after;
				}else{
					$item_output .= $title;
				}
				
				if( strlen($item->description) > 0 ){
					$item_output .= '<div class="menu-desc menu-desc-lv'.$depth.'">'.esc_html($item->description).'</div>';
				}
				
				$item_output .= '</a>';
			}
			
			/* Mega Menu */
			if( $depth === 0 && $item->sub_count == 0 && $is_megamenu ){
				$item_output .= "\n$indent<ul class=\"sub-menu tr-mega-menu\">\n";
				
				$item_output .= '<li><div class="tr-megamenu-widgets-container tr-megamenu-container">';
				$item_output .= $this->get_megamenu_content( $megamenu_id );
				$item_output .= '</div></li>';
				
				$item_output .= "</ul>";
			}
			
			/* Add content into li */
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			if( $depth === 0 && $is_megamenu ){
				$classes[] = 'hide tr-megamenu tr-megamenu-columns-' . $megamenu_column;
				if( $megamenu_column == 0 ){
					$classes[] = 'tr-megamenu-fullwidth';
				}
				if( $megamenu_column == -1 ){
					$classes[] = 'tr-megamenu-fullwidth tr-megamenu-fullwidth-stretch no-stretch-content';
				}
				if( $megamenu_column == -2 ){
					$classes[] = 'tr-megamenu-fullwidth tr-megamenu-fullwidth-stretch';
				}
			}
			
			if( $depth === 0 && !$is_megamenu ){
				$classes[] = 'tr-normal-menu';
			}
			
			if( $item->sub_count || ( $depth === 0 && $is_megamenu ) ){
				$classes[] = 'parent';
			}
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}
		
		function get_megamenu_content( $megamenu_id ){
			if( class_exists('Elementor\Plugin') ){
				return Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $megamenu_id );
			}
		}
	}
}
?>
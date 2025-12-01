<?php 
function themerange_get_list_sidebars(){
	$default_sidebars = array(
		array(
			'name' => esc_html__( 'Default Sidebar', 'themerange' ),
			'id' => 'default-sidebar',
			'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'themerange' ),
			'before_widget' => '<div id="%1$s" class="sidebar sidebar-widget widget widget-container %2$s"><div class="widget-content">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="sidebar-title"><h4>',
			'after_title' => '</h4></div>'
		),
		array(
			'name' => esc_html__('Footer Widget', 'themerange'),
			'id' => 'footer-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in Footer Area.', 'themerange'),
			'before_widget'=>'<div class="col-lg-3 col-md-6 col-sm-12 footer-column"><div id="%1$s" class="footer-widget widget %2$s">',
			'after_widget'=>'</div></div>',
			'before_title' => '<div class="sidebar-title"><h4>',
			'after_title' => '</h4></div>'
		),
		array(
			'name' => esc_html__( 'Blog Sidebar', 'themerange' ),
			'id' => 'blog-sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar sidebar-widget widget widget-container %2$s"><div class="widget-content">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="sidebar-title"><h4>',
			'after_title' => '</h4></div>'
		),
		array(
			'name' => esc_html__( 'Product Sidebar', 'themerange' ),
			'id' => 'product-sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-widget_two widget-container %2$s"><div class="widget-content">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="sidebar-title_two"><h5>',
			'after_title' => '</h5></div>',
		),
	);
					
	$custom_sidebars = themerange_get_custom_sidebars();
	if( is_array($custom_sidebars) && !empty($custom_sidebars) ){
		foreach( $custom_sidebars as $name ){
			$default_sidebars[] = array(
				'name' => ''.$name.'',
				'id' => sanitize_title($name),
				'description' => '',
				'class'			=> 'ts-custom-sidebar',
				'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
				'after_title' => '</h3></div>',
			);
		}
	}
	
	return $default_sidebars;
}

function themerange_register_widget_area(){
	$default_sidebars = themerange_get_list_sidebars();
	foreach( $default_sidebars as $sidebar ){
		register_sidebar($sidebar);
	}
}
add_action( 'widgets_init', 'themerange_register_widget_area' );

/* Custom Sidebar */
add_action( 'sidebar_admin_page', 'themerange_custom_sidebar_form' );
function themerange_custom_sidebar_form(){
?>
	<form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="ts-form-add-sidebar">
        <input type="text" name="sidebar_name" id="sidebar_name" placeholder="<?php esc_attr_e('Custom Sidebar Name', 'themerange'); ?>" />
		<input type="hidden" id="tr_custom_sidebar_nonce" value="<?php echo wp_create_nonce('ts-custom-sidebar'); ?>" />
        <button class="button-primary" id="ts-add-sidebar"><?php esc_html_e('Add Sidebar', 'themerange'); ?></button>
    </form>
<?php
}

function themerange_get_custom_sidebars(){
	$option_name = 'tr_custom_sidebars';
	$custom_sidebars = get_option($option_name);
    return is_array($custom_sidebars)?$custom_sidebars:array();
}

add_action('wp_ajax_themerange_add_custom_sidebar', 'themerange_add_custom_sidebar');
function themerange_add_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		check_ajax_referer('ts-custom-sidebar', 'sidebar_nonce');
		
		$option_name = 'tr_custom_sidebars';
		if( !get_option($option_name) || get_option($option_name) == '' ){
			delete_option($option_name);
		}
		
		$sidebar_name = sanitize_text_field($_POST['sidebar_name']);
		
		if( get_option($option_name) ){
			$custom_sidebars = themerange_get_custom_sidebars();
			if( !in_array($sidebar_name, $custom_sidebars) ){
				$custom_sidebars[] = $sidebar_name;
			}
			$result = update_option($option_name, $custom_sidebars);
		}
		else{
			$custom_sidebars = array();
			$custom_sidebars[] = $sidebar_name;
			$result = add_option($option_name, $custom_sidebars);
		}
		
		if( $result ){
			die( esc_html__('Successfully added the sidebar', 'themerange') );
		}
		else{
			die( esc_html__('Error! It seems that the sidebar exists. Please try again!', 'themerange') );
		}
	}
	die('');
}

add_action('wp_ajax_themerange_delete_custom_sidebar', 'themerange_delete_custom_sidebar');
function themerange_delete_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		check_ajax_referer('ts-custom-sidebar', 'sidebar_nonce');
		
		$option_name = 'tr_custom_sidebars';
		$del_sidebar = trim($_POST['sidebar_name']);
		$custom_sidebars = themerange_get_custom_sidebars();
		foreach( $custom_sidebars as $key => $value ){
			if( $value == $del_sidebar ){
				unset($custom_sidebars[$key]);
				break;
			}
		}
		$custom_sidebars = array_values($custom_sidebars);
		update_option($option_name, $custom_sidebars);
		die( esc_html__('Successfully deleted the sidebar', 'themerange') );
	}
	die('');
}
?>
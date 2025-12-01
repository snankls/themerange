<?php 
/*** Blog Social Sharing ***/
if( !function_exists('tr_template_social_sharing') ){
	function tr_template_social_sharing(){
		ob_start();
		include plugin_dir_path( __FILE__ ) . 'templates/social-sharing.php';
		$icons_html = ob_get_clean();
		echo apply_filters('tr_social_sharing_html', $icons_html);
	}
}

//Form List (CF7, Mailchimp)
function get_form_list( $post_type = 'wpcf7_contact_form' ){
	$forms_list = array();
	$args = array(
		'post_type'			=> $post_type,
		'posts_per_page'	=> -1,
		'order'				=> 'ASC',
		'orderby'			=> 'title',
		'post_status'		=> 'publish',
	);
	
	$query = new WP_Query($args);
	if( $query->have_posts() ){
		foreach( $query->posts as $form ){
			$forms_list[$form->ID] = $form->post_title;
		}
	}
	
	return $forms_list;
}

//Get Categories
function tr_categories_list($taxonomy='') {
    $options = array();
    if(!empty($taxonomy))
    {
        $terms = get_terms(
            array(
                'parent' => 0,
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            )
        );
        if (!empty($terms)) {
            foreach($terms as $term) {
                if (isset($term)) {
                    if (isset($term->slug) && isset($term->name)) {
                        $options[$term->slug] = $term->name.' ('.$term->count.')';
                    }
                }
            }
        }
    }
    return $options;
}

//Icon Option List
function tr_icon_type() {
	return array(
		'' => esc_html__('Select Icon', 'themerange'),
		'flaticon' => esc_html__('Flaticon', 'themerange'),
		'icon' => esc_html__('Icon', 'themerange'),
	);
}

//Layout List
function tr_layout_list($number) {
	for($i=1; $i <= $number; $i++){
		$final_array['layout'.$i] = __('Layout '.$i, 'themerange');
	}
	return $final_array;
}

//Icon List
function tr_icon_list() {
	return array(
		'none' => esc_html__('None', 'themerange'),
		'fa-circle' => esc_html__('Circle', 'themerange'),
		'fa-check' => esc_html__('Check', 'themerange'),
		'fa-check-circle' => esc_html__('Check Circle', 'themerange'),
		'custom' => esc_html__('Custom', 'themerange'),
	);
}

//HTML Tags
function tr_html_tags() {
	return array(
		'h1' => 'H1',
		'h2' => 'H2',
		'h3' => 'H3',
		'h4' => 'H4',
		'h5' => 'H5',
		'h6' => 'H6',
		'div' => 'div',
		'span' => 'span',
		'p' => 'p',
		'strong' => 'strong',
	);
}

//Allowed HTML
function tr_allowed_html() {
	return array(
		'br' => array(),
		'h1' => array(
			'class' => array(),
			'style'	=> array()
		),
		'h2' => array(
			'class' => array(),
			'style'	=> array()
		),
		'h3' => array(
			'class' => array(),
			'style'	=> array()
		),
		'h4' => array(
			'class' => array(),
			'style'	=> array()
		),
		'h5' => array(
			'class' => array(),
			'style'	=> array()
		),
		'h6' => array(
			'class' => array(),
			'style'	=> array()
		),
		'p' => array(
			'class' => array(),
			'style'	=> array()
		),
		'strong' => array(
			'class'		=> array(),
			'style'	=> array()
		),
		'span' => array(
			'class'		=> array(),
			'style'	=> array()
		),
		'img' => array(
			'src' => array(),
			'alt' => array(),
			'class'	=> array(),
			'width'	=> array(),
			'height' => array(),
			'loading' => array(),
			'srcset' => array(),
			'sizes'	=> array()
		),
		'div' => array(
			'class' => array(),
			'style'	=> array()
		),
		'i'	=> array(
			'class' => array(),
			'style' => array()
		),
		'a'	=> array(
			'class' => array(),
			'style'	=> array(),
			'href' => array()
		),
	);
}

//WOW Animation
function tr_wow_animate() {
    return array(
        '' => 'None',
        'wow bounce' => 'bounce',
        'wow bounceIn' => 'bounceIn',
        'wow bounceInDown' => 'bounceInDown',
        'wow bounceInLeft' => 'bounceInLeft',
        'wow bounceInRight' => 'bounceInRight',
        'wow bounceInUp' => 'bounceInUp',
        'wow bounceOut' => 'bounceOut',
        'wow bounceOutDown' => 'bounceOutDown',
        'wow bounceOutLeft' => 'bounceOutLeft',
        'wow bounceOutRight' => 'bounceOutRight',
        'wow bounceOutUp' => 'bounceOutUp',
        'wow fadeIn' => 'fadeIn',
        'wow fadeInDown' => 'fadeInDown',
        'wow fadeInDownBig' => 'fadeInDownBig',
        'wow fadeInLeft' => 'fadeInLeft',
        'wow fadeInLeftBig' => 'fadeInLeftBig',
        'wow fadeInRight' => 'fadeInRight',
        'wow fadeInRightBig' => 'fadeInRightBig',
        'wow fadeInUp' => 'fadeInUp',
        'wow fadeInUpBig' => 'fadeInUpBig',
        'wow fadeOut' => 'fadeOut',
        'wow fadeOutDown' => 'fadeOutDown',
        'wow fadeOutDownBig' => 'fadeOutDownBig',
        'wow fadeOutLeft' => 'fadeOutLeft',
        'wow fadeOutLeftBig' => 'fadeOutLeftBig',
        'wow fadeOutRight' => 'fadeOutRight',
        'wow fadeOutRightBig' => 'fadeOutRightBig',
        'wow fadeOutUp' => 'fadeOutUp',
        'wow fadeOutUpBig' => 'fadeOutUpBig',
        'wow flash' => 'flash',
        'wow flip' => 'flip',
        'wow flipInX' => 'flipInX',
        'wow flipInY' => 'flipInY',
        'wow flipOutX' => 'flipOutX',
        'wow flipOutY' => 'flipOutY',
        'wow hinge' => 'hinge',
        'wow lightSpeedIn' => 'lightSpeedIn',
        'wow lightSpeedOut' => 'lightSpeedOut',
        'wow pulse' => 'pulse',
        'wow rollIn' => 'rollIn',
        'wow rollOut' => 'rollOut',
        'wow rotateIn' => 'rotateIn',
        'wow rotateInDownLeft' => 'rotateInDownLeft',
        'wow rotateInDownRight' => 'rotateInDownRight',
        'wow rotateInUpLeft' => 'rotateInUpLeft',
        'wow rotateInUpRight' => 'rotateInUpRight',
        'wow rotateOut' => 'rotateOut',
        'wow rotateOutDownLeft' => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft' => 'rotateOutUpLeft',
        'wow rotateOutUpRight' => 'rotateOutUpRight',
        'wow rubberBand' => 'rubberBand',
        'wow shake' => 'shake',
        'wow swing' => 'swing',
        'wow tada' => 'tada',
        'wow wobble' => 'wobble',
        'wow zoomIn' => 'zoomIn',
        'wow zoomInDown' => 'zoomInDown',
        'wow zoomInLeft' => 'zoomInLeft',
        'wow zoomInRight' => 'zoomInRight',
        'wow zoomInUp' => 'zoomInUp',
        'wow zoomOut' => 'zoomOut',
        'wow zoomOutDown' => 'zoomOutDown',
        'wow zoomOutLeft' => 'zoomOutLeft',
        'wow zoomOutRight' => 'zoomOutRight',
        'wow zoomOutUp' => 'zoomOutUp',
    );
}

//WOW Animation
function tr_custom_animate() {
    return array(
        '' => 'None',
        'bounce' => 'Bounce',
        'moving-left' => 'Moving Left',
        'moving-right' => 'Moving Right',
    );
}

//Split Animation
function tr_split_animation() {
	return array(
        'none' => 'None',
        'split-in-fade' => 'Split In Fade',
        'split-in-right' => 'Split In Right',
        'split-in-left' => 'Split In Left',
        'split-in-up' => 'Split In Up',
        'split-in-down' => 'Split In down',
        'split-in-rotate' => 'Split In Rotate',
        'split-in-scale' => 'Split In Scale',
    );
}

//Pagination
function tr_pagination($args = array(), $echo = 1) {
    global $wp_query;

    $default = array(
        'base'      => str_replace(99999, '%#%', esc_url(get_pagenum_link(99999))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'next_text' => '&raquo;',
        'prev_text' => '&laquo;',
        'type'      => 'list',
        'add_args'  => false
    );

    $args = wp_parse_args($args, $default);

    $paginate_links = paginate_links($args);
    if ($paginate_links) {
        $pagination = str_replace("<ul class='page-numbers'", '<ul class="styled-pagination"', $paginate_links);
        if ($echo) {
            echo wp_kses_post($pagination);
        }
        return $pagination;
    }

    return ''; // Return empty string if no pagination
}

//Theme Set
function tr_theme_set( $var, $key, $def = '' ) {
	if ( is_object( $var ) && isset( $var->$key ) ) {
		return $var->$key;
	} elseif ( is_array( $var ) && isset( $var[ $key ] ) ) {
		return $var[ $key ];
	} elseif ( $def ) {
		return $def;
	} else {
		return false;
	}
}

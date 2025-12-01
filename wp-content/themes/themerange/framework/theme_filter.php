<?php
/*** Comment ***/
function themerange_list_comments( $comment, $args, $depth ){
	switch ( $comment->comment_type ) :
		case '' :
		case 'comment' :
	?>
	<div <?php comment_class(); ?>>
		<div id="comment-<?php comment_ID(); ?>" class="review-author_box">
        	<div class="comment-box">
            	<div class="comment clearfix">
                    <div class="author-image">
                        <?php echo get_avatar( $comment, 100, 'mystery' ); ?>
                    </div>
                    <h5><?php echo wp_kses( get_comment_author(), true ); ?></h5>
                    
					<?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'themerange' ); ?></em>
                    <?php endif; ?>
                    
                    <div class="review-author_box-text"><?php comment_text(); ?></div>
                    <div class="review-author_box-date">
						<?php echo get_comment_date(); ?>
                    	
                        <?php $myclass = 'comment-reply';
							echo preg_replace( '/comment-reply-link/', 'comment-reply-link reply-btn ' . $myclass, get_comment_reply_link( array_merge( $args, array(
								'depth'      => $depth,
								'reply_text' => esc_html( 'Reply', 'themerange' ),
								'max_depth'  => $args['max_depth'],
								'respond_id' => 'comment-wrapper'
							) ) ), 10 );
						?>
                    </div>
                </div>
            </div>
		</div>
	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<div class="post pingback">
		<p><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'themerange' ), ' ' ); ?></p>
    </div>
	<?php
		break;
	endswitch;
}

function themerange_comment_form( $args = array(), $post_id = null ){
	$theme_options = themerange_get_theme_options();
	global $user_identity;
	
	$comment_title = isset($theme_options['tr_blog_details_comment_title']) ? $theme_options['tr_blog_details_comment_title'] : esc_html__( 'Leave a comment', 'themerange' );
	$comment_name = isset($theme_options['tr_blog_details_comment_name']) ? $theme_options['tr_blog_details_comment_name'] : esc_attr__('Name *', 'themerange');
	$comment_email = isset($theme_options['tr_blog_details_comment_email']) ? $theme_options['tr_blog_details_comment_email'] : esc_attr__('Email *', 'themerange');
	$comment_textarea = isset($theme_options['tr_blog_details_comment_textarea']) ? $theme_options['tr_blog_details_comment_textarea'] : esc_attr__('Add your comment..', 'themerange');
	$comment_button = isset($theme_options['tr_blog_details_comment_label_submit']) ? $theme_options['tr_blog_details_comment_label_submit'] : esc_html__( 'Post Comment', 'themerange' );

	if( null === $post_id ){
		$post_id = get_the_ID();
	}
	
	$allowed_html = array(
		'div'	=> array( 'class' => array() ),
		'p'		=> array( 'class' => array() ),
		'span'	=> array( 'class' => array() ),
		'a' 	=> array( 'href' => array(), 'title' => array(), 'rel' => array() ),
	);

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$comment_author = '';
	$comment_author_email = '';
	
	extract(array_filter(array(
		'comment_author'		=>	esc_attr($commenter['comment_author']),
		'comment_author_email'	=>	esc_attr($commenter['comment_author_email']),
	)), EXTR_OVERWRITE);
	
	$fields =  array(
		'author' => '<div class="col-lg-6 col-md-6 col-sm-12 form-group"><input placeholder="'. $comment_name .'" id="author" class="input-text" name="author" type="text" value="'. $comment_author .'" size="30"' . $aria_req . ' />' . '</div>',
		'email'	=> '<div class="col-lg-6 col-md-6 col-sm-12 form-group"><input placeholder="'. $comment_email .'" id="email" class="input-text" name="email" type="text" value="'. $comment_author_email .'" size="30"' . $aria_req . '/>' . '</div>',
	);

	$required_text = sprintf( ' ' . wp_kses( __('Required fields are marked %s','themerange'), $allowed_html ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'fields_before'		   => '',
		'fields_after'		   => '',
		'comment_field'        => '<div class="col-lg-12 col-md-12 col-sm-12 form-group"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'. $comment_textarea .'"></textarea></div>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'themerange' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'themerange' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p>'. esc_html__( 'Your email address will not be published. Required fields are marked *', 'themerange' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => $comment_title,
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'themerange'),
		'cancel_reply_link'    => esc_html__( 'Cancel reply', 'themerange' ),
		'label_submit'         => $comment_button,
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<section id="comment-wrapper" class="comment-form">
				<div class="group-title">
					<h3 class="blog-detail_subheading"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
					<?php 
						if ( ! is_user_logged_in() ) {
							echo wp_kses($args['comment_notes_before'], $allowed_html); 
						}
					?>
				</div>
				
				<?php 
					if( get_option( 'comment_registration' ) && !is_user_logged_in() ):
						echo wp_kses($args['must_log_in'], $allowed_html);
						do_action( 'comment_form_must_log_in_after' );
					else: 
				?>
                <div class="default-form">
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                    	<div class="row clearfix">
							<?php 
                                do_action( 'comment_form_top' );
                                if ( is_user_logged_in() ){
                                    echo wp_kses( apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ), $allowed_html );
                                    do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
                                }
                                if ( !is_user_logged_in() ) {
                                    echo wp_kses($args['fields_before'], $allowed_html);
                                    do_action( 'comment_form_before_fields' );
                                    foreach ( (array) $args['fields'] as $name => $field ) {
                                        echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                                    }
                                    echo wp_kses($args['fields_after'], $allowed_html);								
                                }
                                echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
                                echo wp_kses($args['comment_notes_after'], $allowed_html);
                                if ( !is_user_logged_in() ){ 
                                    do_action( 'comment_form_after_fields' ); 
                                }
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            	<button type="submit" class="theme-btn btn-style-three" id="<?php echo esc_attr( $args['id_submit'] ); ?>">
                                    <span class="btn-wrap">
                                        <span class="text-one"><?php echo esc_html( $args['label_submit'] ); ?> <i class="fa-solid fa-plus fa-fw"></i></span>
                                        <span class="text-two"><?php echo esc_html( $args['label_submit'] ); ?> <i class="fa-solid fa-plus fa-fw"></i></span>
                                    </span>
                                </button>
                                <?php comment_id_fields( $post_id ); ?>
                            </div>
                            <?php do_action( 'comment_form', $post_id ); ?>
                        </div>
					</form>
				</div>
				<?php endif; ?>
			</section>
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
<?php
}

/* kses allowed html */
add_filter('wp_kses_allowed_html', 'themerange_wp_kses_allowed_html', 10, 2);
function themerange_wp_kses_allowed_html( $tags, $context ){
	switch( $context ){
		case 'themerange_tgmpa':
			$tags = array(
				'a' 		=> array( 'href' => array(), 'class' => array(), 'target' => array() ),
				'p' 		=> array( 'class' => array() ),
				'span' 		=> array( 'class' => array() ),
				'strong' 	=> array(),
				'small'		=> array(),
				'br' 		=> array(),
			);
		break;
		case 'themerange_link':
			$tags = array(
				'a' => array( 
					'href' 		=> array(),
					'target' 	=> array(),
					'class' 	=> array(),
					'style' 	=> array(),
					'title' 	=> array(),
					'rel' 		=> array(),
					'data-*' 	=> array(),
				),
			);
		break;
		case 'themerange_header_text':
			$tags = array(
				'span' 			=> array(
					'class'  	=> array(),
					'style' 	=> array(),
				),
				'i' 			=> array(
					'class' 	=> array(),
				),
				'strong' 		=> array(
					'class' 	=> array(),
					'style' 	=> array(),
				),
				'div' 			=> array(
					'class' 	=> array(),
					'style' 	=> array(),
				),
				'a' 			=> array(
					'href' 	 	=> array(),
					'class' 	=> array(),
					'title' 	=> array(),
					'style' 	=> array(),
				),
				'img' 			=> array(
					'title'  	=> array(),
					'class' 	=> array(),
					'src'   	=> array(),
					'alt'   	=> array(),
					'style' 	=> array(),
				),
			);
		break;
	}
	return $tags;
}

/* Body classes filter */
add_filter('body_class', 'themerange_body_classes_filter');
function themerange_body_classes_filter( $classes ){
	$theme_options = themerange_get_theme_options();
	
	//Sticky Header
	if( $theme_options['tr_enable_sticky_header'] ){
		$classes[] = 'want-sticky-header';
	}
	
	//RTL
	if( is_rtl() || ( isset($theme_options['tr_enable_rtl']) && $theme_options['tr_enable_rtl'] ) ){
		$classes[] = 'rtl';
	}
	
	//Layout
	if( $theme_options['tr_header_layout'] ){
		$classes[] = 'header-' . $theme_options['tr_header_layout'];
	}
	
	//Woocommerce
	if( $theme_options['tr_product_label_style'] ){
		$classes[] = 'product-label-' . $theme_options['tr_product_label_style'];
	}
	
	if( !wp_is_mobile() ){
		$classes[] = 'tr_desktop';
	}
	
	global $is_safari;
	if( !empty($is_safari) ){
		$classes[] = 'is-safari';
	}
	
	return $classes;
}

?>
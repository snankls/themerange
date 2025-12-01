<?php
if( post_password_required() ){
	return;
}
?>

<div id="comments" class="contact-form">

	<?php if ( have_comments() ) : ?>
	
        <h3 class="blog-detail_subheading">
            <?php $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                /* translators: %s: post title */
                printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'themerange' ), get_the_title() );
            } else {
                printf(
                    /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s Reply to &ldquo;%2$s&rdquo;',
                        '%1$s Replies to &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'themerange'
                    ),
                    number_format_i18n( $comments_number ),
                    get_the_title()
                );
            } ?>
        </h3>

		<div class="review-box">
            <?php
				wp_list_comments( array(
					'style'       => 'div',
					'short_ping'  => true,
					'themerange_size' => 100,
					'callback'    => 'themerange_list_comments',
				) );
			?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'themerange' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'themerange' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<?php
		if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.' , 'themerange' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>
	
	<?php themerange_comment_form(); ?>

</div>
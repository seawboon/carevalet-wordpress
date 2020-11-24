<?php
// My custom comments output html
function medihealth_custom_comments( $comment, $args, $depth ) {

	// Get correct tag used for the comments
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	} ?>

	<<?php echo esc_html($tag);?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">

	<?php
	// Switch between different comment types
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
		<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'medihealth' ); ?></span> <?php comment_author_link(); ?></div>
	<?php
		break;
		default :
	?>
		<div class="comment-details">
			<div class="comment-author vcard bio">
				<?php
				// Display avatar unless size is set to 0
				if ( $args['avatar_size'] != 0 ) {
					$avatar_size = ! empty( $args['avatar_size'] ) ? $args['avatar_size'] : 70; // set default avatar size
						echo get_avatar( $comment, $avatar_size );
				}
				?>
			</div><!-- .comment-author -->
			<div class="comment-body">
				<h3>
					<?php 
						//author link
						printf(('%s'), get_comment_author_link());
					?>
				</h3>
				<div class="meta mb-2 comment-meta commentmetadata">
					<?php comment_date('F j, Y');?>&nbsp;<?php esc_html_e('at','medihealth');?>&nbsp;<?php comment_time('g:i a'); ?>
				</div><!-- .comment-meta -->
				<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
				<?php
				// Display comment moderation text
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'medihealth' ); ?></em><br/><?php
				} ?>
				<div class="edit-btn">
					<?php edit_comment_link( __( '<i class="far fa-edit"></i> Edit', 'medihealth' ), '  ', '' ); ?>				
				</div>
				<div class="reply-btn">
					<?php
					// Display comment reply link
					comment_reply_link(array_merge( $args, array(
							'reply_text' => __('<i class="far fa-comment-dots"></i> Reply', 'medihealth'), 
							'add_below' => $add_below, 
							'depth' => $depth, 
							'max_depth' => $args['max_depth']
							)
						)
					);						;
					if ( is_singular() ) wp_enqueue_script( "comment-reply" );
					?>
				</div>

			</div><!-- .comment-details -->
			<span> </span>
		</div>
		<?php 
		break;
	endswitch; // End comment_type check.
}
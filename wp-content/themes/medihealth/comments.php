<?php
/**
 * Comments
 *
 * @package MediHealth WordPress theme
 */

if( post_password_required() ) {
	return;
}
?>
<!-- Comments Area -->
<div id="comments" class="comments-area">
	<?php  
		$medihealth_fields=array(
			'author' => '<div class="form-group"></span></label><input class="form-control" name="author" id="author" value="" type="text" placeholder="'. esc_attr__("Name*",'medihealth').'" /></div>',
			'email' => '<div class="form-group"></span></label><input class="form-control" name="email" id="email" value="" type="email" placeholder="'. esc_attr__("Email*",'medihealth').'" ></div>',
			'website' => '<div class="form-group"></span></label><input class="form-control" name="website" id="website" value="" ype="text" placeholder="'. esc_attr__("Website",'medihealth').'" ></div>',
		);
		function medihealth_comment_fields($medihealth_fields) { 
			return $medihealth_fields;
		}
		add_filter('comment_form_default_fields','medihealth_comment_fields');
			$defaults = array(
				'fields'=> apply_filters( 'medihealth_comment_form_default_fields', $medihealth_fields ),
				'comment_field'=> '<div class="form-group"><textarea id="comments" rows="5" class="form-control" name="comment" type="text" ></textarea></div>',
				
				'logged_in_as' => '<p class="logged-in-as">' . esc_html__( "Logged in as",'medihealth' ).' '.'<a href="'. esc_url(admin_url( 'profile.php' )).'">'. esc_html( $user_identity ).'</a>'. '. '. '<a href="'. wp_logout_url( get_permalink() ).'" title="'. esc_attr__("Log out of this account",'medihealth').'">'.esc_html__("Logout",'medihealth').'</a>' . '</p>',
				
				'id_submit'=> 'submit',
				
				'label_submit'=>esc_html__( 'Send Message','medihealth'),
				
				'comment_notes_after'=> '',
				
				'title_reply'=> '<div class="theme-comment-title"><h5>'.esc_html__('Please Post Your Comments & Reviews','medihealth').'</h5></div>',
				
				'id_form'=> 'action'
			);
		comment_form($defaults);
	?>
</div>
<!-- Comments Area -->
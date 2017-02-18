<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php 
		$args = array(
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => array(

			'author' =>
				'<p class="comment-form-author"><label for="author">Ваше имя</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' /></p>',
			)
		);
		comment_form($args); 
	?>

	<?php if ( have_comments() ) : ?>
		
		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul'
					// 'short_ping'  => true,
					// 'avatar_size' => 56,
				) );
			?>
		</ul><!-- .comment-list -->


	<?php endif; // have_comments() ?>

</div><!-- .comments-area -->

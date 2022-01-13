<!--
COMMENTS
Used on single-property.php.
-->

<section class="comments">

	<div class="share-story">
		<h2 class="h3"><?php _e( 'Share your Story', 'ppsdb' ); ?></h2>
		<div>
			<p class="label-alt"><?php _e( 'Something to add? An edit or correction to suggest? Community input about the history of these important places is welcome. All submissions are reviewed before posting.', 'ppsdb' ); ?> </p>
		</div>
	</div>

	<?php if ( have_comments() ) : ?>

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'max_depth'   => 0,
					'style'       => 'div',
					'type'		  => 'comment',
				) );
			?>
		</ul>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php
		// if comments are closed and there are comments
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'ppsdb' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply' => '',
		) );
	?>

</section>

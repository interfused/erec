<?php global $wp; ?>

<div class="wp-job-manager-bookmarks-form">
	<?php if ( $is_bookmarked ) : ?>
		<div>
			<!-- <a class="remove-bookmark" href="<?php //echo wp_nonce_url( add_query_arg( 'remove_bookmark', absint( $post->ID ), get_permalink() ), 'remove_bookmark' ); ?>">
				<?php //_e( 'Remove', 'wp-job-manager-bookmarks' ); ?>
			</a>  -->
			<a class="" href="<?php echo site_url(); ?>/preferences/saved-jobs-of-interest/">Saved</a></div>
	<?php else : ?>
		<div><a class="open-popup-saveBookmark" href="javascript:void(0);"><?php printf( __( 'Save', 'wp-job-manager-bookmarks' ), ucwords( $post_type->labels->singular_name ) ); ?></a></div>
	<?php endif; ?>
	<div class="modal fade" id="saveBookmarkModalWrap" tabindex="-1" role="dialog" aria-labelledby="saveBookmarkModalWrapLabel">
	    <div class="modal-dialog" role="document">
		    <div class="modal-content">
		       <div class="modal-body">
					<button type="button" class="mfp-close close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			        <img src="<?php echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			        <h3>Your Story Has Taken A Lifetime</h3>
			        <div class="clearfix"></div> 
					<form method="post" action="<?php echo defined( 'DOING_AJAX' ) ? '' : esc_url( remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) ) ); ?>" class="job-manager-form text-left">
						<div class="form-group">
							<label for="bookmark_notes"><?php _e( 'Notes:', 'wp-job-manager-bookmarks' ); ?></label>
							<textarea name="bookmark_notes" id="bookmark_notes" class="form-control" cols="25" rows="3"><?php echo esc_textarea( $note ); ?></textarea>
							<label id="bookmark_notes-error" class="error" style="display:none;">Please enter some notes.</label>
						</div>
						<?php wp_nonce_field( 'update_bookmark' ); ?>
						<div class="text-center">
							<input type="hidden" name="bookmark_post_id" value="<?php echo absint( $post->ID ); ?>" />
							<input type="submit" name="submit_bookmark" value="<?php echo $is_bookmarked ? __( 'Save', 'wp-job-manager-bookmarks' ) : __( 'Save', 'wp-job-manager-bookmarks' ); ?>" />
						</div>
					</form>
					<script type="text/javascript">
						jQuery('input[name="submit_bookmark"]').on('click', function() {
							var msg = jQuery('#bookmark_notes').val(); 
							jQuery('#bookmark_notes-error').hide();
							if ( msg == '' ) {
								jQuery('#bookmark_notes-error').show();
								return false;
							}
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
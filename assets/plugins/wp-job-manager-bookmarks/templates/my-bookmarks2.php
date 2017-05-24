<?php
foreach ( $bookmarks as $bookmark ) :
	if ( get_post_status( $bookmark->post_id ) !== 'publish' ) {
		continue;
	}
	$has_bookmark = true;
	?>
<div class="col-sm-6">
	<article>
		<div class="savearticle_content">
			<h4><?php echo '<a href="' . get_permalink( $bookmark->post_id ) . '">' . get_the_title( $bookmark->post_id ) . '</a>'; ?></h4>
			<ul>
				<li><span>Location : </span>Miami, FL.</li>
				<li><span>Applicants : </span>12</li>
				<li class="date_saved"><span>Date Saved : </span>August 16th 2016</li>
			</ul>
			<a href="#" class="btn btn-primary">Apply Now</a>
			<div class="saved_company">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/barkleysecurity.png" class="img-responsive">
				<ul>
					<li><strong>Distance from you : 14 miles</strong></li>
					<li>Using zip codes : 33327 <a href="#">Change</a></li>
					<li><a href="<?php  echo get_permalink( $bookmark->post_id ); ?>">View This Posting</a> <a href="#">Other Openings</a></li>
				</ul>
			</div>
		</div>
		<div class="article_footer">
			<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
		</div>
	</article>
</div>

<?php endforeach; ?>
<?php if ( empty( $has_bookmark ) ) : ?>
				<div class="col-sm-6">
				<article>
					<?php _e( 'You currently have no saved job', 'wp-job-manager-bookmarks' ); ?>
				</article>
				</div>
	<?php endif; ?>
<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>



<?php  
/*<div id="job-manager-bookmarks">
	<table class="job-manager-bookmarks">
		<thead>
			<tr>
				<th><?php _e( 'Bookmark', 'wp-job-manager-bookmarks' ); ?></th>
				<th><?php _e( 'Notes', 'wp-job-manager-bookmarks' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $bookmarks as $bookmark ) :
				if ( get_post_status( $bookmark->post_id ) !== 'publish' ) {
					continue;
				}
				$has_bookmark = true;
				?>
				<tr>
					<td width="50%">
						<?php echo '<a href="' . get_permalink( $bookmark->post_id ) . '">' . get_the_title( $bookmark->post_id ) . '</a>'; ?>
						<ul class="job-manager-bookmark-actions">
							<?php
								$actions = apply_filters( 'job_manager_bookmark_actions', array(
									'delete' => array(
										'label' => __( 'Delete', 'wp-job-manager-bookmarks' ),
										'url'   =>  wp_nonce_url( add_query_arg( 'remove_bookmark', $bookmark->post_id ), 'remove_bookmark' )
									)
								), $bookmark );

								foreach ( $actions as $action => $value ) {
									echo '<li><a href="' . esc_url( $value['url'] ) . '" class="job-manager-bookmark-action-' . $action . '">' . $value['label'] . '</a></li>';
								}
							?>
						</ul>
					</td>
					<td width="50%">
						<?php echo wpautop( wp_kses_post( $bookmark->bookmark_note ) ); ?>
					</td>
				</tr>
			<?php endforeach; ?>

			<?php if ( empty( $has_bookmark ) ) : ?>
				<tr>
					<td colspan="2"><?php _e( 'You currently have no bookmarks', 'wp-job-manager-bookmarks' ); ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
</div>
        */ ?>
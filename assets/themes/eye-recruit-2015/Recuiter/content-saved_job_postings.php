<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/


if ( isset($_REQUEST['recruitID']) ) {
	$user_id = $_REQUEST['recruitID']; 
}
else{
	$user_id = '';
}

$jobClass = new WP_Job_Manager_Bookmarks();
$get_job = $jobClass->get_user_bookmarks($user_id,2);

if ( $get_job->max_found_rows > 0  ) { ?>
	<ul>
		<?php foreach ($get_job->results as $bookmark) {  
			if ( get_post_status( $bookmark->post_id ) !== 'publish' ) {
				continue;
			}
			$count++;
			$date_created = $bookmark->date_created; ?>
			<li>
				<h6><?php echo '<a href="' . get_permalink( $bookmark->post_id ) . '">' . get_the_title( $bookmark->post_id ) . '</a>'; ?></h6>
				<span><?php echo get_the_company_name($bookmark->post_id); ?></span>
				<em><?php echo date('l, F dS Y', strtotime($date_created) ); ?></em>
			</li>
		<?php } ?>
	</ul>
	<?php if ( $get_job->max_found_rows > 2 ) { ?>
		<div class="text-right">
			<a href="<?php echo site_url().'/saved-job-postings/?recruitID='.$user_id; ?>">See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
		</div>
	<?php } ?>
<?php } else{ ?>
	<h6><?php _e( 'Currently have no saved job', 'wp-job-manager-bookmarks' ); ?></h6>
<?php } ?>
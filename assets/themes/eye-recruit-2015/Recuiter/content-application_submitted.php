<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/
?>
<?php 
if ( isset($_REQUEST['recruitID']) ) {
	$user_id = $_REQUEST['recruitID']; 
}
else{
	$user_id = '';
}

$countargs = apply_filters( 'job_manager_job_applications_past_args', array(
		'post_type'           => 'job_application',
		'post_status'         => array_keys( get_job_application_statuses() ),
		'meta_key'            => '_candidate_user_id',
		'meta_value'          => $user_id,
	) );

$countapplications = new WP_Query( $countargs );
$count = $countapplications->post_count;

$args = apply_filters( 'job_manager_job_applications_past_args', array(
		'post_type'           => 'job_application',
		'post_status'         => array_keys( get_job_application_statuses() ),
		'meta_key'            => '_candidate_user_id',
		'meta_value'          => $user_id,
		'posts_per_page'	  => 3
	) );

$applications = new WP_Query( $args );

if ( $applications->have_posts() ) { 

	echo "<ul>";
		while ( $applications->have_posts() ) {
			$applications->the_post();
			$postID = get_the_ID();
			$parentID = wp_get_post_parent_id($postID);
			?> 
			<li>
				<h6><a href="<?php echo get_the_permalink($parentID); ?>"> <?php echo get_post_meta($postID, '_job_applied_for', true); ?></a></h6>
				<span><?php echo get_the_company_name($parentID); ?></span>
				<em><?php echo get_the_date('l, F dS Y'); ?></em>
			</li>
			<?php												
		}
		wp_reset_postdata();
	echo "</ul>";	
	if ( $count > 3 ) { ?>
		<div class="text-right">
			<a href="<?php echo site_url().'/application-submited/?recruitID='.$user_id; ?>" >See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
		</div>
	<?php } 			
}
else{ ?>
	<h6><?php _e( 'You currently have no applied job', 'wp-job-manager-bookmarks' ); ?></h6>
<?php } ?>
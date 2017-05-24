<?php
/**
 * Template Name: Application Submited
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header();
if ( isset($_REQUEST['recruitID']) ) {
	$user_id = $_REQUEST['recruitID']; 
	$userdata  = get_userdata($user_id);
	$name = $userdata->first_name.' '.$userdata->last_name;
}
else{
	$url = site_url();
	echo wp_redirect($url);
}
?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="job_postings">
		<div class="container">
			<div class="section_title">
				<h3><?php  echo  the_title(); ?></h3>
				<span><strong>Recruit ID</strong> : <?php echo $user_id;  ?></span>
			</div>
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url().'/employers/redacted-recruiter-quick-view/?recruitID='.$user_id; ?>">Home</a></li>
			  <li class="active">Application Submited </li>
			</ol>

			<?php
			$args = apply_filters( 'job_manager_job_applications_past_args', array(
				'post_type'           => 'job_application',
				'post_status'         => array_keys( get_job_application_statuses() ),
				'meta_key'            => '_candidate_user_id',
				'meta_value'          => $user_id,
			) );

			$applications = new WP_Query( $args );
			$count = $applications->post_count;
			?>

			<div class="search_bar">
				<p><?php echo $name; ?> submit <span id="noOfRes"><?php echo $count; ?></span> Application(s)</p>
			</div>

			<div class="savedjobs_list indent">
				<div class="row">
					<?php
					if ( $applications->have_posts() ) { 
						while ( $applications->have_posts() ) {
							$applications->the_post();
							$postID = get_the_ID();
							$parentID = wp_get_post_parent_id($postID);
							$location = get_post_meta($parentID, '_job_location', true);
							?>
							<div class="col-sm-4 applyjobBox<?php echo $postID; ?>" colID = "<?php echo $postID; ?>" >
								<article>
									<div class="savearticle_content">
										<h4><a href="<?php echo get_the_permalink($parentID); ?>"> <?php echo get_post_meta($postID, '_job_applied_for', true); ?></a></h4>
										<ul>
											<li>
												<span>Location : </span>
												<?php 
												global $wpdb;
												$cityId = get_post_meta($parentID, '_job_city', true);
												$regionId = get_post_meta($parentID, '_job_state', true);
												
												$job_deadline = get_post_meta($parentID, '_job_deadline', true);
												$nowDate = date('Y-m-d');

												$cityTable = $wpdb->prefix.'cities';
												$stateTable = $wpdb->prefix.'region';
												
												$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
												$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");

												echo (($city->name)) ? $city->name : '--'; 
												echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $state->name; 
												?>
											</li>
											<li><span>Applicants : </span><?php echo get_job_application_count( $parentID ); ?></li>
											<li class="date_saved"><span>Date Applied : </span><?php echo get_the_date('F dS Y'); ?></li>
										</ul>

										<?php 
										if ( $nowDate > $job_deadline ) {
											echo '<span class="label label-info">Closed</span>';
										}
										else{
											echo '<span class="label label-success">Now Open</span>';
										}
										//if ( is_position_filled( $parentID ) ) echo '<span class="label label-info">Position Filled</span>'; else echo '<span class="label label-success">Now Open</span>'; ?>
										
										<div class="saved_company">
											<?php
											$logo = get_the_company_logo( $parentID );
											if ( !empty($logo) ) { ?>
												<img src="<?php echo $logo; ?>" class="img-responsive">
											<?php } else{ ?>
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
											<?php } ?>
											<!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/barkleysecurity.png" class="img-responsive"> -->
											<ul>
												<li><strong>Distance from you : 14 miles</strong></li>
												<li>Using zip codes : 33327 </li>
												<li><a href="<?php echo get_the_permalink( $parentID ); ?>">View This Posting</a> 

												<?php if ( class_exists( 'Astoundify_Job_Manager_Companies' ) && '' != get_the_company_name($parentID) ) :
													$companies   = Astoundify_Job_Manager_Companies::instance();
													$company_url = esc_url( $companies->company_url( get_the_company_name($parentID) ) );
												?>
												<a href="<?php echo $company_url; ?>" target="_blank">Other Openings</a>
												<?php else : ?>
													<?php //echo get_the_company_name($parentID); ?>
												<?php endif; ?>

											</ul>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="article_footer">
										<div class="checkbox"></div>
									</div>
								</article>
							</div>

							<?php
						}
						wp_reset_postdata();
					}
					else{ ?>
						<div class="col-sm-12">
							<div class="savejobnotfound"><?php _e( 'Currently have no submited application', 'wp-job-manager-bookmarks' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
				
		</div>
	</section>

	<?php endwhile; ?>
<?php get_footer('preferences'); ?>

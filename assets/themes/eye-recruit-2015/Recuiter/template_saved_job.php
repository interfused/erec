<?php
/**
 * Template Name: Seeker Saved Jobs
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
			  <li class="active">Saved Job Postings </li>
			</ol>

			<?php
			$jobClass = new WP_Job_Manager_Bookmarks();
			$get_job = $jobClass->get_user_bookmarks($user_id,20);
			$count = $get_job->max_found_rows;
			?>

			<div class="search_bar">
				<p><?php echo $name; ?> Saved <span id="noOfRes"><?php echo $count; ?></span> Job Posting(s)</p>
			</div>

			<div class="savedjobs_list indent">
				<div class="row">
					<?php
					if ( $count > 0 ) { 
						foreach ( $get_job->results as $bookmark ){
							if ( get_post_status( $bookmark->post_id ) !== 'publish' ) {
								continue;
							}
							$count++;
							$has_bookmark = true;
							$location = get_post_meta($bookmark->post_id, '_job_location', true);
							$date_created = $bookmark->date_created;
							?>
							<div class="col-sm-4 myBookmark<?php echo $bookmark->id; ?>">
								<article>
									<div class="savearticle_content">
										<h4><?php echo '<a href="' . get_permalink( $bookmark->post_id ) . '">' . get_the_title( $bookmark->post_id ) . '</a>'; ?></h4>
										<ul>
											<li>
												<span>Location : </span>
												<?php 
												global $wpdb;
												$cityId = get_post_meta($bookmark->post_id, '_job_city', true);
												$regionId = get_post_meta($bookmark->post_id, '_job_state', true);

												$job_deadline = get_post_meta($bookmark->post_id, '_job_deadline', true);
												$nowDate = date('Y-m-d');


												$cityTable = $wpdb->prefix.'cities';
												$stateTable = $wpdb->prefix.'region';
												
												$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
												$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");

												echo (($city->name)) ? $city->name : '--'; 
												echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $city->name; 
												?>
											</li>
											<li><span>Applicants : </span><?php echo get_job_application_count( $bookmark->post_id ); ?></li>
											<li class="date_saved"><span>Date Saved : </span><?php echo date('F dS Y', strtotime( $date_created) ); ?></li>
										</ul>
										
										<?php if ( user_has_applied_for_job( $user_id, $bookmark->post_id ) ){ echo '<span class="label label-success">Applied</span>'; } ?>
										
										<?php 
										if ( $nowDate > $job_deadline ) {
											echo '<span class="label label-info">Closed</span>';
										}
										else{
											echo '<span class="label label-success">Now Open</span>';
										} ?>
										

										<div class="saved_company">
											<?php
											$logo = get_the_company_logo( $bookmark->post_id );
											if ( !empty($logo) ) { ?>
												<img src="<?php echo $logo; ?>" class="img-responsive">
											<?php } else{ ?>
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
											<?php } ?>

											<ul>
												<li><strong>Distance from you : 14 miles</strong></li>
												<li>Using zip codes : 33327</li>
												<li><a href="<?php  echo get_permalink( $bookmark->post_id ); ?>">View This Posting</a> 

												<?php if ( class_exists( 'Astoundify_Job_Manager_Companies' ) && '' != get_the_company_name($bookmark->post_id) ) :
													$companies   = Astoundify_Job_Manager_Companies::instance();
													$company_url = esc_url( $companies->company_url( get_the_company_name($bookmark->post_id) ) );
												?>
												<a href="<?php echo $company_url; ?>" target="_blank">Other Openings</a>
												<?php else : ?>
													<?php //echo get_the_company_name($bookmark->post_id); ?>
												<?php endif; ?>
											</ul>
										</div>
									</div>
									<div class="article_footer">
										<div class="checkbox"></div>
									</div>
								</article>
							</div>
							<?php
						}
					}
					else{ ?>
						<div class="col-sm-12">
							<div class="savejobnotfound"><?php _e( 'Currently have no saved job posting', 'wp-job-manager-bookmarks' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
				
		</div>
	</section>
	<?php endwhile; ?>
<?php get_footer('preferences'); ?>

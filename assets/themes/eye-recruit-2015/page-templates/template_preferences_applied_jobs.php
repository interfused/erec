<?php
/**
 * Template Name: Preferences applied jobs page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header();
$user_id = get_current_user_id(); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
							<h3><?php  echo  the_title(); ?></h3>
							<span><strong>Recruit ID</strong> : <?php echo $user_id;  ?></span>
					</div>
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
						<p>These are the <span id="countAppliedJob" count="<?php echo $count; ?>" ><?php echo $count; ?></span> Job you have applied for.</p>
						<div class="clearfix"></div>
					</div>

					<div class="savedjobs_list indent applied_jobs">
						<div class="row">

							<?php

							if ( $applications->have_posts() ) { 

								while ( $applications->have_posts() ) {
									$applications->the_post();

									$postID = get_the_ID();
									$parentID = wp_get_post_parent_id($postID);
									$location = get_post_meta($parentID, '_job_location', true);
									$jobtitle = get_post_meta($postID, '_job_applied_for', true);
									?>
									<div class="col-sm-6 applyjobBox<?php echo $postID; ?>" colID = "<?php echo $postID; ?>" >
										<article>
											<div class="savearticle_content">
												<h4 class="applied_jobs_title"><a href="<?php echo get_the_permalink($parentID); ?>"> <?php echo count_char_length($jobtitle, 27);  ?></a></h4>
												
												<?php 
												global $wpdb;
												$cityId = get_post_meta($parentID, '_job_city', true);
												$regionId = get_post_meta($parentID, '_job_state', true);
												
												//$job_deadline = get_post_meta($parentID, '_job_deadline', true);
												$job_deadline = get_post_meta($parentID, '_application_deadline', true);


												$nowDate = date('Y-m-d');

												$cityTable = $wpdb->prefix.'cities';
												$stateTable = $wpdb->prefix.'region';
												
												$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
												$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");
												?>
												<div class="saved_company">
													<ul>
														<li><strong>Distance from you : </strong><?php echo get_post_meta($parentID, '_job_distance', true);  ?> miles</li>
														<li>Using zip codes : <?php echo get_post_meta($parentID, '_job_postcode', true);  ?></li>

														<?php if ( class_exists( 'Astoundify_Job_Manager_Companies' ) && '' != get_the_company_name($parentID) ) :
															$companies   = Astoundify_Job_Manager_Companies::instance();
															$company_url = esc_url( $companies->company_url( get_the_company_name($parentID) ) );
														?>
														<?php else : ?>
															<?php //echo get_the_company_name($parentID); 
															$company_url = 'javascript:void(0);'
															?>
														<?php endif; ?>
													</ul>
												</div>
												<div class="text-center">
													<?php
													$logo = get_the_company_logo( $parentID );
													if ( !empty($logo) ) { ?>
														<div class="pull-left"><img src="<?php echo $logo; ?>" class="img-responsive"></div>
													<?php } else{ ?>
														<div class="pull-left"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/eyerecruit_circle.png" class="img-responsive"></div>
													<?php } ?>

													<?php 
													if ( $nowDate > $job_deadline ) {
														echo '<span class="label label-primary">NOW CLOSED</span>';
													}
													else{
														echo '<span class="label label-success">OPEN JOB</span>';
													} ?>
												</div>
												<div class="text-center">
													<a href="#" class="pull-right">Follow</a>
													<h5><?php $compName = get_the_company_name($parentID); echo count_char_length($compName, 30); ?></h5>
													<small>Posting date: <?php echo get_the_date( 'm/d/Y', $parentID ); ?></small>
													<p><strong>You last showed interest on:</strong> <?php echo get_the_date( 'm/d/Y', $postID ); ?></p>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="article_footer">
												<div class="checkbox"><label><input class="delete_anchor remove<?php echo $postID; ?>" buttonid="<?php echo $postID; ?>" type="checkbox"> <span>Remove</span> </label></div>
												<a href="<?php echo $company_url; ?>">All company Openings</a>
											</div>
										</article>
									</div>

									<?php
								}
								wp_reset_postdata();
							}
							else{ ?>
								<div class="col-sm-12">
									<div class="savejobnotfound"><?php _e( 'You currently have no applied job', 'wp-job-manager-bookmarks' ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php endwhile; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
	<script type="text/javascript">
		jQuery(document).ready( function() {
			jQuery('.delete_anchor').on('click', function() {
				var _this = jQuery(this);
				var id = _this.attr('buttonid');

				var img = '<?php echo get_stylesheet_directory_uri()."/images/danger_icon.jpg"; ?>';
				swal({
				  imageUrl: img,
				  title: "warning",
				  text: "You are about to DELETE this applied job. Once you select continue his can not be undone. May we suggest simply restricting access?",
				  showCancelButton: true,
				  confirmButtonClass: "btn-default btn-sm changetext",
				  confirmButtonText: "Continue Delete",
				  cancelButtonText: "Cancel",
				  cancelButtonClass: "btn-primary btn-sm cancelbutton",
				  closeOnConfirm: false,
				  closeOnCancel: false,
				  customClass: 'daner_sweet'
				},
				function(isConfirm) {
				  if (isConfirm) {
				  	jQuery('.changetext').html('Please Wait...');
				    jQuery.ajax({
						type: 'POST',
						url: '<?php echo admin_url("admin-ajax.php");  ?>',
						dataType: 'json',
						data: {
							action: 'removeSavedJob', //Action in inc/edit_basic_info
							id: id
						},
						success: function(res){
							if ( res.status == 'success' ) {
								jQuery('.sweet-alert').removeClass('daner_sweet');
								jQuery('.changetext').html('Continue Delete');
								jQuery('.applyjobBox'+id).remove();
								var totalJob = parseInt( jQuery('#countAppliedJob').attr('count') ) - 1;
								jQuery('#countAppliedJob').attr('count', totalJob);
								jQuery('#countAppliedJob').html(totalJob);
								swal({
									title: "Deleted!", 
									type: "success",
									confirmButtonClass: "btn-primary btn-sm",
								});
							}
						}
					});
				  } else {
			    	jQuery('.sweet-alert').removeClass('daner_sweet');
					jQuery('.changetext').html('Continue Delete');
				    swal({
				   		title:	"Cancelled",
				   		type: "error",
					   	confirmButtonClass: "btn-primary btn-sm",
				   	});
				    jQuery('.remove'+id).prop('checked', false);
				  }
				});
			});
		});
	</script>
<?php get_footer('preferences'); ?>

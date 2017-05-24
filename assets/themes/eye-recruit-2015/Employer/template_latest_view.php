<?php
/**
 * Template Name: Latest view
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?//php the_title(); ?>Latest View</h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" role="main">
			<?php //comments_template(); ?>
			<section class="dashboard_sec search_employers">
				<div class="container">
							<div class="search_bar">
								<?php 
									global $wpdb;
									$employer_id =  get_current_user_id();
									$profi_visi = get_cimyFieldValue(false, 'PROFILE_VISIBILITY');
									$excludeID = array();
									foreach ($profi_visi as $value) {
										$fieldvalue = cimy_uef_sanitize_content($value['VALUE']);
										if ( ($fieldvalue == 'Open') || ($fieldvalue == 'Private') ) {
											$excludeID[] = $value['user_id'];
											
										}
									}
									$view_result =  $wpdb->get_results(" SELECT * FROM eyecuwp_last_view WHERE emp_id = '".$employer_id."' ORDER BY date_time DESC");
									$select_count = 0;
									foreach ($view_result as $value){
										$can_id = $value->can_id;
										if ( !in_array($can_id, $excludeID) ) {
											$select_count++;
										}
									}
								?>
								<p>Your Latest View : <span id="countMyBookmarks" count="3"><?php  echo $select_count;?> </span></p>
								<hr class="clearfix" />
							</div>
							<div id="seekerListing"  class="employer_search job_listings">
								<div class="job_listing recent_view">
								<div class="row">
									<?php   
									if (!empty($view_result)) {   
										foreach ($view_result as $value){
											$can_id = $value->can_id;
											if ( !in_array($can_id, $excludeID) ) {
											
												$emp_id = $value->emp_id;
												$can_info = get_userdata($can_id);
												$totalPer = job_seeker_profile_com_status($can_id);
												$industries_years = get_cimyFieldValue($can_id,'INDUSTRY_YEARS');
												$MAJOR_METROPOLITAN = get_cimyFieldValue($can_id,'MAJOR_METROPOLITAN');
												$best_industries = get_cimyFieldValue($can_id,'BEST_INDUSTRY');
												$allwoPhoto = get_cimyFieldValue($can_id, 'PNA_PHOTOGRAPH');
										    	?>
												<div class="col-lg-6 col-md-12">
										    	<div class="jobsearch_list">
													<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
													<div class="thumbnail">
														<?php
															if ( (has_wp_user_avatar($can_id)) && ($allwoPhoto != 'No') ) {
																echo get_wp_user_avatar($can_id);
															}else{
																?>
																<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
																<?php
															}
														?>
													</div>
													<div class="post_btns">
														<div class="postbtns_inner">
															<div class="c100 p<?php echo $totalPer; ?> small">
											                   <span><?php echo $totalPer; ?>%<small>Overall</small></span>
											                    <div class="slice">
											                        <div class="bar"></div>
											                        <div class="fill"></div>
											                    </div>
											                </div>
															<a class="btn btn-primary btn-sm" href="<?php echo site_url().'/job-seekers/quick-view/?recruiterid='.$can_id; ?>" target="_blank">See Quick View</a>				
															
															<?php
																$employer_id =  get_current_user_id();
																$userdata = get_userdata($employer_id);

																if( in_array('administrator', $userdata->roles) ){	
																	$Reurl = '/employers/redacted-recruiter-quick-view/';
																}
																else{
																	$Reurl = '/job-seekers/redacted-employer-quick-view/';
																}
															?>
															<a href="<?php echo site_url().$Reurl; ?>?recruitID=<?php echo $can_id; ?>" class="btn btn-default btn-sm">View Full Profile</a>

															<div class="checkbox">
															  <label>
															    <input type="checkbox" value=""><span>Compare</span>
															  </label>
															</div>
														</div>
													</div>
													<div class="searchresult_cont">
														<?php if ( !empty($can_info->first_name) || !empty($can_info->last_name) ) { ?>
															<h3><a href="<?php echo site_url(); ?>/job-seekers/quick-view/?recruiterid=<?php echo $can_id; ?>" target="_blank"><?php echo $can_info->first_name .' '.$can_info->last_name;  ?></a></h3>
														<?php } ?>
														<span>Recruiter ID. : <?php echo $can_id; ?></span>
														<hr class="clearfix" />
														<h3><?php echo ($best_industries)? '<a href="javascript:void(0);">'.$best_industries.'</a>' : '' ;?></h3>
														<span><?php echo ($MAJOR_METROPOLITAN)? $MAJOR_METROPOLITAN : '' ;?></span>
														<span><?php echo ($industries_years)? $industries_years : '' ;?></span>
														<p><a href="javascript:void(0);" class="link">Delete</a>
														<a href="javascript:void(0);" class="link">Remove</a>
														<a href="javascript:void(0);" class="link">Block</a></p>
														<hr class="clearfix" />
													</div>
													<div class="clearfix"></div>
												</div>   
												</div>   
											    <?php  

											}  
									    }  
									}
									else{
									    echo 'No candidate found';
									}
									?>
								</div>
								</div>
							</div>
				</div>
			</section>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('assessment'); ?>


<?php
/**
 * Template Name: Preferences communication-preferences page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="preferences">
		<div class="container">
			<div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
			<div class="row">
				<div class="col-md-3">
				<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Communication Preferences</h3>
						<input type="hidden" name="cur_user_id" id="cur_user_id" value="<?php $user_id = get_current_user_id(); echo $user_id; ?>">
						<span><strong>Recruit ID</strong> : <?php echo $user_id; ?></span>
					</div>
					<div class="communication_prefer">
						<div class="sidebar_title cont_title">
							<h4>Email Notifications</h4>
							<div class="title_edit">
								<label class="radio-inline">
								  <input type="radio" name="CP_EMAIL_NOTIFY" id="CP_EMAIL_NOTIFY_1" value="option1" checked> <span>HTML</span>
								</label>
								<label class="radio-inline">
								  <input type="radio" name="CP_EMAIL_NOTIFY" id="CP_EMAIL_NOTIFY_2" value="option2"> <span>Plain Text</span>
								</label>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" msg="EyeRecruit Job Leads">
								<thead>
									<tr>
										<th colspan="2">EyeRecruit Job Leads</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>When a new job in your area is posted that matches your stated desires, goals &  career objectives.</td>
										
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_DES_GOAL_CAREER');  if($value){ echo $value; }else{ echo "No"; }?>" <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_DES_GOAL_CAREER" class="CP_DES_GOAL_CAREER"  id="CP_DES_GOAL_CAREER" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>With inside information on unlisted job opportunities you may not find anywhere else.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_UNLISTED_JOB_OPP'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_UNLISTED_JOB_OPP" class="CP_UNLISTED_JOB_OPP" id="CP_UNLISTED_JOB_OPP"><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>With Job Recommendations we have located that might be right for you.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_JOB_RECOMMENDS'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_JOB_RECOMMENDS" class="CP_JOB_RECOMMENDS" id="CP_JOB_RECOMMENDS"><span></span>
												</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" msg="Employer Interactions">
								<thead>
									<tr>
										<th colspan="2">Employer Interactions</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>When a message is left for you on your profile by an Employer.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_MESS_ON_PROFILE'); if($value){ echo $value; }else{ echo "No"; }?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_MESS_ON_PROFILE" class="CP_MESS_ON_PROFILE"  id="CP_MESS_ON_PROFILE" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>When a Employer requests to view you Career documents (that are marked private).</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_CAREER_DOCS'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_CAREER_DOCS" class="CP_CAREER_DOCS" id="CP_CAREER_DOCS" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>When you have been invited to participate in a Private Chat initiated by an Employer.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_INV_TO_PART_IN_PC'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_INV_TO_PART_IN_PC" class="CP_INV_TO_PART_IN_PC" id="CP_INV_TO_PART_IN_PC" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>Whit a weekly report that showing you which Employers have viewed your profile.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_WEEK_REP_VIS_EMP'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_WEEK_REP_VIS_EMP" class="CP_WEEK_REP_VIS_EMP" id="CP_WEEK_REP_VIS_EMP" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>When an Employer has shown interest in your future career path and elects to Follow your profile.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_EMP_INT_PATH_PROF'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_EMP_INT_PATH_PROF" class="CP_EMP_INT_PATH_PROF" id="CP_EMP_INT_PATH_PROF" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>Discover top Local, Regional, National & International Companies currently hiring in your industry.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_DIS_LOC_REG_NAT');  if($value){ echo $value; }else{ echo "No"; }?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_DIS_LOC_REG_NAT" class="CP_DIS_LOC_REG_NAT"  id="CP_DIS_LOC_REG_NAT" ><span></span>
												</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" msg="Recruiter Interactions">
								<thead>
									<tr>
										<th colspan="2">Recruiter Interactions</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Direct communication from a Recruiter, including resume request and other message.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_DIR_COM_FRM_RECTR'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_DIR_COM_FRM_RECTR" class="CP_DIR_COM_FRM_RECTR" id="CP_DIR_COM_FRM_RECTR" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>When you have been invited to participate in a Private Chat initiated by a Recruiter.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_PRI_CHAT_BY__RECT'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_PRI_CHAT_BY__RECT" class="CP_PRI_CHAT_BY__RECT" id="CP_PRI_CHAT_BY__RECT" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>A weekly report that showing you which Recruiter have viewed your profile.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_WEEK_REP_VIS_REC'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_WEEK_REP_VIS_REC" class="CP_WEEK_REP_VIS_REC" id="CP_WEEK_REP_VIS_REC" ><span></span>
												</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="table-responsive">
							<table class="table table-bordered" msg="Advice, Updates & Offers">
								<thead>
									<tr>
										<th colspan="2">Advice, Updates & Offers</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>To remain updated on EyeRecruit news, updates & special offers.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_UPDATED_EYE_NEWS'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_UPDATED_EYE_NEWS" class="CP_UPDATED_EYE_NEWS" id="CP_UPDATED_EYE_NEWS" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>Exclusive offers to help take your career to the next level & to get the most our of Eyerecruit.com</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_EXCLUSIVE_OFFERS'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_EXCLUSIVE_OFFERS" class="CP_EXCLUSIVE_OFFERS" id="CP_EXCLUSIVE_OFFERS" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>With helpful offers & updates from EyeRecruit Partners.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_OFFER_FRM_EYE_PAR'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_OFFER_FRM_EYE_PAR" class="CP_OFFER_FRM_EYE_PAR" id="CP_OFFER_FRM_EYE_PAR" ><span></span>
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>With Eyerecruit Newsletters with career advice, job search tips & inspiration.</td>
										<td class="tableicons">
											<div class="checkbox-slider--b">
												<label>
													<input type="checkbox" value="<?php $value = get_cimyFieldValue($user_id, 'CP_EYE_NEWS_CAR_ADV'); if($value){ echo $value; }else{ echo "No"; } ?>"  <?php if($value=='Yes'){ echo "checked"; }?>  name="CP_EYE_NEWS_CAR_ADV" class="CP_EYE_NEWS_CAR_ADV" id="CP_EYE_NEWS_CAR_ADV" ><span></span>
												</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>
					
					<div class="member_setting">
						<?php 
						/*if(is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel())
						{
							global $current_user;
							$current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
							$membershipLevel = $current_user->membership_level->name;
							$membershipLevelID = $current_user->membership_level->id;
						}
						else{
							$membershipLevel = '--';
						}*/
						?>
						<!-- <div class="sidebar_title cont_title">
							<h4>Membership Settings</h4>
						</div> -->
						<!-- <p>
							You are currently a <?php echo $membershipLevel; ?> Member. 
							<?php
							/*if ( $membershipLevelID != 4 ) {
								echo "<br>Go Ultimate for Unlimited access.";
							}*/
							?>
						</p> -->
						<!-- <a href="<?php //echo site_url(); ?>/seeker-pricing/" class="btn btn-primary">Upgrade</a> -->
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
				
		</div> --><!-- #content -->
		<!--
		<?//php do_action( 'jobify_loop_after' ); ?>
	</div> --><!-- #primary -->

	<?php endwhile; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){

			jQuery('.communication_prefer input:checkbox').on('click', function(){

				var msg = jQuery(this).closest('table').attr('msg');
				var user_id = jQuery('#cur_user_id').val();
				var field_names = jQuery(this).attr('name');
				if ( jQuery(this).is(':checked')){ 
					var field_values = 'Yes';
				}
				else{
					var field_values = 'No';
				}
				jQuery('#loaders').show();	
				jQuery.ajax({
					type : "POST",
					url : "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>",
					data : {
						action : 'communication_preferences',
						user_id : user_id,
						field_names : field_names,
						field_values: field_values
					},
					success : function(r){
						jQuery('#loaders').hide();
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>Successfully update communication preferences permission for "+msg+"</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				});
			});

		});
	</script>
<?php get_footer('preferences'); ?>


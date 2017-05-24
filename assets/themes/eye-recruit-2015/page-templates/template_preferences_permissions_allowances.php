<?php
/**
 * Template Name: Preferences permissions-allowances page
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
						<h3>Permissions & Allowances</h3>
						<input type="hidden" name="curr_user_id" id="curr_user_id" value="<?php $user_id = get_current_user_id(); echo $user_id; ?>">
						<span><strong>Recruit ID</strong> : <?php echo $user_id; ?></span>
					</div>
					<div class="per_allowance">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>What would you like the <span>Employer</span> to access</th>
										<th class="text-center">Show</th>
										<th class="text-center">With My <br>Permission</th>
									</tr>
								</thead>
								<tbody utype="Employer">
									<tr acc="Background Verification Report">
										<td>Allow my <strong>Background Verification Report</strong> to be viewed.</td>

											<?php $access1 = get_cimyFieldValue($user_id, 'PNA_BACK_VERI_REPORT'); ?>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_BACK_VERI_REPORT" id="PNA_BACK_VERI_REPORT_1" value="Yes" <?php if($access1=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_BACK_VERI_REPORT" id="PNA_BACK_VERI_REPORT_2" value="No" <?php if($access1!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Current Employer">
										<td>Allow my <strong>Current Employer</strong> to be viewed. (will be indicated as <strong>CONFIDENTIAL</strong>)</td>

										<?php $access2 = get_cimyFieldValue($user_id, 'PNA_CURRENT_EMPLOYER'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_CURRENT_EMPLOYER" id="PNA_CURRENT_EMPLOYER_1" value="Yes" <?php if($access2=='Yes') { echo 'checked="checked"'; }?> ><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_CURRENT_EMPLOYER" id="PNA_CURRENT_EMPLOYER_2" value="No" <?php if($access2!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Licensing Documents">
										<td>Allow my <strong>Licensing Documents</strong> to be viewed.</td>

										<?php $access3 = get_cimyFieldValue($user_id, 'PNA_LICENSING_DOC'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_LICENSING_DOC" id="PNA_LICENSING_DOC_1" value="Yes" <?php if($access3=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_LICENSING_DOC" id="PNA_LICENSING_DOC_2" value="No" <?php if($access3!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Honors & Awards">
										<td>Allow my <strong>Honors & Awards</strong> to be viewed.</td>

										<?php $access4 = get_cimyFieldValue($user_id, 'PNA_HONORS_N_AWARDS'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_HONORS_N_AWARDS" id="PNA_HONORS_N_AWARDS_1" value="Yes" <?php if($access4!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_HONORS_N_AWARDS" id="PNA_HONORS_N_AWARDS_2" value="No" <?php if($access4=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Photograph">
										<td>Allow my <strong>Photograph</strong> to be viewed after I begin communicating. (Specific parties only)</td>

										<?php $access5 = get_cimyFieldValue($user_id, 'PNA_PHOTOGRAPH'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_PHOTOGRAPH" id="PNA_PHOTOGRAPH_1" value="Yes" <?php if($access5!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_PHOTOGRAPH" id="PNA_PHOTOGRAPH_2" value="No" <?php if($access5=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Certifications">
										<td>Allow my <strong>Certifications</strong> to be viewed.</td>

										<?php $access6 = get_cimyFieldValue($user_id, 'PNA_CERTIFICATIONS'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_CERTIFICATIONS" id="PNA_CERTIFICATIONS_1" value="Yes" <?php if($access6!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_CERTIFICATIONS" id="PNA_CERTIFICATIONS_2" value="No" <?php if($access6=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Badges">
										<td>Allow my <strong>Badges</strong> to be viewed.</td>

										<?php $access7 = get_cimyFieldValue($user_id, 'PNA_BADGES'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_BADGES" id="PNA_BADGES_1" value="Yes" <?php if($access7!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_BADGES" id="PNA_BADGES_2" value="No" <?php if($access7=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Referrals">
										<td>Allow my <strong>Referrals</strong> to be viewed.</td>

										<?php $access8 = get_cimyFieldValue($user_id, 'PNA_REFERRALS'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_REFERRALS" id="PNA_REFERRALS_1" value="Yes" <?php if($access8!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_REFERRALS" id="PNA_REFERRALS_2" value="No" <?php if($access8=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Referenced">
										<td>Allow my <strong>References</strong> to be viewed.</td>

										<?php $access9 = get_cimyFieldValue($user_id, 'PNA_REFERENCED'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_REFERENCED" id="PNA_REFERENCED_1" value="Yes" <?php if($access9=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_REFERENCED" id="PNA_REFERENCED_2" value="No" <?php if($access9!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Education">
										<td>Allow my <strong>Education</strong> to be viewed.</td>

										<?php $access10 = get_cimyFieldValue($user_id, 'PNA_EDUCATION'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_EDUCATION" id="PNA_EDUCATION_1" value="Yes" <?php if($access10!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_EDUCATION" id="PNA_EDUCATION_2" value="No" <?php if($access10=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Self Assessments">
										<td>Allow my <strong>Self Assessments</strong> to be viewed.</td>

										<?php $access11 = get_cimyFieldValue($user_id, 'PNA_SELF_ASSESSMENTS'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_SELF_ASSESSMENTS" id="PNA_SELF_ASSESSMENTS_1" value="Yes" <?php if($access11!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_SELF_ASSESSMENTS" id="PNA_SELF_ASSESSMENT_2" value="No" <?php if($access11=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Cellular phone number">
										<td>Allow my <strong>cellular phone number</strong> to be viewed.</td>

										<?php $access12 = get_cimyFieldValue($user_id, 'PNA_CELL_PHONE_NO'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_1" name="PNA_CELL_PHONE_NO" id="PNA_CELL_PHONE_NO_1" value="Yes" <?php if($access12=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="employer_access_2" name="PNA_CELL_PHONE_NO" id="PNA_CELL_PHONE_NO_2" value="No" <?php if($access12!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="text-center">
							<span>Message & Data rates may apply</span>
							<a href="javascript:void(0)" id="restore_1" class="btn btn-default">Restore defaults</a>
						</div>
					</div>

					<div class="per_allowance">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>What would you like the <span>Recruiter</span> to access</th>
										<th class="text-center">Show</th>
										<th class="text-center">With My <br>Permission</th>
									</tr>
								</thead>
								<tbody utype="Recruiter">
									<tr acc="Background Verification Report">
										<td>Allow my <strong>Background Verification Report</strong> to be viewed.</td>

										<?php $access13 = get_cimyFieldValue($user_id, 'PNAR_BACK_VERI_REP'); ?>

										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_BACK_VERI_REP" id="PNAR_BACK_VERI_REP_1" value="Yes" <?php if($access13!='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_BACK_VERI_REP" id="PNAR_BACK_VERI_REP_2" value="No" <?php if($access13=='No') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Current Employer">
										<td>Allow my <strong>Current Employer</strong> to be viewed. (will be indicated as <strong>CONFIDENTIAL</strong>)</td>

										<?php $access14 = get_cimyFieldValue($user_id, 'PNAR_CURRENT_EMPLOY'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_CURRENT_EMPLOY" id="PNAR_CURRENT_EMPLOY_1" value="Yes" <?php if($access14=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_CURRENT_EMPLOY" id="PNAR_CURRENT_EMPLOY_2" value="No" <?php if($access14!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Licensing Documents">
										<td>Allow my <strong>Licensing Documents</strong> to be viewed.</td>

										<?php $access15 = get_cimyFieldValue($user_id, 'PNAR_LICENSING_DOC'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_LICENSING_DOC" id="PNAR_LICENSING_DOC_1" value="Yes" <?php if($access15=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_LICENSING_DOC" id="PNAR_LICENSING_DOC_2" value="No" <?php if($access15!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Honors & Awards">
										<td>Allow my <strong>Honors & Awards</strong> to be viewed.</td>

										<?php $access16 = get_cimyFieldValue($user_id, 'PNAR_HONORS_N_AWARD'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_HONORS_N_AWARD" id="PNAR_HONORS_N_AWARD_1" value="Yes" <?php if($access16=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_HONORS_N_AWARD" id="PNAR_HONORS_N_AWARD_2" value="No" <?php if($access16!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Photograph">
										<td>Allow my <strong>Photograph</strong> to be viewed.</td>

										<?php $access17 = get_cimyFieldValue($user_id, 'PNAR_PHOTOGRAPH'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_PHOTOGRAPH" id="PNAR_PHOTOGRAPH_1" value="Yes" <?php if($access17=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_PHOTOGRAPH" id="PNAR_PHOTOGRAPH_2" value="No" <?php if($access17!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Certifications">
										<td>Allow my <strong>Certifications</strong> to be viewed.</td>

										<?php $access18 = get_cimyFieldValue($user_id, 'PNAR_CERTIFICATIONS'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_CERTIFICATIONS" id="PNAR_CERTIFICATIONS_1" value="Yes" <?php if($access18=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_CERTIFICATIONS" id="PNAR_CERTIFICATIONS_2" value="No" <?php if($access18!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Badges">
										<td>Allow my <strong>Badges</strong> to be viewed.</td>

										<?php $access19 = get_cimyFieldValue($user_id, 'PNAR_BADGES'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_BADGES" id="PNAR_BADGES_1" value="Yes" <?php if($access19=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_BADGES" id="PNAR_BADGES_2" value="No" <?php if($access19!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Referrals">
										<td>Allow my <strong>Referrals</strong> to be viewed.</td>

										<?php $access20 = get_cimyFieldValue($user_id, 'PNAR_REFERRALS'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_REFERRALS" id="PNAR_REFERRALS_1" value="Yes" <?php if($access20=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_REFERRALS" id="PNAR_REFERRALS_2" value="No" <?php if($access20!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Referenced">
										<td>Allow my <strong>References</strong> to be viewed.</td>

										<?php $access21 = get_cimyFieldValue($user_id, 'PNAR_REFERENCED'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_REFERENCED" id="PNAR_REFERENCED_1" value="Yes" <?php if($access21=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_REFERENCED" id="PNAR_REFERENCED_2" value="No" <?php if($access21!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Education">
										<td>Allow my <strong>Education</strong> to be viewed.</td>

										<?php $access22 = get_cimyFieldValue($user_id, 'PNAR_EDUCATION'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_EDUCATION" id="PNAR_EDUCATION_1" value="Yes" <?php if($access22=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_EDUCATION" id="PNAR_EDUCATION_2" value="No" <?php if($access22!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Self Assessments">
										<td>Allow my <strong>Self Assessments</strong> to be viewed.</td>

										<?php $access23 = get_cimyFieldValue($user_id, 'PNAR_SELF_ASSESSMENT'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_SELF_ASSESSMENT" id="PNAR_SELF_ASSESSMENT_1" value="Yes" <?php if($access23=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_SELF_ASSESSMENT" id="PNAR_SELF_ASSESSMENT_2" value="No" <?php if($access23!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
									<tr acc="Cellular phone number">
										<td>Allow my <strong>cellular phone number</strong> to be viewed.</td>

										<?php $access24 = get_cimyFieldValue($user_id, 'PNAR_CELL_PHONE_NO'); ?>
										
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_1" name="PNAR_CELL_PHONE_NO" id="PNAR_CELL_PHONE_NO_1" value="Yes" <?php if($access24=='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
										<td class="tableicons">
											<div class="radio"><label><input type="radio" class="recruiter_access_2" name="PNAR_CELL_PHONE_NO" id="PNAR_CELL_PHONE_NO_2" value="No" <?php if($access24!='Yes') { echo 'checked="checked"'; }?>><span></span></label></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="text-center">
							<span>Message & Data rates may apply</span>
							<a href="javascript:void(0)" id="restore_2" class="btn btn-default">Restore defaults</a>
						</div>
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
			jQuery("#restore_1").on('click', function(){
				jQuery('#loaders').show();
				var user_id = jQuery('#curr_user_id').val();	
				jQuery('.employer_access_1').prop("checked", true);
				jQuery.ajax({
					type : 'POST',
					url : '<?php echo site_url('/wp-admin/admin-ajax.php'); ?>',
					data : {
						action : 'permissions_n_allowances_for_default_emp',
						user_id : user_id
					},
					success:function(r){
						jQuery('#loaders').hide();
						jQuery('#PNA_BACK_VERI_REPORT_2').prop("checked", true);
						jQuery('#PNA_CURRENT_EMPLOYER_2').prop("checked", true);
						jQuery('#PNA_LICENSING_DOC_2').prop("checked", true);
						jQuery('#PNA_CELL_PHONE_NO_2').prop("checked", true);
						jQuery('#PNA_REFERENCED_2').prop("checked", true);
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>You have successfully restored what you would like the Employer to access to the default settings.</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});

					}
				});
			});
			jQuery("#restore_2").on('click', function(){
				jQuery('#loaders').show();
				var user_id = jQuery('#curr_user_id').val();
				jQuery('.recruiter_access_1').prop("checked", true);
				jQuery.ajax({
					type : 'POST',
					url : '<?php echo site_url('/wp-admin/admin-ajax.php'); ?>',
					data : {
						action : 'permissions_n_allowances_for_default_rec',
						user_id : user_id
					},
					success:function(r){
						jQuery('#loaders').hide();
						jQuery('#PNAR_BACK_VERI_REP_2').prop("checked", true);
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>You have successfully restored what you would like the Recruiter to access to the default settings.</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				});
			});
			jQuery('.sidemenu_border input:radio').on('change', function(){
				jQuery('#loaders').show();
				var acc = jQuery(this).closest('tr').attr('acc');
				var utype = jQuery(this).closest('tbody').attr('utype');
				var field_names = jQuery(this).attr('name');
				var field_values = jQuery(this).val();
				var user_id = jQuery('#curr_user_id').val();
				if ( field_values == 'Yes' ) {
					var msg = acc;
				}
				else{
					var msg = acc+' the Employer to access';
				}

				jQuery.ajax({
					type : 'POST',
					url : '<?php echo site_url('/wp-admin/admin-ajax.php'); ?>',
					data : {
						action : 'permissions_n_allowances',
						user_id : user_id,
						field_names : field_names,
						field_values : field_values,
						acc: acc,
						utype: utype,
					},
					success:function(r){
						jQuery('#loaders').hide();
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>You have successfully allowed view "+msg+".</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});


					}
				});
			});
		});
	</script>
<?php get_footer('preferences'); 




<?php
/**
 * Template Name:Employers Basic Information
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
if ( is_user_logged_in() ) {
	$current_user_id = get_current_user_id();
}
else{
	echo wp_redirect( site_url() );
}


get_header(); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>
 	
	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php get_template_part( 'Employer/content', 'emp_preferences_sidemenu' ); ?>
				</div>

				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Update Basic Information</h3>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id; ?></span>
					</div>
					<div class="indent-x">
						
						<form id="profilebuder4390" method="post" action="" enctype="multipart/form-data">
								
							<div class="profilestep_inner">

								<div class="basic_info_step_1 basic_info_steps" style="display:block;">

									<div class="form-group opportunity">
										<p><strong>What is your position in the organization?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_YR_POS_IN_ORGN_db_value = get_cimyFieldValue($current_user_id, 'EMP_YR_POS_IN_ORGN');
												if ( !empty($EMP_YR_POS_IN_ORGN_db_value) ) {
													$EMP_YR_POS_IN_ORGN_db_value = explode(',', $EMP_YR_POS_IN_ORGN_db_value);
												}
												else{
													$EMP_YR_POS_IN_ORGN_db_value = array();
												}
												$EMP_YR_POS_IN_ORGN_array = array('Executive (CxO)','Vice President (HR)','Vice President (Recruiting)','Vice President (Other)','Director (HR)','Director (Recruiting)','Director (other)','Manager (HR)','Manager (Other)','Manager (recruiting)','Recruiting Other','HR Other','Consultant');
												foreach ($EMP_YR_POS_IN_ORGN_array as $value) { ?>
													<div class="checkbox">
														<label>
															<input type="checkbox" <?php if(in_array($value, $EMP_YR_POS_IN_ORGN_db_value)){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_YR_POS_IN_ORGN" name="EMP_YR_POS_IN_ORGN[]"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
											 	} 
											?>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>How many Employees are currently on your team?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_NO_EMP_ON_TEAM_db_value = get_cimyFieldValue($current_user_id, 'EMP_NO_EMP_ON_TEAM');

												$EMP_NO_EMP_ON_TEAM_array = array('Less than 20', '21-50', '51-100', '101-300', '301-500', '501-1000', '1001-2000', '2001-5000', '5000+'); 
												foreach($EMP_NO_EMP_ON_TEAM_array as $value) { ?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_NO_EMP_ON_TEAM_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_NO_EMP_ON_TEAM" name="EMP_NO_EMP_ON_TEAM"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
												} 
											?>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>How many years experience do you have?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_EXPERIENCE_db_value = get_cimyFieldValue($current_user_id, 'EMP_EXPERIENCE'); 
											?>
											<input type="text" name="EMP_EXPERIENCE" value="<?php echo $EMP_EXPERIENCE_db_value; ?>" placeholder="Experience" >
											
										</div>
									</div>
								</div>

								<div class="basic_info_step_2 basic_info_steps" style="display:none;">

									<div class="form-group Miles">
										<p><strong>What area would we be asked to search?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_AREA_TO_B_SEARCH_db_value = get_cimyFieldValue($current_user_id, 'EMP_AREA_TO_B_SEARCH');	
												$EMP_AREA_TO_B_SEARCH_array = array('United States', 'The Central & South Americas', 'Europe', 'Middle East', 'Africa', 'Asia Pacific'); 
												foreach($EMP_AREA_TO_B_SEARCH_array as $value) { 

													if ( $EMP_AREA_TO_B_SEARCH_db_value == 'United States' ) {
														$viewrae = '';
													}
													else{
														$viewrae = 'style="display:none;"	';
													}

													?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_AREA_TO_B_SEARCH_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_AREA_TO_B_SEARCH1" name="EMP_AREA_TO_B_SEARCH"> <span><?php echo $value; ?></span>
														</label>
													</div> <?php 
													if($value=='United States') { ?>
														<div class="form-group has-feedback" id="EMP_STATES_OF_US_CONTAINER" <?php echo $viewrae; ?>>
															<select name="EMP_STATES_OF_US" class="EMP_STATES_OF_US" >
																<?php 
																	$EMP_STATES_OF_US_db_value = get_cimyFieldValue($current_user_id, 'EMP_STATES_OF_US');
																	$EMP_STATES_OF_US_array = array('Northeast', 'Southeast', 'Midwest', 'Southwest', 'West'); 
																	echo "<option value=''>Please Select</option>";
																	foreach($EMP_STATES_OF_US_array as $value1){ ?>
																		<option <?php if($value1 == $EMP_STATES_OF_US_db_value){ echo 'selected="selected"'; } ?> value="<?php echo $value1; ?>" ><?php echo $value1; ?></option><?
																	} 
																?>
															</select>
															<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
														</div> <?php 
													}  
												} 
											?>
										</div>
										
									</div>

									<div class="form-group opportunity">
										<p><strong>Please select the industry that best reflects your companies main services?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_INDUS_REF_SRVICE_db_value = get_cimyFieldValue($current_user_id, 'EMP_INDUS_REF_SRVICE'); 
												$EMP_INDUS_REF_SRVICE_db_value = explode(',', $EMP_INDUS_REF_SRVICE_db_value);
												$EMP_INDUS_REF_SRVICE_array = array('Investigation', 'Surveillance', 'Security', 'Risk Management ', 'Information Technology (IT)');
												foreach ($EMP_INDUS_REF_SRVICE_array as $value) { ?>
													<div class="checkbox">
														<label>
															<input type="checkbox" <?php if(in_array($value, $EMP_INDUS_REF_SRVICE_db_value)){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_INDUS_REF_SRVICE" name="EMP_INDUS_REF_SRVICE[]"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
												} 
											?>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>Provide company licensing information</strong></p>
										<div class="indent-2x">
											<?php $EMP_CMPNY_LIS_INFO_db_value = get_cimyFieldValue($current_user_id, 'EMP_CMPNY_LIS_INFO'); ?>	
												<div class="form-group">
													<textarea class="EMP_CMPNY_LIS_INFO" name="EMP_CMPNY_LIS_INFO"><?php echo $EMP_CMPNY_LIS_INFO_db_value; ?></textarea>
												</div>	
										</div>
									</div>
								</div>

								<div class="basic_info_step_3 basic_info_steps" style="display:none;">
									<div class="form-group Miles">
										<p><strong>For the right team member, would relocation be suggested? </strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_WUD_RELOC_SUGGES_db_value = get_cimyFieldValue($current_user_id, 'EMP_WUD_RELOC_SUGGES'); 
												$EMP_WUD_RELOC_SUGGES_array = array('Yes', 'No');
												foreach($EMP_WUD_RELOC_SUGGES_array as $value){ ?>	
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_WUD_RELOC_SUGGES_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_WUD_RELOC_SUGGES" name="EMP_WUD_RELOC_SUGGES"> <span><?php echo $value; ?></span>
														</label>
													</div> <?php
												}
											?>
										</div>
									</div>

									<div class="relocation_related_ques <?php echo ($EMP_WUD_RELOC_SUGGES_db_value == 'Yes')? '':'hide'; ?>">

										<div class="form-group Miles">
											<p><strong>Please describe what the company provides as a relocation incentive.</strong></p>
											<div class="indent-2x">
												<div class="form-group">
													<?php $EMP_CPY_REL_INCN_DES_db_value = get_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN_DES'); ?>
													<textarea class="EMP_CPY_REL_INCN_DES" name="EMP_CPY_REL_INCN_DES"><?php echo $EMP_CPY_REL_INCN_DES_db_value; ?></textarea>
												</div>
												<?php 
													$EMP_CPY_REL_INCN_db_value = get_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN'); 
													$EMP_CPY_REL_INCN_array = array('None', 'Unknown'); 
													foreach($EMP_CPY_REL_INCN_array as $value){ ?>	
														<div class="radio">
															<label>
																<input type="radio" <?php if($value == $EMP_CPY_REL_INCN_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_CPY_REL_INCN" name="EMP_CPY_REL_INCN"> <span><?php echo $value; ?></span>
															</label>
														</div>
														<?php
													}
												?>
											</div>						
										</div>

										<div class="form-group Miles">
											<p><strong>How much does your company allocate annually on relocation?</strong></p>
											<div class="indent-2x checkbox">
												<div class="form-group">
													<?php $EMP_CMNY_ALLOC_ANUAL_db_value = get_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_ANUAL'); ?>
														<textarea class="EMP_CMNY_ALLOC_ANUAL" name="EMP_CMNY_ALLOC_ANUAL"><?php echo $EMP_CMNY_ALLOC_ANUAL_db_value; ?></textarea>
												</div>
												<label>
													<?php $EMP_CMNY_ALLOC_UNON_db_value = get_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_UNON'); ?>
													<input type="checkbox" <?php if( $EMP_CMNY_ALLOC_UNON_db_value == 'Unknown' ){ echo 'checked="checked"'; } ?> value="Unknown" class="EMP_CMNY_ALLOC_UNON" name="EMP_CMNY_ALLOC_UNON"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>Does your company currently offer signing bonuses and other incentives?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_OFER_SIGNING_BON_db_value = get_cimyFieldValue($current_user_id, 'EMP_OFER_SIGNING_BON'); 
												$EMP_OFER_SIGNING_BON_array = array('Yes', 'No'); 
												foreach($EMP_OFER_SIGNING_BON_array as $value){ ?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_OFER_SIGNING_BON_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_OFER_SIGNING_BON" name="EMP_OFER_SIGNING_BON"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
												}
											?>
										</div>
									</div>

									<div class="signing_bonuses_ques <?php echo ($EMP_OFER_SIGNING_BON_db_value == 'Yes')? '':'hide'; ?>">
										<div class="form-group Miles">
											<p><strong>Please describe what the company provides in the form of a signing bonus or incentive.</strong></p>
											<div class="indent-2x checkbox">
												<div class="form-group">
													<?php $EMP_CPNY_SIG_BON_DES_db_value = get_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON_DES'); ?>
													<textarea class="EMP_CPNY_SIG_BON_DES" name="EMP_CPNY_SIG_BON_DES"><?php echo $EMP_CPNY_SIG_BON_DES_db_value; ?></textarea>
												</div>
												<label>
													<?php $EMP_CPNY_SIG_BON_db_value = get_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON'); ?>
													<input type="checkbox" <?php if($EMP_CPNY_SIG_BON_db_value == 'Unknown'){ echo 'checked="checked"'; } ?> value="Unknown" class="EMP_CPNY_SIG_BON" name="EMP_CPNY_SIG_BON"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="basic_info_step_4 basic_info_steps" style="display:none;">
									<div class="form-group Miles">
										<p><strong>Briefly, what makes your organization unique for Employees & Job Seekers?</strong></p>
										<div class="indent-2x checkbox">
											<?php $EMP_ORG_UNQ_FR_EMP_D_db_value = get_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP_D'); ?>
											<div class="form-group">
												<textarea class="EMP_ORG_UNQ_FR_EMP_D" name="EMP_ORG_UNQ_FR_EMP_D"><?php echo $EMP_ORG_UNQ_FR_EMP_D_db_value; ?></textarea>
											</div>
											<?php $EMP_ORG_UNQ_FR_EMP_db_value = get_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP'); ?>
											<label>
												<input type="checkbox" <?php if($EMP_ORG_UNQ_FR_EMP_db_value == 'Unknown'){ echo 'checked="checked"'; } ?> value="Unknown" class="EMP_ORG_UNQ_FR_EMP" name="EMP_ORG_UNQ_FR_EMP"> <span>Unknown</span>
											</label>
										</div>
									</div>
							
									<div class="form-group Miles">
										<p><strong>Do you have team members in multiple locations?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_TEAM_IN_MULTILOC_db_value = get_cimyFieldValue($current_user_id, 'EMP_TEAM_IN_MULTILOC'); 
												$EMP_TEAM_IN_MULTILOC_array = array('Yes', 'No'); 
												foreach($EMP_TEAM_IN_MULTILOC_array as $value){ ?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_TEAM_IN_MULTILOC_db_value ){ echo 'checked="checked"';} ?> value="<?php echo $value; ?>" class="EMP_TEAM_IN_MULTILOC" name="EMP_TEAM_IN_MULTILOC"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
												}
											?>
										</div>
									</div>

									<div class="team_in_multilocations_ques <?php echo ($EMP_TEAM_IN_MULTILOC_db_value == 'Yes')?'':'hide'; ?>">
										<div class="form-group opportunity">
											<p><strong>Which states do you currently have offices?</strong></p>
											<div class="indent-2x">
												<ul class="radio-group radio-group-1-3">
													<?php 
													$EMP_OFFICES_IN_STATE_db_value = get_cimyFieldValue($current_user_id, 'EMP_OFFICES_IN_STATE');
													if(!empty($EMP_OFFICES_IN_STATE_db_value)){
														$EMP_OFFICES_IN_STATE_db_value = explode(',', $EMP_OFFICES_IN_STATE_db_value);
													}
													else{
														$EMP_OFFICES_IN_STATE_db_value = array();
													}
													$EMP_OFFICES_IN_STATE_array = array('Alaska', 'Alabama', 'Arkansas', 'Arizona', 'California', 'Colorado', 'Connecticut', 'District of Columbia', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Iowa', 'Idaho', 'Illinois', 'Indiana', 'Kansas', 'Kentucky', 'Louisiana', 'Massachusetts', 'Maryland', 'Maine', 'Michigan', 'Minnesota', 'Missouri', 'Mississippi', 'Montana', 'North Carolina', 'North Dakota', 'Nebraska', 'New Hampshire', 'New Jersey', 'New Mexico', 'Nevada', 'New York', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Virginia', 'Vermont', 'Washington', 'Wisconsin', 'West Virginia', 'Wyoming');
													foreach($EMP_OFFICES_IN_STATE_array as $value){
														?>
														<li>
														<div class="checkbox">
															<label>
																<input type="checkbox" <?php if(in_array($value, $EMP_OFFICES_IN_STATE_db_value)){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_OFFICES_IN_STATE" name="EMP_OFFICES_IN_STATE[]"> <span><?php echo $value; ?></span>
															</label>
														</div>
														</li>
													<?php } ?>
												</ul>
											</div>
										</div>

										<div class="form-group Miles">
											<p><strong>Does each location have the authority to make hiring decisions?</strong></p>
											<div class="indent-2x">
												<?php 
												$EMP_HAV_TEAM_IN_MULT_db_value = get_cimyFieldValue($current_user_id, 'EMP_HAV_TEAM_IN_MULT'); 
												$EMP_TEAM_IN_MULTILOC_array = array('Yes', 'No'); 
												foreach($EMP_TEAM_IN_MULTILOC_array as $value){ ?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_HAV_TEAM_IN_MULT_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_HAV_TEAM_IN_MULT" name="EMP_HAV_TEAM_IN_MULT"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
													}
												?>
											</div>
										</div>
									</div>

									<div class="location_have_multi_decisions_ques <?php echo ($EMP_HAV_TEAM_IN_MULT_db_value == 'Yes')?'':'hide'; ?>">
										
										<div class="form-group opportunity">
											<p><strong>What job posting methods do you currently use to find qualified applicants?</strong></p>
											<div class="indent-2x">
												
												<?php 
												$EMP_JOB_POSTNG_METH_db_value = get_cimyFieldValue($current_user_id, 'EMP_JOB_POSTNG_METH');
												if(!empty($EMP_JOB_POSTNG_METH_db_value)){
													$EMP_JOB_POSTNG_METH_db_value = explode(',', $EMP_JOB_POSTNG_METH_db_value);
												}
												else{
													$EMP_JOB_POSTNG_METH_db_value = array();
												}
												$EMP_JOB_POSTNG_METH_array = array('Word-of-mouth', 'Facebook', 'Company site', 'Job Boards', 'Employee referrals', 'Linked In', 'Recruiter');
												foreach($EMP_JOB_POSTNG_METH_array as $value){
													?>
													<div class="checkbox">
														<label>
															<input type="checkbox" <?php if(in_array($value, $EMP_JOB_POSTNG_METH_db_value)){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_JOB_POSTNG_METH" name="EMP_JOB_POSTNG_METH[]"> <span><?php echo $value; ?></span>
														</label>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>

								<div class="basic_info_step_5 basic_info_steps" style="display:none;">

									<div class="form-group Miles">
										<p><strong>Your company name:</strong></p>
										<div class="indent-2x">
											<?php 
												$company_db_value = get_user_meta($current_user_id, 'company', true); 
											?>
											<input type="text" name="company_name" value="<?php echo $company_db_value; ?>" placeholder="Your company name" >
											
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>Are internships available at your company?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_R_INTRNSIP_AVBL_db_value = get_cimyFieldValue($current_user_id, 'EMP_R_INTRNSIP_AVBL'); 
												$EMP_R_INTRNSIP_AVBL_array = array('Yes', 'No'); 
												foreach($EMP_R_INTRNSIP_AVBL_array as $value){ ?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_R_INTRNSIP_AVBL_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_R_INTRNSIP_AVBL" name="EMP_R_INTRNSIP_AVBL"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
												}
											?>
										</div>
									</div>

									<div class="internships_in_compny_ques <?php echo ($EMP_R_INTRNSIP_AVBL_db_value == 'Yes')? '':'hide'; ?>">
										<div class="form-group Miles">
											<p><strong>At what University or Programs are the interns typically located?</strong></p>
											<?php $EMP_UNI_PRG_INT_LOC_db_value = get_cimyFieldValue($current_user_id, 'EMP_UNI_PRG_INT_LOC'); ?>
												<div class="form-group indent-2x">
													<textarea class="EMP_UNI_PRG_INT_LOC" name="EMP_UNI_PRG_INT_LOC"><?php echo $EMP_UNI_PRG_INT_LOC_db_value; ?></textarea>
												</div>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>What is more important: the hourly expenditure of the team member or the final results produced?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_WHAT_IS_MOR_IMP_db_value = get_cimyFieldValue($current_user_id, 'EMP_WHAT_IS_MOR_IMP'); 
												$EMP_WHAT_IS_MOR_IMP_array = array('How much it costs per hour for the team member.', 'The results we are able to obtain within the billable hour.'); 
												foreach($EMP_WHAT_IS_MOR_IMP_array as $value){ ?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_WHAT_IS_MOR_IMP_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_WHAT_IS_MOR_IMP" name="EMP_WHAT_IS_MOR_IMP"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
												}
											?>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>What is the annual expenditure on third-party vendor services such as employment related background checks, credit checks, prescreening services, surveys, and so on?</strong></p>
										<div class="indent-2x">
											<div class="form-group">
												<?php $EMP_ANUAL_EXP_ON_VEN_db_value = get_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_ON_VEN'); ?>
												<textarea class="EMP_ANUAL_EXP_ON_VEN" name="EMP_ANUAL_EXP_ON_VEN"><?php echo $EMP_ANUAL_EXP_ON_VEN_db_value; ?></textarea>
											</div>
											<div class="checkbox">
												<label>
													<?php $EMP_ANUAL_EXP_VEN_db_value = get_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_VEN'); ?>	
													<input type="checkbox" <?php if($EMP_ANUAL_EXP_VEN_db_value == 'Unknown'){ echo 'checked="checked"'; }?> value="Unknown" class="EMP_ANUAL_EXP_VEN" name="EMP_ANUAL_EXP_VEN"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>How much does your company spend annually on external job postings, such as the following:</strong></p>
										<?php
											$EMP_CNY_SPND_ON_JOB_db_value = get_cimyFieldValue($current_user_id, 'EMP_CNY_SPND_ON_JOB'); 
											$EMP_INTRNT_JOB_BOARD_db_value = get_cimyFieldValue($current_user_id, 'EMP_INTRNT_JOB_BOARD'); 
											$EMP_PPR_BSE_BULL_BOA_db_value = get_cimyFieldValue($current_user_id, 'EMP_PPR_BSE_BULL_BOA'); 
											$EMP_KIOSKS_DESC_db_value = get_cimyFieldValue($current_user_id, 'EMP_KIOSKS_DESC'); 
										?>
										<div class="indent-2x">
											<div class="radio">
												<label>
													<input type="radio" value="Internet job boards" <?php echo ($EMP_CNY_SPND_ON_JOB_db_value == 'Internet job boards')? 'checked="checked"':''; ?> class="EMP_CNY_SPND_ON_JOB" name="EMP_CNY_SPND_ON_JOB"> <span>Internet job boards</span>
												</label>
											</div>
											<textarea class="EMP_INTRNT_JOB_BOARD <?php echo ($EMP_CNY_SPND_ON_JOB_db_value == 'Internet job boards')? '':'hide'; ?>" id="EMP_INTRNT_JOB_BOARD" name="EMP_INTRNT_JOB_BOARD"><?php echo $EMP_INTRNT_JOB_BOARD_db_value; ?></textarea>

											<div class="radio">
												<label>
													<input type="radio" value="Paper-based bulletin boards" class="EMP_CNY_SPND_ON_JOB" <?php echo ($EMP_CNY_SPND_ON_JOB_db_value == 'Paper-based bulletin boards')? 'checked="checked"':''; ?> name="EMP_CNY_SPND_ON_JOB"> <span>Paper-based bulletin boards</span>
												</label>
											</div>
											<textarea class="EMP_PPR_BSE_BULL_BOA <?php echo ($EMP_CNY_SPND_ON_JOB_db_value == 'Paper-based bulletin boards')? '':'hide'; ?>" id="EMP_PPR_BSE_BULL_BOA" name="EMP_PPR_BSE_BULL_BOA"><?php echo $EMP_PPR_BSE_BULL_BOA_db_value; ?></textarea>

											<div class="radio">
												<label>
													<input type="radio" value="Kiosks" class="EMP_CNY_SPND_ON_JOB" <?php echo ($EMP_CNY_SPND_ON_JOB_db_value == 'Kiosks')? 'checked="checked"':''; ?> name="EMP_CNY_SPND_ON_JOB"> <span>Kiosks</span>
												</label>
											</div>
											<textarea class="EMP_KIOSKS_DESC <?php echo ($EMP_CNY_SPND_ON_JOB_db_value == 'Kiosks')? '':'hide'; ?>" id="EMP_KIOSKS_DESC" name="EMP_KIOSKS_DESC"><?php echo $EMP_KIOSKS_DESC_db_value; ?></textarea>

											<div class="radio">
												<label>
													<input type="radio" value="Unknown" class="EMP_CNY_SPND_ON_JOB" <?php echo ($EMP_CNY_SPND_ON_JOB_db_value == 'Unknown')? 'checked="checked"':''; ?> name="EMP_CNY_SPND_ON_JOB"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="basic_info_step_6 basic_info_steps" style="display:none;">
									<div class="form-group Miles">
										<p><strong>How many resumes are processed annually? </strong></p>
										<div class="indent-2x">
											<?php $EMP_HOW_MNY_RES_DESC_db_value = get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES_DESC'); ?>	
											<textarea class="EMP_HOW_MNY_RES_DESC" name="EMP_HOW_MNY_RES_DESC"><?php echo $EMP_HOW_MNY_RES_DESC_db_value; ?></textarea>
											<div class="checkbox">
												<label>
													<?php $EMP_HOW_MNY_RES_db_value = get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES'); ?>
													<input type="checkbox" value="Unknown" <?php echo ($EMP_HOW_MNY_RES_db_value == 'Unknown')? 'checked':''; ?> class="EMP_HOW_MNY_RES" name="EMP_HOW_MNY_RES"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>How many full-time Employees are allocated to the processing of resumes and applications?</strong></p>
										<div class="indent-2x">
											<?php $EMP_HOW_MNY_FUL_TM_D_db_value = get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM_D'); ?>
											<textarea class="EMP_HOW_MNY_FUL_TM_D" name="EMP_HOW_MNY_FUL_TM_D"><?php echo $EMP_HOW_MNY_FUL_TM_D_db_value; ?></textarea>
											<div class="checkbox">
												<label>
													<?php $EMP_HOW_MNY_FUL_TM_db_value = get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM'); ?>	
													<input type="checkbox" value="Unknown" <?php echo ($EMP_HOW_MNY_FUL_TM_db_value == 'Unknown')? 'checked':''; ?> class="EMP_HOW_MNY_FUL_TM" name="EMP_HOW_MNY_FUL_TM"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>What is the average, fully burdened, hourly rate paid to the employees who process resumes and applications?</strong></p>
										<div class="indent-2x">
											<?php $EMP_WHT_AVG_BURD_DES_db_value = get_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD_DES'); ?>		
											<textarea class="EMP_WHT_AVG_BURD_DES" name="EMP_WHT_AVG_BURD_DES"><?php echo $EMP_WHT_AVG_BURD_DES_db_value; ?></textarea>
											<div class="checkbox">
												<label>
													<?php $EMP_WHT_AVG_BURD_db_value = get_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD'); ?>
													<input type="checkbox" value="Unknown" <?php echo ($EMP_WHT_AVG_BURD_db_value == 'Unknown')? 'checked':''; ?> class="EMP_WHT_AVG_BURD" name="EMP_WHT_AVG_BURD"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>
								
									
									<div class="form-group Miles">
										<p><strong>What is the approximate percentage of the total resumes received in a fiscal quarter from each of the following sources?</strong></p>
										<div class="indent-2x">
											<?php $EMP_PER_RES_RVD_db_value = get_cimyFieldValue($current_user_id, 'EMP_PER_RES_RVD'); ?>
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes1" <?php echo ($EMP_PER_RES_RVD_db_value == 'Unsolicited mail?')? 'checked':''; ?> value="Unsolicited mail?" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Unsolicited mail?</span>
												</label>
											</div>
										
											<textarea id="EMP_UNSOLICITED_MAIL" class="EMP_UNSOLICITED_MAIL <?php echo ($EMP_PER_RES_RVD_db_value == 'Unsolicited mail?')? '':'hide'; ?>" name="EMP_UNSOLICITED_MAIL"><?php echo get_cimyFieldValue($current_user_id, 'EMP_UNSOLICITED_MAIL'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes2" <?php echo ($EMP_PER_RES_RVD_db_value == 'Recruitment print advertising, including advertising in newspapers, magazines, and so on?')? 'checked':''; ?> value="Recruitment print advertising, including advertising in newspapers, magazines, and so on?" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Recruitment print advertising, including advertising in newspapers, magazines, and so on?</span>
												</label>
											</div>
										
											<textarea id="EMP_REQ_PRINT_ADDS" class="EMP_REQ_PRINT_ADDS <?php echo ($EMP_PER_RES_RVD_db_value == 'Recruitment print advertising, including advertising in newspapers, magazines, and so on?')? '':'hide'; ?>" name="EMP_REQ_PRINT_ADDS"><?php echo get_cimyFieldValue($current_user_id, 'EMP_REQ_PRINT_ADDS'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes3" <?php echo ($EMP_PER_RES_RVD_db_value == 'Outside staffing firms?')? 'checked':''; ?> value="Outside staffing firms?" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Outside staffing firms?</span>
												</label>
											</div>
										
											<textarea id="EMP_OUT_STAFF_FIRMS" class="EMP_OUT_STAFF_FIRMS <?php echo ($EMP_PER_RES_RVD_db_value == 'Outside staffing firms?')? '':'hide'; ?>" name="EMP_OUT_STAFF_FIRMS"><?php echo get_cimyFieldValue($current_user_id, 'EMP_OUT_STAFF_FIRMS'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes4" <?php echo ($EMP_PER_RES_RVD_db_value == 'Job fairs?')? 'checked':''; ?> value="Job fairs?" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Job fairs?</span>
												</label>
											</div>
										
											<textarea id="EMP_JOB_FAIRS_SELECT" class="EMP_JOB_FAIRS_SELECT <?php echo ($EMP_PER_RES_RVD_db_value == 'Job fairs?')? '':'hide'; ?>" name="EMP_JOB_FAIRS_SELECT"><?php echo get_cimyFieldValue($current_user_id, 'EMP_JOB_FAIRS_SELECT'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes5" <?php echo ($EMP_PER_RES_RVD_db_value == 'Campus recruitment?')? 'checked':''; ?> value="Campus recruitment?" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Campus recruitment?</span>
												</label>
											</div>
										
											<textarea id="EMP_CAMPUS_RECRUIT" class="EMP_CAMPUS_RECRUIT <?php echo ($EMP_PER_RES_RVD_db_value == 'Campus recruitment?')? '':'hide'; ?>" name="EMP_CAMPUS_RECRUIT"><?php echo get_cimyFieldValue($current_user_id, 'EMP_CAMPUS_RECRUIT'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes6" <?php echo ($EMP_PER_RES_RVD_db_value == 'Internet advertising and posting boards?')? 'checked':''; ?> value="Internet advertising and posting boards?" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Internet advertising and posting boards?</span>
												</label>
											</div>
										
											<textarea id="EMP_INT_AD_N_POST_BO" class="EMP_INT_AD_N_POST_BO <?php echo ($EMP_PER_RES_RVD_db_value == 'Internet advertising and posting boards?')? '':'hide'; ?>" name="EMP_INT_AD_N_POST_BO"><?php echo get_cimyFieldValue($current_user_id, 'EMP_INT_AD_N_POST_BO'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes7" <?php echo ($EMP_PER_RES_RVD_db_value == 'Employee referrals?')? 'checked':''; ?> value="Employee referrals?" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Employee referrals?</span>
												</label>
											</div>
										
											<textarea id="EMP_EMPLOYE_REFERRAL" class="EMP_EMPLOYE_REFERRAL <?php echo ($EMP_PER_RES_RVD_db_value == 'Employee referrals?')? '':'hide'; ?>" name="EMP_EMPLOYE_REFERRAL"><?php echo get_cimyFieldValue($current_user_id, 'EMP_EMPLOYE_REFERRAL'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="total_resumes8" <?php echo ($EMP_PER_RES_RVD_db_value == 'Unknown')? 'checked':''; ?> value="Unknown" class="EMP_PER_RES_RVD" name="EMP_PER_RES_RVD"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="basic_info_step_7 basic_info_steps" style="display:none;">
									
									<div class="form-group Miles">
										<p><strong>Of the resumes received, what percentage is received:</strong></p>
										<div class="indent-2x">
											<?php $EMP_OF_THE_RES_RVD_db_value = get_cimyFieldValue($current_user_id, 'EMP_OF_THE_RES_RVD'); ?>
											<div class="radio">
												<label>
													<input type="radio" id="resumes_recieved1" <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'In paper form, including fax?')? 'checked':''; ?> value="In paper form, including fax?" class="EMP_OF_THE_RES_RVD" name="EMP_OF_THE_RES_RVD"> <span>In paper form, including fax?</span>
												</label>
											</div>
										
											<textarea id="EMP_PPR_FORM_FAX" class="EMP_PPR_FORM_FAX <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'In paper form, including fax?')? '':'hide'; ?>" name="EMP_PPR_FORM_FAX"><?php echo get_cimyFieldValue($current_user_id, 'EMP_PPR_FORM_FAX'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="resumes_recieved2" <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'Through online applications?')? 'checked':''; ?> value="Through online applications?" class="EMP_OF_THE_RES_RVD" name="EMP_OF_THE_RES_RVD"> <span>Through online applications?</span>
												</label>
											</div>
										
											<textarea id="EMP_THRU_ONLINE_APPS" class="EMP_THRU_ONLINE_APPS <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'Through online applications?')? '':'hide'; ?>" name="EMP_THRU_ONLINE_APPS"><?php echo get_cimyFieldValue($current_user_id, 'EMP_THRU_ONLINE_APPS'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="resumes_recieved3" <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'Through corporate e-mail as an attached file?')? 'checked':''; ?> value="Through corporate e-mail as an attached file?" class="EMP_OF_THE_RES_RVD" name="EMP_OF_THE_RES_RVD"> <span>Through corporate e-mail as an attached file?</span>
												</label>
											</div>
										
											<textarea id="EMP_THRU_CORP_EMAIL" class="EMP_THRU_CORP_EMAIL <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'Through corporate e-mail as an attached file?')? '':'hide'; ?>" name="EMP_THRU_CORP_EMAIL"><?php echo get_cimyFieldValue($current_user_id, 'EMP_THRU_CORP_EMAIL'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="resumes_recieved4" <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'On magazines and periodicals?')? 'checked':''; ?> value="On magazines and periodicals?" class="EMP_OF_THE_RES_RVD" name="EMP_OF_THE_RES_RVD"> <span>On magazines and periodicals?</span>
												</label>
											</div>
										
											<textarea id="EMP_MAGZNS_PERIODIC" class="EMP_MAGZNS_PERIODIC <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'On magazines and periodicals?')? '':'hide'; ?>" name="EMP_MAGZNS_PERIODIC"><?php echo get_cimyFieldValue($current_user_id, 'EMP_MAGZNS_PERIODIC'); ?></textarea>
										
											<div class="radio">
												<label>
													<input type="radio" id="resumes_recieved5" <?php echo ($EMP_OF_THE_RES_RVD_db_value == 'Unknown')? 'checked':''; ?> value="Unknown" class="EMP_OF_THE_RES_RVD" name="EMP_OF_THE_RES_RVD"> <span>Unknown</span>
												</label>
											</div>
										</div>
									</div>


									<div class="form-group Miles">
										<p><strong>Does your company accept or actively seek International candidates?</strong></p>
										<div class="indent-2x">
											<?php 
												$EMP_CNY_ACPT_INT_CAN_db_value = get_cimyFieldValue($current_user_id, 'EMP_CNY_ACPT_INT_CAN'); 
												$EMP_CNY_ACPT_INT_CAN_array = array('Yes', 'No'); 
												foreach($EMP_CNY_ACPT_INT_CAN_array as $value){ ?>
													<div class="radio">
														<label>
															<input type="radio" <?php if($value == $EMP_CNY_ACPT_INT_CAN_db_value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_CNY_ACPT_INT_CAN" name="EMP_CNY_ACPT_INT_CAN"> <span><?php echo $value; ?></span>
														</label>
													</div><?php
												}
											?>	
										</div>
									</div>

									<div class="seek_candidates_ques <?php echo ($EMP_CNY_ACPT_INT_CAN_db_value == 'Yes')? '':'hide'; ?>">
										<div class="form-group Miles">
											<p><strong>Internationally, what are the annual costs (for example, visa attainment and legal and expatriate-related matters)?</strong></p>
											<div class="indent-2x">
												<?php $EMP_INT_WHT_ANL_CT_D_db_value = get_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT_D'); ?>
												<textarea id="EMP_INT_WHT_ANL_CT_D" class="EMP_INT_WHT_ANL_CT_D" name="EMP_INT_WHT_ANL_CT_D"><?php echo $EMP_INT_WHT_ANL_CT_D_db_value; ?></textarea>
												<div class="checkbox">
													<label>
														<?php $EMP_INT_WHT_ANL_CT_db_value = get_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT'); ?>
														<input type="checkbox" <?php if($EMP_INT_WHT_ANL_CT_db_value=='Unknown'){ echo 'checked="checked"'; } ?> value="Unknown" class="EMP_INT_WHT_ANL_CT" name="EMP_INT_WHT_ANL_CT"> <span>Unknown</span>
													</label>
												</div>
											</div>
										</div>
									</div>

								</div>

								<div class="basic_info_step_8 basic_info_steps" style="display:none;" >
									<div class="form-group opportunity">
										<p><strong>How did you hear about EyeRecruit?</strong></p>
										<div class="indent-2x">
											<?php
												$EMP_HOW_HEAR_ABT_EYE_db_value = get_cimyFieldValue($current_user_id, 'EMP_HOW_HEAR_ABT_EYE');
												if ( !empty( $EMP_HOW_HEAR_ABT_EYE_db_value ) ) {
													$EMP_HOW_HEAR_ABT_EYE_db_value = explode(',', $EMP_HOW_HEAR_ABT_EYE_db_value);
												}
												else{
													$EMP_HOW_HEAR_ABT_EYE_db_value = array();
												}
												$EMP_HOW_HEAR_ABT_EYE_array = array('Print Ad', 'Co-worker', 'Social Network', 'Email Ad', 'TV Commercial', 'press Coverage', 'Search Engine', 'Radio', 'Industry Conference', 'Online Ad', 'Current / Past Employer', 'Lawyer', 'Linked In', 'Facebook', 'Other');
												foreach($EMP_HOW_HEAR_ABT_EYE_array as $value){ ?>
													
													<div class="checkbox">
														<label>
															<input type="checkbox" <?php if($value=='Other'){ echo 'id="howAbtEyerecruitOther"';} if(in_array($value, $EMP_HOW_HEAR_ABT_EYE_db_value)){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" class="EMP_HOW_HEAR_ABT_EYE" name="EMP_HOW_HEAR_ABT_EYE[]"> <span><?php echo $value; ?></span>
														</label>
													</div> <?php
												}
											?>
											<?php $EMP_HW_HR_ABT_EYE_D_db_value = get_cimyFieldValue($current_user_id, 'EMP_HW_HR_ABT_EYE_D'); ?>
											<input type="text" id="EMP_HW_HR_ABT_EYE_D" value="<?php if($EMP_HW_HR_ABT_EYE_D_db_value){ echo $EMP_HW_HR_ABT_EYE_D_db_value; } ?>" class="EMP_HW_HR_ABT_EYE_D hide" name="EMP_HW_HR_ABT_EYE_D" /> 
										</div>
									</div>

									<div class="form-group Miles">
										<p><strong>What reservations if any do you have about working with a Recruiting company?</strong></p>
										<div class="indent-2x">
											<?php $EMP_WHT_RES_IF_ANY_db_value = get_cimyFieldValue($current_user_id, 'EMP_WHT_RES_IF_ANY'); ?>
											<textarea id="EMP_WHT_RES_IF_ANY" class="EMP_WHT_RES_IF_ANY" name="EMP_WHT_RES_IF_ANY"><?php echo $EMP_WHT_RES_IF_ANY_db_value; ?></textarea>
										</div>
									</div>
								</div>

								<div class="clearfix gap-md"></div>
					    		<div class="paginationDiv text-center">
						    		<a href="javascript:void(0);" data-step="1" class="view_this_step active">1</a>
						    		<a href="javascript:void(0);" data-step="2" class="view_this_step">2</a>
						    		<a href="javascript:void(0);" data-step="3" class="view_this_step">3</a>
						    		<a href="javascript:void(0);" data-step="4" class="view_this_step">4</a>
						    		<a href="javascript:void(0);" data-step="5" class="view_this_step">5</a>
						    		<a href="javascript:void(0);" data-step="6" class="view_this_step">6</a>
						    		<a href="javascript:void(0);" data-step="7" class="view_this_step">7</a>
						    		<a href="javascript:void(0);" data-step="8" class="view_this_step">8</a>
					    		</div>
					    		<p class="clearfix"></p>

								<!--button -->
								<div class="text-center">
									<button id="empSaveBasicInof" type="button" class="btn btn-primary">Update</button>
								</div>
								<p class="clearfix gap-md"></p>
							</div>
			    		</form>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php endwhile; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
	<script type="text/javascript">
	
	jQuery(document).ready(function(){

		/*........View Basic Steps..............*/
		jQuery('.view_this_step').on('click', function() {
			var step = jQuery(this).data('step');
			jQuery('.view_this_step').removeClass('active');
			jQuery(this).addClass('active');
			jQuery('.basic_info_steps').hide();
			jQuery('.basic_info_step_'+step).show();
			jQuery('html, body').animate({
		        scrollTop: jQuery('.basic_info_step_'+step).offset().top - 200
		    }, 500);
		});


		jQuery(".EMP_AREA_TO_B_SEARCH1").on('click', function(){
			if(jQuery(this).val()=="United States"){ 
				jQuery("#EMP_STATES_OF_US_CONTAINER").show();
			}else{
				jQuery("#EMP_STATES_OF_US_CONTAINER").hide();
				jQuery('select[name="EMP_STATES_OF_US"]').val('');
			}
		});

		function howAbtEyerecruitOther () {
			if ( jQuery("#howAbtEyerecruitOther").is(':checked') ) {
				jQuery('#EMP_HW_HR_ABT_EYE_D').removeClass('hide');
			}
			else{
				jQuery('#EMP_HW_HR_ABT_EYE_D').addClass('hide');
				jQuery('#EMP_HW_HR_ABT_EYE_D').val('');
			}
		}
		howAbtEyerecruitOther();
		jQuery("#howAbtEyerecruitOther").on('click', function() {
			howAbtEyerecruitOther()
		});
		
		jQuery("#empSaveBasicInof").on('click',function() {
			
			var _this = jQuery(this);
			_this.text('Please Wait...').attr('disabled','disabled');

			//step 2
			var EMP_YR_POS_IN_ORGN=[];
			jQuery('input[name="EMP_YR_POS_IN_ORGN[]"]:checked').each(function(i){
				EMP_YR_POS_IN_ORGN.push(jQuery(this).val());
			});

			//step 3
			var EMP_NO_EMP_ON_TEAM = jQuery('input[name="EMP_NO_EMP_ON_TEAM"]:checked').val();

			var EMP_EXPERIENCE = jQuery('input[name="EMP_EXPERIENCE"]').val();

			//step 4
			var EMP_AREA_TO_B_SEARCH = jQuery('input[name="EMP_AREA_TO_B_SEARCH"]:checked').val();
			var EMP_STATES_OF_US = jQuery('select[name="EMP_STATES_OF_US"]').val();

			//step 5
			var EMP_INDUS_REF_SRVICE=[];
			jQuery('input[name="EMP_INDUS_REF_SRVICE[]"]:checked').each(function(){
				EMP_INDUS_REF_SRVICE.push(jQuery(this).val());
			});

			//step 6
			var EMP_CMPNY_LIS_INFO = jQuery('textarea[name="EMP_CMPNY_LIS_INFO"]').val();

			//step 7
			var EMP_WUD_RELOC_SUGGES = jQuery('input[name="EMP_WUD_RELOC_SUGGES"]:checked').val();
			var EMP_CPY_REL_INCN_DES = jQuery('textarea[name="EMP_CPY_REL_INCN_DES"]').val();
			var EMP_CPY_REL_INCN = jQuery('input[name="EMP_CPY_REL_INCN"]:checked').val();
			var EMP_CMNY_ALLOC_ANUAL = jQuery('textarea[name="EMP_CMNY_ALLOC_ANUAL"]').val();
			var EMP_CMNY_ALLOC_UNON = jQuery('input[name="EMP_CMNY_ALLOC_UNON"]:checked').val();

			//step 8
			var EMP_OFER_SIGNING_BON = jQuery('input[name="EMP_OFER_SIGNING_BON"]:checked').val();
			var EMP_CPNY_SIG_BON_DES = jQuery('textarea[name="EMP_CPNY_SIG_BON_DES"]').val();
			var EMP_CPNY_SIG_BON = jQuery('input[name="EMP_CPNY_SIG_BON"]:checked').val();			
			var EMP_ORG_UNQ_FR_EMP_D = jQuery('textarea[name="EMP_ORG_UNQ_FR_EMP_D"]').val();
			var EMP_ORG_UNQ_FR_EMP = jQuery('input[name="EMP_ORG_UNQ_FR_EMP"]:checked').val();

			//step 9
			var EMP_TEAM_IN_MULTILOC = jQuery('input[name="EMP_TEAM_IN_MULTILOC"]:checked').val();
			var EMP_OFFICES_IN_STATE=[];
			jQuery('input[name="EMP_OFFICES_IN_STATE[]"]:checked').each(function(i){
				EMP_OFFICES_IN_STATE.push(jQuery(this).val());
			});
			var EMP_HAV_TEAM_IN_MULT = jQuery('input[name="EMP_HAV_TEAM_IN_MULT"]:checked').val();
			var EMP_JOB_POSTNG_METH=[];
			jQuery('input[name="EMP_JOB_POSTNG_METH[]"]:checked').each(function(i){
				EMP_JOB_POSTNG_METH.push(jQuery(this).val());
			});

			//step 10
			var EMP_R_INTRNSIP_AVBL = jQuery('input[name="EMP_R_INTRNSIP_AVBL"]:checked').val();
			var EMP_UNI_PRG_INT_LOC = jQuery('textarea[name="EMP_UNI_PRG_INT_LOC"]').val();

			//step 11
			var EMP_WHAT_IS_MOR_IMP = jQuery('input[name="EMP_WHAT_IS_MOR_IMP"]:checked').val();

			//step 12
			var EMP_ANUAL_EXP_ON_VEN = jQuery('textarea[name="EMP_ANUAL_EXP_ON_VEN"]').val();
			var EMP_ANUAL_EXP_VEN = jQuery('input[name="EMP_ANUAL_EXP_VEN"]:checked').val();

			//step 13
			var EMP_CNY_SPND_ON_JOB = jQuery('input[name="EMP_CNY_SPND_ON_JOB"]:checked').val();
			var EMP_INTRNT_JOB_BOARD = jQuery('textarea[name="EMP_INTRNT_JOB_BOARD"]').val();
			var EMP_PPR_BSE_BULL_BOA = jQuery('textarea[name="EMP_PPR_BSE_BULL_BOA"]').val();
			var EMP_KIOSKS_DESC = jQuery('textarea[name="EMP_KIOSKS_DESC"]').val();

			//step 14
			var EMP_HOW_MNY_RES_DESC = jQuery('textarea[name="EMP_HOW_MNY_RES_DESC"]').val();
			var EMP_HOW_MNY_RES = jQuery('input[name="EMP_HOW_MNY_RES"]:checked').val();

			//step 15
			var EMP_HOW_MNY_FUL_TM_D = jQuery('textarea[name="EMP_HOW_MNY_FUL_TM_D"]').val();
			var EMP_HOW_MNY_FUL_TM = jQuery('input[name="EMP_HOW_MNY_FUL_TM"]:checked').val();

			//step 16
			var EMP_WHT_AVG_BURD_DES = jQuery('textarea[name="EMP_WHT_AVG_BURD_DES"]').val();
			var EMP_WHT_AVG_BURD = jQuery('input[name="EMP_WHT_AVG_BURD"]:checked').val();

			//step 17
			var EMP_PER_RES_RVD = jQuery('input[name="EMP_PER_RES_RVD"]:checked').val();
			var EMP_UNSOLICITED_MAIL = jQuery('textarea[name="EMP_UNSOLICITED_MAIL"]').val();
			var EMP_REQ_PRINT_ADDS = jQuery('textarea[name="EMP_REQ_PRINT_ADDS"]').val();
			var EMP_OUT_STAFF_FIRMS = jQuery('textarea[name="EMP_OUT_STAFF_FIRMS"]').val();
			var EMP_JOB_FAIRS_SELECT = jQuery('textarea[name="EMP_JOB_FAIRS_SELECT"]').val();
			var EMP_CAMPUS_RECRUIT = jQuery('textarea[name="EMP_CAMPUS_RECRUIT"]').val();
			var EMP_INT_AD_N_POST_BO = jQuery('textarea[name="EMP_INT_AD_N_POST_BO"]').val();
			var EMP_EMPLOYE_REFERRAL = jQuery('textarea[name="EMP_EMPLOYE_REFERRAL"]').val();

			//step 18
			var EMP_OF_THE_RES_RVD = jQuery('input[name="EMP_OF_THE_RES_RVD"]:checked').val();
			var EMP_PPR_FORM_FAX = jQuery('textarea[name="EMP_PPR_FORM_FAX"]').val();
			var EMP_THRU_ONLINE_APPS = jQuery('textarea[name="EMP_THRU_ONLINE_APPS"]').val();
			var EMP_THRU_CORP_EMAIL = jQuery('textarea[name="EMP_THRU_CORP_EMAIL"]').val();
			var EMP_MAGZNS_PERIODIC = jQuery('textarea[name="EMP_MAGZNS_PERIODIC"]').val();

			var company_name = jQuery('input[name="company_name"]').val();

			//step 19
			var EMP_CNY_ACPT_INT_CAN = jQuery('input[name="EMP_CNY_ACPT_INT_CAN"]:checked').val();
			var EMP_INT_WHT_ANL_CT_D = jQuery('textarea[name="EMP_INT_WHT_ANL_CT_D"]').val();
			var EMP_INT_WHT_ANL_CT = jQuery('input[name="EMP_INT_WHT_ANL_CT"]:checked').val();

			//step 21
			var EMP_HOW_HEAR_ABT_EYE=[];
			jQuery('input[name="EMP_HOW_HEAR_ABT_EYE[]"]:checked').each(function(i){
				EMP_HOW_HEAR_ABT_EYE.push(jQuery(this).val());
			});
			var EMP_HW_HR_ABT_EYE_D = jQuery('input[name="EMP_HW_HR_ABT_EYE_D"]').val();

			//step 22
			var EMP_WHT_RES_IF_ANY = jQuery('textarea[name="EMP_WHT_RES_IF_ANY"]').val();

			jQuery.ajax({
				url:'<?php echo admin_url("admin-ajax.php"); ?>',
				type:'POST',
				data:{
					action:'employer_basic_information_saved',
					//rec_id: rec_id,
					EMP_YR_POS_IN_ORGN : EMP_YR_POS_IN_ORGN,
					EMP_NO_EMP_ON_TEAM : EMP_NO_EMP_ON_TEAM,
					EMP_EXPERIENCE: EMP_EXPERIENCE,
					EMP_AREA_TO_B_SEARCH : EMP_AREA_TO_B_SEARCH,
					EMP_STATES_OF_US : EMP_STATES_OF_US,
					EMP_INDUS_REF_SRVICE : EMP_INDUS_REF_SRVICE,
					EMP_CMPNY_LIS_INFO : EMP_CMPNY_LIS_INFO,
					EMP_WUD_RELOC_SUGGES : EMP_WUD_RELOC_SUGGES,
					EMP_CPY_REL_INCN_DES : EMP_CPY_REL_INCN_DES,
					EMP_CPY_REL_INCN : EMP_CPY_REL_INCN,
					EMP_CMNY_ALLOC_ANUAL : EMP_CMNY_ALLOC_ANUAL,
					EMP_CMNY_ALLOC_UNON : EMP_CMNY_ALLOC_UNON,
					EMP_OFER_SIGNING_BON : EMP_OFER_SIGNING_BON,
					EMP_CPNY_SIG_BON_DES : EMP_CPNY_SIG_BON_DES,
					EMP_CPNY_SIG_BON : EMP_CPNY_SIG_BON,
					EMP_ORG_UNQ_FR_EMP_D : EMP_ORG_UNQ_FR_EMP_D,
					EMP_ORG_UNQ_FR_EMP : EMP_ORG_UNQ_FR_EMP,
					EMP_TEAM_IN_MULTILOC : EMP_TEAM_IN_MULTILOC,
					EMP_OFFICES_IN_STATE : EMP_OFFICES_IN_STATE,
					EMP_HAV_TEAM_IN_MULT : EMP_HAV_TEAM_IN_MULT,
					EMP_JOB_POSTNG_METH : EMP_JOB_POSTNG_METH,
					EMP_R_INTRNSIP_AVBL : EMP_R_INTRNSIP_AVBL,
					EMP_UNI_PRG_INT_LOC : EMP_UNI_PRG_INT_LOC,
					EMP_WHAT_IS_MOR_IMP : EMP_WHAT_IS_MOR_IMP,
					EMP_ANUAL_EXP_ON_VEN : EMP_ANUAL_EXP_ON_VEN,
					EMP_ANUAL_EXP_VEN : EMP_ANUAL_EXP_VEN,
					EMP_CNY_SPND_ON_JOB : EMP_CNY_SPND_ON_JOB,
					EMP_INTRNT_JOB_BOARD : EMP_INTRNT_JOB_BOARD,
					EMP_PPR_BSE_BULL_BOA : EMP_PPR_BSE_BULL_BOA,
					EMP_KIOSKS_DESC : EMP_KIOSKS_DESC,
					EMP_HOW_MNY_RES_DESC : EMP_HOW_MNY_RES_DESC,
					EMP_HOW_MNY_RES : EMP_HOW_MNY_RES,
					EMP_HOW_MNY_FUL_TM_D : EMP_HOW_MNY_FUL_TM_D,
					EMP_HOW_MNY_FUL_TM : EMP_HOW_MNY_FUL_TM,
					EMP_WHT_AVG_BURD_DES : EMP_WHT_AVG_BURD_DES,
					EMP_WHT_AVG_BURD : EMP_WHT_AVG_BURD,
					EMP_PER_RES_RVD : EMP_PER_RES_RVD,
					EMP_UNSOLICITED_MAIL : EMP_UNSOLICITED_MAIL,
					EMP_REQ_PRINT_ADDS : EMP_REQ_PRINT_ADDS,
					EMP_OUT_STAFF_FIRMS : EMP_OUT_STAFF_FIRMS,
					EMP_JOB_FAIRS_SELECT : EMP_JOB_FAIRS_SELECT,
					EMP_CAMPUS_RECRUIT : EMP_CAMPUS_RECRUIT,
					EMP_INT_AD_N_POST_BO : EMP_INT_AD_N_POST_BO,
					EMP_EMPLOYE_REFERRAL : EMP_EMPLOYE_REFERRAL,
					EMP_OF_THE_RES_RVD : EMP_OF_THE_RES_RVD,
					EMP_PPR_FORM_FAX : EMP_PPR_FORM_FAX,
					EMP_THRU_ONLINE_APPS : EMP_THRU_ONLINE_APPS,
					EMP_THRU_CORP_EMAIL : EMP_THRU_CORP_EMAIL,
					EMP_MAGZNS_PERIODIC : EMP_MAGZNS_PERIODIC,
					company_name: company_name,
					EMP_CNY_ACPT_INT_CAN : EMP_CNY_ACPT_INT_CAN,
					EMP_INT_WHT_ANL_CT_D : EMP_INT_WHT_ANL_CT_D,
					EMP_INT_WHT_ANL_CT : EMP_INT_WHT_ANL_CT,
					EMP_HOW_HEAR_ABT_EYE : EMP_HOW_HEAR_ABT_EYE,
					EMP_WHT_RES_IF_ANY : EMP_WHT_RES_IF_ANY,
					EMP_HW_HR_ABT_EYE_D : EMP_HW_HR_ABT_EYE_D,
				},
				success:function(r){	
					_this.text('Update').removeAttr('disabled');
					swal({
						title: "Success", 
						html: true,
						text: "<span class='text-center'>Your basic information is successfully updated.</span>",
						type: "success",
						confirmButtonClass: "btn-primary btn-sm",
					});
				}
			});
		});
});
</script>

<?php get_footer('employer'); ?>
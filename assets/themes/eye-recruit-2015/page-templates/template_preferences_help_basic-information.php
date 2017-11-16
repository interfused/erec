<?php
/**
 * Template Name: Preferences basic information page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

if ( is_user_logged_in() ) {
	$UserID = get_current_user_id();
}
else{
	echo wp_redirect( site_url() );
}

function setupCimyQuestion($user_id, $fieldname){
	global $wpdb;
		//search eyecuwp_cimy_uef_fields
	$result = $wpdb->get_row( 'SELECT * FROM eyecuwp_cimy_uef_fields WHERE NAME = "' .$fieldname.'"' );

	$fieldLabel = $result->LABEL;

	$parts = explode('/', $fieldLabel);
	$question = $parts[0];
	$responses_arr = explode(',', $parts[1] );

	$user_answer = get_cimyFieldValue($user_id, $fieldname);

	//replace any found spaces with underline
	$convertedFieldname = str_replace(' ', '_', strtolower($fieldname) );
	
	
	$htmlStr = '<div class="'.$convertedFieldname.'">';
	$htmlStr .= '<p><strong>'.$question.'</strong></p>';

	//setup responses for dropdowns.  We will convert to radio button $result->TYPE==='dropdown'
	if($result->TYPE==='dropdown'){
		$htmlStr .= '<div class="indent-2x">';
		$htmlStr .='user answer is: '.$user_answer;

		foreach ($responses_arr as $response) {
			if($response == '' || $response == ' '){
				continue;
			}else{
				$isChecked = ($user_answer == $response) ? " checked " : " ";
				$htmlStr .= '<div class="radio"><label><input '.$isChecked.' name="'.$fieldname.'" type="radio" value="'.$response.'"> <span>'.$response.'</span></label></div>';
			}
		}

		$htmlStr .= '</div>';
	}
	
	$htmlStr .= '</div>';
	return $htmlStr;
}
////
function setupTaxonomyResponseQuestion($question,$post_type,$taxonomy_name){
	//STUB: SETUP QUESTION.
	//SETUP RESPONSES BASED OFF OF POST TYPE AND TAXONOMY NAME
	//EX PULL CATEGORIES AND USE THEM AS OPTIONS
}

////SETUP THE DISPLAY COMPENSATION ARRAY
$compensation_setup_arr = array( 'Under $40k' => 'Under $40k annually', '$40,001 - $50,000' => '$40,001 - $50,000 annually', '$50,001 - $60,000' => '$50,001 - $60,000 annually', '$60,001 - $70,000' => '$60,001 - $70,000 annually', '$70,001 - $80,000' => '$70,001 - $80,000 annually', '$80,001 - $90,000' => '$80,001 - $90,000 annually', '$90,001 - $100,000' => '$90,001 - $100,000 annually', '$100,001 – $125,000' => '$100,001 - $125,000 annually', '$125,001 – $150,000' => '$125,001 - $150,000 annually', '$150,001 - $250,000' => '$150,001 - $250,000 annually', '$250,001 - $500,000' => '$250,001 - $500,000 annually', 'Over $500k' => 'Over $500k annually');

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
					<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Update Basic Information</h3>
						<span><strong>Recruit ID</strong> : <?php echo $UserID; ?></span>
					</div>
					<div class="indent-x">
						
						<form id="profilebuilder4390" method="post" action="" enctype="multipart/form-data">
								
							<div class="profilestep_inner">

								<!-- Step1 -->
								<div class="basic_info_step_1 basic_info_steps" style="display:block;">
									
									<?php echo setupCimyQuestion($UserID, 'SYSTEM_AND_PROCE');?>
									<?php 
									///DEV NOTE: NEED TO MAKE THIS setupTaxonomyResponseQuestion
									echo setupCimyQuestion($UserID, 'BEST_INDUSTRY');?>
									

									<?php $ClearanceLe = get_cimyFieldValue($UserID, 'CLEARANCE_LEVEL'); ?>
									<div class="industry">
										<p><strong>Clearance Level.</strong></p>
										<div class="indent-2x">
											<div class="radio"><label><input <?php if($ClearanceLe == 'Confidential'){ echo "checked"; } ?> id="confidential" name="CLEARANCE_LEVEL" type="radio" value="Confidential"><span>Confidential</span></label></div>
											<div class="radio"><label><input <?php if($ClearanceLe == 'Secret'){ echo "checked"; } ?> id="secret" name="CLEARANCE_LEVEL" type="radio" value="Secret"><span>Secret</span></label></div>
											<div class="radio"><label><input <?php if($ClearanceLe == 'Top Secret'){ echo "checked"; } ?> id="top_secret" name="CLEARANCE_LEVEL" type="radio" value="Top Secret"><span>Top Secret</span></label></div>
											<!-- <div class="radio"><label><input <?php if($ClearanceLe == 'Top Secret/SCI'){ echo "checked"; } ?> id="top_secretsci" name="CLEARANCE_LEVEL" type="radio" value="Top Secret/SCI"><span>Top Secret/SCI</span></label></div> -->
											<div class="radio"><label><input <?php if($ClearanceLe == 'Intel Agency(NSA /CIA/FBI/etc)'){ echo "checked"; } ?> id="intel_agency" name="CLEARANCE_LEVEL" type="radio" value="Intel Agency(NSA /CIA/FBI/etc)"><span>Intel Agency (NSA, CIA, FBI etc)</span></label></div>
											<div class="radio"><label><input <?php if($ClearanceLe == 'Information available on request only'){ echo "checked"; } ?> id="info_only_req" name="CLEARANCE_LEVEL" type="radio" value="Information available on request only"><span>Information available on request only</span></label></div>
										</div>
									</div>

									<?php echo setupCimyQuestion($UserID, 'CLEARANCE_STATUS');?>

									<?php
									jobseeker_basic_info_member_tips('seeker_update_basic_info');
									?>
								</div>


								<!-- Step2 -->
								<div class="basic_info_step_2 basic_info_steps" style="display:none;">
									
									<?php 
									//view_detail
									$he = get_cimyFieldValue($UserID, 'HIGHEST_EDUCATION');
									$eduDetailArr = array('Associates Degree','Bachelors Degree','Masters Degree','Doctorate Degree / PhD.'); ?>
									<div class="education <?php if( in_array( $he, $eduDetailArr) ){ echo 'thisValid'; } ?>">
										<p>	<strong>What is your highest level of education?</strong></p>
											<div class="indent-2x">
											<div class="radio"><label><input <?php if($he == 'Some High School Coursework'){ echo "checked"; } ?> id="high_school" name="HIGHEST_EDUCATION" type="radio" value="Some High School Coursework"> <span>Some High School Coursework</span></label></div>
											<div class="radio"><label><input <?php if($he == 'High school or equivalent'){ echo "checked"; } ?> id="high_school_equivalent" name="HIGHEST_EDUCATION" type="radio" value="High school or equivalent"> <span>High school or equivalent</span></label></div>
											<div class="radio"><label><input <?php if($he == 'Certification'){ echo "checked"; } ?> id="certification" name="HIGHEST_EDUCATION" type="radio" value="Certification"> <span>Certification</span></label></div>
											<div class="radio"><label><input <?php if($he == 'Vocational'){ echo "checked"; } ?> id="vocational" name="HIGHEST_EDUCATION" type="radio" value="Vocational"> <span>Vocational</span></label></div>
											<div class="radio"><label><input <?php if($he == 'Some College Coursework completed'){ echo "checked"; } ?> id="college_coursework" name="HIGHEST_EDUCATION" type="radio" value="Some College Coursework completed"> <span>Some College Coursework completed</span></label></div>
											<div class="radio"><label><input <?php if($he == 'Associates Degree'){ echo 'checked  chd="associates_degree" ';} ?> id="associates_degree" name="HIGHEST_EDUCATION" type="radio" value="Associates Degree"> <span>Associates Degree</span></label> <span id="ad"><?php if($he == 'Associates Degree'){ echo "<a href='javascript:void();' id='view_detail' >View Detail</a>"; } ?></span> </div>
											<div class="radio"><label><input <?php if($he == 'Bachelors Degree'){ echo 'checked  chd="bachelors_degree" ';} ?> id="bachelors_degree" name="HIGHEST_EDUCATION" type="radio" value="Bachelors Degree"> <span>Bachelors Degree</span></label><span id="bd"> <?php if($he == 'Bachelors Degree'){ echo "<a href='javascript:void();' id='view_detail' > View Detail</a>"; } ?></span> </div>
											<div class="radio"><label><input <?php if($he == 'Masters Degree'){ echo 'checked  chd="masters_degree" ';} ?> id="masters_degree" name="HIGHEST_EDUCATION" type="radio" value="Masters Degree"> <span>Masters Degree</span></label> <span id="md"><?php if($he == 'Masters Degree'){ echo "<a href='javascript:void();' id='view_detail' >View Detail</a>"; } ?></span> </div>
											<div class="radio"><label><input <?php if($he == 'Doctorate Degree / PhD.'){ echo 'checked  chd="doctorate" ';} ?> id="doctorate" name="HIGHEST_EDUCATION" type="radio" value="Doctorate Degree / PhD."> <span>Doctorate Degree / PhD.</span></label><span id="dd"> <?php if($he == 'Doctorate Degree / PhD.'){ echo "<a href='javascript:void();' id='view_detail' >View Detail</a>"; } ?></span> </div>
										</div>
									</div>

									<div class="opportunity">
										<p><strong>What type of opportunity are you looking for?</strong></p>
										<div class="indent-2x custom-radio">
											<?php 
											$to_Arr = explode(',', get_cimyFieldValue($UserID, 'TYPE_OF_OPPORTUNITY') );
											$too_FArr = array('Permanent Full Time Employee','Part Time Employee','Short Term Contract','Long-term Contract','All available advancements');
											
											foreach ($too_FArr as $value) { ?>
												<div class="radio"><label><input <?php if( in_array($value, $to_Arr) ){ echo "checked"; } ?> name="TYPE_OF_OPPORTUNITY[]" type="checkbox" value="<?php echo $value; ?>"> <span><?php echo $value; ?></span></label></div>
											<?php } ?>
											
										</div>
									</div>
									<?php
									jobseeker_basic_info_member_tips('seeker_update_basic_info');
									?>
								</div>
								<!-- Step3 -->
								<div class="basic_info_step_3 basic_info_steps" style="display:none;">
									<?php echo setupCimyQuestion($UserID, 'JOB_SEARCH_RADIUS');?>
									<?php echo setupCimyQuestion($UserID, 'US_ELIGIBLE');?>
									<?php echo setupCimyQuestion($UserID, 'SECURITY_CLEAR_YN');?>
									<?php echo setupCimyQuestion($UserID, 'OVER_18_YN');?>
									
									<?php
									jobseeker_basic_info_member_tips('seeker_update_basic_info');
									?>
								</div>
			    				

			    				<!-- Step4 -->
			    				<div class="basic_info_step_4 basic_info_steps" style="display:none;">
			    					<?php echo setupCimyQuestion($UserID, 'POSSES_DRIVER_LICENS');?>

			    					<?php $pdl = get_cimyFieldValue($UserID, 'POSSES_DRIVER_LICENS'); ?>
									
									<div id="state_field" class="state row" <?php if( $pdl != 'Yes' ){ echo 'style="display:none;"'; } ?> > <!-- style="display: none;" -->
										<div class="col-md-8">
											<div class="form-group has-feedback indent-2x">
												<label class="control-label">State issued?</label>
												<?php
												$ds = get_cimyFieldValue($UserID, 'DRIVER_STATE');
												$dsArr = array('Alaska','Alabama','Arkansas','Arizona','California','Colorado','Connecticut','District of Columbia','Delaware','Florida','Georgia','Hawaii','Iowa','Idaho','Illinois','Indiana','Kansas','Kentucky','Louisiana','Massachusetts','Maryland','Maine','Michigan','Minnesota','Missouri','Mississippi','Montana','North Carolina','North Dakota','Nebraska','New Hampshire','New Jersey','New Mexico','Nevada','New York','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Virginia','Vermont','Washington','Wisconsin','West Virginia','Wyoming');
												?>
												<select class="form-control state-dd" name="DRIVER_STATE">
													<option value="">State issued?</option>
													<?php
													foreach ($dsArr as $value) { ?>
														<option value="<?php echo $value; ?>" <?php if($value == $ds){ echo "selected"; } ?> ><?php echo $value; ?></option> <?php
													}
													?>
												</select>
												<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
											</div>
										</div>
									</div>

									<?php echo setupCimyQuestion($UserID, 'RELIABLE_TRANSPORT');?>
									<?php echo setupCimyQuestion($UserID, 'CURR_EMPLOYED_YN');?>

									<?php $cdYn = get_cimyFieldValue($UserID, 'CURR_EMPLOYED_YN'); ?>
									
									<?php 
									if ( $cdYn == 'Yes' ) {
										$nOc = get_cimyFieldValue($UserID, 'NAME_OF_COMP'); 
										$style = 'style="display:block"';
									}
									else{
										$nOc = ''; 
										$style = 'style="display:none"';
									}
									?>
									<div class="currently_employed_comp" <?php echo $style; ?> >
										<p><strong>Name of the company</strong></p>
										<div class="row">
											<div class="col-md-8">
												<div class="indent-2x form-group">
													<input name="NAME_OF_COMP" type="text" value="<?php echo $nOc; ?>" >
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8">
												<div class="indent-2x form-group">
    												<strong>TIP:</strong> We ask for your current employer so we can restrict access to employers registered under the name you provide from searching you or your profile being presented in their search.
												</div>
											</div>
										</div>
									</div>

									<?php $wda = get_cimyFieldValue($UserID, 'WORK_DATE_AVAILABLE'); ?>
									<div class="currently_employed">
										<div class="available_to_work">
											<p><strong>What date are you available to start work?</strong></p>
											<div class="row">
												<div class="col-md-8">
													<div class="indent-2x form-group">
														<input id="date_available_to_work" name="WORK_DATE_AVAILABLE" type="text" value="<?php echo $wda; ?>" >
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php
									jobseeker_basic_info_member_tips('seeker_update_basic_info');
									?>
								</div>


								<!-- Step5 -->
								<div class="basic_info_step_5 basic_info_steps" style="display:none;">
									<?php
									$iY = get_cimyFieldValue($UserID, 'INDUSTRY_YEARS');
									$iY_Arr = array('Less than two years','Two to four years','Four to six years','Six to ten years','Ten to fifteen years','Over fifteen years');
									?>
									<div class="induster_year">
										<p><strong>Please select the number range that best reflects your years of industry specific experience:</strong></p>
										<div class="row">
											<div class="col-md-8">
												<div class="indent-2x form-group has-feedback">
													<select class="form-control" name="INDUSTRY_YEARS">
														<option value="">Select</option>
														<?php
														foreach ($iY_Arr as $value) { ?>
															<option value="<?php echo $value; ?>" <?php if($value == $iY){ echo "selected"; } ?> ><?php echo $value; ?></option> <?php
														}
														?>
													</select>
													<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
												</div>
											</div>
										</div>
									</div>

									<?php
									$cCl = get_cimyFieldValue($UserID, 'CURR_CAREER_LVL');
									$cCl_Arr = array('Student (High School)','Student (College)','Entry Level','Experienced (Non-Manager)','Managerial','Executive','Senior Executive');
									?>
									<div class="current_carrer_level">
										<p><strong>Please select you Current Career Level:</strong></p>
										<div class="row">
											<div class="col-md-8">
												<div class="indent-2x form-group has-feedback">
													<select class="form-control" name="CURR_CAREER_LVL">
														<option value="">Select</option>
														<?php
														foreach ($cCl_Arr as $value) { ?>
															<option value="<?php echo $value; ?>" <?php if($value == $cCl){ echo "selected"; } ?> ><?php echo $value; ?></option> <?php
														}
														?>
													</select>
													<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
												</div>
											</div>
										</div>
									</div>

									<div class="how_did_u_hear">
										<?php
										$rF = explode(',', get_cimyFieldValue($UserID, 'REF_SRC') );

										$rF_Arr = array('Print Ad','Coworker ','Social Network','Email Ad','TV Commercial','Press Coverage','Search Engin','Radio ','Industry Conference','Online Ad','Current / Past Employer');
										?>
										<p><strong>How did you hear about EyeRecruit?</strong></p>
										<div class="row">
											<div class="col-md-7">
												<div class="indent-2x">
													<ul class="radio-group radio-group-1-2">
														<?php
														foreach ($rF_Arr as $value) { ?>
															<li> <div class="checkbox"><label><input <?php if( in_array($value, $rF) ){ echo 'checked'; } ?> name="REF_SRC[]" type="checkbox" value="<?php echo $value; ?>" ><span><?php echo $value; ?></span></label></div> </li> <?php	
														} 
														?>
													</ul>
												</div>
											</div>
										</div>
									</div>

									<?php echo setupCimyQuestion($UserID, 'RELOCATION_YN');?>

									<?php
									jobseeker_basic_info_member_tips('seeker_update_basic_info');
									?>
								</div>
									

								<!-- Step6 -->
								<div class="basic_info_step_6 basic_info_steps" style="display:none;">
									<?php
									$c_Curr = get_cimyFieldValue($UserID, 'COMPENSATION_CURRENT');
									$c_CurrAcc = get_cimyFieldValue($UserID, 'COMPENSATION_ACC');

									$c_Curr_Arr = $compensation_setup_arr;
									?>
									<div class="ange_most_accurately">
										<p><strong>Please indicate which range most accurately reflects your ANNUAL COMPENSATION in your current or most recent position, including all forms of compensation (base salary, bonus, etc.):</strong></p>
										<div class="row">
											<div class="col-md-8">
												<div class="indent-2x">
													<div class="radio"><label><input <?php if($c_CurrAcc == 'Show Employers'){ echo "checked"; } ?> name="COMPENSATION_ACC" type="radio" value="Show Employers"> <span>Show Employers</span></label></div>
													<div class="radio"><label><input <?php if($c_CurrAcc == 'Do Not Show Employer'){ echo "checked"; } ?> name="COMPENSATION_ACC" type="radio" value="Do Not Show Employer"> <span>Do Not Show Employer</span></label>
														<!-- <img src="<?php echo get_stylesheet_directory_uri();  ?>/img/lock_sm.png" alt="img" class="lock_icon COMPENSATION_ACC"> -->
													</div>
												</div>

												<div class="row">  
													<div class="col-md-6">
														<div class="indent-2x">
															<?php
															$countComp = 0;
															foreach ($c_Curr_Arr as $key => $value) { 
																if ( ($countComp % 6 == 0) && ($countComp != 0) ) {
																 	echo '</div></div><div class="col-md-6"><div class="indent-2x">';
																 } ?>
																<div class="radio"><label><input type="radio" name="COMPENSATION_CURRENT"  value="<?php echo $key; ?>" <?php if($key == $c_Curr){ echo "checked"; } ?> ><span><?php echo $value; ?></span></label></div> <?php
																$countComp++;
															}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php
									$c_Des = get_cimyFieldValue($UserID, 'COMPENSATION_DESIRED');
									$c_DesAcc = get_cimyFieldValue($UserID, 'COMP_DESIRED_ACC');
									$c_Des_Arr = $compensation_setup_arr;
									?>
									<div class="compensation_desired">
										<p><strong>Please indicate which range most accurately reflects your DESIRED ANNUAL COMPENSATION in your current or most recent position, including all forms of compensation (base salary, bonus, etc.):</strong></p> 
										<div class="row">
											<div class="col-md-8">
												<div class="indent-2x">
													<div class="radio"><label><input <?php if($c_DesAcc == 'Show Employers'){ echo "checked"; } ?> name="COMP_DESIRED_ACC" type="radio" value="Show Employers"> <span>Show Employers</span></label></div>
													<div class="radio"><label><input <?php if($c_DesAcc == 'Do Not Show Employer'){ echo "checked"; } ?> name="COMP_DESIRED_ACC" type="radio" value="Do Not Show Employer"> <span>Do Not Show Employer</span></label>
														<!-- <img src="<?php echo get_stylesheet_directory_uri();  ?>/img/lock_sm.png" alt="img" class="lock_icon"> -->
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="indent-2x">
															<?php
															$countDes = 0;
															foreach ($c_Des_Arr as $key => $value) { 
																if ( ($countDes % 6 == 0) && ($countDes != 0) ) {
																 	echo '</div></div><div class="col-md-6"><div class="indent-2x">';
																} ?>
																<div class="radio"><label><input name="COMPENSATION_DESIRED" type="radio" value="<?php echo $key; ?>" <?php if($key == $c_Des){ echo "checked"; } ?> ><span><?php echo $value; ?></span></label></div> <?php
																$countDes++;
															}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php $fLs = get_cimyFieldValue($UserID, 'FIELD_LICENSE_STATUS'); ?>
									<div id="investigation_valid" class="investigation <?php if($fLs == 'Yes'){echo 'thisValid'; } ?>">
										<p><strong>Are you currently licensed in the field of Investigation or Security?</strong></p>
										<div class="indent-2x">
											<div class="radio"><label><input <?php if($fLs == 'Yes'){ echo "checked"; } ?> id="investigation" name="FIELD_LICENSE_STATUS" type="radio" value="Yes"> <span>Yes</span></label> <?php if($fLs == 'Yes'){ echo " <a href='javascript:void();' id='inview_detail' > View Detail</a>"; } ?></div>
											<div class="radio"><label><input <?php if($fLs == 'No'){ echo "checked"; } ?> id="no_investigation" name="FIELD_LICENSE_STATUS" type="radio" value="No"> <span>No</span></label></div>
										</div>
									</div>

								</div>


								<!-- Step7 -->
								<div class="basic_info_step_7 basic_info_steps" style="display:none;">
									<div class="languages">
										<p><strong>List Languages and proficiency level:</strong></p>
										<div class="row">
											<div class="col-md-7">
												<div class="indent-2x">
													<ul class="radio-group radio-group-1-2">
														
														<?php
														$lisLArr = array('mandarin' => 'Mandarin','vietnamese' => 'Vietnamese','english' => 'English','javanese' => 'Javanese','spanish' => 'Spanish','tamil' => 'Tamil','hindi' => 'Hindi','Korean' => 'Korean','russian' => 'Russian','turkish' => 'Turkish','arabic' => 'Arabic','telugu' => 'Telugu','portuguese' => 'Portuguese','marathi' => 'Marathi','bengali' => 'Bengali','italian' => 'Italian','french' => 'French','thai' => 'Thai','malay' => 'Malay, Indonesian','burmese' => 'Burmese','german' => 'German','cantonese' => 'Cantonese','japanese' => 'Japanese','kannada' => 'Kannada','farsi' => 'Farsi (Persian)','gujarati' => 'Gujarati','urdu' => 'Urdu','polish' => 'Polish','punjabi' => 'Punjabi','wu' => 'Wu','other' => 'OTHER');
														foreach ($lisLArr as $key => $value) { 
															$fVal = get_user_meta($UserID, 'list_languages_'.$key, true);
															$fRating = get_user_meta($UserID, $key.'_rating', true);
															?>
															<li> 
																<div class="checkbox">
																	<label>
																		<input id="<?php echo $key; ?>" <?php if( $fVal == $value ){ echo "checked"; } ?> class="list_lang_checkbox" name="list_languages_<?php echo $key; ?>" type="checkbox" value="<?php echo $value; ?>"><span><?php echo $value; ?></span>
																	</label>
																	<?php
																	if ( $fVal == $value ) { ?>
																		<div class="rate_now <?php echo $key; ?>_rating ">
																			<h5>Rate Now</h5>
																			<div class="rate_now_stars">
																				<input type="hidden" class="pre_rating" lang="<?php echo $key; ?>" name="<?php echo $key; ?>_rating" value="<?php echo $fRating; ?>">
																				<i class="fa fa-star-o" lang="<?php echo $key; ?>_rating" no="1" rtno="<?php echo $key; ?>_rating_1" rat="Beginner"></i>
																				<i class="fa fa-star-o" lang="<?php echo $key; ?>_rating" no="2" rtno="<?php echo $key; ?>_rating_2" rat="Intermediate"></i>
																				<i class="fa fa-star-o" lang="<?php echo $key; ?>_rating" no="3" rtno="<?php echo $key; ?>_rating_3" rat="Expert"></i>
																				<i class="fa fa-star-o" lang="<?php echo $key; ?>_rating" no="4" rtno="<?php echo $key; ?>_rating_4" rat="Competent"></i>
																				<i class="fa fa-star-o" lang="<?php echo $key; ?>_rating" no="5" rtno="<?php echo $key; ?>_rating_5" rat="Advanced"></i>
																			</div>
																		</div>
																	<?php } ?>
																	
																</div> 
															</li>
															
															<?php 
														} 
														$fValOth = get_user_meta($UserID, 'list_languages_other', true);
														?>
														<li> <input class="form-control" type="text" name="list_languages_text" value="<?php echo get_user_meta($UserID, 'list_languages_text', true); ?>"  <?php if ( empty($fValOth) ) { echo "style='display:none;'";  } ?> ></li> <!-- style="display: none;" -->
													</ul>
												</div>
											</div>

											<div class="col-md-5">
												<div class="star_rating">
												
													<div class="rating_box" data-toggle="tooltip">
														<span class="star_icon rating1"></span><p></p>
														<h4>Beginner</h4>
														<div class="tooltip top" role="tooltip">
															<div class="tooltip-arrow"></div>
															<div class="tooltip-inner">
																Has limited experience, shows desire and adopts behaviors driven by standards in the simplest situations. Requires extensive guidance.
															</div>
														</div>
													</div>
													
													<div class="rating_box" data-toggle="tooltip">
														<span class="star_icon rating2"></span><p></p>
														<h4>Competent</h4>
														<div class="tooltip top" role="tooltip">
															<div class="tooltip-arrow"></div>
															<div class="tooltip-inner">
																Has been confronted with a sufficient number of practical situations to observe and applies comptency in somewhat difficult situations. Requires frequent quidance.
															</div>
														</div>
													</div>

													<div class="rating_box" data-toggle="tooltip">
														<span class="star_icon rating3"></span><p></p>
														<h4>Intermediate</h4>
														<div class="tooltip top" role="tooltip">
															<div class="tooltip-arrow"></div>
															<div class="tooltip-inner">
															    Posses two or three years of experience in the same circumstances and can evaluate and execute initiatives. Does not process self-sufficiency yet, but has the knowledge and preparation to face most situations. Requires occasional guidance.
															</div>
														</div>
													</div>
													
													<div class="rating_box" data-toggle="tooltip">
														<span class="star_icon rating4"></span><p></p>
														<h4>Advanced</h4>
														<div class="tooltip top" role="tooltip">
															<div class="tooltip-arrow"></div>
															<div class="tooltip-inner">
															   Applies accumulated experience completely in considerably difficult situations. Able to identify, colaborate, communicate and make decisions efficiently. Generally requires little and no guidance.
															</div>
														</div>
													</div>

													<div class="rating_box" data-toggle="tooltip">
														<span class="star_icon rating5"></span><p></p>
														<h4>Expert</h4>
														<div class="tooltip top" role="tooltip">
															<div class="tooltip-arrow"></div>
															<div class="tooltip-inner">
															   Applies accumulated experience completely in exceptionally difficult situations. Serves as a key resource and advises others. Not all professionals are able to reach this level.
														    </div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>



								<!-- Stpep8 -->
								<div class="basic_info_step_8 basic_info_steps" style="display:none;">
									<div class="written_languages">
										<p><strong>Written Languages</strong></p>
										<div class="row">
											<div class="col-md-7">
												<div class="indent-2x">
													<ul class="radio-group radio-group-1-2">
														<?php
														$wrLArr = array('Mandarin','Vietnamese','English','Javanese','Spanish','Tamil','Hindi','Korean','Russian','Turkish','Arabic','Telugu','Portuguese','Marathi','Bengali','Italian','French','Thai','Malay','Burmese','Indonesian','Burmese','German','Cantonese','Japanese','Kannada','Farsi (Persian)','Gujarati','Urdu','Polish','Punjabi','Wu','OTHER');
														$wrVal = explode(',', get_cimyFieldValue($UserID, 'LANGUAGES_WRITTEN') );
														foreach ($wrLArr as $value) { ?>
															<li> <div class="checkbox"><label><input name="LANGUAGES_WRITTEN[]" <?php if( in_array($value, $wrVal) ){ echo "checked"; } ?> class="wri_lan_list" type="checkbox" value="<?php echo $value; ?>"><span><?php echo $value; ?></span></label></div> </li>
															<?php 
														}
														?>
														<li> <input class="form-control" type="text" name="LANGUAGES_WRITTEN_OT" value="<?php echo get_cimyFieldValue($UserID, 'LANGUAGES_WRITTEN_OT'); ?>"  <?php if ( !in_array('OTHER', $wrVal) ) { echo "style='display:none;'";  } ?> ></li> <!-- style="display: none;" -->
													</ul>
												</div>
											</div>
										</div>
									</div>

									<?php
									jobseeker_basic_info_member_tips('seeker_update_basic_info');
									?>	
								</div>


								<!-- Stpep9 -->
								<div class="basic_info_step_9 basic_info_steps" style="display:none;">
									<div class="employment_situation">
										<p><strong>Please tell us a little about your current employment situation: (<a id="selectall">Select all that apply</a>)</strong></p>
										<p class="text-primary"><strong>NOTE:</strong> The responses to this question will not be shown directly to potential or current Employers.</p>
										<div class="row">
											<div class="col-md-12">
												<div class="indent-2x">
													<ul class="radio-group radio-group-1-2">
														<?php 
														
														$cWsArr = get_cimy_options_arr_from_field( 'CUR_WORK_SITUATION' );
																	
														$cWsVal = explode(',', get_cimyFieldValue($UserID, 'CUR_WORK_SITUATION') );
														foreach ($cWsArr as $value) { ?>
															<li>
															 <div class="checkbox"><label><input name="CUR_WORK_SITUATION[]" <?php if( in_array($value, $cWsVal) ){ echo "checked"; } ?> type="checkbox" value="<?php echo $value; ?>"><span><?php echo $value; ?></span></label></div> </li>
														<?php } ?>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>


								<!-- Step10 -->
								<div class="basic_info_step_10 basic_info_steps" style="display:none;">

									<?php $uSf = get_cimyFieldValue($UserID, 'US_ARMED_FORCES'); ?>
									<?php $uSf_o = get_cimyFieldValue($UserID, 'US_ARMED_FORCES_OPTI'); ?>
									<div class="retired">
										<p><strong>Are you active or Retired United States Armed Forces?</strong></p>
										
										<div class="indent-2x">
											<div class="radio"><label><input <?php if($uSf == 'Yes'){ echo "checked"; } ?> id="yes_retired" name="US_ARMED_FORCES" type="radio" value="Yes"> <span>Yes</span></label></div>
											<div class="radio"><label><input <?php if($uSf == 'No'){ echo "checked"; } ?> id="retired" name="US_ARMED_FORCES" type="radio" value="No"> <span>No</span></label></div>
											<div id="fours" <?php if($uSf != 'Yes'){ echo 'style="display:none;"'; } ?>>
												<div class="indent">
													<div class="radio"><label><input <?php if($uSf_o == 'Army'){ echo "checked"; } ?> id="army" name="US_ARMED_FORCES_OPTION" type="radio" value="Army"> <span>Army</span></label></div>
													<div class="radio"><label><input <?php if($uSf_o == 'Navy'){ echo "checked"; } ?> id="navy" name="US_ARMED_FORCES_OPTION" type="radio" value="Navy"> <span>Navy</span></label></div>
													<div class="radio"><label><input <?php if($uSf_o == 'Marine Corps'){ echo "checked"; } ?> id="marine_corps" name="US_ARMED_FORCES_OPTION" type="radio" value="Marine Corps"> <span>Marine Corps</span></label></div>
													<div class="radio"><label><input <?php if($uSf_o == 'Air Force'){ echo "checked"; } ?> id="air_force" name="US_ARMED_FORCES_OPTION" type="radio" value="Air Force"> <span>Air Force</span></label></div>
													<div class="radio"><label><input <?php if($uSf_o == 'Coast Guard'){ echo "checked"; } ?> id="coast_guard" name="US_ARMED_FORCES_OPTION" type="radio" value="Coast Guard"> <span>Coast Guard</span></label></div>
													<div class="radio"><label><input <?php if($uSf_o == 'National Guard'){ echo "checked"; } ?> id="national_guard" name="US_ARMED_FORCES_OPTION" type="radio" value="National Guard"> <span>National Guard</span></label></div>
													<div class="radio"><label><input <?php if($uSf_o == 'Air National Guard'){ echo "checked"; } ?> id="air_national_guard" name="US_ARMED_FORCES_OPTION" type="radio" value="Air National Guard"> <span>Air National Guard</span></label></div>
													<div class="radio"><label><input <?php if($uSf_o == 'Other'){ echo "checked"; } ?> id="" name="US_ARMED_FORCES_OPTION" type="radio" value="Other"> <span>Other</span></label></div>
												</div>
											</div>
										</div>
									</div>

									<?php echo setupCimyQuestion($UserID, 'LOCAL_LAW_FORCE_YN');?>
									<?php echo setupCimyQuestion($UserID, 'FEDERAL_NVESTIGATIV');?>

									<?php
									$majorM = get_cimyFieldValue($UserID, 'MAJOR_METROPOLITAN');
									$majorMo = get_cimyFieldValue($UserID, 'MAJOR_METROPOLITAN_O');
									$majorM_Arr = array('New York','Los Angeles','Chicago','Houston','Philadelphia','Phoenix','San Antonio','San Diego','Dallas','San Jose','Austin','Jacksonville','San Francisco','Indianapolis','Columbus','Fort Worth','Charlotte','Seattle','Denver','El Paso','Detroit','Washington','Boston','Memphis','Nashville','Portland','Oklahoma City','Las Vegas','Baltimore','Louisville','Milwaukee','Albuquerque','Tucson','Fresno','Sacramento','Kansas City','Long Beach','Mesa','Atlanta','Colorado Springs','Virginia Beach','Raleigh','Omaha','Miami','Oakland','Minneapolis','Tulsa','Wichita','New Orleans','Arlington','Cleveland','Bakersfield','Tampa','Aurora','Honolulu','Anaheim','Santa Ana','Corpus Christi','Riverside','St. Louis','Lexington','Stockton','Pittsburgh','Saint Paul','Anchorage','Cincinnati','Henderson','Greensboro','Plano','Newark','Toledo','Lincoln','Orlando','Chula Vista','Jersey City','Chandler','Fort Wayne','Buffalo','Durham','St. Petersburg','Irvine','Laredo','Lubbock','Madison','Gilbert','Norfolk','Reno','Winston–Salem','Glendale','Hialeah','Garland','Scottsdale','Irving','Chesapeake','North Las Vegas','Fremont','Baton Rouge','Richmond','Boise','San Bernardino','Spokane','Birmingham','Modesto','Des Moines','Rochester','Tacoma','Fontana','Oxnard','Moreno Valley','Fayetteville','Huntington Beach','Yonkers','Montgomery','Amarillo','Little Rock','Akron','Shreveport','Augusta','Grand Rapids','Mobile','Salt Lake City','Huntsville','Tallahassee','Grand Prairie','Overland Park','Knoxville','Worcester','Brownsville','Newport News','Santa Clarita','Port St. Lucie','Providence','Fort Lauderdale','Chattanooga','Tempe','Oceanside','Garden Grove','Rancho Cucamonga','Cape Coral','Santa Rosa','Vancouver','Sioux Falls','Peoria','Ontario','Jackson','Elk Grove','Springfield','Pembroke Pines','Salem','Corona','Eugene','McKinney','Fort Collins','Lancaster','Cary','Palmdale','Hayward','Salinas','Frisco','Pasadena','Macon','Alexandria','Pomona','Lakewood','Sunnyvale','Escondido','Hollywood','Clarksville','Torrance','Rockford','Joliet','Paterson','Bridgeport','Naperville','Savannah','Mesquite','Syracuse','Orange','Fullerton','Killeen','Dayton','McAllen','Bellevue','Miramar','Hampton','West Valley City','Warren','Olathe','Columbia','Thornton','Carrollton','Midland','Charleston','Waco','Sterling Heights','Denton','Cedar Rapids','New Haven','Roseville','Gainesville','Visalia','Coral Springs','Thousand Oaks','Elizabeth','Stamford','Concord','Surprise','Lafayette','Topeka','Kent','Simi Valley','Santa Clara','Murfreesboro','Hartford','Athens','Victorville','Abilene','Vallejo','Berkeley','Norman','Allentown','Evansville','Odessa','Fargo','Beaumont','Independence','Ann Arbor','El Monte','Round Rock','Wilmington','Arvada','Provo','Lansing','Downey','Carlsbad','Costa Mesa','Miami Gardens','Westminster','Clearwater','Fairfield','Elgin','Temecula','West Jordan','Inglewood','Richardson','Lowell','Gresham','Antioch','Cambridge','High Point','Billings','Manchester','Murrieta','Centennial','Ventura','Pueblo','Pearland','Waterbury','West Covina','North Charleston','Everett','College Station','Palm Bay','Pompano Beach','Boulder','Norwalk','West Palm Beach','Broken Arrow','Daly City','Sandy Springs','Burbank','Green Bay','Santa Maria','Wichita Falls','Lakeland','Clovis','Lewisville','Tyler','El Cajon','San Mateo','Rialto','Edison','Davenport','Hillsboro','Woodbridge','Las Cruces','South Bend','Vista','Greeley','Davie','San Angelo','Jurupa Valley','Renton','Other');
									asort($majorM_Arr);
									?>
									<div class="major_metro_city">
				    					<p><strong>Select the closest major metropolitan city close to where you are searching.</strong></p>
										<div class="row metro_city">
											<div class="col-md-8">
												<div class="has-feedback indent-2x form-group">
													<select class="form-control" name="MAJOR_METROPOLITAN">
														<option value="">Choose City</option>
														<?php
														foreach ($majorM_Arr as $value) { ?>
															<option value="<?php echo $value; ?>" <?php if($value == $majorM){ echo "selected"; } ?> ><?php echo $value; ?></option> <?php
														}
														?>
													</select>
													<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
												</div>
											</div>
										</div>
									</div>

									<?php 
									if ( $majorM == 'Other' ) { ?>
										<div id="othe_metropo_city">
											<p><strong>Other closest major metropolitan city.</strong></p>
											<div class="row metro_city">
												<div class="col-md-6">
													<div class="indent">
														<input type="text" name="MAJOR_METROPOLITAN_O" value="<?php echo $majorMo; ?>">
													</div>
												</div>
											</div>
										</div>
									<?php } ?>

									<div class="currently_employed_comp" style="display:block">
										<?php
										$SEEKER_ZIP_CODE = get_cimyFieldValue($UserID, 'SEEKER_ZIP_CODE');
										?>
										<p><strong>Zip Code.</strong></p>
										<div class="row">
											<div class="col-md-8">
												<div class="indent-2x form-group">
													<input name="SEEKER_ZIP_CODE" type="text" value="<?php echo $SEEKER_ZIP_CODE; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="text-center paddedTopBottom"><button class="btn btn-primary" type="button" id="update_job_seeker_pro">Update</button></div>

								<div class="paginationDiv text-center paddedTopBottom">
				    			<?php
				    				for($i=1;$i<=10;$i++){
				    					$tmpClass = ($i==1) ? 'view_this_step active' : 'view_this_step' ; 
				    					echo ('<a href="javascript:void(0);" data-step="'.$i.'" class="'.$tmpClass.'">'.$i.'</a>');
				    				}
				    			?>					    		
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
	jQuery(document).ready( function() {

		builderUnsavedChanges = false;

		jQuery('#date_available_to_work').datepicker({
			minDate : 'now',
		    dateFormat : "yy-mm-dd",
		});

		function numericOnly(v) {
		    var r = new RegExp('[^0-9]','g');
		    return (v.match(r) == null) ? false : true;
		}
		
		/*........View Basic Steps..............*/
		jQuery('.view_this_step').on('click', function() {
			//check previous unsaved changes
			if(builderUnsavedChanges == true ){
				swal({
						title: "Uh Oh!", 
						html: true,
						text: "<span class='text-center'>Please 'update/save' your changes before switching pages.</span>",
						type: "error",
						confirmButtonClass: "btn-primary btn-sm",
					});
			}else{
				var step = jQuery(this).data('step');
				jQuery('.view_this_step').removeClass('active');
				jQuery(this).addClass('active');
				jQuery('.basic_info_steps').hide();
				jQuery('.basic_info_step_'+step).show();
				jQuery('html, body').animate({
			        scrollTop: jQuery('.basic_info_step_'+step).offset().top - 200
			    }, 500);	
			}
			
		});

		jQuery("#profilebuilder4390 input[type=text], #profilebuilder4390 textarea").on('input',function(e){
			builderUnsavedChanges = true;
		});
		jQuery('#profilebuilder4390 input[type=radio], #profilebuilder4390 input[type=checkbox], #profilebuilder4390 select').change(function() {
			builderUnsavedChanges = true;
		});

		/*..........aSSOCIATES degree popup validation..............*/
		jQuery('.basic_info_step_2').on('click','#view_detail' , function() {
			
			jQuery('#accociatesdegreeModal').modal('show');
		});

		jQuery('#associates_degree').click(function(){
			 //alert('hello');
			jQuery("#ad").html('<a href="javascript:void(0);" id="view_detail">View Detail</a>');
					 jQuery("#bd").html('');
					 jQuery("#md").html('');
					 jQuery("#dd").html('');
			jQuery('.accociatesdegree .study_error').remove();
			if (jQuery(this).attr("checked") == "checked") {
				 
	            jQuery('#accociatesdegreeModal').modal('show');
	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            
	            if( jQuery(this).attr('chd') != 'associates_degree' ) { 
	            	jQuery('.accociatesdegree input[type="text"]').val('');
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('input[name="HIGHEST_EDUCATION"]').removeAttr('chd');
	            jQuery(this).attr('chd', 'associates_degree');
	      	}
		});

		jQuery('#bachelors_degree').click(function(){
			 jQuery("#ad").html('');
			 jQuery("#bd").html('<a href="javascript:void(0);" id="view_detail"> View Detail</a>');
			 jQuery("#md").html('');
			 jQuery("#dd").html('');
			jQuery('.accociatesdegree .study_error').remove();	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#accociatesdegreeModal').modal('show');
	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            if( jQuery(this).attr('chd') != 'bachelors_degree' ) { 
	            	jQuery('.accociatesdegree input[type="text"]').val('');
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('input[name="HIGHEST_EDUCATION"]').removeAttr('chd');
	            jQuery(this).attr('chd', 'bachelors_degree');
	      	}
		});

		jQuery('#masters_degree').click(function(){
					 jQuery("#ad").html('');
					 jQuery("#bd").html('');
					 jQuery("#md").html('<a href="javascript:void(0);" id="view_detail">View Detail</a>');
					 jQuery("#dd").html('');
			jQuery('.accociatesdegree .study_error').remove();	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#accociatesdegreeModal').modal('show');
	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            if( jQuery(this).attr('chd') != 'masters_degree' ) { 
	            	jQuery('.accociatesdegree input[type="text"]').val('');
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('input[name="HIGHEST_EDUCATION"]').removeAttr('chd');
	            jQuery(this).attr('chd', 'masters_degree');
	      	}
		});

		jQuery('#doctorate').click(function(){	
					jQuery("#ad").html('');
					 jQuery("#bd").html('');
					 jQuery("#md").html('');
					 jQuery("#dd").html('<a href="javascript:void(0);" id="view_detail">View Detail</a>');
			jQuery('.accociatesdegree .study_error').remove();
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#accociatesdegreeModal').modal('show');
	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            if( jQuery(this).attr('chd') != 'doctorate' ) { 
	            	jQuery('.accociatesdegree input[type="text"]').val('');
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('input[name="HIGHEST_EDUCATION"]').removeAttr('chd');
	            jQuery(this).attr('chd', 'doctorate');
	      	}
		});


		/*...................education level validation.....................*/

		jQuery( ".accociatesdegree" ).on('keyup', 'input[name="AREA_OF_STUDY"]', function() {
			
			jQuery('#AREA_OF_STUDY-error').remove();
			var area_val = jQuery('input[name="AREA_OF_STUDY"]').val();
			if ( area_val == '' ) {
				jQuery('.education').removeClass('thisValid');
				jQuery('<label id="AREA_OF_STUDY-error" class="error study_error" for="AREA_OF_STUDY">Please enter an area of study.</label>').insertAfter('input[name="AREA_OF_STUDY"]');
			}
			else{
				jQuery('#AREA_OF_STUDY-error').remove();
			}
		});

		jQuery( ".accociatesdegree" ).on('keyup', 'input[name="SCHOOL_NAME"]', function() {
			
			jQuery('#SCHOOL_NAME-error').remove();
			var sch_val = jQuery('input[name="SCHOOL_NAME"]').val();
			if ( sch_val == '' ) {
				jQuery('.education').removeClass('thisValid');
				jQuery('<label id="SCHOOL_NAME-error" class="error study_error" for="SCHOOL_NAME">Please enter a school name.</label>').insertAfter('input[name="SCHOOL_NAME"]');
			}
			else{
				jQuery('#SCHOOL_NAME-error').remove();
			}
		});

		jQuery( ".accociatesdegree" ).on('keyup', 'input[name="STUDY_YEAR"]', function() {
			jQuery('#STUDY_YEAR-error').remove();
			var year = jQuery('input[name="STUDY_YEAR"]').val();
			if ( year == '' ) {
				jQuery('.education').removeClass('thisValid');
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter your year of graduation.</label>').insertAfter('input[name="STUDY_YEAR"]');
			}
			else if ( numericOnly( jQuery('input[name="STUDY_YEAR"]').val() ) ) {
				jQuery('.education').removeClass('thisValid');
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter only numeric values (0-9).</label>').insertAfter('input[name="STUDY_YEAR"]');
			}
			else{
				jQuery('#STUDY_YEAR-error').remove();
			}
		});

		jQuery('.accociatesdegree').on('click', 'input[name="STUDY_MAJOR"]', function() {
			jQuery('#STUDY_MAJOR-error').remove();
		});



		jQuery('.edu_level_save').on('click', function() {

			jQuery('.error').remove();

			var area_val = jQuery('input[name="AREA_OF_STUDY"]').val();
			if ( area_val == '' ) {
				jQuery('<label id="AREA_OF_STUDY-error" class="error study_error" for="AREA_OF_STUDY">Please enter an area of study.</label>').insertAfter('input[name="AREA_OF_STUDY"]');
			}

			var sch_val = jQuery('input[name="SCHOOL_NAME"]').val();
			if ( sch_val == '' ) {
				jQuery('<label id="SCHOOL_NAME-error" class="error study_error" for="SCHOOL_NAME">Please enter a school name.</label>').insertAfter('input[name="SCHOOL_NAME"]');
			}

			var year = jQuery('input[name="STUDY_YEAR"]').val();
			if ( year == '' ) {
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter your year of graduation.</label>').insertAfter('input[name="STUDY_YEAR"]');
			}
			else if ( numericOnly( jQuery('input[name="STUDY_YEAR"]').val() ) ) {
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter only numeric values (0-9).</label>').insertAfter('input[name="STUDY_YEAR"]');
			}

			var major = jQuery('input[name="STUDY_MAJOR"]');
			if ( !major.is(":checked") ) {
				jQuery('<label id="STUDY_MAJOR-error" class="error study_error" for="STUDY_MAJOR">Please select at least one.</label>').insertBefore('.study_major_option_msg');
			}

			if ( jQuery('.error').hasClass('study_error') ) {
				jQuery('.education').removeClass('thisValid');
				return false;
			}
			else{
				jQuery("#update_job_seeker_pro").click();
				jQuery('.education').addClass('thisValid');
			}
		});


		/*.............State issued Drivers License validation.............*/

		jQuery('input[name="POSSES_DRIVER_LICENS"]').on('click', function() {
			var dr_li = jQuery('input[name="POSSES_DRIVER_LICENS"]:checked').val();
			if ( dr_li == 'Yes' ) {
				jQuery('#state_field').show();
			}
			else{
				jQuery('#state_field').hide();
			}
		});


		/*...........License state validation.............*/

		jQuery('#inview_detail').click(function(){	
            jQuery('#Licenceholder').modal('show');
		});


		jQuery('input[name="FIELD_LICENSE_STATUS"]').click( function(){
			jQuery('#FIELD_LICENSE_STATE-error').remove();
			if ( jQuery('input[name="FIELD_LICENSE_STATUS"]:checked').val() == "Yes") {
				jQuery('#Licenceholder').modal('show');
	      	}
	      	else{

	      		jQuery('input[name="FIELD_LICENSE_STATE[]"]:checked').each(function(){
			      	jQuery(this).attr('checked', false);  
				});
	      	}
		});

		jQuery('.license_holder_save').on('click', function() {
			jQuery('#FIELD_LICENSE_STATE-error').remove();
			var law = jQuery('input[name="FIELD_LICENSE_STATE[]"]');
			if ( !law.is(":checked") ) {
				jQuery('<label id="FIELD_LICENSE_STATE-error" class="error state_error" for="FIELD_LICENSE_STATE"><br>Please select at least one.</label>').insertAfter('.license_holder_close_button');
			}

			if ( jQuery('.error').hasClass('state_error') ) {
				jQuery('#investigation_valid').removeClass('thisValid');
				return false;
			}
			else{
				jQuery('#investigation_valid').addClass('thisValid');
			}
		});


		jQuery('#Licenceholder').on('hidden.bs.modal', function (e) {
			jQuery('#FIELD_LICENSE_STATE-error').remove();

			if( !jQuery('input[name="FIELD_LICENSE_STATE[]"]').is(':checked') ){
				jQuery('#investigation_valid').removeClass('thisValid');
			}
		});


		/*........Spoken language rating & validation................*/

		jQuery('.pre_rating').each( function() { 

			var mand_r = jQuery(this).val();
			var lang_rating = jQuery(this).attr('name');
			var get_no = jQuery('i[rat="'+mand_r+'"]').attr('no');
			var lang = jQuery(this).attr('lang');

			if ( jQuery('#'+lang).is(':checked') ) {
				for (var i = 1; i <= get_no; i++) {
					jQuery('i[rtno="'+lang_rating+'_'+i+'"]').css('color', '#a12641');
					jQuery('i[rtno="'+lang_rating+'_'+i+'"]').addClass('fa-star');
					jQuery('i[rtno="'+lang_rating+'_'+i+'"]').removeClass('fa-star-o');
				}
			}
		});

		jQuery('.list_lang_checkbox').on('click', function() {

			var _this = jQuery(this);
			var this_id   = _this.attr('id');

			if( _this.is(':checked') ){
				_this.closest('li div.checkbox').append('<div class="rate_now '+this_id+'_rating"><h5>Rate Now</h5><div class="rate_now_stars"><input type="hidden" name="'+this_id+'_rating" value="" ><i class="fa fa-star-o" lang="'+this_id+'_rating" no="1" rtno="'+this_id+'_rating_1" rat="Beginner"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="2" rtno="'+this_id+'_rating_2" rat="Intermediate"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="3" rtno="'+this_id+'_rating_3" rat="Expert"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="4" rtno="'+this_id+'_rating_4" rat="Competent"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="5" rtno="'+this_id+'_rating_5" rat="Advanced"></i></div></div>');
			
				if ( _this.val() == 'OTHER' ) {
					jQuery('input[name="list_languages_text"]').show();
				}
			}
			else{
				jQuery('.'+this_id+'_rating').remove();
				if ( _this.val() == 'OTHER' ) {
					jQuery('input[name="list_languages_text"]').hide().val('');
					jQuery('#list_languages_text-error').remove();
				}
			}
		});

		jQuery('.rate_now_stars i').live('click', function() {
			var rate = jQuery(this).attr('rat');
			var lang = jQuery(this).attr('lang');
			var no = jQuery(this).attr('no');
			jQuery('input[name="'+lang+'"]').val(rate);


			for (var i = 1; i <= no; i++) {
				jQuery('i[rtno="'+lang+'_'+i+'"]').css('color', '#a12641');
				jQuery('i[rtno="'+lang+'_'+i+'"]').addClass('fa-star');
				jQuery('i[rtno="'+lang+'_'+i+'"]').removeClass('fa-star-o');
			}

			if ( no < 5 ) {
				for (var i = parseInt(no)+1; i <= 5; i++) {
					jQuery('i[rtno="'+lang+'_'+i+'"]').removeAttr('style');
					jQuery('i[rtno="'+lang+'_'+i+'"]').addClass('fa-star-o');
					jQuery('i[rtno="'+lang+'_'+i+'"]').removeClass('fa-star');
				}
			}

		});


		/*......Written language validation..............*/

		jQuery('.wri_lan_list').on('click', function() {

			var _this = jQuery(this);
			if( _this.is(':checked') ){
				if ( _this.val() == 'OTHER' ) {
					jQuery('input[name="LANGUAGES_WRITTEN_OT"]').show();
				}
			}
			else{
				if ( _this.val() == 'OTHER' ) {
					jQuery('input[name="LANGUAGES_WRITTEN_OT"]').hide().val('');
				}
			}
		});


		/*......Us armed forces validation................*/
		jQuery('#yes_retired').click(function(){	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#fours').show();
	      	}
		});

		jQuery('#retired').click(function(){	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#fours').hide();
	            jQuery('.usfor_error').remove();
	            jQuery('input[name="US_ARMED_FORCES_OPTION"]:checked').each(function(){
				    jQuery(this).attr('checked', false);  
				});
	      	}
		});


		/*...........Federal Investigative or Law Enforcement Agency Validation...........*/
		
		jQuery('#FnviewDetail').click(function(){	
            jQuery('#Investigative').modal('show');
		});

		jQuery('input[name=FEDERAL_NVESTIGATIV]').change(function(){	
			if (jQuery(this).val() == "Yes") {
	            jQuery('#Investigative').modal('show');
	      	}
		});

		jQuery('#law_enforcement_agency').click(function(){	
		    jQuery('input[name="US_LAW_ENFORCE_STATU"]').attr('checked', false);  
		    jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').hide();
			jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').val('');
			jQuery('#law_enfo_agency').removeClass('thisValid');
		});



		jQuery('#Investigative').on('hidden.bs.modal', function (e) {
			jQuery('#US_LAW_ENFORCE_STATU-error').remove();
			jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();

			if( !jQuery('input[name="US_LAW_ENFORCE_STATU"]').is(':checked') ){
				jQuery('#law_enfo_agency').removeClass('thisValid');
			}
		});


		jQuery('.law_enforcement_list').on('click', 'input[name="US_LAW_ENFORCE_STATU"]', function() {
			jQuery('#US_LAW_ENFORCE_STATU-error').remove();
		});



		jQuery( ".law_enforcement_list" ).on('keyup', 'input[name="US_LAW_ENFORCE_STATU_OTHER"]', function() {
			
			jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();
			var sch_val = jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').val();
			if ( sch_val == '' ) {
				jQuery('#law_enfo_agency').removeClass('thisValid');
				jQuery('<label id="US_LAW_ENFORCE_STATU_OTHER-error" class="error study_error" for="US_LAW_ENFORCE_STATU_OTHER">Please enter an other agency name.</label>').insertAfter('input[name="US_LAW_ENFORCE_STATU_OTHER"]');
			}
			else{
				jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();
			}
		});

		//jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').hide();

		jQuery('.law_enforcement_list input[name="US_LAW_ENFORCE_STATU"]').on('click', function() {

			var _this = jQuery(this);
			
				if ( jQuery('input[name="US_LAW_ENFORCE_STATU"]:checked').val() == 'OTHER' ) {
					jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').show();
				}
				else{
					jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').hide().val('');
					jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();
				}
		});

		jQuery('.us_law_status_save').on('click', function() {
			jQuery('.error').remove();
			var law = jQuery('input[name="US_LAW_ENFORCE_STATU"]');
			if ( !law.is(":checked") ) {
				jQuery('<label id="US_LAW_ENFORCE_STATU-error" class="error law_error" for="US_LAW_ENFORCE_STATU"><br>Please select at least one.</label>').insertAfter('.law_status_close_button');
			}

			var law_val = jQuery('input[name="US_LAW_ENFORCE_STATU"]:checked').val();
			if ( law_val == 'OTHER' ) {
				var other_law_val = jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').val();
				if ( other_law_val == '' ) {
					jQuery('<label id="US_LAW_ENFORCE_STATU_OTHER-error" class="error law_error" for="US_LAW_ENFORCE_STATU_OTHER">Please enter an other agency name.</label>').insertAfter('input[name="US_LAW_ENFORCE_STATU_OTHER"]');
				}
			}

			if ( jQuery('.error').hasClass('law_error') ) {
				jQuery('#law_enfo_agency').removeClass('thisValid');
				return false;
			}
			else{
				jQuery('#law_enfo_agency').addClass('thisValid');
			}
		});


		/*............Other Metropolitan City Validation...............*/

		jQuery('select[name="MAJOR_METROPOLITAN"]').on('change', function() {
			var city = jQuery(this).val();
			if ( city == 'Other') {
				jQuery('<div id="othe_metropo_city"><p><strong>Other closest major metropolitan city.</strong></p><div class="row metro_city"><div class="col-md-6"><div class="indent"><input type="text" value="" name="MAJOR_METROPOLITAN_O"></div></div></div></div>').insertAfter('.metro_city');
			}
			else{
				jQuery('#othe_metropo_city').remove();
			}
		});

		/*......CURR_EMPLOYED_YN.......*/
		jQuery('input[name="CURR_EMPLOYED_YN"]').on('click', function() {
			if (jQuery('input[name="CURR_EMPLOYED_YN"]:checked').val() == 'Yes' ) {
				jQuery('.currently_employed_comp').show();
			}
			else{
				jQuery('.currently_employed_comp').hide();
				jQuery('input[name="NAME_OF_COMP"]').val('');
			}
		});

	});
</script>

<!-- Update job seeker basic information -->
<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('#update_job_seeker_pro').on('click', function(){

			/*.......Step1........*/
			var SYSTEM_AND_PROCE = jQuery("input[name='SYSTEM_AND_PROCE']:checked").val();
			var BEST_INDUSTRY = jQuery("input[name='BEST_INDUSTRY']:checked").val();
			var CLEARANCE_LEVEL = jQuery("input[name='CLEARANCE_LEVEL']:checked").val();
			var CLEARANCE_STATUS = jQuery("input[name='CLEARANCE_STATUS']:checked").val();

			/*.......Step2........*/
			var HIGHEST_EDUCATION = jQuery("input[name='HIGHEST_EDUCATION']:checked").val();
			var hi_edu_arr = ['Associates Degree', 'Bachelors Degree', 'Masters Degree', 'Doctorate Degree / PhD.']; 
			if  ( jQuery.inArray( HIGHEST_EDUCATION, hi_edu_arr ) != -1 ) {

				if ( jQuery('.education').hasClass('thisValid') ) {
					var AREA_OF_STUDY = jQuery("input[name='AREA_OF_STUDY']").val();
					var SCHOOL_NAME = jQuery("input[name='SCHOOL_NAME']").val();
					var STUDY_YEAR = jQuery("input[name='STUDY_YEAR']").val();
					var STUDY_MAJOR = jQuery("input[name='STUDY_MAJOR']:checked").val();
				}
				else{
					var AREA_OF_STUDY = '';
					var SCHOOL_NAME   = '';
					var STUDY_YEAR 	  = '';
					var STUDY_MAJOR   = '';
				}
			}
			else{
				var AREA_OF_STUDY = '';
				var SCHOOL_NAME   = '';
				var STUDY_YEAR 	  = '';
				var STUDY_MAJOR   = '';
			}

			var opporunity = [];
			jQuery("input[name='TYPE_OF_OPPORTUNITY[]']:checked").each(function() {
		        opporunity.push( jQuery(this).val() );
		    });

			var TYPE_OF_OPPORTUNITY = opporunity;
			//var TYPE_OF_OPPORTUNITY = jQuery("input[name='TYPE_OF_OPPORTUNITY']:checked").val();


			/*.......Step3........*/
			var JOB_SEARCH_RADIUS = jQuery("input[name='JOB_SEARCH_RADIUS']:checked").val();
			var US_ELIGIBLE = jQuery("input[name='US_ELIGIBLE']:checked").val();
			var SECURITY_CLEAR_YN = jQuery("input[name='SECURITY_CLEAR_YN']:checked").val();
			var OVER_18_YN = jQuery("input[name='OVER_18_YN']:checked"). val();


			
			/*.......Step4........*/
			var POSSES_DRIVER_LICENS = jQuery("input[name='POSSES_DRIVER_LICENS']:checked").val();
			var DRIVER_STATE = jQuery("select[name='DRIVER_STATE']").val();
			var RELIABLE_TRANSPORT = jQuery("input[name='RELIABLE_TRANSPORT']:checked").val();
			var CURR_EMPLOYED_YN = jQuery("input[name='CURR_EMPLOYED_YN']:checked").val();
			var NAME_OF_COMP = jQuery("input[name='NAME_OF_COMP']").val();
			var WORK_DATE_AVAILABLE = jQuery("input[name='WORK_DATE_AVAILABLE']").val();

			
			
			/*.......Step5........*/
			var INDUSTRY_YEARS = jQuery("select[name='INDUSTRY_YEARS']").val();
			var CURR_CAREER_LVL = jQuery("select[name='CURR_CAREER_LVL']").val();

			var hear_about = [];
			jQuery("input[name='REF_SRC[]']:checked").each(function() {
		        hear_about.push( jQuery(this).val() );
		    });
			var REF_SRC = hear_about;
			var RELOCATION_YN = jQuery("input[name='RELOCATION_YN']:checked").val();

			
			
			/*........Step6...........*/
			var COMPENSATION_CURRENT = jQuery("input[name='COMPENSATION_CURRENT']:checked").val();
			var COMPENSATION_ACC = jQuery("input[name='COMPENSATION_ACC']:checked").val();

			var COMPENSATION_DESIRED = jQuery("input[name='COMPENSATION_DESIRED']:checked").val();
			var COMP_DESIRED_ACC = jQuery("input[name='COMP_DESIRED_ACC']:checked").val();
			

			var FIELD_LICENSE_STATUS = jQuery("input[name='FIELD_LICENSE_STATUS']:checked").val();

			if ( jQuery('#investigation_valid').hasClass('thisValid') ) { 

				var li_state = [];
				jQuery("input[name='FIELD_LICENSE_STATE[]']:checked").each(function() {
			        li_state.push( jQuery(this).val() );
			    });

				var FIELD_LICENSE_STATE = li_state;
			}
			else{
				var FIELD_LICENSE_STATE = '';
			}



			/*.......Step7........*/
			var list_languages_mandarin = jQuery("input[name='list_languages_mandarin']:checked").val();
			var list_languages_vietnamese = jQuery("input[name='list_languages_vietnamese']:checked").val();
			var list_languages_english = jQuery("input[name='list_languages_english']:checked").val();
			var list_languages_javanese = jQuery("input[name='list_languages_javanese']:checked").val();
			var list_languages_spanish = jQuery("input[name='list_languages_spanish']:checked").val();
			var list_languages_tamil = jQuery("input[name='list_languages_tamil']:checked").val();

			var list_languages_hindi = jQuery("input[name='list_languages_hindi']:checked").val();
			var list_languages_Korean = jQuery("input[name='list_languages_Korean']:checked").val();
			var list_languages_russian = jQuery("input[name='list_languages_russian']:checked").val();
			var list_languages_turkish = jQuery("input[name='list_languages_turkish']:checked").val();
			var list_languages_arabic = jQuery("input[name='list_languages_arabic']:checked").val();
			var list_languages_telugu = jQuery("input[name='list_languages_telugu']:checked").val();

			var list_languages_portuguese = jQuery("input[name='list_languages_portuguese']:checked").val();
			var list_languages_marathi = jQuery("input[name='list_languages_marathi']:checked").val();
			var list_languages_bengali = jQuery("input[name='list_languages_bengali']:checked").val();
			var list_languages_italian = jQuery("input[name='list_languages_italian']:checked").val();
			var list_languages_french = jQuery("input[name='list_languages_french']:checked").val();
			var list_languages_thai = jQuery("input[name='list_languages_thai']:checked").val();

			var list_languages_malay = jQuery("input[name='list_languages_malay']:checked").val();
			var list_languages_burmese = jQuery("input[name='list_languages_burmese']:checked").val();
			var list_languages_german = jQuery("input[name='list_languages_german']:checked").val();
			var list_languages_cantonese = jQuery("input[name='list_languages_cantonese']:checked").val();
			var list_languages_japanese = jQuery("input[name='list_languages_japanese']:checked").val();
			var list_languages_kannada = jQuery("input[name='list_languages_kannada']:checked").val();

			var list_languages_farsi = jQuery("input[name='list_languages_farsi']:checked").val();
			var list_languages_gujarati = jQuery("input[name='list_languages_gujarati']:checked").val();
			var list_languages_urdu = jQuery("input[name='list_languages_urdu']:checked").val();
			var list_languages_polish = jQuery("input[name='list_languages_polish']:checked").val();
			var list_languages_punjabi = jQuery("input[name='list_languages_punjabi']:checked").val();
			var list_languages_wu = jQuery("input[name='list_languages_wu']:checked").val();

			var list_languages_other = jQuery("input[name='list_languages_other']:checked").val();
			var list_languages_text = jQuery("input[name='list_languages_text']").val();


			var mandarin_rating =  jQuery("input[name='mandarin_rating']").val();
			var vietnamese_rating =  jQuery("input[name='vietnamese_rating']").val();
			var english_rating =  jQuery("input[name='english_rating']").val();
			var javanese_rating =  jQuery("input[name='javanese_rating']").val();
			var spanish_rating =  jQuery("input[name='spanish_rating']").val();
			var tamil_rating =  jQuery("input[name='tamil_rating']").val();

			var hindi_rating =  jQuery("input[name='hindi_rating']").val();
			var Korean_rating =  jQuery("input[name='Korean_rating']").val();
			var russian_rating =  jQuery("input[name='russian_rating']").val();
			var turkish_rating =  jQuery("input[name='turkish_rating']").val();
			var arabic_rating =  jQuery("input[name='arabic_rating']").val();
			var telugu_rating =  jQuery("input[name='telugu_rating']").val();

			var portuguese_rating =  jQuery("input[name='portuguese_rating']").val();
			var marathi_rating =  jQuery("input[name='marathi_rating']").val();
			var bengali_rating =  jQuery("input[name='bengali_rating']").val();
			var italian_rating =  jQuery("input[name='italian_rating']").val();
			var french_rating =  jQuery("input[name='french_rating']").val();
			var thai_rating =  jQuery("input[name='thai_rating']").val();

			var malay_rating =  jQuery("input[name='malay_rating']").val();
			var burmese_rating =  jQuery("input[name='burmese_rating']").val();
			var german_rating =  jQuery("input[name='german_rating']").val();
			var cantonese_rating =  jQuery("input[name='cantonese_rating']").val();
			var japanese_rating =  jQuery("input[name='japanese_rating']").val();
			var kannada_rating =  jQuery("input[name='kannada_rating']").val();

			var farsi_rating =  jQuery("input[name='farsi_rating']").val();
			var gujarati_rating =  jQuery("input[name='gujarati_rating']").val();
			var urdu_rating =  jQuery("input[name='urdu_rating']").val();
			var polish_rating =  jQuery("input[name='polish_rating']").val();
			var punjabi_rating =  jQuery("input[name='punjabi_rating']").val();
			var wu_rating =  jQuery("input[name='wu_rating']").val();
			var other_rating =  jQuery("input[name='other_rating']").val();


			/*...........Step8........*/
			var lang_wr = [];
			jQuery("input[name='LANGUAGES_WRITTEN[]']:checked").each(function() {
		        lang_wr.push( jQuery(this).val() );
		    });
			var LANGUAGES_WRITTEN = lang_wr;
			var LANGUAGES_WRITTEN_OT = jQuery("input[name='LANGUAGES_WRITTEN_OT']").val();


			/*...........Step9........*/
			var work_sitiuation = [];
			jQuery("input[name='CUR_WORK_SITUATION[]']:checked").each(function() {
		        work_sitiuation.push( jQuery(this).val() );
		    });
			var CUR_WORK_SITUATION = work_sitiuation;


			/*...........Step10........*/
			var US_ARMED_FORCES = jQuery("input[name='US_ARMED_FORCES']:checked").val();
			var US_ARMED_FORCES_OPTION = jQuery("input[name='US_ARMED_FORCES_OPTION']:checked").val();
			var LOCAL_LAW_FORCE_YN = jQuery("input[name='LOCAL_LAW_FORCE_YN']:checked").val();
			var FEDERAL_NVESTIGATIV = jQuery("input[name='FEDERAL_NVESTIGATIV']:checked").val();
			if ( jQuery('#law_enfo_agency').hasClass('thisValid') ) {
				var us_law_force = jQuery("input[name='US_LAW_ENFORCE_STATU']:checked").val();
				if ( us_law_force == 'OTHER' ) {
					var US_LAW_ENFORCE_STATU = us_law_force;
					var US_LAW_ENFORCE_OTHER = jQuery("input[name='US_LAW_ENFORCE_STATU_OTHER']").val();
				}
				else {
					var US_LAW_ENFORCE_STATU = us_law_force;
					var US_LAW_ENFORCE_OTHER = '';
				}
			}
			else{
				var US_LAW_ENFORCE_STATU = '';
				var US_LAW_ENFORCE_OTHER = '';
			}

			var MAJOR_METROPOLITAN = jQuery("select[name='MAJOR_METROPOLITAN']").val();
			var MAJOR_METROPOLITAN_O = jQuery('input[name="MAJOR_METROPOLITAN_O"]').val();
			var SEEKER_ZIP_CODE = jQuery('input[name="SEEKER_ZIP_CODE"]').val();

			jQuery('#update_job_seeker_pro').val('Please wait...');
			jQuery('#update_job_seeker_pro').attr('disabled','disabled');

			jQuery.ajax({
				type: 'POST',
	            url: '<?php echo admin_url("admin-ajax.php"); ?>',
	            data: {
	            	action: 'edit_basic_info',

					'SYSTEM_AND_PROCE': SYSTEM_AND_PROCE,
					'BEST_INDUSTRY': BEST_INDUSTRY,
					'CLEARANCE_LEVEL': CLEARANCE_LEVEL,
					'CLEARANCE_STATUS': CLEARANCE_STATUS,

					'HIGHEST_EDUCATION': HIGHEST_EDUCATION,
					'AREA_OF_STUDY': AREA_OF_STUDY,
					'SCHOOL_NAME': SCHOOL_NAME,
					'STUDY_YEAR': STUDY_YEAR,
					'STUDY_MAJOR': STUDY_MAJOR,
					'TYPE_OF_OPPORTUNITY': TYPE_OF_OPPORTUNITY,

					'JOB_SEARCH_RADIUS': JOB_SEARCH_RADIUS,
					'US_ELIGIBLE': US_ELIGIBLE,
					'SECURITY_CLEAR_YN': SECURITY_CLEAR_YN,
					'OVER_18_YN': OVER_18_YN,

					'POSSES_DRIVER_LICENS': POSSES_DRIVER_LICENS,
					'DRIVER_STATE': DRIVER_STATE,
					'RELIABLE_TRANSPORT': RELIABLE_TRANSPORT,
					'CURR_EMPLOYED_YN': CURR_EMPLOYED_YN,
					'NAME_OF_COMP': NAME_OF_COMP,
					'WORK_DATE_AVAILABLE': WORK_DATE_AVAILABLE,

					'INDUSTRY_YEARS': INDUSTRY_YEARS, 
					'CURR_CAREER_LVL': CURR_CAREER_LVL,
					'REF_SRC': REF_SRC,
					'RELOCATION_YN': RELOCATION_YN,

					'COMPENSATION_CURRENT': COMPENSATION_CURRENT,
					'COMPENSATION_ACC': COMPENSATION_ACC,
					'COMPENSATION_DESIRED': COMPENSATION_DESIRED,
					'COMP_DESIRED_ACC': COMP_DESIRED_ACC,
					'FIELD_LICENSE_STATUS': FIELD_LICENSE_STATUS,
					'FIELD_LICENSE_STATE': FIELD_LICENSE_STATE,

					'list_languages_mandarin': list_languages_mandarin,
					'list_languages_vietnamese': list_languages_vietnamese,
					'list_languages_english': list_languages_english,
					'list_languages_javanese': list_languages_javanese,
					'list_languages_spanish': list_languages_spanish,
					'list_languages_tamil': list_languages_tamil,
					'list_languages_hindi': list_languages_hindi,
					'list_languages_Korean': list_languages_Korean,
					'list_languages_russian': list_languages_russian,
					'list_languages_turkish': list_languages_turkish,
					'list_languages_arabic': list_languages_arabic,
					'list_languages_telugu': list_languages_telugu,
					'list_languages_portuguese': list_languages_portuguese,
					'list_languages_marathi': list_languages_marathi,
					'list_languages_bengali': list_languages_bengali,
					'list_languages_italian': list_languages_italian,
					'list_languages_french': list_languages_french,
					'list_languages_thai': list_languages_thai,
					'list_languages_malay': list_languages_malay,
					'list_languages_burmese': list_languages_burmese,
					'list_languages_german': list_languages_german,
					'list_languages_cantonese': list_languages_cantonese,
					'list_languages_japanese': list_languages_japanese,
					'list_languages_kannada': list_languages_kannada,
					'list_languages_farsi': list_languages_farsi,
					'list_languages_gujarati': list_languages_gujarati,
					'list_languages_urdu': list_languages_urdu,
					'list_languages_polish': list_languages_polish,
					'list_languages_punjabi': list_languages_punjabi,
					'list_languages_wu': list_languages_wu,
					'list_languages_other': list_languages_other,
					'list_languages_text': list_languages_text,
					'mandarin_rating': mandarin_rating,
					'vietnamese_rating': vietnamese_rating,
					'english_rating': english_rating,
					'javanese_rating': javanese_rating,
					'spanish_rating': spanish_rating,
					'tamil_rating': tamil_rating,
					'hindi_rating': hindi_rating,
					'Korean_rating': Korean_rating,
					'russian_rating': russian_rating,
					'turkish_rating': turkish_rating,
					'arabic_rating': arabic_rating,
					'telugu_rating': telugu_rating,
					'portuguese_rating': portuguese_rating,
					'marathi_rating': marathi_rating,
					'bengali_rating': bengali_rating,
					'italian_rating': italian_rating,
					'french_rating': french_rating,
					'thai_rating': thai_rating,
					'malay_rating': malay_rating,
					'burmese_rating': burmese_rating,
					'german_rating': german_rating,
					'cantonese_rating': cantonese_rating,
					'japanese_rating': japanese_rating,
					'kannada_rating': kannada_rating,
					'farsi_rating': farsi_rating,
					'gujarati_rating': gujarati_rating,
					'urdu_rating': urdu_rating,
					'polish_rating': polish_rating,
					'punjabi_rating': punjabi_rating,
					'wu_rating': wu_rating,
					'other_rating': other_rating,

					'LANGUAGES_WRITTEN': LANGUAGES_WRITTEN,
					'LANGUAGES_WRITTEN_OT': LANGUAGES_WRITTEN_OT,

					'CUR_WORK_SITUATION': CUR_WORK_SITUATION,

					'US_ARMED_FORCES': US_ARMED_FORCES,
					'US_ARMED_FORCES_OPTION': US_ARMED_FORCES_OPTION,
					'LOCAL_LAW_FORCE_YN': LOCAL_LAW_FORCE_YN,
					'FEDERAL_NVESTIGATIV': FEDERAL_NVESTIGATIV,
					'US_LAW_ENFORCE_STATU': US_LAW_ENFORCE_STATU,
					'US_LAW_ENFORCE_OTHER': US_LAW_ENFORCE_OTHER,

					'MAJOR_METROPOLITAN': MAJOR_METROPOLITAN,
					'MAJOR_METROPOLITAN_O': MAJOR_METROPOLITAN_O,
					'SEEKER_ZIP_CODE': SEEKER_ZIP_CODE,
	            },
	            success: function(r){
	            	builderUnsavedChanges = false;
	            	jQuery('#update_job_seeker_pro').val('Update');
					jQuery('#update_job_seeker_pro').removeAttr('disabled');
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

<?php get_footer('preferences'); ?>

<?php
$aOs = get_cimyFieldValue($UserID, 'AREA_OF_STUDY');
$scN = get_cimyFieldValue($UserID, 'SCHOOL_NAME');
$sY = get_cimyFieldValue($UserID, 'STUDY_YEAR');
?>
<div class="modal fade" id="accociatesdegreeModal" tabindex="-1" role="dialog" aria-labelledby="accociatesdegreeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="accociatesdegree">
			<form class="form-horizontal" method="post">
			  <div class="form-group">
			    <label for="AREA_OF_STUDY" class="col-sm-4 control-label">Area of study:</label>
			    <div class="col-sm-8">
			      <input type="text" name="AREA_OF_STUDY" class="form-control" id="" value="<?php echo $aOs; ?>" >
			    </div>
			  </div>
              <div class="form-group">
			    <label for="SCHOOL_NAME" class="col-sm-4 control-label">School Name:</label>
			    <div class="col-sm-8">
			      <input type="text" name="SCHOOL_NAME" class="form-control" id="" value="<?php echo $scN; ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="STUDY_YEAR" class="col-sm-4 control-label">Year of Graduation:</label>
			    <div class="col-sm-8">
			      <input type="text" name="STUDY_YEAR" class="form-control" id="" value="<?php echo $sY; ?>">
			    </div>
			  </div>
			   
			</form> 

			<p><strong>Major :</strong></p> 
			<div class="indent study_major_option_msg">
				<ul class="radio-group radio-group-1-2 study_major_option">
					<?php
					$sM = get_cimyFieldValue($UserID, 'STUDY_MAJOR');
					$smArr = array('Criminal Justice','History','Criminology','Law Enforcement','Business','Forensics','Communication','Journalism','Economics','Chemistry','International Studies','Computer Science','Political Science','Mathematics','Sociology','Physics');
					foreach ($smArr as $value) { ?>
						<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" <?php if($sM == $value){ echo 'checked="checked"'; } ?> value="<?php echo $value; ?>" >  <span><?php echo $value; ?></span></label></div></li>
					<?php } ?>
				</ul>
			</div>

			<div class="clearfix"></div>

		</div>
      </div>
      <div class="modal-footer text-center">
      <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary edu_level_save" data-dismiss="modal" >Save and close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="Licenceholder" tabindex="-1" role="dialog" aria-labelledby="LicenceholderModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close license_holder_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body vscroll">

		<div class="indent">
			<div class="form-group license_holder">
				<p><strong>From which State(s) are your currently a license holder?</strong></p>
				<div class="indent">
					<ul class="radio-group radio-group-1-3">
						<?php
						$fLstate = explode(',', get_cimyFieldValue($UserID, 'FIELD_LICENSE_STATE') );
						$fLstateArr = array('Alaska','Alabama','Arkansas','Arizona','California','Colorado','Connecticut','District of Columbia','Delaware','Florida','Georgia','Hawaii','Iowa','Idaho','Illinois','Indiana','Kansas','Kentucky','Louisiana','Massachusetts','Maryland','Maine','Michigan','Minnesota','Missouri','Mississippi','Montana','North Carolina','North Dakota','Nebraska','New Hampshire','New Jersey','New Mexico','Nevada','New York','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Virginia','Vermont','Washington','Wisconsin','West Virginia','Wyoming');
						foreach ($fLstateArr as $value) { ?>
							<li>
							<div class="checkbox"><label><input name="FIELD_LICENSE_STATE[]" type="checkbox" <?php if( in_array($value, $fLstate) ){ echo "checked"; } ?> value="<?php echo $value; ?>" ><span><?php echo $value; ?></span></label></div>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
	  	</div>
  	  </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary license_holder_save" data-dismiss="modal">Save and close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="Investigative" tabindex="-1" role="dialog" aria-labelledby="InvestigativeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close law_status_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body vscroll">

		<div class="indent">
			<div class="law_enforcement_list">
				<?php
				$uSle = get_cimyFieldValue($UserID, 'US_LAW_ENFORCE_STATU');
				$uSle_o = get_cimyFieldValue($UserID, 'US_LAW_ENFORCE_OTHER');
				$uSleArr = array('Central Intelligence Agency (CIA)','Department of Agriculture (USDA)','United States Forest Service Office of Law Enforcement and Investigations','Office of Inspector General (USDA-OIG)','Department of Commerce (USDOC)','National Oceanic and Atmospheric Administration (NOAA)','Office of Export Enforcement (OEE)','Department of Health and Human Services (HHS)','Food and Drug Administration (FDA)','FDA Office of Criminal Investigations (OCI)','Office of Inspector General (HHS-OIG)','Department of Education (ED)','Office of Inspector General (ED-OIG)','Department of Homeland Security (DHS)','Coast Guard Investigative Service (CGIS)','Citizenship and Immigration Services (CIS)','Immigration and Customs Enforcement / Homeland Security Investigations (ICE/HSI)','Customs and Border Protection (CBP)','United States Secret Service (USSS)','Transportation Security Administration (TSA)','Federal Protective Service (FPS)','Office of Inspector General (DHS-OIG)','Department of the Interior (DOI)','Bureau of Land Management (BLM)','United States Fish and Wildlife Service (USFWS)','United States Park Police (USPP)','National Park Service (NPS)','Bureau of Indian Affairs Police (BIA)','Office of Inspector General (DOI-OIG)','United States Department of Labor (DOL-OIG) – ','Office of Labor Racketeering and Fraud Investigations','Department of Defense (DOD)','Defense Intelligence Agency (DIA)','National Security Agency (NSA)','Defense Security Service (DSS) – non-law enforcement','United States Army Criminal Investigation Command (USACIDC)','United States Army Counterintelligence (Army CI)','Pentagon Force Protection Agency (PFPA)','Naval Criminal Investigative Service (NCIS)','United States Marine Corps Criminal Investigation Division (Marine CID Agent)','Air Force Office of Special Investigations (AFOSI)','Office of Inspector General (DOD-OIG)','Defense Criminal Investigative Service (DCIS)','United States Office of Personnel Management','Federal Investigative Services Division (OPM-FISD)','Office of Inspector General (OPM-OIG)','Department of Justice (DOJ)','Bureau of Alcohol/ Tobacco/ Firearms and Explosives (ATF)','Drug Enforcement Administration (DEA)','Federal Bureau of Investigation (FBI)','United States Marshals Service (USMS)','Office of Inspector General (DOJ-OIG)','Federal Bureau of Prisons (BOP)','Department of State','U.S. Diplomatic Security Service (DSS) (FS-2501)','Office of Inspector General (DOS-OIG)','Department of Transportation (DOT)','Office of Inspector General for the Department of Transportation (DOT-OIG)','Federal Motor Carrier Safety Administration (FMCSA)','Federal Aviation Administration (FAA)','Department of the Treasury','IRS Criminal Investigation Division (IRS-CID)','Alcohol and Tobacco Tax and Trade Bureau (TTB)','United States Mint Police','Bureau of Engraving and Printing Police','Federal Reserve Board Police','Treasury Inspector General for Tax Administration (TIGTA)','Postal Service (USPS)','United States Postal Inspection Service (USPIS – not an Inspector General)','Office of Inspector General (USPS-OIG)','United States Environmental Protection Agency (EPA)','Criminal Investigation Division','Office of Inspector General (EPA-OIG)','OTHER');
				foreach ($uSleArr as $value) { ?>
					<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="<?php echo $value; ?>" <?php if( $uSle == $value ){ echo "checked"; } ?> /> <span><?php echo $value; ?></span> </label></div>
				<?php } ?>
				<span class="form-inline"> &nbsp; <input type="text" class="form-control" name="US_LAW_ENFORCE_STATU_OTHER" value="<?php echo $uSle_o; ?>" <?php if($uSle != 'OTHER'){ echo 'style="display:none;"'; } ?> /></span>
			</div>
	  	</div>
  	  </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary us_law_status_save" data-dismiss="modal">Save and close</button>
      </div>
    </div>
  </div>
</div>
<style>
input[name="COMPENSATION_ACC"][value="Do Not Show Employer"]:checked+span,
input[name="COMP_DESIRED_ACC"][value="Do Not Show Employer"]:checked+span
{background:url(/assets/themes/eye-recruit-2015/img/lock_sm.png) no-repeat top right; background-size: contain; padding-right:32px;}
</style>
<?php 
///CHECK TRIGGER for page nav
if($_GET['pg']){
?>
<script>
jQuery(document).ready(function(){
	jQuery(".paginationDiv a[data-step=<?php echo $_GET['pg']; ?>]").trigger('click');
});
</script>
<?php
}//end trigger check
?>

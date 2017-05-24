<?php
/**
 * Template Name: Navigation Background Management page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>
	<?php 
	///FUNCTIONS
	//getNotificationMessage($cand_name,$userdata->user_email)
function getNotificationMessage($cand_name,$cand_email){
ob_start();
?>
<div class="no-jobs-found restrict_notice">
										<h4 class="no_job_listings_found"><?php echo $cand_name; ?> has set the Security settings on this section of this section to Restricted.</h4>
										<div class="media">
										  <div class="media-left">
										    <img class="media-object" src="<?php echo get_stylesheet_directory_uri(); ?>/img/big_minus.jpg" alt="0">
										  </div>
										  <div class="media-body">
										    <p>What does that mean? To view this material, you will need to click the link below and a message will be sent notifying the candidate that you would like access to view this material. Once <?php echo $cand_name; ?> approves the material to be viewed, you will recieve a message via mail and within your profile that your access has been granted.</p>
										  </div>
										</div>
										<div class="text-center">
											<a href="mailto:<?php echo $cand_email; ?>?subject=EyeRecruit Background Documents" class="btn btn-sm btn-success">Notify</a>
										</div>
									</div>
<?php
return ob_get_clean();
//end fucntion
}
	///END FUNCTIONS
	$url = site_url();
	if ( !is_user_logged_in() ) {
		echo wp_redirect($url);
	}

	$userID = get_current_user_id();
	$current_user = wp_get_current_user();
	// in_array( 'administrator', $current_user->roles)
	$view = '';
	if(isset($_REQUEST['recruitID'])){

		$verb = 'has';
	}else{
		$verb ='have';
	}
	if ( isset($_REQUEST['recruitID']) ) {
		$userID = $_REQUEST['recruitID'];
		$userdata = get_userdata($userID);
		$allowView = '';
		$breadText = '';
		$cand_name = $userdata->first_name.' '.$userdata->last_name;

		$accessEmp = get_cimyFieldValue($userID, 'PNA_BACK_VERI_REPORT');
		$accessRec = get_cimyFieldValue($userID, 'PNAR_BACK_VERI_REP');
		if ( in_array( 'candidate', $current_user->roles) ){
			if ( $accessEmp == 'Yes' ) {
				$view = 'allow';
			}
			$breadcrumbUrl = '/job-seekers/seeker-profile-view/';
			//if candidate viewing his/her profile as an employee
			//echo '<h3>candidate bview as employee</h3> from '.$_SERVER['HTTP_REFERER'];
			if($_SERVER['HTTP_REFERER'] == 'http://demo.eyerecruit.com/job-seekers/seeker-profile-view/'){
				
				$seekerPreviewAsEmployer =true;
				$view = 'allow';
			}
		}
		elseif ( in_array( 'administrator', $current_user->roles) ) {
			//if ( $accessRec == 'Yes' ) {
			//	$view = 'allow';
			//}
			$view = 'allow';
			$breadcrumbUrl = '/employers/redacted-recruiter-quick-view/?recruitID='.$userID;
		}
		elseif( in_array('employer', $current_user->roles) ){
			if ( $accessEmp == 'Yes' ) {
				$view = 'allow';
			}
			$breadcrumbUrl = '/employers/redacted-employer-quick-view/?recruitID='.$userID;
		}
		else{
			$breadcrumbUrl = '';
		}

	}
	elseif ( in_array( 'candidate', $current_user->roles) || in_array( 'administrator', $current_user->roles) ){
		$userID  = get_current_user_id();
		$allowView = 'allow';
		$breadcrumbUrl = '/job-seekers/dashboard/';
		$breadText = 'Management';
		$cand_name = 'You';
		$view = 'allow';
	}
	else{
		echo wp_redirect($url);
	}
	

	global $wpdb;
	$tableName = $wpdb->prefix.'jobseeker_resume';
	if ( in_array('candidate', $current_user->roles) || in_array('administrator', $current_user->roles) ) {
		$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'background_doc' ORDER BY id desc");
	}
	else{
		$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'background_doc' AND access IN ('Currently Viewable', 'Permission Only') ORDER BY id desc");
	}

	if ( (count($select) == 0) && (in_array( 'candidate', $current_user->roles)) ) { 
		$showinst = 'style="display:none;"';
	}
	elseif ( isset($_REQUEST['recruitID']) ) {
		$showinst = 'style="display:none;"';
	}
	else{
		$showinst = '';
	} 
	$current_user = wp_get_current_user();
	$roles = $current_user->roles;
	$role = array_shift( $roles );
	?>
	
	<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="page-header">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header>

		<div id="primary" class="content-area">
			<div id="content" class="container" role="main">
				<div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>

				<?php if ($seekerPreviewAsEmployer == true){
										?>
										<div class="alert-warning padded marginTop-2x"><strong>NOTE:</strong> You are viewing the employee preview as a seeker</div>
										<?php
									}?>

				<section class="navigations back_verification">
					<div class="section_title">
						<h3>Background <?php echo $breadText; ?></h3>
						<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
					</div>
					<div class="row indent">
						<div class="col-md-9">
							<ol class="breadcrumb">
							  <li><a href="<?php echo site_url().$breadcrumbUrl; ?>">Home</a></li>
							  <li class="active">Background <?php echo $breadText; ?></li>
							</ol>
							<?php if($view == 'allow'){ ?>
								<div class="search_bar">
									<p><?php echo $cand_name." ".$verb; ?> stored <span id="noOfRes"><?php echo count($select); ?></span> Background Management Item(s)</p>
									
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="row indent">

						<div class="col-md-9">
							<?php if($view == 'allow'){ ?>
								<?php if( count($select) >= 1 ){ ?>
									<div class="navigations_list">
										<div class="row">
											<?php foreach ($select as $value) { ?>
												<div class="col-md-6 col-sm-6 col-xs-6 devicefull resumeno" id="resumeID<?php echo $value->id; ?>">
													<article class="navs_listitem">
														<div class="nav_list_header">

															<h4><?php echo $value->other; ?></h4>
															<p>
																<strong>Upload Date</strong> : 
																<?php 
																echo date('m/d/Y', $value->datetime);
																?>
															</p>
														</div>
														<div class="nav_list_cont">
															<div class="nav_list_middle">
																<?php
															   	$strPDF = $value->filefullpath;
																$extension = pathinfo($strPDF, PATHINFO_EXTENSION);
																$target = '';
																
																if ( in_array('candidate', $current_user->roles) || in_array('administrator', $current_user->roles) ) {
																	$previewclass  = 'fancybox';
																	$fileurl = $strPDF;
																	if (  strtolower( $extension ) == 'pdf' ) {
																		$printfileurl = $strPDF;
																		$printwclass  = '';
																	}
																	else{
																		$printfileurl = 'javascript:void(0);';
																		$printwclass  = 'printimg';
																	}
																}
																else{
																	if( $value->access == 'Currently Viewable' ){ 
																		//$previewclass  = 'fancybox';
																		$previewclass  = '';
																		$fileurl = $strPDF;
																		if (  strtolower( $extension ) == 'pdf' ) {
																			$printfileurl = $strPDF;
																			$printwclass  = '';
																		}
																		else{
																			$printfileurl = 'javascript:void(0);';
																			$printwclass  = 'printimg';
																		}
																	}
																	else{
																		$previewclas = '';
																		$fileurl = 'javascript:void(0);';
																		$printfileurl = 'javascript:void(0);';
																		$printwclass = '';
																	}
																}
																?>

																<ul class="text-right">
																	<!-- <li><a href="<?php echo $printfileurl; ?>" class="<?php echo $printwclass; ?>" printimg="<?php echo $fileurl; ?>">Print</a></li> --> <!-- onClick="printPage('<?php //echo $strPDF; ?>');" get_site_url().'/download.php?filename='. $fileurl; -->
																	<?php
																	$viewPreviewLink = false;
																	if( $value->access == 'Currently Viewable' || ( in_array( 'candidate', $current_user->roles) && $_REQUEST['recruitID'] && $value->access == 'Currently Viewable'  ) || ( in_array( 'candidate', $current_user->roles) && !$_REQUEST['recruitID'] ) || ( in_array( 'administrator', $current_user->roles) )  ){
																		?>
																		<li><a href="<?php echo $fileurl; ?>" <?php // echo $target; ?>  target="er_seeker_doc" >Preview</a></li>
																		<?php
																		//end conditional for preview link
																	} 
																	?>
																	
																	<?php if($allowView == 'allow'){ ?>
																		<li><a href="javascript:void(0);" class="forward_doc" docId="<?php echo $value->id; ?>">Forward</a></li>
																		<li><a class="removeResume" docId="<?php echo $value->id; ?>" href="javascript:void(0);">Delete</a></li>
																	<?php } ?>
																</ul>
																
																<div class="thumbnail">
				      												<img src="<?php echo get_stylesheet_directory_uri(); ?>/boxicon/1---Background-Verification---Purchased-[Converted].jpg" class="img-responsive" alt="Resume">
																</div>
																<?php if($allowView == 'allow'){ ?>
																	<div class="text-center">
																		<div class="radio">
																		  <label data-toggle="tooltip" data-placement="top" title="When your profile is viewed, this is the one you want to show without permission">
																		    <input type="radio" class="changeAccess" docId="<?php echo $value->id; ?>" name="manage_resume<?php echo $value->id; ?>" id="optionsRadios<?php echo $value->id; ?>" <?php if( $value->access == 'Currently Viewable' ){ echo "checked"; } ?> value="Currently Viewable">
																		    <span>Currently Viewable</span>
																		  </label>
																		</div>
																		<div class="radio">
																		  <label data-toggle="tooltip" data-placement="top" title="When your profile is viewed, this is the one you want show only with permission.">
																		    <input type="radio" class="changeAccess" docId="<?php echo $value->id; ?>" name="manage_resume<?php echo $value->id; ?>" id="PermissionOnly<?php echo $value->id; ?>" <?php if( $value->access == 'Permission Only' ){ echo "checked"; } ?> value="Permission Only">
																		    <span>Permission Only</span>
																		  </label>
																		</div>
																		<div class="radio">
																		  <label data-toggle="tooltip" data-placement="top" title="When your profile is viewed, it will indicate that you have or do not have, but will provide no further information.">
																		    <input type="radio" class="changeAccess" docId="<?php echo $value->id; ?>" name="manage_resume<?php echo $value->id; ?>" id="RestrictAccess<?php echo $value->id; ?>" <?php if( $value->access == 'Restrict Access' ){ echo "checked"; } ?> value="Restrict Access">
																		    <span>Restrict Access</span>
																		  </label>
																		</div>
																	</div>
																<?php } ?>
															</div>
														</div> 

													</article>

												</div>
												
												

											<?php } ?>
										</div>
										
									</div>
								<?php } else { 
									if ( !isset($_REQUEST['recruitID'])  && in_array( 'candidate', $current_user->roles) ){
										?>
										<div class="well">
											<p><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/green_checklg.jpg"> <span>You haven’t saved any Background Verifications.</span></p>
											<p>A potential Employer may legally look into your background during the hiring process and require a background check to be conducted <strong>as a part of the hiring process.</strong> Over the course of a career you will have provided access to Local, State and Federal Criminal & Civil histories, your credit report and a multitude of other background related inquiries to dozens, if not hunderds of times. Why not manage this process and give approval to people who should actually be seeing it? </p>
											<p class="indent"><strong>You don’t need to have a Background Search done by one of the potential vendors we suggest. Even though you can, you don’t even need to post the results of a third party Background Search that you conduct & requests yourself on the site.</strong></p>
											<p>In truth, you don't need to provide <em><u>anything</u></em> relating to your Background to a potential Employer to get the benefits of using the Eyerecruit.com services. Everything on Eyerecruit.com is self disclosed and designed to allow you to better manage your own carrier. But why not handle your Personal Background verifications like your Credit Report or FICO Score? </p>
											<p>Besides being able to provide permission on a case-by-case basis directly from the platfrom, you will be able to know immediately about potentially harmful errors contained within your background search that may have a negative impact on your ability to obtain gainful employment. With this knowledge you can get the issue addressed before it has a negative impact on your career and before a Decision Maker at an Employer you really would love to work for has less then the full story. </p>
											<p>Decide for yourself if you would like to order one of the Background Searches provided by the third parties we have provided for you or one you find yourself. Before you do, you can <a href="https://prod6.consumer.ftc.gov/articles/0157-background-checks" target="_blank">read here</a> what <strong>The United States Federal Trade Comission (FTC)</strong>  has posted on Employment Background Checks and thier suggestions on "fixing mistakes before an employer see it.</p>
											<div class="text-center"> <!-- https://www.consumer.ftc.gov/articles/0157-employment-background-checks/ -->
												<a href="javascript:void(0);" id="uploadBackDoc" class="btn btn-primary">Upload a Document</a>
												<a href="<?php echo site_url().'/order-background/'; ?>" class="btn btn-default">Request Background Check</a>
											</div>
											<p class="text-center"><a href="<?php  echo site_url(); ?>/job-seekers/dashboard/">No thanks, return to Dashboard.</a></p>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } else{ ?>
								

									echo getNotificationMessage($cand_name,$userdata->user_email);
									<!-- no-jobs-found -->
							<?php } ?>

							<?php 
													//DEV NOTES: RESTRICTED
												if( ($value->access != 'Currently Viewable' && (in_array( 'employer', $current_user->roles) ) ) ||  (in_array( 'candidate', $current_user->roles)  && $seekerPreviewAsEmployer && $value->access != 'Currently Viewable' ) ) 
													echo getNotificationMessage($cand_name,$userdata->user_email);
												?>
						</div>

						<div class="col-md-3">
							<?php 
							$pageID 	= get_the_ID(); 
							$uar 		= get_post_meta($pageID, 'upload_file_content', true); 
							$rabn 		= get_post_meta($pageID, 'run_a_background_now_content', true); 
							$mt 		= get_post_meta($pageID, 'member_tips', true); 
							?>

							<?php  if ( (is_user_logged_in()) &&  ($role == 'employer') ) {  ?>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> THE PROCESS</h5>
									<p>EyeRecruit offers an easy way for Job Seekers to post a current Background Verifications that they have in their own files or order a Background from a third party provider, so interested Hiring Managers, HR personnel and Recruiters can view the documents when interested.  If set to  <strong>Restricted View</strong>, simply select the button and the Job Seeker can authorize viewing.</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>THE DISCLAIME</h5>
									<p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own employment related documents. EyeRecruit, Inc. does not confirm the materials provided here or provide the service.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a href="<?php echo site_url();  ?>/terms-and-conditions/" target="_blank">Terms & Conditions</a> policies. </p>
								</div>

							<?php } elseif ((is_user_logged_in()) &&  ($role == 'candidate')){ ?>

								<?php   if ( isset($_REQUEST['recruitID']) ) {  ?>

										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5> THE PROCESS</h5>
											<p>EyeRecruit offers an easy way for Job Seekers to post a current Background Verifications that they have in their own files or order a Background from a third party provider, so interested Hiring Managers, HR personnel and Recruiters can view the documents when interested.  If set to  <strong>Restricted View</strong>, simply select the button and the Job Seeker can authorize viewing.</p>
										</div>
										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5>THE DISCLAIME</h5>
											<p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own employment related documents. EyeRecruit, Inc. does not confirm the materials provided here or provide the service.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a href="<?php echo site_url();  ?>/terms-and-conditions/" target="_blank">Terms & Conditions</a> policies. </p>
										</div>

								<?php  }else{
											if( count($select) >= 1 ){ 
								  ?>

										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5>RUN A BACKGROUND NOW</h5>
											<!-- <p>By providing your resume, you are essentially stating that what you are providing is a “true and accurate description” of your personal experience, work history, and education. Employers know that is not always the case and Job Seekers know that it’s not always the best candidate that gets the job. Sadly even in the Security, Investigative profession the information provided by candidates can range from an embellishment to outright lies.  Providing anything a Decision Maker might need to make a more education decision is always more beneficial. Think “full disclosure.”</p> -->
											<p>EyeRecruit, Inc. <strong>does not</strong> conduct background searches for our members. By selecting <strong>ORDER</strong> you will have the choice of using a third party vendor through the platform and you will be able to choose the package you would like to order.  If you order a Background Report, you will have complete control on how your report is managed through permission-based viewing.<br><br>
											</p>
												<a href="<?php echo site_url();?>/order-background/" class="btn btn-primary btn-sm">Order Now</a>
										</div>
										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5>UPLOAD YOUR BACKGROUND</h5>
											<p>EyeRecruit, Inc. <strong>does not</strong> prohibit members from ordering or uploading a Background Verification from <strong>any</strong> third party source.  If you already have a background and would like to provide it for viewing on the Eyerecruit.com platform, simply select the button provided, and choose the item you wish to upload.  You will have complete control on how your uploaded report is managed though permission-based viewing.<br><br>
											</p>
											<a href="<?php echo site_url('/job-seekers/upload-background-doc/'); ?>" class="btn btn-primary btn-sm">Upload</a>
										</div>
										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5> MEMBER TIP</h5>
											<p>A Background <strong>IS NOT MANDATORY</strong> to use the services offered thought EyeRecruit.com. Providing a potential Decision Maker a current background verification has been shown to increase trustworthiness during the initial hiring stages and decrease the time to hire as less time consuming pre-hire tasks need to be complete between candidate selection and actually starting work. Think about what is says to a potential employer if you supply this data. </p>
										</div>
										<?php  } else{ ?>

										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5>INSIDE SCOOP</h5>
											<!-- <p>By providing your resume, you are essentially stating that what you are providing is a “true and accurate description” of your personal experience, work history, and education. Employers know that is not always the case and Job Seekers know that it’s not always the best candidate that gets the job. Sadly even in the Security, Investigative profession the information provided by candidates can range from an embellishment to outright lies.  Providing anything a Decision Maker might need to make a more education decision is always more beneficial. Think “full disclosure.”</p> -->
											<p>By providing your resume, you are essentially stating that what you are providing is a “true and accurate description” of your personal experience, work history, and education. Employers know that is not always the case and Job Seekers know that it’s not always the best candidate that gets the job. Sadly even in the Security, Investigative profession the information provided by candidates can range from an embellishment to outright lies.  Providing anything a Decision Maker might need to make a more education decision is always more beneficial. Think “full disclosure.”
											</p>
										</div>
										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5>PROFESSIONAL TIP</h5>
											<p>Proactive, diligent, comprehensive and organized. That’s what it takes. No one is going to manage or care about your career more than you are. It is your professional responsibility to know what might be affecting your career objectives, good or bad, and make every effort to address those items until there is nothing standing between you and the career of your dreams. WHY LEAVE IT TO CHANCE?
											</p>
										</div>
										<div class="special_box special_logo navi_thumbnail">
											<div class="thumbnail">
												<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
											</div>
											<h5> MEMBER TIP</h5>
											<p>A Background <strong>IS NOT MANDATORY</strong> to use the services offered thought EyeRecruit.com.  Providing a potential Decision Maker a current background verification has been shown to increase trustworthiness during the initial hiring stages and decrease the time to hire as less time consuming pre-hire tasks need to be completed between candidate selection and actually starting work. Think about what is says to a potential employer when you supply this up to date data without reservation.</p>
										</div>
								<?php 
									}
								} ?>


							<?php  }else { ?>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> INSIDE SCOOP</h5>
									<p>By providing your resume, you are essentially stating that what you are providing is a “true and accurate description” of your personal experience, work history, and education. Employers know that is not always the case and Job Seekers know that it’s not always the best candidate that gets the job. Sadly even in the Security, Investigative profession the information provided by candidates can range from an embellishment to outright lies.  Providing anything a Decision Maker might need to make a more education decision is always more beneficial. Think “full disclosure.”</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> PROFESSIONAL TIP</h5>
									<p>Proactive, diligent, comprehensive and organized. That’s what it takes. No one is going to manage or care about your career more than you are. It is your professional responsibility to know what might be affecting your career objectives, good or bad, and make every effort to address those items until there is nothing standing between you and the career of your dreams. WHY LEAVE IT TO CHANCE?</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> MEMBER TIP</h5>
									<p>A Background <strong>IS NOT MANDATORY</strong> to use the services offered thought EyeRecruit.com.  Providing a potential Decision Maker a current background verification has been shown to increase trustworthiness during the initial hiring stages and decrease the time to hire as less time consuming pre-hire tasks need to be completed between candidate selection and actually starting work. Think about what is says to a potential employer when you supply this up to date data without reservation.</p>
								</div>

							<?php } ?>

						</div>
					</div>
				</section>
			</div><!-- #content -->
			
			<?//php do_action( 'jobify_loop_after' ); ?>
		</div><!-- #primary -->

	<?php endwhile; ?>
<?php get_footer('preferences'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>

<?php printImage(); ?>
<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('.navigations').on('click', '.printimg', function () {
			var imgurl = jQuery(this).attr('printimg');
		    printImage(imgurl);
		    return true;
		});
	});
</script>

<script type="text/javascript">
	jQuery(document).ready( function() {
		
		jQuery('.removeResume').on('click', function() {
			var _this= jQuery(this);
			var docId = _this.attr('docId');
			var img = '<?php echo get_stylesheet_directory_uri()."/images/danger_icon.jpg"; ?>';
			swal({
			  imageUrl: img,
			  title: "warning",
			  text: "You are about to permanently DELETE this item.  Once you select continue his can not be undone. If you need this document in the future you will need to locate it and upload it again if you want touse it. May we suggest simply restricting access?",
			  showCancelButton: true,
			  confirmButtonClass: "btn-default btn-sm changetext",
			  confirmButtonText: "Continue Delete",
			  cancelButtonText: "Set to Restrict",
			  cancelButtonClass: "btn-primary btn-sm cancelbutton",
			  closeOnConfirm: false,
			  closeOnCancel: true,
			  customClass: 'daner_sweet',
			  // showLoaderOnConfirm: true
			},
			function(isConfirm) {
			  if (isConfirm) {
			  		jQuery('.changetext').html('Please Wait...');
					jQuery.ajax({
						'type': 'POST',
						'url': '<?php echo admin_url("/admin-ajax.php"); ?>',
						data:{
							'action': 'removeJobseekerResume', //Action in inc/edit_basic_info.php
							'docId': docId
						},
						success: function(r){
							if ( r == 'error' ) {
								jQuery('.sweet-alert').removeClass('daner_sweet');
								jQuery('.changetext').html('Continue Delete');
								swal({
									title: "Something Wrong! Please try again.", 
									type: "warning",
									confirmButtonClass: "btn-primary btn-sm",
								});
							}
							else{
								jQuery('.sweet-alert').removeClass('daner_sweet');
								jQuery('.changetext').html('Continue Delete');
								jQuery('#resumeID'+docId).remove();
								jQuery('#noOfRes').html( jQuery('.resumeno').length );
								swal({
									title: "Deleted!", 
									type: "success",
									confirmButtonClass: "btn-primary btn-sm",
								});
							}
						}
					});
				} 
				else {
			  	   jQuery('.sweet-alert').removeClass('daner_sweet');
			  	   if ( !jQuery('#RestrictAccess'+docId).is(':checked') ) {
			  	   		changeAccess('#RestrictAccess'+docId);
			  	   		jQuery('#RestrictAccess'+docId).prop('checked', true);
			  	   }
				}
			});
		});

		function changeAccess(thisVal){
			var _this= jQuery(thisVal);
			var docId = _this.attr('docId');
			var thisVal = _this.val();
			jQuery('#loaders').show();
			jQuery.ajax({
				'type': 'POST',
				'url': '<?php echo admin_url("/admin-ajax.php"); ?>',
				data:{
					'action': 'accessJobseekerResume', //Action in inc/edit_basic_info.php
					'docId': docId,
					'thisVal': thisVal,
				},
				success: function(r){
					jQuery('#loaders').hide();
					if ( r == 'success' ) {
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>Successfully updated to "+thisVal+".</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
					else{
						swal({
							title: "Error", 
							html: true,
							text: "<span class='text-center'>Something Wrong! Please try again.</span>",
							type: "error",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				}
			})
		}

		jQuery('.changeAccess').on('change', function() {
			changeAccess(this);
		});
	});
</script>



<div class="modal fade" id="UploadRes" tabindex="-1" role="dialog" aria-labelledby="UploadResModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="modal-body vscroll">
			<button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			<h3>Upload your Background Doc</h3>
			<div class="upload-form  upload-form-modal">
				<form action="" method="post">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="row">
								<div class="col-xs-6 devicefull">
							        <div class="upload_btn">
								        <input type="file" name="files"  class="files-data form-control" id="fileupload" />
								        <input type="hidden" name="fileid" value="" id="fileid">
							        	<span class="upload_icons"></span>Your Computer
							        </div>
								</div>
								<div class="col-xs-6 devicefull">
							        <div class="upload_btn">
							        	<span class="upload_icons upload_dropbox"></span>Dropbox <sup>TM</sup>
							        </div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 devicefull">
							        <div class="upload_btn">
							        	<span class="upload_icons upload_googledrive"></span>Google Drive <sup>TM</sup>
							        </div>
								</div>
								<div class="col-xs-6 devicefull">
							        <div class="upload_btn">
							        	<span class="upload_icons upload_onedrive"></span>OneDrive <sup>TM</sup>
							        </div>
								</div>
							</div>
							<p class="text-center">
								<span id="uploadedFile" class="text-success"></span>
							</p>
						</div>
					</div>
					<p class="text-center">
						<?php echo SITE_VERBIAGE_PRIVACY_VALUE; ?> Your Background Doc information will be added to your profile.
					</p>
				    <div class="text-center form-group">
				        <button type="button" class="btn btn-primary btn-upload">Submit Background Doc</button>
				    </div>
				    <div class= "upload-response"></div>
				</form>
			</div>
  	    </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	jQuery(document).ready( function() {

		jQuery('#uploadBackDoc').on('click', function() {
			jQuery('#UploadRes').modal('show'); 
		});

		jQuery('#fileupload').on('change', function() {
	        var filename = jQuery(this).val();
	        jQuery('#uploadedFile').text(filename);
	    });

	    jQuery('.btn-upload').on('click', function(e){
	    	jQuery(this).attr('disabled', 'disabled');
	        e.preventDefault;
	        var fd = new FormData();
	        var files_data = jQuery('.upload-form .files-data'); 

	        if(files_data.val()=='') 
	        { 
	            jQuery('.upload-response').html('<label class="error">Please select a file.</label>');
	            jQuery(this).removeAttr('disabled');
	            return false; 
	        } 

	        jQuery.each(jQuery(files_data), function(i, obj) {
	            jQuery.each(obj.files,function(j,file){
	                fd.append('files[' + j + ']', file);
	            })
	        });

	        fd.append('action', 'cvf_upload_backgroundfiles');   //Action in inc/edit_basic_info.php
	        jQuery.ajax({
	            type: 'POST',
	            url: '<?php echo admin_url("admin-ajax.php"); ?>',
	            data: fd,
	            contentType: false,
	            processData: false,
	            success: function(response){
	            	jQuery('#fileid').val(response);

	            	if ( response == '<p class="success">Successfully added.</p>' ) {
	            		jQuery('#UploadRes').modal('hide');
	            		swal({
							title: 'Successfully added', 
							type: "success",
							confirmButtonClass: "btn-primary btn-sm"
						},
						function(isConfirm) {
		  					if (isConfirm) {
		  						var pageId = '<?php echo get_the_ID(); ?>';
		  						window.location.href = '<?php echo get_the_permalink('+pageId+'); ?>';
		  					}
		  				});
						jQuery('.upload-response').html('');
						jQuery('#uploadedFile').html('');
	            	}
	            	else{
						jQuery('#uploadedFile').html('');
	            		jQuery('.upload-response').html(response);
	            	}
	                
	                var fileInput = jQuery('#fileupload');
					fileInput.replaceWith(fileInput.val('').clone(true));
					jQuery('.btn-upload').removeAttr('disabled');
					
	                return false;
	            }
	        });
	    });
	});
</script>
<style>
.restrict_notice:before{
	content: " ";
	display: table;
	clear: both;
}
</style>

<?php echo forwardNavigationFiles('Background Management'); ?>
<!-- start debug -->
<div id="debug" class="row">
    <div class="col-md-6">
        <h3>CIMY</h3>
        <div style="height: 250px; overflow: auto;">
            <pre>
                <?php
//interfsued debug
                $user_id = get_current_user_id();
                $values = get_cimyFieldValue($user_id, false);
                print_r($values);
                ?>
            </pre>
        </div>
    </div>
    <div class="col-md-6">
        <h3>META</h3>
        <div style="height:250px; overflow: auto;">
            <pre>
                <?php
                $all_meta_for_user = get_user_meta( $user_id );
                print_r( $all_meta_for_user ); 
                ?>
            </pre>
        </div>
    </div>
</div>
<!-- END DEBUG -->
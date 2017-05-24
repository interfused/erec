<?php
/**
 * Template Name: Navigation Resume page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<style>
.resumeno{padding-bottom: 2em;}
.navs_listitem .nav_list_header {
    min-height: auto !important;
}
</style>

<?php
/*
* WILL RETURN THE LOWER CASE STRING BASED 
*/
function getItemViewableStatus($accessLevel,$rolesArr, $previewAsEmployer ){
	$accessLevel = strtolower($accessLevel);

	if($accessLevel == 'currently viewable' || in_array( 'administrator', $rolesArr) || ( in_array( 'candidate', $rolesArr) && $previewAsEmployer != true ) ){
		return 'currently viewable';
	}
	//permission only
	if($accessLevel == 'permission only'  ){
		
		if (in_array( 'candidate', $rolesArr) ){
			return $previewAsEmployer ? 'permission only' : 'currently viewable';
		}
		//candidate view as theirself
		return 'permission only';
	}
	//all restricted											//otherwise
	return 'restrict access';	
}
										//RESTRICT CHECK
?>
<?php 

if ( !is_user_logged_in() ) {
	$url = site_url();
	echo wp_redirect($url);
}


$userID = get_current_user_id();
$current_user = wp_get_current_user();
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

	if ( in_array( 'candidate', $current_user->roles) ){
		$breadcrumbUrl = '/job-seekers/seeker-profile-view/';
		//if candidate viewing his/her profile as an employee
		if($_SERVER['HTTP_REFERER'] == 'http://demo.eyerecruit.com/job-seekers/seeker-profile-view/'){

			$seekerPreviewAsEmployer = true;
			$view = 'allow';
		}

	}elseif ( in_array( 'administrator', $current_user->roles) ) {
		$breadcrumbUrl = '/employers/redacted-recruiter-quick-view/?recruitID='.$userID;
	}else{
		$breadcrumbUrl = '/employers/redacted-employer-quick-view/?recruitID='.$userID;
	}

}elseif ( in_array( 'candidate', $current_user->roles) ){
	
	$userID  = get_current_user_id();
	$allowView = 'allow';
	$breadcrumbUrl = '/job-seekers/dashboard/';
	$breadText = 'Management';
	$cand_name = 'You';

}else{
	$url = site_url();
	echo wp_redirect($url);
}

global $wpdb;
$tableName = $wpdb->prefix.'jobseeker_resume';
if ( in_array('candidate', $current_user->roles) || in_array('administrator', $current_user->roles) ) {
	$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'resume' ORDER BY id desc");
}
else{
	$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'resume' AND access IN ('Currently Viewable', 'Permission Only') ORDER BY id desc");
}

if ( (count($select) == 0) && (in_array( 'candidate', $current_user->roles)) ) { 

	if ( isset($_REQUEST['recruitID']) ) {
		$showinst = 'style="display:none;"';
	}
	else{
		?>
		<script type="text/javascript">
		jQuery(document).ready( function() {
			jQuery('#UploadRes').modal('show');
		});
		</script> <?php 
		$showinst = 'style="display:none;"';
	}
}
elseif ( isset($_REQUEST['recruitID']) ) {
	$showinst = 'style="display:none;"';
}
else{
	$showinst = '';
} 
$datas = wp_get_current_user();
$roless = $datas->roles;
$roles1 = array_shift( $roless );

?>
<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

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

			<section class="navigations">
				<div class="section_title">
					<h3>Resume/CV <?php echo $breadText; ?></h3>
					<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
				</div>
				<div class="row indent">
					<div class="col-md-9">
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url().$breadcrumbUrl; ?>">Home</a></li>
							<li class="active">Resume <?php echo $breadText; ?></li>
						</ol>
						<div class="search_bar">
							<p><?php echo $cand_name." ".$verb; ?> stored <span id="noOfRes"><?php echo count($select); ?></span> Resume(s)</p>
						</div>
					</div>
				</div>
				<div class="row indent">
					<div class="col-md-9">
						<?php if( count($select) >= 1 ){ ?>
						<div class="navigations_list">
							<div class="row seeker_resume" id="saveyourreume">
								<?php
								foreach ($select as $value) { 

									if( getItemViewableStatus($value->access, $current_user->roles, $seekerPreviewAsEmployer ) != 'restrict access' ){
										?>
										<div class="col-xs-6 devicefull resumeno" id="resumeID<?php echo $value->id; ?>">
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
															if( $value->access == 'Currently Viewable' ){ 
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
															<!-- <li><a href="<?php echo $printfileurl; ?>" class="<?php echo $printwclass; ?>" printimg="<?php echo $fileurl; ?>" >Print</a></li> --> <!-- onClick="printPage('<?php //echo $strPDF; ?>');" get_site_url().'/download.php?filename='. $fileurl; -->
															<?php
															if(getItemViewableStatus($value->access, $current_user->roles, $seekerPreviewAsEmployer ) == 'currently viewable' ){
																?>
																<li><a href="<?php echo $fileurl; ?>" <?php echo $target; ?> class="<?php // echo $previewclass; ?>" target="_er_doc" >Preview</a></li>

																<?php
															}
															?>
															<!-- <li><a href="javascript:void(0);" data-target="#openpreview" data-toggle="modal">Preview</a></li> -->
															<?php if($allowView == 'allow'){ ?>
															<li><a href="javascript:void(0);" class="forward_doc" docId="<?php echo $value->id; ?>">Forward</a></li>
															<li><a class="removeResume" docId="<?php echo $value->id; ?>" href="javascript:void(0);">Delete</a></li>
															<?php } ?>
														</ul>

														<?php 
														$reargs = array(
															'author__in' => array($userID),
															'post_type'   => 'resume',
															'post_status' => 'publish'
															);

														$the_query = new WP_Query( $reargs );

														$resumefileid = array();
														if ( $the_query->have_posts() ) {
															while ( $the_query->have_posts() ) {
																$the_query->the_post();
																$resumefileid[] = get_post_meta(get_the_ID(), 'resumefileid', true);
															}
															wp_reset_postdata();
														} else {
															$resumefileid = '';
														}

														if ( !empty($resumefileid) ) {
															$getfiekdid = $resumefileid;
														}
														else{
															$getfiekdid = array();
														}
														?>

														<div class="thumbnail">
															<?php if($allowView == 'allow'){ ?>
															<div class="radio">
																<label>
																	<input type="radio" class="setresume <?php echo ( in_array($value->id, $getfiekdid) )? 'alreadysaved': 'setjobapplyresume'; ?>" docId="<?php echo $value->id; ?>" name="setresume" id="setresume<?php echo $value->id; ?>" value="<?php echo $value->filefullpath; ?>"  <?php echo ( in_array($value->id, $getfiekdid) )? 'checked': ''; ?> >
																	<span>Use when applying</span>
																</label>
															</div>
															<?php } ?>
															<img src="<?php echo get_stylesheet_directory_uri(); ?>/boxicon/3--Candidate-Resume---purchased-[Converted].jpg" class="img-responsive" alt="Resume">
															
															<?php if($roles1 == 'administrator'){
																echo '<div class="text-center" style="padding-top:1em; padding-bottom:2em; font-size: .9em;">employer item access:<br>'.strtolower($value->access).'</div>';
															}
															?>
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
												

												<?php

												if( getItemViewableStatus($value->access, $current_user->roles, $seekerPreviewAsEmployer ) == 'permission only' ){
											//MESSAGE
													?>
													<div class="restrictedMessage"><p class="text-center">This item/document has been restricted</p><p class="text-center"><a href="mailto:<?php echo $userdata->user_email;?>?subject=Request Resume from EyeRecruit&body=I would like access to one of your resumes, particularly <?php echo $value->other;?>" class="btn btn-primary">Request Item</a></p> </div>
													<?php
											//END MESSAGE
												}
										//END RESTRICT CHECK

												?>

											</article>
										</div>
										<?php 
							}//end restricted check
						}//end loop ?>
					</div>
					
				</div>
				<?php  }else{ 


					if($roles1 == 'candidate' && !$_REQUEST['recruitID']){
						?>
						<div class="well no_document">
							<p><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/green_checklg.jpg"> <span>You haven’t saved your Resume or Curriculum Vital yet!</span></p>
							<p>No better time to get started with the process than right now!  Let’s take just a few seconds to upload what you have.  Even if you think it needs some updating or fine-tuning, having something is better than having nothing. </p>
							<p>This continues to be a very important step in the process.  Your resume is a traditional method for telling potential employers about you and your previous experience.  So to make sure when a Decision Maker is visiting your profile, they are able to find what they are looking for. Once we have them looking, you will have the opportunity to show them all the other reasons you will be a valuable asset to their organization! </p>
							<p>You have two options; you can choose to upload your current resume or if you do not have a resume or you would like us to assist you in updating you current resume, we have an option for that as well.</p>
							<p>What would you like to do now?</p>
							<p class="text-center"><a id="btn-uploadRes" class="btn btn-primary">Upload Resume</a></p>


						</div>

						<?php } 
					} ?>

				</div>

				<div class="col-md-3">
					<?php 
					$pageID = get_the_ID(); 
					$uar = get_post_meta($pageID, 'upload_file_content', true); 
					$uors = get_post_meta($pageID, 'use_our_services_content', true); 
					$mt = get_post_meta($pageID, 'member_tips', true); 
					?>

					<?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>

					<div class="special_box special_logo navi_thumbnail">
						<div class="thumbnail">
							<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
						</div>
						<h5> HOW WE SEE IT</h5>
						<p>EyeRecruit offers the easiest way to review Resumes digitally when a Seeker has responded to a Job Posting or has been located during a search. Having this information accessible, you can quickly select the best qualified candidates and move to the next hiring phase. The best part is, if you don’t see something you need, you can quickly message the candidate and ask that they send it. </p>
					</div>
					<div class="special_box special_logo navi_thumbnail">
						<div class="thumbnail">
							<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
						</div>
						<h5>BEYOND A RESUME</h5>
						<p>Its important to look beyond and extend your hiring efforts past the candidates resume.  EyeRecruit has designed many tools that will be of value to you during this process. A Resume remains a valuable tool in assessing a potential candidate, but what a Resume can’t tell you is vital to your success as well.  We believe in the bigger picture.  We want to consider all parts to the puzzle and look at a candidates goals, their personality type and their potential.  A Resume is a great launching point to initiate a conversation and start dialog.</p>
					</div>


					<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>



					<?php   if ( isset($_REQUEST['recruitID']) ) { ?>

					<div class="special_box special_logo navi_thumbnail">
						<div class="thumbnail">
							<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
						</div>
						<h5> HOW WE SEE IT</h5>
						<p>EyeRecruit offers the easiest way to review Resumes digitally when a Seeker has responded to a Job Posting or has been located during a search. Having this information accessible, you can quickly select the best qualified candidates and move to the next hiring phase. The best part is, if you don’t see something you need, you can quickly message the candidate and ask that they send it. </p>
					</div>
					<div class="special_box special_logo navi_thumbnail">
						<div class="thumbnail">
							<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
						</div>
						<h5>BEYOND A RESUME</h5>
						<p>Its important to look beyond and extend your hiring efforts past the candidates resume.  EyeRecruit has designed many tools that will be of value to you during this process. A Resume remains a valuable tool in assessing a potential candidate, but what a Resume can’t tell you is vital to your success as well.  We believe in the bigger picture.  We want to consider all parts to the puzzle and look at a candidates goals, their personality type and their potential.  A Resume is a great launching point to initiate a conversation and start dialog.</p>
					</div>

					<?php  }else{  ?>

					<div class="special_box navi_thumbnail">
						<h5>Upload a Resume</h5>
						<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
						<a id="btn-uploadRes2" href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
					</div>

					<div class="special_box navi_thumbnail">
						<h5>Use Our Resume services</h5>
						<p><?php echo (($uors))? $uors : 'Data not found'; ?></p>
						<a href="javascript:void(0);" class="btn btn-primary btn-sm">Begin</a>
					</div>
					
					<?php member_navigation_sidebar_tips_function('seeker_resume'); ?>

					<?php } ?>

					<?php  }else { ?>

					<div class="special_box navi_thumbnail">
						<h5>Upload a Resume</h5>
						<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
					</div>

					<div class="special_box navi_thumbnail">
						<h5>Use Our Resume services</h5>
						<p><?php echo (($uors))? $uors : 'Data not found'; ?></p>
					</div>
					
					<?php member_navigation_sidebar_tips_function('seeker_resume'); ?>

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
							'docId': docId,
							'removedoctype': 'resume',
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
							text: "<span class='text-center'>Successfully updated resume to "+thisVal+".</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
					else{
						swal({
							title: "Error", 
							html: true,
							text: "<span class='text-center'>Something Wrong! Please try again.</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				}
			});
}

jQuery('.changeAccess').on('change', function() {
	changeAccess(this);
});

/*...Save resume For Job Apply............*/
jQuery('#saveyourreume').on('change', '.setjobapplyresume', function() {
	var _this = jQuery(this);
	var resumeID = _this.attr('docId');
	var resumeUrl = _this.val();
	jQuery('#loaders').show();
	jQuery.ajax({
		type: 'POST',
		url: '<?php echo admin_url("admin-ajax.php"); ?>',
		dataType: 'json',
		data: {
			action: 'setjobapplyresumeAction',
			'resumeID': resumeID,
			'resumeUrl': resumeUrl, 
		},
		success: function(res){
			jQuery('#loaders').hide();
			if ( res.msg == 'success' ) {
				jQuery('.setresume').addClass('setjobapplyresume').removeClass('alreadysaved');
				_this.addClass('alreadysaved').removeClass('setjobapplyresume');
				swal({
					title: "Success", 
					html: true,
					text: "<span class='text-center'>Successfully updated resume to use when applying.</span>",
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

	});
});
});

function printPDF(pdfId) {
	var doc = document.getElementById(pdfId);
	doc.print();
}
</script>




<div class="modal fade" id="UploadRes" tabindex="-1" role="dialog" aria-labelledby="UploadResModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body vscroll">
				<button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
				<h3>Upload your Resume</h3>
				<div class="upload-form upload-form-modal">
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
							<?php echo SITE_VERBIAGE_PRIVACY_VALUE; ?> Your resume information will be added to your profile. It is recommended that you keep your resume less than 3 pages long.
						</p>
						<div class="text-center form-group">
							<button type="button" class="btn btn-primary btn-upload">Submit Resume</button>
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
	
	jQuery("#btn-uploadRes, #btn-uploadRes2").click(function(e){ 
		e.preventDefault(); 
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

	        fd.append('action', 'cvf_upload_resumefiles');   //Action in inc/edit_basic_info.php
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

<?php echo forwardNavigationFiles('Resume'); ?>
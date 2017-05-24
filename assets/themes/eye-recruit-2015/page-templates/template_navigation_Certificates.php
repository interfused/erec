<?php
/**
 * Template Name: Navigation Certificates page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>
	<?php 

	if ( !is_user_logged_in() ) {
		$url = site_url();
		echo wp_redirect($url);
	}

	$userID = get_current_user_id();
	$current_user = wp_get_current_user();

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
	 
	  	$accessEmp = get_cimyFieldValue($userID, 'PNA_CERTIFICATIONS');
		$accessRec = get_cimyFieldValue($userID, 'PNAR_CERTIFICATIONS');
		if ( in_array( 'candidate', $current_user->roles) ){
			if ( $accessEmp == 'Yes' ) {
				$view = 'allow';
			}
			$breadcrumbUrl = '/job-seekers/seeker-profile-view/';
		}
		elseif ( in_array( 'administrator', $current_user->roles) ) {
			if ( $accessRec == 'Yes' ) {
				$view = 'allow';
			}
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
	elseif ( in_array( 'candidate', $current_user->roles) ){
		$userID  = get_current_user_id();
		$allowView = 'allow';
		$breadcrumbUrl = '/job-seekers/dashboard/';
		$breadText = 'Management';
		$cand_name = 'You';
		$view = 'allow';
	}
	else{
		$url = site_url();
		echo wp_redirect($url);
	}

	global $wpdb;
	$tableName = $wpdb->prefix.'jobseeker_resume';
	
	if ( in_array('candidate', $current_user->roles) ) {
		$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'certificate' ORDER BY id desc");
	}
	else{
		$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'certificate' AND access IN ('Currently Viewable', 'Permission Only') ORDER BY id desc");
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
	else {
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
			<section class="navigations">
				<div class="section_title">
					<h3>Certification <?php echo $breadText; ?></h3>
					<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
				</div>
				<div class="row indent">
					<div class="col-md-9">
						<ol class="breadcrumb">
						  <li><a href="<?php echo site_url().$breadcrumbUrl; ?>">Home</a></li>
						  <li class="active">Certification <?php echo $breadText; ?></li>
						</ol>

						<?php if($view == 'allow'){ ?>
							<div class="search_bar">
								<p><?php echo $cand_name." ".$verb; ?> stored <span id="noOfRes"><?php echo count($select); ?></span> Certification(s)</p>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="row indent">
					<div class="col-md-9">
						<?php if($view == 'allow'){ ?>
							<?php if( count($select) >= 1){ ?>
							<div class="navigations_list">
								<div class="row">
									<?php
									foreach ($select as $value) { ?>
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
														
														if ( in_array('candidate', $current_user->roles) ) {
															$previewclass  = 'fancybox';
															$fileurl = $strPDF;
															if (  strtolower( $extension ) == 'pdf' ) {
																$printfileurl = $strPDF;
																$printwclass  = 'fancybox';
															}
															else{
																$printfileurl = 'javascript:void(0);';
																$printwclass  = 'printimg';
															}
														}
														else{
															if( $value->access == 'Currently Viewable' ){ 
																$previewclass  = 'fancybox';
																$fileurl = $strPDF;
																if (  strtolower( $extension ) == 'pdf' ) {
																	$printfileurl = $strPDF;
																	$printwclass  = 'fancybox';
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
															<li><a href="<?php echo $printfileurl; ?>" class="<?php echo $printwclass; ?>" printimg="<?php echo $fileurl; ?>">Print</a></li> <!-- onClick="printPage('<?php //echo $strPDF; ?>');" get_site_url().'/download.php?filename='. $fileurl; -->
															<li><a href="<?php echo $fileurl; ?>" <?php echo $target; ?> class="<?php echo $previewclass; ?>" >Preview</a></li>
															<?php if($allowView == 'allow'){ ?>
																<li><a href="javascript:void(0);" class="forward_doc" docId="<?php echo $value->id; ?>">Forward</a></li>
																<li><a class="removeResume" docId="<?php echo $value->id; ?>" href="javascript:void(0);">Delete</a></li>
															<?php } ?>
														</ul>
														<div class="thumbnail">
		      												<img src="<?php echo get_stylesheet_directory_uri(); ?>/boxicon/8---Accomplishments-and-Certifications---purchased-[Converted].jpg" class="img-responsive" alt="Resume">
														</div>
														<?php if($allowView == 'allow'){ ?>
															<div class="text-center">
																<div class="radio">
																  <label data-toggle="tooltip" data-placement="top" title="When your profile is viewed, this is the one you want to show without permission.">
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
							<?php  }else{ 

								  if($roles1 == 'candidate'){


									?>
										<div class="well no_document">
											<p><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/green_checklg.jpg"> <span>You haven’t saved any Certifications yet!</span></p>
											<p>Certifications show your continued interest in a profession or market.  A Decision Maker uses your documented accomplishments, not only to see where you have been, but also to evaluate where you might be going.  Help them make the best choice for the open position they are looking to fill, help them choose you.</p>
											<p>Providing a digital history of your accomplishments in this way show your on-going interest in the profession.  Let’s think logically on this. If the decision to hire someone comes down to two candidates; one candidate can show he or she has document accomplishments and obtained certifications of achievements since starting their career and the second candidate has never received any Certifications, ongoing training or has taken no steps showing initiative for advancement, who do you think will have the strategic advantage?</p>
											<p>Let’s take as much time as we need to collect all of our Certifications, no matter how minimal you consider them to be. If you need to come back to this step, that is not a problem.  We suggest getting the best-looking documents you can and sometimes that requires you to scan documents and then save later.  </p>
											
											<p><strong>Remember, you will not have a second chance at a first impression.</strong></p>  
										</div>
										<div class="media">
										  <div class="media-left media-middle">
										      <img class="media-object" src="<?php  echo get_stylesheet_directory_uri(); ?>/img/eyerecruit-torch-far.jpg" alt="">
										  </div>
										  <div class="media-body media-middle">
											<p>To receive information on Training, Seminars or other learning opportunities, click this button and send us an e-mail.  Tell what you would like to learn or study and we will included your on any future notifications regarding Trainings, Seminars and Events from EyeRecruit, Inc., our affiliates or Industry Professional Associations.  </p>
										  </div>
										  <div class="media-right media-middle">
										      <a href="mailto:info@eyerecruit.com" class="btn btn-primary btn-sm">Get More!</a>
										  </div>
										</div>

							<?php 
								}
							} ?>
						<?php } else{ ?>
							<div class="no-jobs-found restrict_notice">
										<h4 class="no_job_listings_found"><?php echo $cand_name; ?> has set the Security settings on this section of the profile to Restricted.</h4>
										<div class="media">
										  <div class="media-left">
										    <img class="media-object" src="<?php echo get_stylesheet_directory_uri(); ?>/img/big_minus.jpg" alt="0">
										  </div>
										  <div class="media-body">
										    <p>What does that mean? To view this material, you will need to click the link below and a message will be sent notifying the candidate that you would like access to view this material. Once <?php echo $cand_name; ?> approves the material to be viewed, you will recieve a message via mail and within your profile that your access has been granted.</p>
										  </div>
										</div>
										<div class="text-center">
											<a href="mailto:<?php echo $userdata->user_email; ?>" class="btn btn-sm btn-success">Notify</a>
										</div>
									</div><!-- no-jobs-found -->
						<?php } ?>
					</div>

					<div class="col-md-3">
						<?php 
						$pageID = get_the_ID(); 
						$uar = get_post_meta($pageID, 'upload_file_content', true); 
						$mt = get_post_meta($pageID, 'member_tips', true); 
						?>
						<?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>

								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>ON BEING CERTIFIED</h5>
									<p>A certification shows that the Candidate was interested enough to peruse the certification and in most cases they took an exam. Some professional certifications require you study (hard) and pass a text.  Other’s require you have years of experience in a specific field before you can even apply.  Do you see something here that will give this candidate and edge?</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>THE VALUE TO YOU</h5>
									<p>Some Certifications are excellent others will not be useful to you in the position(s) you have available. There are arguments to be made about the value of certification, especially in discussions around technology.  What it does show is on-going interest in the profession and areas where education mixed with passion, might produce excellence. With any luck the Job Seeker learned something though the study that they will be able to implement in the working environment.</p>
								</div>


						<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>
						<?php   if ( isset($_REQUEST['recruitID']) ) { ?>

							<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>ON BEING CERTIFIED</h5>
									<p>A certification shows that the Candidate was interested enough to peruse the certification and in most cases they took an exam. Some professional certifications require you study (hard) and pass a text.  Other’s require you have years of experience in a specific field before you can even apply.  Do you see something here that will give this candidate and edge?</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>THE VALUE TO YOU</h5>
									<p>Some Certifications are excellent others will not be useful to you in the position(s) you have available. There are arguments to be made about the value of certification, especially in discussions around technology.  What it does show is on-going interest in the profession and areas where education mixed with passion, might produce excellence. With any luck the Job Seeker learned something though the study that they will be able to implement in the working environment.</p>
								</div>


						<?php  }else{  ?>

							<div class="special_box navi_thumbnail">
								<h5>Upload a certification</h5>
								<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
								<a href="<?php echo site_url('/job-seekers/upload-certificate/'); ?>" class="btn btn-primary btn-sm">Upload</a>
							</div>

						<?php member_navigation_sidebar_tips_function('seeker_certificates'); ?>
						<?php } ?>

							<?php  }else { ?>
							<div class="special_box navi_thumbnail">
								<h5>Upload a certification</h5>
								<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
							</div>

						<?php member_navigation_sidebar_tips_function('seeker_certificates'); ?>
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
			  customClass: 'daner_sweet'
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
			});
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
			<h3>Upload your Certificate</h3>
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
						<?php echo SITE_VERBIAGE_PRIVACY_VALUE; ?> Your Certificate(s) information will be added to your profile.
					</p>
				    <div class="text-center form-group">
				        <button type="button" class="btn btn-primary btn-upload">Submit My Certificate</button>
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

	        fd.append('action', 'cvf_upload_certificatesfiles');   //Action in inc/edit_basic_info.php
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

<?php echo forwardNavigationFiles('Certification'); ?>
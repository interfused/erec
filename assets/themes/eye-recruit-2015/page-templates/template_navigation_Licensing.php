<?php
/**
 * Template Name: Navigation Licensing page
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

	  	$accessEmp = get_cimyFieldValue($userID, 'PNA_LICENSING_DOC');
		$accessRec = get_cimyFieldValue($userID, 'PNAR_LICENSING_DOC');
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
		$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'license' ORDER BY id desc");
	}
	else{
		$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'license' AND access IN ('Currently Viewable', 'Permission Only') ORDER BY id desc");
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
			<section class="navigations">
				<div class="section_title">
					<h3>License <?php echo $breadText; ?></h3>
					<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
				</div>
				<div class="row indent">
					<div class="col-md-9">
						<ol class="breadcrumb">
						  <li><a href="<?php echo site_url().$breadcrumbUrl; ?>">Home</a></li>
						  <li class="active">Licensing <?php echo $breadText; ?></li>
						</ol>

						<?php if($view == 'allow'){ ?>
							<div class="search_bar">
								<p><?php echo $cand_name." ".$verb; ?> stored <span id="noOfRes"><?php echo count($select); ?></span> Licensing Document(s)</p>
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
		      												<img src="<?php echo get_stylesheet_directory_uri(); ?>/boxicon/10---Professional-Licensing---Purchased---Choice-A-[Converted].jpg" class="img-responsive" alt="Resume">
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
							<?php  } else{

								    if($roles1 == 'candidate'){
							 ?>
										<div class="well no_document">
											<p><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/green_checklg.jpg"> <span>You haven’t saved any of your Licenses!</span></p>
											<p>Licensure is a vital aspect to the profession and the mark of a professional.  It’s a standard recognized by employers and their clients, but governments and by the general public.  It is an assurance of skill, quality and / or aptitude.  While not every jurisdiction has difficult barriers to entry, many States have multiple types of licensing, based on levels of qualification and tenure.  Licensing and continuing education mandates is a trend that is almost certain to continue in the future.</p>
											<p>Be proud of what you have obtained.  Get a quality scan of all of your licensing documents and present them for the potential Employer to see.  Many of our clients put not only their State Professional Licensing, but their Firearms Identification Card, concealed weapon permits, drivers license and other licenses that a potential employer would most likely request.  </p>
											<p>What you post for review and mark as available is up to you.  It is our belief that whatever makes it easier for the Decision Maker, makes it easier for you.  That is the goal.</p>
											
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
									<h5>ABOUT LICENSING</h5>
									<p>Ensuring that all candidates have current professional licensing protects Employers from negligent hiring claims. While the Employer remains responsible for confirming all licensing before and after hiring, Eyerecruit offers an easy way for Job Seekers to post their current licensing, so interested Employers can view licensure and expedite the hiring process when interested.</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>LICENSING DISCLAIMER</h5>
									<p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own employment related documents. EyeRecruit, Inc. does not confirm the materials provided here.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a target="_blank" href="<?php site_url(); ?>/terms-and-conditions/">Terms & Conditions </a>policies.</p>
								</div>

						<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>

							  <?php   if ( isset($_REQUEST['recruitID']) ) { ?>
							  	<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>ABOUT LICENSING</h5>
									<p>Ensuring that all candidates have current professional licensing protects Employers from negligent hiring claims. While the Employer remains responsible for confirming all licensing before and after hiring, Eyerecruit offers an easy way for Job Seekers to post their current licensing, so interested Employers can view licensure and expedite the hiring process when interested.</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>LICENSING DISCLAIMER</h5>
									<p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own employment related documents. EyeRecruit, Inc. does not confirm the materials provided here.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a target="_blank" href="<?php site_url(); ?>/terms-and-conditions/">Terms & Conditions </a>policies.</p>
								</div>

								<?php  }else{  ?>

								<div class="special_box navi_thumbnail">
									<h5>Upload Licensing</h5>
									<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
									<a href="<?php echo site_url('/job-seekers/upload-license/'); ?>" class="btn btn-primary btn-sm">Upload</a>
								</div>

							<?php member_navigation_sidebar_tips_function('seeker_licensing'); ?>

								<?php } ?>

							
						<?php  }else { ?>
							<div class="special_box navi_thumbnail">
								<h5>Upload Licensing</h5>
								<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
							</div>

						<?php member_navigation_sidebar_tips_function('seeker_licensing'); ?>
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
			<h3>Upload your License</h3>
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
						<?php echo SITE_VERBIAGE_PRIVACY_VALUE; ?> Your License information will be added to your profile.
					</p>
				    <div class="text-center form-group">
				        <button type="button" class="btn btn-primary btn-upload">Submit License</button>
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

	        fd.append('action', 'cvf_upload_licensesfiles');   //Action in inc/edit_basic_info.php
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

<?php echo forwardNavigationFiles('License'); ?>
<?php
/**
 * Template Name: Navigation Background Management page backup
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>
	<?php 

	$url = site_url();
	if ( !is_user_logged_in() ) {
		echo wp_redirect($url);
	}

	$userID = get_current_user_id();
	$current_user = wp_get_current_user();

	$view = '';
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
		echo wp_redirect($url);
	}
	

	global $wpdb;
	$tableName = $wpdb->prefix.'jobseeker_resume';
	if ( in_array('candidate', $current_user->roles) ) {
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
	?>
	<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="page-header">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header>

		<div id="primary" class="content-area">
			<div id="content" class="container" role="main">
				<div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
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
									<p><?php echo $cand_name; ?> have stored <span id="noOfRes"><?php echo count($select); ?></span> Background Management(s)</p>
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
											<p>Decide for yourself if you would like to order one of the Background Searches provided by the third parties we have provided for you or one you find yourself. Before you do, you can <a href="javascript:void(0);">read here</a> what the The United States Federal Trade Comission (FTC)  has posted on Employment Background Checks and thier suggestions on "fixing mistakes before an employer see it.</p>
											<div class="text-center"> <!-- https://www.consumer.ftc.gov/articles/0157-employment-background-checks/ -->
												<a href="javascript:void(0);" id="uploadBackDoc" class="btn btn-primary">Upload a Document</a>
												<a href="<?php echo site_url().'/run-a-fresh-background-check/'; ?>" class="btn btn-default">Request Beckground Check</a>
											</div>
											<span><a href="<?php  echo site_url(); ?>/job-seekers/dashboard/">No thanks, return to Dashboard.</a></span>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } else{ ?>
								<div class="jobsearch_results job_listings listingforward">
									<div class="no-jobs-found">
										<h4 class="no_job_listings_found">Whoops! <?php echo $cand_name; ?> restrict access to view. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
										<p><strong>Here are some ideas that might help:</strong></p>
										<ul>
											<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
											<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
										</ul>
										<p>Still no luck? Send us your feedback: <a href="mailto:support@EyeRecruit.com">support@EyeRecruit.com</a>.</p>
									</div><!-- no-jobs-found -->
								</div>
							<?php } ?>
						</div>

						<div class="col-md-3">
							<?php 
							$pageID = get_the_ID(); 
							$uar = get_post_meta($pageID, 'upload_file_content', true); 
							$rabn = get_post_meta($pageID, 'run_a_background_now_content', true); 
							$mt = get_post_meta($pageID, 'member_tips', true); 
							?>

							<?php if($allowView == 'allow'){ ?>		
								<div class="special_box navi_thumbnail">
									<h5>Run  a Background Now</h5>
									<p><?php echo (($rabn))? $rabn : 'Data not found'; ?></p>
									<a href="javascript:void(0);" class="btn btn-primary btn-sm">Order Now</a>
								</div>
								<div class="special_box navi_thumbnail">
									<h5>Upload a Background</h5>
									<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
									<a href="<?php echo site_url('/job-seekers/upload-background-doc/'); ?>" class="btn btn-primary btn-sm">Upload</a>
								</div>
							<?Php } ?>
							<?php member_navigation_sidebar_tips_function('seeker_background_mang'); ?>
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


<?php echo forwardNavigationFiles('Background Management'); ?>
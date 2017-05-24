<?php
/**
 * Template Name: Background Verification page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>
	<?php
	$userID = get_current_user_id();
	$current_user = wp_get_current_user();
	if ( in_array( 'candidate', $current_user->roles) ){
	  $userID  = get_current_user_id();
	  $allowView = 'allow';
	  $breadcrumbUrl = '/job-seekers/dashboard/';
	  $breadText = 'Management';
	  $cand_name = 'You';
	}
	else{
	  $userID = $_REQUEST['recruitID'];
	  $userdata = get_userdata($userID);
	  $allowView = '';
	  $breadcrumbUrl = '/employers/redacted-employer-quick-view/?recruitID='.$userID;
	  $breadText = '';
	  $cand_name = $userdata->first_name.' '.$userdata->last_name;
	}

	global $wpdb;
	$tableName = $wpdb->prefix.'jobseeker_resume';
	$select = $wpdb->get_results("SELECT * FROM $tableName WHERE user_id = '".$userID."' AND docType = 'background_doc' ORDER BY id desc");
	if ( count($select) == 0 ) { ?>
		<script type="text/javascript">
			/*jQuery(document).ready( function() {
				jQuery('#UploadRes').modal('show');
			});*/
		</script>
	<?php } ?>
	<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="page-header">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header>

		<div id="primary" class="content-area">
			<div id="content" class="container" role="main">
				<section class="navigations back_verification">
					<div class="section_title">
						<h3>Background Verification</h3>
						<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
					</div>
					<div class="row">
						<div class="col-md-8">
							<ol class="breadcrumb">
							  <li><a href="<?php echo $breadcrumbUrl; ?>">Home</a></li>
							  <li class="active">Background Verification</li>
							</ol>
							<div class="indent">
								<div class="sidebar_title cont_title">
									<h4>Background Verifications  Managed & Run By You</h4>
								</div>
								<div class="well">
									<p><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/green_checklg.jpg"> <span>You haven’t saved any Background Verificationds.</span></p>
									<p>A potential Employer may ligally look into your background during the hiring process and require a background checl to be conducted <strong>as a part of the hiring process.</strong> Over the course of a career you will have provided access to Local, State and Federal Criminal & civil histories, your credit report and a multitude of other background related inquiries to dozens, if not hunderds of times. Why not manage this process and give approval to people who should actually be seeing it? </p>
									<p class="indent"><strong>You don’t need to have a Background Search done by one of the potential vendors we suggest. Even though you can, you don’t even need to post the results of  a tihrd party Background Search that you conduct & requests yourself on the site.</strong></p>
									<p>In truth, you don't need to provide <em><u>anything</u></em> relating to your Background to a potential Employer to get the benefits of using the Eyerecruit.com services. Everything on Eyerecruit.com is self disclosed and designed to allow you to better manage your own carrier. But why not handle your Personal Background verifications like your Credit Report or FICO Score? </p>
									<p>Besides being able to provide permission on a case-by-case basis directly from the platfrom, you will be able to know immediately about potentially harmful errors contained within your background search that may have a negative impact on your ability to obtain gainful employment. With this knowledge you can get the issue addressed before it has a negative impact on your career and before a Decision Maker at an Employer you really would love to work for has less then the full story. </p>
									<p>Decide for yourself if you would like to order one of the Background Searches provided by the third parties we have provided for you or one you find yourself. Before you do, you can read here what the The United States Federal Trade Comission (FTC)  has posted on Employment Background Checks and thier suggestions on "fixing mistakes before an employer see it.</p>
									<div class="text-center">
										<a href="#" class="btn btn-primary">Upload a Document</a>
										<a href="#" class="btn btn-default">Request Beckground Check</a>
									</div>
									<span>No thanks, return to Preferences</span>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<?php 
							$pageID = get_the_ID(); 
							$uobrc = get_post_meta($pageID, 'use_of_background_reports_content', true); 
							$odc = get_post_meta($pageID, 'our_disclaimer_content', true); 
							$ptc = get_post_meta($pageID, 'professional_tip_content', true); 
							?>

							<?php //if($allowView == 'allow'){ ?>		
								<div class="special_box special_logo">
									<div class="thumbnail"><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive"></div>
									<h5>Use of Background Reports</h5>
									<p><?php echo (($uobrc))? $uobrc : 'Data not found'; ?></p>
								</div>
								<div class="special_box special_logo">
									<div class="thumbnail"><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive"></div>
									<h5>Our disclaimer</h5>
									<p><?php echo (($odc))? $odc : 'Data not found'; ?></p>
								</div>
							<?Php //} ?>
							<div class="special_box special_logo">
								<div class="thumbnail"><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive"></div>
								<h5>Professional Tip</h5>
								<p><?php echo (($ptc))? $ptc : 'Data not found'; ?></p>
							</div>
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
			  cancelButtonText: "Cancel",
			  cancelButtonClass: "btn-primary btn-sm cancelbutton",
			  closeOnConfirm: false,
			  closeOnCancel: false,
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
				   swal({
				   		title:	"Cancelled",
				   		type: "error",
					   	confirmButtonClass: "btn-primary btn-sm",
				   });
				}
			});
		});

		jQuery('.changeAccess').on('click', function() {
			var _this= jQuery(this);
			var docId = _this.attr('docId');
			var thisVal = _this.val();
			jQuery.ajax({
				'type': 'POST',
				'url': '<?php echo admin_url("/admin-ajax.php"); ?>',
				data:{
					'action': 'accessJobseekerResume', //Action in inc/edit_basic_info.php
					'docId': docId,
					'thisVal': thisVal,
				},
				success: function(r){
					if ( r == 'success' ) {
						jQuery.notify('Successfully Updated.', 'success');
					}
					else{
						jQuery.notify('Something Wrong! Please try again.', 'error');
					}
				}
			})
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
			<div class="upload-form">
				<form action="" method="post">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="row">
								<div class="col-xs-8 devicefull col-xs-offset-2">
							        <div class="upload_btn">
								        <input type="file" name="files" class="files-data form-control" id="fileupload">
								        <input type="hidden" name="fileid" value="" id="fileid">
							        	<span class="upload_icons"></span>Your Computer
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
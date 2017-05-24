<?php
/**
 * Template Name: Navigation Background order page
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
				<section class="navigations order_verification">
					<div class="section_title">
						<h3>Background <?php echo $breadText; ?></h3>
						<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
					</div>
					<div class="order_breadcrumb indent">
						<ol class="breadcrumb">
						  <li><a href="<?php echo site_url().$breadcrumbUrl; ?>">Home</a></li>
						   <li><a href="<?php echo site_url(); ?>/background-management/">Background <?php echo $breadText; ?></a></li>
						  <li class="active">Order Background</li>
						</ol>
						<p>&lt;&lt; Need an international background? &gt;&gt;</p>
					</div>
					<div class="row indent">
						<div class="col-md-9">
							<?php if($view == 'allow'){ ?>
								<!-- <div class="search_bar">
									<p><?php //echo $cand_name; ?> have stored <span id="noOfRes"><?php //echo count($select); ?></span> Background Management(s)</p>
								</div> -->
							<?php } ?>
						</div>
					</div>
					<div class="row indent">
						<div class="col-md-8">
							<div class="indent-2x">
								<P>It’s time to start looking at managing <strong>your</strong> career from a different perspective.  Managing your background verification, confirming the data about you is up-to-date and proactively managing your background reports will remain an important part of that process. “Blasting” your resume to every single online posting and hoping that someone on the receiving end will magically find yours, isn’t proactive, nor is it intelligent.</P>
								<p class="text-primary">“You don’t need anyone to tell you the current way isn’t working.”</p>
								<p>The future of employment has already started charting a different course.  The future is focused on a workforce proactively managing their career and choosing the company and the leadership that he or she would like to work for.  Once a candidate researches the company, the leadership hierarchy, management philosophies and what is <strong>specifically</strong> being exchanged, then the only thing left to do is to make sure the decision maker has everything he or she needs to choose the best candidate for the position, <strong>you</strong>.</p>
							</div>
							<div class="row text-center">
								<div class="col-sm-3"><img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/victig_logo.jpg" class="img-responsive orderback_logo"><br><a href="#">View Privacy Policy</a></div>
								<div class="col-sm-6">
									<p><strong>Now Top Rated Pre-Employment Background Screening services are available to you directly.</strong></p>
									<p><em>At VICTIG we feel that using the best screening software in the world, that we are ahead of the game. Integrating over 50 different data providers gives you the most efficient, timely & comprehensive search results available.</em></p>
								</div>
								<div class="col-sm-3"><a href="#">View Sample</a><br><div class="backorder_view"><img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/vic.jpg" class="img-responsive"></div></div>
							</div>
							
							<div class="orderprice_table indent-2x">
								<div class="row">
									<div class="col-sm-4 col-xs-6 devicefull">
										<div class="order_col">
											<div class="ordercol_body">
												<div class="ordercol_header">
													<h3>Basic</h3>
													<h5>Report</h5>
													<div class="orderprice">
														<span>$29.99</span>
													</div>
												</div>
												<div class="ordercol_content">
													<h6>Criminal History</h6>
													<ul>
														<li>National Federal Criminal check</li>
														<li>Sex Offender List</li>
													</ul>
													<h6>Identity</h6>
													<ul>
														<li>SSN Trace + Address History</li>
													</ul>
												</div>
											</div>
											<div class="ordercol_footer">
												<a href="javascript:void(0);" class="btn btn-primary">Order Now</a>
											</div>
										</div>
									</div>
									<div class="col-sm-4 col-xs-6 devicefull">
										<div class="order_col selected">
											<div class="ordercol_body">
												<span class="popular_badge">Most Popular</span>
												<div class="ordercol_header">
													<h3>Standard</h3>
													<h5>Report</h5>
													<div class="orderprice">
														<span>$49.99</span>
													</div>
												</div>
												<div class="ordercol_content">
													<h6>Expand your search to Include:</h6>
													<p><strong>Basic Report Plus</strong></p>
													<ul>
														<li>1 Country Criminal Court check*</li>
														<li>Inspector General, OFAC, FDA & GSA</li>
														<li>National Alias Search</li>
													</ul>
												</div>
											</div>
											<div class="ordercol_footer">
												<a href="javascript:void(0);" class="btn btn-primary">Order Now</a>
											</div>
										</div>
									</div>
									<div class="col-sm-4 col-xs-6 col-sm-offset-0 col-xs-offset-3 devicefull ">
										<div class="order_col">
											<div class="ordercol_body">
												<div class="ordercol_header">
													<h3>Premium</h3>
													<h5>Report</h5>
													<div class="orderprice">
														<span>$89.99</span>
													</div>
												</div>
												<div class="ordercol_content">
													<h6>Expand your search Further:</h6>
													<p><strong>Standard Report Plus</strong></p>
													<ul>
														<li>1 Employment Verification & History</li>
														<li>1 Education Verification & Credentials</li>
														<li>1 State Specific Professional Licensing</li>
													</ul>
												</div>
											</div>
											<div class="ordercol_footer">
												<a href="javascript:void(0);" class="btn btn-primary">Order Now</a>
											</div>
										</div>
									</div>
								</div>
								<div class="text-right">
									<ul>
										<li>* Database coverages varies by State</li>
										<li>* Addition charges may apply</li>
									</ul>
								</div>
							</div>
							<p class="provider"><strong>PROVIDER NOTICE:</strong> The National Criminal Searches through VICTIG are comprised of information provided from various state reporting agencies including, but not limited to, the Department of Public Safety, Department of Corrections, Administrator of the Courts, County Municipal Records and State Bureaus of Investigation. Information provided includes subject description, felony and misdemeanor charges and convictions, file date, and disposition, when available. Search currently includes records in all 50 states Criminal and 50 states from the Sexual Offender Registry.</p>
						</div>

						<div class="col-md-4">
								
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>EMPLOYERS USE OF BACKGROUND REPORTS:</h5>
									<p>"The employer must tell you that they might use the (background report) information to make a decision related to your employment and must ask for your written permission, but if you're applying for a job and don't give your permission, the employer may reject your application."<br></br>
										<strong>- The Federal Trade Commission (FTC)</strong>
									</p>
									<p>
										Wouldn't you like to know what is in those reports and provide them freely yourself?
									</p>
								</div>
								<div class="special_box special_logo navi_thumbnail margin-top-70-logo">
									<div class="thumbnail">
										<img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>OUR DISCLAIMER</h5>
									<p>EyeRecruit, Inc. is not a Law Firm and should not be seen or interpreted as providing legal advice.</p><p>What you provide to a potential employer is up to you.  It is always a good idea to check with someone who knows the specific laws in the jurisdiction where you live.</p>
								</div>
								<div class="special_box special_logo navi_thumbnail margin-top-70-logo">
									<div class="thumbnail">
										<img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>PROFESSIONAL TIP</h5>
									<p>Use a professional licensed provider to conduct your background verification.  Great screening companies will do a far better job of locating the concrete information you need, not only for your knowledge, but to assist a potential Employer.  Providing your own background will prevent Employers from viewing data that might be a violation of State of Federal Law.  </p>
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
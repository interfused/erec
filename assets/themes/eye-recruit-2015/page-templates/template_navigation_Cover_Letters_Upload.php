<?php
/**
 * Template Name: Navigation Cover Letters Upload page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<?php $userID = get_current_user_id(); ?>
<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<section class="navigations">
				<div class="section_title">
					<h3>Upload Cover Letters</h3>
					<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
				</div>

				<!-- <div class="indent">
						<ol class="breadcrumb">
						  <li><a href="<?php echo get_stylesheet_directory_uri(); ?>">Home</a></li>
						  <li class="active">Upload Cover Letters</li>
						</ol>
				</div> -->
				
				<div class="row indent">
					<div class="col-md-9">
						<div class="upload-form">
							<div class="sidebar_title">
								<h4>Upload your Cover Letters from a device or preferred cloud storage</h4>
							</div>
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
										<p class="text-right">
											<a id="backtolist" href="<?php echo site_url('/job-seekers/cover-letters/'); ?>">Cancel</a>
										</p>
									</div>
								</div>
								<p class="text-center">
									<?php echo SITE_VERBIAGE_PRIVACY_VALUE; ?>  Your cover letters information will be added to your profile.
								</p>
							    <div class="text-center form-group">
							        <button type="button" class="btn btn-primary btn-upload" >Submit My Cover Letters</button>
							    </div>
							    <div class= "upload-response">
							    </div>
							</form>
						</div>
					</div>

					<div class="col-md-3">
						<?php /*$pageID = get_the_ID(); ?>
						<div class="special_box">
							<h5>You're almost there!</h5>
							<?php $yat = get_post_meta($pageID, 'youre_almost_there', true); ?>
							<p><?php echo (($yat))? $yat : 'Data not found.' ?></p>
						</div>

						<div class="special_box">
							<h5>What happens next?</h5>
							<?php $whn = get_post_meta($pageID, 'what_happens_next', true); ?>
							<p><?php echo (($whn))? $whn : 'Data not found.' ?></p>
						</div>

						<div class="special_box">
							<h5>The goal is simple:</h5>
							<?php $tgis = get_post_meta($pageID, 'the_goal_is_simple', true); ?>
							<p><?php echo (($tgis))? $tgis : 'Data not found.' ?></p>
						</div><?php */ ?>

						<?php 
							$pageID = get_the_ID(); 
							$uar = get_post_meta($pageID, 'upload_file_content', true); 
							$mt = get_post_meta($pageID, 'member_tips', true); 
							?>

							<div class="special_box navi_thumbnail">
								<h5>Upload a cover letter</h5>
								<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
							</div>

							<div class="special_box navi_thumbnail">
								<h5>Use our template free</h5>
								<!-- <p><?php echo (($uar))? $uar : 'Data not found'; ?></p> -->
								<p>EyeRecruit <b>does have</b> a paid services for correspondences like this, but we have included a FREE cover letters template to be used by our members. This template has been provided to give you a good foundation and example on what could be sent. By selecting to use the <b>TEMPLATE</b> provided you will be able to modify it and save it for this use while also be able to return to use the template again whenever you desire.</p>
								<a href="javascript:void(0);" class="btn btn-primary btn-sm">Start</a>
							</div>

							<?php member_navigation_sidebar_tips_function('seeker_cover_letters'); ?>
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
	jQuery(document).ready(function() {

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

	        fd.append('action', 'cvf_upload_coverlettersfiles');   //Action in inc/edit_basic_info.php
	        jQuery.ajax({
	            type: 'POST',
	            url: '<?php echo admin_url("admin-ajax.php"); ?>',
	            data: fd,
	            contentType: false,
	            processData: false,
	            success: function(response){
	            	jQuery('#fileid').val(response);

	            	if ( response == '<p class="success">Successfully added.</p>' ) {
	            		swal({
							title: 'Successfully added', 
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
						jQuery('.upload-response').html('');
						jQuery('#uploadedFile').html('');
						jQuery('#backtolist').html('View All Cover Letters(s)');
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
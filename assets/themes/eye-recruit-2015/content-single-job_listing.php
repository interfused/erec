<?php
/**
 * Job Content
 *
 * @package Jobify
 * @since Jobify 1.0
 */

global $job_manager;

$er_JobMeta = get_post_meta( get_the_ID() );
$info         = jobify_theme_mod( 'jobify_listings', 'jobify_listings_display_area' );
$col_overview = 'side' == $info ? '12' : ( ! jobify_get_the_company_description() ? '10' : '6' );
$col_company  = 'side' == $info ? '12' : '4';

function isAllowedBranded($str){

	if(!is_user_logged_in()){
		return false;
	}else{
								//checks to see if logo type is 'Branded'
		return strtolower($str) == 'branded';
	}
							//something strange happened
	return false;
}

?>
<div class="single_job_listing" itemscope itemtype="http://schema.org/JobPosting">
	<meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />

	<?php if ( $post->post_status == 'expired' ) : ?>
	<div class="job-manager-info"><?php _e( 'This job listing has expired', 'jobify' ); ?></div>
<?php else : ?>

	<?php if ( is_position_filled() ) : ?>
	<div class="job-manager-error"><?php _e( 'This position has been filled', 'jobify' ); ?></div>
<?php endif; ?>

<?php do_action( 'single_job_listing_start' ); ?>

<?php
$companyName = get_post_meta($post->ID, '_company_name', true);
$location = get_post_meta($post->ID, '_job_location', true);
?>
<?php
function checkErJobMeta($field,$label){

	$er_JobMeta = get_post_meta( get_the_ID() );
	$html='';
	if($er_JobMeta[$field][0]){
		$html .= '<div class="row"><div class="col-md-4">';	
		$html .= '<h3 class="tightTop">'.$label.'</h3></div>';
		$html .= '<div class="col-md-8">';
		$html .= $er_JobMeta[$field][0];
		$html .='</div></div>';
		return $html;
	}else{
		return false;
	}
}

function getMultiSelectValues($field,$label){
	global $post;
	$html ='';
	$tmp_arr=get_post_meta($post->ID, $field, true);
	if( !$tmp_arr ){
		return ;
	}
	$html .='<div class="row"><div class="col-md-4">';
	$html .='<h3  class="tightTop">'.$label.'</h3></div>';
	$html .= '<div class="col-md-8"><ul class="tightTop">';
	for($i=0;$i<count($tmp_arr);$i++){
		$html .= '<li>'.$tmp_arr[$i].'</li>';
	}
	$html .= '</ul>';

	$html.='</div></div>';
	return $html;
}

function getMultiSelectValuescomma($field){
	global $post;
	$html ='';
	$tmp_arr=get_post_meta($post->ID, $field, true);
	if( !$tmp_arr ){
		return '--';
	}

	$newval = array();
	foreach ($tmp_arr as $value) {
		if ( $value == 'Other' ) {
			$other_tmp_arr=get_post_meta($post->ID, $field.'_other', true);
			if ( !empty($other_tmp_arr) ) {
				$newval[] = $value.'( '.$other_tmp_arr.' )';
			}
			else{
				$newval[] = $value;
			}
		}
		else{
			$newval[] = $value;
		}
	}
	return implode(', ', $newval);
}


function get_the_job_cat($postID) {
	$post = get_post( $postID );
	if ( $post->post_type !== 'job_listing' ) {
		return;
	}
	$types = wp_get_post_terms( $postID, 'job_listing_category' );
	if ( $types ) {
		echo $types[0]->name;
	}
}


?>          
<section class="jobdetail_page">
		<!-- 	<header class="jobdetail-header" role="banner">
		<div class="container">
			<a href="<?php //echo site_url(); ?>" title="Eye Recruit" rel="home" class="site-branding pull-right">
				<img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/jobdetail_logo.jpg" alt="">
			</a>
			<a href="#">View All career Opportunities</a>
		</div>
	</header> -->
	<div class="page-header">
		<div class="container">
			<a href="javascript:void(0);" class="forwardThisjob" jobid="<?php echo $post->ID; ?>">Send This to a Friend</a>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="sidebar">
					<div class="special_box thumbnail">
						<?php
						$logo = get_the_company_logo($post, 'full');
						if(is_user_logged_in()){
							if ( !empty($logo) ) { ?>
							<img src="<?php echo $logo; ?>" class="img-responsive">
							<?php } else{ ?>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/eyerecruit_squire.jpg" class="img-responsive">
							<?php } 
						}else{
							?>
							<img src="<?php echo site_url(); ?>/assets/uploads/2017/03/Members-Only-Purchased.jpg" class="img-responsive">
							<?php
						}
						?>
					</div>
					<div class="light_box snap_shot" id="tourSnapShot">
						<div class="sidebar_title">
							<h4>Positional Information</h4>
						</div>
						<ul>
							<li><span>Company : </span>
								<?php 
								if( isAllowedBranded($company_logo_type) ){
									echo ( !empty($companyName) )? $companyName : 'undisclosed';
								}else{
									echo 'For Members Only';
								}
								?>
							</li>
									<?php /*if ( class_exists( 'Astoundify_Job_Manager_Companies' ) && '' != get_the_company_name() ) :
										$companies   = Astoundify_Job_Manager_Companies::instance();
										$company_url = esc_url( $companies->company_url( get_the_company_name() ) );
									?>
									<a href="<?php echo $company_url; ?>" target="_blank"><?php the_company_name(); ?></a>
									<?php else : ?>
										<?php the_company_name(); ?>
									<?php endif; */ ?>
									<?php // the_company_name(); ?>
									<li>
										<span>Job Location : </span>
										<?php 
										global $wpdb;
										$cityId = get_post_meta(get_the_ID(), '_job_city', true);
										$regionId = get_post_meta(get_the_ID(), '_job_state', true);

										$cityTable = $wpdb->prefix.'cities';
										$stateTable = $wpdb->prefix.'region';
										
										$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
										$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");

										echo (($city->name)) ? $city->name : 'Anywhere'; 
										echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $state->name; 
										?>
									</li>
									<li id="gsetJobCat">
										<span>Job Category : </span>
										<div class="value">
										<?php 
										$postID = $post->ID;
										get_the_job_cat($postID); 

										//the_widget( 'Jobify_Widget_Job_Categories', $args ); ?>
									</div>
										<script type="text/javascript">
										jQuery(document).ready(function() {
											jQuery('#gsetJobCat div').removeClass('widget jobify_widget_job_categories');
										});
										</script>
									</li>
									<li>
										<span>Compensation Range : </span>
										<?php
										///HOURLY
										$er_JobMeta = get_post_meta( get_the_ID() );
										$tmp=$er_JobMeta['_job_pay_hourly'][0];
										$tmp2=$er_JobMeta['_job_pay_yearly'][0];

										if($tmp != 'n/a'){
											echo $tmp. ' per hour';
										}
										if($tmp != 'n/a' && $tmp2 != 'n/a'){
											echo ' / ';
										}
										
										if($tmp2 != 'n/a'){
											echo $tmp2. ' per year';
										}
										
										if($tmp == 'n/a' && $tmp2 == 'n/a'){
											echo 'DOE';
										}
										
										//SALARY
										?>
									</li>
									<li><span>Career Level : </span><?php echo $er_JobMeta['_job_position_career_level'][0] ? $er_JobMeta['_job_position_career_level'][0] : 'n/a'; ?></li>
									<li><span>Status : </span><?php the_job_type(); ?></li>
									<li><span>Reference # : </span><?php echo $er_JobMeta['_job_reference'][0] ? $er_JobMeta['_job_reference'][0] : 'n/a'; ?></li>
									
									<!-- <li><span>Work Experience : </span><?php echo getMultiSelectValuescomma('_job_experience_length'); ?></li>
									<li> 
										<span>Education : </span>
										<?php echo getMultiSelectValuescomma('_job_education_certifications'); ?>
									</li> -->
								</ul>
							</div>
							<div class="light_box snap_shot" id="tourSnapShot">
								<div class="sidebar_title">
									<h4>Contact Information</h4>
								</div>
								<ul>


									<li><span>Company Contact : </span>

										<?php
										$fname = get_the_author_meta('first_name');
										$lname = get_the_author_meta('last_name');
										$full_name = '';

										if( empty($fname)){
											$full_name = $lname;
										} elseif( empty( $lname )){
											$full_name = $fname;
										} else {
    //both first name and last name are present
											$full_name = "{$fname} {$lname}";
										}
////


										if( isAllowedBranded($company_logo_type) ){
											echo $full_name;
											echo '<br>{PUT POSITIONAL INFORMATION HERE}';
										}else{
											echo 'For Members Only';
										}

										?>

									</li>

									<li><span>Lead Recruiter : </span>Christopher Bauer</li>
								</ul>
								<a href="mailto:resumes@eyerecruit.com?subject=Interested in EyeRecruit Job: <?php the_title() ?>&body=I am intereseted in the following job located at: <?php the_permalink() ?>">Contact now</a>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="jobinterest_links">
							<?php
							if ( is_user_logged_in() ) {
								$WPJM_Updater = new WP_Job_Manager_Bookmarks();
								if ( !$WPJM_Updater->is_bookmarked($post->ID) ){
									echo '<a href="javascript:void(0)" class="pull-left checkSave custSaveBookmark">Save</a>';
								}
								else{
									echo '<a class="pull-left" href="'.site_url().'/preferences/saved-jobs-of-interest/">Saved</a>';
								}
							}
							else{
								echo '<a href="javascript:void(0)" class="pull-left logintosave" data-toggle="modal" data-target="#logintosaveModalWrap">Save</a>';
							}

							if ( user_has_applied_for_job( get_current_user_id(), $post->ID ) ) {
								echo "<span class='label label-success'>Already Applied</span>";
							} 
							else {
								echo "<a href='javascript:void(0);' class='btn btn-sm btn-success open-popup-intersted'>I'm Interested</a>";
							}
							?>
							
							<div class="text-center">
								
								<div id="customSavejob"></div>
								<a href="javascript:void(0);"  class="ReportThisJobOpen">Report This Job</a>
							</div>
						</div>
						
						<?php $company_logo_type = get_post_meta($post->ID, '_company_logo_type', true); 
						
						if ( isAllowedBranded($company_logo_type) )  { ?>
						<div class="about_jobcompany">
							<div class="section_title">
								<h3>About <?php echo $companyName; ?></h3>
							</div>
							<p><?php echo get_post_meta($post->ID, '_company_description', true); ?></p>
							<!-- <a href="javascript:void(0);" class="pull-right"><i class="fa fa-angle-double-left"></i> More <i class="fa fa-angle-double-right"></i></a> -->
						</div>
						<?php } ?>

						<div class="jobdetail_list">
							<div class="section_title">
								<h3><?php the_title(); ?></h3>
							</div>
							<div class="indent">
								<h4>Positional Overview :</h4>
								<?php echo apply_filters( 'the_job_description', get_the_content() ); ?>
							</div>

							<!-- BENEFITS -->

							<div class="indent">
								<h4>Benefits:</h4>
								<?php $tmp = get_post_meta($post->ID, '_job_benefits', true); ?>
								<div class="multiCol">
									<ul>
										<?php if ( $tmp ) {
											foreach ($tmp as $value) {
												echo "<li>".$value."</li>";
											} 
										} 
										else {
											echo "<li>None Specified</li>";
										} ?>
									</ul>
								</div>
							</div>


							<!-- IDEAL CANDIDATE -->
							<div class="indent">
								<h4>The Ideal Candidate :</h4>
								<?php $job_education_certifications = get_post_meta($post->ID, '_job_education_certifications', true); ?>
								<div >
									<ul>
										<?php if ( $job_education_certifications ) {
											foreach ($job_education_certifications as $value) {
												echo "<li>".$value."</li>";
											} 
										} 
										else {
											echo "<li>None Specified</li>";
										} ?>
									</ul>
								</div>
							</div>

							<div class="indent">
								<h4>Must possess one or more of the following :</h4>
								<?php $job_experience_length = get_post_meta($post->ID, '_job_experience_length', true); ?>
								<div >
									<ul>
										<?php if ( $job_experience_length ) {
											foreach ($job_experience_length as $value) {
												echo "<li>".$value."</li>";
											} 
										} 
										else {
											echo "<li>None Specified</li>";
										} ?>
									</ul>
									<?php 
									$tmpStr = get_post_meta($post->ID, '_job_experience_length_other', true);
									if($tmpStr){
										echo "<p>$tmpStr</p>";
									}
									?>
								</div>
							</div>
							<!-- EDUCATION -->
							<div class="indent">
								<h4>Education :</h4>
								<?php $tmp = get_post_meta($post->ID, '_job_education_certifications', true); ?>
								<div >
									<ul>
										<?php if ( $tmp ) {
											foreach ($tmp as $value) {
												echo "<li>".$value."</li>";
											} 
										} 
										else {
											echo "<li>None Specified</li>";
										} ?>
									</ul>  
								</div>
							</div>
							<!-- skills -->
							<div class="indent">
								<h4>Skill Required :</h4>
								<?php $job_preferred_qualifications = get_post_meta($post->ID, '_job_preferred_qualifications', true); ?>
								<div ><ul>
									<?php if ( $job_preferred_qualifications ) {
										foreach ($job_preferred_qualifications as $value) {
											echo "<li>".$value."</li>";
										} 
									} 
									else {
										echo "<li>None Specified</li>";
									} ?>
								</ul></div>
							</div>
							<!-- PHYSICAL REQUIREMENTS -->
							<div class="indent">
								<h4>Physical Requirements:</h4>
								<?php $tmp = get_post_meta($post->ID, '_job_physical_requirements', true); ?>
								<div >	<ul>
									<?php if ( $tmp ) {
										foreach ($tmp as $value) {
											echo "<li>".$value."</li>";
										} 
									} 
									else {
										echo "<li>None Specified</li>";
									} ?>
								</ul>
							</div>  
						</div>

						<!-- ENV REQUIREMENTS -->
						<div class="indent">
							<h4>Environment &amp; Activity:</h4>
							<?php $tmp = get_post_meta($post->ID, '_job_environment_activity', true); ?>
							<div >
								<ul>
									<?php if ( $tmp ) {
										foreach ($tmp as $value) {
											echo "<li>".$value."</li>";
										} 
									} 
									else {
										echo "<li>None Specified</li>";
									} ?>
								</ul>  
							</div>
							<?php 
							$tmpStr = get_post_meta($post->ID, '_job_environment_activity_other', true);
							if($tmpStr){
								echo "<p>$tmpStr</p>";
							}
							?>

						</div>

						<!-- MINIMUM REQUIREMENTS -->
						<div class="indent">
							<h4>Minimum Requirements :</h4>
							<?php $job_preferred_qualification_other = get_post_meta($post->ID, '_job_preferred_qualification_other', true); ?>
							<div >
								<ul>
									<?php if ( $job_preferred_qualification_other ) {
										foreach ($job_preferred_qualification_other as $value) {
											echo "<li>".$value."</li>";
										} 
									} 
									else {
										echo "<li>None Specified</li>";
									} ?>
								</ul>
							</div>
						</div>

						<!-- MINIMUM REQUIREMENTS -->
						<div class="indent paddedBottom">
							<h4>Other Requirements :</h4>
							<?php echo ($er_JobMeta['_job_preferred_qualifications_other'][0] ? $er_JobMeta['_job_preferred_qualifications_other'][0] : 'n/a'); ?>
						</div>

						<!-- POST ACCEPTANCE TESTS -->
						<div class="indent">
							<h4>After Acceptance Tests:</h4>
							<?php $tmp = get_post_meta($post->ID, '_job_acceptance_exams', true); ?>
							<div >
								<ul>
									<?php if ( $tmp ) {
										foreach ($tmp as $value) {
											echo "<li>".$value."</li>";
										} 
									} 
									else {
										echo "<li>None Specified</li>";
									} ?>
								</ul>
							</div>
						</div>
						<!-- DISCLAIMERS -->
						<div class="indent">
							<h4>Disclaimers:</h4>
							<?php $tmp = get_post_meta($post->ID, '_job_legal_disclaimer', true); ?>

							<ul>
								<?php if ( $tmp ) {
									foreach ($tmp as $value) {
										echo "<li>".$value."</li>";
									} 
								} 
								else {
									echo "<li>None Specified</li>";
								} ?>
							</ul>

						</div>

					</div>

					<?php //new tags inserted with jQuery ?>
					<div id="tagsWrapper">
					</div>

					<div class="jobinterest_links">
						<?php 
						if ( is_user_logged_in() ) {
							$WPJM_Updater = new WP_Job_Manager_Bookmarks();
							if ( !$WPJM_Updater->is_bookmarked($post->ID) ){
								echo '<a href="javascript:void(0)" class="pull-left checkSave custSaveBookmark">Save</a>';
							}
							else{
								echo '<a class="pull-left" href="'.site_url().'/preferences/saved-jobs-of-interest/">Saved</a>';
							}
						}
						else{
							echo '<a href="javascript:void(0)" class="pull-left logintosave" data-toggle="modal" data-target="#logintosaveModalWrap">Save</a>';
						}

						if ( user_has_applied_for_job( get_current_user_id(), $post->ID ) ) {
							echo "<span class='label label-success'>Already Applied</span>";
						} 
						else {
							echo "<a href='javascript:void(0);' class='btn btn-sm btn-success open-popup-intersted'>I'm Interested</a>";
						}
						?>

						<div class="text-center">

							<div id="customSavejob"></div>
							<a href="javascript:void(0);"  class="ReportThisJobOpen">Report This Job</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php do_action( 'single_job_listing_end' ); ?>
<?php endif; ?>
</div>


<div class="modal fade <?php if(!is_user_logged_in()){ ?> begin-process-modal <?php } ?>" id="applyModalWrap" tabindex="-1" role="dialog" aria-labelledby="applyModalWrapLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close profile_pic_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php if (is_user_logged_in()) {
					echo "<h3>Apply For the Job</h3>";
				} 
				else{
					echo "<h3>Begin The Process Now</h3>";
				} ?>
			</div>
			<div class="modal-body vscroll">
				<?php 
				if(!is_user_logged_in()){
					?>
					<p>We offer a Free Career Profile where Job Seekers like you can communicate your interest in advertised positions. Recruiters will also be able to locate <strong>you</strong> for NEW (<span>often advertised</span>) openings that you might not be aware of and where you will be able to upload you current Resume to send to Employers to show your interest.</p>
					<div class="process-buttons">
						<h4>Do you have your own Career Profile?</h4>
						<a href="<?php echo site_url(); ?>/login" class="button button button-medium">Yes, I do.</a>
						<a href="<?php echo site_url(); ?>/job-seekers/get-started/" class="button button button-medium">No, I do not.</a>
					</div><!-- process-buttons -->
					<div class="checkbox">
						<label>
							<input type="checkbox" name="checkwithoulogin" id="checkwithoulogin" value="1"> <span>Continue using only a resume upload.</span>
						</label>
					</div>
					<?php
				}else{ ?>
				<div class="clearfix"></div> <?php
				the_widget( 'Jobify_Widget_Job_Apply', array(), $args );
			}
			?>
		</div>
	</div>
</div>
</div>



<div class="modal fade" id="UploadResume" tabindex="-1" role="dialog" aria-labelledby="UploadResumeModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
				<h3>Apply For the Job</h3>
			</div>
			<div class="modal-body vscroll">
				<div class="">
					<form method="post" action="" class="wpcf7-form text-left" id="upload_doc_form">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Name <span>*</span></label>
									<span class="wpcf7-form-control-wrap firstname-to">
										<input type="text" class="form-control" size="40" name="your_name" id="your_name">
									</span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Email <span>*</span></label>
									<span class="wpcf7-form-control-wrap email-to">
										<input type="email" class="form-control" size="40" name="your_email" id="your_email">
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Upload Resume <span>*</span></label>
							<span class="wpcf7-form-control-wrap shareMsg">
								<input type="file" name="upload_resume" id="upload_resume">
								<label id="upload_resume-error" class="error" for="upload_resume" style="display:none;">Please upload a resume.</label>
							</span>
						</div>

						<div class="text-center">
							<input type="hidden" value="" name="thisdocid" id="thisdocid">
							<input type="submit" class="btn btn-primary btn-sm " value="Send" name="upload_doc" id="upload_doc_btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/additional-methods.min.js"></script>
<script type="text/javascript">
jQuery(document).ready( function() {
	jQuery('#checkwithoulogin').on('click', function() {
		jQuery('#applyModalWrap').modal('hide');
		jQuery('#UploadResume').modal('show');
		jQuery(this).prop('checked', false);
	});

	jQuery('#upload_doc_form').validate({
		rules: {
			your_name: {
				required: true
			},
			your_email: {
				required: true,
				email: true
			},
			upload_resume: {
				required: true,
					// accept: "doc/*, docx/*, pdf/*"
					extension: "doc|docx|pdf"
				}
			},
			messages: {
				your_name: {
					required: "Please enter a name."
				},
				your_email: {
					required: 'Please enter an email address.',
					email: 'Please enter a valid email address.'
				},
				upload_resume: {
					required: 'Please upload a resume.',
					extension: "File is not a valid format. Allow only Pdf, Docx and Doc format."
				}	
			},
			submitHandler: function(form){
				jQuery('#upload_resume-error').hide();
				jQuery('#upload_doc_btn').val('Please Wait...').attr('disabled', 'disabled');
				var fd = new FormData();
				var files_data = jQuery('#upload_doc_form #upload_resume'); 

				jQuery.each(jQuery(files_data), function(i, obj) {
					jQuery.each(obj.files,function(j,file){
						fd.append('files[' + j + ']', file);
					})
				});

				var uname = jQuery('#your_name').val(); 
				var uemail = jQuery('#your_email').val(); 
				var postid = '<?php echo $post->ID; ?>';

				fd.append('action', 'applyforjobwithoutlogin');   //Action in inc/custom_functions.php
				fd.append('uname', uname);
				fd.append('uemail', uemail);
				fd.append('postid', postid);
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url("admin-ajax.php"); ?>',
					data: fd,
					contentType: false,
					processData: false,
					success: function(response){
						jQuery('#upload_doc_btn').val('Send').removeAttr('disabled');
						if ( response == 'success') {
							jQuery('#upload_doc_form')[0].reset();
							jQuery('#UploadResume').modal('hide');
							swal({
								title: 'Successfully applied for job.', 
								type: "success",
								confirmButtonClass: "btn-primary btn-sm"
							});
						}
						else{
							jQuery('#upload_resume-error').html(response).show();
						}
					}
				});
			}
		});
});
</script>


<div class="modal fade  begin-process-modal" id="logintosaveModalWrap" tabindex="-1" role="dialog" aria-labelledby="logintosaveModalWrapLabel">		
	<div class="modal-dialog" role="document">		
		<div class="modal-content">		
			<div class="modal-header">		
				<button type="button" class="close profile_pic_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>		
				<h3>SAVE THIS JOB</h3>		
			</div>		
			<div class="modal-body vscroll">		
				<p>Saving a job is reserved for Members only. <br>We do offer a Free Membership & Career Profile to our community where you can save Jobs like this one, follow Employers you like and communicate your interest in advertised positions.  From your profile you will also be able to upload you current Resume and important career documents and send them directly to Employers to show your interest. </p>		
				<div class="process-buttons">		
					<h4>Would you like to start you own<br> Professional Career Profile now?</h4>		
					<a href="<?php echo site_url(); ?>/job-seekers/get-started/" class="button button button-medium custSaveBookmark">Yes, I would.</a>		
					<a href="javascript:void(0)" class="button button button-medium" data-dismiss="modal" aria-label="Close">No, not now.</a>		
				</div>		
			</div>		
		</div>		
	</div>		
</div>


<!-- <div class="modal fade" id="shareModalWrap" tabindex="-1" role="dialog" aria-labelledby="shareModalWrapLabel">
    <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
		      	<button type="button" class="close profile_pic_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    	<img src="<?php //echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
				<h3>Share Job</h3>
				<div class="clearfix"></div>
		        <?php //echo do_shortcode('[contact-form-7 id="3041" title="Share Job"]'); ?>
	      </div>
		</div>
	</div>
</div> -->


<style type="text/css">
	/*.btn-group{margin-top:2rem;}
	.job-overview-title{color:#a12641; font-size:36px; border-bottom:1px solid #808080;}
	.job-manager-form.wp-job-manager-bookmarks-form a.bookmark-notice{ border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px; padding:14px 24px;}
	p.job_tags{display:none;}
	.job-overview-content ul{padding-left:1rem;}*/
	@media (min-width:992px){
		.multiCol{
			column-count:2;
		}
		li{
			-webkit-column-break-inside: avoid;
			page-break-inside: avoid;
			break-inside: avoid;
		}
	}
	</style>

	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('.paginate-links').remove();

		// jQuery(".wp-job-manager-bookmarks-form").insertBefore("#customSavejob");
		jQuery(".wp-job-manager-bookmarks-form").remove();
		jQuery('.image-link').magnificPopup({type:'image'});
		jQuery('.open-popup-link').magnificPopup({
			type:'inline',
			midClick: true
		});

		jQuery('.open-popup-intersted').on('click', function() {
			jQuery('#applyModalWrap').modal('show');
			jQuery('#applyModalWrap #apply-overlay').removeClass('application_details');
		});
		jQuery('.open-popup-sendFriend').on('click', function() {
			jQuery('#shareModalWrap').modal('show');
		});

		jQuery('.open-popup-saveBookmark').on('click', function() {
			jQuery('#saveBookmarkModalWrap').modal('show');
		});
		//jQuery(".job-manager-single-alert-link a").addClass("button button-medium").insertBefore(".wp-job-manager-bookmarks-form");
		//jQuery(".job-manager-single-alert-link a").html('Report This Job').insertAfter("#customSavejob");
		jQuery(".job-manager-single-alert-link a").remove();
	});
</script>

<?php
/*
<div id="alertMoveToModel">
	<?php echo '<div id="removealert"> '. do_shortcode('[job_alerts]') . "</div>"; ?>
	<form method="post" class="job-manager-form wpcf7-form" id="savealertform">
          <p>We are still in BETA for this revolutionary industry specific service! We are currently compiling the very best candidates for jobs all around the country and reaching out to our contacts in the investigation, surveillance, security and risk management fields. While we are building the back end to give us the exact functionality we need to provide you with the best results, please help us help you.</p>
          <p>Fill out the basic Job Alert below and submit your resume so we can begin the process establishing your account profile.&nbsp; As we expand we will keep in constant contact with you and offer you the first opportunities and the biggest discounts on services just for helping us out!</p>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="alert_name"><?php _e( 'Alert Name', 'wp-job-manager-alerts' ); ?></label>
                <div class="field">
                  <input type="text" name="alert_name" value="<?php echo esc_attr( $alert_name ); ?>" id="alert_name" class="input-text" placeholder="<?php _e( 'Enter a name for your alert', 'wp-job-manager-alerts' ); ?>" />
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="alert_keyword"><?php _e( 'Keyword', 'wp-job-manager-alerts' ); ?></label>
                <div class="field">
                  <input type="text" name="alert_keyword" value="<?php echo esc_attr( $alert_keyword ); ?>" id="alert_keyword" class="input-text" placeholder="<?php _e( 'Optionally add a keyword to match jobs against', 'wp-job-manager-alerts' ); ?>" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <?php if ( taxonomy_exists( 'job_listing_region' ) && wp_count_terms( 'job_listing_region' ) > 0 ) : ?>
              <div class="form-group has-feedback">
                <label for="alert_regions"><?php _e( 'Job Region', 'wp-job-manager-alerts' ); ?></label>
                  <?php
                    job_manager_dropdown_categories( array(
                      'show_option_all' => false,
                      'hierarchical'    => true,
                      'orderby'         => 'name',
                      'taxonomy'        => 'job_listing_region',
                      'name'            => 'alert_regions',
                      'class'           => 'alert_regions job-manager-chosen-select form-control',
                      'hide_empty'      => 0,
                      'selected'        => $alert_id ? wp_get_post_terms( $alert_id, 'job_listing_region', array( 'fields' => 'ids' ) ) : $alert_region,
                      'placeholder'     => __( 'Any region', 'wp-job-manager-alerts' )
                    ) );
                  ?>
                  <small><?php echo $selectMultipleMsg; ?></small>
                <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
              </div>
              <?php else : ?>
              <div class="form-group">
                <label for="alert_location"><?php _e( 'Location', 'wp-job-manager-alerts' ); ?></label>
                  <input type="text" name="alert_location" value="<?php echo esc_attr( $alert_location ); ?>" id="alert_location" class="input-text" placeholder="<?php _e( 'Optionally define a location to search against', 'wp-job-manager-alerts' ); ?>" />
              </div>
              <?php endif; ?>
            </div>
            <div class="col-sm-6">
              <?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
              <div class="form-group has-feedback">
				<label for="alert_cats"><?php _e( 'Categories', 'wp-job-manager-alerts' ); ?></label>
				<div class="field">
					<?php
						wp_enqueue_script( 'wp-job-manager-term-multiselect' );
						job_manager_dropdown_categories( array(
							'taxonomy'     => 'job_listing_category',
							'hierarchical' => false,
							'name'         => 'alert_cats',
							'orderby'      => 'name',
							'selected'     => $alert_cats,
							'hide_empty'   => false,
							'placeholder'  => __( 'Any category', 'wp-job-manager' )
						) );
					?>
	                <small><?php echo $selectMultipleMsg; ?></small>
				</div>
					<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			  </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <?php if ( wp_count_terms( 'job_listing_tag' ) > 0 ) : ?>
                <div class="form-group has-feedback">
                  <label for="alert_tags"><?php _e( 'Tags', 'wp-job-manager-alerts' ); ?></label>
                    <?php
                      wp_enqueue_script( 'wp-job-manager-term-multiselect' );

                      job_manager_dropdown_categories( array(
                        'taxonomy'     => 'job_listing_tag',
                        'hierarchical' => false,
                        'name'         => 'alert_tags',
                        'orderby'      => 'name',
                        'selected'     => $alert_tags,
                        'hide_empty'   => false,
                        'placeholder'  => __( 'Any tag', 'wp-job-manager-alerts' )
                      ) );
                    ?>
                  <small><?php echo $selectMultipleMsg; ?></small>
                  <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
                </div>
              <?php endif; ?>
            </div>
            <div class="col-sm-6">
              <div class="form-group has-feedback">
                <label for="alert_job_type"><?php _e( 'Job Type', 'wp-job-manager-alerts' ); ?></label>
                  <select name="alert_job_type[]" data-placeholder="<?php _e( 'Any job type', 'wp-job-manager-alerts' ); ?>" id="alert_job_type" multiple="multiple" class="job-manager-chosen-select">
                    <?php
                      $terms = get_job_listing_types();
                      foreach ( $terms as $term )
                        echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( in_array( $term->slug, $alert_job_type ), true, false ) . '>' . esc_html( $term->name ) . '</option>';
                    ?>
                  </select>
                  <small><?php echo $selectMultipleMsg; ?></small>
                <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group has-feedback">
                <label for="alert_frequency"><?php _e( 'Email Frequency', 'wp-job-manager-alerts' ); ?></label>
                  <select name="alert_frequency" id="alert_frequency">
                    <?php foreach ( WP_Job_Manager_Alerts_Notifier::get_alert_schedules() as $key => $schedule ) : ?>
                      <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $alert_frequency, $key ); ?>><?php echo esc_html( $schedule['display'] ); ?></option>
                    <?php endforeach; ?>
                  </select>
                  <small>How often would you like your career matches to be sent?</small>
                <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
              </div>
            </div>
          </div>
          <div class="text-center">
            <?php wp_nonce_field( 'job_manager_alert_actions' ); ?>
            <input type="hidden" name="alert_id" value="<?php echo absint( $alert_id ); ?>" />
            <input type="submit" class="btn btn-primary btn-sm" name="submit-job-alert" value="<?php _e( 'Save alert', 'wp-job-manager-alerts' ); ?>" />
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          </div>
    </form>
    </div> */
    ?>

    <!-- Modal -->
    <div class="modal fade" id="ReportThisJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-body">
    				<button class="close profile_pic_close_button" type="button" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">×</span>
    				</button>
    				<img class="popup_logo" src="<?php echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg">
    				<h3>Report This Job</h3>
    				<div class="clearfix"></div>
    				<?php echo do_shortcode('[contact-form-7 id="4976" title="Report this job" html_id="report_job" html_class="forward_modal_form" ]'); ?>
    				<!-- <div id="customAlertform"></div> -->
    			</div>
    		</div>
    	</div>
    </div>


    <script type="text/javascript">
    jQuery(document).ready( function() {

    	jQuery('.ReportThisJobOpen').on('click', function(){
    		var job_title = '<?php echo get_the_title() ?>';
    		jQuery('input[name="job_title"]').val(job_title);
    		jQuery('#ReportThisJob').modal('show');
    	});

    	setTimeout( function() {
    		jQuery('#alertMoveToModel').appendTo('#customAlertform');
    		jQuery('#removealert').remove();
    	}, 500); 

    	jQuery('input[name="submit-job-alert"]').on('click', function() {

    		jQuery('#savealertform').validate({
    			rules: {
    				alert_name: "required",
    			},
    			messages: {
    				alert_name: "Please enter an alert name.",
    			},
    			submitHandler: function(form) {
    				jQuery.ajax({
    					type: 'POST',
    					url: '<?php echo admin_url("admin-ajax.php"); ?>',
    					dataType: 'json',
    					data:{
							action: 'saveAlertforJobs', //Action in inc/edit_basic_info.php file
							getdata: jQuery("#savealertform").serialize()
						},
						success:function(data){
							if ( data.msg == 'success' ) {
								jQuery.notify("Job alert successfully added !", "success");
							}
							else{
								jQuery.notify("Something wrong. Please try again !", "error");
							}
						}
					});
    			}
    		});
    	});
    });


	/*var alert_name 		= jQuery('input[name="alert_name"]').val();
				var alert_keyword   = jQuery('input[name="alert_keyword"]').val();
				
				var alert_regions   = []; 
				jQuery('select[name="alert_regions[]"] option:selected').each( function() {
					alert_regions.push( jQuery(this).val() );
				});

				var alert_cats 		= []; 
				jQuery('select[name="alert_cats[]"] option:selected').each( function() {
					alert_cats.push( jQuery(this).val() );
				});

				var alert_tags 		= []; 
				jQuery('select[name="alert_tags[]"] option:selected').each( function() {
					alert_tags.push( jQuery(this).val() );
				});

				var alert_job_type  = []; 
				jQuery('select[name="alert_job_type[]"] option:selected').each( function() {
					alert_job_type.push( jQuery(this).val() );
				});

var alert_frequency = jQuery('select[name="alert_frequency"]').val();*/
				/*alert_name: alert_name,
						alert_keyword: alert_keyword,
						alert_regions: alert_regions,
						alert_cats: alert_cats,
						alert_tags: alert_tags,
						alert_job_type: alert_job_type,
						alert_frequency: alert_frequency,*/

						</script>

						<!-- Save Bookmark -->
						<script type="text/javascript">
						jQuery(document).ready( function(){
							jQuery('.jobinterest_links').on('click', '.custSaveBookmark', function() {
								var _this = jQuery('.checkSave');
								_this.removeClass('custSaveBookmark');
								var postid = '<?php echo $post->ID; ?>';
								var userid = '<?php echo get_current_user_id(); ?>';
								jQuery.ajax({
									type: 'POST',
									url: '<?php echo admin_url("admin-ajax.php") ?>',
									dataType: 'json',
									data: {
					action: 'saveCustomBookmarks', //Action in inc/edit_basic_info.php
					postid: postid,
					userid: userid
				},
				success:function(data){
					if ( data.msg == 'success' ) {
						var sveurl = "<?php echo site_url(); ?>/preferences/saved-jobs-of-interest/";
						_this.html('Saved');
						_this.attr('href', sveurl);

						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>SUCCESS! This Job has been successfully saved!  You will be able to find it later by going to your Saved Jobs of Interest from your Dashboard or from Preferences.</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
						//jQuery.notify('Job successfully saved!', 'success');
					}
					else if(data.msg == 'exist'){
						//jQuery.notify('Job already saved!', 'warning');
						_this.html('Saved');
						swal({
							title: "Warning", 
							html: true,
							text: "<span class='text-center'>Job already saved. <br> To check your saved Job <a href='"+sveurl+"'>Click Here</a></span>",
							type: "warning",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
					else{
						_this.addClass('custSaveBookmark');
						swal({
							title: "Error", 
							html: true,
							text: "<span class='text-center'>Something Wrong. Please try again!</span>",
							type: "warning",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				}
			});
});
});
</script>


<?php
$user_id = get_current_user_id();
if(is_user_logged_in()){
	$Fname =  get_user_meta($user_id, 'first_name', true);
	$Lname =  get_user_meta($user_id, 'last_name', true);
	$Email =  get_user_meta($user_id, 'pmpro_bemail', true);
}
else{
	$Fname = '';
	$Lname = '';
	$Email ='';
}
?>
<!-- Share Job -->
<!-- Forward Job Pop_up -->

<div class="modal fade" id="shareModalWrap" tabindex="-1" role="dialog" aria-labelledby="shareModalWrapLabel">
	<div class="vertical-alignment-helper">
		<div role="document" class="modal-dialog modal-lg vertical-align-center">
			<div class="modal-content">
				<div class="modal-body">
					<button aria-label="Close" data-dismiss="modal" class="close profile_pic_close_button" type="button"><span aria-hidden="true">×</span>
					</button>
					<img class="popup_logo" src="<?php echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg">
					<h3>Share Job</h3>
					<div class="clearfix"></div>

					<form method="post" action="" class="wpcf7-form text-left" id="forward_modal_form">
						<h4>Send To</h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label>First Name (required)</label>
									<span class="wpcf7-form-control-wrap firstname-to">
										<input type="text" class="form-control" size="40"  name="firstname_to" id="firstname_to">
									</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Last Name (required)</label>
									<span class="wpcf7-form-control-wrap lastname-to">
										<input type="text"  class="form-control" size="40"  name="lastname_to" id="lastname_to">
									</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Email (required)</label>
									<span class="wpcf7-form-control-wrap email-to">
										<input type="email"  class="form-control" size="40"  name="email_to" id="email_to">
									</span>
								</div>
							</div>
						</div>
						<h4>From</h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label>Your First Name (required)</label>
									<span class="wpcf7-form-control-wrap firstname-from">
										<input type="text"  class="form-control" size="40"  name="firstname_from" id="firstname_from" value="<?php echo $Fname; ?>">
									</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Your Last Name (required)</label>
									<span class="wpcf7-form-control-wrap lastname-from">
										<input type="text"  class="form-control" size="40"  name="lastname_from" id="lastname_from" value="<?php echo $Lname; ?>">
									</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Your Email (required)</label>
									<span class="wpcf7-form-control-wrap email-from">
										<input type="email"   class="form-control" size="40"  name="email_from" id="email_from" value="<?php echo $Email; ?>">
									</span>
								</div>
							</div>
						</div>
						<h4>Email Message</h4>
						<div class="form-group">
							<label>Comments to be included in email message:</label>
							<span class="wpcf7-form-control-wrap shareMsg">
								<textarea  class="form-control" rows="10" cols="40" name="shareMsg" id="shareMsg"></textarea>
							</span>
						</div>
						<p>
							<input type="hidden" value="theVal" id="shareJobURL" name="shareJobURL">
						</p>
						<div class="text-center">
							<input type="hidden" value="" name="thisjobid">
							<input type="submit" class="btn btn-primary btn-sm " value="Send" name="forward_job">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
jQuery(document).ready( function(){

	jQuery('.forwardThisjob').on('click', function() {
		var _this = jQuery(this);
		var jobid = _this.attr('jobid');
		jQuery('input[name="thisjobid"]').val(jobid);
		jQuery('#shareModalWrap').modal('show');
	});

	jQuery('input[name="forward_job"]').on('click', function() {
		var _this = jQuery(this);
		jQuery("#forward_modal_form").validate({
			rules:{
				firstname_to:{
					required:true
				},
				lastname_to:{
					required:true
				},
				email_to:{
					required:true
				},
				firstname_from:{
					required:true
				},
				lastname_from:{
					required:true
				},
				email_from:{
					required:true
				},
          /*shareMsg:{
              required:true
            }*/
          },
          messages:{
          	firstname_to:{
          		required:"Please enter first name"
          	},
          	lastname_to:{
          		required:"Plese enter last name"
          	},
          	email_to:{
          		required:"Please enter an email address"
          	},
          	firstname_from:{
          		required:"Please enter first name"
          	},
          	lastname_from:{
          		required:"Please enter last name"
          	},
          	email_from:{
          		required:"Please enter an email address"
          	},
          /*shareMsg:{
              required:"Please enter your messages"
            }*/
          },
          submitHandler: function(form) {
          	_this.attr('disabled', 'disabled');
          	_this.val('Please Wait...');
          	var to_first_name = jQuery("#firstname_to").val();
          	var to_last_name  = jQuery("#lastname_to").val();
          	var to_email      = jQuery("#email_to").val();
          	var from_firstname = jQuery("#firstname_from").val();
          	var from_lastname = jQuery("#lastname_from").val();
          	var from_email    = jQuery("#email_from").val();
          	var share_message  = jQuery("#shareMsg").val();
          	var jobid  = jQuery("input[name='thisjobid']").val();
          	jQuery.ajax({
          		type: 'POST',
          		url: '<?php echo admin_url("admin-ajax.php"); ?>',
          		dataType: 'json',
          		data:{
              action: 'forwardThisJob', //Action in inc/edit_basic_info.php file
              'to_first_name': to_first_name,
              'to_last_name' : to_last_name,
              'to_email'     : to_email,
              'from_firstname': from_firstname,
              'from_lastname': from_lastname,
              'from_email':   from_email,
              'share_message': share_message,
              'jobid': jobid
            },
            success:function(data){
            	if ( data.msg == 'success' ) {
            		jQuery.notify("SUCCESS! You have successfully forwarded this Job Opening! Even if the Job isn't right for you, you can build your professional network by helping someone you know imporve their long term career goals. Great Job! ", "success");
            		jQuery('#forward_modal_form')[0].reset();
            		_this.removeAttr('disabled');
            		_this.val('Send');
            	}
            	else{
            		jQuery.notify("Something wrong. Please try again !", "error");
            		_this.removeAttr('disabled');
            		_this.val('Send');
            	}
            }
          });
}
});
});
});

/*........Validation for Report this job form........*/
jQuery(document).ready(function(){
	
	jQuery("#report_job").validate({
		rules:{
			report_first_name:{
				required : true
			},
			report_last_name:{
				required : true
			},
			report_email:{
				required : true
			},
			report_subject:{
				required :true
			},
			report_message: {
				required: true
			}
		},
		messages:{
			report_first_name:{
				required : "Plese enter first name"
			},
			report_last_name:{
				required : "Please enter last name"
			},
			report_email:{
				required : "Please enter an email address"
			},
			report_subject:{
				required : "Please enter subject"
			},
			report_message:{
				required:"Please enter your messages"
			}
		}
	});

});
jQuery(document).on('mailsent.wpcf7', function () {
	jQuery.ajax({
		type: 'POST',
		url: '<?php echo admin_url("/admin-ajax.php/"); ?>',
		data: {
			action: 'saveactivityaftersendreport',
			postid: '<?php echo get_the_ID(); ?>'
		},
		success: function(res){

		}
	});
});
</script>

<script>

jQuery("p.job_tags").appendTo("#tagsWrapper");

</script>

<?php
// print_r ($er_JobMeta);
?>

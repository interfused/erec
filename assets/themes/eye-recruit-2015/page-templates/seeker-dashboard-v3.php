<?php
/**
 * Template Name: Job Seeker Dashboard (v3)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.5
 */
 
get_header(); ?>
<?php
if(is_user_logged_in()){
	$user_id = get_current_user_id();
	$data = get_userdata($user_id);

	//how much complate profile
	$profileBasicQTotal		= 0;
	$profileBasicQAnswered	= 0;
	$totalper 				= 0;
	$values = get_cimyFieldValue($user_id, false);
	if($values){

		$i=0;
		foreach ($values as $value) { 
			$profileBasicQTotal++;
			if($value['VALUE'] && $value['VALUE'] != "Select" && $value['VALUE'] != "Select all that apply"){
				$valStr=cimy_uef_sanitize_content($value['VALUE']);
				$profileBasicQAnswered++;
			}

		}
	$totalper =  floor(($profileBasicQAnswered/$profileBasicQTotal)*100);
	}

}else{
	wp_redirect(site_url());
}
 ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/nouislider/nouislider.min.css"  />
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/nouislider/nouislider.min.js" type="text/javascript"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/notify.js" type="text/javascript"></script>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="dashboard_sec">
		<div class="container">
			<div class="name_sec">
				<h2><?php echo get_user_meta($user_id,'first_name',true);  ?> <?php echo get_user_meta($user_id,'last_name',true);  ?></h2>
				<h5><strong>Recruit ID :</strong> <?php echo $user_id;  ?></h5>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-12 col-lg-push-3 col-md-push-0">
					<div class="profile_box">
						<div class="row">
							<div class="col-sm-9">
								<?php
								if ( has_wp_user_avatar($user_id) ) {
									echo get_wp_user_avatar($user_id, 'thumbnail'); 
								}else{
									?>
 									<img src="<?php echo site_url();  ?>/assets/uploads/wp-user-avatar/wp-user-avatar1a.png" class="thumbnail">
									<?php
								}
								 ?>
								<div class="profile_cont">
									<ul class="view_points">
										<li><strong>Member Since</strong> <?php echo  date( "F d, Y", strtotime($data->user_registered)); ?></li>
										<li><strong>Membership Type</strong> : Free <a href="<?php echo site_url(); ?>/job-seekers/plans-pricing/" class="btn btn-primary btn-sm">Upgrade Now</a></li>
										<li><strong>Last Log In</strong> :<?php echo get_last_login($user_id); ?></li>
										<!-- <li><strong>Last Modification</strong> : 23/10/2016 at 4:17pm</li> -->
									</ul>
								</div>
							</div>
							<div class="col-sm-3">
								<?php get_template_part( 'seeker_dasboard_templates/content', 'badges' ); ?>

							</div>
						</div>
					</div>
					<div class="navigation">
						<div class="section_title">
							<h3>Navigation</h3>
						</div>
						<div class="nav_items">
							<div class="row">
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Search Jobs</h6>
									<i class="fa fa-search"></i>
									<a href="<?php echo site_url();  ?>/job-seekers/find-a-job/" class="btn btn-default btn-block">View</a>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Saved</h6>
									<i class="fa fa-floppy-o"></i>
									<a href="<?php echo site_url();  ?>/my-bookmarks/" class="btn btn-default btn-block">View</a>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf nav_noti">
									<h6>Background Verifications</h6>
									<i class="nav_icons verification_icon"></i>
									<a href="<?php  echo site_url(); ?>/job-seekers/edit-profile/?m=docs-bgchecks" class="btn btn-default btn-block">View</a>
									<span>1</span>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Connect</h6>
									<i class="nav_icons connect_icon"></i>
									<a href="javascript:void(0);" class="btn btn-default btn-block">View</a>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Resume</h6>
									<i class="nav_icons resume_icon"></i>
									<a href="<?php echo site_url(); ?>/job-seekers/submit-resume/" class="btn btn-default btn-block">View</a>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf nav_noti">
									<h6>Referrals</h6>
									<i class="nav_icons referrals_icon"></i>
									<a href="javascript:void(0);" class="btn btn-default btn-block">View</a>
									<span>3</span>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Cover Letters</h6>
									<i class="fa fa-file-text-o"></i>
									<a href="javascript:void(0);" class="btn btn-default btn-block">View</a>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>References</h6>
									<i class="nav_icons references_icon"></i>
									<a href="javascript:void(0);" class="btn btn-default btn-block">View</a>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Education</h6>
									<i class="fa fa-book"></i>
									<a href="javascript:void(0);" class="btn btn-default btn-block">View</a>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Certificates</h6>
									<i class="nav_icons certificates_icon"></i>
									<a href="<?php  echo site_url(); ?>/job-seekers/edit-profile/?m=docs-certs" class="btn btn-default btn-block">View</a>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Honors and Awards</h6>
									<i class="nav_icons awards_icon"></i>
									<a href="javascript:void(0);" class="btn btn-default btn-block">View</a>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf">
									<h6>Licensing</h6>
									<i class="nav_icons license_icon"></i>
									<a href="javascript:void(0);" class="btn btn-default btn-block">View</a>
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-xs-6 devicefull">
								<a href="#" class="btn btn-primary btn-lg btn-block">
									Connect With <strong>Industry Recruiters</strong>
								</a>
							</div>
							<div class="col-xs-6 devicefull">
								<a href="#" class="btn btn-default btn-lg btn-block">
									Research <strong>Employers</strong>
								</a>
							</div>
						</div> -->
					</div>
					<div class="assessments">
						<div class="section_title">
							<h3>Self Assessments</h3>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="<?php echo site_url();  ?>/job-seekers/tasks-assessment/" class="asses_box">
									<i class="fa fa-tasks"></i>
									<h5>Tasks</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="<?php echo site_url();  ?>/job-seekers/technology-assessment/" class="asses_box">
									<i class="fa fa-mobile"></i>
									<h5>Technology</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="<?php echo site_url();  ?>/job-seekers/knowledge-assessment/" class="asses_box">
									<i class="fa fa-book"></i>
									<h5>Kwonledge</h5>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="<?php echo site_url();  ?>/job-seekers/skills-assessment/" class="asses_box">
									<i class="fa fa-pencil"></i>
									<h5>Skills</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="<?php echo site_url();  ?>/job-seekers/abilities-assessment/" class="asses_box">
									<i class="fa fa-check-square-o"></i>
									<h5>Abilities</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="<?php echo site_url();  ?>/job-seekers/work-activities-assessment/" class="asses_box">
									<i class="fa fa-briefcase"></i>
									<h5>Work</h5>
								</a>
							</div>
						</div>
					</div>

					<div class="support_serv">
						<div class="section_title">
							<h3>Services</h3>
						</div>
						<div class="row">
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url();  ?>/job-seekers/what-we-do-for-you/resume-services/">
									<img src="<?php  site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Resume Services</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="#">
									<img src="<?php  echo site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Interview Coaching</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="#">
									<img src="<?php echo  site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Salary Negotiation</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Contract Opportunities</h6>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Onboarding Orientation</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Transition Support</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php  echo site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Transition Support</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php  echo site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Performance Consulting</h6>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-lg-pull-6 col-md-pull-0">
					<div class="sidebar">
						<div class="dark_box">
							<ul class="view_points">
								<li><strong>Profile Views</strong> : 0</li>
								<li><strong>Favorite</strong> : 0</li>
								<li><strong>Following Career</strong> : 0</li>
							</ul>
						</div>
						<div class="profile_pogress">
							<div class="progress">
							  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $totalper; ?>"
							  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $totalper; ?>%">
							    <span><big><?php echo $totalper; ?>%</big> Profile Complete</span>
							  </div>
							</div>
						</div>
						<div class="light_box visibility">
							<h4 class="sidebar_title">Profile Visibility</h4>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'profile_visibility' ); ?>
						</div>
						<a href="javascript:void(0);" class="btn btn-primary btn_big  btn-lg" data-toggle="modal" data-target="#invite_a_colleague"><i class="fa fa-search"></i> Invite a Colleague</a>
						<a href="javascript:void(0);" class="btn btn-default btn_big  btn-lg" data-toggle="modal" data-target="#feedback"><i class="fa fa-comments-o"></i> Feedback</a>
						<a href="<?php echo site_url();  ?>/faqs/" class="btn btn-default btn_big  btn-lg"><i class="fa fa-question-circle"></i> FAQ</a>
						<div class="light_box">
							<h4 class="sidebar_title"><i class="fa fa-lightbulb-o"></i> Tips</h4>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'seekertips' ); ?>
						</div>
						<div class="light_box msurvey">
							<h4 class="sidebar_title">Monthly Survey</h4>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'monthly_survey' ); ?>
						</div>
						<?php the_field('right_side_add'); ?>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-lg-pull-0 col-md-pull-0">
					<div class="sidebar right_sidebar">
						<div class="light_box recruiter_box">
							<h4 class="sidebar_title">Recuriter</h4>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'recuriter' ); ?>
						</div>
						<a href="javascript:void(0);" class="btn btn-default btn_big btn-lg"><i class="fa fa-search"></i> <span>Premium Members <strong><br>“The Dirty Thirty”</strong></span></a>
						<a href="javascript:void(0);" class="btn btn-default btn_big btn-lg"><i class="fa fa-comments-o"></i> <span>Unlimited Members <strong><br>“25 after 5”</strong></span></a>
						<div href="javascript:void(0);" class="btn_big btn-lg back_veribtn"><i class="fa fa-question-circle"></i> <p>Background Verifications Services <br> <a href="javascript:void(0);" class="btn btn_white">Run Now</a></p></div>
						<div class="light_box last_msurvey">
							<h4 class="sidebar_title">Last Monthly Survey</h4>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'last_monthly_survey' ); ?>
						</div>
						<div class="light_box recommendations">
							<h4 class="sidebar_title">Job Recommendations</h4>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'Job_recommendations' ); ?>

						</div>
						<?php the_field('left_side_add'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="feature_ad specialoffers_ad">
				<?php the_field('bottum_offer_image_link'); ?>
			</div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<!-- <?php //get_template_part( 'content', 'page' ); ?>-->
		</div><!-- #content -->

		<?php //do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('seekerdasboard'); ?>
<style type="text/css">
#slider-toggle {
	height: 100px;
}
#slider-toggle.off .noUi-handle {
	border-color: red;
}

</style>
<?php 
$value = get_cimyFieldValue($user_id,'PROFILE_VISIBILITY');
if($value == 'anonymous'){
	$starts = 0;

}elseif ($value =='Private') {
	$starts = 1;
}else{
	$starts = 2;
}

 ?>
<script type="text/javascript">
var toggleSlider = document.getElementById('slider-toggle');
noUiSlider.create(toggleSlider, {
	orientation: "vertical",
	start:<?php echo $starts;  ?>,
	range: {
		'min': [0,1,2],
		'max': 2
	}
	/*format: wNumb({
		decimals: 0
	})*/
})

toggleSlider.noUiSlider.on('update', function( values, handle ){
	if ( values[handle] === '0.00' ) {
		toggleSlider.className += ' off';
		jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url:'<?php echo site_url();  ?>/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'visibility', //calls wp_ajax_nopriv_ajaxlogin
	                'status': 'anonymous', 
	                'userid': <?php  echo $user_id;  ?> },
	            success: function(data){
	                if (data.success == true){
	                	jQuery.notify("Access granted", "success");
	                }else{
	                
	                }
	            }
	        });
	} else if(values[handle] === '1.00'){
		jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url:'<?php echo site_url();  ?>/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'visibility', //calls wp_ajax_nopriv_ajaxlogin
	                'status': 'Private', 
	                'userid': <?php  echo $user_id;  ?> },
	            success: function(data){
	                if (data.success == true){
	                	//alert(data.message);
	                }else{
	                
	                }
	            }
	        });
	}
	else if(values[handle] === '2.00'){
		jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url:'<?php echo site_url();  ?>/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'visibility', //calls wp_ajax_nopriv_ajaxlogin
	                'status': 'Open', 
	                'userid': <?php  echo $user_id;  ?> },
	            success: function(data){
	                if (data.success == true){
	                	//alert(data.message);
	                }else{
	                
	                }
	            }
	        });
	}
	else {
		toggleSlider.className = toggleSlider.className.slice(0, -4);
	}
});


</script>
<div class="modal fade" id="sendamail" tabindex="-1" role="dialog" aria-labelledby="sendamailLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	<!-- <textarea name="seekersend"></textarea> -->
      	<?php  echo do_shortcode('[contact-form-7 id="4458" title="Recuriter Send mail"]'); ?>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save and close</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedbackLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	<!-- <textarea name="feedback"></textarea> -->
      	<?php   echo do_shortcode('[contact-form-7 id="4457" title="Feedback seeker"]'); ?>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save and close</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="invite_a_colleague" tabindex="-1" role="dialog" aria-labelledby="invite_a_colleagueLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	<div id="userdetail_all_fields">
			<div id="userdetail_pr_1" class="edit-main-dv">
				<div class="form-group row">
					<label class="col-sm-3 control-label" for="fname">Name</label>
					<div class="col-sm-9">
						<input id="fname_1" class="regular-text code form-control" name="fname[]" type="text" />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label" for="user_email">Email</label>
					<div class="col-sm-9">
						<input id="user_email_1" class="regular-text code form-control" name="user_email[]" type="text" />
					</div>
				</div>
			</div>
		</div>
		<div class="field col-md-6 col-sm-12 col-md-offset-4 remove_btn">
			<button id="userdetail_add_more" count="1" class="userdetail_add_more btn btn-info btn-effect sky_btn" type="button">Add More <i class="fa fa-plus"></i></button>
		</div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button id="inv_a_coll" type="button" class="btn btn-primary">Save and close</button>
      </div>
    </div>
  </div>
</div>
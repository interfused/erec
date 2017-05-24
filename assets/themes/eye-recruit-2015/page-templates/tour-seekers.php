<?php
/**
 * Template Name: Seeker Tour
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
 ////DEV TO DELETE
if ( is_user_logged_in() ) {
	$user_id = get_current_user_id();
	$user = get_userdata($user_id);
	$fname = $user->first_name;
	$lname = $user->last_name;
	global $wpdb;
	$tablename = $wpdb->prefix.'last_view';
	$wpdb->insert(
		$tablename,
		array('date_time' => time(), 'meta_other' => $user_id),
		array('%s', '%s')
	);

	if ( isset($_REQUEST['sm']) ) {
		update_user_meta($user_id, 'guidenewUserTour', 'Yes');
	}
}
else{
	if ( isset($_REQUEST['rec']) ) {
		$user_id = multi_base64_decode($_REQUEST['rec']);
		$user = get_userdata($user_id);
		$fname = $user->first_name;
		$lname = $user->last_name;

		if ( $user === false ) {
		   echo wp_redirect( site_url() );
		}
	}
	else{
		 echo wp_redirect( site_url() );
	}
}


get_header(); 
	?>

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title">Dashboard <?php //the_title(); ?></h1>
	</header>
	<section class="dashboard_sec" id="body-container" pagevtoururl="<?php echo get_stylesheet_directory_uri(); ?>/page-templates/tour-instructions.php">
		<!-- <div class="notification_sec">
			<div class="container">
				<i class="fa fa-thumbs-up"></i>
				<div class="noti_cont">
					<div class="row">
						<div class="col-sm-9 col-md-10">
							<h4>Thank you for Choosing EyeRecruit!</h4>
							<p>Now sit and relax and give us some moments to process your application. Within a few hours, you will get a call from us to verify your details.</p>
						</div>
						<div class="col-sm-3 col-md-2 text-right">
						 <a class="btn btn_white" href="javascript:void(0);">Update</a> 
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="container">
			<div class="name_sec">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<h2>Dummy Name</h2>
						<h5><strong>Recruit ID :</strong> 3585</h5>
					</div>
					<!-- <div class="col-md-2 col-sm-6">
						<p><a id="start_tour" href="javascript:void(0);" class="btn btn-sm btn-primary">Take a tour</a></p>
					</div> -->
					<div class="col-md-3 col-sm-6">
						<p><strong>Member Since : </strong>August 23rd, 2016</p>
					</div>
					<div class="col-md-3 col-sm-6">
						<p class="text-center" ><strong>Membership Type : </strong>Plus <a href="javascript:void(0);" id="tourUpgrade" class="btn btn-sm btn-primary">Upgrade</a></p>
					</div>
					<div class="col-md-3 col-sm-6">
						<p class="text-right"><strong>Last Log In : </strong>Yesterday at 4:17pm</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-12 col-lg-push-3 col-md-push-0">
					<div class="profile_box">
						<div class="thumbnail">
							<a id="tourAvatar" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
							<?php
						/*	if ( has_wp_user_avatar($user_id) ) {
								echo get_wp_user_avatar($user_id, ''); 
							}else{
								?>
								<img src="<?php echo site_url();  ?>/assets/uploads/2016/08/EyeRecruit_Avitar.png" height="225px" width="190px">
								<?php
							}*/
							?>
							<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/EyeRecruit_Avitar.jpg" height="225px" width="190px">
						</div>

						<!-- <img src="<?php echo site_url();  ?>/assets/uploads/2016/09/userprofile.jpg" class="thumbnail"> -->
						<div class="profile_cont">
							<ul class="view_points row">
								<li class="col-xs-6 devicefull"><strong>Industry Sector : </strong>Security</li>
								<li class="col-xs-6 devicefull"><strong>Years of Service : </strong>Over fifteen years</li>
								<li class="col-xs-6 devicefull"><strong>Desired Opportunity : </strong>Long-term Contract</li>
								<li class="col-xs-6 devicefull"><strong>Current Employer : </strong>No</li>
								<li class="col-xs-6 devicefull"><strong>Employment Status : </strong>Actively Looking</li>
								<li class="col-xs-6 devicefull"><strong>Closest Metropolitan Area : </strong>New York</li>
								<li class="col-xs-6 devicefull"><strong>Career Level : </strong>Senior Executive</li>
								<li class="col-xs-6 devicefull"><strong>Current Income : </strong>Under $40k</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="text-center">
							<a id="tourProfileDetail" class="btn btn-primary btn-sm" href="javascript:void(0);">Update Your Current Status</a>
							<a id="tourEmployeerView" href="javascript:void(0);" class="btn btn-primary btn-sm">See Employer's Point of View</a>
						</div>
					</div>
					<div class="navigation">
						<div class="section_title">
							<h3>Navigation</h3>
						</div>
						<div class="nav_items">
							<div class="row">
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourBackMang">
									<h6>Background Management</h6>
									<i class="nav_icons backmanage_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourIntMang">
									<h6>Video Interview Management</h6>
									<i class="nav_icons videointer_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf nav_noti" id="tourCarrOpp">
									<h6>Career Opportunities</h6>
									<i class="nav_icons verification_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
									<span>1</span>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourCommunCent">
									<h6>Communications Center</h6>
									<i class="nav_icons connect_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourResume">
									<h6>Resume</h6>
									<i class="nav_icons resume_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf nav_noti" id="tourReferrals">
									<h6>Referrals</h6>
									<i class="nav_icons referrals_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
									<span>3</span>
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourCoverLett">
									<h6>Cover Letters</h6>
									<i class="nav_icons coverletter_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourReferences">
									<h6>References</h6>
									<i class="nav_icons references_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourEducation">
									<h6>Education</h6>
									<i class="nav_icons education_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourCertifi">
									<h6>Certificates</h6>
									<i class="nav_icons certificates_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourHonoAndAwa">
									<h6>Honors and Awards</h6>
									<i class="nav_icons awards_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
								<div class="col-sm-3 col-xs-6 devicehalf" id="tourLicensing">
									<h6>Licensing</h6>
									<i class="nav_icons license_icon"></i>
									<!-- <a href="javascript:void(0);" class="btn btn-default btn-block">View</a> -->
								</div>
							</div>
						</div>
					</div>
					<div class="assessments">
						<div class="section_title">
							<h3>Self Assessments</h3>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourAbiliti" class="asses_box">
									<i class="fa fa-check-square-o"></i>
									<h5>Abilities</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box" id="tourKnowl">
									<i class="fa fa-book"></i>
									<h5>Knowledge</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box" id="tourTechTran">
									<i class="fa fa-mobile"></i>
									<h5>Tech & Trends</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box" id="tourSkills">
									<i class="fa fa-pencil"></i>
									<h5>Skills</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box asses_import" id="tourWork">
									<i class="fa fa-briefcase"></i>
									<h5>Work</h5>
									<!-- <span class="torch"></span> -->
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box asses_import" id="tourTasks">
									<i class="fa fa-tasks"></i>
									<h5>Tasks</h5>
									<!-- <span class="torch"></span> -->
								</a>
							</div>
						</div>
					</div>

					<div class="support_serv">
						<div class="section_title">
							<h3>Support Services </h3>
						</div>
						<div class="row">
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourResSer">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Resume <br>Services</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourIntCoa">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-interview.png" class="img-responsive">
									<h6>Interview <br>Coaching</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourSalNav">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icons-salary.png" class="img-responsive">
									<h6>Salary <br>Negotiation</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourContOpp">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-negotiation.png" class="img-responsive">
									<h6>Contract <br>Opportunities</h6>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourOnbOri">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-training.png" class="img-responsive">
									<h6>Onboarding <br>Orientation</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourTanSupp">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-direction.png" class="img-responsive">
									<h6>Transition <br>Support</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourTanSupport">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-truck.png" class="img-responsive">
									<h6>Relocation <br>Services</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="javascript:void(0);" id="tourPerCons">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icons-performance.png" class="img-responsive">
									<h6>Performance <br>Consulting</h6>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-lg-pull-6 col-md-pull-0">
					<div class="sidebar">
						<div class="dark_box">
							<div class="sidebar_title">
								<h4>Operating Statistics</h4>
							</div>
							<ul class="view_points">
								<li><strong>127 </strong>- Times profile has been viewed.</li>
								<li><strong>12 </strong>- Times profile added to favorites.</li>
								<li><strong>16 </strong>- Times profile was forwarded.</li>
								<li><strong>6 </strong>- Currently following your career.</li>
							</ul>
							<div class="profile_pogress">
								<div class="progress" aria-describedby="profile_process">
								  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%"></div>
								</div>
								<div class="text-center" id="profile_process">Profile is <strong>90%</strong> Complete</div>
							</div>
						</div>
						<div id="tourProVisi" class="light_box visibility">
							<div class="sidebar_title">
								<span class="title_icon visibility_icon"></span>
								<h4>Visibility Settings</h4>
							</div>
							<ul>
								<li class="visibility_everyone active">Visible to Everyone <span></span></li>
								<li class="visibility_only">Recruiters Only <span></span></li>
								<li class="visibility_invisible">You’re Invisible <span></span></li>
							</ul>
						</div>
						<div class="light_box chlng_quest" id="tourPollVo">
							<div class="sidebar_title">
								<span class="title_icon challenge_icon"></span>
								<h5>What is the biggest challenge you are facing today in your Career?</h5>
							</div>
							<div class="chlng_options"> 
								<div class="radio"> 
									<label> 
										<input type="radio" checked="" value="option1" id="challengeRadio1" name="challengeRadio"><span>Not being paid enough</span>
									</label> 
								</div>
								<div class="radio"> 
									<label> 
										<input type="radio" checked="" value="option1" id="challengeRadio2" name="challengeRadio"><span>No chance for advancement</span>
									</label> 
								</div>
								<div class="radio"> 
									<label> 
										<input type="radio" checked="" value="option1" id="challengeRadio3" name="challengeRadio"><span>Over qualified / bored</span>
									</label> 
								</div>
								<div class="radio"> 
									<label> 
										<input type="radio" checked="" value="option1" id="challengeRadio4" name="challengeRadio"><span>I am not sure</span>
									</label> 
								</div>
							</div>
							<div class="text-center">
								<a href="javascript:void(0);" class="btn btn-primary">Submit</a>
							</div>
							<?php //echo do_shortcode("[poll id='3']"); ?>
						</div>
						<div class="light_box quick_links">
							<div class="sidebar_title">
								<span class="title_icon quicklink_icon"></span>
								<h4>Quick Links</h4>
							</div>
							<ul>
								<li><a href="javascript:void(0);" id="tourTellPro">Tell us about a Problem </a></li>
								<li><a href="javascript:void(0);" id="tourGiveFeed">Give us your Fedback</a></li>
								<li><a href="javascript:void(0);" id="tourInviteFri">Invite Friends & Colleagues</a></li>
								<li><a href="javascript:void(0);" id="tourPrefQu">Preferences</a></li>
								<li><a href="javascript:void(0);" id="tourResourQu">Resources</a></li>
								<li><a href="javascript:void(0);" id="tourVisitHelp">Visit the Help Center</a></li>
								<li><a href="javascript:void(0);" id="tourTellUsFrQu">Tell us your story</a></li>
								<li><a href="javascript:void(0);" id="tourMyNetworh">My networks</a></li>
							</ul>
						</div>
						<div class="light_box tips">
							<div class="sidebar_title">
								<span class="title_icon tips_icon"></span>
								<h4>Tips #424</h4>
							</div>
							<p>The tips will be something to catch the users eye and get them to think about something or to take an action and do something. This will also be something that is done from the admin Dashboard side.</p>
						</div>
						<div class="light_box snap_shot" id="tourSnapShot">
							<div class="sidebar_title">
								<span class="title_icon snapshot_icon"></span>
								<h4>Snap Shot</h4>
							</div>
							<ul>
								<li><span>Spoken Language(s) :</span>Mandarin</li>
								<li><span>Willing to Relocate :</span>Yes, Anywhere</li>
								<li><span>Military Service :</span>Coast Guard</li>
								<li><span>Highest Education Level :</span>Bachelors Degree</li>
							</ul>
							<div class="text-center">
								<a href="javascript:void(0);" class="btn btn-primary">See All</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-lg-pull-0 col-md-pull-0">
					<div class="sidebar right_sidebar">
						<div class="light_box recruiter_box">
							<h3>Your Recruiter</h3>
							<div class="thumbnail"><img src="<?php echo site_url();  ?>/assets/uploads/2016/09/recruiter.jpg" class="img-responsive">
								<p>How can I be of service?</p>
							</div>
							<h5>Christopher R. Bauer</h5>
							<a id="tourConNow" href="javascript:void(0);">Contact Now</a>
						</div>
						<div class="jobsearch_form dark_box" id="tourSearch">
							<div class="sidebar_title">
								<h4>Job Search</h4>
							</div>
							<form class="form">
								<div class="form-group">
								    <label for="keywords">Keywords</label>
								    <input type="text" class="form-control" id="keywords" placeholder="Job title, skills">
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">Country</label>
								    <select class="form-control" class="country_select">
									  <option value="">Please Select a country</option>
									  <option value="United States of America" selected="selected">United States of America</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">State</label>
								    <select class="form-control" class="country_select">
									  <option value="">Please Select a State</option>
									  <option value="Florida" selected="selected">Florida</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">City</label>
								    <select class="form-control" class="country_select">
									  	<option value="">Please Select a City</option>
							    	  	<option value="43868">Shalimar</option>
								   		<option value="43869">South Bradenton</option>
								   		<option value="43870">South Daytona</option>
								   		<option value="43871">South Miami</option>
								   		<option value="43872">South Miami Heights</option>
								   		<option value="43873">South Patrick Shores</option>
								   		<option value="43874">South Venice</option>
								   		<option value="43875">Spring Hill</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">Job Category</label>
								    <select class="form-control" class="country_select">
									  	<option value="">Please Select a job category</option>
										<option class="level-0" value="353">Information Technology</option>
										<option class="level-0" value="92">Investigations</option>
										<option class="level-0" value="354">Investigative Journalism</option>
										<option class="level-0" value="366">Loss Prevention</option>
										<option class="level-0" value="308">Marketing &amp; Sales</option>
										<option class="level-0" value="307">Operations Management</option>
										<option class="level-0" value="306">Risk Management</option>
										<option class="level-0" value="34">Security</option>
										<option class="level-0" value="309">Support Staff</option>
										<option class="level-0" value="112">Surveillance</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">Distance</label>
								    <select class="form-control" class="country_select">
									  <option value="">Please Select a distance</option>
									  <option>5 – 20 Miles</option>
									  <option>21 – 50 Miles</option>
									  <option>51 – 100 Miles</option>
									  <option>Anywhere</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								
								<div class="text-center">
									<button type="submit" class="btn btn-default">Search</button>
								</div>
							</form>
						</div>
						<img src="<?php echo site_url();  ?>/assets/uploads/2016/09/ad1.jpg" class="img-responsive">
						<!-- <div class="light_box snap_shot" id="tourNewPosting">
							<div class="sidebar_title">
								<span class="title_icon newposting_icon"></span>
								<h4>New Postings</h4>
							</div>
							<ul>
								<li><span>Security Officer :</span>ABC Security Services</li>
								<li><span>Security Supervisor :</span>Alpha Executive Protection</li>
								<li><span>Security Investigation :</span>Executive Protection</li>
							</ul>
							<div class="text-center">
								<a href="javascript:void(0);" class="btn btn-primary">See All</a>
							</div>
						</div> -->

						<div class="light_box snap_shot" id="tourNewPosting">
							<div class="sidebar_title">
								<span class="title_icon newposting_icon"></span>
								<h4>New Postings</h4>
							</div>
							<ul>
								<li>
									<span><a href="javascript:void(0);">Security Officer</a> :</span>ABC Security Services
								</li>
								
								<li>
									<span><a href="javascript:void(0);">Security Supervisor</a> :</span>Alpha Executive Protection
								</li>
								
								<li>
									<span><a href="javascript:void(0);">Security Investigation</a> :</span>Executive Protection
								</li>
							</ul>							
							<div class="text-center">
								<a href="javascript:void(0);" class="btn btn-primary">See All</a>
							</div>
						</div>

						<div class="light_box last_msurvey" id="tourSurveyRes">
							<div class="sidebar_title">
								<span class="title_icon survey_icon"></span>
								<h4>Survey Results</h4>
							</div>
							<p>Here is where the notes would be put after the results are in from the survey. It has limited space on the front page but can be give more where all the survey results are kept.</p>
							<h6>Do you trust public opinion ?</h6>
							<div class="text-center">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/survey_result.jpg">
								<br>
								<ul class="chart_points">
				            		<li><span style="background:#a12641"></span>Yes</li>
				            		<li><span style="background:#689e26"></span>No</li>
				            	</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="specialoffers_ad">
				<img src="<?php echo site_url();  ?>/assets/uploads/2016/09/ad3.jpg" class="img-responsive">
			</div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<!-- <?php //get_template_part( 'content', 'page' ); ?>-->
			<?php comments_template(); ?>
		</div><!-- #content -->
		<?php //do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('seekerdasboard'); ?>


<script type="text/javascript">

	function VTour(pageTourUrl, contextNew)
	{
	    var tourItems = new Array();
	    var pageVTourUrl = pageTourUrl;
	    var mobileMode = jQuery(window).width() <= 767;
	    var vTour = this;
	    var context = contextNew;

	    var buildTourItems = function(fields){
	        //remove any old fields
	        jQuery('#vtour-help-guide-alert').remove();
	        jQuery('#vtour-modal').remove();
	        // jQuery('.tour-guide-highlight').css({"z-index": '', position: ''});
	        jQuery(".tour-guide-highlight").removeClass("tour-guide-highlight");
	        jQuery(".popover").removeClass("popover");
	        jQuery('[id^="popover-continue-"]').unbind('click');
	        //Load the virtual tour help text into memory
	        var jQuerytourHtml = undefined;
	        jQuery.ajax(
	            {
	                url: pageVTourUrl,
	                type: 'get',
	                dataType: 'html',
	                async: false,
	                cache: false,
	                success: function(data)
	                {
	                    jQuerytourHtml = jQuery(data);
	                }
	            }
	        );
	        if(jQuerytourHtml != undefined){
	            //iterate over each div in the vtour page
	            var itemIndex = 0;
	            jQuerytourHtml.each(
	                function(){
	                    var jQueryitem = jQuery(this);
	                    //If the iterating item has the attribute display, add it to the tourItems list
	                    if(jQueryitem.attr("display")){
	                        //The passed value fields if undefined means add all items, otherwise determine the fields
	                        //to add to the tourItems list.
	                        var fieldRequired = fields == undefined;
	                        if(!fieldRequired){
	                            jQuery.each(fields,
	                                function(index, value){
	                                    if(value == jQueryitem.attr("field")){
	                                        fieldRequired = true;
	                                        return false;
	                                    }
	                                }
	                            );
	                        }
	                        if(fieldRequired){
	                            tourItems[itemIndex] = {
	                                fieldId: jQueryitem.attr("field"),
	                                displayType: jQueryitem.attr("display"),
	                                placement: jQueryitem.attr("placement"),
	                                mobilePlacement: jQueryitem.attr("mobile-placement"),
	                                title: jQueryitem.attr("title"),
	                                content: jQueryitem.html()
	                            };
	                            itemIndex ++;
	                        }
	                    }
	                }
	            );
	        }
	    };
	    var durl = '<?php echo site_url()."/job-seekers/dashboard"; ?>';
	    var guideHelpBox = '<div id="vtour-help-guide-alert" class="alert alert-info" style="position:absolute; z-index: 1071;top: .5px;left:35%;text-align: center;"><div><strong>Help Guide</strong><br/>Hover or press over a highlighted area. Press Esc to close.</div></div>';
	    var staticModal = '<div id="vtour-modal" class="modal fade"  tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><a class="close welcome_close_button" href="'+durl+'" aria-label="Close"><span aria-hidden="true">&times;</span></a></div><div class="modal-body"></div><div class="modal-footer"><div class="text-center"><button type="button" class="step-btn" id="modal-continue"><i class="fa fa-angle-double-left"></i> Close <i class="fa fa-angle-double-right"></i></button></div></div></div></div></div>';
	    // jQuery("<style type='text/css'> .popover{z-index:1061; width: 280px;} .tour-guide-highlight{-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(82, 168, 236, .6);-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(82, 168, 236, .6);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(82, 168, 236, .6); </style>").appendTo("head");

	    var currentTourIndex = 0;
	    var closed = false;

	  /*  jQuery.fn.center = function (jQuery) {
	      var w = jQuery(window);
	      this.css({
	        'position':'absolute',
	        'top':Math.abs(((w.height() - this.outerHeight()) / 2) + w.scrollTop())
	      });
	      return this;
	    }*/


	    var displayTourItem = function (index){
	        if(index < tourItems.length && index >= 0 ){
	            currentTourIndex = index+1;
	            var tourItem = tourItems[index];
	            if(tourItem.displayType == "modal"){
	                jQuery('#vtour-modal .modal-body').html(tourItem.content);
	                jQuery('#vtour-modal').modal({
	                    keyboard: false,
	                    backdrop: 'static',
	                    title: tourItem.title
	                });
	                jQuery('.modal-backdrop.in').css(backdropDefaultStyle);

	                jQuery('#modal-continue').modal({
					    backdrop: 'static',
					    keyboard: false
					});

	                jQuery('#modal-continue').on('click', function() {
	            		var durl = '<?php echo site_url()."/job-seekers/dashboard"; ?>';
	            		window.location = durl;
	            		return false;
	                    // setTimeout(function() { jQuery('#vtour-modal').modal('hide') }, 1);
	                    //setTimeout(function() { displayTourItem(currentTourIndex) }, 1);
	                });

	                // setInterval(function(){ 
	                //     jQuery('#modal-continue').click();
	                // }, 5000);
	            }else if(tourItem.displayType == "popover"){
	            	var durl = '<?php echo site_url()."/job-seekers/dashboard"; ?>';
	                var buttonText = tourItems.length - 1 == index ? "Hide" : "Continue";
	                var tempContent = tourItem.content
	                    + '<div class="text-center"><button type="button" class="popover_count step-btn" id="popover-continue-' + index + '"><< Continue >></button><a  href="'+durl+'" class="btn btn-default btn-sm" id="popover-stop">Stop</a></div>';
	                var fieldArr = ['tourUpgrade', 'tourEmployeerView', 'tourConNow', 'tourSearch', 'tourNewPosting', 'tourSurveyRes', 'tourCarrOpp', 'tourCommunCent', 'tourCoverLett', 'tourReferences', 'tourHonoAndAwa', 'tourLicensing', 'tourTechTran', 'tourTasks', 'tourSalNav', 'tourContOpp', 'tourTanSupport', 'tourPerCons'];
	                if ( jQuery.inArray(tourItem.fieldId, fieldArr) != -1 ) {
	                    var cusPlac = 'left'
	                }
	                else{
	                    var cusPlac = mobileMode && tourItem.mobilePlacement != undefined ? tourItem.mobilePlacement : tourItem.placement;
	                }
	                jQuery("#" + tourItem.fieldId).popover(
	                    {
	                        content: tempContent,
	                        trigger: 'manual',
	                        html: true,
	                        placement: cusPlac,
	                        //title: tourItem.title
	                    }
	                );

	                jQuery("#" + tourItem.fieldId).popover('show');
	                //add backdrop and highlight the field
	                toggleBackdrop();
	                toggleItemHighLight(tourItem.fieldId, index);
	                jQuery("#" + tourItem.fieldId).focus();
	                //handle key press and click on continue
	                handleKeyPress(index, tourItem.fieldId);
	                jQuery('#popover-continue-' + index).on('click', function() {
	                    var errorDiv = jQuery('#'+tourItem.fieldId).first().offset().top - 100;
	                    jQuery(window).scrollTop(errorDiv);
	                    if(itemChanged || !isEditableField){
	                        setTimeout(function() { displayTourItem(currentTourIndex) }, 1);
	                        toggleBackdrop();
	                        toggleItemHighLight(tourItem.fieldId, index);
	                        itemChanged = false; isEditableField = false;
	                    }
	                });
	                jQuery(".close_tour").on('click', function(){
	                   jQuery("#"+tourItem.fieldId).css({"z-index": 'auto'});
	                   jQuery("#" + tourItem.fieldId).toggleClass("tour-guide-highlight");
	                   jQuery("#"+tourItem.fieldId).popover('destroy');
	                   jQuery('#vtour-backdrop').remove();
	                });
	                setInterval(function(){ 
	                    jQuery('#popover-continue-' + index).click();
	                }, 14000);
	            }else{
	                setTimeout(function() { displayTourItem(currentTourIndex) }, 1);
	            }
	        }else if(currentTourIndex == tourItems.length){
	            if(!closed){
	                closed = true;
	                vTour.onClose();
	            }
	        }
	    };

	    var toggleTourGuide = function (){
	        for(var i = 0; i < tourItems.length; i++){
	            var tourItem = tourItems[i];
	            if(tourItem.displayType == "popover"){
	                jQuery("#" + tourItem.fieldId).popover(
	                    {
	                        content: tourItem.content,
	                        placement: mobileMode && tourItem.mobilePlacement != undefined ? tourItem.mobilePlacement : tourItem.placement,
	                        title: tourItem.title,
	                        trigger: 'hover'
	                    }
	                );
	                if(i == 0){
	                    toggleBackdrop({
	                        opacity: '.5',
	                        filter: 'alpha(opacity=50)',
	                        'z-index': '1040'
	                    });
	                    jQuery('#vtour-backdrop').on('click', function(e){vTour.hideTourGuide();});
	                    toggleHelpGuideAlert();
	                }
	                toggleItemHighLight(tourItem.fieldId, i);
	            }
	        }
	    };

	    var backdropDefaultStyle = {
	        opacity: '0.4',
	        filter: 'alpha(opacity=40)',
	        'z-index': '1040'
	    };

	    var toggleItemHighLight = function(focusedId, index){
	        if(focusedId != undefined){
	            if(jQuery("#"+focusedId).css('z-index') >= 1041){
	                jQuery("#"+focusedId).css({"z-index": 'auto'});
	                jQuery("#" + focusedId).toggleClass("tour-guide-highlight");
	                jQuery("#" + focusedId).popover('destroy');
	            }else{
	                jQuery("#"+focusedId).css({'z-index': 1041 + index, position: 'relative'});
	                jQuery("#" + focusedId).toggleClass("tour-guide-highlight");
	                jQuery("#" + focusedId).attr("rel", "popover");
	            }
	        }
	    };

	    var toggleBackdrop = function(backdropStyle) {
	        if(jQuery('#vtour-backdrop').length <= 0){
	            var jQuerybackdrop = jQuery('<div id="vtour-backdrop" class="modal-backdrop"/>').appendTo(document.body);
	            if(backdropStyle == undefined){
	                jQuerybackdrop.css(backdropDefaultStyle);
	            }else{
	                jQuerybackdrop.css(backdropStyle);
	            }
	        }else{
	            jQuery('div.modal-backdrop').remove();
	        }
	    };

	    var toggleHelpGuideAlert = function(){
	        if(jQuery("#vtour-help-guide-alert").length > 0){
	            jQuery("#vtour-help-guide-alert").remove();
	        }else{
	            jQuery('body').append(guideHelpBox);
	            jQuery("#vtour-help-guide-alert").on('click', function(e){
	                vTour.hideTourGuide();
	            });
	        }
	    };

	    var itemChanged = false;
	    var isEditableField = false;

	    var escapeKeyListen = function(){
	        var keyPressHandler = function(e){
	            var keyCode = e.keyCode || e.which;
	            if (keyCode == 27) {
	                vTour.hideTourGuide();
	                jQuery('body').unbind("keydown", keyPressHandler);
	            }
	        };
	        jQuery('body').bind("keydown", keyPressHandler);
	    };

	    var handleKeyPress = function(index, focusedId) {
	        var keyPressHandler = function(e){
	            var keyCode = e.keyCode || e.which;
	            if (keyCode == 13 || keyCode == 9) {
	                e.preventDefault();
	                if(itemChanged || !isEditableField){
	                    jQuery('#popover-continue-' + index).click();
	                    jQuery("#"+focusedId).unbind("keydown", keyPressHandler);
	                    itemChanged = false; isEditableField = false;
	                }
	            }
	        };
	        jQuery("#"+focusedId).bind("keydown", keyPressHandler);

	        var changeHandler = function(e){
	            jQuery('#popover-continue-' + index).removeClass("disabled");
	            itemChanged = true;
	        };
	        isEditableField = (jQuery("#"+focusedId).is('input') || jQuery("#"+focusedId).is('select'))
	            && (!jQuery("#"+focusedId).hasClass('value-input') || !jQuery("#"+focusedId).hasClass('uneditable-input'));
	        if(isEditableField){
	            jQuery('#popover-continue-' + index).addClass("disabled");
	            if(isEventSupported("input") && jQuery("#"+focusedId).is('input')){
	                jQuery("#"+focusedId).one("input", changeHandler);
	            }else if(jQuery("#"+focusedId).is('input')){
	                jQuery('#popover-continue-' + index).removeClass("disabled");
	                isEditableField = false;
	            }

	            if(jQuery("#"+focusedId).is('select')){
	                jQuery("#"+focusedId).one("change", changeHandler);
	            }
	        }
	    };

	    this.tour = function(fields){
	        if(pageVTourUrl == undefined || pageVTourUrl == "" || pageVTourUrl == null) {
	            pageVTourUrl = context.attr("pageVTourUrl");
	        }
	        if(pageVTourUrl != undefined && pageVTourUrl != "" && pageVTourUrl != null){
	            if(fields != undefined){
	                buildTourItems(fields);
	            }else{
	                buildTourItems();
	            }
	            this.onStart(false);
	        }
	    };

	    this.onStart = function(popUpGuide){
	        if(popUpGuide == true){
	            escapeKeyListen();
	            toggleTourGuide();
	        }else{
	            jQuery('body').append(staticModal);
	            displayTourItem(0);
	        }
	    };

	    this.onClose = function(){

	    };

	    this.tourGuide = function(fields){
	        if(pageVTourUrl == undefined || pageVTourUrl == "" || pageVTourUrl == null){
	            pageVTourUrl = context.attr("pageVGuideUrl");
	        }
	        if(pageVTourUrl != undefined && pageVTourUrl != "" && pageVTourUrl != null){
	            if(fields != undefined){
	                buildTourItems(fields);
	            }else{
	                buildTourItems()
	            }
	            this.onStart(true);
	        }
	    };

	    this.hideTourGuide = function(){
	        toggleTourGuide();
	        vTour.onClose();
	    };

	    VTour.getInstance = function(){
	        return vTour;
	    }
	}

	var isEventSupported = (function(){
	    var TAGNAMES = {
	        'select':'input','change':'input', 'input':'input',
	        'submit':'form','reset':'form',
	        'error':'img','load':'img','abort':'img'
	    };
	    function isEventSupported(eventName) {
	        var el = document.createElement(TAGNAMES[eventName] || 'div');
	        eventName = 'on' + eventName;
	        var isSupported = (eventName in el);
	        if (!isSupported) {
	            el.setAttribute(eventName, 'return;');
	            isSupported = typeof el[eventName] == 'function';
	        }
	        el = null;
	        return isSupported;
	    }
	    return isEventSupported;
	})();
		
</script>
<script type="text/javascript">
	
	window.onbeforeunload = function () {
	 jQuery("html,body").animate({scrollTop: 0}, 500);
	}

	jQuery(function(){
        jQuery("[rel=tooltip]").tooltip();
    	new VTour(null, jQuery('#body-container')).tour();
    	//preventDefault();
        /*jQuery('#start_tour').on('click', function(e){
        });*/
    });
</script>
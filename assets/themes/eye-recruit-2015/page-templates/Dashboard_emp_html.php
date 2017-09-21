<?php
/**
 * Template Name:Employer Deshboard  html Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

if ( is_user_logged_in() ) {
	$user_id = get_current_user_id();
	$user = get_userdata($user_id);
	$fname = $user->first_name;
	$lname = $user->last_name;
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

	if ( isset($_REQUEST['rec']) ) {
		$user_id = multi_base64_decode($_REQUEST['rec']);
		$user = get_userdata($user_id);
		$fname = $user->first_name;
		$lname = $user->last_name;
	}


	?>
	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>
	<section class="dashboard_sec">
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
							<!-- <a class="btn btn_white" href="javascript:void(0);">Update</a> -->
						<!--</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="container">
			<div class="name_sec">
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<h2><?php echo $fname.'  '.$lname; ?></h2>
						<h5><strong>Recruit ID :</strong> 3585</h5>
					</div>
					<div class="col-md-4 col-sm-6">
						<p class="text-center"><strong>Member Since : </strong>August 23rd, 2016</p>
					</div>
					<div class="col-md-4 col-sm-6">
						<p class="text-right"><strong>Last Log In : </strong>Yesterday at 4:17pm</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-12 col-lg-push-3 col-md-push-0">
					<div class="profile_box">
						<?php echo get_avatar( $user_id ); ?>
						<script type="text/javascript">jQuery(document).ready(function() { jQuery('.avatar').addClass('thumbnail'); });</script>

						<!-- <img src="<?php echo site_url();  ?>/assets/uploads/2016/09/userprofile.jpg" class="thumbnail"> -->
						<div class="profile_cont">
							<ul class="view_points row">
								<li class="col-xs-5 devicefull"><strong>Industry Sector : </strong>Security</li>
								<li class="col-xs-7 devicefull"><strong>Closest Metropolitan Area : </strong>Fort Lauderdale, FL.</li>
								<li class="col-xs-5 devicefull"><strong>Active Offices : </strong>Fort Lauderdale, Europe</li>
								<li class="col-xs-7 devicefull"><strong>Company Name : </strong>Catawba Security</li>
								<li class="col-xs-5 devicefull"><strong>Head Office : </strong>Fort Lauderdale, FL. 33326 </li>
								<li class="col-xs-7 devicefull"><strong>Employees </strong>Looking for the right opportunity.</li>
							</ul>
							<a href="javascript:void(0);" class="btn btn-primary btn-sm">Update</a>
							<a href="javascript:void(0);" class="btn btn-primary btn-sm pull-right">Public Profile</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="profile_box">
						<?php echo get_avatar( $user_id ); ?>
						<script type="text/javascript">jQuery(document).ready(function() { jQuery('.avatar').addClass('thumbnail'); });</script>

						<!-- <img src="<?php echo site_url();  ?>/assets/uploads/2016/09/userprofile.jpg" class="thumbnail"> -->
						<div class="profile_cont">
							<ul class="view_points row">
								<li class="col-xs-5 devicefull"><strong>Name : </strong>John Dangle</li>
								<li class="col-xs-7 devicefull"><strong>Company Position : </strong>Manager (HR)</li>
								<li class="col-xs-5 devicefull"><strong>Head Office : </strong>Fort Lauderdale, FL. 33326 </li>
								<li class="col-xs-7 devicefull"><strong>Closest Metropolitan Area : </strong>Fort Lauderdale, FL.</li>
								<li class="col-xs-5 devicefull"><strong>Experience : </strong>5 Yers</li>
								<li class="col-xs-7 devicefull"><strong>Company Name : </strong>Catawba Security</li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="navigation">
						<div class="section_title">
							<h3>Navigation</h3>
						</div>
						<div class="nav_items">
							<div class="row">
								<div class="col-sm-4 col-xs-6 devicehalf">
									<h6>Job Dashboard</h6>
									<i class="nav_icons resume_icon"></i>
								</div>
								<div class="col-sm-4 col-xs-6 devicehalf">
									<h6>Featured Matches</h6>
									<i class="nav_icons featuredm_icon"></i>
								</div>
								<div class="col-sm-4 col-xs-6 devicehalf">
									<h6>Communications Center</h6>
									<i class="nav_icons connect_icon"></i>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-6 devicehalf">
									<h6>Search Seeker</h6>
									<i class="nav_icons searchs_icon"></i>
								</div>
								<div class="col-sm-4 col-xs-6 devicehalf">
									<h6>Post a job</h6>
									<i class="nav_icons postjob_icon"></i>
								</div>
								<div class="col-sm-4 col-xs-6 devicehalf">
									<h6>Dummy</h6>
									<i class="nav_icons license_icon"></i>
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
								<a href="javascript:void(0);" class="asses_box">
									<i class="fa fa-check-square-o"></i>
									<h5>Abilities</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box">
									<i class="fa fa-book"></i>
									<h5>Knowledge</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box">
									<i class="fa fa-mobile"></i>
									<h5>Tech & Trends</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box">
									<i class="fa fa-pencil"></i>
									<h5>Skills</h5>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box asses_import">
									<i class="fa fa-briefcase"></i>
									<h5>Work</h5>
									<span class="torch"></span>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);" class="asses_box asses_import">
									<i class="fa fa-tasks"></i>
									<h5>Tasks</h5>
									<span class="torch"></span>
								</a>
							</div>
						</div>
					</div>

					<div class="support_serv">
						<div class="section_title">
							<h3>Navigation</h3>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-interview.png" class="img-responsive">
									<h6>Interview <br>Support</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icons-salary.png" class="img-responsive">
									<h6>Compensation <br>Negotiation</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-truck.png" class="img-responsive">
									<h6>Relocation <br>Assistance Program</h6>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-training.png" class="img-responsive">
									<h6>On-Boarding & <br>Orientation</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-direction.png" class="img-responsive">
									<h6>Transition <br>Support</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf">
								<a href="javascript:void(0);">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icons-performance.png" class="img-responsive">
									<h6>Retention & <br>Performance Consulting</h6>
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
						<div class="light_box visibility">
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
						<div class="light_box chlng_quest">
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
								<li><a href="javascript:void(0);">Tell us about a Problem </a></li>
								<li><a href="javascript:void(0);">Give us your Fedback</a></li>
								<li><a href="javascript:void(0);">Invite Friends & Colleagues</a></li>
								<li><a href="javascript:void(0);">Visit the Help Center</a></li>
								<li><a href="javascript:void(0);">Investigation Nation Blog</a></li>
							</ul>
						</div>
						<div class="light_box tips">
							<div class="sidebar_title">
								<span class="title_icon tips_icon"></span>
								<h4>Tips #424</h4>
							</div>
							<p>The tips will be something to catch the users eye and get them to think about something or to take an action and do something. This will also be something that is done from the admin Dashboard side.</p>
						</div>
						<div class="light_box snap_shot">
							<div class="sidebar_title">
								<span class="title_icon snapshot_icon"></span>
								<h4>Snap Shot</h4>
							</div>
							<ul>
								<li><span>US Eligibility :</span>Yes, I am authorized</li>
								<li><span>Security Clearance :</span>Yes, I am authorized</li>
								<li><span>Would Consider Relocation :</span>Yes, Anywhere</li>
								<li><span>Highest Level of Education :</span>Bachelors Degree</li>
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
							<h3>Profile Visibility</h3>
							<div class="thumbnail"><img src="<?php echo site_url();  ?>/assets/uploads/2016/09/recruiter.jpg" class="img-responsive">
								<p>How can I be of service?</p>
							</div>
							<h5>Christopher R. Bauer</h5>
							<a href="javascript:void(0);">Contact Now</a>
						</div>
						<div class="jobsearch_form dark_box">
							<div class="sidebar_title">
								<h4>Job Search</h4>
							</div>
							<form class="form">
								<div class="form-group">
								    <label for="keywords">Keywords</label>
								    <input type="text" class="form-control" id="keywords" placeholder="Job title, skills">
								</div>
								<div class="form-group">
								    <label for="location_input">Location</label>
								    <input type="text" class="form-control" id="location_input">
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">Distance</label>
								    <select class="form-control" class="country_select">
									  <option>Please Select</option>
									  <option>5 – 20 Miles</option>
									  <option>21 – 50 Miles</option>
									  <option>51 – 100 Miles</option>
									  <option>Anywhere</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">Country</label>
								    <select class="form-control" class="country_select">
									  <option>Please Select</option>
									  <option>United States</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">Job Category</label>
								    <select class="form-control" class="country_select">
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
								    <label for="country_select">Contract Type</label>
								    <select class="form-control" class="country_select">
										<option class="level-0" value="32">Contract</option>
										<option class="level-0" value="2" selected="selected">Full Time</option>
										<option class="level-0" value="6">Internship</option>
										<option class="level-0" value="3">Part Time</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-default">Search</button>
								</div>
							</form>
						</div>
						<img src="<?php echo site_url();  ?>/assets/uploads/2016/09/ad1.jpg" class="img-responsive">
						<div class="light_box snap_shot">
							<div class="sidebar_title">
								<span class="title_icon newposting_icon"></span>
								<h4>New Postings</h4>
							</div>
							<ul>
								<li><span>Security Officer :</span>ABC Security Services</li>
								<li><span>Security Supervisor :</span>Alpha Executive Protection</li>
							</ul>
							<div class="text-center">
								<a href="javascript:void(0);" class="btn btn-primary">See All</a>
							</div>
						</div>
						<div class="light_box last_msurvey">
							<div class="sidebar_title">
								<span class="title_icon survey_icon"></span>
								<h4>Survey Results</h4>
							</div>
							<p>Here is where the notes would be put after the results are in from the survey. It has limited space on the front page but can be give more where all the survey results are kept.</p>
							<h6>Do you trust public opinion ?</h6>
							<div class="text-center">
								<img src="<?php echo site_url();  ?>/assets/uploads/2016/09/graph.png">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="container">
			<div class="feature_ad specialoffers_ad">
				<img src="<?php //echo site_url();  ?>/assets/uploads/2016/09/ad3.jpg" class="img-responsive">
			</div>
		</div> -->
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
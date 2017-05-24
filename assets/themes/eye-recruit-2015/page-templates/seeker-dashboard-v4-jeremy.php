<?php
/**
 * Template Name: Job Seeker Dashboard (v4)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.5
 */
 
get_header(); ?>
<!-- <script src="<?php //echo get_stylesheet_directory_uri(); ?>/js/notify.js" type="text/javascript"></script> -->

	<?php
	if(is_user_logged_in()){
		$user_id = get_current_user_id();
		$data = get_userdata($user_id);

		//how much complate profile
		$totalper = job_seeker_profile_com_status($user_id);

	}else{
		wp_redirect(site_url());
	}

	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}
	
	 ?>
<?php while ( have_posts() ) : the_post(); ?>

	<div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
	<header class="page-header">
	<h1 class="page-title"><?php the_title(); ?></h1>
	</header>
	<section class="dashboard_sec">
		<div class="container">
			<div class="name_sec">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<h2><?php echo get_user_meta($user_id,'first_name',true);  ?> <?php echo get_user_meta($user_id,'last_name',true);  ?></h2>
                        <button id="btn-seekerDashboardTour" class="btn btn-primary">Need help? Take a tour</button>
                        
						  <?php //echo '<h5><strong>Recruit ID :</strong>'.$user_id.'</h5>';  ?> 
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 col-lg-offset-4 col-md-offset-0 col-sm-offset-0">
						<?php 
						$membershipUser = $wpdb->prefix.'memberships_users';
						$checkUserMember = $wpdb->get_var("SELECT COUNT(id) FROM eyecuwp_pmpro_memberships_users WHERE user_id = '".$user_id."' ");
						if ( $checkUserMember <= 0 ) {
							$buttonText = 'Get Started';
						}
						else{
							$buttonText = 'Upgrade Now';
						}

						if(is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel())
						{
							global $current_user;
							$current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
							$membershipLevel = $current_user->membership_level->name;
						}
						else{
							$membershipLevel = 'Not Available';
						}
						?>
						<div class="mmebereship_type">
						<p><strong>Membership Type : </strong><?php echo $membershipLevel; ?> <a href="<?php echo site_url(); ?>/seeker-pricing/" class="btn btn-sm btn-primary"><?php echo $buttonText; ?></a> </p>
						<img data-toggle="modal" data-target="#prices_lock" src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/prices_lock.png" class="img-responsive">
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<p><strong>Member Since : </strong><?php echo  date( "F dS, Y", strtotime($data->user_registered)); ?></p>
					</div>
					<div class="col-md-4 col-sm-6">
						<p class="text-center">   
							<strong>Last Log In : </strong><?php //echo get_last_login($user_id); ?>
							<?php
							global $wpdb;
							$lastlogin = $wpdb->get_row("SELECT * FROM eyecuwp_user_login_history WHERE user_id = '".$user_id."' order by id desc LIMIT 1 offset 1");
							
							if ( !empty($lastlogin->login_date) ) {
								
								$lastStr = strtotime($lastlogin->login_date); 
								/*$last_access = date('Y-m-d', $lastStr);
								if ($last_access == date('Y-m-d', strtotime("today")) ){
							        echo "Today";
							    }
							    else if ($last_access == date('Y-m-d', strtotime("yesterday")) ){
							        echo "Yesterday";
							    }
							    else{
							    	echo date('F dS, Y', strtotime($lastlogin->login_date));
							    }
								
								echo " at ".date('h:ia', $lastStr);*/

								echo date('l, F dS Y', $lastStr);
							}
							else{
								echo "--";
							}
							?>
					    </p>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="seeker-timings pull-right text-center">
							<p class="">
								<strong>Today's Date: </strong>
								<?php 
								date_default_timezone_set('US/Eastern');
								echo date('l, F dS Y'); 
								?>
							</p>	
							<p class="seeker-cur-time">	
								<strong>The Current Time: </strong> 
								<span id="date_time"> 
						            <script type="text/javascript">
						             	offset = -5.0;
							            function getOrdinalSuffix(day) {
			        
										   	if(/^[2-3]?1$/.test(day)){
										   		return 'st';
										   	} else if(/^[2-3]?2$/.test(day)){
										   		return 'nd';
										   	} else if(/^[2-3]?3$/.test(day)){
										   		return 'rd';
										   	} else {
										   		return 'th';
										   	}
										}
							            function date_time(id)
										{
									        //date = new Date;

								           	clientDate = new Date();
										    utc = clientDate.getTime() + (clientDate.getTimezoneOffset() * 60000);
	 									    date = new Date(utc + (3600000*offset));

									        year = date.getFullYear();
									        month = date.getMonth();
									        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
									        d = date.getDate();
									        day = date.getDay();
									        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
									        
									        //h = date.getHours();
								         	h = date.getHours() == 0 ? "12" : date.getHours() > 12 ? date.getHours() - 12 : date.getHours();

									        if(h<10)
									        {
								                h = "0"+h;
									        }
									        m = date.getMinutes();
									        if(m<10)
									        {
								                m = "0"+m;
									        }
									        s = date.getSeconds();
									        if(s<10)
									        {
								                s = "0"+s;
									        }
									        // result = ' '+months[month]+' '+d+getOrdinalSuffix(d)+', '+year+' '+h+':'+m+':'+s;

										    ampm = date.getHours() < 12 ? "am" : "pm";
										    //var formattedTime = hours + ":" + minutes + " " + ampm;

									        result = ' '+h+':'+m+':'+s+ampm+ ' EST';
									        document.getElementById(id).innerHTML = result;
									        setTimeout('date_time("'+id+'");','1000');
									        return true;
										}

						            	window.onload = date_time('date_time');
					
						            </script>
						        </span>
							</p>
							
					    </div><!-- seeker-timings -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-12 col-lg-push-3 col-md-push-0">
					<div class="profile_box">
						<div id="profilePic" class="thumbnail">
							<?php
								if ( has_wp_user_avatar($user_id) ) {
									echo get_wp_user_avatar($user_id, ''); 
								}else{
									?>
									<img src="<?php echo site_url(); ?>/assets/uploads/2016/08/EyeRecruit_Avitar.png" height="225px" width="190px" class="thumbnail">
									<?php
								}

								$spotlight_status 	= get_usermeta($user_id, 'spotlight_status',true);
								if($spotlight_status == 'yes'){
									$statusb 	= 'Featured in Spotlight';
								}else{
									$statusb 	= 'Be Featured in Spotlight';
								}

							?>
							<span class="label label-default"><strong>Recruit ID : </strong><?php echo $user_id;  ?></span>
							<ol>
								<li><a href="<?php echo site_url();  ?>/job-seekers/quick-view/?recruiterid=<?php echo $user_id;   ?>" target="_blank"><img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/quick_farward_icon.jpg"> Quick Forward Now</a></li>
								<li><a href="javascript:void(0);" data-toggle="modal" data-target="#applyModalspoot"><img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/featured_spotlight_icon.jpg"><span id="bfeatured"><?php echo $statusb; ?></span></a></li>
							</ol>
						</div>
						<div class="profile_cont">
							<?php get_template_part( 'seeker_dasboard_templates/content', 'profile_information' ); ?>
						</div>
						<div class="text-center">
							<a href="<?php  echo site_url(); ?>/preferences/basic-information/" class="btn btn-primary btn-sm">Update Your Current Status</a>
							<a id="btn-employer-pov" href="<?php  echo site_url(); ?>/job-seekers/seeker-profile-view" class="btn btn-primary btn-sm">See Employer's Point of View</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="navigation">
						<div class="section_title">
							<h3>Navigation</h3>
						</div>
						<div class="nav_items">
							<div class="row">
								<a href="<?php echo site_url();  ?>/job-seekers/background-management/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Background Management</h6>
									<i class="nav_icons backmanage_icon"></i>
								</a>
								<a id="nav-video-interview-mgt" href="<?php echo site_url();  ?>/job-seekers/video-interview-management/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Video Interview Management</h6>
									<i class="nav_icons videointer_icon"></i>
								</a>
								<a href="<?php echo site_url();  ?>/job-seekers/career-opportunities/" class="col-sm-3 col-xs-6 devicehalf nav_noti">
									<h6>Career Opportunities</h6>
									<i class="nav_icons verification_icon"></i>
									<span>6</span>
								</a>
								<a href="<?php echo site_url();  ?>/job-seekers/communications-center/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Communications Center</h6>
									<i class="nav_icons connect_icon"></i>
								</a>
							</div>
                            <div id="importantDocs">
                            
							<div class="row">
								<a href="<?php echo site_url();  ?>/job-seekers/resume/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Resume</h6>
									<i class="nav_icons resume_icon"></i>
								</a>

								<?php
								global $wpdb;
								$tablename = $wpdb->prefix.'reach_out_and_ask_for_referral';
								$select = $wpdb->get_var("SELECT COUNT(*) FROM $tablename WHERE user_id = '".$user_id."' ORDER BY id DESC ");
								$countref = $select;
								?>
								<a href="<?php echo site_url();  ?>/job-seekers/referrals/" class="col-sm-3 col-xs-6 devicehalf <?php if($countref > 0){ echo 'nav_noti'; } ?>">
									<h6>Recommendations</h6>
									<i class="nav_icons referrals_icon"></i>
									<?php if($countref > 0){ ?> <span id="countref"><?php echo $countref; ?></span> <?php } ?>
								</a>
								<a href="<?php echo site_url();  ?>/job-seekers/cover-letters/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Cover Letters</h6>
									<i class="nav_icons coverletter_icon"></i>
								</a>
								<a href="<?php echo site_url();  ?>/job-seekers/references/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>References</h6>
									<i class="nav_icons references_icon"></i>
								</a>
							</div>
							<div class="row">
								<a href="<?php echo site_url();  ?>/job-seekers/education/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Education</h6>
									<i class="nav_icons education_icon"></i>
								</a>
								<a href="<?php echo site_url();  ?>/job-seekers/certificates/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Certificates</h6>
									<i class="nav_icons certificates_icon"></i>
								</a>
								<a href="<?php echo site_url();  ?>/job-seekers/honors-and-awards/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Honors and Awards</h6>
									<i class="nav_icons awards_icon"></i>
								</a>
								<a href="<?php echo site_url();  ?>/job-seekers/licensing/" class="col-sm-3 col-xs-6 devicehalf">
									<h6>Licensing</h6>
									<i class="nav_icons license_icon"></i>
								</a>
							</div>
                            </div>
						</div>
					</div>
					<div class="assessments" id="assesSection">
						<div class="section_title">
							<h3>Self Assessments</h3>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-6 devicehalf asses_import">
								<a href="<?php echo site_url();  ?>/job-seekers/abilities-assessment/" class="asses_box">
									<i class="fa fa-check-square-o"></i>
									<h5>Abilities</h5>
									<?php 
									$now = time();
									$abilities = get_user_meta($user_id, 'abilities-assessment', true); 
									$abilitiesdatediff = $now - $abilities;
									$abilitiesdayes = floor( $abilitiesdatediff / (60 * 60 * 24) );
									if ( (!empty($abilities)) && ($abilitiesdayes <= 90) ) {
										echo '<span class="torch"></span>';
									}
									?>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf  asses_import">
								<a href="<?php echo site_url();  ?>/job-seekers/knowledge-assessment/" class="asses_box">
									<i class="fa fa-book"></i>
									<h5>Knowledge</h5>
									<?php 
									$kwonledge = get_user_meta($user_id, 'knowledge-assessment', true);
									$kwonledgedatediff = $now - $kwonledge;
									$kwonledgedayes = floor( $kwonledgedatediff / (60 * 60 * 24) );
									if ( (!empty($kwonledge)) && ($kwonledgedayes <= 90) ) {
										echo '<span class="torch"></span>';
									}
									?>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf  asses_import">
								<a href="<?php echo site_url();  ?>/job-seekers/technology-assessment/" class="asses_box">
									<i class="fa fa-mobile"></i>
									<h5>Tech & Trends</h5>
									<?php 
									$tech = get_user_meta($user_id, 'technology-assessment', true);
									$techdatediff = $now - $tech;
									$techdayes = floor( $techdatediff / (60 * 60 * 24) );
									if ( (!empty($tech)) && ($techdayes <= 90) ) {
										echo '<span class="torch"></span>';
									}
									?>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf  asses_import">
								<a href="<?php echo site_url();  ?>/job-seekers/skills-assessment/" class="asses_box">
									<i class="fa fa-pencil"></i>
									<h5>Skills</h5>
									<?php 
									$skills = get_user_meta($user_id, 'skills-assessment', true); 
									$skillsdatediff = $now - $skills;
									$skillsdayes = floor( $skillsdatediff / (60 * 60 * 24) );
									if ( (!empty($skills)) && ($skillsdayes <= 90) ) {
										echo '<span class="torch"></span>';
									}
									?>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf  asses_import">
								<a href="<?php echo site_url();  ?>/job-seekers/work-activities-assessment/" class="asses_box">
									<i class="fa fa-briefcase"></i>
									<h5>Work</h5>
									<?php 
									$work = get_user_meta($user_id, 'work-activities-assessment', true);
									$workdatediff = $now - $work;
									$workdayes = floor( $workdatediff / (60 * 60 * 24) );
									if ( (!empty($work)) && ($workdayes <= 90) ) {
										echo '<span class="torch"></span>';
									}
									?>
								</a>
							</div>
							<div class="col-sm-4 col-xs-6 devicehalf  asses_import">
								<a href="<?php echo site_url();  ?>/job-seekers/tasks-assessment/" class="asses_box">
									<i class="fa fa-tasks"></i>
									<h5>Tasks</h5>
									<?php 
									$tasks = get_user_meta($user_id, 'tasks-assessment', true); 
									$tasksdatediff = $now - $tasks;
									$tasksdayes = floor( $tasksdatediff / (60 * 60 * 24) );
									if ( (!empty($tasks)) && ($tasksdayes <= 90) ) {
										echo '<span class="torch"></span>';
									}
									?>
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
								<a href="<?php echo site_url(); ?>/what-we-do-for-you/resume-services/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
									<h6>Resume <br>Services</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url(); ?>/job-seekers/interview-coaching/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-interview.png" class="img-responsive">
									<h6>Interview <br>Coaching</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url(); ?>/job-seekers/salary-nagotiation/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icons-salary.png" class="img-responsive">
									<h6>Compensation <br>Negotiation</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url(); ?>/job-seekers/contract-opportunities/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-negotiation.png" class="img-responsive">
									<h6>Contract <br>Opportunities</h6>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url(); ?>/job-seekers/onboarding-orientation/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-training.png" class="img-responsive">
									<h6>Onboarding <br>Orientation</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url(); ?>/job-seekers/transition-support/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-direction.png" class="img-responsive">
									<h6>Transition <br>Support</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url(); ?>/job-seekers/relocation-services/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-truck.png" class="img-responsive">
									<h6>Relocation<br>Services</h6>
								</a>
							</div>
							<div class="col-sm-3 col-xs-6 devicehalf">
								<a href="<?php echo site_url(); ?>/job-seekers/performance-consulting/">
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
								<?php global $wpdb;
									$employer_id =  get_current_user_id();
									$select_count = $wpdb->get_var("SELECT count(*) FROM eyecuwp_last_view WHERE can_id=$employer_id");
								?>
								<li><strong><?php echo $select_count; ?></strong>- Times profile has been viewed.</li>
								<li><strong>0 </strong>- Times profile added to favorites.</li>
								<li><strong>0</strong>- Times profile was forwarded.</li>
								<li><strong>0 </strong>- Currently following your career.</li>
							</ul>
							<div class="profile_pogress">
								<div class="progress" aria-describedby="profile_process">
								  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $totalper; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $totalper; ?>%"></div>
								</div>
								<div class="text-center" id="profile_process">Profile is <strong><?php echo $totalper; ?>%</strong> Complete</div>
							</div>
						</div>
						<div id="visibility_settings" class="light_box visibility">
							<div class="sidebar_title">
								<span class="title_icon visibility_icon"></span>
								<h4>Visibility Settings</h4>
							</div>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'profile_visibility' ); ?>
						</div>

						<div id="afterVote" style="display:none;">
							<?php //the_field('left_side_add'); ?>
							<?php
							if(is_active_sidebar('ad_seeker_dashboard_after_question_survey')){
								dynamic_sidebar('ad_seeker_dashboard_after_question_survey');
							}
							?>
						</div>
						<div class="light_box chlng_quest" id="poll_opinion_body" imgUrl="<?php echo get_stylesheet_directory_uri().'/img/ad4.jpg'; ?>">
							<?php get_template_part( 'seeker_dasboard_templates/content', 'question_survey' ); ?>
						</div>

						<div id="quick_links" class="light_box quick_links">
							<div class="sidebar_title">
								<span class="title_icon quicklink_icon"></span>
								<h4>Quick Links</h4>
							</div>
							<ul>
								<li><a href="<?php echo site_url()  ?>/preferences/applied-jobs/">Jobs You Applied To</a></li>
								<li><a href="<?php echo site_url()  ?>/preferences/saved-jobs-of-interest/">Saved Jobs of Interest</a></li>
								<li><a href="<?php echo site_url()  ?>/preferences/my-network/">Your Networks</a></li>
								<li><a href="#" data-toggle="modal" data-target="#invite_a_colleague">Invite friends & colleagues</a></li>
								<li><a href="<?php echo site_url()  ?>/preferences/employer-management">Employer Management</a></li>
								<li><a href="<?php echo site_url()  ?>/preferences/recruiter-management">Recruiter Management</a></li>
								<li><a href="#" data-target="#aboutproblem" data-toggle="modal" id="submitbPobe" ticketID="<?php echo random_str(8); ?>">Tell us about a Problem </a></li>
								<li><a href="#" data-toggle="modal" data-target="#feedback">Give Us your feedback</a></li>
								<li><a href="#" data-toggle="modal" data-target="#yourstory">Tell Us your story</a></li>
								<li><a href="<?php echo site_url();  ?>/preferences/contact-information/">Preferences</a></li>
								<li><a href="<?php echo site_url();  ?>/resources/">Resources</a></li>
								<li><a href="<?php echo site_url();  ?>/preferences/help-support/" >Visit the help center</a></li> <!-- data-toggle="modal" data-target="#visit_the_help_center" -->
							
							</ul>
						</div>
						<div class="light_box tips">
							<?php get_template_part( 'seeker_dasboard_templates/content', 'seekertips' ); ?>

						</div>
						<div class="light_box snap_shot">
							<div class="sidebar_title">
								<span class="title_icon snapshot_icon"></span>
								<h4>Snap Shot</h4>
							</div>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'snap_shot' ); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-lg-pull-0 col-md-pull-0">
					<div class="sidebar right_sidebar">
						<div id="yourRecruiter" class="light_box recruiter_box">
							<h3>Your Recruiter</h3>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'recuriter' ); ?>

						</div>
						<div class="jobsearch_form dark_box">
							<div class="sidebar_title">
								<h4>Job Search</h4>
							</div>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'jobsearch' ); ?>
						</div>
						<!-- <img src="<?php //echo site_url();  ?>/assets/uploads/2016/09/ad1.jpg" class="img-responsive"> -->
						<?php //the_field('right_side_add'); ?>
						<?php
						if(is_active_sidebar('ad_right_side_seeker')){
							dynamic_sidebar('ad_right_side_seeker');
						}
						?>
						<div class="light_box snap_shot">
							<div class="sidebar_title">
								<span class="title_icon newposting_icon"></span>
								<h4>New Postings</h4>
							</div>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'Job_recommendations' ); ?>
							<div class="text-center">
								<a href="<?php echo site_url(); ?>/job-seekers/find-a-job/" class="btn btn-primary">See All</a>
							</div>
						</div>
						<div class="light_box last_msurvey">
							<div class="sidebar_title">
								<span class="title_icon survey_icon"></span>
								<h4>Survey Results</h4>
							</div>
							<?php get_template_part( 'seeker_dasboard_templates/content', 'survey_report' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="specialoffers_ad">
				<?php //the_field('bottum_offer_image_link'); ?>
				<?php
				if(is_active_sidebar('ad_bottom_seeker_dashboard')){
					dynamic_sidebar('ad_bottom_seeker_dashboard');
				}
				?>
			</div>
		</div>
	</section>

	<?php endwhile; ?>


<?php get_footer('seekerdasboard'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	
	jQuery(document).ready(function(){

		jQuery('select[name="select_problem_type"]').on('change', function(){
			var thisVal = jQuery(this).val();
			if ( thisVal == 'Other' ) {
				jQuery('.otheproblem').show();
				jQuery('input[name="other_problem"]').show().val('');
			}
			else{
				jQuery('.otheproblem').hide();
				jQuery('input[name="other_problem"]').hide().val('');
			}

			jQuery('input[name="problem_type"]').val(thisVal);
		});

		jQuery('input[name="other_problem"]').on('keyup', function() {
			var thisVal = jQuery(this).val();
			jQuery('input[name="problem_type"]').val(thisVal);
		});

		jQuery(".visibilitys").on('click',function(){
			var current = jQuery(this);
			var status = jQuery(this).data('status');
			jQuery('#loaders').show();
			var imgurl = '<?php echo get_stylesheet_directory_uri()."/img/visibility_success.jpg"; ?>';
			jQuery.ajax({
		            type: 'POST',
		            dataType: 'json',
		            url:'<?php echo site_url();  ?>/wp-admin/admin-ajax.php',
		            data: {
		                'action': 'visibility', //calls wp_ajax_nopriv_ajaxlogin
		                'status': status, 
		                'userid': <?php  echo $user_id;  ?> },
		            success: function(data){
						jQuery('#loaders').hide();
		                if (data.success == true){
		                	jQuery('.visibilitys').removeClass('active');
		                	current.addClass('active')
		                	swal({
		                		imageUrl: imgurl,
								title: "Congratulations !", 
								html: true,
								text: "<span class='text-center'>You have successfully updated <br> your Visibility Settings!</span>",
								//type: "success",
								confirmButtonClass: "btn-success btn-sm",
								confirmButtonText: "Continue",
								customClass: "visib_swal"
							});
		                	//jQuery.notify("Successfully update Visibility !", "success");
		                }else{
		                
		                }
		            }
		    });
		});
	});
</script>

<div class="modal fade sendamail" id="sendamail" tabindex="-1" role="dialog" aria-labelledby="sendamailLabel">
  <?php echo recrutier_contact_now(); ?>
</div> 

<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedbackLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
      	<h3>Got Feedback?</h3>
      	<h5>We want to be kick ass. Help us get there!</h5>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4457" title="Feedback seeker" html_id="give_us_ur_feedback" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="yourstory" tabindex="-1" role="dialog" aria-labelledby="yourstoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Your Story Has Taken A Lifetime</h3>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4562" title="Tell Us Your Story" html_id="tell_us_ur_stry" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="aboutproblem" tabindex="-1" role="dialog" aria-labelledby="aboutproblemLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Create a Trouble Ticket</h3>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4563" title="Tell us about a Problem" html_id="tell_us_abt_prblm" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="visit_the_help_center" tabindex="-1" role="dialog" aria-labelledby="aboutproblemLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Help us spread the word!</h3>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4624" title="Visit the help center" html_id="visit_the_help_center_id" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		setTimeout( function() {
			var ticid = jQuery('#submitbPobe').attr('ticketID');
			jQuery('#ticketnoid').val(ticid);
		},500);
	});
</script>

<div class="modal fade" id="invite_a_colleague" tabindex="-1" role="dialog" aria-labelledby="invite_a_colleagueLabel">
 	<div class="vertical-alignment-helper">
	    <div class="modal-dialog modal-lg vertical-align-center" role="document">
		    <div class="modal-content invite_frnd">
		        <div class="modal-body">
			        <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			        <h3>Help us spread the word!</h3>
			        <div class="clearfix"></div>
			        <form class="wpcf7-form form-horizontal ">
				        <p>Once your friends & colleagues sign up with EyeRecruit.com, they will be immediately upgraded and receive the Premium Subscription for FREE!  Just for helping them get started, you will also be rewarded too. Keep checking your Network within your Preferences tab and how the Credits you have earned add up!  There are no limits! Biggest Networks have a chance at becoming a Paid Recruiter! </p>
				        <p>When you click the ‘Submit’ button and e-mail message with your comments will be sent to your friend. Thank you for telling your friends and colleagues about us. </p>
				      	<div  class="row">
				      		<div class="col-md-8">
						      	<div id="userdetail_all_fields">
									<div id="userdetail_pr_1" class="edit-main-dv">
										<div class="form-group">
											<label class="col-sm-4 control-label" for="fname">Name:</label>
											<div class="col-sm-8">
												<input id="fname_1" class="regular-text code form-control" name="fname[]" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label" for="user_email">To e-mail address:</label>
											<div class="col-sm-8">
												<input id="user_email_1" class="regular-text code form-control" name="user_email[]" type="text" />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-8 col-sm-offset-4 remove_btn ">
										<a id="userdetail_add_more" count="1" class="userdetail_add_more">+ Add More Recipients</a>
									</div>
								</div>
								<!-- <div class="form-group">
					                <label for="your-name" class="col-sm-4 control-label">To e-mail address:</label>
									<div class="col-sm-8">
										<input name="to_email_address" value="" size="40" class="form-control" aria-invalid="false" type="email">
									</div>
								</div> -->
								<div class="form-group">
				                	<label for="your-name" class="col-sm-4 control-label">Subject:</label>
									<div class="col-sm-8">
										<input name="subject" value="<?php echo $data->first_name; ?> sent this message for you" size="40" class="wpcf7-form-control wpcf7-text form-control" aria-invalid="false" type="text" readonly>
									</div>
								</div>
								<div class="form-group" id="msg_cont">
								    <label for="user_msg" class="col-sm-4 control-label">Comments:</label>
									<div class="col-sm-8">
										<div class="regular-text code form-control" name="user_msg">
											<p>After seeing this site I’m forwarding this link to you as it is only for us in the Security, Investigation & Surveillance industry. </p>
											<p>Besides allowing me to keep all of my career documents in a single place, I can express interest in openings, forward a link for someone to find out more about me, Employers can search for me by my experience 24/7 and industry jobs are posted here that are not posted anywhere on the web!</p>
											<p>If you know someone else, that like us, need could use a support a team, forward this message! </p>
											<p>Go to: <a href="<?php echo site_url(); ?>/job-seekers/">EyeRecruit.com/job-seekers</a></p>
											<?php echo $data->first_name.' '.$data->last_name; ?>
										</div>
									</div>
								</div>
							</div>
				      		<div class="col-md-4">
				      			<div class="popup_invite">
									<div class="form-group">
					                	<label for="your-name" class="control-label">Your Invite URL to share paste it in your blog!</label>
										<input name="subject" value="" size="40" class="wpcf7-form-control wpcf7-text form-control" aria-invalid="false" type="text" placeholder="http://www.">
									</div>
									<div class="form-group">
					                	<label for="your-name" class="control-label">Or invite via social Media</label>
					                	<a href="#" class="invite_link"><i class="fa fa-twitter-square" aria-hidden="true"></i> Tweet on Twitter</a>
					                	<a href="#" class="invite_link"><i class="fa fa-facebook-square" aria-hidden="true"></i> Share on Facebook</a>
					                	<a href="#" class="invite_link"><i class="fa fa-linkedin-square" aria-hidden="true"></i> post on Linkedin</a>
					                	<a href="#" class="invite_link"><i class="fa fa-google-plus-square" aria-hidden="true"></i> Share on Google+</a>
									</div>
				      			</div>
							</div>
						</div>
						<div class="form-group text-center row">
							<div class="col-md-8">
								<div class="row">
								<div class="col-md-8 col-md-offset-4">
	    							<button id="inv_a_coll" type="button" class="btn btn-default btn-sm">Submit</button>
	    							<button type="button" class="close_btn" data-dismiss="modal" aria-label="Close">Cancel</button>
								</div>
								</div>
							</div>
						</div>
						<p class="text-right"><a href="#">Referrals Terms & Conditions</a></p>
						<!-- <div class="form-group" id="msg_cont">
							<label class="control-label" for="user_msg">Your Message</label><br>
							<textarea id="user_msg" class="regular-text code form-control" name="user_msg" readonly>
								Hello < >,
								I recently became a member of an interesting service that is allowing me to manage my own career within the industry I am passionate about.  Besides allowing me to store and forward all of my career documents digitally, it also allows me to better present myself and my accomplishments to potential Employers that I am interested in and that are interested in me.
								I am just starting to gather letters of recommendation to assist my future career aspirations and I immediately thought of you. Would you be able to write a strong letter of recommendation on my behalf? As someone who knows me, is familiar with my work and achievements from a portion of my life, I would greatly appreciate your help. Don’t feel that you are under pressure.  There is no deadline.  
								The link below will allow you to upload a PDF directly to my profile or if you would like I can send you a self addressed envelope. I would also be more than happy to meet with you at your convenience to refresh your memory of me if that would be helpful. Of course I would also provide my personal contact information, my resume, and any other material that you would like for your records. 
								I realize that writing a letter of recommendation will be a burden on your time and it means a lot to me that you would take time to read and consider my request. If you don’t have time to write it, perhaps I could write something for you to review and if it looks all right, you could sign it?
								Sincerely,
								<?php //echo $data->first_name.' '.$data->last_name; ?>
							</textarea>
						</div> -->


						<!-- <div class="text-center">
				        	<button id="inv_a_coll" type="button" class="btn btn-primary btn-sm">Send</button>
				        	<button type="button" class="close_btn" data-dismiss="modal">Close</button>
						</div> -->
					</form>
		      	</div>
		    </div>
	  	</div>
	</div>
</div>

<?php
$guidenewUserTour = get_user_meta($user_id, 'guidenewUserTour', true);
$guidenewUserAsses = get_user_meta($user_id, 'guidenewUserAsses', true);
$guidenewUserBegin = get_user_meta($user_id, 'guidenewUserBegin', true);

function seekerCookieTourChecker(){
	$guidenewUserTour = get_user_meta($user_id, 'guidenewUserTour', true);
$guidenewUserAsses = get_user_meta($user_id, 'guidenewUserAsses', true);
$guidenewUserBegin = get_user_meta($user_id, 'guidenewUserBegin', true);

	if( !empty($guidenewUserBegin) ){
		setcookie('seekerTourStep', 'finishedIntro', time() + (86400 * 30), "/"); // 86400 = 1 day
		return;
	}
	
	if( !empty($guidenewUserAsses) ){
		setcookie('seekerTourStep', 'docs', time() + (86400 * 30), "/"); // 86400 = 1 day
		return;
	}
	
	if( !empty($guidenewUserTour) ){
		setcookie('seekerTourStep', 'assessments', time() + (86400 * 30), "/"); // 86400 = 1 day
		return;
	}
	setcookie('seekerTourStep', 'initial', time() + (86400 * 30), "/"); // 86400 = 1 day
}
////COOKIE MGT
seekerCookieTourChecker();

if ( empty($guidenewUserTour) && empty($guidenewUserAsses)) { ?>
	<script type="text/javascript"> jQuery(document).ready( function() { jQuery('#WelcomeJobSee1').modal('show');  }); </script>
	<?php
} 

if ( empty($guidenewUserTour) && !empty($guidenewUserAsses)) { ?>
	<script type="text/javascript"> jQuery(document).ready( function() { jQuery('#WelcomeJobSee3').modal('show'); }); </script>
	<?php
} 

if ( !empty($guidenewUserTour) && empty($guidenewUserAsses) ) { ?>
	<script type="text/javascript"> jQuery(document).ready( function() { jQuery('#WelcomeJobSee2').modal('show'); }); </script>
	<?php 
}

if ( !empty($guidenewUserTour) && !empty($guidenewUserAsses) && empty($guidenewUserBegin) ) { ?>
	<script type="text/javascript"> jQuery(document).ready( function() { jQuery('#WelcomeJobSee4').modal('show'); }); </script>
	<?php update_user_meta($user_id, 'guidenewUserBegin', 'Yes');
}


 /*update_user_meta($user_id, 'guidenewUserTour', '');
 update_user_meta($user_id, 'guidenewUserAsses', '');
 update_user_meta($user_id, 'guidenewUserBegin', '');*/
?>



<script type="text/javascript"> 
	jQuery(document).ready( function() { 

		jQuery('.dontShowPopup').on('click', function() {
			jQuery('#WelcomeJobSee1, #WelcomeJobSee2 ,#WelcomeJobSee3').modal('hide');
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url("admin-ajax.php"); ?>',
				data: {
					action: 'hidWelcomeAllPopup'
				},
				success: function(res){
					jQuery('#WelcomeJobSee1').modal('hide');
				}
			});
		});
		

		if(jQuery( 'input[name="good_value_for_cost"]:checked' ).val()=='No'){
			jQuery('.textarea_sm').show();
		}

		jQuery('#takeaTour1').on('click', function(e) {
			e.preventDefault();
			jQuery('#WelcomeJobSee1').modal('hide');
			jQuery('#WelcomeJobSee3').modal('show');
		});

		jQuery('#beginselfAsses1').on('click', function() {
			jQuery('#WelcomeJobSee1').modal('hide');
			jQuery('#WelcomeJobSee2').modal('show');
		});

		jQuery('#beginselfAsses2').on('click', function() {
			jQuery('#WelcomeJobSee2').modal('hide');
			jQuery('html, body').animate({
		        scrollTop: jQuery('#assesSection').offset().top - 10
		    }, 500);
		});
        
       jQuery('input[name="good_value_for_cost"]').change(function(){
			var value = jQuery( 'input[name="good_value_for_cost"]:checked' ).val();
			if(value=="No"){
				jQuery('.textarea_sm').show();
			}else{
				jQuery('.textarea_sm').hide();
				jQuery('textarea[name="how_accomplish_goal"]').val('');
			}
	    });


	}); 
</script>



<div class="modal fade" id="WelcomeJobSee1" tabindex="-1" role="dialog" aria-labelledby="WelcomeJobSee1ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-body tour_modal">
	        <button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			<h3>Welcome to the future of Employment</h3>
	        <div class="clearfix"></div>
	        <form id="tell_us_abt_prblm" class="wpcf7-form">
	        	<p>Now you have access to the latest tools that you will need to be successful. Optimize your career though the use of smarter technology. What you do with it is up to you. Job Seekers have become more sophisticated and employers, society and how we work together is being changed at a rate like never before in history. How it was being done yesterday is not how it will be done tomorrow.</p>
	        	<p>You are moving in the direction of building your personal brand, through a professional career profile. More options, more control, more connection, more opportunities.  Everything is now at your fingertips. We have developed a few things within the system that will help you on your journey to the career you want and the future you desire. Take advantage all of them. If you think of something we didn’t, let us know so we can build tomorrow today. </p>
	        	<p>Take a minute now to complete the Self Assessment sections so the become searchable or start by taking a brief tour of your profile so you know how you can maximize your results starting today. </p>
				<div class="text-center form-group">
					<button class="btn btn-primary" id="takeaTour1">Take the Tour</button>
			        <!-- <button type="button" class="btn btn-primary" id="beginselfAsses1" >Begin the Self Assessments</button> --> <!-- data-dismiss="modal" -->

			        <a href="<?php echo site_url();  ?>/job-seekers/abilities-assessment/" class="btn btn-primary">Begin the Self Assessments</a>
			        <div class="checkbox">
					    <label>
					      <input type="checkbox" class="dontShowPopup"> <span>Don't show again.</span>
					    </label>
					</div>
			    </div>

			</form>
	  	  </div>
  	  </div>
    </div>
  </div>
</div>

<div class="modal fade" id="WelcomeJobSee2" tabindex="-1" role="dialog" aria-labelledby="WelcomeJobSee2ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-body tour_modal">
	        <button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			<h3>Many Researchers are estimating that 50% of workers will be independent contractors within the next decade.</h3>
	        <div class="clearfix"></div>
	        <form id="tell_us_abt_prblm" class="wpcf7-form">
	        	<p>Unique experience and skills is the biggest advantage any Job Seeker can have. It gives you a way to differentiate yourself from any other candidate and for you to be in higher demand to a wider group of potential employers. It’s no longer about an opportunity down the street or across town, the global marketplace is now open to all.  Where will your journey take you? One thing that will not change here, there or anywhere:<br>
				<em>The Company with the best people wins.</em></p>
				<p>Moving up no longer means selling out.  The key to success will be found in your ability to develop skills and relationships in the workplace. No matter where you go, you are building on the foundation of success. Follow your passion. Go in the direction of your interests. Keep growing, keep learning, keep connecting.  No one has your exact skills, qualifications, knowledge or abilities. This is where the Self Assessments will help you be found by the Decision Makers who are looking for someone with your exact qualifications, skills, knowledge, abilities and experience. Be found.</p>
				<div class="text-center">
			        <button type="button" class="btn btn-primary" id="beginselfAsses2">Begin the Self Assessments</button>
					<a id="btn-seekerDashboardTourRepeat" href="javascript:void(0);" class="btn btn-primary">Take the Tour Again!</a>
					<div class="checkbox">
					    <label>
					      <input type="checkbox" class="dontShowPopup"> <span>Don't show again.</span>
					    </label>
					</div>
			    </div>
			</form>
	  	  </div>
  	  </div>
    </div>
  </div>
</div>

<div class="modal fade" id="WelcomeJobSee3" tabindex="-1" role="dialog" aria-labelledby="WelcomeJobSee3ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-body tour_modal">
	        <button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			<h3>An exclusive network built by <br>and populated from the industry.</h3>
	        <div class="clearfix"></div>
	        
	        	<p>There is a major talent shortage going on in our industry.  Baby boomers are or have already retired and there is not enough Generation X applicants to fill the void. The competition is now coming from the Millennial Generation. Millennials already compose 50% of the workforce.  By all indication they are already advancing quickly and the most important thing, according to research, is their desire for training.  Until they have the experience, they will be forced to accept the lower paying positions. There is no better time to have experience than right now.</p>
	        	<p>The future is not found in a body filling a seat, it is the brain that fills the body that is filling the seat.  Every job, even now, is temporary. Job security isn’t a guarantee for anyone. There is another shift taking place. Employers are actively searching for better more qualified candidates and they are building pipelines of potential candidates for the shift that has already started. Put yourself in a position of strength. Highlight your strengths. Let them get to know you. Let them follow your career.  The tour will show you how to do this and more. </p>
				<div class="text-center">
                
					<a id="btn-seekerDashboardTourInitial" href="javascript:void(0);" data-user-id="<?php echo get_current_user_id();?>"   class="btn btn-primary">Begin the Tour</a>
					 <form id="tell_us_abt_prblm" class="wpcf7-form">
                    <div class="checkbox">
					    <label>
					      <input type="checkbox" class="dontShowPopup"> <span>Don't show again.</span>
					    </label>
					</div>
                    </form>
			    </div>
			
	  	  </div>
  	  </div>
    </div>
  </div>
</div>

<div class="modal fade" id="WelcomeJobSee4" tabindex="-1" role="dialog" aria-labelledby="WelcomeJobSee4ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-body tour_modal">
	        <button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			<h3>A career is more than just a resume. <br>Let's investigate the possibilities together.</h3>
	        <div class="clearfix"></div>
	        <form id="tell_us_abt_prblm" class="wpcf7-form">
	        	<p>Now that you have completed the Self Assessments and taken the Tour, continue building your Professional Career Profile.  Upload all of your documents including your most current Resume, Certificates of Achievement, Licensing and any and all Honors & Awards you have compiled. Scan all important Career and educational documents and uploading them, even if you decide to keep them confidential. While it is not mandatory, it is also suggested that you take full advantage of our automated Video Interviewing portal.  A pre-recorded interview, to most of the most basic questions that would be asked during the initial stages, is the most advantageous way to present yourself to Decision Makers 24 hours a day, 7 days a week.  Record your answers from a controlled environment and re-recorded and polish your responses until you are completely satisfied. </p>
	        	<p>Once you feel confident that your profile is an accurate representation of you at this stage of your career, you can change the Visibility Setting to Visible so Employers & Recruiters will be able to locate your profile during a search, so you will be able to save or show immediate interest to job postings on the Job Board and so you can reach out, on or off the platform, and begin following Employers that interest you. If you need support from a Recruiter, reach out at anytime.</p>
				<div class="text-center">
					<p><button type="button" class="btn btn-primary" data-dismiss="modal">Begin</button></p>
			    </div>
			</form>
	  	  </div>
  	  </div>
    </div>
  </div>
</div>
<?php 
$user_id  			= get_current_user_id();
$spotlight_status 	= get_usermeta($user_id, 'spotlight_status',true);
if($spotlight_status == 'yes'){
	$value = 'no';
}elseif($spotlight_status =='no'){
	$value = 'yes';
}else{

	$value = 'yes';
}
?>

<div class="modal fade member_popup" id="applyModalspoot" tabindex="-1" role="dialog" aria-labelledby="applyModalspootLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content recommendation_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="<?php  echo site_url();  ?>/assets/themes/eye-recruit-2015/img/icon-eye-magnifying-glass.png" class="popup_logo">
                    <h3>Membership Spotlight</h3>
                    <div class="text-center staying_text">
                    	<p>Staying in the Spotlight boosts your chances of being<br> seen by a Recruiter or your next Employer!</p>
                    </div>
                    <div class="checkbox-slider--b">
						<label>
							<strong>Set to On</strong>
							<input type="checkbox" value="<?php echo $value; ?>" name="spotlight_check" class="CP_DES_GOAL_CAREER" id="spotlight_check"  <?php if($spotlight_status =='yes'){ echo 'checked'; } ?>><span></span>
							<strong>Set to Off</strong>
						</label>
					</div>
					<div class="main_title_box">
						<span><strong>On</strong> - Your profile <strong>will be</strong> featured to the maximum extent available!</span><br>

						<span><strong>Off</strong> - Your profile <strong>will not be</strong> featured or advertised and would loose<br> the advantage of reaching the maximum number of Decision Makers.</span>
					</div>
                    <p class="by_choose">By choosing to accept to be featured in the Spotlight, your non-private information will be highlighted not only within in the Membership, but outside the Platform as well to draw more attention to the platform. The more people that view your account the more opportunities you have for advancement.  Please see our <strong>Privacy Agreement and Terms of Use</strong> for more detailed information. </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('input[name="spotlight_check"]').on('click', function() {
			jQuery('#loaders').show();
			var statusvalue = jQuery(this).val();
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url("admin-ajax.php"); ?>',
				data: {
					action: 'spotlight',status:statusvalue
				},
				success: function(res){
					jQuery('#loaders').hide();
					if(res == 'yes'){
						//alert('yes');
						jQuery('input[name="spotlight_check"]').val('no');
						jQuery('#bfeatured').html('Featured in Spotlight.');
					}else{
						jQuery('input[name="spotlight_check"]').val('yes');
						//alert('no');
						jQuery('#bfeatured').html('Be Featured in Spotlight.');
					}
					//jQuery('#WelcomeJobSee1').modal('hide');
				}
			});
			
		});

	});

</script> 

<div class="modal fade" id="prices_lock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!-- <div class="clearfix"></div> -->
        <form id="tell_us_abt_prblm" class="wpcf7-form plock_popup">
			<div class="text-center">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/prices_lock.png" class="img-responsive" alt="pricing_lock">
		    </div>
			<p>To show our appreciation to those in our community, we offer a Price Lock Guarantee. <span>The cost of your membership will never increase</span> from the day you sign up as a user... as long as you have never canceled or lost your membership privileges and all your payments have been continuously made. If you neglect your account and fail to keep current, your monthly and yearly membership pricing will be as advertised at the time of purchase.</p>
			<p>Sincerely</p>
			<p>Christopher Bauer <br>Founder & Lead Recruiter <br>EyeRecruit, Inc.</p>
		</form>
  	  </div>
    </div>
  </div>
</div>

<div class="modal fade welcome_back" id="welcome_back" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content absolutely_free_popup">
                <div class="modal-body">
		            <button aria-label="Close" data-dismiss="modal" class="close profile_pic_close_button" type="button"><span aria-hidden="true">&times;</span>
		            </button>
		             
		            <h3>Welcome back <?php echo get_user_meta($user_id,'first_name',true); ?>!</h3>
		            <div class="clearfix"></div>

		            <h4>Before we begin, has anythinged changed since you last visit with us?</h4>

		            <ul class="list_check">
		            	<li>
		            		<div class="checkbox">
							    <label>
							      <input type="checkbox" id="check_no">
							      <span class="c_check"></span>
							      Nope, let's get to work!
							    </label>
							</div>
		            	</li>
		            	<li>
		            		<div class="checkbox">
							    <label>
							      <input type="checkbox" id="check_yes">
							      <span class="c_check"></span>
							      Actually yes. <!-- <small>(opens the following)</small> -->
							    </label>
							</div>
							<ul id="sub_yes" style="display: none;">
								<li>
									<div class="checkbox">
									    <label>
									      <input type="checkbox" id="resume">
									      <span class="c_check"></span>
									      I need to update Resume <!-- <small>(opens the Resume section)</small> -->
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox">
									    <label>
									      <input type="checkbox" id="contact">
									      <span class="c_check"></span>
									      I need to update my Contact Info <!-- <small>(opens to account management)</small> -->
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox" id="skills">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I need to update my Skills Assessments <!-- <small>(opens drowpdown for six listed to direct)</small> -->
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox" id="handle">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I can handle it myself<!--  <small>(Closes window to seeker dashboard)</small> -->
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox" id="recruiter">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I need to discuss it with a Recruiter <!-- <small>(opens the Contact now window)</small> -->
									    </label>
									</div>
								</li>
							</ul>
		            	</li>
		            </ul>
		        </div>
            </div>
        </div>
    </div>
</div>
<?php

if ( !empty($guidenewUserTour) && !empty($guidenewUserAsses) && !empty($guidenewUserBegin) ) { ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
		if (typeof jQuery.cookie('visited') === 'undefined'){
 //no cookie
 	var date = new Date();
			date.setTime(date.getTime() + (30 * 1000));
		   	jQuery.cookie('visited', 'yes', { expires: 30 }); 
} else {
 //have cookie
 //start welcome back modal
 jQuery('#welcome_back').modal('show');
 	
		   	jQuery('input:checkbox').removeAttr('checked');
			jQuery('#check_yes').change(function(){
	        if(this.checked)
	            jQuery('#sub_yes').show(500);
	        else
	            jQuery('#sub_yes').hide(500);
    	});
		jQuery('#check_no').change(function(){
		  if(this.checked){
		  	jQuery('#welcome_back').modal('hide');
		  }
		});

		jQuery("#resume").click(function() {
		    var url = "<?php echo site_url(); ?>/job-seekers/resume/";
		    window.location.href = url;
		});
		jQuery("#contact").click(function() {
		    var url ="<?php echo site_url(); ?>/preferences/contact-information/";
		    window.location.href = url;
		});
		jQuery("#skills").click(function() {
		    var url ="<?php echo site_url(); ?>/job-seekers/abilities-assessment/";
		    window.location.href = url;
		});
		jQuery("#handle").click(function() {
		    jQuery('#welcome_back').modal('hide');
		});
		jQuery("#recruiter").click(function() {
			  jQuery('#sendamail').modal('show');
		      jQuery('#welcome_back').modal('hide');
		});
			 ///end welcome back modal
}
	
		   
		 
	});
</script>
<?php }else{ ?>
<script>
if (typeof jQuery.cookie('visited') === 'undefined'){
 //no cookie
 	var date = new Date();
			date.setTime(date.getTime() + (30 * 1000));
		   	jQuery.cookie('visited', 'yes', { expires: 30 }); 
} 
</script>
<?php } ?>
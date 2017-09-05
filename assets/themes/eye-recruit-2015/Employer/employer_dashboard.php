<?php
/**
 * Template Name:Employer Dashboard  Page
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
		<h1 class="page-title">Dashboard<?php //the_title(); ?></h1>
	</header>
	<div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
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
						<div class="col-sm-3 col-md-2 text-right">-->
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
						<h2>
						<?php  
							$compName = get_user_meta($user_id, 'company', true);
							echo  (($compName)) ? $compName : 'Not define';
						?>
						</h2>
						<h5><strong>Employer ID :</strong> <?php echo $user_id; ?></h5>
					</div>
					<div class="col-md-4 col-sm-6">
						<p class="text-center"><strong>Member Since : </strong><?php echo  date( "F dS, Y", strtotime($user->user_registered)); ?></p>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="seeker-timings">
							<p class="text-center">
								
								<strong>Today's Date: </strong>
								<?php 
								date_default_timezone_set('US/Eastern');
								echo date('l, F dS Y'); 
								?>
							</p>	
							<p class="text-center seeker-cur-time">	
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
					    </div><!-- seeker-timings -->
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
								<li class="col-xs-5 devicefull">
									<strong>Industry Sector : </strong>
									<?php  
									$EMP_INDUS_REF_SRVICE = get_cimyFieldValue($user_id,'EMP_INDUS_REF_SRVICE'); 
									if ( !empty( $EMP_INDUS_REF_SRVICE ) ) {
										$EMP_INDUS_REF_SRVICEArr = explode(',', $EMP_INDUS_REF_SRVICE);
										echo implode(' , ', $EMP_INDUS_REF_SRVICEArr); 
									}
									?>
								</li>
								
								<li class="col-xs-7 devicefull">
									<strong>Closest Metropolitan Area : </strong>
									<?php  echo get_cimyFieldValue($user_id,'EMP_AREA_TO_B_SEARCH'); ?>
								</li>
								
								<li class="col-xs-5 devicefull">
									<strong>Active Offices : </strong>
									<?php  
									$EMP_OFFICES_IN_STATE = get_cimyFieldValue($user_id,'EMP_OFFICES_IN_STATE'); 
									if ( !empty( $EMP_OFFICES_IN_STATE ) ) {
										$EMP_OFFICES_IN_STATEArr = explode(',', $EMP_OFFICES_IN_STATE);
										echo implode(' , ', $EMP_OFFICES_IN_STATEArr); 
									}
									?>
								</li>
								
								<li class="col-xs-5 devicefull">
									<strong>Head Office : </strong>
									<?php  
									if ( !empty( $EMP_OFFICES_IN_STATE ) ) {
										$EMP_OFFICES_IN_STATEArr = explode(',', $EMP_OFFICES_IN_STATE);
										echo implode(' , ', $EMP_OFFICES_IN_STATEArr); 
									}
									?>
								</li>
								
								<li class="col-xs-7 devicefull"><strong>Employees </strong><?php  echo get_cimyFieldValue($user_id,'EMP_NO_EMP_ON_TEAM'); ?></li>
							</ul>
							<a href="<?php echo site_url();  ?>/employers-basic-information/" class="btn btn-primary btn-sm">Update</a>
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
								<li class="col-xs-5 devicefull"><strong>Name : </strong><?php echo $fname.'  '.$lname; ?></li>
								
								<li class="col-xs-7 devicefull">
									<strong>Company Position : </strong>
									<?php 
									$EMP_YR_POS_IN_ORGN =  get_cimyFieldValue($user_id,'EMP_YR_POS_IN_ORGN');
									if ( !empty( $EMP_YR_POS_IN_ORGN ) ) {
										$EMP_YR_POS_IN_ORGNArr = explode(',', $EMP_YR_POS_IN_ORGN);
										echo implode(' , ', $EMP_YR_POS_IN_ORGNArr); 
									}
									?>
								</li>
								
								<li class="col-xs-5 devicefull">
									<strong>Head Office : </strong>
									<?php  
									if ( !empty( $EMP_OFFICES_IN_STATE ) ) {
										$EMP_OFFICES_IN_STATEArr = explode(',', $EMP_OFFICES_IN_STATE);
										echo implode(' , ', $EMP_OFFICES_IN_STATEArr); 
									}
									?>
								</li>
								
								<li class="col-xs-7 devicefull"><strong>Closest Metropolitan Area : </strong><?php  echo get_cimyFieldValue($user_id,'EMP_AREA_TO_B_SEARCH'); ?></li>
								
								<li class="col-xs-5 devicefull"><strong>Experience : </strong><?php  echo get_cimyFieldValue($user_id,'EMP_EXPERIENCE'); ?></li> 
								
								<li class="col-xs-7 devicefull"><strong>Company Name : </strong><?php  echo get_user_meta($user_id, 'company', true); ?></li> 
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
								<a href="<?php echo site_url();  ?>/employers/post-a-job/" class="col-sm-4 col-xs-12 devicehalf">
									<h6>Post a job</h6>
									<i class="nav_icons postjob_icon"></i>
								</a>
								<a href="<?php echo site_url();  ?>/employers/manage-jobs/" class="col-sm-4 col-xs-12 devicehalf">
									<h6>Manage jobs</h6>
									<i class="nav_icons resume_icon"></i>
								</a>
								<a href="<?php echo site_url();  ?>/employers/search-candidates/" class="col-sm-4 col-xs-12 devicehalf">
									<h6>Search Seeker</h6>
									<i class="nav_icons searchs_icon"></i>
								</a>
							</div>
							<div class="row">
								<a href="<?php echo site_url(); ?>/find-a-job/" class="col-sm-4 col-xs-12 devicehalf">
									<h6>Job Dashboard</h6>
									<i class="nav_icons connect_icon"></i>
								</a>
								<a href="<?php echo site_url(); ?>/my-account/orders/" class="col-sm-4 col-xs-12 devicehalf">
									<h6>My Subscription</h6>
									<i class="nav_icons featuredm_icon"></i>
								</a>
								
								<a href="<?php  echo site_url(); ?>/employer-pricing/" class="col-sm-4 col-xs-12 devicehalf"> <?php //echo site_url().'/employer-pricing/';   ?>
									<h6>Jobs Pricing</h6>
									<i class="nav_icons license_icon"></i>
								</a>
							</div>
						</div>
					</div>
					

					<div class="support_serv">
						<div class="section_title">
							<h3>Support Servies</h3>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-12 devicehalf">
								<a href="<?php echo site_url(); ?>/employers/interview-support/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-interview.png" class="img-responsive">
									<h6>Interview <br>Support</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-12 devicehalf">
								<a href="<?php echo site_url(); ?>/employers/compensation-negotiation/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icons-salary.png" class="img-responsive">
									<h6>Compensation <br>Negotiation</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-12 devicehalf">
								<a href="<?php echo site_url(); ?>/employers/relocation-assistance-program/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-truck.png" class="img-responsive">
									<h6>Relocation <br>Assistance Program</h6>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 col-xs-12 devicehalf">
								<a href="<?php echo site_url(); ?>/employers/on-boarding-orientation/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/01/icon-training.png" class="img-responsive">
									<h6>On-Boarding & <br>Orientation</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-12 devicehalf">
								<a href="<?php echo site_url(); ?>/employers/transition-support/">
									<img src="<?php echo site_url();  ?>/assets/uploads/2015/02/icon-direction.png" class="img-responsive">
									<h6>Transition <br>Support</h6>
								</a>
							</div>
							<div class="col-sm-4 col-xs-12 devicehalf">
								<a href="<?php echo site_url(); ?>/employers/retention-performance-consulting/">
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
								<li><strong>{#} </strong>- Times profile has been viewed.</li>
								<li><strong>{#} </strong>- Times profile added to favorites.</li>
								<li><strong>{#} </strong>- Times profile was forwarded.</li>
								<li><strong>{#} </strong>- Currently following your career.</li>
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
							<?php get_template_part( 'seeker_dasboard_templates/content', 'profile_visibility' ); ?>
							<!-- <ul>
								<li class="visibility_everyone active">Visible to Everyone <span></span></li>
								<li class="visibility_only">Recruiters Only <span></span></li>
								<li class="visibility_invisible">You’re Invisible <span></span></li>
							</ul> -->
						</div>
						<div id="afterVote" style="display:none;">
							<?php //the_field('left_side_add'); ?>
							<?php
							if(is_active_sidebar('ad_employer_dashboard_after_survey')){
								dynamic_sidebar('ad_employer_dashboard_after_survey');
							}
							?>
						</div>
						<div class="light_box chlng_quest" id="poll_opinion_body" imgUrl="<?php echo get_stylesheet_directory_uri().'/img/ad4.jpg'; ?>">
							<?php get_template_part( 'Employer/content', 'emp_question_survey' ); ?>
						</div>
						<div class="light_box quick_links">
							<div class="sidebar_title">
								<span class="title_icon quicklink_icon"></span>
								<h4>Quick Links</h4>
							</div>
							<ul>
								<li><a href="#" data-target="#aboutproblem" data-toggle="modal">Tell us about a Problem </a></li>
								<li><a href="#" data-toggle="modal" data-target="#feedback">Give us your feedback</a></li>
								<li><a href="<?php echo site_url();  ?>/employers-basic-information">Preferences</a></li>
								<li><a href="<?php echo site_url();  ?>/employer-resources/">Resources</a></li>
								<li><a href="#" data-toggle="modal" data-target="#visit_the_help_center">Visit the help center</a></li>
								<li><a href="#" data-toggle="modal" data-target="#yourstory">Tell Us your story</a></li>
							</ul>
						</div>
						<div class="light_box tips">
							<?php get_template_part( 'Employer/content', 'employertips' ); ?>
						</div>
						<div class="light_box snap_shot">
							<div class="sidebar_title">
								<span class="title_icon snapshot_icon"></span>
								<h4>Snap Shot</h4>
							</div>
							<ul>
								<li><span>Best Reflects Your Companies Services :</span><?php  echo get_cimyFieldValue($user_id,'EMP_INDUS_REF_SRVICE'); ?></li>
								<li><span>Multiple American Locations :</span><?php  echo get_cimyFieldValue($user_id,'EMP_TEAM_IN_MULTILOC'); ?></li>
								<li><span>Internships Available :</span><?php  echo get_cimyFieldValue($user_id,'EMP_R_INTRNSIP_AVBL'); ?></li>
							</ul>
							<div class="text-center">
								<a href="<?php site_url();  ?>/employers-basic-information/" class="btn btn-primary">See All</a>
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
							<a href="javascript:void(0);" data-target="#sendamail" data-toggle="modal">Contact Now</a>
						</div>
						<div class="jobsearch_form dark_box">
							<div class="sidebar_title">
								<h4>Candidate Search</h4>
							</div>
							<form class="form" action="<?php echo site_url(); ?>/employers/search-candidates/" method="POST">
								<div class="form-group">
								    <label for="keywords">Keywords</label>
								    <input type="text" class="form-control" id="keyword_search" name="keyword_search" placeholder="Enter Keywords">
								</div>
								<div class="form-group  has-feedback">
								    <label for="location_input">Location</label>
								    <?php
									$majorM_Arr = array('New York','Los Angeles','Chicago','Houston','Philadelphia','Phoenix','San Antonio','San Diego','Dallas','San Jose','Austin','Jacksonville','San Francisco','Indianapolis','Columbus','Fort Worth','Charlotte','Seattle','Denver','El Paso','Detroit','Washington','Boston','Memphis','Nashville','Portland','Oklahoma City','Las Vegas','Baltimore','Louisville','Milwaukee','Albuquerque','Tucson','Fresno','Sacramento','Kansas City','Long Beach','Mesa','Atlanta','Colorado Springs','Virginia Beach','Raleigh','Omaha','Miami','Oakland','Minneapolis','Tulsa','Wichita','New Orleans','Arlington','Cleveland','Bakersfield','Tampa','Aurora','Honolulu','Anaheim','Santa Ana','Corpus Christi','Riverside','St. Louis','Lexington','Stockton','Pittsburgh','Saint Paul','Anchorage','Cincinnati','Henderson','Greensboro','Plano','Newark','Toledo','Lincoln','Orlando','Chula Vista','Jersey City','Chandler','Fort Wayne','Buffalo','Durham','St. Petersburg','Irvine','Laredo','Lubbock','Madison','Gilbert','Norfolk','Reno','Winston–Salem','Glendale','Hialeah','Garland','Scottsdale','Irving','Chesapeake','North Las Vegas','Fremont','Baton Rouge','Richmond','Boise','San Bernardino','Spokane','Birmingham','Modesto','Des Moines','Rochester','Tacoma','Fontana','Oxnard','Moreno Valley','Fayetteville','Huntington Beach','Yonkers','Montgomery','Amarillo','Little Rock','Akron','Shreveport','Augusta','Grand Rapids','Mobile','Salt Lake City','Huntsville','Tallahassee','Grand Prairie','Overland Park','Knoxville','Worcester','Brownsville','Newport News','Santa Clarita','Port St. Lucie','Providence','Fort Lauderdale','Chattanooga','Tempe','Oceanside','Garden Grove','Rancho Cucamonga','Cape Coral','Santa Rosa','Vancouver','Sioux Falls','Peoria','Ontario','Jackson','Elk Grove','Springfield','Pembroke Pines','Salem','Corona','Eugene','McKinney','Fort Collins','Lancaster','Cary','Palmdale','Hayward','Salinas','Frisco','Pasadena','Macon','Alexandria','Pomona','Lakewood','Sunnyvale','Escondido','Hollywood','Clarksville','Torrance','Rockford','Joliet','Paterson','Bridgeport','Naperville','Savannah','Mesquite','Syracuse','Orange','Fullerton','Killeen','Dayton','McAllen','Bellevue','Miramar','Hampton','West Valley City','Warren','Olathe','Columbia','Thornton','Carrollton','Midland','Charleston','Waco','Sterling Heights','Denton','Cedar Rapids','New Haven','Roseville','Gainesville','Visalia','Coral Springs','Thousand Oaks','Elizabeth','Stamford','Concord','Surprise','Lafayette','Topeka','Kent','Simi Valley','Santa Clara','Murfreesboro','Hartford','Athens','Victorville','Abilene','Vallejo','Berkeley','Norman','Allentown','Evansville','Odessa','Fargo','Beaumont','Independence','Ann Arbor','El Monte','Round Rock','Wilmington','Arvada','Provo','Lansing','Downey','Carlsbad','Costa Mesa','Miami Gardens','Westminster','Clearwater','Fairfield','Elgin','Temecula','West Jordan','Inglewood','Richardson','Lowell','Gresham','Antioch','Cambridge','High Point','Billings','Manchester','Murrieta','Centennial','Ventura','Pueblo','Pearland','Waterbury','West Covina','North Charleston','Everett','College Station','Palm Bay','Pompano Beach','Boulder','Norwalk','West Palm Beach','Broken Arrow','Daly City','Sandy Springs','Burbank','Green Bay','Santa Maria','Wichita Falls','Lakeland','Clovis','Lewisville','Tyler','El Cajon','San Mateo','Rialto','Edison','Davenport','Hillsboro','Woodbridge','Las Cruces','South Bend','Vista','Greeley','Davie','San Angelo','Jurupa Valley','Renton','Other');
								    ?>
							    	<select class="form-control selectpicker" name="search_region" id="MAJOR_METROPOLITAN" data-live-search="true">
										<option value="">Please Select</option>
										<?php foreach ($majorM_Arr as $value) { ?>
											<option value="<?php echo $value; ?>" ><?php echo $value; ?></option> 
										<?php } ?>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="list_languages">Language</label>
								    <select class="form-control selectpicker" class="country_select" name="list_languages" data-live-search="true">
									  	<option value="">Please Select</option>
									  	<option value="English">English</option>
										<option value="Spanish">Spanish</option>
										<option value="Mandarin">Mandarin</option>
										<option value="Hindi">Hindi</option>
										<option value="Russian">Russian</option>
										<option value="Arabic">Arabic</option>
										<option value="Portuguese">Portuguese</option>
										<option value="Bengali">Bengali</option>
										<option value="French">French</option>
										<option value="Malay">Malay</option>
										<option value="Indonesian">Indonesian</option>
										<option value="German">German</option>
										<option value="Japanese">Japanese</option>
										<option value="Farsi (Persian)">Farsi (Persian)</option>
										<option value="Urdu">Urdu</option>
										<option value="Punjabi">Punjabi</option>
										<option value="Wu">Wu</option>
										<option value="Vietnamese">Vietnamese</option>
										<option value="Javanese">Javanese</option>
										<option value="Tamil">Tamil</option>
										<option value="Korean">Korean</option>
										<option value="Turkish">Turkish</option>
										<option value="Telugu">Telugu</option>
										<option value="Marathi">Marathi</option>
										<option value="Italian">Italian</option>
										<option value="Thai">Thai</option>
										<option value="Burmese">Burmese</option>
										<option value="Cantonese">Cantonese</option>
										<option value="Kannada">Kannada</option>
										<option value="Gujarati">Gujarati</option>
										<option value="Polish">Polish</option>
										<option value="OTHER">OTHER</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="country_select">Country</label>
								    <select class="form-control selectpicker" class="country_select" data-live-search="true">
									  <option value="">Please Select</option>
									  <option value="United States">United States</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="BEST_INDUSTRY">Category</label>
								    <select class="form-control selectpicker" class="country_select" name="BEST_INDUSTRY" data-live-search="true">
									  	<option value="">Please Select</option>
										<option class="level-0" value="Information Technology">Information Technology</option>
										<option class="level-0" value="Investigation">Investigations</option>
										<option class="level-0" value="Investigative Journalist">Investigative Journalism</option>
										<option class="level-0" value="Loss Prevention">Loss Prevention</option>
										<option class="level-0" value="Marketing & Sales">Marketing & Sales</option>
										<option class="level-0" value="Operations Management">Operations Management</option>
										<option class="level-0" value="Operations Management">Risk Management</option>
										<option class="level-0" value="Security">Security</option>
										<option class="level-0" value="Support Staff">Support Staff</option>
										<option class="level-0" value="Surveillance">Surveillance</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="form-group has-feedback">
								    <label for="TYPE_OF_OPPORTUNITY">Contract Type</label>
								    <select class="form-control selectpicker" class="country_select" name="TYPE_OF_OPPORTUNITY" data-live-search="true">
									  	<option value="">Please Select</option>
										<option class="level-0" value="Permanent Full Time Employee">Full Time</option>
										<option class="level-0" value="Part Time Employee">Part Time</option>
										<option class="level-0" value="Long-term Contract">Contract-Long Term</option>
										<option class="level-0" value="Short Term Contract">Contract-Short Term</option>
										<option class="level-0" value="All available advancements">All available advancements</option>
									</select>
									<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-default">Search</button>
								</div>
							</form>
						</div>
						<?php //the_field('right_side_add'); ?>
						<?php
						if(is_active_sidebar('ad_right_side_employer_dashboard')){
							dynamic_sidebar('ad_right_side_employer_dashboard');
						}
						?>
						<div class="light_box snap_shot">
							<div class="sidebar_title">
								<span class="title_icon newposting_icon"></span>
								<h4>New Candidates</h4>
							</div>
							<?php get_template_part( 'Employer/content', 'candidates' ); ?>
							<div class="text-center">
								<a href="<?php echo site_url();  ?>/employers/search-candidates/" class="btn btn-primary">See All</a>
							</div>
						</div>
						<div class="light_box last_msurvey">
							<?php get_template_part( 'Employer/content', 'emp_survey_report' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="specialoffers_ad">
				<?php //the_field('bottum_offer_image_link'); ?>
				<?php
				if(is_active_sidebar('ad_bottom_employer_dashboard')){
					dynamic_sidebar('ad_bottom_employer_dashboard');
				}
				?>
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
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap-select.min.css">

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
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
      <!-- <div class="modal-header">
      </div> -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
      	<h3>Got Feedback?</h3>
      	<h5>We want to be kick ass. Help us get there!</h5>
        <div class="clearfix"></div>
      	<!-- <textarea name="feedback"></textarea> -->
      	<?php   echo do_shortcode('[contact-form-7 id="4457" title="Feedback seeker" html_id="give_us_ur_feedback" html_class="form-horizontal"]'); ?>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save and close</button>
      </div> -->
    </div>
  </div>
</div>
<div class="modal fade" id="yourstory" tabindex="-1" role="dialog" aria-labelledby="yourstoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <!-- <div class="modal-header">
      </div> -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Your Story Has Taken A Lifetime</h3>
        <div class="clearfix"></div>
      	<!-- <textarea name="feedback"></textarea> -->
      	<?php   echo do_shortcode('[contact-form-7 id="4562" title="Tell Us Your Story" html_id="tell_us_ur_stry" html_class="form-horizontal"]'); ?>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save and close</button>
      </div> -->
    </div>
  </div>
</div>
<div class="modal fade" id="aboutproblem" tabindex="-1" role="dialog" aria-labelledby="aboutproblemLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <!-- <div class="modal-header">
      </div> -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Create a Trouble Ticket</h3>
        <div class="clearfix"></div>
      	<!-- <textarea name="feedback"></textarea> -->
      	<?php   echo do_shortcode('[contact-form-7 id="4563" title="Tell us about a Problem" html_id="tell_us_abt_prblm" html_class="form-horizontal"]'); ?>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save and close</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="visit_the_help_center" tabindex="-1" role="dialog" aria-labelledby="aboutproblemLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content default-form">
      <!-- <div class="modal-header">
      </div> -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Help us spread the word!</h3>
        <div class="clearfix"></div>
      	<!-- <textarea name="feedback"></textarea> -->
      	<?php   echo do_shortcode('[contact-form-7 id="4624" title="Visit the help center" html_id="visit_the_help_center_id" html_class="form-horizontal"]'); ?>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save and close</button>
      </div> -->
    </div>
  </div>
</div>
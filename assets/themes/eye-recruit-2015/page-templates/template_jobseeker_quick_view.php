 <?php
/**
 * Template Name: A job seeker Quick view
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header();

$now = time();
$employer_id =  get_current_user_id();  	
$user_id = $_REQUEST['recruiterid']; 

if(isset($_GET['recruiterid']) && !empty($_GET['recruiterid']) ){
	$user_id = $_GET['recruiterid'];
	$userdata = get_userdata($user_id);
}else{
	$site_url = site_url();
	echo wp_redirect($site_url);
}

$saveredactedcandidates = get_user_meta($employer_id, 'saveredactedcandidates', true);
if ( !empty($saveredactedcandidates) ) {
	$getprevalArr = explode(',', $saveredactedcandidates);
	
	if ( in_array($user_id, $getprevalArr) ) {
		$savecanText = 'Saved';
		$savecanClass = '';
	}
	else{
		$savecanClass = 'save_candidate';
		$savecanText = 'Save';
	}
}
else{
	$savecanClass = 'save_candidate';
	$savecanText = 'Save';
}


global $wpdb;
$select_view= $wpdb->get_row("SELECT * FROM eyecuwp_last_view WHERE can_id = $user_id AND emp_id = $employer_id");
if( is_user_logged_in() && in_array('candidate', $userdata->roles) ){	
	if(!empty($select_view)){
		$wpdb->update( 
			'eyecuwp_last_view',
			array('date_time'=> $now,),
			array('emp_id' =>$employer_id, 'can_id'=>$user_id),
			array("%s"),
			array("%d")
		);
		
	}
	else{
		$wpdb->insert('eyecuwp_last_view',array(
				'can_id'=>$user_id,
				'emp_id'=>$employer_id,
				'date_time'=>$now
			),
			array(
					"%d",
					"%d",
					"%s",
				)
		);
	}
	update_user_meta($user_id, 'lastviewdbyemp', $now);
	
}
?>
<link rel="stylesheet" type="text/css" media="print" href="<?php echo get_stylesheet_directory_uri(); ?>/css/print_style.css">
<?php  
	function get_star_assessment($user_id,$field_name){
		$star 			= get_cimyFieldValue($user_id,$field_name);
		$value    = '';
		if($star == 'basic'){

        	$value = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';

         }elseif ($star == 'average') {

         	$value = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
         }
         elseif ($star == 'good') {

         	$value = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
         }
         elseif ($star == 'excellent') {

         	$value = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
         }
         elseif ($star == 'master') {
         	$value = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';

         }else{

         	$value = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
         }

         return $value;
	}
?>
	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="loaders" class="filter_loader loader inner-loader" style="display: none;"></div>
		<div id="content" role="main">
			<?php //the_content(); ?>
			<?php //comments_template(); ?>
			<section class="seeker_profile">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-8 col-lg-push-2 col-md-12 col-md-push-0">
							<div class="seekr_profile" id="DivIdToPrint">
								<div class="sprofile_header" style="background:url('<?php echo get_stylesheet_directory_uri(); ?>/img/gray_bg.jpg') repeat;">
									<span class="spro_recruiterid"><strong>Recruit ID</strong> : <?php echo $user_id;  ?></span>
									<div class="row">
										<div class="col-md-5 col-sm-4">
											<div class="presented_by">
												<p>This candidate presented to you by:</p>
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/sprofile_logo.jpg" class="img-responsive"> 
											</div>
										</div>
										<div class="col-md-2 col-sm-4">
											<div href="#" class="thumbnail"> 
												<?php
													$allwoPhoto = get_cimyFieldValue($user_id, 'PNA_PHOTOGRAPH');
													if ( (has_wp_user_avatar($user_id)) && ($allwoPhoto != 'No') ) {
														echo get_wp_user_avatar($user_id, 'thumbnail'); 
													}else{
														?>
														<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/EyeRecruit_Avitar.jpg" height="225px" width="190px" class="thumbnail">
														<?php
													}
												?>
												<!-- <img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/sprofile_user.jpg" class="img-responsive">  -->
											</div>
										</div>
									</div>
									<div class="sprofile_title">
										<h2><?php echo get_user_meta($user_id,'first_name',true);  ?> <?php echo get_user_meta($user_id,'last_name',true);  ?></h2>
									</div>
									<div class="row spro_info">
										<div class="col-md-2 col-sm-4 col-md-push-5 col-sm-push-4">
											<h5><?php  echo get_cimyFieldValue($user_id,'MAJOR_METROPOLITAN'); ?></h5>
										</div>
										<div class="col-md-5 col-sm-4 col-md-pull-2 col-sm-pull-4">
											<p>Member Since : <big><?php $userSince = $userdata->user_registered; if( !empty($userSince) ){ echo  date( "Y", strtotime($userdata->user_registered)); }else{ echo "Not Define"; } ?></big></p>
										</div>
										
										<div class="col-md-5 col-sm-4 col-md-push-0 col-sm-push-0">
											<p>Experience : <big><?php  $indYear = get_cimyFieldValue($user_id, 'INDUSTRY_YEARS' ); echo (($indYear)) ? $indYear : 'Not Define'; ?></big></p>
											<span>Sector : <strong><?php  $bestInd = get_cimyFieldValue($user_id,'BEST_INDUSTRY'); echo (($bestInd)) ? $bestInd : 'Not Define'; ?></strong></span>
										</div>
									</div>
								</div>
								<div class="sprofile_content">
									<div class="clearfix"></div>
									<h2 class="candidatepro_title"><span>This Candidate at a Glance</span></h2>
									<div class="at_glance">
										<div class="row">
											<div class="col-md-6">
												<ul>	
													<li><strong>Current work situation? : </strong><p>I needed a career change,I am looking for more career growth,Decided to take a different career path,Looking for more flexible schedule,Looking for a new challenge,New challenge,Not compatible with company goals.</p></li>
													<li><strong>Active Military or Law Enforcement : </strong><p><?php  $FEDERAL_NVESTIGATIV = get_cimyFieldValue($user_id,'FEDERAL_NVESTIGATIV'); echo (($FEDERAL_NVESTIGATIV)) ? $FEDERAL_NVESTIGATIV : 'N/A'; ?></p></li>
													<li><strong>What type of work are you looking for : </strong><p><?php  $TYPE_OF_OPPORTUNITY = get_cimyFieldValue($user_id,'TYPE_OF_OPPORTUNITY'); echo (($TYPE_OF_OPPORTUNITY)) ? $TYPE_OF_OPPORTUNITY : 'N/A'; ?></p></li>
													<li><strong>Current/previous local/state law enforcement : </strong><p><?php  $LOCAL_LAW_FORCE_YN = get_cimyFieldValue($user_id,'LOCAL_LAW_FORCE_YN'); echo (($LOCAL_LAW_FORCE_YN)) ? $LOCAL_LAW_FORCE_YN : 'N/A'; ?></p></li>
												</ul>
											</div>
											<div class="col-md-6">
												<ul>	
													<li><strong>Over 18? : </strong><span><?php  echo get_cimyFieldValue($user_id,'OVER_18_YN'); ?></span></li>
													<li><strong>Currently employed? : </strong>
														<span>
															<?php 
															$CURR_EMPLOYED_YN = get_cimyFieldValue($user_id,'CURR_EMPLOYED_YN'); 
															echo (($CURR_EMPLOYED_YN)) ? $CURR_EMPLOYED_YN : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Areas of experience : </strong>
														<span>
															<?php 
															$BEST_INDUSTRY = get_cimyFieldValue($user_id,'BEST_INDUSTRY'); 
															echo (($BEST_INDUSTRY)) ? $BEST_INDUSTRY : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Active DL State : </strong>
														<span>
															<?php 
															$DRIVER_STATE = get_cimyFieldValue($user_id,'DRIVER_STATE'); 
															echo (($DRIVER_STATE)) ? $DRIVER_STATE : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>State(s) :  </strong>
														<span>
															<?php 
															$FIELD_LICENSE_STATE = get_cimyFieldValue($user_id,'FIELD_LICENSE_STATE'); 
															echo (($FIELD_LICENSE_STATE)) ? $FIELD_LICENSE_STATE : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Armed Forces : </strong>
														<span>
															<?php 
															$US_ARMED_FORCES_OPTI = get_cimyFieldValue($user_id,'US_ARMED_FORCES_OPTI'); 
															echo (($US_ARMED_FORCES_OPTI)) ? $US_ARMED_FORCES_OPTI : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Date available : </strong>
														<span>
															<?php 
															$WORK_DATE_AVAILABLE = get_cimyFieldValue($user_id,'WORK_DATE_AVAILABLE'); 
															echo (($WORK_DATE_AVAILABLE)) ? $WORK_DATE_AVAILABLE : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Career level : </strong>
														<span>
															<?php 
															$CURR_CAREER_LVL = get_cimyFieldValue($user_id,'CURR_CAREER_LVL'); 
															echo (($CURR_CAREER_LVL)) ? $CURR_CAREER_LVL : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Transportation : </strong>
														<span>
															<?php 
															$RELOCATION_YN = get_cimyFieldValue($user_id,'RELOCATION_YN'); 
															echo (($RELOCATION_YN)) ? $RELOCATION_YN : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Professional License(s) : </strong>
														<span>
															<?php 
															$POSSES_DRIVER_LICENS = get_cimyFieldValue($user_id,'POSSES_DRIVER_LICENS'); 
															echo (($POSSES_DRIVER_LICENS)) ? $POSSES_DRIVER_LICENS : 'N/A'; ?>
														</span>
													</li>
													
													<li><strong>Security clearance : </strong>
														<span>
															<?php 
															$SECURITY_CLEAR_YN = get_cimyFieldValue($user_id,'SECURITY_CLEAR_YN'); 
															echo (($SECURITY_CLEAR_YN)) ? $SECURITY_CLEAR_YN : 'N/A'; ?>
														</span>
													</li>
												</ul
												>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<h3 class="profiletask_title"><span class="iconpro iconpro_exp"></span>Experience</h3>
											<dl class="dl-horizontal">
												<dt>2010-2013</dt>
												<dd>
													<h5>Miami Security</h5>
													<h4>Junior Security Officer</h4>
													<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
												</dd>
												<dt>2013-2016</dt>
												<dd>
													<h5>Barkley Security</h5>
													<h4>Security Manager</h4>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
												</dd>
											</dl>
										</div>
										<div class="col-md-6">
											<h3 class="profiletask_title"><span class="iconpro iconpro_edu"></span>Education</h3>
											<dl class="candidate_edu">
												<dt>Highest education completed : </dt>
												<dd>
													<?php 
													$HIGHEST_EDUCATION = get_cimyFieldValue($user_id,'HIGHEST_EDUCATION'); 
													echo (($HIGHEST_EDUCATION)) ? $HIGHEST_EDUCATION : 'N/A'; ?>
												</dd>
												
												<dt>Graduation year : </dt>
												<dd>
													<?php 
													$STUDY_YEAR = get_cimyFieldValue($user_id,'STUDY_YEAR'); 
													echo (($STUDY_YEAR)) ? $STUDY_YEAR : 'N/A'; ?>
												</dd>
												
												<dt>School : </dt>
												<dd>
													<?php 
													$SCHOOL_NAME = get_cimyFieldValue($user_id,'SCHOOL_NAME'); 
													echo (($SCHOOL_NAME)) ? $SCHOOL_NAME : 'N/A'; ?>
												</dd>
												
												<dt>Field of study : </dt>
												<dd>
													<?php 
													$AREA_OF_STUDY = get_cimyFieldValue($user_id,'AREA_OF_STUDY'); 
													echo (($AREA_OF_STUDY)) ? $AREA_OF_STUDY : 'N/A'; ?>
												</dd>
											</dl>
										</div>
									</div>
									
									<div class="self_assessments">
										<h2 class="candidatepro_title"><span>Quick View Self Assessment</span></h2>
										<div class="row">
											<div class="col-md-6">
												<h3 class="profiletask_title"><span class="iconpro iconpro_tasks"></span>Tasks Assessment</h3>
												<ul>	
													<li>Validating known intelligence data <?php echo checkupdateSelfAsses('TASKS_Q1', $user_id); ?>
														<span><?php echo get_star_assessment($user_id,'TASKS_Q1');   ?></span>
													</li>
													<li>Preparing comprehensive written reports? <?php echo checkupdateSelfAsses('TASKS_Q2', $user_id); ?>
														<span><?php echo get_star_assessment($user_id,'TASKS_Q2');   ?></span>
													</li>
													<li>Study of rings & security threats <?php echo checkupdateSelfAsses('TASKS_Q3', $user_id); ?>
														<span><?php echo get_star_assessment($user_id,'TASKS_Q3');   ?></span>
													</li>
													<li>Coordination of intelligence activities <?php echo checkupdateSelfAsses('TASKS_Q4', $user_id); ?>
														<span><?php echo get_star_assessment($user_id,'TASKS_Q4');   ?></span>
													</li>
													<li>Locating criminal groups? <?php echo checkupdateSelfAsses('TASKS_Q5', $user_id); ?>
													<span><?php echo get_star_assessment($user_id,'TASKS_Q5');   ?></span>
													</li>
												</ul>
												<a href="<?php echo site_url();  ?>/job-seekers/tasks-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i>See More<i class="fa fa-angle-double-right"></i></a>
											</div>
											<div class="col-md-6">
												<h3 class="profiletask_title"><span class="iconpro iconpro_tech"></span>Tech Assessment</h3>
												<ul>	
													<li>Biometrics <?php echo checkupdateSelfAsses('TECH_Q15', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'TECH_Q15');   ?></span></span>
													</li>
													<li>Covert / concealed video surveillance <?php echo checkupdateSelfAsses('TECH_Q14', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'TECH_Q14');   ?></span></span>
													</li>
													<li>Word processing software <?php echo checkupdateSelfAsses('TECH_Q13', $user_id); ?>
													<span><span><?php echo get_star_assessment($user_id,'TECH_Q13');   ?></span></span>
													</li>
													<li>Charting software <?php echo checkupdateSelfAsses('TECH_Q2', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'TECH_Q2');   ?></span></span>
													</li>
													<li>Database user interface and query software <?php echo checkupdateSelfAsses('TECH_Q3', $user_id); ?>
													<span><span><?php echo get_star_assessment($user_id,'TECH_Q3');   ?></span></span>
													</li>
												</ul>
												<a href="<?php echo site_url();  ?>/job-seekers/technology-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i>See More<i class="fa fa-angle-double-right"></i></a>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<h3 class="profiletask_title"><span class="iconpro iconpro_knowledge"></span>Knowledge Assessment</h3>
												<ul>	
													<li>English language proficiency <?php echo checkupdateSelfAsses('KNOW_Q1', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'KNOW_Q1');   ?></span></span>
													</li>
													<li>Laws, codes, procedures & regulations <?php echo checkupdateSelfAsses('KNOW_Q2', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'KNOW_Q2');   ?></span></span>
													</li>
													<li>Public Safety & Security strategies <?php echo checkupdateSelfAsses('KNOW_Q3', $user_id); ?>
													<span><span><?php echo get_star_assessment($user_id,'KNOW_Q3');   ?></span></span>
													</li>
													<li>Media production & dissemination <?php echo checkupdateSelfAsses('KNOW_Q4', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'KNOW_Q4');   ?></span></span>
													</li>
													<li>Computers, electronics & applications <?php echo checkupdateSelfAsses('KNOW_Q5', $user_id); ?>
													<span><span><?php echo get_star_assessment($user_id,'KNOW_Q5');   ?></span></span>
													</li>
												</ul>
												<a href="<?php echo site_url();  ?>/job-seekers/knowledge-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i>See More<i class="fa fa-angle-double-right"></i></a>
											</div>
											<div class="col-md-6">
												<h3 class="profiletask_title"><span class="iconpro iconpro_skills"></span>Skills Assessment</h3>
												<ul>	
													<li>Reading comprehension & understanding <?php echo checkupdateSelfAsses('SKILLS_Q1', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q1');   ?></span></span>
													</li>
													<li>Active listening & follow up inquiry <?php echo checkupdateSelfAsses('SKILLS_Q2', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q2');   ?></span></span>
													</li>
													<li>Instruction, mentoring and teaching others <?php echo checkupdateSelfAsses('SKILLS_Q12', $user_id); ?>
													<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q12');   ?></span></span>
													</li>
													<li>Adjusting actions in relation to others <?php echo checkupdateSelfAsses('SKILLS_Q9', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q9');   ?></span></span>
													</li>
													<li>Social perceptiveness & situational awareness <?php echo checkupdateSelfAsses('SKILLS_Q11', $user_id); ?>
													<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q11');   ?></span></span>
													</li>
												</ul>
												<a href="<?php echo site_url();  ?>/job-seekers/skills-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i>See More<i class="fa fa-angle-double-right"></i></a>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<h3 class="profiletask_title"><span class="iconpro iconpro_abilities"></span>Abilities Assessment</h3>
												<ul>	
													<li>Relationship among seemingly unrelated events <?php echo checkupdateSelfAsses('ABILITY_Q1', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q1');   ?></span></span>
													</li>
													<li>Read and understand information in writing <?php echo checkupdateSelfAsses('ABILITY_Q2', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q2');   ?></span></span>
													</li>
													<li>Communicate with others orally <?php echo checkupdateSelfAsses('ABILITY_Q4', $user_id); ?>
													<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q4');   ?></span></span>
													</li>
													<li>Problem sensitivity and recognition <?php echo checkupdateSelfAsses('ABILITY_Q6', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q6');   ?></span></span>
													</li>
													<li>Speech recognition of other persons <?php echo checkupdateSelfAsses('ABILITY_Q7', $user_id); ?>
													<span><?php echo get_star_assessment($user_id,'ABILITY_Q7');   ?></span>
													</li>
												</ul>
												<a href="<?php echo site_url();  ?>/job-seekers/abilities-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i>See More<i class="fa fa-angle-double-right"></i></a>
											</div>
											<div class="col-md-6">
												<h3 class="profiletask_title"><span class="iconpro iconpro_work"></span>Work Assessment</h3>
												<ul>	
													<li>Representing to external sources <?php echo checkupdateSelfAsses('WORK_ACT_Q11', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q11');   ?></span></span>
													</li>
													<li>Determining the best solution & solve problems <?php echo checkupdateSelfAsses('WORK_ACT_Q12', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q12');   ?></span></span>
													</li>
													<li>Training, development or instruction <?php echo checkupdateSelfAsses('WORK_ACT_Q18', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q18');   ?></span></span>
													</li>
													<li>Coaching, developing & mentoring <?php echo checkupdateSelfAsses('WORK_ACT_Q22', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q22');   ?></span></span>
													</li>
													<li>Coordinating work activities of others <?php echo checkupdateSelfAsses('WORK_ACT_Q23', $user_id); ?>
														<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q23');   ?></span></span>
													</li>
												</ul>
												<a href="<?php echo site_url();  ?>/job-seekers/work-activities-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i>See More<i class="fa fa-angle-double-right"></i></a>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>

						<div class="col-lg-2 col-lg-pull-8 col-md-6 col-md-pull-0">
							<div class="sidebar">
								<ul class="nav nav-pills nav-stacked">
								  <li role="presentation"><a href="<?php echo site_url()  ?>/employers/redacted-employer-quick-view/?recruitID=<?php  echo $user_id; ?>">Access the Full Profile <i class="fa fa-share" aria-hidden="true"></i></a></li>
								  <li role="presentation"><a href="mailto:<?php echo $userdata->user_email; ?>" >Ask a Question <i class="fa fa-question-circle" aria-hidden="true"></i></a></li>
								  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Schedule a Time to Talk <i class="fa fa-phone" aria-hidden="true"></i></a></li>
								  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Request a Meeting <i class="fa fa-users" aria-hidden="true"></i></a></li>
								</ul>
								<hr>
								<ol class="nav nav-pills nav-stacked">
								  <li role="presentation"><a href="javascript:void(0);" data-toggle="modal" data-target="#forwordseeker">Forward <i class="fa fa-share" aria-hidden="true"></i></a></li>
								  <li role="presentation" class="<?php echo $savecanClass; ?>"><a href="javascript:void(0);" id="redactedSaveCandidate" recruitID="<?php echo $user_id; ?>"><?php echo $savecanText; ?> <i class="fa fa-floppy-o" aria-hidden="true"></i></a></li>
								  <li role="presentation"><a href="javascript:void(0)" onclick="window.print(); return false;">Print <i class="fa fa-print" aria-hidden="true"></i></a></li>
								</ol>
							</div>
						</div>


						<div class="col-lg-2 col-md-6">
							<div class="sidebar right_sidebar">
								<div class="light_box recruiter_box">
									<h3>Recruiter</h3>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/recruiter_img.jpg" class="img-circle">
									<p>I am here to facilitate discussions, open channels of communication, and assist you and your team in building the future.</p>
									<div class="text-center">
										<a href="javascript:void(0);" data-target="#sendamail" data-toggle="modal" class="btn btn-primary">Send An Email</a>
										<a href="javascript:void(0);" class="btn btn-default" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Schedule A Call</a>
									</div>
									
								</div>
								<div class="light_box overlay_tlt">
									<h4>Cover Letter</h4>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/coverletter.jpg" class="img-responsive">
								</div>
								<div class="light_box overlay_tlt">
									<h4>Resume</h4>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/coverletter.jpg" class="img-responsive">
								</div>
								<div class="light_box overlay_tlt">
									<h4>References</h4>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/coverletter.jpg" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
<?php get_footer('employer'); ?>


<div class="modal fade sendamail" id="sendamail" tabindex="-1" role="dialog" aria-labelledby="sendamailLabel">
  <?php echo recrutier_contact_now('hide'); ?>
</div> 


<div class="modal fade" id="forwordseeker" tabindex="-1" role="dialog" aria-labelledby="forwordseekerLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
      </div> -->
      <div class="modal-body">
        <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Forword Candidate Detail</h3>
        <div class="clearfix"></div>
        <form class="wpcf7-form form-horizontal" id="forwordform">
	      	<div id="userdetail_all_fields">
				<div class="edit-main-dv">
					<div class="form-group row">
						<label class="col-sm-3 control-label" for="fname">To Name<span>*</span></label>
						<div class="col-sm-9">
							<input id="fname" class="regular-text code form-control" name="fname" type="text" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label" for="user_email">To Email<span>*</span></label>
						<div class="col-sm-9">
							<input id="user_email" class="regular-text code form-control" name="user_email" type="text" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 control-label" for="user_msg">Message</label>
						<div class="col-sm-9">
							<textarea id="user_msg" class="regular-text code form-control" name="user_msg"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="can_id" id="can_id" value="<?php echo $user_id; ?>">
	        	<button id="forwoerdbutton" type="submit" class="btn btn-primary btn-sm">Send</button>
	        	<button type="button" class="close_btn" data-dismiss="modal">Close</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('#forwordform').validate( {
			rules: {
				fname: {
					required: true
				},
				user_email: {
					required: true,
					email: true
				}
			},
			messages: {
				fname: {
					required: 'Please enter an name.'
				},
				user_email: {
					required: 'Please enter an email.',
					email: 'Please enter an valid email.'
				}
			},
			submitHandler: function() {
				var fname = jQuery('input[name="fname"]').val();
				var user_email = jQuery('input[name="user_email"]').val();
				var user_msg = jQuery('#user_msg').val();
				var can_id = jQuery('#can_id').val();

				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url("admin-ajax.php"); ?>',
					dataType: 'json',
					data: {
						action: 'sendSeekerDetailTo', //Action in inc/employee_details_save.php
						fname: fname,
						user_email: user_email,
						user_msg: user_msg,
						can_id: can_id
					},
					success: function(res){
						if ( res.msg == 'success' ) {
							jQuery.notify('Successfully send!', 'success');
						}
						else{
							jQuery.notify('Something wrong. Please try again!', 'error');
						}
					}

				});
			}
		});
	});


	jQuery(document).ready( function() {
		jQuery('.save_candidate').on('click', '#redactedSaveCandidate', function() {
			var _this = jQuery(this);
			var recruitID = _this.attr('recruitID');
			jQuery('#loaders').show();
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url("admin-ajax.php"); ?>',
				data: {
					action: 'redacted_save_candidate_for_emp', // action in inc/employee_detail_save.php
					recruitID: recruitID
				},
				success: function(res){
					jQuery('#loaders').hide();
					// jQuery.notify('Candidate successfully saved!', 'success');
					swal({
						title: "Save", 
						html: true,
						text: "<span class='text-center'>Candidate successfully saved!</span>",
						type: "success",
						confirmButtonClass: "btn-primary btn-sm",
					});
					_this.html('Saved <i class="fa fa-floppy-o" aria-hidden="true"></i>').removeAttr('id');
				}
			});
		});
	});
</script>
<?php
/**
 * Template Name: Redected Recruiter quick view
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); ?>
	<?php  	$user_id = 165;
			$userdata 		= get_userdata($user_id);

	 ?>
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
		<div id="content" role="main">
			<?php //the_content(); ?>
			<?php //comments_template(); ?>
			<section class="seeker_profile redacted_recruiter">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-8 col-lg-push-2 col-md-12 col-md-push-0">
							<div class="seekr_profile" id="DivIdToPrint">
								<div class="sprofile_header">
									<span class="spro_recruiterid"><strong>Recruit ID</strong> : 3585</span>
									<div class="row">
										<div class="col-md-5 col-sm-4">
											<div class="presented_by">
												<p>This candidate presented to you by:</p>
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/sprofile_logo.jpg" class="img-responsive"> 
											</div>
										</div>
										<div class="col-md-2 col-sm-4">
											<div href="javascript:void(0);" class="thumbnail"> 
												<?php
												echo do_shortcode('[ica_avatar uid="'.$user_id.'"]');
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
											<h5>New York, NY.</h5>
										</div>
										<div class="col-md-5 col-sm-4 col-md-pull-2 col-sm-pull-4">
											<p>Member Since : <big><?php echo  date( "Y", strtotime($userdata->user_registered)); ?></big></p>
										</div>
										<div class="col-md-5 col-sm-4 col-md-push-0 col-sm-push-0">
											<p>Experience : <big>14 years</big></p>
											<span>Sector : <strong><?php  echo get_cimyFieldValue($user_id,'BEST_INDUSTRY'); ?></strong></span>
										</div>
									</div>
								</div>
								<div class="redacted_content">
									<div class="clearfix"></div>
									<div class="quick_navigation">
										<div class="row">
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Background">
											      <span>Background</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Video Interviews">
											      <span>Video Interviews</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Resume">
											      <span>Resume</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Cover Letter">
											      <span>Cover Letter</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Referrals">
											      <span>Referrals</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="References">
											      <span>References</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Education">
											      <span>Education</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Certifications">
											      <span>Certifications</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Honors & Awards">
											      <span>Honors & Awards</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="javascript:void(0);" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/navback_manage.jpg" alt="Licensing">
											      <span>Licensing</span>
											    </a>
											</div>
										</div>
									</div>
									<div class="quickview_tab">
									  <!-- Nav tabs -->
									  <ul class="nav nav-tabs" role="tablist">
									    <li role="presentation" class="active"><a href="#tabCommunicatios" aria-controls="tabCommunicatios" role="tab" data-toggle="tab">Communicatios<span>3</span></a></li>
									    <li role="presentation"><a href="#tabJobMatch" aria-controls="tabJobMatch" role="tab" data-toggle="tab">Job Match</a></li>
									    <li role="presentation"><a href="#tabQuestions" aria-controls="tabQuestions" role="tab" data-toggle="tab">Questions</a></li>
									    <li role="presentation"><a href="#tabPhotoScreen" aria-controls="tabPhotoScreen" role="tab" data-toggle="tab">Photo Screen</a></li>
									    <li role="presentation"><a href="#tabNotes" aria-controls="tabNotes" role="tab" data-toggle="tab">Notes</a></li>
									    <li role="presentation"><a href="#tabSupportServices" aria-controls="tabSupportServices" role="tab" data-toggle="tab">Support Services</a></li>
									  </ul>

									  <!-- Tab panes -->
									  <div class="tab-content">
									    <div role="tabpanel" class="tab-pane active" id="tabCommunicatios">tabCommunicatios</div>
									    <div role="tabpanel" class="tab-pane" id="tabJobMatch">tabJobMatch</div>
									    <div role="tabpanel" class="tab-pane" id="tabQuestions">tabQuestions</div>
									    <div role="tabpanel" class="tab-pane" id="tabPhotoScreen">
									    	<div class="clearfix">
									    		<a href="javascript:void(0);" class="quickview_tablink">+ Add Question</a>
									    		<a href="javascript:void(0);" class="quickview_tablink pull-right">Modify Order <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
									    	</div>
									    	<form class="form">
									    		<div class="form-group">
												    <label for="findlastJob">How did you find the last Job?</label>
												    <input class="form-control" id="findlastJob" type="text">
												</div>
									    		<div class="form-group">
												    <label for="Ifsowhom">Have you ever worked with any other Recruiter? If so, whom?</label>
												    <input class="form-control" id="Ifsowhom" type="text">
												</div>
									    		<div class="form-group">
												    <label for="appliedresult">Who have you reached out to or applied with recently and when? what was the result?</label>
												    <input class="form-control" id="appliedresult" type="text">
												</div>
									    		<div class="form-group">
												    <label for="workwithwhy">Who is currently in the market that you would like to work with and why?</label>
												    <input class="form-control" id="workwithwhy" type="text">
												</div>
									    		<div class="form-group">
												    <label for="getthisjob">Where are you currently working now? How did you get this job?</label>
												    <input class="form-control" id="getthisjob" type="text">
												</div>
									    		<div class="form-group">
												    <label for="idealcareerlook">What does the ideal career look like for you?</label>
												    <input class="form-control" id="idealcareerlook" type="text">
												</div>
									    		<div class="form-group">
												    <label for="biggestcomplaint">What’s the biggest complaint you have right now?</label>
												    <input class="form-control" id="biggestcomplaint" type="text">
												</div>
									    		<div class="form-group">
												    <label for="lastemployer">Why did you leave your last employer? (Who was the employer?)</label>
												    <input class="form-control" id="lastemployer" type="text">
												</div>
									    		<div class="form-group">
												    <label for="importantthing">What is the most important thing for you at this point?</label>
												    <input class="form-control" id="importantthing" type="text">
												</div>
									    		<div class="form-group">
												    <label for="industryright">What do you see going on in this industry right now?</label>
												    <input class="form-control" id="industryright" type="text">
												</div>
									    		<div class="form-group">
												    <label for="keepingyou">What is keeping you from finding the job you want?</label>
												    <input class="form-control" id="keepingyou" type="text">
												</div>
									    		<div class="form-group">
												    <label for="continueingeducation">Tell me a little about what you are doing for continueing education. What are you going or what is available?</label>
												    <input class="form-control" id="continueingeducation" type="text">
												</div>
									    		<div class="form-group">
												    <label for="PhotoScreenAdd">&lt;&lt;&lt; Add &gt;&gt;&gt;</label>
												    <input class="form-control" id="PhotoScreenAdd" type="text">
												</div>

									    	</form>
									    </div>
									    <div role="tabpanel" class="tab-pane" id="tabNotes">tabNotes</div>
									    <div role="tabpanel" class="tab-pane" id="tabSupportServices">tabSupportServices</div>
									  </div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-lg-pull-8 col-md-6 col-md-pull-0">
							<div class="sidebar">
								<div class="light_box at_glance">
									<div class="sidebar_title">
										<span class="title_icon qview_icon"></span>
										<h4><a href="<?php echo site_url();  ?>/tips/tips-424/">Quick View</a></h4>
									</div>
									<ul>
										<li><strong>Referred By :</strong><p>Print Ad, Coworker, Social Network, Search Engine,Industry Conference, Current / Past Employer</li>
										<li><strong>Current work situation? :</strong><p>I needed a career change,I am looking for more career growth,Decided to take a different career path,Looking for more flexible schedule, Looking for a new challenge,New challenge, Not compatible with company goals.</li>
										<li><strong>Active Military or Law Enforcement :</strong><p><?php  echo get_cimyFieldValue($user_id,'FEDERAL_NVESTIGATIV'); ?></li>
										<li><strong>What type of work are you looking for :</strong><p><?php  echo get_cimyFieldValue($user_id,'TYPE_OF_OPPORTUNITY'); ?></li>
									</ul>
									<ul>
										<li><strong>Over 18? : </strong><span><?php  echo get_cimyFieldValue($user_id,'OVER_18_YN'); ?></span></li>
										<li><strong>Currently employed? : </strong><span><?php echo get_cimyFieldValue($user_id,'CURR_EMPLOYED_YN'); ?></span></li>
										<li><strong>Areas of experience : </strong><span>N/A<?php echo get_cimyFieldValue($user_id,'OVER_18_YN'); ?></span></li>
										<li><strong>Active DL State : </strong><span><?php echo get_cimyFieldValue($user_id,'DRIVER_STATE'); ?></span></li>
										<li><strong>State(s) :  </strong><span><?php echo get_cimyFieldValue($user_id,'FIELD_LICENSE_STATE'); ?></span></li>
										<li><strong>Armed Forces : </strong><span><?php echo get_cimyFieldValue($user_id,'US_ARMED_FORCES_OPTI'); ?></span></li>
										<li><strong>Date available : </strong><span><?php echo get_cimyFieldValue($user_id,'WORK_DATE_AVAILABLE'); ?></span></li>
										<li><strong>Career level : </strong><span><?php echo get_cimyFieldValue($user_id,'CURR_CAREER_LVL'); ?></span></li>
										<li><strong>Transportation : </strong><span><?php echo get_cimyFieldValue($user_id,'RELOCATION_YN'); ?></span></li>
										<li><strong>Professional License(s) : </strong><span><?php echo get_cimyFieldValue($user_id,'POSSES_DRIVER_LICENS'); ?></span></li>
										<li><strong>Security clearance : </strong><span><?php echo get_cimyFieldValue($user_id,'SECURITY_CLEAR_YN'); ?></span></li>
									</ul>
								</div>
								<div class="side_assessments">
									<h3>Self Assessment</h3>
									<div class="side_assess-box">
										<h4><span class="iconpro iconpro_tasks"></span>Tasks Assessment</h4>
										<ul>	
											<li>Validating known intelligence data <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"> 
												<span><?php echo get_star_assessment($user_id,'TASKS_Q1');   ?></span>
											</li>
											<li>Coordination of intelligence activities 
												<span><?php echo get_star_assessment($user_id,'TASKS_Q4');   ?></span>
											</li>
											<li>Study of rings & security threats 
												<span><?php echo get_star_assessment($user_id,'TASKS_Q3');   ?></span>
											</li>
											<li>Locating criminal groups? 
											<span><?php echo get_star_assessment($user_id,'TASKS_Q5');   ?></span>
											</li>
											<li>Preparing comprehensive written reports? 
												<span><?php echo get_star_assessment($user_id,'TASKS_Q2');   ?></span>
											</li>
										</ul>
										<a href="<?php echo site_url();  ?>/job-seekers/tasks-assessment/"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="side_assess-box">
										<h4><span class="iconpro iconpro_knowledge"></span>Knowledge Assessment</h4>
										<ul>	
											<li>English language proficiency
												<span><span><?php echo get_star_assessment($user_id,'KNOW_Q1');   ?></span></span>
											</li>
											<li>Media production & dissemination <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"> 
												<span><span><?php echo get_star_assessment($user_id,'KNOW_Q4');   ?></span></span>
											</li>
											<li>Public Safety & Security strategies
											<span><span><?php echo get_star_assessment($user_id,'KNOW_Q3');   ?></span></span>
											</li>
											<li>Computers, electronics & applications
											<span><span><?php echo get_star_assessment($user_id,'KNOW_Q5');   ?></span></span>
											</li>
											<li>Laws, codes, procedures & regulations
												<span><span><?php echo get_star_assessment($user_id,'KNOW_Q2');   ?></span></span>
											</li>
										</ul>
										<a href="<?php echo site_url();  ?>/job-seekers/knowledge-assessment/"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="side_assess-box">
										<h4><span class="iconpro iconpro_abilities"></span>Abilities Assessment</h4>
										<ul>	
											<li>Relationship among seemingly unrelated events
												<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q1');   ?></span></span>
											</li>
											<li>Problem sensitivity and recognition
												<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q6');   ?></span></span>
											</li>
											<li>Communicate with others orally
											<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q4');   ?></span></span>
											</li>
											<li>Speech recognition of other persons
											<span><?php echo get_star_assessment($user_id,'ABILITY_Q7');   ?></span>
											</li>
											<li>Read and understand information in writing
												<span><span><?php echo get_star_assessment($user_id,'ABILITY_Q2');   ?></span></span>
											</li>
										</ul>
										<a href="<?php echo site_url();  ?>/job-seekers/abilities-assessment/"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="side_assess-box">
										<h4><span class="iconpro iconpro_tech"></span>Tech Assessment</h4>
										<ul>	
											<li>Biometrics 
												<span><span><?php echo get_star_assessment($user_id,'TECH_Q15');   ?></span></span>
											</li>
											<li>Charting software 
												<span><span><?php echo get_star_assessment($user_id,'TECH_Q2');   ?></span></span>
											</li>
											<li>Word processing software 
											<span><span><?php echo get_star_assessment($user_id,'TECH_Q13');   ?></span></span>
											</li>
											<li>Database user interface and query software 
											<span><span><?php echo get_star_assessment($user_id,'TECH_Q3');   ?></span></span>
											</li>
											<li>Covert / concealed video surveillance 
												<span><span><?php echo get_star_assessment($user_id,'TECH_Q14');   ?></span></span>
											</li>
										</ul>
										<a href="<?php echo site_url();  ?>/job-seekers/technology-assessment/"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="side_assess-box">
										<h4><span class="iconpro iconpro_skills"></span>Skills Assessment</h4>
										<ul>	
											<li>Reading comprehension & understanding <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"> 
												<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q1');   ?></span></span>
											</li>
											<li>Adjusting actions in relation to others
												<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q9');   ?></span></span>
											</li>
											<li>Instruction, mentoring and teaching others
											<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q12');   ?></span></span>
											</li>
											<li>Social perceptiveness & situational awareness
											<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q11');   ?></span></span>
											</li>
											<li>Active listening & follow up inquiry
												<span><span><?php echo get_star_assessment($user_id,'SKILLS_Q2');   ?></span></span>
											</li>
										</ul>
										<a href="<?php echo site_url();  ?>/job-seekers/skills-assessment/"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="side_assess-box">
										<h4><span class="iconpro iconpro_work"></span>Work Assessment</h4>
										<ul>	
											<li>Representing to external sources
												<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q11');   ?></span></span>
											</li>
											<li>Coaching, developing & mentoring <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"> 
												<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q22');   ?></span></span>
											</li>
											<li>Training, development or instruction
												<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q18');   ?></span></span>
											</li>
											<li>Coordinating work activities of others
												<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q23');   ?></span></span>
											</li>
											<li>Determining the best solution & solve problems
												<span><span><?php echo get_star_assessment($user_id,'WORK_ACT_Q12');   ?></span></span>
											</li>
										</ul>
										<a href="<?php echo site_url();  ?>/job-seekers/work-activities-assessment/"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-6">
							<div class="sidebar right_sidebar">
								<div class="light_box status_indicatr">
									<div class="sidebar_title" id="quickCategory">
										<h4>Category</h4>
									</div>
									<ul>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Although there are many factors those affects why candidates become locked, many fall into this category due to family obligations and restrictions or perhaps because of the allure of hefty retention bonuses. Regardless of their reasons, locked candidates are highly unlikely to be open to discussions."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Locked</span></label></div></li>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Recruiters also will want to avoid most arrived candidates, as they are likely to feel they have achieved a level of career fulfillment that cannot be found anywhere else. While they may occasionally demonstrate curiosity about job opportunities, the arrived are almost untouchable."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Arrived</span></label></div></li>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="These candidates are performing well in their current roles but they may be looking for a bigger and better job with more responsibilities or more staff to manage. Although they are often appreciated within their company, they may want to be promoted more quickly than their company can promise."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Ambitious</span></label></div></li>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Accomplished candidates are solid performers who are comfortable in their role and have no real incentive to move on, but they may be tempted to pick up their heads and look around from time to time. The trick for recruiters is to determine which accomplished candidates have somehow found themselves in a backlog at their company and which are just average, ho-hum performers."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Accomplished</span></label></div></li>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Whether it is due to a conflict with their boss or changing priorities from new owners, these candidates are incredibly frustrated with their current situation, but are often still loyal and working hard in their role. Although they may be unhappy where they are, they are still not actively looking for new opportunities. "><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Frustrated</span></label></div></li>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="These candidates can see the writing on the wall — they are anticipating a layoff, loss of an account, or the sale of the company. Yet, they appear fully employed and many are still passive candidates. The fated with dated skills and low performance ratings are to be avoided."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Fated</span></label></div></li>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="Superstar recruiters recognize that even the unemployed are not a homogenous group. There may be any number of reasons why candidates drop out of the workforce — for instance, to care for an ailing parent, or because of an outsourcing of their division’s functions. Although the most motivated to be hired, they also may be low performers with skills in low demand."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Unemployed</span></label></div></li>
					    				<li><div class="checkbox"><label data-toggle="tooltip" data-placement="top" title="At the opposite end of the spectrum from locked candidates are the unstable — the individuals who have jumped from job to job once a year (or even more often). With this many red flags, most of the unstable should be avoided, though there may always be a needle in the haystack."><input name="filter_category[]" class="job-manager-filter" type="checkbox"><span>Unstable</span></label></div></li>
						   			</ul>
		                            <p class="last_modify"><span data-toggle="tooltip" data-placement="top" title="John Dangle changed it">Last Modified :</span>Thursday, October 2nd 2016</p>
								</div>
								<div class="quick_interaction">
									<ul class="nav nav-pills nav-stacked">
									  <li role="presentation"><a href="javascript:void(0);">Access the Full Profile <i class="fa fa-share" aria-hidden="true"></i></a></li>
									  <li role="presentation"><a href="javascript:void(0);">Ask a Question <i class="fa fa-question-circle" aria-hidden="true"></i></a></li>
									  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Schedule a Time to Talk <i class="fa fa-phone" aria-hidden="true"></i></a></li>
									  <li role="presentation"><a href="javascript:void(0);" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Request a Meeting <i class="fa fa-users" aria-hidden="true"></i></a></li>
									</ul>
									<ol class="nav nav-pills nav-stacked">
									  <li role="presentation"><a href="javascript:void(0);">Forward Career <i class="fa fa-share" aria-hidden="true"></i></a></li>
									  <li role="presentation"><a href="javascript:void(0);" onclick="window.print(); return false;">Save Candidate <i class="fa fa-floppy-o" aria-hidden="true"></i></a></li>
									</ol>
									<ul class="nav nav-pills nav-stacked">
									  <li role="presentation"><a href="javascript:void(0);">Set a Reminder <i class="fa fa-clock-o" aria-hidden="true"></i></a></li>
									  <li role="presentation"><a href="javascript:void(0);">Send a Message <i class="fa fa-comments-o" aria-hidden="true"></i></a></li>
									</ul>
								</div>
								<div class="light_box sasp_list">
									<div class="sidebar_title">
										<h4>Saved Employers</h4>
									</div>
									<ul>
										<li>
											<h6>ABC Security</h6>
											<span>Miami, FL.</span>
											<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
										</li>
										<li>
											<h6>Omaha Security</h6>
											<span>Fort Lauderdale, FL.</span>
											<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
										</li>
										<li>
											<h6>Allied Martin Investigations</h6>
											<span>Orlando, FL.</span>
											<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
										</li>
									</ul>
									<div class="text-right">
										<a href="javascript:void(0);">See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
								<div class="light_box sasp_list">
									<div class="sidebar_title">
										<h4>Application Submited</h4>
									</div>
									<ul>
										<li>
											<h6>Armed Security Officer</h6>
											<span>Eagle Eye Security</span>
											<em>Thursday, October 2nd 2016</em>
										</li>
										<li>
											<h6>Loss Prevention Officer</h6>
											<span>Alpha Security Services</span>
											<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
										</li>
										<li>
											<h6>Security Guard</h6>
											<span>One World Services</span>
											<strong>Saved : </strong><em>Thursday, October 2nd 2016</em>
										</li>
									</ul>
									<div class="text-right">
										<a href="javascript:void(0);">See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
								<div class="light_box sasp_list">
									<div class="sidebar_title">
										<h4>Saved Job Postings</h4>
									</div>
									<ul>
										<li>
											<h6>Armed Security Officer</h6>
											<span>Eagle Eye Security</span>
											<em>Thursday, October 2nd 2016</em>
										</li>
										<li>
											<h6>Armed Security Officer</h6>
											<span>Blue Skies Security Inc.</span>
											<em>Thursday, October 2nd 2016</em>
										</li>
									</ul>
									<div class="text-right">
										<a href="javascript:void(0);">See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
								<div class="light_box acti">
									<div class="sidebar_title">
										<h4>Saved Job Postings</h4>
									</div>
									<ul>
										<li>Signes out on 06/10/2016 at 2:50 pm EST </li>
										<li>Uploaded Photograph on 06/10/2016 at 2:44 pm EST</li>
										<li>Accepted Terms & Conditions on 06/10/2016 at 2:40 pm EST</li>
										<li>Accepted Privacy Policy on 05/10/2016 at 2:44 pm EST </li>
										<li>Uploaded Resume on 05/10/2016 at 2:44 pm EST </li>
									</ul>
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
<script type="text/javascript">
function printDiv() 
{
	 var divContents = jQuery("#DivIdToPrint").html();
  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divContents+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}


</script>
<?php get_footer('seekerdasborad'); ?>


<div class="modal fade sendamail" id="sendamail" tabindex="-1" role="dialog" aria-labelledby="sendamailLabel">
  <?php echo recrutier_contact_now(); ?>
</div> 
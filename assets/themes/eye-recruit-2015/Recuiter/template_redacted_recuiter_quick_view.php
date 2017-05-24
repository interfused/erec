<?php
/**
 * Template Name: Redacted Recruiter quickView 
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); 

	$now = time();
	$mydate= date('H:ia l d/m/Y');
	$employer_id =  get_current_user_id();  	
	if(isset($_GET['recruitID']) && !empty($_GET['recruitID']) ){
		$user_id = $_GET['recruitID'];
		$userdata = get_userdata($user_id);
	}else{
		$site_url = site_url();
		echo wp_redirect($site_url);
	} 

	function get_star_assessment($user_id,$field_name){
		$star 	= get_cimyFieldValue($user_id,$field_name);
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

	<header class="page-header page-header_btn">
		<div class="container">
            <a href="<?php echo site_url();  ?>/job-seekers/dashboard/" class="btn btn-success btn-sm">Back to Dashboard</a>
        </div>
	</header>

	<div id="primary" class="content-area">
		<div id="loaders" class="filter_loader loader inner-loader" style="display: none;"></div>
		<div id="content" role="main">
			<?php //the_content(); ?>
			<?php //comments_template(); ?>
			<section class="seeker_profile redacted_recruiter">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-8 col-lg-push-2 col-md-12 col-md-push-0">
							<div class="seekr_profile" id="DivIdToPrint">
								<div class="sprofile_header">
									<span class="spro_recruiterid"><strong>Recruit ID</strong> : <?php echo $user_id; ?></span>
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
											<span>Member Since : <strong><?php $userSince = $userdata->user_registered; if( !empty($userSince) ){ echo  date( "Y", strtotime($userdata->user_registered)); }else{ echo "Not Define"; } ?></strong></span>
										</div>
										<div class="col-md-5 col-sm-4 col-md-push-0 col-sm-push-0">
											<p>Experience : <big><?php  $indYear = get_cimyFieldValue($user_id, 'INDUSTRY_YEARS' ); echo (($indYear)) ? $indYear : 'Not Define'; ?></big></p>
											<span>Sector : <strong><?php  $bestInd = get_cimyFieldValue($user_id,'BEST_INDUSTRY'); echo (($bestInd)) ? $bestInd : 'Not Define'; ?></strong></span>
										</div>
									</div>
								</div>
								<div class="redacted_content">
									<div class="clearfix"></div>
										<div class="quick_navigation">
										<div class="row">
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/background-management/?recruitID='.$user_id; ?>" class="thumbnail"> 
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/navback_veri.jpg" alt="Background">
											      <span>Background <br> Verifications</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/video-interview-management/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/record_int.jpg" alt="Video Interviews">
											      <span>Pre-Recorded <br> Interviews</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/resume/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/candidate_cv.jpg" alt="Resume">
											      <span>Candidates <br> Resumes</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/cover-letters/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/intro_cover.jpg" alt="Cover Letter">
											      <span>Introduction <br> Cover Letter</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/referrals/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/writn_recom.jpg" alt="Referrals">
											      <span>Personal Written <br> Recommendations</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/references/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/pers_refernc.jpg" alt="References">
											      <span>Personal <br> References</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/education/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/edu_doc.jpg" alt="Education">
											      <span>Educational <br> Documents</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/certificates/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/accomp_cert.jpg" alt="Certifications">
											      <span>Accomplishments <br> and Certifications</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/honors-and-awards/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/candidat_award.jpg" alt="Honors & Awards">
											      <span>Candidates <br> Honors & Awards</span>
											    </a>
											</div>
											<div class="col-md-2 col-sm-3 col-xs-4 devicefull">
												<a href="<?php echo site_url().'/job-seekers/licensing/?recruitID='.$user_id; ?>" class="thumbnail">
											      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_sec/pers_licens.jpg" alt="Licensing">
											      <span>Professional <br> Licensing</span>
											    </a>
											</div>
										</div>
									</div>

									<div class="side_assessments">
                                        <div class="sprofile_title">
                                            <h2>Self Assessments</h2>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="side_assess-box">
                                                    <div class="mini_tourch">
                                                        <!-- <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content=""><img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"></a> -->
                                                        <div class="mypopover">
                                                            <a href="#" class="close_popover">x</a>
                                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tourch_md.jpg">
                                                            <p>The job seekers responsive to this assessment question has been recently updated.</p>
                                                        </div>
                                                    </div>
                                                    <h4><span class="iconpro iconpro_tasks"></span>Tasks Assessment</h4>
                                                    <ul>    
                                                        <li>Validating known intelligence data <?php echo checkupdateSelfAsses('Q1', $user_id); ?> 
                                                            <span><?php echo get_star_assessment($user_id,'TASKS_Q1');   ?></span>
                                                        </li>
                                                        <li>Coordination of intelligence activities <?php echo checkupdateSelfAsses('TASKS_Q4', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'TASKS_Q4');   ?></span>
                                                        </li>
                                                        <li>Study of rings & security threats <?php echo checkupdateSelfAsses('TASKS_Q3', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'TASKS_Q3');   ?></span>
                                                        </li>
                                                        <li>Locating criminal groups? <?php echo checkupdateSelfAsses('TASKS_Q5', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'TASKS_Q5');   ?></span>
                                                        </li>
                                                        <li>Preparing comprehensive written reports? <?php echo checkupdateSelfAsses('TASKS_Q2', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'TASKS_Q2');   ?></span>
                                                        </li>
                                                    </ul>
                                                    <a href="<?php echo site_url();  ?>/job-seekers/tasks-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="side_assess-box">
                                                  <!--   <div class="mini_tourch">
                                                        <a href="#"><img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"></a>
                                                        <div class="mypopover">
                                                            <a href="#" class="close_popover">x</a>
                                                            <img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/tourch_md.jpg">
                                                            <p>The job seekers responsive to this assessment question has been recently updated.</p>
                                                        </div>
                                                    </div> -->
                                                    <h4><span class="iconpro iconpro_knowledge"></span>Knowledge Assessment</h4>
                                                    <ul>    
                                                        <li>English language proficiency <?php echo checkupdateSelfAsses('KNOW_Q1', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'KNOW_Q1');   ?></span>
                                                        </li>
                                                        <li>Media production & dissemination <?php echo checkupdateSelfAsses('KNOW_Q4', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'KNOW_Q4');   ?></span>
                                                        </li>
                                                        <li>Public Safety & Security strategies <?php echo checkupdateSelfAsses('KNOW_Q3', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'KNOW_Q3');   ?></span>
                                                        </li>
                                                        <li>Computers, electronics & applications <?php echo checkupdateSelfAsses('KNOW_Q5', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'KNOW_Q5');   ?></span>
                                                        </li>
                                                        <li>Laws, codes, procedures & regulations <?php echo checkupdateSelfAsses('KNOW_Q2', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'KNOW_Q2');   ?></span>
                                                        </li>
                                                    </ul>
                                                    <a href="<?php echo site_url();  ?>/job-seekers/knowledge-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="side_assess-box">
                                                    <h4><span class="iconpro iconpro_abilities"></span>Abilities Assessment</h4>
                                                    <ul>    
                                                        <li>Relationship among seemingly unrelated events <?php echo checkupdateSelfAsses('ABILITY_Q1', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'ABILITY_Q1');   ?></span>
                                                        </li>
                                                        <li>Problem sensitivity and recognition <?php echo checkupdateSelfAsses('ABILITY_Q6', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'ABILITY_Q6');   ?></span>
                                                        </li>
                                                        <li>Communicate with others orally <?php echo checkupdateSelfAsses('ABILITY_Q4', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'ABILITY_Q4');   ?></span>
                                                        </li>
                                                        <li>Speech recognition of other persons <?php echo checkupdateSelfAsses('ABILITY_Q7', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'ABILITY_Q7');   ?></span>
                                                        </li>
                                                        <li>Read and understand information in writing <?php echo checkupdateSelfAsses('ABILITY_Q2', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'ABILITY_Q2');   ?></span>
                                                        </li>
                                                    </ul>
                                                    <a href="<?php echo site_url();  ?>/job-seekers/abilities-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="side_assess-box">
                                                    <h4><span class="iconpro iconpro_tech"></span>Tech Assessment</h4>
                                                    <ul>    
                                                        <li>Biometrics <?php echo checkupdateSelfAsses('TECH_Q15', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'TECH_Q15');   ?></span>
                                                        </li>
                                                        <li>Charting software <?php echo checkupdateSelfAsses('TECH_Q2', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'TECH_Q2');   ?></span>
                                                        </li>
                                                        <li>Word processing software <?php echo checkupdateSelfAsses('TECH_Q13', $user_id); ?>
                                                        <span><?php echo get_star_assessment($user_id,'TECH_Q13');   ?></span>
                                                        </li>
                                                        <li>Database user interface and query software <?php echo checkupdateSelfAsses('TECH_Q3', $user_id); ?>
                                                        <span><?php echo get_star_assessment($user_id,'TECH_Q3');   ?></span>
                                                        </li>
                                                        <li>Covert / concealed video surveillance <?php echo checkupdateSelfAsses('TECH_Q14', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'TECH_Q14');   ?></span>
                                                        </li>
                                                    </ul>
                                                    <a href="<?php echo site_url();  ?>/job-seekers/technology-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="side_assess-box">
                                                    <h4><span class="iconpro iconpro_skills"></span>Skills Assessment</h4>
                                                    <ul>    
                                                        <li>Reading comprehension & understanding <?php echo checkupdateSelfAsses('SKILLS_Q1', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'SKILLS_Q1');   ?></span>
                                                        </li>
                                                        <li>Adjusting actions in relation to others <?php echo checkupdateSelfAsses('SKILLS_Q9', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'SKILLS_Q9');   ?></span>
                                                        </li>
                                                        <li>Instruction, mentoring and teaching others <?php echo checkupdateSelfAsses('SKILLS_Q12', $user_id); ?>
                                                        <span><?php echo get_star_assessment($user_id,'SKILLS_Q12');   ?></span>
                                                        </li>
                                                        <li>Social perceptiveness & situational awareness <?php echo checkupdateSelfAsses('SKILLS_Q11', $user_id); ?>
                                                        <span><?php echo get_star_assessment($user_id,'SKILLS_Q11');   ?></span>
                                                        </li>
                                                        <li>Active listening & follow up inquiry <?php echo checkupdateSelfAsses('SKILLS_Q2', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'SKILLS_Q2');   ?></span>
                                                        </li>
                                                    </ul>
                                                    <a href="<?php echo site_url();  ?>/job-seekers/skills-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="side_assess-box">
                                                    <h4><span class="iconpro iconpro_work"></span>Work Assessment</h4>
                                                    <ul>    
                                                        <li>Representing to external sources <?php echo checkupdateSelfAsses('WORK_ACT_Q11', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'WORK_ACT_Q11');   ?></span>
                                                        </li>
                                                        <li>Coaching, developing & mentoring <?php echo checkupdateSelfAsses('WORK_ACT_Q22', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'WORK_ACT_Q22');   ?></span>
                                                        </li>
                                                        <li>Training, development or instruction <?php echo checkupdateSelfAsses('WORK_ACT_Q18', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'WORK_ACT_Q18');   ?></span>
                                                        </li>
                                                        <li>Coordinating work activities of others <?php echo checkupdateSelfAsses('WORK_ACT_Q23', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'WORK_ACT_Q23');   ?></span>
                                                        </li>
                                                        <li>Determining the best solution & solve problems <?php echo checkupdateSelfAsses('WORK_ACT_Q12', $user_id); ?>
                                                            <span><?php echo get_star_assessment($user_id,'WORK_ACT_Q12');   ?></span>
                                                        </li>
                                                    </ul>
                                                    <a href="<?php echo site_url();  ?>/job-seekers/work-activities-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

									<div class="quickview_tab">
									  <!-- Nav tabs -->
									  <ul class="nav nav-tabs redacted_retab" role="tablist">
									    <li role="presentation" class="active"><a href="#tabCommunications" aria-controls="tabCommunications" role="tab" data-toggle="tab">Communications<span>3</span></a></li>
									    <li role="presentation"><a href="#tabJobMatch" aria-controls="tabJobMatch" role="tab" data-toggle="tab">Job Match</a></li>
									    <li role="presentation"><a href="#tabQuestions" aria-controls="tabQuestions" role="tab" data-toggle="tab">Questions</a></li>
									    <li role="presentation"><a href="#tabPhotoScreen" aria-controls="tabPhotoScreen" role="tab" data-toggle="tab">Phone Screen</a></li>
									    <li role="presentation"><a href="#tabNotes" aria-controls="tabNotes" role="tab" data-toggle="tab">Notes</a></li>
									    <li role="presentation"><a href="#offerManagement" aria-controls="offerManagement" role="tab" data-toggle="tab">Offer Management</a></li>
										<li role="presentation"><a href="#tabTesting" aria-controls="tabTesting" role="tab" data-toggle="tab">Testing</a></li>
									    <li role="presentation"><a href="#tabSupportServices" aria-controls="tabSupportServices" role="tab" data-toggle="tab">Support Services</a></li>
									  </ul>

									  <!-- Tab panes -->
									  <div class="tab-content">
									   <div role="tabpanel" class="tab-pane active" id="tabCommunications">
									    	<div class="communications">
										    	<div class="comments_list">
											    	<div class="clearfix">
											    		<a href="javascript:void(0);" class="text-blue">+ Add Comment (Optional)</a>
											    	</div>
											    	<?php   
											    	//fetch comments
													$limit=10;
													$comment_pages= $wpdb->get_results ( "SELECT * FROM eyecuwp_seeker_profile_comment WHERE meta = '".$user_id."'" );
													$total_records=count($comment_pages);
													$total_pages=ceil($total_records/$limit);
													
										    		$currentId=get_current_user_id();
													$user_comments= $wpdb->get_results ( "SELECT * FROM (SELECT * FROM eyecuwp_seeker_profile_comment WHERE meta = '".$user_id."' order by id DESC limit ".$limit.") sub ORDER BY id ASC" );
													if ( $total_records <= 0 ) {
														echo '<div id="usercomments"> <h5 class="no_comment_found">No comment found for this user.</h5></div>';
													}
													else{ ?>
												    	<div id="usercomments">
														    <?php foreach($user_comments as $ucomments)  {       
														    	 	$userId=$ucomments->user_id; 
														    		$id=$ucomments->id;
                                    								$newdate= date('h:ia l m/d/Y',$ucomments->date);
													    	  	?>
														    		<article class="<?php echo (($userId == $currentId))? 'current_user' : ''; ?>">
														    			<div class="img-circle"><?php 
															    			if ( (has_wp_user_avatar($userId))) {
																				echo get_wp_user_avatar($userId, ' img-responsive'); 
																			}else{
																				?>
																					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/EyeRecruit_Avitar.jpg" height="225px" width="190px" class="img-responsive">
																				<?php
																			}
																			?>
														    			</div>
														    			<div class="comment_cont row">
															    			<div class="col-md-9" id="c<?php echo $id ?>" >
																    			<p><?php echo $ucomments->comment; ?></p>
																    			<?php if($userId==$currentId){ ?>
															    					<button class="edit btn btn-default btn-sm" id="<?php echo $id ?>">Edit</button>
															    					<button class="delete btn btn-sm btn-primary" id="d<?php echo $id ?>">Delete</button>
															    				<?php  }  ?>
															    				<div class="clearfix"></div>
															    			</div>
															    			<div class="col-md-3 text-right"><span class="ecomm"><?php echo (($newdate)) ? $newdate : ''; ?></span></div>
														    			</div>
														    		</article>
													    	<?php   }  ?>
											    		</div>
											    		<?php if ( $total_records > 10 ) { ?>
												    		<button id="prev" class="btn btn-primary btn-sm pull-left" offsetno="1">‹ Prev</button>
															<button id="next" class="btn btn-primary btn-sm pull-right" offsetno="0" style="display:none;">Next ›</button>
												    		<input type="hidden" name="totalPages" totalcomm="<?php echo $total_records; ?>" id="tp" value="<?php echo $total_pages; ?>">
												    	<?php } ?>
											    	<?php } ?>
									    			<div class="clearfix"></div>
									    		</div>
									    		<?php  if(is_user_logged_in()) {  ?>
											    	<form class="comments_submit" id="seekercomment" action="" method="post">
											    		<article>
											    			<div class="img-circle">
											    			<?php
											    				if ( (has_wp_user_avatar($employer_id))) {
																echo get_wp_user_avatar($employer_id, ' img-responsive'); 
																}else{
															?>
																<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/EyeRecruit_Avitar.jpg" height="225px" width="190px" class="img-responsive">
															<?php
																}
															?>
											    			</div>
											    			<div class="comment_cont">
											    				<input type="hidden" id="hd" name="hideid" value="">
													    		<input class="form-control" type="text" name="comment_message" id="scomment" placeholder="Write your message here...">
													    		<button class="btn btn-primary pull-right sent" type="submit" id="seekersubmit">Post</button>
													    		<span id="dlt"></span>
											    			</div>
											    			<div class="clearfix"></div>
											    		</article>
											    	</form>
										    	<?php   }else{    ?>
										    		<span>Please Login to post the comment.</span>
										    	<?php } ?>
									    	</div>
									    </div>
									    <div role="tabpanel" class="tab-pane" id="tabJobMatch">
									    	<div class="job_match">
										    	<?php 
										    	$cate = array('Investigation' => 'investigations',  'Surveillance' => 'video-surveillance',  'Security' => 'security',  'Risk Management' => 'risk-management',  'Information Technology' => 'information-technology',  'Investigative Journalist' => 'investigative-journalism',  'Loss Prevention' => 'loss-prevention',  'Operations Management' => 'operations-management',  'Marketing & Sales' => 'marketing-sales',  'Support Staff' => 'support-staff');
										    	$BEST_INDUSTRY = get_cimyFieldValue($user_id,'BEST_INDUSTRY'); 
										    	if ( !empty($BEST_INDUSTRY) ) {
											    	if ( isset($cate[$BEST_INDUSTRY]) &&  !empty($cate[$BEST_INDUSTRY]) ) {
											    		$arg = array(
											    			'post_type' => 'job_listing',
											    			'post_status' => 'publish',
															'posts_per_page' => 5,
											    			'tax_query' => array(
																array(
																	'taxonomy' => 'job_listing_category',
																	'field'    => 'slug',
																	'terms'    => $cate[$BEST_INDUSTRY],
																),
															),
											    		);
											    		$query = new WP_Query( $arg );

											    		if ( $query->have_posts() ) {
															while ( $query->have_posts() ) {
																$query->the_post(); 
																$jobID = get_the_ID();
																?>
																<article id="<?php echo "job_id_".the_ID(); ?>">
													    			<a href="<?php the_permalink(); ?>"><h3><?php echo get_the_title(); ?> from <?php echo get_the_date('m/d/Y'); ?></h3></a>
													    			<p>Does this candidate meet the Minimum Requirements?</p>
													    			<div class="likes_sec">
														    			<div class="likes_row">
														    				<div class="like_bx unexpectable_icon">
														    					<span></span>
														    					<p>Unexpectable</p>
														    				</div>
														    				<div class="like_bx poor_icon">
														    					<span></span>
														    					<p>Poor</p>
														    				</div>
														    				<div class="like_bx expectable_icon">
														    					<span></span>
														    					<p>Expectable</p>
														    				</div>
														    				<div class="like_bx believing_icon">
														    					<span></span>
														    					<p>Believing</p>
														    				</div>
														    				<div class="like_bx rating_icon">
														    					<span></span>
														    					<p>Rating</p>
														    				</div>
														    			</div>
														    			<a href="#" class="text-blue">+ Add Comment (Optional)</a>
														    			<a href="#" class="btn btn-sm btn-primary pull-right">Update</a>
														    			<div class="clearfix"></div>
													    			</div>
													    			<div class="jobmatch_cont">
													    				<?php
													    				$job_preferred_qualification_other = get_post_meta($jobID, '_job_preferred_qualification_other', true); 
																		$job_acceptance_exams = get_post_meta($jobID, '_job_acceptance_exams', true); 
													    				?>
													    				<h5>Ideal Candidate Criteria</h5>
													    				<?php
												    					echo "<ul>";
													    					if ( !empty($job_preferred_qualification_other) || !empty($job_acceptance_exams) ) {
													    						foreach ($job_preferred_qualification_other as $value) {
													    							echo "<li>".$value."</li>";
													    						}

													    						foreach ($job_acceptance_exams as $value) {
													    							echo "<li>".$value."</li>";
													    						}
													    					}
													    					else{
													    						echo "Data Not Found";
													    					}
												    					echo "</ul>";	


													    				$job_experience_length = get_post_meta($jobID, '_job_experience_length', true); 
													    				?>
													    				<h5>Your requirements for Experience?</h5>
													    				<?php
												    					echo "<ul>";
													    					if ( !empty($job_experience_length) ) {
													    						foreach ($job_experience_length as $value) {
													    							echo "<li>".$value."</li>";
													    						}
													    					}
													    					else{
													    						echo "Data Not Found";
													    					}
												    					echo "</ul>";	
													    				
																		$job_education_certifications = get_post_meta($jobID, '_job_education_certifications', true); 
																		?>
													    				
													    				<h5>Your requirements for Education, Licensure & Certificates</h5>
													    				<?php
												    					echo "<ul>";
													    					if ( !empty($job_education_certifications) ) {
													    						foreach ($job_education_certifications as $value) {
													    							echo "<li>".$value."</li>";
													    						}
													    					}
													    					else{
													    						echo "Data Not Found";
													    					}
												    					echo "</ul>";	
													    				
													    				$job_preferred_qualifications = get_post_meta($jobID, '_job_preferred_qualifications', true); 
													    				?>
													    				
													    				<h5>Your requirements for Preferred Qualifications?</h5>
													    				<?php
												    					echo "<ul>";
													    					if ( !empty($job_preferred_qualifications) ) {
													    						foreach ($job_preferred_qualifications as $value) {
													    							echo "<li>".$value."</li>";
													    						}
													    					}
													    					else{
													    						echo "Data Not Found";
													    					}
												    					echo "</ul>";	
													    				?>
													    			</div>
													    		</article> <?php
															}
															wp_reset_postdata();
														}
														else{
															echo '<div class="savejobnotfound">No matching job found.</div>';
														}
											    	}
											    	else{
											    		echo '<div class="savejobnotfound">No matching job found.</div>';
											    	}
										    	}
										    	else{
										    		echo '<div class="savejobnotfound">No matching job found.</div>';
										    	} ?>
									    	</div>
									    </div>
									    <div role="tabpanel" class="tab-pane" id="tabQuestions">
									    	<div class="clearfix">
									    		<a href="#" class="quickview_tablink">+ Add Question</a>
									    		<a href="#" class="quickview_tablink pull-right">Modify Order <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
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
									    <div role="tabpanel" class="tab-pane" id="tabPhotoScreen">
									    	<div class="clearfix">
									    		<a href="#" class="quickview_tablink">+ Add Question</a>
									    		<a href="#" class="quickview_tablink pull-right">Modify Order <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
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
									    <div role="tabpanel" class="tab-pane" id="tabNotes">
									    	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
									    	<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
									    	<ul>
												<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
												<li>Pellentesque ultrices justo hendrerit, molestie est pharetra, faucibus libero.</li>
												<li>Quisque in urna feugiat, interdum leo quis, elementum augue.</li>
												<li>Nullam mattis sapien at lectus luctus sollicitudin.</li>
												<li>In hendrerit felis vitae hendrerit convallis.</li>
											</ul>
											<form class="form">
												<div class="form-group">
												    <label for="AddNotes">Add Notes</label>
												    <textarea class="form-control" id="AddNotes"></textarea>
												</div>
												<div class="form-group">
												    <button class="btn btn-primary" type="submit">Add Notes</button>
												</div>
											</form>
									    </div>
									    <div role="tabpanel" class="tab-pane" id="offerManagement">
									    	<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
									    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									    	<ul>
												<li>Curabitur ut felis in neque commodo finibus.</li>
												<li>Nunc at massa at justo tempus sagittis sed eu dui.</li>
												<li>Sed et sapien iaculis, fringilla eros in, auctor ex.</li>
												<li>Aliquam sollicitudin est id erat euismod interdum.</li>
												<li>Maecenas sit amet risus in orci faucibus accumsan vel sed erat.</li>
												<li>Morbi nec purus feugiat, feugiat erat non, ullamcorper felis.</li>
												<li>Morbi porta ligula et diam facilisis, in elementum dolor iaculis.</li>
											</ul>
									    </div>
									    <div role="tabpanel" class="tab-pane" id="tabTesting">
									    	<div class="job_match">
									    		<article>
									    			<div class="jobmatch_cont">
									    				<h5>Your requirements for Education, Licensure & Certificates</h5>
									    				<ul>
									    					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
									    					<li>Integer feugiat mi eu nibh volutpat, non rhoncus nulla laoreet.</li>
									    					<li>Nunc vel sapien sed est volutpat vulputate sed non tellus.</li>
									    					<li>Etiam laoreet orci eu purus feugiat vulputate.</li>
									    				</ul>
									    				<h5>Ideal Candidate Criteria</h5>
									    				<ul>
									    					<li>Duis ultricies lectus at velit molestie imperdiet.</li>
									    					<li>Vestibulum sed justo placerat, bibendum sapien id, condimentum sem.</li>
									    					<li>Nam eget purus consequat risus iaculis venenatis quis eu metus.</li>
									    					<li>Curabitur posuere risus eu est gravida ultrices.</li>
									    				</ul>
									    				<h5>Your requirements for Experience?</h5>
									    				<ul>
									    					<li>Donec hendrerit urna faucibus augue faucibus, id vehicula odio condimentum.</li>
									    					<li>Phasellus eleifend nisl eu metus pellentesque, ullamcorper iaculis dui scelerisque.</li>
									    					<li>Ut sit amet erat ullamcorper, vehicula justo ut, dictum est.</li>
									    				</ul>
									    				<h5>Your requirements for Preferred Qualifications?</h5>
									    				<ul>
									    					<li>Vestibulum varius risus vel nisl finibus posuere.</li>
									    					<li>Sed at erat sagittis, sodales ante vitae, auctor metus.</li>
									    					<li>Vestibulum a purus nec dui volutpat posuere ut quis erat.</li>
									    				</ul>
									    			</div>
									    		</article>
									    	</div>
									    </div>
									    <div role="tabpanel" class="tab-pane" id="tabSupportServices">
									    	<div class="support_serv">
												<div class="row">
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/01/icon-resume.png" class="img-responsive">
															<h6>Resume <br>Services</h6>
														</a>
													</div>
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/02/icon-interview.png" class="img-responsive">
															<h6>Interview <br>Coaching</h6>
														</a>
													</div>
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/02/icons-salary.png" class="img-responsive">
															<h6>Salary <br>Negotiation</h6>
														</a>
													</div>
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/01/icon-negotiation.png" class="img-responsive">
															<h6>Contract <br>Opportunities</h6>
														</a>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/01/icon-training.png" class="img-responsive">
															<h6>Onboarding <br>Orientation</h6>
														</a>
													</div>
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/02/icon-direction.png" class="img-responsive">
															<h6>Transition <br>Support</h6>
														</a>
													</div>
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/01/icon-truck.png" class="img-responsive">
															<h6>Relocation<br>Services</h6>
														</a>
													</div>
													<div class="col-sm-3 col-xs-6 devicehalf">
														<a href="javascript:void(0);">
															<img src="<?php echo site_url(); ?>/assets/uploads/2015/02/icons-performance.png" class="img-responsive">
															<h6>Performance <br>Consulting</h6>
														</a>
													</div>
												</div>
											</div>
									    </div>
									  </div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-lg-pull-8 col-md-6 col-md-pull-0">
							<?php get_template_part('Recuiter/content', 'reda_left_sidebar'); ?>
						</div>
						<div class="col-lg-2 col-md-6">
							<?php get_template_part('Recuiter/content', 'reda_right_sidebar'); ?>
						</div>
					</div>
				</div>
			</section>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var totalPages=jQuery("#tp").val();
		var nxtbtn=jQuery("#next").attr('offsetno');
		var prevbtn=jQuery("#prev").attr('offsetno');
		if(nxtbtn==0){
			jQuery( "#next" ).hide();
		}
		jQuery( "#prev" ).show();
 		jQuery("#next,#prev").click(function(){
 			jQuery('#loaders').show();
 			var _this = jQuery(this);
 			var offset = _this.attr('offsetno');
			loadCurrentPage(offset);
 		});

 		function loadCurrentPage(offset){
 			jQuery.ajax({
 				url: "<?php echo admin_url('admin-ajax.php'); ?>",
 				type: 'POST',
 				data: {
 					action: "seeker_comment_page", 
 					"offset": offset*10
 				},
 				success: function (data) {
 					if ( offset <= 1 ) {
 						jQuery("#next").attr('offsetno',0);
 					}
 					else{
 						jQuery("#next").attr('offsetno',offset-1);
 					}
 					offset++;
 					jQuery("#prev").attr('offsetno',offset);
 					jQuery('#usercomments').html(data);
 					var nxtbtn=jQuery("#next").attr('offsetno');
					var prevbtn=jQuery("#prev").attr('offsetno');
 					if(nxtbtn==0 && prevbtn==1){
						jQuery( "#next" ).hide();
					}else{
						jQuery( "#next" ).show();
					}
					if(totalPages==prevbtn){
					 	jQuery( "#prev" ).hide();
					}else{
					 	jQuery( "#prev" ).show();
					}

 					jQuery('#loaders').hide();
					jQuery('html, body').animate({
			        	scrollTop: jQuery("#seekercomment").offset().top-550
			    	}, 1000);
 				}
 			});
 		}

		jQuery("#seekersubmit").html('Post'); 
		jQuery("#scomment").val('');
        jQuery("#hd").val('');

        jQuery(document).on('click' ,'.edit', function(e){
			jQuery('html, body').animate({
	        	scrollTop: jQuery("#seekercomment").offset().top-200
	    	}, 2000);
         	jQuery("#seekersubmit").html('Update');    
			var id=jQuery(this).attr('id');
			var item = jQuery("#c"+id+' p').text(); 
            jQuery("#scomment").val(item);
            jQuery("#hd").val(id);
		});

      	jQuery(document).on('click' ,'.delete', function(){
      		var total_comm = jQuery('#tp').attr('totalcomm');
			var id=jQuery(this).attr('id');
			var avoid='d';
			id=id.replace(avoid,'');
			jQuery.ajax({
				type: 'POST',
				dataType: 'html',
				url: "<?php echo admin_url('admin-ajax.php'); ?>",
				data: {"action": "your_delete_action", "element_id": id},
				success: function (data) {
					jQuery("#dlt").html(data).delay(5000).fadeOut();
					jQuery("#d" + id).closest("article").hide();
					swal({
						title: "Delete", 
						html: true,
						text: "<span class='text-center'>Successfully delete your comment.</span>",
						type: "success",
						confirmButtonClass: "btn-primary btn-sm",
					});
					/*var left_total_comm = parseInt(total_comm)-1;
      				var totalPages = Math.ceil(left_total_comm/10);
      				jQuery('#tp').val(totalPages);*/
				}
			});
		});

		jQuery('html').click(function(e) {   
			if( jQuery(e.target).hasClass('edit') || jQuery(e.target).hasClass('form-control') || jQuery(e.target).hasClass('sent')) {
				jQuery("#hid").val();
			}else{
				jQuery("#scomment").val('');
               	jQuery("#hd").val('');
               	jQuery("#seekersubmit").html('Post'); 
			}
		});   

	   	jQuery("#seekercomment").validate({ 
			rules: {
				comment_message: {
					required: true
				}
			},
			submitHandler: function (form) {
				jQuery( "#seekersubmit" ).prop( "disabled", true );
				var comm= jQuery('#scomment').val();
				var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
				var user_id = "<?php echo $employer_id;  ?>";
				var recruitID = "<?php echo $_GET['recruitID']; ?>";
				var tm  = "<?php echo $now; ?>";
				var hid = jQuery("#hd").val();
				if(hid == ''){
					var hid='null';
				}	

				jQuery.ajax({
					type: 'POST',
					dataType: 'html',
					url:ajaxurl,
					data: {
						'action': 'ey_seeker_profile_comment', //calls wp_ajax_nopriv_ajaxlogin
						'comment': comm,
						'user_id': user_id,
						'time': tm,
						'hid': hid,
						'recruitID': recruitID,
					},
					success: function(data){
						jQuery( "#seekersubmit" ).prop( "disabled", false );
						if(hid!='null'){
							jQuery("#c"+hid+' p').html(data); 
							jQuery('html, body').animate({
								scrollTop: jQuery("#" + hid).closest("article").offset().top-200
							}, 1000);
							jQuery("#seekersubmit").html('Post'); 
							jQuery("#scomment").val('');
							jQuery("#hd").val('');
						}else{	
							jQuery("#usercomments").append(data);
							jQuery('.no_comment_found').remove();
							jQuery("#scomment").val('');
							jQuery("#hd").val('');
						}
					}	
				});
			}
		});
	});    
</script>

<script type="text/javascript">
	function printDiv() {
	  var divContents = jQuery("#DivIdToPrint").html();
	  var divToPrint=document.getElementById('DivIdToPrint');

	  var newWin=window.open('','Print-Window');

	  newWin.document.open();

	  newWin.document.write('<html><body onload="window.print()">'+divContents+'</body></html>');

	  newWin.document.close();

	  setTimeout(function(){newWin.close();},10);
	}

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
<?php get_footer('seekerdasboard'); ?>


<div class="modal fade sendamail" id="sendamail" tabindex="-1" role="dialog" aria-labelledby="sendamailLabel">
  <?php echo recrutier_contact_now(); ?>
</div> 
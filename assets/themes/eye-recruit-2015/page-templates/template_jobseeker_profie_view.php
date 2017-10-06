<?php
/**
 * Template Name: A job seeker Profile view
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header();
if($_REQUEST['uID']){
  $user_id =  $_REQUEST['uID'];
}else{
  $user_id =  get_current_user_id();    
}

$userdata = get_userdata($user_id);
$userMeta = get_user_meta($user_id);
?>
<?php  
function getCimyOrUndefined ($field_name,$user_id){
  $value   = get_cimyFieldValue($user_id,$field_name);
  if($value){
    return $value;
  }else{
    return 'Not defined';        
  }

}

?>

<style>
.star_rating-1,.star_rating-2,.star_rating-3,.star_rating-4,.star_rating-5{
  font-family: "FontAwesome"; 
  display:inline-block;
}
.star_rating-1:after{
  content: "\f005 \f006 \f006 \f006 \f006";
}
.star_rating-2:after{
  content: "\f005 \f005 \f006 \f006 \f006";
}
.star_rating-3:after{
  content: "\f005 \f005 \f005 \f006 \f006";
}
.star_rating-4:after{
  content: "\f005 \f005 \f005 \f005 \f006";
}
.star_rating-5:after{
  content: "\f005 \f005 \f005 \f005 \f005"; 
}

li.icon{
  position: relative;
}
.checkfactual{
  display; block; 
  width: 32px;
  height: 44px;
  position: absolute;
  right: 0;
  top: 0;
  z-index: 10;
}
</style>

<?php while ( have_posts() ) : the_post(); ?>

  <header class="page-header page-header_btn">
    <!-- <h1 class="page-title"><?php the_title(); ?></h1> -->
    <div class="container">
      <a href="<?php echo site_url();  ?>/job-seekers/dashboard/" class="btn btn-success btn-sm">Back to Dashboard</a>
    </div>
  </header>

  <div id="primary" class="content-area">
    <div id="content" role="main">
      <div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
      <section class="seeker_profile redacted_recruiter">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8 col-lg-push-2 col-md-12 col-md-push-0">
              <div class="seekr_profile" id="DivIdToPrint">
                <div class="sprofile_header">
                  <span class="spro_recruiterid"><strong>Recruit ID :</strong> <?php echo $user_id; ?></span>
                  <div class="row">
                    <div class="col-md-5 col-sm-4">
                      <div class="presented_by">
                        <p>This candidate presented to you by:</p>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/sprofile_logo.jpg" class="img-responsive"> 
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                      <div class="thumbnail"> 
                        <?php
                        $allwoPhoto = get_cimyFieldValue($user_id, 'PNA_PHOTOGRAPH');
                        if (  ($allwoPhoto != 'No') ) {
                          echo do_shortcode('[ica_avatar uid="'.$user_id.'"]'); 
                        }else{
                          ?>
                          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/EyeRecruit_Avitar.jpg" height="225px" width="190px" class="thumbnail">
                          <?php
                        }
                        ?>
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
                      <span>Member Since : <strong><?php echo  date( "Y", strtotime($userdata->user_registered)); ?></strong></span>
                    </div>
                    <div class="col-md-5 col-sm-4 col-md-push-0 col-sm-push-0">
                      <p><big>Experience : </big><?php echo getCimyOrUndefined('INDUSTRY_YEARS',$user_id); ?></p>
                      <span>Sector : <strong><?php  echo getCimyOrUndefined('BEST_INDUSTRY', $user_id);  ?></strong></span>
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
                          <span>Pre-Recorded <br> Interviews</span><!-- Video Interviews -->
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
                </div>
                <div class="side_assessments">
                  <div class="sprofile_title">
                    <h2>Self Assessments</h2>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-6">
                      <div class="side_assess-box">
                        <div class="mini_tourch">
                          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"></a>
                          <div class="mypopover">
                            <a href="#" class="close_popover">x</a>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tourch_md.jpg">
                            <p>The job seekers responsive to this assessment question has been recently updated.</p>
                          </div>
                        </div>
                        <h4><span class="iconpro iconpro_tasks"></span>Tasks Assessment</h4>
                        <?php
                          echo get_employer_pov_candidate_assessments_overview(483,$user_id);
                        ?>

                        <!-- <a href="<?php echo site_url();  ?>/job-seekers/tasks-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a> -->
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="side_assess-box">
                        <div class="mini_tourch">
                          <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mini_torch.png"></a>
                          <div class="mypopover">
                            <a href="#" class="close_popover">x</a>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tourch_md.jpg">
                            <p>The job seekers responsive to this assessment question has been recently updated.</p>
                          </div>
                        </div>
                        <h4><span class="iconpro iconpro_knowledge"></span>Knowledge Assessment</h4>
                        <?php
                          echo get_employer_pov_candidate_assessments_overview(486,$user_id);
                        ?>
                        
                        <!-- <a href="<?php echo site_url();  ?>/job-seekers/knowledge-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a> -->
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="side_assess-box">
                        <h4><span class="iconpro iconpro_abilities"></span>Abilities Assessment</h4>
                        <?php
                          echo get_employer_pov_candidate_assessments_overview(485,$user_id);
                        ?>
                        
                        <!-- <a href="<?php echo site_url();  ?>/job-seekers/abilities-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a> -->
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="side_assess-box">
                        <h4><span class="iconpro iconpro_tech"></span>Tech Assessment</h4>
                        <?php
                          echo get_employer_pov_candidate_assessments_overview(484,$user_id);
                        ?>
                        
                        <!-- <a href="<?php echo site_url();  ?>/job-seekers/technology-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a> -->
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="side_assess-box">
                        <h4><span class="iconpro iconpro_skills"></span>Skills Assessment</h4>
                        <?php
                          echo get_employer_pov_candidate_assessments_overview(487,$user_id);
                        ?>
                        
                        <!-- <a href="<?php echo site_url();  ?>/job-seekers/skills-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a> -->
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="side_assess-box">
                        <h4><span class="iconpro iconpro_work"></span>Work Assessment</h4>
                        <?php
                          echo get_employer_pov_candidate_assessments_overview(488,$user_id);
                        ?>
                        
                        <!-- <a href="<?php echo site_url();  ?>/job-seekers/work-activities-assessment/?recruitID=<?php echo $user_id; ?>"><i class="fa fa-angle-double-left"></i> See More <i class="fa fa-angle-double-right"></i></a> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="quickview_tab">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tabCommunications" aria-controls="tabCommunications" role="tab" data-toggle="tab">Communications<span>3</span></a></li>
                    <li role="presentation"><a href="#tabJobMatch" aria-controls="tabJobMatch" role="tab" data-toggle="tab">Job Match</a></li>
                    <li role="presentation"><a href="#tabQuestions" aria-controls="tabQuestions" role="tab" data-toggle="tab">Secondary Questions</a></li>
                    <li role="presentation"><a href="#tabPhotoScreen" aria-controls="tabPhotoScreen" role="tab" data-toggle="tab">Video Interview</a></li>
                    <li role="presentation"><a href="#tabNotes" aria-controls="tabNotes" role="tab" data-toggle="tab">Offer Management</a></li>
                    <li role="presentation"><a href="#tabSupportServices" aria-controls="tabSupportServices" role="tab" data-toggle="tab">Testing</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tabCommunications">
                      <div class="communications">
                        <div class="comments_list">
                          <div class="clearfix">
                            <a href="javascript:void(0);" class="text-blue">+ Add Comment (Optional)</a>
                          </div>
                          <div id="usercomments"> <h5 class="no_comment_found">No comment found for this user.</h5></div>
                          <div class="clearfix"></div>
                        </div>
                        <form class="comments_submit" id="seekercomment" action="" method="post">
                          <article>
                            <div class="img-circle">
                              <?php
                              echo do_shortcode('[ica_avatar uid="'.$user_id.'"]');
                              ?>
                            </div>

                            <div class="comment_cont">
                              <input class="form-control" type="text" name="comment_message" id="scomment" placeholder="Write your message here...">
                              <button class="btn btn-primary pull-right sent" type="button" >Post</button>
                              <span id="dlt"></span>
                            </div>
                            <div class="clearfix"></div>
                          </article>
                        </form>

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
                        <div class="job_match">
                          <article>
                            <div class="jobmatch_cont">
                              <h5>Your requirements for Preferred Qualifications?</h5>
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
                              <h5>Your requirements for Education, Licensure & Certificates</h5>
                              <ul>
                                <li>Vestibulum varius risus vel nisl finibus posuere.</li>
                                <li>Sed at erat sagittis, sodales ante vitae, auctor metus.</li>
                                <li>Vestibulum a purus nec dui volutpat posuere ut quis erat.</li>
                              </ul>
                            </div>
                          </article>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="tabPhotoScreen">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="video_interview_box">
                              <div class="thumbnail"><img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/img/sprofile_user.jpg"></div>
                              <p></p>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="video_interview_box">
                              <div class="thumbnail"><img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/img/cirstopher.jpg"></div>
                              <p></p>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="video_interview_box">
                              <div class="thumbnail"><img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/img/team_member1.jpg"></div>
                              <span>Waiting to Join the meeting</span>
                            </div>
                          </div>
                        </div>
                        <div class="communications">
                          <div class="comments_list">
                            <div id="usercomments">                 
                              <article class="current_user">
                                <div class="img-circle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cirstopher.jpg" alt="andersonsmith" class="avatar avatar- img-responsive wp-user-avatar wp-user-avatar- img-responsive alignnone photo"></div>
                                <div class="comment_cont row">
                                  <div class="col-md-9" id="c1">
                                    <p>We will starting in 5min.</p>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="col-md-3 text-right"><span> 11:24am Tuesday 27/12/2016 </span></div>
                                </div>
                              </article> 
                              <article class="current_user">
                                <div class="img-circle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/sprofile_user.jpg" alt="andersonsmith" class="avatar avatar- img-responsive wp-user-avatar wp-user-avatar- img-responsive alignnone photo"></div>
                                <div class="comment_cont row">
                                  <div class="col-md-9" id="c1">
                                    <p>I am ready to go.</p>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="col-md-3 text-right"><span> 11:25am Tuesday 27/12/2016 </span></div>
                                </div>
                              </article> 
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <form class="comments_submit" id="seekercomment" action="" method="post" novalidate="novalidate">
                            <article>
                              <div class="img-circle">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cirstopher.jpg" alt="andersonsmith" class="avatar avatar- img-responsive wp-user-avatar wp-user-avatar- img-responsive alignnone photo">                                                            </div>
                                <div class="comment_cont">
                                  <input id="hd" name="hideid" value="" type="hidden">
                                  <input class="form-control valid" name="comment_message" id="scomment" placeholder="Write your message here..." aria-required="true" type="text">
                                  <button class="btn btn-primary pull-right sent" type="submit" id="seekersubmit">Post</button>
                                  <span id="dlt"></span>
                                </div>
                                <div class="clearfix"></div>
                              </article>
                            </form>
                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tabNotes">
                          <div class="job_match">
                            <article>
                              <div class="jobmatch_cont">
                                <h5>Ideal Candidate Criteria</h5>
                                <ul>
                                  <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                  <li>Integer feugiat mi eu nibh volutpat, non rhoncus nulla laoreet.</li>
                                  <li>Nunc vel sapien sed est volutpat vulputate sed non tellus.</li>
                                  <li>Etiam laoreet orci eu purus feugiat vulputate.</li>
                                </ul>
                                <h5>Your requirements for Experience?</h5>
                                <ul>
                                  <li>Duis ultricies lectus at velit molestie imperdiet.</li>
                                  <li>Vestibulum sed justo placerat, bibendum sapien id, condimentum sem.</li>
                                  <li>Nam eget purus consequat risus iaculis venenatis quis eu metus.</li>
                                  <li>Curabitur posuere risus eu est gravida ultrices.</li>
                                </ul>
                                <h5>Your requirements for Education, Licensure & Certificates</h5>
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
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-lg-pull-8 col-md-6 col-md-pull-0">
                  <div class="sidebar">
                   <div class="light_box snap_shot ata_glance">
                     <div class="sidebar_title">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ata_glance.jpg" class="title_icon">
                      <h4>At a Glance</h4>
                    </div>
                    <ul>
                      <li><span>Candidate Search Status :</span><?php echo getCimyOrUndefined('SYSTEM_AND_PROCE',$user_id); ?></li>
                      <li><span>Industry Sector :</span><?php  echo getCimyOrUndefined('BEST_INDUSTRY',$user_id);  ?></li>
                      <li><span>Industry Experience :</span><?php  echo getCimyOrUndefined('INDUSTRY_YEARS',$user_id);  ?></li>
                      <li><span>Highest Level of Education :</span><?php  echo getCimyOrUndefined('HIGHEST_EDUCATION',$user_id);  ?></li>
                      <li><span>Current Career Level :</span><?php  echo getCimyOrUndefined('CURR_CAREER_LVL',$user_id);  ?></li>
                      <li class="<?php  if (strtolower(get_cimyFieldValue($user_id,'COMPENSATION_ACC'))=='do not show employer'){echo 'icon locked';} ?>">
                        <span>Current Income Range :</span>
                        <?php  if(strtolower(get_cimyFieldValue($user_id,'COMPENSATION_ACC'))=='do not show employer'){
                         echo 'Confidential';
                       }else{
                        echo getCimyOrUndefined('COMPENSATION_CURRENT',$user_id); 
                      } ?>
                    </li>

                    <li class="<?php  if (strtolower(get_cimyFieldValue($user_id,'COMP_DESIRED_ACC'))=='do not show employer'){echo 'icon locked';} ?>">

                     <span>Desired Income Range :</span>
                     <?php  if (strtolower(get_cimyFieldValue($user_id,'COMP_DESIRED_ACC'))=='do not show employer'){
                      echo 'Confidential';
                    }else{
                      echo getCimyOrUndefined('COMPENSATION_DESIRED',$user_id); 
                    } 
                    ?>
                  </li>
                  <li><span>Date Available to Start :</span><?php echo getCimyOrUndefined('WORK_DATE_AVAILABLE',$user_id); ?></li>
                  <li><span>Willingness to Relocate :</span><?php echo getCimyOrUndefined('RELOCATION_YN',$user_id); ?></li>
                  <li><span>Job Search Radius :</span><?php echo getCimyOrUndefined('JOB_SEARCH_RADIUS',$user_id); ?></li>
                  <li><span>Spoken Language(s) :</span><?php echo getUserSpokenLanguages($user_id, false); ?></li>
                  <li><span>Written Language(s) :</span><?php echo getCimyOrUndefined('LANGUAGES_WRITTEN',$user_id); ?></li>
                  
                  <li class="icon military">
                    <a href="javascript:void(0);" class="checkfactual" data-target="#checkfactual" data-toggle="modal">&nbsp;</a>
                    <span>Military Service:</span><?php echo getCimyOrUndefined('US_ARMED_FORCES_OPTI',$user_id); ?>
                  </li>

                  <li class="icon law_enforcement">
                    <a href="javascript:void(0);" class="checkfactual" data-target="#checkfactual" data-toggle="modal">&nbsp;</a>
                    <span>Law Enforcement Service :</span> <?php echo getCimyOrUndefined('LOCAL_LAW_FORCE_YN',$user_id); ?>
                  </li> 
                  
                  <li class="icon federal">
                    <a href="javascript:void(0);" class="checkfactual" data-target="#checkfactual" data-toggle="modal">&nbsp;</a>
                    <span>Federal Agency Service :</span><?php echo getCimyOrUndefined('US_LAW_ENFORCE_STATU',$user_id); ?>
                  </li> 

                  <li><span>Highest Clearance Level :</span><?php echo getCimyOrUndefined('CLEARANCE_LEVEL',$user_id); ?></li>
                </ul>						
              </div>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/rightside_ad.jpg" class="img-responsive">
								<!-- <div class="light_box awarded_badges">
									<div class="sidebar_title">
										<h4>Awarded Badges</h4>
									</div>
									<div class="text-center">
										<?php echo get_er_badges($user_id); ?>
									</div>						
								</div> -->
              </div>
            </div>
            <div class="col-lg-2 col-md-6">
                            <!-- <div class="light_box recruiter_box welcome_box">
                                <p><a href="<?php //echo site_url().'/job-seekers/dashboard/'; ?>" class="btn btn-primary btn-lg">Go Back</a></p> 
                              </div> -->
                              <div class="sidebar right_sidebar">
                                <div class="light_box recruiter_box">
                                  <h3>Your Recruiter</h3>
                                  <div class="thumbnail"><img src="<?php echo site_url(); ?>/assets/uploads/2016/09/recruiter.jpg" class="img-responsive"></div>
                                  <p>I am here to facilitate discussions, open channels of communication, and assist you and your team in building the future.</p>
                                  <a href="javascript:void(0);" data-target="#sendamail" data-toggle="modal">Contact Now</a>
                                </div>
<!--                                 <a href="<?php //echo site_url();  ?>/job-seekers/dashboard/" class="btn btn-primary btn-block">Return to Dashboard</a>
-->
<div class="light_box quick_interaction">
  <div class="sidebar_title" id="quickCategory">
    <h4>Quick Interaction</h4>
  </div>
  <ul>
    <li><a href="javascript:void(0);">Ask this Candidate a Question</a></li>
    <li><a href="javascript:void(0);">Request a Meeting with this Candidate</a></li>
    <li><a href="javascript:void(0);">Favorite this Candidates Profile</a></li>
    <li><a href="javascript:void(0);">Follow this Candidates Career</a></li>
    <li><a href="javascript:void(0);">Print this Candidates Profile</a></li>
    <li><a href="javascript:void(0);">Set Yourself a Reminder Alert</a></li>
    <li><a href="javascript:void(0);">Block this Candidates Profile</a></li>
  </ul>
</div>
<a href="#" class="btn btn-primary btn-block">Report a Violation</a>
<a href="#" class="btn btn-primary btn-block">Suggest Improvement</a>
<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/leftside_ad.jpg" class="img-responsive">
<div class="light_box acti">
  <div class="sidebar_title">
    <h4>Activity Log</h4>
  </div>

  <?php 
  global $wpdb;
  $my_no_rows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id = '".$user_id."'"); 
  $count = count($my_no_rows);
  if($count>0){ ?>
  <?php 
  $myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id='".$user_id."' ORDER BY ID DESC LIMIT 5" );
  $current_time = current_time( 'timestamp' );
  echo "<ul>";
  foreach ($myrows as $key) { ?>
  <li>
    <?php echo $key->meta; ?>
    <?php echo date('\o\n m/d/Y \a\t g.iA', $key->datetime); ?>
  </li>
  <?php } ?>
</ul>
                                        <!-- <div class="text-center">
                                            <a href="<?php //echo site_url();  ?>/preferences/recent-activity/?recruitID=<?php //echo $user_id; ?>" class="btn btn-default">See Complete Activity
                                            </a>
                                          </div> -->
                                          <?php
                                        }else{
                                          echo "No results found";
                                        } 
                                        ?>
                                      </div>
                                      <a href="#" class="btn btn-primary btn-block">View Timeline Activity</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div><!-- #content -->

                          <?php do_action( 'jobify_loop_after' ); ?>
                        </div><!-- #primary -->

                      <?php endwhile; ?>


                      <?php get_footer('seekerdasboard'); ?>


                      <div class="modal fade sendamail" id="sendamail" tabindex="-1" role="dialog" aria-labelledby="sendamailLabel">
                        <?php echo recrutier_contact_now(); ?>
                      </div>

                      <div class="modal fade" id="checkfactual" tabindex="-1" role="dialog" aria-labelledby="checkfactualLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="modal-header">
                              <h4>Info Verification</h4>
                            </div>
                            <div class="modal-body">
                              <p>Information has not been confirmed or deemed accurate by EyeRecruit, Inc. to be factual.</p>
                            </div>
                          </div>
                        </div> 

<?php
/**
 * Template Name: Navigation Referrals page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>
<style>
.network_list article .article_content ul.network_list_info li{font-size: .9em; margin-bottom: .9em !important;}

.network_list article .article_content ul li span{display:block; font-weight: bold;}
</style>
<?php


/*  $array1 = array('a', 'b', 'c', 'd', 'e', 'f', 'g');
  $array2 = array('aa', 'ba', 'ca', 'da', 'ea', 'fa', 'ga');
  foreach ($array1 as $key => $value) {
    $arr[] = array($value => $array2[$key]);
  }

  $arr2['test'] = $arr; 

  print_r( json_encode($arr2));*/

  if ( !is_user_logged_in() ) {
    $url = site_url();
    echo wp_redirect($url);
  }


  $current_user_id = get_current_user_id();
  $current_user = wp_get_current_user();

  $view = '';
  if(isset($_REQUEST['recruitID'])){
    $verb = 'has';
  }else{
    $verb ='have';
  }
  if ( isset($_REQUEST['recruitID']) ) {
    $userID = $_REQUEST['recruitID'];
    $userdata = get_userdata($userID);
    $allowView = '';
    $breadText = '';
    $cand_name = $userdata->first_name.' '.$userdata->last_name;

    $accessEmp = get_cimyFieldValue($userID, 'PNA_REFERRALS');
    $accessRec = get_cimyFieldValue($userID, 'PNAR_REFERRALS');
    if ( in_array( 'candidate', $current_user->roles) ){
      if ( $accessEmp == 'Yes' ) {
        $view = 'allow';
      }
      $breadcrumbUrl = '/job-seekers/seeker-profile-view/';
      if($_SERVER['HTTP_REFERER'] == get_site_url().'/job-seekers/seeker-profile-view/'){

        $seekerPreviewAsEmployer = true;
        $view = 'allow';
      }
    }
    elseif ( in_array( 'administrator', $current_user->roles) ) {
      if ( $accessRec == 'Yes' ) {
        $view = 'allow';
      }
      $breadcrumbUrl = '/employers/redacted-recruiter-quick-view/?recruitID='.$userID;
    }
    elseif( in_array('employer', $current_user->roles) ){
      if ( $accessEmp == 'Yes' ) {
        $view = 'allow';
      }
      $breadcrumbUrl = '/employers/redacted-employer-quick-view/?recruitID='.$userID;
    }
    else{
      $breadcrumbUrl = '';
    }
  }
  elseif ( in_array( 'candidate', $current_user->roles) ){
    $userID  = get_current_user_id();
    $allowView = 'allow';
    $breadcrumbUrl = '/job-seekers/dashboard/';
    $breadText = 'Management';
    $cand_name = 'You';
    $view = 'allow';
  }
  else{
    $url = site_url();
    echo wp_redirect($url);
  }
  $datas = wp_get_current_user();
  $roless = $datas->roles;
  $roles1 = array_shift( $roless );
  ?>

  <link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

  <?php while ( have_posts() ) : the_post(); ?>

  <header class="page-header">
    <h1 class="page-title"><?php the_title(); ?></h1>
  </header>

  <div id="primary" class="content-area">
    <div id="content" class="container" role="main">

      <?php 
      
      if ($seekerPreviewAsEmployer == true){
        ?>
        <div class="alert-warning padded marginTop-2x"><strong>NOTE:</strong> You are viewing the employee preview as a seeker</div>
        <?php
      }?>

      <section class="navigations">
        <div class="section_title">
          <h3>Recommendation <?php echo $breadText; ?></h3>
          <span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
        </div>
        <?php
        global $wpdb;
        $tablename = $wpdb->prefix.'reach_out_and_ask_for_referral';
        $select = $wpdb->get_results("SELECT * FROM $tablename WHERE user_id = '".$userID."' AND user_message IS NOT NULL  ORDER BY id DESC ");
        $selectPending = $wpdb->get_results("SELECT * FROM $tablename WHERE user_id = '".$userID."' AND user_message IS NULL ORDER BY id DESC ");
        $countref = count($select); 
        ?>
        <ol class="breadcrumb paddedLR">
          <li><a href="<?php echo $breadcrumbUrl; ?>">Home</a></li>
          <li class="active">Recommendation <?php echo $breadText; ?></li>
        </ol>
        <div class="row indent">
          <div class="col-md-9">


            <?php
            if(count($selectPending) > 0 && $seekerPreviewAsEmployer != true ){
              ?>

              <?php if($view == 'allow'){ ?>
              <h3>Pending Recommendations</h3>
              <div class="search_bar">
                <p><?php echo $cand_name." ".$verb; ?> <span id="counttotalref" count="<?php echo $countref; ?>"><?php echo count($selectPending); ?></span> pending recommendation(s)</p>
              </div>
              <div id="pending" class="network_list row">
                <?php foreach ($selectPending as $value) {
                      # code...
                  ?>
                  <div class="col-md-6 pendingResult" id="refralno<?php echo $value->id; ?>">
                    <article>
                      <div class="article_content">
                        <?php
                        echo '<h4>'.ucfirst($value->first_name).' '.ucfirst($value->last_name).'</h4>';
                        echo $value->use_relationship;
                        ?>
                      </div>
                      <div class="article_footer">
                        <div class="checkbox">
                          <?php if ( in_array( 'candidate', $current_user->roles) && !isset($_REQUEST['recruitID']) ){ ?>
                          <label>
                            <input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $value->id; ?>" type="checkbox"> 
                            <span>Remove</span> 
                          </label>
                          <?php } ?>
                        </div>
                      </div>
                    </article>
                  </div>
                  <?php
                }
                ?>
              </div>
              <?php } ?>

              <?php
                }//end pending
                ?>

                <h3>Completed Recommendations</h3>

                <?php if($view == 'allow'){ ?>
                <div class="search_bar">
                  <p><?php echo $cand_name." ".$verb; ?> <span id="counttotalref" count="<?php echo $countref; ?>"><?php echo $countref; ?></span> completed recommendation(s)</p>
                </div>
                <?php } ?>
                <!-- completed recommendations -->
                <div id="final" class="network_list indent">
                  <div class="row">
                    <div class="col-md-12">

                      <?php if($view == 'allow'){ ?>
                      <div class="" id="inv_frn_n_coll">
                        <?php foreach ($select as $value) {
                          $name = ucfirst($value->first_name).' '.ucfirst($value->last_name);
                          $email = $value->rcvr_email2? $value->rcvr_email2  : $value->user_email;

                          ?>
                          <div id="refralno<?php echo $value->id; ?>">
                            <article>

                             <div class="article_content">

                              <div class="row">
                                <div class="col-md-4 text-center">
                                  <?php echo get_avatar($email); ?>
                                  <h4 style="text-align:center; padding:0; margin:0;"><?php echo $name; ?></h4>
                                  <small><?php echo $value->rcvr_curr_company;?><br>
                                    <?php echo $value->rcvr_curr_title;?>
                                  </small>
                                  <hr>
                                  <small>
                                    <span><strong>Affiliated through:</strong></span><br><?php echo $value->affiliation_loc;?><br>
                                    <?php echo $value->affiliation_year; ?>
                                  </small>

                                  <?php if($value->rcvr_contact_yn=='yes'){ ?>
                                  
                                  <hr>
                                  <div class="">
                                    <ul class="network_list_info">
                                      <!-- <li><span>Able to Contact:</span><?php echo $value->rcvr_contact_yn;?></li> -->

                                      <li><span>Best Contact Method:</span><?php echo $value->rcvr_pref_contact_method;?></li>

                                      <li><span>Best Time to Contact:</span><?php echo $value->rcvr_pref_contact_time;?></li>

                                      <li class="cu_wordwrap"><span>Email: </span><?php echo $email; ?></li>
                                      <li><span>Cell:</span><?php echo $value->rcvr_phone_cell;?></li>
                                      <li><span>Office:</span><?php echo $value->rcvr_phone_office;?></li>
                                      <li><span>Status:</span><?php echo (email_exists($email)? "Member" : "Not a Member"); ?></li>

                                    </ul>
                                  </div>
                                  <?php } ?>
                                </div>
                                
                                <div class="col-md-8 ">
                                  <span><strong>Recommendation Received:</strong></span><br><?php echo $value->user_message;?>
                                </div>

                              </div>
                              

                            </div>
                            <div class="clearfix"></div>
                            <div class="article_footer">
                              <div class="checkbox">
                                <?php if ( in_array( 'candidate', $current_user->roles) && !isset($_REQUEST['recruitID']) ){ ?>
                                <label>
                                  <input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $value->id; ?>" type="checkbox"> 
                                  <span>Remove</span> 
                                </label>
                                <?php } ?>
                              </div>
                            </div>
                          </article>
                        </div>
                        <?php } ?>
                      </div>
                      <?php } else{ ?>
                      <div class="no-jobs-found restrict_notice">
                        <h4 class="no_job_listings_found"><?php echo $cand_name; ?> has set the Security settings on this section of the profile to Restricted.</h4>
                        <div class="media">
                          <div class="media-left">
                            <img class="media-object" src="<?php echo get_stylesheet_directory_uri(); ?>/img/big_minus.jpg" alt="0">
                          </div>
                          <div class="media-body">
                            <p>What does that mean? To view this material, you will need to click the link below and a message will be sent notifying the candidate that you would like access to view this material. Once <?php echo $cand_name; ?> approves the material to be viewed, you will recieve a message via mail and within your profile that your access has been granted.</p>
                          </div>
                        </div>
                        <div class="text-center">
                          <a href="mailto:<?php echo $userdata->user_email; ?>" class="btn btn-sm btn-success">Notify</a>
                        </div>
                      </div><!-- no-jobs-found -->
                      <?php } ?>
                    </div>  


                  </div>
                </div>
              </div>
              <div id="refSidebar" class="col-md-3">
                <?php 
                $pageID = get_the_ID(); 
                $roafar = get_post_meta($pageID, 'wpcf-referral-now-content', true); 
                $hiw = get_post_meta($pageID, 'wpcf-how-it-works', true); 
                $mt = get_post_meta($pageID, 'member_tip', true); 
                ?>
                <?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>
                <div class="special_box special_logo navi_thumbnail">
                  <div class="thumbnail">
                    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
                  </div>
                  <h5> HERE IS THE PROCESS</h5>
                  <p>The recommendation process has been simplified for the Candidate, so they are able to provide you with a simple and effective way to review some of the things people who know them have taken the time to provide in writing. The Seeker sends an automated e-mail asking for open ended feedback and the response is posted within the Job Seekers profile so it can be provide here for your review. </p>
                </div>
                <div class="special_box special_logo navi_thumbnail">
                  <div class="thumbnail">
                    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
                  </div>
                  <h5>ITS A STARTING POINT</h5>
                  <p>While there is no way for EyeRecruit, Inc. to validate accuracy of the information, we offer this section to Hiring Managers, HR personnel and Recruiters to initiate open lines of communication, get to know the candidate better, to begin to cross reference the bigger picture and to assist in the verification, background and pre-hiring process for a potential employee / team member you might be interested in considering.</p>
                </div>


                <?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>

                <?php   if ( isset($_REQUEST['recruitID']) ) { ?>

                <div class="special_box special_logo navi_thumbnail">
                  <div class="thumbnail">
                    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
                  </div>
                  <h5> HERE IS THE PROCESS</h5>
                  <p>The recommendation process has been simplified for the Candidate, so they are able to provide you with a simple and effective way to review some of the things people who know them have taken the time to provide in writing. The Seeker sends an automated e-mail asking for open ended feedback and the response is posted within the Job Seekers profile so it can be provide here for your review. </p>
                </div>
                <div class="special_box special_logo navi_thumbnail">
                  <div class="thumbnail">
                    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
                  </div>
                  <h5>ITS A STARTING POINT</h5>
                  <p>While there is no way for EyeRecruit, Inc. to validate accuracy of the information, we offer this section to Hiring Managers, HR personnel and Recruiters to initiate open lines of communication, get to know the candidate better, to begin to cross reference the bigger picture and to assist in the verification, background and pre-hiring process for a potential employee / team member you might be interested in considering.</p>
                </div>
                <?php  }else{  ?>

                <div class="special_box navi_thumbnail">
                  <h5>Reach out & ask for a Recommendation Now</h5>
                  <p><?php echo (($roafar))? $roafar : 'Data not found'; ?></p>
                  <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reach_out_n_ask_fr_Referral">Ask Now</a>
                </div>
                <div class="special_box navi_thumbnail">
                  <h5>How it Works</h5>
                  <p><?php echo (($hiw))? $hiw : 'Data not found'; ?></p>
                </div>

                <?php member_navigation_sidebar_tips_function('seeker_referrals'); ?>

                <?php } ?>


                <?php  }else { ?>
                <div class="special_box navi_thumbnail">
                  <h5>Reach out & ask for a Recommendation Now</h5>
                  <p><?php echo (($roafar))? $roafar : 'Data not found'; ?></p>
                </div>
                <div class="special_box navi_thumbnail">
                  <h5>How it Works</h5>
                  <p><?php echo (($hiw))? $hiw : 'Data not found'; ?></p>
                </div>

                <?php member_navigation_sidebar_tips_function('seeker_referrals'); ?>

                <?php } ?>

              </div>
            </div>

          </section>  
        </div><!-- #content -->

        <?//php do_action( 'jobify_loop_after' ); ?>
      </div><!-- #primary -->

    <?php endwhile; ?>
    <?php get_footer('preferences'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery("#inv_frn_n_coll, .pendingResult").on('click', '.delete_anchor', function(){
        var _this = jQuery(this);
        var reflid = jQuery(this).attr('buttonid');
        var counttotalref = jQuery('#counttotalref').attr('count');
        var img = '<?php echo get_stylesheet_directory_uri()."/images/danger_icon.jpg"; ?>';
        swal({
          imageUrl: img,
          title: "warning",
          text: "You are about to permanently DELETE this reference. Once you select continue, this can not be undone.",
          showCancelButton: true,
          confirmButtonClass: "btn-default btn-sm changetext",
          confirmButtonText: "Continue Delete",
          cancelButtonText: "Cancel",
          cancelButtonClass: "btn-primary btn-sm cancelbutton",
          closeOnConfirm: false,
          closeOnCancel: false,
          customClass: 'daner_sweet'
        },
        function(isConfirm){
          if (isConfirm) {
            jQuery('.changetext').html('Please Wait...');
            jQuery.ajax({
              type : 'POST',
              url : '<?php echo admin_url("admin-ajax.php"); ?>',
              dataType: 'json',
              data : {
                action : 'delete_reach_referral',
                reflid : reflid
              },
              success : function(r) {
                if ( r.msg == 'success' ) {
                  jQuery('.changetext').html('Continue Delete');
                  jQuery('#refralno'+reflid).remove();
                  swal({
                    title: "Deleted!", 
                    type: "success",
                    confirmButtonClass: "btn-primary btn-sm",
                  });
                  jQuery('#counttotalref').attr('count', parseInt(counttotalref)-1 );
                  jQuery('#counttotalref').text( parseInt(counttotalref)-1 );
                }
                else{
                  jQuery('.changetext').html('Continue Delete');
                  swal({
                    title: "Error!", 
                    type: "error",
                    confirmButtonClass: "btn-primary btn-sm",
                  });
                  _this.prop('checked',false);
                }
              }
            });
} else {
  swal({
    title:  "Cancelled",
    type: "error",
    confirmButtonClass: "btn-primary btn-sm",
  });
  _this.prop('checked',false);
}
});
});
});
</script>

<script type="text/javascript">

jQuery(document).ready(function(){
    //for email validation
    function validEmail(v) {
      var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
      return (v.match(r) == null) ? false : true;
    }


    jQuery('.userdetail_add_more').live('click', function(){

      var ln_no = jQuery(this).attr('count');

      var count = parseInt(ln_no)+1;

      jQuery("#userdetail_all_fields").append('<div id="userdetail_pr_'+count+'" class="edit-main-dv form-group row"><div class="col-sm-4"><label class="control-label" for="fname">First Name:</label><br /><input id="fname_'+count+'" class="regular-text code form-control" name="fname[]" type="text" /></div><div class="col-sm-4"> <label class="control-label" for="lname">Last Name:</label><br /><input id="lname_'+count+'" class="regular-text code form-control" name="lname[]" type="text" /></div><div class="col-sm-4"><label class="control-label" for="user_email">Email Address:</label><br /><input id="user_email_'+count+'" class="regular-text code form-control" name="user_email[]" type="text" /></div><div class="col-sm-6"><label class="control-label" for="Relationship">Relationship: *</label><br /><select id="Relationship" name="Relationship[]"><option value="">---Selection---</option><option value="Colleague">Colleague</option><option value="Direct Supervisor">Direct Supervisor</option><option value="Direct Manager">Direct Manager</option><option value="Business Partner">Business Partner</option><option value="Mentor/Mastermind">Mentor/Mastermind</option><option value="Friend/Relative">Friend/Relative</option></select></div><div class="col-sm-6"><label class="control-label" for="Years">What year did you meet each other?</label><br /><input id="Years_'+count+'" class="regular-text code form-control" name="Years[]" type="text" maxlength="4" /></div></div><span class="remove_edu btn btn-default btn-sm pull-right" id="remove_edu_'+count+'" rel="'+count+'">remove</span><div class="clearfix"></div></div>');

      jQuery(this).attr('count', count);
    });


jQuery('.remove_edu').live('click', function(){
  var rel = jQuery(this).attr('rel');
  jQuery('#userdetail_pr_'+rel).remove();
  jQuery('#remove_edu_'+rel).remove();
});

        //for first name validation
        jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="fname[]"]', function() {
          var name_val = jQuery(this).val();
          var name_id = jQuery(this).attr('id');
          jQuery('#'+name_id+'-error').remove();

          if ( name_val == '' ) {
            jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">First Name is required.</label>').insertAfter(this);
          }
          else{
            jQuery('#'+name_id+'-error').remove();
          }

        });

    //for last name validation
    jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="lname[]"]', function() {
      var name_val = jQuery(this).val();
      var name_id = jQuery(this).attr('id');
      jQuery('#'+name_id+'-error').remove();

      if ( name_val == '' ) {
        jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Last Name is required.</label>').insertAfter(this);
      }
      else{
        jQuery('#'+name_id+'-error').remove();
      }

    });

    //for email validation
    jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="user_email[]"]', function() {
      var email_val = jQuery(this).val();
      var email_id = jQuery(this).attr('id');
      jQuery('#'+email_id+'-error').remove();

      if ( email_val == '' ) {
        jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Email is required.</label>').insertAfter(this);
      }
      else if ( !validEmail(email_val) ) {
        jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter a valid email.</label>').insertAfter(this);
      } 
      else{
        jQuery('#'+email_id+'-error').remove();
      }
    });

    jQuery( "#userdetail_all_fields" ).on('keyup', 'select[name="Relationship[]"]', function() {
      var Relationship_val = jQuery(this).val();
      var Relationship_id = jQuery(this).attr('id');
      jQuery('#'+Relationship_id+'-error').remove();

      if ( Relationship_val == '' ) {
        jQuery('<label id="'+Relationship_id+'-error" class="error send_mail_error" for="'+Relationship_id+'">Relationship is required.</label>').insertAfter(this);
      }
      else{
        jQuery('#'+Relationship_id+'-error').remove();
      }

    }); 
    //save and close button functionality
    jQuery('#reach_out_n_ask').on('click', function(){

      jQuery('.error').remove();

      jQuery('input[name="fname[]"]').each( function() {

        var name_val = jQuery(this).val();
        var name_id = jQuery(this).attr('id');

        if ( name_val == '' ) {
          jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">First Name is required.</label>').insertAfter(this);
        }
      });
      jQuery('input[name="lname[]"]').each( function() {

        var name_val = jQuery(this).val();
        var name_id = jQuery(this).attr('id');

        if ( name_val == '' ) {
          jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Last Name is required.</label>').insertAfter(this);
        }
      });

      jQuery('input[name="user_email[]"]').each( function() {

        var email_val = jQuery(this).val();
        var email_id = jQuery(this).attr('id');

        if ( email_val == '' ) {
          jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Email is required.</label>').insertAfter(this);
        }
        else if ( !validEmail(email_val) ) {
          jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter a valid email address.</label>').insertAfter(this);
        }  
      });
      jQuery('select[name="Relationship[]"]').each( function() {

        var Relationship_val = jQuery(this).val();
        var Relationship_id = jQuery(this).attr('id');
        
        if ( Relationship_val == '' ) {
          jQuery('<label id="'+Relationship_id+'-error" class="error send_mail_error" for="'+Relationship_id+'">Relationship is required.</label>').insertAfter(this);
        }
      });

      if(!jQuery('.error').hasClass('send_mail_error')){

        var fname = new Array();
        jQuery('input[name="fname[]"]').each( function() {
          fname.push( jQuery(this).val() );
        });

        var lname = new Array();
        jQuery('input[name="lname[]"]').each( function() {
          lname.push( jQuery(this).val() );
        });

        var user_email = new Array();
        jQuery('input[name="user_email[]"]').each( function() {
          user_email.push( jQuery(this).val() );
        });
        var Relationship = [];

        jQuery('select[name="Relationship[]"]').each( function() {
          Relationship.push( jQuery(this).val() );
        });
        var Years = [];

        jQuery('input[name="Years[]"]').each( function() {
          Years.push( jQuery(this).val() );
        });
        var user_msg = jQuery('textarea[name="user_msg"]').val();
        var sender_name = jQuery('input[name="sender_name"]').val();

        jQuery('#reach_out_n_ask').text('Sending...').attr('disabled', 'disabled');

        jQuery.ajax({
          type:"POST",
          url: "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>", 
          data: {
            action: 'reach_out_and_ask_for_referral',
            fname: fname,
            lname: lname,
            user_email: user_email,
            user_msg: user_msg,
            sender_name: sender_name,
            Relationship:Relationship,
            Years: Years,
          },
          success:function(r){
            //jQuery('.wpcf7-form').append('<p class="remove_btn text-center" id="rfsuccess"> Successfully send.</p>');
            var id = '<?php echo get_the_ID(); ?>';
            window.location = '<?php echo get_the_permalink( "'+id+'" ); ?>';
            jQuery('#reach_out_n_ask').text('Send').removeAttr('disabled');
          }
        });
      }
    });

    //for invite a collegue popup close
    jQuery('#rfclosepopup').on('click', function(){
      jQuery('.error').remove();
      for (var k=2; k<=jQuery('#userdetail_add_more').attr('count'); k++) {
        jQuery('#userdetail_pr_'+k).remove();
      };
    });
  });


</script>


<div class="modal fade" id="reach_out_n_ask_fr_Referral" tabindex="-1" role="dialog" aria-labelledby="reach_out_n_ask_fr_ReferralLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content recommendation_popup">
      <!-- <div class="modal-header">
    </div> -->
    <div class="modal-body">
      <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
      <h3>Reach Out & Ask for a Recommendation</h3>
      <div class="clearfix"></div>
      <form class="wpcf7-form">
        <div id="userdetail_all_fields">
          <div id="userdetail_pr" class="edit-main-dv form-group row">
            <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <label class="control-label" for="fname">First Name:</label><br />
                <input id="fname" class="regular-text code form-control" name="fname[]" type="text" />
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <label class="control-label" for="lname">Last Name:</label><br />
                <input id="lname" class="regular-text code form-control" name="lname[]" type="text" />
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <label class="control-label" for="user_email">Email Address:</label><br />
                <input id="user_email" class="regular-text code form-control" name="user_email[]" type="text" />
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label class="control-label" for="Relationship">Relationship: *</label><br />
                <select id="Relationship" name="Relationship[]">
                  <option value="">---Selection---</option>
                  <option value="Colleague">Colleague</option>
                  <option value="Direct Supervisor">Direct Supervisor</option>
                  <option value="Direct Manager">Direct Manager</option>
                  <option value="Business Partner">Business Partner</option>
                  <option value="Mentor/Mastermind">Mentor/Mastermind</option>
                  <option value="Friend/Relative">Friend/Relative</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label class="control-label" for="Years">What year did you meet each other?</label><br />
                <input id="Years" class="regular-text code form-control" name="Years[]" type="text" maxlength="4" />
              </div>
            </div>
          </div>
        </div>
        <p class="remove_btn">
          <a id="userdetail_add_more" count="1" class="userdetail_add_more">+ Add More Recipients</a>
        </p>
        <div class="form-group">
          <label class="control-label" for="user_msg">Your Message</label><br />
          <textarea id="user_msg" class="regular-text code form-control" name="user_msg" readonly>Hello {First Name},

            I recently became a member of an interesting service that is allowing me to manage my own career within the industry I am passionate about.  Besides allowing me to store and forward all of my career documents digitally, it also allows me to better present myself and my accomplishments to potential Employers that I am interested in and that are interested in me.

            I am just starting to gather letters of recommendation to assist my future career aspirations and I immediately thought of you. Would you be able to write a strong letter of recommendation on my behalf? As someone who knows me, is familiar with my work and achievements from a portion of my life, I would greatly appreciate your help. Don’t feel that you are under pressure.  There is no deadline.  

            It means a lot to me that you would take time to read and consider my request.

            {recommendation_link} 

            Sincerely,
            <?php 
            $current_user_id = get_current_user_id();
            $userdata = get_userdata($current_user_id);
            $user_fname = $userdata->first_name;
            $user_lname = $userdata->last_name;
            echo $user_fname.' '.$user_lname;
            ?>
          </textarea>
        </div>
        <input type="hidden" name="sender_name" value="<?php echo $user_fname.' '.$user_lname; ?>">
        <div class="text-center">
          <button id="reach_out_n_ask" type="button" class="btn btn-success btn-sm">Send</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
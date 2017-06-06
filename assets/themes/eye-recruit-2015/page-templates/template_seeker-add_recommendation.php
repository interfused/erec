<?php
/**
 * Template Name: Seeker - Add Recommendation
 *
 * 
 *
 * @package Jobify
 * @since Jobify 1.5
 */

//handle form posts

$postSuccess=false;
global $wpdb;
$tableName = $wpdb->prefix.'reach_out_and_ask_for_referral';

if($_POST['user_message'] && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' )){

  $user_message = stripslashes_deep($_POST['user_message']);
  $sql = 'SELECT * FROM '.$tableName.' WHERE id = "'.$_POST['id'].'"';
  $wpdb->get_row($sql);

  $wpdb->update(
    $tableName,
    array('response_time' => $_POST['time'],
      'user_message' => $user_message,
      'affiliation_loc' => $_POST['user_aff'],
      'affiliation_year' => $_POST['user_aff_year'],
      'rcvr_curr_company' => $_POST['current_company'],
      'rcvr_curr_title' => $_POST['current_position'],
      'rcvr_contact_yn' => $_POST['contactYN'],
      'rcvr_phone_office' => $_POST['phone_office'],
      'rcvr_phone_cell' => $_POST['phone_cell'],
      'rcvr_email2' => $_POST['email2'],
      'rcvr_pref_contact_method' => $_POST['contact_preference'],
      'rcvr_pref_contact_time' => $_POST['contact_preference_time']
      ),
    array('id' => $_POST['id']),
    array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'),
    array('%d')
    );
  $postSuccess = true;
}

get_header(); ?>

<style>
textarea#user_message{height:10em;}
#formContainer{background-color:#fefefe;}
form{ padding: 2em;}
form fieldset{border:1px solid #ccc; padding: 2em;  }
form fieldset legend{border:none; width: initial; padding-left: .5em; padding-right: .5em;}
#phoneWrapper, #emailWrapper, #contactPreferencesWrapper{display: none;}
</style>
<?php
///two ids.  userID vs refererID
$recommendationID = $_REQUEST['rID'] ? $_REQUEST['rID'] : 0;
if($recommendationID == 0){
  //get requested user id which should be passed by urlParam
  //redirect if no userID exists
}else{


  //$sql = 'SELECT * FROM '.$tableName.' WHERE id = "'.$recommendationID.'"';
  $sql = 'SELECT * FROM '.$tableName.' WHERE id = "'.$recommendationID.'" AND user_message IS NULL';

  $resultrow = $wpdb->get_row($sql);
  //pull seeker's id from rec
}

?>

<header class="page-header">
  <h1 class="page-title"><?php the_title(); ?></h1>
</header>

<div id="primary" class="content-area">
  <div id="content" class="container" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry-content<?php echo has_shortcode( $post->post_content, 'jobs' ) ? ' has-jobs' : null; ?>">
        <?php // the_content(); ?>

        
        <?php
        if(!$resultrow && $_REQUEST['rID'] && !$postSuccess){
            //no results exist
          ?>
          <div class="paddedTopBottom-2x text-center">This recommendation does not exist</div>
          <?php } ?>

          <?php
          if($postSuccess == true){
            ?>
            <div id="thanksMsg" class="container paddedTop">
              <div class="row">
                <div class="col-md-3 text-center">
                  <?php er_asset_icon('personal-recommendations.png');?>
                </div>
                <div class="col-md-9">
                
              <h3>Thanks <?php echo ucfirst($_POST['ref_fname']);?>,</h3>

              <p>Being selected from a distinguished short list to speak candidly and attest to someone’s experience, work ethic and credentials is an honor.  What a potential Employer can gauge from a quality written Recommendation is substantial and it may be the deciding factor in an applicant advancing to the next stage. </p>

              <p>It is significant to receive praise and written endorsements from ones former Supervisors, Managers & Colleagues. This is why EyeRecruit believes in providing an open, transparent and cooperative way to seek and display Recommendations. </p>

              <p>We believe that the process we provide for Job Seekers will assist them in managing their own career.  It displays trust and demonstrates positive and high ethical standards - all of which are very appealing qualities in the eyes of employers, especially high caliber employers. </p>

              <p>If you wish to provide a more formalized Letter of Recommendation, perhaps on your organizations stationary, please contact the party directly who requested the Recommendation. If you attach a PDF via email, that document can be added to their professional profile as well.  

              </p>
              </div>
              </div>
            </div>
          <?php } ?>

            <?php
            if(count($resultrow) >= 1){
          //show details of recommendation data
          //seeker's info / seeker card
              $user_info = get_userdata($resultrow->user_id);
              $user_fullname = $user_info->first_name .' '.$user_info->last_name;
              ?>

              <div id="" class="paddedTop-2x">

                <div class="text-center paddedTopBottom">
                  <?php echo get_wp_user_avatar($user_info->id);?>
                  <h3><?php echo ($user_fullname ); ?></h3>
                  <p>recruitID: <?php echo $user_info->id ?></p>
                </div>

                <div class="row">

                  <?php if($postSuccess==false) {
                    ?>

                    <div id="formContainer" class="clearfix">
                      <form id="addSeekerRecommendation" name="id="addSeekerRecommendation"" method="POST">
                        <input type="hidden" name="ref_fname" id="ref_fname" value="<?php echo $resultrow->first_name;?>" />
                        <input type="hidden" name="time" value="<?php echo time();?>">
                        <input type="hidden" name="id" id="id" value="<?php echo $resultrow->id;?>" />

                        <div id="seekerInfo" class="col-md-6">



                          <fieldset>
                            <legend>Tell Us About <?php echo $user_info->first_name;?> </legend>

                            <div class="form-group">
                              <label for="user_message">
                                Thank you for responding to my request for a letter of recommendation. If you could, please describe below.
                              </label>
                              <textarea id="user_message" name="user_message" required></textarea>
                            </div>

                            <div class="form-group">
                              <label for="user_aff">How are/were you affiliated with <?php echo $user_info->first_name;?>? *  </label>
                              <input type="text" id="user_aff" name="user_aff" required placeholder="Company/club/group/etc.">
                            </div>

                            <div class="form-group">
                              <label for="user_aff_year">What year?</label>
                              <input type="text" id="user_aff_year" name="user_aff_year" required maxlength="4" >
                            </div>

                          </fieldset>
                        </div>

                        <div class="col-md-6">
                          <fieldset>
                            <legend>Tell Us About Yourself</legend>
                            <p>Hello <?php echo ucfirst($resultrow->first_name ); ?>,</p>
                            <p class="paddedBottom"><?php echo $user_fullname;?> has requested your recommendation.  If would, please let us know a little bit more about you.</p>
                            <div class="form-group">
                              <label for="current_company">Your Current Employer?</label>
                              <input type="text" id="current_company" name="current_company" >
                            </div>

                            <div class="form-group">
                              <label for="current_position">Current Position</label>
                              <input type="text" id="current_position" name="current_position" >
                            </div>

                            <div class="form-group">
                              <p>Would you be willing to speak further about <?php echo $user_fullname; ?> if someone needed further information?</p>
                              <label ><input type="radio" id="current_position" name="contactYN" value="yes" > Yes </label>
                              <label ><input type="radio" id="current_position" name="contactYN" value="no" > No </label>
                            </div>

                            <div id="phoneWrapper" class="row">
                              <div class="col-md-6 form-group">
                                <label for="phone_office" >Office Phone</label>
                                <input type="tel" id="phone_office" name="phone_office"  >                      
                              </div>

                              <div class="col-md-6 form-group">
                                <label for="phone_cell" >Cell Phone</label>
                                <input type="tel" id="phone_cell" name="phone_cell"  > 
                              </div>
                            </div>



                            <div id="emailWrapper" class="form-group">
                              <label for="email2" >Email</label>
                              <input type="email" id="email2" name="email2"  >                       
                            </div>

                            <div id="contactPreferencesWrapper" class="row">
                              <div class="col-md-6 form-group">
                                <label for="contact_preference" >Preferred Method of Contact</label>
                                <select name="contact_preference" id="contact_preference">
                                  <option value="">Select</option>
                                  <option value="Office Phone">Office Phone</option>
                                  <option value="Cell Phone">Cell Phone</option>
                                  <option value="Email">Email</option>
                                </select> 
                              </div>

                              <div class="col-md-6 form-group">
                                <label for="contact_preference_time" >Best time to contact</label>
                                <select name="contact_preference_time" id="contact_preference_time">
                                  <option value="">Select</option>
                                  <option value="Early Morning">Early Morning</option>
                                  <option value="Mid Morning">Mid Morning</option>
                                  <option value="Lunch time">Lunch time</option>
                                  <option value="Early Afternoon">Early Afternoon</option>
                                  <option value="Late Afternoon">Late Afternoon</option>
                                  <option value="Evenings/Weekends">Evenings/Weekends</option>
                                </select>  
                              </div>
                            </div>


                          </fieldset>
                        </div>
                        <div class="col-sm-12 form-group text-center paddedTopBottom-2x">
                          <?php  wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
                          <button type="submit" class="btn btn-primary">Submit Recommendation</button>
                        </div>
                      </form>
                    </div>

                    <?php
                  }?>

                </div>
              </div>
              <?php
            }
            ?>
          </div>
        </article><!-- #post -->

        <?php // comments_template(); ?>
      </div><!-- #content -->

      <?php do_action( 'jobify_loop_after' ); ?>
    </div><!-- #primary -->

    <script>
    jQuery(document).ready(function(){
      jQuery("input[type=radio][name=contactYN]").change(function(event) {
        /* Act on the event */
        var additionalRefFields = jQuery("#phoneWrapper, #emailWrapper, #contactPreferencesWrapper");
        if(this.value=='yes'){
          additionalRefFields.show();
        }else{
          additionalRefFields.hide();
        }

      });

    });

    </script>
    <?php get_footer(); ?>
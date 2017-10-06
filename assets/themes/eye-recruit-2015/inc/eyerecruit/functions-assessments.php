<?php
/* ASSESSMENTS ARE ON A SCALE OF 0-5 WITH 0 BEING NO EXPERIENCE AND 5 BEING MASTER */
function get_assessment_questions_count($terms_id){
  //if id is numeric we assume actual id otherwise we pull by slug
  if(is_numeric($terms_id)){
    $field_type = 'id';
  }else{
    $field_type = 'slug';
  }

  $the_query = new WP_Query( array(
    'post_type' => 'assessment-question',
    'post_status' => 'publish',
    'tax_query' => array(
      array(
        'taxonomy' => 'assessment-category',
        'field' => $field_type,
        'terms' => $terms_id
        )
      )
    ) );
  $count = $the_query->found_posts;
  return $count;
}


/* ASSESSMENT RELATED FUNCTIONS */
/* below function is outdated and requires cimy */
function get_star_assessment($user_id,$field_name){
  $star   = get_cimyFieldValue($user_id,$field_name);
  $value  = '';
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
/* UPDATED: Works off of updated  
  Shows visual based off of numeric value
*/
  function get_star_assessment_from_numeric($user_id,$field_name){
  // $star needs to be calculated.  we are temporarily setting 3 for testing purposes
    $star = 3;
    $maxStars = 5;
    $value = '';
    $star_yes = '<i class="fa fa-star">';
    $star_no = '<i class="fa fa-star-o">';
    
    if($star == 0){
      for ($i=1;$i<=$maxStars;$i++){
        $value .= $star_no;
      }
      return $value;
    }

    for($i=1;$i<=$maxStars;$i++){
      if($i <= $star ){
        $value .= $star_yes;
      }else{
        $value .= $star_no;
      }

    }
    return $value;
  }

function getAssessmentOptionSelectedAttribute($a,$b){
  if($a == $b){
    return 'selected';
  }else{
    return '';
  }
}
/* 
SHOW UPDATED ASSESSMENTS ACCORDING TO CUSTOM POST TYPE AND NOT CIMY.
New user meta will be in the format
assessment-{taxonomy term slug}-{post id}
EX: assessment-abilities-9999
We will display the text however from the pulled custom taxonomy content
*/
/* need to group by taxonomy */

add_action( 'show_user_profile', 'extra_user_assessment_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_assessment_profile_fields' );

function extra_user_assessment_profile_fields( $user ) { ?>
<hr>
<div class="er-admin-tabbed-wrapper admin-tabbed-assessments">
  <h3><?php _e("UPDATED Assessment profile information", "blank"); ?></h3>
  <?php
    //get assessment-category taxonomy
  $terms = get_terms( array(
    'taxonomy' => 'assessment-category',
    'hide_empty' => false,
    ));
  //print_r($terms); 
    //
  echo '<ul class="er_admin_tabs">';

  for($i=0;$i<count($terms);$i++){
    echo '<li>';
    echo '<a href="javascript:void(0);" data-term-target="term_id_'.$terms[$i]->term_id.'" >'. $terms[$i]->name .'</a>';
    echo '</li>';
  }
  echo '</ul>';

  foreach ($terms as $assessment_term) {
    echo '<div id="term_id_'.$assessment_term->term_taxonomy_id.'" class="er_admin_tabbed_content">';
    echo '<h4>'.$assessment_term->name .' content</h4>';

    $args=array(
      'post_type'           => 'assessment-question',
      'post_status'         => array( 'publish'),
      'order'               => 'ASC',
      'tax_query' => array(
        array( 
          'taxonomy' => 'assessment-category',
          'field' => 'id',
          'terms' => $assessment_term->term_taxonomy_id
          )
        ),
      'posts_per_page' => -1
      );

      $questions = new WP_Query($args);
      while ( $questions->have_posts() ) {
        $questions->the_post();
        $postMeta=get_post_meta(get_the_ID() );
        //title
        //echo 'uID: '.$user->ID;
        echo '<div class="question_container">';
        $editLink = '/wp-admin/post.php?post='.get_the_ID().'&action=edit';
        $userAssessmentMetaKey = 'assessment-'. $assessment_term->slug .'-'.get_the_ID();
        $userAssessmentMetaKeyValue = get_user_meta($user->ID,$userAssessmentMetaKey,true);
        //we default to no experience
        if(!$userAssessmentMetaKeyValue){
          $userAssessmentMetaKeyValue = 0;
        }
        
        //echo get_the_title();
        //echo get_the_content();
        
        //print_r($postMeta);
        //long question meta
        echo '<p>'.$postMeta['wpcf-job-seeker-assessment-question'][0].'</p>';
        //short desc meta
        //echo $postMeta['wpcf-job-seeker-q-short-desc'][0];
        //echo '<br>slug is. '.$userAssessmentMetaKey;

        //user entry
        ?>
        <div class="admin_assessment_star_rating">
       <!-- <input type="number" name="<?php echo $userAssessmentMetaKey;?>" id="<?php echo $userAssessmentMetaKey;?>" value="<?php echo $userAssessmentMetaKeyValue; ?>" class="star-numeric-input" min=0 max=5 /> -->
         <select name="<?php echo $userAssessmentMetaKey;?>" id="<?php echo $userAssessmentMetaKey;?>">
          <option value="0" <?php echo getAssessmentOptionSelectedAttribute($userAssessmentMetaKeyValue,0);?> >None</option>
          <option value="1" <?php echo getAssessmentOptionSelectedAttribute($userAssessmentMetaKeyValue,1);?> >Basic</option>
          <option value="2" <?php echo getAssessmentOptionSelectedAttribute($userAssessmentMetaKeyValue,2);?> >Average</option>
          <option value="3" <?php echo getAssessmentOptionSelectedAttribute($userAssessmentMetaKeyValue,3);?> >Good</option>
          <option value="4" <?php echo getAssessmentOptionSelectedAttribute($userAssessmentMetaKeyValue,4);?> >Excellent</option>
          <option value="5" <?php echo getAssessmentOptionSelectedAttribute($userAssessmentMetaKeyValue,5);?> >Master</option>
        </select> 
        </div>
        <?php
        
        echo '<br><a href="'.$editLink.'">Edit question text</a>';
        echo '</div>';
      }
      $html .= '<div>';
      wp_reset_postdata();

    echo '</div>';
  }
  ?>
    <!--
    <table class="form-table">
    <tr>
        <th><label for="address"><?php _e("Address"); ?></label></th>
        <td>
            <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your address."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="city"><?php _e("City"); ?></label></th>
        <td>
            <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your city."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
        <td>
            <input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your postal code."); ?></span>
        </td>
    </tr>
    </table>
  -->
</div>
<hr>
<?php }

add_action( 'personal_options_update', 'save_extra_user_assessment_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_assessment_profile_fields' );

function save_extra_user_assessment_profile_fields( $user_id ) {
  if ( !current_user_can( 'edit_user', $user_id ) ) { 
    return false; 
  }
  $terms = get_terms( array(
    'taxonomy' => 'assessment-category',
    'hide_empty' => false,
  ));

  foreach ($terms as $assessment_term) {
    $args=array(
      'post_type'           => 'assessment-question',
      'post_status'         => array( 'publish'),
      'tax_query' => array(
        array( 
          'taxonomy' => 'assessment-category',
          'field' => 'id',
          'terms' => $assessment_term->term_taxonomy_id
          )
        ),
      'posts_per_page' => -1
      );

    $questions = new WP_Query($args);
      while ( $questions->have_posts() ) {
        $questions->the_post();
        $userAssessmentMetaKey = 'assessment-'. $assessment_term->slug .'-'.get_the_ID();
        update_user_meta( $user_id, $userAssessmentMetaKey, $_POST["$userAssessmentMetaKey"] );
      }    
  }
  wp_reset_postdata();

}

/* UPDATED GET QUESTION */
function getQuestions($tag_id){
    
    $current_user = wp_get_current_user();
    if(isset($_REQUEST['recruitID'])){
      $user_id = $_REQUEST['recruitID'];
      $startext = "STAR BELOW TO INDICATE EXPERIENCE/SKILL LEVEL";
      $radiodis = "disabled";
      $notallow = 'notallow';
      $allowrating = "style='display:none;'";
      $showrating = "";
      $removeallow = "removeallow";
      $removeshow = "";
    }
    elseif ( in_array( 'candidate', $current_user->roles) ){
      $user_id  = get_current_user_id();
      // $startext = "Select A STAR BELOW TO INDICATE YOUR EXPERIENCE/SKILL LEVEL";
      $startext = "Select a star rating to indicate your current experience / skill level.";
      $radiodis = "";
      $notallow = '';
      $allowrating = "";
      $showrating = "style='display:none;'";
      $removeshow = "removeshow";
      $removeallow = "";
    }

    switch ($tag_id) {
      case 483:
      $selfAssPagename = 'Tasks';
      break;

      case 484:
      $selfAssPagename = 'Tech Trends';
      break;

      case 486:
      $selfAssPagename = 'Kwonledge';
      break;

      case 487:
      $selfAssPagename = 'Skills';
      break;

      case 485:
      $selfAssPagename = 'Abilities';
      break;

      case 488:
      $selfAssPagename = 'Work';
      break;
    }

    $qCnt = get_assessment_questions_count($tag_id);

    $post_ids = get_cpt_taxonomy_post_ids('assessment-question','assessment-category',$tag_id);
    
    $j = 0;
  $step = 2;
  $noOfP = 5;
  $pagi = ceil( $qCnt / $noOfP );
  echo '<div class="basic_info_steps basic_info_step_1">';
  for($i=1;$i<= $qCnt;$i++){

    if( ($j != 0 ) && ($j % $noOfP == 0 ) ) {
      echo '</div><div class="basic_info_steps basic_info_step_'.$step.'" style="display:none;">';
      $step++;
    }
    //updated
    $questionPostID = $post_ids[$i-1];
   
   $my_posts = get_post($questionPostID);
   //print_r($my_posts);
   if( $my_posts ) :
      //$starvalue = array('1'=>'basic','2'=>'average','3'=>'good','4'=>'excellent','5'=>'master');
      $the_slug = $my_posts->post_name;
      $name      = strtoupper( $my_posts->post_name );
    
      //$v    = get_cimyFieldValue($user_id,$name); 
      // get current taxonomy slug

      $terms = get_the_terms( $questionPostID, 'assessment-category' );
      
      if ( !empty( $terms ) ){
          // get the first term
          $term = array_shift( $terms );
          $v2keylabel = 'assessment-'.$term->slug.'-'.$my_posts->ID;
      
      }else{
        $v2keylabel = 'assessment-unknown-'.$my_posts->ID;  
      }
      $v2 = get_user_meta($user_id, $v2keylabel, true) ? get_user_meta($user_id, $v2keylabel, true):0;

      ?>

      <div class="task-row">
          <div class="question"><?php  echo get_post_meta( $questionPostID,'wpcf-job-seeker-assessment-question',true); ?></div>
          <div class="radio"><label><input type="radio" name="<?php echo $the_slug; ?>" value="yes" id="RadioGroup1_<?php echo $j; ?>" checked class="<?php echo $notallow; ?>" <?php echo $radiodis; ?> /> <span>Yes</span></label></div>
          <div class="radio"><label><input type="radio" name="<?php echo $the_slug; ?>"  value="no" id="RadioGroup1_<?php echo $i; ?>" class="no_<?php echo $the_slug; ?> <?php echo $notallow; ?>"  <?php echo $radiodis; ?> /> <span>No</span></label></div>
        <div id="m<?php echo $the_slug; ?>">
          <div class="taskRating">
            <div class="row">
              <div class="col-md-8"><p><?php echo $startext; ?></p></div>
              <div class="col-md-4">
                <div class="redacted_quick_view <?php echo $removeshow; ?>" <?php echo $showrating; ?> >
                  <?php if($v == 'basic'){ ?>
                    <div data-toggle="tooltip" title="Beginner" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Competent" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Intermediate" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Advanced" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Expert" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                  <?php } elseif ($v == 'average') { ?>
                    <div data-toggle="tooltip" title="Beginner" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Competent" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Intermediate" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Advanced" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Expert" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>

                  <?php } elseif ($v == 'good') { ?>
                    <div data-toggle="tooltip" title="Beginner" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Competent" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Intermediate" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Advanced" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Expert" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>

                  <?php } elseif ($v == 'excellent') { ?>
                    <div data-toggle="tooltip" title="Beginner" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Competent" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Intermediate" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Advanced" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Expert" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>

                  <?php } elseif ($v == 'master') { ?>
                    <div data-toggle="tooltip" title="Beginner" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Competent" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Intermediate" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Advanced" data-placement="bottom" class="jr-ratenode jr-rating" ></div>
                    <div data-toggle="tooltip" title="Expert" data-placement="bottom" class="jr-ratenode jr-rating" ></div>

                  <?php } else{ ?>
                    <div data-toggle="tooltip" title="Beginner" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Competent" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Intermediate" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Advanced" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                    <div data-toggle="tooltip" title="Expert" data-placement="bottom" class="jr-ratenode jr-nomal" ></div>
                  <?php } ?>
                </div>

                <div class="starRating<?php echo $the_slug; ?>  <?php echo $removeallow; ?>" <?php echo $allowrating; ?> >
                  <div data-toggle="tooltip" title="Beginner" data-placement="bottom" class="jr-ratenode jr-nomal"></div>
                  <div data-toggle="tooltip" title="Competent" data-placement="bottom" class="jr-ratenode jr-nomal"></div>
                  <div data-toggle="tooltip" title="Intermediate" data-placement="bottom" class="jr-ratenode jr-nomal"></div>
                  <div data-toggle="tooltip" title="Advanced" data-placement="bottom" class="jr-ratenode jr-nomal"></div>
                  <div data-toggle="tooltip" title="Expert" data-placement="bottom" class="jr-ratenode jr-nomal"></div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      jQuery("input:radio[name='<?php echo $the_slug; ?>']").change(function () {
        if ( jQuery(this).hasClass('notallow') ) {
          return false;
        }
        if(jQuery(this).val() == 'yes'){
           jQuery('#m<?php echo $the_slug; ?>').show();
        }else{
          jQuery('#m<?php echo $the_slug; ?>').hide();
        }
      });
      jQuery('.starRating<?php echo $the_slug; ?>').start(<?php echo $v2; ?>,function(cur){
        //alert("<?php echo $v2keylabel ?> is: "+cur);
        //jQuery('#loaders').show();
        jQuery.ajax({
          type: 'POST',
          dataType: 'json',
          url:'<?php echo site_url();  ?>/wp-admin/admin-ajax.php',
          data: {
            'action': 'save_assessment',
            'question': '<?php echo $name; ?>',
            'the_slug': '<?php echo $the_slug; ?>',
            'asseName': '<?php echo $selfAssPagename; ?>',
            'user_meta_to_update_label' : '<?php echo $v2keylabel ?>',
            'field_value': cur,
            'slug': '<?php echo get_post_field("post_name", get_post() ); ?>',
          },
          success: function(data){
            /*swal({
              title: "Success", 
              html: true,
              text: "<span class='text-center'>Successfully updated!</span>",
              type: "success",
              confirmButtonClass: "btn-primary btn-sm",
            });*/
            //jQuery('#loaders').hide();
          }
        });
      });
      if ( !jQuery('.starRating<?php echo $the_slug; ?> .jr-ratenode').hasClass('jr-rating') ) {
        jQuery(".no_<?php echo $the_slug; ?>").attr('checked', true);
        jQuery("#m<?php echo $the_slug; ?>").hide();
      }
      jQuery('.removeshow, .removeallow').remove();
      </script>
      <?php
      $j++;
    endif;
  } 
  echo '</div>';
  ?>
  <div class="paginationDiv text-center">
    <?php for ($i=1; $i <= $pagi; $i++) {  ?>
      <a href="javascript:void(0);" data-step="<?php echo $i; ?>" class="view_this_step <?php if($i == 1){ echo 'active'; } ?>"><?php echo $i; ?></a>
    <?php } ?>
  </div>
  <?php
}

/*save value for assessment*/
function data_save_assessment(){
  $data = json_encode(array('success'=>false, 'message'=>'not save'));
  if(isset($_POST['action'])){
    $user_id = get_current_user_id();
    // echo $_POST['field_value'];
    // echo $_POST['question'];
    $star = $_POST['field_value'];
    if($_POST['question']){
     
      //$v2keylabel
      update_user_meta($user_id, $_POST['user_meta_to_update_label'], $star );

//      set_cimyFieldValue($user_id, $_POST['question'], $value);
      global $wpdb;
      $wpdb->insert(
        $wpdb->prefix.'user_activity_log',
        array(
          'user_id'  => $user_id,
          'action'   => 'updateAsses',
          'datetime' => time(),
          'meta'     => 'Modified Self Assessments > '.$_POST['asseName']
        ),
        array( '%d', '%s', '%s', '%s' )
      );

      if ( isset($_POST['slug']) ) {
        $fieldvalue = time();
        //update_user_meta($user_id, $_POST['the_slug'].'action', $fieldvalue);
        update_user_meta($user_id, $_POST['user_meta_to_update_label'].'-action', $fieldvalue);
        
        update_user_meta($user_id, $_POST['slug'], $fieldvalue);
      }

      $data = json_encode(array('success'=>true, 'message'=>'Successfully save'));
    }
  }
  echo $data; die;
}
/*
function data_save_assessment_backup(){
  $data = json_encode(array('success'=>false, 'message'=>'not save'));
  if(isset($_POST['action'])){
    $user_id = get_current_user_id();
    // echo $_POST['field_value'];
    // echo $_POST['question'];
    $star = $_POST['field_value'];
    if($_POST['question']){
      if($star == 1){
        $value = 'basic';
      }elseif ($star == 2) {
        $value = 'average';
      }
      elseif ($star == 3) {
        $value = 'good';
      }
      elseif ($star == 4) {
        $value = 'excellent';
      }
      elseif ($star == 5) {
        $value = 'master';
      }else{
        $value = 'none';
      }

      set_cimyFieldValue($user_id, $_POST['question'], $value);
      global $wpdb;
      $wpdb->insert(
        $wpdb->prefix.'user_activity_log',
        array(
          'user_id'  => $user_id,
          'action'   => 'updateAsses',
          'datetime' => time(),
          'meta'     => 'Modified Self Assessments > '.$_POST['asseName']
        ),
        array( '%d', '%s', '%s', '%s' )
      );

      if ( isset($_POST['slug']) ) {
        $fieldvalue = time();
        update_user_meta($user_id, $_POST['the_slug'].'action', $fieldvalue);
        update_user_meta($user_id, $_POST['slug'], $fieldvalue);
      }

      $data = json_encode(array('success'=>true, 'message'=>'Successfully save'));
    }
  }
  echo $data; die;
ability_q1action
*/
add_action('wp_ajax_save_assessment','data_save_assessment');
add_action('wp_ajax_nopriv_save_assessment','data_save_assessment');

/*
function say_goodby_to_old_assessment_meta(){

    $role = 'candidate';
    $users = get_users('role='.$role);

    foreach ($users as $user) {
      for($i=1;$i<=100;$i++){
        delete_user_meta($user->ID, 'know_q'.$i.'action');
        delete_user_meta($user->ID, 'tech_q'.$i.'action');
        delete_user_meta($user->ID, 'skills_q'.$i.'action');
        delete_user_meta($user->ID, 'tasks_q'.$i.'action');
      }
    }

}
add_action('admin_init', 'say_goodby_to_old_assessment_meta');
*/

/* RETURN AN ARRAY OF THE POST ID and rank */
function get_employer_pov_candidate_assessments_overview($tag_id, $user_id){
  $post_ids = get_cpt_taxonomy_post_ids('assessment-question','assessment-category',$tag_id);
  $userMeta = get_user_meta($user_id);
  $htmlStr = 'tag id is: '.$tag_id."<br>";
  $tmp_arr = array();
  
  switch ($tag_id){
    case 485:
    $keyStart='assessment-abilities-';
    break;
    case 486:
    $keyStart='assessment-knowledge-';
    break;
    case 483:
    $keyStart='assessment-tasks-';
    break;
    case 487:
    $keyStart='assessment-skills-';
    break;
    case 484:
    $keyStart='assessment-tech-trends-';
    break;
    case 488:
    $keyStart='assessment-work-';
    break;
  }

  for($i = 0 ;$i< count($post_ids); $i++){
    $key = $keyStart . $post_ids[$i];

    //$empQ = get_post_meta($post_ids[$i], 'wpcf-employer-to-seeker-question', true);
    $empQ = get_post_meta($post_ids[$i], 'wpcf-job-seeker-q-short-desc', true);

    $htmlStr.= '<br>'.$key.' is: '.$userMeta[$key][0]. ' with q: '. $empQ ;
    if($userMeta[$key][0] > 0){
      array_push($tmp_arr, array('key'=>$key, 'empQ' => $empQ, 'value' => $userMeta[$key][0] ) );
    }
    
  }
if(count($tmp_arr) == 0){
  return '<ul><li>Not yet answered</li></ul>';
}
usort($tmp_arr, function($a, $b) {
    if($a['value']==$b['value']) return 0;
    return $a['value'] < $b['value']?1:-1;
});
  
  $htmlStr2 = '<ul>';
  for($i = 0 ;$i<count($tmp_arr);$i++ ){
    $htmlStr2 .= '<li>';
    $htmlStr2 .= $tmp_arr[$i]['empQ'];
    $htmlStr2 .= '<span class="star_rating-'. $tmp_arr[$i]['value'] .'"></span>';
//    $htmlStr2 .= '<span class="star-rating-'.$tmp_arr[$]['value'].'">stars</span>';
    $htmlStr2 .= '</li>';
    
  }
  $htmlStr2 .= '</ul>';
  
  return $htmlStr2;
  //return $htmlStr;
}
 
?>
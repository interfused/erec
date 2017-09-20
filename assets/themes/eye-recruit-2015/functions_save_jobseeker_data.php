<?php
/*Use for set job seeker profile visibility*/
function save_profile_visibility(){
  global $wpdb;
  $data = json_encode(array('success'=>false, 'message'=>'not save'));
  if(isset($_POST['userid'])){
    set_cimyFieldValue($_POST['userid'], 'PROFILE_VISIBILITY', $_POST['status']);
    if($_POST['status'] == 'anonymous'){
      $status = 'Visible to Everyone';
    }elseif ($_POST['status'] == 'Open') {
      $status = 'Recruiters Only ';
    }elseif ($_POST['status'] == 'Private') {
      $status = 'Invisible';
    }else{
      $status = 'Invisible';
    }
    $wpdb->insert($wpdb->prefix.'user_activity_log', array('user_id' => $_POST['userid'], 'action' => 'ProfileVisibility', 'datetime' => time(), 'meta' => 'Changed visibility Settings to '.$status ),array( '%d', '%s', '%s', '%s' ) );
    $data = json_encode(array('success'=>true, 'message'=>'Successfully save'));
  }else{
   $data = json_encode(array('success'=>false, 'message'=>'not save'));
  }
  echo $data; exit;
}

add_action('wp_ajax_visibility', 'save_profile_visibility');
add_action('wp_ajax_nopriv_visibility', 'save_profile_visibility');



//Membership Spotlight active inactive
function spotlight_status(){
  if($_POST['status']){
    $v = $_POST['status'];
    $user_id  = get_current_user_id();
    update_usermeta($user_id, 'spotlight_status',$_POST['status']);
  }
  echo $v; die;
}

add_action('wp_ajax_spotlight', 'spotlight_status');
add_action('wp_ajax_nopriv_spotlight', 'spotlight_status');





//associating a function to login hook
add_action('wp_login', 'set_last_login');
 
//function for setting the last login
function set_last_login($login) {
   $user = get_userdatabylogin($login);
 
   //add or update the last login value for logged in user
   update_usermeta( $user->ID, 'last_login', current_time('mysql') );
}


//function for getting the last login
function get_last_login($user_id) {
   $last_login = get_user_meta($user_id, 'last_login', true);
 
   //picking up wordpress date time format
   $date_format = get_option('date_format') . ' ' . get_option('time_format');
 
   //converting the login time to wordpress format
   $the_last_login = mysql2date($date_format, $last_login, false);
 
   //finally return the value
   return $the_last_login;
}

/*
Login history Store in  database  for every user role
*/
function save_user_login_history($login){
  global  $wpdb;
    $user               = get_userdatabylogin($login);
    $user_id            = $user->ID;
    $browser            = $_SERVER['HTTP_USER_AGENT'];
    $device             = $_SERVER['HTTP_USER_AGENT'];
    $location           = 'Fort Lauderdale, FL.United States';
    $ip_address         = $_SERVER['REMOTE_ADDR'];
    $login_datetime     = date('Y-m-d H:i:s');
    $cdate              = date('Y-m-d H:i:s');
      $wpdb->insert( 
      'eyecuwp_user_login_history', 
      array( 
        'user_id'     => $user_id, 
        'browser'     => $browser ,
        'device'      => $device , 
        'location'    =>  $location , 
        'ip_address'  => $ip_address , 
        'login_date'  =>$login_datetime, 
        'created_ate' => $cdate
      ), 
      array( '%d','%s' ,'%s','%s','%s','%s','%s'));

}


add_action('wp_login','save_user_login_history');

/* ASSESSMENTS */
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
      $slugStart='tasks_q';
      $selfAssPagename = 'Tasks';
      break;

      case 484:
      $slugStart='tech_q';
      $selfAssPagename = 'Tech Trends';
      break;

      case 486:
      $slugStart='know_q';
      $selfAssPagename = 'Kwonledge';
      break;

      case 487:
      $slugStart='skills_q';
      $selfAssPagename = 'Skills';
      break;

      case 485:
      $slugStart='ability_q';
      $selfAssPagename = 'Abilities';
      break;

      case 488:
      $slugStart='work_act_q';
      $selfAssPagename = 'Work';
      break;
    }

    $qCnt = get_assessment_questions_count($tag_id);

    
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
    ///get post by slug
   $the_slug = $slugStart.$i;
   $args = array(
     'name'        => $the_slug,
     'post_type'   => 'assessment-question',
     'post_status' => 'publish',
     'numberposts' => 1
   );
   $my_posts = get_posts($args);

   if( $my_posts ) :
      $questionPostID  = $my_posts[0]->ID;
      $starvalue = array('1'=>'basic','2'=>'average','3'=>'good','4'=>'excellent','5'=>'master');
      $name      = strtoupper($the_slug);
      $fname     = 'cimy_uef_'.$name;
      $v    = get_cimyFieldValue($user_id,$name); 
      //echo cimy_uef_sanitize_content($v);
      $key = array_search($v, $starvalue);
      if($key){
         $setvalue = $key;
      }else{
         $setvalue =0;
      }

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
      jQuery('.starRating<?php echo $the_slug; ?>').start(<?php echo $setvalue; ?>,function(cur){
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
}
add_action('wp_ajax_save_assessment','data_save_assessment');
add_action('wp_ajax_nopriv_save_assessment','data_save_assessment');


function data_save_assessment_none(){
  $data = json_encode(array('success'=>false, 'message'=>'not save'));
  if(isset($_POST['question'])){
    $user_id = get_current_user_id();
    set_cimyFieldValue($user_id, $_POST['question'], '');
    if ( isset($_POST['slug']) ) {
      $fieldvalue = time();
      update_user_meta($user_id, $_POST['question'].'action', $fieldvalue);
      update_user_meta($user_id, $_POST['slug'], $fieldvalue);
    }
    $data = json_encode(array('success'=>true, 'message'=>'Successfully save'));
  }
  echo $data; die;
}
add_action('wp_ajax_save_assessment_none','data_save_assessment_none');
add_action('wp_ajax_nopriv_save_assessment_none','data_save_assessment_none');



function checkupdateSelfAsses($slug, $user_id){
  if ( !empty($slug) ) {
    $img = '<img src="'.get_stylesheet_directory_uri().'/img/mini_torch.png"> ';
    $slug = strtolower($slug);
    $fieldname = $slug.'action';
    $getdata = get_user_meta($user_id, $fieldname, true);
    $now = time();
    $datediff = $now - $getdata;
    $dayes = floor( $datediff / (60 * 60 * 24) );
    if ( (!empty($getdata)) && ($dayes <= 90) ) {
      // return $img;
       return '';
    }
  }
}

?>
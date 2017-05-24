<?php
/**
 * Job Submission Form
 */
if ( ! defined( 'ABSPATH' ) ) exit;

global $job_manager;
?>
<?php if(is_interfused()):
echo 'er modded template: this line is only visible to interfused';
endif;

$user_id = get_current_user_id();
?>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
<div class="filter_loader loader inner-loader" id="loaders"></div>
<section class="preferences">
<div class="row">
  <div class="col-md-3">
    <div class="sidemenu">
      <ul id="navMenu" class="nav nav-stacked">

        <li><a href="#" data-target="1" class="active nextshowsteps">This Postings Basics</a></li>
        <li><a href="#" data-target="2" class="nextshowsteps">Description/Responsibilities</a></li>
        <li><a href="#" data-target="3">Experience Required</a></li>
        <li><a href="#" data-target="4">Preferred Qualifications</a></li>
        <li><a href="#" data-target="5">General Qualifications</a></li>
        <li><a href="#" data-target="6">Education/Licenses</a></li>
        <li><a href="#" data-target="7">Environment/Activity</a></li>
		<li><a href="#" data-target="8">Benefits</a></li>
        <li><a href="#" data-target="9">Physical Requirements</a></li>
        <li><a href="#" data-target="10">Disclaimers</a></li>
        <li><a href="#" data-target="11">Company Details</a></li>      
		<li><a href="#" data-target="12">Preview</a></li>
      </ul>
    </div>
  </div>

  <div class="col-md-9 sidemenu_border">
    <form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data" autocomplete="off" novalidate>
      <div id="initHeading" class="section_title">
        <h3>Job Basics</h3>
        <span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span>
      </div>

      <?php do_action( 'submit_job_form_start' ); ?>
      <?php if ( apply_filters( 'submit_job_form_show_signin', true ) ) : ?>
        <?php get_job_manager_template( 'account-signin.php' ); ?>
      <?php endif; ?>
      <?php if ( job_manager_user_can_post_job() || job_manager_user_can_edit_job( $job_id ) ) : ?>
        <fieldset class="fieldset-job_title2 offScrn">
          <div class="positionListSelect form-group">
            <div id="selectJobTitle" class="sidebar_title cont_title">
              <h4>Choose Your Job Title <span class='job_submit_required custom_job_required text-warning'>(required)</span></h4>
            </div>
            <div id="jobTitle_Security" class="jobTitle_selector ">
              <ul>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security Officer"><span>Security Officer</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security Officer - Unarmed"><span>Security Officer - Unarmed</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security Officer - Armed"><span>Security Officer - Armed</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security Guard"><span>Security Guard </span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security - Engineer"><span>Security - Engineer</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security - Analyst"><span>Security - Analyst</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security - Specialist"><span>Security - Specialist</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security - Supervisor"><span>Security - Supervisor</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security - Manager"><span>Security - Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security - Regional Manager"><span>Security - Regional Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Security - Director"><span>Security - Director</span></label></div>
                </li>
              </ul>
            </div>
            <div id="jobTitle_Investigations" class="jobTitle_selector ">
              <ul>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Generalist"><span>Investigator - Generalist</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Senior"><span>Investigator - Senior</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Principle"><span>Investigator - Principle</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Private"><span>Investigator - Private</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Fraud"><span>Investigator - Fraud</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Research"><span>Investigator - Research</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Background"><span>Investigator - Background</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Criminal"><span>Investigator - Criminal</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Supervisor"><span>Investigator - Supervisor</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Manager"><span>Investigator - Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Regional Manager"><span>Investigator - Regional Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Investigator - Director"><span>Investigator - Director</span></label></div>
                </li>
              </ul>
            </div>
            <div id="jobTitle_Surveillance" class="jobTitle_selector ">
              <ul>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Surveillance - Operative"><span>Surveillance - Operative</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Surveillance - Officer"><span>Surveillance - Officer</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Surveillance - Analyst"><span>Surveillance - Analyst</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Surveillance - Supervisor"><span>Surveillance - Supervisor</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Surveillance - Manager"><span>Surveillance - Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Surveillance - Regional Manager"><span>Surveillance - Regional Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Surveillance - Director"><span>Surveillance - Director</span></label></div>
                </li>
              </ul>
            </div>
            <div id="jobTitle_Loss-Prevention" class="jobTitle_selector ">
              <ul>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Loss Prevention - Officer"><span>Loss Prevention - Officer</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Loss Prevention - Direct Loss"><span>Loss Prevention - Direct Loss</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Loss Prevention - Supervisor"><span>Loss Prevention - Supervisor</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Loss Prevention - Manager"><span>Loss Prevention - Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Loss Prevention - Regional Manager"><span>Loss Prevention - Regional Manager</span></label></div>
                </li>
                <li>
                  <div class="radio"><label><input type="radio" name="multiCheck" value="Loss Prevention - Director"><span>Loss Prevention - Director</span></label></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="sidebar_title cont_title">
            <h4 id="manualJobTitle">Job Title Not Listed?</h4>
          </div>
          <div class="">
            <input type="text" value="" id="job_titleB" name="job_titleB" placeholder="Job title" class="input-text">
          </div>
        </fieldset>
        
        <!-- Job Information Fields -->
        <?php do_action( 'submit_job_form_job_fields_start' ); ?>

        <?php foreach ( $job_fields as $key => $field ) : ?>
          <fieldset class="fieldset-<?php esc_attr_e( $key ); ?> <?php echo (( ($field['type']=='select') || ($field['type']=='term-select') )) ? 'form-group has-feedback' : ''; ?>">
            <label for="<?php esc_attr_e( $key ); ?>"><?php echo $field['label'] . apply_filters( 'submit_job_form_required_label', $field['required'] ? ' <span class="job_submit_required text-warning">' . __( '(required)', 'wp-job-manager' ) . '</span>' : ' <span class="text-success">' . __( '(optional)', 'wp-job-manager' ) . '</span>', $field ); ?></label>
            <div class="field <?php echo $field['required'] ? 'required-field' : ''; ?>">
              <?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
            </div>
            <?php if ( $field['type']=='select' ) { ?>
              <script type="text/javascript">
              jQuery('select').addClass('chosen-single');
              </script>
            <?php } 
            echo (( ($field['type']=='select') || ($field['type']=='term-select') )) ? '<span aria-hidden="true" class="fa fa-angle-down form-control-feedback"></span>' : ''; ?>
          </fieldset>
        <?php endforeach; ?>

        <?php do_action( 'submit_job_form_job_fields_end' ); ?>
      
        <!-- Company Information Fields -->
        <?php if ( $company_fields ) : ?>
        <div id="compDetailHeading" class="sidebar_title cont_title section_title">
          <h3>
            <?php _e( 'Company Details', 'wp-job-manager' ); ?>
          </h3>
          <span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span>
        </div>

        <?php do_action( 'submit_job_form_company_fields_start' ); ?>

        <?php foreach ( $company_fields as $key => $field ) : ?>
          <fieldset class="fieldset-<?php esc_attr_e( $key ); ?>">
            <label for="<?php esc_attr_e( $key ); ?>"><?php echo $field['label'] . apply_filters( 'submit_job_form_required_label', $field['required'] ? ' <span class="job_submit_required text-warning">' . __( '(required)', 'wp-job-manager' ) . '</span>' : ' <span class="text-success">' . __( '(optional)', 'wp-job-manager' ) . '</span>', $field ); ?></label>
            <div class="field <?php echo $field['required'] ? 'required-field' : ''; ?> <?php echo (($field['type'] == 'radio')) ? 'radio' : ''; ?>">
              <?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
            </div>
          </fieldset>
        <?php endforeach; ?>

        <?php do_action( 'submit_job_form_company_fields_end' ); ?>
      <?php endif; ?>

      <?php do_action( 'submit_job_form_end' ); ?>
      <p>
        <input type="hidden" name="job_manager_form" value="<?php echo $form; ?>" />
        <input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
        <input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
        <input type="submit" name="submit_job" class="button" value="<?php esc_attr_e( $submit_button_text ); ?>" />
      </p>
      <?php else : ?>
      <?php do_action( 'submit_job_form_disabled' ); ?>
      <?php endif; ?>
      <p class="text-center">
        <a href="javascript:void(0);" class="btn btn-primary btn-sm previwssteps" data-target="0" id="viewPre" style="display:none;">Previous</a>
        <a href="javascript:void(0);" class="btn btn-primary btn-sm nextsteps" data-target="1" id="viewNext" >Next</a>
      </p>
    </form>

    <div class="disclaimer fineprint marginTop" id="discinstr"> EyeRecruit, Inc. supports and Recruit for only Equal Opportunity Affirmative Action Employers committed to hiring in a diverse workforce that is an Alcohol and Drug-Free Workplace. </div>
    
    <div id="locationDetail" > <!-- class="row" -->
      <div id="locationDetailLeft" ></div><!-- class="col-md-6" -->
      <div id="locationDetailRight" ></div><!-- class="col-md-6" -->
    </div>
    
    <div id="travelMgt"><!-- class="row" -->
      <div id="travelMgtLeft"></div>
      <div id="travelMgtRight"></div>
    </div>
    
    <div id="compensationDetail"><!-- class="row" -->
      <div id="compensationDetailLeft"></div>
      <div id="compensationDetailRight"></div>
    </div>
   
    <fieldset id="insertTmp">
      <label>Job Pay Type<span class="text-warning"> (required)</span></label>
      <div class="radio ">
        <label>
          <input id="RadioGroup1_0" name="JobPayType" type="radio" value="hourly"> <span>Hourly</span>
        </label>

        <label>
          <input id="RadioGroup1_1" name="JobPayType" type="radio" value="salary"> <span>Salary</span>
        </label>
      </div>
    </fieldset>

    <!-- <fieldset id="baseListBuilder" class="listBuilder" data-target="#job_requirements_ifr">
      <div class="sidebar_title cont_title">
        <h4>Build your list</h4>
      </div>
      <div class="indent">
        <ul>
          <li><a href="#" data-action="remove" ><i class="fa  fa-minus-circle fa-lg"></i></a>
            <input type="text">
          </li>
        </ul>
        <div class="text-right">
          <a href="#" data-action="add" class="btn btn-default btn-sm">Add More +</a> <a href="#" data-action="save" data-target="#job_requirements_ifr" class="btn btn-primary btn-sm"  >Save</a>
        </div>
      </div>
    </fieldset> -->
  </div>
  <!-- form --> 
</div>
<!-- main layout -->
</section>

<?php
 /* $jobCountry = get_post_meta($job_id, "_job_country", true);
  $jobState = get_post_meta($job_id, "_job_state", true);
  $jobCity = get_post_meta($job_id, "_job_city", true);
  echo $jobCountry.' , '.$jobState.' , '.$jobCity; //101, 33, 3295*/

?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap-select.min.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap-select.min.js"></script>
<script type="text/javascript">

  jQuery(document).ready(function () {

    /*.......Country-State-City-Select-box.............*/
    jQuery('#job_country, #job_state, #job_city, #job_category, #manages_others, .job_travel_required, #job_pay_yearly, #job_pay_hourly, #job_distance, #job_type').addClass('selectpicker').attr('data-live-search', 'true');
    jQuery(window).load(function() { 
      jQuery('#job_region_chosen a div').remove();
    });

    function getstatebycountry(country){
      if ( country == '' ) {
        jQuery('#job_state option, #job_city option').remove();
        jQuery('#job_state').append('<option value="">Select state</option>');
        jQuery('#job_city').append('<option value="">Select city</option>');
        jQuery("#job_state, #job_city").selectpicker("refresh");
      }
      else {
        jQuery('#job_state option, #job_city option').remove();
        jQuery('#job_state, #job_city').append('<option value="">Please Wait..</option>');
        jQuery("#job_state, #job_city").selectpicker("refresh");
        jQuery.ajax({
          url: '<?php echo admin_url("admin-ajax.php") ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            action: 'getstatebycountry',
            country: country
          },
          success: function(res){
            var jobState = '<?php echo get_post_meta($job_id, "_job_state", true); ?>';
            jQuery('#job_state option, #job_city option').remove();
            jQuery('#job_state').append('<option value="">Select State</option>');
            jQuery('#job_state').append(res);
            jQuery('#job_city').append('<option value="">Select city</option>');
            jQuery('#job_state option[value="'+jobState+'"]').attr('selected', 'selected');
            if ( jobState != '') {
              getcitybystateid(jobState);
            }

            jQuery("#job_state, #job_city").selectpicker("refresh");
          }
        });
      }
    }

    function getcitybystateid(state){
      if ( state == '' ) {
        jQuery('#job_city option').remove();
        jQuery('#job_city').append('<option value="">Select city</option>');
        jQuery("#job_city").selectpicker("refresh");
      }
      else {
        jQuery('#job_city option').remove();
        jQuery('#job_city').append('<option value="">Please Wait..</option>');
        jQuery("#job_city").selectpicker("refresh");
        jQuery.ajax({
          url: '<?php echo admin_url("admin-ajax.php") ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            action: 'getcitybystate',
            state: state
          },
          success: function(res){
            var jobCity = '<?php echo get_post_meta($job_id, "_job_city", true); ?>';
            jQuery('#job_city option').remove();
            jQuery('#job_city').append(res);
            jQuery('#job_city option[value="'+jobCity+'"]').attr('selected', 'selected');
            jQuery("#job_city").selectpicker("refresh");
          }
        });
      }
    }

    var jobCountry = '<?php echo get_post_meta($job_id, "_job_country", true); ?>';
    var jobState = '<?php echo get_post_meta($job_id, "_job_state", true); ?>';
    var jobCity = '<?php echo get_post_meta($job_id, "_job_city", true); ?>';
  
    if ( jobCountry != '' ) {
      getstatebycountry(jobCountry);
    }

    jQuery('#job_country').on('change', function() {
      var country = jQuery(this).val();
      getstatebycountry(country);
    });

    jQuery('#job_state').on('change', function() {
      var state = jQuery(this).val();
      getcitybystateid(state);
    });

    /*.......Prevent Submit form on enter key click.............*/
    jQuery('#submit-job-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });
  });

  /*.......Validation functions Start.............*/
    function stepno1(){
      var job_cat = jQuery("#job_category").val();
      var job_title = jQuery("#job_title").val();
      if( job_cat == '' ){
        jQuery('<label id="job_category-error" stepname="Basic" class="error lang_error" for="job_category">Please select an job category.</label>').insertAfter('#job_category');
      }
      else if(job_title ==''){
        if ( jQuery('#job_titleB').hasClass('joblistedEnterName') ) {
          var jobTitle = 'Please enter an job title.';
        }
        else{
          var jobTitle = 'Please choose an job title Or if not listed enter an job title.';
        }
        jQuery('.fieldset-job_title2').append('<label id="job_title-error" stepname="Basic" class="error lang_error" for="job_title">'+jobTitle+'</label>');
      }

      var job_reference =jQuery('#job_reference').val();
      if( job_reference == ''){
        jQuery('<label id="job_reference-error" stepname="Basic" class="error lang_error" for="job_reference_chosen">Please enter an job reference.</label>').insertAfter('#job_reference');
      }


      /*var job_region = jQuery('#job_region').val();
      var job_location = jQuery('#job_location').val();
      if( job_region == '' && job_location == ''){
        jQuery('<label id="job_region-error" stepname="Basic" class="error lang_error" for="job_region_chosen">Please select an job region Or add other job region.</label>').insertAfter('#job_region_chosen');
      }*/

      var manages_others =jQuery('#manages_others').val();
      if( manages_others == ''){
        jQuery('<label id="manages_others-error" stepname="Basic" class="error lang_error" for="manages_others_chosen">Please select an manages type.</label>').insertAfter('#manages_others');
      }

      var travel_required =jQuery('#job_travel_required').val();
      if( travel_required == ''){
        jQuery('<label id="travel_required-error" stepname="Basic" class="error lang_error" for="travel_required_chosen">Please select an travel type</label>').insertAfter('#job_travel_required');
      }


      if ( jQuery('input[name="JobPayType"]').is(':checked') ) {
        var JobPayType = jQuery('input[name="JobPayType"]:checked').val();
      }
      else{
        var JobPayType = '';
      }
      var job_pay_yearly =jQuery('select[name="job_pay_yearly"]').val();
      var job_pay_hourly =jQuery('select[name="job_pay_hourly"]').val();
      if( JobPayType == ''){
        jQuery('<label id="JobPayType-error" stepname="Basic" class="error lang_error" for="JobPayType_chosen">Please select an job pay type.</label>').insertAfter('#compensationDetailLeft #insertTmp .radio');
      }
      else{
        if( (JobPayType == 'hourly') && (job_pay_hourly == 'n/a') ) {
          jQuery('<label id="job_pay_hourly-error" stepname="Basic" class="error lang_error" for="job_pay_hourly_chosen">Please select an hourly job pay.</label>').insertAfter('#job_pay_hourly');
        }
        else if( (JobPayType == 'salary') && (job_pay_yearly == 'n/a') ){
          jQuery('<label id="job_pay_yearly-error" stepname="Basic" class="error lang_error" for="job_pay_yearly_chosen">Please select an yearly job pay.</label>').insertAfter('#job_pay_yearly');
        }
      }


      var job_country = jQuery('#job_country').val();
      var job_state = jQuery('#job_state').val();
      var job_city = jQuery('#job_city').val();
      if( job_country == ''){
        jQuery('<label id="job_country-error" stepname="Basic" class="error lang_error" for="job_country_chosen">Please select your country.</label>').insertAfter('#job_country');
      }
      else if( job_state == ''){
        jQuery('<label id="job_state-error" stepname="Basic" class="error lang_error" for="job_state_chosen">Please select your state.</label>').insertAfter('#job_state');
      }
      else if( job_city == ''){
        jQuery('<label id="job_city-error" stepname="Basic" class="error lang_error" for="job_city_chosen">Please select your city.</label>').insertAfter('#job_city');
      }

      var job_distance = jQuery('#job_distance').val();
      if( job_distance == ''){
        jQuery('<label id="job_distance-error" stepname="Basic" class="error lang_error" for="job_distance_chosen">Please select an job distance.</label>').insertAfter('#job_distance');
      }

      var job_type =jQuery('#job_type').val();
      if( job_type == ''){
        jQuery('<label id="job_type-error" stepname="Basic" class="error lang_error" for="job_type_chosen">Please select an job type.</label>').insertAfter('#job_type');
      }

      var application_email = jQuery("#application").val();
      if(application_email==''){
        jQuery('<label id="application-error" stepname="Basic" class="error lang_error" for="application">Please enter an email address.</label>').insertAfter('#application');
      }
      else if(!validEmail(application_email)) {
        jQuery('<label id="application-error" stepname="Basic" class="error lang_error" for="application"><br>Please enter a valid email address.</label>').insertAfter('#application');
      }

      var job_deadline =jQuery('#job_deadline').val();
      if( job_deadline == ''){
        jQuery('<label id="job_deadline-error" stepname="Basic" class="error lang_error" for="job_deadline_chosen">Please select an closing date.</label>').insertAfter('#job_deadline');
      }
      
      var job_tags =jQuery('#job_tags').val();
      if( job_tags == ''){
        jQuery('<label id="job_tags-error" stepname="Basic" class="error lang_error" for="job_tags_chosen">Please enter an job tag.</label>').insertAfter('#job_tags');
      }
    }

    function stepno2(){
      var job_description = tinymce.editors['job_description'].getContent();
      if( job_description == '' ){
        jQuery('<label id="job_description-error" stepname="Description/Responsibilities" class="error lang_error" for="job_description">Please enter job description.</label>').insertAfter('#wp-job_description-wrap');
      }
    }

    function stepno3(){
      if( !jQuery('select[name="job_experience_length[]"] option').is(':selected') ){
        jQuery('<label id="job_experience_length-error" stepname="Experience Required" class="error lang_error" for="job_experience_length">Please select at least one experience.</label>').insertAfter('.fieldset-job_experience_length');
      }

      if( ( jQuery('select[name="job_experience_length[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_experience_length_other').val() == '' ) ){
        jQuery('<label id="job_experience_length_other-error" stepname="Experience Required" class="error lang_error" for="job_experience_length_other">Please enter an other experience.</label>').insertAfter('#job_experience_length_other');
      }
    }

    function stepno4(){
      if( !jQuery('select[name="job_preferred_qualifications[]"] option').is(':selected') ){
        jQuery('<label id="job_preferred_qualifications-error" stepname="Preferred Qualifications" class="error lang_error" for="job_preferred_qualifications">Please select at least one preferred qualifications.</label>').insertAfter('.fieldset-job_preferred_qualifications');
      }

      if( ( jQuery('select[name="job_preferred_qualifications[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_preferred_qualifications_other').val() == '' ) ){
        jQuery('<label id="job_preferred_qualifications_other-error" stepname="Experience Required" class="error lang_error" for="job_preferred_qualifications_other">Please enter an other qualification.</label>').insertAfter('#job_preferred_qualifications_other');
      }
    }

    function stepno5(){
     if( !jQuery('select[name="job_preferred_qualification_other[]"] option').is(':selected') ){
        jQuery('<label id="job_preferred_qualification_other-error" stepname="General Qualifications" class="error lang_error" for="job_preferred_qualification_other">Please select at least one other preferred qualification.</label>').insertAfter('.fieldset-job_preferred_qualification_other');
      }

      if( !jQuery('select[name="job_acceptance_exams[]"] option').is(':selected') ){
        jQuery('<label id="job_acceptance_exams-error" stepname="General Qualifications" class="error lang_error" for="job_acceptance_exams">Please select at least one acceptance exam.</label>').insertAfter('.fieldset-job_acceptance_exams');
      }

      if( ( jQuery('select[name="job_acceptance_exams[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_acceptance_exams_other').val() == '' ) ){
        jQuery('<label id="job_acceptance_exams_other-error" stepname="Experience Required" class="error lang_error" for="job_acceptance_exams_other">Please enter an other acceptance exam.</label>').insertAfter('#job_acceptance_exams_other');
      }
    }

    function stepno6(){
     if( !jQuery('select[name="job_education_certifications[]"] option').is(':selected') ){
        jQuery('<label id="job_education_certifications-error" stepname="Education/Licenses" class="error lang_error" for="job_education_certifications">Please select at least one education certifications.</label>').insertAfter('.fieldset-job_education_certifications');
      }

      if( ( jQuery('select[name="job_education_certifications[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_education_certifications_other').val() == '' ) ){
        jQuery('<label id="job_education_certifications_other-error" stepname="Experience Required" class="error lang_error" for="job_education_certifications_other">Please enter an other education.</label>').insertAfter('#job_education_certifications_other');
      }
    }

    function stepno7(){
     if( !jQuery('select[name="job_environment_activity[]"] option').is(':selected') ){
        jQuery('<label id="job_environment_activity-error" stepname="Environment/Activity" class="error lang_error" for="job_environment_activity">Please select at least one environment/activity.</label>').insertAfter('.fieldset-job_environment_activity');
      }

      if( ( jQuery('select[name="job_environment_activity[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_environment_activity_other').val() == '' ) ){
        jQuery('<label id="job_environment_activity_other-error" stepname="Experience Required" class="error lang_error" for="job_environment_activity_other">Please enter an other activity.</label>').insertAfter('#job_environment_activity_other');
      }
    }

    function stepno8(){
     if( !jQuery('select[name="job_benefits[]"] option').is(':selected') ){
        jQuery('<label id="job_benefits-error" stepname="Benefits" class="error lang_error" for="job_benefits">Please select at least one benefit.</label>').insertAfter('.fieldset-job_benefits');
      }

      if( ( jQuery('select[name="job_benefits[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_benefits_other').val() == '' ) ){
        jQuery('<label id="job_benefits_other-error" stepname="Experience Required" class="error lang_error" for="job_benefits_other">Please enter an other benefit.</label>').insertAfter('#job_benefits_other');
      }
    }

    function stepno9(){
     if( !jQuery('select[name="job_physical_requirements[]"] option').is(':selected') ){
        jQuery('<label id="job_physical_requirements-error" stepname="Physical Requirements" class="error lang_error" for="job_physical_requirements">Please select at least one physical requirements.</label>').insertAfter('.fieldset-job_physical_requirements');
      }

      if( ( jQuery('select[name="job_physical_requirements[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_physical_requirements_other').val() == '' ) ){
        jQuery('<label id="job_physical_requirements_other-error" stepname="Experience Required" class="error lang_error" for="job_physical_requirements_other">Please enter an other physical requirement.</label>').insertAfter('#job_physical_requirements_other');
      }
    }


    function stepno10(){
     if( !jQuery('select[name="job_legal_disclaimer[]"] option').is(':selected') ){
        jQuery('<label id="job_legal_disclaimer-error" stepname="Disclaimers" class="error lang_error" for="job_legal_disclaimer">Please select at least one disclaimer.</label>').insertAfter('.fieldset-job_legal_disclaimer');
      }

      if( ( jQuery('select[name="job_legal_disclaimer[]"] option[value="Other"]').is(':selected') ) && ( jQuery('#job_legal_disclaimer_other').val() == '' ) ){
        jQuery('<label id="job_legal_disclaimer_other-error" stepname="Experience Required" class="error lang_error" for="job_legal_disclaimer_other">Please enter an other legal disclaimer.</label>').insertAfter('#job_legal_disclaimer_other');
      }
    }

    function stepno11(){
      var company_name = jQuery('#company_name').val();
      if( company_name == '' ){
        jQuery('<label id="company_name-error" stepname="Company Details" class="error lang_error" for="company_name">Please enter your company name.</label>').insertAfter('#company_name');
      }

      var company_tagline = jQuery('#company_tagline').val();
      if( company_tagline == '' ){
        jQuery('<label id="company_tagline-error" stepname="Company Details" class="error lang_error" for="company_tagline">Please enter your company tagline.</label>').insertAfter('#company_tagline');
      }

      var company_description = tinymce.editors['company_description'].getContent();
      if( company_description == '' ){
        jQuery('<label id="company_description-error" stepname="Company Details" class="error lang_error" for="company_description">Please enter about your company.</label>').insertAfter('#wp-company_description-wrap');
      }


      if ( jQuery('input[name="company_logo_type"]').is(':checked') ) {
        var company_logo_type = jQuery('input[name="company_logo_type"]:checked').val();
      }
      else{
        var company_logo_type = '';
      }

      if( company_logo_type == '' ){
        jQuery('<label id="company_logo_type-error" stepname="Company Details" class="error lang_error" for="company_logo_type">Please select your company logo type.</label>').insertAfter('.fieldset-company_logo_type ');
      }

      var company_logo = jQuery('#company_logo').val();

      var logoexist = jQuery('input[name=current_company_logo]');
      if( logoexist.length > 0 ) {
        var current_company_logo = logoexist.val();
      }
      else{
        var current_company_logo = '';
      }

      if ( (company_logo == '') && (current_company_logo == '') ) {
        jQuery('<label id="company_logo-error" stepname="Company Details" class="error lang_error" for="company_logo">Please upload your company logo.</label>').insertAfter('#company_logo');
      }
      else{
        if ( company_logo != '' ) {
          var ext = company_logo.split('.').pop().toLowerCase();
          var file_size = jQuery('#company_logo')[0].files[0].size;
          
          if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            jQuery('<label id="company_logo-error" stepname="Company Details" class="error lang_error" for="company_logo">File is not a valid format. Allow only jpg, jpeg, gif and png formats.</label>').insertAfter('#company_logo');
          }
          else if ( file_size > 2000000 ) {
            jQuery('<label id="company_logo-error" stepname="Company Details" class="error lang_error" for="company_logo">File is too large!. Maximum file size 2 MB.</label>').insertAfter('#company_logo');
          }

        }
      }
    }
  /*.......Validation functions End.............*/
</script>

<script>

  function showSection(sectionID){
    jQuery("fieldset,#locationDetail,#typeCategoryDetail,#travelMgt,#compensationDetail,#initHeading,#compDetailHeading").addClass('offScrn');
    
    var jobTit = jQuery('#job_titleB').val();
    if ( jobTit != '' ){
      jQuery("#job_title").val(jobTit);
    }

    if(sectionID==1){
      jQuery(".fieldset-job_country, .fieldset-job_state, .fieldset-job_city, .fieldset-job_distance, #insertTmp, .fieldset-manages_others, .fieldset-job_travel_required, .fieldset-job_category, .fieldset-job_region, .fieldset-job_location, .fieldset-job_type, .fieldset-job_pay_yearly, .fieldset-job_pay_hourly, .fieldset-job_reference,#locationDetail,#typeCategoryDetail,#travelMgt,#compensationDetail,#initHeading,.fieldset-application,.fieldset-job_deadline,.fieldset-job_tags,.fieldset-job_postcode").removeClass('offScrn');
      jQuery('#loaders').hide();
      var val=jQuery('#job_category').val();
      jQuery("#selectJobTitle").addClass('offScrn');
      var valText=jQuery("#job_category option[value='"+val+"']").text();
      
      if(valText=="Loss Prevention"){
        valText="Loss-Prevention";
      }
      
      var selectedTextArr=["Loss-Prevention","Security","Surveillance","Loss Prevention","Investigations"];
      if(selectedTextArr.indexOf(valText) >= 0  ){
        jQuery("#selectJobTitle").removeClass('offScrn');
        jQuery("#jobTitle_"+valText).removeClass('offScrn');
        jQuery("#manualJobTitle").text("Job not listed? Enter it below.");
      }
      else{
        jQuery("#selectJobTitle").addClass('offScrn');
        jQuery("#manualJobTitle").text("Enter in your job title below");    
      }

      setTimeout(function(){ jQuery('#viewPre').hide(); },500);

      //jQuery(".fieldset-job_title2").removeClass('offScrn');
      jQuery(".jobTitle_selector").addClass('offScrn');
      return;
    }

    if(sectionID==2){
     //  jQuery(".fieldset-job_description,#primaryResponsibilities").removeClass('offScrn');
      jQuery(".fieldset-job_description,#primaryResponsibilities").removeClass('offScrn');
      jQuery('.fieldset-job_description').prepend('<div id="initHeading" class="section_title"> <h3>Description/Responsibilities</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      return;
    }
    
    if(sectionID==3){
      jQuery(".fieldset-job_experience_length").removeClass('offScrn');
      jQuery('.fieldset-job_experience_length').prepend('<div id="initHeading" class="section_title"> <h3>Experience Required</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      
      if( jQuery('#job_experience_length option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_experience_length_other').insertAfter('.fieldset-job_experience_length');
        jQuery('.fieldset-job_experience_length_other').removeClass('offScrn');
      }
      return;
    }

    if(sectionID==4){
      jQuery(".fieldset-job_preferred_qualifications").removeClass('offScrn');
      jQuery('.fieldset-job_preferred_qualifications').prepend('<div id="initHeading" class="section_title"> <h3>Preferred Qualifications</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      
      if( jQuery('#job_preferred_qualifications option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_preferred_qualifications_other').insertAfter('.fieldset-job_preferred_qualifications');
        jQuery('.fieldset-job_preferred_qualifications_other').removeClass('offScrn');
      }
      return;
    }

    //other
    if(sectionID==5){
      jQuery(".fieldset-job_preferred_qualification_other, .fieldset-job_acceptance_exams").removeClass('offScrn');
      jQuery('.fieldset-job_preferred_qualification_other').prepend('<div id="initHeading" class="section_title"> <h3>General Qualifications</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      
      jQuery('.fieldset-job_acceptance_exams').insertAfter('.fieldset-job_preferred_qualification_other');
      
      if( jQuery('#job_acceptance_exams option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_acceptance_exams_other').insertAfter('.fieldset-job_acceptance_exams');
        jQuery('.fieldset-job_acceptance_exams_other').removeClass('offScrn');
      }
      return;
    }

    if(sectionID==6){
      jQuery(".fieldset-job_education_certifications").removeClass('offScrn');
      jQuery('.fieldset-job_education_certifications').prepend('<div id="initHeading" class="section_title"> <h3>Education/Licenses</h3><span><strong>Employer ID</strong> : 1<?php echo $user_id;  ?></span></div>');
      
      if( jQuery('#job_education_certifications option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_education_certifications_other').insertAfter('.fieldset-job_education_certifications');
        jQuery('.fieldset-job_education_certifications_other').removeClass('offScrn');
      }
      return;
    }

    if(sectionID==7){
      jQuery(".fieldset-job_environment_activity").removeClass('offScrn');
      jQuery('.fieldset-job_environment_activity').prepend('<div id="initHeading" class="section_title"> <h3>Environment/Activity</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      
      if( jQuery('#job_environment_activity option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_environment_activity_other').insertAfter('.fieldset-job_environment_activity');
        jQuery('.fieldset-job_environment_activity_other').removeClass('offScrn');
      }
      return;
    }

    if(sectionID==8){
      jQuery(".fieldset-job_benefits").removeClass('offScrn');
      jQuery('.fieldset-job_benefits').prepend('<div id="initHeading" class="section_title"> <h3>Benefits</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      
      if( jQuery('#job_benefits option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_benefits_other').insertAfter('.fieldset-job_benefits');
        jQuery('.fieldset-job_benefits_other').removeClass('offScrn');
      }
      return;
    }

    //physical
    if(sectionID==9){
      jQuery(".fieldset-job_physical_requirements").removeClass('offScrn');
      jQuery('.fieldset-job_physical_requirements').prepend('<div id="initHeading" class="section_title"> <h3>Physical Requirements</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      
      if( jQuery('#job_physical_requirements option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_physical_requirements_other').insertAfter('.fieldset-job_physical_requirements');
        jQuery('.fieldset-job_physical_requirements_other').removeClass('offScrn');
      }
      return;
    }


    //disclaimers
    if(sectionID==10){
      jQuery(".fieldset-job_legal_disclaimer").removeClass('offScrn');
      jQuery('.fieldset-job_legal_disclaimer').prepend('<div id="initHeading" class="section_title"> <h3>Disclaimers</h3><span><strong>Employer ID</strong> : <?php echo $user_id;  ?></span></div>');
      
      if( jQuery('#job_legal_disclaimer option[value="Other"]').is(':selected') ){
        jQuery('.fieldset-job_legal_disclaimer_other').insertAfter('.fieldset-job_legal_disclaimer');
        jQuery('.fieldset-job_legal_disclaimer_other').removeClass('offScrn');
      }
      return;
    }

    //company info
    if(sectionID==11){
      jQuery(".fieldset-company_logo_type, #compDetailHeading, .fieldset-company_logo, .fieldset-company_name, .fieldset-company_tagline, .fieldset-company_description").removeClass('offScrn');
      return;
    }
    //preview
    if(sectionID==12){
      //jQuery("input[name=submit_job]").removeClass('offScrn');
      //jQuery("input[name=submit_job]").trigger('click');
      stepno1();
      stepno2();
      stepno3();
      stepno4();
      stepno5();
      stepno6();
      stepno7();
      stepno8();
      stepno9();
      stepno10();
      stepno11();
      jQuery('.lang_error').hide();
      if ( jQuery('.error').hasClass('lang_error') ) {
        var errorFieldAll = [];
        jQuery('.lang_error').each( function() {
           errorFieldAll.push( jQuery(this).attr('stepname') );
        });

        jQuery('.joberrolist').remove();
        /*jQuery('.lang_error').each( function() {
          var thisMsg = jQuery(this).text();
          jQuery('#errorlist').append('<li class="list-group-item joberrolist" >'+thisMsg+'</li>');
        });*/

        var errorField = [];
        jQuery.each(errorFieldAll, function(i, el){
          if(jQuery.inArray(el, errorField) === -1) {
            errorField.push(el);
            jQuery('#errorlist').append('<li class="text-warning joberrolist" >Please fill required fileds for '+el+'</li>');
          }
          //var thisMsg = jQuery(this).text();
        });
        jQuery('#requirederrorpopup').modal('show');

        // if( errorField.length > 1 ){
        //   var errorList = '';
        //   var i;
        //   for (i = 0; i < errorField.length; ++i) {
        //     if (i == errorField.length - 1){
        //       errorList += " and " + errorField[i];
        //     }
        //     else{
        //       errorList += ", " + errorField[i];
        //     }
        //   }
        //   var errorFieldSep = errorList.substr(2, errorList.length);
        // }
        // else{
        //   var errorFieldSep = errorField;
        // }

        // jQuery('<label class="error lang_error" id="laststepcheckvalid">Please fill required fileds for '+errorFieldSep+'.</label>').insertBefore('#discinstr');
        
        return false;
      }
      else{
        jQuery("input[name=submit_job]").trigger('click');
        return;
      }

    }
  }
</script> 

<script>

  function validEmail(v) {
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (v.match(r) == null) ? false : true;
  }

  var imgurl = '<?php echo get_stylesheet_directory_uri()."/img/job_posting_seeker_view.jpg"; ?>';

  jQuery(".job-manager-multiselect").each(function(index, element) {

    //get parent div
    var tgtDiv=jQuery(this).closest('.field');

    //append list
    var html='<ul>';
      tgtDiv.find('select option').each(function(index, element) {
        var displayClasses='onoffswitch ';
        if(jQuery(this).prop('selected')){
          displayClasses += ' active';
        }
        html += '<li><div class="'+displayClasses+'"></div> '+jQuery(this).text()+'</li>';
      });
    html += '</ul>';

    jQuery(tgtDiv).append('<div class="alternateField">'+html+'</div>');
  });///END EACH

  jQuery('.job-manager-multiselect, .job-manager-multiselect + .description').addClass('offScrn');

  jQuery('.fieldset-job_experience_length .alternateField').addClass('addjoddetimg')
  jQuery('.fieldset-job_experience_length .alternateField').append('<div class="spe_exp"> <a class="fancybox"   rel="group" href="'+imgurl+'"><img class="img-responsive" src="'+imgurl+'"></a></div>');
  
  ////
  jQuery('body').on('click','.onoffswitch',function(){
    
    var sourceSelectEl=jQuery(this).closest(".field").find('select');
    //console.log(sourceSelectEl.attr('id'));
    
    //toggle class
    jQuery(this).toggleClass('active');
    
    //find element index
    var tmpIdx=jQuery(this).closest('li').index();
    
    //console.log(tmpIdx);
    
    //set select  status on multiselect source 
    if(jQuery(this).hasClass('active')){
      sourceSelectEl.find('option').eq(tmpIdx).prop('selected','true');
    }
    else{
      sourceSelectEl.find('option').eq(tmpIdx).removeProp('selected');
    }
  });

</script>

<script>
  var sectionIdx=1;

  function navSection(){
    jQuery('fieldset').addClass('offScrn');
    if(sectionIdx==1){
      jQuery(".fieldset-job_title2, .fieldset-job_reference").removeClass('offScrn');
    }
    if(sectionIdx==2){
      jQuery("#locationDetail, #locationDetail fieldset").removeClass('offScrn');
    }
    jQuery('.fieldset-job_title, .fieldset-job_requirements').removeClass('offScrn');
  }

  ///HANDLE LIST BUILDER ADD
  jQuery('body').on('click', 'a[data-action="add"]',function(e) {
    e.preventDefault();
    var tgtEl=jQuery(this).closest('fieldset');
    baseEl=tgtEl.find('ul > li:eq(0)');
    cloneEl=baseEl.clone();
    cloneEl.appendTo(tgtEl.find('ul'));
    cloneEl.find("input").val('');
  });
  
  //HANDLE LIST BUILDER REMOVE
  jQuery('body').on('click', 'a[data-action="remove"]', function(e) {
    // do something
    e.preventDefault();
    //index of list item
    var tgtEl=jQuery(this).closest('li');
    var tmpIdx=tgtEl.index();
    //delete current except for first
    if(tmpIdx > 0){
      tgtEl.remove();
    }else{
      removeIt=true;
      var tmpUL=jQuery(this).closest('ul');
      
      if(tmpUL.find('li').length > 1){
        tgtEl.remove();
      }else{
      tgtEl.find('input').val('');
      }
      
    }
  });

  ///PROCESS SAVE
  jQuery('body').on('click', 'a[data-action="save"]',function(e) {
    
    e.preventDefault();
    var tgtIframe=jQuery(this).attr('data-target');
    //console.log('iframe: '+tgtIframe);
    
    var tgtEl2=jQuery(tgtIframe).contents().find('body ');
    
    jQuery(tgtEl2).html('<ul></ul>');
    var tgtEl=jQuery(this).closest('fieldset');
    
    jQuery(tgtEl).find("li").each(function(index, element) {
      var tmpVal=jQuery(this).find('input').val();
      jQuery(tgtEl2).find("ul").append('<li>'+tmpVal+'</li>');
    });
  });
</script> 

<script>
  jQuery("#baseListBuilder").clone().attr('id','primaryResponsibilities').insertAfter(".fieldset-job_requirements");
  jQuery("#primaryResponsibilities h2").html("Primary Responsibilities<br><small>Please provide your list of primary responsibilities</small>");
  //
  jQuery("#baseListBuilder").clone().attr('id','idealQualifications').insertAfter(".fieldset-job_position_skills_bonus");
  jQuery("#idealQualifications h2").text('THE IDEAL QUALIFICATIONS');
  jQuery("#idealQualifications a[data-action=save]").attr('data-target','#job_position_skills_bonus_ifr');
</script>

<div id="typeCategoryDetail" class="row">
  <div id="typeCategoryDetailLeft" class="col-md-6"></div>
  <div id="typeCategoryDetailRight" class="col-md-6"></div>
</div>

<script>

  jQuery("#locationDetail,  #compensationDetail, #travelMgt").insertAfter(".fieldset-job_reference");

  jQuery('.fieldset-job_title, .fieldset-job_requirements, .fieldset-job_position_skills_bonus').addClass('offScrn');
  jQuery(".fieldset-job_location").appendTo("#locationDetailRight");
  jQuery(".fieldset-job_region").appendTo("#locationDetailLeft");
  jQuery(".fieldset-job_category").insertAfter("#initHeading");

  jQuery(".fieldset-manages_others").appendTo("#travelMgtLeft"); 
  jQuery(".fieldset-job_travel_required").appendTo("#travelMgtRight"); 


  jQuery(".field.account-sign-in").closest('fieldset').remove();
  jQuery().insertAfter(".fieldset-job_title");

  jQuery(window).load(function(){

    jQuery('#job_category option[value=""]').text('Select Job Category');
    jQuery('select[name="job_category"] option[value="445"]').remove();
    jQuery('#job_category').append('<option value="445" class="level-0">Other</option>');
    jQuery('#job_type option[value=""]').text('Select Job Type');
    jQuery("#job_category, #job_type").selectpicker("refresh");
    jQuery('.fieldset-job_location label small').remove();

    var edit = '<?php echo $_REQUEST["action"]; ?>';
    
    /*if ( edit != 'edit' ) {
      jQuery('#job_category option').removeAttr('selected');
      jQuery('#job_type option').removeAttr('selected');
    }*/


    jQuery("#insertTmp").appendTo("#compensationDetailLeft");
    jQuery(".chosen-container-multi").remove();
      
    jQuery(".fieldset-job_pay_hourly, .fieldset-job_pay_yearly").appendTo("#compensationDetailRight").hide();


    jQuery("#RadioGroup1_0").on('click',function(){
      jQuery('#job_pay_yearly').prop('selectedIndex',0);
      jQuery(".fieldset-job_pay_yearly").hide();
      jQuery(".fieldset-job_pay_hourly").fadeIn('slow');
    });

    jQuery("#RadioGroup1_1").on('click',function(){
      jQuery('#job_pay_hourly').prop('selectedIndex',0);
      jQuery(".fieldset-job_pay_hourly").hide();
      jQuery(".fieldset-job_pay_yearly").fadeIn('slow');
    });

    jQuery(document).ready(function(){
        if ( jQuery('input[name="JobPayType"]').is(':checked') ){
           var JobPayType = jQuery('input[name="JobPayType"]:checked').val();
           if(JobPayType=='hourly'){
            jQuery(".fieldset-job_pay_yearly").hide();
            jQuery(".fieldset-job_pay_hourly").fadeIn('slow');
         }else{
          jQuery(".fieldset-job_pay_hourly").hide();
          jQuery(".fieldset-job_pay_yearly").fadeIn('slow');
         }
       }


    });

      
    jQuery('input[name=submit_job]').addClass('offScrn');
    if(window.innerWidth > 768){
      showSection(1);
    }


    if ( jQuery('select[name="job_pay_yearly"]').val() != 'n/a' ) {
      jQuery(".fieldset-job_pay_yearly").fadeIn('slow');
      jQuery(".fieldset-job_pay_hourly").hide();
      jQuery('#RadioGroup1_1').prop('checked', true);
    }
    
    if ( jQuery('select[name="job_pay_hourly"]').val() != 'n/a' ) {
      jQuery(".fieldset-job_pay_yearly").hide();
      jQuery(".fieldset-job_pay_hourly").fadeIn('slow');
      jQuery('#RadioGroup1_0').prop('checked', true);
    }
  });


  jQuery("#job_category").change(function(e) {
    jQuery('.fieldset-job_title2 input[type="radio"]').prop('checked', false);
    var val=jQuery(this).val();
    jQuery("#selectJobTitle").addClass('offScrn');
    var valText=jQuery("#job_category option[value='"+val+"']").text();
    
    if(valText=="Loss Prevention"){
      valText="Loss-Prevention";
    }
    jQuery('#job_title-error').remove();
    var selectedTextArr=["Loss-Prevention","Security","Surveillance","Loss Prevention","Investigations"];
    if(selectedTextArr.indexOf(valText) >= 0  ){
      jQuery("#selectJobTitle").removeClass('offScrn');
      jQuery("#manualJobTitle").html("Job not listed? Enter it below.");
      jQuery('#job_titleB').addClass('jobNotlistedEnterName').removeClass('joblistedEnterName');
    }
    else{
      jQuery("#selectJobTitle").addClass('offScrn');
      jQuery("#manualJobTitle").html("Enter your job title below <span class='job_submit_required custom_job_required text-warning'>(required)</span>");
      jQuery('#job_titleB').addClass('joblistedEnterName').removeClass('jobNotlistedEnterName');    
    }

    console.log(valText);
    jQuery(".fieldset-job_title2").removeClass('offScrn');
    jQuery(".jobTitle_selector").addClass('offScrn');
    jQuery("#jobTitle_"+valText).removeClass('offScrn');
    jQuery("#job_titleB").val('');
    jQuery("#job_title").val('');
  });

  jQuery(".positionListSelect input[type=radio]").click(function(e) {
    var thisVal=jQuery(this).parent().text();
    jQuery("#job_titleB").val('');
    jQuery("#job_title").val(thisVal);
  });

  jQuery("#job_titleB").keyup(function(e) {
    var thisVal=jQuery(this).val();
    jQuery('.positionListSelect input[type=radio]').removeAttr('checked');
    jQuery("#job_title").val(thisVal);
  });
</script> 

<script type="text/javascript">

  /* NAV HANDLER */
  jQuery("#navMenu a").click(function(e){
    e.preventDefault();
    
    var stepno = jQuery('#navMenu .active').data('target');
    if( (jQuery(this).hasClass('active')) && ( stepno != 12 ) ){
      return false;
    }
    jQuery('.lang_error').remove();

    if ( stepno == 1 ){
      stepno1();
    }

    if ( stepno == 2 ) {
      stepno2();
    }

    if ( stepno == 3 ) {
      stepno3();
    }

    if ( stepno == 4 ) {
      stepno4();
    }

    if ( stepno == 5 ) {
      stepno5();
    }

    if ( stepno == 6 ) {
      stepno6();
    }

    if ( stepno == 7 ) {
      stepno7();
    }

    if ( stepno == 8 ) {
      stepno8();
    }

    if ( stepno == 9 ) {
      stepno9();
    }

    if ( stepno == 10 ) {
      stepno10();
    }

    if ( stepno == 11 ) {
      stepno11();
    }

    var thisno = jQuery(this).data('target');
    var preno = jQuery("#navMenu a.active").data('target');

    if ( ( jQuery('.error').hasClass('lang_error') ) && (thisno > preno)  ) {
      jQuery('.joberrolist').remove();
      jQuery('.lang_error').each( function() {
        var thisMsg = jQuery(this).text();
        jQuery('#errorlist').append('<li class="text-warning joberrolist" >'+thisMsg+'</li>');
      });

      jQuery('#requirederrorpopup').modal('show');
      jQuery('.lang_error').hide();
      /*jQuery('html, body').animate({
        scrollTop: jQuery(".lang_error").first().offset().top-200
      }, 1000);*/
      return false;
    }
    else{
      jQuery('.lang_error').remove();
      jQuery("#navMenu a").removeClass('active');
      jQuery(this).addClass('active');
      showSection(jQuery(this).attr('data-target'));

      var curr = jQuery(this).attr('data-target');
      var pre = parseInt(curr) - 1;
      jQuery('#viewNext').attr('data-target', curr);
      jQuery('#viewPre').attr('data-target', pre);

      if ( jQuery('#viewPre').attr('data-target') == 0 ) {
        jQuery('#viewPre').hide();
      }
      else{
        jQuery('#viewPre').show();  
      }

      if ( jQuery(this).attr('data-target') >= 12 ) {
        jQuery('#viewNext').hide();
        jQuery('#viewPre').hide();
      }
      else{
        jQuery('#viewNext').show();
        jQuery('#viewPre').show();
      }
    }
  });

  jQuery(document).ready(function() {

    jQuery('fieldset').on('click', '.onoffswitch', function() {
      var findOption = jQuery(this).closest(".field").find('select');
      var liPostion=jQuery(this).closest('li').index();
      var fieldsetClass = jQuery(this).closest("fieldset").attr('class');
      if(jQuery(this).hasClass('active')){
        jQuery('.'+fieldsetClass+'_other').addClass('offScrn');
        jQuery('.'+fieldsetClass+'_other input').val('');
      }
      else{
        var optionVal = findOption.find('option').eq(liPostion).val();
        if ( optionVal == 'Other' ) {
          jQuery('.'+fieldsetClass+'_other').insertAfter('.'+fieldsetClass);
          jQuery('.'+fieldsetClass+'_other').removeClass('offScrn');
        }
      }
    });
  });
</script>

<script type="text/javascript">
  jQuery(document).ready( function() {
    
    jQuery('#viewNext').on('click', function() {

      var curr = jQuery(this).attr('data-target');
      var nxt = parseInt(curr) + 1;
      jQuery('ul li a[data-target="'+nxt+'"]').click();
      if ( jQuery('.error').hasClass('lang_error') ) {
        return false;
      }

      jQuery(this).attr('data-target', nxt);
      jQuery('#viewPre').attr('data-target', curr);
      jQuery('#viewPre').show();

      if ( jQuery(this).attr('data-target') >= 12 ) {
        jQuery(this).hide();
        jQuery('#viewPre').hide();
      }
    });

    jQuery('#viewPre').on('click', function() {

      var curr = jQuery(this).attr('data-target');
      jQuery('ul li a[data-target="'+curr+'"]').click();
      if ( jQuery('.error').hasClass('lang_error') ) {
        return false;
      }

      var pre = parseInt(curr) - 1;
      jQuery('#viewNext').attr('data-target', curr);
      jQuery(this).attr('data-target', pre);

      if ( jQuery(this).attr('data-target') == 0 ) {
        jQuery(this).hide();
      }
      
    });
    
  });

jQuery(document).ready(function() {
  jQuery(".fancybox").fancybox({ 
    'autoDimensions': false,
    'padding'       : 0,
    'width'         : 940,
    'height'        : 400,
    'autoScale'     : false,
    'transitionIn'  : 'none',
    'transitionOut' : 'none',

  });
});

</script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/jquery.fancybox.pack.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>


<div class="modal fade" id="requirederrorpopup" tabindex="-1" role="dialog" aria-labelledby="requirederrorpopupLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h5>Hold on! Before you move on to the next section, a few things remain unanswered.  Please complete the following so you can get the best results from your Job Posting.</h5>
        <div class="clearfix"></div>
        <ul class="" id="errorlist">
          
        </ul>
      </div>
    </div>
  </div>
</div>
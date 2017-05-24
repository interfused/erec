<?php

add_filter( 'submit_job_form_fields', 'frontend_add_customjob_field' ); 
function frontend_add_customjob_field( $fields ) {

	global $wpdb;
	$counTable = $wpdb->prefix.'country';
	$selectCoun = $wpdb->get_results("SELECT * FROM $counTable ORDER BY order_by DESC");
	$getCoun =  array("Select country");
	$countryId =  array("");
	foreach ($selectCoun as $value) {
		$countryId[] = $value->countryId;
		$getCoun[] = ucfirst($value->name);
	}

	if ( isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ) {
		$job_id = $_REQUEST['job_id'];
		$selected_cID = get_post_meta($job_id, '_job_country', true);
		$selected_sID = get_post_meta($job_id, '_job_state', true);

		$stateTable = $wpdb->prefix.'region';
		$selectState = $wpdb->get_results("SELECT * FROM $stateTable WHERE countryId = '".$selected_cID."' ORDER BY name ASC");
		$getState =  array("Select state");
		$regionId =  array("");
		foreach ($selectState as $value) {
			$getState[] = ucfirst($value->name);
			$regionId[] = $value->regionId;
		}

		$cityTable = $wpdb->prefix.'cities';
		$selectCity = $wpdb->get_results("SELECT * FROM $cityTable WHERE regionId = '".$selected_sID."' ORDER BY name ASC");
		$getCity =  array("Select city");
		$cityId =  array("");
		foreach ($selectCity as $value) {
			$getCity[] = ucfirst($value->name);
			$cityId[] = $value->cityId;
		}
	}
	else{
		$stateTable = $wpdb->prefix.'region';
		$selectState = $wpdb->get_results("SELECT * FROM $stateTable WHERE countryId = 231 ORDER BY name ASC");
		$getState =  array("Select state");
		$regionId =  array("");
		foreach ($selectState as $value) {
			$getState[] = ucfirst($value->name);
			$regionId[] = $value->regionId;
		}

		$cityTable = $wpdb->prefix.'cities';
		$selectCity = $wpdb->get_results("SELECT * FROM $cityTable WHERE regionId = 3930 ORDER BY name ASC");
		$getCity =  array("Select city");
		$cityId =  array("");
		foreach ($selectCity as $value) {
			$getCity[] = ucfirst($value->name);
			$cityId[] = $value->cityId;
		}
	}

	$fields['job']['job_country'] = array(
		'label'       => __( 'Country', 'job_manager' ),
		'type'        => 'select',
		'options'	  => array_combine($countryId, $getCoun),
		'required'    => true,
		'priority'    => "1.3",
		'default'     => 231, 
	);

	$fields['job']['job_state'] = array(
		'label'       => __( 'State', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array_combine($regionId, $getState),
		'priority'    => "1.4",
		'default'     => 3930, 
	);


	$fields['job']['job_city'] = array(
		'label'       => __( 'City', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array_combine($cityId, $getCity),
		'priority'    => "1.5",
		'default'     => '-1', 
	);

	$fields['job']['job_distance'] = array(
		'label'       => __( 'Distance', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array('1' => 'Select distance', '5' => 'within 5 miles', '10' => 'within 10 miles', '20' => 'within 20 miles', '30' => 'within 30 miles', '40'=>'within 40 miles','50'=>'within 50 miles','75'=>'within 75 miles','100'=>'within 100 miles'),
		'default'     => '-1', 
		'priority'    => "1.6",
	);

	$fields['_job_postcode'] = array(
		'label'       => __( 'Postcode', 'job_manager' ),
		'type'        => 'text',
		'required'    => true,
		'priority'    => "1.7",
	);

	$fields['job']['job_travel_required'] = array(
		'label'       => __( 'Travel Required', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array('' => 'Select', 'yes' => 'Yes', 'no' => 'No'),
		'default'     => '-1', 
		'priority'    => "1.4",
	);

	return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_customjob_field' );
function admin_add_customjob_field( $fields ) { 

	global $wpdb;
	$counTable = $wpdb->prefix.'country';
	$selectCoun = $wpdb->get_results("SELECT * FROM $counTable ORDER BY order_by DESC");
	$getCoun =  array("Select country");
	$countryId =  array("");
	foreach ($selectCoun as $value) {
		$countryId[] = $value->countryId;
		$getCoun[] = ucfirst($value->name);
	}

	if ( isset($_REQUEST['post']) && !empty($_REQUEST['post']) ) {
		$job_id = $_REQUEST['post'];
		$selected_cID = get_post_meta($job_id, '_job_country', true);
		$selected_sID = get_post_meta($job_id, '_job_state', true);

		$stateTable = $wpdb->prefix.'region';
		$selectState = $wpdb->get_results("SELECT * FROM $stateTable WHERE countryId = '".$selected_cID."' ORDER BY name ASC");
		$getState =  array("Select state");
		$regionId =  array("");
		foreach ($selectState as $value) {
			$getState[] = ucfirst($value->name);
			$regionId[] = $value->regionId;
		}

		$cityTable = $wpdb->prefix.'cities';
		$selectCity = $wpdb->get_results("SELECT * FROM $cityTable WHERE regionId = '".$selected_sID."' ORDER BY name ASC");
		$getCity =  array("Select city");
		$cityId =  array("");
		foreach ($selectCity as $value) {
			$getCity[] = ucfirst($value->name);
			$cityId[] = $value->cityId;
		}
	}
	else{
		$regionId =  array("");
		$getState =  array("Select state");

		$cityId =  array("");
		$getCity =  array("Select city");
	}

	/*$fields['_job_country'] = array(
	    'label' => __( 'Budget type', 'job_manager' ),
	    'type' => 'select',
	    'options' => array( 'Fixed Fee' => 'Fixed Fee', 'Contract Work' => 'Contract Work', 'Time & Materials' => 'Time & Materials', 'Negotiable' => 'Negotiable', 'Negotiable' =>'Negotiable', 'Salary' =>'Salary', 'Commission only' => 'Commission only'),
	    'default'     => 'Negotiable',
	    'placeholder' => '',
    );
  	return $fields;*/

  	$fields['_job_country'] = array(
		'label'       => __( 'Country', 'job_manager' ),
		'type'        => 'select',
		'options'	  => array_combine($countryId, $getCoun),
		'required'    => true,
		'priority'    => "1.3",
		'default'     => '-1', 
	);

	$fields['_job_state'] = array(
		'label'       => __( 'State', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array_combine($regionId, $getState),
		'priority'    => "1.4",
		'default'     => '-1', 
	);


	$fields['_job_city'] = array(
		'label'       => __( 'City', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array_combine($cityId, $getCity),
		'priority'    => "1.5",
		'default'     => '-1', 
	);

	$fields['_job_distance'] = array(
		'label'       => __( 'Distance', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array('1' => 'Select distance', '5' => 'within 5 miles', '10' => 'within 10 miles', '20' => 'within 20 miles', '30' => 'within 30 miles', '40'=>'within 40 miles','50'=>'within 50 miles','75'=>'within 75 miles','100'=>'within 100 miles'),
		'default'     => '-1', 
		'priority'    => "1.6",
	);

	$fields['_job_postcode'] = array(
		'label'       => __( 'Postcode', 'job_manager' ),
		'type'        => 'text',
		'required'    => true,
		'priority'    => "1.7",
	);
	$fields['_job_travel_required'] = array(
		'label'       => __( 'Travel Required', 'job_manager' ),
		'type'        => 'select',
		'required'    => true,
		'options'	  => array('' => 'Select', 'yes' => 'Yes', 'no' => 'No'),
		'default'     => '-1', 
		'priority'    => "1.4",
	);

	return $fields;
}



/*............get state by country Action...............*/

add_action('wp_ajax_getstatebycountry', 'getstatebycountry');
add_action('wp_ajax_nopriv_getstatebycountry', 'getstatebycountry');

function getstatebycountry(){
	$return = array();
	if ( isset($_POST['country']) && !empty($_POST['country']) ) {
		global $wpdb;
		$countryId = $_POST['country'];
		$stateTable = $wpdb->prefix.'region';
		$selectState = $wpdb->get_results("SELECT * FROM $stateTable WHERE countryId = '".$countryId."' ORDER BY name");
		foreach ($selectState as $value) {
			$state[] = '<option value="'.$value->regionId.'">'.ucfirst($value->name).'</option>';
		}
		$return['state'] = $state;
		die( json_encode($return['state']) );
	}
	else{
		$return['state'] = '';
		die( json_encode($return['state']) );
	}
}


/*............get city by state Action...............*/

add_action('wp_ajax_getcitybystate', 'getcitybystate');
add_action('wp_ajax_nopriv_getcitybystate', 'getcitybystate');

function getcitybystate(){
	$return = array();
	if ( isset($_POST['state']) && !empty($_POST['state']) ) {
		global $wpdb;
		$stateId = $_POST['state'];
		$cityTable = $wpdb->prefix.'cities';
		$selectCity = $wpdb->get_results("SELECT * FROM $cityTable WHERE regionId = '".$stateId."' ORDER BY name");
		foreach ($selectCity as $value) {
			$city[] = '<option value="'.$value->cityId.'">'.ucfirst($value->name).'</option>';
		}
		$return['city'] = $city;
		die( json_encode($return['city']) );
	}
	else{
		$return['city'] = '<option value="">Select city</option>';
		die( json_encode($return['city']) );
	}
}

 /*............When edit job listing...............*/

 add_action('admin_footer','edit_post_joblist');
function edit_post_joblist(){
 //if ( isset($_POST['action']) && $_POST['action'] === 'edit' ){  
 	// wp_enqueue_script('jquery'); 
	?> 
   <script type="text/javascript">
	   jQuery(document).ready(function () {
			function getstatebycountry(country){
			  if ( country == '' ) {
			    jQuery('#_job_state option, #_job_city option').remove();
			    jQuery('#_job_state').append('<option value="">Select state</option>');
			    jQuery('#_job_city').append('<option value="">Select city</option>');
			    jQuery("#_job_state, #_job_city").val('');
			  }
			  else {
			    jQuery('#_job_state option, #_job_city option').remove();
			    jQuery('#_job_state, #_job_city').append('<option value="">Please Wait..</option>');
			    jQuery("#_job_state, #_job_city").val('');
			    jQuery.ajax({
			      url: '<?php echo admin_url("admin-ajax.php") ?>',
			      type: 'POST',
			      dataType: 'json',
			      data: {
			        action: 'getstatebycountry',
			        country: country
			      },
			      success: function(res){
			        var jobState = '<?php echo get_post_meta($job_id, "__job_state", true); ?>';
			        jQuery('#_job_state option, #_job_city option').remove();
			        jQuery('#_job_state').append('<option value="">Select State</option>');
			        jQuery('#_job_state').append(res);
			        jQuery('#_job_city').append('<option value="">Select city</option>');
			        jQuery('#_job_state option[value="'+jobState+'"]').attr('selected', 'selected');
			        if ( jobState != '') {
			          getcitybystateid(jobState);
			        }

			        jQuery("#_job_state, #_job_city").val('');
			      }
			    });
			  }
			}

		    function getcitybystateid(state){
		      if ( state == '' ) {
		        jQuery('#_job_city option').remove();
		        jQuery('#_job_city').append('<option value="">Select city</option>');
		        jQuery("#_job_city").val('');
		      }
		      else {
		        jQuery('#_job_city option').remove();
		        jQuery('#_job_city').append('<option value="">Please Wait..</option>');
		        jQuery("#_job_city").val('');
		        jQuery.ajax({
		          url: '<?php echo admin_url("admin-ajax.php") ?>',
		          type: 'POST',
		          dataType: 'json',
		          data: {
		            action: 'getcitybystate',
		            state: state
		          },
		          success: function(res){
		            var jobCity = '<?php echo get_post_meta($job_id, "__job_city", true); ?>';
		            jQuery('#_job_city option').remove();
		            jQuery('#_job_city').append('<option value="">Select city</option>');
		            jQuery('#_job_city').append(res);
		            jQuery('#_job_city option[value="'+jobCity+'"]').attr('selected', 'selected');
		            jQuery("#_job_city").val('');
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
		    jQuery('#_job_country').on('change', function() {
		      var country = jQuery(this).val();
		      getstatebycountry(country);
		    });

		    jQuery('#_job_state').on('change', function() {
		      var state = jQuery(this).val();
		      getcitybystateid(state);
		    });
		});
    </script>
  	<?php
}


function pmpro_manage_users_columns1($columns) {
    $columns['pmpro_membership_level1'] = __('Membership Level', 'pmpro');
    return $columns;
}

function pmpro_manage_users_custom_column1($column_data, $column_name, $user_id) {

    if($column_name == 'pmpro_membership_level1') {
        $levels = pmpro_getMembershipLevelsForUser($user_id);
        $level_names = array();
        if(!empty($levels)) {
            foreach($levels as $key => $level)
                $level_names[] = $level->name;
            $column_data = implode(',', $level_names);
        }
        else
            $column_data = __('None', 'pmpro');
    }

    return $column_data;
}

add_filter('manage_users_columns', 'pmpro_manage_users_columns1');
add_filter('manage_users_custom_column', 'pmpro_manage_users_custom_column1', 10, 3);




/*............Stop Auto renewal...............*/

add_action('wp_ajax_ajaxstopautorenewal', 'ajaxstopautorenewal');
add_action('wp_ajax_nopriv_ajaxstopautorenewal', 'ajaxstopautorenewal');

function ajaxstopautorenewal(){
	$return = array();
	if ( isset($_POST['user_id']) ) {
		global $wpdb;
		$user_id = $_POST['user_id'];
		$memberplan = pmpro_getMembershipLevelForUser($user_id);
		$paln_id = $memberplan->id;
		$initial_payment = $memberplan->initial_payment;
		$cycle_number = $memberplan->cycle_number;

		$aroff = $wpdb->query($wpdb->prepare("UPDATE eyecuwp_pmpro_memberships_users SET cycle_number=0 WHERE user_id='%d' AND membership_id='".$paln_id."' AND status='active'",$user_id));
		$return['msg'] = 'success';
	}
	else{
		$return['msg'] = 'error';
	}
	die( json_encode($return['msg']) );
	
}

/*............Start Auto renewal...............*/

add_action('wp_ajax_ajaxstartautorenewal', 'ajaxstartautorenewal');
add_action('wp_ajax_nopriv_ajaxstartautorenewal', 'ajaxstartautorenewal');

function ajaxstartautorenewal(){
	$return = array();
	if ( isset($_POST['user_id']) ) {
		global $wpdb;
		$user_id = $_POST['user_id'];
		$memberplan = pmpro_getMembershipLevelForUser($user_id);
		$paln_id = $memberplan->id;
		$initial_payment = $memberplan->initial_payment;
		$cycle_number = $memberplan->cycle_number;

		$aroff = $wpdb->query($wpdb->prepare("UPDATE eyecuwp_pmpro_memberships_users SET cycle_number=1 WHERE user_id='%d' AND membership_id='".$paln_id."' AND status='active'",$user_id));
		$return['msg'] = 'success';
	}
	else{
		$return['msg'] = 'error';
	}
	die( json_encode($return['msg']) );
	
}

add_action('wp_ajax_hidWelcomeAllPopup', 'hidWelcomeAllPopup');
add_action('wp_ajax_nopriv_hidWelcomeAllPopup', 'hidWelcomeAllPopup');

function hidWelcomeAllPopup(){
	$user_id = get_current_user_id();
	update_user_meta($user_id, 'guidenewUserTour', 'Yes');
	update_user_meta($user_id, 'guidenewUserAsses', 'Yes');
	update_user_meta($user_id, 'guidenewUserBegin', 'Yes');
	die();
}
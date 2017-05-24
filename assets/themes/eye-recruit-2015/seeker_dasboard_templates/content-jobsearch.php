<?php
/**
 * The default template for displaying content. Used for seeker tips
 * @package Jobify
 * @since Jobify 1.0
 */
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap-select.min.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap-select.min.js"></script>
<form class="form" method="get" action="<?php  echo site_url(); ?>/job-seekers/find-a-job/">
<!-- 	<div class="form-group">
	    <label for="keywords">Keywords</label>
	    <input name="search_keywords" type="text" class="form-control" id="keywords" placeholder="Job title, skills, etc.">
	</div>
 -->
	<div class="form-group has-feedback deshcountryfieldappend">
		<?php 
		global $wpdb;
		$counTable = $wpdb->prefix.'country';
		$selectCoun = $wpdb->get_results("SELECT * FROM $counTable ORDER BY order_by DESC");
		?>
	    <label for="country_select">Country</label>
	    <select class="form-control selectpicker" name="job_country" id="job_country" data-live-search="true">
		  <option value="">Please select a country</option>
		  <option value="all">Select all</option>
		   <?php foreach ($selectCoun as $value) { ?>
		   		<option value="<?php echo $value->countryId; ?>" <?php //echo (($value->countryId == 231)) ? 'selected' : ''; ?> ><?php echo ucfirst($value->name); ?></option>
			<?php } ?>
		</select>
		<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
	</div>

	<div class="form-group has-feedback">
	    <?php
	    $stateTable = $wpdb->prefix.'region';
		$selectState = $wpdb->get_results("SELECT * FROM $stateTable WHERE countryId = 231 ORDER BY name ASC");
	    ?>
	    <label for="state_select">State</label>
	    <select class="form-control selectpicker" name="job_state" id="job_state" data-live-search="true">
		  <option value="">Please select a state</option>
		  <option value="all">Select all</option>
		  <?php /*foreach ($selectState as $value) { ?>
		   		<option value="<?php echo $value->regionId; ?>" <?php //echo (($value->regionId == 3930)) ? 'selected' : ''; ?> ><?php echo ucfirst($value->name); ?></option>
		  <?php }*/ ?>
		</select>
		<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
	</div>

	<div class="form-group has-feedback">
		<?php
		$cityTable = $wpdb->prefix.'cities';
		$selectCity = $wpdb->get_results("SELECT * FROM $cityTable WHERE regionId = 3930 ORDER BY name ASC");
	    ?>
	    <label for="city_select">City</label>
	    <select class="form-control selectpicker" name="job_city" id="job_city" data-live-search="true">
		  <option value="">Please select a city</option>
		  <option value="all">Select all</option>
		    <?php /*foreach ($selectCity as $value) { ?>
		   		<option value="<?php echo $value->cityId; ?>" ><?php echo ucfirst($value->name); ?></option>
			<?php }*/ ?>
		</select>
		<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
	</div>

	<div class="form-group has-feedback">
	    <label for="country_select">Job Category</label>
	    <?php
		$args = array(
			'hide_empty' => false,
		    'taxonomy' => 'job_listing_category',
		    'orderby'  => 'name'
		); ?>
		
	    <select class="form-control selectpicker" class="country_select" name="filter_category" data-live-search="true">
	    	<option class="level-0" value="">Please select a job category</option>
			<?php foreach (get_categories( $args ) as $key ) { ?>
				<option value="<?php echo $key->term_id; ?>" ><?php echo $key->name; ?></option>
		   <?php } ?>
		</select>
		<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
	</div>

	<div class="form-group has-feedback">
	    <label for="job_distance">Distance</label>
	     <ul class="quick_link_distance">
	  	<?php 
	  	$comArr = array('5' => 'within 5 miles', '10' => 'within 10 miles', '20' => 'within 20 miles', '30' => 'within 30 miles', '40'=>'within 40 miles','50'=>'within 50 miles','75'=>'within 75 miles','100'=>'within 100 miles');
	  	 ?>
	    <select class="form-control selectpicker" id="job_distance" name="job_distance" data-live-search="true">
		  <option value="">Please select a distance</option>
		<!--   <option value="all">Select all</option> -->
		  <?php   foreach ($comArr as $key => $value ) {  ?>
		  <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
		  <?php } ?>
		 <!--  <option value="Under 10 miles">Under 10 miles</option>
		  <option value="Under 25 miles">Under 25 miles</option>
		  <option value="Under 50 miles">Under 50 miles</option>
		  <option value="Over 50 miles">Over 50 miles</option> -->
		</select>
		<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-default">Search</button>
	</div>
</form>

<script type="text/javascript">

	jQuery(document).ready(function () {

		jQuery('#job_country').on('change', function() {
		  var country = jQuery('#job_country option:selected').val();
		  if ( country == '' || country == 'all' ) {
		  	jQuery('#job_state option, #job_city option').remove();
		  	jQuery('#job_state').append('<option value="">Please select a state</option>');
		  	jQuery('#job_city').append('<option value="">Please select a city</option>');
		  	jQuery("#job_state, #job_city").selectpicker("refresh");
		  }
		  else {
			  jQuery('#job_state option').remove();
			  jQuery('#job_state').append('<option value="">Please Wait..</option>');
			  jQuery('button[data-id="job_state"] span').html('Please Wait..');
			  jQuery.ajax({
			    url: '<?php echo admin_url("admin-ajax.php") ?>',
			    type: 'POST',
			    dataType: 'json',
			    data: {
			      action: 'getstatebycountry',
			      country: country
			    },
			    success: function(res){
			      jQuery('#job_state option, #job_city option').remove();
			      jQuery('#job_state').append('<option value="">Please select a state</option><option value="all">Select all</option>');
			      jQuery('#job_city').append('<option value="">Please select a city</option>');
			      jQuery('#job_state').append(res);
			      jQuery("#job_state, #job_city").selectpicker("refresh");
			    }
			  });
			}
		});

		jQuery('#job_state').on('change', function() {
		  var state = jQuery(this).val();
		  if ( state == '' || state == 'all') {
		  	jQuery('#job_city option').remove();
		  	jQuery('#job_city').append('<option value="">Please select a city</option>');
		  	jQuery("#job_city").selectpicker("refresh");
		  }
		  else {
			  jQuery('#job_city option').remove();
			  jQuery('#job_city').append('<option value="">Please Wait..</option>');
			  jQuery('button[data-id="job_city"] span').html('Please Wait..');
			  jQuery.ajax({
			    url: '<?php echo admin_url("admin-ajax.php") ?>',
			    type: 'POST',
			    dataType: 'json',
			    data: {
			      action: 'getcitybystate',
			      state: state
			    },
			    success: function(res){
			      jQuery('#job_city option').remove();
			      jQuery('#job_city').append('<option value="">Please select a city</option><option value="all">Select all</option>');
			      jQuery('#job_city').append(res);
			      jQuery("#job_city").selectpicker("refresh");
			    }
			  });
			}
		});
	});
</script>
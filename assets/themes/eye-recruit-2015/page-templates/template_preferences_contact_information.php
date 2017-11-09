<?php
/**
 * Template Name: Preferences contact information page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<style>
#editPoPic{
	display: none;
}
</style>

<?php 
	$user_id = get_current_user_id();
	$value = get_cimyFieldValue($user_id,'PROFILE_VISIBILITY');
	if($value == 'anonymous'){
		$status = 'Visible to Everyone';
	}elseif ($value == 'Open') {
		# code...
		$status = 'Recruiters Only ';
	}elseif ($value == 'Private') {
		# code...
		$status = 'You’re Invisible';
	}else{

		$status = 'You’re Invisible';
	}
	$data = get_userdata($user_id);

?>
<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="contact_info">
						<div class="section_title">
							<h3><?php  echo  the_title(); ?></h3>
							<span><strong>Recruit ID</strong> : <?php echo $user_id;  ?></span>
						</div>
						<div class="sidebar_title cont_title">
							<h4>Photo Professional Photograph</h4>
							<!-- <div class="title_edit"><a href="javascript:void(0);"><i class="fa fa-pencil"></i> Edit</a></div> -->
						</div>
						<div class="profile_box indent">
							<div class="thumbnail">
								<a href="javascript:void(0);" id="editPoPic"><i class="fa fa-pencil"></i></a>
								<?php
								echo do_shortcode('[ica_avatar uid="'.$user_id.'"]');
								?>
							</div>
							<div class="profile_cont">
								<?php 
								$membershipUser = $wpdb->prefix.'memberships_users';
								$checkUserMember = $wpdb->get_var("SELECT COUNT(id) FROM eyecuwp_pmpro_memberships_users WHERE user_id = '".$user_id."' ");
								if ( $checkUserMember <= 0 ) {
									$buttonText = 'Get Started';
								}
								else{
									$buttonText = 'Upgrade';
								}
								if(is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel())
								{
									global $current_user;
									$current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
									$membershipLevel = $current_user->membership_level->name;
								}
								else{
									$membershipLevel = 'Not Available';
								}

								$spotlight_status 	= get_usermeta($user_id, 'spotlight_status',true);
								if($spotlight_status == 'yes'){
									$status 	= 'Active';
								}else{
									$status 	= 'Inactive';
								}
								?>
								<ul class="view_points">
									<li><strong>Your Current Profile Status is : </strong><span class="cuStatus"><?php echo $status;  ?></span><a href="javascript:void(0);" id="change_Visistatus" class="btn btn-sm btn-primary">Edit</a></li>
									<li><strong>Your Current Membership Level is : </strong><?php echo $membershipLevel; ?> <a href="<?php echo site_url(); ?>/seeker-pricing/" class="btn btn-sm btn-primary"><?php echo $buttonText; ?></a></li>
									<li><strong>You have been a Member since : </strong><?php echo  date( "F d, Y", strtotime($data->user_registered)); ?></li>
									<li><strong>Your Membership Spotlight Status is : </strong><?php echo $status; ?> <!-- <a href="javascript:void(0);" class="btn btn-sm btn-primary">Edit</a> -->
										<!-- <div class=" alert" role="alert"> --><i class="fa fa-info-circle info_tooltip" data-toggle="tooltip" title="Increase your chances of being seen!" data-placement="left"></i> <!-- <span>Increase yout chances fo being seen!</span> --><!-- </div> -->
									</li>
									<li><strong>Your signature</strong>  <a href="<?php echo site_url(); ?>/signature/" class="btn btn-sm btn-primary">Add</a>
									</li>
								</ul>						
							</div>
						</div>
						<div class="name_info">
							<div class="sidebar_title cont_title">
								<h4>Name & Contact Info</h4>
								<div class="title_edit"><a href="javascript:void(0);" id="save_contact_info"><i class="fa fa-pencil"></i> Edit</a></div>
							</div>
							<div class="indent">
								<div class="row">
									<div class="col-sm-7">
										<div class="form-group">
										  <label class="control-label" for="get_first_name">First Name</label>
										  <p class="help-block" id="get_first_name"><?php echo get_user_meta($user_id,'first_name',true);  ?></p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-7">
										<div class="form-group">
											<label class="control-label" for="get_last_name">Last Name</label>
										  	<p class="help-block" id="get_last_name"><?php echo get_user_meta($user_id,'last_name',true);  ?></p>
										</div>
									</div>
								</div>
								<div class="form-group alert_row">
									<div class="row">
										<div class="col-sm-7">
											<label class="control-label" for="get_email_address">Email Address</label>
										  	<p class="help-block" id="get_email_address"><?php echo $data->user_email;  ?></p>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-7">
										<div class="form-group">
											<label class="control-label" for="get_secondary_email">Secondary Email Address</label>
										  	<p class="help-block" id="get_secondary_email"><?php echo get_user_meta( $user_id, 'sec_email',true); ?></p>
										</div>
									</div>
									<div class="col-sm-5">
											<i class="fa fa-info-circle info_tooltip" data-toggle="tooltip" title="Have an alternate email address?" data-placement="left"></i> 
										</div>
								</div>
								<div class="form-group alert_row">
									<div class="row">
										<div class="col-sm-7">
											<label class="control-label" for="get_cell_phone">Cellular Phone</label>
										  	<p class="help-block" id="get_cell_phone"><?php echo get_user_meta( $user_id, 'cell_phone',true); ?></p>
										</div>
										<div class="col-sm-5">
											<i class="fa fa-info-circle info_tooltip" data-toggle="tooltip" title="Provide us with your cellular telephone so we can contact you privately for positions personally and by text. Text charges may apply. Check with you carrier for details." data-placement="left"></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-7">
										<div class="form-group has-feedback">
										    <label class="control-label" for="country_select">Distance</label>
										    <?php
										    $disVal = get_cimyFieldValue($user_id, 'JOB_SEARCH_RADIUS');
										    $disArr = array('Under 10 miles','Under 25 miles','Under 50 miles','Over 50 miles');
										    ?>
										    <p class="help-block" id="get_best_time"><?php echo $disVal; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="name_info">
							<div class="sidebar_title cont_title">
								<h4>Your Zip Code</h4>
								<!-- <div class="title_edit"><a href="javascript:void(0);"><i class="fa fa-pencil"></i> Edit</a></div> -->
							</div>
							<div class="indent">
								<div class="form-group alert_row">
									<!-- <label>Membership Spotlight</label> -->

									<div class="row">
										<div class="col-sm-7">
											<span class="help-block"><?php echo get_cimyFieldValue($user_id, 'SEEKER_ZIP_CODE'); ?></span>
										</div>
										<div class="col-sm-5">
											<i class="fa fa-info-circle info_tooltip" data-toggle="tooltip" title="Your zip code" data-placement="left"></i>
										</div>
									</div>
									
								</div>
								<div class="form-group alert_row">
									<div class="row">
										<div class="col-sm-7">
											<label class="sr-only" for="inputHelpBlock">Closest Major City You are Seeking</label>
											
											<!-- <p class="help-block" id="get_cell_phone"><?php echo get_user_meta( $user_id, 'cell_phone',true); ?></p> -->
											<?php echo get_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN'); ?>
											<!-- <input type="text" aria-invalid="false" aria-required="true" class="form-control" size="40" value="<?php //echo get_user_meta( $user_id, 'cell_phone',true); ?>"  placeholder="Cellular Phone *" name="cellular_phone"> -->
										</div>
										<div class="col-sm-5">
											<i class="fa fa-info-circle info_tooltip" data-toggle="tooltip" title="Area of interest for seeking opportunities." data-placement="left"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="name_info">
							<div class="sidebar_title cont_title">
								<h4>Your Current Default Currency</h4>
								<?php 
								$currency = array(
									'USD' => 'US Dollars ($)',
									'EUR' => 'Euros (€)',
									'GBP' => 'Pounds Sterling (£)', 
									'ARS' => 'Argentine Peso ($)', 
									'AUD' => 'Australian Dollars ($)', 
									'BRL' => 'Brazilian Real (R$)', 
									'CAD' => 'Canadian Dollars ($)', 
									'CNY' => 'Chinese Yuan', 
									'CZK' => 'Czech Koruna', 
									'DKK' => 'Danish Krone', 
									'HKD' => 'Hong Kong Dollar ($)', 
									'HUF' => 'Hungarian Forint', 
									'INR' => 'Indian Rupee', 
									'IDR' => 'Indonesia Rupiah', 
									'ILS' => 'Israeli Shekel', 
									'JPY' => 'Japanese Yen (¥)', 
									'MYR' => 'Malaysian Ringgits', 
									'MXN' => 'Mexican Peso ($)', 
									'NGN' => 'Nigerian Naira (₦)', 
									'NZD' => 'New Zealand Dollar ($)', 
									'NOK' => 'Norwegian Krone', 
									'PHP' => 'Philippine Pesos', 
									'PLN' => 'Polish Zloty', 
									'SGD' => 'Singapore Dollar ($)', 
									'ZAR' => 'South African Rand (R)', 
									'KRW' => 'South Korean Won', 
									'SEK' => 'Swedish Krona', 
									'CHF' => 'Swiss Franc', 
									'TWD' => 'Taiwan New Dollars', 
									'THB' => 'Thai Baht', 
									'TRY' => 'Turkish Lira', 
									'VND' => 'Vietnamese Dong'
								);
								$select_currency = get_user_meta($user_id, 'usercustom_curr', true);
								if ( empty($select_currency) ) {
									$select_currency1 = "Your default currency not set.";
								}
								else{
									$select_currency1 = $select_currency;
								}
								?>
								<div class="title_edit"><a href="javascript:void(0);" id="editCustomCurr"><i class="fa fa-pencil"></i> Edit</a></div>
							</div>
							<div class="indent">
								<div class="form-group" id="showcustcurr">
									<strong><?php echo $select_currency1; ?></strong>
								</div>
								<div id="savecurrcont" style="display:none;">
									<div class="row">
										<div class="col-sm-7">
											<div class="form-group" id="savecurrinput">
												<!-- <input type="text" name="custom_curr" class="form-control" id="custom_curr" value="<?php //echo $getCurr; ?>" placeholder="Your Default Currency" > -->
												<select name="custom_curr" class="form-control" id="custom_curr">
													<option value="">Select your currency</option>
													<?php 
													foreach ($currency as $currency_code => $currency_name) {
														?>
														<option value="<?php echo $currency_code; ?>" <?php echo (($currency_code == $select_currency))? 'selected': ''; ?> ><?php echo $currency_name; ?></option>
														<?php
													}
													 ?>
												</select>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="text-center" id="savecurrbtn">
												<a href="javascript:void(0);" class="btn btn-primary">Save</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="form-group">
								<label>Membership Spotlight</label>
							</div> -->
						</div>


						<div class="name_info view_radio">
							<div class="sidebar_title cont_title">
								<h4>Select For Profile Pic</h4>
							</div>
							<div class="indent">
							  <div class="radio ">
							    <label>
							      <input name="choose_profile" value="image" type="radio" checked="checked"> <span>Photo Professional Photograph</span>
							    </label>

							    <label>
							      <input name="choose_profile" value="namefirstletter" type="radio"> <span>First Letter Of Your Name</span>
							    </label>
							  </div>
							</div>
						</div>

						<div class="name_info view_radio">
							<div class="sidebar_title cont_title">
								<h4>Select For Cover Letter</h4>
							</div>
							<div class="indent">
							  <div class="radio ">
							    <label>
							      <input name="choose_profile1" value="image" type="radio" checked="checked"> <span>Photo Professional Photograph</span>
							    </label>

							    <label>
							      <input name="choose_profile1" value="namefirstletter" type="radio"> <span>First Letter Of Your Name</span>
							    </label>
							  </div>
							</div>
						</div>

						<div class="name_info view_radio">
							<div class="sidebar_title cont_title">
								<h4>Select For Redacted View</h4>
							</div>
							<div class="indent">
							  <div class="radio ">
							    <label>
							      <input name="choose_profile2" value="image" type="radio" checked="checked"> <span>Photo Professional Photograph</span>
							    </label>

							    <label>
							      <input name="choose_profile2" value="namefirstletter" type="radio"> <span>First Letter Of Your Name</span>
							    </label>
							  </div>
							</div>
						</div>


						<div class="name_info view_radio">
							<div class="sidebar_title cont_title">
								<h4>Select For Quick View</h4>
							</div>
							<div class="indent">
							  <div class="radio ">
							    <label>
							      <input name="choose_profile3" value="image" type="radio" checked="checked"> <span>Photo Professional Photograph</span>
							    </label>

							    <label>
							      <input name="choose_profile3" value="namefirstletter" type="radio"> <span>First Letter Of Your Name</span>
							    </label>
							  </div>
							</div>
						</div>
						

						<div class="name_info">
							<div class="sidebar_title cont_title">
								<h4>Take a Tour</h4>
							</div>
							<div class="form-group text-center">
								<a href="<?php echo site_url('/job-seekers/tour/'); ?>" class="btn btn-primary" target="_blank">Take a tour</a>
							</div>
							<div class="sidebar_title cont_title">
								<h4>Recent Tour</h4>
							</div>
							<div class="indent">
								<?php 
								global $wpdb;
								$tablename = $wpdb->prefix.'last_view';
								$select = $wpdb->get_results("SELECT * FROM $tablename WHERE meta_other = '".$user_id."' ORDER BY id desc LIMIT 5");
								if ( !empty($select) ) { ?>
									<ul class="recent_tour_list card_billing_info">
										<?php 
										foreach ($select as $value) {
											$datetaime = date('g.iA \o\n j M, Y', $value->date_time);
											echo '<li>'.$datetaime.'</li>';
										} ?>
									</ul>
								<?php }
								else{ echo "<strong>No data found.</strong>"; } ?>
							</div>
						</div>
						<div class="badge_box">
							<div class="sidebar_title cont_title">
								<h4>Your Badges</h4>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="badge_icon">
										<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/profile_badge.png" class="img-reponsive">
										<span>5</span>
									</div>
									<div class="checkbox-slider--b">
										<label>
											<span class="text-primary">Show</span><input type="checkbox" name="pricingType" <?php if( ( in_array($current_user->membership_level->ID, $levelArray) ) || empty($current_user->membership_level->ID) ){ echo "checked"; } ?> ><span>Don’t Show</span>
										</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="badge_icon">
										<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/profile_badge.png" class="img-reponsive">
										<span>1</span>
									</div>
									<div class="checkbox-slider--b">
										<label>
											<span class="text-primary">Show</span><input type="checkbox" name="pricingType" <?php if( ( in_array($current_user->membership_level->ID, $levelArray) ) || empty($current_user->membership_level->ID) ){ echo "checked"; } ?> ><span>Don’t Show</span>
										</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="badge_icon">
										<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/profile_badge.png" class="img-reponsive">
									</div>
									<div class="checkbox-slider--b">
										<label>
											<span class="text-primary">Show</span><input type="checkbox" name="pricingType" <?php if( ( in_array($current_user->membership_level->ID, $levelArray) ) || empty($current_user->membership_level->ID) ){ echo "checked"; } ?> ><span>Don’t Show</span>
										</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="badge_icon">
										<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/profile_badge.png" class="img-reponsive">
									</div>
									<div class="checkbox-slider--b">
										<label>
											<span class="text-primary">Show</span><input type="checkbox" name="pricingType" <?php if( ( in_array($current_user->membership_level->ID, $levelArray) ) || empty($current_user->membership_level->ID) ){ echo "checked"; } ?> ><span>Don’t Show</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
				
		</div> --><!-- #content -->
		<!--
		<?//php do_action( 'jobify_loop_after' ); ?>
	</div> --><!-- #primary -->

	<?php endwhile; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
		   jQuery('#editCustomCurr').on('click', function() {
		   		jQuery('#savecurrcont').slideToggle();
		   });
		   jQuery('#savecurrbtn .btn').on('click', function() {
		   		var curr = jQuery('#custom_curr').val();
		   		var _this = jQuery(this);
		   		_this.attr('disabled', 'disabled');
		   		jQuery.ajax({
		   			type: 'POST',
		            url: '<?php echo admin_url("admin-ajax.php"); ?>', 
		            dataType: 'json',
		            data: {
		            	action: 'editCustomCurrency', //Axtion in in/edit_basic_info.php
		            	curr: curr,
		            },
		            success: function(r){
		            	if (r.msg == 'success') {
		            		swal({
								title: "Success", 
								html: true,
								text: "<span class='text-center'>Successfully updated your Currency.</span>",
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
		            		if ( curr == '' ) {
		   			        	jQuery('#showcustcurr strong').html("Your default currency not set.");
		            		}
		            		else{
		   			        	jQuery('#showcustcurr strong').html(curr);
		            		}
		   					jQuery('#savecurrcont').slideToggle();
		            	}
		            	else{
		            		swal({
								title: "Error", 
								html: true,
								text: "<span class='text-center error'>Something wrong. Please try again!</span>",
								type: "error",
								confirmButtonClass: "btn-primary btn-sm",
							});
		            	}
		   				_this.removeAttr('disabled');
		            }
		   		});
		   });
		});
	</script>

	<script type="text/javascript">
		jQuery(document).ready( function() {

			function validateEmail(email) {
			  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			  return emailReg.test( email );
			}

			function numericOnly(v) {
			    var r = new RegExp('[^0-9]','g');
			    return (v.match(r) == null) ? false : true;
			}

			jQuery('#save_contact_info').on('click', function() {
				jQuery('#BasicInfoPoup').modal('show');
			});

			jQuery('#saveContactInfo').on('click', '.basicinfo_status_save', function() {
				jQuery('.error').remove();
				var _this = jQuery(this);
				
				var fname = jQuery('input[name="ufirst_name"]').val();
				if (fname == '') {
					jQuery('<label id="ufirst_name-error" class="error continfo_error" for="ufirst_name">Please enter an first name.</label>').insertAfter('input[name="ufirst_name"]');
				}

				var lname = jQuery('input[name="ulast_name"]').val();
				if (lname == '') {
					jQuery('<label id="ulast_name-error" class="error continfo_error" for="ulast_name">Please enter an last name.</label>').insertAfter('input[name="ulast_name"]');
				}

				var uemail = jQuery('input[name="uemail_address"]').val();
				if (uemail == '') {
					jQuery('<label id="email_address-error" class="error continfo_error" for="uemail_address">Please enter an email.</label>').insertAfter('input[name="uemail_address"]');
				}
				else if( !validateEmail(uemail) ){
					jQuery('<label id="email_address-error" class="error continfo_error" for="uemail_address">Please enter an valid email.</label>').insertAfter('input[name="uemail_address"]');
				}

				var contno = jQuery('input[name="ucell_phone"]').val();
				if (contno == '') {
					jQuery('<label id="cell_phone-error" class="error continfo_error" for="ucell_phone">Please enter an phone no.</label>').insertAfter('input[name="ucell_phone"]');
				}
				else if( (contno.length < 12) || (contno.length > 14)  ){
					jQuery('<label id="cell_phone-error" class="error continfo_error" for="ucell_phone">Please enter an valid phone no.</label>').insertAfter('input[name="ucell_phone"]');
				}
				

				var suemail = jQuery('input[name="usecondary_email"]').val();
				if( !validateEmail(suemail) ){
					jQuery('<label id="usecondary_email-error" class="error continfo_error" for="usecondary_email">Please enter an valid email.</label>').insertAfter('input[name="usecondary_email"]');
				}

				var bestTr = jQuery('select[name="ubest_time"]').val();

				if ( jQuery('.error').hasClass('continfo_error') ) {
					return false;
				}
				else{
					_this.text('Please Wait...');
					jQuery.ajax({
						type: 'POST',
			            url: '<?php echo admin_url("admin-ajax.php"); ?>',
			            dataType: 'json',
			            data: {
			            	action: 'editContactInfo', 
			            	fname: fname,
							lname: lname,
							uemail: uemail,
							suemail: suemail,
							contno: contno,
							bestTr: bestTr,
			            },
			            success: function(r){
			            	if (r.status == 'success') {
			            		jQuery('#get_first_name').text(fname);
								jQuery('#get_last_name').text(lname);
								jQuery('#get_email_address').text(uemail);
								jQuery('#get_cell_phone').text(contno);
								jQuery('#get_secondary_email').text(suemail);
								jQuery('#get_best_time').text(bestTr);
			            		jQuery('#BasicInfoPoup').modal('hide');
		            			_this.text('Save and close');
			            		swal({
									title: "Success", 
									html: true,
									text: "<span class='text-center'>Successfully updated your name & contact info.</span>",
									type: "success",
									confirmButtonClass: "btn-primary btn-sm",
								});
			            	}
			            	if (r.status == 'exist') {
			            		swal({
									title: "Warning", 
									html: true,
									text: "<span class='text-center warning'>Email already exist!</span>",
									type: "warning",
									confirmButtonClass: "btn-primary btn-sm",
								});
		            			_this.text('Save and close');
			            		return false;
			            	}
			            	if (r.status == 'fail') {
			            		swal({
									title: "Error", 
									html: true,
									text: "<span class='text-center error'>Something wrong please try again!</span>",
									type: "error",
									confirmButtonClass: "btn-primary btn-sm",
								});
		            			_this.text('Save and close');
			            		return false;
			            	}

			            }
					});
				}
			});
		});
	</script>

	<!-- Profile visibility Status -->
	<script type="text/javascript">
		jQuery(document).ready(function(){

			jQuery('#change_Visistatus').on('click', function() { jQuery('#ProfileStatus').modal('show'); });

			jQuery(".visibilitys").on('click',function(){ 
				var current = jQuery(this);
				jQuery('.visibilitys').removeClass('active');
            	current.addClass('active')
			});
			
			jQuery(".profileStatus_save").on('click',function(){
				var _this = jQuery(this);
				var status = jQuery('.active').data('status');
				_this.text('Saving...').attr('disabled','disabled');
				jQuery.ajax({
		            type: 'POST',
		            dataType: 'json',
		            url:'<?php echo admin_url("admin-ajax.php");  ?>',
		            data: {
		                'action': 'visibility',
		                'status': status, 
		                'userid': <?php  echo $user_id;  ?> 
		            },
		            success: function(data){
		                if (data.success == true){
		                	if(status == 'anonymous'){
								var cstatus = 'Visible to Everyone';
							}else if (status == 'Open') {
								var cstatus = 'Recruiters Only';
							}else if (status == 'Private') {
								var cstatus = 'You’re Invisible';
							}else{
								var cstatus = 'You’re Invisible';
							}
							jQuery('.cuStatus').html(cstatus);
		                	jQuery('#ProfileStatus').modal('hide');
							_this.text('Save and close').removeAttr('disabled');
		                	swal({
								title: "Updated", 
								html: true,
								text: "<span class='text-center'>Successfully updated your Visibility.</span>",
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
		                	//jQuery.notify("Successfully update Visibility !", "success");
		                }else{
		                	swal({
								title: "Updated", 
								html: true,
								text: "<span class='text-center error'>Something wrong. Please try again!</span>",
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
		                }
		            }
			    });
			});
		});
	</script>


	<!-- Edit Profile Pic -->
	<script type="text/javascript">
		jQuery(document).ready( function() {
			
			jQuery('#editPoPic').on('click', function() {
				jQuery('#ProfilePic').modal('show');
			});


		});
	</script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.mask.min.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function($){
		    jQuery("#cell_phone").mask("999-999-9999"); 
		});
	</script>

<div class="modal fade" id="BasicInfoPoup" tabindex="-1" role="dialog" aria-labelledby="BasicInfoPoupModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close basic_in_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<img class="popup_logo" src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg">
		<h3>Name &amp; Contact Info</h3>
		<div class="clearfix"></div>
		<div class="wpcf7-form">
			<div class="form-group">
				<input type="text" class="form-control" size="40" name="ufirst_name" value="<?php echo get_user_meta($user_id,'first_name',true);  ?>" placeholder="First Name *" disabled>
			</div>
			
			<div class="form-group">
				<input type="text" aria-invalid="false" aria-required="true" class="form-control" size="40" value="<?php echo get_user_meta($user_id,'last_name',true);  ?>" name="ulast_name" placeholder="Last Name *" disabled>
			</div>
			<div class="alert_row">
				<div class="form-group">
					<input type="email" aria-invalid="false" aria-required="true" class="form-control" size="40" value="<?php echo $data->user_email;  ?>" name="uemail_address" placeholder="Email Address *" disabled>
				</div>
			</div>
			
			<div class="form-group">
				<input type="email" aria-invalid="false" aria-required="true" class="form-control" size="40" name="usecondary_email" value="<?php echo get_user_meta( $user_id, 'sec_email',true); ?>"  placeholder="Secondary Email Address">
			</div>
			<div class="alert_row">
				<div class="form-group">
					<input type="text" aria-invalid="false" aria-required="true" id="cell_phone" class="form-control" size="40" value="<?php echo get_user_meta( $user_id, 'cell_phone',true); ?>" name="ucell_phone" placeholder="Cellular Phone *">
				</div>
			</div>

			
			<div class="form-group has-feedback">
			    <label for="country_select">Distance</label>
			    <?php
			    $disVal = get_cimyFieldValue($user_id, 'JOB_SEARCH_RADIUS');
			    $disArr = array('Under 10 miles','Under 25 miles','Under 50 miles','Over 50 miles');
			    ?>
			    <select class="form-control" name="ubest_time">
				  <option value="">Select</option>
				  <?php foreach ($disArr as $value) { ?>
				  	<option <?php if($disVal == $value){ echo "selected"; } ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
				  <?php } ?>
				</select>
				<span aria-hidden="true" class="fa fa-angle-down form-control-feedback"></span>
			</div>
	      <div class="text-center" id="saveContactInfo">
	        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
	        <button type="button" class="btn btn-primary btn-sm basicinfo_status_save" >Save and close</button>
	      </div>
	  	</div>
  	  </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ProfileStatus" tabindex="-1" role="dialog" aria-labelledby="ProfileStatusModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close profileStatus_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body vscroll">
			<div class="light_box visibility" >
				<div class="sidebar_title">
					<span class="title_icon visibility_icon"></span>
					<h4>Visibility Settings</h4>
				</div>
				<?php get_template_part( 'seeker_dasboard_templates/content', 'profile_visibility' ); ?>
			</div>
  	  </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary profileStatus_save" >Save and close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ProfilePic" tabindex="-1" role="dialog" aria-labelledby="ProfilePicModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close profile_pic_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div id="proEditBody" class="modal-body vscroll cHangePic">
      	<div class="row">
	  		<div class="col-md-7">
	      	<?php 
	      		global $current_user;
	      		echo '<input type="hidden" id="user_id" value="'.$current_user->ID.'">';
				do_action('edit_user_avatar', $current_user); 
			?>
			</div>
			<div class="col-md-5">
				<p><strong>Add a professional Photo now.</strong></p>
				<p>You never get a second chance at a first impression. This photo
				will be the very first thing people see when learning about you. It
				will be used on all your forward facing graphic images seen by
				employers & recruiters.</p>
				<p><strong>We highly suggest you smile & dress to impress.</strong></p>
				<p>We would like to see you use a portrait style photo that is a least
				112 pixels hide and 150 pixels high. The photo you use muse be a
				graphic file (JPG, PNG, BMP or GIF).</p>
		  	</div>
		</div>
  	  </div>
      <div class="modal-footer text-center">
        <input type="button" name="submit" id="submit" class="button button-primary custom_update" data-dismiss="modal" value="Save">
      </div>
    </div>
  </div>
</div>
<?php get_footer('preferences'); ?>

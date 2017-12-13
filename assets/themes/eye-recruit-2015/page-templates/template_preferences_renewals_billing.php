<?php
/**
 * Template Name: (OLD) Preferences renewals-billing page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<?php
$user_id = get_current_user_id();
?>
<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

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
						<div class="section_title">
							<h3>Renewals & Billing</h3>
							<span><strong>Recruit ID</strong> : <?php echo $user_id; ?></span>
						</div>
						<div class="renewalform">
							<div class="sidebar_title cont_title">
								<h4>Membership Information</h4>
							</div>

							<?php
							global $wpdb, $pmpro_msg, $pmpro_msgt, $pmpro_levels, $current_user, $levels;
						  	$getlastpaymentdate = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_memberships_users WHERE user_id = '".$current_user->ID."' ORDER BY id DESC LIMIT 1");
						  	$getfirspaymentdate = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_memberships_users WHERE user_id = '".$current_user->ID."' ORDER BY id ASC LIMIT 1");
							if(is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel())
							{
								$current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
								$membershipLevel = $current_user->membership_level->name;
								$checkautorenew = $current_user->membership_level->cycle_number;

								if( ($getlastpaymentdate->enddate) && ( $getlastpaymentdate->enddate != '0000-00-00 00:00:00') ) {
									$expdat = date('F d, Y', strtotime($getlastpaymentdate->enddate) );
								}
								else if($getlastpaymentdate->enddate == '0000-00-00 00:00:00'){
									$expdat = "Unlimited ";
								}
								else{
									$expdat = "No data found.";
								} 
							}
							else{
								$checkautorenew = 0;
								$membershipLevel = 'No data found.';
								$expdat = "No data found.";
							}
							?>


							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label" for="membersince">You have been a member since</label>
									  <p class="help-block">
									  <?php
									  echo (($getfirspaymentdate->startdate))?date('F d, Y', strtotime($getfirspaymentdate->startdate) ) : 'No data found.';
									  ?>
									  </p>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label" for="subscriblevel">Your current subscription level</label>
									  <p class="help-block"><?php echo $membershipLevel; ?></p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label" for="expiredate">Your current expiration date</label>
									   <p class="help-block">
									   <?php echo $expdat; ?>
										</p>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<?php if($checkautorenew > 0){ ?>
										  <label class="control-label" for="autorenewon">You are set to Auto-Renew on</label>
										  <small class="help-block"><a href="javascript:void(0);" class="renewbillingpopup">Stop my subscription from renewing</a></small>
										<?php } else{ ?>
											<label class="control-label" for="autorenewon">Auto Renewal Inactive</label>
											<?php if( function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel() && ( $current_user->membership_level->initial_payment  != '0.00')){ ?>
										  		<small class="help-block"><a href="javascript:void(0);" class="renewbillingpopup">Set Up Auto Renewal Now</a></small>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label" for="lastbilledon">You were last billed on </label>
									  <p class="help-block">
									  <?php
									  echo (($getlastpaymentdate->startdate))? date('F d, Y', strtotime($getlastpaymentdate->startdate) ) : 'No data found.';
									  ?>
									  </p>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label" for="billingdate">Your next billing date will be</label>
									   <p class="help-block">
									   		<?php
										  	$paymetdate = date('Y-m-d', strtotime($getlastpaymentdate->startdate) );
										  	if( !empty($paymetdate)  ) {
										  		$memberplan = pmpro_getMembershipLevelForUser($user_id);
												$cy_number = $memberplan->cycle_number;
												$cycle_period = $memberplan->cycle_period;
										  		if ( $cy_number > 0 ) {
									  				/*$order = new MemberOrder();
													$order->getLastMemberOrder($user_id, "success");
													$lastdate = date("Y-m-d", $order->timestamp);
													$nextdate = $wpdb->get_var("SELECT UNIX_TIMESTAMP('" . $lastdate . "' + INTERVAL " . $memberplan->cycle_number . " " . $memberplan->cycle_period . ")");
													echo date('F d, Y', $nextdate); */

													$next_payment_date = pmpro_next_payment();
													// $next_payment_date = strtotime("+2 day", $next_payment_date);
													echo date('F d, Y', $next_payment_date); 

													/*if(!empty($order) && $order->gateway == "stripe")
													{
														if(!empty($pmpro_stripe_event))
														{
															//cancel initiated from Stripe webhook
															if(!empty($pmpro_stripe_event->data->object->current_period_end))
															{
																$pmpro_next_payment_timestamp = $pmpro_stripe_event->data->object->current_period_end;
															}
														}
														else
														{
															//cancel initiated from PMPro
															$pmpro_next_payment_timestamp = PMProGateway_stripe::pmpro_next_payment("", $user_id, "success");
														}
													}

													echo date('F d, Y', $pmpro_next_payment_timestamp);*/

										  			/*$next = $cy_number.' '.$cycle_period;
										  			$date = strtotime($paymetdate);
													$date = strtotime("+".$next, $date);*/
										  		}
										  		else{
													echo "No Data Found";
												}
											}
											else{
												echo "No Data Found";
											}
											?>
									   </p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label" for="transactperiod">Credits for this transaction period</label>
									  <small class="help-block">See referral status here</small>
									</div>
								</div>
							</div>
										
							
							<div class="sidebar_title cont_title">
								<h4>Credit Card & Billing Information</h4>
								<div class="title_edit"><a href="javascript:void(0);" id="save_renewals_billing"><i class="fa fa-pencil"></i> Edit</a></div>
							</div>
							<?php 
							$ccbi_cardname = get_user_meta($user_id, 'ccbi_cardname', true); 
							$ccbi_cardnumber = get_user_meta($user_id, 'ccbi_cardnumber', true); 
							$ccbi_verifycode = get_user_meta($user_id, 'ccbi_verifycode', true); 
							$ccbi_address = get_user_meta($user_id, 'ccbi_address', true); 
							$ccbi_city = get_user_meta($user_id, 'ccbi_city', true); 
							$ccbi_zip = get_user_meta($user_id, 'ccbi_zip', true); 
							$ccbi_state = get_user_meta($user_id, 'ccbi_state', true); 
							$ccbi_country = get_user_meta($user_id, 'ccbi_country', true);
							?>
							<ul class="card_billing_info">
								<li>
									<span>Name as it appears on card  : </span> 
									<label class="view_cardname"><?php echo (!empty($ccbi_cardname))? $ccbi_cardname : 'No Data Found.'; ?></label>
								</li>
								<li>
									<span>Credit Card Number  : </span> 
									<label class="view_cardnumber"><?php echo (!empty($ccbi_cardnumber))? $ccbi_cardnumber : 'No Data Found.'; ?> </label>
								</li>
								
								<li>
									<span>Verification code  : </span> 
									<label class="view_cvv"><?php echo (!empty($ccbi_verifycode))? $ccbi_verifycode : 'No Data Found.'; ?> </label>
								</li>
								
								<li>
									<span>Billing Address  : </span> 
									<label class="view_billaddress">
										<?php 
										if ( !empty($ccbi_address) ) {
											echo (!empty($ccbi_address))? $ccbi_address. ', ' : '';
											echo (!empty($ccbi_city))? $ccbi_city.', ' : '';
											echo (!empty($ccbi_state))? $ccbi_state.', ' : '';
											echo (!empty($ccbi_country))? $ccbi_country.', ' : '';
											echo (!empty($ccbi_zip))? $ccbi_zip : '';
										}
										else{
											echo 'No Data Found.';
										}
										?>
									</label>
								</li>
							</ul>
							<div class="sidebar_title cont_title">
								<h4>Transaction history & Receipts</h4>
							</div>
							<div class="table-responsive">
								<?php
								$tablename = $wpdb->prefix.'pmpro_membership_orders';
						  		$getpaymentdetail = $wpdb->get_results("SELECT * FROM $tablename WHERE user_id = '".$current_user->ID."' ORDER BY id DESC LIMIT 5");
								?>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Date</th>
											<th>Receipt id</th>
											<th>Credit card</th>
											<th>Description</th>
											<th class="text-right">Total</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										foreach ($getpaymentdetail as $value) {
											$date = date('m/d/Y', strtotime($value->timestamp) );
											$price = $value->subtotal;
											$accno = $value->accountnumber;
											$recID = $value->code;
											$uID = $value->user_id;
											$uData = get_userdata($uID);
											$uName = $uData->first_name.' '.$uData->last_name;
											$uEmail = $uData->user_email;
											?>
											<tr>
												<td class="text-center"><?php echo $date; ?></td>
												<?php /*<td class="text-center"><?php if(!empty($recID)){ ?><a href="<?php echo site_url().'/membership-invoice/?invoice='.$recID; ?>" target="_blank"><?php echo $recID; ?></a><?php } else{ echo "--"; } ?></td> */ ?>
												<td class="text-center"><?php echo (($recID))? $recID :'--'; ?></td>
												<td class="text-center"><?php echo (($accno))? $accno :'--'; ?></td>
												<td class="text-center">Order <?php echo (($recID))? '#'.$recID :''; ?>, <?php echo (($uName))? $uName :''; ?> <?php echo (($uEmail))? '('.$uEmail.')' :''; ?></td>
												<td class="text-right"><?php echo pmpro_formatPrice($price); ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="text-center"><a href="<?php echo site_url().'/transaction-history-receipts/'; ?>" class="btn btn-default">See Complete Activity</a></div>
							<div class="sidebar_title cont_title">
								<h4>Auto Renewal</h4>
							</div>
							<div class="auto_renewal">
								<p>EyeRecruit.com is all about making life easier on its members. That is why we set accounts to auto-renew. Auto-renewing your annual membership helps ensure the uninterrupted access of your Professional Profile to Employers and Recruiters who have positions that could have significant positive results on your career and financial advancement.</p>
								<p>
									If you would prefer to renew your membership on your own, you can stop auto-renew by clicking the button beloew. 
									<?php if( function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel() && ( $current_user->membership_level->initial_payment  != '0.00')){ ?>
										If you do this your account will expire on : 
										<strong>
											<?php echo (($getlastpaymentdate->enddate))?date('F dS, Y', strtotime($getlastpaymentdate->enddate) ) : 'No data found.'; ?>
										</strong>
									<?php } ?>
								</p>
								<div class="text-center">
									<?php
									$renID = 'stoprenewal';
									if ( $checkautorenew <= 0 && pmpro_hasMembershipLevel() && ( $current_user->membership_level->initial_payment  != '0.00') ) {
										$renText = 'Start Auto Renew';
										$renClass = 'btn-success';
									}
									else{
										if ( $current_user->membership_level->initial_payment  == '0.00' ) {
											$renID = 'stoprenewaloff';
										}
										$renText = 'Stop Auto Renew';
										$renClass = 'btn-primary';
									}
									?>
									<a href="javascript:void(0);" id="<?php echo $renID; ?>" class="btn <?php echo $renClass; ?>" ><?php echo $renText; ?></a>
									<a href="javascript:void(0);" class="btn btn-default">Cancel</a>
								</div>
							</div>

							<div class="sidebar_title cont_title">
								<h4>Cancel Your Membership</h4>
							</div>
								<?php
								$mlevels= pmpro_getMembershipLevelForUser($user_id);

								?>
							<div class="cancel_membership" plan="<?php echo $mlevels->name; ?>">
								<?php

								if($mlevels->id == 1){
									echo "<p>Currently you have a BASIC(free) membership plan.</p>";
								}
								else if ( pmpro_hasMembershipLevel() ) { ?>
										<p>The information you are about to view requires the use of a password to modify. To continue please enter your password.</p>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
												  <label class="control-label" for="cancepalnpassword">Enter Password</label>
												  <input type="password" class="form-control" id="cancepalnpassword" name="cancepalnpassword" aria-describedby="helpBlock2">
												  <!-- <a href="#" class="help-block">Forgot my password</a> -->
												</div>
											  	<div id="actionmsg"></div>
											</div>
											<div class="col-sm-6">
												<div class="text-center"><button id="cancepalncont" class="btn btn-primary">Continue</button></div>
											</div>
										</div>
									<?php
								}

								
								else{
									echo "<p>Currently you don't have any membership.</p>";
								}
								?>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php get_footer('preferences'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery('#cancepalncont').on('click', function() {
			var pass = jQuery('#cancepalnpassword').val();
			if ( pass == '' ) {
				jQuery('#actionmsg').html("<label class='error'>Please enter your password.</label>");
			}
			else{
				jQuery('#cancepalncont').attr('disabled', 'disabled').html('Please Wait...');
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url("admin-ajax.php"); ?>',
					dataType: 'json',
					data: {
						action: 'cancelMembershipAjaxAction',
						pass: pass
					},
					success: function(res){
						if (  res.msg == 'success' ) {
							var plan=jQuery('.cancel_membership').attr('plan');
							jQuery('#cancepalncont').removeAttr('disabled').html('Continue');
							jQuery('.cancel_membership').html('<p>Your recent plan '+plan+' has been canceled,currently you have a BASIC(free) membership plan.</p>');

							swal({
								title: "Success", 
								html: true,
								text: "<span class='text-center'>Successfully cancel your membership.</span>",
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
						}
						else{
							jQuery('#actionmsg').html(res.msg);
							jQuery('#cancepalncont').removeAttr('disabled').html('Continue');
						}
					}
				});
			}
		});

		jQuery('#save_renewals_billing').on('click', function() {
			jQuery('#cradit_card_renewals_billing').modal('show');
		});

		/*jQuery.validator.addMethod("exactlength", function(value, element, param) {
		 return this.optional(element) || value.length == param;
		}, "Please enter exactly {0} characters.");*/

		jQuery("#ccbi_info").validate({
			rules:{
				name_on_card:{
					 required:true
				},
				card_number:{
					required:true,
					number:true,
				},
				verifi_code:{
					required:true,
					number:true,

				},
				billing_address:{
					required:true
				},
				billing_city:{
					required:true
				},
				billing_zip:{
					required:true,
					number:true
				},
				billing_state:{
					required:true
				},
				billing_country:{
					required:true
				}

			},
			messages:{
				name_on_card:{
					required:"Please enter name as it appears on card."
				},
				card_number:{
					required:"Please enter card number.",
					number:"Please enter valid card number.",
				},
				verifi_code:{
					required:"Please enter verification code.",
					number:"Please enter valid verification code."
				},
				billing_address:{
					 required:"Please enter your billing address."
				},
				billing_city:{
					required:"Please enter your city."
				},
				billing_zip:{
					required:"Please enter Zip code.",
					number:"Please enter valid zip code."
				},
				billing_state:{
					required:"Please enter your state."
				},
				billing_country:{
					required:"Please select your country."
				}
			},
			submitHandler: function(form) {
				var name_on_card = jQuery('input[name="name_on_card"]').val();
				var card_number = jQuery('input[name="card_number"]').val();
				var verifi_code = jQuery('input[name="verifi_code"]').val();
				var billing_address = jQuery('input[name="billing_address"]').val();
				var billing_city = jQuery('input[name="billing_city"]').val();
				var billing_zip = jQuery('input[name="billing_zip"]').val();
				var billing_state = jQuery('input[name="billing_state"]').val();
				var billing_country = jQuery('select[name="billing_country"]').val();

				jQuery('#savebillbutton').attr('disabled', 'disabled').html('Please Wait...');
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url("admin-ajax.php"); ?>',
					dataType: 'json',
					data: {
						action: 'saveCreditAndBillingInfo',
						'name_on_card': name_on_card,
						'card_number': card_number,
						'verifi_code': verifi_code,
						'billing_address': billing_address,
						'billing_city': billing_city,
						'billing_zip': billing_zip,
						'billing_state': billing_state,
						'billing_country': billing_country,
					},
					success: function(res){
						if ( res.msg == 'success' ) {
							jQuery('#savebillbutton').removeAttr('disabled').html('Save and Close');
							//str.slice(-2);
							jQuery('#cradit_card_renewals_billing').modal('hide');
							jQuery('.view_cardname').html(name_on_card);
							jQuery('.view_cardnumber').html(card_number);
							jQuery('.view_cvv').html(verifi_code);
							jQuery('.view_billaddress').html(billing_address +', '+ billing_city +', '+ billing_state +', '+ billing_country +', '+ billing_zip);
							swal({
								title: "Success", 
								html: true,
								text: "<span class='text-center'>Successfully update Credit Card & Billing Information.</span>",
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
						}
						else{
							jQuery('#savebillbutton').removeAttr('disabled').html('Save and Close');
						}
					}
				});
            	
        	}
		});
	});
</script>

<div class="modal fade" id="cradit_card_renewals_billing" tabindex="-1" role="dialog" aria-labelledby="RenewalsbillingPoupModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close basic_in_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<img class="popup_logo" src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg">
		<h3>Credit Card & Billing Information</h3>
		<div class="clearfix"></div>
		<form id="ccbi_info" method="POST">
			<div class="wpcf7-form">

				<div class="form-group">
					<label for="name_on_card">Name as it appears on card<span>*</span> </label>
					<input type="text" class="form-control" name="name_on_card" value="<?php echo get_user_meta($user_id, 'ccbi_cardname', true); ?>" placeholder="Name as it appears on card*">
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="card_number">Credit Card Number<span>*</span> </label>
							<input type="text" class="form-control" value="<?php echo get_user_meta($user_id, 'ccbi_cardnumber', true); ?>" name="card_number" placeholder="Credit Card Number*">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="verification_code">Verification code<span>*</span> </label>
							<input type="text" class="form-control" value="<?php echo get_user_meta($user_id, 'ccbi_verifycode', true); ?>" name="verifi_code" placeholder="Verification code*">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="billing_address">Billing Address<span>*</span> </label>
							<input type="text" class="form-control" name="billing_address" value="<?php echo get_user_meta($user_id, 'ccbi_address', true); ?>"  placeholder="Billing Address*">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="billing_city">Billing City<span>*</span> </label>
							<input type="text" class="form-control" value="<?php echo get_user_meta($user_id, 'ccbi_city', true); ?>" name="billing_city" placeholder="Billing City*">
						</div>
					</div>
				</div>

				<div class="row">
				    <div class="col-sm-6">
						<div class="form-group">
							<label for="billing_zip">Billing Zip<span>*</span> </label>
							<input type="text" class="form-control" value="<?php echo get_user_meta($user_id, 'ccbi_zip', true); ?>" name="billing_zip" placeholder="Billing Zip*">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="billing_state">Billing State<span>*</span> </label>
							<input type="text" class="form-control" value="<?php echo get_user_meta($user_id, 'ccbi_state', true); ?>" name="billing_state" placeholder="Billing State*">
						</div>
					</div>
				</div>
				
				<div class="form-group has-feedback">
					<label for="country_select">Country<span>*</span></label>
					<select name="billing_country" class="">
						<?php
                        global $pmpro_countries, $pmpro_default_country;
                        $bcountry = get_user_meta($user_id, 'ccbi_country', true);
                        if(!$bcountry){
                            $bcountry = $pmpro_default_country;
                        }
                        else{
                        	$bcountry = $bcountry;
                        }

                        foreach($pmpro_countries as $abbr => $country)
                        {
                            ?>
                            <option value="<?php echo $abbr?>" <?php if($abbr == $bcountry) { ?>selected="selected"<?php } ?>><?php echo $country?></option>
                            <?php
                        }
                        ?>
					</select>	
					<span aria-hidden="true" class="fa fa-angle-down form-control-feedback"></span>
				</div>
					
			    <div class="text-center" id="save_cradit_card_billing">
			        <button type="submit" class="btn btn-primary btn-sm cradit_card_renewals_billing" id="savebillbutton">Save and close</button>
			    </div>
		  	</div>
		 </form>
  	  </div>
    </div>
  </div>
</div>

<div class="modal fade stop-renewal-modal" id="stopautorenewal" tabindex="-1" role="dialog" aria-labelledby="stopautorenewalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body vscroll">
	      	<!-- <button type="button" class="close profile_pic_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
	    	<img src="<?php echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			<h3>Automatic Membership Renewal</h3>
			<div class="clearfix"></div>
			<div id="autorenewaltext">
				<?php

				$memberplan = pmpro_getMembershipLevelForUser($user_id);
				$paln_id = $memberplan->id;
				$initial_payment = $memberplan->initial_payment;
				$cycle_number = $memberplan->cycle_number;
				
				if ( $cycle_number > 0 ) { ?>
			        <p class="text-left"><strong>Your automatic membership renewal will be canceled immediately</strong> after clicking submit. We're disappointed that this automatic feature didn't prove beneficial in saving you time and hassle, but we thank you for giving the service a try.</p>
			        <p class="text-left">If you have any second thoughts about discontinuing you auto renewal and would like to reactivate the auto renewal feature, just select the button to begin auto renewal or give us a call at 1-855-899-9500 or reach out to our customer service team <a href="<?php echo site_url(); ?>/contact">here</a>.</p>
			        <p class="text-left">Thanks again for trying. We'll be here if you ever want to give it another shot. A confirmation email will be sent to you shortly. </p>
		        	<p class="text-center"><button type="button" class="btn btn-primary btn-sm" id="submitstopautorenw" >Submit</button></p>
		        	<p class="text-center">Or <a href="javascript:void(0);" class="countautorenewal" data-dismiss="modal" aria-label="Close">Never mind, I'll keep annual auto renewal active.</a></p>
	  	  		<?php } else { ?>
			        <p class="text-left"><strong>Your automatic membership renewal will be start immediately</strong> after clicking submit.</p>
		        	<p class="text-center"><button type="button" class="btn btn-primary btn-sm" id="submitstartautorenw" >Submit</button></p>
		        	<p class="text-center">Or <a href="javascript:void(0);" class="countautorenewal" data-dismiss="modal" aria-label="Close">I'll keep auto renewal off.</a></p>
	  	  		<?php } ?>
	  	  	</div>
  	  </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('#stoprenewal, .renewbillingpopup').on('click', function() {
			jQuery('#stopautorenewal').modal('show');
		});

		jQuery('#submitstopautorenw').on('click', function() {
			var _this = jQuery(this);
			_this.html('Please Wait...').attr('disabled', 'disabled');
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url("admin-ajax.php"); ?>',
				dataType: 'json',
				data: {
					action: 'ajaxstopautorenewal',
					'user_id': '<?php echo $user_id; ?>'
				},
				success: function(res){
					jQuery('#stopautorenewal').modal('hide');
					_this.html('Submit').removeAttr('disabled');
					if ( res == 'success' ) {
						/*jQuery('#autorenewaltext').html('<p class="text-left">Your automatic membership renewal already canceled.</p><p class="text-center"><button type="button" class="btn btn-primary btn-sm" id="alreadystop" data-dismiss="modal" aria-label="Close">Close</button></p>');
						*/
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>Successfully canceled your automatic membership renewal.</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						},
						function(isConfirm) {
		  					if (isConfirm) {
		  						var pageId = '<?php echo get_the_ID(); ?>';
		  						window.location.href = '<?php echo get_the_permalink('+pageId+'); ?>';
		  					}
		  				});
					}
					else{
						swal({
							title: "Error", 
							html: true,
							text: "<span class='text-center'>Something wrong. Please try again!</span>",
							type: "error",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				}
			});
		});

		jQuery('#submitstartautorenw').on('click', function() {
			var _this = jQuery(this);
			_this.html('Please Wait...').attr('disabled', 'disabled');
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url("admin-ajax.php"); ?>',
				dataType: 'json',
				data: {
					action: 'ajaxstartautorenewal',
					'user_id': '<?php echo $user_id; ?>'
				},
				success: function(res){
					jQuery('#stopautorenewal').modal('hide');
					_this.html('Submit').removeAttr('disabled');
					if ( res == 'success' ) {
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>Successfully start your automatic membership renewal.</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						},
						function(isConfirm) {
		  					if (isConfirm) {
		  						var pageId = '<?php echo get_the_ID(); ?>';
		  						window.location.href = '<?php echo get_the_permalink('+pageId+'); ?>';
		  					}
		  				});
					}
					else{
						swal({
							title: "Error", 
							html: true,
							text: "<span class='text-center'>Something wrong. Please try again!</span>",
							type: "error",
							confirmButtonClass: "btn-primary btn-sm",
						});
					}
				}
			});
		});
	});
</script>
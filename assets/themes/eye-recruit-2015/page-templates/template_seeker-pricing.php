 <?php
/**
 * Template Name: Seeker Pricing
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header('loginpage'); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

<?php while ( have_posts() ) : the_post(); 
	global $wpdb, $current_user, $pmpro_currency_symbol;
	$getPmproLevels_prefix = $wpdb->prefix.'pmpro_membership_levels';
	$levelmeta_prefix = $wpdb->prefix.'pmpro_membership_levelmeta';
	$getPmproLevels = pmpro_getAllLevels(false, true);
	$levelArray = array();
	foreach ($getPmproLevels as $level) {
		$levelmeta = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'selectusertype' AND meta_value = 'candidate' " );
		if ( ((!empty($levelmeta->meta_value)) && ($level->expiration_period == 'Month')) || ($level->initial_payment == '0.00')  ) {
			$levelArray[] = $level->id;
		}
	}
	?>

	<div id="primary" class="content-area">
		<div id="content" role="main">
			<section class="pricing_page">
				<div class="container">
					<header class="pricing_header">
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<a href="<?php echo site_url();  ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/pricing_logo.png" class="img-responsive" alt="pricing_logo"></a>
							</div>
							<div class="col-md-5 col-sm-4"><h2>NO RISK.  NO HIDDEN FEES.  NO MINIMUMS.</h2></div>
							<div class="col-md-3 col-sm-4">
								<a href="javascript:void(0);" data-toggle="modal" data-target="#prices_lock" class="prices_lock">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/prices_lock.png" class="img-responsive" alt="pricing_logo">
									<p>Lock in these prices for <br>your entire career now!</p>
								</a>
							</div>
						</div>
					</header>
					<div id="loaders" class="filter_loader loader inner-loader"></div>
					<div class="seeker_pricing">

						<!-- <div class="checkbox-slider--b">
							<label>
								<span>Pay Once <br>Yearly Pricing</span>
								<input type="checkbox" name="pricingType" <?php //if( ( in_array($current_user->membership_level->ID, $levelArray) ) || empty($current_user->membership_level->ID) ){  }else{ echo "checked"; } ?> ><span>Pay Each <br>Month Pricing</span>
							</label>
						</div> -->
						<?php
						//echo $current_user->membership_level->ID; 
						//print_r($levelArray);
						 ?>
						<div class="checkbox-slider--cc">
							<div id="first" class="radio radio_active">
								<label>
									<input type="radio" name="pricingcheck" value="1" <?php //if( ( in_array($current_user->membership_level->ID, $levelArray) ) || empty($current_user->membership_level->ID) ){  }else{ echo "checked"; } ?>>
									<span>Pay Each <br>Month Pricing</span>
								</label>
							</div>
							<div class="radio" id="secound">
								<label>
									<input type="radio" name="pricingcheck" value="2" checked>
									<span>Pay Once <br>Yearly pricing</span>
								</label>
							</div>
						</div>

						<div class="row" id="seekerPricingList">
							<?php
							$countno = 1;
							foreach ($getPmproLevels as $level) {
								$levelmeta = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'selectusertype' AND meta_value = 'candidate' " );
								$levelOtherDesc = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'other_desc'" );
								$plan_image = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'plan_image'" );
								$other_text_after_price = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'other_text_after_price'" );
								if ( ((!empty($levelmeta->meta_value)) && ($level->expiration_period == 'Month')) || ($level->initial_payment == '0.00')  ) { 
									
									$leveprice = (($level->initial_payment == '0.00')) ? '<h4><big>Free</big></h4>' : '<h4>'.$pmpro_currency_symbol.' <big>'.$level->initial_payment.'</big><small>/ Month</small></h4>'; 

									/*.$level->expiration_period.*/
									?>

									
									<div class="col-md-3 col-sm-6 col-xs-6 devicefull">
										<div class="sprice_col <?php echo (($countno == 3)) ? 'popular_pricing ' : ' '; echo ( (is_user_logged_in()) && ( $current_user->membership_level->ID == $level->id) )? 'sprice_active' : ''; ?> ">
											<?php echo (($countno == 3)) ? '<span class="popular_badge">Most Popular</span>' : ''; ?>
											<h3><?php echo $level->name; ?></h3>
											<div class="spricecol_box">
												<?php if ( !empty($plan_image->meta_value) ) { ?>
													<img src="<?php echo $plan_image->meta_value; ?>" class="img-respoinsive">
												<?php } else { ?>
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/seeker_basicicon.jpg" class="img-respoinsive">
												<?php } ?>
												<?php echo $leveprice; ?>
												<?php echo $other_text_after_price->meta_value;  ?>
											</div>
											<?php echo $levelOtherDesc->meta_value; ?>
											<?php if ( (is_user_logged_in()) && ( $current_user->membership_level->ID == $level->id ) ) { ?>									 	
												<a href="javascript:void(0);" class="btn btn-success current-plan">Current Plan</a>
											<?php } else{ 
												$user_id = get_current_user_id();
												$membershipUser = $wpdb->prefix.'memberships_users';
												$checkUserMember = $wpdb->get_var("SELECT COUNT(id) FROM eyecuwp_pmpro_memberships_users WHERE user_id = '".$user_id."' ");
												if ( $checkUserMember <= 0 ) {
													$buttonText = 'Get Started';
												}
												else if($level->initial_payment == '0.00'){
													$buttonText = 'Downgrade Plan';
												}
												else{
													$buttonText = 'Upgrade Now';
												}
												?>
												<a href="<?php  echo site_url();  ?>/membership-checkout/?level=<?php echo $level->id; ?>" class="btn btn-success"><?php echo $buttonText; ?></a>
											<?php } ?>
										</div>
									</div> <?php 
									$countno++;
								} 
							} ?>
						</div>
						<h2 class="text-center">Find The Plan That Works For You.</h2>
						<p class="text-right">* Calculated using the shown monthly and annual costs using a 31 day month.</p>
					</div>
				</div>
			</section>
				
		</div><!-- #content -->
	</div><!-- #primary -->
<?php endwhile; ?>
<?php get_footer('preferences'); ?>

<script type="text/javascript">
	function seekerPricing(){
		//alert(jQuery('input[name="pricingcheck"]:checked').val());
		if ( jQuery('input[name="pricingcheck"]:checked').val() == 2 ) {
			var plan = 'annual';
			jQuery("#secound").addClass('radio_active');
			jQuery("#first").removeClass('radio_active');
		}
		else{
			var plan = 'monthly';
			jQuery("#first").addClass('radio_active');
			jQuery("#secound").removeClass('radio_active');
		}
		jQuery('#loaders').show();
		jQuery.ajax({
			type: 'POST',
			url: '<?php echo admin_url("admin-ajax.php");  ?>',
			data: {
				action: 'seekerPricingPlanType', //Action in inc/edit_basic_info.php
				plan: plan
			},
			success: function(data){
				jQuery('#seekerPricingList').html(data);
				jQuery('#loaders').hide();
			}
		});
	}
	jQuery(document).ready( function() {
		seekerPricing();
		jQuery('input[name="pricingcheck"]').on('click', function() {
			seekerPricing();
		});
	});
</script>

<!-- Modal -->
<div class="modal fade" id="prices_lock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!-- <div class="clearfix"></div> -->
        <form id="tell_us_abt_prblm" class="wpcf7-form plock_popup">
			<div class="text-center">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/prices_lock.png" class="img-responsive" alt="pricing_lock">
		    </div>
			<p>To show our appreciation to those in our community, we offer a Price Lock Guarantee. <span>The cost of your membership will never increase</span> from the day you sign up as a user... as long as you have never canceled or lost your membership privileges and all your payments have been continuously made. If you neglect your account and fail to keep current, your monthly and yearly membership pricing will be as advertised at the time of purchase.</p>
			<p>Sincerely</p>
			<p>Christopher Bauer <br>Founder & Lead Recruiter <br>EyeRecruit, Inc.</p>
		</form>
  	  </div>
    </div>
  </div>
</div>
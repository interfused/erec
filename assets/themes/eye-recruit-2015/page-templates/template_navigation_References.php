<?php
/**
 * Template Name: Navigation References page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>
<?php 

	if ( !is_user_logged_in() ) {
		$url = site_url();
		echo wp_redirect($url);
	}

$userID = get_current_user_id();
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

 	$accessEmp = get_cimyFieldValue($userID, 'PNA_REFERENCED');
	$accessRec = get_cimyFieldValue($userID, 'PNAR_REFERENCED');
	if ( in_array( 'candidate', $current_user->roles) ){
		if ( $accessEmp == 'Yes' ) {
			$view = 'allow';
		}
		$breadcrumbUrl = '/job-seekers/seeker-profile-view/';
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
			<section class="navigations">
				<div class="section_title">
					<h3>References <?php echo $breadText; ?></h3>
					<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
				</div>
				<?php
					global $wpdb;
					$tablename = $wpdb->prefix.'reference_now';
					$select = $wpdb->get_results("SELECT * FROM $tablename WHERE user_id = '".$userID."' ORDER BY id DESC");
					$countref = count($select);	
				 ?>
				<div class="row indent">
					<div class="col-md-9">
						<ol class="breadcrumb">
						  <li><a href="<?php echo site_url().$breadcrumbUrl; ?>">Home</a></li>
						  <li class="active">References <?php echo $breadText; ?></li>
						</ol>

						<?php if($view == 'allow'){ ?>
							<div class="search_bar">
								<p><?php echo $cand_name." ".$verb; ?> stored <span id="counttotalref" count="<?php echo $countref; ?>"><?php echo $countref; ?></span> Reference(s)</p>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="row indent network_list indent">
					<div class="col-md-9">
						<?php if($view == 'allow'){ ?>
							<div class="row" id="inv_frn_n_coll">
									<?php 
									foreach ($select as $value) {
											$ref_id = $value->id;
											$value = unserialize($value->ref_detail);
										?>
										<div class="col-md-6" id="refralno<?php echo $ref_id; ?>">
											<article>
												<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/EyeRecruit_Avitar.jpg" class="img-responsive">
												<div class="article_content">
													<h4>Hello! <br>My Name is <br><?php echo $value['fname'].' '.$value['lname']; ?></h4>
													<ul class="network_list_info">
														<li class="cu_wordwrap"><span>Email : </span><br><strong><?php echo $value['Email']; ?></strong></li>
														<li>
															<span>Status : </span><br>
															<?php 
																if( email_exists($value['Email']) ){ ?>
																	<strong>Join</strong><?php
																}else{ ?>
																	<strong>Not Join</strong><?php
																}
															?>	
														</li>
													</ul>
												</div>
												<div class="clearfix"></div>
												<div class="article_footer">
													<div class="checkbox">
														<?php if ( in_array( 'candidate', $current_user->roles) && !isset($_REQUEST['recruitID']) ){ ?>
															<label>
																<input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_id; ?>" type="checkbox"> 
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
					<div class="col-md-3">
						<?php 
						$pageID = get_the_ID(); 
						$roafar = get_post_meta($pageID, 'reach_out_ask_for_a_referral_now_content', true); 
						$hiw = get_post_meta($pageID, 'how_it_works', true); 
						$mt = get_post_meta($pageID, 'member_tip', true); 
						?>
						
						<?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>

							<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> REFERENCE CHECKING</h5>
									<p>Checking references is critical to making a final decision between candidates and it also helps Hiring Managers, HR personnel and Recruiters better understand how the potential new employee might transition into the new role.  It’s more than looking for “dirt” or confirming something you already know. The goal it to make a positive distinction among candidates.</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>GATHERING REFERENCES</h5>
									<p>Our goal in automating this process is for you to be able to reach out to their professional network, with pre-approval, and for the Candidate to provide interested Employers immediate access to reference names, phone numbers and how they know each other professionally.  Ideally you will be able to choose which reference you would like to confirm this candidates skills, track record and competencies, and even discuss their role within the organization, specific responsibilities & performance. </p>
								</div>


						<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>


   							<?php   if ( isset($_REQUEST['recruitID']) ) { ?>

   								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> REFERENCE CHECKING</h5>
									<p>Checking references is critical to making a final decision between candidates and it also helps Hiring Managers, HR personnel and Recruiters better understand how the potential new employee might transition into the new role.  It’s more than looking for “dirt” or confirming something you already know. The goal it to make a positive distinction among candidates.</p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>GATHERING REFERENCES</h5>
									<p>Our goal in automating this process is for you to be able to reach out to their professional network, with pre-approval, and for the Candidate to provide interested Employers immediate access to reference names, phone numbers and how they know each other professionally.  Ideally you will be able to choose which reference you would like to confirm this candidates skills, track record and competencies, and even discuss their role within the organization, specific responsibilities & performance. </p>
								</div>

								<?php  }else{  ?>

									<div class="special_box navi_thumbnail">
										<h5>Reach out & ask for a Reference Now</h5>
										<p><?php echo (($roafar))? $roafar : 'Data not found'; ?></p>
										<a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reach_out_n_ask_fr_References">Ask Now</a>
									</div>
							
									<div class="special_box navi_thumbnail">
										<h5>How it Works</h5>
										<p><?php echo (($hiw))? $hiw : 'Data not found'; ?></p>
									</div>
									<?php member_navigation_sidebar_tips_function('seeker_references'); ?>

								<?php } ?>
							
							<?php  }else { ?>

							<div class="special_box navi_thumbnail">
								<h5>Reach out & ask for a Reference Now</h5>
								<p><?php echo (($roafar))? $roafar : 'Data not found'; ?></p>
							</div>
					
							<div class="special_box navi_thumbnail">
								<h5>How it Works</h5>
								<p><?php echo (($hiw))? $hiw : 'Data not found'; ?></p>
							</div>
							<?php member_navigation_sidebar_tips_function('seeker_references'); ?>

							<?php } ?>
					</div>
				</div>
			</section>
		</div><!-- #content -->
		
		<?//php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
<!-- Modal for start now -->
<div class="modal fade" id="reach_out_n_ask_fr_References" tabindex="-1" role="dialog" aria-labelledby="reach_out_n_ask_fr_ReferralLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content recommendation_popup">
      <!-- <div class="modal-header">
      </div> -->
      <div class="modal-body">
        <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Reach Out for a Reference</h3>
        <div class="clearfix"></div>
        <form class="wpcf7-form">
	      	<div id="userdetail_all_fields">
					<div id="userdetail_pr" class="edit-main-dv form-group row">
						<div class="col-sm-4">
							<label class="control-label" for="fname">First Name: *</label><br />
							<input id="fname" class="regular-text code form-control" name="fname[]" type="text" />
						</div>
						<div class="col-sm-4">
							<label class="control-label" for="lname">Last Name: *</label><br />
							<input id="lname" class="regular-text code form-control" name="lname[]" type="text" />
						</div>
						<div class="col-sm-4">
							<label class="control-label" for="Company">Company: *</label><br />
							<input id="Company" class="regular-text code form-control" name="Company[]" type="text" />
						</div>
					</div>
					<div id="userdetail_pr" class="edit-main-dv form-group row">
						<div class="col-sm-4">
							<label class="control-label" for="Position">Position: *</label><br />
							<input id="Position" class="regular-text code form-control" name="Position[]" type="text" />
						</div>
						<div class="col-sm-4">
							<label class="control-label" for="Telephone">Telephone: *</label><br />
							<input id="Telephone" class="regular-text code form-control" name="Telephone[]" type="text" />
						</div>
						<div class="col-sm-4">
							<label class="control-label" for="Email">Email Address: *</label><br />
							<input id="Email" class="regular-text code form-control" name="Email[]" type="text" />
						</div>
					</div>
					<div id="userdetail_pr" class="edit-main-dv form-group row">
						<div class="col-sm-6">
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
						<div class="col-sm-6">
							<label class="control-label" for="Years">Years know each other:</label><br />
							<input id="Years" class="regular-text code form-control" name="Years[]" type="text" />
						</div>
					</div>
					<!-- <div class="edit-main-dv form-group">
						<label class="control-label" for="user_email">Notations:</label><br />
						<textarea name="notation[]" class="form-control cust_textarea" id="Notations"></textarea>
					</div> -->
			</div>
			<p class="remove_btn">
				<a id="userdetail_add_more" count="1" class="userdetail_add_more">+ Add More Recipients</a>
			</p>
			<div class="form-group">
				<label class="control-label" for="user_msg">Your Message:</label><br />
				<textarea id="user_msg" class="regular-text code form-control" name="user_msg" readonly>
Hello < >,

As you know I am looking to better myself and my financial future with positive career opportunities. I am working with a Recruiter and I have been asked to get all of my career documents in order. I would really assist me when dealing with a potential employer if you could provide me with a reference that I can provide if requested.

Please take a minute and follow the link provided in this email to confirm the infomation I have provided a for my career profile.

This is really helps me out. Thank you.

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
        	<button id="reach_out_n_ask" type="button" class="btn btn-success btn-sm">Send Now</button>
        	</div>
		</form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

	jQuery(document).ready(function(){
	 	//for email validation
		function validEmail(v) {
		    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
		    return (v.match(r) == null) ? false : true;
		}
		function validPhone(v) {
		    var p = new RegExp("1?\W*([2-9][0-8][0-9])\W*([2-9][0-9]{2})\W*([0-9]{4})(\se?x?t?(\d*))?");
		    return (v.match(p) == null) ? false : true;
		}


		jQuery('.userdetail_add_more').live('click', function(){

            var ln_no = jQuery(this).attr('count');

            var count = parseInt(ln_no)+1;

         /*   jQuery("#userdetail_all_fields").append('<div id="userdetail_pr_'+count+'" class="edit-main-dv form-group row"><div class="col-sm-4"><label class="control-label" for="fname">First Name:</label><br /><input id="fname_'+count+'" class="regular-text code form-control" name="fname[]" type="text" /></div><div class="col-sm-4">	<label class="control-label" for="lname">Last Name:</label><br /><input id="lname_'+count+'" class="regular-text code form-control" name="lname[]" type="text" /></div><div class="col-sm-4"><label class="control-label" for="user_email">Email Address:</label><br /><input id="user_email_'+count+'" class="regular-text code form-control" name="user_email[]" type="text" /></div></div><span class="remove_edu btn btn-default btn-sm pull-right" id="remove_edu_'+count+'" rel="'+count+'">remove</span><div class="clearfix"></div>');*/
            jQuery("#userdetail_all_fields").append('<div id="abc"><div id="userdetail_pr'+count+'" class="edit-main-dv form-group row"><div class="col-sm-4"><label class="control-label" for="fname">First Name: *</label><br /><input id="fname_'+count+'" class="regular-text code form-control" name="fname[]" type="text" /></div><div class="col-sm-4"><label class="control-label" for="lname">Last Name: *</label><br /><input id="lname_'+count+'" class="regular-text code form-control" name="lname[]" type="text" /></div><div class="col-sm-4"><label class="control-label" for="Company">Company: *</label><br /><input id="Company_'+count+'" class="regular-text code form-control" name="Company[]" type="text" /></div></div><div id="userdetail_pr" class="edit-main-dv form-group row"><div class="col-sm-4"><label class="control-label" for="Position">Position: *</label><br /><input id="Position_'+count+'" class="regular-text code form-control" name="Position[]" type="text" /></div><div class="col-sm-4"><label class="control-label" for="Telephone">Telephone: *</label><br /><input id="Telephone_'+count+'" class="regular-text code form-control" name="Telephone[]" type="text" /></div><div class="col-sm-4"><label class="control-label" for="Email">Email Address: *</label><br /><input id="Email_'+count+'" class="regular-text code form-control" name="Email[]" type="text" /></div></div><div id="userdetail_pr_'+count+'" class="edit-main-dv form-group row"><div class="col-sm-6"><label class="control-label" for="Relationship">Relationship: *</label><br /><select id="Relationship" name="Relationship[]"><option value="">---Selection---</option><option value="Colleague">Colleague</option><option value="Direct Supervisor">Direct Supervisor</option><option value="Direct Manager">Direct Manager</option><option value="Business Partner">Business Partner</option><option value="Mentor/Mastermind">Mentor/Mastermind</option><option value="Friend/Relative">Friend/Relative</option></select></div><div class="col-sm-6"><label class="control-label" for="Years">Years know each other:</label><br /><input id="Years_'+count+'" class="regular-text code form-control" name="Years[]" type="text" /></div></div><span class="remove_edu btn btn-default btn-sm pull-right" id="remove_edu_'+count+'" rel="'+count+'">remove</span><div class="clearfix"></div></div>');
            jQuery(this).attr('count', count);
        });


        jQuery('.remove_edu').live('click', function(){
            var rel = jQuery(this).attr('rel');
            jQuery("#abc").remove();
           // jQuery('#userdetail_pr_'+rel).remove();
            //jQuery('#remove_edu_'+rel).remove();
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
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="Email[]"]', function() {
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

		//for company name validation
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="Company[]"]', function() {
			var company_val = jQuery(this).val();
			var company_id = jQuery(this).attr('id');
			jQuery('#'+company_id+'-error').remove();

			if ( company_val == '' ) {
				jQuery('<label id="'+company_id+'-error" class="error send_mail_error" for="'+company_id+'">Comapany name is required.</label>').insertAfter(this);
			}
			else{
				jQuery('#'+company_id+'-error').remove();
			}

		}); 

		// for position validation
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="Position[]"]', function() {
			var position_val = jQuery(this).val();
			var position_id = jQuery(this).attr('id');
			jQuery('#'+position_id+'-error').remove();

			if ( position_val == '' ) {
				jQuery('<label id="'+position_id+'-error" class="error send_mail_error" for="'+position_id+'">Position is required.</label>').insertAfter(this);
			}
			else{
				jQuery('#'+position_id+'-error').remove();
			}

		}); 

		// for Telephone validation
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="Telephone[]"]', function() {
			var Telephone_val = jQuery(this).val();
			var Telephone_id = jQuery(this).attr('id');
			jQuery('#'+Telephone_id+'-error').remove();

			if ( Telephone_val == '' ) {
				jQuery('<label id="'+Telephone_id+'-error" class="error send_mail_error" for="'+Telephone_id+'">Phone number is required.</label>').insertAfter(this);
			}
			else if ( !validPhone(Telephone_val) ) {
				jQuery('<label id="'+Telephone_id+'-error" class="error send_mail_error" for="'+Telephone_id+'">Please enter a valid Phone number.</label>').insertAfter(this);
			} 
			else{
				jQuery('#'+Telephone_id+'-error').remove();
			}
		});

		//Relationship validation
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
			jQuery('input[name="Company[]"]').each( function() {

				var Company_val = jQuery(this).val();
				var Company_id = jQuery(this).attr('id');

				if ( Company_val == '' ) {
					jQuery('<label id="'+Company_id+'-error" class="error send_mail_error" for="'+Company_id+'">Company name is required.</label>').insertAfter(this);
				}
			});
			jQuery('input[name="Position[]"]').each( function() {

				var Position_val = jQuery(this).val();
				var Position_id = jQuery(this).attr('id');

				if ( Position_val == '' ) {
					jQuery('<label id="'+Position_id+'-error" class="error send_mail_error" for="'+Position_id+'">Position  is required.</label>').insertAfter(this);
				}
			});

			jQuery('input[name="Telephone[]"]').each( function() {
				var Telephone_val = jQuery(this).val();
				var Telephone_id = jQuery(this).attr('id');

				if ( Telephone_val == '' ) {
					jQuery('<label id="'+Telephone_id+'-error" class="error send_mail_error" for="'+Telephone_id+'">Telephone is required.</label>').insertAfter(this);

				}
				else if ( !validPhone(Telephone_val) ) {
					jQuery('<label id="'+Telephone_id+'-error" class="error send_mail_error" for="'+Telephone_id+'">Please enter a valid Telephone address.</label>').insertAfter(this);
				}  
			});

			jQuery('input[name="Email[]"]').each( function() {
				var Email_val = jQuery(this).val();
				var Email_id = jQuery(this).attr('id');

				if ( Email_val == '' ) {
					jQuery('<label id="'+Email_id+'-error" class="error send_mail_error" for="'+Email_id+'">Email is required.</label>').insertAfter(this);

				}
				else if ( !validEmail(Email_val) ) {
					jQuery('<label id="'+Email_id+'-error" class="error send_mail_error" for="'+Email_id+'">Please enter a valid Email address.</label>').insertAfter(this);
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
				
				var fname = [];
				jQuery('input[name="fname[]"]').each( function() {
					fname.push( jQuery(this).val() );
				});

				var lname = [];
				jQuery('input[name="lname[]"]').each( function() {
					lname.push( jQuery(this).val() );
				});

				var Email = [];

				jQuery('input[name="Email[]"]').each( function() {
					Email.push( jQuery(this).val() );
				});
				var Email = [];

				jQuery('input[name="Email[]"]').each( function() {
					Email.push( jQuery(this).val() );
				});
				var Company = [];

				jQuery('input[name="Company[]"]').each( function() {
					Company.push( jQuery(this).val() );
				});
				var Position = [];

				jQuery('input[name="Position[]"]').each( function() {
					Position.push( jQuery(this).val() );
				});
				var Telephone = [];

				jQuery('input[name="Telephone[]"]').each( function() {
					Telephone.push( jQuery(this).val() );
				});
				var Relationship = [];

				jQuery('select[name="Relationship[]"]').each( function() {
					Relationship.push( jQuery(this).val() );
				});
				var Years = [];

				jQuery('input[name="Years[]"]').each( function() {
					Years.push( jQuery(this).val() );
				});
				var notation = [];

				jQuery('textarea[name="notation[]"]').each( function() {
					notation.push( jQuery(this).val() );
				});

				var user_msg = jQuery('textarea[name="user_msg"]').val();
				var sender_name = jQuery('input[name="sender_name"]').val();

				jQuery('#reach_out_n_ask').text('Sending...').attr('disabled', 'disabled');

				jQuery.ajax({
			 		type:"POST",
					url: "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>", 
					data: {
						action: 'reach_out_and_ask_for_reference',
						fname: fname,
						lname: lname,
						Email: Email,
						Company: Company,
						Position: Position,
						Telephone:Telephone,
						Relationship:Relationship,
						Years: Years,
						//notation:notation,
					},
					success:function(r){
						jQuery('.wpcf7-form').append('<p class="remove_btn text-center" id="rfsuccess"> Successfully send.</p>');
						var id = '<?php echo get_the_ID(); ?>';
						//window.location = '<?php echo get_the_permalink( "'+id+'" ); ?>';
						jQuery('#reach_out_n_ask').text('Send Now').removeAttr('disabled');
						location.reload();

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
<?php get_footer('preferences'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#inv_frn_n_coll").on('click', '.delete_anchor', function(){
			var _this = jQuery(this);
			var refcid = jQuery(this).attr('buttonid');
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
							action : 'delete_reach_reference',
							refcid : refcid
						},
						success : function(r) {
							if ( r.msg == 'success' ) {
								jQuery('.changetext').html('Continue Delete');
						    	jQuery('#refralno'+refcid).remove();
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
				   		title:	"Cancelled",
				   		type: "error",
					   	confirmButtonClass: "btn-primary btn-sm",
				   });
				   _this.prop('checked',false);
				}
			});
		});
	});
</script>
<?php
/**
 * The default template for displaying content. Used for seeker tips
 * @package Jobify
 * @since Jobify 1.0
 */



function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

$userID= get_current_user_id();
$data= get_userdata($userID);

global $post;
$post_slug=$post->post_name;

?>
<div class="sidemenu">
	<h3 class="sidemenu_title">Account Management</h3>
	  <?php echo wp_nav_menu( array( 'menu' => 'Preferences Account Management', 'menu_class' => 'nav nav-stacked' ) );  ?>
	<h3 class="sidemenu_title">helpful quick links</h3>
	
	<ul class="nav nav-stacked">
		<li <?php if( $post_slug == 'applied-jobs' ){ echo "class='current_page_item'"; } ?>><a href="<?php echo site_url()  ?>/preferences/applied-jobs/">Jobs You Applied To</a></li> <!-- current_page_item -->
		<li <?php if( $post_slug == 'saved-jobs-of-interest' ){ echo "class='current_page_item'"; } ?>><a href="<?php echo site_url()  ?>/preferences/saved-jobs-of-interest/">Saved Jobs of Interest</a></li>
		<li <?php if( $post_slug == 'my-network' ){ echo "class='current_page_item'"; } ?>><a href="<?php echo site_url()  ?>/preferences/my-network/">Your Networks</a></li>
		<li><a href="#" data-toggle="modal" data-target="#invite_a_colleague">Invite Friends & Colleagues</a></li>
		<li <?php if( $post_slug == 'employer-management' ){ echo "class='current_page_item'"; } ?>><a href="<?php echo site_url()  ?>/preferences/employer-management">Employer Management</a></li>
		<li <?php if( $post_slug == 'recruiter-management' ){ echo "class='current_page_item'"; } ?>><a href="<?php echo site_url()  ?>/preferences/recruiter-management">Recruiter Management</a></li>
		<li><a href="#" data-target="#aboutproblem" data-toggle="modal" id="submitbPobe" ticketID="<?php echo random_str(8); ?>">Tell Us About a Problem </a></li>
		<li><a href="#" data-toggle="modal" data-target="#feedback">Give Us Your Feedback</a></li>
		<li><a href="#" data-toggle="modal" data-target="#yourstory">Tell Us Your Story</a></li>
		<li><a href="<?php echo site_url();  ?>/job-seekers/find-a-job/">Job Board</a></li>
		<li><a href="<?php echo site_url();  ?>/resources/">Resources</a></li>
		<!-- <li><a href="#" data-toggle="modal" data-target="#visit_the_help_center">Visit the help center</a></li> -->
	
	</ul>
	
	<?php //echo wp_nav_menu( array( 'menu' => 'Helpfull Quick links', 'menu_class' => 'nav nav-stacked' ) );  ?>
	<div class="clearfix"></div>
</div>


<script type="text/javascript">
	
	jQuery(document).ready(function(){
		jQuery('select[name="select_problem_type"]').on('change', function(){
			var thisVal = jQuery(this).val();
			if ( thisVal == 'Other' ) {
				jQuery('.otheproblem').show();
				jQuery('input[name="other_problem"]').show().val('');
			}
			else{
				jQuery('.otheproblem').hide();
				jQuery('input[name="other_problem"]').hide().val('');
			}

			jQuery('input[name="problem_type"]').val(thisVal);
		});

		jQuery('input[name="other_problem"]').on('keyup', function() {
			var thisVal = jQuery(this).val();
			jQuery('input[name="problem_type"]').val(thisVal);
		});

		jQuery('input[name="good_value_for_cost"]').change(function(){
			var value = jQuery( 'input[name="good_value_for_cost"]:checked' ).val();
			if(value=="No"){
				jQuery('.textarea_sm').show();
			}else{
				jQuery('.textarea_sm').hide();
				jQuery('textarea[name="how_accomplish_goal"]').val('');
			}
	    });
	});
</script>


<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedbackLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
      	<h3>Got Feedback?</h3>
      	<h5>We want to be kick ass. Help us get there!</h5>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4457" title="Feedback seeker" html_id="give_us_ur_feedback" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="yourstory" tabindex="-1" role="dialog" aria-labelledby="yourstoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Your Story Has Taken A Lifetime</h3>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4562" title="Tell Us Your Story" html_id="tell_us_ur_stry" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="aboutproblem" tabindex="-1" role="dialog" aria-labelledby="aboutproblemLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Create a Trouble Ticket</h3>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4563" title="Tell us about a Problem" html_id="tell_us_abt_prblm" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="visit_the_help_center" tabindex="-1" role="dialog" aria-labelledby="aboutproblemLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Help us spread the word!</h3>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4624" title="Visit the help center" html_id="visit_the_help_center_id" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		setTimeout( function() {
			var ticid = jQuery('#submitbPobe').attr('ticketID');
			jQuery('#ticketnoid').val(ticid);
		},500);
	});
</script>


<div class="modal fade" id="invite_a_colleague" tabindex="-1" role="dialog" aria-labelledby="invite_a_colleagueLabel">
 	<div class="vertical-alignment-helper">
	    <div class="modal-dialog modal-lg vertical-align-center" role="document">
		    <div class="modal-content invite_frnd">
		        <div class="modal-body">
			        <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			        <h3>Help us spread the word!</h3>
			        <div class="clearfix"></div>
			        <form class="wpcf7-form form-horizontal ">
				        <p>Once your friends & colleagues sign up with EyeRecruit.com, they will be immediately upgraded and receive the Premium Subscription for FREE!  Just for helping them get started, you will also be rewarded too. Keep checking your Network within your Preferences tab and how the Credits you have earned add up!  There are no limits! Biggest Networks have a chance at becoming a Paid Recruiter! </p>
				        <p>When you click the ‘Submit’ button and e-mail message with your comments will be sent to your friend. Than you for telling your friends and colleagues about us. </p>
				      	<div  class="row">
				      		<div class="col-md-8">
						      	<div id="userdetail_all_fields">
									<div id="userdetail_pr_1" class="edit-main-dv">
										<div class="form-group">
											<label class="col-sm-4 control-label" for="fname">Name:</label>
											<div class="col-sm-8">
												<input id="fname_1" class="regular-text code form-control" name="fname[]" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label" for="user_email">To e-mail address:</label>
											<div class="col-sm-8">
												<input id="user_email_1" class="regular-text code form-control" name="user_email[]" type="text" />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-8 col-sm-offset-4 remove_btn ">
										<a id="userdetail_add_more" count="1" class="userdetail_add_more">+ Add More Recipients</a>
									</div>
								</div>
								<!-- <div class="form-group">
					                <label for="your-name" class="col-sm-4 control-label">To e-mail address:</label>
									<div class="col-sm-8">
										<input name="to_email_address" value="" size="40" class="form-control" aria-invalid="false" type="email">
									</div>
								</div> -->
								<div class="form-group">
				                	<label for="your-name" class="col-sm-4 control-label">Subject:</label>
									<div class="col-sm-8">
										<input name="subject" value="<?php echo $data->first_name; ?> sent this message for you" size="40" class="wpcf7-form-control wpcf7-text form-control" aria-invalid="false" type="text" readonly>
									</div>
								</div>
								<div class="form-group" id="msg_cont">
								    <label for="user_msg" class="col-sm-4 control-label">Comments:</label>
									<div class="col-sm-8">
										<div class="regular-text code form-control" name="user_msg">
											<p>After seeing this site I’m forwarding this link to you as it is only for us in the Security, Investigation & Surveillance industry. </p>
											<p>Besides allowing me to keep all of my career documents in a single place, I can express interest in openings, forward a link for someone to find out more about me, Employers can search for me by my experience 24/7 and industry jobs are posted here that are not posted anywhere on the web!</p>
											<p>If you know someone else, that like us, need could use a support a team, forward this message! </p>
											<p>Go to: <a href="<?php echo site_url(); ?>/job-seekers/">EyeRecruit.com/job-seekers</a></p>
											<?php echo $data->first_name.' '.$data->last_name; ?>
										</div>
									</div>
								</div>
							</div>
				      		<div class="col-md-4">
				      			<div class="popup_invite">
									<div class="form-group">
					                	<label for="your-name" class="control-label">Your Invite URL to share paste it in your blog!</label>
										<input name="subject" value="" size="40" class="wpcf7-form-control wpcf7-text form-control" aria-invalid="false" type="text" placeholder="http://www.">
									</div>
									<div class="form-group">
					                	<label for="your-name" class="control-label">Or invite via social Media</label>
					                	<a href="#" class="invite_link"><i class="fa fa-twitter-square" aria-hidden="true"></i> Tweet on Twitter</a>
					                	<a href="#" class="invite_link"><i class="fa fa-facebook-square" aria-hidden="true"></i> Share on Facebook</a>
					                	<a href="#" class="invite_link"><i class="fa fa-linkedin-square" aria-hidden="true"></i> post on Linkedin</a>
					                	<a href="#" class="invite_link"><i class="fa fa-google-plus-square" aria-hidden="true"></i> Share on Google+</a>
									</div>
				      			</div>
							</div>
						</div>
						<div class="form-group text-center row">
							<div class="col-md-8">
								<div class="row">
								<div class="col-md-8 col-md-offset-4">
	    							<button id="inv_a_coll" type="button" class="btn btn-default btn-sm">Submit</button>
	    							<button type="button" class="close_btn" data-dismiss="modal" aria-label="Close">Cancel</button>
								</div>
								</div>
							</div>
						</div>
						<p class="text-right"><a href="#">Referrals Terms & Conditions</a></p>
						<!-- <div class="form-group" id="msg_cont">
							<label class="control-label" for="user_msg">Your Message</label><br>
							<textarea id="user_msg" class="regular-text code form-control" name="user_msg" readonly>
								Hello < >,
								I recently became a member of an interesting service that is allowing me to manage my own career within the industry I am passionate about.  Besides allowing me to store and forward all of my career documents digitally, it also allows me to better present myself and my accomplishments to potential Employers that I am interested in and that are interested in me.
								I am just starting to gather letters of recommendation to assist my future career aspirations and I immediately thought of you. Would you be able to write a strong letter of recommendation on my behalf? As someone who knows me, is familiar with my work and achievements from a portion of my life, I would greatly appreciate your help. Don’t feel that you are under pressure.  There is no deadline.  
								The link below will allow you to upload a PDF directly to my profile or if you would like I can send you a self addressed envelope. I would also be more than happy to meet with you at your convenience to refresh your memory of me if that would be helpful. Of course I would also provide my personal contact information, my resume, and any other material that you would like for your records. 
								I realize that writing a letter of recommendation will be a burden on your time and it means a lot to me that you would take time to read and consider my request. If you don’t have time to write it, perhaps I could write something for you to review and if it looks all right, you could sign it?
								Sincerely,
								<?php //echo $data->first_name.' '.$data->last_name; ?>
							</textarea>
						</div> -->


						<!-- <div class="text-center">
				        	<button id="inv_a_coll" type="button" class="btn btn-primary btn-sm">Send</button>
				        	<button type="button" class="close_btn" data-dismiss="modal">Close</button>
						</div> -->
					</form>
		      	</div>
		    </div>
	  	</div>
	</div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("li#login2-modal a").attr("href", "<?php echo site_url(); ?>/login/");

		jQuery('.btt').on('click', function(){
			jQuery("html, body").animate({ scrollTop: 0 }, 600);
    	});

		jQuery('.userdetail_add_more').live('click', function(){

            var ln_no = jQuery(this).attr('count');

            var count = parseInt(ln_no)+1;

            jQuery("#userdetail_all_fields").append('<div class="edit-main-dv" id="userdetail_pr_'+count+'" ><div class="form-group"><label for="userdetail" class="col-sm-4 control-label">Name:</label><div class="col-sm-8"><input type="text" name="fname[]" id="fname_'+count+'" class="regular-text code form-control"></div></div><div class="form-group"><label for="userdetail" class="col-sm-4 control-label">To e-mail address:</label><div class="col-sm-8"><input type="text" name="user_email[]" id="user_email_'+count+'" class="regular-text code form-control"></div></div><span class="remove_edu btn btn-default btn-sm pull-right" id="remove_edu_'+count+'" rel="'+count+'">remove</span><div class="clearfix"></div></div>');
            jQuery(this).attr('count', count);
        });


        jQuery('.remove_edu').live('click', function(){
            var rel = jQuery(this).attr('rel');
            jQuery('#userdetail_pr_'+rel).remove();
            jQuery('#remove_edu_'+rel).remove();
        });


        //for email validation
		function validEmail(v) {
		    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
		    return (v.match(r) == null) ? false : true;
		}

		//for name validation
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="fname[]"]', function() {
			var name_val = jQuery(this).val();
			var name_id = jQuery(this).attr('id');
			jQuery('#'+name_id+'-error').remove();

			if ( name_val == '' ) {
				jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Name is required.</label>').insertAfter(this);
			}
			else{
				jQuery('#'+name_id+'-error').remove();
			}

		});

		//for email validation
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="user_email[]"]', function() {
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

		//save and close button functionality
		jQuery('#inv_a_coll').on('click', function(){

			jQuery('.error').remove();

			jQuery('input[name="fname[]"]').each( function() {

				var name_val = jQuery(this).val();
				var name_id = jQuery(this).attr('id');

				if ( name_val == '' ) {
					jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Name is required.</label>').insertAfter(this);
				}
			});

			jQuery('input[name="user_email[]"]').each( function() {

				var email_val = jQuery(this).val();
				var email_id = jQuery(this).attr('id');

				if ( email_val == '' ) {
					jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Email is required.</label>').insertAfter(this);
				}
				else if ( !validEmail(email_val) ) {
					jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter a valid email.</label>').insertAfter(this);
				}  
			});

			if(!jQuery('.error').hasClass('send_mail_error')){

				var _this = jQuery(this).html('Please Wait..');
				_this.attr('disabled','disabled');
				
				var rfname = [];

				jQuery('input[name="fname[]"]').each( function() {
					rfname.push( jQuery(this).val() );
				});

				var rfemail = [];
				jQuery('input[name="user_email[]"]').each( function() {
					rfemail.push( jQuery(this).val() );
				});

				jQuery.ajax({
			 		type:"POST",
					url: "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>", 
					data: {
						action: 'invite_any_colleague',
						rfname: rfname,
						rfemail: rfemail
					},
					success:function(r){
						jQuery('#invite_a_colleague').modal('hide');
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>All Colleage entries have been saved and invited !</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
						_this.removeAttr('disabled').html('Submit');
						setTimeout(function(){ 
							jQuery('#rfsuccess').remove();
							for (var k=1; k<=jQuery('#userdetail_add_more').attr('count'); k++) {
					            jQuery('#user_email_'+k).val('');
					            jQuery('#fname_'+k).val('');
					            if(k!=1){ jQuery('#userdetail_pr_'+k).remove(); }
            				};
						}, 2000);
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
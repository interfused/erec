<?php
/**
 * Template Name: Employer access-security page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php get_template_part( 'Employer/content', 'emp_preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Access & Security</h3>
						<?php $current_user_id = get_current_user_id(); ?>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id ?></span>
					</div>
					<form id="change_pass_form_id" class="renewalform" method="POST">
						<div class="sidebar_title cont_title">
							<h4>Change Password</h4>
							<!-- <div class="title_edit"><a href="#"><i class="fa fa-pencil"></i> Edit</a></div> -->
						</div>
						<div class="indent">
							<!-- <div class="row">
								<div class="col-sm-7">
									<div class="form-group">
									  <input type="password" name="old_passwd" class="form-control" id="old_passwd" placeholder="Current Password">
									</div>
								</div>
							</div> -->
							<div class="row">
								<div class="col-sm-7">
									<div class="form-group">
									  <input type="password" name="new_passwd" class="form-control" id="new_passwd" placeholder="New Password">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="alert" style="display:none;" role="alert"><i class="fa fa-info-circle"></i> <span id="not_match">4 to 20 Characters</span></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-7">
									<div class="form-group">
									  <input type="password" name="confirm_passwd" class="form-control" id="confirm_passwd" placeholder="Confirm New Password">
									</div>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" id="sub_res_pass" class="btn btn-primary">Save New Password</button>
							</div>
						</div>
					</form>
					<form class="renewalform">
						<div class="sidebar_title cont_title">
							<h4>Login Notifications</h4>
							<!-- <div class="title_edit"><a href="#"><i class="fa fa-pencil"></i> Edit</a></div> -->
						</div>
						<div class="indent">
							<div class="checkbox">
								<label>
									<input id="actively" name="notifications" value="Turn on login notifications" type="checkbox"> 
									<span><strong>Turn on login notifications</strong></span>
								</label>
								<p>An extra security feature to let you know when anyone logs on into your account from a new browser. This keeps you and your account safe.</p>
							</div>
						</div>
						<div class="sidebar_title cont_title">
							<h4>Create Your Security Question</h4>
						</div>
						<div class="indent security_question">
							<div class="row">
								<div class="col-sm-8">
									<p>For added security, we require the creation of a security question and answer.</p>
									<ul>
										<li>Always confirm you are on EyeRucruit.com before entering  your password or answering the security question.</li>
										<li>You will be asked for this security question whenever you log in to EyeRecruit.com from a new computer and when resetting your password.</li>
									</ul>
									<div class="form-group has-feedback">
									    <label for="squestion">Question</label>
									    <?php
									    $queArray = array('What was the name of your elementary / primary school?','What is your pet’s name?','In what year was your father born?','In what city does your nearest sibling live?','In what city or town was your first job?');
									    $getYourQue = get_cimyFieldValue($current_user_id, 'YOUR_SECURITY');
									    $getans = get_cimyFieldValue($current_user_id, 'YOUR_ANSWER');
									    $getcond = get_cimyFieldValue($current_user_id, 'YOUR_ANSWER_CON');
									    $cancelThis = ( !empty($getYourQu) || !empty($getans) ) ? 'cancelThis' :'';
									    ?>
									    <select class="form-control" id="squestion" name="YOUR_SECURITY">
									      <option value="">Please select a question</option>
										  <?php foreach ($queArray as $value) { ?>
										  		<option value="<?php echo $value; ?>" <?php if( $value == $getYourQue ){ echo "selected"; } ?> ><?php echo $value; ?></option>
										  <?php } ?>
										</select>
										<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
									</div>
									<div class="form-group">
									  <label class="control-label" for="sanswer">Answer</label>
									  <input type="text" class="form-control" id="sanswer" name="YOUR_ANSWER" value="<?php echo $getans;?>" >
									</div>
									<h5>Important</h5>
									<div class="checkbox">
										<label>
											<input name="YOUR_ANSWER_CON" value="Yes" <?php if($getcond == 'Yes'){ echo "checked"; } ?> type="checkbox"> 
											<span>I understand my account will be locked if i am unable to answer this question.</span>
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input id="actively" name="Remember this computer" value="Remember this computer" type="checkbox" checked=""> 
											<span>Remember this computer</span>
										</label>
									</div>
								</div>
								<div class="col-sm-4">
									<?php member_navigation_sidebar_tips_function('employer_access_sec'); ?>
								</div>
							</div>
							<div class="text-center">
								<a href="javascript:void(0);"  id="secQuesCreate" class="btn btn-primary secQuesAction">Create</a>
								<a href="javascript:void(0);" id="secQuesCancel" class="btn btn-default secQuesAction <?php echo $cancelThis; ?> ">Cancel</a>
							</div>
						</div>
						<div class="sidebar_title cont_title">
							<h4>Login History</h4>
						</div>
						<?php 
							$my_no_rows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_login_history WHERE user_id = '".$current_user_id."'"); 
							$count = count($my_no_rows);
							if($count>0){ ?>
								<div class="table-responsive indent">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Browser / Device</th>
												<th>Location</th>
												<th>IP Address</th>
												<th>Recent Activity</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_login_history WHERE user_id = '".$current_user_id."' ORDER BY ID DESC limit 4" );
												$current_time = current_time( 'timestamp' );
												foreach ($myrows as $key) {
											?>
												<tr>
													<td><strong><?php echo $key->browser; ?> </strong><?php echo $key->device; ?></td>
													<td><?php echo $key->location; ?></td>
													<td><?php echo $key->ip_address; ?></td>
													<td><?php echo esc_html(human_time_diff(mysql2date('U', $key->login_date), $current_time)) . ' ago'; ?></td>
												</tr>
											<?php
												}
											?>
										</tbody>
									</table>
								</div>
								<div class="text-center">
									<a href="<?php echo site_url();  ?>/employer-login-history/" class="btn btn-default">See Complete History
									</a>
								</div><?php
							}else{
								echo "No results found";
							} ?>
						<div class="sidebar_title cont_title">
							<h4>Recent Activity
							</h4>
							<small>If you see something unfamiliar , change your password</small>
							<div class="clearfix"></div>
						</div>
						<?php 
							$my_no_rows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id = '".$current_user_id."'"); 
							$count = count($my_no_rows);
							if($count>0){ ?>
								<div class="table-responsive indent">
									<table class="table table-bordered">
										<tbody>
											<?php 
												$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id='".$current_user_id."' ORDER BY ID DESC LIMIT 5" );
												$current_time = current_time( 'timestamp' );
												foreach ($myrows as $key) {
											?>
												<tr>
													<td><?php echo $key->meta; ?></td>
													<td class="text-right"><?php echo date('g.iA \o\n j M, Y', $key->datetime); ?></td>
												</tr>
											<?php
												}
											?>
										</tbody>
									</table>
								</div>
								<div class="text-center">
									<a href="<?php echo site_url();  ?>/employer-recent-activity/" class="btn btn-default">See Complete Activity
									</a>
								</div><?php
							}else{
								echo "No results found";
							} 
						?>
					</form>
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
				//For reset password form
			   jQuery("#change_pass_form_id").validate({
			        rules: {
			            /*old_passwd: {
			                         required: true,
			                         minlength: 4,
			                         maxlength: 20                
			            },*/
			            new_passwd: {
			                         required: true,
			                         minlength: 4,
			                         maxlength: 20  
			            },
			            confirm_passwd: {
			                         required: true,
			                         minlength: 4,
			                         maxlength: 20
			            }
			             
			         },            
			        messages: {
			           /* old_passwd: {
			                         required: "Plese enter the old password",
			                         minlength: "Please type at least 4 letters",
			                         maxlength: "Please type at most 20 letters"                     
			            },*/
			            new_passwd: {
			                         required: "Plese enter the new password",
			                         minlength: "Please type at least 4 letters",
			                         maxlength: "Please type at most 20 letters"
			         	},
			            confirm_passwd: {
			                         required: "Plese enter the confirm password",
			                         minlength: "Please type at least 4 letters",
			                         maxlength: "Please type at most 20 letters"
			         	}
			             
			    	},
					submitHandler: function(form) {
					// old_pass = jQuery("#old_passwd").val();
					new_pass = jQuery("#new_passwd").val();
					confirm_pass = jQuery("#confirm_passwd").val();	
						if( new_pass != confirm_pass ){
							jQuery(".alert").show();
							jQuery(".alert #not_match").html("Password doesn't match");
						}else{
							jQuery('#sub_res_pass').html('Please Wait...').attr('disabled','disabled');
						    jQuery.ajax({
								type:"POST",
								url: "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>", 
								data: {
									action: 'reset_pass_form',
									// old_pass: old_pass,
									new_pass: new_pass
								},
								success:function(r){
									jQuery(".alert").show();
									jQuery(".alert #not_match").html(r);
									jQuery('#sub_res_pass').html('Save New Password').removeAttr('disabled');
								}
							});
						}
					}

				});
		/*	jQuery("#sub_res_pass").click(function(){
				old_pass = jQuery("#old_passwd").val();
				new_pass = jQuery("#new_passwd").val();
				confirm_pass = jQuery("#confirm_passwd").val();	
				if( new_pass != confirm_pass ){
					jQuery(".alert").show();
					jQuery(".alert #not_match").html("Password doesn't match");
				}else{
				    jQuery.ajax({
						type:"POST",
						url: "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>", 
						data: {
							action: 'reset_pass_form',
							old_pass: old_pass,
							new_pass: new_pass
						},
						success:function(r){
							jQuery(".alert #not_match").html(r);
						}
					});
				}
			});
*/

			jQuery('#secQuesCreate').on('click', function() {
				jQuery('.sec_error').remove();
				var _this = jQuery(this);
				var actType = _this.attr('id');
				var ques = jQuery('select[name="YOUR_SECURITY"]').val();
				var ans = jQuery('input[name="YOUR_ANSWER"]').val();
				var quesCon = jQuery('input[name="YOUR_ANSWER_CON"]:checked').val();
				var errorQue = jQuery('<label id="security-question-error" class="error sec_error" for="security-question">Please select at least one.</label>');
				var errorans = jQuery('<label id="security-answer-error" class="error sec_error" for="security-answer">Please Please enter an answer.</label>');

				if ( ques == '' ) { errorQue.insertAfter('select[name="YOUR_SECURITY"]') }else{ jQuery('#security-question-error').remove(); }
				if ( ans == '' ) { errorans.insertAfter('input[name="YOUR_ANSWER"]') }else{ jQuery('#security-answer-error-error').remove(); }
				if ( jQuery('.error').hasClass('sec_error') ) { return false; }
				_this.html('Please Wait...');
				jQuery.ajax({
					type: 'POST',
					url: "<?php echo admin_url('/admin-ajax.php/'); ?>",
					datType: 'json',
					data: {
						action: 'addRemoveSecQuestion', //Action in inc/edit_basic_info.php
						actType: actType,
						ques: ques,
						ans: ans,
						quesCon: quesCon
					},
					success: function(res){
						jQuery('.sec_error').remove();
						var obj = jQuery.parseJSON(res);
						if ( obj.status == 'success' ) {
							swal({
								title: 'success', 
								html: true,
								text: '<span>Successfully add/update your security question.<span>',
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
							_this.html('Create');
							//jQuery.notify("Successfully add your security question !", "success");
							jQuery('.sec_error').remove();
							jQuery('#secQuesCancel').addClass('cancelThis');
						}
						else{
							if ( obj.ques == 'quesEmpty' ) {
								errorQue.insertAfter('select[name="YOUR_SECURITY"]');
							}
							if ( obj.ans == 'ansEmpty' ) {
								errorans.insertAfter('input[name="YOUR_ANSWER"]');
							}
						}
					}
				}); 
			});

			jQuery('#secQuesCancel').on('click', function() {
				if ( jQuery(this).hasClass('cancelThis') ) {
					var _this = jQuery(this);
					_this.html('Please Wait...');
					jQuery.ajax({
						type: 'POST',
						url: "<?php echo admin_url('/admin-ajax.php/'); ?>",
						data: {
							action: 'quesRemoveSecQuestion', //Action in inc/edit_basic_info.php
						},
						success: function(res){
							//jQuery.notify("Successfully cancel your security question !", "success");
							swal({
								title: 'success', 
								html: true,
								text: '<span class="text-center">Successfully cancel your security question.</span>',
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
							_this.removeClass('cancelThis').html('Cancel');
							jQuery('select[name="YOUR_SECURITY"]').val('');
							jQuery('input[name="YOUR_ANSWER"]').val('');
							jQuery('input[name="YOUR_ANSWER_CON"]').removeAttr('checked');
						}
					});
				}
				else{
					swal({
						title: 'Warning',
						html: true,
						text: '<span class="text-center">Already cancelled your security question.</span>', 
						type: "warning",
						confirmButtonClass: "btn-primary btn-sm",
					});
					//jQuery.notify("Your security question already cancelled!", "error");
				}
			});
		});
	</script>
<?php get_footer('preferences'); ?>
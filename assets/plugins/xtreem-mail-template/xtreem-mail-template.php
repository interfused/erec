<?php
/*
Plugin Name: Xtreem  Mail Templates 
Author:      Xtreem Solution
Description: This plugin is customized to create mail templates for eyerecruit.
*/
 // error_reporting(E_ALL);
include('includes/api-mailchimp.php');

add_action( 'admin_menu', 'cusotme_menu_pages' );
function cusotme_menu_pages() {

    add_menu_page('Mail Templates','Email Templates','manage_options','eyerecruit-mail-templates','xtreem_mail_setting_callback');
	
	add_submenu_page('eyerecruit-mail-templates','jobseeker','Jobseeker template','manage_options','eyerecruit-jobseeker-mail','eyerecruit_thank_mail_templates_callback');
	add_submenu_page('eyerecruit-mail-templates','jobseeker','Jobseeker template BACKUP','manage_options','eyerecruit-jobseeker-mail-backup','eyerecruit_thank_mail_templates_callback_backup');
	
	add_submenu_page('eyerecruit-mail-templates','Employers','Employers template','manage_options','eyerecruit-employer-mail','eyerecruit_employer_mail');
	add_submenu_page('eyerecruit-mail-templates','Employers','Employers template BACKUP','manage_options','eyerecruit-employer-mail-backup','eyerecruit_employer_mail_backup');
  
   	add_submenu_page('eyerecruit-mail-templates','Employer Admin','Employer Admin template','manage_options','employer-admin-mail','eyerecruit_mail_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates','Jobseeker Admin','Jobseeker Admin template','manage_options','jobseeker-admin-mail','eyerecruit_jobseeker_mail_templates_callback');
   	
   	add_submenu_page('eyerecruit-mail-templates','Password Reset','Password Reset template','manage_options','password-reset-mail','password_reset_mail_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates','After Password Reset','After Password Reset template','manage_options','after-password-reset-mail','after_password_reset_mail_templates_callback');
   	
   	add_submenu_page('eyerecruit-mail-templates','Admin Approval','Admin Approval template','manage_options','admin-approval-mail','admin_approval_mail_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Jobseeker Profile', 'Jobseeker Profile Builder Template', 'manage_options', 'jobseeker-profile-builder-mail', 'jobseeker_profile_builder_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Recruiter Mail', 'Recruiter Mail Template', 'manage_options', 'recruiter-mail', 'recruiter_mail_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Recommend Friends & Colleagues Mail', 'Recommend Friends & Colleagues Mail Template', 'manage_options', 'recommend-friends-mail', 'recommend_friends_mail_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Reach Out Recommendation', 'Reach Out For A Recommendation Template', 'manage_options', 'reach-out-recommendation', 'reach_out_recommendation_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Reach Out Recommendation', 'Reach Out For A Rererence Template', 'manage_options', 'reach-out-reference', 'reach_out_reference_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Forward Job', 'Forward Job', 'manage_options', 'forward-job', 'forward_job_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Forward Seeker Detail', 'Forward Seeker Detail', 'manage_options', 'forward-seeker-detail', 'forward_seeker_detail_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Suppor Service Seeker Mail', 'Suppor Service Seeker Mail', 'manage_options', 'support-service-seeker-mail', 'support_service_seeker_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Suppor Service Admin Mail', 'Suppor Service Admin Mail', 'manage_options', 'support-service-admin-mail', 'support_service_admin_templates_callback');

   	add_submenu_page('eyerecruit-mail-templates', 'Follow Up', 'Follow Up Template', 'manage_options', 'follow-up', 'follow_up_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Message Now', 'Message Now Template', 'manage_options', 'message-now', 'message_now_templates_callback');
   
   	add_submenu_page('eyerecruit-mail-templates', 'Forward Doc', 'Forward Doc Template', 'manage_options', 'forward-doc', 'forward_doc_templates_callback');
   	
   	add_submenu_page('eyerecruit-mail-templates', 'Job Apply', 'Job Apply Template', 'manage_options', 'job-apply', 'job_apply_templates_callback');
   	add_submenu_page('eyerecruit-mail-templates', 'Thank You Job Apply', 'Thank You Job Apply Template', 'manage_options', 'thank-job-apply', 'thank_job_apply_templates_callback');
 
}

add_action( 'admin_init', 'register_founder_options' );
function register_founder_options() {
	register_setting( 'founder_options', 'founder_options', 'founder_options_callback' ); 
	register_setting( 'eyerecruit_thanks_employes__options', 'eyerecruit_thanks_employes__options', 'founder_options_callback' );
	register_setting( 'eyerecruit_thanks_employes_backup__options', 'eyerecruit_thanks_employes_backup__options', 'founder_options_callback' ); 
	register_setting( 'xtreem_options_smtp', 'xtreem_options_smtp', 'setting_options_callback' ); 
	register_setting( 'founder_options_employer','founder_options_employer','founder_options_employer_callback');
	register_setting( 'founder_options_jobseeker','founder_options_jobseeker','founder_options_jobseeker_callback');
	register_setting( 'founder_options_jobseeker_backup','founder_options_jobseeker_backup','founder_options_jobseeker_callback');
	
	register_setting( 'cpr_password_reset','cpr_password_reset','cpr_password_reset_callback');
	register_setting( 'cpr_after_password_reset','cpr_after_password_reset','cpr_after_password_reset_callback');
	
	register_setting( 'admin_approval','admin_approval','admin_approval_callback');
	register_setting( 'jobseeker_profile_builder','jobseeker_profile_builder','jobseeker_profile_builder_callback');
	register_setting( 'recruiter_mail','recruiter_mail','recruiter_mail_callback');
	register_setting( 'recommend_friends_mail','recommend_friends_mail','recommend_friends_mail_callback');
	register_setting( 'reach_out_recommendation','reach_out_recommendation','reach_out_recommendation_callback');
	register_setting( 'reach_out_reference','reach_out_reference','reach_out_reference_callback');
	register_setting( 'forward_job','forward_job','forward_job_callback');
	register_setting( 'forward_seeker_detail','forward_seeker_detail','forward_seeker_detail_callback');
	register_setting( 'support_service_seeker','support_service_seeker','support_service_seeker_callback');
	register_setting( 'support_service_admin','support_service_admin','support_service_admin_callback');

	register_setting( 'follow_up','follow_up','follow_up_msg_callback');
	register_setting( 'message_now','message_now','message_now_msg_callback');

	register_setting( 'forward_doc','forward_doc','forward_doc_msg_callback');

	register_setting( 'job_apply','job_apply','job_apply_msg_callback');
	register_setting( 'thank_job_apply','thank_job_apply','thank_job_apply_msg_callback');
	
} 
function founder_options_callback($array){
	return $array;
}

//backups to be removed later post launch
function eyerecruit_thank_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Thank you email template for jobseeker</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('founder_options');
					$founder_options = get_option('founder_options');

					$argss = array(
							'textarea_name' => 'founder_options[thanks_jobseeker_mail_template]',
						);
					$contents = isset($founder_options['thanks_jobseeker_mail_template']) ? $founder_options['thanks_jobseeker_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="founder_options[subject]" id="subject"><?php echo $founder_options['subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Activation mail Editor</label></th>
							<td><?php wp_editor( $contents, 'thanks_jobseeker_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}

function eyerecruit_thank_mail_templates_callback_backup() {
  ?>
    <div class="wrap">
    
      <p><h3>Thank you email template for jobseeker</h3></p> 
      
      <?php 
        if(isset($_GET['settings-updated'])){
          ?>
            <div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
              <p>
                <strong>Settings saved.</strong>
              </p>
              <button class="notice-dismiss" type="button">
                <span class="screen-reader-text">Dismiss this notice.</span>
              </button>
            </div>
          <?php 
        }
      ?>

      <form method="post" action="options.php">

        <?php 
          settings_fields('founder_options_jobseeker_backup');
          $founder_options_jobseeker_backup = get_option('founder_options_jobseeker_backup');

          $argss = array(
              'textarea_name' => 'founder_options_jobseeker_backup[thanks_jobseeker_mail_template_backup]',
            );
          $contents = isset($founder_options_jobseeker_backup['thanks_jobseeker_mail_template_backup']) ? $founder_options_jobseeker_backup['thanks_jobseeker_mail_template_backup'] : '';
          
          ?>
          <table class="form-table">
            <tr>
              <th><label for="subject">Subject</label></th>
              <td><textarea style="width:100%" name="founder_options_jobseeker_backup[subject]" id="subject"><?php echo $founder_options_jobseeker_backup['subject']; ?></textarea></td>
            </tr>
            <tr>
              <th><label>Activation mail Editor</label></th>
              <td><?php wp_editor( $contents, 'thanks_jobseeker_mail_template_backup', $argss); ?></td>
            </tr>
          </table><?php 
          submit_button();
        ?>
      </form>
    </div>

  <?php 
}

function eyerecruit_employer_mail_backup() {
	?>
		<p><h3>Thank you email template for employers</h3></p> 
		<div class="wrap">
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('eyerecruit_thanks_employes_backup__options');
					$apply_job__options = get_option('eyerecruit_thanks_employes_backup__options');

					$argss = array(
							'textarea_name' => 'eyerecruit_thanks_employes_backup__options[eyerecruit_thanks_message_backup]',
						);
					$contents = isset($apply_job__options['eyerecruit_thanks_message_backup']) ? $apply_job__options['eyerecruit_thanks_message_backup'] : '';
					
					?>
					<table class="form-table">
							
							
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="eyerecruit_thanks_employes_backup__options[subject]" id="apply_job_subject"><?php echo $apply_job__options['subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Job apply mail Editor</label></th>
							<td><?php wp_editor( $contents, 'eyerecruit_thanks_message_backup', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}

function eyerecruit_employer_mail() {
	?>
		<p><h3>Thank you email template for employers</h3></p> 
		<div class="wrap">
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('eyerecruit_thanks_employes__options');
					$apply_job__options = get_option('eyerecruit_thanks_employes__options');

					$argss = array(
							'textarea_name' => 'eyerecruit_thanks_employes__options[eyerecruit_thanks_message]',
						);
					$contents = isset($apply_job__options['eyerecruit_thanks_message']) ? $apply_job__options['eyerecruit_thanks_message'] : '';
					
					?>
					<table class="form-table">
							
							
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="eyerecruit_thanks_employes__options[subject]" id="apply_job_subject"><?php echo $apply_job__options['subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Job apply mail Editor</label></th>
							<td><?php wp_editor( $contents, 'eyerecruit_thanks_message', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}

function xtreem_mail_setting_callback() {
	?>
		<div class="wrap">
			
			<h3>SMTP Setting Templates</h3>

			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">
				<?php 
					settings_fields('xtreem_options_smtp');
					$setting_options = get_option('xtreem_options_smtp');
					?>
						<table class="form-table">
							<tr>
								<th scope="row"><label for="host">SMTP Host</label></th>
								<td><input type="text" id="host" name="xtreem_options_smtp[host]" class="regular-text" value="<?php echo $setting_options['host'];?>"></td>
							</tr>
							<tr>
								<th><label for="port">SMTP Port</label></th>
								<td><input type="text" id="port" name="xtreem_options_smtp[port]" class="regular-text" value="<?php echo $setting_options['port'];?>"></td>
							</tr>
							<tr>
								<th><label for="username">SMTP Username</label></th>
								<td><input type="text" id="username" name="xtreem_options_smtp[username]" class="regular-text" value="<?php echo $setting_options['username'];?>"></td>
							</tr>
							<tr>
								<th><label for="password">SMTP Password</label></th>
								<td><input type="password" id="password" name="xtreem_options_smtp[password]" class="regular-text" value="<?php echo $setting_options['password'];?>"></td>
							</tr>
							<tr>
								<th><label for="fromemail">From Email</label></th>
								<td><input type="text" id="fromemail" name="xtreem_options_smtp[fromemail]" class="regular-text" value="<?php echo $setting_options['fromemail'];?>"></td>
							</tr>
							<tr>
								<th><label for="fromname"> From Name</label></th>
								<td><input type="text" id="fromname" name="xtreem_options_smtp[fromname]" class="regular-text" value="<?php echo $setting_options['fromname'];?>"></td>
							</tr>
							<tr>
								<th><label for="tomail"> To mail 1</label></th>
								<td><input type="text" id="tomail" name="xtreem_options_smtp[tomail]" class="regular-text" value="<?php echo $setting_options['tomail'];?>"></td>
							</tr>
							<tr>
								<th><label for="tomail2"> To mail 2</label></th>
								<td><input type="text" id="tomail2" name="xtreem_options_smtp[tomail2]" class="regular-text" value="<?php echo $setting_options['tomail2'];?>"></td>
							</tr>
							<tr>
								<th><label for="tomail3"> To mail 3 </label></th>
								<td><input type="text" id="tomail3" name="xtreem_options_smtp[tomail3]" class="regular-text" value="<?php echo $setting_options['tomail3'];?>"></td>
							</tr>
						</table>
					<?php
					/*wp_editor( $content, 'request_mail_template', $args);*/
				
					submit_button();
				?>
			</form>
		</div>

	<?php 
}


function setting_options_callback($arg){
	return $arg;
}

// Admin mail template for Employer
function eyerecruit_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Mail template employer Admin</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('founder_options_employer');
					$founder_options_employer = get_option('founder_options_employer');

					$argss = array(
							'textarea_name' => 'founder_options_employer[employer_mail_template]',
						);
					$contents = isset($founder_options_employer['employer_mail_template']) ? $founder_options_employer['employer_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="founder_options_employer[employer_subject]" id="subject"><?php echo $founder_options_employer['employer_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Admin mail Editor</label></th>
							<td><?php wp_editor( $contents, 'employer_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function founder_options_employer_callback($employer){
	return $employer;
}



// Admin mail template for jobseeker
function eyerecruit_jobseeker_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Mail template Jobseeker Admin</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('founder_options_jobseeker');
					$founder_options_jobseeker = get_option('founder_options_jobseeker');

					$argss = array(
							'textarea_name' => 'founder_options_jobseeker[jobseeker_mail_template]',
						);
					$contents = isset($founder_options_jobseeker['jobseeker_mail_template']) ? $founder_options_jobseeker['jobseeker_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="founder_options_jobseeker[jobseeker_subject]" id="subject"><?php echo $founder_options_jobseeker['jobseeker_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Admin mail Editor</label></th>
							<td><?php wp_editor( $contents, 'jobseeker_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function founder_options_jobseeker_callback($jobseeker){
	return $jobseeker;
}



// Password Reset mail template for jobseeker
function password_reset_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Mail template Password Reset</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('cpr_password_reset');
					$cpr_password_reset = get_option('cpr_password_reset');

					$argss = array(
							'textarea_name' => 'cpr_password_reset[passreset_mail_template]',
						);
					$contents = isset($cpr_password_reset['passreset_mail_template']) ? $cpr_password_reset['passreset_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="cpr_password_reset[passreset_subject]" id="subject"><?php echo $cpr_password_reset['passreset_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Admin mail Editor</label></th>
							<td><?php wp_editor( $contents, 'passreset_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function cpr_password_reset_callback($passreset){
	return $passreset;
}


// Password Reset mail template for jobseeker
function after_password_reset_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Mail template After Password Reset</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('cpr_after_password_reset');
					$cpr_after_password_reset = get_option('cpr_after_password_reset');

					$argss = array(
							'textarea_name' => 'cpr_after_password_reset[after_passreset_mail_template]',
						);
					$contents = isset($cpr_after_password_reset['after_passreset_mail_template']) ? $cpr_after_password_reset['after_passreset_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="cpr_after_password_reset[passreset_subject]" id="subject"><?php echo $cpr_after_password_reset['passreset_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Admin mail Editor</label></th>
							<td><?php wp_editor( $contents, 'after_passreset_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function cpr_after_password_reset_callback($passreset){
	return $passreset;
}



// Admin approve mail template for jobseeker
function admin_approval_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Mail template Admin Approve</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('admin_approval');
					$admin_approval = get_option('admin_approval');

					$argss = array(
							'textarea_name' => 'admin_approval[adminapprove_mail_template]',
						);
					$contents = isset($admin_approval['adminapprove_mail_template']) ? $admin_approval['adminapprove_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="admin_approval[adminapprove_subject]" id="subject"><?php echo $admin_approval['adminapprove_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Admin mail Editor</label></th>
							<td><?php wp_editor( $contents, 'adminapprove_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function admin_approval_callback($adminapprove){
	return $adminapprove;
}


// Jobseeker profile builder template
function jobseeker_profile_builder_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Jobseeker Profile Builder Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('jobseeker_profile_builder');
					$jobseeker_profile_builder = get_option('jobseeker_profile_builder');

					$argss = array(
							'textarea_name' => 'jobseeker_profile_builder[jobseekerprofilebuilder_mail_template]',
						);
					$contents = isset($jobseeker_profile_builder['jobseekerprofilebuilder_mail_template']) ? $jobseeker_profile_builder['jobseekerprofilebuilder_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="jobseeker_profile_builder[jobseekerprofilebuilder_subject]" id="subject"><?php echo $jobseeker_profile_builder['jobseekerprofilebuilder_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'jobseekerprofilebuilder_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function jobseeker_profile_builder_callback($jobseekerprofilebuilder){
	return $jobseekerprofilebuilder;
}


// Recruiter mail template
function recruiter_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Recruiter Mail Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('recruiter_mail');
					$recruiter_mail = get_option('recruiter_mail');

					$argss = array(
							'textarea_name' => 'recruiter_mail[recruiter_mail_template]',
						);
					$contents = isset($recruiter_mail['recruiter_mail_template']) ? $recruiter_mail['recruiter_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="recruiter_mail[recruiter_subject]" id="subject"><?php echo $recruiter_mail['recruiter_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'recruiter_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function recruiter_mail_callback($recruiter){
	return $recruiter;
}



// Recommend friend mail template
function recommend_friends_mail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Recommend Friend Mail Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('recommend_friends_mail');
					$recommend_friends_mail = get_option('recommend_friends_mail');
					$argss = array(
							'textarea_name' => 'recommend_friends_mail[recommend_friends_mail_template]',
						);
					$contents = isset($recommend_friends_mail['recommend_friends_mail_template']) ? $recommend_friends_mail['recommend_friends_mail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="recommend_friends_mail[recommend_friends_subject]" id="subject"><?php echo $recommend_friends_mail['recommend_friends_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'recommend_friends_mail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function recommend_friends_mail_callback($recommend_friend){
	return $recommend_friend;
}


// Recommend friend mail template
function reach_out_recommendation_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Reach Out For A Recommendation Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('reach_out_recommendation');
					$reach_out_recommendation = get_option('reach_out_recommendation');

					$argss = array(
							'textarea_name' => 'reach_out_recommendation[reach_out_recommendation_template]',
						);
					$contents = isset($reach_out_recommendation['reach_out_recommendation_template']) ? $reach_out_recommendation['reach_out_recommendation_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="reach_out_recommendation[reach_out_recommendation_subject]" id="subject"><?php echo $reach_out_recommendation['reach_out_recommendation_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'reach_out_recommendation_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function reach_out_recommendation_callback($reach_out_recommendation){
	return $reach_out_recommendation;
}



// Recommend friend mail template
function forward_job_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Forward Job Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('forward_job');
					$forward_job = get_option('forward_job');

					$argss = array(
							'textarea_name' => 'forward_job[forward_job_template]',
						);
					$contents = isset($forward_job['forward_job_template']) ? $forward_job['forward_job_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="forward_job[forward_job_subject]" id="subject"><?php echo $forward_job['forward_job_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'forward_job_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function forward_job_callback($forward_job){
	return $forward_job;
}


// Recommend Forward seeker mail template
function forward_seeker_detail_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Forward Seeker Detail Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('forward_seeker_detail');
					$forward_seeker_detail = get_option('forward_seeker_detail');

					$argss = array(
							'textarea_name' => 'forward_seeker_detail[forward_seeker_detail_template]',
						);
					$contents = isset($forward_seeker_detail['forward_seeker_detail_template']) ? $forward_seeker_detail['forward_seeker_detail_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="forward_seeker_detail[forward_seeker_detail_subject]" id="subject"><?php echo $forward_seeker_detail['forward_seeker_detail_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'forward_seeker_detail_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function forward_seeker_detail_callback($forward_seeker_detail){
	return $forward_seeker_detail;
}

// Job seeker mail template reference

function reach_out_reference_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Reach Out For A Reference Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('reach_out_reference');
					$reach_out_reference = get_option('reach_out_reference');

					$argss = array(
							'textarea_name' => 'reach_out_reference[reach_out_reference_template]',
						);
					$contents = isset($reach_out_reference['reach_out_reference_template']) ? $reach_out_reference['reach_out_reference_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="reach_out_reference[reach_out_reference_subject]" id="subject"><?php echo $reach_out_reference['reach_out_reference_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'reach_out_reference_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function reach_out_reference_callback($reach_out_reference){
	return $reach_out_reference;
}


// support service seeker template


function support_service_seeker_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Support Service seeker Mail</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('support_service_seeker');
					$support_service_seeker = get_option('support_service_seeker');

					$argss = array(
							'textarea_name' => 'support_service_seeker[support_service_seeker_template]',
						);
					$contents = isset($support_service_seeker['support_service_seeker_template']) ? $support_service_seeker['support_service_seeker_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="support_service_seeker[support_service_seeker_subject]" id="subject"><?php echo $support_service_seeker['support_service_seeker_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'support_service_seeker_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function support_service_seeker_callback($support_service_seeker){
	return $support_service_seeker;
}

function support_service_admin_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Support Service admin Mail</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('support_service_admin');
					$support_service_admin = get_option('support_service_admin');

					$argss = array(
							'textarea_name' => 'support_service_admin[support_service_admin_template]',
						);
					$contents = isset($support_service_admin['support_service_admin_template']) ? $support_service_admin['support_service_admin_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="support_service_admin[support_service_admin_subject]" id="subject"><?php echo $support_service_admin['support_service_admin_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'support_service_admin_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function support_service_admin_callback($support_service_admin){
	return $support_service_admin;
}


// Follow Up mail template
function follow_up_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Follow up Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('follow_up');
					$follow_up = get_option('follow_up');

					$argss = array(
							'textarea_name' => 'follow_up[follow_up_template]',
						);
					$contents = isset($follow_up['follow_up_template']) ? $follow_up['follow_up_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="follow_up[follow_up_subject]" id="subject"><?php echo $follow_up['follow_up_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'follow_up_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function follow_up_msg_callback($follow_up_msg){
	return $follow_up_msg;
}



// Message Now mail template
function message_now_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Message Now Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('message_now');
					$message_now = get_option('message_now');

					$argss = array(
							'textarea_name' => 'message_now[message_now_template]',
						);
					$contents = isset($message_now['message_now_template']) ? $message_now['message_now_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="message_now[message_now_subject]" id="subject"><?php echo $message_now['message_now_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'message_now_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function message_now_msg_callback($message_now_msg){
	return $message_now_msg;
}


// Forward doc mail template
function forward_doc_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Forward doc Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('forward_doc');
					$forward_doc = get_option('forward_doc');

					$argss = array(
							'textarea_name' => 'forward_doc[forward_doc_template]',
						);
					$contents = isset($forward_doc['forward_doc_template']) ? $forward_doc['forward_doc_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="forward_doc[forward_doc_subject]" id="subject"><?php echo $forward_doc['forward_doc_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'forward_doc_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function forward_doc_msg_callback($forward_doc_msg){
	return $forward_doc_msg;
}

// Job Apply mail template
function job_apply_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Job Apply Mail Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('job_apply');
					$job_apply = get_option('job_apply');

					$argss = array(
							'textarea_name' => 'job_apply[job_apply_template]',
						);
					$contents = isset($job_apply['job_apply_template']) ? $job_apply['job_apply_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="job_apply[job_apply_subject]" id="subject"><?php echo $job_apply['job_apply_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'job_apply_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function job_apply_msg_callback($job_apply_msg){
	return $job_apply_msg;
}

// Thank You Job Apply mail template
function thank_job_apply_templates_callback() {
	?>
		<div class="wrap">
		
			<p><h3>Thank You Job Apply Mail Template</h3></p> 
			
			<?php 
				if(isset($_GET['settings-updated'])){
					?>
						<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
							<p>
								<strong>Settings saved.</strong>
							</p>
							<button class="notice-dismiss" type="button">
								<span class="screen-reader-text">Dismiss this notice.</span>
							</button>
						</div>
					<?php 
				}
			?>

			<form method="post" action="options.php">

				<?php 
					settings_fields('thank_job_apply');
					$thank_job_apply = get_option('thank_job_apply');

					$argss = array(
							'textarea_name' => 'thank_job_apply[thank_job_apply_template]',
						);
					$contents = isset($thank_job_apply['thank_job_apply_template']) ? $thank_job_apply['thank_job_apply_template'] : '';
					
					?>
					<table class="form-table">
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><textarea style="width:100%" name="thank_job_apply[thank_job_apply_subject]" id="subject"><?php echo $thank_job_apply['thank_job_apply_subject']; ?></textarea></td>
						</tr>
						<tr>
							<th><label>Mail Editor</label></th>
							<td><?php wp_editor( $contents, 'thank_job_apply_template', $argss); ?></td>
						</tr>
					</table><?php 
					submit_button();
				?>
			</form>
		</div>

	<?php 
}
function thank_job_apply_msg_callback($thank_job_apply_msg){
	return $thank_job_apply_msg;
}
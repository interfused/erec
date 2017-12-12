<?php
/**
 * Template Name: lostpassword page2
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

/* http://www.sutanaryan.com/2014/08/custom-user-reset-forgot-password-using-ajax-wordpress/ */


get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>

<?php
/*
 * @author	Ryan Sutana
 * @desc	Process all datas coming from theme-ajax.js
 * since 	v 1.0
 */

add_action( 'wp_ajax_nopriv_lost_pass', 'lost_pass_callback' );
add_action( 'wp_ajax_lost_pass', 'lost_pass_callback' );
/*
 *	@desc	Process lost password
 */
function lost_pass_callback() {

	global $wpdb, $wp_hasher;

	$nonce = $_POST['nonce'];

	if ( ! wp_verify_nonce( $nonce, 'rs_user_lost_password_action' ) )
        die ( 'Security checked!');

	//We shall SQL escape all inputs to avoid sql injection.
	$user_login = $_POST['user_login'];

	$errors = new WP_Error();

	if ( empty( $user_login ) ) {
		$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));
	} else if ( strpos( $user_login, '@' ) ) {
		$user_data = get_user_by( 'email', trim( $user_login ) );
		if ( empty( $user_data ) )
			$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
	} else {
		$login = trim( $user_login );
		$user_data = get_user_by('login', $login);
	}

	/**
	 * Fires before errors are returned from a password reset request.
	 *
	 * @since 2.1.0
	 * @since 4.4.0 Added the `$errors` parameter.
	 *
	 * @param WP_Error $errors A WP_Error object containing any errors generated
	 *                         by using invalid credentials.
	 */
	do_action( 'lostpassword_post', $errors );

	if ( $errors->get_error_code() )
		return $errors;

	if ( !$user_data ) {
		$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
		return $errors;
	}

	// Redefining user_login ensures we return the right case in the email.
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;
	$key = get_password_reset_key( $user_data );

	if ( is_wp_error( $key ) ) {
		return $key;
	}

	$message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
	$message .= network_home_url( '/' ) . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
	$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
	//$message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

	// replace PAGE_ID with reset page ID
	$message .= esc_url( get_permalink( PAGE_ID ) . "/?action=rp&key=$key&login=" . rawurlencode($user_login) ) . "\r\n";

	if ( is_multisite() )
		$blogname = $GLOBALS['current_site']->site_name;
	else
		/*
		 * The blogname option is escaped with esc_html on the way into the database
		 * in sanitize_option we want to reverse this for the plain text arena of emails.
		 */
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$title = sprintf( __('[%s] Password Reset'), $blogname );

	/**
	 * Filter the subject of the password reset email.
	 *
	 * @since 2.8.0
	 * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
	 *
	 * @param string  $title      Default email title.
	 * @param string  $user_login The username for the user.
	 * @param WP_User $user_data  WP_User object.
	 */
	$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

	/**
	 * Filter the message body of the password reset mail.
	 *
	 * @since 2.8.0
	 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
	 *
	 * @param string  $message    Default mail message.
	 * @param string  $key        The activation key.
	 * @param string  $user_login The username for the user.
	 * @param WP_User $user_data  WP_User object.
	 */
	$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

	if ( wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
		$errors->add('confirm', __('Check your e-mail for the confirmation link.'), 'message');
	else
		$errors->add('could_not_sent', __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.'), 'message');


	// display error message
	if ( $errors->get_error_code() )
		echo '<p class="error">'. $errors->get_error_message( $errors->get_error_code() ); .'</p>';

	// return proper result
	die();
}

add_action( 'wp_ajax_nopriv_reset_pass', 'reset_pass_callback' );
add_action( 'wp_ajax_reset_pass', 'reset_pass_callback' );
/*
 *	@desc	Process reset password
 */
function reset_pass_callback() {

	$errors = new WP_Error();
	$nonce = $_POST['nonce'];

	if ( ! wp_verify_nonce( $nonce, 'rs_user_reset_password_action' ) )
        die ( 'Security checked!');

	$pass1 	= $_POST['pass1'];
	$pass2 	= $_POST['pass2'];
	$key 	= $_POST['user_key'];
	$login 	= $_POST['user_login'];

	$user = check_password_reset_key( $key, $login );

	// check to see if user added some string
	if( empty( $pass1 ) || empty( $pass2 ) )
		$errors->add( 'password_required', __( 'Password is required field' ) );

	// is pass1 and pass2 match?
	if ( isset( $pass1 ) && $pass1 != $pass2 )
		$errors->add( 'password_reset_mismatch', __( 'The passwords do not match.' ) );

	/**
	 * Fires before the password reset procedure is validated.
	 *
	 * @since 3.5.0
	 *
	 * @param object           $errors WP Error object.
	 * @param WP_User|WP_Error $user   WP_User object if the login and reset key match. WP_Error object otherwise.
	 */
	do_action( 'validate_password_reset', $errors, $user );

	if ( ( ! $errors->get_error_code() ) && isset( $pass1 ) && !empty( $pass1 ) ) {
		reset_password($user, $pass1);

		$errors->add( 'password_reset', __( 'Your password has been reset.' ) );
	}

	// display error message
	if ( $errors->get_error_code() )
		echo '<p class="error">'. $errors->get_error_message( $errors->get_error_code() ); .'</p>';

	// return proper result
	die();
}
?>

<?php /***** FORM *********/ ?>

<div id="lostPassword">
		<div id="message"></div>
		<form id="lostPasswordForm" method="post">
			<?php
				// this prevent automated script for unwanted spam
				if ( function_exists( 'wp_nonce_field' ) )
					wp_nonce_field( 'rs_user_lost_password_action', 'rs_user_lost_password_nonce' );
			?>

			<p>
				<label for="user_login"><?php _e('Username or E-mail:') ?> <br />
					<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" />
				</label>
			</p>
			<?php
			/**
			 * Fires inside the lostpassword <form> tags, before the hidden fields.
			 *
			 * @since 2.1.0
			 */
			do_action( 'lostpassword_form' ); 
			?>
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Get New Password'); ?>" />
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
			</p>
		</form>
	</div>

	<?php /************** */ ?>

	<div id="resetPassword">
	<div id="message"></div>
	<!--this check on the link key and user login/username-->
	<?php
		$errors = new WP_Error();
		$user = check_password_reset_key($_GET['key'], $_GET['login']);

		if ( is_wp_error( $user ) ) {
			if ( $user->get_error_code() === 'expired_key' )
				$errors->add( 'expiredkey', __( 'Sorry, that key has expired. Please try again.' ) );
			else
				$errors->add( 'invalidkey', __( 'Sorry, that key does not appear to be valid.' ) );
		}

		// display error message
		if ( $errors->get_error_code() )
			echo $errors->get_error_message( $errors->get_error_code() );
		?>

		<form id="resetPasswordForm" method="post" autocomplete="off">
			<?php
				// this prevent automated script for unwanted spam
				if ( function_exists( 'wp_nonce_field' ) )
					wp_nonce_field( 'rs_user_reset_password_action', 'rs_user_reset_password_nonce' );
			?>

			<input type="hidden" name="user_key" id="user_key" value="<?php echo esc_attr( $_GET['key'] ); ?>" autocomplete="off" />
			<input type="hidden" name="user_login" id="user_login" value="<?php echo esc_attr( $_GET['login'] ); ?>" autocomplete="off" />

			<p>
				<label for="pass1"><?php _e('New password') ?><br />
				<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" /></label>
			</p>
			<p>
				<label for="pass2"><?php _e('Confirm new password') ?><br />
				<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /></label>
			</p>

			<p class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ &amp; ).'); ?></p>

			<br class="clear" />

			<?php
			/**
			 * Fires following the 'Strength indicator' meter in the user password reset form.
			 *
			 * @since 3.9.0
			 *
			 * @param WP_User $user User object of the user whose password is being reset.
			 */
			do_action( 'resetpass_form', $user );
			?>
			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Reset Password'); ?>" />
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
			</p>
		</form>
	</div>

	<script>
	/*
 * @author Ryan Sutana
 * @description Pass all datas requested through wp-ajax
 * since v 1.0
 */

jQuery(document).ready(function($) {

	// for lost password
	$("form#lostPasswordForm").submit(function(){
		var submit = $("div#lostPassword #submit"),
			preloader = $("div#lostPassword #preloader"),
			message	= $("div#lostPassword #message"),
			contents = {
				action: 	'lost_pass',
				nonce: 		this.rs_user_lost_password_nonce.value,
				user_login:	this.user_login.value
			};

		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');

		// Display our pre-loading
		preloader.css({'visibility':'visible'});

		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');

			// hide pre-loader
			preloader.css({'visibility':'hidden'});

			// display return data
			message.html( data );
		});

		return false;
	});


	// for reset password
	$("form#resetPasswordForm").submit(function(){
		var submit = $("div#resetPassword #submit"),
			preloader = $("div#resetPassword #preloader"),
			message	= $("div#resetPassword #message"),
			contents = {
				action: 	'reset_pass',
				nonce: 		this.rs_user_reset_password_nonce.value,
				pass1:		this.pass1.value,
				pass2:		this.pass2.value,
				user_key:	this.user_key.value,
				user_login:	this.user_login.value
			};

		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');

		// Display our pre-loading
		preloader.css({'visibility':'visible'});

		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');

			// hide pre-loader
			preloader.css({'visibility':'hidden'});

			// display return data
			message.html( data );
		});

		return false;
	});

});
	</script>

<?php get_footer(); ?>

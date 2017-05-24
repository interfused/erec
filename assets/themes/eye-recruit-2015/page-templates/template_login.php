<?php
/**
 * Template Name: Login page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

if ( is_user_logged_in() ) {
	echo wp_redirect( site_url() );
}

get_header('loginpage'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- 	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header> -->

	<style type="text/css">
	#masthead{display: none;}
	</style>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<p class="text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="branding_login">
				<img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/login_logo.png">
			</a></p>
			<div class="loginform_wrapper ">
				
				<div class="loginform">
					
					<h2 class="text-center">Member Login</h2>

					<div class="loader inner-loader" id="loaders" style="display:none;"></div>
					<div id="error_message"></div>
					<div  id="jobseeker">
						<form class="form form-horizontal"  id="jobseekerlogin" action="" method="post">
							<div class="form-group">
								<label for="username">Email</label>
								<input type="text" class="form-control" id="username" name="username" value="<?php  if(!isset($_COOKIE['email'])) { echo ''; }else { echo $_COOKIE['email']; } ?>" placeholder="Enter Email">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" value="<?php  if(!isset($_COOKIE['pass'])) { echo ''; }else { echo $_COOKIE['pass']; } ?>" id="password" placeholder="Enter Password">
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember" id="remember" value="1" <?php  if(!isset($_COOKIE['rem'])) { echo ''; } else { echo 'checked'; } ?>> <span>Remember Me</span>
								</label>
							</div>
							<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce( "eyerecruitjobseeker"); ?>"/>
							<div class="paddedTopBottom"><input type="submit" id="wp_submitseeker" name="wp_submitseeker" value="Login"></div>
							<p>Lost your password ? <a href="<?php  echo site_url(); ?>/lostpassword/">Reset Now</a></p>
							<p>Don't have an account? <a class="get_started_now" href="javascript:void(0);">Get Started Now</a></p>
						</form>
					</div> <!-- jobseeker -->

					<input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo $_REQUEST['redirect_to']; ?>">
				</div> <!-- login-main-form -->
			</div> <!-- login-form-wrapper -->

			<div id="get_started" class="text-center">
				
				<div id="get_started_choice" class="paddedBottom-2x ">
					<h2>Want to Get Started Now?<br><small>Which describes you?</small></h2>
					<a href="<?php echo site_url();  ?>/job-seekers/get-started/" class="btn btn-primary">Looking for work</a> <a href="<?php echo site_url();  ?>/employers/get-started/" class="btn btn-primary">Looking for talent</a>
				</div>
			</div>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->
	<style>
	#wp_submitseeker:hover{ color: #ffffff; background-color: #900;}
	input[type=password],input[type=text]{box-sizing: border-box;}
	.loginform{background-color: #f5f5f5; padding: 2em;}
	.loginform .form-group{margin-left:0; margin-right: 0;}
	.loginform a, a.get_started_now{text-decoration: underline;}
	</style>

	<script type="text/javascript">
	jQuery("#get_started").hide();
	jQuery(".get_started_now").click(function(e){
		jQuery("#get_started").fadeIn('slow');
	});
	</script>
<?php endwhile; ?>

<?php get_footer(); ?>
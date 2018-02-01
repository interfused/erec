<?php
/**
 * Template Name: Employers registration page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<div class="entry-content">
				<div class="row">
					<?php  the_content(); ?>
					<div class="col-md-6 col-md-pull-6 panel callout">
						<div class="loader inner-loader" id="loaders" style="display:none;"></div>

						<h2 class="tight">GET STARTED</h2>
						You are moments away from being able to access the industries most comprehensive catalog of Investigative, Surveillance &amp; Security talent.

						Please fill out the following basic questions to get started.

						<section class="opform_wrapper"><!-- START FORM -->
						<form name="registerform" class="form" id="employersform" action="" method="post">
								<div class="form-group">
									<label  for="firstname">First Name</label>
									<input id="firstname" class="input form-control" name="firstname" type="text" value="" placeholder="" />
								</div>
								<div class="form-group">
									<label for="lastname">Last Name</label>
									<input id="lastname" class="input form-control" name="lastname" type="text" value="" placeholder="" />
								</div>
								<div class="form-group">
									<label for="user_email">E-mail</label>
									<input type="text" name="user_email" id="user_email" class="input" value="" size="20" />
									<div id="error_message"></div>
									<div class="sub_text">This email will be used for your account.</div>
								</div>
								
								<div class="form-group">
									<label  for="company_name">Company</label>
									<input id="company_name" class="input form-control" name="company_name" type="text" value=""/>
								</div>

								<div class="form-group">
									<label  for="office_phone">Office Phone</label>
									<input id="office_phone" class="input form-control" name="office_phone" placeholder="###-###-####" type="tel" value="" />
								</div>

								<div class="form-group">
									<label  for="ext">Ext</label>
									<input id="ext" class="input form-control" name="ext" type="text" value="" placeholder="" />
								</div>
								<div class="form-group">
									<label  for="cell_phone">Cell Phone</label>
									<input id="cell_phone" class="input form-control" name="cell_phone" type="text" placeholder="###-###-####" value="" />
								</div>

								<?php //do_action( 'register_form' ); ?>
								<p class="tml-submit-wrap">
									<input type="submit" name="wp-submit" id="employer_submit" value="Submit" />
									<input type="hidden" name="redirect_to" value="register" />
									<input type="hidden" name="instance" value="" />
									<input type="hidden" name="action" value="register" />
									<input type="hidden" name="role" value="employer" />
								</p>
							</form>
						<!-- END FORM -->
						<div class="login_cta">
						already have an acccount? <a style="text-decoration: underline;" href="<?php echo site_url(); ?>/login/">Login Here</a>
					</div>
						</section>
					</div>
				</div>
			</div>
				<?php comments_template(); ?>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.mask.min.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function($){
		    jQuery("#office_phone").mask("999-999-9999"); 
		    jQuery("#cell_phone").mask("999-999-9999");    
		});
	</script>

<?php get_footer(); ?>
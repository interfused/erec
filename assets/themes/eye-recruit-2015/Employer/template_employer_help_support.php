<?php
/**
 * Template Name: Employers help-support page
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
					<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Customer Help center</h3>
						<span><strong>Recruit ID</strong> : 3585</span>
					</div>
					<div class="indent help_center help_today">
						<div class="sidebar_title cont_title">
							<h4>How can we help you today?</h4>
						</div>
						<p>Take a look at the list of Frequently Asked Questions at the bottom of this page or click the link and take a look within our Knowledge Base. The answers that you are looking for are probably in there somewhere. If you cannot find the information you need, please send an email to <a href="#">Customer Support</a>. We will do our best to respond to you within 1 business day.</p>
						<p><small>At EyeRecruit, we know, what it’s like to be a customer. We realize that getting questions orlooking for support online can be  furstrating. We work hard to provide you with the best possible online experence. We hope you find dedication evident as well.</small></p>
						<div class="indent row">
							<div class="col-sm-4">
								<div class="well">
									<h5>Knowledge Base</h5>
									<p>Browse Articles or search by topics in our new information library regarding all things Eyerecruit. We recommend starting here if you are looking for an answer.</p>
									<a href="#" class="btn btn-default">Let’s Get Learning</a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Submit a Trouble Ticket</h5>
									<p>Browse Articles or search by topics in our new information library regarding all things Eyerecruit. We recommend starting here if you are looking for an answer.</p>
									<a href="#" class="btn btn-default">Submit Ticket</a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Join a Webinar</h5>
									<p>Browse Articles or search by topics in our new information library regarding all things Eyerecruit. We recommend starting here if you are looking for an answer.</p>
									<a href="#" class="btn btn-default">Save My Seat</a>
								</div>
							</div>
						</div>
					</div>
					<div class="indent help_center">
						<div class="sidebar_title cont_title">
							<h4>Advanced Support</h4>
						</div>
						<div class="indent row">
							<div class="col-sm-4">
								<div class="well">
									<h5>Call Us</h5>
									<span class="label label-success">Premium Accounts</span>
									<p>Browse Articles or search by topics in our new information library regarding all things Eyerecruit. We recommend starting here if you are looking for an answer.</p>
									<a href="#" class="btn btn-default">Show Number</a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Live Chat</h5>
									<span class="label label-success">Premium Accounts</span>
									<p>Browse Articles or search by topics in our new information library regarding all things Eyerecruit. We recommend starting here if you are looking for an answer.</p>
									<a href="#" class="btn btn-default">Chat Now</a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Schedule a 1-on-1</h5>
									<span class="label label-success">Premium Accounts</span>
									<p>Browse Articles or search by topics in our new information library regarding all things Eyerecruit. We recommend starting here if you are looking for an answer.</p>
									<a href="#" class="btn btn-default">Schedule</a>
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
<?php get_footer('preferences'); ?>
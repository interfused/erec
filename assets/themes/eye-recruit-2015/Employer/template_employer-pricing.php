<?php
/**
 * Template Name: Employer Pricing
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header('loginpage'); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

<?php while ( have_posts() ) : the_post(); ?>

	<!-- <header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header> -->
	<?php 
	global $wpdb, $current_user;
	$pmpro_levels = pmpro_getAllLevels(false, true);
	?>
	<div id="primary" class="content-area">
		<div id="content" role="main">
			<section class="pricing_page">
				<div class="container">
					<header class="pricing_header">
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<a href="<?php  echo site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/pricing_logo.png" class="img-responsive" alt="pricing_logo"></a>
							</div>
							<div class="col-md-7 col-sm-8"><h2>NO RISK.  NO HIDDEN FEES.  NO MINIMUMS.</h2></div>
						</div>
					</header>
					<div class="employer_pricing">
						<div class="eprice_leftcol">
							<div class="question_bx">
								<h3>Have a Question ?<span>Call 855.899.9500</span></h3>
								<ul>
									<li>Direct Access to Local Job Seekers!</li>
									<li>No expensive Set Up Fees! </li>
									<li>Dedicated Customer Support! </li>
									<li>Focus on Only Qualified Talent! </li>
								</ul>
							</div>
							<ol class="sprice_detail">
								<li>Company Appears in Candidate Searches</li>
								<li>Custom Company Branded Profile <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Custom Company Branded Profile"></i></li>
								<li>Easily Connect with Industry Recruiters</li>
								<li>Standout to Potential Job Seekers</li>
								<li>Featured in Member Spotlight <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Custom Company Branded Profile"></i></li>
								<li>Exclusive Access to Our Communinty</li>
								<li>Advanced Candidate Search Function</li>
								<li>Browse & Save Profiles</li>
								<li>Search by Industry Experience Metrics</li>
								<li>Integrated Live Secure Chat Rooms</li>
								<li>Follow the Careers that Interest You</li>
								<li>Access Employment Documents Realtime</li>
								<li>Full Access to Contact Talent Directly</li>
								<li>Early access to New Features</li>
							</ol>
						</div>
						<div class="eprice_rightcol">
							<div class="row">
								<div class="col-xs-3">
									<div class="sprice_col <?php echo ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 5 ) )? 'sprice_active' : ''; ?>">
										<div class="spricecol_box">
											<h3>lite</h3>
											<h4>$<big>10</big><small>/<br>per day</small></h4>
											<a href="#" class="btn btn-sm btn-warning">Try It Free</a>
											<h5>Save 75%</h5>
										</div>
										<ol class="sprice_detail">
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
										</ol>
										<?php /*if ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 5 ) ) { ?>									 	
											<a href="javascript:void(0);" class="btn btn-success">Your Level</a>
										<?php } else{ ?>
											<a href="<?php  echo site_url();  ?>/membership-checkout/?level=5" class="btn btn-success">Get Started</a>
										<?php } */?>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="sprice_col popular_pricing <?php echo ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 6 ) )? 'sprice_active' : ''; ?>">
										<span class="popular_badge">Most Popular</span>
										<div class="spricecol_box">
											<h3>Starter</h3>
											<h4>$<big>15</big><small>/<br>per day</small></h4>
											<a href="#" class="btn btn-sm btn-warning">Try It Free</a>
											<h5>Save 63%</h5>
										</div>
										<ol class="sprice_detail">
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
										</ol>
										<?php /*if ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 6 ) ) { ?>									 	
											<a href="javascript:void(0);" class="btn btn-success">Your Level</a>
										<?php } else{ ?>
											<a href="<?php  echo site_url();  ?>/membership-checkout/?level=6" class="btn btn-success">Get Started</a>
										<?php } */?>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="sprice_col <?php echo ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 7 ) )? 'sprice_active' : ''; ?>">
										<div class="spricecol_box">
											<h3>Standard</h3>
											<h4>$<big>20</big><small>/<br>per day</small></h4>
											<a href="#" class="btn btn-sm btn-warning">Try It Free</a>
											<h5>Save 50%</h5>
										</div>
										<ol class="sprice_detail">
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
											<li>&nbsp;</li>
										</ol>
										<?php /*if ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 7 ) ) { ?>									 	
											<a href="javascript:void(0);" class="btn btn-success">Your Level</a>
										<?php } else{ ?>
											<a href="<?php  echo site_url();  ?>/membership-checkout/?level=7" class="btn btn-success">Get Started</a>
										<?php } */?>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="sprice_col <?php echo ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 8 ) )? 'sprice_active' : ''; ?>">
										<div class="spricecol_box">
											<h3>Performance</h3>
											<h4>$<big>25</big><small>/<br>per day</small></h4>
											<a href="#" class="btn btn-sm btn-warning">Try It Free</a>
											<h5>Save 38%</h5>
										</div>
										<ol class="sprice_detail">
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
											<li><i class="fa fa-circle"></i></li>
										</ol>
										<?php /*if ( (is_user_logged_in()) && ( $current_user->membership_level->ID == 8 ) ) { ?>									 	
											<a href="javascript:void(0);" class="btn btn-success">Your Level</a>
										<?php } else{ ?>
											<a href="<?php  echo site_url();  ?>/membership-checkout/?level=8" class="btn btn-success">Get Started</a>
										<?php } */?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/verisign_logo.jpg" class="img-respoinsive"></div>
							<div class="col-sm-9"><h2 class="text-center">Find The Plan That Works For You.</h2></div>
						</div>
						
					</div>
				</div>
			</section>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php endwhile; ?>
<?php get_footer('preferences'); ?>
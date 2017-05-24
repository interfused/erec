<?php
/**
 * Template Name: Seeker Serviecs
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php //the_title(); ?>Services</h1>
	</header>
	<?php
	global $wpdb;
	$userid = get_current_user_id();
	$tablename = $wpdb->prefix.'fullstripe_payments';
	$getpreoption = $wpdb->get_row("SELECT * FROM $tablename WHERE formname IN ('the-entry-level-package','the-professional-package','the-executive-package') AND userid = '".$userid."' order by paymentID desc limit 1"); //WHERE formname IN $optionarr
	$getpreoptionname =  ( !empty($getpreoption->formname) )? $getpreoption->formname : '';

	function getoptionurl($getpreoptionname, $url){
		$basurl = site_url().'/job-seekers/resume-support-service-checkout/?serviceType='.$url;
		return ($getpreoptionname == $url)? 'javascript:void(0);' : $basurl;
	}
	?>
	<div id="primary" class="content-area">
		<div id="content" role="main">
			<div class="resume_services">
				<div class="container">
					<p><?php echo get_the_content(); ?></p>
					<hr />
				
					<h3 class="text-center">Upgrade NOW and elevate your career to the next level</h3>
					<div class="row">
						<div class="col-sm-4">
							<div class="pricing-table-widget <?php echo ($getpreoptionname == 'the-entry-level-package')? 'sprice_active':''; ?>">
								<div class="text-center iconArea">
									<h4 class="pricing-table-widget-title">The Entry Level Package</h4>
									<h5>$<big>99</big><br><strong>limited time!</strong></h5>
								</div>
								<div class="pricing-table-widget-description">
								<ul class="checkmarks">
									<li>This package is for entry-level clients with less than 5 years of work experience. Choose this service if you are a student, recent college graduate, transitioning from general military service or you are an aspiring professional.</li>
									<li>Our entry-level package is designed to showcase your education, coursework, related experience and transferable skills.</li>
									<li>Best of all, our process are reasonable. We don’t charge hundreds of dollars to write a resume. By acting now, you can get your new career off to the right start for less than $100!</li>
								</ul>
								<a class="btn btn-success" href="<?php echo getoptionurl($getpreoptionname, 'the-entry-level-package'); ?>"><?php echo ($getpreoptionname == 'the-entry-level-package')? 'SELECTED':'SELECT OPTION'; ?></a>
								<!--* Limited Discount: (30% Until January 1st 2016 - taken at checkout) --> 
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="pricing-table-widget popular_bx <?php echo ($getpreoptionname == 'the-professional-package')? 'sprice_active':''; ?>">
								<span class="popular_badge">Most Popular</span>
								<div class="text-center iconArea">
									<h4 class="pricing-table-widget-title">The Professional Package</h4>
									<h5>$<big>199</big></h5>
								</div>
								<div class="pricing-table-widget-description">
								<ul class="checkmarks">
									<li>This package is designed for clients who have more than 5 years of total work experience in the industry. Choose this service if you are a non-technical, supervisor, manager and mid-level management professional.</li>
									<li>Our Professional-level package is designed to highlight your experience and leadership and leverage that for your next role.</li>
									<li>A resume remains one of the most acceptable means of self-promotion. Make a great impression and target your personal skills and accomplishments.</li>
								</ul>
								<a class="btn btn-success" href="<?php echo getoptionurl($getpreoptionname, 'the-professional-package'); ?>"><?php echo ($getpreoptionname == 'the-professional-package')? 'SELECTED':'SELECT OPTION'; ?></a> 
								<!--* Limited Discount: (30% Until January 1st 2016 - taken at checkout) -->
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="pricing-table-widget <?php echo ($getpreoptionname == 'the-executive-package')? 'sprice_active':''; ?>">
								<div class="text-center iconArea">
									<h4 class="pricing-table-widget-title">The Executive Package</h4>
									<h5>$<big>399.</big><small>95</small></h5>
								</div>
								<div class="pricing-table-widget-description">
								<ul class="checkmarks">
									<li>This package is designed for corporate level executives who have extensive working experience in the industry, proven leadership and a track record of goal attainment.</li>
									<li>If you are looking to take the next step in your career or transition into another organization in a similar capacity, your resume will be tailored and designed to your position of choice.</li>
									<li>Deliberately focused one-on-one assessment to clarify your goals and gather preliminary information to translate into more interviews and job offers for you to continue to advance your career.</li>
								</ul>
								<a class="btn btn-success" href="<?php echo getoptionurl($getpreoptionname, 'the-executive-package'); ?>"><?php echo ($getpreoptionname == 'the-executive-package')? 'SELECTED':'SELECT OPTION'; ?></a>
								<!--* Limited Discount: (30% Until January 1st 2016 - taken at checkout) -->
								</div>
							</div>
						</div>
					</div>
					<!-- <h3>So, how do we get started?</h3>
					<p>It's simple. You select a service above and we will provide you with a <strong>free resume critique</strong> from one our our resume consultants. The critique will provide you with an honest, direct assessment of your current resume. This will also give us a clear understanding of exactly how much support you are going to need.</p>
					<p>We then tailor your needs to match your level of experience and specific requirements or we can continue by selecting one of our prepared Resume options.</p>
				 --></div>
					<?php

					/*<div class="col-md-4">
						<?php if ( has_post_thumbnail() ) : ?>
						    <a class="other_service_img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						        <?php the_post_thumbnail(); ?>
						    </a>
						<?php endif; ?>
					</div>
					<div class="col-md-8">
						<div class="services_title"> <h2><?php  the_title(); ?></h2></div>
						<?php the_content(); ?>
						<?php 
						global $wpdb;
						$post = get_post(get_the_ID()); 
						$slug = $post->post_name;
						$tablename = $wpdb->prefix.'fullstripe_payments';
						$userid = get_current_user_id();
						$get = $wpdb->get_row("SELECT * FROM $tablename WHERE formname = '".$slug."' AND userid = '".$userid."' ");
						if( !empty( $get->formname ) ){

						}
						else{	 
							?>
							<form method="get" action="<?php echo site_url().'/support-service-checkout/'; ?>" >
								<input type="hidden" value="<?php echo $slug; ?>" name="serviceType">
								<div class="text-center"><button type="submit" class="btn btn-primary">Pay Now</button></div>
							</form>
						<?php } ?>
					</div>*/ 	 ?>

				<!-- </div> -->
			</div>
				
				<?php //comments_template(); ?>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('assessment'); ?>


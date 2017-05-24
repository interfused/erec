 <?php
/**
 * Template Name: seeker support service checkout
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

$userID = get_current_user_id();
$userdata = get_userdata($userID);
if ( in_array('employer', $userdata->roles) ) {
	$url = site_url();
	echo  wp_redirect($url);
}

get_header(); 
?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<section class="upgrade_membership">
				<?php 
				if ( isset($_REQUEST['serviceType']) ) {
					$servicename =  $_REQUEST['serviceType']; 
				}

				if ( !empty($servicename) ) { 
					global $wpdb;
					$formtable = $wpdb->prefix . "fullstripe_payment_forms";
					$paymentForms = $wpdb->get_row("SELECT * FROM $formtable WHERE name = '".$servicename."' ");

					?>
					<div class="membership_about">
						<div class="section_title">
							<h3><?php  echo $paymentForms->formTitle; ?></h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<?php echo do_shortcode('[fullstripe_payment form="'.$servicename.'"]'); ?>
						</div>
						<div class="col-md-4">
							<div class="special_box special_logo">
								<div class="thumbnail"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive"></div>
								<h5>What You'll Get Going <?php echo $paymentForms->formTitle; ?></h5>
								<?php 
								$rep = array('\"checkmarks\"', 'checkmarks');
								$repto = array('','');
								echo str_replace($rep, $repto, $paymentForms->formcontent);  
								?>
							</div>
						    <div class="special_box">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/security_pro_img.jpg" class="img-responsive">
						    </div>
						</div>
					</div>

				<?php } else {
					echo "Nothing Found.";
				} ?>
			</section>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
<?php get_footer('preferences'); ?>

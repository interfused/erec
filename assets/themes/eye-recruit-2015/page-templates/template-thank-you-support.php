<?php
/**
 * Template Name: Thank You Support Service
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.5
 */

	global $wpdb;
	$site_url = site_url(); 
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		if ( in_array('candidate', $current_user->roles) ) {
			$redirectUrl = $site_url.'/dashboard/';
		}
		elseif ( in_array('employer', $current_user->roles) ) {
			$redirectUrl = $site_url.'/employer-dashboard/';
		}
		elseif ( in_array('administrator', $current_user->roles) ) {
			$redirectUrl = $site_url.'/wp-admin/';
		}
	}
	else{
		$redirectUrl = $site_url;
	}
	$userid = get_current_user_id();
	$tablename = $wpdb->prefix.'fullstripe_payments';
	$fortablename = $wpdb->prefix.'fullstripe_payment_forms';
	if ( isset($_GET['serviceType']) && !empty($_GET['serviceType']) ) {
		$getpreoption = $wpdb->get_row("SELECT * FROM $tablename WHERE formname = '".$_GET['serviceType']."' AND userid = '".$userid."' order by paymentID desc limit 1"); //WHERE formname IN $optionarr
		if ( !empty($getpreoption->formname) ) {
			$getformtitle = $wpdb->get_row("SELECT * FROM $fortablename WHERE name = '".$getpreoption->formname."' ");
			$formtitle = $getformtitle->formTitle;
			$resumeplanArr = array( 'the-entry-level-package', 'the-professional-package', 'the-executive-package');
			if ( in_array($_GET['serviceType'], $resumeplanArr) ) {
				$formtitle = 'Resume '.$formtitle;
			}
		}
		else{
			$formtitle = '';
			echo wp_redirect($redirectUrl);
		}
	}
	else{
		$formtitle = '';
		echo wp_redirect($redirectUrl);
	}

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title">Thank you for Choosing <?php echo $formtitle; ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>
				<div class="entry-summary">
					<div class="clearfix"></div>
					<?php echo  get_the_content(); ?>
				</div>
			</article><!-- #post -->
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer(); ?>
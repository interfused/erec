<?php
/**
 * Template Name: Preferences Run A Fresh Background Check page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>
<?php
$userID = get_current_user_id();
?>
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
						<h3>Fresh Background Check</h3>
						<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
					</div>
					<div class="indent">
					<?php echo do_shortcode(get_the_content()); ?>
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
<style type="text/css">
	.wpcf7-not-valid-tip{
		display: none !important;
	}
</style>
<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('.wpcf7-form').validate({
			rules: {
				'your-name': {
					required: true
				},
				'your-email': {
					required: true
				},
				'your-subject': {
					required: true
				},
				'your-message': {
					required: true
				}
			},
			messages: {
				'your-name': {
					required: 'Please enter your name'
				},
				'your-email': {
					required: 'Please enter your email'
				},
				'your-subject': {
					required: 'Please enter an subject'
				},
				'your-message': {
					required: 'Please type your message'
				}
			}
		});
	});
</script>
<?php
/**
 * Template Name: Preferences (bare)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<?php
$user_id = get_current_user_id();
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
							<h3><?php the_title();?></h3>
							<span><strong>Recruit ID</strong> : <?php echo $user_id; ?></span>
						</div>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</section>


		
	<?php endwhile; ?>
<?php get_footer('preferences'); ?>
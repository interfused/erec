<?php
/**
 * Template Name:background-verifications
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
	<section class="back_verification">
		<div class="container">
			<div class="section_title">
				<h3>Background Verification</h3>
				<span><strong>Recruit ID</strong> : 3585</span>
			</div>
			<div class="row">
				<div class=""></div>
			</div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<!-- <?php //get_template_part( 'content', 'page' ); ?>-->
			<?php comments_template(); ?>
		</div><!-- #content -->

		<?php //do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer(); ?>

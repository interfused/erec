<?php
/**
 * Template Name: My account
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
		<div id="content" role="main">
		<section class="myaccount">
			<div class="container">
			<?php  the_content();  ?>
			</div>
		</section>	

				
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>


<?php get_footer(); ?>



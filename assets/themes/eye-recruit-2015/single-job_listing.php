<?php
/**
 * Single Post
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php if ( is_singular( 'job_listing' ) ) : ?>
		<?php get_template_part( 'content-single', 'job' ); ?>
	<?php endif; ?>

	<?php do_action( 'jobify_loop_after' ); ?>
		
<?php endwhile; ?>

<?php get_footer('employer'); ?>
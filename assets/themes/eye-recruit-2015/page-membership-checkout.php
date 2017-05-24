<?php
/**
 * Single Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title">
		<?php
		if ( is_user_logged_in() ) {
			global $current_user;
			if ( in_array('candidate', $current_user->roles) ) {
				the_title();
			}
			else if ( in_array('employer', $current_user->roles) ) {
				echo "Plan";
			}
			else{
				the_title(); 
			}
		} else{
			the_title(); 
		}
		?>
		</h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<?php get_template_part( 'content', 'page' ); ?>
			<?php comments_template(); ?>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer(); ?>
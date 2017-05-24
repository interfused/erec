<?php
/**
 * 404
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

	<header class="page-header">
		<h1 class="page-title">
			<?php _e( 'Page Not Found', 'jobify' ); ?>
		</h1>
	</header>

	<div id="primary" class="content-area error-page">
		<div id="content" class="container" role="main">

			<!-- <div class="blog-archive">
				<?php //get_template_part( 'content', 'none' ); ?>
			</div> -->

			<div class="error-404"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/error-404.png" class="img-responsive"></div>

		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
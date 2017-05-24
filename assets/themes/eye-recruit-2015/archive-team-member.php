<?php
/**
 * Archives
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

	<header class="page-header">
   
		<h1 class="page-title">
			 EYE RECRUIT TEAM
		</h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">

			<div class="blog-archive row">
				<div class="col-md-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '8' : '12'; ?> col-xs-12">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'grid2' ); ?>
						<?php endwhile; ?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</div>

				<?php get_sidebar(); ?>
			</div>

		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->
<style>
h2.entry-title{font-size:1.4rem;}
.featured-image img{width:250px; height:250px; margin-bottom:1rem;}
.featured-image:hover {opacity:.7; padding-bottom:1rem;}
</style>
<?php get_footer(); ?>
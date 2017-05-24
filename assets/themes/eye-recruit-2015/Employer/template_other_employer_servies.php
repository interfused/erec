<?php
/**
 * Template Name: Employers Serviecs
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php //the_title(); ?>Services</h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<div class="other_services">
				<div class="row">
					<div class="col-md-4">
						<?php if ( has_post_thumbnail() ) : ?>
						    <a class="other_service_img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						        <?php the_post_thumbnail(); ?>
						    </a>
						<?php endif; ?>
					</div>
					<div class="col-md-8">
						<div class="services_title"> <h2><?php  the_title(); ?></h2></div>
						<?php the_content(); ?>
						<div class="text-center"><a href="javascript:void(0);" class="btn btn-primary">Pay Now</a></div> 
					</div>

				</div>
			</div>
				
				<?php //comments_template(); ?>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('assessment'); ?>
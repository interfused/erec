<?php
/**
 * Testimonials
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php echo apply_filters( 'jobify_testimonial_page_title', post_type_archive_title( '', false ) ); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="row" role="main">
			<?php
				the_widget(
					'Jobify_Widget_Testimonials',
					array(
						'title'       => null,
						'description' => null,
						'number'      => 8,
						'background'  => null,
						'animations'  => 0
					),
					array(
						'widget_id'     => 'widget-area-front-page',
						'before_widget' => '<section class="jobify_widget_testimonials row">',
						'after_widget'  => '</section>',
						'before_title'  => '<h3 class="homepage-widget-title">',
						'after_title'   => '</h3>',
					)
				);
			?>
            <div id="shareTestimonial" class="swatch1 text-center  paddedTop-2x paddedBottom-2x">
            <h2>Have something interesting to share?</h2>
            <a href="http://eyerecruit.com/add-my-testimonial/" class="button">Share My Story</a>
            </div>
		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>
<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-md-6 col-sm-12' ); ?>>
	<header class="entry-header text-center">
		<a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"> <?php the_post_thumbnail('medium', array('class' => 'round')); ?></a>

		<h2 class="entry-title text-center">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
             <?php
			 $tmpVal=types_render_field("work-position", array("raw"=>"true"));

		if( $tmpVal) 
    echo '<br><small>'.$tmpVal.'</small>'; 
		?>
		</h2>
<!-- 
		<div class="entry-meta">
			<?php echo get_the_date(); ?>
			<?php if ( comments_open() ) : ?>
				<span class="comments-link">
					 |
					<?php comments_popup_link( __( '0 Comments', 'jobify' ), __( '1 Comment', 'jobify' ), __( '% Comments', 'jobify' ) ); ?>
				</span><!-- .comments-link -->
			<?php endif; ?>
		</div>
         -->
	</header><!-- .entry-header -->

	<div class="entry">
		<div class="entry-summary">
			<?php // the_excerpt(); ?>

			<p class="text-center"><a href="<?php the_permalink(); ?>" rel="bookmark" class="button button-medium"><?php _e( 'View Info', 'jobify' ); ?></a></p>
		</div>
	</div>
</article><!-- #post -->
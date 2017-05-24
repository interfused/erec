<?php
/**
 * single eye recruit team member template
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>

	<header class="entry-header col-sm-3 col-xs-12">
	<?php the_post_thumbnail( 'full', array( 'class' => 'roundOutline' ) ); ?>
<?php
$my_meta = get_post_meta( $post->ID, 'er_teammember_details', true ); 
?>
		<ul class="fa-ul">
         <?php
		if( !empty( $my_meta[0]['work-email'] ) ) 
    echo '<li><i class="fa fa-envelope"></i> <a href=mailto:'.$my_meta[0]['work-email'].'">e-mail me</a></li>'; 
		?>
        </ul>
	</header><!-- .entry-header -->

	<div class="entry col-sm-9 col-xs-12">
		 

		<?php if ( is_single() ) : ?>
		
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; ?>

		<div class="entry-summary">
			<?php if ( is_singular() ) : ?>
				<?php the_content(); ?>

				<?php if ( is_singular() ) : ?>
				<?php the_tags( '<p class="entry-tags"><i class="icon-tag"></i> ' . __( 'Tags:', 'jobify' ) . ' ', ', ', '</p>' ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'jobify' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				<?php endif; ?>
			<?php else : ?>
				<?php the_excerpt(); ?>

				<p><a href="<?php the_permalink(); ?>" rel="bookmark" class="button button-medium"><?php _e( 'Continue Reading', 'jobify' ); ?></a></p>
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post -->
<hr />
<p class="text-center"><a href="/eyerecruit_team" class="button">BACK TO TEAM</a></p>
<hr />
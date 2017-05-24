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
<?php
$my_meta = get_post_meta( $post->ID, 'er_teammember_details', true ); 
?>
	<?php while ( have_posts() ) : the_post(); ?>
<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?>
        <?php
		if( !empty( $my_meta[0]['position'] ) ) 
    echo '<br><small>'.$my_meta[0]['position'].'</small>'; 
		?>
        </h1>
        
	</header>
	<div id="primary" class="content-area">
    

			<div id="content" class="container" role="main">

				<div class="blog-archive row">
					<div class="col-md-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '9' : '12'; ?> col-xs-12">
						<?php get_template_part( 'content', 'single-eyerecruit_team' ); ?>
						<?php comments_template(); ?>
					</div>

					<?php get_sidebar(); ?>
				</div>

			</div><!-- #content -->

		 

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer(); ?>
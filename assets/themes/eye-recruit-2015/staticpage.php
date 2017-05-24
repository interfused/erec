<?php
/**
 * Template Name: Static Page
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
		<div id="content" class="container" role="main">
			<?php get_template_part( 'content', 'page' ); ?>
			<?php comments_template(); ?>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

	<?php if ( is_user_logged_in() ) { ?>
		<script type="text/javascript">
			jQuery(document).ready( function() {
				jQuery('.ready_to_started').remove();
			});
		</script>
	<?php } ?>

<?php get_footer(); ?>

<?php if( is_page(1882) || is_page(2330) ){ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.mask.min.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function($){
		    jQuery("input[name='tel-493']").mask("999-999-9999"); 
		    jQuery("input[name='tel-729']").mask("999-999-9999"); 
		});
	</script>
<?php } ?>
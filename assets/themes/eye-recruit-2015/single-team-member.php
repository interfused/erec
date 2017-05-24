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
<header class="page-header">
		<h1 class="page-title">Our Team</h1>
	</header>
    
	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">

<div class="row paddedTop paddedBottom">
<div class="col-md-3 text-center paddedBottom"><?php the_post_thumbnail('medium', array('class' => 'round')); ?>


</div>
<div class="col-md-9">
<?php the_title('<h1 class="tight">','</h2>');?>
<?php
$tmpVal=types_render_field("work-position", array("raw"=>"true"));
if($tmpVal){
echo ('<h2 class="tight">'.$tmpVal.'</h2>');
}
?>
<div class="teamContact tight borderBottom">
<span class="h4">Get In Touch: </span>
<?php
///BUILD CONTACTS
$tmpVal=types_render_field("work-email", array("raw"=>"true"));
if($tmpVal){
echo ('<a href="mailto:'.$tmpVal.'"><i class="fa fa-envelope "></i></a>');
}
?>
</div>
<?php the_content(); ?></div>
</div>


				

			</div><!-- #content -->


		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
<style>
.gray{color:#888;}
.h4{font-family:'Rokkitt'; text-transform:uppercase;}
.teamContact{font-size:1.2rem;}
</style>
<?php get_footer(); ?>
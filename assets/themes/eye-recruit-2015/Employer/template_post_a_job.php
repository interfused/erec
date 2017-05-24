<?php
/**
 * Template Name:Employer post a job
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
			
				<?php the_content(); ?>
				<?php //comments_template(); ?>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
<script type="text/javascript">
jQuery(document).ready(function(){

    // jQuery('.job_listing_preview_title input[name="edit_job"]').remove();

	/*jQuery(".fieldset-job_physical_requirements").trigger('click');
		//For reset password form
    jQuery("#submit-job-form").validate({
        rules: {
            job_category: {
                         required: true            
            }
       
             
         },            
        messages: {
            job_category: {
                         required: "Plese select a job category"                   
            }
             
    	},
		submitHandler: function(form) {
		   // jQuery(form).Submit();
		}

	});*/

});
</script>
<?php get_footer('employer'); ?>
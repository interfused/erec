<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
//exit;
global $post;
?>

<?php //do_action( 'single_job_listing_meta_before' ); ?>
<?php //do_action( 'single_job_listing_meta_start' ); ?>
<?php
/* if( !$_SESSION['restrictView'] ){
	?>
    <li class="job-company">
		<?php
		if ( class_exists( 'Astoundify_Job_Manager_Companies' ) && '' != get_the_company_name() ) :
			$companies   = Astoundify_Job_Manager_Companies::instance();
			$company_url = esc_url( $companies->company_url( get_the_company_name() ) );
		?>
		<a href="<?php echo $company_url; ?>" target="_blank"><?php the_company_name(); ?></a>
		<?php else : ?>
			<?php the_company_name(); ?>
		<?php endif; ?>
	</li>
    <?php
}*/
?>
<!-- <li class="job-date-posted"><i class="icon-calendar"></i> <?php //printf( __( 'Posted <date>%s</date> ago', 'jobify' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></li> -->
<?php //do_action( 'single_job_listing_meta_end' ); ?>
<?php //do_action( 'single_job_listing_meta_after' ); ?>

<!-- <div id="content" class="container hgfhfghfgh" role="main"> -->
	<!-- <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> -->
		<!-- <div class="entry-content"> -->
       
			<?php if ( 'preview' == $post->post_status ) : ?>
           
				<?php get_job_manager_template_part( 'content-single', 'job_listing' ); ?>
			<?php else : ?>
				<?php the_content(); ?>
			<?php endif; ?>

			<?php get_template_part( 'content-single-job', 'related' ); ?>
		<!-- </div> -->
	<!-- </article> -->
<!-- </div> -->

<?php
//INTERFUSED DEBUGGING
if(is_interfused() ){
	?>


<div id="debug">
<small>SINGLE EYE RECRUIT JOB</small>
<?php 
$myvals = get_post_meta( get_the_ID() );

foreach($myvals as $key=>$val)
{
    echo $key . ' : ' . $val[0] . '<br/>';
}
?>
</div>
    <?php
}
?>
<?php
/**
 *
 */
/*
if ( 'side' == jobify_theme_mod( 'jobify_listings', 'jobify_listings_display_area' ) )
	return;
*/
//$columns = jobify_theme_mod( 'jobify_listings', 'jobify_listings_topbar_columns' );
$columns = 12;
//$colspan = jobify_theme_mod( 'jobify_listings', 'jobify_listings_topbar_colspan' );
$colspan=2;
$colspan = array_map( 'trim', explode( ' ', $colspan ) );

$args    = array(
	'before_widget' => '<aside class="job_listing-widget-top default-widget">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="job_listing-widget-title-top">',
	'after_title'   => '</h3>'
);
?>

<div class="job-meta-top swatch3 padded">
	<?php do_action( 'single_job_listing_info_before' ); ?>
	<div class="text-center">
	<?php
	//logo here
	//from types plugin
	//$uncloakCheck=types_render_field("uncloak-job-listing", array("raw"=>"true"));
	if( is_er_listing_uncloaked()  ){
		the_widget( 'Jobify_Widget_Job_Company_Logo', array(), $args );
	}else{
		?>
	    <img src="http://eyerecruit.com/assets/uploads/2015/01/icon-resume.png" />
	    <?php
	}
	?>
</div>
<div class="">
<h3>At a Glance</h3>
<?php //echo esc_attr( $post->post_title ); ?>

<h4 class="tightBottom">Location(s)</h4>
<?php the_job_location(false); ?>

 <h4 class="tightBottom">Status</h4>
<?php the_job_type(); ?>

<h4 class="tightBottom">Compensation</h4>
                            <p>
                            <?php
							///HOURLY
							$er_JobMeta = get_post_meta( get_the_ID() );
							$tmp=$er_JobMeta['_job_pay_hourly'][0];
							$tmp2=$er_JobMeta['_job_pay_yearly'][0];
							 
							if($tmp != 'n/a'){
								echo $tmp. ' per hour';
							}
							if($tmp != 'n/a' && $tmp2 != 'n/a'){
								echo ' / ';
							}
							
							if($tmp2 != 'n/a'){
								echo $tmp2. ' per year';
							}
							
							if($tmp == 'n/a' && $tmp2 == 'n/a'){
								echo 'DOE';
							}
							
							//SALARY
							?>
</p>
 
<?php if ( ! class_exists( 'WP_Job_Manager_Job_Tags' ) ) : ?>
<?php the_widget( 'Jobify_Widget_Job_Categories', array( 'title' => __( 'Job Category', 'jobify' ) ), $args ); ?>
<?php else : ?>
<?php the_widget( 'Jobify_Widget_Job_Tags', array( 'title' => __( "Job Tags", 'jobify' ) ), $args ); ?>
<?php endif; ?>
 



<?php // the_widget( 'Jobify_Widget_Job_Company_Social', array( 'title' => __( 'Company Details', 'jobify' ) ), $args ); ?>

</div>

	 

	<?php do_action( 'single_job_listing_info_after' ); ?>

</div>

<div class="swatch3 marginTop padded">
<h3 class="tight">Contact Info</h3>
<p><strong>Lead Recruiter</strong><br>
Christopher Bauer<br>
<a href="mailto:resumes@eyerecruit.com?subject=Interested in EyeRecruit Job: <?php the_title() ?>&body=I am intereseted in the following job located at: <?php the_permalink() ?>">Contact Now</a>
</div>
<?php
/**
 *
 */

global $post;

$skills     = wp_get_object_terms( $post->ID, 'resume_skill', array( 'fields' => 'names' ) );
$education  = get_post_meta( $post->ID, '_candidate_education', true );
$experience = get_post_meta( $post->ID, '_candidate_experience', true );

$info            = jobify_theme_mod( 'jobify_listings', 'jobify_listings_display_area' );

$has_local_info  = is_array( $skills ) || $education || $experience;

$col_description = 'top' == $info ? '12' : ( $has_local_info ? '6' : '10' );
$col_info        = 'top' == $info ? '12' : ( 'side' == $info ? '4' : '6' );
?>

<div class="single-resume-content row">

	<?php if ( resume_manager_user_can_view_resume( $post->ID ) ) : ?>

		<?php do_action( 'single_resume_start' ); ?>

		<?php // locate_template( array( 'sidebar-single-resume-top.php' ), true, false ); ?>
<section id="contactDetails">
<?php the_widget( 'Jobify_Widget_Resume_Links', array( 'title' => __( 'Candidate Details', 'jobify' ) ), $args ); ?>

					<?php the_widget( 'Jobify_Widget_Job_Apply', array(), $args ); ?>
</section>

<section>
<div class="row">
<div class="col-md-4 text-center "><?php  the_widget( 'Jobify_Widget_Job_Company_Logo', array(), $args ); ?></div>
<div class="col-md-8  "><div class="resume_description col-md-<?php echo $col_description; ?> col-sm-12">
			<h2 class="job-overview-title borderBottom tight"><?php _e( 'Career Highlights', 'jobify' ); ?></h2>

			<?php echo apply_filters( 'the_resume_description', get_the_content() ); ?>
		</div></div>
</div>
</section>

		

		<?php if ( $has_local_info ) : ?>

		<div class="resume-info col-xs-12">

			<?php if ( $skills && is_array( $skills ) && 'side' == $info ) : ?>
				<h2 class="job-overview-title"><?php _e( 'Skills', 'jobify' ); ?></h2>

				<ul class="resume-manager-skills">
					<?php echo '<li>' . implode( '</li><li>', $skills ) . '</li>'; ?>
				</ul>
			<?php endif; ?>

<section>

<?php if ( get_option( 'resume_manager_enable_skills' ) ) : ?>
						<?php the_widget( 'Jobify_Widget_Resume_Skills', array( 'title' => __( 'Core Competencies', 'jobify' ) ), $args ); ?>
					<?php endif; ?>
</section>
			

			<?php if ( $experience ) : ?>
            
				<h2 class="job-overview-title borderBottom tight"><?php _e( 'Professional Experience', 'jobify' ); ?></h2>

				<section class="resume-manager-experience">
				<?php
					foreach( $experience as $item ) : ?>
<div class="row borderBottom paddedTop">
            <div class="col-md-4">
            <h3 class="tight"><?php echo esc_html( $item['employer'] ); ?></h3>
            <strong class="job_title"><?php echo esc_html( $item['job_title'] ); ?></strong>        <br>
   <small class="date"><?php echo esc_html( $item['date'] ); ?></small>
							 
            </div>
            <div class="col-md-8">							<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
	</div>
            </div>
						
	

					<?php endforeach;
				?>
				</section>
			<?php endif; ?>
            
            <?php if ( $education ) : ?>
				<h2 class="job-overview-title borderBottom tight"><?php _e( 'Education & Credentials', 'jobify' ); ?></h2>

				<dl class="resume-manager-education">
				<?php
					foreach( $education as $item ) : ?>

						<dt>
							<h3><?php echo esc_html( $item['location'] ); ?></h3>
						</dt>
						<dd>
							<small class="date"><?php echo esc_html( $item['date'] ); ?></small>
							<strong class="qualification"><?php echo esc_html( $item['qualification'] ); ?></strong>
							<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
						</dd>

					<?php endforeach;
				?>
				</dl>
			<?php endif; ?>
            
		</div>

		<?php endif; ?>

		<?php locate_template( array( 'sidebar-single-resume.php' ), true, false ); ?>

		<?php do_action( 'single_resume_end' ); ?>

	<?php else : ?>

		<?php get_job_manager_template_part( 'access-denied', 'single-resume', 'resume_manager', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

	<?php endif; ?>

</div>

<style>
.entry-content{margin:0;}
.page-subtitle{font-size:1.2rem; color:#ccc;}
.jobify_widget_resume_skills h2{font-size:23px; padding:0; margin:0; margin-bottom:1rem; border-bottom:1px solid #ccc;}
#contactDetails .resume-links, #contactDetails .resume-links li{display:inline;}

.jobify_widget_job_apply div, .jobify_widget_job_apply form, .jobify_widget_resume_links, .jobify_widget_job_apply{display:inline-block;  }
a.bookmark-notice{padding:15px 50px !important;}
</style>
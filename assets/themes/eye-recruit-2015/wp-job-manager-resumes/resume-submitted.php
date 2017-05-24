<?php
switch ( $resume->post_status ) :
	case 'publish' :
		if ( resume_manager_user_can_view_resume( $resume->ID ) ) {
			printf( '<p class="resume-submitted">' . __( 'Resume submitted successfully. To view your resume <a href="%s">click here</a>.', 'wp-job-manager-resumes' ) . '</p>', get_permalink( $resume->ID ) );
		} else {
			print( '<p class="resume-submitted">' . __( 'Resume submitted successfully.', 'wp-job-manager-resumes' ) . '</p>' );
		}
	break;
	case 'pending' :
	$resMsg='Resume submitted successfully. Thanks for signing up. Your resume will be visible once approved. While we begin to prepare your profile, please tell us what you are struggling with right now?';
	
		printf( '<p class="resume-submitted">' . __( $resMsg, 'wp-job-manager-resumes' ) . '</p>', get_permalink( $resume->ID ) );
		//echo do_shortcode('[gravityform id="2" name="Job Seeker Issues" title="false" description="false"]');
		echo do_shortcode('[contact-form-7 id="2853" title="Notes - Job Seekers"]');
		echo '<p>Not struggling with anything?<br><a href="/job-seekers/dashboard/" class="button button-small">Back to Dashboard</a></p>';
		?>
        <script>jQuery(document).ready(function(){jQuery(".page-title").text("Resume Submitted Successfully");});</script>
        <?php
		/* INTERFUSED */
		global $current_user;
      get_currentuserinfo();
		 /*
		 echo 'em:'.$current_user->user_email;
		 echo '<br>f: '.$current_user->user_firstname;
		 echo '<br>l: '.$current_user->user_lastname;
		 echo '<br>d: '.$current_user->display_name;
		 */
		echo '<script>jQuery(window).load(function(){jQuery("#input_2_1").val("'.$current_user->user_email.'");});</script>';
	break;
	default :
		do_action( 'resume_manager_resume_submitted_content_' . str_replace( '-', '_', sanitize_title( $resume->post_status ) ), $resume );
	break;
endswitch;
<?php
/**
 * Template Name: Cover Letter page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header('loginpage');

$current_user = wp_get_current_user();
if ( is_user_logged_in() ){ /*in_array( 'candidate', $current_user->roles)*/
	$userID = get_current_user_id();
}
else{
 	$url = site_url();
 	echo wp_redirect($url);
}

$userdata = get_userdata($userID);
$cand_name = $userdata->first_name.' '.$userdata->last_name;
$last_name = $userdata->last_name;
$email = $userdata->user_email;

$sector = get_cimyFieldValue($userID,'BEST_INDUSTRY');
$closedtMetro = get_cimyFieldValue($userID,'MAJOR_METROPOLITAN');
$aboutEye = get_cimyFieldValue($userID,'REF_SRC');
$experience = get_cimyFieldValue($userID,'INDUSTRY_YEARS');
$currCareer = get_cimyFieldValue($userID,'CURR_CAREER_LVL');
$cell_phone = get_user_meta($userID, 'cell_phone', true);

?>
<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />
<?php while ( have_posts() ) : the_post(); ?>
	<div id="primary" class="content-area">
		<div id="content" role="main">
			<section class="cover_letter">
				<div class="container">
					<h1>Cover Letter Priview</h1>
					<a href="javascript:void();" class="modify_save">Modify & Save</a>
					<div class="cover_letter_box" id="printme">
						<div class="letter_header">
							
							<div class="thumbnail">
								<?php
									echo do_shortcode('[ica_avatar uid="'.$userID.'"]');
								?>
								<!-- <img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/coverletter_name.png" class="img-responsive" alt="seeker profile"> -->
							</div>
							
							<h2><span><?php echo $cand_name; ?></span></h2>
							<h4><span>Sector : <?php  echo (($sector)) ? $sector : 'Not define'; ?></span></h4>
							<p>Closest Major Metropolitan City : <?php  echo (($closedtMetro)) ? $closedtMetro : 'Not define'; ?></p>
						</div>
						<div class="letter_info">
							<span>About EyeRecruit : <strong><?php  echo (($aboutEye)) ? $aboutEye : 'Not define'; ?></strong></span>
							<span class="pull-right">Experience: <strong><?php  echo (($experience)) ? $experience : 'Not define'; ?></strong></span>
						</div>
						<h3>COVER LETTER</h3>
						<div class="row">
							<div class="col-sm-4">
								<div class="letter_sidebar">
									<h4> <?php echo date( 'd F Y' ); ?> </h4>
									<address>
									  <strong>Mr. Tailor</strong><br>
									  <span>Senior Security Officer</span>
									  E-Lite Protections<br>
									  15970 W State Rd 84 – Suite 418<br>
									  Fort Lauderdale, FL. 33326
									</address>
									<ul> 
										<li><span>Phone :</span><?php  echo (($cell_phone)) ? $cell_phone : 'Not define'; ?></li> <!-- +245 567 42 234 -->
										<li><span>E- Mail :</span><?php echo $email; ?></li> <!-- anjleenatailor@mailinator.com -->
										<li><span>Website :</span>www.eyerecruit.com</li>
									</ul>
									<p>Do you want a Professional Cover Letter? We can complete it for you within 24 hours and give you a basic template to use any time or a highly individual and personalized introduction cover letter on every position you are interest in.  Click Here to begin!</p>
									
								</div>
							</div>
							<div class="col-sm-8">
								<div class="letter_content">
									<h4>Dear Mr./Ms. <?php echo $last_name; ?> !</h4>
									<p>This letter is to express my interest in the Security Manager position listed on EyeRecruit.com. Based on my skills in Civil Investigations, I am confident that I would be a great addition to your team if given the opportunity.</p>
									<p>My Resume highlights my abilities, skills, knowledge and expertise in  Conducting Investigations, Servelliance and Security is enclosed. During my time at Miami Protections, I was able to save money in Security. Secury Manager.</p>
									<p>I am excited about the Security Manager position and the ability to help your company in it’s future success. Thank you in advance for your time. Please do not hesitate to contact me personally if you have any questions.  I have a detailed Career Profile online if you are interested in reviewing more about me. I would appreciate the opportunity to review my qualifications in more detail and will contact your next Monday.</p>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="letter_sidebar">
									<div class="profile_located">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/coverletter_logoicon.jpg" class="img-responsive" alt="profile located logo">
										<p>A Full Professional Profile<br>Can be Located At:</p>
										<a href="#" class="eyerecruit.com/search/23455">eyerecruit.com/search/23455</a>
									</div>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="letter_content">
									<div class="letter_footer">
										<span>Sincerely</span>
										<h5><?php echo $cand_name; ?></h5>
										<strong><?php echo $cand_name; ?></strong>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="btn_area">
						<a href="<?php echo site_url(); ?>/job-seekers/cover-letters/" class="btn btn-primary">GO back</a>
						<!-- <button type="button" class="btn btn-primary">Go back</button> -->
						<button type="button" class="btn btn-primary"  onclick="javascript:printDiv('printme')">Print it</button>
						<button type="button" class="btn btn-primary">Forward</button>
					</div>
				</div>
			</section>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php endwhile; ?>


 <script language="javascript" type="text/javascript">
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
       document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";
         // document.body.innerHTML = divElements;
        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;


    }
</script>
<?php wp_footer(); ?>
<?php 
$pageID   = get_the_ID(); 
$uar    = get_post_meta($pageID, 'wpcf-upload-file-content', true);
$uors = get_post_meta($pageID, 'wpcf-use-our-services-content', true); 
$mt     = get_post_meta($pageID, 'member_tips', true); 
?>

<?php  if ( (is_user_logged_in()) &&  (in_array( 'employer', $current_user->roles) ) ) {  ?>
<div class="special_box special_logo navi_thumbnail">
  <div class="thumbnail">
    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
  </div>
  <h5> THE PROCESS</h5>
  <p>EyeRecruit offers an easy way for Job Seekers to post a current Background Verifications that they have in their own files or order a Background from a third party provider, so interested Hiring Managers, HR personnel and Recruiters can view the documents when interested.  If set to  <strong>Restricted View</strong>, simply select the button and the Job Seeker can authorize viewing.</p>
</div>
<div class="special_box special_logo navi_thumbnail">
  <div class="thumbnail">
    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
  </div>
  <h5>THE DISCLAIMER</h5>
  <p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own employment related documents. EyeRecruit, Inc. does not confirm the materials provided here or provide the service.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a href="<?php echo site_url();  ?>/terms-and-conditions/" target="_blank">Terms & Conditions</a> policies. </p>
</div>

<?php } elseif ((is_user_logged_in()) &&  ( in_array( 'candidate', $current_user->roles) )){ ?>

<?php   if ( isset($_REQUEST['recruitID']) ) {  ?>

<div class="special_box special_logo navi_thumbnail">
  <div class="thumbnail">
    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
  </div>
  <h5> THE PROCESS</h5>
  <p>EyeRecruit offers an easy way for Job Seekers to post a current Background Verifications that they have in their own files or order a Background from a third party provider, so interested Hiring Managers, HR personnel and Recruiters can view the documents when interested.  If set to  <strong>Restricted View</strong>, simply select the button and the Job Seeker can authorize viewing.</p>
</div>
<div class="special_box special_logo navi_thumbnail">
  <div class="thumbnail">
    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
  </div>
  <h5>THE DISCLAIME</h5>
  <p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own employment related documents. EyeRecruit, Inc. does not confirm the materials provided here or provide the service.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a href="<?php echo site_url();  ?>/terms-and-conditions/" target="_blank">Terms & Conditions</a> policies. </p>
</div>

<?php  }else{
  if( count($select) >= 1 ){ 
    ?>

    <div class="special_box special_logo navi_thumbnail">
      <div class="thumbnail">
        <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
      </div>
      <h5>RUN A BACKGROUND NOW</h5>
      <?php echo $uors; ?>
      <a href="<?php echo site_url();?>/order-background/" class="btn btn-primary btn-sm">Order Now</a>
    </div>
    <div class="special_box special_logo navi_thumbnail">
      <div class="thumbnail">
        <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
      </div>
      <h5>UPLOAD YOUR BACKGROUND</h5>
      <?php echo $uar; ?>
      <a id="btn-uploadRes2" href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
    </div>
    <div class="special_box special_logo navi_thumbnail">
      <div class="thumbnail">
        <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
      </div>
      <h5> MEMBER TIP</h5>
      <?php echo (do_shortcode('[er_random_member_tip_content tax_id=489]')); ?>
      
    </div>
    <?php  } else{ ?>

    <div class="special_box special_logo navi_thumbnail">
      <div class="thumbnail">
        <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
      </div>
      <h5>INSIDE SCOOP</h5>
      <!-- <p>By providing your resume, you are essentially stating that what you are providing is a “true and accurate description” of your personal experience, work history, and education. Employers know that is not always the case and Job Seekers know that it’s not always the best candidate that gets the job. Sadly even in the Security, Investigative profession the information provided by candidates can range from an embellishment to outright lies.  Providing anything a Decision Maker might need to make a more education decision is always more beneficial. Think “full disclosure.”</p> -->
      <p>By providing your resume, you are essentially stating that what you are providing is a “true and accurate description” of your personal experience, work history, and education. Employers know that is not always the case and Job Seekers know that it’s not always the best candidate that gets the job. Sadly even in the Security, Investigative profession the information provided by candidates can range from an embellishment to outright lies.  Providing anything a Decision Maker might need to make a more education decision is always more beneficial. Think “full disclosure.”
      </p>
    </div>
    <div class="special_box special_logo navi_thumbnail">
      <div class="thumbnail">
        <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
      </div>
      <h5>PROFESSIONAL TIP</h5>
      <p>Proactive, diligent, comprehensive and organized. That’s what it takes. No one is going to manage or care about your career more than you are. It is your professional responsibility to know what might be affecting your career objectives, good or bad, and make every effort to address those items until there is nothing standing between you and the career of your dreams. WHY LEAVE IT TO CHANCE?
      </p>
    </div>
    <div class="special_box special_logo navi_thumbnail">
      <div class="thumbnail">
        <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
      </div>
      <h5> MEMBER TIP</h5>
      <?php echo (do_shortcode('[er_random_member_tip_content tax_id=489]')); ?>
    </div>
    <?php 
  }
} ?>


<?php  }else { ?>
<div class="special_box special_logo navi_thumbnail">
  <div class="thumbnail">
    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
  </div>
  <h5> INSIDE SCOOP</h5>
  <p>By providing your resume, you are essentially stating that what you are providing is a “true and accurate description” of your personal experience, work history, and education. Employers know that is not always the case and Job Seekers know that it’s not always the best candidate that gets the job. Sadly even in the Security, Investigative profession the information provided by candidates can range from an embellishment to outright lies.  Providing anything a Decision Maker might need to make a more education decision is always more beneficial. Think “full disclosure.”</p>
</div>
<div class="special_box special_logo navi_thumbnail">
  <div class="thumbnail">
    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
  </div>
  <h5> PROFESSIONAL TIP</h5>
  <p>Proactive, diligent, comprehensive and organized. That’s what it takes. No one is going to manage or care about your career more than you are. It is your professional responsibility to know what might be affecting your career objectives, good or bad, and make every effort to address those items until there is nothing standing between you and the career of your dreams. WHY LEAVE IT TO CHANCE?</p>
</div>
<div class="special_box special_logo navi_thumbnail">
  <div class="thumbnail">
    <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
  </div>
  <h5> MEMBER TIP</h5>
  <?php echo (do_shortcode('[er_random_member_tip_content tax_id=489]')); ?>
</div>

<?php } ?>

<?php
/**
 * Jobify Child Theme
 *
 * Place any custom functionality/code snippets here.
 *
 * @since Jobify Child 1.0.0
 */

//include('inc/ontraport/ontraport-api.php');
//include('functions-ontraport.php');
include('inc/site-verbiage.php');
include('functions-interfused.php');
include('functions_registration.php');
include('functions_save_jobseeker_data.php');
include('functions-wc.php');
include('templates/email/functions.php');
include('inc/eyerecruit/functions-assessments.php');

//tracking codes

// Add scripts to wp_head()
function hook_eyerecruit_head_script() { ?>
<!-- Hotjar Tracking Code for http://www.eyerecruit.com -->

<script>

(function(h,o,t,j,a,r){

  h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};

  h._hjSettings={hjid:203897,hjsv:5};

  a=o.getElementsByTagName('head')[0];

  r=o.createElement('script');r.async=1;

  r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;

  a.appendChild(r);

})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');

</script>

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-63934732-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-63934732-1');
</script>

<?php }
add_action( 'wp_head', 'hook_eyerecruit_head_script' );

// Sidebar for job find 
function basicMailTest(){
	mail('jeremy@interfused-inc.com','basic subject er test','this is the basic message');
}
function eyerecruit_sidebar(){
	register_sidebar( array(
		'name'          => __( ' Post a Job Here ', 'eyerecruit' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'post_job',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( ' Why employers use us ?  ', 'eyerecruit' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'employers_use_us',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( ' Adds  ', 'eyerecruit' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'adds',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( ' Question Survey  ', 'eyerecruit' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'question_survey',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( ' Question Survey Result ', 'eyerecruit' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'question_survey_result',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( ' Seeker tips ', 'eyerecruit' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'show_seeker_tips',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );

	/*..............Sidebar for ads............*/
	register_sidebar( array(
		'name'          => __( ' Ad for search candidates Page ', 'eyerecruit' ),
		'id'            => 'ad_search_candidate_page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( ' Ad for right side employer dashboard ', 'eyerecruit' ),
		'id'            => 'ad_right_side_employer_dashboard',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	
	register_sidebar( array(
		'name'          => __( ' Ad for left side employer dashboard after Survey ', 'eyerecruit' ),
		'id'            => 'ad_employer_dashboard_after_survey',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __( ' Ad for bottom employer dashboard ', 'eyerecruit' ),
		'id'            => 'ad_bottom_employer_dashboard',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __( ' Ad for bottom seeker dashboard ', 'eyerecruit' ),
		'id'            => 'ad_bottom_seeker_dashboard',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __( ' Ad for left side seeker dashboard after question survey ', 'eyerecruit' ),
		'id'            => 'ad_seeker_dashboard_after_question_survey',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __( ' Ad for right side seeker dashboard ', 'eyerecruit' ),
		'id'            => 'ad_right_side_seeker',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __( ' Ad for Find a job Top ', 'eyerecruit' ),
		'id'            => 'ad_find_a_job_top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __( ' Ad for Find a job bottom ', 'eyerecruit' ),
		'id'            => 'ad_find_a_job_bottom',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
}
add_action('widgets_init','eyerecruit_sidebar');

function jobify_child_styles() {
	//wp_enqueue_style('blockgrid', get_stylesheet_directory().'/css/block-grid.css');
	
	wp_enqueue_style('fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_enqueue_style('opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800');
	wp_enqueue_style('Sacramento', 'https://fonts.googleapis.com/css?family=Sacramento');
	wp_enqueue_style('Rokkitt', 'http://fonts.googleapis.com/css?family=Rokkitt:400,700');
	wp_enqueue_style( 'jobify-child', get_stylesheet_uri(), array('Rokkitt','opensans','fontawesome') );
	wp_enqueue_style( 'custom-switchbtn', get_stylesheet_directory_uri() . '/css/swichbtn.css' );
	wp_enqueue_style( 'custom-circleprogress', get_stylesheet_directory_uri() . '/css/circle_progress.css' );
	wp_enqueue_script( 'custom-validate', get_stylesheet_directory_uri() . '/inc/js/jquery.validate.min.js' );

	wp_enqueue_script( 'custom-validate-rules', get_stylesheet_directory_uri() . '/inc/js/validaterules.js' );
	$data1 = array( 'ajaxurl'=>  site_url() );
	wp_localize_script( 'custom-validate-rules', 'siteurl', $data1 );

	wp_enqueue_script( 'custom-bootstrapcssjs', get_stylesheet_directory_uri() . '/inc/js/bootstrap.js' );
	wp_enqueue_script( 'notify-js', get_stylesheet_directory_uri() . '/js/notify.js' );
	//REWRITE TO BE A CONDITIONAL ENQUEUE
	wp_enqueue_script( 'form-filefield-js', get_stylesheet_directory_uri() . '/js/jquery.custom-file-input.js','','',true );

	if ( !is_page_template( 'staticpage.php' ) && !is_page_template('page-templates/template_job_seekers_registration.php')  && !is_page_template('page-templates/template_job_employers_registration.php') ) {
		wp_enqueue_style( 'custom-bootstrapcss', get_stylesheet_directory_uri() . '/css/bootstrap.css' );
		wp_enqueue_style( 'custom-dashboard', get_stylesheet_directory_uri() . '/dashboard.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'jobify_child_styles', 20 );
/////////////////
function bootstrap_tour_styles(){
	if(is_page_template( 'page-templates/seeker-dashboard-v4.php' ) ){
		wp_enqueue_style('bootstrap-tour-style', get_stylesheet_directory_uri() . '/css/bootstrap-tour.css');
		wp_enqueue_script( 'bootstrap-tour-script', get_stylesheet_directory_uri() . '/js/bootstrap-tour.min.js','','',true );
		wp_enqueue_script( 'bootstrap-tour-seeker-dashboard', get_stylesheet_directory_uri() . '/js/bootstrap-tour-job-seeker.js','','',true );
	}
}

add_action( 'wp_enqueue_scripts', 'bootstrap_tour_styles', 21 );





/*
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
*/
/* REMOVE WORDPRESS GENERATOR META */
remove_action('wp_head', 'wp_generator');


/******** CHANGE PERMALINK for job
ref: https://wpjobmanager.com/document/tutorial-changing-the-job-slugpermalink/
 *******/
function job_listing_post_type_link( $permalink, $post ) {
    // Abort if post is not a job
	if ( $post->post_type !== 'job_listing' )
		return $permalink;

    // Abort early if the placeholder rewrite tag isn't in the generated URL
	if ( false === strpos( $permalink, '%' ) )
		return $permalink;

	$find = array(
		'%post_id%'
		);

	$replace = array(
		$post->ID
		);

	$replace = array_map( 'sanitize_title', $replace );

	$permalink = str_replace( $find, $replace, $permalink );

	return $permalink;
}
add_filter( 'post_type_link', 'job_listing_post_type_link', 10, 2 );

function change_job_listing_slug( $args ) {
	$args['rewrite']['slug'] = 'job/%post_id%';
	return $args;
}
add_filter( 'register_post_type_job_listing', 'change_job_listing_slug' );

/*
function get_edit_profile_link_fnBACKUP($atts){
	//	return "foo = {$atts['foo']}";
//	return admin_url( 'profile.php' );
return '<a href="'.admin_url( 'user-edit.php?user_id=' . get_current_user_id(), 'http' ).'">Edit Profile</a>';
}
*/

function get_edit_profile_link_fn(){
	/*global $current_user;
      get_currentuserinfo();
	*/
      $html='';
      $current_user = wp_get_current_user();
	//check if address exists
//$user_id =  get_current_user_id();
      $key = 'billing_address1';
      $single = true;
      $all_meta_for_user = get_user_meta( $current_user->ID );
      $all_meta_for_user = array_filter( array_map( function( $a ) {
      	return $a[0];
      }, $all_meta_for_user ) );


      $debug = print_r($all_meta_for_user,true);
//  return $debug;
//$html .= '<hr>'.$debug;
      $html .= '<hr>';

//  $billing_address1 = get_user_meta( $user_id, $key, $single ); 

      $billing_address1 = 'Address: <br>'. $all_meta_for_user['billing_address_1'];


//$editLink=get_page_link(12);
      $editLink='http://eyerecruit.com/my-account/edit-address/billing/';
      if(!$billing_address1){
      	return '<p class="text-center">Need to edit your address information.</p> <p><a href="'.$editLink.'" class="button">Click here</a></p>';
      }
////continue otherwise

	//$html .= '<h2>'.$all_meta_for_user['first_name'].' '.$all_meta_for_user['last_name'].'</h2>';
	//$html .= $billing_address1;
	//return $html;

      $fulladdress = $all_meta_for_user['billing_address_1'];
      if($all_meta_for_user['billing_address_2']){
      	$fulladdress .= '<br>' . $all_meta_for_user['billing_address_2'];
      }
      $fulladdress .= '<br>' . $all_meta_for_user['billing_city'] .', ' .$all_meta_for_user['billing_state'] . ' '.$all_meta_for_user['billing_postcode'];
      $fulladdress .= '<br>' .$all_meta_for_user['billing_country'];

      $html.='<div class="row">
      <div class="col-md-12"><h2>' .$all_meta_for_user['first_name']. ' '. $all_meta_for_user['last_name']  .'</h2></div>
      <div class="col-md-6">
      <p>'.$fulladdress.'</p></div>
      <div class="col-md-6"><p>'.$all_meta_for_user['billing_phone'].'<br>
      '.$current_user->user_email.'</p></div>
      </div>';


      return $html;

    }

    add_shortcode( 'eye_recruit_profile_edit', 'get_edit_profile_link_fn' );




///after login

    function your_recruiter_fn(){
    	ob_start();
    	?>
    	<div class="text-center"><img src="http://eyerecruit.com/assets/uploads/2016/05/headshot-cb.jpg" class="img-responsive round" style="width:100%; max-width:300px; height:auto; border:1px solid #ccc;" />
    		<p><strong>Chris Bauer</strong><br>
    			<!-- <i class="fa fa-phone"></i> <a href="tel:9549997157">954-999-7157</a><br > -->
    			<i class="fa fa-envelope"></i> <a href="mailto:chris.bauer@eyerecruit.com?subject=Job Seeker Question">Contact Now</a></p>
    		</div>

    		<?php
    		$html = ob_get_clean();
    		ob_end_flush();


    		return $html;
    	}
    	add_shortcode('your_recruiter','your_recruiter_fn');


    	function thankscontent_fn( $atts, $content = "" ) {

    		$atts = shortcode_atts( array(
    			'sm' => 'undefined',
    			'baz' => 'default baz'
    			), $atts, 'bartag' );

    		/* NEED TO PASS URL VARIABLE sm (success mode) OTHERWISE EXIT */
    		if(!$_GET['sm']){
    			return '';
    		}

    		if($_GET['sm'] == $atts['sm'] ){

    			return do_shortcode( $content);
    		}

	//return "content = $content";
    	}

    	add_shortcode('thankscontent','thankscontent_fn');

    	function is_er_listing_uncloaked(){
	/*
	if(!is_user_logged_in() ){
		return 0;
	}
	*/
	$uncloakCheck=types_render_field("uncloak-job-listing", array("raw"=>"true"));
	return $uncloakCheck;
}

function is_er_company_uncloaked(){
	if( !is_user_logged_in() ){
		return false;
	}
	
	return true;
}
/*
REDIRECT USERS BASED OFF OF ROLE
*/
/*
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} elseif(in_array( 'candidate', $user->roles )) {
			return '/?p=2637';
		}else{
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
*/
//REDIRECT TO HOME AFTER LOGOUT

/***** USER SUPPORT DOCUMENTS RELATED FUNCTIONS BELOW 
WE ARE ONLY STORING THE FILE IDS FOR SPEED.

reference: http://stevenslack.com/add-image-uploader-to-profile-admin-page-wordpress/
*****/
/**
 * Adds additional user fields
 * more info: http://justintadlock.com/archives/2009/09/10/adding-and-using-custom-user-profile-fields
 */

/////SET CUSTOM UPLOAD DIRECTORY
function per_user_upload_dir( $original ){
    // use the original array for initial setup
	$modified = $original;
    // set our own replacements
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
        //$subdir = $current_user->user_login;
		
		///MODIFY FOR CANDIDATES 
		if( in_array( 'candidate', $current_user->roles ) ){
			$subdir = 'usr/uid_'.$current_user->ID;
			$modified['subdir'] = $subdir;
			$modified['url'] = $original['baseurl'] . '/' . $subdir;
			$modified['path'] = $original['basedir'] . DIRECTORY_SEPARATOR . $subdir;
		}
		///MODIFY FOR EMPLOYERS
		if( in_array( 'employer', $current_user->roles ) ){
			$subdir = 'emp/uid_'.$current_user->ID;
			$modified['subdir'] = $subdir;
			$modified['url'] = $original['baseurl'] . '/' . $subdir;
			$modified['path'] = $original['basedir'] . DIRECTORY_SEPARATOR . $subdir;
		}

	}
	return $modified;
}
add_filter( 'upload_dir', 'per_user_upload_dir');

/////////SHOW FILEDS IN EDIT PROFILE 

function additional_er_supportdocs_fields( $user ) {
	///do not do if there is a mode of request change password
	if($_REQUEST['chpw']){
		return;
	}
	?>

	<br style="clear:both;" >
	<section id="supportDocsWrapper">
		<h1 id="supportDocsHeader" class="tight marginTop">Support Documents</h1>
		<p>Have any of the below? Upload PDFs/JPGs/PNGs/Docs and stand out above the rest.</p>  

		<div class="acc_group">
			<div id="docs-certs" class="acc_heading active"> 
				<p>Certificates</p>
			</div>
			<div id="acc1_body" class="acc_body">Content 1 Here</div> 
			<div id="docs-achievements" class="acc_heading"> 
				<p>Achievements</p>
			</div>
			<div id="acc2_body" class="acc_body">Content 2 Here</div> 
			<div id="docs-bgchecks" class="acc_heading"> 
				<p>Background Checks</p>
			</div>
			<div id="acc3_body" class="acc_body">Content 2 Here</div> 
		</div>

		<section id="fileCertificatesWrapper">   
    <!-- <h3>Certificates</h3>
    <p>Upload PDFs/JPGs/PNGs/Docs</p>
  -->
  <?php
  $maxFiles=5;
  ?>
  <table id="" class="form-table">

  	<?php for($i=1;$i<=$maxFiles;$i++){?>

  	<tr>
  		<th><label for="user_meta_image"><?php _e( 'File #'.$i, 'textdomain' ); ?></label></th>
  		<td>
  			<!-- Outputs the image/file after save -->

  			<!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->

  			<?php
  			$attachmentURL   ="";
  			$attachmentID    ="";
  			$attachmentID    = get_the_author_meta( 'fileID_certificate'.$i, $user->ID );
  			if($attachmentID){
  				$attachment = get_post( $attachmentID ); 
  				$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
  				$attachment_title = $attachment->post_title;
  				$caption = $attachment->post_excerpt;
  				$description = $image->post_content;
  				$attachmentURL = wp_get_attachment_url( $attachmentID );

  			}
  			?>
  			<div class="row" >
  				<div class="col-sm-8"><input type="hidden" name="fileID_certificate<?php echo $i;?>" id="fileID_certificate<?php echo $i;?>" value="<?php echo ( get_the_author_meta( 'fileID_certificate'.$i, $user->ID ) ); ?>" class="attachmentIdToUpdate" ><input type="text" class="attachmentURLtoDisplay regular-text" value="<?php echo $attachmentURL;?>"></div>
  				<div class="col-sm-4">
  					<!-- Outputs the save button -->
  					<input type='button' class="additional-file-bgcheck button-primary" value="<?php _e( 'Choose File', 'textdomain' ); ?>" id="uploadimage"/>
  				</div>
  			</div>



  		</td>
  	</tr>

  	<?php } ///end for loop  ?>


  	<tr>
  		<td><button class="er_updater button">SAVE FILES</button></td>
  	</tr>

  </table><!-- end form-table -->
</section>

<section id="fileAchievementsWrapper">
    <!-- <h3>Achievements</h3>
    <p>Upload PDFs/JPGs/PNGs/Docs</p>
  -->
  <?php
  $maxFiles=5;
  ?>
  <table class="form-table">

  	<?php for($i=1;$i<=$maxFiles;$i++){?>




  	<tr>
  		<th><label for="user_meta_image"><?php _e( 'File #'.$i, 'textdomain' ); ?></label></th>
  		<td>
  			<!-- Outputs the image/file after save -->

  			<!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->


  			<?php
  			$attachmentURL="";
  			$attachmentID="";
  			$attachmentID= get_the_author_meta( 'fileID_achievement'.$i, $user->ID );
  			if($attachmentID){
  				$attachment = get_post( $attachmentID ); 
  				$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
  				$attachment_title = $attachment->post_title;
  				$caption = $attachment->post_excerpt;
  				$description = $image->post_content;
  				$attachmentURL = wp_get_attachment_url( $attachmentID );

  			}
  			?>
  			<div class="row" >
  				<div class="col-sm-8"><input type="hidden" name="fileID_achievement<?php echo $i;?>" id="fileID_achievement<?php echo $i;?>" value="<?php echo ( get_the_author_meta( 'fileID_achievement'.$i, $user->ID ) ); ?>" class="attachmentIdToUpdate" ><input type="text" class="attachmentURLtoDisplay regular-text" value="<?php echo $attachmentURL;?>"></div>
  				<div class="col-sm-4">
  					<!-- Outputs the save button -->
  					<input type='button' class="additional-file-bgcheck button-primary" value="<?php _e( 'Choose File', 'textdomain' ); ?>" id="uploadimage"/>
  				</div>
  			</div>



  		</td>
  	</tr>

  	<?php } ///end for loop  ?>


  	<tr>
  		<td><button class="er_updater button">SAVE FILES</button></td>
  	</tr>

  </table><!-- end form-table -->
</section>

<section id="fileBackgroundCheckWrapper">
    <!-- <h3>Background Checks</h3>
    <p>Upload PDFs/JPGs/PNGs/Docs</p>
  -->
  <?php
  $maxFiles=5;
  ?>
  <table class="form-table">

  	<?php for($i=1;$i<=$maxFiles;$i++){?>




  	<tr>
  		<th><label for="user_meta_image"><?php _e( 'File #'.$i, 'textdomain' ); ?></label></th>
  		<td>
  			<!-- Outputs the image/file after save -->

  			<!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->


  			<?php
  			$attachmentURL="";
  			$attachmentID="";
  			$attachmentID= get_the_author_meta( 'fileID_bgck'.$i, $user->ID );
  			if($attachmentID){
  				$attachment = get_post( $attachmentID ); 
  				$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
  				$attachment_title = $attachment->post_title;
  				$caption = $attachment->post_excerpt;
  				$description = $image->post_content;
  				$attachmentURL = wp_get_attachment_url( $attachmentID );

  			}
  			?>
  			<div class="row" >
  				<div class="col-sm-8"><input type="hidden" name="fileID_bgck<?php echo $i;?>" id="fileID_bgck<?php echo $i;?>" value="<?php echo ( get_the_author_meta( 'fileID_bgck'.$i, $user->ID ) ); ?>" class="attachmentIdToUpdate" ><input type="text" class="attachmentURLtoDisplay regular-text" value="<?php echo $attachmentURL;?>"></div>
  				<div class="col-sm-4">
  					<!-- Outputs the save button -->
  					<input type='button' class="additional-file-bgcheck button-primary" value="<?php _e( 'Choose File', 'textdomain' ); ?>" id="uploadimage"/>
  				</div>
  			</div>



  		</td>
  	</tr>

  	<?php } ///end for loop  ?>


  	<tr>
  		<td><button class="er_updater button">SAVE FILES</button></td>
  	</tr>

  </table><!-- end form-table -->
</section>

</section>

<script>
	/*
 * Adapted from: http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
 */
 jQuery(document).ready(function($){
 	jQuery(".acc_body").empty().slideUp();
 	jQuery("#fileCertificatesWrapper").appendTo("#acc1_body");
 	jQuery("#fileAchievementsWrapper").appendTo("#acc2_body");
 	jQuery("#fileBackgroundCheckWrapper").appendTo("#acc3_body");
 	jQuery("#acc1_body").slideDown();
// Uploading files
var file_frame;

$('.additional-file-bgcheck').on('click', function( event ){

	event.preventDefault();
	var tgtIdBox = jQuery(this).closest('td').find('.attachmentIdToUpdate').eq(0);
	var tgtInputBox=jQuery(this).closest('td').find('.regular-text').eq(0); 
    // If the media frame already exists, reopen it.
    if ( file_frame ) {
    	file_frame.open();
    	return;
    }

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
    	title: $( this ).data( 'uploader_title' ),
    	button: {
    		text: $( this ).data( 'uploader_button_text' ),
    	},
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();


      // Do something with attachment.id and/or attachment.url here

      tgtIdBox.val(attachment.id);
      tgtInputBox.val(attachment.url);
    });

    // Finally, open the modal
    file_frame.open();
  });

});
</script>
<?php } // additional_er_supportdocs_fields

add_action( 'show_user_profile', 'additional_er_supportdocs_fields' );
add_action( 'edit_user_profile', 'additional_er_supportdocs_fields' );

/**
* Saves additional user fields to the database
*/
function save_additional_user_meta( $user_id ) {
	$maxFileCount=5;
    // only saves if the current user can edit user profiles
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

 //   update_usermeta( $user_id, 'user_meta_image', $_POST['user_meta_image'] );
////LOOP THROUGH VARIOUS BACKGROUND IMAGE FIELS
	for($i=1;$i<=$maxFileCount;$i++){
		$postsVal= $_POST['fileID_bgck'.$i];
		if($postsVal){
			update_usermeta( $user_id, 'fileID_bgck'.$i, $postsVal  );
		}
 }///end for loop
 
 ////update achievements
 for($i=1;$i<=$maxFileCount;$i++){
 	$postsVal= $_POST['fileID_achievement'.$i];
 	if($postsVal){
 		update_usermeta( $user_id, 'fileID_achievement'.$i, $postsVal  );
 	}
 }///end for loop
 
  ////update certificates
 for($i=1;$i<=$maxFileCount;$i++){
 	$postsVal= $_POST['fileID_certificate'.$i];
 	if($postsVal){
 		update_usermeta( $user_id, 'fileID_certificate'.$i, $postsVal  );
 	}
 }///end for loop
 
 



}

add_action( 'personal_options_update', 'save_additional_user_meta' );
add_action( 'edit_user_profile_update', 'save_additional_user_meta' );

//////////////


////////////////


/**
 * Return an ID of an attachment by searching the database with the file URL.
 *
 * First checks to see if the $url is pointing to a file that exists in
 * the wp-content directory. If so, then we search the database for a
 * partial match consisting of the remaining path AFTER the wp-content
 * directory. Finally, if a match is found the attachment ID will be
 * returned.
 *
 * http://frankiejarrett.com/get-an-attachment-id-by-url-in-wordpress/
 *
 * @return {int} $attachment
 */
function get_attachment_image_by_url( $url ) {

    // Split the $url into two parts with the wp-content directory as the separator.
	$parse_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

    // Get the host of the current site and the host of the $url, ignoring www.
	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

    // Return nothing if there aren't any $url parts or if the current host and $url host do not match.
	if ( !isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host != $file_host ) ) {
		return;
	}

    // Now we're going to quickly search the DB for any attachment GUID with a partial path match.
    // Example: /uploads/2013/05/test-image.jpg
	global $wpdb;

	$prefix     = $wpdb->prefix;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM " . $prefix . "posts WHERE guid RLIKE %s;", $parse_url[1] ) );

    // Returns null if no attachment is found.
	return $attachment[0];
}

function tmpempassessment_fn(){
	////ONLY FOR DEBUGGING.... NOT CRUCIAL TO FRONT END DISPLAY
	$html='';
	

	//returns user's resume ids
	$tmpArr= array();
	$args=array(
		'post_type'           => 'assessment-question',
		'post_status'         => array( 'publish'),
		'posts_per_page' => -1
		);

	$questions = new WP_Query($args);
	while ( $questions->have_posts() ) {
		$questions->the_post();
		$postMeta=get_post_meta(get_the_ID() );
	//echo '<li>' . get_the_title() . '</li>';

		$empQ = get_post_meta(get_the_ID(), 'wpcf-employer-to-seeker-question', true);
//$empQ == '' || (strpos('BACKSIDE', $empQ) >0
		if(true)  {
			$html .= 'MISSING EMPLOYER QUESTION FOR: '.get_the_title();
			$html .= '<br><a href="http://eyerecruit.com/wp-admin/post.php?post='.get_the_ID().'&action=edit" target="editWindow">EDIT</a>';
			$html.="<hr>";
		}
	//$html.='<br><BR>';
	//$html .= print_r($postMeta,true);
	/*
		$html .= '<h2>'.get_the_title().'</h2>';
	$html .= '<h3>ID: '.get_the_ID().'</h3>';
	
	
	*/
	//$html .= '<p>'.$postMeta['wpcf-job-seeker-assessment-question'][0].'</p>';
	
	
	
	
	
	
	//array_push($tmpArr,get_the_ID());
}
wp_reset_postdata();
return $html;

}
add_shortcode('tmpempassessment','tmpempassessment_fn');

include('inc/eyerecruit/candidates/er_candidate_functions.php');
include('inc/eyerecruit/general-functions.php');
include('inc/profile_meta_field.php');
include('inc/edit_basic_info.php');
include('inc/tips_functions.php');
include('inc/employee_details_save.php');
include('inc/jobcustomfield.php');
include('Employer/employers_basic_information_saved.php');
include('seeker_search_sidebar/searchAjaxaction.php');
include('inc/custom_functions.php');



/* blocking the admin section (but still using admin-ajax.php)*/
add_action('admin_init', 'wpse28702_restrictAdminAccess', 1);
function wpse28702_restrictAdminAccess() {
	$isAjax = (defined('DOING_AJAX') && true === DOING_AJAX) ? true : false;

	if(!$isAjax) {
		if(!current_user_can('administrator')) {
			wp_redirect( home_url() );
		}
	}
}

/*Add extra fileds on user profiles*/
function modify_user_contact_methods( $user_contact ) {

	// Add user contact methods
	$user_contact['cell_phone']   = __( 'Cell phone');
	$user_contact['office_phone']   = __( 'Office phone');
	$user_contact['company']   = __( 'Company');
	$user_contact['ext']   = __( 'Ext');

	return $user_contact;
}

add_filter( 'user_contactmethods', 'modify_user_contact_methods' );


function pr($value){
	echo '<pre>';
	print_r($value); die;
}


/* ajax result to invite friends and colleages */
add_action('wp_ajax_invite_any_colleague', 'invite_any_colleague');
add_action('wp_ajax_nopriv_invite_any_colleague', 'invite_any_colleague');

function invite_any_colleague(){
	$current_user_id = get_current_user_id();
	if( isset($_POST['rfname']) && isset($_POST['rfemail']) ){
		$colleague_name = $_POST['rfname'];
		$colleague_email = $_POST['rfemail'];
		$data = get_userdata($current_user_id);
		$sender_name = $data->first_name.' '.$data->last_name;
		$get_option_arr 	= get_option('recommend_friends_mail');
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		$currtime = time();
		foreach ($colleague_email as $key => $femail) {

			$to 				= $femail;
			$shordcode_to_rep 	= array('[site-url]','[reach_out_recommendation_first_name]','[reach_out_recommendation_last_name]','[reach_out_recommendation]','[sender_name]');
			$replace_with 		= array(site_url(),$colleague_name[$key],'',$user_msg, $sender_name);
			$subject 			= str_replace($shordcode_to_rep, $replace_with,$get_option_arr['recommend_friends_subject']);
			$message 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['recommend_friends_template']);
			wp_mail($to, $subject, $message, $headers);
			$colleague_date[] = $currtime;
		}

		$existing_colleages_name = get_user_meta($current_user_id , 'rfname', true);
		if(!empty($existing_colleages_name)){
			$existing_colleages_name_arr = explode(',', $existing_colleages_name);
			$merged_colleages_name_arrs = array_merge($existing_colleages_name_arr, $colleague_name);
			$merged_colleages_name_arrs = implode(',', $merged_colleages_name_arrs);
			update_user_meta( $current_user_id, 'rfname', $merged_colleages_name_arrs );
			
			$existing_colleages_date = get_user_meta($current_user_id , 'rfdate', true);
			if ( empty($existing_colleages_date) ) {
				foreach ($existing_colleages_name_arr as $value) {
					$existing_colleages_date_arr[] = $currtime;
				}
			}
			else{
				$existing_colleages_date_arr = explode(',', $existing_colleages_date);
			}

			$merged_colleages_date_arrs = array_merge($existing_colleages_date_arr, $colleague_date);
			$merged_colleages_date_arrs = implode(',', $merged_colleages_date_arrs);
			update_user_meta( $current_user_id, 'rfdate', $merged_colleages_date_arrs );

		}else{
			$new_colleagues_name = implode(',', $_POST['rfname']);
			update_user_meta( $current_user_id, 'rfname', $new_colleagues_name );

			$new_colleagues_date = implode(',', $colleague_date);
			update_user_meta( $current_user_id, 'rfdate', $new_colleagues_date );
		}

		$existing_colleages_email = get_user_meta($current_user_id , 'rfemail', true);
		if(!empty($existing_colleages_name)){
			$existing_colleages_email_arr = explode(',', $existing_colleages_email);
			$merged_colleages_email_arrs = array_merge($existing_colleages_email_arr, $colleague_email);
			$merged_colleages_email_arrs = implode(',', $merged_colleages_email_arrs);
			update_user_meta( $current_user_id, 'rfemail', $merged_colleages_email_arrs );

			$currtime = time();
			$count = count($colleague_email);
			$timearr = array();
			for ($i=1; $i <= $count; $i++) { 
				$timearr[] = $currtime;
			}

			$mynetwork_lastupdate = get_user_meta($current_user_id , 'mynetwork_lastupdate', true);
			$mynetwork_lastupdate_arr = explode(',', $mynetwork_lastupdate);
			$mynetwork_lastupdate_arr = array_merge($mynetwork_lastupdate_arr, $timearr);
			$mynetwork_lastupdate_arr = implode(',', $mynetwork_lastupdate_arr);
			update_user_meta( $current_user_id, 'mynetwork_lastupdate', $mynetwork_lastupdate_arr );
		}else{
			$new_colleagues_email = implode(',', $_POST['rfemail']);
			update_user_meta( $current_user_id, 'rfemail', $new_colleagues_email );
			update_user_meta( $current_user_id, 'mynetwork_lastupdate', time() );
		}
	}
	die();
}

/* ajax reach out and ask for referral */
add_action('wp_ajax_reach_out_and_ask_for_referral', 'reach_out_and_ask_for_referral');
add_action('wp_ajax_nopriv_reach_out_and_ask_for_referral', 'reach_out_and_ask_for_referral');

function reach_out_and_ask_for_referral(){
	global $wpdb;
	$current_user_id = get_current_user_id();
	if( isset($_POST)){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$user_email = $_POST['user_email'];
		$user_msg = $_POST['user_msg'];
		$sender_name = $_POST['sender_name'];
		$Relationship = $_POST['Relationship'];
		$Years = $_POST['Years'];
		$tablename = $wpdb->prefix.'reach_out_and_ask_for_referral';
		
		$nameArr = array();
		foreach ($user_email as $key => $value) {
			//insert the record
			$wpdb->insert(
				$tablename, 
				array(
					"user_id" => $current_user_id,
					"first_name" => $fname[$key],
					"last_name" => $lname[$key],
					"request_time" => time(),
					"user_email" => $value,
					"use_relationship" => $Relationship[$key],
					"how_year"  => $Years[$key]
					),
				array( '%d', '%s', '%s', '%s', '%s', '%s' , '%s')
				);
			//get the mail options
			if($wpdb->insert_id){
				$selectPending = $wpdb->get_row("SELECT * FROM $tablename WHERE user_email = '".$user_email."' AND user_message IS NULL  ");
				$sender_recommendation_link = get_site_url().'/add-recommendation/?rID='.$wpdb->insert_id;
				$get_option_arr 	= get_option('reach_out_recommendation');
				$setting_options 	= get_option('xtreem_options_smtp');
			$to 				= $value;//$setting_options['tomail'];
			$shordcode_to_rep 	= array('[site-url]','[reach_out_recommendation_first_name]','[reach_out_recommendation_last_name]','[reach_out_recommendation]','[sender_name]','[sender_recommendation_link]');
			$replace_with 		= array(site_url(),$fname[$key],$lname[$key],$user_msg, $sender_name,$sender_recommendation_link);
			$subject 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['reach_out_recommendation_subject']);
			$message 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['reach_out_recommendation_template']);
			$headers            = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$awesome=false;
			if(wp_mail($to, $subject, $message, $headers)){
				$awesome=true;
				
			}	
		}


		$nameArr[] = $fname[$key].' '.$lname[$key];
	}

	$nameList = implode(', 	', $nameArr);
	$wpdb->insert(
		$wpdb->prefix.'user_activity_log',
		array(
			'user_id'  => $current_user_id,
			'action'   => 'deleteReachReferral',
			'datetime' => time(),
			'meta'     => 'Add new referral '.$nameList
			),
		array( '%d', '%s', '%s', '%s' )
		);	
}
die();
}



// permissions & allowances page ajax for specific item
add_action('wp_ajax_permissions_n_allowances', 'permissions_n_allowances');
add_action('wp_ajax_nopriv_permissions_n_allowances', 'permissions_n_allowances');

function permissions_n_allowances(){
	global $wpdb;
	if(isset($_POST['user_id']) && isset($_POST['field_values']) && isset($_POST['field_names']) && isset($_POST['acc'])){
		$user_id = $_POST['user_id'];
		$field_values = $_POST['field_values'];
		$field_names = $_POST['field_names'];
		$acc = $_POST['acc'];
		$utype = $_POST['utype'];
		set_cimyFieldValue($user_id, $field_names, $field_values);
		$wpdb->insert(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $user_id,
				'action'   => 'UpdateBasicInfo',
				'datetime' => time(),
				'meta' 	   => 'Modified Preferences > change permission to view '.$acc.' for '.$utype
				),
			array( '%d', '%s', '%s', '%s' )
			);
	}
	die();
}

function seeker_dashboard_tour_meta_update(){
	global $wpdb;
	$current_user_id = get_current_user_id();
	update_user_meta($current_user_id, 'guidenewUserTour', 'Yes');
	die();
}
add_action('wp_ajax_nopriv_seeker_dashboard_tour_meta_update','seeker_dashboard_tour_meta_update');
add_action('wp_ajax_seeker_dashboard_tour_meta_update','seeker_dashboard_tour_meta_update');

// permissions & allowances page ajax for default employer
add_action('wp_ajax_permissions_n_allowances_for_default_emp', 'permissions_n_allowances_for_default_emp');
add_action('wp_ajax_nopriv_permissions_n_allowances_for_default_emp', 'permissions_n_allowances_for_default_emp');

function permissions_n_allowances_for_default_emp(){
	$user_id = $_POST['user_id'];
	$field_names = array('PNA_BACK_VERI_REPORT','PNA_CURRENT_EMPLOYER','PNA_LICENSING_DOC','PNA_HONORS_N_AWARDS','PNA_PHOTOGRAPH','PNA_CERTIFICATIONS','PNA_BADGES','PNA_REFERRALS','PNA_REFERENCED','PNA_EDUCATION','PNA_SELF_ASSESSMENTS','PNA_CELL_PHONE_NO');
	if(isset($user_id)){
		foreach($field_names as $field_name){
			if($field_name == 'PNA_BACK_VERI_REPORT' || $field_name == 'PNA_CURRENT_EMPLOYER' || $field_name == 'PNA_LICENSING_DOC' || $field_name == 'PNA_REFERENCED' || $field_name == 'PNA_CELL_PHONE_NO'){
				set_cimyFieldValue($user_id, $field_name, 'No');
			}else{

				set_cimyFieldValue($user_id, $field_name, 'Yes');
			}
		}
	}
	die();
}

// permissions & allowances page ajax for default recruiter
add_action('wp_ajax_permissions_n_allowances_for_default_rec', 'permissions_n_allowances_for_default_rec');
add_action('wp_ajax_nopriv_permissions_n_allowances_for_default_rec', 'permissions_n_allowances_for_default_rec');

function permissions_n_allowances_for_default_rec(){
	$user_id = $_POST['user_id'];
	$field_names = array('PNAR_BACK_VERI_REP','PNAR_CURRENT_EMPLOY','PNAR_LICENSING_DOC','PNAR_HONORS_N_AWARD','PNAR_PHOTOGRAPH','PNAR_CERTIFICATIONS','PNAR_BADGES','PNAR_REFERRALS','PNAR_REFERENCED','PNAR_EDUCATION','PNAR_SELF_ASSESSMENT','PNAR_CELL_PHONE_NO');
	if(isset($user_id)){
		foreach($field_names as $field_name){
			if($field_name == 'PNAR_BACK_VERI_REP'){
				set_cimyFieldValue($user_id, $field_name, 'No');
			}else{
				set_cimyFieldValue($user_id, $field_name, 'Yes');
			}

		}
	}
	die();
}

// communications and preferences ajax
add_action('wp_ajax_communication_preferences', 'communication_preferences');
add_action('wp_ajax_nopriv_communication_preferences', 'communication_preferences');

function communication_preferences(){
	$user_id = $_POST['user_id'];
	$field_names = $_POST['field_names'];
	$field_values = $_POST['field_values'];
	if(isset($user_id) && isset($field_names)){
		set_cimyFieldValue($user_id, $field_names, $field_values);
	}
	die();
}



/* ajax for delete name and email user*/ 
add_action('wp_ajax_delete_name_email', 'delete_name_email');
add_action('wp_ajax_nopriv_delete_name_email', 'delete_name_email');

function delete_name_email(){
	$return_msg = array();
	$friend_n_coll_id = $_POST['friend_n_coll_id'];
	$current_user_id = $_POST['current_user_id'];

	$existing_rfname = get_user_meta($current_user_id, 'rfname', true);
	$existing_rfmail = get_user_meta($current_user_id, 'rfemail', true);
	$existing_rfdate = get_user_meta($current_user_id, 'rfdate', true);
	$mynetwork_lastupdate = get_user_meta($current_user_id , 'mynetwork_lastupdate', true);

	if(!empty($existing_rfname) && !empty($existing_rfmail)){
		
		$existing_rfname_arr = explode(',', $existing_rfname);
		$removeName = $existing_rfname_arr[$friend_n_coll_id];
		array_splice($existing_rfname_arr,$friend_n_coll_id,1);
		$existing_rfname_arr = implode(',', $existing_rfname_arr);
		update_user_meta( $current_user_id, 'rfname', $existing_rfname_arr);
		
		
		$existing_rfmail_arr = explode(',', $existing_rfmail);
		$removeemail = $existing_rfmail_arr[$friend_n_coll_id];
		array_splice($existing_rfmail_arr,$friend_n_coll_id,1);
		$existing_rfmail_arr = implode(',', $existing_rfmail_arr);
		update_user_meta( $current_user_id, 'rfemail', $existing_rfmail_arr);

		$existing_rfdate_arr = explode(',', $existing_rfdate);
		if ( isset($existing_rfdate_arr[$friend_n_coll_id]) ) {
			$removedate = $existing_rfdate_arr[$friend_n_coll_id];
			array_splice($existing_rfdate_arr,$friend_n_coll_id,1);
			$existing_rfdate_arr = implode(',', $existing_rfdate_arr);
			update_user_meta( $current_user_id, 'rfdate', $existing_rfdate_arr);
		}


		$mynetwork_lastupdate_arr = explode(',', $mynetwork_lastupdate);
		array_splice($mynetwork_lastupdate_arr,$friend_n_coll_id,1);
		$mynetwork_lastupdate_arr = implode(',', $mynetwork_lastupdate_arr);
		update_user_meta( $current_user_id, 'mynetwork_lastupdate', $mynetwork_lastupdate_arr);


		$referenced_name = $existing_rfname_arr;
		$exploded_referenced_name = explode(',', $referenced_name);
		$referenced_email = $existing_rfmail_arr; 
		$exploded_referenced_email = explode(',', $referenced_email); 

		global $wpdb;

		$wpdb->insert(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $current_user_id,
				'action'   => 'RemoveReference',
				'datetime' => time(),
				'meta' 	   => 'Modified Preferences > remove reference '.$removeName.' ('.$removeemail.')'
				),
			array( '%d', '%s', '%s', '%s' )
			);

			?>

			<div class="search_bar">
			<!-- <div class="pull-right">
				<a href="#">Change View</a>
				<div class="input-group">
			      <input type="text" class="form-control" placeholder="Search">
			      <span class="input-group-btn">
			        <button class="btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
			      </span>
			    </div>
			  </div> -->
			  <p>These are the <span>
			  	<?php
			  	if( !empty($referenced_name) && !empty($referenced_email) ) { 
			  		$exploded_referenced_name = explode(',', $referenced_name);
			  		$no_of_refs = count($exploded_referenced_name);
			  		echo $no_of_refs; 
			  	}
			  	else{
			  		echo "0";
			  	}	?></span> references in my network.</p>
			  	<div class="clearfix"></div>
			  </div>
			  <div class="network_list indent">
			  	<div class="row">
			  		<?php 
			  		if( !empty($referenced_name) && !empty($referenced_email) ) { 
			  			$exploded_referenced_name = explode(',', $referenced_name);
			  			$exploded_referenced_email = explode(',', $referenced_email); 

			  			if (!empty($referenced_date)) {
			  				$exploded_referenced_date = explode(',', $referenced_date); 
			  			}
			  			else{
			  				$exploded_referenced_date = array();
			  			}

			  			$lastUpdate  = get_user_meta( $current_user_id, 'mynetwork_lastupdate', true);
			  			$exploded_gettimelastupdate = explode(',', $lastUpdate );
			  			foreach( $exploded_referenced_name as $ref_name_key => $ref_name ) { 
			  				if( email_exists($exploded_referenced_email[$ref_name_key]) ){ 
			  					$getuser = get_user_by('email', $exploded_referenced_email[$ref_name_key]);
			  					$fname = $getuser->first_name;
			  					$usename = $fname.' '.$getuser->last_name;
			  					$displayname = $getuser->display_name;
			  					$name = (($fname))? $usename : $displayname;
			  					$acceDate =  date("m/d/Y", strtotime($getuser->user_registered) );
			  					$BEST_INDUSTRY = get_cimyFieldValue($getuser->ID, 'BEST_INDUSTRY');

			  					$sector = ( trim($BEST_INDUSTRY) )? $BEST_INDUSTRY : '--';
			  				}
			  				else{ 
			  					$name = $ref_name;
			  					$acceDate = '--';
			  					$sector = '--';
			  				} 

			  				if ( isset($exploded_referenced_date[$ref_name_key]) ) {
			  					$inviteddate = $exploded_referenced_date[$ref_name_key];
			  					$inviteddate = date('m/d/Y', $inviteddate);
			  				}
			  				else{
			  					$inviteddate = '--';
			  				}

			  				?>
			  				<div class="col-sm-6">
			  					<article>
			  						<h4><?php echo $name; ?></h4>
			  						<div class="network-images">
			  							<?php 
			  							if( email_exists($exploded_referenced_email[$ref_name_key]) ){ 
			  								$getuser = get_user_by('email', $exploded_referenced_email[$ref_name_key]);
			  								$userID = $getuser->ID;

			  								$followAttr = 'class="message_now" count="'.$ref_name_key.'" rel="'.$userID.'"';
			  								$followtext = 'MESSAGE NOW';


			  								if ( isset($exploded_referenced_date[$ref_name_key]) ) {
			  									$regitime = new DateTime($getuser->user_registered);
			  									$changestrtotoime = date( 'Y-m-d H:i:s', $exploded_referenced_date[$ref_name_key]);
			  									$requtime = new DateTime($changestrtotoime);

			  									if ( $regitime >= $requtime) {
			  										echo '<span class="badge">This <br>Just In</span>';
			  									}
			  								}

			  								echo do_shortcode('[ica_avatar uid="'.$userID.'"]');
			  								echo "<span class='join_rec_id'>Recruit ID: ".$userID."</span>";
			  							}
			  							else{ 
			  								$followAttr = 'class="follow_up" count="'.$ref_name_key.'" refname="'.$name.'" refemail="'.$exploded_referenced_email[$ref_name_key].'"';
			  								$followtext = 'FOLLOW UP';
			  								?>
			  								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/EyeRecruit_Avitar.jpg" class="img-responsive">
			  								<?php } ?>
			  							</div>
			  							<div class="article_content">
			  								<ul class="network_list_info">
			  									<li class="cu_wordwrap"><span>Sector: </span> <?php echo $sector; ?></li>
			  									<li class="cu_wordwrap"><span>Invited: </span> <?php echo $inviteddate; ?></li>
			  									<li class="cu_wordwrap"><span>Accepted: </span> <?php echo $acceDate; ?> </li>
			  									<li>
			  										<span>Status: </span>
			  										<?php 
			  										if( email_exists($exploded_referenced_email[$ref_name_key]) ){ 
			  											echo "<strong>In Network</strong>";
			  										}else{ ?>
			  										<strong>Pending</strong><?php
			  									}

			  									?>	
			  								</li>
			  							</ul>
			  						</div>
			  						<div class="clearfix"></div>
			  						<div class="article_footer my_network">
			  							<a href="javascript:void(0);" <?php echo $followAttr; ?> ><?php echo $followtext; ?></a>
			  							<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
			  						</div>
			  					</article>
			  					</div><?php 
			  				} 
			  			} 
			  			?>
			  		</div>
			  		</div><?php
			  	}
			  	die();
			  }


			  /* ajax for password reset*/ 
			  add_action('wp_ajax_reset_pass_form', 'reset_pass_form');
			  add_action('wp_ajax_nopriv_reset_pass_form', 'reset_pass_form');

			  function reset_pass_form(){
			  	if( (!empty($_POST['new_pass']))  && (isset($_POST['new_pass']))  ){
			  		$current_user_id = get_current_user_id();
			  		$userdata = get_userdata($current_user_id);
			  		wp_set_password( $_POST['new_pass'], $current_user_id );
			  		wp_set_current_user($current_user_id);
			  		wp_set_auth_cookie($current_user_id);
			  		global $wpdb;
			  		$wpdb->insert(
			  			$wpdb->prefix.'user_activity_log',
			  			array(
			  				'user_id'  => $current_user_id,
			  				'action'   => 'changePassword',
			  				'datetime' => time(),
			  				'meta' 	   => 'Modified Preferences > Change password'
			  				),
			  			array( '%d', '%s', '%s', '%s' )
			  			);
			  		echo "Your password is reset successfully";
			  		die();
			  	}
			  	die();
			  }


			  /* ajax for password reset*/ 
			  add_action('wp_ajax_pag_prefer_log_hstry', 'pag_prefer_log_hstry');
			  add_action('wp_ajax_nopriv_pag_prefer_log_hstry', 'pag_prefer_log_hstry');

			  function pag_prefer_log_hstry() {
			  	global $wpdb;
			  	$current_user_id = get_current_user_id();
			  	if( isset($_POST['offset']) ) {
			  		$offset = $_POST['offset'];
			  		$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_login_history WHERE user_id = '".$current_user_id."' LIMIT ".$offset.",10" );

			  		$current_time = current_time( 'timestamp' );
			  		foreach ($myrows as $key) { ?>
			  		<tr>
			  			<td><strong><?php echo $key->browser; ?> </strong><?php echo $key->device; ?></td>
			  			<td><?php echo $key->location; ?></td>
			  			<td><?php echo $key->ip_address; ?></td>
			  			<td><?php echo esc_html(human_time_diff(mysql2date('U', $key->login_date), $current_time)) . ' ago'; ?></td>
			  		</tr>
			  		<?php } 							
			  	}
			  	die();
			  }

			  /* ajax for password reset*/ 
			  add_action('wp_ajax_paginate_preferences_recent_activity', 'paginate_preferences_recent_activity');
			  add_action('wp_ajax_nopriv_paginate_preferences_recent_activity', 'paginate_preferences_recent_activity');

			  function paginate_preferences_recent_activity() {
			  	global $wpdb;
			  	$current_user_id = get_current_user_id();
			  	if( isset($_POST['offset']) ) {
			  		$offset = $_POST['offset'];
			  		$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id='".$current_user_id."' LIMIT ".$offset.",10" );
			  		$current_time = current_time( 'timestamp' );
			  		foreach ($myrows as $key) { ?>
			  		<tr>
			  			<td><?php echo $key->meta; ?></td>
			  			<td class="text-right"><?php echo date('g.iA \o\n j M, Y', $key->datetime); ?></td>
			  		</tr>
			  		<?php
			  	}				
			  }
			  die();
			}


			function auto_login_new_user( $user_id ) {
				wp_set_current_user($user_id);
				wp_set_auth_cookie($user_id);
    // You can change home_url() to the specific URL,such as 
    //wp_redirect( 'http://www.wpcoke.com' );
				echo wp_redirect( site_url('/employer-dashboard/') );
				exit;
			}


			add_action('login_footer', 'my_addition_to_login_footer');
			function my_addition_to_login_footer() {
				echo '<div class="text-center"><a class="loginexit_page" href="'.site_url().'">Exit This Page</a></div>';
			}


			function login_function() {
				add_filter( 'gettext', 'username_change', 20, 3 );
				function username_change( $translated_text, $text, $domain ) 
				{
					if ($text === 'Username or Email Address') 
					{
						$translated_text = 'AUTHORIZED USER:';
					}
					return $translated_text;
				}
			}
			add_action( 'login_head', 'login_function' );

			function login_functions() {
				add_filter( 'gettext', 'password_change', 20, 3 );
				function password_change( $translated_text, $text, $domain ) 
				{
					if ($text === 'Password') 
					{
						$translated_text = 'AUTHORIZED ACCESS CODE:';
					}
					return $translated_text;
				}
			}
			add_action( 'login_head', 'login_functions' );

			function login_functionss() {
				add_filter( 'gettext', 'label_change', 20, 3 );
				function label_change( $translated_text, $text, $domain ) 
				{
					if ($text === 'Lost your password?') 
					{
						$translated_text = 'Assistance';
					}
					return $translated_text;
				}
			}
			add_action( 'login_head', 'login_functionss' );

// define the wp_mail_failed callback 
			function action_wp_mail_failed($wp_error) 
			{
				return error_log(print_r($wp_error, true));
			}

// add the action 
			add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);

//returns a stylized form input
//https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/
			function style_file_input_fn( $atts ) {

	// Attributes
				$atts = shortcode_atts(
					array(
						'fieldID' => 'fieldDefaultID',
						'fieldName' => 'fieldDefaultName',
						'multiple' => 'false'
						),
					$atts,
					'style_file_input'
					);
				$multipleString='';
				if($atts['multiple'] != 'false'){
					$multipleString=' multiple ';
				}
				$html = '<div class="styledInputField">';
				$html .= '<input type="file" name="'.$atts['fieldName'].'" id="'.$atts['fieldID'].'" class="inputfile" data-multiple-caption="{count} files selected" '.$multipleString.' />
				<label for="'.$atts['fieldID'].'"><i class="fa fa-upload"></i> <span>Choose a file</span></label>';
				$html .= '</div>';
				return $html;

			}
			add_shortcode( 'style_file_input', 'style_file_input_fn' );

/*
* USAGE: [getcimyfieldoptions field='CIMY_FIELDNAME']
*/
function get_cimy_field_options($atts){
	global $wpdb;

	$atts = shortcode_atts(
		array(
			'field' => 'default',
			'emptylabel' => ''
			),
		$atts,
		'get_cimy_field_options'
		);

	$htmlStr ='';
	
	if($atts['field'] != 'default'){
			//search eyecuwp_cimy_uef_fields
		$result = $wpdb->get_row( 'SELECT * FROM eyecuwp_cimy_uef_fields WHERE NAME = "' .$atts['field'].'"' );

		$fieldLabel = $result->LABEL   ;

	//when you find the record get the 'TYPE' column
		if($result->TYPE == 'dropdown'){
			$tmp  = explode("/", $result->LABEL );
			$question = $tmp[0];
			$options_arr = explode("," , $tmp[1]); 
		//$htmlStr .= '<label class="question">' . $question .'</label2>'  ;
			$htmlStr .= '<select class="form-control" name="'.$atts['field'].'">';

			for ($i=0; $i<count($options_arr); $i++ ){
				if($i==0){
					if($options_arr[$i]=='' ){
						$htmlStr .= '<option value="">'.$atts['emptylabel'].'</option>';
					}
				}else{
					$htmlStr .= '<option value="'.$options_arr[$i].'">'. $options_arr[$i] .'</option>';
				}
			}
			$htmlStr .= '</select>';
		}

	////DROPDOWN MULTI TYPE
		if($result->TYPE == 'dropdown-multi'){
		//break apart label
		//neeed to find first position of forward slash of label which sseparates the question from the options,
			$tmp  = explode("/", $result->LABEL );
			$question = $tmp[0];
			$options_arr = explode("," , $tmp[1]); 
			$htmlStr .= '<label class="question">' . $question .'</label2>'  ;
			$htmlStr .= '<select name="'.$atts['field'].'" id="'.$atts['field'].'" multiple>';

			for ($i=0; $i<count($options_arr); $i++ ){
				if($i==0  ){
					if($options_arr[$i]=='' ){
						$htmlStr .= '<option value="">'.$atts['emptylabel'].'</option>';
					}
				}else{
					$htmlStr .= '<option value="'.$options_arr[$i].'">'. $options_arr[$i] .'</option>';
				}
			}
			$htmlStr .= '</select>';

		}
	///GET DESCRIPTION
		if( $result->DESCRIPTION ){
			$htmlStr .= '<div class="fineprint">'.$result->DESCRIPTION ."</div>";		
		}

		
	}

	return $htmlStr;
}
add_shortcode('getcimyfieldoptions','get_cimy_field_options');

/*
returns an array of options 
use for dropdowns
*/
function get_cimy_options_arr_from_field($fieldname){

	$allCimyFields = get_cimyFields();
	if (count($allCimyFields) > 0) {
		foreach ($allCimyFields as $field) {

			if(cimy_uef_sanitize_content($field['NAME']) == $fieldname){
				$str =  cimy_uef_sanitize_content($field['LABEL']) ;
				break;
			}
		}
	}

	//find the first slash
	if (($tmp = strstr($str, '/')) !== false) {
		$str = substr($tmp, 1);
	}
	//explode everything after based on comma
	//return array
	return explode(',',$str);
}

///////
//AWARD BADGES
///////
function get_er_badges($uID){
	return 'none';
	/*
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge1.jpg" class="img-responsive">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge2.jpg" class="img-responsive">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge3.jpg" class="img-responsive">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge4.jpg" class="img-responsive">
										*/
									}
///////
//RETURNS A USER'S SPOKEN LANGUAGES
////
									function getUserSpokenLanguages($user_id,$includeRatingBool){

										$lang_base_array=array("mandarin","vietnamese","english","javanese","spanish","tamil","hindi","Korean","russian","turkish","arabic","telugu","portuguese","marathi","bengali","italian","french","thai","malay","burmese","german","cantonese","japanese","kannada","farsi","gujarati","urdu","polish","punjabi","wu");
//get list_languages_mandarin
										$arr2  = array();

										$htmlStr = '<ul>';
										for ($i=0;$i<count($lang_base_array);$i++){
											$lang = get_user_meta($user_id , 'list_languages_'. $lang_base_array[$i]  , true);
											if($lang){
												array_push($arr2, $lang  );
												$htmlStr .= '<li>';
												$htmlStr .=  $lang ;
		//get mandarin_rating
												if($includeRatingBool ){
													$htmlStr .= '<br>'.get_user_meta($user_id , $lang_base_array[$i]. '_rating'  , true) .'<br>';
												}
												$htmlStr .= '</li>';
											}
										}

										$htmlStr .= '</ul>';
// return $htmlStr;
										return implode(',', $arr2);
									}

///
									function er_asset_icon($filename){
										$filename = get_stylesheet_directory_uri().'/img/icons/'.$filename;
										echo '<img src="'.$filename.'" alt="icon">';
									}
/* 
DISCLAIMERS
usage: [er_disclaimer disclaimer_type="armed_forces"]
*/
function er_disclaimer($atts){
	switch($atts['disclaimer_type']){
		case "armed_forces":
		return "EyeRecruit, Inc. and the site EyeRecruit.com, is a Proud supporter of Veterans, Veteran Families and the men and women of the Armed Forces. This site is providing only the information that you as a member are willing to provide to us. We do not confirm or validate this information to be factual. EyeRecruit, Inc is not responsible for incorrect information supplied by users. Providing Military Service information IS NOT MANDATORY and by continuing to use this service you continue to agree to be bound by our Terms & Conditions. Learn More about Military Service Records - DD Form 214 - and consider obtaining any and all supporting documentation and providing it for interest parties on this platform. Again, thank you for your service.";
		break;

		case "federal":
		return "EyeRecruit, Inc. and the site EyeRecruit.com, is a Proud supporter of the Federal Govenrment and the men and women who provide service to our country. This site is providing only the information that you as a member are willing to provide to us. We do not confirm or validate this information to be factual. EyeRecruit, Inc is not responsible for incorrect information supplied by users. Providing Federal Law Enforcement or Federal Investigative Agency information IS NOT MANDATORY and by continuing to use this service you continue to agree to be bound by our Terms & Conditions. Consider obtaining any and all supporting documentation regarding your Federal Investigative & Security history and providing it for interest parties on this platform. Again, thank you for your service and God Bless America.";
		break;

		default:
		return "Default disclaimer";
		break;
	}
}
add_shortcode( 'er_disclaimer', 'er_disclaimer' );

/* Dynamically update dropdown for toolset types */
//dynamically populate select field from Types
add_filter( 'wpt_field_options', 'prefix_custom_options', 10, 3);

function prefix_custom_options( $options, $title, $type ){
	switch( $title ){
		case 'Assessment Type':
		$options = array();
		$options[] = array(
      '#value' => 'Select',
      '#title' => 'Select Assessment Type',
      );
		$args = array(
			'hide_empty' => 'false');
		$terms = get_terms( array('assessment-category'),$args );
		foreach ($terms as $term) {
			$options[] = array(
				'#value' => $term->term_id,
				'#title' => $term->name,
				);
		}
		break;

	}
	return $options;
}

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
function er_admin_create_cpt_filter_dropdown($post_type, $taxonomy){
  global $typenow;
  if ($typenow == $post_type) {
    $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
    $info_taxonomy = get_taxonomy($taxonomy);
    wp_dropdown_categories(array(
      'show_option_all' => __("Show All {$info_taxonomy->label}"),
      'taxonomy'        => $taxonomy,
      'name'            => $taxonomy,
      'orderby'         => 'name',
      'selected'        => $selected,
      'show_count'      => true,
      'hide_empty'      => true,
      ));
  };
}
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
  er_admin_create_cpt_filter_dropdown('profile-builder-step','profile-category');
  er_admin_create_cpt_filter_dropdown('assessment-question','assessment-category');
  er_admin_create_cpt_filter_dropdown('faq','faq-category');
  er_admin_create_cpt_filter_dropdown('site-tip','site-tip-category');
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
function er_admin_get_filtered_cpt_taxonomy_posts($query,$post_type,$taxonomy){
  global $pagenow;
  $q_vars    = &$query->query_vars;
  if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
    $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
    $q_vars[$taxonomy] = $term->slug;
  }
}

add_filter('parse_query', 'tsm_convert_id_to_term_in_query1');
function tsm_convert_id_to_term_in_query1($query) {
  er_admin_get_filtered_cpt_taxonomy_posts($query,'profile-builder-step','profile-category');
  er_admin_get_filtered_cpt_taxonomy_posts($query,'assessment-question','assessment-category');
  er_admin_get_filtered_cpt_taxonomy_posts($query,'faq','faq-category');
  er_admin_get_filtered_cpt_taxonomy_posts($query,'site-tip','site-tip-category');
}

/* FAQ CUSTOM POST TYPE */
function get_er_faq($atts){
  $atts = shortcode_atts( array(
    'cat_id' => 0
    ), $atts, 'get_er_faq' );
  
  if($atts['cat_id'] != 0){
    $args=array(
      'post_type'           => 'faq',
      'post_status'         => array( 'publish'),
      'tax_query' => array(
        array( 
          'taxonomy' => 'faq-category',
          'field' => 'id',
          'terms' => $atts['cat_id']
          )
        ),
      'posts_per_page' => -1
      );
  }else{
    $args=array(
      'post_type'           => 'faq',
      'post_status'         => array( 'publish'),
      'posts_per_page' => -1
      );
  }

  $html = '<div class="faq_wrapper">';

  $questions = new WP_Query($args);
  while ( $questions->have_posts() ) {
    $questions->the_post();
    $postMeta=get_post_meta(get_the_ID() );
    $html .= '<h3 class="faq_title">'.get_the_title().'</h3>';
    $html .= '<div class="faq_content">'.get_the_content().'</div>';
  }
  $html .= '<div>';
  wp_reset_postdata();
  return $html;
}
add_shortcode('faq','get_er_faq');
/////////
function load_custom_er_wp_admin_style() {
  wp_register_style( 'custom_er_wp_admin_css', get_stylesheet_directory_uri() . '/css/er-admin-style.css', false, '1.0.0' );
  wp_enqueue_style( 'custom_er_wp_admin_css' );
  wp_register_script(
    'custom-er-admin',
    get_stylesheet_directory_uri() . '/inc/js/er-admin.js',
    false,
    '1.0',
    true
    );

  wp_enqueue_script( 'custom-er-admin' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_er_wp_admin_style' );

/*
RETURN AN ARRAY OF POST_IDS BY CUSTOM POST TYPE AND TAXONOMY
*/
function get_cpt_taxonomy_post_ids($post_type_slug,$taxonomy_slug,$terms_id){
  //if id is numeric we assume actual id otherwise we pull by slug
  if(is_numeric($terms_id)){
    $field_type = 'id';
  }else{
    $field_type = 'slug';
  }

  $the_query = new WP_Query( array(
    'post_type' => $post_type_slug,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'tax_query' => array(
      array(
        'taxonomy' => $taxonomy_slug,
        'field' => $field_type,
        'terms' => $terms_id
        )
      )
    ) );
  $post_ids = wp_list_pluck( $the_query->posts, 'ID' );
  return $post_ids;
}

<?php

function custom_char_length($x, $length, $link) {
  if(strlen($x)<=$length){
    echo $x;
  } else {
    $y=substr($x,0,$length) . '... <a href="'.$link.'">Read more</a>';
    echo $y;
  }
}

function count_char_length($x, $length = 27) {
  if(strlen($x)<=$length){
    return $x;
  } else {
    $y=substr($x,0,$length) . '...';
    return $y;
  }
}
/*
PULL ONLY THE CONTENT OF A RANDOM GENERATED MEMBER TIP
*/
function er_random_member_tip_content($atts){
	$atts = shortcode_atts( array(
    			'tax_id' => 1,
    			'tax_slug' => 'default'
    			), $atts, 'er_random_member_tip_content' );
	//args only if tax_slug is defined
	if($atts['tax_term'] != 'default'){
		//by tax id
	$args = array(
		"post_type"=>'site-tip',
		"post_status"=>'publish',
		'orderby' => 'rand',
		'order' => 'DESC',
		 'tax_query' => array(
        array( 
            'taxonomy' => 'site-tip-category',
            'field' => 'slug',
            'terms' => $atts['tax_slug']
        )
    ),
	"posts_per_page"=> 1
	);
	}else{
		//by tax id
	$args = array(
		"post_type"=>'site-tip',
		"post_status"=>'publish',
		'orderby' => 'rand',
		'order' => 'DESC',
		 'tax_query' => array(
        array( 
            'taxonomy' => 'site-tip-category',
            'field' => 'id',
            'terms' => $atts['tax_id']
        )
    ),
	"posts_per_page"=> 1
	);
	}
	

	$the_queries = new Wp_query($args);
	if($the_queries->have_posts()){
		while($the_queries->have_posts()){ $the_queries->the_post(); 
				$content = get_the_content();
				return '<p>'.$content.'</p>';  
		}
	}
	else{ 
		$notFoundTerm = $atts['tax_term']? $atts['tax_term'] : $atts['tax_id'];
		return '<p>Tips not found for tip category: '. $notFoundTerm .'</p>';
	} 
	wp_reset_postdata();
}
add_shortcode('er_random_member_tip_content','er_random_member_tip_content');

function jobseeker_basic_info_member_tips($value){ ?>
	<aside class="widget widget_wpb_widget special_box special_logo navi_thumbnail">
		<?php
		//termsID is "Seeker preferences"
		$args = array(
		"post_type"=>'site-tip',
		"post_status"=>'publish',
		'orderby' => 'rand',
		'order' => 'DESC',
		 'tax_query' => array(
        array( 
            'taxonomy' => 'site-tip-category',
            'field' => 'id',
            'terms' => 532
        )
    ),
	"posts_per_page"=> 1
	
	);
		$the_queries = new Wp_query($args);
		echo '<div class="thumbnail"><img class="img-responsive" src="'. site_url() .'/assets/themes/eye-recruit-2015/img/navi_logo-icon.png"></div>';
		if($the_queries->have_posts()){
			while($the_queries->have_posts()){ $the_queries->the_post(); ?>
				<h5><a href="<?php  the_permalink(); ?>"><?php //echo get_the_title(); ?> MEMBER TIP</h5></a>
				<?php 
				$link = get_the_permalink(); 
				$content = get_the_content();
				echo "<p>";
				echo $content; 
				echo "</p>";
			}
			wp_reset_postdata();
		}
		else{ ?>
			<p>No tips found for this section.</p>
		<?php } 
		
	echo "</aside>";
}



function member_dashboard_sidebar_tips_function($value){
	$args = array(
		"post_type"=>'site-tip',
		"post_status"=>'publish',
		'orderby' => 'rand',
		'order' => 'DESC',
		 'tax_query' => array(
        array( 
            'taxonomy' => 'site-tip-category',
            'field' => 'id',
            'terms' => 480
        )
    ),
	"posts_per_page"=> 1
	
	);
	$the_queries = new Wp_query($args);
	if($the_queries->have_posts()){
		while($the_queries->have_posts()){ $the_queries->the_post(); ?>
			<div class="sidebar_title">
				<span class="title_icon tips_icon"></span>
				<h4>Tip #<?php echo get_the_id(); ?></a>
			</div>
			<p><?php  $link = get_the_permalink(); 
				$content = get_the_content();
				echo $content;  ?>
			</p> <?php
		}
	}
	else{ ?>
		<div class="sidebar_title">
			<span class="title_icon tips_icon"></span>
			<h4>Tips not found</h4>
		</div>
	<?php } 
	wp_reset_postdata();
}


function member_navigation_sidebar_tips_function($value){ ?>
	<div class="special_box special_logo navi_thumbnail">
		<div class="thumbnail"><img src="<?php  echo get_stylesheet_directory_uri(); ?>/img/navi_logo-icon.png" class="img-responsive"></div>
		<h5>MEMBER TIP</h5>
		<?php
		if(!is_numeric($value)){
			//echo ('<strong>DEV TO REPROGRAM jobseeker_basic_info_member_tips for '.$value.' to use category taxonomy insteady of select_page_to_show meta (line #70-76)</strong>');
			echo (do_shortcode('[er_random_member_tip_content tax_slug='.$value.']'));
		}else{
			echo (do_shortcode('[er_random_member_tip_content tax_id='.$value.']'));
		}
	echo "</div>"; 
}


/*.....Reach Out for a Recommendation Reference.....*/

add_action('wp_ajax_reach_out_and_ask_for_reference','reach_out_and_ask_for_reference');
add_action('wp_ajax_nopriv_reach_out_and_ask_for_reference','reach_out_and_ask_for_reference');

function reach_out_and_ask_for_reference(){
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
		$tablename = $wpdb->prefix.'er_references';
		
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
			$sender_recommendation_link = get_site_url().'/add-reference/?rID='.$wpdb->insert_id;
			$get_option_arr 	= get_option('reach_out_reference');
			$setting_options 	= get_option('xtreem_options_smtp');
			$to 				= $value;//$setting_options['tomail'];
			$shordcode_to_rep 	= array('[site-url]','[reference_first_name]','[reach_out_recommendation_last_name]','[reach_out_recommendation]','[sender_name]','[sender_reference_link]');
			$replace_with 		= array(site_url(),$fname[$key],$lname[$key],$user_msg, $sender_name,$sender_recommendation_link);
			$subject 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['reach_out_reference_subject']);
			$message 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['reach_out_reference_template']);
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
            'action'   => 'reachReference',
            'datetime' => time(),
            'meta'     => 'Add new referral '.$nameList
          ),
          array( '%d', '%s', '%s', '%s' )
        );	
	}
	die();
}

/*..............delete reference......*/
add_action('wp_ajax_delete_reach_reference','delete_reach_reference');
add_action('wp_ajax_nopriv_delete_reach_reference','delete_reach_reference');

function delete_reach_reference(){
	$return = array();
 	if ( isset($_POST['refcid']) && is_user_logged_in() ) {
	 	global $wpdb;
	 	$user_id = get_current_user_id();
	 	$refcid = $_POST['refcid'];
	 	$tablename = $wpdb->prefix.'er_references';
		$select = $wpdb->get_row("SELECT * FROM $tablename WHERE id = '".$refcid."' AND user_id = '".$user_id."' ");
		$ref_detail = unserialize($select->ref_detail);

		if ( !empty($select->id) ) {
			
			$wpdb->delete(
				$tablename,
				array('id' => $refcid),
				array('%d')
			);

			if ( !empty($ref_detail) ) {
				$rname = $ref_detail['fname']. ' '.$ref_detail['lname'];
				$remail = $ref_detail['Email'];
				$remail = (($remail)) ? '( '.$remail.' )' : '';
			}
			else{
				$rname = '';
				$remail = '';
			}
	        $wpdb->insert(
				$wpdb->prefix.'user_activity_log',
				array(
					'user_id'  => $user_id,
					'action'   => 'removeRefe',
					'datetime' => time(),
					'meta'     => 'Remove a reference '.$rname. $remail
				),
				array( '%d', '%s', '%s', '%s' )
	        );	

			$return['msg'] = 'success';
			die(json_encode($return));		
		}else{
			$return['msg'] = 'error';
			die(json_encode($return));		
		}
	}
	else{
		$return['msg'] = 'error';
		die(json_encode($return));	
	}
}

function recrutier_contact_now($schedule = 'show'){ 
	$userid = get_current_user_id();
	$data = get_userdata($userid);
	?>
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
			<button type="button" class="close closesendamail" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <div class="row">
	        	<div class="col-sm-6 col-sm-push-6">
	        		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cirstopher.jpg" class="img-responsive">
	        	</div>
	        	<div class="col-sm-6 col-sm-pull-6">
	        		<p>Hello <span><?php echo $data->first_name; ?></span>,</p>
	        		<p>My name is <span>Christopher Bauer</span> and I am proud to offer you my assistance. I have been a member of the <span>Security</span>, <span>Investigation</span> & <span>Risk Management</span> industry since <span>1993</span>.</p>
	        		<p>I have experience in <span>not only the field conducting Investigations, Servelliance and Security Services, but I also have many years in supervisory, management and executive</span> roles that will be of assistance to you in your career.</p>
	        		<p>As a recruiter I will be able to offer guidance and feedback on an individualized, but most importantly, I can search out, forward or provide introduction when the right oppportunity presents itself.</p>
	        		<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cirstopher_sign.jpg" class="img-responsive"></p>
	        		<?php if ( $schedule == 'show' ) { ?>
	        			<div class="text-center"><a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick='var soqueryparam = "//secure.scheduleonce.com/ChrisBauer?thm=gray&bt=1"; if (window.location.href.indexOf("?") > 0) {   soqueryparam += "&"+window.location.href.slice(window.location.href.indexOf("?") + 1);}window.open(soqueryparam)'>Schedule a Call</a>
	        		<?php } ?>
	        		
	        		<a href="javascript:void(0);" class="btn btn-default btn-sm">Ask a Question</a>
	        		<a href="javascript:void(0);" class="btn btn-default btn-sm">Introduce Me</a></div>
	        	</div>
	        </div>
	      </div>
	    </div>
    </div>
<?php }


/*function redirect_login_page(){
	global $pagenow;
	if( $pagenow == "wp-login.php" ) {
		$cssUrl = get_stylesheet_directory_uri(); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $cssUrl.'/dashboard.css'; ?>"> <?php
	}
}

add_action( 'init','redirect_login_page' );*/

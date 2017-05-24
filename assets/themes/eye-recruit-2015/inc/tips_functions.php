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


function jobseeker_basic_info_member_tips($value){ ?>
	<aside class="widget widget_wpb_widget special_box special_logo navi_thumbnail">
		<?php
		$args = array(
			"post_type"=>'tips',
			"post_status"=>'publish',
			//'orderby' => 'rand',
			'order' => 'DESC',
			"posts_per_page"=> 1,
			'meta_query'    => array(
			    array(
			        'key'       => 'select_page_to_show',
			        'value'     =>  $value,
			        'compare'   => 'LIKE',
			    )
			)
		);
		$the_queries = new Wp_query($args);
		if($the_queries->have_posts()){
			while($the_queries->have_posts()){ $the_queries->the_post(); ?>
				<div class="thumbnail"><img class="img-responsive" src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png"></div>
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
			<h3>Tips not found</h3>
		<?php } 
	echo "</aside>";
}



function member_dashboard_sidebar_tips_function($value){
	$args = array(
		"post_type"=>'tips',
		"post_status"=>'publish',
		'orderby' => 'rand',
		'order' => 'DESC',
		 'tax_query' => array(
        array( 
            'taxonomy' => 'tip_category',
            'field' => 'id',
            'terms' => 456
        )
    ),
	"posts_per_page"=> 1
	/*	'meta_query'    => array(
		    array(
		        'key'       => 'select_page_to_show',
		        'value'     => $value,
		        'compare'   => 'LIKE',
		    )
		)*/
	);
	$the_queries = new Wp_query($args);
	if($the_queries->have_posts()){
		while($the_queries->have_posts()){ $the_queries->the_post(); ?>
			<div class="sidebar_title">
				<span class="title_icon tips_icon"></span>
				<h4><a href="<?php  the_permalink(); ?>"><?php echo get_the_title(); ?></h4></a>
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
		<?php 
		$args = array(
			"post_type"=>'tips',
			"post_status"=>'publish',
			//'orderby' => 'rand',
			'order' => 'DESC',
			"posts_per_page"=> 1,
			'meta_query'    => array(
			    array(
			        'key'       => 'select_page_to_show',
			        'value'     => $value,
			        'compare'   => 'LIKE',
			    )
			)
		);
		$the_queries = new Wp_query($args);
		if($the_queries->have_posts()){
			while($the_queries->have_posts()){ $the_queries->the_post(); ?>
				<h5><?php //echo get_the_title(); ?> MEMBER TIP</h5>
				<p><?php  $link = get_the_permalink(); 
					$content = get_the_content();
					echo $content;  ?>
				</p> <?php
			}
		}
		else{ ?>
			<h5>Tips not found</h5>
		<?php } 
		wp_reset_postdata();
	echo "</div>"; 
}


/*.....Reach Out for a Recommendation Reference.....*/

add_action('wp_ajax_reach_out_and_ask_for_reference','reach_out_and_ask_for_reference');
add_action('wp_ajax_nopriv_reach_out_and_ask_for_reference','reach_out_and_ask_for_reference');

function reach_out_and_ask_for_reference(){
	$current_user_id = get_current_user_id();
	$userdata = get_userdata($current_user_id);
	$user_fname = $userdata->first_name;
	$user_lname = $userdata->last_name;
	global $wpdb;
	if( isset($_POST) && !empty($_POST['Email']) ){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$Email = $_POST['Email'];
		$Company = $_POST['Company'];
		$Position = $_POST['Position'];
		$Telephone = $_POST['Telephone'];
		$Relationship = $_POST['Relationship'];
		$Years = $_POST['Years'];
		//$notation = $_POST['notation'];
		$sender_name = $user_fname.' '. $user_lname;	
		$nameArr = array();
		foreach ($Email as $key => $value) {
			$newArr = array(
				'fname' => $fname[$key], 
				'lname' => $lname[$key],
				'Email' => $Email[$key],
				'Company' => $Company[$key],
				'Position' => $Position[$key],
				'Telephone' => $Telephone[$key],
				'Relationship' => $Relationship[$key],
				'Years' => $Years[$key],
				//'notation' => $notation[$key],

			);
			$get_option_arr 	= get_option('reach_out_reference');
			$subject 			= $get_option_arr['reach_out_reference_subject'];
			$setting_options 	= get_option('xtreem_options_smtp');
			$to 				= $Email[$key];//$setting_options['tomail'];
			$shordcode_to_rep 	= array('[site-url]','[reference_first_name]','[reference_last_name]','[sender_name]');
			$replace_with 		= array(site_url(),$fname[$key],$lname[$key],$sender_name);
			$message 			= str_replace($shordcode_to_rep, $replace_with, $get_option_arr['reach_out_reference_template']);
			$headers            = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			wp_mail($to, $subject, $message, $headers);
			$wpdb->insert(
				$wpdb->prefix."reference_now", 
				array(
					"ref_detail"=> serialize($newArr),
					"user_id" => $current_user_id,
				),
				array('%s', '%d')
			);
			$nameArr[] = $fname[$key].' '.$lname[$key];
		}
		$nameList = implode(', 	', $nameArr);
        $wpdb->insert(
          $wpdb->prefix.'user_activity_log',
          array(
            'user_id'  => $current_user_id,
            'action'   => 'AddRefre',
            'datetime' => time(),
            'meta'     => 'Add new reference '.$nameList
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
	 	$tablename = $wpdb->prefix.'reference_now';
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

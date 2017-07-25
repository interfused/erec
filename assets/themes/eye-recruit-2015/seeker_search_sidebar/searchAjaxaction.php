<?php

add_action('wp_ajax_employee_seeker_filter_ajax', 'employee_seeker_filter_ajax');
add_action('wp_ajax_nopriv_employee_seeker_filter_ajax', 'employee_seeker_filter_ajax');

function employee_seeker_filter_ajax(){
	$WP_User_Query_Args = array();
	$alluserId = get_users( array('role' => 'candidate') ); 
	$alluserIdArr = array();
	foreach ($alluserId as $value) {
		$alluserIdArr[] = $value->ID;
	}

	if ( isset($_POST) ) {

		if ( isset($_POST['keyword_search']) && !empty($_POST['keyword_search']) ) {
			$keyword_search = $_POST['keyword_search'];
			$WP_User_Query_Args['search'] = '*'.esc_attr( $keyword_search ).'*';
		}


		if ( isset($_POST['BEST_INDUSTRY']) && !empty($_POST['BEST_INDUSTRY']) ) {
			$BEST_INDUSTRYArr = $_POST['BEST_INDUSTRY'];
			$B_Ind_Arr = array();
			foreach ($BEST_INDUSTRYArr as $values) {
				$BEST_INDUSTRY = get_cimyFieldValue(false, 'BEST_INDUSTRY', $values);
				foreach ($BEST_INDUSTRY as $value) {
					$B_Ind_Arr[] = $value['user_id'];
				}
			}
		}
		else{
			$B_Ind_Arr = $alluserIdArr;
		}

		
		if ( isset($_POST['SEEKER_ZIP_CODE']) && !empty($_POST['SEEKER_ZIP_CODE']) ) {
			$See_Zip_Code = $_POST['SEEKER_ZIP_CODE'];
			$SEEKER_ZIP_CODE = get_cimyFieldValue(false, 'SEEKER_ZIP_CODE', $See_Zip_Code);
			$See_Zip_Code_Arr = array();
			foreach ($SEEKER_ZIP_CODE as $value) {
				$See_Zip_Code_Arr[] = $value['user_id'];
			}
		}
		else{
			$See_Zip_Code_Arr = $alluserIdArr;
		}


		if ( isset($_POST['MAJOR_METROPOLITAN']) && !empty($_POST['MAJOR_METROPOLITAN']) ) {
			$M_Metro = $_POST['MAJOR_METROPOLITAN'];
			$MAJOR_METROPOLITAN = get_cimyFieldValue(false, 'MAJOR_METROPOLITAN', $M_Metro);
			$M_Metro_Arr = array();
			foreach ($MAJOR_METROPOLITAN as $value) {
				$M_Metro_Arr[] = $value['user_id'];
			}
		}
		else{
			$M_Metro_Arr = $alluserIdArr;
		}

		if ( isset($_POST['JOB_SEARCH_RADIUS']) && !empty($_POST['JOB_SEARCH_RADIUS']) ) {
			$J_S_R = $_POST['JOB_SEARCH_RADIUS'];
			$JOB_SEARCH_RADIUS = get_cimyFieldValue(false, 'JOB_SEARCH_RADIUS', $J_S_R);
			$J_S_R_Arr = array();
			foreach ($JOB_SEARCH_RADIUS as $value) {
				$J_S_R_Arr[] = $value['user_id'];
			}
		}
		else{
			$J_S_R_Arr = $alluserIdArr;
		}

		if ( isset($_POST['HIGHEST_EDUCATION']) && !empty($_POST['HIGHEST_EDUCATION']) ) {
			$H_Edu = $_POST['HIGHEST_EDUCATION'];
			$HIGHEST_EDUCATION = get_cimyFieldValue(false, 'HIGHEST_EDUCATION', $H_Edu);
			$H_Edu_Arr = array();
			foreach ($HIGHEST_EDUCATION as $value) {
				$H_Edu_Arr[] = $value['user_id'];
			}
		}
		else{
			$H_Edu_Arr = $alluserIdArr;
		}

		if ( isset($_POST['CURR_CAREER_LVL']) && !empty($_POST['CURR_CAREER_LVL']) ) {
			$Curr_Carr = $_POST['CURR_CAREER_LVL'];
			$CURR_CAREER_LVL = get_cimyFieldValue(false, 'CURR_CAREER_LVL', $Curr_Carr);
			$Curr_Carr_Arr = array();
			foreach ($CURR_CAREER_LVL as $value) {
				$Curr_Carr_Arr[] = $value['user_id'];
			}
		}
		else{
			$Curr_Carr_Arr = $alluserIdArr;
		}

		if ( isset($_POST['INDUSTRY_YEARS']) && !empty($_POST['INDUSTRY_YEARS']) ) {
			$Ind_Years = $_POST['INDUSTRY_YEARS'];
			$INDUSTRY_YEARS = get_cimyFieldValue(false, 'INDUSTRY_YEARS', $Ind_Years);
			$Ind_Years_Arr = array();
			foreach ($INDUSTRY_YEARS as $value) {
				$Ind_Years_Arr[] = $value['user_id'];
			}
		}
		else{
			$Ind_Years_Arr = $alluserIdArr;
		}

		if ( isset($_POST['TYPE_OF_OPPORTUNITY']) && !empty($_POST['TYPE_OF_OPPORTUNITY']) ) {
			$Type_Of_Opp = array();
			$Type_Of_Opp['like'] = true;
			$Type_Of_Opp['value'] = $_POST['TYPE_OF_OPPORTUNITY'];
			$TYPE_OF_OPPORTUNITY = get_cimyFieldValue(false, 'TYPE_OF_OPPORTUNITY', $Type_Of_Opp);
			$Type_Of_Opp_Arr = array();
			foreach ($TYPE_OF_OPPORTUNITY as $value) {
				$Type_Of_Opp_Arr[] = $value['user_id'];
			}
		}
		else{
			$Type_Of_Opp_Arr = $alluserIdArr;
		}

		if ( isset($_POST['COMPENSATION_DESIRED']) && !empty($_POST['COMPENSATION_DESIRED']) ) {
			$Com_Des_Acc = $_POST['COMPENSATION_DESIRED'];
			$COMPENSATION_DESIRED = get_cimyFieldValue(false, 'COMPENSATION_DESIRED', $Com_Des_Acc);
			$Com_Des_Acc_Arr = array();
			foreach ($COMPENSATION_DESIRED as $value) {
				$Com_Des_Acc_Arr[] = $value['user_id'];
			}
		}
		else{
			$Com_Des_Acc_Arr = $alluserIdArr;
		}

		if ( isset($_POST['US_ARMED_FORCES_OPTION']) && !empty($_POST['US_ARMED_FORCES_OPTION']) ) {
			$Us_Armed = $_POST['US_ARMED_FORCES_OPTION'];
			$US_ARMED_FORCES_OPTION = get_cimyFieldValue(false, 'US_ARMED_FORCES_OPTI', $Us_Armed);
			$Us_Armed_Arr = array();
			foreach ($US_ARMED_FORCES_OPTION as $value) {
				$Us_Armed_Arr[] = $value['user_id'];
			}
		}
		else{
			$Us_Armed_Arr = $alluserIdArr;
		}

		if ( isset($_POST['US_LAW_ENFORCE_STATU']) && !empty($_POST['US_LAW_ENFORCE_STATU']) ) {
			$Us_Law_Enf = $_POST['US_LAW_ENFORCE_STATU'];
			$US_LAW_ENFORCE_STATU = get_cimyFieldValue(false, 'US_LAW_ENFORCE_STATU', $Us_Law_Enf);
			$Us_Law_Enf_Arr = array();
			foreach ($US_LAW_ENFORCE_STATU as $value) {
				$Us_Law_Enf_Arr[] = $value['user_id'];
			}
		}
		else{
			$Us_Law_Enf_Arr = $alluserIdArr;
		}

		if ( isset($_POST['CLEARANCE_LEVEL']) && !empty($_POST['CLEARANCE_LEVEL']) ) {
			$Clear_Lev = $_POST['CLEARANCE_LEVEL'];
			$CLEARANCE_LEVEL = get_cimyFieldValue(false, 'CLEARANCE_LEVEL', $Clear_Lev);
			$Clear_Lev_Arr = array();
			foreach ($CLEARANCE_LEVEL as $value) {
				$Clear_Lev_Arr[] = $value['user_id'];
			}
		}
		else{
			$Clear_Lev_Arr = $alluserIdArr;
		}

		if ( isset($_POST['US_ELIGIBLE']) && !empty($_POST['US_ELIGIBLE']) ) {
			$Us_Eligi = $_POST['US_ELIGIBLE'];
			$US_ELIGIBLE = get_cimyFieldValue(false, 'US_ELIGIBLE', $Us_Eligi);
			$Us_Eligi_Arr = array();
			foreach ($US_ELIGIBLE as $value) {
				$Us_Eligi_Arr[] = $value['user_id'];
			}
		}
		else{
			$Us_Eligi_Arr = $alluserIdArr;
		}


		if ( isset($_POST['list_languages']) && !empty($_POST['list_languages']) ) {
			$list_lang = $_POST['list_languages'];
			$WP_User_Query_Args['meta_query'][] = array(
				'key' => 'list_languages_'.$list_lang,
				'value'    => $list_lang,
				'compare' => 'Like',
			);
		}

		if ( isset($_POST['metaval']) && !empty($_POST['metaval']) ) {
			$metaval = $_POST['metaval'];
			$metrocity = get_cimyFieldValue(false, 'MAJOR_METROPOLITAN', $metaval);
			$yopAreaArr = array();
			foreach ($metrocity as $value) {
				$yopAreaArr[] = $value['user_id'];
			}
		}
		else{
			$yopAreaArr = $alluserIdArr;
		}
	}

	$array_intersect = array_intersect($B_Ind_Arr, $See_Zip_Code_Arr, $M_Metro_Arr, $J_S_R_Arr, $H_Edu_Arr, $Curr_Carr_Arr, $Ind_Years_Arr, $Type_Of_Opp_Arr, $Com_Des_Acc_Arr, $Us_Armed_Arr, $Us_Law_Enf_Arr ,$Clear_Lev_Arr, $Us_Eligi_Arr, $yopAreaArr);
	if ( !empty($array_intersect) ) {
		$includeUserID = $array_intersect;
	}
	else{
		$includeUserID = array(0);
	}

	$profi_visi = get_cimyFieldValue(false, 'PROFILE_VISIBILITY');
	$excludeID = array();
	foreach ($profi_visi as $value) {
		$fieldvalue = cimy_uef_sanitize_content($value['VALUE']);
		if ( ($fieldvalue == 'Open') || ($fieldvalue == 'Private') ) {
			$excludeID[] = $value['user_id'];
			
		}
	}
	
	$includeUserID = array_diff($includeUserID, $excludeID);

	$WP_User_Query_Args['include'] = $includeUserID;
	$WP_User_Query_Args['role'] = 'candidate';
	$WP_User_Query_Args['fields'] = 'all';
	$WP_User_Query_Args['order'] = 'DESC';
	$user_query = new WP_User_Query( $WP_User_Query_Args);

	$authors = $user_query->get_results();
	$queryTotal = $user_query->get_total();
	echo '<div id="getjobseekerlist" class="job_listing" totaluser="'.$queryTotal.'">';
		if (!empty($authors)) {
			$totalUserCount = 0;
			$totalPageCount = 0;
			foreach ($authors as $author){
		    	$author_info = get_userdata($author->ID);
		    	$totalPer = job_seeker_profile_com_status($author->ID);
		    	$allwoPhoto = get_cimyFieldValue($author->ID, 'PNA_PHOTOGRAPH');
		    	if ( $totalUserCount % 10 == 0) { $totalPageCount++;  ?>
		    		<div class='page_stap view_page_stap<?php echo $totalPageCount ?>' <?php echo (($totalPageCount != 1)) ? 'style="display:none;"' : ''; ?> >
		    	<?php } ?>
		    	<div class="jobsearch_list">
					<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
					<div class="thumbnail">
						<?php
							if (  ($allwoPhoto != 'No') ) {
								echo do_shortcode('[ica_avatar uid="'.$author_info->ID.'"]');
							}else{
								?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
								<?php
							}
						?>
					</div>
					<div class="post_btns">
						<div class="postbtns_inner">
							<div class="c100 p<?php echo $totalPer; ?> small">
			                    <span><?php echo $totalPer; ?>%<small>Overall</small></span>
			                    <div class="slice">
			                        <div class="bar"></div>
			                        <div class="fill"></div>
			                    </div>
			                </div>
							<a class="btn btn-primary btn-sm" target="_blank" href="<?php echo site_url(); ?>/job-seekers/quick-view/?recruiterid=<?php echo $author_info->ID; ?>">See Quick View</a>				
							
							<?php
								$employer_id =  get_current_user_id();
								$userdata = get_userdata($employer_id);

								if( in_array('administrator', $userdata->roles) ){	
									$Reurl = '/employers/redacted-recruiter-quick-view/';
								}
								else{
									$Reurl = '/job-seekers/redacted-employer-quick-view/';
								}
							?>
							<a href="<?php echo site_url().$Reurl; ?>?recruitID=<?php echo $author_info->ID; ?>" class="btn btn-default btn-sm">View Full Profile</a>
							
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value=""><span>Compare</span>
							  </label>
							</div>
						</div>
					</div>
					<div class="searchresult_cont">
						<h3><a href="<?php echo site_url(); ?>/job-seekers/quick-view/?recruiterid=<?php echo $author_info->ID; ?>" target="_blank"><?php echo $author_info->first_name . ' ' . $author_info->last_name; ?></a></h3>
						<span>Recruiter ID. : <?php echo $author_info->ID;  ?></span>
						<hr class="clearfix" />
						<h3><a href="javascript:void(0);"><?php  echo get_cimyFieldValue($author_info->ID,'BEST_INDUSTRY'); ?></a></h3>
						<span><?php  echo get_cimyFieldValue($author_info->ID,'INDUSTRY_YEARS'); ?></span>
						<span><?php  echo get_cimyFieldValue($author_info->ID,'MAJOR_METROPOLITAN'); ?></span>
						<p class="text-right"><a href="javascript:void(0);" class="link">Delete</a><a href="javascript:void(0);" class="link">Remove</a><a href="javascript:void(0);" class="link">Block</a></p>
					</div>
					<div class="clearfix"></div>
				</div>   
			    <?php 
			    $totalUserCount++;
			    if ( $totalUserCount % 10 == 0) { echo "</div>"; }   
		    }  
		    echo "</div>";
		}
		else{
		    echo 'No candidate found';
		}
	echo "</div>";
	?>
	<div class="clearfix gap-md"></div>
	<?php if ( $queryTotal > 10  ) { ?>
		<div class="paginationDiv text-center">
			<?php
			$pageno = ceil($queryTotal/10);
			for ($i=1; $i<=$pageno; $i++) { ?>
				<a href="javascript:void(0);" data-step="<?php echo $i; ?>" class="view_this_step <?php echo (($i == 1)) ? 'active' : ''; ?>"><?php echo $i; ?></a>
			<?php } ?>
		</div>
	<?php } 
	die();
}


add_action('wp_ajax_ey_seeker_profile_comment', 'ey_seeker_profile_comment');
add_action('wp_ajax_nopriv_ey_seeker_profile_comment', 'ey_seeker_profile_comment');
function ey_seeker_profile_comment(){
 	if(isset($_POST)) {
		global $wpdb;
		$tablename = $wpdb->prefix."seeker_profile_comment";
		$hid= $_POST['hid'];
		$comments=$_POST['comment'];
		if (strpos($comments,'<script>') !== false) {
   			$comments=htmlspecialchars($comments);
		}

     	if($hid!='null'){
     		$update_comments=$wpdb->query($wpdb->prepare("UPDATE $tablename SET date='".$_POST['time']."',comment='".$comments."' WHERE id='$hid'"));
     		$user_comments= $wpdb->get_results ( "SELECT * FROM eyecuwp_seeker_profile_comment where id='$hid'" );
     		foreach($user_comments as $ucomments){       
				$newdate= date('h:ia l m/d/Y',$ucomments->date);						    	
				echo $ucomments->comment;
			} 
            die();
     	} else{
     		$data=array(
        		'user_id' => $_POST['user_id'], 
        		'comment' => $comments,
        		'date' => $_POST['time'],
        		'meta' => $_POST['recruitID'],
         	);

     		$wpdb->insert( $tablename, $data);
        	$user_comments= $wpdb->get_results ( "SELECT * FROM eyecuwp_seeker_profile_comment order by id DESC limit 1" );
      		foreach($user_comments as $ucomments){       
				$newdate= date('h:ia l m/d/Y',$ucomments->date);
				$userId=$ucomments->user_id; 		
				$currentId=get_current_user_id();
				$id=$ucomments->id;	
				 ?>
				<article class="<?php echo (($userId == $currentId))? 'current_user' : ''; ?>" >
				  	<div class='img-circle'><?php echo do_shortcode('[ica_avatar uid="'.$userId.'"]'); ?></div>
					<div class='comment_cont row'>
						<div class='col-md-9' id='c<?php echo $id; ?>'>
							<p><?php echo $ucomments->comment; ?></p>
							<?php if($userId==$currentId){ ?> 
								<button class='edit btn btn-default btn-sm' id='<?php echo $id; ?>'>Edit</button>
								<button class='delete btn btn-sm btn-primary' id='d<?php echo $id; ?>'>Delete</button>
							<?php } ?>
							<div class='clearfix'></div>
						</div>
						<div class="col-md-3 text-right"><span class="ecomm"><?php echo (($newdate)) ? $newdate : ''; ?></span></div>
					</div>
				</article> <?php
			} 
            die();
		}
 	}

}


add_action('wp_ajax_your_delete_action', 'delete_row');
add_action( 'wp_ajax_nopriv_your_delete_action', 'delete_row');
function delete_row() {

	global $wpdb;
    $id = $_POST['element_id'];
    
    $table = 'eyecuwp_seeker_profile_comment';
    $wpdb->delete( $table, array( 'id' => $id ) );



        echo 'Deleted comment';
        die;
    
}


add_action('wp_ajax_seeker_comment_page', 'seeker_comment_page');
add_action( 'wp_ajax_nopriv_seeker_comment_page', 'seeker_comment_page');
function seeker_comment_page(){
	if(isset($_POST)) {
		global $wpdb;
		$offset=$_POST['offset'];
		$user_comments= $wpdb->get_results ( "SELECT * FROM (SELECT * FROM eyecuwp_seeker_profile_comment order by id DESC LIMIT ".$offset.",10) sub ORDER BY id ASC" );
		if(count($user_comments)>0){
	    	foreach($user_comments as $ucomments) {       
				$newdate= date('h:ia l m/d/Y',$ucomments->date);
				$userId=$ucomments->user_id; 		
				$currentId=get_current_user_id();
				$id=$ucomments->id;					    	
				 ?>
				<article class="<?php echo (($userId == $currentId))? 'current_user' : ''; ?>">
					<div class='img-circle'><?php echo do_shortcode('[ica_avatar uid="'.$userId.'"]'); ?></div>
					<div class='comment_cont row'>
						<div class='col-md-9' id='c<?php echo $id; ?>'>
							<p><?php echo $ucomments->comment; ?></p>
							<?php if($userId==$currentId){ ?> 
								<button class='edit btn btn-default btn-sm' id='<?php echo $id; ?>'>Edit</button>
								<button class='delete btn btn-sm btn-primary' id='d<?php echo $id; ?>'>Delete</button>
							<?php } ?>
							<div class='clearfix'></div>
						</div>
						<div class='col-md-3 text-right'><span> <?php echo $newdate; ?> </span></div>
					</div>
				</article> <?php
			} 
			die();
		}else{
			echo 'Sorry! No data found.';
			die();
		}
	}
}

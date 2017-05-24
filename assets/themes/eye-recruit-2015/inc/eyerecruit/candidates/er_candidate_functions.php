<?php
///EYE RECRUIT CANDIDATE FUNCTIONS
////////
function showBackgroundCheckList($userID){
	 
	$fileCnt=0;
	
	$html='<ul>';
	for ($i=1;$i<=5;$i++){
		$attachmentID= get_user_meta($userID, 'fileID_bgck'.$i , true);
		if($attachmentID){
			$fileCnt++;
			$attachment = get_post( $attachmentID ); 
				   $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
					$attachment_title = $attachment->post_title;
					$caption = $attachment->post_excerpt;
					$description = $image->post_content;
					$attachmentURL = wp_get_attachment_url( $attachmentID );
			///
			$html .= '<li>';
			$html .= '<a href="'.$attachmentURL.'" target="fileTgtWindow">'.$attachment_title.'</a>';
			$html .='</li>';
		}//end if
	}//end loop
	$html .= '</ul>';
	
	if($fileCnt==0){
		return 'N/A';
	}else{
	return $html;
	}
}

//////////////
function showAchievementsFileList($userID){
	 
	$fileCnt=0;
	
	$html='<ul>';
	for ($i=1;$i<=5;$i++){
		$attachmentID= get_user_meta($userID, 'fileID_achievement'.$i , true);
		if($attachmentID){
			$fileCnt++;
			$attachment = get_post( $attachmentID ); 
				   $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
					$attachment_title = $attachment->post_title;
					$caption = $attachment->post_excerpt;
					$description = $image->post_content;
					$attachmentURL = wp_get_attachment_url( $attachmentID );
			///
			$html .= '<li>';
			$html .= '<a href="'.$attachmentURL.'" target="fileTgtWindow">'.$attachment_title.'</a>';
			$html .='</li>';
		}//end if
	}//end loop
	$html .= '</ul>';
	
	if($fileCnt==0){
		return 'N/A';
	}else{
	return $html;
	}
}

//////////////
function showCertificatesFileList($userID){
	 
	$fileCnt=0;
	
	$html='<ul>';
	for ($i=1;$i<=5;$i++){
		$attachmentID= get_user_meta($userID, 'fileID_certificate'.$i , true);
		if($attachmentID){
			$fileCnt++;
			$attachment = get_post( $attachmentID ); 
				   $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
					$attachment_title = $attachment->post_title;
					$caption = $attachment->post_excerpt;
					$description = $image->post_content;
					$attachmentURL = wp_get_attachment_url( $attachmentID );
			///
			$html .= '<li>';
			$html .= '<a href="'.$attachmentURL.'" target="fileTgtWindow">'.$attachment_title.'</a>';
			$html .='</li>';
		}//end if
	}//end loop
	$html .= '</ul>';
	
	if($fileCnt==0){
		return 'N/A';
	}else{
	return $html;
	}
}


////////////////
///////
function er_candidate_restricted_view_check(){
	$isRestricted=true;
	
	if(is_user_logged_in()){
		$isRestricted=false;
	}
	return $isRestricted;
}
/////ADD COLUMN TO admin USER LIST
/*function new_modify_user_table( $column ) {
    $column['candidateView'] = 'Candidate Profile';
//    $column['xyz'] = 'XYZ';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );*/

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    $user = get_userdata( $user_id );
    switch ($column_name) {
        case 'candidateView' :
		//check if candidate
	$str='';	
		if(in_array('candidate', $user->roles)){
		//	$str='<a href="/candidate-view/?uID='.$user_id.'" target="_candidateWindow">view</a>';
			$str='<form method="post" action="/candidate-view/" target="candidateWindow"><input name="uID" type="hidden" id="uID" value="'.$user_id.'"><button type="submit">View</button></form>';
			
		}
		
		
            return $str;
			//return '<a href="/candidate-view/?uID="'.$user_id.'>view</a>';
            break;
        case 'xyz' :
            return '';
            break;
        default:
    }
    return $return;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );

/*
SEND REDACTED VERSION TO ANONYMOUS USER FOR MARKETING PURPOSES
*/
////////////
function sendProfile($userID,$toName,$toEmailAddy){
	////
}

function getResumeIds($userID,$postStatus_arr=array( 'publish', 'expired', 'pending', 'hidden' )){
	//returns user's resume ids
	$tmpArr= array();
	$args=array(
	'post_type'           => 'resume',
	'post_status'         => $postStatus_arr,
			'author'     => $userID
	);

$er_resumes = new WP_Query($args);
while ( $er_resumes->have_posts() ) {
	$er_resumes->the_post();
	//echo '<li>' . get_the_title() . '</li>';
	array_push($tmpArr,get_the_ID());
}
wp_reset_postdata();
return $tmpArr;
	
}
/////////////////////////////
/*
GET AVERAGE SCORE FOR QUESTION TYPE by JOB SEEKER ID
*/

function getAvgStarRatingV2($qType,$userID){
	
	$qCnt=0;
	$score=0;
	
	$candidate = get_user_by( 'id', $userID );
//echo 'uid: '.$user->ID;
	for($i=1;$i<=50;$i++){
		
		$tmp=  $qType.'_Q'.$i;
		//echo "<br>".$tmp.": ";
		$value = get_cimyFieldValue($candidate->ID , $tmp );
		
		if($value){
			$qCnt++;
		}
		///none,basic,average,good,excellent,master
		if($value=='basic'){
			$score=$score+1;
		}
		if($value=='average'){
			$score=$score+2;
		}
		if($value=='good'){
			$score=$score+3;
		}
		if($value=='excellent'){
			$score=$score+4;
		}
		if($value=='master'){
			$score=$score+5;
		}
		
		//echo get_cimyFieldValue($user->ID, $tmp  );
  
	}
	$avg=$score/$qCnt;
	//echo '<br>qcnt: '.$qCnt;
	//echo '<br>score: '.$score;
	//echo '<br>avg score: '.$avg;
	//echo '<br>floor: '.floor($avg);
	echo '<div class="starRating text-center">';
	for($j=1;$j<=5;$j++){
		if(floor($avg > $j) ){
			$starClass='fa-star';
		}else{
			$starClass='fa-star-o';
		}
		echo '<i class="fa '.$starClass.' fa-2x"></i>';
		
	}
	echo '<div>SELF RATING: '. number_format((float)$avg, 2, '.', '') .'</div>';
	echo'</div>';
	
}
/////////////////////////////
function getHighestScoreQuestionsV2($qType,$userID){
	
	$candidate = get_user_by( 'id', $userID );
	
	$qCnt=0;
	$missedQCnt=0;
	$totQuestionToReturn=50;
	$sort_arr = array('master','excellent','good','average','basic');
	$master_arr=array();
	$excellent_arr=array();
	$good_arr=array();
	$average_arr=array();
	$basic_arr=array();
	
	$html='';
	
	    $values = get_cimyFieldValue($candidate->ID, false);

    foreach ($values as $value) {
		$pos=strrpos($value['NAME'], $qType );
		if ($pos === false) { // note: three equal signs
    		// not found...
			 $missedQCnt++;
			 if($missedQCnt >=5){
			 	
			 }
		}else{
			///build arrays
			
			$tmpVal = cimy_uef_sanitize_content($value['VALUE']);
			$insert_arr=array(id=>$value['NAME'],label=>$value['LABEL'],shortlabel=> getShortDesc($qType,$value['NAME'])  ,val=>$tmpVal);
			
			if($tmpVal == 'master'){
				array_push($master_arr, $insert_arr );
			}
			if($tmpVal == 'excellent'){
				array_push($excellent_arr,$insert_arr);
			}
			if($tmpVal == 'good'){
				array_push($good_arr,$insert_arr);
			}
			if($tmpVal == 'average'){
				array_push($average_arr,$insert_arr);
			}
			if($tmpVal == 'basic'){
				array_push($basic_arr,$insert_arr);
			}
			
			/* INGNORE BELOW 
			
			$html.='<div id="'.$value['NAME'].'">';
			    $html .= '<div id="q">'.$value['NAME'].'</div>';
	//$html .="<br>";
    $html .=$value['LABEL'];
    $html .="<br>";
	$html .=cimy_uef_sanitize_content($value['VALUE']);
	$html .= '</div>';
			$html .= '<hr>';
			*/
		}
		

	}
	
	$result_arr=array_merge($master_arr, $excellent_arr);
	if( count($result_arr< $totQuestionToReturn) ){
		$result_arr = array_merge($result_arr,$average_arr);
	}
	if( count($result_arr< $totQuestionToReturn ) ){
		$result_arr = array_merge($result_arr,$basic_arr);
	}
	
//	print_r($result_arr);
$html = '';
for($i=0;$i<count($result_arr);$i++){
	$html.='<div id="'. $result_arr[$i]['id'] .'" class="qContainer">';
	$html .= '<div class="row">';
	//$html .="<br>";
	$assessmentQuestionPostID=$result_arr[$i]['shortlabel'];
	
//    $html .= $assessmentQuestionPostID;
/*
GET THE DESCRIPTION FROM THE CUSTOM POST TYPE AND NOT CIMY
*/
	$html .= '<div class="question">';
	$html .=  get_post_meta( $assessmentQuestionPostID, 'wpcf-job-seeker-q-short-desc', true );
    $html .="</div>";
	
	
	///SHOW SUB STARS
	$selfAssessmentVal=$result_arr[$i]['val'];
	//$html .=$result_arr[$i]['val'];
	
	if($selfAssessmentVal=='master'){
		$starCnt=5;
	}
	if($selfAssessmentVal=='excellent'){
		$starCnt=4;
	}
	if($selfAssessmentVal=='good'){
		$starCnt=3;
	}
	if($selfAssessmentVal=='average'){
		$starCnt=2;
	}
	if($selfAssessmentVal=='basic'){
		$starCnt=1;
	}
	$html .= '<div class="starSelfAssessment '.$selfAssessmentVal.'">';
	for($k=1;$k<=$starCnt;$k++){
			$html .= '<i class="fa fa-star"></i>';
		}
	$html .= '</div>';
	
	
	$html .= '</div></div>';
			$html .= '<hr>';
			
			 
	
}

	return $html;
}
/////////////////////////////


?>
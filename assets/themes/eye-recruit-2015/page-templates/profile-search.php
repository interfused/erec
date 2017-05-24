<?php
/**
 * Template Name: Profile Search
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.5
 */
 
 //reference docs
//http://www.marcocimmino.net/cimy-wordpress-plugins/cimy-user-extra-fields/documentation/
//http://wordpress.stackexchange.com/questions/9775/how-to-edit-a-user-profile-on-the-front-end
/* Get user info. */

global $current_user, $wp_roles;
get_currentuserinfo();


//////////
get_header();
?>
<?php

include(get_stylesheet_directory() . '/inc/eyerecruit/employers/employee-scoring.php');
?>
<?php
function getUpdatedEmployerQuestions($qType){
	/*
	global $sectionQuestions_work_act,$sectionQuestions_tech,$sectionQuestions_tasks,$sectionQuestions_know,$sectionQuestions_skills, $sectionQuestions_ability;
	*/
	$sectionQuestions_work_act   = 44;
	$sectionQuestions_tech       = 47;
	$sectionQuestions_tasks      = 32; 
	$sectionQuestions_know       = 14; 
	$sectionQuestions_skills     = 17; 
	$sectionQuestions_ability    = 18; 
///////////
	if ($qType == 'TASKS'){
		$qCnt		= $sectionQuestions_tasks;
		$slugStart	='tasks_q';
	}
	if ($qType == 'TECH'){
		$qCnt		= $sectionQuestions_tech;
		$slugStart	='tech_q';
	}
	if ($qType == 'KNOW'){
		$qCnt		= $sectionQuestions_know;
		$slugStart	='know_q';
	}
	if ($qType == 'SKILLS'){
		$qCnt		= $sectionQuestions_skills;
		$slugStart	='skills_q';
	}
	if ($qType == 'ABILITY'){
		$qCnt		= $sectionQuestions_ability;
		$slugStart	='ability_q';
	}
	if ($qType == 'WORK_ACT'){
		$qCnt		=  $sectionQuestions_work_act;
		$slugStart	='work_act_q';
	}
	
		for($i=1;$i< $qCnt;$i++){
		///get post by slug
		$the_slug = $slugStart.$i;
	$args = array(
	  'name'        => $the_slug,
	  'post_type'   => 'assessment-question',
	  'post_status' => 'publish',
	  'numberposts' => 1
	);
	$my_posts = get_posts($args);
	if( $my_posts ) :
	$questionPostID		= $my_posts[0]->ID;
	 $my_meta 			= get_post_meta( $questionPostID); 
	  //print_r($my_meta);
	 //echo '<hr>'; 
	 $skipQuestionVal	= $my_meta['wpcf-ignore-employer-front'][0];
	
	if(!$skipQuestionVal){
	//	echo 'DO NOT skip this question';
		echo '<div id="'.$the_slug.'">';
	  //GET QUESTION
	  
	  $employerQuestionTxt = $my_meta['wpcf-employer-to-seeker-question'][0];
	  if(!$employerQuestionTxt){
		  $employerQuestionTxt 	= $the_slug. ' NEEDS TO BE PUT IN BACKSIDE';
	  }
	  
	  //$the_slug
	  setupQuestion($employerQuestionTxt,'select_yn',strtoupper($the_slug) );
	  
	  //echo get_post_meta( $questionPostID,'wpcf-employer-to-seeker-question',true);
	  echo '</div>';
	} 


	
	  
	 // echo '<div id="'.$the_slug.'">'. $my_meta[0]['job-seeker-assessment-question'] . '</div>' ;
	endif;
		//get proper question(s)
	}
}
//////////////
function get_meta_vals_arr_updated($postTypeTmp,$tmpMetaKey,$tmpVals_arr,$sortOrder){
		///POSTTYPETMP SHOULD DEFAULT TO 'resume'
		////THIS SHOULD RETURN ALL META VALUES FOR ALL USERS BASED OFF OF EMPLOYER CRITERIA and should be sorted.
	$ret_arr = array();
		
	$args = array (
	'post_type' => $postTypeTmp,
	'meta_key' => $tmpMetaKey,
	 'meta_query' => array (
		    array (
			  'key' => $tmpMetaKey,
			  'value' => $tmpVals_arr,
                          'compare' => 'IN'
		    )
		  )
	);
	// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	//echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		//$html .= get_the_title() ;
	
		$post_id=get_the_ID();
	//	$html .= '<br>Post ID: '.$post_id;
	/////GET USER ID
		$author_id=$post->post_author;
		$post = get_post( $post_id );
		//$html .='<br>uID: '.get_the_author_meta('ID',get_the_ID());
	//	$html .= '<br>uID: '.$post->post_author;
		///GET AMOUNT LOWEST TAKEN
			$valTmp = get_post_meta($post_id,$tmpMetaKey,true);	
		array_push($ret_arr,array('uID'=>$post->post_author,'val'=>$valTmp  ) );
		}
	} 
	wp_reset_postdata();
	return $ret_arr;		
}

/////////
function getMetaForArray($tmpMetaKey,$tmp_arr){
	// WP_Query arguments
$args = array (
	'post_type' => 'resume',
	'meta_key' => $tmpMetaKey,
	 'meta_query' => array (
		    array (
			  'key' => $tmpMetaKey,
			  'value' => $tmp_arr,
                          'compare' => 'IN'
		    )
		  )
);

// The Query
$the_query = new WP_Query( $args );
$html = '';
// The Loop
if ( $the_query->have_posts() ) {
	//echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		//$html .= get_the_title() ;
		$post_id=get_the_ID();
	//	$html .= '<br>Post ID: '.$post_id;
	/////GET USER ID
		$author_id=$post->post_author;
		$post = get_post( $post_id );
		//$html .='<br>uID: '.get_the_author_meta('ID',get_the_ID());
		$html .= '<br>uID: '.$post->post_author;
		///GET AMOUNT LOWEST TAKEN
		
		
		for($i=0;$i<count($tmp_arr);$i++){
			$lowestAmtUserRequested = get_post_meta($post_id,$tmpMetaKey,true);
			if($tmp_arr[$i] == $lowestAmtUserRequested){
				
				break;
			}
		}
		$html .= '<br>lowest asked: '.$lowestAmtUserRequested;
		$html .= '<hr>';
	}
//	echo '</ul>';
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

return $html;

}

function getSectionScorePctforUser($emp_arr,$user_arr,$uID){
	///THIS FUNCTION GRABS THE SCORE FROM INDIVIDUAL SECTIONS AS A PCT
	$userfound=false;
	$idx=0;
	
	for($i=0;$i<count($user_arr);$i++){
	if($user_arr[$i]['user_id']==$uID){
		$userfound    = true;
		$idx          = $i;
		break;
	}
	}
	
	if($userfound){
		$score=$user_arr[$idx]['score'] / count($emp_arr);
		$score = floor($score*100) .' %' ;
		return $score;
	}
	///ELSE
	return 0;
	
	
}

function getYN_OptionVal($str){
		$possibilities_arr= array("basic","average","good","excellent","master");
	///convert string to index to use for calculations
	$val = 1+array_search($str, $possibilities_arr);
	return $val;
}
/////////////SCORING
function get_scoring_YN($empNeed,$seekerAssessment){
	
	//$str='Employer need score: ' . $empNeed;
	//$str .= '<p>Seeker self assessment score: '. $seekerAssessment.'</p>';
	///tmp
	//return $str;
	
	///continue
	$score=0;
	$maxScore = 1.2;
	//$yn_possibilities = 5;
	///variance was calculated as follows $maxScore / ($yn_possibilities - 1)   
	$variance = .05;
	
	/*
	Base perfect match as 1 point
Each variance is a fraction (.2)
So we would have to calculate the difference based off of employer submission?
*/
	if($empNeed == $seekerAssessment){
		return 1;
	}
	$absDiff = abs($empNeed - $seekerAssessment);
	if($seekerAssessment > $empNeed ){
		$score = 1 + ($absDiff * $variance);
		return $score;
	}else{
		$score = 1 - ($absDiff * $variance);
		return $score;
	}
	
	////something went wrong;
	return 0;

}
////////////////
///////////
function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}

///////////////
function increaseScore($uID){
	global $userSearchResults_arr;
		$tmpArr = search($userSearchResults_arr, 'user_id', $uID);
		$seekerType = get_cimyFieldValue($uID, 'JOB_SEEKER_TYPE'); 
		$new_arr = array( 
		   "user_id" => $uID, 
		   "score" => 1,
		   "seekerType" => $seekerType);
		   
		if(count($tmpArr)>0){
			//echo 'found';
			for($i=0;$i<count($userSearchResults_arr);$i++){
				if($userSearchResults_arr[$i]['user_id'] == $uID  ){
				//echo '<h3>score: '. print_r($userSearchResults_arr[$i]) .'</h3>';
				//echo '<h3>score: '. $userSearchResults_arr[$i]['score'] .'</h3>';
				$userSearchResults_arr[$i]['score'] += 1;
				break;
				}
			}
		}else{
			//echo 'not found';
			array_push($userSearchResults_arr,$new_arr);
		}
	}

	/////////////////
	function getCriteriaArray($fieldname){
		$values = get_cimyFieldValue(false, $fieldname, $_POST[$fieldname]);
			$tmp_arr = array();
			foreach ($values as $value) {
			//print_r($value);
			$tmp_arr[] = $value['user_id'];
			increaseScore($value['user_id']);
			}
		sort($tmp_arr);	
		return $tmp_arr;
	}
///////////////
function increaseScoreNEW($uID,$arr,$qType,$score){
	////THIS FN searches array for user_id and add score
	
	//DEFAULTS
		$seekerType = get_cimyFieldValue($uID, 'JOB_SEEKER_TYPE'); 
		$new_arr = array( 
		   "user_id" => $uID, 
		   "score" => $score,
		   "seekerType" => $seekerType);
		/*
		   ///IF SEEKER TYPE IS NOT SET, DO NOT PROCESS ANY FURTHER
		
		   if(!$seekerType){
//			   echo 'seeker not set';
			   return $arr;
		   }
	*/	   
	///SEARCH ARRAY for user_id
	$tmpArr = search($arr, 'user_id', $uID);
	if(count($tmpArr)>0){
			//echo 'found';
			for($i=0;$i<count($arr);$i++){
				if($arr[$i]['user_id'] == $uID  ){
				$arr[$i]['score'] += $score;
				break;
				}
			}
		}else{
			//echo 'not found';
			array_push($arr,$new_arr);
		}
		   
		   ////return new array
		   return $arr;
}

/////////////	


///////////END SCORING
function getLabelOptions($cimyFieldName,$multiple=false){
	/*
	THIS FUNCTION IS USED TO SETUP QUESTIONS DISPLAY
	*/
	/*    $values = get_cimyFieldValue(false, $id);

    foreach ($values as $value) {
    //$user_id = $value['user_id'];
    //echo $value['user_login'];
    //echo cimy_uef_sanitize_content($value['VALUE']);
    print_r($value);
	}
	*/
	global $wpdb;
	$results = $wpdb->get_results( 'SELECT * FROM eyecuwp_cimy_uef_fields WHERE `name` = "'.$cimyFieldName .'"', OBJECT );
	if(!$results){
		return;
	}
	//print_r($results);
$fullStr=$results[0]->LABEL;
$labels = substr($fullStr, strpos($fullStr, "/") + 1);    
//echo '<h3>'.$labels.'</h3>';
$labels_arr = explode(',' , $labels);

if($multiple==true){
	echo '<select name="'.$cimyFieldName.'[]" multiple="multiple" size="5" id="'.$cimyFieldName.'" style="height: 11em;"  >';
}else{
	echo '<select name="'.$cimyFieldName.'" id="'.$cimyFieldName.'">';
}


//echo '<option value="">Select</option>';
for ($i=0;$i<count($labels_arr);$i++){
	$val = $labels_arr[$i];
	echo '<option value="'.$val.'">'.$val.'</option>';
}
echo  '</select>';

if($multiple==true){
	echo '<span class="description">To select multiple (Apple Hold Command ) / (PC hold ALT) while clicking</span>';
}

	//return $results;
/*	foreach ( $results as $result ) 
	{
	echo $result->post_title;
	}
*/

}



function setupQuestion($question,$questionType,$cimyFieldID){
	echo '<div class="row paddedBottom">';
	echo '<div class="col-md-8">'.$question.'</div>';
	echo '<div class="col-md-4">';
	
	
	
	
	switch($questionType){
		case "select":
		getLabelOptions($cimyFieldID);
		break;
		
		case "select_multiple":
		getLabelOptions($cimyFieldID,true);
		break;
		
		case "select_yn":
		$html = '<select name="'.$cimyFieldID.'" id="'.$cimyFieldID.'"><option value="">Select</option><option value="1">basic</option><option value="2">average</option><option value="3">good</option><option value="4">excellent</option><option value="5">master</option></select>';
		echo $html;
		break;
		
		default:
		echo 'OPTION ';
		break;
	}
	
	echo '</div></div>';
	
	$ID=$cimyField['ID'];
	
}

function setupDisplayField($field){
	$ID=$field['ID'];
	
	$html='';
		
$html .= '<div id="'.$ID.'">';
$html .= '</div>';
	
	}

function setupDisplayFieldBACKUP($field){
	//$field is an associative array
	
	$ID=$field['ID'];
	
	$html='';
		
$html .= '<div id="'.$ID.'">';
	
	switch($field['TYPE']){
		case 'dropdown':
		
		$optionVals=explode(",", $field['VALUE']);
		$optionLabels=explode(",", $field['LABEL']);
		//fix first label	
		$fieldLabel= strstr($optionLabels[0], '/', true); // As of PHP 5.3.0
		
		$newOptionLabel = substr(strrchr($optionLabels[0], "/"), 1);
		$optionLabels[0]=$newOptionLabel;
		
		$html .= '<label>'.$fieldLabel.'</label>';
			$html .= '<select name="'.$field['NAME'].'"  >';
	for($i=0;$i<count($optionVals);$i++){
	  //<option value="value 1">label 1</option>
		$html .= '<option value="'.$optionVals[$i].'">'.$optionLabels[$i].'</option>';
	}  
$html .='</select>';
		break;
		
		case 'dropdown-multi':
		
		$optionVals=explode(",", $field['VALUE']);
		$optionLabels=explode(",", $field['LABEL']);
		//fix first label	
		$fieldLabel= strstr($optionLabels[0], '/', true); // As of PHP 5.3.0
		
		$newOptionLabel = substr(strrchr($optionLabels[0], "/"), 1);
		$optionLabels[0]=$newOptionLabel;
		
		$html .= '<label>'.$fieldLabel.'</label>';
			$html .= '<select name="'.$field['NAME'].'" size="3" multiple="multiple" >';
	for($i=0;$i<count($optionVals);$i++){
	  //<option value="value 1">label 1</option>
		$html .= '<option value="'.$optionVals[$i].'">'.$optionLabels[$i].'</option>';
	}  
$html .='</select>';
		break;
		
		case 'textarea':
			$html .= '<label for="'.$field['NAME'].'">'.$field['LABEL'].'</label>';
			$html .= '<textarea name="'.$field['NAME'].'" ></textarea>';
		break;
		
		case 'text':
		//<input name="" type="text" />
			$html .= '<label for="'.$field['NAME'].'">'.$field['LABEL'].'</label>';
			$html .= '<input name="'.$field['NAME'].'" type="text" />';
		break;
	}//END SWITCH	

if($field['DESCRIPTION']){
	$html .= '<small>'.$field['DESCRIPTION'].'</small>';
}

$html .= '</div>';	
	

	
	return $html;
	}
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
    
            <?php the_content(); ?>
            <?php if ( !is_user_logged_in() ) : ?>
                    <p class="warning">
                        <?php _e('You must be logged in to search profiles.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>
       
  
            <div class="loadingImg text-center"><img src="http://eyerecruit.com/assets/uploads/2015/03/ajax-loader.gif"></div>
            <?php
			$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);
echo '<strong>Current User Role</strong>: ' . $user_role;
			?>
                <?php // if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
                
                
                <?php
				$allFields = get_cimyFields();
?>				
<form id="candidateSearch" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>" method="post">
<?php

////NON-SCORED

?>
 


<h2>Basic Section</h2>

<?php
/////SETUP BASIC QUESTIONS HERE

//setupQuestion('If you are looking for a specific gender, select here?','select','GENDER');
setupQuestion('Do you require candidates to be a citizen of the United States?','select','US_ELIGIBLE');

//setupQuestion('Would you consider someone with a felony charge?','select','FELONY_STATUS');
//setupQuestion('Would you consider someone with a misdemeanor charge?','select','MISDEMEANOR_YN');


setupQuestion('Job Seekers come to us in every conceivable way, with every conceivable level of experience and an amazing array of hopes, memories, aspirations and employment status.  Sadly, many candidates feel that they are underemployed, under paid and under valued in their current role. This means while they are currently employed, they have indicated in their profile that they are willing to consider all options that their experience would be beneficial to another employer or opportunity. 

For the process to work most efficiently and effectively, and for our Recruiting Staff to focus where it would best suit you as an employer, we need to know if you would consider Job Seekers that are passively or just actively looking for a job or career change.
','select','JOB_SEARCH_AGRESS');

setupQuestion('Please select the number range that best reflects your desired years of industry experience.','select','INDUSTRY_YEARS');

setupQuestion('Please select the type of employee that you are interested in:','select_multiple','DES_WORK_TYPE');

/*
setupQuestion('Please select the industry that best reflects your needed experience.','select_custom','Investigations,Security,Surveillance,Risk Management,Information Technology,Investigative Journalist');
setupQuestion('Please enter the zipcode(s) where this opening is located.','text','WORK_ZIP');
setupQuestion('What is the ideal working radius for this current position?','select_custom','5 - 20 Miles,21 – 50 Miles,51 – 100 Miles,Anywhere');
setupQuestion('Please indicate what areas of experience you desire for your current search. The list we have compiled might seem repetitive in some areas. This is due to the job terms used by Job Seekers and Employers in their respective regions.  Please indicate all that apply or may apply to your current search.','select_custom','Accident Reconstruction,Adultery,Alarm Systems,Alimony Reduction,Arson,Asset Search,Auto Theft,Background Checks,Bail Enforcement,Bail Fugitive Recovery,Bounty Hunter,Bug Sweep,Business Investigators,Cheating Spouses,Child Custody,Child Recovery,Child Support,Child Visitation,Civil Investigations,Competitive Intelligence,Computer Forensics,Computer Crime,Counterfeit Goods,Corporate Espionage,Corporate Investigations,Covert Surveillance,Crime Scene Investigations,Criminal Defense Investigations,Criminal Investigations,CSI (Crime Scene Investigations),Cyber Investigations,Death Investigations,Divorce,Domestic,Due Diligence,Employee Research,Employee Theft,Elder Abuse Investigations,Elder Care Confirmation,Electronic Data Discovery,Electronic Surveillance,Executive Protection,Financial Investigations,Fire Investigations,Forensic Investigations,Fraud Investigations,General Investigations,Homicide Investigations,Identity Theft Investigations,Infidelity,Insurance Investigations,Internal Theft,International Background Checks,International Investigations,Internet Profiling,Integrity Checks,Intelligence Gathering,Judgment Recovery,Marine Investigators,Missing Children,Missing Persons,Mystery Shopper Background Checks,Photo Surveillance,PI Transcription Services,Polygraph Administer,Pre-Employment Background Searches,Premarital,Process Server,Public Record Searches,Repossession,Security Guards,Security Services,Skip Tracing,Spousal & Matrimonial Research,Surveillance,Theft,Trial Preparation,Undercover Investigators,Video Surveillance,Workers Compensation Wrongful Death');
*/
//setupQuestion('Depending on the qualifications you are seeking, Job Seekers are asked specifically if they are willing to relocate for the right Career opportunities. If we find a Candidate that we believe to be an outstanding applicant who matches what you are looking for during this Job Search, would your company be willing to relocate the Candidate?','select','RELOCATION_ABILITY');

setupQuestion('Please indicate which range most accurately reflects your target annual compensation for this positional posting, including all forms of compensation (base salary, bonus, etc.). ','select','COMPENSATION_CURRENT');
setupQuestion('Does the candidate you are seeking need to be currently licensed for the position?','select','FIELD_LICENSE_STATUS');
setupQuestion('Please indicate which State(s) you currently opening requires the Job Seekers to have an active license.','select_multiple','FIELD_LICENSE_STATE');
setupQuestion('Does the position require the Job Candidate to have reliable transportation for local travel?','select','RELIABLE_TRANSPORT');

/*
setupQuestion('Which of your personal characteristics do you think would be needed to be a success for the next applicant?','textarea','PERSONAL_CHARACTERISTICS');
setupQuestion('Describe how the current job opening relates to the overall goals of your organization and what impact it has on the company\'s bottom line profit and loss?','textarea','IMPACT_ON_BOTTOMLINE');
setupQuestion('What are the most important decisions that will this candidate will be handling on this job?','textarea','MOST_IMPT_DECISIONS');
setupQuestion('In what ways can this applicant show you after beginning employment that they are ready to take on greater responsibility?','textarea','HOW_TO_SHOW_GREATER_RESPONSIBILITY');
setupQuestion('What do you feel makes a candidate’s diverse talents and pervasive skills important to this position?','textarea','CANDIDATE_SKILLS_IMPT_TO_JOB');
setupQuestion('If you were to make a job offer and hire a Job Seeker, what do you think would be the first things on their "to do" list on day one?','textarea','TO_DO_DAY_1');
setupQuestion('How long do you think it should take once the candidate is hired to make a meaningful contribution to the organization?','textarea','MEANINGFUL_CONTRIBUTION_LENGTH_START');
setupQuestion('How do you feel about paying a little more or a little less for an excellent candidate if they were overqualified/under qualified/too experienced for this position?','textarea','JOB_PAY_FLEXIBILITY');
*/
setupQuestion('In many positions offered within our industry, language proficiency is a very important factor on getting the job done correctly. Many times there is no chance for a second chance, especially with witness interviews and gathering key information. Below is our list of the most common languages spoke within our profession. Please select the ones that best suit your current SPOKEN need.','select_multiple','LANGUAGES_SPOKEN');

setupQuestion('Please select the ones that best suit your current WRITTEN need.','select_multiple','LANGUAGES_WRITTEN');

setupQuestion('Many Retired Veterans from the United States Armed Forces that are current Job Seekers. Besides incentives that may be offered, there is a strong commitment to excellence from this community. Would you like to consider narrow your search to include members of the United States Armed Forces? This will not exclude viable local experienced candidates, simply assist our algorithms bring this sector to the forefront for your consideration. ','select_multiple','US_ARMED_FORCES');
setupQuestion('Many Retired professionals from the Governmental sector have extensive backgrounds, experience, technological advantages and contacts within the community, which might serve your current need.   This sector is very specific and one branch or sector might have significant qualifications that might specifically impact your business now and in the future. 
Would you like to consider narrowing your search to include Military or Federal Law Enforcement Investigative or Security sectors by department? This will not exclude candidates that do not have this designation, but will simply assist our algorithms to highlight those Job Seekers that have experience in this sector for your consideration. (Click all that apply.)','select_multiple','US_LAW_ENFORCE_STATU');



?>

<hr>
<h2>Tasks Section</h2>
<p>The next sections will have to do with job related specifics experience the Job Seeker. Not all the categories will be something that you currently need for your current candidate for the available position.  </p>
<p>The first section has to do with the experience you are seeking from, and in a Job Seeker that has to do specifically with job related TASKS. </p>
<hr>

<?php 
/****************************
TASKS SECTION 
*****************/
getUpdatedEmployerQuestions('TASKS');

/*
setupQuestion('Does the position require the Candidate to possess experience with linking or charting suspects to criminal organizations or events to determine activities and interrelationships?','select_yn','TASKS_Q7');
*/


?>

<h2>Tech Section</h2>
<p>The next section has to do with your experience in and with job related TECHNOLOGY.</p>
<?php
/****************************
TECH SECTION 
*****************/
getUpdatedEmployerQuestions('TECH');

?>

<h2>Knowledge Section</h2>
<p>The next section has to do with your experience in and with job related KNOWLEDGE.</p>
<?php
/****************************
KNOWLEDGE SECTION 
*****************/

getUpdatedEmployerQuestions('KNOW');
 
?>
<hr>
<h2>Skills Section</h2>
<p>The next section has to do with your experience in and with job related SKILLS.</p>
<hr>
<?php
/****************************
SKILLS SECTION 
*****************/

getUpdatedEmployerQuestions('SKILLS');

 

?>
<hr>
<h2>Abilities Section</h2>
<p>The next section has to do with your experience in and with job related ABILITIES.</p>
<hr>
<?php
/****************************
ABILITIES SECTION 
*****************/
getUpdatedEmployerQuestions('ABILITY');
 
?>
<hr>
<h2>Work Activities Section</h2>
<p>The next section has to do with your experience in and with job related WORK ACTIVITIES.</p>
<hr>
<?php
/****************************
WORK ACTIVITIES SECTION 
*****************/
getUpdatedEmployerQuestions('WORK_ACT');
 

?>




<?php
/* 
echo '<h2>Other Section</h2>';
if (count($allFields) > 0) {
foreach ($allFields as $field) {
echo "<p>";
	$debugMode=true;
	
	if($debugMode){
		echo "ID: ".$field['ID']." \n";
	
	echo "F_ORDER: ".$field['F_ORDER']." \n";
	echo "NAME: ".cimy_uef_sanitize_content($field['NAME'])." \n";
	echo "TYPE: ".cimy_uef_sanitize_content($field['TYPE'])." \n";
	echo "VALUE: ".cimy_uef_sanitize_content($field['VALUE'])." \n";
	echo "LABEL: ".cimy_uef_sanitize_content($field['LABEL'])." \n";
	echo "DESCRIPTION: ".cimy_uef_sanitize_content($field['DESCRIPTION'])." \n";
	echo "</p>";
	echo "<p>RULES:</p> ";
	print_r($field['RULES']);
	echo '<br>';
	echo "<p>FINAL DISPLAY:</p> ";
	}
	echo setupDisplayField($field);
	//echo "<hr>";
}
}
////END DEBUG 
*/

 
echo '<input type="hidden" name="searchCandidates" value="1" />';
echo '<p class="paddedTop-2x"><button class="button" type="submit">SEARCH CANDIDATES</button></p>';

				?>
</form>                
            <?php endif; ?>
        </div><!-- .entry-content -->
        <?php do_action( 'jobify_loop_after' ); ?>
    </div><!-- .hentry .post -->
     
    <?php endwhile; ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>

<div class="container">
<?php
///////SEARCH RESULTS
if($_POST['searchCandidates']){
	/*
	PROBABLY SHOULD DO A SEARCH OF EVERYBODY 
	DO A REMOVAL OF RESULTS IF TOO NARROW
	
	*/
	?>

    <script>
	jQuery("#candidateSearch").hide();
	</script>
    <h2>EMPLOYER SEARCH CRITERIA POST ARRAY:</h2>
	<?php
	//print_r($_POST);
	?>
    <hr />
    <div id="basicResults" style="background-color:#ddd; padding:20px;">
    <h2>Basic Results</h2>
    <?php
	///WE BUILD THE BASIC EMPLOYER SEARCH CRITERIA
	 $empBasicCriteria_arr=array();
	 
	$basicScores_arr = array();

	
function getScoreFromOptions($options_arr,$empCriteria,$seekerAssessment, $direction){
	///USED FOR THE BASIC SECTION, this function takes an array of possible values and determines the score according to employer criteria and seeker assessment
	
	
	
	//return $search_arr;
	
	
	
	///we take the employer criteria and find the index in the options array
	$empIdx = array_search($empCriteria, $options_arr); // $key = 2;
	
	//we then take the seeker assessment and find the index in the options array
	$seekerIdx = array_search($seekerAssessment, $options_arr); // $key = 2;
	
	$score=0;
	$maxScore = 1.2;
	$variance = .2/count($options_arr);
	
	if($empCriteria==$seekerAssessment){
		return 1;
	}
	//we calculate the difference according to direction
	///direction determins positive/negative scoring
	$absDiff = abs($empIdx - $seekerIdx);
	
	
	if( ($seekerIdx  > $empIdx) ){
		if($direction=='ASC'){
			$score = 1 + ($absDiff * $variance);
		}else{
			$score = 1 - ($absDiff * $variance);
		}
		return $score;
	}else{
		if($direction=='ASC'){
			$score = 1 - ($absDiff * $variance);
		}else{
			$score = 1 + ($absDiff * $variance);
		}
		
		return $score;
	}
	
	////something went wrong;
	return 0;
}
	 
	 
	?>
   
    <?php 
// <p><strong>Salary</strong></p>
array_push($empBasicCriteria_arr,array('qID' => 'COMPENSATION_CURRENT', 'required_val' =>  $_POST['COMPENSATION_CURRENT'] ));

	////SEEKER DESIRED PAY (taken from option label values)
	$pay_arr=array("30-40k","40-50k","50-60k","60-70k","70-80k","80-90k","90-100k","100k+");
	
	///EMPLOYEE DESIRED COMPENSATION (taken from option labbel values)
	switch($_POST['COMPENSATION_CURRENT']){
		case '$40k - $50k':
			$maxIdx=1;
		break;
		case '$50k - $60k':
			$maxIdx=2;
		break;
		case '$60k - $70k':
			$maxIdx=3;
		break;
		case '$70k - $80k':
			$maxIdx=4;
		break;
		case '$80k - $90k':
			$maxIdx=5;
		break;
		case '$90k - $100k':
			$maxIdx=6;
		break;
		case '$100k – $125k':
		case '$125k – $150k':
		case '$150k - $250k':
		case '$250k - $500k':
		case 'Over $500k':
			$maxIdx=7;
		break;
		default:
			$maxIdx=0;
		break;
	}

 
	//$a2=array();
	array_splice($pay_arr,$maxIdx+1); 
	
		//$tmpQ=getMetaForArray('_desired_pay_salary', $pay_arr  );
		//UPDATED
		$tmpQ=get_meta_vals_arr_updated('resume','_desired_pay_salary',$pay_arr,'ASC');
	//	$tmpQ=get_meta_vals_arr_updated('resume','COMPENSATION_CURRENT',$pay_arr,'ASC');
		//print_r( $tmpQ);
		
	
	?>
    
    
    <?php 
	////NOTE EXACT MATCH IF NO SHOULD ADD/EXCLUDE THIS USER ID FROM ANY RESULTS: todo
		function score_either($vals_arr,$empReq,$userinput,$exactmatch=false){
			if( ($empReq==$userinput) ){
				return 1;
			}
			if( ( ($empReq!=$userinput) && $exactmatch == false) ){
				return .5;
			}
				return 0;
			
		}
		

		
		//score_either($vals_arr,$userinput,$exactmatch);
		//$score_gender=score_either($vals_arr,$_POST['GENDER'],'male',true);
		//echo $score_gender;
		/*
	$values = get_cimyFieldValue(false, 'GENDER', $_POST['GENDER'] );

    foreach ($values as $value) {
	    $user_id = $value['user_id'];
    	//echo $value['user_login'];
		$basicScores_arr = increaseScoreNEW($value['user_id'],$basicScores_arr,'basic_yn', 1 );
    }
	array_push($empBasicCriteria_arr,array('qID' => 'GENDER', 'required_val' =>  $_POST['GENDER'] ));
	*/
	?>
    
    <?php 
	//<p><strong>Grouped Simple Single Value Answers</strong></p>
		$simplevals_arr = array('GENDER','US_ELIGIBLE','FELONY_STATUS','MISDEMEANOR_YN','FIELD_LICENSE_STATUS','RELIABLE_TRANSPORT','JOB_SEARCH_AGRESS');
		////LOOP THROUGH SIMPLE VALUES WHERE THE ANSWER DOES NOT NEED A SCALE SCORE AND INCREMENT IF NECCESSARY
		for($i=0;$i<count($simplevals_arr);$i++){
			$values = get_cimyFieldValue(false, $simplevals_arr[$i], $_POST[ $simplevals_arr[$i] ] );
			foreach ($values as $value) {
				$user_id = $value['user_id'];
				///NEED TO CHECK IF USER IS A RECRUIT
				
				$basicScores_arr = increaseScoreNEW($value['user_id'],$basicScores_arr,'basic_yn', 1 );
			}
			array_push($empBasicCriteria_arr,array('qID' => $simplevals_arr[$i], 'required_val' =>  $_POST[ $simplevals_arr[$i] ] ));
			
		}
		
		
		
	?>
    

  <?php
  // <p><strong>Grouped Single Option Value Answers</strong></p>
	//// SCORE SINGLE SELECT QUESTIONS
	//increaseScoringSingleSelect($field , $direction, $scoringArr, $empCritArr);
	///$direction is bonus
	increaseScoringSingleSelect('INDUSTRY_YEARS' , 'ASC', $basicScores_arr, $empBasicCriteria_arr);
	increaseScoringSingleSelect('COMPENSATION_CURRENT' , 'DESC', $basicScores_arr, $empBasicCriteria_arr);
	
	
	?>
   
    
    <?php
	//<p><strong>Grouped Multi Option Value Answers</strong></p>   
	//FIELDS WITH MULTI SELECT
	$fields_arr=array('DES_WORK_TYPE','FIELD_LICENSE_STATE','LANGUAGES_SPOKEN','LANGUAGES_WRITTEN','US_ARMED_FORCES','US_LAW_ENFORCE_STATU');
	for($i=0; $i<count($fields_arr); $i++){
		///check if posted requirement and only process if neccessary
		if($_POST[ $fields_arr[ $i ]  ]){
			increaseScoringMultiSelect( $fields_arr[ $i ]  ,  $basicScores_arr, $empBasicCriteria_arr);
		}
		
		
	}
	
	?>  
    
      
     <h2>FINAL &quot;BASIC&quot; SCORE ARRAY</h2>
      <?php //print_r($basicScores_arr); ?>
    </div>
    <!---- BASICS --->
   <div id="tasksResults" style="background-color:#eee; padding:20px;">
   <h2>Tasks Criteria Sorted by Importance<br /><small>(used later during display of search profile but not neccessarily for scoring)</small></h2>
   <p>
     <?php
   $empTasksCriteria_arr=array();
   ////build criteria array 
   for ($i=0;$i<=30;$i++){
	   $qID='TASKS_Q' . $i;
	   $tmpVal = $_POST[$qID];
	   if($tmpVal){

	    array_push($empTasksCriteria_arr,array('qID' => $qID, 'required_skill' =>  $tmpVal ));
	   }
   }
   ////sort array by requirements decending
   $skillReq = array();
foreach ($empTasksCriteria_arr as $key => $row)
{
    $skillReq[$key] = $row['required_skill'];
}
   array_multisort($skillReq, SORT_DESC, $empTasksCriteria_arr);
    
   print_r($empTasksCriteria_arr);
   echo '<br>count: '.count($empTasksCriteria_arr);
   ?>
   </p>
   <?php
   /////CREATE RESULTS HOLDER
   $searchResultsTasks_arr=array();
   
   /////EMPLOYER CRITERA ARRAY
   for($i=0;$i<count($empTasksCriteria_arr);$i++){
	   $qID = $empTasksCriteria_arr[$i]['qID'];
	   $empNeed = $empTasksCriteria_arr[$i]['required_skill'];
	   
//   	echo ' <p>Users with some criteria for qID: ' .$qID .'</p>';
	
	 ////FIND SEEKER RESULTS ARRAY AND ADD TO SEARCH RESULTS ARRAY
	 $values = get_cimyFieldValue(false, $qID);
	 foreach ($values as $value) {
		$user_id = $value['user_id'];
	//	echo $value['user_login'] .': ';
	
		$seekerSkill = getYN_OptionVal($value['VALUE']);
	//	echo $seekerSkill;
		$qScore = get_scoring_YN($empNeed,$seekerSkill);
	//	echo ' score: '. $qScore;
	//	echo '<br>';
		array_push($searchResultsTasks_arr,array('qID' => $qID, 'user_id'=>$value['user_id'],'answer' =>  $seekerSkill, 'score' => $qScore ));
	}
	 
	// echo '<hr>';
	 
   }
  
   
   /////CREATE SCORES ARRAY
   
   ?>
  <!--
   <h2>FINAL RESULTS:</h2>
   <hr>
   <h4>Search Results</h4>
   <?php 
   print_r($searchResultsTasks_arr);
   ?>
   <br />
   <h4>Individual Question Calculated Score Results</h4>
   -->
   <?php
   /////CREATE EMPTY SCORES ARRAY FOR RESULTS which will contain user_id and scores
   $taskScores_arr=array();
   
   $tmp_arr = array();
   foreach ($searchResultsTasks_arr as $value) {
			//print_r($value);
			//$tmp_arr[] = $value['user_id'];
			//increaseScore($value['user_id']);
			$taskScores_arr = increaseScoreNEW($value['user_id'],$taskScores_arr,'yn_scale',$value['score']);
			echo 'USER_ID: '. $value['user_id'] .' / SCORE: '. $value['score'] . '<br>';
			}
   ?>
   
      <br />
     <h4>Final Combined &quot;Tasks&quot; Score Results</h4>
   <?php 
   $scoreRank = array();
foreach ($taskScores_arr as $key => $row)
{
    $scoreRank[$key] = $row['score'];
}
   array_multisort($scoreRank, SORT_DESC, $taskScores_arr);
    
  // print_r($taskScores_arr);
   ///
   
   ?>
   </div>
   
   <!-- TECH -->
   <div id="techResults" style="background-color:#ddd; padding:20px;">
   <h2>Tech Criteria Sorted by Importance<br /><small>(used later during display of search profile but not neccessarily for scoring)</small></h2>
   <p>
     <?php
   $empTechCriteria_arr=array();
   ////build criteria array 
   for ($i=0;$i<=30;$i++){
	   $qID='TECH_Q' . $i;
	   $tmpVal = $_POST[$qID];
	   if($tmpVal){

	    array_push($empTechCriteria_arr,array('qID' => $qID, 'required_skill' =>  $tmpVal ));
	   }
   }
   ////sort array by requirements decending
   $skillReq = array();
foreach ($empTechCriteria_arr as $key => $row)
{
    $skillReq[$key] = $row['required_skill'];
}
   array_multisort($skillReq, SORT_DESC, $empTechCriteria_arr);
    
   //print_r($empTechCriteria_arr);
   //echo '<br>count: '.count($empTechCriteria_arr);
   ?>
   </p>
   <?php
   /////CREATE RESULTS HOLDER
   $searchResultsTech_arr=array();
   
   /////EMPLOYER CRITERA ARRAY
   for($i=0;$i<count($empTechCriteria_arr);$i++){
	   $qID = $empTechCriteria_arr[$i]['qID'];
	   $empNeed = $empTechCriteria_arr[$i]['required_skill'];
	   
  // 	echo ' <p>Users with some criteria for qID: ' .$qID .'</p>';
	
	 ////FIND SEEKER RESULTS ARRAY AND ADD TO SEARCH RESULTS ARRAY
	 $values = get_cimyFieldValue(false, $qID);
	 foreach ($values as $value) {
		$user_id = $value['user_id'];
	//	echo $value['user_login'] .': ';
	
		$seekerSkill = getYN_OptionVal($value['VALUE']);
	//	echo $seekerSkill;
		$qScore = get_scoring_YN($empNeed,$seekerSkill);
	//	echo ' score: '. $qScore;
	//	echo '<br>';
		array_push($searchResultsTech_arr,array('qID' => $qID, 'user_id'=>$value['user_id'],'answer' =>  $seekerSkill, 'score' => $qScore ));
	}
	 
	// echo '<hr>';
	 
   }
  
   
   /////CREATE SCORES ARRAY
   
   ?>
  
   <h2>FINAL RESULTS:</h2>
   <hr>
   <h4>Search Results</h4>
   <?php 
  // print_r($searchResultsTech_arr);
   ?>
   <br />
   <h4>Individual Question Calculated Score Results</h4>
   <?php
   /////CREATE EMPTY SCORES ARRAY FOR RESULTS which will contain user_id and scores
   $techScores_arr=array();
   
   $tmp_arr = array();
   foreach ($searchResultsTech_arr as $value) {
			//print_r($value);
			//$tmp_arr[] = $value['user_id'];
			//increaseScore($value['user_id']);
			$techScores_arr = increaseScoreNEW($value['user_id'],$techScores_arr,'yn_scale',$value['score']);
			echo 'USER_ID: '. $value['user_id'] .' / SCORE: '. $value['score'] . '<br>';
			}
   ?>
   
      <br />
     <h4>Final Combined &quot;Tech&quot; Score Results</h4>
   <?php 
   $scoreRank = array();
foreach ($techScores_arr as $key => $row)
{
    $scoreRank[$key] = $row['score'];
}
   array_multisort($scoreRank, SORT_DESC, $techScores_arr);
    
   //print_r($techScores_arr);
   ///
   
   ?>
   </div>
   
   <!-- KNOWLEDGE -->
    <div id="knowResults" style="background-color:#eee; padding:20px;">
   <h2>Knowledge Criteria Sorted by Importance<br /><small>(used later during display of search profile but not neccessarily for scoring)</small></h2>
   <p>
     <?php
   $empKnowCriteria_arr=array();
   ////build criteria array 
   for ($i=0;$i<=30;$i++){
	   $qID='KNOW_Q' . $i;
	   $tmpVal = $_POST[$qID];
	   if($tmpVal){

	    array_push($empKnowCriteria_arr,array('qID' => $qID, 'required_skill' =>  $tmpVal ));
	   }
   }
   ////sort array by requirements decending
   $skillReq = array();
foreach ($empKnowCriteria_arr as $key => $row)
{
    $skillReq[$key] = $row['required_skill'];
}
   array_multisort($skillReq, SORT_DESC, $empKnowCriteria_arr);
    
   //print_r($empKnowCriteria_arr);
   //echo '<br>count: '.count($empKnowCriteria_arr);
   ?>
   </p>
   <?php
   /////CREATE RESULTS HOLDER
   $searchResultsKnow_arr=array();
   
   /////EMPLOYER CRITERA ARRAY
   for($i=0;$i<count($empKnowCriteria_arr);$i++){
	   $qID = $empKnowCriteria_arr[$i]['qID'];
	   $empNeed = $empKnowCriteria_arr[$i]['required_skill'];
	   
  // 	echo ' <p>Users with some criteria for qID: ' .$qID .'</p>';
	
	 ////FIND SEEKER RESULTS ARRAY AND ADD TO SEARCH RESULTS ARRAY
	 $values = get_cimyFieldValue(false, $qID);
	 foreach ($values as $value) {
		$user_id = $value['user_id'];
	//	echo $value['user_login'] .': ';
	
		$seekerSkill = getYN_OptionVal($value['VALUE']);
	//	echo $seekerSkill;
		$qScore = get_scoring_YN($empNeed,$seekerSkill);
	//	echo ' score: '. $qScore;
	//	echo '<br>';
		array_push($searchResultsKnow_arr,array('qID' => $qID, 'user_id'=>$value['user_id'],'answer' =>  $seekerSkill, 'score' => $qScore ));
	}
	 
	// echo '<hr>';
	 
   }
  
   
   /////CREATE SCORES ARRAY
   
   ?>
  
   <h2>FINAL RESULTS:</h2>
   <hr>
   <h4>Search Results</h4>
   <?php 
  // print_r($searchResultsKnow_arr);
   ?>
   <br />
   <h4>Individual Question Calculated Score Results</h4>
   <?php
   /////CREATE EMPTY SCORES ARRAY FOR RESULTS which will contain user_id and scores
   $knowScores_arr=array();
   
   $tmp_arr = array();
   foreach ($searchResultsKnow_arr as $value) {
			//print_r($value);
			//$tmp_arr[] = $value['user_id'];
			//increaseScore($value['user_id']);
			$knowScores_arr = increaseScoreNEW($value['user_id'],$knowScores_arr,'yn_scale',$value['score']);
			echo 'USER_ID: '. $value['user_id'] .' / SCORE: '. $value['score'] . '<br>';
			}
   ?>
   
      <br />
     <h4>Final Combined &quot;Know&quot; Score Results</h4>
   <?php 
   $scoreRank = array();
foreach ($knowScores_arr as $key => $row)
{
    $scoreRank[$key] = $row['score'];
}
   array_multisort($scoreRank, SORT_DESC, $knowScores_arr);
    
   //print_r($knowScores_arr);
   ///
   
   ?>
   </div>
   
    <h2>Here are your best matches</h2>
    <?php
	///CALCULATE POINTS
	$empTotalCriteriaPts=count($empBasicCriteria_arr)+count($empTasksCriteria_arr)+count($empTechCriteria_arr);
	?>
    <p>Employer possible criteria points: <?php echo $empTotalCriteriaPts;?></p>
    
    <?php
	//$tmpTotalScores_arr=array();
	$tmpTotalScores_arr=array_merge($basicScores_arr,$taskScores_arr,$techScores_arr,$knowScores_arr);
	
	$totalScores_arr = array();
	
	foreach ($tmpTotalScores_arr as $value) {
			
			$totalScores_arr = increaseScoreNEW($value['user_id'],$totalScores_arr,'yn_scale',$value['score']);
			//echo 'USER_ID: '. $value['user_id'] .' / SCORE: '. $value['score'] . '<br>';
			}
	 
	  ////sort array by requirements decending
   $tmpSort = array();
foreach ($totalScores_arr as $key => $row)
{
    $tmpSort[$key] = $row['score'];
}
   array_multisort($tmpSort, SORT_DESC, $totalScores_arr);
   
			////
			///SHOW RESULT
		//	echo '<ol>';
			foreach ($totalScores_arr as $value) {
				$user = get_user_by( 'id', $value['user_id'] );
			 
				
		//	echo '<li>';
			echo '<div class="row marginBottom">';
			
			///AVATAR
			ob_start();
			?>
            <div class="col-md-3">
            <form target="_blank" action="<?php echo site_url(); ?>/candidate-view/" method="post"><input type="hidden" value="<?php echo $value['user_id'];?>" id="uID" name="uID"><button type="submit"><?php echo get_wp_user_avatar($value['user_id'], 150);?></button></form>
            </div>
            
            <div class="col-md-6 columns">
            Name: <?php echo $user->first_name . ' ' . $user->last_name; ?>
            <br>
            username: <?php echo $user->display_name;?><br>
			<br>login: <?php echo $user->user_login;?>
			<br>USER_ID:  <?php echo $value['user_id'] .' / SCORE: '. $value['score'] ; ?>
			<br>membership level:  <?php echo $value['seekerType']; ?>
            
            <form target="_blank" action="<?php echo site_url(); ?>/candidate-view/" method="post"><input type="hidden" value="<?php echo $value['user_id'];?>" id="uID" name="uID"><button type="submit" class="button button-primary radius button-small">View Profile</button></form>
			
<?php
			//$seekerType = get_cimyFieldValue($current_user->ID, 'JOB_SEEKER_TYPE'); 
			
			?>
            </div>
            
			<?php
			$html = ob_get_clean();
	ob_end_flush();
		echo $html;
		//	echo '<div class="col-md-3 text-center"><a href="'.$profileLink.'">'.get_wp_user_avatar($value['user_id'], 150).'</a></div>';///columns
			?>
    
            
            <?php
			$tmpVal=($value['score']/$empTotalCriteriaPts)*100 ;
			?>
            
            <div class="col-md-3">
            
            <div class="pct_overview text-center" style="position:relative; width:150px;">
<div id="overall" style="width:100%; position:absolute; top:20px; text-align:center;"><h2><small>Overall</small><br>
<?php 
$displayDecimal_str = number_format($tmpVal, 2, '.', '');
echo $displayDecimal_str .'%';  
?>
</h2></div>
<?php


echo do_shortcode('[wp_charts title="dough'.$value['user_id'].'" type="doughnut" width="100%"   data="'.$tmpVal.','.(100-$tmpVal).'" colors="#cccccc,#ffffff"]');
?>


</div>
            
            </div>
            
            <h3 class="text-center">SECTION MATCHING</h3>
            <ul class="medium-block-grid-3">
<li class="text-center"><h5>BASIC<br>
            <?php
			
			///TASKS MATCH

			echo getSectionScorePctforUser($empBasicCriteria_arr,$basicScores_arr,$value['user_id']);
			 
			?>
            </h5></li>
<li class="text-center"><h5>TASKS<br>            
			<?php
			
			///TASKS MATCH

			echo getSectionScorePctforUser($empTasksCriteria_arr,$taskScores_arr,$value['user_id']);
			 
			?>
            </h5></li>
    
    <li class="text-center"><h5>TECH :<br>        
            <?php
			
			///TECH MATCH
	
			echo getSectionScorePctforUser($empTechCriteria_arr,$techScores_arr,$value['user_id']);

			?>
            </h5></li>
            
             <li class="text-center"><h5>KNOWLEDGE :<br>        
            <?php
			
			///IN PROGRESS
	
			echo getSectionScorePctforUser($empKnowCriteria_arr,$knowScores_arr,$value['user_id']);

			?>
            </h5></li>
            
             
            
            </ul>
            
            <?php
			echo '</div>';////ROW
			
			//echo '</li>';
			}
			//echo '</ol>';
			//echo '<h2>ROCK ON!!!! j is badass!</h2>  ';
		//	echo 'FINAL CNT: '.count($totalScores_arr);
	?>
    
   
    <?php
	}
	/////END SEARCH RESULTS
?>
</div>

<script>
jQuery(window).load(function(e) {
	var maxIdx=0;
	var seekerType = jQuery("#seekerType span").text();
	if(seekerType=='Plus'){maxIdx=1;}
	if(seekerType=='Premium'){maxIdx=2;}
	if(seekerType=='Ultimate'){maxIdx=3;}

    jQuery(".loadingImg").remove();
	jQuery("form#adduser h3:gt("+maxIdx+")").remove();
	jQuery("form#adduser table.form-table:gt("+(maxIdx+1)+")").remove();
});
</script>

<style>
form p{margin-top:1rem;}
</style>


<?php get_footer(); ?>
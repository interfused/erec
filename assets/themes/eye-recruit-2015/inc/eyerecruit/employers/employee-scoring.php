<?php
function getLabelOptionsForArr($cimyFieldName){
	/*
	THIS FUNCTION IS USED TO SETUP ARRAY FOR SCORING PURPOSES
	*/
	global $wpdb;
	$results = $wpdb->get_results( 'SELECT * FROM eyecuwp_cimy_uef_fields WHERE `name` = "'.$cimyFieldName .'"', OBJECT );
	//print_r($results);
	$fullStr=$results[0]->LABEL;
	$labels = substr($fullStr, strpos($fullStr, "/") + 1);    
	 
	$labels_arr = explode(',' , $labels);
	
	$tmpArray=array();
	
	
	for ($i=0;$i<count($labels_arr);$i++){
		$val = $labels_arr[$i];
		array_push($tmpArray,$val);
	}
	 return $tmpArray;
}
///////////
function increaseScoringSingleSelect($cimy_field , $searchDirection, $scoringArr,$empCritArr){
	//global $$scoringArr,$$empCritArr;

		/*
		Increase scoring of single select options CIMY
		$cimy_field :  the name of the CIMY user field 
		$searchDirection: ASC or DESC (used to determine scoring bonus)
		$scoringArr: the array used for user scoring
		$empCritArr: the array for ALL employee search criteria
		
		*/
	///VARIABLES
		$scoreVal=1;
		$maxVariance = .2; //bonus points.  max score in this case would be 1.2
		 
	$options_arr=getLabelOptionsForArr($cimy_field);
	//GET POSTED FIELD VALUE
	$empCriteria=$_POST[$cimy_field];
	
	
	///CREATE NEW SEARCH ARRAY BASED OFF OF criteria and options
	$key=array_search($empCriteria,$options_arr);
	
	$search_arr=array();
	
	if($searchDirection=='DESC'){
		for($i=0; $i< count($options_arr) ; $i++){
			array_push($search_arr,$options_arr[$i]);
			
			if( $i  >= $key){
				break;
			}
		}
		///we reverse the array for scoring purposes
		$search_arr = array_reverse($search_arr);
		
	}else{
		///ASC
		for($i=0; $i< count($options_arr) ; $i++){
			if($i >= $key){
			array_push($search_arr,$options_arr[$i]);
			}
		}
	}
	
	//	print_r( $search_arr );
	///max variance would be .2
		$scoreBonus= $maxVariance/count($search_arr);
			
		for($i=0; $i<count($search_arr); $i++){
	//echo '<hr>search for: ' . $search_arr[$i];
			if($i>0){
				$scoreVal = 1+ ($i*$scoreBonus);
			}
	
			$values = get_cimyFieldValue(false, $cimy_field, $search_arr[$i]  );

			foreach ($values as $value) {
				 /*
				//$user_id = $value['user_id'];
				echo '<p>Increase score of '.$value['user_login'] ." / user id: ".$value['user_id']." - ";
				//echo cimy_uef_sanitize_content($value['VALUE']) ;
				echo $scoreVal."</p>";
				 */
				$scoringArr = increaseScoreNEW($value['user_id'],$scoringArr,'general', $scoreVal );
			}
						
			array_push($empCritArr,array('qID' => $simplevals_arr[$i], 'required_val' =>  $_POST[ $simplevals_arr[$i] ] ));
			
		}
	}
///////////////////////////////////////

function increaseScoringMultiSelect($cimy_field ,  $scoringArr,$empCritArr){
		
		$maxScoreBonus = .2;
		
		//echo '<h4>emp criteria post:</h4>';
		$postedEmployerReq_arr=$_POST[$cimy_field];
		
		 
		
	//	print_r($postedEmployerReq_arr);
		
		//echo '<h4>user search criteria:</h4>';
		
		
		
		$values = get_cimyFieldValue(false, $cimy_field, $postedEmployerReq_arr  );

			foreach ($values as $value) {
				
				//$user_id = $value['user_id'];
				///check if not null
				if($value['VALUE']){
				
				///the answers provided by the employee
				
				$seekerAnswer_arr = explode(',' , cimy_uef_sanitize_content($value['VALUE'] )); 
				
				 
				
				////COMPARE $seekerAnswer_arr against $postedEmployerReq_arr
				$result_arr = array_intersect($seekerAnswer_arr, $postedEmployerReq_arr);
				$seekerResultsCnt =  count($seekerAnswer_arr);
				$empCriteriaCnt =  count($postedEmployerReq_arr);
				$intersectCnt = count($result_arr);
				
				$bonusDiff=0;
				if( ($seekerResultsCnt > $intersectCnt) && ($empCriteriaCnt == $intersectCnt) ){
					
					$options_arr=getLabelOptionsForArr($cimy_field);				
					
					//$bonusDiff = .1;
					/////NOTE: NEED BETTER CALCULATION
					$individualPtVal = $maxScoreBonus/( count($options_arr) -  $empCriteriaCnt);
					$bonusDiff = $individualPtVal * ($seekerResultsCnt-$intersectCnt);
				}
				
				/*
				echo '<br>intereset cnt: '.$intersectCnt;
				echo '<br>seeker cnt: '.$seekerResultsCnt;
				echo '<br>empcrit cnt: '.$empCriteriaCnt;
				 */
				if( $intersectCnt == 0){
					///NO MATCH
					$scoreVal=0;
				}elseif($intersectCnt == $empCriteriaCnt ){
					$scoreVal=1+$bonusDiff;
				}else{
					//GREATER / LESS CALCULATIONS
					$ratio = $intersectCnt/$empCriteriaCnt;
					$scoreVal = $ratio+$bonusDiff;
				}
				
				 /*
				echo '<p>'.$value['user_login'] ." / user id: ".$value['user_id']." - ";
				echo cimy_uef_sanitize_content($value['VALUE']) ;
				echo " score: ". $scoreVal ."</p>";
				*/
				$scoringArr = increaseScoreNEW($value['user_id'],$scoringArr,'general', $scoreVal );
				
				}///END IF VALUE EXISTS
				
				array_push($empCritArr,array('qID' => $simplevals_arr[$i], 'required_val' =>  $_POST[ $simplevals_arr[$i] ] ));
			
			}
		
	}

?>
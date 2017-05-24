<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/

$user_id = get_current_user_id();
$tofOpArr = explode(',', get_cimyFieldValue($user_id,'TYPE_OF_OPPORTUNITY') );
$tofOp = implode(', ', $tofOpArr );

$cuEm = get_cimyFieldValue($user_id,'NAME_OF_COMP');
if ( !empty($cuEm) ) {
	$cuEm = $cuEm;
}
else{
	$cuEm = 'No';
}

$emStatus = get_cimyFieldValue($user_id, 'SYSTEM_AND_PROCE');
if ( $emStatus == 'I am Actively looking for the right opportunity.') {
	$emStatus = 'Actively looking';
}
elseif( $emStatus == 'I am Passively considering all options.' ){
	$emStatus = 'Passively considering';
}
else{
	$emStatus = 'None';
}

$language_array = array('mandarin','vietnamese','english','javanese','spanish','tamil','hindi','Korean','russian','turkish','arabic','telugu','portuguese','marathi','bengali','italian','french','thai','malay','burmese','german','cantonese','japanese','kannada','farsi','gujarati','urdu','polish','punjabi','wu','other');

foreach ($language_array as $lang) {
	
	$list_language = get_user_meta( $user_id, 'list_languages_'.$lang, true );
	if ( !empty( $list_language ) ) {
		if ( $list_language == 'OTHER' ) {
			$list_languages_text = get_user_meta( $user_id, 'list_languages_text', true );
			$list_languages[] = $list_languages_text;
		}
		else{
			$list_languages[] = $list_language;
		}
	}	
}

if ( !empty($list_languages) ) {
	
	$LANGUAGES_SPOKEN = implode(', ', $list_languages);
}
else{
	$LANGUAGES_SPOKEN = 'none';
}
$value6 = get_cimyFieldValue($user_id,'HIGHEST_EDUCATION');

$value3 = get_cimyFieldValue($user_id,'RELOCATION_YN');
if($value3){
	if($value3 == 'Yes'){
		$Relocation = 'Yes, Anywhere';
	}else{
		$Relocation = 'No';
	}

}else{
	$Relocation = 'None';
}

?>
<ul class="view_points row">
	<li class="col-xs-6 devicefull"><strong>Industry Sector : </strong><?php  echo get_cimyFieldValue($user_id,'BEST_INDUSTRY'); ?></li>
	<li class="col-xs-6 devicefull"><strong>Years of Service : </strong><?php  echo get_cimyFieldValue($user_id,'INDUSTRY_YEARS'); ?></li>
	<li class="col-xs-6 devicefull"><strong>Employment Status : </strong><?php  echo 'Actively Looking'; ?></li>
	<li class="col-xs-6 devicefull"><strong>Desired Opportunity : </strong><?php  echo $tofOp; ?></li>
	<li class="col-xs-6 devicefull"><strong>Career Level : </strong><?php  echo get_cimyFieldValue($user_id,'CURR_CAREER_LVL'); ?></li>
	<li class="col-xs-6 devicefull"><strong>Closest Metropolitan Area : </strong><?php  echo get_cimyFieldValue($user_id,'MAJOR_METROPOLITAN'); ?></li>
	<li class="col-xs-6 devicefull"><strong>Highest Education Level : </strong><?php  echo $value6; ?></li>
	
	<li id="currEmp" class="col-xs-6 devicefull <?php  if (strtolower($cuEm)=='no'){echo 'locked';} ?>">
		<strong>Current Employer : </strong><?php  echo $cuEm; ?>
	</li>
	
	<li class="col-xs-6 devicefull"><strong>Spoken Language(s) : </strong><?php  echo $LANGUAGES_SPOKEN; ?></li>
	
	<li class="col-xs-6 devicefull salary <?php  if (strtolower(get_cimyFieldValue($user_id,'COMPENSATION_ACC'))=='do not show employer'){echo 'locked';} ?>">
		<a href="/preferences/basic-information/?pg=6">
			<strong>Current Income Range : </strong><?php  echo get_cimyFieldValue($user_id,'COMPENSATION_CURRENT'); ?>
		</a>
	</li>
	
	<li class="col-xs-6 devicefull"><strong>Willing to Relocate : </strong><?php  echo $Relocation; ?></li>
	<li class="col-xs-6 devicefull salary <?php  if (strtolower(get_cimyFieldValue($user_id,'COMP_DESIRED_ACC'))=='do not show employer'){echo 'locked';} ?>">
		<a href="/preferences/basic-information/?pg=6">
			<strong>Desired Income Range : </strong><?php  echo get_cimyFieldValue($user_id,'COMPENSATION_DESIRED'); ?>
		</a>
	</li>
</ul>
<div class="clearfix"></div>
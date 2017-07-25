<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/
?>
<?php
$user_id = get_current_user_id();

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

$value4 = get_cimyFieldValue($user_id,'US_ARMED_FORCES_OPTI');
$value5 = get_cimyFieldValue($user_id,'US_ARMED_FORCES');

if( !empty($value4) ){
	if ( $value4 != 'Other' ) {
		$US_ARMED_FORCES_OPTION = $value5.', '.$value4;
	}
	else{
		$US_ARMED_FORCES_OPTION = $value5;
	}

}else{
	if ( !empty($value5) ) {
		$US_ARMED_FORCES_OPTION = $value5;
	}
	else{
		$US_ARMED_FORCES_OPTION = 'No';
	}
}


$value6 = get_cimyFieldValue($user_id,'HIGHEST_EDUCATION');
$eduDetailArr = array('Associates Degree','Bachelors Degree','Masters Degree','Doctorate Degree / PhD.'); 

$Clearance = get_cimyFieldValue($user_id,'CLEARANCE_LEVEL') ? get_cimyFieldValue($user_id,'CLEARANCE_LEVEL') : 'Not Defined';
$LAW_ENFORCE = get_cimyFieldValue($user_id,'FEDERAL_NVESTIGATIV');
$yesvalue = get_cimyFieldValue($user_id,'US_LAW_ENFORCE_STATU');
if($LAW_ENFORCE == 'Yes'){
	if($yesvalue == 'OTHER'){
		$oth = get_cimyFieldValue($user_id,'US_LAW_ENFORCE_OTHER');
		$Federal = $LAW_ENFORCE .', '. $oth;
		
	}else{

		$Federal = $LAW_ENFORCE .', '. $yesvalue;
	}
}else{
	$Federal ='No';
}

?>
<ul><!-- 
	<li><span>Spoken Language(s) :</span><?php  //echo $LANGUAGES_SPOKEN; ?></li>
	<li><span>Willing to Relocate :</span><?php  //echo $Relocation; ?></li>
	<li><span>Military Service :</span><?php  //echo $US_ARMED_FORCES_OPTION; ?></li>
	<li><span>Highest Education Level :</span><?php //echo $value6; ?></li> -->
	<li class="icon military"><!-- <img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/military_service_icon.png" class="pull-right"> --><span>Military Service :</span><?php  echo $US_ARMED_FORCES_OPTION; ?></li>
	<li class="icon law_enforcement"><span>Law Enforcement Service :</span><?php  echo get_cimyFieldValue($user_id,'LOCAL_LAW_FORCE_YN'); ?></li>
	<li class="icon federal"><span>Federal Agency Service :</span><?php echo $Federal;  ?></li>
	<li class="icon locked"><span>Highest Clearance Level :</span><?php echo $Clearance;  ?></li>
</ul>
<div class="text-center">
	<a href="<?php  echo site_url(); ?>/preferences/basic-information/" class="btn btn-primary">See All</a>
</div>
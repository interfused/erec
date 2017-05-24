<?php
/* TESTING PURPOSES */
/*
$fname='Jeremy';
$lname='External Test';
$emailToAdd='extpptest@interfusedcreative.com';
*/


/* REF CALLS 
https://api.ontraport.com/doc/#!/objects/getObjects
*/
define('APP_ID','2_21625_8o1XeyNbE');
define('APP_KEY','akPNmSS5sS0IKQT');
///////////
function get_full_statename($abbr){
	/* 
	We'll use this as paypal returns states as abbreviations
	USAGE: echo get_full_statename('FL'); 
	
	*/
	$us_state_abbrevs_names = array(
	'AL'=>'ALABAMA',
	'AK'=>'ALASKA',
	'AS'=>'AMERICAN SAMOA',
	'AZ'=>'ARIZONA',
	'AR'=>'ARKANSAS',
	'CA'=>'CALIFORNIA',
	'CO'=>'COLORADO',
	'CT'=>'CONNECTICUT',
	'DE'=>'DELAWARE',
	'DC'=>'DISTRICT OF COLUMBIA',
	'FM'=>'FEDERATED STATES OF MICRONESIA',
	'FL'=>'FLORIDA',
	'GA'=>'GEORGIA',
	'GU'=>'GUAM GU',
	'HI'=>'HAWAII',
	'ID'=>'IDAHO',
	'IL'=>'ILLINOIS',
	'IN'=>'INDIANA',
	'IA'=>'IOWA',
	'KS'=>'KANSAS',
	'KY'=>'KENTUCKY',
	'LA'=>'LOUISIANA',
	'ME'=>'MAINE',
	'MH'=>'MARSHALL ISLANDS',
	'MD'=>'MARYLAND',
	'MA'=>'MASSACHUSETTS',
	'MI'=>'MICHIGAN',
	'MN'=>'MINNESOTA',
	'MS'=>'MISSISSIPPI',
	'MO'=>'MISSOURI',
	'MT'=>'MONTANA',
	'NE'=>'NEBRASKA',
	'NV'=>'NEVADA',
	'NH'=>'NEW HAMPSHIRE',
	'NJ'=>'NEW JERSEY',
	'NM'=>'NEW MEXICO',
	'NY'=>'NEW YORK',
	'NC'=>'NORTH CAROLINA',
	'ND'=>'NORTH DAKOTA',
	'MP'=>'NORTHERN MARIANA ISLANDS',
	'OH'=>'OHIO',
	'OK'=>'OKLAHOMA',
	'OR'=>'OREGON',
	'PW'=>'PALAU',
	'PA'=>'PENNSYLVANIA',
	'PR'=>'PUERTO RICO',
	'RI'=>'RHODE ISLAND',
	'SC'=>'SOUTH CAROLINA',
	'SD'=>'SOUTH DAKOTA',
	'TN'=>'TENNESSEE',
	'TX'=>'TEXAS',
	'UT'=>'UTAH',
	'VT'=>'VERMONT',
	'VI'=>'VIRGIN ISLANDS',
	'VA'=>'VIRGINIA',
	'WA'=>'WASHINGTON',
	'WV'=>'WEST VIRGINIA',
	'WI'=>'WISCONSIN',
	'WY'=>'WYOMING',
	'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
	'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
	'AP'=>'ARMED FORCES PACIFIC'
	);
	$statename="Does not exist in US";
	foreach ($us_state_abbrevs_names as $key => $value) {
		 if ($key == $abbr){
			 $statename=$value;
			 break;
		 }
	}
	return $statename;
}
///////////
function add_site_member($fname,$lname,$emailToAdd,$address='',$city='',$state='',$zip='',$country="US",$mbrType='GENERAL'){
	////THE FOLLOWING CAN BE FOUND BY HOVERING OVER SEQUENCES IN ONTRAPORT AND LOOKING AT THE URL VARIABLE ID=.  NOTE: more accurate since it is possible to change sequnce names easily.
	$tagID='';
	if($mbrType=='GENERAL-PAYPAL'){
		$tagID=163;
	}
	if($mbrType=='VIP-PAYPAL'){
		$tagID=164;
	}
	

	$sequnceIDToAdd=95;
	
	$data_arr = array(
	'objectID' =>0,
	'firstname' => $fname,
	'lastname' => $lname,
	'email' => $emailToAdd,
	'address' => $address,
	'city' => $city,
	'state' => $state,
	'zipcode' => $zip,
	'country' => $country,
	'updateSequence' => $sequnceIDToAdd,
	'contact_cat' => $tagID
	);
	$data_json=json_encode($data_arr);
	///add contact
	CallAPI('POST', 'https://api.ontraport.com/1/objects', $data_json);
}

function cancel_mc_member($email){
		/* 
CANCEL MC CANCELLATION
We will add a tag "MC Member : v4 : VIP" with tag_id 162 which will trigger a rule in Ontraport to finalize the cancellation
 */
	$contact_id = searchByEmail($email);
	add_tag(array($contact_id),array(162));
}

function addSequence($contact_id,$sequence_id){
}
function removeSequence($contact_id,$sequence_id){
}

function add_tag($contactids_arr,$tags_arr){
	/* ADDLIST : Array of Tag IDs as comma-delimited list .  use implode(",", $array) */
	
	$data_arr=array(
	"objectID" => 0,
	 "ids" => implode(",", $contactids_arr),
	 'add_list' => implode(",", $tags_arr),
	 'performAll' => true
	);
	//$data_json=json_encode($data_arr);
	CallAPI('PUT', 'https://api.ontraport.com/1/objects/tag', $data_arr);
}

function CallAPI($method, $url, $data = false)
{
	
   $session = curl_init($url);
	$headers = array(
		'Api-Appid: '.APP_ID,
	  'Api-Key: '.APP_KEY,
	);
	curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
	curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);
	if($method=='POST' ){
		curl_setopt($session, CURLOPT_POST, true);
		curl_setopt($session, CURLOPT_POSTFIELDS, $data);
	}
	if($method=='PUT'){
		curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($session, CURLOPT_POSTFIELDS,@http_build_query($data));
	}

	$response = curl_exec($session);
	curl_close($session);
	$result = json_decode($response, true);
    return $result;
}
////////////////
function getSequenceID($arr,$seq_name){
	///receives the sequences array and returns the id for the sequence name
	$idx=0;
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]['name']==$seq_name){
		$idx=$i;
		break;
		}
	}
	return $idx;
}
////////////////
function searchByEmail($email){
	$request="https://api.ontraport.com/1/objects?objectID=0&performAll=false&sortDir=asc&condition=email%3D'".urlencode($email)."'&searchNotes=false";

	$session = curl_init($request);
	$headers = array(
		'Api-Appid: '.APP_ID,
	  'Api-Key: '.APP_KEY,
	);
	curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
	curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($session);
	curl_close($session);
	
	//var_dump($response);
	// Will dump a beauty json :3
	//var_dump(json_decode($response, true));
	$feedback = json_decode($response, true);
	$contact_id=$feedback['data'][0]['id'];
	if($contact_id){
		return $contact_id;
	}else{
		return 0;
	}
}
//////////////////
function getContactRecord($id){
	$request='https://api.ontraport.com/1/object?objectID=0&id='.$id;
	
	$response= CallAPI('GET', $request);
	return $response;
}

/****************************
START PROCESSING 
****************************/

/////SEARCH FOR EMAIL
/*
$email = 'jeremy@interfused-inc.com';
$contact_id = searchByEmail($email);


if(!$contact_id){
	die ('email does not exist');
}
*/
/*
if($contact_id){
	echo ' contact id is: '.$contact_id;
}
*/
//$contact_record=getContactRecord($contact_id);
//var_dump($contact_record);
/*
////SEQUENCES
$url= 'https://api.ontraport.com/1/objects?objectID=5';
$sequences = CallAPI('GET', $url);
$sequences_arr=$sequences['data'];
//var_dump($sequences_arr);
//echo '<hr>';
*/
/*
////search for sequence id
$test_str='Course Delivery - 22 Days';
$idx=getSequenceID($sequences_arr,$test_str);
*/
/*
if($idx != 0){
echo 'Sequence id for '.$test_str.' is: '.$sequences_arr[$idx]['drip_id'];
}else{
	echo 'Sequence does not exist';	
}
*/
/////////
/*
$item_number = 'mc-mbr-v4-gen-monthly';
$mbrType='GENERAL-PAYPAL';

add_site_member('Jeremy','FULLTEST','completetets@interfusedcreative.com','1234 my street','Ft Lauderdale',
'FL','33325',"US",$mbrType);
//cancel_mc_member($emailToAdd);

echo 'DONE';
*/
?>
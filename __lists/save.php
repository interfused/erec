<?php
define('DB_NAME', 'eyerec5_production');

/** MySQL database username */
define('DB_USER', 'eyerec5_ifused');


/** MySQL database password */
define('DB_PASSWORD', 'eyer3cru1td3v');


/** MySQL hostname */
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
   // throw new Exception('Request method must be POST!');
  header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}

/*
//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    //throw new Exception('Content type must be: application/json');
  header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1339)));
}
*/

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$contacts = json_decode($content, true);

//If json_decode failed, the JSON is invalid.

if(!is_array($contacts)){
    throw new Exception('Received content contained invalid JSON!');
    header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1340)));
}


//Process the JSON.
//open sql connection

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
//    throw new Exception('DB connection!');
}

//echo ($contacts);
print_r($contacts);

foreach ($contacts['contacts_arr'] as $contact) {

  $fullname = addslashes($contact['fullname']);
  $salutation = addslashes($contact['salutation']);
  $first_name = addslashes($contact['first_name']);
  $middle_name = addslashes($contact['middle_name']);
  $last_name = addslashes($contact['last_name']);
  $name_suffix = addslashes($contact['name_suffix']);
  $company = addslashes($contact['company']);
  $contact_title = addslashes($contact['contact_title']);
  $list_source = addslashes($contact['list_source']);
  $address1 = addslashes($contact['address1']);
  $address2 = addslashes($contact['address2']);
  $city = addslashes($contact['city']);
  $state = addslashes($contact['state']);
  $detail_link = addslashes($contact['detail_link']);
  $misc_data = addslashes($contact['misc_data']);


  # code...
 
/*
$fields_arr = array('fullname','salutation','list_source','email');
$fields_str = '`'. implode('`,`',$fields_arr)  .'`';

$values_arr= array();

for($i=0;$i<count($fields_arr);$i++){
  $label = $fields_arr[$i];
  array_push($values_arr, addslashes($contact[$label])  );
}
$values_str = '`'. implode('`,`',$values_arr) .'`';

$sql = "REPLACE INTO `__leads` ($fields_str) VALUES ($values_str)";
*/

  $sql = "INSERT IGNORE INTO `__leads` (`fullname`, `salutation`, `first_name`, `middle_name`, `last_name`,`name_suffix`,`list_source`, `company`, `contact_title`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `email`, `phone`, `fax`, `website`, `detail_link`,`misc_data`) VALUES ( 
    '$fullname',
    '$salutation',
    '$first_name',
    '$middle_name',
    '$last_name',
    '$name_suffix',
    '$list_source',
    '$company',
    '$contact_title',
    '$address1',
    '$address2',
    '$city',
    '".($contact['state'])."',
    '".($contact['country'])."',
    '".$contact['zip']."',
    '".$contact['email']."',
    '".$contact['phone']."',
    '".$contact['fax']."',
    '".$contact['website']."',
    '$detail_link',
    '$misc_data'
    )";

  if ($conn->query($sql) === TRUE) {
    $tmp = 'yes';
    //  echo "New record created successfully";
  } else {
      die( "Error: " . $sql . "<br>" . $conn->error);
  }
  
}

echo 'you rock: '.count($contacts['contacts_arr']);
print_r($values_arr);
//echo $contacts['contacts_arr'][1]['email'];

//close connection
$conn->close(); 


?>
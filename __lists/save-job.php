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
$jobs = json_decode($content, true);

//If json_decode failed, the JSON is invalid.

if(!is_array($jobs)){
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

//echo ($jobs);
print_r($jobs);


  $list_source = addslashes($jobs['list_source']);
  $detail_link = addslashes($jobs['detail_link']);
  $city = addslashes($jobs['city']);
  $state = addslashes($jobs['state']);
  $zip = addslashes($jobs['zip']);
  $company = addslashes($jobs['company']);
  $posted_on = addslashes($jobs['posted_on']);
  $salary = addslashes($jobs['salary']);
  $job_type = addslashes($jobs['job_type']);
  $description = addslashes($jobs['description']);


  # code...
 
/*
$fields_arr = array('fullname','salutation','list_source','email');
$fields_str = '`'. implode('`,`',$fields_arr)  .'`';

$values_arr= array();

for($i=0;$i<count($fields_arr);$i++){
  $label = $fields_arr[$i];
  array_push($values_arr, addslashes($jobs[$label])  );
}
$values_str = '`'. implode('`,`',$values_arr) .'`';

$sql = "REPLACE INTO `__leads` ($fields_str) VALUES ($values_str)";
*/

  $sql = "INSERT INTO `__jobs-scraped` (`list_source`, `detail_link`, `city`, `state`, `zip`,`company`,`posted_on`, `salary`, `job_type`, `description`) VALUES ( 
    '$list_source',
    '$detail_link',
    '$city',
    '$state',
    '$zip',
    '$company',
    '$posted_on',
    '$salary',
    '$job_type',
    '$description'

    )";

  if ($conn->query($sql) === TRUE) {
    $tmp = 'yes';
    //  echo "New record created successfully";
  } else {
      die( "Error: " . $sql . "<br>" . $conn->error);
  }
 

echo 'you rock: '.count($jobs['jobs_arr']);
print_r($values_arr);
//echo $jobs['jobs_arr'][1]['email'];

//close connection
$conn->close(); 


?>
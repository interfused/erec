<?php
$http_origin = $_SERVER['HTTP_ORIGIN'];
$allowed_cross_domains = array(
    'http://infosecjobsnearme.com',
    'http://www.infosecjobsnearme.com',
    'http://cybersecurityjobsnearme.com',
    'http://www.cybersecurityjobsnearme.com',
    'http://investigationjobsnearme.com',
    'http://www.investigationjobsnearme.com',
    'http://securityjobsnearme.com',
    'http://www.securityjobsnearme.com'
    );
if(in_array($http_origin, $allowed_cross_domains)){
    header("Access-Control-Allow-Origin: $http_origin");
}


require_once('config.php');
require_once('api.php');

$data = array();
$uploadfile_url = '';
//create folder based on base64 encoded email address
$uploaddir = 'uploads/'. base64_encode($_POST['email']) .'/'  ;
if (!file_exists($uploaddir)) {
    mkdir($uploaddir);
}

if($_FILES['file']){
    if ( 0 < $_FILES['file']['error'] ) {
    //echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        $data = array('error' => 'There was an error uploading your files');
    }
    else {

        $uploadfile = $uploaddir . time() .'-' . basename($_FILES['file']['name']);
        $uploadfile_url = 'http://eyerecruit.com/__lists/seeker-leads/' . $uploadfile;

        if( move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile) ){
        //echo 'moved file to '.$uploadfile_url;
            $data = array('success' => 'Form was submitted', 'formData' => $_POST, 'res_location' => $uploadfile_url);

        }else{
        //echo 'could not move file';
            $data = array('error' => 'Could not move files');
        }

    }
}


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

// Check connection
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
    $data = array('error' => 'DB connection failed');
//    throw new Exception('DB connection!');
}else{
    //insert record
    extract($_POST);
    $last_name = addslashes($_POST['last_name']);
    $first_name = addslashes($_POST['first_name']);

    $sql = "INSERT INTO `__leads-seeker` (`last_name`, `first_name`, `resume_location`, `email`,`phone`,`industry`, `contact_source`,`zip`,`desired_salary_range`) VALUES ( 
        '$last_name',
        '$first_name',
        '$uploadfile_url',
        '$email',
        '$phone',
        '$industry',
        '$contact_source',
        '$zip',
        '$salary_range'
        )";

if ($conn->query($sql) === TRUE) {
    $tmp = 'yes';

    //  echo "New record created successfully";
} else {
      //die( "Error: " . $sql . "<br>" . $conn->error);
  $data = array('error' => "SQL Error: " . $sql . "<br>" . $conn->error );
}

}

$conn->close();

/* TEST/ADD TO MAILCHIMP */
$listid = '0';

switch($contact_source){
    case "securityjobsnearme.com":
    $listid = 'a77f35c589';
    break;
    case "infosecjobsnearme.com":
    $listid = '2705feafe9';
    break;

    case "investigationjobsnearme.com":
    $listid = '8c598b5282';
    break;
    case "cybersecurityjobsnearme.com":
    $listid = '9bdeecb79d';
    break;
}

if($listid != '0'){
    $merge_fields = new stdClass();
    $merge_fields->FNAME = $first_name;
    $merge_fields->LNAME = $last_name;
    $merge_fields->ZIP  = $zip;
    $merge_fields->PHONE  = $phone;
    $merge_fields->SALARY_REQ  = $salary_range;
    $merge_fields->INDUSTRY  = $industry;

    $data = array(
      'fields' => 'lists',
      'email_address' => $email,
      'merge_fields' => $merge_fields,
      'status' => 'subscribed'
      );

    $endpoint = '/lists/'.$listid.'/members/';

    $result = json_decode( er_mailchimp_curl_connect( $endpoint, 'POST', $apikey_mailchimp, $data) );

    //notify chris
    $msg = 'check http://eyerecruit.com/__lists/seeker-leads/ for details on '.$first_name.' '.$last_name.' who subscribed from '.$contact_source;
    $headers[] = 'From: noreply@eyerecruit.com';
    //$to_email = 'jeremy@interfusedcreative.com';
    $to_email = 'chris.bauer@eyerecruit.com';
    mail ( $to_email , 'new subscriber from secondary domain' , $msg, implode("\r\n", $headers) );
}



//
echo json_encode($data);

?>
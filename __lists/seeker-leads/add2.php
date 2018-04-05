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
    'http://www.securityjobsnearme.com',
    'http://eyerecruit.com',
    'http://www.eyerecruit.com'
    );
if(in_array($http_origin, $allowed_cross_domains)){
    header("Access-Control-Allow-Origin: $http_origin");
}


require_once('config.php');
require_once('api.php');
require_once('../inc/sendinblue/Mailin.php');

$data_sib = array();
$uploadfile_url = '';
//create folder based on base64 encoded email address
$uploaddir = 'uploads/'. base64_encode($_POST['email']) .'/'  ;
if (!file_exists($uploaddir)) {
    mkdir($uploaddir);
}

if($_FILES['file']){
    if ( 0 < $_FILES['file']['error'] ) {
    //echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        $data_sib = array('error' => 'There was an error uploading your files');
    }
    else {

        $uploadfile = $uploaddir . time() .'-' . basename($_FILES['file']['name']);
        $uploadfile_url = 'http://eyerecruit.com/__lists/seeker-leads/' . $uploadfile;

        if( move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile) ){
        //echo 'moved file to '.$uploadfile_url;
            $data_sib = array('success' => 'Form was submitted', 'formData' => $_POST, 'res_location' => $uploadfile_url);

        }else{
        //echo 'could not move file';
            $data_sib = array('error' => 'Could not move files');
        }

    }
}


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

// Check connection
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
    $data_sib = array('error' => 'DB connection failed');
//    throw new Exception('DB connection!');
}else{
    //insert record
    extract($_POST);
    $last_name = addslashes($_POST['last_name']);
    $first_name = addslashes($_POST['first_name']);


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
                $charset = 'utf8mb4';
                $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=$charset";
                $opt = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $opt);
                
                $sql = "INSERT INTO `__leads-seeker` ( first_name, last_name, resume_location, email, phone, industry, contact_source, zip, desired_salary_range, any_changes, daily_duties, industry_history,looking_for,how_last_job_found,any_other_recruiters,current_applications_results,ideal_career,why_left_last_job,desired_companies,who_met_with,most_important_career_factor,industry_observations,biggest_complaint,biggest_job_hurdles,continuing_education
                     ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                     
                     
                    
/*
//old
    $sql = "INSERT INTO `__leads-seeker` (`last_name`, `first_name`, `resume_location`, `email`,`phone`,`industry`, `contact_source`,`zip`,`desired_salary_range`,`any_changes`,`daily_duties`,`industry_history`,`looking_for`,`how_last_job_found`,`any_other_recruiters`,`current_applications_results`,`ideal_career`,`why_left_last_job`,`desired_companies`,`who_met_with`,`most_important_career_factor`,`industry_observations`,`biggest_complaint`,`biggest_job_hurdles`,`continuing_education`) 
        VALUES ( 
        '$last_name',
        '$first_name',
        '$uploadfile_url',
        '$email',
        '$phone',
        '$industry',
        '$contact_source',
        '$zip',
        '$SALARY_REQ',
        '$any_changes','$daily_duties','$industry_history','$looking_for','$how_last_job_found','$any_other_recruiters','$current_applications_results','$ideal_career','$why_left_last_job','$desired_companies','$who_met_with','$most_important_career_factor','$industry_observations','$biggest_complaint','$biggest_job_hurdles','$continuing_education'
        )";
*/
//old condition : $conn->query($sql) === TRUE
        
if (
    $pdo->prepare($sql)->execute([$first_name, $last_name, $uploadfile_url, $email, $phone, $industry, $contact_source, $zip, $SALARY_REQ,$any_changes,$daily_duties,$industry_history,$looking_for,$how_last_job_found,$any_other_recruiters,$current_applications_results,$ideal_career,$why_left_last_job,$desired_companies,$who_met_with,$most_important_career_factor,$industry_observations,$biggest_complaint,$biggest_job_hurdles,$continuing_education])
) {
    $tmp = 'yes';

    //  echo "New record created successfully";
} else {
      //die( "Error: " . $sql . "<br>" . $conn->error);
  //$data_sib = array('error' => "SQL Error: " . $sql . "<br>" . $conn->error );
    $data_sib = array('error' => "WTRF Error: " . $sql . "<br>"  );
}

}

$conn->close();

//SEND IN BLUE
$mailin = new Mailin("https://api.sendinblue.com/v2.0",APIKEY_SENDINBLUE);


/* TEST/ADD TO MAILCHIMP */
$listid = '0';
$listid_sib = '0';

switch($contact_source){
    case "securityjobsnearme.com":
    $listid = 'a77f35c589';
    $listid_sib = 8;
    break;
    case "infosecjobsnearme.com":
    $listid = '2705feafe9';
    $listid_sib = 10;
    break;

    case "investigationjobsnearme.com":
    $listid = '8c598b5282';
    $listid_sib = 9;
    break;
    case "cybersecurityjobsnearme.com":
    $listid = '9bdeecb79d';
    $listid_sib = 11;
    break;
}

if($listid_sib != '0'){
    $merge_fields = new stdClass();
    $merge_fields->FNAME = $first_name;
    $merge_fields->LNAME = $last_name;
    $merge_fields->ZIP  = $zip;
    $merge_fields->PHONE  = $phone;
    $merge_fields->SALARY_REQ  = $salary_range;
    $merge_fields->INDUSTRY  = $industry;
    /*
    $data = array(
      'fields' => 'lists',
      'email_address' => $email,
      'merge_fields' => $merge_fields,
      'status' => 'subscribed'
      );
    */
    $data_sib = array( "email" => $email,
                      "attributes" => array("FIRSTNAME"=>$first_name, 
                                            "LASTNAME"=>$last_name,
                                            "SMS"=>'+1'.$phone,
                                            "ZIP"=>$zip,
                                            "SALARY_REQ"=>$salary_range,
                                            "INDUSTRY"=>$industry),
                      "listid" => array($listid_sib)
                  );
    //ADD TO SENDINBLUE LIST
    $mailin->create_update_user($data_sib);

//    $endpoint = '/lists/'.$listid.'/members/';
 //   $result = json_decode( er_mailchimp_curl_connect( $endpoint, 'POST', $apikey_mailchimp, $data) );

    //notify chris
    $msg = 'check http://eyerecruit.com/__lists/seeker-leads/ for details on '.$first_name.' '.$last_name.' who subscribed from '.$contact_source;
    $headers[] = 'From: noreply@eyerecruit.com';
    $to_email = 'jeremy@interfusedcreative.com';
    //\$to_email = 'chris.bauer@eyerecruit.com';
    mail ( $to_email , 'new subscriber from secondary domain' , $msg, implode("\r\n", $headers) );
}



//
echo json_encode($data_sib);

?>
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

$data_sib = array();


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

// Check connection
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
    $data_sib = array('error' => 'DB connection failed');
//    throw new Exception('DB connection!');
}else{
    //insert record
    extract($_REQUEST);
    
/*
    $last_name = addslashes($_POST['last_name']);
    $first_name = addslashes($_POST['first_name']);

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
        $sql = 'DELETE FROM `__leads-seeker` WHERE `__leads-seeker`.`id` = '.$deleteID;

if ($conn->query($sql) === TRUE) {
    $tmp = 'yes';
    $data_sib = array('message' => "Deleted " );
    //  echo "New record created successfully";
} else {
      //die( "Error: " . $sql . "<br>" . $conn->error);
  $data_sib = array('error' => "SQL Error: " . $sql . "<br>" . $conn->error );
}

}

$conn->close();



//
echo json_encode($data_sib);

?>
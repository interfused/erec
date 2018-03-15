<?php
require_once('config.php');
$data = array();
$uploadfile_url = '';
$uploaddir = 'uploads/'  ;
        

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
    $user_note = addslashes($_POST['user_note']);
    $first_name = addslashes($_POST['first_name']);

    $sql = "INSERT INTO `__leads-seeker-notes` (`user_id`,`user_note`) VALUES ( 
        '$user_id',
        '$user_note'
        )";

if ($conn->query($sql) === TRUE) {
    $tmp = 'yes';
    $data = array('success' => "New record created successfully" );
    //  echo "New record created successfully";
} else {
      //die( "Error: " . $sql . "<br>" . $conn->error);
  $data = array('error' => "SQL Error: " . $sql . "<br>" . $conn->error );
}

}

$conn->close();

echo json_encode($data);

?>
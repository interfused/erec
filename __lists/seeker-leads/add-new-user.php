<?php
//ADD NEW USER
require_once('config.php');

//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
   // throw new Exception('Request method must be POST!');
  header('HTTP/1.1 500 Internal Server Booboo');
  header('Content-Type: application/json; charset=UTF-8');
  die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}

//CREATE and upload to ENCODED EMAIL FOLDER
          $uploaddir = 'resumes/'  ;
          $uploadfile = $uploaddir . time() .'-' . basename($_FILES['resume']['name']);
          $uploadfile_url = 'http://eyerecruit.com/__lists/seeker-leads/' . $uploadfile;

$data = array();
$error = false;
$files = array();

if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadfile)) {
  //success
  $error=false;
  $files[] = $uploadfile_url;
}else
        {
            $error = true;
        }

if($error){
  $data = array('error' => 'There was an error uploading your files');
}else{
    $data = array('success' => 'Form was submitted', 'formData' => $_POST, 'files' => $files);
}

echo json_encode($data);

/*
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

*/

//Process the JSON.
//open sql connection

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
//    throw new Exception('DB connection!');
}


?>
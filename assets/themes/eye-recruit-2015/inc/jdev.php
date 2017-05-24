<?php


header("access-control-allow-origin: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("HTTP/1.0 200 OK");

$msg='nothing else before this so this should go out. ';
$msg .= '<br>SERVER REQ MODE: '.$_SERVER['REQUEST_METHOD'];
/*
if($_POST){
	$msg .= '<br> has post vars: ';
}

if($_GET['email']){
	$msg .= '<br> has GET vars: '.$_GET['email'];
}
*/
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: NO-REPLY <no-reply@eyerecruit.com>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";


mail('jeremy@interfusedcreative.com','jdev php called',$msg,$headers);
/*
$msg = print_r($_POST, true);
mail('jeremy@interfused-inc.com','jdev php after called',$msg);
*/

?>
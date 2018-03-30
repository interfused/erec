<?php

function er_mailchimp_curl_connect( $endpoint, $request_type, $apikey_mailchimp = 'asdf', $data = array() ) {
  
  //Mailchimp API key (temporarily hardcoded)
  $apikey_mailchimp = '2360afdcdb2d2bc836937fcb959d4067-us14';
  //a77f35c589  : security jobs near me (updated)
  $server = 'us14';

  $url = 'https://' . substr($apikey_mailchimp,strpos($apikey_mailchimp,'-')+1) . '.api.mailchimp.com/3.0/'.$endpoint;

  if( $request_type == 'GET' )
    $url .= '?' . http_build_query($data);
 

  $mch = curl_init();
  $headers = array(
    'Content-Type: application/json',
    'Authorization: Basic '.base64_encode( 'user:'. $apikey_mailchimp )
  );
  curl_setopt($mch, CURLOPT_URL, $url );
  curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
  //curl_setopt($mch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
  curl_setopt($mch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
  curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type); // according to MailChimp API: POST/GET/PATCH/PUT/DELETE
  curl_setopt($mch, CURLOPT_TIMEOUT, 10);
  curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
 
  if( $request_type != 'GET' ) {
    curl_setopt($mch, CURLOPT_POST, true);
    curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
  }
 
  return curl_exec($mch);
}

?>
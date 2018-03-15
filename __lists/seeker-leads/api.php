<?php
/*
https://developer.mailchimp.com/documentation/mailchimp/guides/get-started-with-mailchimp-api-3/
*/
//Mailchimp API key
$apikey_mailchimp = '2360afdcdb2d2bc836937fcb959d4067-us14';
//a77f35c589  : security jobs near me (updated)
$server = 'us14';


function er_mailchimp_curl_connect( $endpoint, $request_type, $apikey_mailchimp, $data = array() ) {
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



/*
//GET LIST EXAMPLE
$data = array(
  'fields' => 'lists'
);

$endpoint = '/lists';

$result = json_decode( er_mailchimp_curl_connect( $endpoint, 'GET', $apikey_mailchimp, $data) );
echo '<pre>';
print_r( $result);
echo '</pre>';

if( !empty($result->lists) ) {
  echo '<select>';
  foreach( $result->lists as $list ){
    echo '<option value="' . $list->id . '">' . $list->name . ' (' . $list->stats->member_count . ')</option>';
    // you can also use $list->date_created, $list->stats->unsubscribe_count, $list->stats->cleaned_count or vizit MailChimp API Reference for more parameters (link is above)
  }
  echo '</select>';
} elseif ( is_int( $result->status ) ) { // full error glossary is here http://developer.mailchimp.com/documentation/mailchimp/guides/error-glossary/
  echo '<strong>' . $result->title . ':</strong> ' . $result->detail;
}

*/

/////ADD SUBSCRIBER EXAMPLE 
/*
$merge_fields = new stdClass();
$merge_fields->FNAME = 'test';
$merge_fields->LNAME = 'guy';
$merge_fields->ZIP  = '33325';
$merge_fields->PHONE  = '305-555-5555';

$data = array(
  'fields' => 'lists',
  'email_address' => 'jeremytest2@eyerecruit.com',
  'merge_fields' => $merge_fields,
  'FNAME' => 'test',
  'status' => 'subscribed'
);

$listid = 'a77f35c589';

$endpoint = '/lists/'.$listid.'/members/';

$result = json_decode( er_mailchimp_curl_connect( $endpoint, 'POST', $apikey_mailchimp, $data) );
echo '<pre>';
print_r( $result);
echo '</pre>';

if(!empty($result->id)){
  echo '<h1>Successfully added to list</h1>';
}
*/
?>
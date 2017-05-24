<?php
/**
 * Plugin Name: EyeRecruit Utility Plugin
 * Plugin URI: http://www.eyerecruit.com
 * Description: This is a utility plugin for eyerecruit.com
 * Version: 1.0

 */



/*
 * Create a class for pilotpress api
*/
class PilotPressApi{

  private $app_id; 
  private $api_key;
  private $request;
  private $postargs;

  function __construct(){
    global $wpdb;
    $query = "SELECT option_value FROM $wpdb->options WHERE option_name = 'pilotpress-settings'";     
    $result = $wpdb->get_var($query);
    if($result){
      $unserialized = unserialize($result); 
      $this->app_id = $unserialized['app_id'];
      $this->api_key = $unserialized['api_key'];
    }
  }

  private function setRequest($request){
    switch($request){
      case 'contact':
        $this->request = 'https://api.ontraport.com/cdata.php';
      break;
    }
  }

  private function buildPostArgs($reqType, $data){
    $postargs = 'appid=' . $this->app_id . '&key=' . $this->api_key . '&return_id=1&reqType=' . $reqType . '&data=' . $data; 
    $this->postargs = $postargs;
  }

  private function executeRequest(){
    $startTime = microtime(true);
    $session = curl_init($this->request);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $this->postargs);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($session);
    curl_close($session);

    //elapsed time
    $message = "Elapsed time to execute OAP api request: " . (microtime(true) - $startTime) . " seconds\r\n";
    //error_log($message, 3, "/var/tmp/mc-error.log");

    return $response;
  }

  private function parseXml($xml){
    $parsed = new SimpleXMLElement($xml);
    return $parsed;
  }

  public function fetchContact($contact_id){
    $meta = '<contact_id>' . $contact_id . '</contact_id>';
    $data = urlencode(urlencode($meta));
    $reqType = 'fetch';
    $this->setRequest('contact');
    $this->buildPostArgs($reqType, $data);

    //execute request
    $record = $this->executeRequest();
    $contact = $this->parseXml($record);
    return $contact;
  }

}

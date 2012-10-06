<?php

$API_KEY = 'example';
$REQUEST_URL = 'https://api.change.org/v1/petitions/get_id';
$PETITION_URL = 'http://www.change.org/petitions/dunkin-donuts-stop-using-styrofoam-cups-and-switch-to-a-more-eco-friendly-solution';

$parameters = array(
  'api_key' => $API_KEY,
  'petition_url' => $PETITION_URL
);

$query_string = http_build_query($parameters);
$final_request_url = "$REQUEST_URL?$query_string";
$response = file_get_contents($final_request_url);

$json_response = json_decode($response, true);
$petition_id = $json_response['petition_id'];
echo $petition_id;

?>
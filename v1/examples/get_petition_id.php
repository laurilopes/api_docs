<?php

$API_KEY = 'example';   // Omitted
$SECRET = 'example';    // Omitted

$REQUEST_BASE_URL = 'https://api.change.org';
$REQUEST_PATH = '/v1/petitions/get_id';

$parameters = array(
        'api_key' => $API_KEY,
        'timestamp' => gmdate("Y-m-d\TH:i:s\Z"), // UTC time in ISO-8601 format
        'petition_url' => 'http://www.change.org/petitions/dunkin-donuts-stop-using-styrofoam-cups-and-switch-to-a-more-eco-friendly-solution',
        'endpoint' => $REQUEST_PATH
    );


$query_string = http_build_query($parameters);
$rsig = hash('sha256', $query_string . $SECRET);

$parameters['rsig'] = $rsig;
$query_string = http_build_query($parameters);

$final_request_url = "$REQUEST_BASE_URL$REQUEST_PATH?$query_string";
$response = file_get_contents($final_request_url);

$json_response = json_decode($response, true);
$petition_id = $json_response['petition_id'];
echo $petition_id;

?>
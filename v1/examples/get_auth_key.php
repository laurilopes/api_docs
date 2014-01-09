<?php
  $api_key = 'my_api_key';
  $secret_token = 'my_secret_token';
  $petition_id = 123456;

  $host = 'https://api.change.org';
  $endpoint = "/v1/petitions/$petition_id/auth_keys";
  $request_url = $host . $endpoint;

  $params = array();
  $params['api_key'] = $api_key;
  $params['source_description'] = 'This is a test description.'; // Something human readable.
  $params['source'] = 'test_source'; // Eventually included in every signature submitted with the auth key obtained with this request.
  $params['requester_email'] = 'example@example.com'; // The email associated with your API key and Change.org account.
  $params['timestamp'] = gmdate("Y-m-d\TH:i:s\Z"); // ISO-8601-formtted timestamp at UTC
  $params['endpoint'] = $endpoint;

  // Build request signature and add it as a parameter
  $query_string_with_secret_and_auth_key = http_build_query($params) . $secret_token;
  $params['rsig'] = hash('sha256', $query_string_with_secret_and_auth_key);

  // Final request body
  $query = http_build_query($params);

  // Make the request
  $curl_session = curl_init();
  curl_setopt_array($curl_session, array(
    CURLOPT_POST => 1,
    CURLOPT_URL => $request_url,
    CURLOPT_POSTFIELDS => $query,
    CURLOPT_RETURNTRANSFER => true
  ));

  $result = curl_exec($curl_session);
  $result = curl_exec($curl_session);
  $json_response = json_decode($result, true);
  print_r($json_response);

?>
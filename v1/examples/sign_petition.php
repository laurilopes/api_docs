<?php
  // Set my API key and secret token.
  $api_key = 'my_api_key';
  $secret = 'my_secret_token';

  // Set my authorization key for petition with Change.org ID 12345.
  $petition_auth_key = 'my_petition_auth_key';
  $petition_id = 12345;

  // Set up the endpoint and URL.
  $base_url = "https://api.change.org";
  $endpoint = "/v1/petitions/$petition_id/signatures";
  $url = $base_url . $endpoint;

  // Set up the signature parameters.
  $parameters = array();
  $parameters['api_key'] = $api_key;
  $parameters['timestamp'] = gmdate("Y-m-d\TH:i:s\Z"); // ISO-8601-formtted timestamp at UTC
  $parameters['endpoint'] = $endpoint;
  $parameters['source'] = 'test.com';
  $parameters['email'] = 'person@example.com';
  $parameters['first_name'] = 'John';
  $parameters['last_name'] = 'Doe';
  $parameters['address'] = '1 Market St';
  $parameters['city'] = 'Philadelphia';
  $parameters['state_province'] = 'PA';
  $parameters['postal_code'] = '19144';
  $parameters['country_code'] = 'US';

  // Build request signature.
  $query_string_with_secret_and_auth_key = http_build_query($parameters) . $secret . $petition_auth_key;
  
  // Add the request signature to the parameters array.
  $parameters['rsig'] = hash('sha256', $query_string_with_secret_and_auth_key);

  // Create the request body.
  $data = http_build_query($parameters);

  // POST the parameters to the petition's signatures endpoint.
  $curl_session = curl_init();
  curl_setopt_array($curl_session, array(
    CURLOPT_POST => 1,
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => $data
  ));
  $result = curl_exec($curl_session);

  // Output  the returned JSON result.
  echo $result;
?>

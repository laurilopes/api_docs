# Tutorials

## A Basic Request

In this example, we will add signatures to a petition with PHP using the 
`GET petitions/:petition_id/signatures` request.

### 1. Obtain an API key and secret token

Before you start using Change.org's API you will need an API key and secret
token. Obtain these by visiting
[change.org/developers](http://www.change.org/developers). Click on "Request
an API Key" and follow the instructions. You may need to verify the
email address associated with your account if you have not done so already.

Once you have an API key and secret token, let's declare them:

    $api_key = 'my_api_key';
    $secret = 'my_secret_token';

### 2. Get the petition ID and an authorization key

A petition authorization key is requied to add signatures to a petition. To
obtain one, use the  `POST /petitions/:petition_id/auth_keys` request or you
can request an authorization key directly on a petition's page on Change.org by
clicking on the "Request API access" link at the bottom, right above the
footer.

Once you have an authorization key for the specific petition to which you want
to add signatures, declare it:

    $petition_auth_key = 'my_petition_auth_key';

You'll also need to specify the petition by ID. (See  
[A Basic Request](a-basic-request.md) on how to obtain a petition's
unique Change.org ID.)

    $petition_id = 12345;

### 3. Set the endpoint

With the petition ID, we can set the endpoint to which we'll make the request.
We'll need to reference the path part of the URL separately later, so let's
declare it as a separate variable, `$endpoint`.

    $base_url = "https://api.change.org";
    $endpoint = "/v1/petitions/$petition_id/signatures";
    $url = $base_url . $endpoint;

### 4. Set the signature values

Now, let's set up the parameters that we're going to submit as a petition
signature.

Every API request requires the public API key as a parameter. Let's declare that as
the first parameter:

    $parameters = array();
    $parameters['api_key'] = $api_key;

Then, let's declare all of the signature parameters -- check the docs to find
out which are required and which are optional:

    $parameters['source'] = 'test.com';
    $parameters['email'] = 'person@example.com';
    $parameters['first_name'] = 'John';
    $parameters['last_name'] = 'Doe';
    $parameters['address'] = '1 Market St';
    $parameters['city'] = 'Philadelphia';
    $parameters['state_province'] = 'PA';
    $parameters['postal_code'] = '19144';
    $parameters['country_code'] = 'US';

### 5. Add the parameters required to construct the request signature

To validate a request to add a signature to a petition, a _request signature_
(not be confused with a _petition's_ signature) must also be appended as a
parameter.

A `timestamp` and `endpoint` must be added as additional parameters
first in order to construct the request signature. These help to prevent
against request hijacking:

    $parameters['timestamp'] = gmdate("Y-m-d\TH:i:s\Z"); // ISO-8601-formtted timestamp at UTC
    $parameters['endpoint'] = $endpoint;

### 6. Construct the request signature

To construct the request signature, we get the URL-encoded parameters that we
will be submitting as the `POST` request body and append our secret token and
petition authorization key.

    $query_string_with_secret_and_auth_key = http_build_query($parameters) . $secret . $petition_auth_key;

Then we create a 256-bit SHA-2 digest of the result and add it as a parameter,
`rsig`.

    $parameters['rsig'] = hash('sha256', $query_string_with_secret_and_auth_key);

### 7. Send the request to add a signature

Finally, we set up the `POST` request body:

    $data = http_build_query($parameters);

Then, we set up the cURL session:

    $curl_session = curl_init();
    curl_setopt_array($curl_session, array(
        CURLOPT_POST => 1,
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $data
    ));

And we make the request and output the result, which should be a JSON object
with a success result!

    $result = curl_exec($curl_session);
    echo $result;

[Download the full PHP script here.](../examples/sign_petition.php)

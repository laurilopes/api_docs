# Tutorials

## A Basic Request

In this example, we will construct a simple PHP script to get the unique
Change.org ID of a petition using the `petitions/get_id` request.

### 1. Obtain an API key and secret token

Before you start using Change.org's API you will need an API key and secret
token. Obtain these by visiting
[change.org/developers](http://www.change.org/developers).
Click on "Request an API Key" and follow the instructions on screen. You may
need to verify the email address associated with your account if you have not
done so already.

Let's start by declaring the API key and secret token at the top of our
script:

    $API_KEY = 'example';
    $SECRET = 'example';

Then let's also specify the base URL and path that will eventually be used to make
the request.

    $REQUEST_BASE_URL = 'https://api.change.org';
    $REQUEST_PATH = '/v1/petitions/get_id';

### 2. Determine the clear-text parameters of your request

Every Change.org request requires the following parameters:

* `api_key`
* `timestamp`
* `endpoint`
* `rsig`

The `api_key` is the key you obtained in Step 1. The `timestamp` should be
the current time at UTC in an ISO-8601-formatted timestamp. The `endpoint` is the path to
which the request is sent, which we declared in `$REQUEST_PATH`. `rsig`
should be constructed as described in Step 3.

`petitions/get_id` requests take one additional parameter,
`petition_url`, which is the URL of the petition for which we want to get the
unique Change.org ID. In this example, we'll get the petition ID for this
[petition](http://www.change.org/petitions/dunkin-donuts-stop-using-styrofoam-cups-and-switch-to-a-more-eco-friendly-solution).

Let's make an associate array of the parameters for this request:

    $parameters = array(
        'api_key' => $API_KEY,
        'timestamp' => gmdate("Y-m-d\TH:i:s\Z"), // UTC time in ISO-8601 format
        'petition_url' => 'http://www.change.org/petitions/dunkin-donuts-stop-using-styrofoam-cups-and-switch-to-a-more-eco-friendly-solution',
        'endpoint' => $REQUEST_PATH
    );

### 3. Construct your request signature

Next, we'll need to construct the request signature and add it to the request as
the parameter `rsig`.

This is done by taking the body of the request, or in the case of a `GET`
request, the query string, then appending the secret token, and creating
a SHA-2 digest from that.

First, we create the query string:

    $query_string = http_build_query($parameters);

Then we add the secret token to the end of it and create a 256-bit SHA-2
hexadecimal digest of the result:

    $rsig = hash('sha256', $query_string . $SECRET);

### 4. Construct your final request

Now we need to rebuild the query string with the request signature as an
additional parameter, `rsig`:

    $parameters['rsig'] = $rsig;
    $query_string = http_build_query($parameters);

### 5. Submit the request and parse the results

The last step is to submit the request and parse the results!

We create the final request URL, with the domain, path, and query string:

    $final_request_url = "$REQUEST_BASE_URL$REQUEST_PATH?$query_string";

Then we submit the request:

    $response = file_get_contents($final_request_url);

Finally, we parse the response into an associative array and output the
`petition_id` returned:

    $json_response = json_decode($response, true);
    $petition_id = $json_response['petition_id'];
    echo $petition_id; // 132448

[Download the full PHP script here.](../examples/get_petition_id.php)

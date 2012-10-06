# Tutorials

## A Basic Request

In this example, we will construct a simple PHP script to get the unique
Change.org ID of a petition using the `petitions/get_id` request.

### 1. Obtain an API key and petition URL

Before you start using Change.org's API you will need an API key. Obtain one
by visiting [change.org/developers](http://www.change.org/developers).
Click on "Request an API Key" and follow the instructions on screen. You may
need to verify the email address associated with your account if you have not
done so already.

Let's start by declaring the API key and endpoint to which we will make the
request at the top of our script:

    $API_KEY = 'example';
    $REQUEST_URL = 'https://api.change.org/v1/petitions/get_id';

Then let's also specify the petition whose ID we are attempting to get. In
this example, we'll get the petition ID for
[this petition](http://www.change.org/petitions/dunkin-donuts-stop-using-styrofoam-cups-and-switch-to-a-more-eco-friendly-solution).
    
    $PETITION_URL = 'http://www.change.org/petitions/dunkin-donuts-stop-using-styrofoam-cups-and-switch-to-a-more-eco-friendly-solution';

### 2. Declare the clear-text parameters of your request

Every Change.org request requires the `api_key` as a parameter.
`petitions/get_id` requests take one additional parameter,
`petition_url`, which is the URL of the petition for which we want to get the
unique Change.org ID.

Let's make an associate array of the parameters for this request:

    $parameters = array(
        'api_key' => $API_KEY,
        'petition_url' => $PETITION_URL
    );

### 3. Construct your final request

Now we'll build the query string:

    $query_string = http_build_query($parameters);

Then create the final request URL, with the endpoint and query string:

    $final_request_url = "$REQUEST_URL?$query_string";

Finally, we submit the request:

    $response = file_get_contents($final_request_url);

We parse the response into an associative array and output the
`petition_id` that was returned:

    $json_response = json_decode($response, true);
    $petition_id = $json_response['petition_id'];
    echo $petition_id; // 132448

[Download the full PHP script here.](../examples/get_petition_id.php)

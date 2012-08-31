# Requests

All requests are made on a specific API resource:

    https://api.change.org/v1/[resource]

The clear-text parameters in each requests must be accompanied by three
additional parameters: an _API key_, a _request signature_, and a _timestamp_.
The request signature is generated using a _secret token_, a _timestamp_, and,
in some cases, a _petition authorization key_. Requests to modify or update a
petition (e.g. signatures) require a petition authorization key, whereas
requests for information do not.

## Content Type

The body of POST and PUT requests, including any relevant parameters, can be
formatted as URL-encoded form data or Javascript Object Notation (JSON). The
format is specified in the `Content-Type` HTTP header of a request.

The API assumes that the body of a request is URL-encoded form data unless a
`Content-Type` header is specified. The following Content-Type headers are
accepted:

<table>
    <thead>
        <th>Format</th>
        <th>MIME Type</th>
    </thead>
    <tbody>
        <tr>
            <td>URL-encoded form data</td>
            <td><code>application/x-www-form-urlencoded</code></td>
        </tr>
        <tr>
            <td>JSON</td>
            <td><code>application/json</code></td>
        </tr>
    </tbody>
</table>

## Request Validation

### Timestamp

Every request must include a timestamp parameter with the current date and time
in ISO 8601 format. This parameter is sent in clear text for verification
and included in the request signature as a salt. Requests submitted more than 5
minutes before or after the date and time indicated by the timestamp will be
rejected.

### Endpoint

The endpoint -- the path to which the HTTP request is made -- is included only
as a parameter in the request signature as a salt.

### Request Signature

Every request must include a request signature parameter, appended to the
clear-text parameters as rsig. This ensures that the request originated from an
authorized API user and, if applicable, that the user is authorized to perform
the requested action.

The request signature consists of the hexadecimal SHA-2 digest of the
alphabetized parameters in URL-encoded query string format. The parameters used
to construct the signature are all those that are required for the specific
request, including the API key, along with the requestor’s secret token, the
timestamp, the endpoint, and, if applicable, the relevant petition authorization
key.

#### Request Signature Parameters
<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Example</th>
    </thead>
    <tbody>
        <tr>
            <td><code>api_key</code></td>
            <td><code>string</code></td>
            <td>The user’s API key.</td>
            <td><code>754a28309b20012f479b109add670a2c</code></td>
        </tr>
        <tr>
            <td><code>secret</code></td>
            <td><code>string</code></td>
            <td>The API user’s secret token.</td>
            <td><code>003af2309b1f012f479b109add670a2c</code></td>
        </tr>
        <tr>
            <td><code>timestamp</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                The timestamp of the request:
                <code>YYYY-MM-DDThh:mmTZD</code>
            </td>
            <td><code>2012-04-18T21:02-07:00</code></td>
        </tr>
        <tr>
            <td><code>endpoint</code></td>
            <td><code>string</code></td>
            <td>The path of the endpoint to which the API request is sent.</td>
            <td><code>/v1/petitions/48503</code></td>
        </tr>
        <tr>
            <td><code>auth_key</code></td>
            <td><code>string</code></td>
            <td>(If applicable) The petition authorization key.</td>
            <td><code>309b20754a2809add670a2c012f479b1</code></td>
        </tr>
        <tr>
            <td><em>varies</em></td>
            <td><em>varies</em></td>
            <td>All other clear-text parameters for the specific request.</td>
            <td><code>api_key=754a28309b20012f479b109add670a2c&amp;page=2&amp;page_size=10&amp;petition_id=4832</code></td>
        </tr>
    </tbody>
</table>

For example, when making a call to retrieve information about a petition, the
clear-text parameters would be

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Example</th>
    </thead>
    <tbody>
        <tr>
            <td><code>api_key</code></td>
            <td><code>string</code></td>
            <td>The user’s API key.</td>
            <td><code>754a28309b20012f479b109add670a2c</code></td>
        </tr>
        <tr>
            <td><code>petition_id</code></td>
            <td><code>int</code></td>
            <td>The petition from which information should be retrieved.</td>
            <td><code>4832</code></td>
        </tr>
        <tr>
            <td><code>timestamp</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>The timestamp of the request: <code>YYYY-MM-DDThh:mmTZD</code></td>
            <td><code>2012-04-18T21:02-07:00</code></td>
        </tr>
    </tbody>
</table>  

In `petition/:petition_id` requests, note that although `petition_id` is
included as part of the request URL and not the query string, it is still
considered a parameter. The signature is generated from the parameters above
along with the user’s secret token, the endpoint, and a timestamp. In this
example, no petition authorization key is needed since petition information
requests are not restricted.

As an example, to construct the request signature for this request, we start
with the clear-text parameters in alphabetical order by name:

    api_key=754a28309b20012f479b109add670a2c&petition_id=4832

The secret token and timestamp are then added, in alphabetical order, as
additional parameters. Then the whole string is URL-encoded:

    api_key=754a28309b20012f479b109add670a2c&endpoint=https%3A%2F%2Fapi.change.org%2Fv1%2Fpetitions%2F48503&petition_id=4832&secret=003af2309b1f012f479b109add670a2c&timestamp=2012-04-18T21%3A02-07%3A00

And the final request signature would be the SHA-2 digest of the string
above:

    1d12d0b923ecdbb4d5b1df8c7f2f1b3c2270bc6e538bbf5d32611d3429c1b310

The signature is then appended as a parameter, `rsig`, to the clear-text query
string. So the full request and return value would be

    GET https://api.change.org/v1/petitions/4832?api_key=754a28309b20012f479b109add670a2c&rsig=1d12d0b923ecdbb4d5b1df8c7f2f1b3c2270bc6e538bbf5d32611d3429c1b310&timestamp=2012-04-18T21%3A02-07%3A00

    => {    
            "title": "Ask Starfleet to Add a Purple Uniform",
            "url": "http://www.change.org/petitions/ask-starfleet-to-add-a-purple-uniform",
            "overview": "The current three colors are getting old. Additional colors, such as purple, would be a welcome change!",
            [...]
        }

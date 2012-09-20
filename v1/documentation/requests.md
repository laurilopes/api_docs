# Requests

All requests are made on a specific API resource:

    https://api.change.org/v1/[resource]

## Content Type

The body of `POST` and `PUT` requests, including any relevant parameters, can be
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

The parameters in each request must always be accompanied by four
additional parameters: an _API key_, an _endpoint_, a _timestamp_, and a
_request signature_. The request signature (detailed below) is generated
by using the API user's _secret token_ and, in some cases, a
_petition authorization key_.

### API Key

See [_Authentication_](authentication.md) for more information about API keys.

### Endpoint

The `endpoint` -- the path to which the HTTP request is made -- ensures that
the request was sent to the intended enpoint since the request signature is
generated with this value and checked against the actual request path. This
mitigates against "man in the middle" attacks.

Example:

    /v1/petitions/291810

### Timestamp

Every request must include a `timestamp` parameter with the current date and time
at UTC in ISO 8601 format. This mitigates against "replay"
attacks. Requests submitted more than 5 minutes before or after the date and
time indicated by the timestamp will be rejected.

Example:

    2012-06-08T00:46:16Z

### Request Signature

Every request must include a request signature parameter, appended to the
clear-text parameters as `rsig`. This ensures that the request originated from an
authorized API user and, if applicable, that the user is authorized to perform
the requested action.

The request signature is a 256-bit hexadecimal SHA-2 digest of the
`POST` body or `GET` query string appended with the user's secret token and,
for requests that require it, the resource authorization key.

#### Constructing Request Signatures

To construct a request signature, the components are ordered as follows:

    [POST body or GET query string][secret token][authorization key, if applicable]

Then, a 256-bit SHA-2 digest is created of that resulting string. This is
then passed as a parameter, `rsig`.

##### Example Request Signature

For example, when making a call to retrieve information about a petition, the
clear-text parameters would be

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Example</th>
    </thead>
    <tbody>
        <tr>
            <td><code>api_key</code></td>
            <td><code>754a28309b20012f479b109add670a2c</code></td>
        </tr>
        <tr>
            <td><code>timestamp</code></td>
            <td><code>2012-04-18T21:02:00Z</code></td>
        </tr>
        <tr>
            <td><code>endpoint</code></td>
            <td><code>/v1/petitions/4832</code></td>
        </tr>
    </tbody>
</table>  

The request signature is generated from the query string of this `GET` request
along with the user's secret token. In this example, no petition authorization
key is needed since petition information requests are not restricted.

To construct the request signature, we take the query string:

    api_key=754a28309b20012f479b109add670a2c&endpoint=%2Fv1%2Fpetitions%2F48503&timestamp=2012-04-18T21%3A02-07%3A00

Then the [secret token](authentication.md), in this case `003af2309b1f012f479b109add670a2c` is
appended to the end of the string

    api_key=754a28309b20012f479b109add670a2c&endpoint=%2Fv1%2Fpetitions%2F48503&timestamp=2012-04-18T21%3A02-07%3A00003af2309b1f012f479b109add670a2c

And the final request signature would be the 256-bit SHA-2 digest of the string
above:

    ac0889ce480e30151c08613093868d22e30d4fcb60cc42089313e9d6ccc5bcbc

The signature is then appended as another parameter, `rsig`, to the clear-text
query string. So the full request and return value would be

    GET https://api.change.org/v1/petitions/4832?api_key=754a28309b20012f479b109add670a2c&endpoint=%2Fv1%2Fpetitions%2F48503&timestamp=2012-04-18T21%3A02-07%3A00&rsig=ac0889ce480e30151c08613093868d22e30d4fcb60cc42089313e9d6ccc5bcbc
    => {    
            "title": "Ask Starfleet to Add a Purple Uniform",
            "url": "http://www.change.org/petitions/ask-starfleet-to-add-a-purple-uniform",
            "overview": "The current three colors are getting old. Additional colors, such as purple, would be a welcome change!",
            [...etc...]
        }

## Request Parameters

The following table summarizes the paramters required for every request:

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
            <td>The user's API key.</td>
            <td><code>754a28309b20012f479b109add670a2c</code></td>
        </tr>
        <tr>
            <td><code>endpoint</code></td>
            <td><code>string</code></td>
            <td>The path of the endpoint to which the API request is sent.</td>
            <td><code>/v1/petitions/48503</code></td>
        </tr>
        <tr>
            <td><code>timestamp</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                The timestamp of the request:
                <code>YYYY-MM-DDThh:mm:ssZ</code>
            </td>
            <td><code>2012-04-18T21:02:00Z</code></td>
        </tr>
        <tr>
            <td><code>rsig</code></td>
            <td><code>string</code></td>
            <td>
                A 256-bit SHA-2 hexadecimal digest of the <code>POST</code>
                body or <code>GET</code> query string, appended with the secret token
                and, if applicable, the resource authorization key.
            </td>
            <td><code>ac0889ce480e30151c08613093868d22e30d4fcb60cc42089313e9d6ccc5bcbc</code></td>
        </tr>
        <tr>
            <td><em>varies</em></td>
            <td><em>varies</em></td>
            <td>All other clear-text parameters for the specific request.</td>
            <td></td>
        </tr>
    </tbody>
</table>

## Rate Limits

A maximum of 50,000 requests per day using the same API key are allowed. A
maximum of 10,000 requests per day using the same petition authorization key are
allowed.

Upon special request and coordination with Change.org, these limits may be
lifted.

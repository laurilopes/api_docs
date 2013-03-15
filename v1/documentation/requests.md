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

The parameters in each request must always be accompanied by an _API key_.
Three additional parameters must be included on all requests that modify or
update a resource: an _endpoint_, a _timestamp_, and a _request signature_.
The request signature (detailed below) is generated
by using the API user's _secret token_ and a
_resource authorization key_.

### API Key

See [_Authentication_](authentication.md) for more information about API keys.

### Endpoint

Requests that require a request signature require an `endpoint` parameter.
The `endpoint` -- the path to which the HTTP request is made -- ensures that
the request was sent to the intended enpoint since the request signature is
generated with this value and checked against the actual request path. This
mitigates against "man in the middle" attacks.

Example:

    /v1/petitions/291810

### Timestamp

Requests that require a request signature require a `timestamp`
parameter, which is the current date and time at UTC in ISO 8601 format.
This mitigates against "replay" attacks. Requests submitted more than 5
minutes before or after the date and time indicated by the timestamp will
be rejected.

Example:

    2012-06-08T00:46:16Z

### Request Signature

The request signature parameter, appended to the clear-text parameters as
`rsig`, ensures that the request originated from an authorized API user and,
if applicable, that the user is authorized to perform the requested action.

The request signature is a 256-bit hexadecimal SHA-2 digest of the
`POST` body or `GET` query string appended with the user's secret token and,
for requests that require it, the resource authorization key.

#### Constructing Request Signatures

To construct a request signature, the components are ordered as follows:

    [POST body or GET query string][secret token][authorization key, if applicable]

Then, a 256-bit SHA-2 digest is created of that resulting string. This is
then passed as a parameter, `rsig`.

##### Example Request Signature

For example, when making a request to add a signature to a petition, whose
petition_id is 4832, the clear-text parameters would be

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
        <tr>
            <td><code>source</code></td>
            <td><code>http://www.myblog.com/posts/a-post-about-a-petition</code></td>
        </tr>
        <tr>
            <td><code>email</code></td>
            <td><code>dtroi@betazoids.net</code></td>
        </tr>
        <tr>
            <td><code>first_name</code></td>
            <td><code>Deanna</code></td>
        </tr>
        <tr>
            <td><code>last_name</code></td>
            <td><code>Troi</code></td>
        </tr>
        <tr>
            <td><code>address</code></td>
            <td><code>3 Broadway</code></td>
        </tr>
        <tr>
            <td><code>city</code></td>
            <td><code>New York</code></td>
        </tr>
        <tr>
            <td><code>state_province</code></td>
            <td><code>NY</code></td>
        </tr>
        <tr>
            <td><code>postal_code</code></td>
            <td><code>12345</code></td>
        </tr>
        <tr>
            <td><code>country_code</code></td>
            <td><code>US</code></td>
        </tr>
    </tbody>
</table>  

The request signature is generated from the query string of this `POST` request
along with the user's secret token and petition authorization key.

To construct the request signature, we take the `POST` body:

    api_key=754a28309b20012f479b109add670a2c&endpoint=%2Fv1%2Fpetitions%2F4832%2Fsignatures&timestamp=2012-04-18T21%3A02-07%3A00&source=http%3A%2F%2Fwww.myblog.com%2Fposts%2Fa-post-about-a-petition&email=dtroi%40betazoids.net&first_name=Deanna&last_name=Troi&address=3%20Broadway&city=New%20York&state_province=NY&postal_code=12345&country_code=US

Then the [secret token](authentication.md), in this case 
`003af2309b1f012f479b109add670a2c`, and the authorization key, in this case
`b233f245f01666f479b179a1124701aa`, are appended to the end of the string:

    api_key=754a28309b20012f479b109add670a2c&endpoint=%2Fv1%2Fpetitions%2F4832%2Fsignatures&timestamp=2012-04-18T21%3A02-07%3A00&source=http%3A%2F%2Fwww.myblog.com%2Fposts%2Fa-post-about-a-petition&email=dtroi%40betazoids.net&first_name=Deanna&last_name=Troi&address=3%20Broadway&city=New%20York&state_province=NY&postal_code=12345&country_code=US003af2309b1f012f479b109add670a2cb233f245f01666f479b179a1124701aa

And the final request signature would be the 256-bit hexadecimal SHA-2 digest of the string
above:

    7c896c27b6368a8e564cb2d7f0e97b19344b05f651d1f41c8ef5be317a86c76a

The signature is then appended as another parameter, `rsig`, to the clear-text
body content. So the full request and return value would be

    POST https://api.change.org/v1/petitions/4832/signatures
    api_key=754a28309b20012f479b109add670a2c&endpoint=%2Fv1%2Fpetitions%2F4832%2Fsignatures&timestamp=2012-04-18T21%3A02-07%3A00&source=http%3A%2F%2Fwww.myblog.com%2Fposts%2Fa-post-about-a-petition&email=dtroi%40betazoids.net&first_name=Deanna&last_name=Troi&address=3%20Broadway&city=New%20York&state_province=NY&postal_code=12345&country_code=US&rsig=7c896c27b6368a8e564cb2d7f0e97b19344b05f651d1f41c8ef5be317a86c76a
    => [202 success message]

## Request Parameters

The following table summarizes the paramters required for requests:

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
            <td><em>(Requests with <code>rsig</code>)</em> The path of the endpoint to which the API request is sent.</td>
            <td><code>/v1/petitions/48503</code></td>
        </tr>
        <tr>
            <td><code>timestamp</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                <em>(Requests with <code>rsig</code>)</em> The timestamp of the request:
                <code>YYYY-MM-DDThh:mm:ssZ</code>
            </td>
            <td><code>2012-04-18T21:02:00Z</code></td>
        </tr>
        <tr>
            <td><code>rsig</code></td>
            <td><code>string</code></td>
            <td>
                <em>(For requests that create or modify a resource)</em> A 256-bit SHA-2 hexadecimal digest of the <code>POST</code>
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

## JSON-P

A `callback` parameter can be specified on any request and the resulting
response will be wrapped in the specified callback method.

## Rate Limits

In rare circumstances, during peak usage, Change.org may be required to impose
a modest limit on the number of requests submitted by an individual API user
(a developer). In such a case, Change.org will make an effort to contact the
API user before doing so.

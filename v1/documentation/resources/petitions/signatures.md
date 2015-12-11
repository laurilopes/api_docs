# Resources

## Signatures on Petitions

* [`GET petitions/:petition_id/signatures`](#get-signatures) (Deprecated)
* [`GET petitions/:petition_id/signatures/recent`](#get-signatures-recent)
* [`POST petitions/:petition_id/signatures`](#post-signatures)

<a name="get-signatures"></a>
### `GET petitions/:petition_id/signatures` (Deprecated)

<a name="get-signatures-recent"></a>
### `GET petitions/:petition_id/signatures/recent`

Returns an array of the 10 most recent signatures on a petition.

This is similar to

    petitions/:petition_id/signatures?page_size=10&sort=time_desc

but will not return pagination information or endpoints.

#### Request Parameters

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>petition_id</code></td>
            <td><code>int</code></td>
            <td>
                <em>(In URL)</em> The petition from which signatures should be
                retrieved.
            </td>
        </tr>
    </tbody>
</table>

<a name="post-signatures"></a>
### `POST petitions/:petition_id/signatures`

Adds a signature to a petition. **A request signature, is required for
this request.**

By adding signatures to a petition, the API user agrees to display the
following text and links directly above or below the signature form:

> This petition is powered by Change.org. By signing, you accept Change.org's
[terms of service](http://www.change.org/about/terms-of-service) and
[privacy policy](http://www.change.org/about/privacy).

#### Request Parameters

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>petition_id</code></td>
            <td><code>int</code></td>
            <td>
                <em>(In URL)</em> The petition to which a new signature should
                be added.
            </td>
        </tr>
        <tr>
            <td><code>auth_key</code></td>
            <td><code>string</code></td>
            <td>
                The petition authorization key.
            </td>
        </tr>
        <tr>
            <td><code>source</code></td>
            <td><code>string</code></td>
            <td>
                The source URL originally submitted to request the
                authorization key. (See <em><a href="auth_keys.md">Authorization
                Keys on Petitions</a></em>.)
            </td>
        </tr>
        <tr>
            <td><code>email</code></td>
            <td><code>string</code></td>
            <td>
                Email address of the signer.
            </td>
        </tr>
        <tr>
            <td><code>first_name</code></td>
            <td><code>string</code></td>
            <td>
                First name of the signer.
            </td>
        </tr>
        <tr>
            <td><code>last_name</code></td>
            <td><code>string</code></td>
            <td>
                Last name of the signer.
            </td>
        </tr>
        <tr>
            <td><code>address</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> Residential address of the signer.
            </td>
        </tr>
        <tr>
            <td><code>city</code></td>
            <td><code>string</code></td>
            <td>
                Residential city of the signer.
            </td>
        </tr>
        <tr>
            <td><code>state_province</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The standard abbreviation for the signer's state or province.
            </td>
        </tr>
        <tr>
            <td><code>postal_code</code></td>
            <td><code>string</code></td>
            <td>
                Postal code of the signer.
            </td>
        </tr>
        <tr>
            <td><code>country_code</code></td>
            <td><code>string</code></td>
            <td>
                Two-letter country code of the signer.
            </td>
        </tr>
        <tr>
            <td><code>phone</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> Mobile phone number of the signer.
            </td>
        </tr>
        <tr>
            <td><code>reason</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The signer’s reason for signing.
            </td>
        </tr>
        <tr>
            <td><code>hidden</code></td>
            <td><code>boolean</code></td>
            <td>
                <em>(Optional)</em> Whether or not the signer’s name will
                appear in the petition’s signature list and on their Change.org
                profile. If omitted, a signature is public by default.
                Accepted values are <code>true</code> and <code>false</code>.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

If the request is successful, the response will have an HTTP status code of 202
and a brief successful result message. If it is not successful for whatever
reason, the status code will vary depending on the circumstance. See
[_Response Codes_](../../responses.md).

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>result</code></td>
            <td><code>string</code></td>
            <td>
                Whether or not the signature was successfully queued for adding
                to the petition. Either <code>success</code> or
                <code>failure</code>.
            </td>
        </tr>
        <tr>
            <td><code>messages</code></td>
            <td><code>array</code></td>
            <td>
                <em>(If applicable)</em> An array of error messages.
            </td>
        </tr>
    </tbody>
</table>

Examples:

    POST https://api.change.org/v1/petitions/48503/signatures
    address=123%20Sesame%20St&auth_key=fb6dc0709b1e012f479b109add670a2c&city=New%20York&country=US&first_name=Hikaru&last_name=Sulu&phone=123-555-1234&postal_code=12345&state_province=NY
    => { "result": "success" }

    POST https://api.change.org/v1/petitions/48503/signatures
    => {
            "result": "failure",
            "messages": ["No signature data received."]
       }

_Note: A public API key is a required parameter on all requests, and a
timestamp, endpoint, and request signature are required on certain requests.
For readability, these parameters have been omitted from the tables and
examples above._

# Resources

## Signatures on Petitions

* [`GET petitions/:petition_id/signatures`](#get-signatures)
* [`GET petitions/:petition_id/signatures/recent`](#get-signatures-recent)
* [`POST petitions/:petition_id/signatures`](#post-signatures)

<a name="get-signatures"></a>
### `GET petitions/:petition_id/signatures`

Returns signatures on a petition.

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
                <em>(In URL)</em> The petition from which the targets should
                be retrieved.
            </td>
        </tr>
        <tr>
            <td><code>page_size</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em> The maximum number of signatures to return
                per request, but no more than 100. Returns a maximum of 10
                signatures if omitted.
            </td>
        </tr>
        <tr>
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em> The page offset by <code>page_size</code>
                signatures. Returns the first page by default if omitted.
            </td>
        </tr>
        <tr>
            <td><code>sort</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The order by which signatures will be
                returned. Accepted values are <code>time_asc</code> and 
                <code>time_desc</code>. Defaults to <code>time_asc</code>
                if omitted.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

An array of signatures. A maximum of `page_size` signatures will be returned,
offset by the `page` number given.

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>signature_count</code></td>
            <td><code>int</code></td>
            <td>
                The number of total signatures on this petition.
            </td>
        </tr>
        <tr>
            <td><code>prev_page_endpoint</code></td>
            <td><code>string</code></td>
            <td>
                The API endpoint that can be called to retrieve the previous
                page of signatures. <code>null</code> if there is no previous page.
            </td>
        </tr>
        <tr>
            <td><code>next_page_endpoint</code></td>
            <td><code>string</code></td>
            <td>
                The API endpoint that can be called to retrieve the next page
                of signatures. <code>null</code> if there is no next page.
            </td>
        </tr>
        <tr>
            <td><code>total_pages</code></td>
            <td><code>int</code></td>
            <td>
                The total number of pages of signatures (of size specified by
                <code>page_size</code>)
            </td>
        </tr>
        <tr>
            <td><code>signatures</code></td>
            <td><code>array</code></td>
            <td>
                The array of signatures.
            </td>
        </tr>
    </tbody>
</table>

The signatures array contains objects with the following data:

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>name</code></td>
            <td><code>string</code></td>
            <td>
                Full display name of the signer.
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
                <em>(If available)</em> State or province of the signer.
            </td>
        </tr>
        <tr>
            <td><code>country</code></td>
            <td><code>string</code></td>
            <td>
                Full country name of the signer.
            </td>
        </tr>
        <tr>
            <td><code>signed_on</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                Date and time of the signature.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/petitions/48503/signatures?&page_size=2&sort=time_desc
    => { 
        "signature_count": 6,
        "prev_page_endpoint": null,
        "next_page_endpoint": "https://https://api.change.org/v1/petitions/48503/signatures?page=2&page_size=2&sort=time_desc",
        "total_pages": 3,
        "signatures": [{
                "first_name": "Jean-Luc",
                "last_name": "Picard",
                "city": "Paris",
                "state_province": "",
                "country": "FR",
                "signed_on": "2012-02-15T23:39:31Z"
            },
            {
                "first_name": "William",
                "last_name": "Riker",
                "city": "San Francisco",
                "state_province": "CA",
                "country": "US",
                "signed_on": "2012-02-14T10:02:23Z"
            }]
        }

<a name="get-signatures-recent"></a>
### `GET petitions/:petition_id/signatures/recent`

Returns a maximum of the 10 most recent signatures on a petition. This is an
alias for

    petitions/:petition_id/signatures?page_size=10&sort=time_desc

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

Adds a signature to a petition. A petition authorization key is required for
this action.

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
                <em>(In request signature only)</em> The petition authorization
                key.
            </td>
        </tr>
        <tr>
            <td><code>source</code></td>
            <td><code>string</code></td>
            <td>
                The source code originally submitted to request the
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
                Residential address of the signer.
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
                State or province of the signer.
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
                profile. If omitted, a signatures is public by default.
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

_A public API key, timestamp, and request signature are required parameters on
all requests, so they are omitted from the tables and examples above._
# Resources

## Authorization Keys on Petitions

### `POST petitions/:petition_id/auth_keys`

Sends a request for a petition authorization key on behalf of an individual.

The requester must provide a source code, specified by `source`, for their 
request. This source code indicates where signatures (or other requests on the 
petition) are coming from. `source` must be unique for each requester, so URL 
would most often be a reasonable source code (e.g. a specific YouTube video).

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
                <em>(In URL)</em> The petition on which authorization is being
                requested.
            </td>
        </tr>
        <tr>
            <td><code>source_description</code></td>
            <td><code>string</code></td>
            <td>
                User defined. The type of media around which signatures will be 
                gathered. Example: <code>"YouTube video"</code>
            </td>
        </tr>
        <tr>
            <td><code>source</code></td>
            <td><code>string</code></td>
            <td>
                URL or other identifier of the source from which signatures will
                be gathered. Must be unique to the API consumer submitting the 
                request. Example: 
                <code>http://www.youtube.com/watch?v=bflYjF90t7c</code>
            </td>
        </tr>
        <tr>
            <td><code>requester_email</code></td>
            <td><code>string</code></td>
            <td>
                The email address of the individual requesting the petition 
                authorization key.
            </td>
        </tr>
        <tr>
            <td><code>callback_endpoint</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The URL to which updated information (outlined below) will
                be posted if the status of an authorization key changes.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

The following is the response data, including the newly-granted authorization
key. If the status of an authorization key changes (e.g. if authorization has
been revoked), this data will be posted to the URL specified
by `callback_endpoint`, which was optionally submitted in the original request.

An email is also sent to the email address specified by `requester_email`
if an authrorization key's status changes.

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>status</code></td>
            <td><code>string</code></td>
            <td>
                Whether or not the authorization key was granted. Possible
                values are <code>granted</code>, <code>denied</code>, or
                <code>revoked</code>.
            </td>
        </tr>
        <tr>
            <td><code>petition_id</code></td>
            <td><code>int</code></td>
            <td>
                The ID of the petition on which an authorization key was
                requested.
            </td>
        </tr>
        <tr>
            <td><code>source_description</code></td>
            <td><code>string</code></td>
            <td>
                The <code>source_description</code> originally submitted with
                this request.
            </td>
        </tr>
        <tr>
            <td><code>source</code></td>
            <td><code>string</code></td>
            <td>
                The <code>source</code> originally submitted with this request.
            </td>
        </tr>
        <tr>
            <td><code>requester_email</code></td>
            <td><code>string</code></td>
            <td>
                The <code>requester_email</code> originally submitted with this
                request.
            </td>
        </tr>
        <tr>
            <td><code>auth_key</code></td>
            <td><code>string</code></td>
            <td>
                The petition authorization key.
            </td>
        </tr>
    </tbody>
</table>

Example:

    POST https://api.change.org/v1/petitions/48503/auth_keys    
    {
        "source_description": "YouTube video",
        "source": "http://www.youtube.com/watch?v=AayLwwvn77s",
        "requester_email": "data@ent1701d.org",
        "callback_endpoint": "http://mywebsite.com/receive_auth_keys"
    }

The immediate response would be:

    {
        "status": "granted",
        "petition_id": "48503",
        "source_description": "YouTube video",
        "source": "http://www.youtube.com/watch?v=AayLwwvn77s",
        "requester_email": "data@ent1701d.org",
        "auth_key": "29b109add0012f47754a28309b670a2c"
    }

If the petition creator were to revoke the authorization key, the following
would be posted to `http://mywebsite.com/receive_auth_keys`:

    {
        "status": "revoked",
        "petition_id": "48503",
        "source_description": "YouTube video",
        "source": "http://www.youtube.com/watch?v=AayLwwvn77s",
        "requester_email": "data@ent1701d.org",
        "auth_key": "29b109add0012f47754a28309b670a2c"
    }

_Note: A public API key is a required parameter on all requests, and a
timestamp, endpoint, and request signature are required on certain requests.
For readability, these parameters have been omitted from the tables and
examples above._

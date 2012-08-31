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
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>petition_id</code></td>
            <td>
                <em>(In URL)</em> The petition from which updates should be 
                retrieved.
            </td>
        </tr>
        <tr>
            <td><code>source_description</code></td>
            <td>
                User defined. The type of media around which signatures will be 
                gathered. Example: <code>"YouTube video"</code>
            </td>
        </tr>
        <tr>
            <td><code>source</code></td>
            <td>
                URL or other identifier of the source from which signatures will
                be gathered. Must be unique to the API consumer submitting the 
                request. Example: 
                <code>http://www.youtube.com/watch?v=bflYjF90t7c</code>
            </td>
        </tr>
        <tr>
            <td><code>requester_email</code></td>
            <td>
                The email address of the individual requesting the petition 
                authorization key.
            </td>
        </tr>
        <tr>
            <td><code>callback_endpoint</code></td>
            <td>
                The URL to which the petition authorization key or other 
                information (outlined below) will be posted.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

A 202 acknowledgement response is sent upon receipt of the request if no 
petition authorization key already exists for this resource and requestor. If it 
does, then a 200 response is sent with the authorization code that already 
exists or an indication that the request has been denied or that a 
previously-granted authorization code has been revoked. 

The following is the data sent to the callback endpoint once the request has 
been processed. The originally fields submitted are posted to the callback 
endpoint to enable the user submitting the request to map the authorization back 
to its own user and resource (originally specified in `source`).

<table>
    <thead>
        <th>Field Name</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>status</code></td>
            <td>
                Whether or not the authorization key was granted. Possible 
                values are <code>granted</code>, <code>denied</code>, or 
                <code>revoked</code>.
            </td>
        </tr>
        <tr>
            <td><code>petition_id</code></td>
            <td>
                The ID of the petition on which an authorization key was 
                requested.
            </td>
        </tr>
        <tr>
            <td><code>source_description</code></td>
            <td>
                The <code>source_description</code> originally submitted with 
                this request.
            </td>
        </tr>
        <tr>
            <td><code>source</code></td>
            <td>
                The <code>source</code> originally submitted with this request.
            </td>
        </tr>
        <tr>
            <td><code>requester_email</code></td>
            <td>
                The <code>requester_email</code> originally submitted with this
                request.
            </td>
        </tr>
        <tr>
            <td><code>auth_key</code></td>
            <td>
                <em>(If granted or revoked)</em> The petition authorization key.
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

Results in a 202 acknowledgment response. Eventually, the callback endpoint 
would receive this request:

    POST http://mywebsite.com/receive_auth_keys
    {
        "status": "granted",
        "petition_id": "48503",
        "source_description": "YouTube video",
        "source": "http://www.youtube.com/watch?v=AayLwwvn77s",
        "requester_email": "data@ent1701d.org",
        "auth_key": "29b109add0012f47754a28309b670a2c"
    }

# Responses

Depending on its type, a request is either processed immediately or queued for
processing later. Generally, requests that are seeking information will get an
immediate response; requests that are modifying or adding data will be queued
for later.

## Response Codes

The following HTTP status codes are possible in response to a request:
<table>
    <thead>
        <th>HTTP Status Code</th>
        <th>Status</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td>200</td>
            <td>OK (Immediate response)</td>
            <td>The request was a success and the response includes the
                requested data.</td>
        </tr>
        <tr>
            <td>202</td>
            <td>OK (Immediate response)</td>
            <td>The request was received and queued for processing, but not yet
                processed.</td>
        </tr>
        <tr>
            <td>400</td>
            <td>Bad Request</td>
            <td>The request was malformed or unexpected.</td>
        </tr>
        <tr>
            <td>401</td>
            <td>Unauthorized</td>
            <td>The request did not include a valid API key, secret, or petition
                authorization key.</td>
        </tr>
        <tr>
            <td>403</td>
            <td>Forbidden</td>
            <td>The request included an API key, secret, or a petition
                authorization key that has been revoked.</td>
        </tr>
        <tr>
            <td>404</td>
            <td>Not Found</td>
            <td>The requested resource was not found.</td>
        </tr>
        <tr>
            <td>415</td>
            <td>Unsupported Media Type</td>
            <td>The request was sent with a specified format that is not
                supported.</td>
        </tr>
        <tr>
            <td>429</td>
            <td>Too Many Requests</td>
            <td>The rate limit has been reached for this API key. See <em>Rate
                Limits</em>.</td>
        </tr>
        <tr>
            <td>500</td>
            <td>Internal Server Error</td>
            <td>The request could not be fulfilled due to an unexpected
                error.</td>
        </tr>
        <tr>
            <td>503</td>
            <td>Service Unavailable</td>
            <td>Change.org is temporarily unable to fulfill the request. The
                request can be tried again later.</td>
        </tr>
    </tbody>
</table>

## Response Format

All responses are sent in JSON.

Here is an example request to retrieve the most recent signature of a petition:

    GET https://api.change.org/v1/petitions/48503/signatures?page_size=1
    => [{ 
            "first_name": "Jean-Luc",
            "last_name": "Picard",
            "city": "San Francisco",
            "state_province": "CA",
            "country": "US",
            "signed_on": "2012-02-15 23:39:31 UTC"
        }]

Note: Authentication and validation clear-text parameters (public API key,
request signature, and timestamp) were omitted from the request above.
# Resources

## Reasons on Petitions

### `GET petitions/:petition_id/reasons`

Returns the reasons given by signers of a petition for having signed.

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
                <em>(In URL)</em> The petition from which reasons should be
                retrieved.
            </td>
        </tr>
        <tr>
            <td><code>page_size</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em>The maximum number of reasons to return per 
                request, but no more than 500. If omitted, returns a maximum of 10 reasons.
            </td>
        </tr>
        <tr>
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em>The page offset by <code>page_size</code> 
                reasons. If omitted, returns the first page by default.
            </td>
        </tr>
        <tr>
            <td><code>sort</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em>The order by which reasons will be returned. 
                Accepted values are <code>popularity</code>, 
                <code>time_asc</code>, and <code>time_desc</code>. If omitted, returns
                reasons in order of popularity (most number of likes).
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

An array of reasons for signing the petition.

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>created_on</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                The date and time when this reason was posted to the petition.
            </td>
        </tr>
        <tr>
            <td><code>content</code></td>
            <td><code>string</code></td>
            <td>
                The content of the reason for signing.
            </td>
        </tr>
        <tr>
            <td><code>like_count</code></td>
            <td><code>int</code></td>
            <td>
                The number of users who have liked this reason.
            </td>
        </tr>
        <tr>
            <td><code>author_name</code></td>
            <td><code>string</code></td>
            <td>
                The name of the author of the reason.
            </td>
        </tr>
        <tr>
            <td><code>author_url</code></td>
            <td><code>string</code></td>
            <td>
                The URL to the Change.org profile page of the reason author.
            </td>
        </tr>
        <tr>
            <td><code>flag_endpoint</code></td>
            <td><code>string</code></td>
            <td>
                The URL to send a <code>PUT</code> request to if this reason 
                should be removed for inappropriate content. The body of the
                <code>PUT</code> request should include a parameter 
                <code>why</code> that indicates the justification for flagging.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/petitions/48503/reasons?page_size=1&sort=time_desc
    => [{
            "created_on": "2012-02-15T23:39:31Z",
            "content": "Because I’m tired of wearing red!",
            "like_count": 4,
            "author_name": "Jean-Luc Picard",
            "author_url": "http://www.change.org/members/230923"
            "flag_endpoint": "http://api.change.org/petitions/48503/reasons/569/flag"
        }]

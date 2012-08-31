# Resources

## Updates on Petitions

### `GET petitions/:petition_id/updates`

Returns the news updates on a petition.

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
                <em>(In URL)</em> The petition from which updates should be
                retrieved.
            </td>
        </tr>
        <tr>
            <td><code>page_size</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em>The maximum number of updates to return per
                request, but no more than 100. Returns a maximum of 10 updates
                if omitted.
            </td>
        </tr>
        <tr>
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em> The page offset by <code>page_size</code>
                updates. Returns the first page by default if omitted.
            </td>
        </tr>
        <tr>
            <td><code>sort</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The order by which updates will be returned.
                Accepted values are <code>time_asc</code> and
                <code>time_desc</code>. Returns updates in order of most recent
                if omitted.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

An array of petition updates.

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
                The date and time when this update was posted to the petition.
            </td>
        </tr>
        <tr>
            <td><code>content</code></td>
            <td><code>string</code></td>
            <td>
                The content of the update to the petition.
            </td>
        </tr>
        <tr>
            <td><code>link</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> A URL included in the update.
            </td>
        </tr>
        <tr>
            <td><code>author_name</code></td>
            <td><code>string</code></td>
            <td>
                The name of the author of the update.
            </td>
        </tr>
        <tr>
            <td><code>author_url</code></td>
            <td><code>string</code></td>
            <td>
                The URL to the Change.org profile page of the update author.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/petitions/48503/updates
    => [{
            "created_on": "2012-03-14T03:32:39Z",
            "content": "We hit 2,000 signatures!",
            "link": "",
            "author_name": "Jean-Luc Picard",
            "author_url": "http://www.change.org/members/233311"
        },
        {
            "created_on": "2012-03-23T15:22:21Z",
            "content": "Check out this great media coverage in the Times",
            "link": "http://www.thestarfleettimes.co.uk/petition-targets-starfleet",
            "author_name": "Jean-Luc Picard",
            "author_url": "http://www.change.org/members/233311"
        }]

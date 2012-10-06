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
                request, but no more than 100. If omitted, returns a maximum of 10 updates.
            </td>
        </tr>
        <tr>
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em> The page offset by <code>page_size</code>
                updates. If omitted, returns the first page by default.
            </td>
        </tr>
        <tr>
            <td><code>sort</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The order by which updates will be returned.
                Accepted values are <code>time_asc</code> and
                <code>time_desc</code>. If omitted, returns most recent updates in order.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>update_count</code></td>
            <td><code>int</code></td>
            <td>
                The number of total news updates on this petition.
            </td>
        </tr>
        <tr>
            <td><code>prev_page_endpoint</code></td>
            <td><code>string</code></td>
            <td>
                The API endpoint that can be called to retrieve the previous
                page of updates. <code>null</code> if there is no previous page.
            </td>
        </tr>
        <tr>
            <td><code>next_page_endpoint</code></td>
            <td><code>string</code></td>
            <td>
                The API endpoint that can be called to retrieve the next page
                of updates. <code>null</code> if there is no next page.
            </td>
        </tr>
        <tr>
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                The current page number.
            </td>
        </tr>
        <tr>
            <td><code>total_pages</code></td>
            <td><code>int</code></td>
            <td>
                The total number of pages of updates (of size specified by
                <code>page_size</code>)
            </td>
        </tr>
        <tr>
            <td><code>reasons</code></td>
            <td><code>array</code></td>
            <td>
                The array of news updates.
            </td>
        </tr>
    </tbody>
</table>

The `updates` array contains objects with the following data:

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

    GET https://api.change.org/v1/petitions/48503/updates?page_size=2&page=3
    => {
            "update_count": 8,
            "prev_page_endpoint": "https://api.change.org/v1/petitions/48503/updates?page=2&page_size=2&sort=time_desc",
            "next_page_endpoint": "https://api.change.org/v1/petitions/48503/updates?page=4&page_size=2&sort=time_desc",
            "page": 3,
            "total_pages": 4,
            "updates":[{
                "created_on": "2012-03-14T03:32:39Z",
                "content": "We hit 2,000 signatures!",
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
        }

_Note: A public API key is a required parameter on all requests, and a
timestamp, endpoint, and request signature are required on certain requests.
For readability, these parameters have been omitted from the tables and
examples above._

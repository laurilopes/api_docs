# Resources

## Petitions

* [`GET petitions`](#get-petitions)
* [`GET petitions/:petition_id`](#get-petitions-petition_id)
* [`GET petitions/get_id`](#get-petitions-get_id)

<a name="get-petitions"></a>
### `GET petitions`

Returns the array of petition data objects corresponding to the petition IDs
submitted. It is the same as doing `GET petitions/:petition_id` in bulk over an
array of IDs.

#### Request Parameters
<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>petition_ids</code></td>
            <td><code>string</code> of comma-separated petition IDs</td>
            <td>
                An array of IDs for the petitions about which information should
                be retrieved.<br />
                <br />
                Example: <code>"5445,29301,7762"</code>
            </td>
        </tr>
        <tr>
            <td><code>fields</code></td>
            <td><code>string</code> of comma-separated field names</td>
            <td>
                (Optional) The fields of the petition data object that will be
                returned for each petition in the response. The parameter should include the
                field names (described in
                <code>GET petitions/:petition_id</code>), separated
                by commas. Omitting this parameter will return all available
                fields. <br />
                <br />
                Example: <code>"title,url,signature_count"</code>
            </td>
        </tr>
        <tr>
            <td><code>page_size</code></td>
            <td><code>int</code></td>
            <td>
                (Optional) The maximum number of petition data objects to return
                per request, no more than 500. If omitted, returns the maximum number of
                petitions.
            </td>
        </tr>
        <tr>
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                (Optional) The page offset by <code>page_size</code> petitions.
                If omitted, returns the first page by default.
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
            <td><code>prev_page_endpoint</code></td>
            <td><code>string</code></td>
            <td>
                The API endpoint that can be called to retrieve the previous
                page of petitions. <code>null</code> if there is no previous
                page.
            </td>
        </tr>
        <tr>
            <td><code>next_page_endpoint</code></td>
            <td><code>string</code></td>
            <td>The API endpoint that can be called to retrieve the next page of
            petitions. <code>null</code> if there is no next page.</td>
        </tr>
        <tr>
            <td><code>total_pages</code></td>
            <td><code>int</code></td>
            <td>The total number of pages of petitions (of size specified by
            <code>page_size</code>)</td>
        </tr>
        <tr>
            <td><code>petitions</code></td>
            <td><code>array</code></td>
            <td>
                The array of petitions (specified in <code>GET 
                petitions/:petition_id</code>)
            </td>
        </tr>
    </tbody>
</table>

<a name="get-petitions-petition_id"></a>
### `GET petitions/:petition_id`

Returns information about this petition, including the overview, letter to the
petition target, URL to the petition image (if available), and signature count.

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
                <em>(In URL)</em> The petition about which information should be
                retrieved.
            </td>
        </tr>
        <tr>
            <td><code>fields</code></td>
            <td><code>string</code> of comma-separated field names</td>
            <td>
                <em>(Optional)</em> The fields that will be returned in the
                response. The parameter should include the field names (described below in
                Response Data), separated by commas. Omitting this parameter
                will return all available fields.<br />
                <br />
                Example: <code>"title,url,signature_count"</code>
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
            <td><code>petition_id</code></td>
            <td><code>int</code></td>
            <td>The id of the petition.</td>
        </tr>
        <tr>
            <td><code>title</code></td>
            <td><code>string</code></td>
            <td>The human-readable title of the petition.</td>
        </tr>
        <tr>
            <td><code>status</code></td>
            <td><code>string</code></td>
            <td>Possible values are <code>open</code>, <code>closed</code>,
            and <code>victory</code>.</td>
        </tr>
        <tr>
            <td><code>url</code></td>
            <td><code>string</code></td>
            <td>The URL of the petition on Change.org.</td>
        </tr>
        <tr>
            <td><code>overview</code></td>
            <td><code>string</code></td>
            <td>The overview text of the petition.</td>
        </tr>
        <tr>
            <td><code>targets</code></td>
            <td><code>array</code></td>
            <td>
                The list of targets. (See <em>
                <a href="petitions/targets.md">Targets on Petitions</a></em>.)
            </td>
        </tr>
        <tr>
            <td><code>letter</code></td>
            <td><code>string</code></td>
            <td>The petition letter to the target(s).</td>
        </tr>
        <tr>
            <td><code>signature_count</code></td>
            <td><code>int</code></td>
            <td>The petition's total number of signatures.</td>
        </tr>
        <tr>
            <td><code>image_url</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The URL to the petition's image on
                Change.org.
            </td>
        </tr>
        <tr>
            <td><code>category</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The category that the petition is in on
                Change.org.
            </td>
        </tr>
        <tr>
            <td><code>goal</code></td>
            <td><code>int</code></td>
            <td>
                <em>(If available)</em> The signature goal for a petition.
            </td>
        </tr>
        <tr>
            <td><code>end_date</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                <em>(If available)</em> The deadline for the petition.
            </td>
        </tr>
        <tr>
            <td><code>creator_name</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If applicable)</em> The name of the petition creator.
            </td>
        </tr>
        <tr>
            <td><code>creator_url</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If applicable)</em> The URL to the Change.org profile page
                of the petition creator.
            </td>
        </tr>
        <tr>
            <td><code>organization_name</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If applicable)</em> The name of the organization that
                created the petition.
            </td>
        </tr>
        <tr>
            <td><code>organization_url</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If applicable)</em> The URL to the Change.org profile page
                of the organization that created the petition.</td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/petitions/48503
    => {
            "title": "Tell Congress: Build the Enterprise",
            "url": "http://www.change.org/petitions/tell-congress-build-the-enterprise",
            "overview": "It's time to build the Enterprise, don't you think?",
            "targets": [{
                "name": "US House of Representatives",
                "type": "us_government",
            }],
            "letter": "Dear Congress,
                
                Please build the USS Enterprise as quickly as possible.

                Thank you.",
            "image_url": "https://change-production.s3.amazonaws.com/photos/1/bi/gp/fdjs.jpg",
            "signature_count": 23456,
            "creator_name": "Gene Roddenberry",
            "creator_url": "http://www.change.org/members/382934"
        }

<a name="get-petitions-get_id"></a>
### `GET petitions/get_id`

Returns the unique Change.org ID for the petition specified by
<code>petition_url</code>. Before performing requests on a petition, the
unique Change.org ID is required. Obtaining the ID versus using the URL as an
identifier is required because petition URLs can change.

#### Request Parameters

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>petition_url</code></td>
            <td><code>string</code></td>
            <td>
                The petition whose ID will be retrieved.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

The ID of the requested petition.

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>petition_id</code></td>
            <td><code>int</code></td>
            <td>
                The unique Change.org ID of the petition.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/petitions/get_id?petition_url=http%3A%2F%2Fwww.change.org%2Fpetitions%2Fask-starfleet-to-add-a-purple-uniform
    => { "petition_id": 949821 }


_A public API key, timestamp, and request signature are required parameters on
all requests, implicit in the tables and examples above._
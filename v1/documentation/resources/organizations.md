# Resources

## Organizations

* [`GET organizations/:organization_id`](#get-organizations-organization_id)
* [`GET organizations/:organization_id/petitions`](#get-organizations-organization_id-petitions)
* [`GET organizations/get_id`](#get-organizations-get_id)

<a name="get-organizations-organization_id"></a>
### `GET organizations/:organization_id`

Returns information about the specified organization.

#### Request Parameters
<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>organization_id</code></td>
            <td><code>int</code></td>
            <td>
                <em>(In URL)</em> The ID of the organization about which information
                will be retrieved.
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
            <td><code>organization_id</code></td>
            <td><code>int</code></td>
            <td>
                The ID of the organization about which information was retrieved.
            </td>
        </tr>
        <tr>
            <td><code>name</code></td>
            <td><code>string</code></td>
            <td>
                The full name of the organization.
            </td>
        </tr>
        <tr>
            <td><code>location</code></td>
            <td><code>string</code></td>
            <td>
                The full location of the organization in English.
                (e.g. <code>San Francisco, CA</code> or <code>Paris, France</code>)
            </td>
        </tr>
        <tr>
            <td><code>address</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The address of the organization.
            </td>
        </tr>
        <tr>
            <td><code>city</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> City of the organization.
            </td>
        </tr>
        <tr>
            <td><code>state_province</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The standard abbreviation of the state or province of the organization.
            </td>
        </tr>
        <tr>
            <td><code>postal_code</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The postal code of the organization.
            </td>
        </tr>
        <tr>
            <td><code>country_name</code></td>
            <td><code>string</code></td>
            <td>
                Full English name of the country of the organization.
            </td>
        </tr>
        <tr>
            <td><code>country_code</code></td>
            <td><code>string</code></td>
            <td>
                The two-letter code of the country of the organization.
            </td>
        </tr>
        <tr>
            <td><code>website</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The URL to the organization's website.
            </td>
        </tr>
        <tr>
            <td><code>mission</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The mission statement provided by the organization.
            </td>
        </tr>
        <tr>
            <td><code>organization_url</code></td>
            <td><code>string</code></td>
            <td>
                The URL to the organization's profile on Change.org
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/organizations/298374
    =>  {
            "organization_id": 73899,
            "name": "United Federation of Planets",
            "location": "Paris, France",
            "city": "Paris",
            "country_name": "France",
            "country_code": "FR",
            "website": "http://en.memory-alpha.org/wiki/United_Federation_of_Planets",
            "mission": "To be peaceful and do other things.",
            "organization_url": "http://www.change.org/groups/the_federation"
        }

<a name="get-organizations-organization_id-petitions"></a>
### `GET organizations/:organization_id/petitions`

Returns the array of petitions that were created by the specified organization.
For more information about the petition information returned, see
_[Petitions](petitions.md)_.

#### Request Parameters
<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>organization_id</code></td>
            <td><code>int</code></td>
            <td>
                <em>(In URL)</em> The ID of the organizations whose petitions have been returned.
            </td>
        </tr>
        <tr>
            <td><code>fields</code></td>
            <td><code>string</code> of comma-separated field names</td>
            <td>
                (Optional) The fields of the petition data objects that will be
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
        <tr>
            <td><code>sort</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The order by which petitions will be returned.
                Accepted values are the number of signatures,
                <code>signatures_asc</code> or <code>signatures_desc</code>, or
                the date and time the petition was created,
                <code>time_asc</code> or <code>time_desc</code>. If omitted,
                returns petitions in the ascending order in which they were created.
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
            <td><code>organization_id</code></td>
            <td><code>int</code></td>
            <td>
                The ID of the organization whose petitions have been returned.
            </td>
        </tr>
        <tr>
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                The current page number. Defaults to 1.
            </td>
        </tr>
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
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                The current page number.
            </td>
        </tr>
        <tr>
            <td><code>total_pages</code></td>
            <td><code>int</code></td>
            <td>The total number of pages of petitions (of size specified by
            <code>page_size</code>)</td>
        </tr>
        <tr>
            <td><code>petitions</code></td>
            <td><code>array</code> of petitions created by the specified organization</td>
            <td>
                See <em><a href="petitions.md">Petitions</a></em>
                for more information about petition data objects.
            </td>
        </tr>
    </tbody>
</table>

<a name="get-organizations-get_id"></a>
### `GET organizations/get_id`

Returns the unique Change.org ID for the organization specified by
<code>organization_url</code>, which is the URL to the organization's profile
on Change.org. Before performing requests on an organization
resource, this ID is required because organization profile URLs can change.

#### Request Parameters

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>organization_url</code></td>
            <td><code>string</code></td>
            <td>
                The URL to the organization's Change.org profile.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

The ID of the requested organization.

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>organization_id</code></td>
            <td><code>int</code></td>
            <td>
                The unique Change.org ID of the organization.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/organizations/get_id?organization_url=http%3A%2F%2Fwww.change.org%2Fgroups%2Fthe_federation
    => { "organization_id": 73899 }

_Note: A public API key is a required parameter on all requests, and a
timestamp, endpoint, and request signature are required on certain requests.
For readability, these parameters have been omitted from the tables and
examples above._

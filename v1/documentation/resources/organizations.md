# Resources

## Organizations

* [`GET organizations/:organization_id`](#get-organizations-organization_id)
* [`GET organizations/:organization_id/petitions`](#get-organizations-organization_id-petitions)

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
                City of the organization.
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
                The ID of the organizations whose petitions have been returned.
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
            <td><code>user_id</code></td>
            <td><code>int</code></td>
            <td>
                The ID of the organization whose petitions have been returned.
            </td>
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

_Note: A public API key, timestamp, endpoint, and request signature are
required parameters on all requests, and have been omitted from the tables
and examples above._
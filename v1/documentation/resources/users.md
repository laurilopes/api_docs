# Resources

## Users

* [`GET users/:user_id`](#get-users-user_id)
* [`GET users/:user_id/petitions`](#get-users-user_id-petitions)

<a name="get-users-user_id"></a>
### `GET users/:user_id`

Returns information about the specified user.

#### Request Parameters
<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>user_id</code></td>
            <td><code>int</code></td>
            <td>
                <em>(In URL)</em> The ID of the user about which information
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
            <td><code>user_id</code></td>
            <td><code>int</code></td>
            <td>
                The ID of the user about which information was retrieved.
            </td>
        </tr>
        <tr>
            <td><code>name</code></td>
            <td><code>string</code></td>
            <td>
                The full name of the user.
            </td>
        </tr>
        <tr>
            <td><code>location</code></td>
            <td><code>string</code></td>
            <td>
                The full location of the user in English.
                (e.g. <code>San Francisco, CA</code> or <code>Paris, France</code>)
            </td>
        </tr>
        <tr>
            <td><code>city</code></td>
            <td><code>string</code></td>
            <td>
                Residential city of the user.
            </td>
        </tr>
        <tr>
            <td><code>state_province</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The standard abbreviation of the state or province of the user.
            </td>
        </tr>
        <tr>
            <td><code>country_name</code></td>
            <td><code>string</code></td>
            <td>
                Full English name of the country of the user.
            </td>
        </tr>
        <tr>
            <td><code>country_code</code></td>
            <td><code>string</code></td>
            <td>
                The two-letter code of the country of the user.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/users/298374
    =>  {
            "user_id": 298374,
            "name": "Pavel Chekov",
            "location": "Saint Petersburg, Russia",
            "city": "Saint Petersburg",
            "country_name", "Russia",
            "country_code", "RU"
        }

<a name="get-users-user_id-petitions"></a>
### `GET users/:user_id/petitions`

Returns the array of petitions that were created by the specified user.
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
            <td><code>user_id</code></td>
            <td><code>int</code></td>
            <td>
                The ID of the user whose petitions should be returned.
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
                The ID of the user whose petitions have been returned.
            </td>
        </tr>
        <tr>
            <td><code>petitions</code></td>
            <td><code>array</code> of petitions created by the specified user</td>
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
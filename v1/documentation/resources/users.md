# Resources

## Users

* [`GET users/:user_id`](#get-users-user_id)
* [`GET users/:user_id/petitions`](#get-users-user_id-petitions)
* [`GET users/:user_id/signatures/petitions`](#get-users-user_id-signatures-petitions)
* [`GET users/get_id`](#get-users-get_id)

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
            <td><code>array</code> of petitions created by the specified user</td>
            <td>
                See <em><a href="petitions.md">Petitions</a></em>
                for more information about petition data objects.
            </td>
        </tr>
    </tbody>
</table>

<a name="get-users-user_id-signatures-petitions"></a>
### `GET users/:user_id/signatures/petitions`

Returns the array of petitions that were signed by the specified user.
Signatures that are hidden by the user will not be returned. For more
information about the petition information returned, see
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
                The ID of the user whose signed petitions should be returned.
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
    </tbody>
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
                The ID of the user whose signed petitions have been returned.
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
            <td><code>array</code> of petitions created by the specified user</td>
            <td>
                See <em><a href="petitions.md">Petitions</a></em>
                for more information about petition data objects.
            </td>
        </tr>
    </tbody>
</table>

<a name="get-users-get_id"></a>
### `GET users/get_id`

Returns the unique Change.org ID for the user specified by
<code>user_url</code>, which is the URL to the user's Change.org profile.
Before performing requests on a user resource, this ID is required because
user profile URLs can change.

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
            <td><code>string</code></td>
            <td>
                The user whose ID will be retrieved.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

The ID of the requested user.

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
                The unique Change.org ID of the user.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/users/get_id?user_url=http%3A%2F%2Fwww.change.org%2Fmembers%2Fpavelchekov
    => { "user_id": 298374 }

_Note: A public API key is a required parameter on all requests, and a
timestamp, endpoint, and request signature are required on certain requests.
For readability, these parameters have been omitted from the tables and
examples above._

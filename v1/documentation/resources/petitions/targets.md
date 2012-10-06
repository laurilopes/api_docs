# Resources

## Targets on Petitions

### `GET petitions/:petition_id/targets`

Returns the target(s) of a petition.

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
                <em>(In URL)</em> The petition from which the targets should be retrieved.
            </td>
        </tr>
    </tbody>
</table>

#### Response Data

An array of targets.

<table>
    <thead>
        <th>Field Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>name</code></td>
            <td><code>string</code></td>
            <td>
                The human-readable name of the petition target.
            </td>
        </tr>
        <tr>
            <td><code>title</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If available)</em> The office, title, or organization of the target.
            </td>
        </tr>
        <tr>
            <td><code>type</code></td>
            <td><code>string</code></td>
            <td>
                The possible target types are
                <ul>
                    <li><code>us_government</code></li>
                    <li><code>custom</code> (information supplied by the petition creator)</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td><code>target_area</code></td>
            <td><code>string</code></td>
            <td>
                <em>(If applicable)</em> In the US, this is the two-letter state abbreviation if the target type is a US state government body, such as a state legislature or governor.
            </td>
        </tr>
    </tbody>
</table>

Example:

    GET https://api.change.org/v1/petitions/48503/targets
    => [{
            "name": "Spock",
            "title": "Ambassador",
            "type": "custom",
        },
        {
            "name": "Governor of Alabama",
            "type": "us_government",
            "target_area": "AL"
        }]

_Note: A public API key is a required parameter on all requests, and a
timestamp, endpoint, and request signature are required on certain requests.
For readability, these parameters have been omitted from the tables and
examples above._

# Resources

## Petitions

* [`GET petitions`](#get-petitions)
* [`POST petitions`](#post-petitions)
* [`GET petitions/:petition_id`](#get-petitions-petition_id)
* [`PUT petitions/:petition_id`](#put-petitions-petition_id)
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
            <td><code>page</code></td>
            <td><code>int</code></td>
            <td>
                The current page number. Will default to 1.
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
            <td><code>array</code></td>
            <td>
                The array of petitions (specified in <code>GET 
                petitions/:petition_id</code>)
            </td>
        </tr>
    </tbody>
</table>

<a name="post-petitions"></a>
### `POST petitions`

Creates a new petition and returns the petition's ID and URL.

#### Request Parameters

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>title</code></td>
            <td><code>string</code></td>
            <td>The human-readable title of the petition.</td>
        </tr>
        <tr>
            <td><code>overview</code></td>
            <td><code>string</code></td>
            <td>
                The overview text of the petition. Supports basic HTML tags:
                <code>a, p, strong, em</code>.
            </td>
        </tr>
        <tr>
            <td><code>targets</code></td>
            <td><code>array</code></td>
            <td>
                An array of target(s) of the petition. See the <em>Target
                Request Parameters</em> table below.
            </td>
        </tr>
        <tr>
            <td><code>letter_subject</code></td>
            <td><code>string</code></td>
            <td>The subject line of the petition letter to the target(s).</td>
        </tr>
        <tr>
            <td><code>letter_salutation</code></td>
            <td><code>string</code></td>
            <td>The salutation of the petition letter to the target(s).</td>
        </tr>
        <tr>
            <td><code>letter_body</code></td>
            <td><code>string</code></td>
            <td>The body content of the petition letter to the target(s).</td>
        </tr>
        <tr>
            <td><code>image_url</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em>The URL to the petition's image. This image
                will be uploaded to Change.org's servers from the URL provided.
                The ideal dimensions are 556 px by 304 px.
            </td>
        </tr>
        <tr>
            <td><code>category</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The category that the petition is in on
                Change.org. Acceptable values are <code>animals, criminaljustice,
                economicjustice, education, environment, gayrights,<br />health,
                humanrights, humantrafficking, immigration, food,<br />
                womensrights</code>
            </td>
        </tr>
        <tr>
            <td><code>goal</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em> The signature goal for the petition.
            </td>
        </tr>
        <tr>
            <td><code>end_date</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                <em>(Optional)</em> The deadline for the petition.
            </td>
        </tr>
    </tbody>
</table>

##### Target Request Parameters

The following target objects can be repeated.

<table>
    <thead>
        <th>Parameter Name</th>
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
                <em>(Optional)</em> The office, title, or organization of the
                target.
            </td>
        </tr>
        <tr>
            <td><code>email</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The email address to which the petition
                letter will be sent upon each signature.
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
            <td>
                The unique Change.org ID of the new petition.
            </td>
        </tr>
        <tr>
            <td><code>petition_url</code></td>
            <td><code>string</code></td>
            <td>
                The URL of the petition on Change.org
            </td>
        </tr>
    </tbody>
</table>

Example:

    POST https://api.change.org/v1/petitions
    {
        "title": "Ask Starfleet to Build the Enterprise F",
        "overview": "I'm really getting tired of the Enterprise E. It <strong>was</strong> cool when it was launched, but I'm tired of it now.",
        "targets": [
            {
                "name": "Kathryn Janeway",
                "title": "Admiral",
                "email": "kate@mail.voyager.com"
            },
            {
                "name": "Worf",
                "title": "Ambassador",
                "email": "prunejuice7@klingons.net"
            }
        ],
        "letter_subject": "Please build a new Enterprise",
        "letter_salutation": "Dear Captain Janeway,",
        "letter_body": "It's time to build a new ship. Will you commit to building it?\n\nSincerely,",
        "image_url": "http://images2.wikia.nocookie.net/__cb20100226011030/memoryalpha/en/images/6/66/USS_Enterprise-E_in_nebula.jpg"
    }
    =>  {
            "petition_id": 48398,
            "petition_url": "http://www.change.org/petitions/ask-starfleet-to-build-the-enterprise-f"
        }

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
            <td><code>letter_subject</code></td>
            <td><code>string</code></td>
            <td>The subject line of the petition letter to the target(s).</td>
        </tr>
        <tr>
            <td><code>letter_salutation</code></td>
            <td><code>string</code></td>
            <td>The salutation of the petition letter to the target(s).</td>
        </tr>
        <tr>
            <td><code>letter_body</code></td>
            <td><code>string</code></td>
            <td>The body content of the petition letter to the target(s).</td>
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
            <td><code>created_at</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                The date and time the petition was created.
            </td>
        </tr>
        <tr>
            <td><code>end_at</code></td>
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

<a name="put-petitions-petition_id"></a>
### `PUT petitions/:petition_id`

Updates information for a given petition. A petition's attributes will remain
unchanged except in cases where new information is specified, so all request
parameters are optional.

#### Request Parameters

<table>
    <thead>
        <th>Parameter Name</th>
        <th>Type</th>
        <th>Description</th>
    </thead>
    <tbody>
        <tr>
            <td><code>title</code></td>
            <td><code>string</code></td>
            <td><em>(Optional)</em> The human-readable title of the petition.</td>
        </tr>
        <tr>
            <td><code>overview</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The overview text of the petition. Supports basic HTML tags:
                <code>a, p, strong, em</code>.
            </td>
        </tr>
        <tr>
            <td><code>targets</code></td>
            <td><code>array</code></td>
            <td>
                <em>(Optional)</em> An array of target(s) of the petition.
                See the <em>Target Request Parameters</em> table above under
                <code>POST petitions</code>.
            </td>
        </tr>
        <tr>
            <td><code>letter</code></td>
            <td><code>string</code></td>
            <td><em>(Optional)</em> The petition letter to the target(s).</td>
        </tr>
        <tr>
            <td><code>image_url</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em>The URL to the petition's image. This image
                will be uploaded to Change.org's servers from the URL provided.
                The ideal dimensions are 556 px by 304 px.
            </td>
        </tr>
        <tr>
            <td><code>category</code></td>
            <td><code>string</code></td>
            <td>
                <em>(Optional)</em> The category that the petition is in on
                Change.org. Acceptable values are <code>animals, criminaljustice,
                economicjustice, education, environment, gayrights,<br />health,
                humanrights, humantrafficking, immigration, food,<br />
                womensrights</code>
            </td>
        </tr>
        <tr>
            <td><code>goal</code></td>
            <td><code>int</code></td>
            <td>
                <em>(Optional)</em> The signature goal for a petition.
            </td>
        </tr>
        <tr>
            <td><code>end_date</code></td>
            <td><code>string</code> of ISO-8601 datetime</td>
            <td>
                <em>(Optional)</em> The deadline for the petition.
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
            <td>
                The unique Change.org ID of the new petition.
            </td>
        </tr>
        <tr>
            <td><code>petition_url</code></td>
            <td><code>string</code></td>
            <td>
                The URL of the petition on Change.org, which may have changed
                if the title was altered.
            </td>
        </tr>
    </tbody>
</table>

Example:

    PUT https://api.change.org/v1/petitions/48398
    {
        "title": "Ask Starfleet to Build the Enterprise F, please!",
        "letter": "Dear Capt. Janeway & Amb. Spock,\n\nIt's time to build a new ship. Will you commit to building it?\n\nSincerely,",
    }
    =>  {
            "petition_id": 48398,
            "petition_url": "http://www.change.org/petitions/ask-starfleet-to-build-the-enterprise-f-please"
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

_Note: A public API key, timestamp, endpoint, and request signature are
required parameters on all requests, and have been omitted from the tables
and examples above._
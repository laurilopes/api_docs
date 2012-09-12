# Authentication

## API Key

Every user must obtain a public API key to make requests to the Change.org API.
This key is sent in clear text along with every request.

The parameter name is `api_key`.

## API Secret Token

Every user receives a companion private secret token. This string is used as a
salt in generating request signatures and is never sent in clear text.

## Authorization Key

For certain requests, a resource (e.g. a petition) authorization key must be
used as an added salt. The authorization key is granted by the resource
owner and can be revoked. Each authorization key is specific to a resource,
a source (of the request), and an API user.

Partners wishing to obtain a authorization keys on behalf of an
individual may do so through an authorization key API request. See, for example,
[_Authorization Keys on Petitions_](resources/petitions/auth_keys.md).
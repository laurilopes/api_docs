# Authentication

## API Key

Every user must obtain a public API key to make requests to the Change.org API.
This key is sent in clear text along with every request.

The parameter name is `api_key`.

## API Secret Token

Every user receives a companion private secret token. This string is used as a
salt in generating request signatures and is never sent in clear text.

The parameter name is `secret`.

## Petition Authorization Key

For certain requests, request signatures must be generated using a unique
petition authorization key as a salt in addition to the secret. This
authorization key is granted by the petition owner and can be revoked. Each
petition authorization key is specific to a petition, a source, and an API user.

The parameter name is `auth_key`.

Partners wishing to obtain a petition authorization key on behalf of an
individual may do so through an authorization key API request. See 
_Authorization Keys on Petitions_.
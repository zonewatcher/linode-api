# Linode API V4

## Introduction
The Linode API provides the ability to programmatically manage the full
range of Linode products and services.

This reference is designed to assist application developers and system
administrators.  Each endpoint includes descriptions, request syntax, and
examples using standard HTTP requests. Response data is returned in JSON
format.


This document was generated from our OpenAPI Specification.  See the
<a target=\"_top\" href=\"https://www.openapis.org\">OpenAPI website</a> for more information.

<a target=\"_top\" href=\"/docs/api/openapi.yaml\">Download the Linode OpenAPI Specification</a>.


## Changelog

<a target=\"_top\" href=\"https://developers.linode.com/changelog\">View our Changelog</a> to see release
notes on all changes made to our API.

## Access and Authentication

Some endpoints are publicly accessible without requiring authentication.
All endpoints affecting your Account, however, require either a Personal
Access Token or OAuth authentication (when using third-party
applications).

### Personal Access Token

The easiest way to access the API is with a Personal Access Token (PAT)
generated from the
<a target=\"_top\" href=\"https://cloud.linode.com/profile/tokens\">Linode Cloud Manager</a> or
the [Create Personal Access Token](/docs/api/profile/#personal-access-token-create) endpoint.

All scopes for the OAuth security model ([defined below](/docs/api/profile/#oauth)) apply to this
security model as well.

#### Authentication

| Security Scheme Type: | HTTP |
|-----------------------|------|
| **HTTP Authorization Scheme** | bearer |

### OAuth
If you only need to access the Linode API for personal use,
we recommend that you create a [personal access token](/docs/api/#personal-access-token).
If you're designing an application that can authenticate with an arbitrary Linode user, then
you should use the OAuth 2.0 workflows presented in this section.

For a more detailed example of an OAuth 2.0 implementation, see our guide on [How to Create an OAuth App with the Linode Python API Library](/docs/platform/api/how-to-create-an-oauth-app-with-the-linode-python-api-library/#oauth-2-authentication-exchange).

Before you implement OAuth in your application, you first need to create an OAuth client. You can do this [with the Linode API](/docs/api/account/#oauth-client-create) or [via the Cloud Manager](https://cloud.linode.com/profile/clients):

  - When creating the client, you'll supply a `label` and a `redirect_uri` (referred to as the Callback URL in the Cloud Manager).
  - The response from this endpoint will give you a `client_id` and a `secret`.
  - Clients can be public or private, and are private by default. You can choose to make the client public when it is created.
    - A private client is used with applications which can securely store the client secret (that is, the secret returned to you when you first created the client). For example, an application running on a secured server that only the developer has access to would use a private OAuth client. This is also called a confidential client in some OAuth documentation.
    - A public client is used with applications where the client secret is not guaranteed to be secure. For example, a native app running on a user's computer may not be able to keep the client secret safe, as a user could potentially inspect the source of the application. So, native apps or apps that run in a user's browser should use a public client.
    - Public and private clients follow different workflows, as described below.

#### OAuth Workflow

The OAuth workflow is a series of exchanges between your third-party app and Linode. The workflow is used
to authenticate a user before an application can start making API calls on the user's behalf.

Notes:

- With respect to the diagram in [section 1.2 of RFC 6749](https://tools.ietf.org/html/rfc6749#section-1.2), login.linode.com (referred to in this section as the *login server*)
is the Resource Owner and the Authorization Server; api.linode.com (referred to here as the *api server*) is the Resource Server.
- The OAuth spec refers to the private and public workflows listed below as the [authorization code flow](https://tools.ietf.org/html/rfc6749#section-1.3.1) and [implicit flow](https://tools.ietf.org/html/rfc6749#section-1.3.2).

| PRIVATE WORKFLOW | PUBLIC WORKFLOW |
|------------------|------------------|
| 1.  The user visits the application's website and is directed to login with Linode. | 1.  The user visits the application's website and is directed to login with Linode. |
| 2.  Your application then redirects the user to Linode's [login server](https://login.linode.com) with the client application's `client_id` and requested OAuth `scope`, which should appear in the URL of the login page. | 2.  Your application then redirects the user to Linode's [login server](https://login.linode.com) with the client application's `client_id` and requested OAuth `scope`, which should appear in the URL of the login page. |
| 3.  The user logs into the login server with their username and password. | 3.  The user logs into the login server with their username and password. |
| 4.  The login server redirects the user to the specificed redirect URL with a temporary authorization `code` (exchange code) in the URL. | 4.  The login server redirects the user back to your application with an OAuth `access_token` embedded in the redirect URL's hash. This is temporary and expires in two hours. No `refresh_token` is issued. Therefore, once the `access_token` expires, a new one will need to be issued by having the user log in again. |
| 5.  The application issues a POST request (*see below*) to the login server with the exchange code, `client_id`, and the client application's `client_secret`. | |
| 6.  The login server responds to the client application with a new OAuth `access_token` and `refresh_token`. The `access_token` is set to expire in two hours. | |
| 7.  The `refresh_token` can be used by contacting the login server with the `client_id`, `client_secret`, `grant_type`, and `refresh_token` to get a new OAuth `access_token` and `refresh_token`. The new `access_token` is good for another two hours, and the new `refresh_token`, can be used to extend the session again by this same method. | |

#### OAuth Private Workflow - Additional Details

The following information expands on steps 5 through 7 of the private workflow:

Once the user has logged into Linode and you have received an exchange code,
you will need to trade that exchange code for an `access_token` and `refresh_token`. You
do this by making an HTTP POST request to the following address:

```
https://login.linode.com/oauth/token
```

Make this request as `application/x-www-form-urlencoded` or as
`multipart/form-data` and include the following parameters in the POST body:

| PARAMETER | DESCRIPTION |
|-----------|-------------|
| grant_type | The grant type you're using for renewal.  Currently only the string \"refresh_token\" is accepted. |
| client_id | Your app's client ID. |
| client_secret | Your app's client secret. |
| code | The code you just received from the redirect. |

You'll get a response like this:

```json
{
  \"scope\": \"linodes:read_write\",
  \"access_token\": \"03d084436a6c91fbafd5c4b20c82e5056a2e9ce1635920c30dc8d81dc7a6665c\"
  \"token_type\": \"bearer\",
  \"expires_in\": 7200,
}
```

Included in the reponse is an `access_token`. With this token, you can proceed to make
authenticated HTTP requests to the API by adding this header to each request:

```
Authorization: Bearer 03d084436a6c91fbafd5c4b20c82e5056a2e9ce1635920c30dc8d81dc7a6665c
```

#### OAuth Reference

| Security Scheme Type | OAuth 2.0 |
|-----------------------|--------|
| **Authorization URL** | https://login.linode.com/oauth/authorize |
| **Token URL** | https://login.linode.com/oauth/token |
| **Scopes** | <ul><li>`account:read_only` - Allows access to GET information about your Account.</li><li>`account:read_write` - Allows access to all endpoints related to your Account.</li><li>`domains:read_only` - Allows access to GET Domains on your Account.</li><li>`domains:read_write` - Allows access to all Domain endpoints.</li><li>`events:read_only` - Allows access to GET your Events.</li><li>`events:read_write` - Allows access to all endpoints related to your Events.</li><li>`firewall:read_only` - Allows access to GET information about your Firewalls.</li><li>`firewall:read_write` - Allows access to all Firewall endpoints.</li><li>`images:read_only` - Allows access to GET your Images.</li><li>`images:read_write` - Allows access to all endpoints related to your Images.</li><li>`ips:read_only` - Allows access to GET your ips.</li><li>`ips:read_write` - Allows access to all endpoints related to your ips.</li><li>`linodes:read_only` - Allows access to GET Linodes on your Account.</li><li>`linodes:read_write` - Allow access to all endpoints related to your Linodes.</li><li>`lke:read_only` - Allows access to GET LKE Clusters on your Account.</li><li>`lke:read_write` - Allows access to all endpoints related to LKE Clusters on your Account.</li><li>`longview:read_only` - Allows access to GET your Longview Clients.</li><li>`longview:read_write` - Allows access to all endpoints related to your Longview Clients.</li><li>`maintenance:read_only` - Allows access to GET information about Maintenance on your account.</li><li>`nodebalancers:read_only` - Allows access to GET NodeBalancers on your Account.</li><li>`nodebalancers:read_write` - Allows access to all NodeBalancer endpoints.</li><li>`object_storage:read_only` - Allows access to GET information related to your Object Storage.</li><li>`object_storage:read_write` - Allows access to all Object Storage endpoints.</li><li>`stackscripts:read_only` - Allows access to GET your StackScripts.</li><li>`stackscripts:read_write` - Allows access to all endpoints related to your StackScripts.</li><li>`volumes:read_only` - Allows access to GET your Volumes.</li><li>`volumes:read_write` - Allows access to all endpoints related to your Volumes.</li></ul><br/>|

## Requests

Requests must be made over HTTPS to ensure transactions are encrypted. The
following Request methods are supported:

| METHOD | USAGE |
|--------|-------|
| GET    | Retrieves data about collections and individual resources. |
| POST   | For collections, creates a new resource of that type. Also used to perform actions on action endpoints. |
| PUT    | Updates an existing resource. |
| DELETE | Deletes a resource. This is a destructive action. |


## Responses

Actions will return one following HTTP response status codes:

| STATUS  | DESCRIPTION |
|---------|-------------|
| 200 OK  | The request was successful. |
| 202 Accepted | The request was successful, but processing has not been completed. The response body includes a \"warnings\" array containing the details of incomplete processes. |
| 204 No Content | The server successfully fulfilled the request and there is no additional content to send. |
| 400 Bad Request | You submitted an invalid request (missing parameters, etc.). |
| 401 Unauthorized | You failed to authenticate for this resource. |
| 403 Forbidden | You are authenticated, but don't have permission to do this. |
| 404 Not Found | The resource you're requesting does not exist. |
| 429 Too Many Requests | You've hit a rate limit. |
| 500 Internal Server Error | Please [open a Support Ticket](/docs/api/support/#support-ticket-open). |

## Errors

Success is indicated via <a href=\"https://en.wikipedia.org/wiki/List_of_HTTP_status_codes\" target=\"_top\">Standard HTTP status codes</a>.
`2xx` codes indicate success, `4xx` codes indicate a request error, and
`5xx` errors indicate a server error. A
request error might be an invalid input, a required parameter being omitted,
or a malformed request. A server error means something went wrong processing
your request. If this occurs, please
[open a Support Ticket](/docs/api/support/#support-ticket-open)
and let us know. Though errors are logged and we work quickly to resolve issues,
opening a ticket and providing us with reproducable steps and data is always helpful.

The `errors` field is an array of the things that went wrong with your request.
We will try to include as many of the problems in the response as possible,
but it's conceivable that fixing these errors and resubmitting may result in
new errors coming back once we are able to get further along in the process
of handling your request.


Within each error object, the `field` parameter will be included if the error
pertains to a specific field in the JSON you've submitted. This will be
omitted if there is no relevant field. The `reason` is a human-readable
explanation of the error, and will always be included.

## Pagination

Resource lists are always paginated. The response will look similar to this:

```json
{
    \"data\": [ ... ],
    \"page\": 1,
    \"pages\": 3,
    \"results\": 300
}
```

* Pages start at 1. You may retrieve a specific page of results by adding
`?page=x` to your URL (for example, `?page=4`). If the value of `page`
exceeds `2^64/page_size`, the last possible page will be returned.


* Page sizes default to 100,
and can be set to return between 25 and 500. Page size can be set using
`?page_size=x`.

## Filtering and Sorting

Collections are searchable by fields they include, marked in the spec as
`x-linode-filterable: true`. Filters are passed
in the `X-Filter` header and are formatted as JSON objects. Here is a request
call for Linode Types in our \"standard\" class:

```Shell
curl \"https://api.linode.com/v4/linode/types\" \\
  -H '
    X-Filter: {
      \"class\": \"standard\"
    }'
```

The filter object's keys are the keys of the object you're filtering,
and the values are accepted values. You can add multiple filters by
including more than one key. For example, filtering for \"standard\" Linode
Types that offer one vcpu:

```Shell
 curl \"https://api.linode.com/v4/linode/types\" \\
  -H '
    X-Filter: {
      \"class\": \"standard\",
      \"vcpus\": 1
    }'
```

In the above example, both filters are combined with an \"and\" operation.
However, if you wanted either Types with one vcpu or Types in our \"standard\"
class, you can add an operator:

 ```Shell
curl \"https://api.linode.com/v4/linode/types\" \\
  -H '
    X-Filter: {
      \"+or\": [
        { \"vcpus\": 1 },
        { \"class\": \"standard\" }
      ]
    }'
```

Each filter in the `+or` array is its own filter object, and all conditions
in it are combined with an \"and\" operation as they were in the previous example.

Other operators are also available. Operators are keys of a Filter JSON
object. Their value must be of the appropriate type, and they are evaluated
as described below:

| OPERATOR | TYPE   | DESCRIPTION                       |
|----------|--------|-----------------------------------|
| +and     | array  | All conditions must be true.       |
| +or      | array  | One condition must be true.        |
| +gt      | number | Value must be greater than number. |
| +gte     | number | Value must be greater than or equal to number. |
| +lt      | number | Value must be less than number. |
| +lte     | number | Value must be less than or equal to number. |
| +contains | string | Given string must be in the value. |
| +neq      | string | Does not equal the value.          |
| +order_by | string | Attribute to order the results by - must be filterable. |
| +order    | string | Either \"asc\" or \"desc\". Defaults to \"asc\". Requires `+order_by`. |

For example, filtering for [Linode Types](/docs/api/linode-types/)
that offer memory equal to or higher than 61440:

```Shell
curl \"https://api.linode.com/v4/linode/types\" \\
  -H '
    X-Filter: {
      \"memory\": {
        \"+gte\": 61440
      }
    }'
```

You can combine and nest operators to construct arbitrarily-complex queries.
For example, give me all [Linode Types](/docs/api/linode-types/)
which are either `standard` or `highmem` class, or
have between 12 and 20 vcpus:

```Shell
curl \"https://api.linode.com/v4/linode/types\" \\
  -H '
    X-Filter: {
      \"+or\": [
        {
          \"+or\": [
            {
              \"class\": \"standard\"
            },
            {
              \"class\": \"highmem\"
            }
          ]
        },
        {
          \"+and\": [
            {
              \"vcpus\": {
                \"+gte\": 12
              }
            },
            {
              \"vcpus\": {
                \"+lte\": 20
              }
            }
          ]
        }
      ]
    }'
```

## Rate Limiting

With the Linode API, you can make up to 1,600 general API requests every two minutes per user as
determined by IP adddress or by OAuth token. Additionally, there are endpoint specfic limits defined below.

**Note:** There may be rate limiting applied at other levels outside of the API, for example, at the load balancer.

`/stats` endpoints have their own dedicated limits of 100 requests per minute per user.
These endpoints are:

* [View Linode Statistics](/docs/api/linode-instances/#linode-statistics-view)
* [View Linode Statistics (year/month)](/docs/api/linode-instances/#statistics-yearmonth-view)
* [View NodeBalancer Statistics](/docs/api/nodebalancers/#nodebalancer-statistics-view)
* [List Managed Stats](/docs/api/managed/#managed-stats-list)

Object Storage endpoints have a dedicated limit of 750 requests per second per user.
The Object Storage endpoints are:

* [Object Storage Endpoints](/docs/api/object-storage/)

Opening Support Tickets has a dedicated limit of 2 requests per minute per user.
That endpoint is:

* [Open Support Ticket](/docs/api/support/#support-ticket-open)

Accepting Service Transfers has a dedicated limit of 2 requests per minute per user.
That endpoint is:

* [Service Transfer Accept](/docs/api/account/#service-transfer-accept)

## CLI (Command Line Interface)

The <a href=\"https://github.com/linode/linode-cli\" target=\"_top\">Linode CLI</a> allows you to easily
work with the API using intuitive and simple syntax. It requires a
[Personal Access Token](/docs/api/#personal-access-token)
for authentication, and gives you access to all of the features and functionality
of the Linode API that are documented here with CLI examples.

Endpoints that do not have CLI examples are currently unavailable through the CLI, but
can be accessed via other methods such as Shell commands and other third-party applications.


For more information, please visit [https://linode.com](https://linode.com).

## Installation & Usage

### Requirements

PHP 7.3 and later.
Should also work with PHP 8.0 but has not been tested.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 'token_example'; // string | The UUID of the Entity Transfer.

try {
    $result = $apiInstance->acceptEntityTransfer($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->acceptEntityTransfer: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.linode.com/v4*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountApi* | [**acceptEntityTransfer**](docs/Api/AccountApi.md#acceptentitytransfer) | **POST** /account/entity-transfers/{token}/accept | Entity Transfer Accept
*AccountApi* | [**acceptServiceTransfer**](docs/Api/AccountApi.md#acceptservicetransfer) | **POST** /account/service-transfers/{token}/accept | Service Transfer Accept
*AccountApi* | [**cancelAccount**](docs/Api/AccountApi.md#cancelaccount) | **POST** /account/cancel | Account Cancel
*AccountApi* | [**createClient**](docs/Api/AccountApi.md#createclient) | **POST** /account/oauth-clients | OAuth Client Create
*AccountApi* | [**createCreditCard**](docs/Api/AccountApi.md#createcreditcard) | **POST** /account/credit-card | Credit Card Add/Edit
*AccountApi* | [**createEntityTransfer**](docs/Api/AccountApi.md#createentitytransfer) | **POST** /account/entity-transfers | Entity Transfer Create
*AccountApi* | [**createPayPalPayment**](docs/Api/AccountApi.md#createpaypalpayment) | **POST** /account/payments/paypal | PayPal Payment Stage
*AccountApi* | [**createPayment**](docs/Api/AccountApi.md#createpayment) | **POST** /account/payments | Payment Make
*AccountApi* | [**createPaymentMethod**](docs/Api/AccountApi.md#createpaymentmethod) | **POST** /account/payment-methods | Payment Method Add
*AccountApi* | [**createPromoCredit**](docs/Api/AccountApi.md#createpromocredit) | **POST** /account/promo-codes | Promo Credit Add
*AccountApi* | [**createServiceTransfer**](docs/Api/AccountApi.md#createservicetransfer) | **POST** /account/service-transfers | Service Transfer Create
*AccountApi* | [**createUser**](docs/Api/AccountApi.md#createuser) | **POST** /account/users | User Create
*AccountApi* | [**deleteClient**](docs/Api/AccountApi.md#deleteclient) | **DELETE** /account/oauth-clients/{clientId} | OAuth Client Delete
*AccountApi* | [**deleteEntityTransfer**](docs/Api/AccountApi.md#deleteentitytransfer) | **DELETE** /account/entity-transfers/{token} | Entity Transfer Cancel
*AccountApi* | [**deletePaymentMethod**](docs/Api/AccountApi.md#deletepaymentmethod) | **DELETE** /account/payment-methods/{paymentMethodId} | Payment Method Delete
*AccountApi* | [**deleteServiceTransfer**](docs/Api/AccountApi.md#deleteservicetransfer) | **DELETE** /account/service-transfers/{token} | Service Transfer Cancel
*AccountApi* | [**deleteUser**](docs/Api/AccountApi.md#deleteuser) | **DELETE** /account/users/{username} | User Delete
*AccountApi* | [**enableAccountManged**](docs/Api/AccountApi.md#enableaccountmanged) | **POST** /account/settings/managed-enable | Linode Managed Enable
*AccountApi* | [**eventRead**](docs/Api/AccountApi.md#eventread) | **POST** /account/events/{eventId}/read | Event Mark as Read
*AccountApi* | [**eventSeen**](docs/Api/AccountApi.md#eventseen) | **POST** /account/events/{eventId}/seen | Event Mark as Seen
*AccountApi* | [**executePayPalPayment**](docs/Api/AccountApi.md#executepaypalpayment) | **POST** /account/payments/paypal/execute | Staged/Approved PayPal Payment Execute
*AccountApi* | [**getAccount**](docs/Api/AccountApi.md#getaccount) | **GET** /account | Account View
*AccountApi* | [**getAccountLogin**](docs/Api/AccountApi.md#getaccountlogin) | **GET** /account/logins/{loginId} | Login View
*AccountApi* | [**getAccountLogins**](docs/Api/AccountApi.md#getaccountlogins) | **GET** /account/logins | User Logins List All
*AccountApi* | [**getAccountSettings**](docs/Api/AccountApi.md#getaccountsettings) | **GET** /account/settings | Account Settings View
*AccountApi* | [**getClient**](docs/Api/AccountApi.md#getclient) | **GET** /account/oauth-clients/{clientId} | OAuth Client View
*AccountApi* | [**getClientThumbnail**](docs/Api/AccountApi.md#getclientthumbnail) | **GET** /account/oauth-clients/{clientId}/thumbnail | OAuth Client Thumbnail View
*AccountApi* | [**getClients**](docs/Api/AccountApi.md#getclients) | **GET** /account/oauth-clients | OAuth Clients List
*AccountApi* | [**getEntityTransfer**](docs/Api/AccountApi.md#getentitytransfer) | **GET** /account/entity-transfers/{token} | Entity Transfer View
*AccountApi* | [**getEntityTransfers**](docs/Api/AccountApi.md#getentitytransfers) | **GET** /account/entity-transfers | Entity Transfers List
*AccountApi* | [**getEvent**](docs/Api/AccountApi.md#getevent) | **GET** /account/events/{eventId} | Event View
*AccountApi* | [**getEvents**](docs/Api/AccountApi.md#getevents) | **GET** /account/events | Events List
*AccountApi* | [**getInvoice**](docs/Api/AccountApi.md#getinvoice) | **GET** /account/invoices/{invoiceId} | Invoice View
*AccountApi* | [**getInvoiceItems**](docs/Api/AccountApi.md#getinvoiceitems) | **GET** /account/invoices/{invoiceId}/items | Invoice Items List
*AccountApi* | [**getInvoices**](docs/Api/AccountApi.md#getinvoices) | **GET** /account/invoices | Invoices List
*AccountApi* | [**getMaintenance**](docs/Api/AccountApi.md#getmaintenance) | **GET** /account/maintenance | Maintenance List
*AccountApi* | [**getNotifications**](docs/Api/AccountApi.md#getnotifications) | **GET** /account/notifications | Notifications List
*AccountApi* | [**getPayment**](docs/Api/AccountApi.md#getpayment) | **GET** /account/payments/{paymentId} | Payment View
*AccountApi* | [**getPaymentMethod**](docs/Api/AccountApi.md#getpaymentmethod) | **GET** /account/payment-methods/{paymentMethodId} | Payment Method View
*AccountApi* | [**getPaymentMethods**](docs/Api/AccountApi.md#getpaymentmethods) | **GET** /account/payment-methods | Payment Methods List
*AccountApi* | [**getPayments**](docs/Api/AccountApi.md#getpayments) | **GET** /account/payments | Payments List
*AccountApi* | [**getServiceTransfer**](docs/Api/AccountApi.md#getservicetransfer) | **GET** /account/service-transfers/{token} | Service Transfer View
*AccountApi* | [**getServiceTransfers**](docs/Api/AccountApi.md#getservicetransfers) | **GET** /account/service-transfers | Service Transfers List
*AccountApi* | [**getTransfer**](docs/Api/AccountApi.md#gettransfer) | **GET** /account/transfer | Network Utilization View
*AccountApi* | [**getUser**](docs/Api/AccountApi.md#getuser) | **GET** /account/users/{username} | User View
*AccountApi* | [**getUserGrants**](docs/Api/AccountApi.md#getusergrants) | **GET** /account/users/{username}/grants | User&#39;s Grants View
*AccountApi* | [**getUsers**](docs/Api/AccountApi.md#getusers) | **GET** /account/users | Users List
*AccountApi* | [**makePaymentMethodDefault**](docs/Api/AccountApi.md#makepaymentmethoddefault) | **POST** /account/payment-methods/{paymentMethodId}/make-default | Payment Method Make Default
*AccountApi* | [**resetClientSecret**](docs/Api/AccountApi.md#resetclientsecret) | **POST** /account/oauth-clients/{clientId}/reset-secret | OAuth Client Secret Reset
*AccountApi* | [**setClientThumbnail**](docs/Api/AccountApi.md#setclientthumbnail) | **PUT** /account/oauth-clients/{clientId}/thumbnail | OAuth Client Thumbnail Update
*AccountApi* | [**updateAccount**](docs/Api/AccountApi.md#updateaccount) | **PUT** /account | Account Update
*AccountApi* | [**updateAccountSettings**](docs/Api/AccountApi.md#updateaccountsettings) | **PUT** /account/settings | Account Settings Update
*AccountApi* | [**updateClient**](docs/Api/AccountApi.md#updateclient) | **PUT** /account/oauth-clients/{clientId} | OAuth Client Update
*AccountApi* | [**updateUser**](docs/Api/AccountApi.md#updateuser) | **PUT** /account/users/{username} | User Update
*AccountApi* | [**updateUserGrants**](docs/Api/AccountApi.md#updateusergrants) | **PUT** /account/users/{username}/grants | User&#39;s Grants Update
*DomainsApi* | [**cloneDomain**](docs/Api/DomainsApi.md#clonedomain) | **POST** /domains/{domainId}/clone | Domain Clone
*DomainsApi* | [**createDomain**](docs/Api/DomainsApi.md#createdomain) | **POST** /domains | Domain Create
*DomainsApi* | [**createDomainRecord**](docs/Api/DomainsApi.md#createdomainrecord) | **POST** /domains/{domainId}/records | Domain Record Create
*DomainsApi* | [**deleteDomain**](docs/Api/DomainsApi.md#deletedomain) | **DELETE** /domains/{domainId} | Domain Delete
*DomainsApi* | [**deleteDomainRecord**](docs/Api/DomainsApi.md#deletedomainrecord) | **DELETE** /domains/{domainId}/records/{recordId} | Domain Record Delete
*DomainsApi* | [**getDomain**](docs/Api/DomainsApi.md#getdomain) | **GET** /domains/{domainId} | Domain View
*DomainsApi* | [**getDomainRecord**](docs/Api/DomainsApi.md#getdomainrecord) | **GET** /domains/{domainId}/records/{recordId} | Domain Record View
*DomainsApi* | [**getDomainRecords**](docs/Api/DomainsApi.md#getdomainrecords) | **GET** /domains/{domainId}/records | Domain Records List
*DomainsApi* | [**getDomainZone**](docs/Api/DomainsApi.md#getdomainzone) | **GET** /domains/{domainId}/zone-file | Domain Zone File View
*DomainsApi* | [**getDomains**](docs/Api/DomainsApi.md#getdomains) | **GET** /domains | Domains List
*DomainsApi* | [**importDomain**](docs/Api/DomainsApi.md#importdomain) | **POST** /domains/import | Domain Import
*DomainsApi* | [**updateDomain**](docs/Api/DomainsApi.md#updatedomain) | **PUT** /domains/{domainId} | Domain Update
*DomainsApi* | [**updateDomainRecord**](docs/Api/DomainsApi.md#updatedomainrecord) | **PUT** /domains/{domainId}/records/{recordId} | Domain Record Update
*ImagesApi* | [**createImage**](docs/Api/ImagesApi.md#createimage) | **POST** /images | Image Create
*ImagesApi* | [**deleteImage**](docs/Api/ImagesApi.md#deleteimage) | **DELETE** /images/{imageId} | Image Delete
*ImagesApi* | [**getImage**](docs/Api/ImagesApi.md#getimage) | **GET** /images/{imageId} | Image View
*ImagesApi* | [**getImages**](docs/Api/ImagesApi.md#getimages) | **GET** /images | Images List
*ImagesApi* | [**imagesUploadPost**](docs/Api/ImagesApi.md#imagesuploadpost) | **POST** /images/upload | Image Upload
*ImagesApi* | [**updateImage**](docs/Api/ImagesApi.md#updateimage) | **PUT** /images/{imageId} | Image Update
*LinodeInstancesApi* | [**addLinodeConfig**](docs/Api/LinodeInstancesApi.md#addlinodeconfig) | **POST** /linode/instances/{linodeId}/configs | Configuration Profile Create
*LinodeInstancesApi* | [**addLinodeDisk**](docs/Api/LinodeInstancesApi.md#addlinodedisk) | **POST** /linode/instances/{linodeId}/disks | Disk Create
*LinodeInstancesApi* | [**addLinodeIP**](docs/Api/LinodeInstancesApi.md#addlinodeip) | **POST** /linode/instances/{linodeId}/ips | IPv4 Address Allocate
*LinodeInstancesApi* | [**bootLinodeInstance**](docs/Api/LinodeInstancesApi.md#bootlinodeinstance) | **POST** /linode/instances/{linodeId}/boot | Linode Boot
*LinodeInstancesApi* | [**cancelBackups**](docs/Api/LinodeInstancesApi.md#cancelbackups) | **POST** /linode/instances/{linodeId}/backups/cancel | Backups Cancel
*LinodeInstancesApi* | [**cloneLinodeDisk**](docs/Api/LinodeInstancesApi.md#clonelinodedisk) | **POST** /linode/instances/{linodeId}/disks/{diskId}/clone | Disk Clone
*LinodeInstancesApi* | [**cloneLinodeInstance**](docs/Api/LinodeInstancesApi.md#clonelinodeinstance) | **POST** /linode/instances/{linodeId}/clone | Linode Clone
*LinodeInstancesApi* | [**createLinodeInstance**](docs/Api/LinodeInstancesApi.md#createlinodeinstance) | **POST** /linode/instances | Linode Create
*LinodeInstancesApi* | [**createSnapshot**](docs/Api/LinodeInstancesApi.md#createsnapshot) | **POST** /linode/instances/{linodeId}/backups | Snapshot Create
*LinodeInstancesApi* | [**deleteDisk**](docs/Api/LinodeInstancesApi.md#deletedisk) | **DELETE** /linode/instances/{linodeId}/disks/{diskId} | Disk Delete
*LinodeInstancesApi* | [**deleteLinodeConfig**](docs/Api/LinodeInstancesApi.md#deletelinodeconfig) | **DELETE** /linode/instances/{linodeId}/configs/{configId} | Configuration Profile Delete
*LinodeInstancesApi* | [**deleteLinodeInstance**](docs/Api/LinodeInstancesApi.md#deletelinodeinstance) | **DELETE** /linode/instances/{linodeId} | Linode Delete
*LinodeInstancesApi* | [**enableBackups**](docs/Api/LinodeInstancesApi.md#enablebackups) | **POST** /linode/instances/{linodeId}/backups/enable | Backups Enable
*LinodeInstancesApi* | [**getBackup**](docs/Api/LinodeInstancesApi.md#getbackup) | **GET** /linode/instances/{linodeId}/backups/{backupId} | Backup View
*LinodeInstancesApi* | [**getBackups**](docs/Api/LinodeInstancesApi.md#getbackups) | **GET** /linode/instances/{linodeId}/backups | Backups List
*LinodeInstancesApi* | [**getKernel**](docs/Api/LinodeInstancesApi.md#getkernel) | **GET** /linode/kernels/{kernelId} | Kernel View
*LinodeInstancesApi* | [**getKernels**](docs/Api/LinodeInstancesApi.md#getkernels) | **GET** /linode/kernels | Kernels List
*LinodeInstancesApi* | [**getLinodeConfig**](docs/Api/LinodeInstancesApi.md#getlinodeconfig) | **GET** /linode/instances/{linodeId}/configs/{configId} | Configuration Profile View
*LinodeInstancesApi* | [**getLinodeConfigs**](docs/Api/LinodeInstancesApi.md#getlinodeconfigs) | **GET** /linode/instances/{linodeId}/configs | Configuration Profiles List
*LinodeInstancesApi* | [**getLinodeDisk**](docs/Api/LinodeInstancesApi.md#getlinodedisk) | **GET** /linode/instances/{linodeId}/disks/{diskId} | Disk View
*LinodeInstancesApi* | [**getLinodeDisks**](docs/Api/LinodeInstancesApi.md#getlinodedisks) | **GET** /linode/instances/{linodeId}/disks | Disks List
*LinodeInstancesApi* | [**getLinodeFirewalls**](docs/Api/LinodeInstancesApi.md#getlinodefirewalls) | **GET** /linode/instances/{linodeId}/firewalls | Firewalls List
*LinodeInstancesApi* | [**getLinodeIP**](docs/Api/LinodeInstancesApi.md#getlinodeip) | **GET** /linode/instances/{linodeId}/ips/{address} | IP Address View
*LinodeInstancesApi* | [**getLinodeIPs**](docs/Api/LinodeInstancesApi.md#getlinodeips) | **GET** /linode/instances/{linodeId}/ips | Networking Information List
*LinodeInstancesApi* | [**getLinodeInstance**](docs/Api/LinodeInstancesApi.md#getlinodeinstance) | **GET** /linode/instances/{linodeId} | Linode View
*LinodeInstancesApi* | [**getLinodeInstances**](docs/Api/LinodeInstancesApi.md#getlinodeinstances) | **GET** /linode/instances | Linodes List
*LinodeInstancesApi* | [**getLinodeNodeBalancers**](docs/Api/LinodeInstancesApi.md#getlinodenodebalancers) | **GET** /linode/instances/{linodeId}/nodebalancers | Linode NodeBalancers View
*LinodeInstancesApi* | [**getLinodeStats**](docs/Api/LinodeInstancesApi.md#getlinodestats) | **GET** /linode/instances/{linodeId}/stats | Linode Statistics View
*LinodeInstancesApi* | [**getLinodeStatsByYearMonth**](docs/Api/LinodeInstancesApi.md#getlinodestatsbyyearmonth) | **GET** /linode/instances/{linodeId}/stats/{year}/{month} | Statistics View (year/month)
*LinodeInstancesApi* | [**getLinodeTransfer**](docs/Api/LinodeInstancesApi.md#getlinodetransfer) | **GET** /linode/instances/{linodeId}/transfer | Network Transfer View
*LinodeInstancesApi* | [**getLinodeTransferByYearMonth**](docs/Api/LinodeInstancesApi.md#getlinodetransferbyyearmonth) | **GET** /linode/instances/{linodeId}/transfer/{year}/{month} | Network Transfer View (year/month)
*LinodeInstancesApi* | [**getLinodeVolumes**](docs/Api/LinodeInstancesApi.md#getlinodevolumes) | **GET** /linode/instances/{linodeId}/volumes | Linode&#39;s Volumes List
*LinodeInstancesApi* | [**migrateLinodeInstance**](docs/Api/LinodeInstancesApi.md#migratelinodeinstance) | **POST** /linode/instances/{linodeId}/migrate | DC Migration/Pending Host Migration Initiate
*LinodeInstancesApi* | [**mutateLinodeInstance**](docs/Api/LinodeInstancesApi.md#mutatelinodeinstance) | **POST** /linode/instances/{linodeId}/mutate | Linode Upgrade
*LinodeInstancesApi* | [**rebootLinodeInstance**](docs/Api/LinodeInstancesApi.md#rebootlinodeinstance) | **POST** /linode/instances/{linodeId}/reboot | Linode Reboot
*LinodeInstancesApi* | [**rebuildLinodeInstance**](docs/Api/LinodeInstancesApi.md#rebuildlinodeinstance) | **POST** /linode/instances/{linodeId}/rebuild | Linode Rebuild
*LinodeInstancesApi* | [**removeLinodeIP**](docs/Api/LinodeInstancesApi.md#removelinodeip) | **DELETE** /linode/instances/{linodeId}/ips/{address} | IPv4 Address Delete
*LinodeInstancesApi* | [**rescueLinodeInstance**](docs/Api/LinodeInstancesApi.md#rescuelinodeinstance) | **POST** /linode/instances/{linodeId}/rescue | Linode Boot into Rescue Mode
*LinodeInstancesApi* | [**resetDiskPassword**](docs/Api/LinodeInstancesApi.md#resetdiskpassword) | **POST** /linode/instances/{linodeId}/disks/{diskId}/password | Disk Root Password Reset
*LinodeInstancesApi* | [**resetLinodePassword**](docs/Api/LinodeInstancesApi.md#resetlinodepassword) | **POST** /linode/instances/{linodeId}/password | Linode Root Password Reset
*LinodeInstancesApi* | [**resizeDisk**](docs/Api/LinodeInstancesApi.md#resizedisk) | **POST** /linode/instances/{linodeId}/disks/{diskId}/resize | Disk Resize
*LinodeInstancesApi* | [**resizeLinodeInstance**](docs/Api/LinodeInstancesApi.md#resizelinodeinstance) | **POST** /linode/instances/{linodeId}/resize | Linode Resize
*LinodeInstancesApi* | [**restoreBackup**](docs/Api/LinodeInstancesApi.md#restorebackup) | **POST** /linode/instances/{linodeId}/backups/{backupId}/restore | Backup Restore
*LinodeInstancesApi* | [**shutdownLinodeInstance**](docs/Api/LinodeInstancesApi.md#shutdownlinodeinstance) | **POST** /linode/instances/{linodeId}/shutdown | Linode Shut Down
*LinodeInstancesApi* | [**updateDisk**](docs/Api/LinodeInstancesApi.md#updatedisk) | **PUT** /linode/instances/{linodeId}/disks/{diskId} | Disk Update
*LinodeInstancesApi* | [**updateLinodeConfig**](docs/Api/LinodeInstancesApi.md#updatelinodeconfig) | **PUT** /linode/instances/{linodeId}/configs/{configId} | Configuration Profile Update
*LinodeInstancesApi* | [**updateLinodeIP**](docs/Api/LinodeInstancesApi.md#updatelinodeip) | **PUT** /linode/instances/{linodeId}/ips/{address} | IP Address Update
*LinodeInstancesApi* | [**updateLinodeInstance**](docs/Api/LinodeInstancesApi.md#updatelinodeinstance) | **PUT** /linode/instances/{linodeId} | Linode Update
*LinodeKubernetesEngineLKEApi* | [**createLKECluster**](docs/Api/LinodeKubernetesEngineLKEApi.md#createlkecluster) | **POST** /lke/clusters | Kubernetes Cluster Create
*LinodeKubernetesEngineLKEApi* | [**deleteLKECluster**](docs/Api/LinodeKubernetesEngineLKEApi.md#deletelkecluster) | **DELETE** /lke/clusters/{clusterId} | Kubernetes Cluster Delete
*LinodeKubernetesEngineLKEApi* | [**deleteLKEClusterKubeconfig**](docs/Api/LinodeKubernetesEngineLKEApi.md#deletelkeclusterkubeconfig) | **DELETE** /lke/clusters/{clusterId}/kubeconfig | Kubeconfig Delete
*LinodeKubernetesEngineLKEApi* | [**deleteLKEClusterNode**](docs/Api/LinodeKubernetesEngineLKEApi.md#deletelkeclusternode) | **DELETE** /lke/clusters/{clusterId}/nodes/{nodeId} | Node Delete
*LinodeKubernetesEngineLKEApi* | [**deleteLKENodePool**](docs/Api/LinodeKubernetesEngineLKEApi.md#deletelkenodepool) | **DELETE** /lke/clusters/{clusterId}/pools/{poolId} | Node Pool Delete
*LinodeKubernetesEngineLKEApi* | [**getLKECluster**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkecluster) | **GET** /lke/clusters/{clusterId} | Kubernetes Cluster View
*LinodeKubernetesEngineLKEApi* | [**getLKEClusterAPIEndpoints**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkeclusterapiendpoints) | **GET** /lke/clusters/{clusterId}/api-endpoints | Kubernetes API Endpoints List
*LinodeKubernetesEngineLKEApi* | [**getLKEClusterKubeconfig**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkeclusterkubeconfig) | **GET** /lke/clusters/{clusterId}/kubeconfig | Kubeconfig View
*LinodeKubernetesEngineLKEApi* | [**getLKEClusterNode**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkeclusternode) | **GET** /lke/clusters/{clusterId}/nodes/{nodeId} | Node View
*LinodeKubernetesEngineLKEApi* | [**getLKEClusterPools**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkeclusterpools) | **GET** /lke/clusters/{clusterId}/pools | Node Pools List
*LinodeKubernetesEngineLKEApi* | [**getLKEClusters**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkeclusters) | **GET** /lke/clusters | Kubernetes Clusters List
*LinodeKubernetesEngineLKEApi* | [**getLKENodePool**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkenodepool) | **GET** /lke/clusters/{clusterId}/pools/{poolId} | Node Pool View
*LinodeKubernetesEngineLKEApi* | [**getLKEVersion**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkeversion) | **GET** /lke/versions/{version} | Kubernetes Version View
*LinodeKubernetesEngineLKEApi* | [**getLKEVersions**](docs/Api/LinodeKubernetesEngineLKEApi.md#getlkeversions) | **GET** /lke/versions | Kubernetes Versions List
*LinodeKubernetesEngineLKEApi* | [**postLKEClusterNodeRecycle**](docs/Api/LinodeKubernetesEngineLKEApi.md#postlkeclusternoderecycle) | **POST** /lke/clusters/{clusterId}/nodes/{nodeId}/recycle | Node Recycle
*LinodeKubernetesEngineLKEApi* | [**postLKEClusterPoolRecycle**](docs/Api/LinodeKubernetesEngineLKEApi.md#postlkeclusterpoolrecycle) | **POST** /lke/clusters/{clusterId}/pools/{poolId}/recycle | Node Pool Recycle
*LinodeKubernetesEngineLKEApi* | [**postLKEClusterPools**](docs/Api/LinodeKubernetesEngineLKEApi.md#postlkeclusterpools) | **POST** /lke/clusters/{clusterId}/pools | Node Pool Create
*LinodeKubernetesEngineLKEApi* | [**postLKEClusterRecycle**](docs/Api/LinodeKubernetesEngineLKEApi.md#postlkeclusterrecycle) | **POST** /lke/clusters/{clusterId}/recycle | Cluster Nodes Recycle
*LinodeKubernetesEngineLKEApi* | [**putLKECluster**](docs/Api/LinodeKubernetesEngineLKEApi.md#putlkecluster) | **PUT** /lke/clusters/{clusterId} | Kubernetes Cluster Update
*LinodeKubernetesEngineLKEApi* | [**putLKENodePool**](docs/Api/LinodeKubernetesEngineLKEApi.md#putlkenodepool) | **PUT** /lke/clusters/{clusterId}/pools/{poolId} | Node Pool Update
*LinodeTypesApi* | [**getLinodeType**](docs/Api/LinodeTypesApi.md#getlinodetype) | **GET** /linode/types/{typeId} | Type View
*LinodeTypesApi* | [**getLinodeTypes**](docs/Api/LinodeTypesApi.md#getlinodetypes) | **GET** /linode/types | Types List
*LongviewApi* | [**createLongviewClient**](docs/Api/LongviewApi.md#createlongviewclient) | **POST** /longview/clients | Longview Client Create
*LongviewApi* | [**deleteLongviewClient**](docs/Api/LongviewApi.md#deletelongviewclient) | **DELETE** /longview/clients/{clientId} | Longview Client Delete
*LongviewApi* | [**getLongviewClient**](docs/Api/LongviewApi.md#getlongviewclient) | **GET** /longview/clients/{clientId} | Longview Client View
*LongviewApi* | [**getLongviewClients**](docs/Api/LongviewApi.md#getlongviewclients) | **GET** /longview/clients | Longview Clients List
*LongviewApi* | [**getLongviewPlan**](docs/Api/LongviewApi.md#getlongviewplan) | **GET** /longview/plan | Longview Plan View
*LongviewApi* | [**getLongviewSubscription**](docs/Api/LongviewApi.md#getlongviewsubscription) | **GET** /longview/subscriptions/{subscriptionId} | Longview Subscription View
*LongviewApi* | [**getLongviewSubscriptions**](docs/Api/LongviewApi.md#getlongviewsubscriptions) | **GET** /longview/subscriptions | Longview Subscriptions List
*LongviewApi* | [**updateLongviewClient**](docs/Api/LongviewApi.md#updatelongviewclient) | **PUT** /longview/clients/{clientId} | Longview Client Update
*LongviewApi* | [**updateLongviewPlan**](docs/Api/LongviewApi.md#updatelongviewplan) | **PUT** /longview/plan | Longview Plan Update
*ManagedApi* | [**createManagedContact**](docs/Api/ManagedApi.md#createmanagedcontact) | **POST** /managed/contacts | Managed Contact Create
*ManagedApi* | [**createManagedCredential**](docs/Api/ManagedApi.md#createmanagedcredential) | **POST** /managed/credentials | Managed Credential Create
*ManagedApi* | [**createManagedService**](docs/Api/ManagedApi.md#createmanagedservice) | **POST** /managed/services | Managed Service Create
*ManagedApi* | [**deleteManagedContact**](docs/Api/ManagedApi.md#deletemanagedcontact) | **DELETE** /managed/contacts/{contactId} | Managed Contact Delete
*ManagedApi* | [**deleteManagedCredential**](docs/Api/ManagedApi.md#deletemanagedcredential) | **POST** /managed/credentials/{credentialId}/revoke | Managed Credential Delete
*ManagedApi* | [**deleteManagedService**](docs/Api/ManagedApi.md#deletemanagedservice) | **DELETE** /managed/services/{serviceId} | Managed Service Delete
*ManagedApi* | [**disableManagedService**](docs/Api/ManagedApi.md#disablemanagedservice) | **POST** /managed/services/{serviceId}/disable | Managed Service Disable
*ManagedApi* | [**enableManagedService**](docs/Api/ManagedApi.md#enablemanagedservice) | **POST** /managed/services/{serviceId}/enable | Managed Service Enable
*ManagedApi* | [**getManagedContact**](docs/Api/ManagedApi.md#getmanagedcontact) | **GET** /managed/contacts/{contactId} | Managed Contact View
*ManagedApi* | [**getManagedContacts**](docs/Api/ManagedApi.md#getmanagedcontacts) | **GET** /managed/contacts | Managed Contacts List
*ManagedApi* | [**getManagedCredential**](docs/Api/ManagedApi.md#getmanagedcredential) | **GET** /managed/credentials/{credentialId} | Managed Credential View
*ManagedApi* | [**getManagedCredentials**](docs/Api/ManagedApi.md#getmanagedcredentials) | **GET** /managed/credentials | Managed Credentials List
*ManagedApi* | [**getManagedIssue**](docs/Api/ManagedApi.md#getmanagedissue) | **GET** /managed/issues/{issueId} | Managed Issue View
*ManagedApi* | [**getManagedIssues**](docs/Api/ManagedApi.md#getmanagedissues) | **GET** /managed/issues | Managed Issues List
*ManagedApi* | [**getManagedLinodeSetting**](docs/Api/ManagedApi.md#getmanagedlinodesetting) | **GET** /managed/linode-settings/{linodeId} | Linode&#39;s Managed Settings View
*ManagedApi* | [**getManagedLinodeSettings**](docs/Api/ManagedApi.md#getmanagedlinodesettings) | **GET** /managed/linode-settings | Managed Linode Settings List
*ManagedApi* | [**getManagedService**](docs/Api/ManagedApi.md#getmanagedservice) | **GET** /managed/services/{serviceId} | Managed Service View
*ManagedApi* | [**getManagedServices**](docs/Api/ManagedApi.md#getmanagedservices) | **GET** /managed/services | Managed Services List
*ManagedApi* | [**getManagedStats**](docs/Api/ManagedApi.md#getmanagedstats) | **GET** /managed/stats | Managed Stats List
*ManagedApi* | [**updateManagedContact**](docs/Api/ManagedApi.md#updatemanagedcontact) | **PUT** /managed/contacts/{contactId} | Managed Contact Update
*ManagedApi* | [**updateManagedCredential**](docs/Api/ManagedApi.md#updatemanagedcredential) | **PUT** /managed/credentials/{credentialId} | Managed Credential Update
*ManagedApi* | [**updateManagedCredentialUsernamePassword**](docs/Api/ManagedApi.md#updatemanagedcredentialusernamepassword) | **POST** /managed/credentials/{credentialId}/update | Managed Credential Username and Password Update
*ManagedApi* | [**updateManagedLinodeSetting**](docs/Api/ManagedApi.md#updatemanagedlinodesetting) | **PUT** /managed/linode-settings/{linodeId} | Linode&#39;s Managed Settings Update
*ManagedApi* | [**updateManagedService**](docs/Api/ManagedApi.md#updatemanagedservice) | **PUT** /managed/services/{serviceId} | Managed Service Update
*ManagedApi* | [**viewManagedSSHKey**](docs/Api/ManagedApi.md#viewmanagedsshkey) | **GET** /managed/credentials/sshkey | Managed SSH Key View
*NetworkingApi* | [**allocateIP**](docs/Api/NetworkingApi.md#allocateip) | **POST** /networking/ips | IP Address Allocate
*NetworkingApi* | [**assignIPs**](docs/Api/NetworkingApi.md#assignips) | **POST** /networking/ipv4/assign | Linodes Assign IPs
*NetworkingApi* | [**createFirewallDevice**](docs/Api/NetworkingApi.md#createfirewalldevice) | **POST** /networking/firewalls/{firewallId}/devices | Firewall Device Create
*NetworkingApi* | [**createFirewalls**](docs/Api/NetworkingApi.md#createfirewalls) | **POST** /networking/firewalls | Firewall Create
*NetworkingApi* | [**deleteFirewall**](docs/Api/NetworkingApi.md#deletefirewall) | **DELETE** /networking/firewalls/{firewallId} | Firewall Delete
*NetworkingApi* | [**deleteFirewallDevice**](docs/Api/NetworkingApi.md#deletefirewalldevice) | **DELETE** /networking/firewalls/{firewallId}/devices/{deviceId} | Firewall Device Delete
*NetworkingApi* | [**getFirewall**](docs/Api/NetworkingApi.md#getfirewall) | **GET** /networking/firewalls/{firewallId} | Firewall View
*NetworkingApi* | [**getFirewallDevice**](docs/Api/NetworkingApi.md#getfirewalldevice) | **GET** /networking/firewalls/{firewallId}/devices/{deviceId} | Firewall Device View
*NetworkingApi* | [**getFirewallDevices**](docs/Api/NetworkingApi.md#getfirewalldevices) | **GET** /networking/firewalls/{firewallId}/devices | Firewall Devices List
*NetworkingApi* | [**getFirewallRules**](docs/Api/NetworkingApi.md#getfirewallrules) | **GET** /networking/firewalls/{firewallId}/rules | Firewall Rules List
*NetworkingApi* | [**getFirewalls**](docs/Api/NetworkingApi.md#getfirewalls) | **GET** /networking/firewalls | Firewalls List
*NetworkingApi* | [**getIP**](docs/Api/NetworkingApi.md#getip) | **GET** /networking/ips/{address} | IP Address View
*NetworkingApi* | [**getIPs**](docs/Api/NetworkingApi.md#getips) | **GET** /networking/ips | IP Addresses List
*NetworkingApi* | [**getIPv6Pools**](docs/Api/NetworkingApi.md#getipv6pools) | **GET** /networking/ipv6/pools | IPv6 Pools List
*NetworkingApi* | [**getIPv6Ranges**](docs/Api/NetworkingApi.md#getipv6ranges) | **GET** /networking/ipv6/ranges | IPv6 Ranges List
*NetworkingApi* | [**getVLANs**](docs/Api/NetworkingApi.md#getvlans) | **GET** /networking/vlans | VLANs List
*NetworkingApi* | [**shareIPs**](docs/Api/NetworkingApi.md#shareips) | **POST** /networking/ipv4/share | IP Sharing Configure
*NetworkingApi* | [**updateFirewall**](docs/Api/NetworkingApi.md#updatefirewall) | **PUT** /networking/firewalls/{firewallId} | Firewall Update
*NetworkingApi* | [**updateFirewallRules**](docs/Api/NetworkingApi.md#updatefirewallrules) | **PUT** /networking/firewalls/{firewallId}/rules | Firewall Rules Update
*NetworkingApi* | [**updateIP**](docs/Api/NetworkingApi.md#updateip) | **PUT** /networking/ips/{address} | IP Address RDNS Update
*NodeBalancersApi* | [**createNodeBalancer**](docs/Api/NodeBalancersApi.md#createnodebalancer) | **POST** /nodebalancers | NodeBalancer Create
*NodeBalancersApi* | [**createNodeBalancerConfig**](docs/Api/NodeBalancersApi.md#createnodebalancerconfig) | **POST** /nodebalancers/{nodeBalancerId}/configs | Config Create
*NodeBalancersApi* | [**createNodeBalancerNode**](docs/Api/NodeBalancersApi.md#createnodebalancernode) | **POST** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes | Node Create
*NodeBalancersApi* | [**deleteNodeBalancer**](docs/Api/NodeBalancersApi.md#deletenodebalancer) | **DELETE** /nodebalancers/{nodeBalancerId} | NodeBalancer Delete
*NodeBalancersApi* | [**deleteNodeBalancerConfig**](docs/Api/NodeBalancersApi.md#deletenodebalancerconfig) | **DELETE** /nodebalancers/{nodeBalancerId}/configs/{configId} | Config Delete
*NodeBalancersApi* | [**deleteNodeBalancerConfigNode**](docs/Api/NodeBalancersApi.md#deletenodebalancerconfignode) | **DELETE** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId} | Node Delete
*NodeBalancersApi* | [**getNodeBalancer**](docs/Api/NodeBalancersApi.md#getnodebalancer) | **GET** /nodebalancers/{nodeBalancerId} | NodeBalancer View
*NodeBalancersApi* | [**getNodeBalancerConfig**](docs/Api/NodeBalancersApi.md#getnodebalancerconfig) | **GET** /nodebalancers/{nodeBalancerId}/configs/{configId} | Config View
*NodeBalancersApi* | [**getNodeBalancerConfigNodes**](docs/Api/NodeBalancersApi.md#getnodebalancerconfignodes) | **GET** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes | Nodes List
*NodeBalancersApi* | [**getNodeBalancerConfigs**](docs/Api/NodeBalancersApi.md#getnodebalancerconfigs) | **GET** /nodebalancers/{nodeBalancerId}/configs | Configs List
*NodeBalancersApi* | [**getNodeBalancerNode**](docs/Api/NodeBalancersApi.md#getnodebalancernode) | **GET** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId} | Node View
*NodeBalancersApi* | [**getNodeBalancers**](docs/Api/NodeBalancersApi.md#getnodebalancers) | **GET** /nodebalancers | NodeBalancers List
*NodeBalancersApi* | [**nodebalancersNodeBalancerIdStatsGet**](docs/Api/NodeBalancersApi.md#nodebalancersnodebalanceridstatsget) | **GET** /nodebalancers/{nodeBalancerId}/stats | NodeBalancer Statistics View
*NodeBalancersApi* | [**rebuildNodeBalancerConfig**](docs/Api/NodeBalancersApi.md#rebuildnodebalancerconfig) | **POST** /nodebalancers/{nodeBalancerId}/configs/{configId}/rebuild | Config Rebuild
*NodeBalancersApi* | [**updateNodeBalancer**](docs/Api/NodeBalancersApi.md#updatenodebalancer) | **PUT** /nodebalancers/{nodeBalancerId} | NodeBalancer Update
*NodeBalancersApi* | [**updateNodeBalancerConfig**](docs/Api/NodeBalancersApi.md#updatenodebalancerconfig) | **PUT** /nodebalancers/{nodeBalancerId}/configs/{configId} | Config Update
*NodeBalancersApi* | [**updateNodeBalancerNode**](docs/Api/NodeBalancersApi.md#updatenodebalancernode) | **PUT** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId} | Node Update
*ObjectStorageApi* | [**cancelObjectStorage**](docs/Api/ObjectStorageApi.md#cancelobjectstorage) | **POST** /object-storage/cancel | Object Storage Cancel
*ObjectStorageApi* | [**createObjectStorageBucket**](docs/Api/ObjectStorageApi.md#createobjectstoragebucket) | **POST** /object-storage/buckets | Object Storage Bucket Create
*ObjectStorageApi* | [**createObjectStorageKeys**](docs/Api/ObjectStorageApi.md#createobjectstoragekeys) | **POST** /object-storage/keys | Object Storage Key Create
*ObjectStorageApi* | [**createObjectStorageObjectURL**](docs/Api/ObjectStorageApi.md#createobjectstorageobjecturl) | **POST** /object-storage/buckets/{clusterId}/{bucket}/object-url | Object Storage Object URL Create
*ObjectStorageApi* | [**createObjectStorageSSL**](docs/Api/ObjectStorageApi.md#createobjectstoragessl) | **POST** /object-storage/buckets/{clusterId}/{bucket}/ssl | Object Storage TLS/SSL Cert Upload
*ObjectStorageApi* | [**deleteObjectStorageBucket**](docs/Api/ObjectStorageApi.md#deleteobjectstoragebucket) | **DELETE** /object-storage/buckets/{clusterId}/{bucket} | Object Storage Bucket Remove
*ObjectStorageApi* | [**deleteObjectStorageKey**](docs/Api/ObjectStorageApi.md#deleteobjectstoragekey) | **DELETE** /object-storage/keys/{keyId} | Object Storage Key Revoke
*ObjectStorageApi* | [**deleteObjectStorageSSL**](docs/Api/ObjectStorageApi.md#deleteobjectstoragessl) | **DELETE** /object-storage/buckets/{clusterId}/{bucket}/ssl | Object Storage TLS/SSL Cert Delete
*ObjectStorageApi* | [**getObjectStorageBucket**](docs/Api/ObjectStorageApi.md#getobjectstoragebucket) | **GET** /object-storage/buckets/{clusterId}/{bucket} | Object Storage Bucket View
*ObjectStorageApi* | [**getObjectStorageBucketContent**](docs/Api/ObjectStorageApi.md#getobjectstoragebucketcontent) | **GET** /object-storage/buckets/{clusterId}/{bucket}/object-list | Object Storage Bucket Contents List
*ObjectStorageApi* | [**getObjectStorageBucketinCluster**](docs/Api/ObjectStorageApi.md#getobjectstoragebucketincluster) | **GET** /object-storage/buckets/{clusterId} | Object Storage Buckets in Cluster List
*ObjectStorageApi* | [**getObjectStorageBuckets**](docs/Api/ObjectStorageApi.md#getobjectstoragebuckets) | **GET** /object-storage/buckets | Object Storage Buckets List
*ObjectStorageApi* | [**getObjectStorageCluster**](docs/Api/ObjectStorageApi.md#getobjectstoragecluster) | **GET** /object-storage/clusters/{clusterId} | Cluster View
*ObjectStorageApi* | [**getObjectStorageClusters**](docs/Api/ObjectStorageApi.md#getobjectstorageclusters) | **GET** /object-storage/clusters | Clusters List
*ObjectStorageApi* | [**getObjectStorageKey**](docs/Api/ObjectStorageApi.md#getobjectstoragekey) | **GET** /object-storage/keys/{keyId} | Object Storage Key View
*ObjectStorageApi* | [**getObjectStorageKeys**](docs/Api/ObjectStorageApi.md#getobjectstoragekeys) | **GET** /object-storage/keys | Object Storage Keys List
*ObjectStorageApi* | [**getObjectStorageSSL**](docs/Api/ObjectStorageApi.md#getobjectstoragessl) | **GET** /object-storage/buckets/{clusterId}/{bucket}/ssl | Object Storage TLS/SSL Cert View
*ObjectStorageApi* | [**getObjectStorageTransfer**](docs/Api/ObjectStorageApi.md#getobjectstoragetransfer) | **GET** /object-storage/transfer | Object Storage Transfer View
*ObjectStorageApi* | [**modifyObjectStorageBucketAccess**](docs/Api/ObjectStorageApi.md#modifyobjectstoragebucketaccess) | **POST** /object-storage/buckets/{clusterId}/{bucket}/access | Object Storage Bucket Access Modify
*ObjectStorageApi* | [**updateObjectStorageBucketACL**](docs/Api/ObjectStorageApi.md#updateobjectstoragebucketacl) | **PUT** /object-storage/buckets/{clusterId}/{bucket}/object-acl | Object Storage Object ACL Config Update
*ObjectStorageApi* | [**updateObjectStorageBucketAccess**](docs/Api/ObjectStorageApi.md#updateobjectstoragebucketaccess) | **PUT** /object-storage/buckets/{clusterId}/{bucket}/access | Object Storage Bucket Access Update
*ObjectStorageApi* | [**updateObjectStorageKey**](docs/Api/ObjectStorageApi.md#updateobjectstoragekey) | **PUT** /object-storage/keys/{keyId} | Object Storage Key Update
*ObjectStorageApi* | [**viewObjectStorageBucketACL**](docs/Api/ObjectStorageApi.md#viewobjectstoragebucketacl) | **GET** /object-storage/buckets/{clusterId}/{bucket}/object-acl | Object Storage Object ACL Config View
*ProfileApi* | [**addSSHKey**](docs/Api/ProfileApi.md#addsshkey) | **POST** /profile/sshkeys | SSH Key Add
*ProfileApi* | [**createPersonalAccessToken**](docs/Api/ProfileApi.md#createpersonalaccesstoken) | **POST** /profile/tokens | Personal Access Token Create
*ProfileApi* | [**deletePersonalAccessToken**](docs/Api/ProfileApi.md#deletepersonalaccesstoken) | **DELETE** /profile/tokens/{tokenId} | Personal Access Token Revoke
*ProfileApi* | [**deleteProfileApp**](docs/Api/ProfileApi.md#deleteprofileapp) | **DELETE** /profile/apps/{appId} | App Access Revoke
*ProfileApi* | [**deleteSSHKey**](docs/Api/ProfileApi.md#deletesshkey) | **DELETE** /profile/sshkeys/{sshKeyId} | SSH Key Delete
*ProfileApi* | [**getDevices**](docs/Api/ProfileApi.md#getdevices) | **GET** /profile/devices | Trusted Devices List
*ProfileApi* | [**getPersonalAccessToken**](docs/Api/ProfileApi.md#getpersonalaccesstoken) | **GET** /profile/tokens/{tokenId} | Personal Access Token View
*ProfileApi* | [**getPersonalAccessTokens**](docs/Api/ProfileApi.md#getpersonalaccesstokens) | **GET** /profile/tokens | Personal Access Tokens List
*ProfileApi* | [**getProfile**](docs/Api/ProfileApi.md#getprofile) | **GET** /profile | Profile View
*ProfileApi* | [**getProfileApp**](docs/Api/ProfileApi.md#getprofileapp) | **GET** /profile/apps/{appId} | Authorized App View
*ProfileApi* | [**getProfileApps**](docs/Api/ProfileApi.md#getprofileapps) | **GET** /profile/apps | Authorized Apps List
*ProfileApi* | [**getProfileGrants**](docs/Api/ProfileApi.md#getprofilegrants) | **GET** /profile/grants | Grants List
*ProfileApi* | [**getProfileLogin**](docs/Api/ProfileApi.md#getprofilelogin) | **GET** /profile/logins/{loginId} | Login View
*ProfileApi* | [**getProfileLogins**](docs/Api/ProfileApi.md#getprofilelogins) | **GET** /profile/logins | Logins List
*ProfileApi* | [**getSSHKey**](docs/Api/ProfileApi.md#getsshkey) | **GET** /profile/sshkeys/{sshKeyId} | SSH Key View
*ProfileApi* | [**getSSHKeys**](docs/Api/ProfileApi.md#getsshkeys) | **GET** /profile/sshkeys | SSH Keys List
*ProfileApi* | [**getTrustedDevice**](docs/Api/ProfileApi.md#gettrusteddevice) | **GET** /profile/devices/{deviceId} | Trusted Device View
*ProfileApi* | [**getUserPreferences**](docs/Api/ProfileApi.md#getuserpreferences) | **GET** /profile/preferences | User Preferences View
*ProfileApi* | [**revokeTrustedDevice**](docs/Api/ProfileApi.md#revoketrusteddevice) | **DELETE** /profile/devices/{deviceId} | Trusted Device Revoke
*ProfileApi* | [**tfaConfirm**](docs/Api/ProfileApi.md#tfaconfirm) | **POST** /profile/tfa-enable-confirm | Two Factor Authentication Confirm/Enable
*ProfileApi* | [**tfaDisable**](docs/Api/ProfileApi.md#tfadisable) | **POST** /profile/tfa-disable | Two Factor Authentication Disable
*ProfileApi* | [**tfaEnable**](docs/Api/ProfileApi.md#tfaenable) | **POST** /profile/tfa-enable | Two Factor Secret Create
*ProfileApi* | [**updatePersonalAccessToken**](docs/Api/ProfileApi.md#updatepersonalaccesstoken) | **PUT** /profile/tokens/{tokenId} | Personal Access Token Update
*ProfileApi* | [**updateProfile**](docs/Api/ProfileApi.md#updateprofile) | **PUT** /profile | Profile Update
*ProfileApi* | [**updateSSHKey**](docs/Api/ProfileApi.md#updatesshkey) | **PUT** /profile/sshkeys/{sshKeyId} | SSH Key Update
*ProfileApi* | [**updateUserPreferences**](docs/Api/ProfileApi.md#updateuserpreferences) | **PUT** /profile/preferences | User Preferences Update
*RegionsApi* | [**getRegion**](docs/Api/RegionsApi.md#getregion) | **GET** /regions/{regionId} | Region View
*RegionsApi* | [**getRegions**](docs/Api/RegionsApi.md#getregions) | **GET** /regions | Regions List
*StackScriptsApi* | [**addStackScript**](docs/Api/StackScriptsApi.md#addstackscript) | **POST** /linode/stackscripts | StackScript Create
*StackScriptsApi* | [**deleteStackScript**](docs/Api/StackScriptsApi.md#deletestackscript) | **DELETE** /linode/stackscripts/{stackscriptId} | StackScript Delete
*StackScriptsApi* | [**getStackScript**](docs/Api/StackScriptsApi.md#getstackscript) | **GET** /linode/stackscripts/{stackscriptId} | StackScript View
*StackScriptsApi* | [**getStackScripts**](docs/Api/StackScriptsApi.md#getstackscripts) | **GET** /linode/stackscripts | StackScripts List
*StackScriptsApi* | [**updateStackScript**](docs/Api/StackScriptsApi.md#updatestackscript) | **PUT** /linode/stackscripts/{stackscriptId} | StackScript Update
*SupportApi* | [**closeTicket**](docs/Api/SupportApi.md#closeticket) | **POST** /support/tickets/{ticketId}/close | Support Ticket Close
*SupportApi* | [**createTicket**](docs/Api/SupportApi.md#createticket) | **POST** /support/tickets | Support Ticket Open
*SupportApi* | [**createTicketAttachment**](docs/Api/SupportApi.md#createticketattachment) | **POST** /support/tickets/{ticketId}/attachments | Ticket Attachment Create
*SupportApi* | [**createTicketReply**](docs/Api/SupportApi.md#createticketreply) | **POST** /support/tickets/{ticketId}/replies | Reply Create
*SupportApi* | [**getTicket**](docs/Api/SupportApi.md#getticket) | **GET** /support/tickets/{ticketId} | Support Ticket View
*SupportApi* | [**getTicketReplies**](docs/Api/SupportApi.md#getticketreplies) | **GET** /support/tickets/{ticketId}/replies | Replies List
*SupportApi* | [**getTickets**](docs/Api/SupportApi.md#gettickets) | **GET** /support/tickets | Support Tickets List
*TagsApi* | [**createTag**](docs/Api/TagsApi.md#createtag) | **POST** /tags | New Tag Create
*TagsApi* | [**deleteTag**](docs/Api/TagsApi.md#deletetag) | **DELETE** /tags/{label} | Tag Delete
*TagsApi* | [**getTaggedObjects**](docs/Api/TagsApi.md#gettaggedobjects) | **GET** /tags/{label} | Tagged Objects List
*TagsApi* | [**getTags**](docs/Api/TagsApi.md#gettags) | **GET** /tags | Tags List
*VolumesApi* | [**attachVolume**](docs/Api/VolumesApi.md#attachvolume) | **POST** /volumes/{volumeId}/attach | Volume Attach
*VolumesApi* | [**cloneVolume**](docs/Api/VolumesApi.md#clonevolume) | **POST** /volumes/{volumeId}/clone | Volume Clone
*VolumesApi* | [**createVolume**](docs/Api/VolumesApi.md#createvolume) | **POST** /volumes | Volume Create
*VolumesApi* | [**deleteVolume**](docs/Api/VolumesApi.md#deletevolume) | **DELETE** /volumes/{volumeId} | Volume Delete
*VolumesApi* | [**detachVolume**](docs/Api/VolumesApi.md#detachvolume) | **POST** /volumes/{volumeId}/detach | Volume Detach
*VolumesApi* | [**getVolume**](docs/Api/VolumesApi.md#getvolume) | **GET** /volumes/{volumeId} | Volume View
*VolumesApi* | [**getVolumes**](docs/Api/VolumesApi.md#getvolumes) | **GET** /volumes | Volumes List
*VolumesApi* | [**resizeVolume**](docs/Api/VolumesApi.md#resizevolume) | **POST** /volumes/{volumeId}/resize | Volume Resize
*VolumesApi* | [**updateVolume**](docs/Api/VolumesApi.md#updatevolume) | **PUT** /volumes/{volumeId} | Volume Update

## Models

- [Account](docs/Model/Account.md)
- [AccountCreditCard](docs/Model/AccountCreditCard.md)
- [AccountSettings](docs/Model/AccountSettings.md)
- [AuthorizedApp](docs/Model/AuthorizedApp.md)
- [Backup](docs/Model/Backup.md)
- [BackupDisks](docs/Model/BackupDisks.md)
- [CreditCard](docs/Model/CreditCard.md)
- [Device](docs/Model/Device.md)
- [Devices](docs/Model/Devices.md)
- [Disk](docs/Model/Disk.md)
- [DiskRequest](docs/Model/DiskRequest.md)
- [Domain](docs/Model/Domain.md)
- [DomainRecord](docs/Model/DomainRecord.md)
- [EntityTransfer](docs/Model/EntityTransfer.md)
- [EntityTransferEntities](docs/Model/EntityTransferEntities.md)
- [ErrorObject](docs/Model/ErrorObject.md)
- [Event](docs/Model/Event.md)
- [EventEntity](docs/Model/EventEntity.md)
- [EventSecondaryEntity](docs/Model/EventSecondaryEntity.md)
- [Firewall](docs/Model/Firewall.md)
- [FirewallDevices](docs/Model/FirewallDevices.md)
- [FirewallDevicesEntity](docs/Model/FirewallDevicesEntity.md)
- [FirewallRuleConfig](docs/Model/FirewallRuleConfig.md)
- [FirewallRuleConfigAddresses](docs/Model/FirewallRuleConfigAddresses.md)
- [FirewallRules](docs/Model/FirewallRules.md)
- [Grant](docs/Model/Grant.md)
- [GrantsResponse](docs/Model/GrantsResponse.md)
- [GrantsResponseGlobal](docs/Model/GrantsResponseGlobal.md)
- [IPAddress](docs/Model/IPAddress.md)
- [IPAddressPrivate](docs/Model/IPAddressPrivate.md)
- [IPAddressV6LinkLocal](docs/Model/IPAddressV6LinkLocal.md)
- [IPAddressV6Slaac](docs/Model/IPAddressV6Slaac.md)
- [IPv6Pool](docs/Model/IPv6Pool.md)
- [IPv6Range](docs/Model/IPv6Range.md)
- [Image](docs/Model/Image.md)
- [InlineObject](docs/Model/InlineObject.md)
- [InlineObject1](docs/Model/InlineObject1.md)
- [InlineObject10](docs/Model/InlineObject10.md)
- [InlineObject11](docs/Model/InlineObject11.md)
- [InlineObject12](docs/Model/InlineObject12.md)
- [InlineObject13](docs/Model/InlineObject13.md)
- [InlineObject14](docs/Model/InlineObject14.md)
- [InlineObject15](docs/Model/InlineObject15.md)
- [InlineObject16](docs/Model/InlineObject16.md)
- [InlineObject17](docs/Model/InlineObject17.md)
- [InlineObject18](docs/Model/InlineObject18.md)
- [InlineObject19](docs/Model/InlineObject19.md)
- [InlineObject2](docs/Model/InlineObject2.md)
- [InlineObject20](docs/Model/InlineObject20.md)
- [InlineObject21](docs/Model/InlineObject21.md)
- [InlineObject3](docs/Model/InlineObject3.md)
- [InlineObject4](docs/Model/InlineObject4.md)
- [InlineObject5](docs/Model/InlineObject5.md)
- [InlineObject6](docs/Model/InlineObject6.md)
- [InlineObject7](docs/Model/InlineObject7.md)
- [InlineObject8](docs/Model/InlineObject8.md)
- [InlineObject9](docs/Model/InlineObject9.md)
- [InlineResponse200](docs/Model/InlineResponse200.md)
- [InlineResponse2001](docs/Model/InlineResponse2001.md)
- [InlineResponse20010](docs/Model/InlineResponse20010.md)
- [InlineResponse20011](docs/Model/InlineResponse20011.md)
- [InlineResponse20012](docs/Model/InlineResponse20012.md)
- [InlineResponse20013](docs/Model/InlineResponse20013.md)
- [InlineResponse20014](docs/Model/InlineResponse20014.md)
- [InlineResponse20015](docs/Model/InlineResponse20015.md)
- [InlineResponse20016](docs/Model/InlineResponse20016.md)
- [InlineResponse20017](docs/Model/InlineResponse20017.md)
- [InlineResponse20018](docs/Model/InlineResponse20018.md)
- [InlineResponse20018Snapshot](docs/Model/InlineResponse20018Snapshot.md)
- [InlineResponse20019](docs/Model/InlineResponse20019.md)
- [InlineResponse2002](docs/Model/InlineResponse2002.md)
- [InlineResponse20020](docs/Model/InlineResponse20020.md)
- [InlineResponse20021](docs/Model/InlineResponse20021.md)
- [InlineResponse20022](docs/Model/InlineResponse20022.md)
- [InlineResponse20023](docs/Model/InlineResponse20023.md)
- [InlineResponse20024](docs/Model/InlineResponse20024.md)
- [InlineResponse20025](docs/Model/InlineResponse20025.md)
- [InlineResponse20026](docs/Model/InlineResponse20026.md)
- [InlineResponse20027](docs/Model/InlineResponse20027.md)
- [InlineResponse20028](docs/Model/InlineResponse20028.md)
- [InlineResponse20029](docs/Model/InlineResponse20029.md)
- [InlineResponse20029Data](docs/Model/InlineResponse20029Data.md)
- [InlineResponse2003](docs/Model/InlineResponse2003.md)
- [InlineResponse20030](docs/Model/InlineResponse20030.md)
- [InlineResponse20030Data](docs/Model/InlineResponse20030Data.md)
- [InlineResponse20031](docs/Model/InlineResponse20031.md)
- [InlineResponse20032](docs/Model/InlineResponse20032.md)
- [InlineResponse20033](docs/Model/InlineResponse20033.md)
- [InlineResponse20034](docs/Model/InlineResponse20034.md)
- [InlineResponse20035](docs/Model/InlineResponse20035.md)
- [InlineResponse20036](docs/Model/InlineResponse20036.md)
- [InlineResponse20037](docs/Model/InlineResponse20037.md)
- [InlineResponse20038](docs/Model/InlineResponse20038.md)
- [InlineResponse20039](docs/Model/InlineResponse20039.md)
- [InlineResponse2004](docs/Model/InlineResponse2004.md)
- [InlineResponse20040](docs/Model/InlineResponse20040.md)
- [InlineResponse20041](docs/Model/InlineResponse20041.md)
- [InlineResponse20042](docs/Model/InlineResponse20042.md)
- [InlineResponse20043](docs/Model/InlineResponse20043.md)
- [InlineResponse20044](docs/Model/InlineResponse20044.md)
- [InlineResponse20045](docs/Model/InlineResponse20045.md)
- [InlineResponse20046](docs/Model/InlineResponse20046.md)
- [InlineResponse20047](docs/Model/InlineResponse20047.md)
- [InlineResponse20048](docs/Model/InlineResponse20048.md)
- [InlineResponse20049](docs/Model/InlineResponse20049.md)
- [InlineResponse2005](docs/Model/InlineResponse2005.md)
- [InlineResponse20050](docs/Model/InlineResponse20050.md)
- [InlineResponse20051](docs/Model/InlineResponse20051.md)
- [InlineResponse20052](docs/Model/InlineResponse20052.md)
- [InlineResponse20053](docs/Model/InlineResponse20053.md)
- [InlineResponse20054](docs/Model/InlineResponse20054.md)
- [InlineResponse20055](docs/Model/InlineResponse20055.md)
- [InlineResponse20056](docs/Model/InlineResponse20056.md)
- [InlineResponse20057](docs/Model/InlineResponse20057.md)
- [InlineResponse20058](docs/Model/InlineResponse20058.md)
- [InlineResponse20059](docs/Model/InlineResponse20059.md)
- [InlineResponse2006](docs/Model/InlineResponse2006.md)
- [InlineResponse20060](docs/Model/InlineResponse20060.md)
- [InlineResponse2007](docs/Model/InlineResponse2007.md)
- [InlineResponse2008](docs/Model/InlineResponse2008.md)
- [InlineResponse2009](docs/Model/InlineResponse2009.md)
- [InlineResponse202](docs/Model/InlineResponse202.md)
- [InlineResponse409](docs/Model/InlineResponse409.md)
- [InlineResponse409Errors](docs/Model/InlineResponse409Errors.md)
- [InlineResponseDefault](docs/Model/InlineResponseDefault.md)
- [Invoice](docs/Model/Invoice.md)
- [InvoiceItem](docs/Model/InvoiceItem.md)
- [Kernel](docs/Model/Kernel.md)
- [LKECluster](docs/Model/LKECluster.md)
- [LKENodePool](docs/Model/LKENodePool.md)
- [LKENodePoolAutoscaler](docs/Model/LKENodePoolAutoscaler.md)
- [LKENodePoolDisks](docs/Model/LKENodePoolDisks.md)
- [LKENodePoolRequestBody](docs/Model/LKENodePoolRequestBody.md)
- [LKENodePoolRequestBodyAutoscaler](docs/Model/LKENodePoolRequestBodyAutoscaler.md)
- [LKENodeStatus](docs/Model/LKENodeStatus.md)
- [LKEVersion](docs/Model/LKEVersion.md)
- [Linode](docs/Model/Linode.md)
- [LinodeAlerts](docs/Model/LinodeAlerts.md)
- [LinodeBackups](docs/Model/LinodeBackups.md)
- [LinodeBackupsSchedule](docs/Model/LinodeBackupsSchedule.md)
- [LinodeConfig](docs/Model/LinodeConfig.md)
- [LinodeConfigHelpers](docs/Model/LinodeConfigHelpers.md)
- [LinodeConfigInterface](docs/Model/LinodeConfigInterface.md)
- [LinodeRequest](docs/Model/LinodeRequest.md)
- [LinodeSpecs](docs/Model/LinodeSpecs.md)
- [LinodeStats](docs/Model/LinodeStats.md)
- [LinodeStatsIo](docs/Model/LinodeStatsIo.md)
- [LinodeStatsNetv4](docs/Model/LinodeStatsNetv4.md)
- [LinodeStatsNetv6](docs/Model/LinodeStatsNetv6.md)
- [LinodeType](docs/Model/LinodeType.md)
- [LinodeTypeAddons](docs/Model/LinodeTypeAddons.md)
- [LinodeTypeAddonsBackups](docs/Model/LinodeTypeAddonsBackups.md)
- [LinodeTypeAddonsBackupsPrice](docs/Model/LinodeTypeAddonsBackupsPrice.md)
- [LinodeTypePrice](docs/Model/LinodeTypePrice.md)
- [Login](docs/Model/Login.md)
- [LongviewClient](docs/Model/LongviewClient.md)
- [LongviewClientApps](docs/Model/LongviewClientApps.md)
- [LongviewPlan](docs/Model/LongviewPlan.md)
- [LongviewSubscription](docs/Model/LongviewSubscription.md)
- [LongviewSubscriptionPrice](docs/Model/LongviewSubscriptionPrice.md)
- [Maintenance](docs/Model/Maintenance.md)
- [MaintenanceEntity](docs/Model/MaintenanceEntity.md)
- [ManagedContact](docs/Model/ManagedContact.md)
- [ManagedContactPhone](docs/Model/ManagedContactPhone.md)
- [ManagedCredential](docs/Model/ManagedCredential.md)
- [ManagedIssue](docs/Model/ManagedIssue.md)
- [ManagedIssueEntity](docs/Model/ManagedIssueEntity.md)
- [ManagedLinodeSettings](docs/Model/ManagedLinodeSettings.md)
- [ManagedLinodeSettingsSsh](docs/Model/ManagedLinodeSettingsSsh.md)
- [ManagedService](docs/Model/ManagedService.md)
- [NodeBalancer](docs/Model/NodeBalancer.md)
- [NodeBalancerConfig](docs/Model/NodeBalancerConfig.md)
- [NodeBalancerConfigNodesStatus](docs/Model/NodeBalancerConfigNodesStatus.md)
- [NodeBalancerNode](docs/Model/NodeBalancerNode.md)
- [NodeBalancerStats](docs/Model/NodeBalancerStats.md)
- [NodeBalancerStatsData](docs/Model/NodeBalancerStatsData.md)
- [NodeBalancerStatsDataTraffic](docs/Model/NodeBalancerStatsDataTraffic.md)
- [NodeBalancerTransfer](docs/Model/NodeBalancerTransfer.md)
- [Notification](docs/Model/Notification.md)
- [NotificationEntity](docs/Model/NotificationEntity.md)
- [OAuthClient](docs/Model/OAuthClient.md)
- [ObjectStorageBucket](docs/Model/ObjectStorageBucket.md)
- [ObjectStorageCluster](docs/Model/ObjectStorageCluster.md)
- [ObjectStorageKey](docs/Model/ObjectStorageKey.md)
- [ObjectStorageKeyBucketAccess](docs/Model/ObjectStorageKeyBucketAccess.md)
- [ObjectStorageObject](docs/Model/ObjectStorageObject.md)
- [ObjectStorageSSL](docs/Model/ObjectStorageSSL.md)
- [ObjectStorageSSLResponse](docs/Model/ObjectStorageSSLResponse.md)
- [PaginationEnvelope](docs/Model/PaginationEnvelope.md)
- [PayPal](docs/Model/PayPal.md)
- [PayPalExecute](docs/Model/PayPalExecute.md)
- [Payment](docs/Model/Payment.md)
- [PaymentMethod](docs/Model/PaymentMethod.md)
- [PaymentMethodData](docs/Model/PaymentMethodData.md)
- [PaymentRequest](docs/Model/PaymentRequest.md)
- [PersonalAccessToken](docs/Model/PersonalAccessToken.md)
- [Profile](docs/Model/Profile.md)
- [ProfileReferrals](docs/Model/ProfileReferrals.md)
- [Promotion](docs/Model/Promotion.md)
- [Region](docs/Model/Region.md)
- [RegionResolvers](docs/Model/RegionResolvers.md)
- [RescueDevices](docs/Model/RescueDevices.md)
- [SSHKey](docs/Model/SSHKey.md)
- [SSHKeyRequest](docs/Model/SSHKeyRequest.md)
- [ServiceTransfer](docs/Model/ServiceTransfer.md)
- [ServiceTransferEntities](docs/Model/ServiceTransferEntities.md)
- [StackScript](docs/Model/StackScript.md)
- [StatsData](docs/Model/StatsData.md)
- [StatsDataAvailable](docs/Model/StatsDataAvailable.md)
- [SupportTicket](docs/Model/SupportTicket.md)
- [SupportTicketEntity](docs/Model/SupportTicketEntity.md)
- [SupportTicketReply](docs/Model/SupportTicketReply.md)
- [SupportTicketRequest](docs/Model/SupportTicketRequest.md)
- [Tag](docs/Model/Tag.md)
- [Transfer](docs/Model/Transfer.md)
- [TrustedDevice](docs/Model/TrustedDevice.md)
- [User](docs/Model/User.md)
- [UserDefinedField](docs/Model/UserDefinedField.md)
- [Vlans](docs/Model/Vlans.md)
- [Volume](docs/Model/Volume.md)
- [WarningObject](docs/Model/WarningObject.md)

## Authorization

### oauth

- **Type**: `OAuth`
- **Flow**: `accessCode`
- **Authorization URL**: `https://login.linode.com/oauth/authorize`
- **Scopes**: 
    - **account:read_only**: Allows access to GET information about your Account.
    - **account:read_write**: Allows access to all endpoints related to your Account.
    - **domains:read_only**: Allows access to GET Domains on your Account.
    - **domains:read_write**: Allows access to all Domain endpoints.
    - **events:read_only**: Allows access to GET your Events.
    - **events:read_write**: Allows access to all endpoints related to your Events.
    - **firewall:read_only**: Allows access to GET information about your Firewalls.
    - **firewall:read_write**: Allows acces to all Firewall endpoints.
    - **images:read_only**: Allows access to GET your Images.
    - **images:read_write**: Allows access to all endpoints related to your Images.
    - **ips:read_only**: Allows access to GET your ips.
    - **ips:read_write**: Allows access to all endpoints related to your ips.
    - **linodes:read_only**: Allows access to GET Linodes on your Account.
    - **linodes:read_write**: Allow access to all endpoints related to your Linodes.
    - **lke:read_only**: Allows access to GET LKE Clusters on your Account.
    - **lke:read_write**: Allows access to all endpoints related to LKE Clusters on your Account.
    - **longview:read_only**: Allows access to GET your Longview Clients.
    - **longview:read_write**: Allows access to all endpoints related to your Longview Clients.
    - **maintenance:read_only**: Allows access to GET information about Maintenance on your account.
    - **nodebalancers:read_only**: Allows access to GET NodeBalancers on your Account.
    - **nodebalancers:read_write**: Allows access to all NodeBalancer endpoints.
    - **object_storage:read_only**: Allows access to GET information related to your Object Storage.
    - **object_storage:read_write**: Allows access to all Object Storage endpoints.
    - **stackscripts:read_only**: Allows access to GET your StackScripts.
    - **stackscripts:read_write**: Allows access to all endpoints related to your StackScripts.
    - **volumes:read_only**: Allows access to GET your Volumes.
    - **volumes:read_write**: Allows access to all endpoints related to your Volumes.


### personalAccessToken

- **Type**: Bearer authentication

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

support@linode.com

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `4.107.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`

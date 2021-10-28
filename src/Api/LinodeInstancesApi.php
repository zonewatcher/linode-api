<?php
/**
 * LinodeInstancesApi
 * PHP version 7.3
 *
 * @category Class
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Linode API
 *
 * ## Introduction The Linode API provides the ability to programmatically manage the full range of Linode products and services.  This reference is designed to assist application developers and system administrators.  Each endpoint includes descriptions, request syntax, and examples using standard HTTP requests. Response data is returned in JSON format.   This document was generated from our OpenAPI Specification.  See the <a target=\"_top\" href=\"https://www.openapis.org\">OpenAPI website</a> for more information.  <a target=\"_top\" href=\"/docs/api/openapi.yaml\">Download the Linode OpenAPI Specification</a>.   ## Changelog  <a target=\"_top\" href=\"https://developers.linode.com/changelog\">View our Changelog</a> to see release notes on all changes made to our API.  ## Access and Authentication  Some endpoints are publicly accessible without requiring authentication. All endpoints affecting your Account, however, require either a Personal Access Token or OAuth authentication (when using third-party applications).  ### Personal Access Token  The easiest way to access the API is with a Personal Access Token (PAT) generated from the <a target=\"_top\" href=\"https://cloud.linode.com/profile/tokens\">Linode Cloud Manager</a> or the [Create Personal Access Token](/docs/api/profile/#personal-access-token-create) endpoint.  All scopes for the OAuth security model ([defined below](/docs/api/profile/#oauth)) apply to this security model as well.  #### Authentication  | Security Scheme Type: | HTTP | |-----------------------|------| | **HTTP Authorization Scheme** | bearer |  ### OAuth If you only need to access the Linode API for personal use, we recommend that you create a [personal access token](/docs/api/#personal-access-token). If you're designing an application that can authenticate with an arbitrary Linode user, then you should use the OAuth 2.0 workflows presented in this section.  For a more detailed example of an OAuth 2.0 implementation, see our guide on [How to Create an OAuth App with the Linode Python API Library](/docs/platform/api/how-to-create-an-oauth-app-with-the-linode-python-api-library/#oauth-2-authentication-exchange).  Before you implement OAuth in your application, you first need to create an OAuth client. You can do this [with the Linode API](/docs/api/account/#oauth-client-create) or [via the Cloud Manager](https://cloud.linode.com/profile/clients):    - When creating the client, you'll supply a `label` and a `redirect_uri` (referred to as the Callback URL in the Cloud Manager).   - The response from this endpoint will give you a `client_id` and a `secret`.   - Clients can be public or private, and are private by default. You can choose to make the client public when it is created.     - A private client is used with applications which can securely store the client secret (that is, the secret returned to you when you first created the client). For example, an application running on a secured server that only the developer has access to would use a private OAuth client. This is also called a confidential client in some OAuth documentation.     - A public client is used with applications where the client secret is not guaranteed to be secure. For example, a native app running on a user's computer may not be able to keep the client secret safe, as a user could potentially inspect the source of the application. So, native apps or apps that run in a user's browser should use a public client.     - Public and private clients follow different workflows, as described below.  #### OAuth Workflow  The OAuth workflow is a series of exchanges between your third-party app and Linode. The workflow is used to authenticate a user before an application can start making API calls on the user's behalf.  Notes:  - With respect to the diagram in [section 1.2 of RFC 6749](https://tools.ietf.org/html/rfc6749#section-1.2), login.linode.com (referred to in this section as the *login server*) is the Resource Owner and the Authorization Server; api.linode.com (referred to here as the *api server*) is the Resource Server. - The OAuth spec refers to the private and public workflows listed below as the [authorization code flow](https://tools.ietf.org/html/rfc6749#section-1.3.1) and [implicit flow](https://tools.ietf.org/html/rfc6749#section-1.3.2).  | PRIVATE WORKFLOW | PUBLIC WORKFLOW | |------------------|------------------| | 1.  The user visits the application's website and is directed to login with Linode. | 1.  The user visits the application's website and is directed to login with Linode. | | 2.  Your application then redirects the user to Linode's [login server](https://login.linode.com) with the client application's `client_id` and requested OAuth `scope`, which should appear in the URL of the login page. | 2.  Your application then redirects the user to Linode's [login server](https://login.linode.com) with the client application's `client_id` and requested OAuth `scope`, which should appear in the URL of the login page. | | 3.  The user logs into the login server with their username and password. | 3.  The user logs into the login server with their username and password. | | 4.  The login server redirects the user to the specificed redirect URL with a temporary authorization `code` (exchange code) in the URL. | 4.  The login server redirects the user back to your application with an OAuth `access_token` embedded in the redirect URL's hash. This is temporary and expires in two hours. No `refresh_token` is issued. Therefore, once the `access_token` expires, a new one will need to be issued by having the user log in again. | | 5.  The application issues a POST request (*see below*) to the login server with the exchange code, `client_id`, and the client application's `client_secret`. | | | 6.  The login server responds to the client application with a new OAuth `access_token` and `refresh_token`. The `access_token` is set to expire in two hours. | | | 7.  The `refresh_token` can be used by contacting the login server with the `client_id`, `client_secret`, `grant_type`, and `refresh_token` to get a new OAuth `access_token` and `refresh_token`. The new `access_token` is good for another two hours, and the new `refresh_token`, can be used to extend the session again by this same method. | |  #### OAuth Private Workflow - Additional Details  The following information expands on steps 5 through 7 of the private workflow:  Once the user has logged into Linode and you have received an exchange code, you will need to trade that exchange code for an `access_token` and `refresh_token`. You do this by making an HTTP POST request to the following address:  ``` https://login.linode.com/oauth/token ```  Make this request as `application/x-www-form-urlencoded` or as `multipart/form-data` and include the following parameters in the POST body:  | PARAMETER | DESCRIPTION | |-----------|-------------| | grant_type | The grant type you're using for renewal.  Currently only the string \"refresh_token\" is accepted. | | client_id | Your app's client ID. | | client_secret | Your app's client secret. | | code | The code you just received from the redirect. |  You'll get a response like this:  ```json {   \"scope\": \"linodes:read_write\",   \"access_token\": \"03d084436a6c91fbafd5c4b20c82e5056a2e9ce1635920c30dc8d81dc7a6665c\"   \"token_type\": \"bearer\",   \"expires_in\": 7200, } ```  Included in the reponse is an `access_token`. With this token, you can proceed to make authenticated HTTP requests to the API by adding this header to each request:  ``` Authorization: Bearer 03d084436a6c91fbafd5c4b20c82e5056a2e9ce1635920c30dc8d81dc7a6665c ```  #### OAuth Reference  | Security Scheme Type | OAuth 2.0 | |-----------------------|--------| | **Authorization URL** | https://login.linode.com/oauth/authorize | | **Token URL** | https://login.linode.com/oauth/token | | **Scopes** | <ul><li>`account:read_only` - Allows access to GET information about your Account.</li><li>`account:read_write` - Allows access to all endpoints related to your Account.</li><li>`domains:read_only` - Allows access to GET Domains on your Account.</li><li>`domains:read_write` - Allows access to all Domain endpoints.</li><li>`events:read_only` - Allows access to GET your Events.</li><li>`events:read_write` - Allows access to all endpoints related to your Events.</li><li>`firewall:read_only` - Allows access to GET information about your Firewalls.</li><li>`firewall:read_write` - Allows access to all Firewall endpoints.</li><li>`images:read_only` - Allows access to GET your Images.</li><li>`images:read_write` - Allows access to all endpoints related to your Images.</li><li>`ips:read_only` - Allows access to GET your ips.</li><li>`ips:read_write` - Allows access to all endpoints related to your ips.</li><li>`linodes:read_only` - Allows access to GET Linodes on your Account.</li><li>`linodes:read_write` - Allow access to all endpoints related to your Linodes.</li><li>`lke:read_only` - Allows access to GET LKE Clusters on your Account.</li><li>`lke:read_write` - Allows access to all endpoints related to LKE Clusters on your Account.</li><li>`longview:read_only` - Allows access to GET your Longview Clients.</li><li>`longview:read_write` - Allows access to all endpoints related to your Longview Clients.</li><li>`maintenance:read_only` - Allows access to GET information about Maintenance on your account.</li><li>`nodebalancers:read_only` - Allows access to GET NodeBalancers on your Account.</li><li>`nodebalancers:read_write` - Allows access to all NodeBalancer endpoints.</li><li>`object_storage:read_only` - Allows access to GET information related to your Object Storage.</li><li>`object_storage:read_write` - Allows access to all Object Storage endpoints.</li><li>`stackscripts:read_only` - Allows access to GET your StackScripts.</li><li>`stackscripts:read_write` - Allows access to all endpoints related to your StackScripts.</li><li>`volumes:read_only` - Allows access to GET your Volumes.</li><li>`volumes:read_write` - Allows access to all endpoints related to your Volumes.</li></ul><br/>|  ## Requests  Requests must be made over HTTPS to ensure transactions are encrypted. The following Request methods are supported:  | METHOD | USAGE | |--------|-------| | GET    | Retrieves data about collections and individual resources. | | POST   | For collections, creates a new resource of that type. Also used to perform actions on action endpoints. | | PUT    | Updates an existing resource. | | DELETE | Deletes a resource. This is a destructive action. |   ## Responses  Actions will return one following HTTP response status codes:  | STATUS  | DESCRIPTION | |---------|-------------| | 200 OK  | The request was successful. | | 202 Accepted | The request was successful, but processing has not been completed. The response body includes a \"warnings\" array containing the details of incomplete processes. | | 204 No Content | The server successfully fulfilled the request and there is no additional content to send. | | 400 Bad Request | You submitted an invalid request (missing parameters, etc.). | | 401 Unauthorized | You failed to authenticate for this resource. | | 403 Forbidden | You are authenticated, but don't have permission to do this. | | 404 Not Found | The resource you're requesting does not exist. | | 429 Too Many Requests | You've hit a rate limit. | | 500 Internal Server Error | Please [open a Support Ticket](/docs/api/support/#support-ticket-open). |  ## Errors  Success is indicated via <a href=\"https://en.wikipedia.org/wiki/List_of_HTTP_status_codes\" target=\"_top\">Standard HTTP status codes</a>. `2xx` codes indicate success, `4xx` codes indicate a request error, and `5xx` errors indicate a server error. A request error might be an invalid input, a required parameter being omitted, or a malformed request. A server error means something went wrong processing your request. If this occurs, please [open a Support Ticket](/docs/api/support/#support-ticket-open) and let us know. Though errors are logged and we work quickly to resolve issues, opening a ticket and providing us with reproducable steps and data is always helpful.  The `errors` field is an array of the things that went wrong with your request. We will try to include as many of the problems in the response as possible, but it's conceivable that fixing these errors and resubmitting may result in new errors coming back once we are able to get further along in the process of handling your request.   Within each error object, the `field` parameter will be included if the error pertains to a specific field in the JSON you've submitted. This will be omitted if there is no relevant field. The `reason` is a human-readable explanation of the error, and will always be included.  ## Pagination  Resource lists are always paginated. The response will look similar to this:  ```json {     \"data\": [ ... ],     \"page\": 1,     \"pages\": 3,     \"results\": 300 } ```  * Pages start at 1. You may retrieve a specific page of results by adding `?page=x` to your URL (for example, `?page=4`). If the value of `page` exceeds `2^64/page_size`, the last possible page will be returned.   * Page sizes default to 100, and can be set to return between 25 and 500. Page size can be set using `?page_size=x`.  ## Filtering and Sorting  Collections are searchable by fields they include, marked in the spec as `x-linode-filterable: true`. Filters are passed in the `X-Filter` header and are formatted as JSON objects. Here is a request call for Linode Types in our \"standard\" class:  ```Shell curl \"https://api.linode.com/v4/linode/types\" \\   -H '     X-Filter: {       \"class\": \"standard\"     }' ```  The filter object's keys are the keys of the object you're filtering, and the values are accepted values. You can add multiple filters by including more than one key. For example, filtering for \"standard\" Linode Types that offer one vcpu:  ```Shell  curl \"https://api.linode.com/v4/linode/types\" \\   -H '     X-Filter: {       \"class\": \"standard\",       \"vcpus\": 1     }' ```  In the above example, both filters are combined with an \"and\" operation. However, if you wanted either Types with one vcpu or Types in our \"standard\" class, you can add an operator:   ```Shell curl \"https://api.linode.com/v4/linode/types\" \\   -H '     X-Filter: {       \"+or\": [         { \"vcpus\": 1 },         { \"class\": \"standard\" }       ]     }' ```  Each filter in the `+or` array is its own filter object, and all conditions in it are combined with an \"and\" operation as they were in the previous example.  Other operators are also available. Operators are keys of a Filter JSON object. Their value must be of the appropriate type, and they are evaluated as described below:  | OPERATOR | TYPE   | DESCRIPTION                       | |----------|--------|-----------------------------------| | +and     | array  | All conditions must be true.       | | +or      | array  | One condition must be true.        | | +gt      | number | Value must be greater than number. | | +gte     | number | Value must be greater than or equal to number. | | +lt      | number | Value must be less than number. | | +lte     | number | Value must be less than or equal to number. | | +contains | string | Given string must be in the value. | | +neq      | string | Does not equal the value.          | | +order_by | string | Attribute to order the results by - must be filterable. | | +order    | string | Either \"asc\" or \"desc\". Defaults to \"asc\". Requires `+order_by`. |  For example, filtering for [Linode Types](/docs/api/linode-types/) that offer memory equal to or higher than 61440:  ```Shell curl \"https://api.linode.com/v4/linode/types\" \\   -H '     X-Filter: {       \"memory\": {         \"+gte\": 61440       }     }' ```  You can combine and nest operators to construct arbitrarily-complex queries. For example, give me all [Linode Types](/docs/api/linode-types/) which are either `standard` or `highmem` class, or have between 12 and 20 vcpus:  ```Shell curl \"https://api.linode.com/v4/linode/types\" \\   -H '     X-Filter: {       \"+or\": [         {           \"+or\": [             {               \"class\": \"standard\"             },             {               \"class\": \"highmem\"             }           ]         },         {           \"+and\": [             {               \"vcpus\": {                 \"+gte\": 12               }             },             {               \"vcpus\": {                 \"+lte\": 20               }             }           ]         }       ]     }' ```  ## Rate Limiting  With the Linode API, you can make up to 1,600 general API requests every two minutes per user as determined by IP adddress or by OAuth token. Additionally, there are endpoint specfic limits defined below.  **Note:** There may be rate limiting applied at other levels outside of the API, for example, at the load balancer.  `/stats` endpoints have their own dedicated limits of 100 requests per minute per user. These endpoints are:  * [View Linode Statistics](/docs/api/linode-instances/#linode-statistics-view) * [View Linode Statistics (year/month)](/docs/api/linode-instances/#statistics-yearmonth-view) * [View NodeBalancer Statistics](/docs/api/nodebalancers/#nodebalancer-statistics-view) * [List Managed Stats](/docs/api/managed/#managed-stats-list)  Object Storage endpoints have a dedicated limit of 750 requests per second per user. The Object Storage endpoints are:  * [Object Storage Endpoints](/docs/api/object-storage/)  Opening Support Tickets has a dedicated limit of 2 requests per minute per user. That endpoint is:  * [Open Support Ticket](/docs/api/support/#support-ticket-open)  Accepting Service Transfers has a dedicated limit of 2 requests per minute per user. That endpoint is:  * [Service Transfer Accept](/docs/api/account/#service-transfer-accept)  ## CLI (Command Line Interface)  The <a href=\"https://github.com/linode/linode-cli\" target=\"_top\">Linode CLI</a> allows you to easily work with the API using intuitive and simple syntax. It requires a [Personal Access Token](/docs/api/#personal-access-token) for authentication, and gives you access to all of the features and functionality of the Linode API that are documented here with CLI examples.  Endpoints that do not have CLI examples are currently unavailable through the CLI, but can be accessed via other methods such as Shell commands and other third-party applications.
 *
 * The version of the OpenAPI document: 4.107.0
 * Contact: support@linode.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.1-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace ZoneWatcher\LinodeApiV4\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use ZoneWatcher\LinodeApiV4\ApiException;
use ZoneWatcher\LinodeApiV4\Configuration;
use ZoneWatcher\LinodeApiV4\HeaderSelector;
use ZoneWatcher\LinodeApiV4\ObjectSerializer;

/**
 * LinodeInstancesApi Class Doc Comment
 *
 * @category Class
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class LinodeInstancesApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation addLinodeConfig
     *
     * Configuration Profile Create
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Configuration profile. This determines which kernel, devices, how much memory, etc. a Linode boots with. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\LinodeConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function addLinodeConfig($linode_id, $unknown_base_type)
    {
        list($response) = $this->addLinodeConfigWithHttpInfo($linode_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation addLinodeConfigWithHttpInfo
     *
     * Configuration Profile Create
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Configuration profile. This determines which kernel, devices, how much memory, etc. a Linode boots with. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\LinodeConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function addLinodeConfigWithHttpInfo($linode_id, $unknown_base_type)
    {
        $request = $this->addLinodeConfigRequest($linode_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\LinodeConfig' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation addLinodeConfigAsync
     *
     * Configuration Profile Create
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Configuration profile. This determines which kernel, devices, how much memory, etc. a Linode boots with. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addLinodeConfigAsync($linode_id, $unknown_base_type)
    {
        return $this->addLinodeConfigAsyncWithHttpInfo($linode_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addLinodeConfigAsyncWithHttpInfo
     *
     * Configuration Profile Create
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Configuration profile. This determines which kernel, devices, how much memory, etc. a Linode boots with. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addLinodeConfigAsyncWithHttpInfo($linode_id, $unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig';
        $request = $this->addLinodeConfigRequest($linode_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'addLinodeConfig'
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Configuration profile. This determines which kernel, devices, how much memory, etc. a Linode boots with. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function addLinodeConfigRequest($linode_id, $unknown_base_type)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling addLinodeConfig'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling addLinodeConfig'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/configs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation addLinodeDisk
     *
     * Disk Create
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Disk. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function addLinodeDisk($linode_id, $unknown_base_type)
    {
        list($response) = $this->addLinodeDiskWithHttpInfo($linode_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation addLinodeDiskWithHttpInfo
     *
     * Disk Create
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Disk. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function addLinodeDiskWithHttpInfo($linode_id, $unknown_base_type)
    {
        $request = $this->addLinodeDiskRequest($linode_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Disk' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Disk', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Disk',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation addLinodeDiskAsync
     *
     * Disk Create
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addLinodeDiskAsync($linode_id, $unknown_base_type)
    {
        return $this->addLinodeDiskAsyncWithHttpInfo($linode_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addLinodeDiskAsyncWithHttpInfo
     *
     * Disk Create
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addLinodeDiskAsyncWithHttpInfo($linode_id, $unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
        $request = $this->addLinodeDiskRequest($linode_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'addLinodeDisk'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The parameters to set when creating the Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function addLinodeDiskRequest($linode_id, $unknown_base_type)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling addLinodeDisk'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling addLinodeDisk'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/disks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation addLinodeIP
     *
     * IPv4 Address Allocate
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the address you are creating. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\IPAddress|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function addLinodeIP($linode_id, $unknown_base_type)
    {
        list($response) = $this->addLinodeIPWithHttpInfo($linode_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation addLinodeIPWithHttpInfo
     *
     * IPv4 Address Allocate
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the address you are creating. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\IPAddress|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function addLinodeIPWithHttpInfo($linode_id, $unknown_base_type)
    {
        $request = $this->addLinodeIPRequest($linode_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\IPAddress' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\IPAddress', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\IPAddress';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\IPAddress',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation addLinodeIPAsync
     *
     * IPv4 Address Allocate
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the address you are creating. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addLinodeIPAsync($linode_id, $unknown_base_type)
    {
        return $this->addLinodeIPAsyncWithHttpInfo($linode_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addLinodeIPAsyncWithHttpInfo
     *
     * IPv4 Address Allocate
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the address you are creating. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addLinodeIPAsyncWithHttpInfo($linode_id, $unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\IPAddress';
        $request = $this->addLinodeIPRequest($linode_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'addLinodeIP'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the address you are creating. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function addLinodeIPRequest($linode_id, $unknown_base_type)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling addLinodeIP'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling addLinodeIP'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/ips';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation bootLinodeInstance
     *
     * Linode Boot
     *
     * @param  int $linode_id The ID of the Linode to boot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject8 $inline_object8 inline_object8 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function bootLinodeInstance($linode_id, $inline_object8 = null)
    {
        list($response) = $this->bootLinodeInstanceWithHttpInfo($linode_id, $inline_object8);
        return $response;
    }

    /**
     * Operation bootLinodeInstanceWithHttpInfo
     *
     * Linode Boot
     *
     * @param  int $linode_id The ID of the Linode to boot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject8 $inline_object8 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function bootLinodeInstanceWithHttpInfo($linode_id, $inline_object8 = null)
    {
        $request = $this->bootLinodeInstanceRequest($linode_id, $inline_object8);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation bootLinodeInstanceAsync
     *
     * Linode Boot
     *
     * @param  int $linode_id The ID of the Linode to boot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject8 $inline_object8 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function bootLinodeInstanceAsync($linode_id, $inline_object8 = null)
    {
        return $this->bootLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object8)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation bootLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Boot
     *
     * @param  int $linode_id The ID of the Linode to boot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject8 $inline_object8 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function bootLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object8 = null)
    {
        $returnType = 'object';
        $request = $this->bootLinodeInstanceRequest($linode_id, $inline_object8);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'bootLinodeInstance'
     *
     * @param  int $linode_id The ID of the Linode to boot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject8 $inline_object8 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function bootLinodeInstanceRequest($linode_id, $inline_object8 = null)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling bootLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/boot';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($inline_object8)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object8));
            } else {
                $httpBody = $inline_object8;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation cancelBackups
     *
     * Backups Cancel
     *
     * @param  int $linode_id The ID of the Linode to cancel backup service for. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function cancelBackups($linode_id)
    {
        list($response) = $this->cancelBackupsWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation cancelBackupsWithHttpInfo
     *
     * Backups Cancel
     *
     * @param  int $linode_id The ID of the Linode to cancel backup service for. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function cancelBackupsWithHttpInfo($linode_id)
    {
        $request = $this->cancelBackupsRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cancelBackupsAsync
     *
     * Backups Cancel
     *
     * @param  int $linode_id The ID of the Linode to cancel backup service for. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelBackupsAsync($linode_id)
    {
        return $this->cancelBackupsAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelBackupsAsyncWithHttpInfo
     *
     * Backups Cancel
     *
     * @param  int $linode_id The ID of the Linode to cancel backup service for. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelBackupsAsyncWithHttpInfo($linode_id)
    {
        $returnType = 'object';
        $request = $this->cancelBackupsRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'cancelBackups'
     *
     * @param  int $linode_id The ID of the Linode to cancel backup service for. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cancelBackupsRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling cancelBackups'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/backups/cancel';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation cloneLinodeDisk
     *
     * Disk Clone
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to clone. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function cloneLinodeDisk($linode_id, $disk_id)
    {
        list($response) = $this->cloneLinodeDiskWithHttpInfo($linode_id, $disk_id);
        return $response;
    }

    /**
     * Operation cloneLinodeDiskWithHttpInfo
     *
     * Disk Clone
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to clone. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function cloneLinodeDiskWithHttpInfo($linode_id, $disk_id)
    {
        $request = $this->cloneLinodeDiskRequest($linode_id, $disk_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Disk' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Disk', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Disk',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cloneLinodeDiskAsync
     *
     * Disk Clone
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to clone. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cloneLinodeDiskAsync($linode_id, $disk_id)
    {
        return $this->cloneLinodeDiskAsyncWithHttpInfo($linode_id, $disk_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cloneLinodeDiskAsyncWithHttpInfo
     *
     * Disk Clone
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to clone. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cloneLinodeDiskAsyncWithHttpInfo($linode_id, $disk_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
        $request = $this->cloneLinodeDiskRequest($linode_id, $disk_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'cloneLinodeDisk'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to clone. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cloneLinodeDiskRequest($linode_id, $disk_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling cloneLinodeDisk'
            );
        }
        // verify the required parameter 'disk_id' is set
        if ($disk_id === null || (is_array($disk_id) && count($disk_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $disk_id when calling cloneLinodeDisk'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/disks/{diskId}/clone';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($disk_id !== null) {
            $resourcePath = str_replace(
                '{' . 'diskId' . '}',
                ObjectSerializer::toPathValue($disk_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation cloneLinodeInstance
     *
     * Linode Clone
     *
     * @param  int $linode_id ID of the Linode to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject9 $inline_object9 inline_object9 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function cloneLinodeInstance($linode_id, $inline_object9)
    {
        list($response) = $this->cloneLinodeInstanceWithHttpInfo($linode_id, $inline_object9);
        return $response;
    }

    /**
     * Operation cloneLinodeInstanceWithHttpInfo
     *
     * Linode Clone
     *
     * @param  int $linode_id ID of the Linode to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject9 $inline_object9 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function cloneLinodeInstanceWithHttpInfo($linode_id, $inline_object9)
    {
        $request = $this->cloneLinodeInstanceRequest($linode_id, $inline_object9);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Linode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Linode', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Linode',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cloneLinodeInstanceAsync
     *
     * Linode Clone
     *
     * @param  int $linode_id ID of the Linode to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject9 $inline_object9 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cloneLinodeInstanceAsync($linode_id, $inline_object9)
    {
        return $this->cloneLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object9)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cloneLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Clone
     *
     * @param  int $linode_id ID of the Linode to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject9 $inline_object9 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cloneLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object9)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
        $request = $this->cloneLinodeInstanceRequest($linode_id, $inline_object9);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'cloneLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject9 $inline_object9 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cloneLinodeInstanceRequest($linode_id, $inline_object9)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling cloneLinodeInstance'
            );
        }
        // verify the required parameter 'inline_object9' is set
        if ($inline_object9 === null || (is_array($inline_object9) && count($inline_object9) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $inline_object9 when calling cloneLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/clone';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($inline_object9)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object9));
            } else {
                $httpBody = $inline_object9;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createLinodeInstance
     *
     * Linode Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested initial state of a new Linode. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createLinodeInstance($unknown_base_type)
    {
        list($response) = $this->createLinodeInstanceWithHttpInfo($unknown_base_type);
        return $response;
    }

    /**
     * Operation createLinodeInstanceWithHttpInfo
     *
     * Linode Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested initial state of a new Linode. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createLinodeInstanceWithHttpInfo($unknown_base_type)
    {
        $request = $this->createLinodeInstanceRequest($unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Linode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Linode', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Linode',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createLinodeInstanceAsync
     *
     * Linode Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested initial state of a new Linode. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createLinodeInstanceAsync($unknown_base_type)
    {
        return $this->createLinodeInstanceAsyncWithHttpInfo($unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested initial state of a new Linode. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createLinodeInstanceAsyncWithHttpInfo($unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
        $request = $this->createLinodeInstanceRequest($unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createLinodeInstance'
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested initial state of a new Linode. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createLinodeInstanceRequest($unknown_base_type)
    {
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling createLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createSnapshot
     *
     * Snapshot Create
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject6 $inline_object6 inline_object6 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Backup|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createSnapshot($linode_id, $inline_object6)
    {
        list($response) = $this->createSnapshotWithHttpInfo($linode_id, $inline_object6);
        return $response;
    }

    /**
     * Operation createSnapshotWithHttpInfo
     *
     * Snapshot Create
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject6 $inline_object6 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Backup|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createSnapshotWithHttpInfo($linode_id, $inline_object6)
    {
        $request = $this->createSnapshotRequest($linode_id, $inline_object6);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Backup' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Backup', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Backup';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Backup',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createSnapshotAsync
     *
     * Snapshot Create
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject6 $inline_object6 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createSnapshotAsync($linode_id, $inline_object6)
    {
        return $this->createSnapshotAsyncWithHttpInfo($linode_id, $inline_object6)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createSnapshotAsyncWithHttpInfo
     *
     * Snapshot Create
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject6 $inline_object6 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createSnapshotAsyncWithHttpInfo($linode_id, $inline_object6)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Backup';
        $request = $this->createSnapshotRequest($linode_id, $inline_object6);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createSnapshot'
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject6 $inline_object6 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createSnapshotRequest($linode_id, $inline_object6)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling createSnapshot'
            );
        }
        // verify the required parameter 'inline_object6' is set
        if ($inline_object6 === null || (is_array($inline_object6) && count($inline_object6) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $inline_object6 when calling createSnapshot'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/backups';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($inline_object6)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object6));
            } else {
                $httpBody = $inline_object6;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteDisk
     *
     * Disk Delete
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteDisk($linode_id, $disk_id)
    {
        list($response) = $this->deleteDiskWithHttpInfo($linode_id, $disk_id);
        return $response;
    }

    /**
     * Operation deleteDiskWithHttpInfo
     *
     * Disk Delete
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteDiskWithHttpInfo($linode_id, $disk_id)
    {
        $request = $this->deleteDiskRequest($linode_id, $disk_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteDiskAsync
     *
     * Disk Delete
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDiskAsync($linode_id, $disk_id)
    {
        return $this->deleteDiskAsyncWithHttpInfo($linode_id, $disk_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteDiskAsyncWithHttpInfo
     *
     * Disk Delete
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDiskAsyncWithHttpInfo($linode_id, $disk_id)
    {
        $returnType = 'object';
        $request = $this->deleteDiskRequest($linode_id, $disk_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteDisk'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteDiskRequest($linode_id, $disk_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling deleteDisk'
            );
        }
        // verify the required parameter 'disk_id' is set
        if ($disk_id === null || (is_array($disk_id) && count($disk_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $disk_id when calling deleteDisk'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/disks/{diskId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($disk_id !== null) {
            $resourcePath = str_replace(
                '{' . 'diskId' . '}',
                ObjectSerializer::toPathValue($disk_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteLinodeConfig
     *
     * Configuration Profile Delete
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteLinodeConfig($linode_id, $config_id)
    {
        list($response) = $this->deleteLinodeConfigWithHttpInfo($linode_id, $config_id);
        return $response;
    }

    /**
     * Operation deleteLinodeConfigWithHttpInfo
     *
     * Configuration Profile Delete
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteLinodeConfigWithHttpInfo($linode_id, $config_id)
    {
        $request = $this->deleteLinodeConfigRequest($linode_id, $config_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteLinodeConfigAsync
     *
     * Configuration Profile Delete
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteLinodeConfigAsync($linode_id, $config_id)
    {
        return $this->deleteLinodeConfigAsyncWithHttpInfo($linode_id, $config_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteLinodeConfigAsyncWithHttpInfo
     *
     * Configuration Profile Delete
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteLinodeConfigAsyncWithHttpInfo($linode_id, $config_id)
    {
        $returnType = 'object';
        $request = $this->deleteLinodeConfigRequest($linode_id, $config_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteLinodeConfig'
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteLinodeConfigRequest($linode_id, $config_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling deleteLinodeConfig'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling deleteLinodeConfig'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/configs/{configId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($config_id !== null) {
            $resourcePath = str_replace(
                '{' . 'configId' . '}',
                ObjectSerializer::toPathValue($config_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteLinodeInstance
     *
     * Linode Delete
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteLinodeInstance($linode_id)
    {
        list($response) = $this->deleteLinodeInstanceWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation deleteLinodeInstanceWithHttpInfo
     *
     * Linode Delete
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteLinodeInstanceWithHttpInfo($linode_id)
    {
        $request = $this->deleteLinodeInstanceRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteLinodeInstanceAsync
     *
     * Linode Delete
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteLinodeInstanceAsync($linode_id)
    {
        return $this->deleteLinodeInstanceAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Delete
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteLinodeInstanceAsyncWithHttpInfo($linode_id)
    {
        $returnType = 'object';
        $request = $this->deleteLinodeInstanceRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteLinodeInstanceRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling deleteLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation enableBackups
     *
     * Backups Enable
     *
     * @param  int $linode_id The ID of the Linode to enable backup service for. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function enableBackups($linode_id)
    {
        list($response) = $this->enableBackupsWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation enableBackupsWithHttpInfo
     *
     * Backups Enable
     *
     * @param  int $linode_id The ID of the Linode to enable backup service for. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function enableBackupsWithHttpInfo($linode_id)
    {
        $request = $this->enableBackupsRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation enableBackupsAsync
     *
     * Backups Enable
     *
     * @param  int $linode_id The ID of the Linode to enable backup service for. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function enableBackupsAsync($linode_id)
    {
        return $this->enableBackupsAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation enableBackupsAsyncWithHttpInfo
     *
     * Backups Enable
     *
     * @param  int $linode_id The ID of the Linode to enable backup service for. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function enableBackupsAsyncWithHttpInfo($linode_id)
    {
        $returnType = 'object';
        $request = $this->enableBackupsRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'enableBackups'
     *
     * @param  int $linode_id The ID of the Linode to enable backup service for. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function enableBackupsRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling enableBackups'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/backups/enable';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getBackup
     *
     * Backup View
     *
     * @param  int $linode_id The ID of the Linode the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Backup|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getBackup($linode_id, $backup_id)
    {
        list($response) = $this->getBackupWithHttpInfo($linode_id, $backup_id);
        return $response;
    }

    /**
     * Operation getBackupWithHttpInfo
     *
     * Backup View
     *
     * @param  int $linode_id The ID of the Linode the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Backup|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBackupWithHttpInfo($linode_id, $backup_id)
    {
        $request = $this->getBackupRequest($linode_id, $backup_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Backup' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Backup', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Backup';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Backup',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getBackupAsync
     *
     * Backup View
     *
     * @param  int $linode_id The ID of the Linode the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBackupAsync($linode_id, $backup_id)
    {
        return $this->getBackupAsyncWithHttpInfo($linode_id, $backup_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getBackupAsyncWithHttpInfo
     *
     * Backup View
     *
     * @param  int $linode_id The ID of the Linode the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBackupAsyncWithHttpInfo($linode_id, $backup_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Backup';
        $request = $this->getBackupRequest($linode_id, $backup_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getBackup'
     *
     * @param  int $linode_id The ID of the Linode the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getBackupRequest($linode_id, $backup_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getBackup'
            );
        }
        // verify the required parameter 'backup_id' is set
        if ($backup_id === null || (is_array($backup_id) && count($backup_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $backup_id when calling getBackup'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/backups/{backupId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($backup_id !== null) {
            $resourcePath = str_replace(
                '{' . 'backupId' . '}',
                ObjectSerializer::toPathValue($backup_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getBackups
     *
     * Backups List
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20018|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getBackups($linode_id)
    {
        list($response) = $this->getBackupsWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation getBackupsWithHttpInfo
     *
     * Backups List
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20018|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBackupsWithHttpInfo($linode_id)
    {
        $request = $this->getBackupsRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20018' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20018', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20018';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20018',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getBackupsAsync
     *
     * Backups List
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBackupsAsync($linode_id)
    {
        return $this->getBackupsAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getBackupsAsyncWithHttpInfo
     *
     * Backups List
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBackupsAsyncWithHttpInfo($linode_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20018';
        $request = $this->getBackupsRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getBackups'
     *
     * @param  int $linode_id The ID of the Linode the backups belong to. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getBackupsRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getBackups'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/backups';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getKernel
     *
     * Kernel View
     *
     * @param  string $kernel_id ID of the Kernel to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Kernel|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getKernel($kernel_id)
    {
        list($response) = $this->getKernelWithHttpInfo($kernel_id);
        return $response;
    }

    /**
     * Operation getKernelWithHttpInfo
     *
     * Kernel View
     *
     * @param  string $kernel_id ID of the Kernel to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Kernel|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getKernelWithHttpInfo($kernel_id)
    {
        $request = $this->getKernelRequest($kernel_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Kernel' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Kernel', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Kernel';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Kernel',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getKernelAsync
     *
     * Kernel View
     *
     * @param  string $kernel_id ID of the Kernel to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getKernelAsync($kernel_id)
    {
        return $this->getKernelAsyncWithHttpInfo($kernel_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getKernelAsyncWithHttpInfo
     *
     * Kernel View
     *
     * @param  string $kernel_id ID of the Kernel to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getKernelAsyncWithHttpInfo($kernel_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Kernel';
        $request = $this->getKernelRequest($kernel_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getKernel'
     *
     * @param  string $kernel_id ID of the Kernel to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getKernelRequest($kernel_id)
    {
        // verify the required parameter 'kernel_id' is set
        if ($kernel_id === null || (is_array($kernel_id) && count($kernel_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $kernel_id when calling getKernel'
            );
        }

        $resourcePath = '/linode/kernels/{kernelId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($kernel_id !== null) {
            $resourcePath = str_replace(
                '{' . 'kernelId' . '}',
                ObjectSerializer::toPathValue($kernel_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getKernels
     *
     * Kernels List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20022|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getKernels($page = 1, $page_size = 100)
    {
        list($response) = $this->getKernelsWithHttpInfo($page, $page_size);
        return $response;
    }

    /**
     * Operation getKernelsWithHttpInfo
     *
     * Kernels List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20022|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getKernelsWithHttpInfo($page = 1, $page_size = 100)
    {
        $request = $this->getKernelsRequest($page, $page_size);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20022' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20022', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20022';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20022',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getKernelsAsync
     *
     * Kernels List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getKernelsAsync($page = 1, $page_size = 100)
    {
        return $this->getKernelsAsyncWithHttpInfo($page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getKernelsAsyncWithHttpInfo
     *
     * Kernels List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getKernelsAsyncWithHttpInfo($page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20022';
        $request = $this->getKernelsRequest($page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getKernels'
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getKernelsRequest($page = 1, $page_size = 100)
    {
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling LinodeInstancesApi.getKernels, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getKernels, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getKernels, must be bigger than or equal to 25.');
        }


        $resourcePath = '/linode/kernels';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($page_size !== null) {
            if('form' === 'form' && is_array($page_size)) {
                foreach($page_size as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page_size'] = $page_size;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeConfig
     *
     * Configuration Profile View
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\LinodeConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeConfig($linode_id, $config_id)
    {
        list($response) = $this->getLinodeConfigWithHttpInfo($linode_id, $config_id);
        return $response;
    }

    /**
     * Operation getLinodeConfigWithHttpInfo
     *
     * Configuration Profile View
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\LinodeConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeConfigWithHttpInfo($linode_id, $config_id)
    {
        $request = $this->getLinodeConfigRequest($linode_id, $config_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\LinodeConfig' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeConfigAsync
     *
     * Configuration Profile View
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeConfigAsync($linode_id, $config_id)
    {
        return $this->getLinodeConfigAsyncWithHttpInfo($linode_id, $config_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeConfigAsyncWithHttpInfo
     *
     * Configuration Profile View
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeConfigAsyncWithHttpInfo($linode_id, $config_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig';
        $request = $this->getLinodeConfigRequest($linode_id, $config_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeConfig'
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeConfigRequest($linode_id, $config_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeConfig'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling getLinodeConfig'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/configs/{configId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($config_id !== null) {
            $resourcePath = str_replace(
                '{' . 'configId' . '}',
                ObjectSerializer::toPathValue($config_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeConfigs
     *
     * Configuration Profiles List
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20019
     */
    public function getLinodeConfigs($linode_id, $page = 1, $page_size = 100)
    {
        list($response) = $this->getLinodeConfigsWithHttpInfo($linode_id, $page, $page_size);
        return $response;
    }

    /**
     * Operation getLinodeConfigsWithHttpInfo
     *
     * Configuration Profiles List
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20019, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeConfigsWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $request = $this->getLinodeConfigsRequest($linode_id, $page, $page_size);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20019' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20019', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20019';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20019',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeConfigsAsync
     *
     * Configuration Profiles List
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeConfigsAsync($linode_id, $page = 1, $page_size = 100)
    {
        return $this->getLinodeConfigsAsyncWithHttpInfo($linode_id, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeConfigsAsyncWithHttpInfo
     *
     * Configuration Profiles List
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeConfigsAsyncWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20019';
        $request = $this->getLinodeConfigsRequest($linode_id, $page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeConfigs'
     *
     * @param  int $linode_id ID of the Linode to look up Configuration profiles for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeConfigsRequest($linode_id, $page = 1, $page_size = 100)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeConfigs'
            );
        }
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling LinodeInstancesApi.getLinodeConfigs, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeConfigs, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeConfigs, must be bigger than or equal to 25.');
        }


        $resourcePath = '/linode/instances/{linodeId}/configs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($page_size !== null) {
            if('form' === 'form' && is_array($page_size)) {
                foreach($page_size as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page_size'] = $page_size;
            }
        }


        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeDisk
     *
     * Disk View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeDisk($linode_id, $disk_id)
    {
        list($response) = $this->getLinodeDiskWithHttpInfo($linode_id, $disk_id);
        return $response;
    }

    /**
     * Operation getLinodeDiskWithHttpInfo
     *
     * Disk View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeDiskWithHttpInfo($linode_id, $disk_id)
    {
        $request = $this->getLinodeDiskRequest($linode_id, $disk_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Disk' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Disk', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Disk',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeDiskAsync
     *
     * Disk View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeDiskAsync($linode_id, $disk_id)
    {
        return $this->getLinodeDiskAsyncWithHttpInfo($linode_id, $disk_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeDiskAsyncWithHttpInfo
     *
     * Disk View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeDiskAsyncWithHttpInfo($linode_id, $disk_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
        $request = $this->getLinodeDiskRequest($linode_id, $disk_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeDisk'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeDiskRequest($linode_id, $disk_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeDisk'
            );
        }
        // verify the required parameter 'disk_id' is set
        if ($disk_id === null || (is_array($disk_id) && count($disk_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $disk_id when calling getLinodeDisk'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/disks/{diskId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($disk_id !== null) {
            $resourcePath = str_replace(
                '{' . 'diskId' . '}',
                ObjectSerializer::toPathValue($disk_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeDisks
     *
     * Disks List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20020|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeDisks($linode_id, $page = 1, $page_size = 100)
    {
        list($response) = $this->getLinodeDisksWithHttpInfo($linode_id, $page, $page_size);
        return $response;
    }

    /**
     * Operation getLinodeDisksWithHttpInfo
     *
     * Disks List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20020|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeDisksWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $request = $this->getLinodeDisksRequest($linode_id, $page, $page_size);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20020' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20020', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20020';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20020',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeDisksAsync
     *
     * Disks List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeDisksAsync($linode_id, $page = 1, $page_size = 100)
    {
        return $this->getLinodeDisksAsyncWithHttpInfo($linode_id, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeDisksAsyncWithHttpInfo
     *
     * Disks List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeDisksAsyncWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20020';
        $request = $this->getLinodeDisksRequest($linode_id, $page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeDisks'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeDisksRequest($linode_id, $page = 1, $page_size = 100)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeDisks'
            );
        }
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling LinodeInstancesApi.getLinodeDisks, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeDisks, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeDisks, must be bigger than or equal to 25.');
        }


        $resourcePath = '/linode/instances/{linodeId}/disks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($page_size !== null) {
            if('form' === 'form' && is_array($page_size)) {
                foreach($page_size as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page_size'] = $page_size;
            }
        }


        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeFirewalls
     *
     * Firewalls List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20021|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeFirewalls($linode_id, $page = 1, $page_size = 100)
    {
        list($response) = $this->getLinodeFirewallsWithHttpInfo($linode_id, $page, $page_size);
        return $response;
    }

    /**
     * Operation getLinodeFirewallsWithHttpInfo
     *
     * Firewalls List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20021|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeFirewallsWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $request = $this->getLinodeFirewallsRequest($linode_id, $page, $page_size);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20021' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20021', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20021';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20021',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeFirewallsAsync
     *
     * Firewalls List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeFirewallsAsync($linode_id, $page = 1, $page_size = 100)
    {
        return $this->getLinodeFirewallsAsyncWithHttpInfo($linode_id, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeFirewallsAsyncWithHttpInfo
     *
     * Firewalls List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeFirewallsAsyncWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20021';
        $request = $this->getLinodeFirewallsRequest($linode_id, $page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeFirewalls'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeFirewallsRequest($linode_id, $page = 1, $page_size = 100)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeFirewalls'
            );
        }
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling LinodeInstancesApi.getLinodeFirewalls, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeFirewalls, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeFirewalls, must be bigger than or equal to 25.');
        }


        $resourcePath = '/linode/instances/{linodeId}/firewalls';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($page_size !== null) {
            if('form' === 'form' && is_array($page_size)) {
                foreach($page_size as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page_size'] = $page_size;
            }
        }


        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeIP
     *
     * IP Address View
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\IPAddress|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeIP($linode_id, $address)
    {
        list($response) = $this->getLinodeIPWithHttpInfo($linode_id, $address);
        return $response;
    }

    /**
     * Operation getLinodeIPWithHttpInfo
     *
     * IP Address View
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\IPAddress|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeIPWithHttpInfo($linode_id, $address)
    {
        $request = $this->getLinodeIPRequest($linode_id, $address);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\IPAddress' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\IPAddress', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\IPAddress';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\IPAddress',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeIPAsync
     *
     * IP Address View
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeIPAsync($linode_id, $address)
    {
        return $this->getLinodeIPAsyncWithHttpInfo($linode_id, $address)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeIPAsyncWithHttpInfo
     *
     * IP Address View
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeIPAsyncWithHttpInfo($linode_id, $address)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\IPAddress';
        $request = $this->getLinodeIPRequest($linode_id, $address);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeIP'
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeIPRequest($linode_id, $address)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeIP'
            );
        }
        // verify the required parameter 'address' is set
        if ($address === null || (is_array($address) && count($address) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $address when calling getLinodeIP'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/ips/{address}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($address !== null) {
            $resourcePath = str_replace(
                '{' . 'address' . '}',
                ObjectSerializer::toPathValue($address),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeIPs
     *
     * Networking Information List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeIPs($linode_id)
    {
        list($response) = $this->getLinodeIPsWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation getLinodeIPsWithHttpInfo
     *
     * Networking Information List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeIPsWithHttpInfo($linode_id)
    {
        $request = $this->getLinodeIPsRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeIPsAsync
     *
     * Networking Information List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeIPsAsync($linode_id)
    {
        return $this->getLinodeIPsAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeIPsAsyncWithHttpInfo
     *
     * Networking Information List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeIPsAsyncWithHttpInfo($linode_id)
    {
        $returnType = 'object';
        $request = $this->getLinodeIPsRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeIPs'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeIPsRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeIPs'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/ips';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeInstance
     *
     * Linode View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeInstance($linode_id)
    {
        list($response) = $this->getLinodeInstanceWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation getLinodeInstanceWithHttpInfo
     *
     * Linode View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeInstanceWithHttpInfo($linode_id)
    {
        $request = $this->getLinodeInstanceRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Linode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Linode', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Linode',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeInstanceAsync
     *
     * Linode View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeInstanceAsync($linode_id)
    {
        return $this->getLinodeInstanceAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeInstanceAsyncWithHttpInfo
     *
     * Linode View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeInstanceAsyncWithHttpInfo($linode_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
        $request = $this->getLinodeInstanceRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeInstanceRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeInstances
     *
     * Linodes List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20017|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeInstances($page = 1, $page_size = 100)
    {
        list($response) = $this->getLinodeInstancesWithHttpInfo($page, $page_size);
        return $response;
    }

    /**
     * Operation getLinodeInstancesWithHttpInfo
     *
     * Linodes List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20017|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeInstancesWithHttpInfo($page = 1, $page_size = 100)
    {
        $request = $this->getLinodeInstancesRequest($page, $page_size);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20017' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20017', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20017';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20017',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeInstancesAsync
     *
     * Linodes List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeInstancesAsync($page = 1, $page_size = 100)
    {
        return $this->getLinodeInstancesAsyncWithHttpInfo($page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeInstancesAsyncWithHttpInfo
     *
     * Linodes List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeInstancesAsyncWithHttpInfo($page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20017';
        $request = $this->getLinodeInstancesRequest($page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeInstances'
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeInstancesRequest($page = 1, $page_size = 100)
    {
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling LinodeInstancesApi.getLinodeInstances, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeInstances, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeInstances, must be bigger than or equal to 25.');
        }


        $resourcePath = '/linode/instances';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($page_size !== null) {
            if('form' === 'form' && is_array($page_size)) {
                foreach($page_size as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page_size'] = $page_size;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeNodeBalancers
     *
     * Linode NodeBalancers View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20023
     */
    public function getLinodeNodeBalancers($linode_id)
    {
        list($response) = $this->getLinodeNodeBalancersWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation getLinodeNodeBalancersWithHttpInfo
     *
     * Linode NodeBalancers View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20023, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeNodeBalancersWithHttpInfo($linode_id)
    {
        $request = $this->getLinodeNodeBalancersRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20023' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20023', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20023';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20023',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeNodeBalancersAsync
     *
     * Linode NodeBalancers View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeNodeBalancersAsync($linode_id)
    {
        return $this->getLinodeNodeBalancersAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeNodeBalancersAsyncWithHttpInfo
     *
     * Linode NodeBalancers View
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeNodeBalancersAsyncWithHttpInfo($linode_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20023';
        $request = $this->getLinodeNodeBalancersRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeNodeBalancers'
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeNodeBalancersRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeNodeBalancers'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/nodebalancers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeStats
     *
     * Linode Statistics View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\LinodeStats|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeStats($linode_id)
    {
        list($response) = $this->getLinodeStatsWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation getLinodeStatsWithHttpInfo
     *
     * Linode Statistics View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\LinodeStats|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeStatsWithHttpInfo($linode_id)
    {
        $request = $this->getLinodeStatsRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\LinodeStats' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\LinodeStats', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeStats';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\LinodeStats',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeStatsAsync
     *
     * Linode Statistics View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeStatsAsync($linode_id)
    {
        return $this->getLinodeStatsAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeStatsAsyncWithHttpInfo
     *
     * Linode Statistics View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeStatsAsyncWithHttpInfo($linode_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeStats';
        $request = $this->getLinodeStatsRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeStats'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeStatsRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeStats'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/stats';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeStatsByYearMonth
     *
     * Statistics View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\LinodeStats|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeStatsByYearMonth($linode_id, $year, $month)
    {
        list($response) = $this->getLinodeStatsByYearMonthWithHttpInfo($linode_id, $year, $month);
        return $response;
    }

    /**
     * Operation getLinodeStatsByYearMonthWithHttpInfo
     *
     * Statistics View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\LinodeStats|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeStatsByYearMonthWithHttpInfo($linode_id, $year, $month)
    {
        $request = $this->getLinodeStatsByYearMonthRequest($linode_id, $year, $month);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\LinodeStats' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\LinodeStats', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeStats';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\LinodeStats',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeStatsByYearMonthAsync
     *
     * Statistics View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeStatsByYearMonthAsync($linode_id, $year, $month)
    {
        return $this->getLinodeStatsByYearMonthAsyncWithHttpInfo($linode_id, $year, $month)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeStatsByYearMonthAsyncWithHttpInfo
     *
     * Statistics View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeStatsByYearMonthAsyncWithHttpInfo($linode_id, $year, $month)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeStats';
        $request = $this->getLinodeStatsByYearMonthRequest($linode_id, $year, $month);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeStatsByYearMonth'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeStatsByYearMonthRequest($linode_id, $year, $month)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeStatsByYearMonth'
            );
        }
        // verify the required parameter 'year' is set
        if ($year === null || (is_array($year) && count($year) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $year when calling getLinodeStatsByYearMonth'
            );
        }
        // verify the required parameter 'month' is set
        if ($month === null || (is_array($month) && count($month) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $month when calling getLinodeStatsByYearMonth'
            );
        }
        if ($month > 12) {
            throw new \InvalidArgumentException('invalid value for "$month" when calling LinodeInstancesApi.getLinodeStatsByYearMonth, must be smaller than or equal to 12.');
        }
        if ($month < 1) {
            throw new \InvalidArgumentException('invalid value for "$month" when calling LinodeInstancesApi.getLinodeStatsByYearMonth, must be bigger than or equal to 1.');
        }


        $resourcePath = '/linode/instances/{linodeId}/stats/{year}/{month}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($year !== null) {
            $resourcePath = str_replace(
                '{' . 'year' . '}',
                ObjectSerializer::toPathValue($year),
                $resourcePath
            );
        }
        // path params
        if ($month !== null) {
            $resourcePath = str_replace(
                '{' . 'month' . '}',
                ObjectSerializer::toPathValue($month),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeTransfer
     *
     * Network Transfer View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeTransfer($linode_id)
    {
        list($response) = $this->getLinodeTransferWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation getLinodeTransferWithHttpInfo
     *
     * Network Transfer View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeTransferWithHttpInfo($linode_id)
    {
        $request = $this->getLinodeTransferRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeTransferAsync
     *
     * Network Transfer View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeTransferAsync($linode_id)
    {
        return $this->getLinodeTransferAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeTransferAsyncWithHttpInfo
     *
     * Network Transfer View
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeTransferAsyncWithHttpInfo($linode_id)
    {
        $returnType = 'object';
        $request = $this->getLinodeTransferRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeTransfer'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeTransferRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeTransfer'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/transfer';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeTransferByYearMonth
     *
     * Network Transfer View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeTransferByYearMonth($linode_id, $year, $month)
    {
        list($response) = $this->getLinodeTransferByYearMonthWithHttpInfo($linode_id, $year, $month);
        return $response;
    }

    /**
     * Operation getLinodeTransferByYearMonthWithHttpInfo
     *
     * Network Transfer View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeTransferByYearMonthWithHttpInfo($linode_id, $year, $month)
    {
        $request = $this->getLinodeTransferByYearMonthRequest($linode_id, $year, $month);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeTransferByYearMonthAsync
     *
     * Network Transfer View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeTransferByYearMonthAsync($linode_id, $year, $month)
    {
        return $this->getLinodeTransferByYearMonthAsyncWithHttpInfo($linode_id, $year, $month)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeTransferByYearMonthAsyncWithHttpInfo
     *
     * Network Transfer View (year/month)
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeTransferByYearMonthAsyncWithHttpInfo($linode_id, $year, $month)
    {
        $returnType = 'object';
        $request = $this->getLinodeTransferByYearMonthRequest($linode_id, $year, $month);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeTransferByYearMonth'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $year Numeric value representing the year to look up. (required)
     * @param  int $month Numeric value representing the month to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeTransferByYearMonthRequest($linode_id, $year, $month)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeTransferByYearMonth'
            );
        }
        // verify the required parameter 'year' is set
        if ($year === null || (is_array($year) && count($year) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $year when calling getLinodeTransferByYearMonth'
            );
        }
        if ($year > 2037) {
            throw new \InvalidArgumentException('invalid value for "$year" when calling LinodeInstancesApi.getLinodeTransferByYearMonth, must be smaller than or equal to 2037.');
        }
        if ($year < 2000) {
            throw new \InvalidArgumentException('invalid value for "$year" when calling LinodeInstancesApi.getLinodeTransferByYearMonth, must be bigger than or equal to 2000.');
        }

        // verify the required parameter 'month' is set
        if ($month === null || (is_array($month) && count($month) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $month when calling getLinodeTransferByYearMonth'
            );
        }
        if ($month > 12) {
            throw new \InvalidArgumentException('invalid value for "$month" when calling LinodeInstancesApi.getLinodeTransferByYearMonth, must be smaller than or equal to 12.');
        }
        if ($month < 1) {
            throw new \InvalidArgumentException('invalid value for "$month" when calling LinodeInstancesApi.getLinodeTransferByYearMonth, must be bigger than or equal to 1.');
        }


        $resourcePath = '/linode/instances/{linodeId}/transfer/{year}/{month}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($year !== null) {
            $resourcePath = str_replace(
                '{' . 'year' . '}',
                ObjectSerializer::toPathValue($year),
                $resourcePath
            );
        }
        // path params
        if ($month !== null) {
            $resourcePath = str_replace(
                '{' . 'month' . '}',
                ObjectSerializer::toPathValue($month),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLinodeVolumes
     *
     * Linode&#39;s Volumes List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20024|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getLinodeVolumes($linode_id, $page = 1, $page_size = 100)
    {
        list($response) = $this->getLinodeVolumesWithHttpInfo($linode_id, $page, $page_size);
        return $response;
    }

    /**
     * Operation getLinodeVolumesWithHttpInfo
     *
     * Linode&#39;s Volumes List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20024|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinodeVolumesWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $request = $this->getLinodeVolumesRequest($linode_id, $page, $page_size);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20024' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20024', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20024';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20024',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLinodeVolumesAsync
     *
     * Linode&#39;s Volumes List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeVolumesAsync($linode_id, $page = 1, $page_size = 100)
    {
        return $this->getLinodeVolumesAsyncWithHttpInfo($linode_id, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLinodeVolumesAsyncWithHttpInfo
     *
     * Linode&#39;s Volumes List
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLinodeVolumesAsyncWithHttpInfo($linode_id, $page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20024';
        $request = $this->getLinodeVolumesRequest($linode_id, $page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLinodeVolumes'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLinodeVolumesRequest($linode_id, $page = 1, $page_size = 100)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling getLinodeVolumes'
            );
        }
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling LinodeInstancesApi.getLinodeVolumes, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeVolumes, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling LinodeInstancesApi.getLinodeVolumes, must be bigger than or equal to 25.');
        }


        $resourcePath = '/linode/instances/{linodeId}/volumes';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($page_size !== null) {
            if('form' === 'form' && is_array($page_size)) {
                foreach($page_size as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page_size'] = $page_size;
            }
        }


        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation migrateLinodeInstance
     *
     * DC Migration/Pending Host Migration Initiate
     *
     * @param  int $linode_id ID of the Linode to migrate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type unknown_base_type (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function migrateLinodeInstance($linode_id, $unknown_base_type = null)
    {
        list($response) = $this->migrateLinodeInstanceWithHttpInfo($linode_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation migrateLinodeInstanceWithHttpInfo
     *
     * DC Migration/Pending Host Migration Initiate
     *
     * @param  int $linode_id ID of the Linode to migrate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function migrateLinodeInstanceWithHttpInfo($linode_id, $unknown_base_type = null)
    {
        $request = $this->migrateLinodeInstanceRequest($linode_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation migrateLinodeInstanceAsync
     *
     * DC Migration/Pending Host Migration Initiate
     *
     * @param  int $linode_id ID of the Linode to migrate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function migrateLinodeInstanceAsync($linode_id, $unknown_base_type = null)
    {
        return $this->migrateLinodeInstanceAsyncWithHttpInfo($linode_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation migrateLinodeInstanceAsyncWithHttpInfo
     *
     * DC Migration/Pending Host Migration Initiate
     *
     * @param  int $linode_id ID of the Linode to migrate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function migrateLinodeInstanceAsyncWithHttpInfo($linode_id, $unknown_base_type = null)
    {
        $returnType = 'object';
        $request = $this->migrateLinodeInstanceRequest($linode_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'migrateLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to migrate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function migrateLinodeInstanceRequest($linode_id, $unknown_base_type = null)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling migrateLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/migrate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation mutateLinodeInstance
     *
     * Linode Upgrade
     *
     * @param  int $linode_id ID of the Linode to mutate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject10 $inline_object10 inline_object10 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function mutateLinodeInstance($linode_id, $inline_object10 = null)
    {
        list($response) = $this->mutateLinodeInstanceWithHttpInfo($linode_id, $inline_object10);
        return $response;
    }

    /**
     * Operation mutateLinodeInstanceWithHttpInfo
     *
     * Linode Upgrade
     *
     * @param  int $linode_id ID of the Linode to mutate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject10 $inline_object10 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function mutateLinodeInstanceWithHttpInfo($linode_id, $inline_object10 = null)
    {
        $request = $this->mutateLinodeInstanceRequest($linode_id, $inline_object10);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation mutateLinodeInstanceAsync
     *
     * Linode Upgrade
     *
     * @param  int $linode_id ID of the Linode to mutate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject10 $inline_object10 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function mutateLinodeInstanceAsync($linode_id, $inline_object10 = null)
    {
        return $this->mutateLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object10)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation mutateLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Upgrade
     *
     * @param  int $linode_id ID of the Linode to mutate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject10 $inline_object10 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function mutateLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object10 = null)
    {
        $returnType = 'object';
        $request = $this->mutateLinodeInstanceRequest($linode_id, $inline_object10);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'mutateLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to mutate. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject10 $inline_object10 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function mutateLinodeInstanceRequest($linode_id, $inline_object10 = null)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling mutateLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/mutate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($inline_object10)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object10));
            } else {
                $httpBody = $inline_object10;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation rebootLinodeInstance
     *
     * Linode Reboot
     *
     * @param  int $linode_id ID of the linode to reboot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Optional reboot parameters. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function rebootLinodeInstance($linode_id, $unknown_base_type = null)
    {
        list($response) = $this->rebootLinodeInstanceWithHttpInfo($linode_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation rebootLinodeInstanceWithHttpInfo
     *
     * Linode Reboot
     *
     * @param  int $linode_id ID of the linode to reboot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Optional reboot parameters. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function rebootLinodeInstanceWithHttpInfo($linode_id, $unknown_base_type = null)
    {
        $request = $this->rebootLinodeInstanceRequest($linode_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation rebootLinodeInstanceAsync
     *
     * Linode Reboot
     *
     * @param  int $linode_id ID of the linode to reboot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Optional reboot parameters. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rebootLinodeInstanceAsync($linode_id, $unknown_base_type = null)
    {
        return $this->rebootLinodeInstanceAsyncWithHttpInfo($linode_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rebootLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Reboot
     *
     * @param  int $linode_id ID of the linode to reboot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Optional reboot parameters. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rebootLinodeInstanceAsyncWithHttpInfo($linode_id, $unknown_base_type = null)
    {
        $returnType = 'object';
        $request = $this->rebootLinodeInstanceRequest($linode_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'rebootLinodeInstance'
     *
     * @param  int $linode_id ID of the linode to reboot. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Optional reboot parameters. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function rebootLinodeInstanceRequest($linode_id, $unknown_base_type = null)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling rebootLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/reboot';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation rebuildLinodeInstance
     *
     * Linode Rebuild
     *
     * @param  int $linode_id ID of the Linode to rebuild. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested state your Linode will be rebuilt into. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function rebuildLinodeInstance($linode_id, $unknown_base_type)
    {
        list($response) = $this->rebuildLinodeInstanceWithHttpInfo($linode_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation rebuildLinodeInstanceWithHttpInfo
     *
     * Linode Rebuild
     *
     * @param  int $linode_id ID of the Linode to rebuild. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested state your Linode will be rebuilt into. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function rebuildLinodeInstanceWithHttpInfo($linode_id, $unknown_base_type)
    {
        $request = $this->rebuildLinodeInstanceRequest($linode_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Linode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Linode', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Linode',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation rebuildLinodeInstanceAsync
     *
     * Linode Rebuild
     *
     * @param  int $linode_id ID of the Linode to rebuild. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested state your Linode will be rebuilt into. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rebuildLinodeInstanceAsync($linode_id, $unknown_base_type)
    {
        return $this->rebuildLinodeInstanceAsyncWithHttpInfo($linode_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rebuildLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Rebuild
     *
     * @param  int $linode_id ID of the Linode to rebuild. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested state your Linode will be rebuilt into. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rebuildLinodeInstanceAsyncWithHttpInfo($linode_id, $unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
        $request = $this->rebuildLinodeInstanceRequest($linode_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'rebuildLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to rebuild. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The requested state your Linode will be rebuilt into. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function rebuildLinodeInstanceRequest($linode_id, $unknown_base_type)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling rebuildLinodeInstance'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling rebuildLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/rebuild';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation removeLinodeIP
     *
     * IPv4 Address Delete
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function removeLinodeIP($linode_id, $address)
    {
        list($response) = $this->removeLinodeIPWithHttpInfo($linode_id, $address);
        return $response;
    }

    /**
     * Operation removeLinodeIPWithHttpInfo
     *
     * IPv4 Address Delete
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function removeLinodeIPWithHttpInfo($linode_id, $address)
    {
        $request = $this->removeLinodeIPRequest($linode_id, $address);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation removeLinodeIPAsync
     *
     * IPv4 Address Delete
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function removeLinodeIPAsync($linode_id, $address)
    {
        return $this->removeLinodeIPAsyncWithHttpInfo($linode_id, $address)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation removeLinodeIPAsyncWithHttpInfo
     *
     * IPv4 Address Delete
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function removeLinodeIPAsyncWithHttpInfo($linode_id, $address)
    {
        $returnType = 'object';
        $request = $this->removeLinodeIPRequest($linode_id, $address);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'removeLinodeIP'
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function removeLinodeIPRequest($linode_id, $address)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling removeLinodeIP'
            );
        }
        // verify the required parameter 'address' is set
        if ($address === null || (is_array($address) && count($address) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $address when calling removeLinodeIP'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/ips/{address}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($address !== null) {
            $resourcePath = str_replace(
                '{' . 'address' . '}',
                ObjectSerializer::toPathValue($address),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation rescueLinodeInstance
     *
     * Linode Boot into Rescue Mode
     *
     * @param  int $linode_id ID of the Linode to rescue. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject11 $inline_object11 inline_object11 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function rescueLinodeInstance($linode_id, $inline_object11 = null)
    {
        list($response) = $this->rescueLinodeInstanceWithHttpInfo($linode_id, $inline_object11);
        return $response;
    }

    /**
     * Operation rescueLinodeInstanceWithHttpInfo
     *
     * Linode Boot into Rescue Mode
     *
     * @param  int $linode_id ID of the Linode to rescue. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject11 $inline_object11 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function rescueLinodeInstanceWithHttpInfo($linode_id, $inline_object11 = null)
    {
        $request = $this->rescueLinodeInstanceRequest($linode_id, $inline_object11);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation rescueLinodeInstanceAsync
     *
     * Linode Boot into Rescue Mode
     *
     * @param  int $linode_id ID of the Linode to rescue. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject11 $inline_object11 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rescueLinodeInstanceAsync($linode_id, $inline_object11 = null)
    {
        return $this->rescueLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object11)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rescueLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Boot into Rescue Mode
     *
     * @param  int $linode_id ID of the Linode to rescue. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject11 $inline_object11 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rescueLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object11 = null)
    {
        $returnType = 'object';
        $request = $this->rescueLinodeInstanceRequest($linode_id, $inline_object11);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'rescueLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to rescue. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject11 $inline_object11 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function rescueLinodeInstanceRequest($linode_id, $inline_object11 = null)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling rescueLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/rescue';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($inline_object11)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object11));
            } else {
                $httpBody = $inline_object11;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation resetDiskPassword
     *
     * Disk Root Password Reset
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new password. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function resetDiskPassword($linode_id, $disk_id, $unknown_base_type)
    {
        list($response) = $this->resetDiskPasswordWithHttpInfo($linode_id, $disk_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation resetDiskPasswordWithHttpInfo
     *
     * Disk Root Password Reset
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new password. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function resetDiskPasswordWithHttpInfo($linode_id, $disk_id, $unknown_base_type)
    {
        $request = $this->resetDiskPasswordRequest($linode_id, $disk_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation resetDiskPasswordAsync
     *
     * Disk Root Password Reset
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new password. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resetDiskPasswordAsync($linode_id, $disk_id, $unknown_base_type)
    {
        return $this->resetDiskPasswordAsyncWithHttpInfo($linode_id, $disk_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resetDiskPasswordAsyncWithHttpInfo
     *
     * Disk Root Password Reset
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new password. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resetDiskPasswordAsyncWithHttpInfo($linode_id, $disk_id, $unknown_base_type)
    {
        $returnType = 'object';
        $request = $this->resetDiskPasswordRequest($linode_id, $disk_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'resetDiskPassword'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new password. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function resetDiskPasswordRequest($linode_id, $disk_id, $unknown_base_type)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling resetDiskPassword'
            );
        }
        // verify the required parameter 'disk_id' is set
        if ($disk_id === null || (is_array($disk_id) && count($disk_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $disk_id when calling resetDiskPassword'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling resetDiskPassword'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/disks/{diskId}/password';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($disk_id !== null) {
            $resourcePath = str_replace(
                '{' . 'diskId' . '}',
                ObjectSerializer::toPathValue($disk_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation resetLinodePassword
     *
     * Linode Root Password Reset
     *
     * @param  int $linode_id ID of the Linode for which to reset its root password. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type This Linode&#39;s new root password. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function resetLinodePassword($linode_id, $unknown_base_type = null)
    {
        list($response) = $this->resetLinodePasswordWithHttpInfo($linode_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation resetLinodePasswordWithHttpInfo
     *
     * Linode Root Password Reset
     *
     * @param  int $linode_id ID of the Linode for which to reset its root password. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type This Linode&#39;s new root password. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function resetLinodePasswordWithHttpInfo($linode_id, $unknown_base_type = null)
    {
        $request = $this->resetLinodePasswordRequest($linode_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation resetLinodePasswordAsync
     *
     * Linode Root Password Reset
     *
     * @param  int $linode_id ID of the Linode for which to reset its root password. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type This Linode&#39;s new root password. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resetLinodePasswordAsync($linode_id, $unknown_base_type = null)
    {
        return $this->resetLinodePasswordAsyncWithHttpInfo($linode_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resetLinodePasswordAsyncWithHttpInfo
     *
     * Linode Root Password Reset
     *
     * @param  int $linode_id ID of the Linode for which to reset its root password. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type This Linode&#39;s new root password. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resetLinodePasswordAsyncWithHttpInfo($linode_id, $unknown_base_type = null)
    {
        $returnType = 'object';
        $request = $this->resetLinodePasswordRequest($linode_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'resetLinodePassword'
     *
     * @param  int $linode_id ID of the Linode for which to reset its root password. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type This Linode&#39;s new root password. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function resetLinodePasswordRequest($linode_id, $unknown_base_type = null)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling resetLinodePassword'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/password';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation resizeDisk
     *
     * Disk Resize
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new size of the Disk. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function resizeDisk($linode_id, $disk_id, $unknown_base_type)
    {
        list($response) = $this->resizeDiskWithHttpInfo($linode_id, $disk_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation resizeDiskWithHttpInfo
     *
     * Disk Resize
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new size of the Disk. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function resizeDiskWithHttpInfo($linode_id, $disk_id, $unknown_base_type)
    {
        $request = $this->resizeDiskRequest($linode_id, $disk_id, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation resizeDiskAsync
     *
     * Disk Resize
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new size of the Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resizeDiskAsync($linode_id, $disk_id, $unknown_base_type)
    {
        return $this->resizeDiskAsyncWithHttpInfo($linode_id, $disk_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resizeDiskAsyncWithHttpInfo
     *
     * Disk Resize
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new size of the Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resizeDiskAsyncWithHttpInfo($linode_id, $disk_id, $unknown_base_type)
    {
        $returnType = 'object';
        $request = $this->resizeDiskRequest($linode_id, $disk_id, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'resizeDisk'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The new size of the Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function resizeDiskRequest($linode_id, $disk_id, $unknown_base_type)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling resizeDisk'
            );
        }
        // verify the required parameter 'disk_id' is set
        if ($disk_id === null || (is_array($disk_id) && count($disk_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $disk_id when calling resizeDisk'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling resizeDisk'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/disks/{diskId}/resize';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($disk_id !== null) {
            $resourcePath = str_replace(
                '{' . 'diskId' . '}',
                ObjectSerializer::toPathValue($disk_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation resizeLinodeInstance
     *
     * Linode Resize
     *
     * @param  int $linode_id ID of the Linode to resize. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject12 $inline_object12 inline_object12 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function resizeLinodeInstance($linode_id, $inline_object12)
    {
        list($response) = $this->resizeLinodeInstanceWithHttpInfo($linode_id, $inline_object12);
        return $response;
    }

    /**
     * Operation resizeLinodeInstanceWithHttpInfo
     *
     * Linode Resize
     *
     * @param  int $linode_id ID of the Linode to resize. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject12 $inline_object12 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function resizeLinodeInstanceWithHttpInfo($linode_id, $inline_object12)
    {
        $request = $this->resizeLinodeInstanceRequest($linode_id, $inline_object12);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation resizeLinodeInstanceAsync
     *
     * Linode Resize
     *
     * @param  int $linode_id ID of the Linode to resize. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject12 $inline_object12 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resizeLinodeInstanceAsync($linode_id, $inline_object12)
    {
        return $this->resizeLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object12)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resizeLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Resize
     *
     * @param  int $linode_id ID of the Linode to resize. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject12 $inline_object12 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resizeLinodeInstanceAsyncWithHttpInfo($linode_id, $inline_object12)
    {
        $returnType = 'object';
        $request = $this->resizeLinodeInstanceRequest($linode_id, $inline_object12);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'resizeLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to resize. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject12 $inline_object12 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function resizeLinodeInstanceRequest($linode_id, $inline_object12)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling resizeLinodeInstance'
            );
        }
        // verify the required parameter 'inline_object12' is set
        if ($inline_object12 === null || (is_array($inline_object12) && count($inline_object12) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $inline_object12 when calling resizeLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/resize';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($inline_object12)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object12));
            } else {
                $httpBody = $inline_object12;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation restoreBackup
     *
     * Backup Restore
     *
     * @param  int $linode_id The ID of the Linode that the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to restore. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject7 $inline_object7 inline_object7 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function restoreBackup($linode_id, $backup_id, $inline_object7)
    {
        list($response) = $this->restoreBackupWithHttpInfo($linode_id, $backup_id, $inline_object7);
        return $response;
    }

    /**
     * Operation restoreBackupWithHttpInfo
     *
     * Backup Restore
     *
     * @param  int $linode_id The ID of the Linode that the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to restore. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject7 $inline_object7 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function restoreBackupWithHttpInfo($linode_id, $backup_id, $inline_object7)
    {
        $request = $this->restoreBackupRequest($linode_id, $backup_id, $inline_object7);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation restoreBackupAsync
     *
     * Backup Restore
     *
     * @param  int $linode_id The ID of the Linode that the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to restore. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject7 $inline_object7 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function restoreBackupAsync($linode_id, $backup_id, $inline_object7)
    {
        return $this->restoreBackupAsyncWithHttpInfo($linode_id, $backup_id, $inline_object7)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation restoreBackupAsyncWithHttpInfo
     *
     * Backup Restore
     *
     * @param  int $linode_id The ID of the Linode that the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to restore. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject7 $inline_object7 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function restoreBackupAsyncWithHttpInfo($linode_id, $backup_id, $inline_object7)
    {
        $returnType = 'object';
        $request = $this->restoreBackupRequest($linode_id, $backup_id, $inline_object7);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'restoreBackup'
     *
     * @param  int $linode_id The ID of the Linode that the Backup belongs to. (required)
     * @param  int $backup_id The ID of the Backup to restore. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject7 $inline_object7 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function restoreBackupRequest($linode_id, $backup_id, $inline_object7)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling restoreBackup'
            );
        }
        // verify the required parameter 'backup_id' is set
        if ($backup_id === null || (is_array($backup_id) && count($backup_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $backup_id when calling restoreBackup'
            );
        }
        // verify the required parameter 'inline_object7' is set
        if ($inline_object7 === null || (is_array($inline_object7) && count($inline_object7) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $inline_object7 when calling restoreBackup'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/backups/{backupId}/restore';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($backup_id !== null) {
            $resourcePath = str_replace(
                '{' . 'backupId' . '}',
                ObjectSerializer::toPathValue($backup_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($inline_object7)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object7));
            } else {
                $httpBody = $inline_object7;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation shutdownLinodeInstance
     *
     * Linode Shut Down
     *
     * @param  int $linode_id ID of the Linode to shutdown. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function shutdownLinodeInstance($linode_id)
    {
        list($response) = $this->shutdownLinodeInstanceWithHttpInfo($linode_id);
        return $response;
    }

    /**
     * Operation shutdownLinodeInstanceWithHttpInfo
     *
     * Linode Shut Down
     *
     * @param  int $linode_id ID of the Linode to shutdown. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function shutdownLinodeInstanceWithHttpInfo($linode_id)
    {
        $request = $this->shutdownLinodeInstanceRequest($linode_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation shutdownLinodeInstanceAsync
     *
     * Linode Shut Down
     *
     * @param  int $linode_id ID of the Linode to shutdown. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shutdownLinodeInstanceAsync($linode_id)
    {
        return $this->shutdownLinodeInstanceAsyncWithHttpInfo($linode_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation shutdownLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Shut Down
     *
     * @param  int $linode_id ID of the Linode to shutdown. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shutdownLinodeInstanceAsyncWithHttpInfo($linode_id)
    {
        $returnType = 'object';
        $request = $this->shutdownLinodeInstanceRequest($linode_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'shutdownLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to shutdown. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function shutdownLinodeInstanceRequest($linode_id)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling shutdownLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/shutdown';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateDisk
     *
     * Disk Update
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Disk $disk Updates the parameters of a single Disk. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateDisk($linode_id, $disk_id, $disk)
    {
        list($response) = $this->updateDiskWithHttpInfo($linode_id, $disk_id, $disk);
        return $response;
    }

    /**
     * Operation updateDiskWithHttpInfo
     *
     * Disk Update
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Disk $disk Updates the parameters of a single Disk. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Disk|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateDiskWithHttpInfo($linode_id, $disk_id, $disk)
    {
        $request = $this->updateDiskRequest($linode_id, $disk_id, $disk);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Disk' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Disk', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Disk',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateDiskAsync
     *
     * Disk Update
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Disk $disk Updates the parameters of a single Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDiskAsync($linode_id, $disk_id, $disk)
    {
        return $this->updateDiskAsyncWithHttpInfo($linode_id, $disk_id, $disk)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateDiskAsyncWithHttpInfo
     *
     * Disk Update
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Disk $disk Updates the parameters of a single Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDiskAsyncWithHttpInfo($linode_id, $disk_id, $disk)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Disk';
        $request = $this->updateDiskRequest($linode_id, $disk_id, $disk);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateDisk'
     *
     * @param  int $linode_id ID of the Linode to look up. (required)
     * @param  int $disk_id ID of the Disk to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Disk $disk Updates the parameters of a single Disk. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateDiskRequest($linode_id, $disk_id, $disk)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling updateDisk'
            );
        }
        // verify the required parameter 'disk_id' is set
        if ($disk_id === null || (is_array($disk_id) && count($disk_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $disk_id when calling updateDisk'
            );
        }
        // verify the required parameter 'disk' is set
        if ($disk === null || (is_array($disk) && count($disk) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $disk when calling updateDisk'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/disks/{diskId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($disk_id !== null) {
            $resourcePath = str_replace(
                '{' . 'diskId' . '}',
                ObjectSerializer::toPathValue($disk_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($disk)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($disk));
            } else {
                $httpBody = $disk;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateLinodeConfig
     *
     * Configuration Profile Update
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\LinodeConfig $linode_config The Configuration profile parameters to modify. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\LinodeConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateLinodeConfig($linode_id, $config_id, $linode_config)
    {
        list($response) = $this->updateLinodeConfigWithHttpInfo($linode_id, $config_id, $linode_config);
        return $response;
    }

    /**
     * Operation updateLinodeConfigWithHttpInfo
     *
     * Configuration Profile Update
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\LinodeConfig $linode_config The Configuration profile parameters to modify. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\LinodeConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateLinodeConfigWithHttpInfo($linode_id, $config_id, $linode_config)
    {
        $request = $this->updateLinodeConfigRequest($linode_id, $config_id, $linode_config);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\LinodeConfig' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateLinodeConfigAsync
     *
     * Configuration Profile Update
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\LinodeConfig $linode_config The Configuration profile parameters to modify. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateLinodeConfigAsync($linode_id, $config_id, $linode_config)
    {
        return $this->updateLinodeConfigAsyncWithHttpInfo($linode_id, $config_id, $linode_config)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateLinodeConfigAsyncWithHttpInfo
     *
     * Configuration Profile Update
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\LinodeConfig $linode_config The Configuration profile parameters to modify. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateLinodeConfigAsyncWithHttpInfo($linode_id, $config_id, $linode_config)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\LinodeConfig';
        $request = $this->updateLinodeConfigRequest($linode_id, $config_id, $linode_config);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateLinodeConfig'
     *
     * @param  int $linode_id The ID of the Linode whose Configuration profile to look up. (required)
     * @param  int $config_id The ID of the Configuration profile to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\LinodeConfig $linode_config The Configuration profile parameters to modify. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateLinodeConfigRequest($linode_id, $config_id, $linode_config)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling updateLinodeConfig'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling updateLinodeConfig'
            );
        }
        // verify the required parameter 'linode_config' is set
        if ($linode_config === null || (is_array($linode_config) && count($linode_config) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_config when calling updateLinodeConfig'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/configs/{configId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($config_id !== null) {
            $resourcePath = str_replace(
                '{' . 'configId' . '}',
                ObjectSerializer::toPathValue($config_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($linode_config)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($linode_config));
            } else {
                $httpBody = $linode_config;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateLinodeIP
     *
     * IP Address Update
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The information to update for the IP address. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\IPAddress|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateLinodeIP($linode_id, $address, $unknown_base_type = null)
    {
        list($response) = $this->updateLinodeIPWithHttpInfo($linode_id, $address, $unknown_base_type);
        return $response;
    }

    /**
     * Operation updateLinodeIPWithHttpInfo
     *
     * IP Address Update
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The information to update for the IP address. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\IPAddress|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateLinodeIPWithHttpInfo($linode_id, $address, $unknown_base_type = null)
    {
        $request = $this->updateLinodeIPRequest($linode_id, $address, $unknown_base_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\IPAddress' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\IPAddress', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\IPAddress';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\IPAddress',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateLinodeIPAsync
     *
     * IP Address Update
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The information to update for the IP address. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateLinodeIPAsync($linode_id, $address, $unknown_base_type = null)
    {
        return $this->updateLinodeIPAsyncWithHttpInfo($linode_id, $address, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateLinodeIPAsyncWithHttpInfo
     *
     * IP Address Update
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The information to update for the IP address. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateLinodeIPAsyncWithHttpInfo($linode_id, $address, $unknown_base_type = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\IPAddress';
        $request = $this->updateLinodeIPRequest($linode_id, $address, $unknown_base_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateLinodeIP'
     *
     * @param  int $linode_id The ID of the Linode to look up. (required)
     * @param  string $address The IP address to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The information to update for the IP address. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateLinodeIPRequest($linode_id, $address, $unknown_base_type = null)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling updateLinodeIP'
            );
        }
        // verify the required parameter 'address' is set
        if ($address === null || (is_array($address) && count($address) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $address when calling updateLinodeIP'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}/ips/{address}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }
        // path params
        if ($address !== null) {
            $resourcePath = str_replace(
                '{' . 'address' . '}',
                ObjectSerializer::toPathValue($address),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($unknown_base_type)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($unknown_base_type));
            } else {
                $httpBody = $unknown_base_type;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateLinodeInstance
     *
     * Linode Update
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Linode $linode Any field that is not marked as &#x60;readOnly&#x60; may be updated. Fields that are marked &#x60;readOnly&#x60; will be ignored. If any updated field fails to pass validation, the Linode will not be updated. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateLinodeInstance($linode_id, $linode)
    {
        list($response) = $this->updateLinodeInstanceWithHttpInfo($linode_id, $linode);
        return $response;
    }

    /**
     * Operation updateLinodeInstanceWithHttpInfo
     *
     * Linode Update
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Linode $linode Any field that is not marked as &#x60;readOnly&#x60; may be updated. Fields that are marked &#x60;readOnly&#x60; will be ignored. If any updated field fails to pass validation, the Linode will not be updated. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Linode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateLinodeInstanceWithHttpInfo($linode_id, $linode)
    {
        $request = $this->updateLinodeInstanceRequest($linode_id, $linode);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\ZoneWatcher\LinodeApiV4\Model\Linode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Linode', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\Linode',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateLinodeInstanceAsync
     *
     * Linode Update
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Linode $linode Any field that is not marked as &#x60;readOnly&#x60; may be updated. Fields that are marked &#x60;readOnly&#x60; will be ignored. If any updated field fails to pass validation, the Linode will not be updated. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateLinodeInstanceAsync($linode_id, $linode)
    {
        return $this->updateLinodeInstanceAsyncWithHttpInfo($linode_id, $linode)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateLinodeInstanceAsyncWithHttpInfo
     *
     * Linode Update
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Linode $linode Any field that is not marked as &#x60;readOnly&#x60; may be updated. Fields that are marked &#x60;readOnly&#x60; will be ignored. If any updated field fails to pass validation, the Linode will not be updated. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateLinodeInstanceAsyncWithHttpInfo($linode_id, $linode)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Linode';
        $request = $this->updateLinodeInstanceRequest($linode_id, $linode);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateLinodeInstance'
     *
     * @param  int $linode_id ID of the Linode to look up (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Linode $linode Any field that is not marked as &#x60;readOnly&#x60; may be updated. Fields that are marked &#x60;readOnly&#x60; will be ignored. If any updated field fails to pass validation, the Linode will not be updated. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateLinodeInstanceRequest($linode_id, $linode)
    {
        // verify the required parameter 'linode_id' is set
        if ($linode_id === null || (is_array($linode_id) && count($linode_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode_id when calling updateLinodeInstance'
            );
        }
        // verify the required parameter 'linode' is set
        if ($linode === null || (is_array($linode) && count($linode) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $linode when calling updateLinodeInstance'
            );
        }

        $resourcePath = '/linode/instances/{linodeId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($linode_id !== null) {
            $resourcePath = str_replace(
                '{' . 'linodeId' . '}',
                ObjectSerializer::toPathValue($linode_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($linode)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($linode));
            } else {
                $httpBody = $linode;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}

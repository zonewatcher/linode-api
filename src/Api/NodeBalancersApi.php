<?php
/**
 * NodeBalancersApi
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
 * NodeBalancersApi Class Doc Comment
 *
 * @category Class
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class NodeBalancersApi
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
     * Operation createNodeBalancer
     *
     * NodeBalancer Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer to create. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createNodeBalancer($unknown_base_type)
    {
        list($response) = $this->createNodeBalancerWithHttpInfo($unknown_base_type);
        return $response;
    }

    /**
     * Operation createNodeBalancerWithHttpInfo
     *
     * NodeBalancer Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer to create. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createNodeBalancerWithHttpInfo($unknown_base_type)
    {
        $request = $this->createNodeBalancerRequest($unknown_base_type);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancer' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer',
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
     * Operation createNodeBalancerAsync
     *
     * NodeBalancer Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer to create. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createNodeBalancerAsync($unknown_base_type)
    {
        return $this->createNodeBalancerAsyncWithHttpInfo($unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createNodeBalancerAsyncWithHttpInfo
     *
     * NodeBalancer Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer to create. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createNodeBalancerAsyncWithHttpInfo($unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
        $request = $this->createNodeBalancerRequest($unknown_base_type);

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
     * Create request for operation 'createNodeBalancer'
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer to create. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createNodeBalancerRequest($unknown_base_type)
    {
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling createNodeBalancer'
            );
        }

        $resourcePath = '/nodebalancers';
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
     * Operation createNodeBalancerConfig
     *
     * Config Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config Information about the port to configure. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createNodeBalancerConfig($node_balancer_id, $node_balancer_config = null)
    {
        list($response) = $this->createNodeBalancerConfigWithHttpInfo($node_balancer_id, $node_balancer_config);
        return $response;
    }

    /**
     * Operation createNodeBalancerConfigWithHttpInfo
     *
     * Config Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config Information about the port to configure. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createNodeBalancerConfigWithHttpInfo($node_balancer_id, $node_balancer_config = null)
    {
        $request = $this->createNodeBalancerConfigRequest($node_balancer_id, $node_balancer_config);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig',
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
     * Operation createNodeBalancerConfigAsync
     *
     * Config Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config Information about the port to configure. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createNodeBalancerConfigAsync($node_balancer_id, $node_balancer_config = null)
    {
        return $this->createNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $node_balancer_config)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createNodeBalancerConfigAsyncWithHttpInfo
     *
     * Config Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config Information about the port to configure. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $node_balancer_config = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig';
        $request = $this->createNodeBalancerConfigRequest($node_balancer_id, $node_balancer_config);

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
     * Create request for operation 'createNodeBalancerConfig'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config Information about the port to configure. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createNodeBalancerConfigRequest($node_balancer_id, $node_balancer_config = null)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling createNodeBalancerConfig'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
        if (isset($node_balancer_config)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($node_balancer_config));
            } else {
                $httpBody = $node_balancer_config;
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
     * Operation createNodeBalancerNode
     *
     * Node Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Node to create. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createNodeBalancerNode($node_balancer_id, $config_id, $unknown_base_type)
    {
        list($response) = $this->createNodeBalancerNodeWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation createNodeBalancerNodeWithHttpInfo
     *
     * Node Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Node to create. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createNodeBalancerNodeWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type)
    {
        $request = $this->createNodeBalancerNodeRequest($node_balancer_id, $config_id, $unknown_base_type);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode',
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
     * Operation createNodeBalancerNodeAsync
     *
     * Node Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Node to create. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createNodeBalancerNodeAsync($node_balancer_id, $config_id, $unknown_base_type)
    {
        return $this->createNodeBalancerNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createNodeBalancerNodeAsyncWithHttpInfo
     *
     * Node Create
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Node to create. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createNodeBalancerNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode';
        $request = $this->createNodeBalancerNodeRequest($node_balancer_id, $config_id, $unknown_base_type);

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
     * Create request for operation 'createNodeBalancerNode'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Node to create. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createNodeBalancerNodeRequest($node_balancer_id, $config_id, $unknown_base_type)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling createNodeBalancerNode'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling createNodeBalancerNode'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling createNodeBalancerNode'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}/nodes';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation deleteNodeBalancer
     *
     * NodeBalancer Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteNodeBalancer($node_balancer_id)
    {
        list($response) = $this->deleteNodeBalancerWithHttpInfo($node_balancer_id);
        return $response;
    }

    /**
     * Operation deleteNodeBalancerWithHttpInfo
     *
     * NodeBalancer Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteNodeBalancerWithHttpInfo($node_balancer_id)
    {
        $request = $this->deleteNodeBalancerRequest($node_balancer_id);

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
     * Operation deleteNodeBalancerAsync
     *
     * NodeBalancer Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteNodeBalancerAsync($node_balancer_id)
    {
        return $this->deleteNodeBalancerAsyncWithHttpInfo($node_balancer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteNodeBalancerAsyncWithHttpInfo
     *
     * NodeBalancer Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteNodeBalancerAsyncWithHttpInfo($node_balancer_id)
    {
        $returnType = 'object';
        $request = $this->deleteNodeBalancerRequest($node_balancer_id);

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
     * Create request for operation 'deleteNodeBalancer'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteNodeBalancerRequest($node_balancer_id)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling deleteNodeBalancer'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation deleteNodeBalancerConfig
     *
     * Config Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteNodeBalancerConfig($node_balancer_id, $config_id)
    {
        list($response) = $this->deleteNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id);
        return $response;
    }

    /**
     * Operation deleteNodeBalancerConfigWithHttpInfo
     *
     * Config Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id)
    {
        $request = $this->deleteNodeBalancerConfigRequest($node_balancer_id, $config_id);

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
     * Operation deleteNodeBalancerConfigAsync
     *
     * Config Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteNodeBalancerConfigAsync($node_balancer_id, $config_id)
    {
        return $this->deleteNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteNodeBalancerConfigAsyncWithHttpInfo
     *
     * Config Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id)
    {
        $returnType = 'object';
        $request = $this->deleteNodeBalancerConfigRequest($node_balancer_id, $config_id);

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
     * Create request for operation 'deleteNodeBalancerConfig'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteNodeBalancerConfigRequest($node_balancer_id, $config_id)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling deleteNodeBalancerConfig'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling deleteNodeBalancerConfig'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation deleteNodeBalancerConfigNode
     *
     * Node Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteNodeBalancerConfigNode($node_balancer_id, $config_id, $node_id)
    {
        list($response) = $this->deleteNodeBalancerConfigNodeWithHttpInfo($node_balancer_id, $config_id, $node_id);
        return $response;
    }

    /**
     * Operation deleteNodeBalancerConfigNodeWithHttpInfo
     *
     * Node Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteNodeBalancerConfigNodeWithHttpInfo($node_balancer_id, $config_id, $node_id)
    {
        $request = $this->deleteNodeBalancerConfigNodeRequest($node_balancer_id, $config_id, $node_id);

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
     * Operation deleteNodeBalancerConfigNodeAsync
     *
     * Node Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteNodeBalancerConfigNodeAsync($node_balancer_id, $config_id, $node_id)
    {
        return $this->deleteNodeBalancerConfigNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $node_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteNodeBalancerConfigNodeAsyncWithHttpInfo
     *
     * Node Delete
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteNodeBalancerConfigNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $node_id)
    {
        $returnType = 'object';
        $request = $this->deleteNodeBalancerConfigNodeRequest($node_balancer_id, $config_id, $node_id);

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
     * Create request for operation 'deleteNodeBalancerConfigNode'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteNodeBalancerConfigNodeRequest($node_balancer_id, $config_id, $node_id)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling deleteNodeBalancerConfigNode'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling deleteNodeBalancerConfigNode'
            );
        }
        // verify the required parameter 'node_id' is set
        if ($node_id === null || (is_array($node_id) && count($node_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_id when calling deleteNodeBalancerConfigNode'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
        // path params
        if ($node_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeId' . '}',
                ObjectSerializer::toPathValue($node_id),
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
     * Operation getNodeBalancer
     *
     * NodeBalancer View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getNodeBalancer($node_balancer_id)
    {
        list($response) = $this->getNodeBalancerWithHttpInfo($node_balancer_id);
        return $response;
    }

    /**
     * Operation getNodeBalancerWithHttpInfo
     *
     * NodeBalancer View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNodeBalancerWithHttpInfo($node_balancer_id)
    {
        $request = $this->getNodeBalancerRequest($node_balancer_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancer' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer',
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
     * Operation getNodeBalancerAsync
     *
     * NodeBalancer View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerAsync($node_balancer_id)
    {
        return $this->getNodeBalancerAsyncWithHttpInfo($node_balancer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getNodeBalancerAsyncWithHttpInfo
     *
     * NodeBalancer View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerAsyncWithHttpInfo($node_balancer_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
        $request = $this->getNodeBalancerRequest($node_balancer_id);

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
     * Create request for operation 'getNodeBalancer'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getNodeBalancerRequest($node_balancer_id)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling getNodeBalancer'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation getNodeBalancerConfig
     *
     * Config View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getNodeBalancerConfig($node_balancer_id, $config_id)
    {
        list($response) = $this->getNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id);
        return $response;
    }

    /**
     * Operation getNodeBalancerConfigWithHttpInfo
     *
     * Config View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id)
    {
        $request = $this->getNodeBalancerConfigRequest($node_balancer_id, $config_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig',
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
     * Operation getNodeBalancerConfigAsync
     *
     * Config View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerConfigAsync($node_balancer_id, $config_id)
    {
        return $this->getNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getNodeBalancerConfigAsyncWithHttpInfo
     *
     * Config View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig';
        $request = $this->getNodeBalancerConfigRequest($node_balancer_id, $config_id);

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
     * Create request for operation 'getNodeBalancerConfig'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getNodeBalancerConfigRequest($node_balancer_id, $config_id)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling getNodeBalancerConfig'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling getNodeBalancerConfig'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation getNodeBalancerConfigNodes
     *
     * Nodes List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20048|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getNodeBalancerConfigNodes($node_balancer_id, $config_id, $page = 1, $page_size = 100)
    {
        list($response) = $this->getNodeBalancerConfigNodesWithHttpInfo($node_balancer_id, $config_id, $page, $page_size);
        return $response;
    }

    /**
     * Operation getNodeBalancerConfigNodesWithHttpInfo
     *
     * Nodes List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20048|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNodeBalancerConfigNodesWithHttpInfo($node_balancer_id, $config_id, $page = 1, $page_size = 100)
    {
        $request = $this->getNodeBalancerConfigNodesRequest($node_balancer_id, $config_id, $page, $page_size);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20048' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20048', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20048';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20048',
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
     * Operation getNodeBalancerConfigNodesAsync
     *
     * Nodes List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerConfigNodesAsync($node_balancer_id, $config_id, $page = 1, $page_size = 100)
    {
        return $this->getNodeBalancerConfigNodesAsyncWithHttpInfo($node_balancer_id, $config_id, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getNodeBalancerConfigNodesAsyncWithHttpInfo
     *
     * Nodes List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerConfigNodesAsyncWithHttpInfo($node_balancer_id, $config_id, $page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20048';
        $request = $this->getNodeBalancerConfigNodesRequest($node_balancer_id, $config_id, $page, $page_size);

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
     * Create request for operation 'getNodeBalancerConfigNodes'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the NodeBalancer config to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getNodeBalancerConfigNodesRequest($node_balancer_id, $config_id, $page = 1, $page_size = 100)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling getNodeBalancerConfigNodes'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling getNodeBalancerConfigNodes'
            );
        }
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling NodeBalancersApi.getNodeBalancerConfigNodes, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling NodeBalancersApi.getNodeBalancerConfigNodes, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling NodeBalancersApi.getNodeBalancerConfigNodes, must be bigger than or equal to 25.');
        }


        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}/nodes';
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
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation getNodeBalancerConfigs
     *
     * Configs List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20047|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getNodeBalancerConfigs($node_balancer_id, $page = 1, $page_size = 100)
    {
        list($response) = $this->getNodeBalancerConfigsWithHttpInfo($node_balancer_id, $page, $page_size);
        return $response;
    }

    /**
     * Operation getNodeBalancerConfigsWithHttpInfo
     *
     * Configs List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20047|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNodeBalancerConfigsWithHttpInfo($node_balancer_id, $page = 1, $page_size = 100)
    {
        $request = $this->getNodeBalancerConfigsRequest($node_balancer_id, $page, $page_size);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20047' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20047', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20047';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20047',
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
     * Operation getNodeBalancerConfigsAsync
     *
     * Configs List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerConfigsAsync($node_balancer_id, $page = 1, $page_size = 100)
    {
        return $this->getNodeBalancerConfigsAsyncWithHttpInfo($node_balancer_id, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getNodeBalancerConfigsAsyncWithHttpInfo
     *
     * Configs List
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerConfigsAsyncWithHttpInfo($node_balancer_id, $page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20047';
        $request = $this->getNodeBalancerConfigsRequest($node_balancer_id, $page, $page_size);

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
     * Create request for operation 'getNodeBalancerConfigs'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getNodeBalancerConfigsRequest($node_balancer_id, $page = 1, $page_size = 100)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling getNodeBalancerConfigs'
            );
        }
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling NodeBalancersApi.getNodeBalancerConfigs, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling NodeBalancersApi.getNodeBalancerConfigs, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling NodeBalancersApi.getNodeBalancerConfigs, must be bigger than or equal to 25.');
        }


        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs';
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
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation getNodeBalancerNode
     *
     * Node View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getNodeBalancerNode($node_balancer_id, $config_id, $node_id)
    {
        list($response) = $this->getNodeBalancerNodeWithHttpInfo($node_balancer_id, $config_id, $node_id);
        return $response;
    }

    /**
     * Operation getNodeBalancerNodeWithHttpInfo
     *
     * Node View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNodeBalancerNodeWithHttpInfo($node_balancer_id, $config_id, $node_id)
    {
        $request = $this->getNodeBalancerNodeRequest($node_balancer_id, $config_id, $node_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode',
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
     * Operation getNodeBalancerNodeAsync
     *
     * Node View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerNodeAsync($node_balancer_id, $config_id, $node_id)
    {
        return $this->getNodeBalancerNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $node_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getNodeBalancerNodeAsyncWithHttpInfo
     *
     * Node View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancerNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $node_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode';
        $request = $this->getNodeBalancerNodeRequest($node_balancer_id, $config_id, $node_id);

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
     * Create request for operation 'getNodeBalancerNode'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getNodeBalancerNodeRequest($node_balancer_id, $config_id, $node_id)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling getNodeBalancerNode'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling getNodeBalancerNode'
            );
        }
        // verify the required parameter 'node_id' is set
        if ($node_id === null || (is_array($node_id) && count($node_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_id when calling getNodeBalancerNode'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
        // path params
        if ($node_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeId' . '}',
                ObjectSerializer::toPathValue($node_id),
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
     * Operation getNodeBalancers
     *
     * NodeBalancers List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20023|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getNodeBalancers($page = 1, $page_size = 100)
    {
        list($response) = $this->getNodeBalancersWithHttpInfo($page, $page_size);
        return $response;
    }

    /**
     * Operation getNodeBalancersWithHttpInfo
     *
     * NodeBalancers List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20023|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNodeBalancersWithHttpInfo($page = 1, $page_size = 100)
    {
        $request = $this->getNodeBalancersRequest($page, $page_size);

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
     * Operation getNodeBalancersAsync
     *
     * NodeBalancers List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancersAsync($page = 1, $page_size = 100)
    {
        return $this->getNodeBalancersAsyncWithHttpInfo($page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getNodeBalancersAsyncWithHttpInfo
     *
     * NodeBalancers List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getNodeBalancersAsyncWithHttpInfo($page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20023';
        $request = $this->getNodeBalancersRequest($page, $page_size);

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
     * Create request for operation 'getNodeBalancers'
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getNodeBalancersRequest($page = 1, $page_size = 100)
    {
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling NodeBalancersApi.getNodeBalancers, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling NodeBalancersApi.getNodeBalancers, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling NodeBalancersApi.getNodeBalancers, must be bigger than or equal to 25.');
        }


        $resourcePath = '/nodebalancers';
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
     * Operation nodebalancersNodeBalancerIdStatsGet
     *
     * NodeBalancer Statistics View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerStats|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function nodebalancersNodeBalancerIdStatsGet($node_balancer_id)
    {
        list($response) = $this->nodebalancersNodeBalancerIdStatsGetWithHttpInfo($node_balancer_id);
        return $response;
    }

    /**
     * Operation nodebalancersNodeBalancerIdStatsGetWithHttpInfo
     *
     * NodeBalancer Statistics View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancerStats|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function nodebalancersNodeBalancerIdStatsGetWithHttpInfo($node_balancer_id)
    {
        $request = $this->nodebalancersNodeBalancerIdStatsGetRequest($node_balancer_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancerStats' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerStats', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerStats';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerStats',
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
     * Operation nodebalancersNodeBalancerIdStatsGetAsync
     *
     * NodeBalancer Statistics View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function nodebalancersNodeBalancerIdStatsGetAsync($node_balancer_id)
    {
        return $this->nodebalancersNodeBalancerIdStatsGetAsyncWithHttpInfo($node_balancer_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation nodebalancersNodeBalancerIdStatsGetAsyncWithHttpInfo
     *
     * NodeBalancer Statistics View
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function nodebalancersNodeBalancerIdStatsGetAsyncWithHttpInfo($node_balancer_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerStats';
        $request = $this->nodebalancersNodeBalancerIdStatsGetRequest($node_balancer_id);

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
     * Create request for operation 'nodebalancersNodeBalancerIdStatsGet'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function nodebalancersNodeBalancerIdStatsGetRequest($node_balancer_id)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling nodebalancersNodeBalancerIdStatsGet'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/stats';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation rebuildNodeBalancerConfig
     *
     * Config Rebuild
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer Config to rebuild. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function rebuildNodeBalancerConfig($node_balancer_id, $config_id, $unknown_base_type)
    {
        list($response) = $this->rebuildNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation rebuildNodeBalancerConfigWithHttpInfo
     *
     * Config Rebuild
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer Config to rebuild. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function rebuildNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type)
    {
        $request = $this->rebuildNodeBalancerConfigRequest($node_balancer_id, $config_id, $unknown_base_type);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancer' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer',
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
     * Operation rebuildNodeBalancerConfigAsync
     *
     * Config Rebuild
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer Config to rebuild. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rebuildNodeBalancerConfigAsync($node_balancer_id, $config_id, $unknown_base_type)
    {
        return $this->rebuildNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rebuildNodeBalancerConfigAsyncWithHttpInfo
     *
     * Config Rebuild
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer Config to rebuild. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rebuildNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id, $unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
        $request = $this->rebuildNodeBalancerConfigRequest($node_balancer_id, $config_id, $unknown_base_type);

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
     * Create request for operation 'rebuildNodeBalancerConfig'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the NodeBalancer Config to rebuild. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function rebuildNodeBalancerConfigRequest($node_balancer_id, $config_id, $unknown_base_type)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling rebuildNodeBalancerConfig'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling rebuildNodeBalancerConfig'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling rebuildNodeBalancerConfig'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}/rebuild';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
     * Operation updateNodeBalancer
     *
     * NodeBalancer Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancer $node_balancer The information to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateNodeBalancer($node_balancer_id, $node_balancer)
    {
        list($response) = $this->updateNodeBalancerWithHttpInfo($node_balancer_id, $node_balancer);
        return $response;
    }

    /**
     * Operation updateNodeBalancerWithHttpInfo
     *
     * NodeBalancer Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancer $node_balancer The information to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancer|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateNodeBalancerWithHttpInfo($node_balancer_id, $node_balancer)
    {
        $request = $this->updateNodeBalancerRequest($node_balancer_id, $node_balancer);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancer' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer',
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
     * Operation updateNodeBalancerAsync
     *
     * NodeBalancer Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancer $node_balancer The information to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateNodeBalancerAsync($node_balancer_id, $node_balancer)
    {
        return $this->updateNodeBalancerAsyncWithHttpInfo($node_balancer_id, $node_balancer)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateNodeBalancerAsyncWithHttpInfo
     *
     * NodeBalancer Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancer $node_balancer The information to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateNodeBalancerAsyncWithHttpInfo($node_balancer_id, $node_balancer)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancer';
        $request = $this->updateNodeBalancerRequest($node_balancer_id, $node_balancer);

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
     * Create request for operation 'updateNodeBalancer'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancer $node_balancer The information to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateNodeBalancerRequest($node_balancer_id, $node_balancer)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling updateNodeBalancer'
            );
        }
        // verify the required parameter 'node_balancer' is set
        if ($node_balancer === null || (is_array($node_balancer) && count($node_balancer) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer when calling updateNodeBalancer'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
        if (isset($node_balancer)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($node_balancer));
            } else {
                $httpBody = $node_balancer;
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
     * Operation updateNodeBalancerConfig
     *
     * Config Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config The fields to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateNodeBalancerConfig($node_balancer_id, $config_id, $node_balancer_config)
    {
        list($response) = $this->updateNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id, $node_balancer_config);
        return $response;
    }

    /**
     * Operation updateNodeBalancerConfigWithHttpInfo
     *
     * Config Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config The fields to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateNodeBalancerConfigWithHttpInfo($node_balancer_id, $config_id, $node_balancer_config)
    {
        $request = $this->updateNodeBalancerConfigRequest($node_balancer_id, $config_id, $node_balancer_config);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig',
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
     * Operation updateNodeBalancerConfigAsync
     *
     * Config Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config The fields to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateNodeBalancerConfigAsync($node_balancer_id, $config_id, $node_balancer_config)
    {
        return $this->updateNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id, $node_balancer_config)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateNodeBalancerConfigAsyncWithHttpInfo
     *
     * Config Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config The fields to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateNodeBalancerConfigAsyncWithHttpInfo($node_balancer_id, $config_id, $node_balancer_config)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig';
        $request = $this->updateNodeBalancerConfigRequest($node_balancer_id, $config_id, $node_balancer_config);

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
     * Create request for operation 'updateNodeBalancerConfig'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the config to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfig $node_balancer_config The fields to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateNodeBalancerConfigRequest($node_balancer_id, $config_id, $node_balancer_config)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling updateNodeBalancerConfig'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling updateNodeBalancerConfig'
            );
        }
        // verify the required parameter 'node_balancer_config' is set
        if ($node_balancer_config === null || (is_array($node_balancer_config) && count($node_balancer_config) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_config when calling updateNodeBalancerConfig'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
        if (isset($node_balancer_config)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($node_balancer_config));
            } else {
                $httpBody = $node_balancer_config;
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
     * Operation updateNodeBalancerNode
     *
     * Node Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode $node_balancer_node The fields to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateNodeBalancerNode($node_balancer_id, $config_id, $node_id, $node_balancer_node)
    {
        list($response) = $this->updateNodeBalancerNodeWithHttpInfo($node_balancer_id, $config_id, $node_id, $node_balancer_node);
        return $response;
    }

    /**
     * Operation updateNodeBalancerNodeWithHttpInfo
     *
     * Node Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode $node_balancer_node The fields to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateNodeBalancerNodeWithHttpInfo($node_balancer_id, $config_id, $node_id, $node_balancer_node)
    {
        $request = $this->updateNodeBalancerNodeRequest($node_balancer_id, $config_id, $node_id, $node_balancer_node);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode';
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
                        '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode',
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
     * Operation updateNodeBalancerNodeAsync
     *
     * Node Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode $node_balancer_node The fields to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateNodeBalancerNodeAsync($node_balancer_id, $config_id, $node_id, $node_balancer_node)
    {
        return $this->updateNodeBalancerNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $node_id, $node_balancer_node)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateNodeBalancerNodeAsyncWithHttpInfo
     *
     * Node Update
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode $node_balancer_node The fields to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateNodeBalancerNodeAsyncWithHttpInfo($node_balancer_id, $config_id, $node_id, $node_balancer_node)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode';
        $request = $this->updateNodeBalancerNodeRequest($node_balancer_id, $config_id, $node_id, $node_balancer_node);

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
     * Create request for operation 'updateNodeBalancerNode'
     *
     * @param  int $node_balancer_id The ID of the NodeBalancer to access. (required)
     * @param  int $config_id The ID of the Config to access (required)
     * @param  int $node_id The ID of the Node to access (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\NodeBalancerNode $node_balancer_node The fields to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateNodeBalancerNodeRequest($node_balancer_id, $config_id, $node_id, $node_balancer_node)
    {
        // verify the required parameter 'node_balancer_id' is set
        if ($node_balancer_id === null || (is_array($node_balancer_id) && count($node_balancer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_id when calling updateNodeBalancerNode'
            );
        }
        // verify the required parameter 'config_id' is set
        if ($config_id === null || (is_array($config_id) && count($config_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $config_id when calling updateNodeBalancerNode'
            );
        }
        // verify the required parameter 'node_id' is set
        if ($node_id === null || (is_array($node_id) && count($node_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_id when calling updateNodeBalancerNode'
            );
        }
        // verify the required parameter 'node_balancer_node' is set
        if ($node_balancer_node === null || (is_array($node_balancer_node) && count($node_balancer_node) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $node_balancer_node when calling updateNodeBalancerNode'
            );
        }

        $resourcePath = '/nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($node_balancer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeBalancerId' . '}',
                ObjectSerializer::toPathValue($node_balancer_id),
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
        // path params
        if ($node_id !== null) {
            $resourcePath = str_replace(
                '{' . 'nodeId' . '}',
                ObjectSerializer::toPathValue($node_id),
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
        if (isset($node_balancer_node)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($node_balancer_node));
            } else {
                $httpBody = $node_balancer_node;
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

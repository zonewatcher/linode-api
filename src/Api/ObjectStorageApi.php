<?php
/**
 * ObjectStorageApi
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
 * ObjectStorageApi Class Doc Comment
 *
 * @category Class
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObjectStorageApi
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
     * Operation cancelObjectStorage
     *
     * Object Storage Cancel
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function cancelObjectStorage()
    {
        list($response) = $this->cancelObjectStorageWithHttpInfo();
        return $response;
    }

    /**
     * Operation cancelObjectStorageWithHttpInfo
     *
     * Object Storage Cancel
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function cancelObjectStorageWithHttpInfo()
    {
        $request = $this->cancelObjectStorageRequest();

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
     * Operation cancelObjectStorageAsync
     *
     * Object Storage Cancel
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelObjectStorageAsync()
    {
        return $this->cancelObjectStorageAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelObjectStorageAsyncWithHttpInfo
     *
     * Object Storage Cancel
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelObjectStorageAsyncWithHttpInfo()
    {
        $returnType = 'object';
        $request = $this->cancelObjectStorageRequest();

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
     * Create request for operation 'cancelObjectStorage'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cancelObjectStorageRequest()
    {

        $resourcePath = '/object-storage/cancel';
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createObjectStorageBucket
     *
     * Object Storage Bucket Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject15 $inline_object15 inline_object15 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createObjectStorageBucket($inline_object15 = null)
    {
        list($response) = $this->createObjectStorageBucketWithHttpInfo($inline_object15);
        return $response;
    }

    /**
     * Operation createObjectStorageBucketWithHttpInfo
     *
     * Object Storage Bucket Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject15 $inline_object15 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createObjectStorageBucketWithHttpInfo($inline_object15 = null)
    {
        $request = $this->createObjectStorageBucketRequest($inline_object15);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket',
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
     * Operation createObjectStorageBucketAsync
     *
     * Object Storage Bucket Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject15 $inline_object15 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageBucketAsync($inline_object15 = null)
    {
        return $this->createObjectStorageBucketAsyncWithHttpInfo($inline_object15)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createObjectStorageBucketAsyncWithHttpInfo
     *
     * Object Storage Bucket Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject15 $inline_object15 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageBucketAsyncWithHttpInfo($inline_object15 = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket';
        $request = $this->createObjectStorageBucketRequest($inline_object15);

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
     * Create request for operation 'createObjectStorageBucket'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject15 $inline_object15 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createObjectStorageBucketRequest($inline_object15 = null)
    {

        $resourcePath = '/object-storage/buckets';
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
        if (isset($inline_object15)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object15));
            } else {
                $httpBody = $inline_object15;
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createObjectStorageKeys
     *
     * Object Storage Key Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey $object_storage_key The label of the key to create. This is used to identify the created key. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createObjectStorageKeys($object_storage_key = null)
    {
        list($response) = $this->createObjectStorageKeysWithHttpInfo($object_storage_key);
        return $response;
    }

    /**
     * Operation createObjectStorageKeysWithHttpInfo
     *
     * Object Storage Key Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey $object_storage_key The label of the key to create. This is used to identify the created key. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createObjectStorageKeysWithHttpInfo($object_storage_key = null)
    {
        $request = $this->createObjectStorageKeysRequest($object_storage_key);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey',
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
     * Operation createObjectStorageKeysAsync
     *
     * Object Storage Key Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey $object_storage_key The label of the key to create. This is used to identify the created key. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageKeysAsync($object_storage_key = null)
    {
        return $this->createObjectStorageKeysAsyncWithHttpInfo($object_storage_key)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createObjectStorageKeysAsyncWithHttpInfo
     *
     * Object Storage Key Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey $object_storage_key The label of the key to create. This is used to identify the created key. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageKeysAsyncWithHttpInfo($object_storage_key = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey';
        $request = $this->createObjectStorageKeysRequest($object_storage_key);

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
     * Create request for operation 'createObjectStorageKeys'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey $object_storage_key The label of the key to create. This is used to identify the created key. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createObjectStorageKeysRequest($object_storage_key = null)
    {

        $resourcePath = '/object-storage/keys';
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
        if (isset($object_storage_key)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($object_storage_key));
            } else {
                $httpBody = $object_storage_key;
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createObjectStorageObjectURL
     *
     * Object Storage Object URL Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the request to sign. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createObjectStorageObjectURL($cluster_id, $bucket, $unknown_base_type = null)
    {
        list($response) = $this->createObjectStorageObjectURLWithHttpInfo($cluster_id, $bucket, $unknown_base_type);
        return $response;
    }

    /**
     * Operation createObjectStorageObjectURLWithHttpInfo
     *
     * Object Storage Object URL Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the request to sign. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createObjectStorageObjectURLWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $request = $this->createObjectStorageObjectURLRequest($cluster_id, $bucket, $unknown_base_type);

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
     * Operation createObjectStorageObjectURLAsync
     *
     * Object Storage Object URL Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the request to sign. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageObjectURLAsync($cluster_id, $bucket, $unknown_base_type = null)
    {
        return $this->createObjectStorageObjectURLAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createObjectStorageObjectURLAsyncWithHttpInfo
     *
     * Object Storage Object URL Create
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the request to sign. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageObjectURLAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $returnType = 'object';
        $request = $this->createObjectStorageObjectURLRequest($cluster_id, $bucket, $unknown_base_type);

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
     * Create request for operation 'createObjectStorageObjectURL'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the request to sign. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createObjectStorageObjectURLRequest($cluster_id, $bucket, $unknown_base_type = null)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling createObjectStorageObjectURL'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling createObjectStorageObjectURL'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/object-url';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createObjectStorageSSL
     *
     * Object Storage TLS/SSL Cert Upload
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSL $object_storage_ssl Upload this TLS/SSL certificate with its corresponding secret key. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createObjectStorageSSL($cluster_id, $bucket, $object_storage_ssl = null)
    {
        list($response) = $this->createObjectStorageSSLWithHttpInfo($cluster_id, $bucket, $object_storage_ssl);
        return $response;
    }

    /**
     * Operation createObjectStorageSSLWithHttpInfo
     *
     * Object Storage TLS/SSL Cert Upload
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSL $object_storage_ssl Upload this TLS/SSL certificate with its corresponding secret key. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createObjectStorageSSLWithHttpInfo($cluster_id, $bucket, $object_storage_ssl = null)
    {
        $request = $this->createObjectStorageSSLRequest($cluster_id, $bucket, $object_storage_ssl);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse',
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
     * Operation createObjectStorageSSLAsync
     *
     * Object Storage TLS/SSL Cert Upload
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSL $object_storage_ssl Upload this TLS/SSL certificate with its corresponding secret key. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageSSLAsync($cluster_id, $bucket, $object_storage_ssl = null)
    {
        return $this->createObjectStorageSSLAsyncWithHttpInfo($cluster_id, $bucket, $object_storage_ssl)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createObjectStorageSSLAsyncWithHttpInfo
     *
     * Object Storage TLS/SSL Cert Upload
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSL $object_storage_ssl Upload this TLS/SSL certificate with its corresponding secret key. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageSSLAsyncWithHttpInfo($cluster_id, $bucket, $object_storage_ssl = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse';
        $request = $this->createObjectStorageSSLRequest($cluster_id, $bucket, $object_storage_ssl);

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
     * Create request for operation 'createObjectStorageSSL'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSL $object_storage_ssl Upload this TLS/SSL certificate with its corresponding secret key. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createObjectStorageSSLRequest($cluster_id, $bucket, $object_storage_ssl = null)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling createObjectStorageSSL'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling createObjectStorageSSL'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/ssl';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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
        if (isset($object_storage_ssl)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($object_storage_ssl));
            } else {
                $httpBody = $object_storage_ssl;
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteObjectStorageBucket
     *
     * Object Storage Bucket Remove
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteObjectStorageBucket($cluster_id, $bucket)
    {
        list($response) = $this->deleteObjectStorageBucketWithHttpInfo($cluster_id, $bucket);
        return $response;
    }

    /**
     * Operation deleteObjectStorageBucketWithHttpInfo
     *
     * Object Storage Bucket Remove
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteObjectStorageBucketWithHttpInfo($cluster_id, $bucket)
    {
        $request = $this->deleteObjectStorageBucketRequest($cluster_id, $bucket);

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
     * Operation deleteObjectStorageBucketAsync
     *
     * Object Storage Bucket Remove
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteObjectStorageBucketAsync($cluster_id, $bucket)
    {
        return $this->deleteObjectStorageBucketAsyncWithHttpInfo($cluster_id, $bucket)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteObjectStorageBucketAsyncWithHttpInfo
     *
     * Object Storage Bucket Remove
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteObjectStorageBucketAsyncWithHttpInfo($cluster_id, $bucket)
    {
        $returnType = 'object';
        $request = $this->deleteObjectStorageBucketRequest($cluster_id, $bucket);

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
     * Create request for operation 'deleteObjectStorageBucket'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteObjectStorageBucketRequest($cluster_id, $bucket)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling deleteObjectStorageBucket'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling deleteObjectStorageBucket'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteObjectStorageKey
     *
     * Object Storage Key Revoke
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteObjectStorageKey($key_id)
    {
        list($response) = $this->deleteObjectStorageKeyWithHttpInfo($key_id);
        return $response;
    }

    /**
     * Operation deleteObjectStorageKeyWithHttpInfo
     *
     * Object Storage Key Revoke
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteObjectStorageKeyWithHttpInfo($key_id)
    {
        $request = $this->deleteObjectStorageKeyRequest($key_id);

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
     * Operation deleteObjectStorageKeyAsync
     *
     * Object Storage Key Revoke
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteObjectStorageKeyAsync($key_id)
    {
        return $this->deleteObjectStorageKeyAsyncWithHttpInfo($key_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteObjectStorageKeyAsyncWithHttpInfo
     *
     * Object Storage Key Revoke
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteObjectStorageKeyAsyncWithHttpInfo($key_id)
    {
        $returnType = 'object';
        $request = $this->deleteObjectStorageKeyRequest($key_id);

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
     * Create request for operation 'deleteObjectStorageKey'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteObjectStorageKeyRequest($key_id)
    {
        // verify the required parameter 'key_id' is set
        if ($key_id === null || (is_array($key_id) && count($key_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $key_id when calling deleteObjectStorageKey'
            );
        }

        $resourcePath = '/object-storage/keys/{keyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($key_id !== null) {
            $resourcePath = str_replace(
                '{' . 'keyId' . '}',
                ObjectSerializer::toPathValue($key_id),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteObjectStorageSSL
     *
     * Object Storage TLS/SSL Cert Delete
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteObjectStorageSSL($cluster_id, $bucket)
    {
        list($response) = $this->deleteObjectStorageSSLWithHttpInfo($cluster_id, $bucket);
        return $response;
    }

    /**
     * Operation deleteObjectStorageSSLWithHttpInfo
     *
     * Object Storage TLS/SSL Cert Delete
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteObjectStorageSSLWithHttpInfo($cluster_id, $bucket)
    {
        $request = $this->deleteObjectStorageSSLRequest($cluster_id, $bucket);

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
     * Operation deleteObjectStorageSSLAsync
     *
     * Object Storage TLS/SSL Cert Delete
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteObjectStorageSSLAsync($cluster_id, $bucket)
    {
        return $this->deleteObjectStorageSSLAsyncWithHttpInfo($cluster_id, $bucket)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteObjectStorageSSLAsyncWithHttpInfo
     *
     * Object Storage TLS/SSL Cert Delete
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteObjectStorageSSLAsyncWithHttpInfo($cluster_id, $bucket)
    {
        $returnType = 'object';
        $request = $this->deleteObjectStorageSSLRequest($cluster_id, $bucket);

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
     * Create request for operation 'deleteObjectStorageSSL'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteObjectStorageSSLRequest($cluster_id, $bucket)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling deleteObjectStorageSSL'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling deleteObjectStorageSSL'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/ssl';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageBucket
     *
     * Object Storage Bucket View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageBucket($cluster_id, $bucket)
    {
        list($response) = $this->getObjectStorageBucketWithHttpInfo($cluster_id, $bucket);
        return $response;
    }

    /**
     * Operation getObjectStorageBucketWithHttpInfo
     *
     * Object Storage Bucket View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageBucketWithHttpInfo($cluster_id, $bucket)
    {
        $request = $this->getObjectStorageBucketRequest($cluster_id, $bucket);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket',
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
     * Operation getObjectStorageBucketAsync
     *
     * Object Storage Bucket View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketAsync($cluster_id, $bucket)
    {
        return $this->getObjectStorageBucketAsyncWithHttpInfo($cluster_id, $bucket)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageBucketAsyncWithHttpInfo
     *
     * Object Storage Bucket View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketAsyncWithHttpInfo($cluster_id, $bucket)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageBucket';
        $request = $this->getObjectStorageBucketRequest($cluster_id, $bucket);

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
     * Create request for operation 'getObjectStorageBucket'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageBucketRequest($cluster_id, $bucket)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling getObjectStorageBucket'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling getObjectStorageBucket'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageBucketContent
     *
     * Object Storage Bucket Contents List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $marker The \&quot;marker\&quot; for this request, which can be used to paginate through large buckets. Its value should be the value of the &#x60;next_marker&#x60; property returned with the last page. Listing bucket contents *does not* support arbitrary page access. See the &#x60;next_marker&#x60; property in the responses section for more details. (optional)
     * @param  string $delimiter The delimiter for object names; if given, object names will be returned up to the first occurrence of this character. This is most commonly used with the &#x60;/&#x60; character to allow bucket transversal in a manner similar to a filesystem, however any delimiter may be used. Use in conjunction with &#x60;prefix&#x60; to see object names past the first occurrence of the delimiter. (optional)
     * @param  string $prefix Filters objects returned to only those whose name start with the given prefix. Commonly used in conjunction with &#x60;delimiter&#x60; to allow transversal of bucket contents in a manner similar to a filesystem. (optional)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageBucketContent($cluster_id, $bucket, $marker = null, $delimiter = null, $prefix = null, $page_size = 100)
    {
        list($response) = $this->getObjectStorageBucketContentWithHttpInfo($cluster_id, $bucket, $marker, $delimiter, $prefix, $page_size);
        return $response;
    }

    /**
     * Operation getObjectStorageBucketContentWithHttpInfo
     *
     * Object Storage Bucket Contents List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $marker The \&quot;marker\&quot; for this request, which can be used to paginate through large buckets. Its value should be the value of the &#x60;next_marker&#x60; property returned with the last page. Listing bucket contents *does not* support arbitrary page access. See the &#x60;next_marker&#x60; property in the responses section for more details. (optional)
     * @param  string $delimiter The delimiter for object names; if given, object names will be returned up to the first occurrence of this character. This is most commonly used with the &#x60;/&#x60; character to allow bucket transversal in a manner similar to a filesystem, however any delimiter may be used. Use in conjunction with &#x60;prefix&#x60; to see object names past the first occurrence of the delimiter. (optional)
     * @param  string $prefix Filters objects returned to only those whose name start with the given prefix. Commonly used in conjunction with &#x60;delimiter&#x60; to allow transversal of bucket contents in a manner similar to a filesystem. (optional)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageBucketContentWithHttpInfo($cluster_id, $bucket, $marker = null, $delimiter = null, $prefix = null, $page_size = 100)
    {
        $request = $this->getObjectStorageBucketContentRequest($cluster_id, $bucket, $marker, $delimiter, $prefix, $page_size);

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
     * Operation getObjectStorageBucketContentAsync
     *
     * Object Storage Bucket Contents List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $marker The \&quot;marker\&quot; for this request, which can be used to paginate through large buckets. Its value should be the value of the &#x60;next_marker&#x60; property returned with the last page. Listing bucket contents *does not* support arbitrary page access. See the &#x60;next_marker&#x60; property in the responses section for more details. (optional)
     * @param  string $delimiter The delimiter for object names; if given, object names will be returned up to the first occurrence of this character. This is most commonly used with the &#x60;/&#x60; character to allow bucket transversal in a manner similar to a filesystem, however any delimiter may be used. Use in conjunction with &#x60;prefix&#x60; to see object names past the first occurrence of the delimiter. (optional)
     * @param  string $prefix Filters objects returned to only those whose name start with the given prefix. Commonly used in conjunction with &#x60;delimiter&#x60; to allow transversal of bucket contents in a manner similar to a filesystem. (optional)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketContentAsync($cluster_id, $bucket, $marker = null, $delimiter = null, $prefix = null, $page_size = 100)
    {
        return $this->getObjectStorageBucketContentAsyncWithHttpInfo($cluster_id, $bucket, $marker, $delimiter, $prefix, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageBucketContentAsyncWithHttpInfo
     *
     * Object Storage Bucket Contents List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $marker The \&quot;marker\&quot; for this request, which can be used to paginate through large buckets. Its value should be the value of the &#x60;next_marker&#x60; property returned with the last page. Listing bucket contents *does not* support arbitrary page access. See the &#x60;next_marker&#x60; property in the responses section for more details. (optional)
     * @param  string $delimiter The delimiter for object names; if given, object names will be returned up to the first occurrence of this character. This is most commonly used with the &#x60;/&#x60; character to allow bucket transversal in a manner similar to a filesystem, however any delimiter may be used. Use in conjunction with &#x60;prefix&#x60; to see object names past the first occurrence of the delimiter. (optional)
     * @param  string $prefix Filters objects returned to only those whose name start with the given prefix. Commonly used in conjunction with &#x60;delimiter&#x60; to allow transversal of bucket contents in a manner similar to a filesystem. (optional)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketContentAsyncWithHttpInfo($cluster_id, $bucket, $marker = null, $delimiter = null, $prefix = null, $page_size = 100)
    {
        $returnType = 'object';
        $request = $this->getObjectStorageBucketContentRequest($cluster_id, $bucket, $marker, $delimiter, $prefix, $page_size);

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
     * Create request for operation 'getObjectStorageBucketContent'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $marker The \&quot;marker\&quot; for this request, which can be used to paginate through large buckets. Its value should be the value of the &#x60;next_marker&#x60; property returned with the last page. Listing bucket contents *does not* support arbitrary page access. See the &#x60;next_marker&#x60; property in the responses section for more details. (optional)
     * @param  string $delimiter The delimiter for object names; if given, object names will be returned up to the first occurrence of this character. This is most commonly used with the &#x60;/&#x60; character to allow bucket transversal in a manner similar to a filesystem, however any delimiter may be used. Use in conjunction with &#x60;prefix&#x60; to see object names past the first occurrence of the delimiter. (optional)
     * @param  string $prefix Filters objects returned to only those whose name start with the given prefix. Commonly used in conjunction with &#x60;delimiter&#x60; to allow transversal of bucket contents in a manner similar to a filesystem. (optional)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageBucketContentRequest($cluster_id, $bucket, $marker = null, $delimiter = null, $prefix = null, $page_size = 100)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling getObjectStorageBucketContent'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling getObjectStorageBucketContent'
            );
        }
        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling ObjectStorageApi.getObjectStorageBucketContent, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling ObjectStorageApi.getObjectStorageBucketContent, must be bigger than or equal to 25.');
        }


        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/object-list';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($marker !== null) {
            if('form' === 'form' && is_array($marker)) {
                foreach($marker as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['marker'] = $marker;
            }
        }
        // query params
        if ($delimiter !== null) {
            if('form' === 'form' && is_array($delimiter)) {
                foreach($delimiter as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['delimiter'] = $delimiter;
            }
        }
        // query params
        if ($prefix !== null) {
            if('form' === 'form' && is_array($prefix)) {
                foreach($prefix as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['prefix'] = $prefix;
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
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageBucketinCluster
     *
     * Object Storage Buckets in Cluster List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20049|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageBucketinCluster($cluster_id)
    {
        list($response) = $this->getObjectStorageBucketinClusterWithHttpInfo($cluster_id);
        return $response;
    }

    /**
     * Operation getObjectStorageBucketinClusterWithHttpInfo
     *
     * Object Storage Buckets in Cluster List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20049|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageBucketinClusterWithHttpInfo($cluster_id)
    {
        $request = $this->getObjectStorageBucketinClusterRequest($cluster_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049',
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
     * Operation getObjectStorageBucketinClusterAsync
     *
     * Object Storage Buckets in Cluster List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketinClusterAsync($cluster_id)
    {
        return $this->getObjectStorageBucketinClusterAsyncWithHttpInfo($cluster_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageBucketinClusterAsyncWithHttpInfo
     *
     * Object Storage Buckets in Cluster List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketinClusterAsyncWithHttpInfo($cluster_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049';
        $request = $this->getObjectStorageBucketinClusterRequest($cluster_id);

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
     * Create request for operation 'getObjectStorageBucketinCluster'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageBucketinClusterRequest($cluster_id)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling getObjectStorageBucketinCluster'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageBuckets
     *
     * Object Storage Buckets List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20049|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageBuckets()
    {
        list($response) = $this->getObjectStorageBucketsWithHttpInfo();
        return $response;
    }

    /**
     * Operation getObjectStorageBucketsWithHttpInfo
     *
     * Object Storage Buckets List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20049|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageBucketsWithHttpInfo()
    {
        $request = $this->getObjectStorageBucketsRequest();

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049',
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
     * Operation getObjectStorageBucketsAsync
     *
     * Object Storage Buckets List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketsAsync()
    {
        return $this->getObjectStorageBucketsAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageBucketsAsyncWithHttpInfo
     *
     * Object Storage Buckets List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageBucketsAsyncWithHttpInfo()
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20049';
        $request = $this->getObjectStorageBucketsRequest();

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
     * Create request for operation 'getObjectStorageBuckets'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageBucketsRequest()
    {

        $resourcePath = '/object-storage/buckets';
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageCluster
     *
     * Cluster View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the Cluster. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageCluster|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageCluster($cluster_id)
    {
        list($response) = $this->getObjectStorageClusterWithHttpInfo($cluster_id);
        return $response;
    }

    /**
     * Operation getObjectStorageClusterWithHttpInfo
     *
     * Cluster View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the Cluster. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageCluster|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageClusterWithHttpInfo($cluster_id)
    {
        $request = $this->getObjectStorageClusterRequest($cluster_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageCluster' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageCluster', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageCluster';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageCluster',
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
     * Operation getObjectStorageClusterAsync
     *
     * Cluster View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the Cluster. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageClusterAsync($cluster_id)
    {
        return $this->getObjectStorageClusterAsyncWithHttpInfo($cluster_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageClusterAsyncWithHttpInfo
     *
     * Cluster View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the Cluster. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageClusterAsyncWithHttpInfo($cluster_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageCluster';
        $request = $this->getObjectStorageClusterRequest($cluster_id);

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
     * Create request for operation 'getObjectStorageCluster'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the Cluster. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageClusterRequest($cluster_id)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling getObjectStorageCluster'
            );
        }

        $resourcePath = '/object-storage/clusters/{clusterId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageClusters
     *
     * Clusters List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20051|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageClusters()
    {
        list($response) = $this->getObjectStorageClustersWithHttpInfo();
        return $response;
    }

    /**
     * Operation getObjectStorageClustersWithHttpInfo
     *
     * Clusters List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20051|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageClustersWithHttpInfo()
    {
        $request = $this->getObjectStorageClustersRequest();

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20051' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20051', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20051';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20051',
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
     * Operation getObjectStorageClustersAsync
     *
     * Clusters List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageClustersAsync()
    {
        return $this->getObjectStorageClustersAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageClustersAsyncWithHttpInfo
     *
     * Clusters List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageClustersAsyncWithHttpInfo()
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20051';
        $request = $this->getObjectStorageClustersRequest();

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
     * Create request for operation 'getObjectStorageClusters'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageClustersRequest()
    {

        $resourcePath = '/object-storage/clusters';
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageKey
     *
     * Object Storage Key View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageKey($key_id)
    {
        list($response) = $this->getObjectStorageKeyWithHttpInfo($key_id);
        return $response;
    }

    /**
     * Operation getObjectStorageKeyWithHttpInfo
     *
     * Object Storage Key View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageKeyWithHttpInfo($key_id)
    {
        $request = $this->getObjectStorageKeyRequest($key_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey',
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
     * Operation getObjectStorageKeyAsync
     *
     * Object Storage Key View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageKeyAsync($key_id)
    {
        return $this->getObjectStorageKeyAsyncWithHttpInfo($key_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageKeyAsyncWithHttpInfo
     *
     * Object Storage Key View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageKeyAsyncWithHttpInfo($key_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey';
        $request = $this->getObjectStorageKeyRequest($key_id);

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
     * Create request for operation 'getObjectStorageKey'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageKeyRequest($key_id)
    {
        // verify the required parameter 'key_id' is set
        if ($key_id === null || (is_array($key_id) && count($key_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $key_id when calling getObjectStorageKey'
            );
        }

        $resourcePath = '/object-storage/keys/{keyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($key_id !== null) {
            $resourcePath = str_replace(
                '{' . 'keyId' . '}',
                ObjectSerializer::toPathValue($key_id),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageKeys
     *
     * Object Storage Keys List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20052|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageKeys()
    {
        list($response) = $this->getObjectStorageKeysWithHttpInfo();
        return $response;
    }

    /**
     * Operation getObjectStorageKeysWithHttpInfo
     *
     * Object Storage Keys List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20052|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageKeysWithHttpInfo()
    {
        $request = $this->getObjectStorageKeysRequest();

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20052' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20052', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20052';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20052',
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
     * Operation getObjectStorageKeysAsync
     *
     * Object Storage Keys List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageKeysAsync()
    {
        return $this->getObjectStorageKeysAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageKeysAsyncWithHttpInfo
     *
     * Object Storage Keys List
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageKeysAsyncWithHttpInfo()
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20052';
        $request = $this->getObjectStorageKeysRequest();

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
     * Create request for operation 'getObjectStorageKeys'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageKeysRequest()
    {

        $resourcePath = '/object-storage/keys';
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageSSL
     *
     * Object Storage TLS/SSL Cert View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageSSL($cluster_id, $bucket)
    {
        list($response) = $this->getObjectStorageSSLWithHttpInfo($cluster_id, $bucket);
        return $response;
    }

    /**
     * Operation getObjectStorageSSLWithHttpInfo
     *
     * Object Storage TLS/SSL Cert View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageSSLWithHttpInfo($cluster_id, $bucket)
    {
        $request = $this->getObjectStorageSSLRequest($cluster_id, $bucket);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse',
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
     * Operation getObjectStorageSSLAsync
     *
     * Object Storage TLS/SSL Cert View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageSSLAsync($cluster_id, $bucket)
    {
        return $this->getObjectStorageSSLAsyncWithHttpInfo($cluster_id, $bucket)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageSSLAsyncWithHttpInfo
     *
     * Object Storage TLS/SSL Cert View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageSSLAsyncWithHttpInfo($cluster_id, $bucket)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageSSLResponse';
        $request = $this->getObjectStorageSSLRequest($cluster_id, $bucket);

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
     * Create request for operation 'getObjectStorageSSL'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageSSLRequest($cluster_id, $bucket)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling getObjectStorageSSL'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling getObjectStorageSSL'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/ssl';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getObjectStorageTransfer
     *
     * Object Storage Transfer View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getObjectStorageTransfer()
    {
        list($response) = $this->getObjectStorageTransferWithHttpInfo();
        return $response;
    }

    /**
     * Operation getObjectStorageTransferWithHttpInfo
     *
     * Object Storage Transfer View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getObjectStorageTransferWithHttpInfo()
    {
        $request = $this->getObjectStorageTransferRequest();

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
     * Operation getObjectStorageTransferAsync
     *
     * Object Storage Transfer View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageTransferAsync()
    {
        return $this->getObjectStorageTransferAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getObjectStorageTransferAsyncWithHttpInfo
     *
     * Object Storage Transfer View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getObjectStorageTransferAsyncWithHttpInfo()
    {
        $returnType = 'object';
        $request = $this->getObjectStorageTransferRequest();

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
     * Create request for operation 'getObjectStorageTransfer'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getObjectStorageTransferRequest()
    {

        $resourcePath = '/object-storage/transfer';
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation modifyObjectStorageBucketAccess
     *
     * Object Storage Bucket Access Modify
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function modifyObjectStorageBucketAccess($cluster_id, $bucket, $unknown_base_type = null)
    {
        list($response) = $this->modifyObjectStorageBucketAccessWithHttpInfo($cluster_id, $bucket, $unknown_base_type);
        return $response;
    }

    /**
     * Operation modifyObjectStorageBucketAccessWithHttpInfo
     *
     * Object Storage Bucket Access Modify
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function modifyObjectStorageBucketAccessWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $request = $this->modifyObjectStorageBucketAccessRequest($cluster_id, $bucket, $unknown_base_type);

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
     * Operation modifyObjectStorageBucketAccessAsync
     *
     * Object Storage Bucket Access Modify
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyObjectStorageBucketAccessAsync($cluster_id, $bucket, $unknown_base_type = null)
    {
        return $this->modifyObjectStorageBucketAccessAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyObjectStorageBucketAccessAsyncWithHttpInfo
     *
     * Object Storage Bucket Access Modify
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyObjectStorageBucketAccessAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $returnType = 'object';
        $request = $this->modifyObjectStorageBucketAccessRequest($cluster_id, $bucket, $unknown_base_type);

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
     * Create request for operation 'modifyObjectStorageBucketAccess'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyObjectStorageBucketAccessRequest($cluster_id, $bucket, $unknown_base_type = null)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling modifyObjectStorageBucketAccess'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling modifyObjectStorageBucketAccess'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/access';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateObjectStorageBucketACL
     *
     * Object Storage Object ACL Config Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to this Object&#39;s access controls. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20050|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateObjectStorageBucketACL($cluster_id, $bucket, $unknown_base_type = null)
    {
        list($response) = $this->updateObjectStorageBucketACLWithHttpInfo($cluster_id, $bucket, $unknown_base_type);
        return $response;
    }

    /**
     * Operation updateObjectStorageBucketACLWithHttpInfo
     *
     * Object Storage Object ACL Config Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to this Object&#39;s access controls. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20050|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateObjectStorageBucketACLWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $request = $this->updateObjectStorageBucketACLRequest($cluster_id, $bucket, $unknown_base_type);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050',
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
     * Operation updateObjectStorageBucketACLAsync
     *
     * Object Storage Object ACL Config Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to this Object&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageBucketACLAsync($cluster_id, $bucket, $unknown_base_type = null)
    {
        return $this->updateObjectStorageBucketACLAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateObjectStorageBucketACLAsyncWithHttpInfo
     *
     * Object Storage Object ACL Config Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to this Object&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageBucketACLAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050';
        $request = $this->updateObjectStorageBucketACLRequest($cluster_id, $bucket, $unknown_base_type);

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
     * Create request for operation 'updateObjectStorageBucketACL'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to this Object&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateObjectStorageBucketACLRequest($cluster_id, $bucket, $unknown_base_type = null)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling updateObjectStorageBucketACL'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling updateObjectStorageBucketACL'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/object-acl';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateObjectStorageBucketAccess
     *
     * Object Storage Bucket Access Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateObjectStorageBucketAccess($cluster_id, $bucket, $unknown_base_type = null)
    {
        list($response) = $this->updateObjectStorageBucketAccessWithHttpInfo($cluster_id, $bucket, $unknown_base_type);
        return $response;
    }

    /**
     * Operation updateObjectStorageBucketAccessWithHttpInfo
     *
     * Object Storage Bucket Access Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateObjectStorageBucketAccessWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $request = $this->updateObjectStorageBucketAccessRequest($cluster_id, $bucket, $unknown_base_type);

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
     * Operation updateObjectStorageBucketAccessAsync
     *
     * Object Storage Bucket Access Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageBucketAccessAsync($cluster_id, $bucket, $unknown_base_type = null)
    {
        return $this->updateObjectStorageBucketAccessAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateObjectStorageBucketAccessAsyncWithHttpInfo
     *
     * Object Storage Bucket Access Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageBucketAccessAsyncWithHttpInfo($cluster_id, $bucket, $unknown_base_type = null)
    {
        $returnType = 'object';
        $request = $this->updateObjectStorageBucketAccessRequest($cluster_id, $bucket, $unknown_base_type);

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
     * Create request for operation 'updateObjectStorageBucketAccess'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type The changes to make to the bucket&#39;s access controls. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateObjectStorageBucketAccessRequest($cluster_id, $bucket, $unknown_base_type = null)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling updateObjectStorageBucketAccess'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling updateObjectStorageBucketAccess'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/access';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateObjectStorageKey
     *
     * Object Storage Key Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject16 $inline_object16 inline_object16 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateObjectStorageKey($key_id, $inline_object16 = null)
    {
        list($response) = $this->updateObjectStorageKeyWithHttpInfo($key_id, $inline_object16);
        return $response;
    }

    /**
     * Operation updateObjectStorageKeyWithHttpInfo
     *
     * Object Storage Key Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject16 $inline_object16 (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateObjectStorageKeyWithHttpInfo($key_id, $inline_object16 = null)
    {
        $request = $this->updateObjectStorageKeyRequest($key_id, $inline_object16);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey';
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
                        '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey',
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
     * Operation updateObjectStorageKeyAsync
     *
     * Object Storage Key Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject16 $inline_object16 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageKeyAsync($key_id, $inline_object16 = null)
    {
        return $this->updateObjectStorageKeyAsyncWithHttpInfo($key_id, $inline_object16)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateObjectStorageKeyAsyncWithHttpInfo
     *
     * Object Storage Key Update
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject16 $inline_object16 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageKeyAsyncWithHttpInfo($key_id, $inline_object16 = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\ObjectStorageKey';
        $request = $this->updateObjectStorageKeyRequest($key_id, $inline_object16);

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
     * Create request for operation 'updateObjectStorageKey'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  int $key_id The key to look up. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject16 $inline_object16 (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateObjectStorageKeyRequest($key_id, $inline_object16 = null)
    {
        // verify the required parameter 'key_id' is set
        if ($key_id === null || (is_array($key_id) && count($key_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $key_id when calling updateObjectStorageKey'
            );
        }

        $resourcePath = '/object-storage/keys/{keyId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($key_id !== null) {
            $resourcePath = str_replace(
                '{' . 'keyId' . '}',
                ObjectSerializer::toPathValue($key_id),
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
        if (isset($inline_object16)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object16));
            } else {
                $httpBody = $inline_object16;
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation viewObjectStorageBucketACL
     *
     * Object Storage Object ACL Config View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $name The &#x60;name&#x60; of the object for which to retrieve its Access Control List (ACL). Use the [Object Storage Bucket Contents List](/docs/api/object-storage/#object-storage-bucket-contents-list) endpoint to access all object names in a bucket. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20050|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function viewObjectStorageBucketACL($cluster_id, $bucket, $name)
    {
        list($response) = $this->viewObjectStorageBucketACLWithHttpInfo($cluster_id, $bucket, $name);
        return $response;
    }

    /**
     * Operation viewObjectStorageBucketACLWithHttpInfo
     *
     * Object Storage Object ACL Config View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $name The &#x60;name&#x60; of the object for which to retrieve its Access Control List (ACL). Use the [Object Storage Bucket Contents List](/docs/api/object-storage/#object-storage-bucket-contents-list) endpoint to access all object names in a bucket. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20050|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function viewObjectStorageBucketACLWithHttpInfo($cluster_id, $bucket, $name)
    {
        $request = $this->viewObjectStorageBucketACLRequest($cluster_id, $bucket, $name);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050',
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
     * Operation viewObjectStorageBucketACLAsync
     *
     * Object Storage Object ACL Config View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $name The &#x60;name&#x60; of the object for which to retrieve its Access Control List (ACL). Use the [Object Storage Bucket Contents List](/docs/api/object-storage/#object-storage-bucket-contents-list) endpoint to access all object names in a bucket. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function viewObjectStorageBucketACLAsync($cluster_id, $bucket, $name)
    {
        return $this->viewObjectStorageBucketACLAsyncWithHttpInfo($cluster_id, $bucket, $name)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation viewObjectStorageBucketACLAsyncWithHttpInfo
     *
     * Object Storage Object ACL Config View
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $name The &#x60;name&#x60; of the object for which to retrieve its Access Control List (ACL). Use the [Object Storage Bucket Contents List](/docs/api/object-storage/#object-storage-bucket-contents-list) endpoint to access all object names in a bucket. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function viewObjectStorageBucketACLAsyncWithHttpInfo($cluster_id, $bucket, $name)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20050';
        $request = $this->viewObjectStorageBucketACLRequest($cluster_id, $bucket, $name);

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
     * Create request for operation 'viewObjectStorageBucketACL'
     *
     * This operation contains host(s) defined in the OpenAP spec. Use 'hostIndex' to select the host.
     * URL: https://api.linode.com/v4
     *
     * @param  string $cluster_id The ID of the cluster this bucket exists in. (required)
     * @param  string $bucket The bucket name. (required)
     * @param  string $name The &#x60;name&#x60; of the object for which to retrieve its Access Control List (ACL). Use the [Object Storage Bucket Contents List](/docs/api/object-storage/#object-storage-bucket-contents-list) endpoint to access all object names in a bucket. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function viewObjectStorageBucketACLRequest($cluster_id, $bucket, $name)
    {
        // verify the required parameter 'cluster_id' is set
        if ($cluster_id === null || (is_array($cluster_id) && count($cluster_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cluster_id when calling viewObjectStorageBucketACL'
            );
        }
        // verify the required parameter 'bucket' is set
        if ($bucket === null || (is_array($bucket) && count($bucket) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bucket when calling viewObjectStorageBucketACL'
            );
        }
        // verify the required parameter 'name' is set
        if ($name === null || (is_array($name) && count($name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $name when calling viewObjectStorageBucketACL'
            );
        }

        $resourcePath = '/object-storage/buckets/{clusterId}/{bucket}/object-acl';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($name !== null) {
            if('form' === 'form' && is_array($name)) {
                foreach($name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['name'] = $name;
            }
        }


        // path params
        if ($cluster_id !== null) {
            $resourcePath = str_replace(
                '{' . 'clusterId' . '}',
                ObjectSerializer::toPathValue($cluster_id),
                $resourcePath
            );
        }
        // path params
        if ($bucket !== null) {
            $resourcePath = str_replace(
                '{' . 'bucket' . '}',
                ObjectSerializer::toPathValue($bucket),
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

        $operationHosts = ["https://api.linode.com/v4"];
        if ($this->hostIndex < 0 || $this->hostIndex >= sizeof($operationHosts)) {
            throw new \InvalidArgumentException("Invalid index {$this->hostIndex} when selecting the host. Must be less than ".sizeof($operationHosts));
        }
        $operationHost = $operationHosts[$this->hostIndex];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
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

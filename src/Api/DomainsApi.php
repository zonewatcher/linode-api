<?php
/**
 * DomainsApi
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
 * DomainsApi Class Doc Comment
 *
 * @category Class
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DomainsApi
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
     * Operation cloneDomain
     *
     * Domain Clone
     *
     * @param  string $domain_id ID of the Domain to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject4 $inline_object4 inline_object4 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function cloneDomain($domain_id, $inline_object4)
    {
        list($response) = $this->cloneDomainWithHttpInfo($domain_id, $inline_object4);
        return $response;
    }

    /**
     * Operation cloneDomainWithHttpInfo
     *
     * Domain Clone
     *
     * @param  string $domain_id ID of the Domain to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject4 $inline_object4 (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function cloneDomainWithHttpInfo($domain_id, $inline_object4)
    {
        $request = $this->cloneDomainRequest($domain_id, $inline_object4);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\Domain' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Domain', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
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
                        '\ZoneWatcher\LinodeApiV4\Model\Domain',
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
     * Operation cloneDomainAsync
     *
     * Domain Clone
     *
     * @param  string $domain_id ID of the Domain to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject4 $inline_object4 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cloneDomainAsync($domain_id, $inline_object4)
    {
        return $this->cloneDomainAsyncWithHttpInfo($domain_id, $inline_object4)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cloneDomainAsyncWithHttpInfo
     *
     * Domain Clone
     *
     * @param  string $domain_id ID of the Domain to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject4 $inline_object4 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cloneDomainAsyncWithHttpInfo($domain_id, $inline_object4)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
        $request = $this->cloneDomainRequest($domain_id, $inline_object4);

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
     * Create request for operation 'cloneDomain'
     *
     * @param  string $domain_id ID of the Domain to clone. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\InlineObject4 $inline_object4 (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cloneDomainRequest($domain_id, $inline_object4)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling cloneDomain'
            );
        }
        // verify the required parameter 'inline_object4' is set
        if ($inline_object4 === null || (is_array($inline_object4) && count($inline_object4) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $inline_object4 when calling cloneDomain'
            );
        }

        $resourcePath = '/domains/{domainId}/clone';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
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
        if (isset($inline_object4)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($inline_object4));
            } else {
                $httpBody = $inline_object4;
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
     * Operation createDomain
     *
     * Domain Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the domain you are registering. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createDomain($unknown_base_type)
    {
        list($response) = $this->createDomainWithHttpInfo($unknown_base_type);
        return $response;
    }

    /**
     * Operation createDomainWithHttpInfo
     *
     * Domain Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the domain you are registering. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createDomainWithHttpInfo($unknown_base_type)
    {
        $request = $this->createDomainRequest($unknown_base_type);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\Domain' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Domain', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
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
                        '\ZoneWatcher\LinodeApiV4\Model\Domain',
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
     * Operation createDomainAsync
     *
     * Domain Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the domain you are registering. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDomainAsync($unknown_base_type)
    {
        return $this->createDomainAsyncWithHttpInfo($unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createDomainAsyncWithHttpInfo
     *
     * Domain Create
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the domain you are registering. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDomainAsyncWithHttpInfo($unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
        $request = $this->createDomainRequest($unknown_base_type);

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
     * Create request for operation 'createDomain'
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the domain you are registering. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createDomainRequest($unknown_base_type)
    {
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling createDomain'
            );
        }

        $resourcePath = '/domains';
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
     * Operation createDomainRecord
     *
     * Domain Record Create
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the new Record to add. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\DomainRecord|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function createDomainRecord($domain_id, $unknown_base_type)
    {
        list($response) = $this->createDomainRecordWithHttpInfo($domain_id, $unknown_base_type);
        return $response;
    }

    /**
     * Operation createDomainRecordWithHttpInfo
     *
     * Domain Record Create
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the new Record to add. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\DomainRecord|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function createDomainRecordWithHttpInfo($domain_id, $unknown_base_type)
    {
        $request = $this->createDomainRecordRequest($domain_id, $unknown_base_type);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\DomainRecord' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\DomainRecord', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\DomainRecord';
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
                        '\ZoneWatcher\LinodeApiV4\Model\DomainRecord',
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
     * Operation createDomainRecordAsync
     *
     * Domain Record Create
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the new Record to add. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDomainRecordAsync($domain_id, $unknown_base_type)
    {
        return $this->createDomainRecordAsyncWithHttpInfo($domain_id, $unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createDomainRecordAsyncWithHttpInfo
     *
     * Domain Record Create
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the new Record to add. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDomainRecordAsyncWithHttpInfo($domain_id, $unknown_base_type)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\DomainRecord';
        $request = $this->createDomainRecordRequest($domain_id, $unknown_base_type);

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
     * Create request for operation 'createDomainRecord'
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the new Record to add. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createDomainRecordRequest($domain_id, $unknown_base_type)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling createDomainRecord'
            );
        }
        // verify the required parameter 'unknown_base_type' is set
        if ($unknown_base_type === null || (is_array($unknown_base_type) && count($unknown_base_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $unknown_base_type when calling createDomainRecord'
            );
        }

        $resourcePath = '/domains/{domainId}/records';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
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
     * Operation deleteDomain
     *
     * Domain Delete
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteDomain($domain_id)
    {
        list($response) = $this->deleteDomainWithHttpInfo($domain_id);
        return $response;
    }

    /**
     * Operation deleteDomainWithHttpInfo
     *
     * Domain Delete
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteDomainWithHttpInfo($domain_id)
    {
        $request = $this->deleteDomainRequest($domain_id);

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
     * Operation deleteDomainAsync
     *
     * Domain Delete
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDomainAsync($domain_id)
    {
        return $this->deleteDomainAsyncWithHttpInfo($domain_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteDomainAsyncWithHttpInfo
     *
     * Domain Delete
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDomainAsyncWithHttpInfo($domain_id)
    {
        $returnType = 'object';
        $request = $this->deleteDomainRequest($domain_id);

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
     * Create request for operation 'deleteDomain'
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteDomainRequest($domain_id)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling deleteDomain'
            );
        }

        $resourcePath = '/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
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
     * Operation deleteDomainRecord
     *
     * Domain Record Delete
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function deleteDomainRecord($domain_id, $record_id)
    {
        list($response) = $this->deleteDomainRecordWithHttpInfo($domain_id, $record_id);
        return $response;
    }

    /**
     * Operation deleteDomainRecordWithHttpInfo
     *
     * Domain Record Delete
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteDomainRecordWithHttpInfo($domain_id, $record_id)
    {
        $request = $this->deleteDomainRecordRequest($domain_id, $record_id);

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
     * Operation deleteDomainRecordAsync
     *
     * Domain Record Delete
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDomainRecordAsync($domain_id, $record_id)
    {
        return $this->deleteDomainRecordAsyncWithHttpInfo($domain_id, $record_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteDomainRecordAsyncWithHttpInfo
     *
     * Domain Record Delete
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDomainRecordAsyncWithHttpInfo($domain_id, $record_id)
    {
        $returnType = 'object';
        $request = $this->deleteDomainRecordRequest($domain_id, $record_id);

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
     * Create request for operation 'deleteDomainRecord'
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteDomainRecordRequest($domain_id, $record_id)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling deleteDomainRecord'
            );
        }
        // verify the required parameter 'record_id' is set
        if ($record_id === null || (is_array($record_id) && count($record_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $record_id when calling deleteDomainRecord'
            );
        }

        $resourcePath = '/domains/{domainId}/records/{recordId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }
        // path params
        if ($record_id !== null) {
            $resourcePath = str_replace(
                '{' . 'recordId' . '}',
                ObjectSerializer::toPathValue($record_id),
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
     * Operation getDomain
     *
     * Domain View
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getDomain($domain_id)
    {
        list($response) = $this->getDomainWithHttpInfo($domain_id);
        return $response;
    }

    /**
     * Operation getDomainWithHttpInfo
     *
     * Domain View
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDomainWithHttpInfo($domain_id)
    {
        $request = $this->getDomainRequest($domain_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\Domain' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Domain', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
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
                        '\ZoneWatcher\LinodeApiV4\Model\Domain',
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
     * Operation getDomainAsync
     *
     * Domain View
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainAsync($domain_id)
    {
        return $this->getDomainAsyncWithHttpInfo($domain_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDomainAsyncWithHttpInfo
     *
     * Domain View
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainAsyncWithHttpInfo($domain_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
        $request = $this->getDomainRequest($domain_id);

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
     * Create request for operation 'getDomain'
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDomainRequest($domain_id)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling getDomain'
            );
        }

        $resourcePath = '/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
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
     * Operation getDomainRecord
     *
     * Domain Record View
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\DomainRecord|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getDomainRecord($domain_id, $record_id)
    {
        list($response) = $this->getDomainRecordWithHttpInfo($domain_id, $record_id);
        return $response;
    }

    /**
     * Operation getDomainRecordWithHttpInfo
     *
     * Domain Record View
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\DomainRecord|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDomainRecordWithHttpInfo($domain_id, $record_id)
    {
        $request = $this->getDomainRecordRequest($domain_id, $record_id);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\DomainRecord' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\DomainRecord', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\DomainRecord';
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
                        '\ZoneWatcher\LinodeApiV4\Model\DomainRecord',
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
     * Operation getDomainRecordAsync
     *
     * Domain Record View
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainRecordAsync($domain_id, $record_id)
    {
        return $this->getDomainRecordAsyncWithHttpInfo($domain_id, $record_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDomainRecordAsyncWithHttpInfo
     *
     * Domain Record View
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainRecordAsyncWithHttpInfo($domain_id, $record_id)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\DomainRecord';
        $request = $this->getDomainRecordRequest($domain_id, $record_id);

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
     * Create request for operation 'getDomainRecord'
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDomainRecordRequest($domain_id, $record_id)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling getDomainRecord'
            );
        }
        // verify the required parameter 'record_id' is set
        if ($record_id === null || (is_array($record_id) && count($record_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $record_id when calling getDomainRecord'
            );
        }

        $resourcePath = '/domains/{domainId}/records/{recordId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }
        // path params
        if ($record_id !== null) {
            $resourcePath = str_replace(
                '{' . 'recordId' . '}',
                ObjectSerializer::toPathValue($record_id),
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
     * Operation getDomainRecords
     *
     * Domain Records List
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20014
     */
    public function getDomainRecords($domain_id, $page = 1, $page_size = 100)
    {
        list($response) = $this->getDomainRecordsWithHttpInfo($domain_id, $page, $page_size);
        return $response;
    }

    /**
     * Operation getDomainRecordsWithHttpInfo
     *
     * Domain Records List
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20014, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDomainRecordsWithHttpInfo($domain_id, $page = 1, $page_size = 100)
    {
        $request = $this->getDomainRecordsRequest($domain_id, $page, $page_size);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20014' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20014', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20014';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20014',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getDomainRecordsAsync
     *
     * Domain Records List
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainRecordsAsync($domain_id, $page = 1, $page_size = 100)
    {
        return $this->getDomainRecordsAsyncWithHttpInfo($domain_id, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDomainRecordsAsyncWithHttpInfo
     *
     * Domain Records List
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainRecordsAsyncWithHttpInfo($domain_id, $page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20014';
        $request = $this->getDomainRecordsRequest($domain_id, $page, $page_size);

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
     * Create request for operation 'getDomainRecords'
     *
     * @param  int $domain_id The ID of the Domain we are accessing Records for. (required)
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDomainRecordsRequest($domain_id, $page = 1, $page_size = 100)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling getDomainRecords'
            );
        }
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling DomainsApi.getDomainRecords, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling DomainsApi.getDomainRecords, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling DomainsApi.getDomainRecords, must be bigger than or equal to 25.');
        }


        $resourcePath = '/domains/{domainId}/records';
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
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
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
     * Operation getDomainZone
     *
     * Domain Zone File View
     *
     * @param  string $domain_id ID of the Domain. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getDomainZone($domain_id)
    {
        list($response) = $this->getDomainZoneWithHttpInfo($domain_id);
        return $response;
    }

    /**
     * Operation getDomainZoneWithHttpInfo
     *
     * Domain Zone File View
     *
     * @param  string $domain_id ID of the Domain. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDomainZoneWithHttpInfo($domain_id)
    {
        $request = $this->getDomainZoneRequest($domain_id);

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
     * Operation getDomainZoneAsync
     *
     * Domain Zone File View
     *
     * @param  string $domain_id ID of the Domain. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainZoneAsync($domain_id)
    {
        return $this->getDomainZoneAsyncWithHttpInfo($domain_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDomainZoneAsyncWithHttpInfo
     *
     * Domain Zone File View
     *
     * @param  string $domain_id ID of the Domain. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainZoneAsyncWithHttpInfo($domain_id)
    {
        $returnType = 'object';
        $request = $this->getDomainZoneRequest($domain_id);

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
     * Create request for operation 'getDomainZone'
     *
     * @param  string $domain_id ID of the Domain. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDomainZoneRequest($domain_id)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling getDomainZone'
            );
        }

        $resourcePath = '/domains/{domainId}/zone-file';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
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
     * Operation getDomains
     *
     * Domains List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\InlineResponse20013|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function getDomains($page = 1, $page_size = 100)
    {
        list($response) = $this->getDomainsWithHttpInfo($page, $page_size);
        return $response;
    }

    /**
     * Operation getDomainsWithHttpInfo
     *
     * Domains List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\InlineResponse20013|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDomainsWithHttpInfo($page = 1, $page_size = 100)
    {
        $request = $this->getDomainsRequest($page, $page_size);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\InlineResponse20013' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20013', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20013';
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
                        '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20013',
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
     * Operation getDomainsAsync
     *
     * Domains List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainsAsync($page = 1, $page_size = 100)
    {
        return $this->getDomainsAsyncWithHttpInfo($page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDomainsAsyncWithHttpInfo
     *
     * Domains List
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDomainsAsyncWithHttpInfo($page = 1, $page_size = 100)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\InlineResponse20013';
        $request = $this->getDomainsRequest($page, $page_size);

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
     * Create request for operation 'getDomains'
     *
     * @param  int $page The page of a collection to return. (optional, default to 1)
     * @param  int $page_size The number of items to return per page. (optional, default to 100)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDomainsRequest($page = 1, $page_size = 100)
    {
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling DomainsApi.getDomains, must be bigger than or equal to 1.');
        }

        if ($page_size !== null && $page_size > 100) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling DomainsApi.getDomains, must be smaller than or equal to 100.');
        }
        if ($page_size !== null && $page_size < 25) {
            throw new \InvalidArgumentException('invalid value for "$page_size" when calling DomainsApi.getDomains, must be bigger than or equal to 25.');
        }


        $resourcePath = '/domains';
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
     * Operation importDomain
     *
     * Domain Import
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Domain to import. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function importDomain($unknown_base_type = null)
    {
        list($response) = $this->importDomainWithHttpInfo($unknown_base_type);
        return $response;
    }

    /**
     * Operation importDomainWithHttpInfo
     *
     * Domain Import
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Domain to import. (optional)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function importDomainWithHttpInfo($unknown_base_type = null)
    {
        $request = $this->importDomainRequest($unknown_base_type);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\Domain' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Domain', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
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
                        '\ZoneWatcher\LinodeApiV4\Model\Domain',
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
     * Operation importDomainAsync
     *
     * Domain Import
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Domain to import. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function importDomainAsync($unknown_base_type = null)
    {
        return $this->importDomainAsyncWithHttpInfo($unknown_base_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation importDomainAsyncWithHttpInfo
     *
     * Domain Import
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Domain to import. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function importDomainAsyncWithHttpInfo($unknown_base_type = null)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
        $request = $this->importDomainRequest($unknown_base_type);

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
     * Create request for operation 'importDomain'
     *
     * @param  \ZoneWatcher\LinodeApiV4\Model\UNKNOWN_BASE_TYPE $unknown_base_type Information about the Domain to import. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function importDomainRequest($unknown_base_type = null)
    {

        $resourcePath = '/domains/import';
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
     * Operation updateDomain
     *
     * Domain Update
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Domain $domain The Domain information to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateDomain($domain_id, $domain)
    {
        list($response) = $this->updateDomainWithHttpInfo($domain_id, $domain);
        return $response;
    }

    /**
     * Operation updateDomainWithHttpInfo
     *
     * Domain Update
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Domain $domain The Domain information to update. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\Domain|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateDomainWithHttpInfo($domain_id, $domain)
    {
        $request = $this->updateDomainRequest($domain_id, $domain);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\Domain' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\Domain', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
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
                        '\ZoneWatcher\LinodeApiV4\Model\Domain',
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
     * Operation updateDomainAsync
     *
     * Domain Update
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Domain $domain The Domain information to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDomainAsync($domain_id, $domain)
    {
        return $this->updateDomainAsyncWithHttpInfo($domain_id, $domain)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateDomainAsyncWithHttpInfo
     *
     * Domain Update
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Domain $domain The Domain information to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDomainAsyncWithHttpInfo($domain_id, $domain)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\Domain';
        $request = $this->updateDomainRequest($domain_id, $domain);

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
     * Create request for operation 'updateDomain'
     *
     * @param  int $domain_id The ID of the Domain to access. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\Domain $domain The Domain information to update. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateDomainRequest($domain_id, $domain)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling updateDomain'
            );
        }
        // verify the required parameter 'domain' is set
        if ($domain === null || (is_array($domain) && count($domain) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain when calling updateDomain'
            );
        }

        $resourcePath = '/domains/{domainId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
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
        if (isset($domain)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($domain));
            } else {
                $httpBody = $domain;
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
     * Operation updateDomainRecord
     *
     * Domain Record Update
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\DomainRecord $domain_record The values to change. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ZoneWatcher\LinodeApiV4\Model\DomainRecord|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault
     */
    public function updateDomainRecord($domain_id, $record_id, $domain_record)
    {
        list($response) = $this->updateDomainRecordWithHttpInfo($domain_id, $record_id, $domain_record);
        return $response;
    }

    /**
     * Operation updateDomainRecordWithHttpInfo
     *
     * Domain Record Update
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\DomainRecord $domain_record The values to change. (required)
     *
     * @throws \ZoneWatcher\LinodeApiV4\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ZoneWatcher\LinodeApiV4\Model\DomainRecord|\ZoneWatcher\LinodeApiV4\Model\InlineResponseDefault, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateDomainRecordWithHttpInfo($domain_id, $record_id, $domain_record)
    {
        $request = $this->updateDomainRecordRequest($domain_id, $record_id, $domain_record);

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
                    if ('\ZoneWatcher\LinodeApiV4\Model\DomainRecord' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\ZoneWatcher\LinodeApiV4\Model\DomainRecord', []),
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

            $returnType = '\ZoneWatcher\LinodeApiV4\Model\DomainRecord';
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
                        '\ZoneWatcher\LinodeApiV4\Model\DomainRecord',
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
     * Operation updateDomainRecordAsync
     *
     * Domain Record Update
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\DomainRecord $domain_record The values to change. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDomainRecordAsync($domain_id, $record_id, $domain_record)
    {
        return $this->updateDomainRecordAsyncWithHttpInfo($domain_id, $record_id, $domain_record)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateDomainRecordAsyncWithHttpInfo
     *
     * Domain Record Update
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\DomainRecord $domain_record The values to change. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDomainRecordAsyncWithHttpInfo($domain_id, $record_id, $domain_record)
    {
        $returnType = '\ZoneWatcher\LinodeApiV4\Model\DomainRecord';
        $request = $this->updateDomainRecordRequest($domain_id, $record_id, $domain_record);

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
     * Create request for operation 'updateDomainRecord'
     *
     * @param  int $domain_id The ID of the Domain whose Record you are accessing. (required)
     * @param  int $record_id The ID of the Record you are accessing. (required)
     * @param  \ZoneWatcher\LinodeApiV4\Model\DomainRecord $domain_record The values to change. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateDomainRecordRequest($domain_id, $record_id, $domain_record)
    {
        // verify the required parameter 'domain_id' is set
        if ($domain_id === null || (is_array($domain_id) && count($domain_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_id when calling updateDomainRecord'
            );
        }
        // verify the required parameter 'record_id' is set
        if ($record_id === null || (is_array($record_id) && count($record_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $record_id when calling updateDomainRecord'
            );
        }
        // verify the required parameter 'domain_record' is set
        if ($domain_record === null || (is_array($domain_record) && count($domain_record) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_record when calling updateDomainRecord'
            );
        }

        $resourcePath = '/domains/{domainId}/records/{recordId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($domain_id !== null) {
            $resourcePath = str_replace(
                '{' . 'domainId' . '}',
                ObjectSerializer::toPathValue($domain_id),
                $resourcePath
            );
        }
        // path params
        if ($record_id !== null) {
            $resourcePath = str_replace(
                '{' . 'recordId' . '}',
                ObjectSerializer::toPathValue($record_id),
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
        if (isset($domain_record)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($domain_record));
            } else {
                $httpBody = $domain_record;
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

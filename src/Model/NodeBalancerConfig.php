<?php
/**
 * NodeBalancerConfig
 *
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

namespace ZoneWatcher\LinodeApiV4\Model;

use \ArrayAccess;
use \ZoneWatcher\LinodeApiV4\ObjectSerializer;

/**
 * NodeBalancerConfig Class Doc Comment
 *
 * @category Class
 * @description A NodeBalancer config represents the configuration of this NodeBalancer on a single port.  For example, a NodeBalancer Config on port 80 would typically represent how this NodeBalancer response to HTTP requests.  NodeBalancer configs have a list of backends, called \&quot;nodes,\&quot; that they forward requests between based on their configuration.
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class NodeBalancerConfig implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'NodeBalancerConfig';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'port' => 'int',
        'protocol' => 'string',
        'algorithm' => 'string',
        'stickiness' => 'string',
        'check' => 'string',
        'check_interval' => 'int',
        'check_timeout' => 'int',
        'check_attempts' => 'int',
        'check_path' => 'string',
        'check_body' => 'string',
        'check_passive' => 'bool',
        'proxy_protocol' => 'string',
        'cipher_suite' => 'string',
        'nodebalancer_id' => 'int',
        'ssl_commonname' => 'string',
        'ssl_fingerprint' => 'string',
        'ssl_cert' => 'string',
        'ssl_key' => 'string',
        'nodes_status' => '\ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfigNodesStatus'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'port' => null,
        'protocol' => null,
        'algorithm' => null,
        'stickiness' => null,
        'check' => null,
        'check_interval' => null,
        'check_timeout' => null,
        'check_attempts' => null,
        'check_path' => null,
        'check_body' => null,
        'check_passive' => null,
        'proxy_protocol' => null,
        'cipher_suite' => null,
        'nodebalancer_id' => null,
        'ssl_commonname' => null,
        'ssl_fingerprint' => null,
        'ssl_cert' => 'ssl-cert',
        'ssl_key' => 'ssl-key',
        'nodes_status' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'port' => 'port',
        'protocol' => 'protocol',
        'algorithm' => 'algorithm',
        'stickiness' => 'stickiness',
        'check' => 'check',
        'check_interval' => 'check_interval',
        'check_timeout' => 'check_timeout',
        'check_attempts' => 'check_attempts',
        'check_path' => 'check_path',
        'check_body' => 'check_body',
        'check_passive' => 'check_passive',
        'proxy_protocol' => 'proxy_protocol',
        'cipher_suite' => 'cipher_suite',
        'nodebalancer_id' => 'nodebalancer_id',
        'ssl_commonname' => 'ssl_commonname',
        'ssl_fingerprint' => 'ssl_fingerprint',
        'ssl_cert' => 'ssl_cert',
        'ssl_key' => 'ssl_key',
        'nodes_status' => 'nodes_status'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'port' => 'setPort',
        'protocol' => 'setProtocol',
        'algorithm' => 'setAlgorithm',
        'stickiness' => 'setStickiness',
        'check' => 'setCheck',
        'check_interval' => 'setCheckInterval',
        'check_timeout' => 'setCheckTimeout',
        'check_attempts' => 'setCheckAttempts',
        'check_path' => 'setCheckPath',
        'check_body' => 'setCheckBody',
        'check_passive' => 'setCheckPassive',
        'proxy_protocol' => 'setProxyProtocol',
        'cipher_suite' => 'setCipherSuite',
        'nodebalancer_id' => 'setNodebalancerId',
        'ssl_commonname' => 'setSslCommonname',
        'ssl_fingerprint' => 'setSslFingerprint',
        'ssl_cert' => 'setSslCert',
        'ssl_key' => 'setSslKey',
        'nodes_status' => 'setNodesStatus'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'port' => 'getPort',
        'protocol' => 'getProtocol',
        'algorithm' => 'getAlgorithm',
        'stickiness' => 'getStickiness',
        'check' => 'getCheck',
        'check_interval' => 'getCheckInterval',
        'check_timeout' => 'getCheckTimeout',
        'check_attempts' => 'getCheckAttempts',
        'check_path' => 'getCheckPath',
        'check_body' => 'getCheckBody',
        'check_passive' => 'getCheckPassive',
        'proxy_protocol' => 'getProxyProtocol',
        'cipher_suite' => 'getCipherSuite',
        'nodebalancer_id' => 'getNodebalancerId',
        'ssl_commonname' => 'getSslCommonname',
        'ssl_fingerprint' => 'getSslFingerprint',
        'ssl_cert' => 'getSslCert',
        'ssl_key' => 'getSslKey',
        'nodes_status' => 'getNodesStatus'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const PROTOCOL_HTTP = 'http';
    const PROTOCOL_HTTPS = 'https';
    const PROTOCOL_TCP = 'tcp';
    const ALGORITHM_ROUNDROBIN = 'roundrobin';
    const ALGORITHM_LEASTCONN = 'leastconn';
    const ALGORITHM_SOURCE = 'source';
    const STICKINESS_NONE = 'none';
    const STICKINESS_TABLE = 'table';
    const STICKINESS_HTTP_COOKIE = 'http_cookie';
    const CHECK_NONE = 'none';
    const CHECK_CONNECTION = 'connection';
    const CHECK_HTTP = 'http';
    const CHECK_HTTP_BODY = 'http_body';
    const PROXY_PROTOCOL_NONE = 'none';
    const PROXY_PROTOCOL_V1 = 'v1';
    const PROXY_PROTOCOL_V2 = 'v2';
    const CIPHER_SUITE_RECOMMENDED = 'recommended';
    const CIPHER_SUITE_LEGACY = 'legacy';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProtocolAllowableValues()
    {
        return [
            self::PROTOCOL_HTTP,
            self::PROTOCOL_HTTPS,
            self::PROTOCOL_TCP,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAlgorithmAllowableValues()
    {
        return [
            self::ALGORITHM_ROUNDROBIN,
            self::ALGORITHM_LEASTCONN,
            self::ALGORITHM_SOURCE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStickinessAllowableValues()
    {
        return [
            self::STICKINESS_NONE,
            self::STICKINESS_TABLE,
            self::STICKINESS_HTTP_COOKIE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCheckAllowableValues()
    {
        return [
            self::CHECK_NONE,
            self::CHECK_CONNECTION,
            self::CHECK_HTTP,
            self::CHECK_HTTP_BODY,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProxyProtocolAllowableValues()
    {
        return [
            self::PROXY_PROTOCOL_NONE,
            self::PROXY_PROTOCOL_V1,
            self::PROXY_PROTOCOL_V2,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCipherSuiteAllowableValues()
    {
        return [
            self::CIPHER_SUITE_RECOMMENDED,
            self::CIPHER_SUITE_LEGACY,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = $data['id'] ?? null;
        $this->container['port'] = $data['port'] ?? null;
        $this->container['protocol'] = $data['protocol'] ?? null;
        $this->container['algorithm'] = $data['algorithm'] ?? null;
        $this->container['stickiness'] = $data['stickiness'] ?? null;
        $this->container['check'] = $data['check'] ?? null;
        $this->container['check_interval'] = $data['check_interval'] ?? null;
        $this->container['check_timeout'] = $data['check_timeout'] ?? null;
        $this->container['check_attempts'] = $data['check_attempts'] ?? null;
        $this->container['check_path'] = $data['check_path'] ?? null;
        $this->container['check_body'] = $data['check_body'] ?? null;
        $this->container['check_passive'] = $data['check_passive'] ?? null;
        $this->container['proxy_protocol'] = $data['proxy_protocol'] ?? 'none';
        $this->container['cipher_suite'] = $data['cipher_suite'] ?? null;
        $this->container['nodebalancer_id'] = $data['nodebalancer_id'] ?? null;
        $this->container['ssl_commonname'] = $data['ssl_commonname'] ?? null;
        $this->container['ssl_fingerprint'] = $data['ssl_fingerprint'] ?? null;
        $this->container['ssl_cert'] = $data['ssl_cert'] ?? null;
        $this->container['ssl_key'] = $data['ssl_key'] ?? null;
        $this->container['nodes_status'] = $data['nodes_status'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['port']) && ($this->container['port'] > 65535)) {
            $invalidProperties[] = "invalid value for 'port', must be smaller than or equal to 65535.";
        }

        if (!is_null($this->container['port']) && ($this->container['port'] < 1)) {
            $invalidProperties[] = "invalid value for 'port', must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getProtocolAllowableValues();
        if (!is_null($this->container['protocol']) && !in_array($this->container['protocol'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'protocol', must be one of '%s'",
                $this->container['protocol'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getAlgorithmAllowableValues();
        if (!is_null($this->container['algorithm']) && !in_array($this->container['algorithm'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'algorithm', must be one of '%s'",
                $this->container['algorithm'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getStickinessAllowableValues();
        if (!is_null($this->container['stickiness']) && !in_array($this->container['stickiness'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'stickiness', must be one of '%s'",
                $this->container['stickiness'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getCheckAllowableValues();
        if (!is_null($this->container['check']) && !in_array($this->container['check'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'check', must be one of '%s'",
                $this->container['check'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['check_timeout']) && ($this->container['check_timeout'] > 30)) {
            $invalidProperties[] = "invalid value for 'check_timeout', must be smaller than or equal to 30.";
        }

        if (!is_null($this->container['check_timeout']) && ($this->container['check_timeout'] < 1)) {
            $invalidProperties[] = "invalid value for 'check_timeout', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['check_attempts']) && ($this->container['check_attempts'] > 30)) {
            $invalidProperties[] = "invalid value for 'check_attempts', must be smaller than or equal to 30.";
        }

        if (!is_null($this->container['check_attempts']) && ($this->container['check_attempts'] < 1)) {
            $invalidProperties[] = "invalid value for 'check_attempts', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['check_path']) && !preg_match("/^[a-zA-Z0-9\/\\-%?&=.]*$/", $this->container['check_path'])) {
            $invalidProperties[] = "invalid value for 'check_path', must be conform to the pattern /^[a-zA-Z0-9\/\\-%?&=.]*$/.";
        }

        $allowedValues = $this->getProxyProtocolAllowableValues();
        if (!is_null($this->container['proxy_protocol']) && !in_array($this->container['proxy_protocol'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'proxy_protocol', must be one of '%s'",
                $this->container['proxy_protocol'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getCipherSuiteAllowableValues();
        if (!is_null($this->container['cipher_suite']) && !in_array($this->container['cipher_suite'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'cipher_suite', must be one of '%s'",
                $this->container['cipher_suite'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id This config's unique ID
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets port
     *
     * @return int|null
     */
    public function getPort()
    {
        return $this->container['port'];
    }

    /**
     * Sets port
     *
     * @param int|null $port The port this Config is for. These values must be unique across configs on a single NodeBalancer (you can't have two configs for port 80, for example).  While some ports imply some protocols, no enforcement is done and you may configure your NodeBalancer however is useful to you. For example, while port 443 is generally used for HTTPS, you do not need SSL configured to have a NodeBalancer listening on port 443.
     *
     * @return self
     */
    public function setPort($port)
    {

        if (!is_null($port) && ($port > 65535)) {
            throw new \InvalidArgumentException('invalid value for $port when calling NodeBalancerConfig., must be smaller than or equal to 65535.');
        }
        if (!is_null($port) && ($port < 1)) {
            throw new \InvalidArgumentException('invalid value for $port when calling NodeBalancerConfig., must be bigger than or equal to 1.');
        }

        $this->container['port'] = $port;

        return $this;
    }

    /**
     * Gets protocol
     *
     * @return string|null
     */
    public function getProtocol()
    {
        return $this->container['protocol'];
    }

    /**
     * Sets protocol
     *
     * @param string|null $protocol The protocol this port is configured to serve. * If using `http` or `tcp` protocol, `ssl_cert` and `ssl_key` are not supported. * If using `https` protocol, `ssl_cert` and `ssl_key` are required.
     *
     * @return self
     */
    public function setProtocol($protocol)
    {
        $allowedValues = $this->getProtocolAllowableValues();
        if (!is_null($protocol) && !in_array($protocol, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'protocol', must be one of '%s'",
                    $protocol,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['protocol'] = $protocol;

        return $this;
    }

    /**
     * Gets algorithm
     *
     * @return string|null
     */
    public function getAlgorithm()
    {
        return $this->container['algorithm'];
    }

    /**
     * Sets algorithm
     *
     * @param string|null $algorithm What algorithm this NodeBalancer should use for routing traffic to backends.
     *
     * @return self
     */
    public function setAlgorithm($algorithm)
    {
        $allowedValues = $this->getAlgorithmAllowableValues();
        if (!is_null($algorithm) && !in_array($algorithm, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'algorithm', must be one of '%s'",
                    $algorithm,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['algorithm'] = $algorithm;

        return $this;
    }

    /**
     * Gets stickiness
     *
     * @return string|null
     */
    public function getStickiness()
    {
        return $this->container['stickiness'];
    }

    /**
     * Sets stickiness
     *
     * @param string|null $stickiness Controls how session stickiness is handled on this port. * If set to `none` connections will always be assigned a backend based on the algorithm configured. * If set to `table` sessions from the same remote address will be routed to the same   backend.  * For HTTP or HTTPS clients, `http_cookie` allows sessions to be   routed to the same backend based on a cookie set by the NodeBalancer.
     *
     * @return self
     */
    public function setStickiness($stickiness)
    {
        $allowedValues = $this->getStickinessAllowableValues();
        if (!is_null($stickiness) && !in_array($stickiness, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'stickiness', must be one of '%s'",
                    $stickiness,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['stickiness'] = $stickiness;

        return $this;
    }

    /**
     * Gets check
     *
     * @return string|null
     */
    public function getCheck()
    {
        return $this->container['check'];
    }

    /**
     * Sets check
     *
     * @param string|null $check The type of check to perform against backends to ensure they are serving requests. This is used to determine if backends are up or down. * If `none` no check is performed. * `connection` requires only a connection to the backend to succeed. * `http` and `http_body` rely on the backend serving HTTP, and that   the response returned matches what is expected.
     *
     * @return self
     */
    public function setCheck($check)
    {
        $allowedValues = $this->getCheckAllowableValues();
        if (!is_null($check) && !in_array($check, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'check', must be one of '%s'",
                    $check,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['check'] = $check;

        return $this;
    }

    /**
     * Gets check_interval
     *
     * @return int|null
     */
    public function getCheckInterval()
    {
        return $this->container['check_interval'];
    }

    /**
     * Sets check_interval
     *
     * @param int|null $check_interval How often, in seconds, to check that backends are up and serving requests.
     *
     * @return self
     */
    public function setCheckInterval($check_interval)
    {
        $this->container['check_interval'] = $check_interval;

        return $this;
    }

    /**
     * Gets check_timeout
     *
     * @return int|null
     */
    public function getCheckTimeout()
    {
        return $this->container['check_timeout'];
    }

    /**
     * Sets check_timeout
     *
     * @param int|null $check_timeout How long, in seconds, to wait for a check attempt before considering it failed.
     *
     * @return self
     */
    public function setCheckTimeout($check_timeout)
    {

        if (!is_null($check_timeout) && ($check_timeout > 30)) {
            throw new \InvalidArgumentException('invalid value for $check_timeout when calling NodeBalancerConfig., must be smaller than or equal to 30.');
        }
        if (!is_null($check_timeout) && ($check_timeout < 1)) {
            throw new \InvalidArgumentException('invalid value for $check_timeout when calling NodeBalancerConfig., must be bigger than or equal to 1.');
        }

        $this->container['check_timeout'] = $check_timeout;

        return $this;
    }

    /**
     * Gets check_attempts
     *
     * @return int|null
     */
    public function getCheckAttempts()
    {
        return $this->container['check_attempts'];
    }

    /**
     * Sets check_attempts
     *
     * @param int|null $check_attempts How many times to attempt a check before considering a backend to be down.
     *
     * @return self
     */
    public function setCheckAttempts($check_attempts)
    {

        if (!is_null($check_attempts) && ($check_attempts > 30)) {
            throw new \InvalidArgumentException('invalid value for $check_attempts when calling NodeBalancerConfig., must be smaller than or equal to 30.');
        }
        if (!is_null($check_attempts) && ($check_attempts < 1)) {
            throw new \InvalidArgumentException('invalid value for $check_attempts when calling NodeBalancerConfig., must be bigger than or equal to 1.');
        }

        $this->container['check_attempts'] = $check_attempts;

        return $this;
    }

    /**
     * Gets check_path
     *
     * @return string|null
     */
    public function getCheckPath()
    {
        return $this->container['check_path'];
    }

    /**
     * Sets check_path
     *
     * @param string|null $check_path The URL path to check on each backend. If the backend does not respond to this request it is considered to be down.
     *
     * @return self
     */
    public function setCheckPath($check_path)
    {

        if (!is_null($check_path) && (!preg_match("/^[a-zA-Z0-9\/\\-%?&=.]*$/", $check_path))) {
            throw new \InvalidArgumentException("invalid value for $check_path when calling NodeBalancerConfig., must conform to the pattern /^[a-zA-Z0-9\/\\-%?&=.]*$/.");
        }

        $this->container['check_path'] = $check_path;

        return $this;
    }

    /**
     * Gets check_body
     *
     * @return string|null
     */
    public function getCheckBody()
    {
        return $this->container['check_body'];
    }

    /**
     * Sets check_body
     *
     * @param string|null $check_body This value must be present in the response body of the check in order for it to pass. If this value is not present in the response body of a check request, the backend is considered to be down.
     *
     * @return self
     */
    public function setCheckBody($check_body)
    {
        $this->container['check_body'] = $check_body;

        return $this;
    }

    /**
     * Gets check_passive
     *
     * @return bool|null
     */
    public function getCheckPassive()
    {
        return $this->container['check_passive'];
    }

    /**
     * Sets check_passive
     *
     * @param bool|null $check_passive If true, any response from this backend with a `5xx` status code will be enough for it to be considered unhealthy and taken out of rotation.
     *
     * @return self
     */
    public function setCheckPassive($check_passive)
    {
        $this->container['check_passive'] = $check_passive;

        return $this;
    }

    /**
     * Gets proxy_protocol
     *
     * @return string|null
     */
    public function getProxyProtocol()
    {
        return $this->container['proxy_protocol'];
    }

    /**
     * Sets proxy_protocol
     *
     * @param string|null $proxy_protocol ProxyProtocol is a TCP extension that sends initial TCP connection information such as source/destination IPs and ports to backend devices. This information would be lost otherwise. Backend devices must be configured to work with ProxyProtocol if enabled.  * If ommited, or set to `none`, the NodeBalancer doesn't send any auxilary data over TCP connections. This is the default. * If set to `v1`, the human-readable header format (Version 1) is used. * If set to `v2`, the binary header format (Version 2) is used.
     *
     * @return self
     */
    public function setProxyProtocol($proxy_protocol)
    {
        $allowedValues = $this->getProxyProtocolAllowableValues();
        if (!is_null($proxy_protocol) && !in_array($proxy_protocol, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'proxy_protocol', must be one of '%s'",
                    $proxy_protocol,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['proxy_protocol'] = $proxy_protocol;

        return $this;
    }

    /**
     * Gets cipher_suite
     *
     * @return string|null
     */
    public function getCipherSuite()
    {
        return $this->container['cipher_suite'];
    }

    /**
     * Sets cipher_suite
     *
     * @param string|null $cipher_suite What ciphers to use for SSL connections served by this NodeBalancer.  * `legacy` is considered insecure and should only be used if necessary.
     *
     * @return self
     */
    public function setCipherSuite($cipher_suite)
    {
        $allowedValues = $this->getCipherSuiteAllowableValues();
        if (!is_null($cipher_suite) && !in_array($cipher_suite, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'cipher_suite', must be one of '%s'",
                    $cipher_suite,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['cipher_suite'] = $cipher_suite;

        return $this;
    }

    /**
     * Gets nodebalancer_id
     *
     * @return int|null
     */
    public function getNodebalancerId()
    {
        return $this->container['nodebalancer_id'];
    }

    /**
     * Sets nodebalancer_id
     *
     * @param int|null $nodebalancer_id The ID for the NodeBalancer this config belongs to.
     *
     * @return self
     */
    public function setNodebalancerId($nodebalancer_id)
    {
        $this->container['nodebalancer_id'] = $nodebalancer_id;

        return $this;
    }

    /**
     * Gets ssl_commonname
     *
     * @return string|null
     */
    public function getSslCommonname()
    {
        return $this->container['ssl_commonname'];
    }

    /**
     * Sets ssl_commonname
     *
     * @param string|null $ssl_commonname The read-only common name automatically derived from the SSL certificate assigned to this NodeBalancerConfig. Please refer to this field to verify that the appropriate certificate is assigned to your NodeBalancerConfig.
     *
     * @return self
     */
    public function setSslCommonname($ssl_commonname)
    {
        $this->container['ssl_commonname'] = $ssl_commonname;

        return $this;
    }

    /**
     * Gets ssl_fingerprint
     *
     * @return string|null
     */
    public function getSslFingerprint()
    {
        return $this->container['ssl_fingerprint'];
    }

    /**
     * Sets ssl_fingerprint
     *
     * @param string|null $ssl_fingerprint The read-only fingerprint automatically derived from the SSL certificate assigned to this NodeBalancerConfig. Please refer to this field to verify that the appropriate certificate is assigned to your NodeBalancerConfig.
     *
     * @return self
     */
    public function setSslFingerprint($ssl_fingerprint)
    {
        $this->container['ssl_fingerprint'] = $ssl_fingerprint;

        return $this;
    }

    /**
     * Gets ssl_cert
     *
     * @return string|null
     */
    public function getSslCert()
    {
        return $this->container['ssl_cert'];
    }

    /**
     * Sets ssl_cert
     *
     * @param string|null $ssl_cert The PEM-formatted public SSL certificate (or the combined PEM-formatted SSL certificate and Certificate Authority chain) that should be served on this NodeBalancerConfig's port.  The contents of this field will not be shown in any responses that display the NodeBalancerConfig. Instead, `<REDACTED>` will be printed where the field appears.  The read-only `ssl_commonname` and `ssl_fingerprint` fields in a NodeBalancerConfig response are automatically derived from your certificate. Please refer to these fields to verify that the appropriate certificate was assigned to your NodeBalancerConfig.
     *
     * @return self
     */
    public function setSslCert($ssl_cert)
    {
        $this->container['ssl_cert'] = $ssl_cert;

        return $this;
    }

    /**
     * Gets ssl_key
     *
     * @return string|null
     */
    public function getSslKey()
    {
        return $this->container['ssl_key'];
    }

    /**
     * Sets ssl_key
     *
     * @param string|null $ssl_key The PEM-formatted private key for the SSL certificate set in the `ssl_cert` field.  Line breaks must be represented as \"\\n\" in the string.  The contents of this field will not be shown in any responses that display the NodeBalancerConfig. Instead, `<REDACTED>` will be printed where the field appears.  The read-only `ssl_commonname` and `ssl_fingerprint` fields in a NodeBalancerConfig response are automatically derived from your certificate. Please refer to these fields to verify that the appropriate certificate was assigned to your NodeBalancerConfig.
     *
     * @return self
     */
    public function setSslKey($ssl_key)
    {
        $this->container['ssl_key'] = $ssl_key;

        return $this;
    }

    /**
     * Gets nodes_status
     *
     * @return \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfigNodesStatus|null
     */
    public function getNodesStatus()
    {
        return $this->container['nodes_status'];
    }

    /**
     * Sets nodes_status
     *
     * @param \ZoneWatcher\LinodeApiV4\Model\NodeBalancerConfigNodesStatus|null $nodes_status nodes_status
     *
     * @return self
     */
    public function setNodesStatus($nodes_status)
    {
        $this->container['nodes_status'] = $nodes_status;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}



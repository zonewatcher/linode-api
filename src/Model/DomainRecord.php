<?php
/**
 * DomainRecord
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
 * DomainRecord Class Doc Comment
 *
 * @category Class
 * @description A single record on a Domain.
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class DomainRecord implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'DomainRecord';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'type' => 'string',
        'name' => 'string',
        'target' => 'string',
        'priority' => 'int',
        'weight' => 'int',
        'port' => 'int',
        'service' => 'string',
        'protocol' => 'string',
        'ttl_sec' => 'int',
        'tag' => 'string',
        'created' => '\DateTime',
        'updated' => '\DateTime'
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
        'type' => null,
        'name' => null,
        'target' => null,
        'priority' => null,
        'weight' => null,
        'port' => null,
        'service' => null,
        'protocol' => null,
        'ttl_sec' => null,
        'tag' => null,
        'created' => 'date-time',
        'updated' => 'date-time'
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
        'type' => 'type',
        'name' => 'name',
        'target' => 'target',
        'priority' => 'priority',
        'weight' => 'weight',
        'port' => 'port',
        'service' => 'service',
        'protocol' => 'protocol',
        'ttl_sec' => 'ttl_sec',
        'tag' => 'tag',
        'created' => 'created',
        'updated' => 'updated'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'type' => 'setType',
        'name' => 'setName',
        'target' => 'setTarget',
        'priority' => 'setPriority',
        'weight' => 'setWeight',
        'port' => 'setPort',
        'service' => 'setService',
        'protocol' => 'setProtocol',
        'ttl_sec' => 'setTtlSec',
        'tag' => 'setTag',
        'created' => 'setCreated',
        'updated' => 'setUpdated'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'type' => 'getType',
        'name' => 'getName',
        'target' => 'getTarget',
        'priority' => 'getPriority',
        'weight' => 'getWeight',
        'port' => 'getPort',
        'service' => 'getService',
        'protocol' => 'getProtocol',
        'ttl_sec' => 'getTtlSec',
        'tag' => 'getTag',
        'created' => 'getCreated',
        'updated' => 'getUpdated'
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

    const TYPE_A = 'A';
    const TYPE_AAAA = 'AAAA';
    const TYPE_NS = 'NS';
    const TYPE_MX = 'MX';
    const TYPE_CNAME = 'CNAME';
    const TYPE_TXT = 'TXT';
    const TYPE_SRV = 'SRV';
    const TYPE_PTR = 'PTR';
    const TYPE_CAA = 'CAA';
    const TAG_ISSUE = 'issue';
    const TAG_ISSUEWILD = 'issuewild';
    const TAG_IODEF = 'iodef';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_A,
            self::TYPE_AAAA,
            self::TYPE_NS,
            self::TYPE_MX,
            self::TYPE_CNAME,
            self::TYPE_TXT,
            self::TYPE_SRV,
            self::TYPE_PTR,
            self::TYPE_CAA,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTagAllowableValues()
    {
        return [
            self::TAG_ISSUE,
            self::TAG_ISSUEWILD,
            self::TAG_IODEF,
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
        $this->container['type'] = $data['type'] ?? null;
        $this->container['name'] = $data['name'] ?? null;
        $this->container['target'] = $data['target'] ?? null;
        $this->container['priority'] = $data['priority'] ?? null;
        $this->container['weight'] = $data['weight'] ?? null;
        $this->container['port'] = $data['port'] ?? null;
        $this->container['service'] = $data['service'] ?? null;
        $this->container['protocol'] = $data['protocol'] ?? null;
        $this->container['ttl_sec'] = $data['ttl_sec'] ?? null;
        $this->container['tag'] = $data['tag'] ?? null;
        $this->container['created'] = $data['created'] ?? null;
        $this->container['updated'] = $data['updated'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['name']) && (mb_strlen($this->container['name']) > 100)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['name']) && (mb_strlen($this->container['name']) < 1)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['priority']) && ($this->container['priority'] > 255)) {
            $invalidProperties[] = "invalid value for 'priority', must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['priority']) && ($this->container['priority'] < 0)) {
            $invalidProperties[] = "invalid value for 'priority', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['weight']) && ($this->container['weight'] > 65535)) {
            $invalidProperties[] = "invalid value for 'weight', must be smaller than or equal to 65535.";
        }

        if (!is_null($this->container['weight']) && ($this->container['weight'] < 0)) {
            $invalidProperties[] = "invalid value for 'weight', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['port']) && ($this->container['port'] > 65535)) {
            $invalidProperties[] = "invalid value for 'port', must be smaller than or equal to 65535.";
        }

        if (!is_null($this->container['port']) && ($this->container['port'] < 0)) {
            $invalidProperties[] = "invalid value for 'port', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getTagAllowableValues();
        if (!is_null($this->container['tag']) && !in_array($this->container['tag'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'tag', must be one of '%s'",
                $this->container['tag'],
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
     * @param int|null $id This Record's unique ID.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type The type of Record this is in the DNS system. For example, A records associate a domain name with an IPv4 address, and AAAA records associate a domain name with an IPv6 address. For more information, see our guide on [DNS Records](/docs/guides/dns-records-an-introduction).
     *
     * @return self
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name The name of this Record. For requests, this property's actual usage and whether it is required depends on the type of record this represents:  `A` and `AAAA`: The hostname or FQDN of the Record.  `NS`: The subdomain, if any, to use with the Domain of the Record.  `MX`: The mail server subdomain. Must be an empty string (`\"\"`) for a Null MX Record.  `CNAME`: The hostname. Must be unique. Required.  `TXT`: The hostname.  `SRV`: Unused. Use the `service` property to set the service name for this record.  `CAA`: The subdomain. Omit or enter an empty string (`\"\"`) to apply to the entire Domain.  `PTR`: See our guide on how to [Configure Your Linode for Reverse DNS (rDNS)](/docs/guides/configure-your-linode-for-reverse-dns).
     *
     * @return self
     */
    public function setName($name)
    {
        if (!is_null($name) && (mb_strlen($name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $name when calling DomainRecord., must be smaller than or equal to 100.');
        }
        if (!is_null($name) && (mb_strlen($name) < 1)) {
            throw new \InvalidArgumentException('invalid length for $name when calling DomainRecord., must be bigger than or equal to 1.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets target
     *
     * @return string|null
     */
    public function getTarget()
    {
        return $this->container['target'];
    }

    /**
     * Sets target
     *
     * @param string|null $target The target for this Record. For requests, this property's actual usage and whether it is required depends on the type of record this represents:  `A` and `AAAA`: The IP address. Use `[remote_addr]` to submit the IPv4 address of the request. Required.  `NS`: The name server. Must be a valid domain. Required.  `MX`: The mail server. Must be a valid domain unless creating a Null MX Record. To create a [Null MX Record](https://datatracker.ietf.org/doc/html/rfc7505), first [remove](/docs/api/domains/#domain-record-delete) any additional MX records, then enter an empty string (`\"\"`) for this property. If a Domain has a Null MX record, new MX records cannot be created. Required.  `CNAME`: The alias. Must be a valid domain. Required.  `TXT`: The value. Required.  `SRV`: The target domain or subdomain. If a subdomain is entered, it is automatically used with the Domain. To configure for a different domain, enter a valid FQDN. For example, the value `www` with a Domain for `example.com` results in a target set to `www.example.com`, whereas the value `sample.com` results in a target set to `sample.com`. Required.  `CAA`: The value. For `issue` or `issuewild` tags, the domain of your certificate issuer. For the `iodef` tag, a contact or submission URL (http or mailto).  `PTR`: See our guide on how to [Configure Your Linode for Reverse DNS (rDNS)](/docs/guides/configure-your-linode-for-reverse-dns).  With the exception of A, AAAA, and CAA records, this field accepts a trailing period.
     *
     * @return self
     */
    public function setTarget($target)
    {
        $this->container['target'] = $target;

        return $this;
    }

    /**
     * Gets priority
     *
     * @return int|null
     */
    public function getPriority()
    {
        return $this->container['priority'];
    }

    /**
     * Sets priority
     *
     * @param int|null $priority The priority of the target host for this Record. Lower values are preferred. Only valid for MX and SRV record requests. Required for SRV record requests.  Defaults to `0` for MX record requests. Must be `0` for Null MX records.
     *
     * @return self
     */
    public function setPriority($priority)
    {

        if (!is_null($priority) && ($priority > 255)) {
            throw new \InvalidArgumentException('invalid value for $priority when calling DomainRecord., must be smaller than or equal to 255.');
        }
        if (!is_null($priority) && ($priority < 0)) {
            throw new \InvalidArgumentException('invalid value for $priority when calling DomainRecord., must be bigger than or equal to 0.');
        }

        $this->container['priority'] = $priority;

        return $this;
    }

    /**
     * Gets weight
     *
     * @return int|null
     */
    public function getWeight()
    {
        return $this->container['weight'];
    }

    /**
     * Sets weight
     *
     * @param int|null $weight The relative weight of this Record used in the case of identical priority. Higher values are preferred. Only valid and required for SRV record requests.
     *
     * @return self
     */
    public function setWeight($weight)
    {

        if (!is_null($weight) && ($weight > 65535)) {
            throw new \InvalidArgumentException('invalid value for $weight when calling DomainRecord., must be smaller than or equal to 65535.');
        }
        if (!is_null($weight) && ($weight < 0)) {
            throw new \InvalidArgumentException('invalid value for $weight when calling DomainRecord., must be bigger than or equal to 0.');
        }

        $this->container['weight'] = $weight;

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
     * @param int|null $port The port this Record points to. Only valid and required for SRV record requests.
     *
     * @return self
     */
    public function setPort($port)
    {

        if (!is_null($port) && ($port > 65535)) {
            throw new \InvalidArgumentException('invalid value for $port when calling DomainRecord., must be smaller than or equal to 65535.');
        }
        if (!is_null($port) && ($port < 0)) {
            throw new \InvalidArgumentException('invalid value for $port when calling DomainRecord., must be bigger than or equal to 0.');
        }

        $this->container['port'] = $port;

        return $this;
    }

    /**
     * Gets service
     *
     * @return string|null
     */
    public function getService()
    {
        return $this->container['service'];
    }

    /**
     * Sets service
     *
     * @param string|null $service The name of the service. An underscore (`_`) is prepended and a period (`.`) is appended automatically to the submitted value for this property. Only valid and required for SRV record requests.
     *
     * @return self
     */
    public function setService($service)
    {
        $this->container['service'] = $service;

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
     * @param string|null $protocol The protocol this Record's service communicates with. An underscore (`_`) is prepended automatically to the submitted value for this property. Only valid for SRV record requests.
     *
     * @return self
     */
    public function setProtocol($protocol)
    {
        $this->container['protocol'] = $protocol;

        return $this;
    }

    /**
     * Gets ttl_sec
     *
     * @return int|null
     */
    public function getTtlSec()
    {
        return $this->container['ttl_sec'];
    }

    /**
     * Sets ttl_sec
     *
     * @param int|null $ttl_sec \"Time to Live\" - the amount of time in seconds that this Domain's records may be cached by resolvers or other domain servers. Valid values are 300, 3600, 7200, 14400, 28800, 57600, 86400, 172800, 345600, 604800, 1209600, and 2419200 - any other value will be rounded to the nearest valid value.
     *
     * @return self
     */
    public function setTtlSec($ttl_sec)
    {
        $this->container['ttl_sec'] = $ttl_sec;

        return $this;
    }

    /**
     * Gets tag
     *
     * @return string|null
     */
    public function getTag()
    {
        return $this->container['tag'];
    }

    /**
     * Sets tag
     *
     * @param string|null $tag The tag portion of a CAA record. Only valid and required for CAA record requests.
     *
     * @return self
     */
    public function setTag($tag)
    {
        $allowedValues = $this->getTagAllowableValues();
        if (!is_null($tag) && !in_array($tag, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'tag', must be one of '%s'",
                    $tag,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tag'] = $tag;

        return $this;
    }

    /**
     * Gets created
     *
     * @return \DateTime|null
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param \DateTime|null $created When this Domain Record was created.
     *
     * @return self
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets updated
     *
     * @return \DateTime|null
     */
    public function getUpdated()
    {
        return $this->container['updated'];
    }

    /**
     * Sets updated
     *
     * @param \DateTime|null $updated When this Domain Record was last updated.
     *
     * @return self
     */
    public function setUpdated($updated)
    {
        $this->container['updated'] = $updated;

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



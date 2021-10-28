<?php
/**
 * Event
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
 * Event Class Doc Comment
 *
 * @category Class
 * @description A collection of Event objects. An Event is an action taken against an entity related to your Account. For example, booting a Linode would create an Event. The Events returned depends on your grants.
 * @package  ZoneWatcher\LinodeApiV4
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Event implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Event';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'action' => 'string',
        'created' => '\DateTime',
        'duration' => 'float',
        'entity' => '\ZoneWatcher\LinodeApiV4\Model\EventEntity',
        'secondary_entity' => '\ZoneWatcher\LinodeApiV4\Model\EventSecondaryEntity',
        'percent_complete' => 'int',
        'rate' => 'string',
        'read' => 'bool',
        'seen' => 'bool',
        'status' => 'string',
        'time_remaining' => 'string',
        'username' => 'string',
        'message' => 'string'
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
        'action' => null,
        'created' => 'date-time',
        'duration' => null,
        'entity' => null,
        'secondary_entity' => null,
        'percent_complete' => null,
        'rate' => null,
        'read' => null,
        'seen' => null,
        'status' => null,
        'time_remaining' => null,
        'username' => null,
        'message' => null
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
        'action' => 'action',
        'created' => 'created',
        'duration' => 'duration',
        'entity' => 'entity',
        'secondary_entity' => 'secondary_entity',
        'percent_complete' => 'percent_complete',
        'rate' => 'rate',
        'read' => 'read',
        'seen' => 'seen',
        'status' => 'status',
        'time_remaining' => 'time_remaining',
        'username' => 'username',
        'message' => 'message'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'action' => 'setAction',
        'created' => 'setCreated',
        'duration' => 'setDuration',
        'entity' => 'setEntity',
        'secondary_entity' => 'setSecondaryEntity',
        'percent_complete' => 'setPercentComplete',
        'rate' => 'setRate',
        'read' => 'setRead',
        'seen' => 'setSeen',
        'status' => 'setStatus',
        'time_remaining' => 'setTimeRemaining',
        'username' => 'setUsername',
        'message' => 'setMessage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'action' => 'getAction',
        'created' => 'getCreated',
        'duration' => 'getDuration',
        'entity' => 'getEntity',
        'secondary_entity' => 'getSecondaryEntity',
        'percent_complete' => 'getPercentComplete',
        'rate' => 'getRate',
        'read' => 'getRead',
        'seen' => 'getSeen',
        'status' => 'getStatus',
        'time_remaining' => 'getTimeRemaining',
        'username' => 'getUsername',
        'message' => 'getMessage'
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

    const ACTION_ACCOUNT_UPDATE = 'account_update';
    const ACTION_ACCOUNT_SETTINGS_UPDATE = 'account_settings_update';
    const ACTION_BACKUPS_ENABLE = 'backups_enable';
    const ACTION_BACKUPS_CANCEL = 'backups_cancel';
    const ACTION_BACKUPS_RESTORE = 'backups_restore';
    const ACTION_COMMUNITY_QUESTION_REPLY = 'community_question_reply';
    const ACTION_COMMUNITY_LIKE = 'community_like';
    const ACTION_CREDIT_CARD_UPDATED = 'credit_card_updated';
    const ACTION_DISK_CREATE = 'disk_create';
    const ACTION_DISK_DELETE = 'disk_delete';
    const ACTION_DISK_UPDATE = 'disk_update';
    const ACTION_DISK_DUPLICATE = 'disk_duplicate';
    const ACTION_DISK_IMAGIZE = 'disk_imagize';
    const ACTION_DISK_RESIZE = 'disk_resize';
    const ACTION_DNS_RECORD_CREATE = 'dns_record_create';
    const ACTION_DNS_RECORD_DELETE = 'dns_record_delete';
    const ACTION_DNS_RECORD_UPDATE = 'dns_record_update';
    const ACTION_DNS_ZONE_CREATE = 'dns_zone_create';
    const ACTION_DNS_ZONE_DELETE = 'dns_zone_delete';
    const ACTION_DNS_ZONE_IMPORT = 'dns_zone_import';
    const ACTION_DNS_ZONE_UPDATE = 'dns_zone_update';
    const ACTION_ENTITY_TRANSFER_ACCEPT = 'entity_transfer_accept';
    const ACTION_ENTITY_TRANSFER_CANCEL = 'entity_transfer_cancel';
    const ACTION_ENTITY_TRANSFER_CREATE = 'entity_transfer_create';
    const ACTION_ENTITY_TRANSFER_FAIL = 'entity_transfer_fail';
    const ACTION_ENTITY_TRANSFER_STALE = 'entity_transfer_stale';
    const ACTION_FIREWALL_CREATE = 'firewall_create';
    const ACTION_FIREWALL_DELETE = 'firewall_delete';
    const ACTION_FIREWALL_DISABLE = 'firewall_disable';
    const ACTION_FIREWALL_ENABLE = 'firewall_enable';
    const ACTION_FIREWALL_UPDATE = 'firewall_update';
    const ACTION_FIREWALL_DEVICE_ADD = 'firewall_device_add';
    const ACTION_FIREWALL_DEVICE_REMOVE = 'firewall_device_remove';
    const ACTION_HOST_REBOOT = 'host_reboot';
    const ACTION_IMAGE_DELETE = 'image_delete';
    const ACTION_IMAGE_UPDATE = 'image_update';
    const ACTION_IMAGE_UPLOAD = 'image_upload';
    const ACTION_IPADDRESS_UPDATE = 'ipaddress_update';
    const ACTION_LASSIE_REBOOT = 'lassie_reboot';
    const ACTION_LISH_BOOT = 'lish_boot';
    const ACTION_LINODE_ADDIP = 'linode_addip';
    const ACTION_LINODE_BOOT = 'linode_boot';
    const ACTION_LINODE_CLONE = 'linode_clone';
    const ACTION_LINODE_CREATE = 'linode_create';
    const ACTION_LINODE_DELETE = 'linode_delete';
    const ACTION_LINODE_UPDATE = 'linode_update';
    const ACTION_LINODE_DELETEIP = 'linode_deleteip';
    const ACTION_LINODE_MIGRATE = 'linode_migrate';
    const ACTION_LINODE_MIGRATE_DATACENTER = 'linode_migrate_datacenter';
    const ACTION_LINODE_MIGRATE_DATACENTER_CREATE = 'linode_migrate_datacenter_create';
    const ACTION_LINODE_MUTATE = 'linode_mutate';
    const ACTION_LINODE_MUTATE_CREATE = 'linode_mutate_create';
    const ACTION_LINODE_REBOOT = 'linode_reboot';
    const ACTION_LINODE_REBUILD = 'linode_rebuild';
    const ACTION_LINODE_RESIZE = 'linode_resize';
    const ACTION_LINODE_RESIZE_CREATE = 'linode_resize_create';
    const ACTION_LINODE_SHUTDOWN = 'linode_shutdown';
    const ACTION_LINODE_SNAPSHOT = 'linode_snapshot';
    const ACTION_LINODE_CONFIG_CREATE = 'linode_config_create';
    const ACTION_LINODE_CONFIG_DELETE = 'linode_config_delete';
    const ACTION_LINODE_CONFIG_UPDATE = 'linode_config_update';
    const ACTION_LKE_NODE_CREATE = 'lke_node_create';
    const ACTION_LONGVIEWCLIENT_CREATE = 'longviewclient_create';
    const ACTION_LONGVIEWCLIENT_DELETE = 'longviewclient_delete';
    const ACTION_LONGVIEWCLIENT_UPDATE = 'longviewclient_update';
    const ACTION_MANAGED_DISABLED = 'managed_disabled';
    const ACTION_MANAGED_ENABLED = 'managed_enabled';
    const ACTION_MANAGED_SERVICE_CREATE = 'managed_service_create';
    const ACTION_MANAGED_SERVICE_DELETE = 'managed_service_delete';
    const ACTION_NODEBALANCER_CREATE = 'nodebalancer_create';
    const ACTION_NODEBALANCER_DELETE = 'nodebalancer_delete';
    const ACTION_NODEBALANCER_UPDATE = 'nodebalancer_update';
    const ACTION_NODEBALANCER_CONFIG_CREATE = 'nodebalancer_config_create';
    const ACTION_NODEBALANCER_CONFIG_DELETE = 'nodebalancer_config_delete';
    const ACTION_NODEBALANCER_CONFIG_UPDATE = 'nodebalancer_config_update';
    const ACTION_NODEBALANCER_NODE_CREATE = 'nodebalancer_node_create';
    const ACTION_NODEBALANCER_NODE_DELETE = 'nodebalancer_node_delete';
    const ACTION_NODEBALANCER_NODE_UPDATE = 'nodebalancer_node_update';
    const ACTION_OAUTH_CLIENT_CREATE = 'oauth_client_create';
    const ACTION_OAUTH_CLIENT_DELETE = 'oauth_client_delete';
    const ACTION_OAUTH_CLIENT_SECRET_RESET = 'oauth_client_secret_reset';
    const ACTION_OAUTH_CLIENT_UPDATE = 'oauth_client_update';
    const ACTION_PASSWORD_RESET = 'password_reset';
    const ACTION_PAYMENT_METHOD_ADD = 'payment_method_add';
    const ACTION_PAYMENT_SUBMITTED = 'payment_submitted';
    const ACTION_PROFILE_UPDATE = 'profile_update';
    const ACTION_STACKSCRIPT_CREATE = 'stackscript_create';
    const ACTION_STACKSCRIPT_DELETE = 'stackscript_delete';
    const ACTION_STACKSCRIPT_UPDATE = 'stackscript_update';
    const ACTION_STACKSCRIPT_PUBLICIZE = 'stackscript_publicize';
    const ACTION_STACKSCRIPT_REVISE = 'stackscript_revise';
    const ACTION_TAG_CREATE = 'tag_create';
    const ACTION_TAG_DELETE = 'tag_delete';
    const ACTION_TFA_DISABLED = 'tfa_disabled';
    const ACTION_TFA_ENABLED = 'tfa_enabled';
    const ACTION_TICKET_ATTACHMENT_UPLOAD = 'ticket_attachment_upload';
    const ACTION_TICKET_CREATE = 'ticket_create';
    const ACTION_TICKET_UPDATE = 'ticket_update';
    const ACTION_TOKEN_CREATE = 'token_create';
    const ACTION_TOKEN_DELETE = 'token_delete';
    const ACTION_TOKEN_UPDATE = 'token_update';
    const ACTION_USER_CREATE = 'user_create';
    const ACTION_USER_UPDATE = 'user_update';
    const ACTION_USER_DELETE = 'user_delete';
    const ACTION_USER_SSH_KEY_ADD = 'user_ssh_key_add';
    const ACTION_USER_SSH_KEY_DELETE = 'user_ssh_key_delete';
    const ACTION_USER_SSH_KEY_UPDATE = 'user_ssh_key_update';
    const ACTION_VLAN_ATTACH = 'vlan_attach';
    const ACTION_VLAN_DETACH = 'vlan_detach';
    const ACTION_VOLUME_ATTACH = 'volume_attach';
    const ACTION_VOLUME_CLONE = 'volume_clone';
    const ACTION_VOLUME_CREATE = 'volume_create';
    const ACTION_VOLUME_DELETE = 'volume_delete';
    const ACTION_VOLUME_UPDATE = 'volume_update';
    const ACTION_VOLUME_DETACH = 'volume_detach';
    const ACTION_VOLUME_RESIZE = 'volume_resize';
    const STATUS_FAILED = 'failed';
    const STATUS_FINISHED = 'finished';
    const STATUS_NOTIFICATION = 'notification';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_STARTED = 'started';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getActionAllowableValues()
    {
        return [
            self::ACTION_ACCOUNT_UPDATE,
            self::ACTION_ACCOUNT_SETTINGS_UPDATE,
            self::ACTION_BACKUPS_ENABLE,
            self::ACTION_BACKUPS_CANCEL,
            self::ACTION_BACKUPS_RESTORE,
            self::ACTION_COMMUNITY_QUESTION_REPLY,
            self::ACTION_COMMUNITY_LIKE,
            self::ACTION_CREDIT_CARD_UPDATED,
            self::ACTION_DISK_CREATE,
            self::ACTION_DISK_DELETE,
            self::ACTION_DISK_UPDATE,
            self::ACTION_DISK_DUPLICATE,
            self::ACTION_DISK_IMAGIZE,
            self::ACTION_DISK_RESIZE,
            self::ACTION_DNS_RECORD_CREATE,
            self::ACTION_DNS_RECORD_DELETE,
            self::ACTION_DNS_RECORD_UPDATE,
            self::ACTION_DNS_ZONE_CREATE,
            self::ACTION_DNS_ZONE_DELETE,
            self::ACTION_DNS_ZONE_IMPORT,
            self::ACTION_DNS_ZONE_UPDATE,
            self::ACTION_ENTITY_TRANSFER_ACCEPT,
            self::ACTION_ENTITY_TRANSFER_CANCEL,
            self::ACTION_ENTITY_TRANSFER_CREATE,
            self::ACTION_ENTITY_TRANSFER_FAIL,
            self::ACTION_ENTITY_TRANSFER_STALE,
            self::ACTION_FIREWALL_CREATE,
            self::ACTION_FIREWALL_DELETE,
            self::ACTION_FIREWALL_DISABLE,
            self::ACTION_FIREWALL_ENABLE,
            self::ACTION_FIREWALL_UPDATE,
            self::ACTION_FIREWALL_DEVICE_ADD,
            self::ACTION_FIREWALL_DEVICE_REMOVE,
            self::ACTION_HOST_REBOOT,
            self::ACTION_IMAGE_DELETE,
            self::ACTION_IMAGE_UPDATE,
            self::ACTION_IMAGE_UPLOAD,
            self::ACTION_IPADDRESS_UPDATE,
            self::ACTION_LASSIE_REBOOT,
            self::ACTION_LISH_BOOT,
            self::ACTION_LINODE_ADDIP,
            self::ACTION_LINODE_BOOT,
            self::ACTION_LINODE_CLONE,
            self::ACTION_LINODE_CREATE,
            self::ACTION_LINODE_DELETE,
            self::ACTION_LINODE_UPDATE,
            self::ACTION_LINODE_DELETEIP,
            self::ACTION_LINODE_MIGRATE,
            self::ACTION_LINODE_MIGRATE_DATACENTER,
            self::ACTION_LINODE_MIGRATE_DATACENTER_CREATE,
            self::ACTION_LINODE_MUTATE,
            self::ACTION_LINODE_MUTATE_CREATE,
            self::ACTION_LINODE_REBOOT,
            self::ACTION_LINODE_REBUILD,
            self::ACTION_LINODE_RESIZE,
            self::ACTION_LINODE_RESIZE_CREATE,
            self::ACTION_LINODE_SHUTDOWN,
            self::ACTION_LINODE_SNAPSHOT,
            self::ACTION_LINODE_CONFIG_CREATE,
            self::ACTION_LINODE_CONFIG_DELETE,
            self::ACTION_LINODE_CONFIG_UPDATE,
            self::ACTION_LKE_NODE_CREATE,
            self::ACTION_LONGVIEWCLIENT_CREATE,
            self::ACTION_LONGVIEWCLIENT_DELETE,
            self::ACTION_LONGVIEWCLIENT_UPDATE,
            self::ACTION_MANAGED_DISABLED,
            self::ACTION_MANAGED_ENABLED,
            self::ACTION_MANAGED_SERVICE_CREATE,
            self::ACTION_MANAGED_SERVICE_DELETE,
            self::ACTION_NODEBALANCER_CREATE,
            self::ACTION_NODEBALANCER_DELETE,
            self::ACTION_NODEBALANCER_UPDATE,
            self::ACTION_NODEBALANCER_CONFIG_CREATE,
            self::ACTION_NODEBALANCER_CONFIG_DELETE,
            self::ACTION_NODEBALANCER_CONFIG_UPDATE,
            self::ACTION_NODEBALANCER_NODE_CREATE,
            self::ACTION_NODEBALANCER_NODE_DELETE,
            self::ACTION_NODEBALANCER_NODE_UPDATE,
            self::ACTION_OAUTH_CLIENT_CREATE,
            self::ACTION_OAUTH_CLIENT_DELETE,
            self::ACTION_OAUTH_CLIENT_SECRET_RESET,
            self::ACTION_OAUTH_CLIENT_UPDATE,
            self::ACTION_PASSWORD_RESET,
            self::ACTION_PAYMENT_METHOD_ADD,
            self::ACTION_PAYMENT_SUBMITTED,
            self::ACTION_PROFILE_UPDATE,
            self::ACTION_STACKSCRIPT_CREATE,
            self::ACTION_STACKSCRIPT_DELETE,
            self::ACTION_STACKSCRIPT_UPDATE,
            self::ACTION_STACKSCRIPT_PUBLICIZE,
            self::ACTION_STACKSCRIPT_REVISE,
            self::ACTION_TAG_CREATE,
            self::ACTION_TAG_DELETE,
            self::ACTION_TFA_DISABLED,
            self::ACTION_TFA_ENABLED,
            self::ACTION_TICKET_ATTACHMENT_UPLOAD,
            self::ACTION_TICKET_CREATE,
            self::ACTION_TICKET_UPDATE,
            self::ACTION_TOKEN_CREATE,
            self::ACTION_TOKEN_DELETE,
            self::ACTION_TOKEN_UPDATE,
            self::ACTION_USER_CREATE,
            self::ACTION_USER_UPDATE,
            self::ACTION_USER_DELETE,
            self::ACTION_USER_SSH_KEY_ADD,
            self::ACTION_USER_SSH_KEY_DELETE,
            self::ACTION_USER_SSH_KEY_UPDATE,
            self::ACTION_VLAN_ATTACH,
            self::ACTION_VLAN_DETACH,
            self::ACTION_VOLUME_ATTACH,
            self::ACTION_VOLUME_CLONE,
            self::ACTION_VOLUME_CREATE,
            self::ACTION_VOLUME_DELETE,
            self::ACTION_VOLUME_UPDATE,
            self::ACTION_VOLUME_DETACH,
            self::ACTION_VOLUME_RESIZE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_FAILED,
            self::STATUS_FINISHED,
            self::STATUS_NOTIFICATION,
            self::STATUS_SCHEDULED,
            self::STATUS_STARTED,
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
        $this->container['action'] = $data['action'] ?? null;
        $this->container['created'] = $data['created'] ?? null;
        $this->container['duration'] = $data['duration'] ?? null;
        $this->container['entity'] = $data['entity'] ?? null;
        $this->container['secondary_entity'] = $data['secondary_entity'] ?? null;
        $this->container['percent_complete'] = $data['percent_complete'] ?? null;
        $this->container['rate'] = $data['rate'] ?? null;
        $this->container['read'] = $data['read'] ?? null;
        $this->container['seen'] = $data['seen'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['time_remaining'] = $data['time_remaining'] ?? null;
        $this->container['username'] = $data['username'] ?? null;
        $this->container['message'] = $data['message'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getActionAllowableValues();
        if (!is_null($this->container['action']) && !in_array($this->container['action'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'action', must be one of '%s'",
                $this->container['action'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
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
     * @param int|null $id The unique ID of this Event.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets action
     *
     * @return string|null
     */
    public function getAction()
    {
        return $this->container['action'];
    }

    /**
     * Sets action
     *
     * @param string|null $action The action that caused this Event. New actions may be added in the future.
     *
     * @return self
     */
    public function setAction($action)
    {
        $allowedValues = $this->getActionAllowableValues();
        if (!is_null($action) && !in_array($action, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'action', must be one of '%s'",
                    $action,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['action'] = $action;

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
     * @param \DateTime|null $created When this Event was created.
     *
     * @return self
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets duration
     *
     * @return float|null
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param float|null $duration The total duration in seconds that it takes for the Event to complete.
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets entity
     *
     * @return \ZoneWatcher\LinodeApiV4\Model\EventEntity|null
     */
    public function getEntity()
    {
        return $this->container['entity'];
    }

    /**
     * Sets entity
     *
     * @param \ZoneWatcher\LinodeApiV4\Model\EventEntity|null $entity entity
     *
     * @return self
     */
    public function setEntity($entity)
    {
        $this->container['entity'] = $entity;

        return $this;
    }

    /**
     * Gets secondary_entity
     *
     * @return \ZoneWatcher\LinodeApiV4\Model\EventSecondaryEntity|null
     */
    public function getSecondaryEntity()
    {
        return $this->container['secondary_entity'];
    }

    /**
     * Sets secondary_entity
     *
     * @param \ZoneWatcher\LinodeApiV4\Model\EventSecondaryEntity|null $secondary_entity secondary_entity
     *
     * @return self
     */
    public function setSecondaryEntity($secondary_entity)
    {
        $this->container['secondary_entity'] = $secondary_entity;

        return $this;
    }

    /**
     * Gets percent_complete
     *
     * @return int|null
     */
    public function getPercentComplete()
    {
        return $this->container['percent_complete'];
    }

    /**
     * Sets percent_complete
     *
     * @param int|null $percent_complete A percentage estimating the amount of time remaining for an Event. Returns `null` for notification events.
     *
     * @return self
     */
    public function setPercentComplete($percent_complete)
    {
        $this->container['percent_complete'] = $percent_complete;

        return $this;
    }

    /**
     * Gets rate
     *
     * @return string|null
     */
    public function getRate()
    {
        return $this->container['rate'];
    }

    /**
     * Sets rate
     *
     * @param string|null $rate The rate of completion of the Event. Only some Events will return rate; for example, migration and resize Events.
     *
     * @return self
     */
    public function setRate($rate)
    {
        $this->container['rate'] = $rate;

        return $this;
    }

    /**
     * Gets read
     *
     * @return bool|null
     */
    public function getRead()
    {
        return $this->container['read'];
    }

    /**
     * Sets read
     *
     * @param bool|null $read If this Event has been read.
     *
     * @return self
     */
    public function setRead($read)
    {
        $this->container['read'] = $read;

        return $this;
    }

    /**
     * Gets seen
     *
     * @return bool|null
     */
    public function getSeen()
    {
        return $this->container['seen'];
    }

    /**
     * Sets seen
     *
     * @param bool|null $seen If this Event has been seen.
     *
     * @return self
     */
    public function setSeen($seen)
    {
        $this->container['seen'] = $seen;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status The current status of this Event.
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets time_remaining
     *
     * @return string|null
     */
    public function getTimeRemaining()
    {
        return $this->container['time_remaining'];
    }

    /**
     * Sets time_remaining
     *
     * @param string|null $time_remaining The estimated time remaining until the completion of this Event. This value is only returned for some in-progress migration events. For all other in-progress events, the `percent_complete` attribute will indicate about how much more work is to be done.
     *
     * @return self
     */
    public function setTimeRemaining($time_remaining)
    {
        $this->container['time_remaining'] = $time_remaining;

        return $this;
    }

    /**
     * Gets username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string|null $username The username of the User who caused the Event.
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string|null $message Provides additional information about the event. Additional information may include, but is not limited to, a more detailed representation of events which can help diagnose non-obvious failures.
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

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



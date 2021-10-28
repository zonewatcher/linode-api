# OpenAPI\Client\NodeBalancersApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createNodeBalancer()**](NodeBalancersApi.md#createNodeBalancer) | **POST** /nodebalancers | NodeBalancer Create
[**createNodeBalancerConfig()**](NodeBalancersApi.md#createNodeBalancerConfig) | **POST** /nodebalancers/{nodeBalancerId}/configs | Config Create
[**createNodeBalancerNode()**](NodeBalancersApi.md#createNodeBalancerNode) | **POST** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes | Node Create
[**deleteNodeBalancer()**](NodeBalancersApi.md#deleteNodeBalancer) | **DELETE** /nodebalancers/{nodeBalancerId} | NodeBalancer Delete
[**deleteNodeBalancerConfig()**](NodeBalancersApi.md#deleteNodeBalancerConfig) | **DELETE** /nodebalancers/{nodeBalancerId}/configs/{configId} | Config Delete
[**deleteNodeBalancerConfigNode()**](NodeBalancersApi.md#deleteNodeBalancerConfigNode) | **DELETE** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId} | Node Delete
[**getNodeBalancer()**](NodeBalancersApi.md#getNodeBalancer) | **GET** /nodebalancers/{nodeBalancerId} | NodeBalancer View
[**getNodeBalancerConfig()**](NodeBalancersApi.md#getNodeBalancerConfig) | **GET** /nodebalancers/{nodeBalancerId}/configs/{configId} | Config View
[**getNodeBalancerConfigNodes()**](NodeBalancersApi.md#getNodeBalancerConfigNodes) | **GET** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes | Nodes List
[**getNodeBalancerConfigs()**](NodeBalancersApi.md#getNodeBalancerConfigs) | **GET** /nodebalancers/{nodeBalancerId}/configs | Configs List
[**getNodeBalancerNode()**](NodeBalancersApi.md#getNodeBalancerNode) | **GET** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId} | Node View
[**getNodeBalancers()**](NodeBalancersApi.md#getNodeBalancers) | **GET** /nodebalancers | NodeBalancers List
[**nodebalancersNodeBalancerIdStatsGet()**](NodeBalancersApi.md#nodebalancersNodeBalancerIdStatsGet) | **GET** /nodebalancers/{nodeBalancerId}/stats | NodeBalancer Statistics View
[**rebuildNodeBalancerConfig()**](NodeBalancersApi.md#rebuildNodeBalancerConfig) | **POST** /nodebalancers/{nodeBalancerId}/configs/{configId}/rebuild | Config Rebuild
[**updateNodeBalancer()**](NodeBalancersApi.md#updateNodeBalancer) | **PUT** /nodebalancers/{nodeBalancerId} | NodeBalancer Update
[**updateNodeBalancerConfig()**](NodeBalancersApi.md#updateNodeBalancerConfig) | **PUT** /nodebalancers/{nodeBalancerId}/configs/{configId} | Config Update
[**updateNodeBalancerNode()**](NodeBalancersApi.md#updateNodeBalancerNode) | **PUT** /nodebalancers/{nodeBalancerId}/configs/{configId}/nodes/{nodeId} | Node Update


## `createNodeBalancer()`

```php
createNodeBalancer($unknown_base_type): \OpenAPI\Client\Model\NodeBalancer
```

NodeBalancer Create

Creates a NodeBalancer in the requested Region. This NodeBalancer will not start serving requests until it is configured.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the NodeBalancer to create.

try {
    $result = $apiInstance->createNodeBalancer($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->createNodeBalancer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the NodeBalancer to create. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancer**](../Model/NodeBalancer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createNodeBalancerConfig()`

```php
createNodeBalancerConfig($node_balancer_id, $node_balancer_config): \OpenAPI\Client\Model\NodeBalancerConfig
```

Config Create

Creates a NodeBalancer Config, which allows the NodeBalancer to accept traffic on a new port. You will need to add NodeBalancer Nodes to the new Config before it can actually serve requests.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$node_balancer_config = new \OpenAPI\Client\Model\NodeBalancerConfig(); // \OpenAPI\Client\Model\NodeBalancerConfig | Information about the port to configure.

try {
    $result = $apiInstance->createNodeBalancerConfig($node_balancer_id, $node_balancer_config);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->createNodeBalancerConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **node_balancer_config** | [**\OpenAPI\Client\Model\NodeBalancerConfig**](../Model/NodeBalancerConfig.md)| Information about the port to configure. | [optional]

### Return type

[**\OpenAPI\Client\Model\NodeBalancerConfig**](../Model/NodeBalancerConfig.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createNodeBalancerNode()`

```php
createNodeBalancerNode($node_balancer_id, $config_id, $unknown_base_type): \OpenAPI\Client\Model\NodeBalancerNode
```

Node Create

Creates a NodeBalancer Node, a backend that can accept traffic for this NodeBalancer Config. Nodes are routed requests on the configured port based on their status.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the NodeBalancer config to access.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the Node to create.

try {
    $result = $apiInstance->createNodeBalancerNode($node_balancer_id, $config_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->createNodeBalancerNode: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the NodeBalancer config to access. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the Node to create. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancerNode**](../Model/NodeBalancerNode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteNodeBalancer()`

```php
deleteNodeBalancer($node_balancer_id): object
```

NodeBalancer Delete

Deletes a NodeBalancer.  **This is a destructive action and cannot be undone.**  Deleting a NodeBalancer will also delete all associated Configs and Nodes, although the backend servers represented by the Nodes will not be changed or removed. Deleting a NodeBalancer will cause you to lose access to the IP Addresses assigned to this NodeBalancer.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.

try {
    $result = $apiInstance->deleteNodeBalancer($node_balancer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->deleteNodeBalancer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |

### Return type

**object**

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteNodeBalancerConfig()`

```php
deleteNodeBalancerConfig($node_balancer_id, $config_id): object
```

Config Delete

Deletes the Config for a port of this NodeBalancer.  **This cannot be undone.**  Once completed, this NodeBalancer will no longer respond to requests on the given port. This also deletes all associated NodeBalancerNodes, but the Linodes they were routing traffic to will be unchanged and will not be removed.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the config to access.

try {
    $result = $apiInstance->deleteNodeBalancerConfig($node_balancer_id, $config_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->deleteNodeBalancerConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the config to access. |

### Return type

**object**

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteNodeBalancerConfigNode()`

```php
deleteNodeBalancerConfigNode($node_balancer_id, $config_id, $node_id): object
```

Node Delete

Deletes a Node from this Config. This backend will no longer receive traffic for the configured port of this NodeBalancer.  This does not change or remove the Linode whose address was used in the creation of this Node.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the Config to access
$node_id = 56; // int | The ID of the Node to access

try {
    $result = $apiInstance->deleteNodeBalancerConfigNode($node_balancer_id, $config_id, $node_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->deleteNodeBalancerConfigNode: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the Config to access |
 **node_id** | **int**| The ID of the Node to access |

### Return type

**object**

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getNodeBalancer()`

```php
getNodeBalancer($node_balancer_id): \OpenAPI\Client\Model\NodeBalancer
```

NodeBalancer View

Returns a single NodeBalancer you can access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.

try {
    $result = $apiInstance->getNodeBalancer($node_balancer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->getNodeBalancer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancer**](../Model/NodeBalancer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getNodeBalancerConfig()`

```php
getNodeBalancerConfig($node_balancer_id, $config_id): \OpenAPI\Client\Model\NodeBalancerConfig
```

Config View

Returns configuration information for a single port of this NodeBalancer.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the config to access.

try {
    $result = $apiInstance->getNodeBalancerConfig($node_balancer_id, $config_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->getNodeBalancerConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the config to access. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancerConfig**](../Model/NodeBalancerConfig.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getNodeBalancerConfigNodes()`

```php
getNodeBalancerConfigNodes($node_balancer_id, $config_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20048
```

Nodes List

Returns a paginated list of NodeBalancer nodes associated with this Config. These are the backends that will be sent traffic for this port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the NodeBalancer config to access.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getNodeBalancerConfigNodes($node_balancer_id, $config_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->getNodeBalancerConfigNodes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the NodeBalancer config to access. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20048**](../Model/InlineResponse20048.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getNodeBalancerConfigs()`

```php
getNodeBalancerConfigs($node_balancer_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20047
```

Configs List

Returns a paginated list of NodeBalancer Configs associated with this NodeBalancer. NodeBalancer Configs represent individual ports that this NodeBalancer will accept traffic on, one Config per port.  For example, if you wanted to accept standard HTTP traffic, you would need a Config listening on port 80.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getNodeBalancerConfigs($node_balancer_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->getNodeBalancerConfigs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20047**](../Model/InlineResponse20047.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getNodeBalancerNode()`

```php
getNodeBalancerNode($node_balancer_id, $config_id, $node_id): \OpenAPI\Client\Model\NodeBalancerNode
```

Node View

Returns information about a single Node, a backend for this NodeBalancer's configured port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the Config to access
$node_id = 56; // int | The ID of the Node to access

try {
    $result = $apiInstance->getNodeBalancerNode($node_balancer_id, $config_id, $node_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->getNodeBalancerNode: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the Config to access |
 **node_id** | **int**| The ID of the Node to access |

### Return type

[**\OpenAPI\Client\Model\NodeBalancerNode**](../Model/NodeBalancerNode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getNodeBalancers()`

```php
getNodeBalancers($page, $page_size): \OpenAPI\Client\Model\InlineResponse20023
```

NodeBalancers List

Returns a paginated list of NodeBalancers you have access to.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getNodeBalancers($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->getNodeBalancers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20023**](../Model/InlineResponse20023.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `nodebalancersNodeBalancerIdStatsGet()`

```php
nodebalancersNodeBalancerIdStatsGet($node_balancer_id): \OpenAPI\Client\Model\NodeBalancerStats
```

NodeBalancer Statistics View

Returns detailed statistics about the requested NodeBalancer.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.

try {
    $result = $apiInstance->nodebalancersNodeBalancerIdStatsGet($node_balancer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->nodebalancersNodeBalancerIdStatsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancerStats**](../Model/NodeBalancerStats.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rebuildNodeBalancerConfig()`

```php
rebuildNodeBalancerConfig($node_balancer_id, $config_id, $unknown_base_type): \OpenAPI\Client\Model\NodeBalancer
```

Config Rebuild

Rebuilds a NodeBalancer Config and its Nodes that you have permission to modify.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the Config to access.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the NodeBalancer Config to rebuild.

try {
    $result = $apiInstance->rebuildNodeBalancerConfig($node_balancer_id, $config_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->rebuildNodeBalancerConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the Config to access. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the NodeBalancer Config to rebuild. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancer**](../Model/NodeBalancer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateNodeBalancer()`

```php
updateNodeBalancer($node_balancer_id, $node_balancer): \OpenAPI\Client\Model\NodeBalancer
```

NodeBalancer Update

Updates information about a NodeBalancer you can access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$node_balancer = new \OpenAPI\Client\Model\NodeBalancer(); // \OpenAPI\Client\Model\NodeBalancer | The information to update.

try {
    $result = $apiInstance->updateNodeBalancer($node_balancer_id, $node_balancer);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->updateNodeBalancer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **node_balancer** | [**\OpenAPI\Client\Model\NodeBalancer**](../Model/NodeBalancer.md)| The information to update. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancer**](../Model/NodeBalancer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateNodeBalancerConfig()`

```php
updateNodeBalancerConfig($node_balancer_id, $config_id, $node_balancer_config): \OpenAPI\Client\Model\NodeBalancerConfig
```

Config Update

Updates the configuration for a single port on a NodeBalancer.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the config to access.
$node_balancer_config = new \OpenAPI\Client\Model\NodeBalancerConfig(); // \OpenAPI\Client\Model\NodeBalancerConfig | The fields to update.

try {
    $result = $apiInstance->updateNodeBalancerConfig($node_balancer_id, $config_id, $node_balancer_config);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->updateNodeBalancerConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the config to access. |
 **node_balancer_config** | [**\OpenAPI\Client\Model\NodeBalancerConfig**](../Model/NodeBalancerConfig.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancerConfig**](../Model/NodeBalancerConfig.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateNodeBalancerNode()`

```php
updateNodeBalancerNode($node_balancer_id, $config_id, $node_id, $node_balancer_node): \OpenAPI\Client\Model\NodeBalancerNode
```

Node Update

Updates information about a Node, a backend for this NodeBalancer's configured port.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NodeBalancersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$node_balancer_id = 56; // int | The ID of the NodeBalancer to access.
$config_id = 56; // int | The ID of the Config to access
$node_id = 56; // int | The ID of the Node to access
$node_balancer_node = new \OpenAPI\Client\Model\NodeBalancerNode(); // \OpenAPI\Client\Model\NodeBalancerNode | The fields to update.

try {
    $result = $apiInstance->updateNodeBalancerNode($node_balancer_id, $config_id, $node_id, $node_balancer_node);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NodeBalancersApi->updateNodeBalancerNode: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **node_balancer_id** | **int**| The ID of the NodeBalancer to access. |
 **config_id** | **int**| The ID of the Config to access |
 **node_id** | **int**| The ID of the Node to access |
 **node_balancer_node** | [**\OpenAPI\Client\Model\NodeBalancerNode**](../Model/NodeBalancerNode.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\NodeBalancerNode**](../Model/NodeBalancerNode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

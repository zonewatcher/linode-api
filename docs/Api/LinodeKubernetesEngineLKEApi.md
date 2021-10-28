# OpenAPI\Client\LinodeKubernetesEngineLKEApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createLKECluster()**](LinodeKubernetesEngineLKEApi.md#createLKECluster) | **POST** /lke/clusters | Kubernetes Cluster Create
[**deleteLKECluster()**](LinodeKubernetesEngineLKEApi.md#deleteLKECluster) | **DELETE** /lke/clusters/{clusterId} | Kubernetes Cluster Delete
[**deleteLKEClusterKubeconfig()**](LinodeKubernetesEngineLKEApi.md#deleteLKEClusterKubeconfig) | **DELETE** /lke/clusters/{clusterId}/kubeconfig | Kubeconfig Delete
[**deleteLKEClusterNode()**](LinodeKubernetesEngineLKEApi.md#deleteLKEClusterNode) | **DELETE** /lke/clusters/{clusterId}/nodes/{nodeId} | Node Delete
[**deleteLKENodePool()**](LinodeKubernetesEngineLKEApi.md#deleteLKENodePool) | **DELETE** /lke/clusters/{clusterId}/pools/{poolId} | Node Pool Delete
[**getLKECluster()**](LinodeKubernetesEngineLKEApi.md#getLKECluster) | **GET** /lke/clusters/{clusterId} | Kubernetes Cluster View
[**getLKEClusterAPIEndpoints()**](LinodeKubernetesEngineLKEApi.md#getLKEClusterAPIEndpoints) | **GET** /lke/clusters/{clusterId}/api-endpoints | Kubernetes API Endpoints List
[**getLKEClusterKubeconfig()**](LinodeKubernetesEngineLKEApi.md#getLKEClusterKubeconfig) | **GET** /lke/clusters/{clusterId}/kubeconfig | Kubeconfig View
[**getLKEClusterNode()**](LinodeKubernetesEngineLKEApi.md#getLKEClusterNode) | **GET** /lke/clusters/{clusterId}/nodes/{nodeId} | Node View
[**getLKEClusterPools()**](LinodeKubernetesEngineLKEApi.md#getLKEClusterPools) | **GET** /lke/clusters/{clusterId}/pools | Node Pools List
[**getLKEClusters()**](LinodeKubernetesEngineLKEApi.md#getLKEClusters) | **GET** /lke/clusters | Kubernetes Clusters List
[**getLKENodePool()**](LinodeKubernetesEngineLKEApi.md#getLKENodePool) | **GET** /lke/clusters/{clusterId}/pools/{poolId} | Node Pool View
[**getLKEVersion()**](LinodeKubernetesEngineLKEApi.md#getLKEVersion) | **GET** /lke/versions/{version} | Kubernetes Version View
[**getLKEVersions()**](LinodeKubernetesEngineLKEApi.md#getLKEVersions) | **GET** /lke/versions | Kubernetes Versions List
[**postLKEClusterNodeRecycle()**](LinodeKubernetesEngineLKEApi.md#postLKEClusterNodeRecycle) | **POST** /lke/clusters/{clusterId}/nodes/{nodeId}/recycle | Node Recycle
[**postLKEClusterPoolRecycle()**](LinodeKubernetesEngineLKEApi.md#postLKEClusterPoolRecycle) | **POST** /lke/clusters/{clusterId}/pools/{poolId}/recycle | Node Pool Recycle
[**postLKEClusterPools()**](LinodeKubernetesEngineLKEApi.md#postLKEClusterPools) | **POST** /lke/clusters/{clusterId}/pools | Node Pool Create
[**postLKEClusterRecycle()**](LinodeKubernetesEngineLKEApi.md#postLKEClusterRecycle) | **POST** /lke/clusters/{clusterId}/recycle | Cluster Nodes Recycle
[**putLKECluster()**](LinodeKubernetesEngineLKEApi.md#putLKECluster) | **PUT** /lke/clusters/{clusterId} | Kubernetes Cluster Update
[**putLKENodePool()**](LinodeKubernetesEngineLKEApi.md#putLKENodePool) | **PUT** /lke/clusters/{clusterId}/pools/{poolId} | Node Pool Update


## `createLKECluster()`

```php
createLKECluster($inline_object13): \OpenAPI\Client\Model\LKECluster
```

Kubernetes Cluster Create

Creates a Kubernetes cluster. The Kubernetes cluster will be created asynchronously. You can use the events system to determine when the Kubernetes cluster is ready to use. Please note that it often takes 2-5 minutes before the [Kubernetes API server endpoint](/docs/api/linode-kubernetes-engine-lke/#kubernetes-api-endpoints-list) and the [Kubeconfig file](/docs/api/linode-kubernetes-engine-lke/#kubeconfig-view) for the new cluster are ready.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object13 = new \OpenAPI\Client\Model\InlineObject13(); // \OpenAPI\Client\Model\InlineObject13

try {
    $result = $apiInstance->createLKECluster($inline_object13);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->createLKECluster: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object13** | [**\OpenAPI\Client\Model\InlineObject13**](../Model/InlineObject13.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\LKECluster**](../Model/LKECluster.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteLKECluster()`

```php
deleteLKECluster($cluster_id): object
```

Kubernetes Cluster Delete

Deletes a Cluster you have permission to `read_write`.  **Deleting a Cluster is a destructive action and cannot be undone.**  Deleting a Cluster:   - Deletes all Linodes in all pools within this Kubernetes cluster   - Deletes all supporting Kubernetes services for this Kubernetes     cluster (API server, etcd, etc)   - Deletes all NodeBalancers created by this Kubernetes cluster   - Does not delete any of the volumes created by this Kubernetes     cluster

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.

try {
    $result = $apiInstance->deleteLKECluster($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->deleteLKECluster: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |

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

## `deleteLKEClusterKubeconfig()`

```php
deleteLKEClusterKubeconfig($cluster_id): object
```

Kubeconfig Delete

Delete and regenerate the Kubeconfig file for a Cluster.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.

try {
    $result = $apiInstance->deleteLKEClusterKubeconfig($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->deleteLKEClusterKubeconfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |

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

## `deleteLKEClusterNode()`

```php
deleteLKEClusterNode($cluster_id, $node_id): object
```

Node Delete

Deletes a specific Node from a Node Pool.  **Deleting a Node is a destructive action and cannot be undone.**  Deleting a Node will reduce the size of the Node Pool it belongs to.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster containing the Node.
$node_id = 'node_id_example'; // string | ID of the Node to look up.

try {
    $result = $apiInstance->deleteLKEClusterNode($cluster_id, $node_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->deleteLKEClusterNode: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster containing the Node. |
 **node_id** | **string**| ID of the Node to look up. |

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

## `deleteLKENodePool()`

```php
deleteLKENodePool($cluster_id, $pool_id): object
```

Node Pool Delete

Delete a specific Node Pool from a Kubernetes cluster.  **Deleting a Node Pool is a destructive action and cannot be undone.**  Deleting a Node Pool will delete all Linodes within that Pool.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.
$pool_id = 56; // int | ID of the Pool to look up

try {
    $result = $apiInstance->deleteLKENodePool($cluster_id, $pool_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->deleteLKENodePool: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |
 **pool_id** | **int**| ID of the Pool to look up |

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

## `getLKECluster()`

```php
getLKECluster($cluster_id): \OpenAPI\Client\Model\LKECluster
```

Kubernetes Cluster View

Get a specific Cluster by ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.

try {
    $result = $apiInstance->getLKECluster($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKECluster: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |

### Return type

[**\OpenAPI\Client\Model\LKECluster**](../Model/LKECluster.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKEClusterAPIEndpoints()`

```php
getLKEClusterAPIEndpoints($cluster_id): \OpenAPI\Client\Model\InlineResponse20030
```

Kubernetes API Endpoints List

List the Kubernetes API server endpoints for this cluster. Please note that it often takes 2-5 minutes before the endpoint is ready after first [creating a new cluster](/docs/api/linode-kubernetes-engine-lke/#kubernetes-cluster-create).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.

try {
    $result = $apiInstance->getLKEClusterAPIEndpoints($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKEClusterAPIEndpoints: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20030**](../Model/InlineResponse20030.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKEClusterKubeconfig()`

```php
getLKEClusterKubeconfig($cluster_id): \OpenAPI\Client\Model\InlineResponse20031
```

Kubeconfig View

Get the Kubeconfig file for a Cluster. Please note that it often takes 2-5 minutes before the Kubeconfig file is ready after first [creating a new cluster](/docs/api/linode-kubernetes-engine-lke/#kubernetes-cluster-create).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.

try {
    $result = $apiInstance->getLKEClusterKubeconfig($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKEClusterKubeconfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20031**](../Model/InlineResponse20031.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKEClusterNode()`

```php
getLKEClusterNode($cluster_id, $node_id): \OpenAPI\Client\Model\InlineResponse20029
```

Node View

Returns the values for a specified node object.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster containing the Node.
$node_id = 'node_id_example'; // string | ID of the Node to look up.

try {
    $result = $apiInstance->getLKEClusterNode($cluster_id, $node_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKEClusterNode: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster containing the Node. |
 **node_id** | **string**| ID of the Node to look up. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20029**](../Model/InlineResponse20029.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKEClusterPools()`

```php
getLKEClusterPools($cluster_id): \OpenAPI\Client\Model\InlineResponse20028
```

Node Pools List

Returns all active Node Pools on a Kubernetes cluster.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.

try {
    $result = $apiInstance->getLKEClusterPools($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKEClusterPools: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20028**](../Model/InlineResponse20028.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKEClusters()`

```php
getLKEClusters(): \OpenAPI\Client\Model\InlineResponse20027
```

Kubernetes Clusters List

Lists current Kubernetes clusters available on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getLKEClusters();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKEClusters: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20027**](../Model/InlineResponse20027.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKENodePool()`

```php
getLKENodePool($cluster_id, $pool_id): \OpenAPI\Client\Model\LKENodePool
```

Node Pool View

Get a specific Node Pool by ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.
$pool_id = 56; // int | ID of the Pool to look up

try {
    $result = $apiInstance->getLKENodePool($cluster_id, $pool_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKENodePool: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |
 **pool_id** | **int**| ID of the Pool to look up |

### Return type

[**\OpenAPI\Client\Model\LKENodePool**](../Model/LKENodePool.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKEVersion()`

```php
getLKEVersion($version): \OpenAPI\Client\Model\LKEVersion
```

Kubernetes Version View

View a Kubernetes version available for deployment to a Kubernetes cluster.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$version = 'version_example'; // string | The LKE version to view.

try {
    $result = $apiInstance->getLKEVersion($version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKEVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **version** | **string**| The LKE version to view. |

### Return type

[**\OpenAPI\Client\Model\LKEVersion**](../Model/LKEVersion.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLKEVersions()`

```php
getLKEVersions(): \OpenAPI\Client\Model\InlineResponse20032
```

Kubernetes Versions List

List the Kubernetes versions available for deployment to a Kubernetes cluster.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getLKEVersions();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->getLKEVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20032**](../Model/InlineResponse20032.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `postLKEClusterNodeRecycle()`

```php
postLKEClusterNodeRecycle($cluster_id, $node_id): object
```

Node Recycle

Recycles an individual Node in the designated Kubernetes Cluster. The Node will be deleted and replaced with a new Linode, which may take a few minutes. Replacement Nodes are installed with the latest available patch for the Cluster's Kubernetes Version.  **Any local storage on deleted Linodes (such as \"hostPath\" and \"emptyDir\" volumes, or \"local\" PersistentVolumes) will be erased.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster containing the Node.
$node_id = 'node_id_example'; // string | ID of the Node to be recycled.

try {
    $result = $apiInstance->postLKEClusterNodeRecycle($cluster_id, $node_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->postLKEClusterNodeRecycle: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster containing the Node. |
 **node_id** | **string**| ID of the Node to be recycled. |

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

## `postLKEClusterPoolRecycle()`

```php
postLKEClusterPoolRecycle($cluster_id, $pool_id): object
```

Node Pool Recycle

Recycles a Node Pool for the designated Kubernetes Cluster. All Linodes within the Node Pool will be deleted and replaced with new Linodes on a rolling basis, which may take several minutes. Replacement Nodes are installed with the latest available patch for the Cluster's Kubernetes Version.  **Any local storage on deleted Linodes (such as \"hostPath\" and \"emptyDir\" volumes, or \"local\" PersistentVolumes) will be erased.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster this Node Pool is attached to.
$pool_id = 56; // int | ID of the Node Pool to be recycled.

try {
    $result = $apiInstance->postLKEClusterPoolRecycle($cluster_id, $pool_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->postLKEClusterPoolRecycle: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster this Node Pool is attached to. |
 **pool_id** | **int**| ID of the Node Pool to be recycled. |

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

## `postLKEClusterPools()`

```php
postLKEClusterPools($cluster_id, $unknown_base_type): \OpenAPI\Client\Model\LKENodePool
```

Node Pool Create

Creates a new Node Pool for the designated Kubernetes cluster.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.
$unknown_base_type = array('key' => new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE()); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Configuration for the Node Pool

try {
    $result = $apiInstance->postLKEClusterPools($cluster_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->postLKEClusterPools: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Configuration for the Node Pool |

### Return type

[**\OpenAPI\Client\Model\LKENodePool**](../Model/LKENodePool.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `postLKEClusterRecycle()`

```php
postLKEClusterRecycle($cluster_id): object
```

Cluster Nodes Recycle

Recycles all nodes in all pools of a designated Kubernetes Cluster. All Linodes within the Cluster will be deleted and replaced with new Linodes on a rolling basis, which may take several minutes. Replacement Nodes are installed with the latest available [patch version](https://github.com/kubernetes/community/blob/master/contributors/design-proposals/release/versioning.md#kubernetes-release-versioning) for the Cluster's current Kubernetes minor release.  **Any local storage on deleted Linodes (such as \"hostPath\" and \"emptyDir\" volumes, or \"local\" PersistentVolumes) will be erased.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster which contains nodes to be recycled.

try {
    $result = $apiInstance->postLKEClusterRecycle($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->postLKEClusterRecycle: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster which contains nodes to be recycled. |

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

## `putLKECluster()`

```php
putLKECluster($cluster_id, $unknown_base_type): object
```

Kubernetes Cluster Update

Updates a Kubernetes cluster.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The fields to update the Kubernetes cluster.

try {
    $result = $apiInstance->putLKECluster($cluster_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->putLKECluster: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The fields to update the Kubernetes cluster. | [optional]

### Return type

**object**

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `putLKENodePool()`

```php
putLKENodePool($cluster_id, $pool_id, $unknown_base_type): \OpenAPI\Client\Model\LKENodePool
```

Node Pool Update

Updates a Node Pool's count.  Linodes will be created or deleted to match changes to the Node Pool's count.  **Any local storage on deleted Linodes (such as \"hostPath\" and \"emptyDir\" volumes, or \"local\" PersistentVolumes) will be erased.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeKubernetesEngineLKEApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 56; // int | ID of the Kubernetes cluster to look up.
$pool_id = 56; // int | ID of the Pool to look up
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The fields to update

try {
    $result = $apiInstance->putLKENodePool($cluster_id, $pool_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeKubernetesEngineLKEApi->putLKENodePool: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **int**| ID of the Kubernetes cluster to look up. |
 **pool_id** | **int**| ID of the Pool to look up |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The fields to update | [optional]

### Return type

[**\OpenAPI\Client\Model\LKENodePool**](../Model/LKENodePool.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

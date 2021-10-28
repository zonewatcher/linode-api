# OpenAPI\Client\ObjectStorageApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelObjectStorage()**](ObjectStorageApi.md#cancelObjectStorage) | **POST** /object-storage/cancel | Object Storage Cancel
[**createObjectStorageBucket()**](ObjectStorageApi.md#createObjectStorageBucket) | **POST** /object-storage/buckets | Object Storage Bucket Create
[**createObjectStorageKeys()**](ObjectStorageApi.md#createObjectStorageKeys) | **POST** /object-storage/keys | Object Storage Key Create
[**createObjectStorageObjectURL()**](ObjectStorageApi.md#createObjectStorageObjectURL) | **POST** /object-storage/buckets/{clusterId}/{bucket}/object-url | Object Storage Object URL Create
[**createObjectStorageSSL()**](ObjectStorageApi.md#createObjectStorageSSL) | **POST** /object-storage/buckets/{clusterId}/{bucket}/ssl | Object Storage TLS/SSL Cert Upload
[**deleteObjectStorageBucket()**](ObjectStorageApi.md#deleteObjectStorageBucket) | **DELETE** /object-storage/buckets/{clusterId}/{bucket} | Object Storage Bucket Remove
[**deleteObjectStorageKey()**](ObjectStorageApi.md#deleteObjectStorageKey) | **DELETE** /object-storage/keys/{keyId} | Object Storage Key Revoke
[**deleteObjectStorageSSL()**](ObjectStorageApi.md#deleteObjectStorageSSL) | **DELETE** /object-storage/buckets/{clusterId}/{bucket}/ssl | Object Storage TLS/SSL Cert Delete
[**getObjectStorageBucket()**](ObjectStorageApi.md#getObjectStorageBucket) | **GET** /object-storage/buckets/{clusterId}/{bucket} | Object Storage Bucket View
[**getObjectStorageBucketContent()**](ObjectStorageApi.md#getObjectStorageBucketContent) | **GET** /object-storage/buckets/{clusterId}/{bucket}/object-list | Object Storage Bucket Contents List
[**getObjectStorageBucketinCluster()**](ObjectStorageApi.md#getObjectStorageBucketinCluster) | **GET** /object-storage/buckets/{clusterId} | Object Storage Buckets in Cluster List
[**getObjectStorageBuckets()**](ObjectStorageApi.md#getObjectStorageBuckets) | **GET** /object-storage/buckets | Object Storage Buckets List
[**getObjectStorageCluster()**](ObjectStorageApi.md#getObjectStorageCluster) | **GET** /object-storage/clusters/{clusterId} | Cluster View
[**getObjectStorageClusters()**](ObjectStorageApi.md#getObjectStorageClusters) | **GET** /object-storage/clusters | Clusters List
[**getObjectStorageKey()**](ObjectStorageApi.md#getObjectStorageKey) | **GET** /object-storage/keys/{keyId} | Object Storage Key View
[**getObjectStorageKeys()**](ObjectStorageApi.md#getObjectStorageKeys) | **GET** /object-storage/keys | Object Storage Keys List
[**getObjectStorageSSL()**](ObjectStorageApi.md#getObjectStorageSSL) | **GET** /object-storage/buckets/{clusterId}/{bucket}/ssl | Object Storage TLS/SSL Cert View
[**getObjectStorageTransfer()**](ObjectStorageApi.md#getObjectStorageTransfer) | **GET** /object-storage/transfer | Object Storage Transfer View
[**modifyObjectStorageBucketAccess()**](ObjectStorageApi.md#modifyObjectStorageBucketAccess) | **POST** /object-storage/buckets/{clusterId}/{bucket}/access | Object Storage Bucket Access Modify
[**updateObjectStorageBucketACL()**](ObjectStorageApi.md#updateObjectStorageBucketACL) | **PUT** /object-storage/buckets/{clusterId}/{bucket}/object-acl | Object Storage Object ACL Config Update
[**updateObjectStorageBucketAccess()**](ObjectStorageApi.md#updateObjectStorageBucketAccess) | **PUT** /object-storage/buckets/{clusterId}/{bucket}/access | Object Storage Bucket Access Update
[**updateObjectStorageKey()**](ObjectStorageApi.md#updateObjectStorageKey) | **PUT** /object-storage/keys/{keyId} | Object Storage Key Update
[**viewObjectStorageBucketACL()**](ObjectStorageApi.md#viewObjectStorageBucketACL) | **GET** /object-storage/buckets/{clusterId}/{bucket}/object-acl | Object Storage Object ACL Config View


## `cancelObjectStorage()`

```php
cancelObjectStorage(): object
```

Object Storage Cancel

Cancel Object Storage on an Account. All buckets on the Account must be empty before Object Storage can be cancelled:  - To delete a smaller number of objects, review the instructions in our [How to Use Object Storage](/docs/platform/object-storage/how-to-use-object-storage/) guide. - To delete large amounts of objects, consult our guide on [Lifecycle Policies](/docs/platform/object-storage/lifecycle-policies/).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->cancelObjectStorage();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->cancelObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

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

## `createObjectStorageBucket()`

```php
createObjectStorageBucket($inline_object15): \OpenAPI\Client\Model\ObjectStorageBucket
```

Object Storage Bucket Create

Creates an Object Storage Bucket in the cluster specified. If the bucket already exists and is owned by you, this endpoint will return a `200` response with that bucket as if it had just been created.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/bucketops/#put-bucket) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object15 = new \OpenAPI\Client\Model\InlineObject15(); // \OpenAPI\Client\Model\InlineObject15

try {
    $result = $apiInstance->createObjectStorageBucket($inline_object15);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->createObjectStorageBucket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object15** | [**\OpenAPI\Client\Model\InlineObject15**](../Model/InlineObject15.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\ObjectStorageBucket**](../Model/ObjectStorageBucket.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createObjectStorageKeys()`

```php
createObjectStorageKeys($object_storage_key): \OpenAPI\Client\Model\ObjectStorageKey
```

Object Storage Key Create

Provisions a new Object Storage Key on your account.  * To create a Limited Access Key with specific permissions, send a `bucket_access` array.  * To create a Limited Access Key without access to any buckets, send an empty `bucket_access` array.  * To create an Access Key with unlimited access to all clusters and all buckets, omit the `bucket_access` array.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$object_storage_key = new \OpenAPI\Client\Model\ObjectStorageKey(); // \OpenAPI\Client\Model\ObjectStorageKey | The label of the key to create. This is used to identify the created key.

try {
    $result = $apiInstance->createObjectStorageKeys($object_storage_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->createObjectStorageKeys: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **object_storage_key** | [**\OpenAPI\Client\Model\ObjectStorageKey**](../Model/ObjectStorageKey.md)| The label of the key to create. This is used to identify the created key. | [optional]

### Return type

[**\OpenAPI\Client\Model\ObjectStorageKey**](../Model/ObjectStorageKey.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createObjectStorageObjectURL()`

```php
createObjectStorageObjectURL($cluster_id, $bucket, $unknown_base_type): object
```

Object Storage Object URL Create

Creates a pre-signed URL to access a single Object in a bucket. This can be used to share objects, and also to create/delete objects by using the appropriate HTTP method in your request body's `method` parameter.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the request to sign.

try {
    $result = $apiInstance->createObjectStorageObjectURL($cluster_id, $bucket, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->createObjectStorageObjectURL: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the request to sign. | [optional]

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

## `createObjectStorageSSL()`

```php
createObjectStorageSSL($cluster_id, $bucket, $object_storage_ssl): \OpenAPI\Client\Model\ObjectStorageSSLResponse
```

Object Storage TLS/SSL Cert Upload

Upload a TLS/SSL certificate and private key to be served when you visit your Object Storage bucket via HTTPS. Your TLS/SSL certificate and private key are stored encrypted at rest.   To replace an expired certificate, [delete your current certificate](/docs/api/object-storage/#object-storage-tlsssl-cert-delete) and upload a new one.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.
$object_storage_ssl = new \OpenAPI\Client\Model\ObjectStorageSSL(); // \OpenAPI\Client\Model\ObjectStorageSSL | Upload this TLS/SSL certificate with its corresponding secret key.

try {
    $result = $apiInstance->createObjectStorageSSL($cluster_id, $bucket, $object_storage_ssl);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->createObjectStorageSSL: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |
 **object_storage_ssl** | [**\OpenAPI\Client\Model\ObjectStorageSSL**](../Model/ObjectStorageSSL.md)| Upload this TLS/SSL certificate with its corresponding secret key. | [optional]

### Return type

[**\OpenAPI\Client\Model\ObjectStorageSSLResponse**](../Model/ObjectStorageSSLResponse.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteObjectStorageBucket()`

```php
deleteObjectStorageBucket($cluster_id, $bucket): object
```

Object Storage Bucket Remove

Removes a single bucket. While buckets containing objects _may_ be deleted by including the `force` option in the request, such operations will fail if the bucket contains too many objects. The recommended way to empty large buckets is to use the [S3 API to configure lifecycle policies](https://docs.ceph.com/en/latest/radosgw/bucketpolicy/#) that remove all objects, then delete the bucket.  This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/bucketops/#delete-bucket) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.

try {
    $result = $apiInstance->deleteObjectStorageBucket($cluster_id, $bucket);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->deleteObjectStorageBucket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |

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

## `deleteObjectStorageKey()`

```php
deleteObjectStorageKey($key_id): object
```

Object Storage Key Revoke

Revokes an Object Storage Key.  This keypair will no longer be usable by third-party clients.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$key_id = 56; // int | The key to look up.

try {
    $result = $apiInstance->deleteObjectStorageKey($key_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->deleteObjectStorageKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **key_id** | **int**| The key to look up. |

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

## `deleteObjectStorageSSL()`

```php
deleteObjectStorageSSL($cluster_id, $bucket): object
```

Object Storage TLS/SSL Cert Delete

Deletes this Object Storage bucket's user uploaded TLS/SSL certificate and private key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.

try {
    $result = $apiInstance->deleteObjectStorageSSL($cluster_id, $bucket);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->deleteObjectStorageSSL: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |

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

## `getObjectStorageBucket()`

```php
getObjectStorageBucket($cluster_id, $bucket): \OpenAPI\Client\Model\ObjectStorageBucket
```

Object Storage Bucket View

Returns a single Object Storage Bucket.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/bucketops/#get-bucket) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.

try {
    $result = $apiInstance->getObjectStorageBucket($cluster_id, $bucket);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageBucket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |

### Return type

[**\OpenAPI\Client\Model\ObjectStorageBucket**](../Model/ObjectStorageBucket.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageBucketContent()`

```php
getObjectStorageBucketContent($cluster_id, $bucket, $marker, $delimiter, $prefix, $page_size): object
```

Object Storage Bucket Contents List

Returns the contents of a bucket. The contents are paginated using a `marker`, which is the name of the last object on the previous page.  Objects may be filtered by `prefix` and `delimiter` as well; see Query Parameters for more information.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/objectops/#get-object) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.
$marker = 'marker_example'; // string | The \"marker\" for this request, which can be used to paginate through large buckets. Its value should be the value of the `next_marker` property returned with the last page. Listing bucket contents *does not* support arbitrary page access. See the `next_marker` property in the responses section for more details.
$delimiter = 'delimiter_example'; // string | The delimiter for object names; if given, object names will be returned up to the first occurrence of this character. This is most commonly used with the `/` character to allow bucket transversal in a manner similar to a filesystem, however any delimiter may be used. Use in conjunction with `prefix` to see object names past the first occurrence of the delimiter.
$prefix = 'prefix_example'; // string | Filters objects returned to only those whose name start with the given prefix. Commonly used in conjunction with `delimiter` to allow transversal of bucket contents in a manner similar to a filesystem.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getObjectStorageBucketContent($cluster_id, $bucket, $marker, $delimiter, $prefix, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageBucketContent: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |
 **marker** | **string**| The \&quot;marker\&quot; for this request, which can be used to paginate through large buckets. Its value should be the value of the &#x60;next_marker&#x60; property returned with the last page. Listing bucket contents *does not* support arbitrary page access. See the &#x60;next_marker&#x60; property in the responses section for more details. | [optional]
 **delimiter** | **string**| The delimiter for object names; if given, object names will be returned up to the first occurrence of this character. This is most commonly used with the &#x60;/&#x60; character to allow bucket transversal in a manner similar to a filesystem, however any delimiter may be used. Use in conjunction with &#x60;prefix&#x60; to see object names past the first occurrence of the delimiter. | [optional]
 **prefix** | **string**| Filters objects returned to only those whose name start with the given prefix. Commonly used in conjunction with &#x60;delimiter&#x60; to allow transversal of bucket contents in a manner similar to a filesystem. | [optional]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

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

## `getObjectStorageBucketinCluster()`

```php
getObjectStorageBucketinCluster($cluster_id): \OpenAPI\Client\Model\InlineResponse20049
```

Object Storage Buckets in Cluster List

Returns a list of Buckets in this cluster belonging to this Account.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/bucketops/#get-bucket) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.

try {
    $result = $apiInstance->getObjectStorageBucketinCluster($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageBucketinCluster: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20049**](../Model/InlineResponse20049.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageBuckets()`

```php
getObjectStorageBuckets(): \OpenAPI\Client\Model\InlineResponse20049
```

Object Storage Buckets List

Returns a paginated list of all Object Storage Buckets that you own.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/serviceops/#list-buckets) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getObjectStorageBuckets();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageBuckets: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20049**](../Model/InlineResponse20049.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageCluster()`

```php
getObjectStorageCluster($cluster_id): \OpenAPI\Client\Model\ObjectStorageCluster
```

Cluster View

Returns a single Object Storage Cluster.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$cluster_id = 'cluster_id_example'; // string | The ID of the Cluster.

try {
    $result = $apiInstance->getObjectStorageCluster($cluster_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageCluster: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the Cluster. |

### Return type

[**\OpenAPI\Client\Model\ObjectStorageCluster**](../Model/ObjectStorageCluster.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageClusters()`

```php
getObjectStorageClusters(): \OpenAPI\Client\Model\InlineResponse20051
```

Clusters List

Returns a paginated list of Object Storage Clusters that are available for use.  Users can connect to the clusters with third party clients to create buckets and upload objects.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getObjectStorageClusters();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageClusters: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20051**](../Model/InlineResponse20051.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageKey()`

```php
getObjectStorageKey($key_id): \OpenAPI\Client\Model\ObjectStorageKey
```

Object Storage Key View

Returns a single Object Storage Key provisioned for your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$key_id = 56; // int | The key to look up.

try {
    $result = $apiInstance->getObjectStorageKey($key_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **key_id** | **int**| The key to look up. |

### Return type

[**\OpenAPI\Client\Model\ObjectStorageKey**](../Model/ObjectStorageKey.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageKeys()`

```php
getObjectStorageKeys(): \OpenAPI\Client\Model\InlineResponse20052
```

Object Storage Keys List

Returns a paginated list of Object Storage Keys for authenticating to the Object Storage S3 API.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getObjectStorageKeys();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageKeys: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20052**](../Model/InlineResponse20052.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageSSL()`

```php
getObjectStorageSSL($cluster_id, $bucket): \OpenAPI\Client\Model\ObjectStorageSSLResponse
```

Object Storage TLS/SSL Cert View

Returns a boolean value indicating if this bucket has a corresponding TLS/SSL certificate that was uploaded by an Account user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.

try {
    $result = $apiInstance->getObjectStorageSSL($cluster_id, $bucket);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageSSL: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |

### Return type

[**\OpenAPI\Client\Model\ObjectStorageSSLResponse**](../Model/ObjectStorageSSLResponse.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageTransfer()`

```php
getObjectStorageTransfer(): object
```

Object Storage Transfer View

The amount of outbound data transfer used by your account's Object Storage buckets. Object Storage adds 1 terabyte of outbound data transfer to your data transfer pool. See the [Object Storage Pricing and Limitations](/docs/guides/pricing-and-limitations/) guide for details on Object Storage transfer quotas.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getObjectStorageTransfer();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->getObjectStorageTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

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

## `modifyObjectStorageBucketAccess()`

```php
modifyObjectStorageBucketAccess($cluster_id, $bucket, $unknown_base_type): object
```

Object Storage Bucket Access Modify

Allows changing basic Cross-origin Resource Sharing (CORS) and Access Control Level (ACL) settings. Only allows enabling/disabling CORS for all origins, and/or setting canned ACLs.   For more fine-grained control of both systems, please use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/bucketops/#put-bucket-acl) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The changes to make to the bucket's access controls.

try {
    $result = $apiInstance->modifyObjectStorageBucketAccess($cluster_id, $bucket, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->modifyObjectStorageBucketAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The changes to make to the bucket&#39;s access controls. | [optional]

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

## `updateObjectStorageBucketACL()`

```php
updateObjectStorageBucketACL($cluster_id, $bucket, $unknown_base_type): \OpenAPI\Client\Model\InlineResponse20050
```

Object Storage Object ACL Config Update

Update an Object's configured Access Control List (ACL) in this Object Storage bucket. ACLs define who can access your buckets and objects and specify the level of access granted to those users.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/objectops/#set-object-acl) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The changes to make to this Object's access controls.

try {
    $result = $apiInstance->updateObjectStorageBucketACL($cluster_id, $bucket, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->updateObjectStorageBucketACL: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The changes to make to this Object&#39;s access controls. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20050**](../Model/InlineResponse20050.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateObjectStorageBucketAccess()`

```php
updateObjectStorageBucketAccess($cluster_id, $bucket, $unknown_base_type): object
```

Object Storage Bucket Access Update

Allows changing basic Cross-origin Resource Sharing (CORS) and Access Control Level (ACL) settings. Only allows enabling/disabling CORS for all origins, and/or setting canned ACLs.   For more fine-grained control of both systems, please use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/bucketops/#put-bucket-acl) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The changes to make to the bucket's access controls.

try {
    $result = $apiInstance->updateObjectStorageBucketAccess($cluster_id, $bucket, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->updateObjectStorageBucketAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The changes to make to the bucket&#39;s access controls. | [optional]

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

## `updateObjectStorageKey()`

```php
updateObjectStorageKey($key_id, $inline_object16): \OpenAPI\Client\Model\ObjectStorageKey
```

Object Storage Key Update

Updates an Object Storage Key on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$key_id = 56; // int | The key to look up.
$inline_object16 = new \OpenAPI\Client\Model\InlineObject16(); // \OpenAPI\Client\Model\InlineObject16

try {
    $result = $apiInstance->updateObjectStorageKey($key_id, $inline_object16);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->updateObjectStorageKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **key_id** | **int**| The key to look up. |
 **inline_object16** | [**\OpenAPI\Client\Model\InlineObject16**](../Model/InlineObject16.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\ObjectStorageKey**](../Model/ObjectStorageKey.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `viewObjectStorageBucketACL()`

```php
viewObjectStorageBucketACL($cluster_id, $bucket, $name): \OpenAPI\Client\Model\InlineResponse20050
```

Object Storage Object ACL Config View

View an Object’s configured Access Control List (ACL) in this Object Storage bucket. ACLs define who can access your buckets and objects and specify the level of access granted to those users.   This endpoint is available for convenience. It is recommended that instead you use the more [fully-featured S3 API](https://docs.ceph.com/en/latest/radosgw/s3/objectops/#get-object-acl) directly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStorageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cluster_id = 'cluster_id_example'; // string | The ID of the cluster this bucket exists in.
$bucket = 'bucket_example'; // string | The bucket name.
$name = 'name_example'; // string | The `name` of the object for which to retrieve its Access Control List (ACL). Use the [Object Storage Bucket Contents List](/docs/api/object-storage/#object-storage-bucket-contents-list) endpoint to access all object names in a bucket.

try {
    $result = $apiInstance->viewObjectStorageBucketACL($cluster_id, $bucket, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStorageApi->viewObjectStorageBucketACL: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **cluster_id** | **string**| The ID of the cluster this bucket exists in. |
 **bucket** | **string**| The bucket name. |
 **name** | **string**| The &#x60;name&#x60; of the object for which to retrieve its Access Control List (ACL). Use the [Object Storage Bucket Contents List](/docs/api/object-storage/#object-storage-bucket-contents-list) endpoint to access all object names in a bucket. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20050**](../Model/InlineResponse20050.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

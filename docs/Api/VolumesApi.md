# OpenAPI\Client\VolumesApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**attachVolume()**](VolumesApi.md#attachVolume) | **POST** /volumes/{volumeId}/attach | Volume Attach
[**cloneVolume()**](VolumesApi.md#cloneVolume) | **POST** /volumes/{volumeId}/clone | Volume Clone
[**createVolume()**](VolumesApi.md#createVolume) | **POST** /volumes | Volume Create
[**deleteVolume()**](VolumesApi.md#deleteVolume) | **DELETE** /volumes/{volumeId} | Volume Delete
[**detachVolume()**](VolumesApi.md#detachVolume) | **POST** /volumes/{volumeId}/detach | Volume Detach
[**getVolume()**](VolumesApi.md#getVolume) | **GET** /volumes/{volumeId} | Volume View
[**getVolumes()**](VolumesApi.md#getVolumes) | **GET** /volumes | Volumes List
[**resizeVolume()**](VolumesApi.md#resizeVolume) | **POST** /volumes/{volumeId}/resize | Volume Resize
[**updateVolume()**](VolumesApi.md#updateVolume) | **PUT** /volumes/{volumeId} | Volume Update


## `attachVolume()`

```php
attachVolume($volume_id, $inline_object19): \OpenAPI\Client\Model\Volume
```

Volume Attach

Attaches a Volume on your Account to an existing Linode on your Account. In order for this request to complete successfully, your User must have `read_only` or `read_write` permission to the Volume and `read_write` permission to the Linode. Additionally, the Volume and Linode must be located in the same Region.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$volume_id = 56; // int | ID of the Volume to attach.
$inline_object19 = new \OpenAPI\Client\Model\InlineObject19(); // \OpenAPI\Client\Model\InlineObject19

try {
    $result = $apiInstance->attachVolume($volume_id, $inline_object19);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->attachVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **volume_id** | **int**| ID of the Volume to attach. |
 **inline_object19** | [**\OpenAPI\Client\Model\InlineObject19**](../Model/InlineObject19.md)|  |

### Return type

[**\OpenAPI\Client\Model\Volume**](../Model/Volume.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `cloneVolume()`

```php
cloneVolume($volume_id, $inline_object20): \OpenAPI\Client\Model\Volume
```

Volume Clone

Creates a Volume on your Account. In order for this request to complete successfully, your User must have the `add_volumes` grant. The new Volume will have the same size and data as the source Volume. Creating a new Volume will incur a charge on your Account. * Only Volumes with a `status` of \"active\" can be cloned.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$volume_id = 56; // int | ID of the Volume to clone.
$inline_object20 = new \OpenAPI\Client\Model\InlineObject20(); // \OpenAPI\Client\Model\InlineObject20

try {
    $result = $apiInstance->cloneVolume($volume_id, $inline_object20);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->cloneVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **volume_id** | **int**| ID of the Volume to clone. |
 **inline_object20** | [**\OpenAPI\Client\Model\InlineObject20**](../Model/InlineObject20.md)|  |

### Return type

[**\OpenAPI\Client\Model\Volume**](../Model/Volume.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createVolume()`

```php
createVolume($inline_object18): \OpenAPI\Client\Model\Volume
```

Volume Create

Creates a Volume on your Account. In order for this to complete successfully, your User must have the `add_volumes` grant. Creating a new Volume will start accruing additional charges on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object18 = new \OpenAPI\Client\Model\InlineObject18(); // \OpenAPI\Client\Model\InlineObject18

try {
    $result = $apiInstance->createVolume($inline_object18);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->createVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object18** | [**\OpenAPI\Client\Model\InlineObject18**](../Model/InlineObject18.md)|  |

### Return type

[**\OpenAPI\Client\Model\Volume**](../Model/Volume.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteVolume()`

```php
deleteVolume($volume_id): object
```

Volume Delete

Deletes a Volume you have permission to `read_write`.  * **Deleting a Volume is a destructive action and cannot be undone.**  * Deleting stops billing for the Volume. You will be billed for time used within the billing period the Volume was active.  * Volumes that are migrating cannot be deleted until the migration is finished.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$volume_id = 56; // int | ID of the Volume to look up.

try {
    $result = $apiInstance->deleteVolume($volume_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->deleteVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **volume_id** | **int**| ID of the Volume to look up. |

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

## `detachVolume()`

```php
detachVolume($volume_id): object
```

Volume Detach

Detaches a Volume on your Account from a Linode on your Account. In order for this request to complete successfully, your User must have `read_write` access to the Volume and `read_write` access to the Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$volume_id = 56; // int | ID of the Volume to detach.

try {
    $result = $apiInstance->detachVolume($volume_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->detachVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **volume_id** | **int**| ID of the Volume to detach. |

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

## `getVolume()`

```php
getVolume($volume_id, $page, $page_size): \OpenAPI\Client\Model\Volume
```

Volume View

Get information about a single Volume.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$volume_id = 56; // int | ID of the Volume to look up.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getVolume($volume_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->getVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **volume_id** | **int**| ID of the Volume to look up. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\Volume**](../Model/Volume.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getVolumes()`

```php
getVolumes($page, $page_size): \OpenAPI\Client\Model\InlineResponse20024
```

Volumes List

Returns a paginated list of Volumes you have permission to view.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getVolumes($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->getVolumes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20024**](../Model/InlineResponse20024.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `resizeVolume()`

```php
resizeVolume($volume_id, $inline_object21): object
```

Volume Resize

Resize an existing Volume on your Account. In order for this request to complete successfully, your User must have the `read_write` permissions to the Volume. * Volumes can only be resized up. * Only Volumes with a `status` of \"active\" can be resized.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$volume_id = 56; // int | ID of the Volume to resize.
$inline_object21 = new \OpenAPI\Client\Model\InlineObject21(); // \OpenAPI\Client\Model\InlineObject21

try {
    $result = $apiInstance->resizeVolume($volume_id, $inline_object21);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->resizeVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **volume_id** | **int**| ID of the Volume to resize. |
 **inline_object21** | [**\OpenAPI\Client\Model\InlineObject21**](../Model/InlineObject21.md)|  |

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

## `updateVolume()`

```php
updateVolume($volume_id, $unknown_base_type): \OpenAPI\Client\Model\Volume
```

Volume Update

Updates a Volume that you have permission to `read_write`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$volume_id = 56; // int | ID of the Volume to look up.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | If any updated field fails to pass validation, the Volume will not be updated.

try {
    $result = $apiInstance->updateVolume($volume_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->updateVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **volume_id** | **int**| ID of the Volume to look up. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| If any updated field fails to pass validation, the Volume will not be updated. |

### Return type

[**\OpenAPI\Client\Model\Volume**](../Model/Volume.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

# OpenAPI\Client\LinodeTypesApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getLinodeType()**](LinodeTypesApi.md#getLinodeType) | **GET** /linode/types/{typeId} | Type View
[**getLinodeTypes()**](LinodeTypesApi.md#getLinodeTypes) | **GET** /linode/types | Types List


## `getLinodeType()`

```php
getLinodeType($type_id): \OpenAPI\Client\Model\LinodeType
```

Type View

Returns information about a specific Linode Type, including pricing and specifications. This is used when [creating](/docs/api/linode-instances/#linode-create) or [resizing](/docs/api/linode-instances/#linode-resize) Linodes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\LinodeTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$type_id = 'type_id_example'; // string | The ID of the Linode Type to look up.

try {
    $result = $apiInstance->getLinodeType($type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeTypesApi->getLinodeType: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **type_id** | **string**| The ID of the Linode Type to look up. |

### Return type

[**\OpenAPI\Client\Model\LinodeType**](../Model/LinodeType.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeTypes()`

```php
getLinodeTypes(): \OpenAPI\Client\Model\InlineResponse20026
```

Types List

Returns collection of Linode Types, including pricing and specifications for each Type. These are used when [creating](/docs/api/linode-instances/#linode-create) or [resizing](/docs/api/linode-instances/#linode-resize) Linodes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\LinodeTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getLinodeTypes();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeTypesApi->getLinodeTypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20026**](../Model/InlineResponse20026.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

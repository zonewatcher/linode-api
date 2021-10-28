# OpenAPI\Client\RegionsApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getRegion()**](RegionsApi.md#getRegion) | **GET** /regions/{regionId} | Region View
[**getRegions()**](RegionsApi.md#getRegions) | **GET** /regions | Regions List


## `getRegion()`

```php
getRegion($region_id): \OpenAPI\Client\Model\Region
```

Region View

Returns a single Region.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\RegionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$region_id = 'region_id_example'; // string | ID of the Region to look up.

try {
    $result = $apiInstance->getRegion($region_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RegionsApi->getRegion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **region_id** | **string**| ID of the Region to look up. |

### Return type

[**\OpenAPI\Client\Model\Region**](../Model/Region.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getRegions()`

```php
getRegions(): \OpenAPI\Client\Model\InlineResponse20057
```

Regions List

Lists the Regions available for Linode services. Not all services are guaranteed to be available in all Regions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\RegionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getRegions();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RegionsApi->getRegions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20057**](../Model/InlineResponse20057.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

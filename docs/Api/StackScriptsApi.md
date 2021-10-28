# OpenAPI\Client\StackScriptsApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addStackScript()**](StackScriptsApi.md#addStackScript) | **POST** /linode/stackscripts | StackScript Create
[**deleteStackScript()**](StackScriptsApi.md#deleteStackScript) | **DELETE** /linode/stackscripts/{stackscriptId} | StackScript Delete
[**getStackScript()**](StackScriptsApi.md#getStackScript) | **GET** /linode/stackscripts/{stackscriptId} | StackScript View
[**getStackScripts()**](StackScriptsApi.md#getStackScripts) | **GET** /linode/stackscripts | StackScripts List
[**updateStackScript()**](StackScriptsApi.md#updateStackScript) | **PUT** /linode/stackscripts/{stackscriptId} | StackScript Update


## `addStackScript()`

```php
addStackScript($unknown_base_type): \OpenAPI\Client\Model\StackScript
```

StackScript Create

Creates a StackScript in your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\StackScriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The properties to set for the new StackScript.

try {
    $result = $apiInstance->addStackScript($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StackScriptsApi->addStackScript: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The properties to set for the new StackScript. |

### Return type

[**\OpenAPI\Client\Model\StackScript**](../Model/StackScript.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteStackScript()`

```php
deleteStackScript($stackscript_id): object
```

StackScript Delete

Deletes a private StackScript you have permission to `read_write`. You cannot delete a public StackScript.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\StackScriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$stackscript_id = 'stackscript_id_example'; // string | The ID of the StackScript to look up.

try {
    $result = $apiInstance->deleteStackScript($stackscript_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StackScriptsApi->deleteStackScript: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **stackscript_id** | **string**| The ID of the StackScript to look up. |

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

## `getStackScript()`

```php
getStackScript($stackscript_id): \OpenAPI\Client\Model\StackScript
```

StackScript View

Returns all of the information about a specified StackScript, including the contents of the script.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\StackScriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$stackscript_id = 'stackscript_id_example'; // string | The ID of the StackScript to look up.

try {
    $result = $apiInstance->getStackScript($stackscript_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StackScriptsApi->getStackScript: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **stackscript_id** | **string**| The ID of the StackScript to look up. |

### Return type

[**\OpenAPI\Client\Model\StackScript**](../Model/StackScript.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getStackScripts()`

```php
getStackScripts($page, $page_size): \OpenAPI\Client\Model\InlineResponse20025
```

StackScripts List

If the request is not authenticated, only public StackScripts are returned.  For more information on StackScripts, please read our [StackScripts guides](/docs/platform/stackscripts/).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\StackScriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getStackScripts($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StackScriptsApi->getStackScripts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20025**](../Model/InlineResponse20025.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateStackScript()`

```php
updateStackScript($stackscript_id, $stack_script): \OpenAPI\Client\Model\StackScript
```

StackScript Update

Updates a StackScript.  **Once a StackScript is made public, it cannot be made private.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\StackScriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$stackscript_id = 'stackscript_id_example'; // string | The ID of the StackScript to look up.
$stack_script = new \OpenAPI\Client\Model\StackScript(); // \OpenAPI\Client\Model\StackScript | The fields to update.

try {
    $result = $apiInstance->updateStackScript($stackscript_id, $stack_script);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StackScriptsApi->updateStackScript: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **stackscript_id** | **string**| The ID of the StackScript to look up. |
 **stack_script** | [**\OpenAPI\Client\Model\StackScript**](../Model/StackScript.md)| The fields to update. | [optional]

### Return type

[**\OpenAPI\Client\Model\StackScript**](../Model/StackScript.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

# OpenAPI\Client\TagsApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTag()**](TagsApi.md#createTag) | **POST** /tags | New Tag Create
[**deleteTag()**](TagsApi.md#deleteTag) | **DELETE** /tags/{label} | Tag Delete
[**getTaggedObjects()**](TagsApi.md#getTaggedObjects) | **GET** /tags/{label} | Tagged Objects List
[**getTags()**](TagsApi.md#getTags) | **GET** /tags | Tags List


## `createTag()`

```php
createTag($inline_object17): \OpenAPI\Client\Model\Tag
```

New Tag Create

Creates a new Tag and optionally tags requested objects with it immediately.  **Important**: You must be an unrestricted User in order to add or modify Tags.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object17 = new \OpenAPI\Client\Model\InlineObject17(); // \OpenAPI\Client\Model\InlineObject17

try {
    $result = $apiInstance->createTag($inline_object17);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->createTag: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object17** | [**\OpenAPI\Client\Model\InlineObject17**](../Model/InlineObject17.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Tag**](../Model/Tag.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteTag()`

```php
deleteTag($label): object
```

Tag Delete

Remove a Tag from all objects and delete it.  **Important**: You must be an unrestricted User in order to add or modify Tags.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$label = 'label_example'; // string

try {
    $result = $apiInstance->deleteTag($label);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->deleteTag: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **label** | **string**|  |

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

## `getTaggedObjects()`

```php
getTaggedObjects($label, $page, $page_size): object
```

Tagged Objects List

Returns a paginated list of all objects you've tagged with the requested Tag. This is a mixed collection of all object types.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$label = 'label_example'; // string
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getTaggedObjects($label, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->getTaggedObjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **label** | **string**|  |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
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

## `getTags()`

```php
getTags($page, $page_size): \OpenAPI\Client\Model\InlineResponse20060
```

Tags List

Tags are User-defined labels attached to objects in your Account, such as Linodes. They are used for specifying and grouping attributes of objects that are relevant to the User.  This endpoint returns a paginated list of Tags on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getTags($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->getTags: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20060**](../Model/InlineResponse20060.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

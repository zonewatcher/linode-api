# OpenAPI\Client\LongviewApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createLongviewClient()**](LongviewApi.md#createLongviewClient) | **POST** /longview/clients | Longview Client Create
[**deleteLongviewClient()**](LongviewApi.md#deleteLongviewClient) | **DELETE** /longview/clients/{clientId} | Longview Client Delete
[**getLongviewClient()**](LongviewApi.md#getLongviewClient) | **GET** /longview/clients/{clientId} | Longview Client View
[**getLongviewClients()**](LongviewApi.md#getLongviewClients) | **GET** /longview/clients | Longview Clients List
[**getLongviewPlan()**](LongviewApi.md#getLongviewPlan) | **GET** /longview/plan | Longview Plan View
[**getLongviewSubscription()**](LongviewApi.md#getLongviewSubscription) | **GET** /longview/subscriptions/{subscriptionId} | Longview Subscription View
[**getLongviewSubscriptions()**](LongviewApi.md#getLongviewSubscriptions) | **GET** /longview/subscriptions | Longview Subscriptions List
[**updateLongviewClient()**](LongviewApi.md#updateLongviewClient) | **PUT** /longview/clients/{clientId} | Longview Client Update
[**updateLongviewPlan()**](LongviewApi.md#updateLongviewPlan) | **PUT** /longview/plan | Longview Plan Update


## `createLongviewClient()`

```php
createLongviewClient($longview_client): \OpenAPI\Client\Model\LongviewClient
```

Longview Client Create

Creates a Longview Client.  This Client will not begin monitoring the status of your server until you configure the Longview Client application on your Linode using the returning `install_code` and `api_key`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$longview_client = new \OpenAPI\Client\Model\LongviewClient(); // \OpenAPI\Client\Model\LongviewClient | Information about the LongviewClient to create.

try {
    $result = $apiInstance->createLongviewClient($longview_client);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->createLongviewClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **longview_client** | [**\OpenAPI\Client\Model\LongviewClient**](../Model/LongviewClient.md)| Information about the LongviewClient to create. |

### Return type

[**\OpenAPI\Client\Model\LongviewClient**](../Model/LongviewClient.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteLongviewClient()`

```php
deleteLongviewClient($client_id): object
```

Longview Client Delete

Deletes a Longview Client from your Account.  **All information stored for this client will be lost.**  This _does not_ uninstall the Longview Client application for your Linode - you must do that manually.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 56; // int | The Longview Client ID to access.

try {
    $result = $apiInstance->deleteLongviewClient($client_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->deleteLongviewClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **int**| The Longview Client ID to access. |

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

## `getLongviewClient()`

```php
getLongviewClient($client_id): \OpenAPI\Client\Model\LongviewClient
```

Longview Client View

Returns a single Longview Client you can access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 56; // int | The Longview Client ID to access.

try {
    $result = $apiInstance->getLongviewClient($client_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->getLongviewClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **int**| The Longview Client ID to access. |

### Return type

[**\OpenAPI\Client\Model\LongviewClient**](../Model/LongviewClient.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLongviewClients()`

```php
getLongviewClients($page, $page_size): \OpenAPI\Client\Model\InlineResponse20033
```

Longview Clients List

Returns a paginated list of Longview Clients you have access to. Longview Client is used to monitor stats on your Linode with the help of the Longview Client application.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getLongviewClients($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->getLongviewClients: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20033**](../Model/InlineResponse20033.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLongviewPlan()`

```php
getLongviewPlan(): \OpenAPI\Client\Model\LongviewSubscription
```

Longview Plan View

Get the details of your current Longview plan. This returns a `LongviewSubscription` object for your current Longview Pro plan, or an empty set `{}` if your current plan is Longview Free.  You must have at least one of the following `global` [User Grants](/docs/api/account/#users-grants-view) in order to access this endpoint:    - `\"account_access\": read_write`   - `\"account_access\": read_only`   - `\"longview_subscription\": true`   - `\"add_longview\": true`   To update your subscription plan, send a request to [Update Longview Plan](/docs/api/longview/#longview-plan-update).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getLongviewPlan();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->getLongviewPlan: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\LongviewSubscription**](../Model/LongviewSubscription.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLongviewSubscription()`

```php
getLongviewSubscription($subscription_id): \OpenAPI\Client\Model\LongviewSubscription
```

Longview Subscription View

Get the Longview plan details as a single `LongviewSubscription` object for the provided subscription ID. This is a public endpoint and requires no authentication.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$subscription_id = 'subscription_id_example'; // string | The Longview Subscription to look up.

try {
    $result = $apiInstance->getLongviewSubscription($subscription_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->getLongviewSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_id** | **string**| The Longview Subscription to look up. |

### Return type

[**\OpenAPI\Client\Model\LongviewSubscription**](../Model/LongviewSubscription.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLongviewSubscriptions()`

```php
getLongviewSubscriptions($page, $page_size): \OpenAPI\Client\Model\InlineResponse20034
```

Longview Subscriptions List

Returns a paginated list of available Longview Subscriptions. This is a public endpoint and requires no authentication.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getLongviewSubscriptions($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->getLongviewSubscriptions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20034**](../Model/InlineResponse20034.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateLongviewClient()`

```php
updateLongviewClient($client_id, $longview_client): \OpenAPI\Client\Model\LongviewClient
```

Longview Client Update

Updates a Longview Client.  This cannot update how it monitors your server; use the Longview Client application on your Linode for monitoring configuration.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 56; // int | The Longview Client ID to access.
$longview_client = new \OpenAPI\Client\Model\LongviewClient(); // \OpenAPI\Client\Model\LongviewClient | The fields to update.

try {
    $result = $apiInstance->updateLongviewClient($client_id, $longview_client);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->updateLongviewClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **int**| The Longview Client ID to access. |
 **longview_client** | [**\OpenAPI\Client\Model\LongviewClient**](../Model/LongviewClient.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\LongviewClient**](../Model/LongviewClient.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateLongviewPlan()`

```php
updateLongviewPlan($longview_plan): \OpenAPI\Client\Model\LongviewSubscription
```

Longview Plan Update

Update your Longview plan to that of the given subcription ID. This returns a `LongviewSubscription` object for the updated Longview Pro plan, or an empty set `{}` if the updated plan is Longview Free.  You must have `\"longview_subscription\": true` configured as a `global` [User Grant](/docs/api/account/#users-grants-view) in order to access this endpoint.  You can send a request to the [List Longview Subscriptions](/docs/api/longview/#longview-subscriptions-list) endpoint to receive the details, including `id`'s, of each plan.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LongviewApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$longview_plan = new \OpenAPI\Client\Model\LongviewPlan(); // \OpenAPI\Client\Model\LongviewPlan | Update your Longview subscription plan.

try {
    $result = $apiInstance->updateLongviewPlan($longview_plan);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LongviewApi->updateLongviewPlan: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **longview_plan** | [**\OpenAPI\Client\Model\LongviewPlan**](../Model/LongviewPlan.md)| Update your Longview subscription plan. |

### Return type

[**\OpenAPI\Client\Model\LongviewSubscription**](../Model/LongviewSubscription.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

# OpenAPI\Client\SupportApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**closeTicket()**](SupportApi.md#closeTicket) | **POST** /support/tickets/{ticketId}/close | Support Ticket Close
[**createTicket()**](SupportApi.md#createTicket) | **POST** /support/tickets | Support Ticket Open
[**createTicketAttachment()**](SupportApi.md#createTicketAttachment) | **POST** /support/tickets/{ticketId}/attachments | Ticket Attachment Create
[**createTicketReply()**](SupportApi.md#createTicketReply) | **POST** /support/tickets/{ticketId}/replies | Reply Create
[**getTicket()**](SupportApi.md#getTicket) | **GET** /support/tickets/{ticketId} | Support Ticket View
[**getTicketReplies()**](SupportApi.md#getTicketReplies) | **GET** /support/tickets/{ticketId}/replies | Replies List
[**getTickets()**](SupportApi.md#getTickets) | **GET** /support/tickets | Support Tickets List


## `closeTicket()`

```php
closeTicket($ticket_id): object
```

Support Ticket Close

Closes a Support Ticket you have access to modify.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ticket_id = 56; // int | The ID of the Support Ticket.

try {
    $result = $apiInstance->closeTicket($ticket_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->closeTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ticket_id** | **int**| The ID of the Support Ticket. |

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

## `createTicket()`

```php
createTicket($support_ticket_request): \OpenAPI\Client\Model\SupportTicket
```

Support Ticket Open

Open a Support Ticket. Only one of the ID attributes (`linode_id`, `domain_id`, etc.) can be set on a single Support Ticket.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$support_ticket_request = new \OpenAPI\Client\Model\SupportTicketRequest(); // \OpenAPI\Client\Model\SupportTicketRequest | Open a Support Ticket.

try {
    $result = $apiInstance->createTicket($support_ticket_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->createTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **support_ticket_request** | [**\OpenAPI\Client\Model\SupportTicketRequest**](../Model/SupportTicketRequest.md)| Open a Support Ticket. | [optional]

### Return type

[**\OpenAPI\Client\Model\SupportTicket**](../Model/SupportTicket.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createTicketAttachment()`

```php
createTicketAttachment($ticket_id, $file): object
```

Ticket Attachment Create

Adds a file attachment to an existing Support Ticket on your Account. File attachments are used to assist our Support team in resolving your Ticket. Examples of attachments are screen shots and text files that provide additional information. Note: Accepted file extensions include: .gif, .jpg, .jpeg, .pjpg, .pjpeg, .tif, .tiff, .png, .pdf, or .txt.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ticket_id = 56; // int | The ID of the Support Ticket.
$file = 'file_example'; // string | The local, absolute path to the file you want to attach to your Support Ticket.

try {
    $result = $apiInstance->createTicketAttachment($ticket_id, $file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->createTicketAttachment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ticket_id** | **int**| The ID of the Support Ticket. |
 **file** | **string**| The local, absolute path to the file you want to attach to your Support Ticket. |

### Return type

**object**

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createTicketReply()`

```php
createTicketReply($ticket_id, $unknown_base_type): \OpenAPI\Client\Model\SupportTicketReply
```

Reply Create

Adds a reply to an existing Support Ticket.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ticket_id = 56; // int | The ID of the Support Ticket.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Add a reply.

try {
    $result = $apiInstance->createTicketReply($ticket_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->createTicketReply: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ticket_id** | **int**| The ID of the Support Ticket. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Add a reply. |

### Return type

[**\OpenAPI\Client\Model\SupportTicketReply**](../Model/SupportTicketReply.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTicket()`

```php
getTicket($ticket_id): \OpenAPI\Client\Model\SupportTicket
```

Support Ticket View

Returns a Support Ticket under your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ticket_id = 56; // int | The ID of the Support Ticket.

try {
    $result = $apiInstance->getTicket($ticket_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->getTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ticket_id** | **int**| The ID of the Support Ticket. |

### Return type

[**\OpenAPI\Client\Model\SupportTicket**](../Model/SupportTicket.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTicketReplies()`

```php
getTicketReplies($ticket_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20059
```

Replies List

Returns a collection of replies to a Support Ticket on your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ticket_id = 56; // int | The ID of the Support Ticket.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getTicketReplies($ticket_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->getTicketReplies: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ticket_id** | **int**| The ID of the Support Ticket. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20059**](../Model/InlineResponse20059.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTickets()`

```php
getTickets($page, $page_size): \OpenAPI\Client\Model\InlineResponse20058
```

Support Tickets List

Returns a collection of Support Tickets on your Account. Support Tickets can be both tickets you open with Linode for support, as well as tickets generated by Linode regarding your Account. This collection includes all Support Tickets generated on your Account, with open tickets returned first.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getTickets($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->getTickets: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20058**](../Model/InlineResponse20058.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

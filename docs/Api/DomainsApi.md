# OpenAPI\Client\DomainsApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**cloneDomain()**](DomainsApi.md#cloneDomain) | **POST** /domains/{domainId}/clone | Domain Clone
[**createDomain()**](DomainsApi.md#createDomain) | **POST** /domains | Domain Create
[**createDomainRecord()**](DomainsApi.md#createDomainRecord) | **POST** /domains/{domainId}/records | Domain Record Create
[**deleteDomain()**](DomainsApi.md#deleteDomain) | **DELETE** /domains/{domainId} | Domain Delete
[**deleteDomainRecord()**](DomainsApi.md#deleteDomainRecord) | **DELETE** /domains/{domainId}/records/{recordId} | Domain Record Delete
[**getDomain()**](DomainsApi.md#getDomain) | **GET** /domains/{domainId} | Domain View
[**getDomainRecord()**](DomainsApi.md#getDomainRecord) | **GET** /domains/{domainId}/records/{recordId} | Domain Record View
[**getDomainRecords()**](DomainsApi.md#getDomainRecords) | **GET** /domains/{domainId}/records | Domain Records List
[**getDomainZone()**](DomainsApi.md#getDomainZone) | **GET** /domains/{domainId}/zone-file | Domain Zone File View
[**getDomains()**](DomainsApi.md#getDomains) | **GET** /domains | Domains List
[**importDomain()**](DomainsApi.md#importDomain) | **POST** /domains/import | Domain Import
[**updateDomain()**](DomainsApi.md#updateDomain) | **PUT** /domains/{domainId} | Domain Update
[**updateDomainRecord()**](DomainsApi.md#updateDomainRecord) | **PUT** /domains/{domainId}/records/{recordId} | Domain Record Update


## `cloneDomain()`

```php
cloneDomain($domain_id, $inline_object4): \OpenAPI\Client\Model\Domain
```

Domain Clone

Clones a Domain and all associated DNS records from a Domain that is registered in Linode's DNS manager.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 'domain_id_example'; // string | ID of the Domain to clone.
$inline_object4 = new \OpenAPI\Client\Model\InlineObject4(); // \OpenAPI\Client\Model\InlineObject4

try {
    $result = $apiInstance->cloneDomain($domain_id, $inline_object4);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->cloneDomain: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **string**| ID of the Domain to clone. |
 **inline_object4** | [**\OpenAPI\Client\Model\InlineObject4**](../Model/InlineObject4.md)|  |

### Return type

[**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createDomain()`

```php
createDomain($unknown_base_type): \OpenAPI\Client\Model\Domain
```

Domain Create

Adds a new Domain to Linode's DNS Manager. Linode is not a registrar, and you must own the domain before adding it here. Be sure to point your registrar to Linode's nameservers so that the records hosted here are used.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the domain you are registering.

try {
    $result = $apiInstance->createDomain($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->createDomain: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the domain you are registering. |

### Return type

[**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createDomainRecord()`

```php
createDomainRecord($domain_id, $unknown_base_type): \OpenAPI\Client\Model\DomainRecord
```

Domain Record Create

Adds a new Domain Record to the zonefile this Domain represents.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain we are accessing Records for.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the new Record to add.

try {
    $result = $apiInstance->createDomainRecord($domain_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->createDomainRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain we are accessing Records for. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the new Record to add. |

### Return type

[**\OpenAPI\Client\Model\DomainRecord**](../Model/DomainRecord.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDomain()`

```php
deleteDomain($domain_id): object
```

Domain Delete

Deletes a Domain from Linode's DNS Manager. The Domain will be removed from Linode's nameservers shortly after this operation completes. This also deletes all associated Domain Records.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain to access.

try {
    $result = $apiInstance->deleteDomain($domain_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->deleteDomain: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain to access. |

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

## `deleteDomainRecord()`

```php
deleteDomainRecord($domain_id, $record_id): object
```

Domain Record Delete

Deletes a Record on this Domain.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain whose Record you are accessing.
$record_id = 56; // int | The ID of the Record you are accessing.

try {
    $result = $apiInstance->deleteDomainRecord($domain_id, $record_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->deleteDomainRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain whose Record you are accessing. |
 **record_id** | **int**| The ID of the Record you are accessing. |

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

## `getDomain()`

```php
getDomain($domain_id): \OpenAPI\Client\Model\Domain
```

Domain View

This is a single Domain that you have registered in Linode's DNS Manager. Linode is not a registrar, and in order for this Domain record to work you must own the domain and point your registrar at Linode's nameservers.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain to access.

try {
    $result = $apiInstance->getDomain($domain_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->getDomain: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain to access. |

### Return type

[**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDomainRecord()`

```php
getDomainRecord($domain_id, $record_id): \OpenAPI\Client\Model\DomainRecord
```

Domain Record View

View a single Record on this Domain.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain whose Record you are accessing.
$record_id = 56; // int | The ID of the Record you are accessing.

try {
    $result = $apiInstance->getDomainRecord($domain_id, $record_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->getDomainRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain whose Record you are accessing. |
 **record_id** | **int**| The ID of the Record you are accessing. |

### Return type

[**\OpenAPI\Client\Model\DomainRecord**](../Model/DomainRecord.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDomainRecords()`

```php
getDomainRecords($domain_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20014
```

Domain Records List

Returns a paginated list of Records configured on a Domain in Linode's DNS Manager.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain we are accessing Records for.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getDomainRecords($domain_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->getDomainRecords: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain we are accessing Records for. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20014**](../Model/InlineResponse20014.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDomainZone()`

```php
getDomainZone($domain_id): object
```

Domain Zone File View

Returns the zone file for the last rendered zone for the specified domain.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 'domain_id_example'; // string | ID of the Domain.

try {
    $result = $apiInstance->getDomainZone($domain_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->getDomainZone: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **string**| ID of the Domain. |

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

## `getDomains()`

```php
getDomains($page, $page_size): \OpenAPI\Client\Model\InlineResponse20013
```

Domains List

This is a collection of Domains that you have registered in Linode's DNS Manager.  Linode is not a registrar, and in order for these to work you must own the domains and point your registrar at Linode's nameservers.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getDomains($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->getDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20013**](../Model/InlineResponse20013.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `importDomain()`

```php
importDomain($unknown_base_type): \OpenAPI\Client\Model\Domain
```

Domain Import

Imports a domain zone from a remote nameserver. Your nameserver must allow zone transfers (AXFR) from the following IPs:    - 96.126.114.97   - 96.126.114.98   - 2600:3c00::5e   - 2600:3c00::5f

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the Domain to import.

try {
    $result = $apiInstance->importDomain($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->importDomain: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the Domain to import. | [optional]

### Return type

[**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateDomain()`

```php
updateDomain($domain_id, $domain): \OpenAPI\Client\Model\Domain
```

Domain Update

Update information about a Domain in Linode's DNS Manager.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain to access.
$domain = new \OpenAPI\Client\Model\Domain(); // \OpenAPI\Client\Model\Domain | The Domain information to update.

try {
    $result = $apiInstance->updateDomain($domain_id, $domain);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->updateDomain: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain to access. |
 **domain** | [**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)| The Domain information to update. |

### Return type

[**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateDomainRecord()`

```php
updateDomainRecord($domain_id, $record_id, $domain_record): \OpenAPI\Client\Model\DomainRecord
```

Domain Record Update

Updates a single Record on this Domain.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$domain_id = 56; // int | The ID of the Domain whose Record you are accessing.
$record_id = 56; // int | The ID of the Record you are accessing.
$domain_record = new \OpenAPI\Client\Model\DomainRecord(); // \OpenAPI\Client\Model\DomainRecord | The values to change.

try {
    $result = $apiInstance->updateDomainRecord($domain_id, $record_id, $domain_record);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainsApi->updateDomainRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **domain_id** | **int**| The ID of the Domain whose Record you are accessing. |
 **record_id** | **int**| The ID of the Record you are accessing. |
 **domain_record** | [**\OpenAPI\Client\Model\DomainRecord**](../Model/DomainRecord.md)| The values to change. |

### Return type

[**\OpenAPI\Client\Model\DomainRecord**](../Model/DomainRecord.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

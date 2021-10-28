# OpenAPI\Client\ManagedApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createManagedContact()**](ManagedApi.md#createManagedContact) | **POST** /managed/contacts | Managed Contact Create
[**createManagedCredential()**](ManagedApi.md#createManagedCredential) | **POST** /managed/credentials | Managed Credential Create
[**createManagedService()**](ManagedApi.md#createManagedService) | **POST** /managed/services | Managed Service Create
[**deleteManagedContact()**](ManagedApi.md#deleteManagedContact) | **DELETE** /managed/contacts/{contactId} | Managed Contact Delete
[**deleteManagedCredential()**](ManagedApi.md#deleteManagedCredential) | **POST** /managed/credentials/{credentialId}/revoke | Managed Credential Delete
[**deleteManagedService()**](ManagedApi.md#deleteManagedService) | **DELETE** /managed/services/{serviceId} | Managed Service Delete
[**disableManagedService()**](ManagedApi.md#disableManagedService) | **POST** /managed/services/{serviceId}/disable | Managed Service Disable
[**enableManagedService()**](ManagedApi.md#enableManagedService) | **POST** /managed/services/{serviceId}/enable | Managed Service Enable
[**getManagedContact()**](ManagedApi.md#getManagedContact) | **GET** /managed/contacts/{contactId} | Managed Contact View
[**getManagedContacts()**](ManagedApi.md#getManagedContacts) | **GET** /managed/contacts | Managed Contacts List
[**getManagedCredential()**](ManagedApi.md#getManagedCredential) | **GET** /managed/credentials/{credentialId} | Managed Credential View
[**getManagedCredentials()**](ManagedApi.md#getManagedCredentials) | **GET** /managed/credentials | Managed Credentials List
[**getManagedIssue()**](ManagedApi.md#getManagedIssue) | **GET** /managed/issues/{issueId} | Managed Issue View
[**getManagedIssues()**](ManagedApi.md#getManagedIssues) | **GET** /managed/issues | Managed Issues List
[**getManagedLinodeSetting()**](ManagedApi.md#getManagedLinodeSetting) | **GET** /managed/linode-settings/{linodeId} | Linode&#39;s Managed Settings View
[**getManagedLinodeSettings()**](ManagedApi.md#getManagedLinodeSettings) | **GET** /managed/linode-settings | Managed Linode Settings List
[**getManagedService()**](ManagedApi.md#getManagedService) | **GET** /managed/services/{serviceId} | Managed Service View
[**getManagedServices()**](ManagedApi.md#getManagedServices) | **GET** /managed/services | Managed Services List
[**getManagedStats()**](ManagedApi.md#getManagedStats) | **GET** /managed/stats | Managed Stats List
[**updateManagedContact()**](ManagedApi.md#updateManagedContact) | **PUT** /managed/contacts/{contactId} | Managed Contact Update
[**updateManagedCredential()**](ManagedApi.md#updateManagedCredential) | **PUT** /managed/credentials/{credentialId} | Managed Credential Update
[**updateManagedCredentialUsernamePassword()**](ManagedApi.md#updateManagedCredentialUsernamePassword) | **POST** /managed/credentials/{credentialId}/update | Managed Credential Username and Password Update
[**updateManagedLinodeSetting()**](ManagedApi.md#updateManagedLinodeSetting) | **PUT** /managed/linode-settings/{linodeId} | Linode&#39;s Managed Settings Update
[**updateManagedService()**](ManagedApi.md#updateManagedService) | **PUT** /managed/services/{serviceId} | Managed Service Update
[**viewManagedSSHKey()**](ManagedApi.md#viewManagedSSHKey) | **GET** /managed/credentials/sshkey | Managed SSH Key View


## `createManagedContact()`

```php
createManagedContact($managed_contact): \OpenAPI\Client\Model\ManagedContact
```

Managed Contact Create

Creates a Managed Contact.  A Managed Contact is someone Linode special forces can contact in the course of attempting to resolve an issue with a Managed Service.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$managed_contact = new \OpenAPI\Client\Model\ManagedContact(); // \OpenAPI\Client\Model\ManagedContact | Information about the contact to create.

try {
    $result = $apiInstance->createManagedContact($managed_contact);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->createManagedContact: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **managed_contact** | [**\OpenAPI\Client\Model\ManagedContact**](../Model/ManagedContact.md)| Information about the contact to create. | [optional]

### Return type

[**\OpenAPI\Client\Model\ManagedContact**](../Model/ManagedContact.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createManagedCredential()`

```php
createManagedCredential($unknown_base_type): \OpenAPI\Client\Model\ManagedCredential
```

Managed Credential Create

Creates a Managed Credential. A Managed Credential is stored securely to allow Linode special forces to access your Managed Services and resolve issues.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the Credential to create.

try {
    $result = $apiInstance->createManagedCredential($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->createManagedCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the Credential to create. | [optional]

### Return type

[**\OpenAPI\Client\Model\ManagedCredential**](../Model/ManagedCredential.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createManagedService()`

```php
createManagedService($unknown_base_type): \OpenAPI\Client\Model\ManagedService
```

Managed Service Create

Creates a Managed Service. Linode Managed will begin monitoring this service and reporting and attempting to resolve any Issues.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the service to monitor.

try {
    $result = $apiInstance->createManagedService($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->createManagedService: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the service to monitor. | [optional]

### Return type

[**\OpenAPI\Client\Model\ManagedService**](../Model/ManagedService.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteManagedContact()`

```php
deleteManagedContact($contact_id): object
```

Managed Contact Delete

Deletes a Managed Contact.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contact_id = 56; // int | The ID of the contact to access.

try {
    $result = $apiInstance->deleteManagedContact($contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->deleteManagedContact: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **int**| The ID of the contact to access. |

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

## `deleteManagedCredential()`

```php
deleteManagedCredential($credential_id): object
```

Managed Credential Delete

Deletes a Managed Credential.  Linode special forces will no longer have access to this Credential when attempting to resolve issues.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$credential_id = 56; // int | The ID of the Credential to access.

try {
    $result = $apiInstance->deleteManagedCredential($credential_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->deleteManagedCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credential_id** | **int**| The ID of the Credential to access. |

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

## `deleteManagedService()`

```php
deleteManagedService($service_id): object
```

Managed Service Delete

Deletes a Managed Service.  This service will no longer be monitored by Linode Managed.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$service_id = 56; // int | The ID of the Managed Service to access.

try {
    $result = $apiInstance->deleteManagedService($service_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->deleteManagedService: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **service_id** | **int**| The ID of the Managed Service to access. |

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

## `disableManagedService()`

```php
disableManagedService($service_id): \OpenAPI\Client\Model\ManagedService
```

Managed Service Disable

Temporarily disables monitoring of a Managed Service.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$service_id = 56; // int | The ID of the Managed Service to disable.

try {
    $result = $apiInstance->disableManagedService($service_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->disableManagedService: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **service_id** | **int**| The ID of the Managed Service to disable. |

### Return type

[**\OpenAPI\Client\Model\ManagedService**](../Model/ManagedService.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `enableManagedService()`

```php
enableManagedService($service_id): \OpenAPI\Client\Model\ManagedService
```

Managed Service Enable

Enables monitoring of a Managed Service.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$service_id = 56; // int | The ID of the Managed Service to enable.

try {
    $result = $apiInstance->enableManagedService($service_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->enableManagedService: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **service_id** | **int**| The ID of the Managed Service to enable. |

### Return type

[**\OpenAPI\Client\Model\ManagedService**](../Model/ManagedService.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedContact()`

```php
getManagedContact($contact_id): \OpenAPI\Client\Model\ManagedContact
```

Managed Contact View

Returns a single Managed Contact.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contact_id = 56; // int | The ID of the contact to access.

try {
    $result = $apiInstance->getManagedContact($contact_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedContact: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **int**| The ID of the contact to access. |

### Return type

[**\OpenAPI\Client\Model\ManagedContact**](../Model/ManagedContact.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedContacts()`

```php
getManagedContacts($page, $page_size): \OpenAPI\Client\Model\InlineResponse20035
```

Managed Contacts List

Returns a paginated list of Managed Contacts on your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getManagedContacts($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedContacts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20035**](../Model/InlineResponse20035.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedCredential()`

```php
getManagedCredential($credential_id): \OpenAPI\Client\Model\ManagedCredential
```

Managed Credential View

Returns a single Managed Credential.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$credential_id = 56; // int | The ID of the Credential to access.

try {
    $result = $apiInstance->getManagedCredential($credential_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credential_id** | **int**| The ID of the Credential to access. |

### Return type

[**\OpenAPI\Client\Model\ManagedCredential**](../Model/ManagedCredential.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedCredentials()`

```php
getManagedCredentials($page, $page_size): \OpenAPI\Client\Model\InlineResponse20036
```

Managed Credentials List

Returns a paginated list of Managed Credentials on your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getManagedCredentials($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20036**](../Model/InlineResponse20036.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedIssue()`

```php
getManagedIssue($issue_id): \OpenAPI\Client\Model\ManagedIssue
```

Managed Issue View

Returns a single Issue that is impacting or did impact one of your Managed Services.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$issue_id = 56; // int | The Issue to look up.

try {
    $result = $apiInstance->getManagedIssue($issue_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedIssue: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **issue_id** | **int**| The Issue to look up. |

### Return type

[**\OpenAPI\Client\Model\ManagedIssue**](../Model/ManagedIssue.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedIssues()`

```php
getManagedIssues($page, $page_size): \OpenAPI\Client\Model\InlineResponse20038
```

Managed Issues List

Returns a paginated list of recent and ongoing issues detected on your Managed Services.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getManagedIssues($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedIssues: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20038**](../Model/InlineResponse20038.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedLinodeSetting()`

```php
getManagedLinodeSetting($linode_id): \OpenAPI\Client\Model\ManagedLinodeSettings
```

Linode's Managed Settings View

Returns a single Linode's Managed settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The Linode ID whose settings we are accessing.

try {
    $result = $apiInstance->getManagedLinodeSetting($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedLinodeSetting: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The Linode ID whose settings we are accessing. |

### Return type

[**\OpenAPI\Client\Model\ManagedLinodeSettings**](../Model/ManagedLinodeSettings.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedLinodeSettings()`

```php
getManagedLinodeSettings($page, $page_size): \OpenAPI\Client\Model\InlineResponse20039
```

Managed Linode Settings List

Returns a paginated list of Managed Settings for your Linodes. There will be one entry per Linode on your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getManagedLinodeSettings($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedLinodeSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20039**](../Model/InlineResponse20039.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedService()`

```php
getManagedService($service_id): \OpenAPI\Client\Model\ManagedService
```

Managed Service View

Returns information about a single Managed Service on your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$service_id = 56; // int | The ID of the Managed Service to access.

try {
    $result = $apiInstance->getManagedService($service_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedService: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **service_id** | **int**| The ID of the Managed Service to access. |

### Return type

[**\OpenAPI\Client\Model\ManagedService**](../Model/ManagedService.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedServices()`

```php
getManagedServices(): \OpenAPI\Client\Model\InlineResponse20040
```

Managed Services List

Returns a paginated list of Managed Services on your Account. These are the services Linode Managed is monitoring and will report and attempt to resolve issues with.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getManagedServices();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedServices: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20040**](../Model/InlineResponse20040.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getManagedStats()`

```php
getManagedStats(): \OpenAPI\Client\Model\InlineResponse20041
```

Managed Stats List

Returns a list of Managed Stats on your Account in the form of x and y data points. You can use these data points to plot your own graph visualizations. These stats reflect the last 24 hours of combined usage across all managed Linodes on your account giving you a high-level snapshot of data for the following:   * cpu * disk * swap * network in * network out

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getManagedStats();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->getManagedStats: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20041**](../Model/InlineResponse20041.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateManagedContact()`

```php
updateManagedContact($contact_id, $managed_contact): \OpenAPI\Client\Model\ManagedContact
```

Managed Contact Update

Updates information about a Managed Contact.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contact_id = 56; // int | The ID of the contact to access.
$managed_contact = new \OpenAPI\Client\Model\ManagedContact(); // \OpenAPI\Client\Model\ManagedContact | The fields to update.

try {
    $result = $apiInstance->updateManagedContact($contact_id, $managed_contact);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->updateManagedContact: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contact_id** | **int**| The ID of the contact to access. |
 **managed_contact** | [**\OpenAPI\Client\Model\ManagedContact**](../Model/ManagedContact.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\ManagedContact**](../Model/ManagedContact.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateManagedCredential()`

```php
updateManagedCredential($credential_id, $managed_credential): \OpenAPI\Client\Model\ManagedCredential
```

Managed Credential Update

Updates the label of a Managed Credential. This endpoint does not update the username and password for a Managed Credential. To do this, use the Update Managed Credential Username and Password ([POST /managed/credentials/{credentialId}/update](https://developers.linode.com/api/docs/v4#operation/updateManagedCredentialUsernamePassword)) endpoint instead.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$credential_id = 56; // int | The ID of the Credential to access.
$managed_credential = new \OpenAPI\Client\Model\ManagedCredential(); // \OpenAPI\Client\Model\ManagedCredential | The fields to update.

try {
    $result = $apiInstance->updateManagedCredential($credential_id, $managed_credential);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->updateManagedCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credential_id** | **int**| The ID of the Credential to access. |
 **managed_credential** | [**\OpenAPI\Client\Model\ManagedCredential**](../Model/ManagedCredential.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\ManagedCredential**](../Model/ManagedCredential.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateManagedCredentialUsernamePassword()`

```php
updateManagedCredentialUsernamePassword($credential_id, $unknown_base_type): object
```

Managed Credential Username and Password Update

Updates the username and password for a Managed Credential.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$credential_id = 56; // int | The ID of the Credential to update.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The new username and password to assign to the Managed Credential.

try {
    $result = $apiInstance->updateManagedCredentialUsernamePassword($credential_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->updateManagedCredentialUsernamePassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credential_id** | **int**| The ID of the Credential to update. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The new username and password to assign to the Managed Credential. | [optional]

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

## `updateManagedLinodeSetting()`

```php
updateManagedLinodeSetting($linode_id, $managed_linode_settings): \OpenAPI\Client\Model\ManagedLinodeSettings
```

Linode's Managed Settings Update

Updates a single Linode's Managed settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The Linode ID whose settings we are accessing.
$managed_linode_settings = new \OpenAPI\Client\Model\ManagedLinodeSettings(); // \OpenAPI\Client\Model\ManagedLinodeSettings | The settings to update.

try {
    $result = $apiInstance->updateManagedLinodeSetting($linode_id, $managed_linode_settings);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->updateManagedLinodeSetting: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The Linode ID whose settings we are accessing. |
 **managed_linode_settings** | [**\OpenAPI\Client\Model\ManagedLinodeSettings**](../Model/ManagedLinodeSettings.md)| The settings to update. |

### Return type

[**\OpenAPI\Client\Model\ManagedLinodeSettings**](../Model/ManagedLinodeSettings.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateManagedService()`

```php
updateManagedService($service_id, $managed_service): \OpenAPI\Client\Model\ManagedService
```

Managed Service Update

Updates information about a Managed Service.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$service_id = 56; // int | The ID of the Managed Service to access.
$managed_service = new \OpenAPI\Client\Model\ManagedService(); // \OpenAPI\Client\Model\ManagedService | The fields to update.

try {
    $result = $apiInstance->updateManagedService($service_id, $managed_service);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->updateManagedService: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **service_id** | **int**| The ID of the Managed Service to access. |
 **managed_service** | [**\OpenAPI\Client\Model\ManagedService**](../Model/ManagedService.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\ManagedService**](../Model/ManagedService.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `viewManagedSSHKey()`

```php
viewManagedSSHKey(): \OpenAPI\Client\Model\InlineResponse20037
```

Managed SSH Key View

Returns the unique SSH public key assigned to your Linode account's Managed service. If you [add this public key](/docs/platform/linode-managed/#adding-the-public-key) to a Linode on your account, Linode special forces will be able to log in to the Linode with this key when attempting to resolve issues.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ManagedApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->viewManagedSSHKey();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ManagedApi->viewManagedSSHKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20037**](../Model/InlineResponse20037.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

# OpenAPI\Client\NetworkingApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**allocateIP()**](NetworkingApi.md#allocateIP) | **POST** /networking/ips | IP Address Allocate
[**assignIPs()**](NetworkingApi.md#assignIPs) | **POST** /networking/ipv4/assign | Linodes Assign IPs
[**createFirewallDevice()**](NetworkingApi.md#createFirewallDevice) | **POST** /networking/firewalls/{firewallId}/devices | Firewall Device Create
[**createFirewalls()**](NetworkingApi.md#createFirewalls) | **POST** /networking/firewalls | Firewall Create
[**deleteFirewall()**](NetworkingApi.md#deleteFirewall) | **DELETE** /networking/firewalls/{firewallId} | Firewall Delete
[**deleteFirewallDevice()**](NetworkingApi.md#deleteFirewallDevice) | **DELETE** /networking/firewalls/{firewallId}/devices/{deviceId} | Firewall Device Delete
[**getFirewall()**](NetworkingApi.md#getFirewall) | **GET** /networking/firewalls/{firewallId} | Firewall View
[**getFirewallDevice()**](NetworkingApi.md#getFirewallDevice) | **GET** /networking/firewalls/{firewallId}/devices/{deviceId} | Firewall Device View
[**getFirewallDevices()**](NetworkingApi.md#getFirewallDevices) | **GET** /networking/firewalls/{firewallId}/devices | Firewall Devices List
[**getFirewallRules()**](NetworkingApi.md#getFirewallRules) | **GET** /networking/firewalls/{firewallId}/rules | Firewall Rules List
[**getFirewalls()**](NetworkingApi.md#getFirewalls) | **GET** /networking/firewalls | Firewalls List
[**getIP()**](NetworkingApi.md#getIP) | **GET** /networking/ips/{address} | IP Address View
[**getIPs()**](NetworkingApi.md#getIPs) | **GET** /networking/ips | IP Addresses List
[**getIPv6Pools()**](NetworkingApi.md#getIPv6Pools) | **GET** /networking/ipv6/pools | IPv6 Pools List
[**getIPv6Ranges()**](NetworkingApi.md#getIPv6Ranges) | **GET** /networking/ipv6/ranges | IPv6 Ranges List
[**getVLANs()**](NetworkingApi.md#getVLANs) | **GET** /networking/vlans | VLANs List
[**shareIPs()**](NetworkingApi.md#shareIPs) | **POST** /networking/ipv4/share | IP Sharing Configure
[**updateFirewall()**](NetworkingApi.md#updateFirewall) | **PUT** /networking/firewalls/{firewallId} | Firewall Update
[**updateFirewallRules()**](NetworkingApi.md#updateFirewallRules) | **PUT** /networking/firewalls/{firewallId}/rules | Firewall Rules Update
[**updateIP()**](NetworkingApi.md#updateIP) | **PUT** /networking/ips/{address} | IP Address RDNS Update


## `allocateIP()`

```php
allocateIP($unknown_base_type): \OpenAPI\Client\Model\IPAddress
```

IP Address Allocate

Allocates a new IPv4 Address on your Account. The Linode must be configured to support additional addresses - please [open a support ticket](/docs/api/support/#support-ticket-open) requesting additional addresses before attempting allocation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the address you are creating.

try {
    $result = $apiInstance->allocateIP($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->allocateIP: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the address you are creating. |

### Return type

[**\OpenAPI\Client\Model\IPAddress**](../Model/IPAddress.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `assignIPs()`

```php
assignIPs($unknown_base_type): object
```

Linodes Assign IPs

Assign multiple IPs to multiple Linodes in one Region. This allows swapping, shuffling, or otherwise reorganizing IPv4 Addresses to your Linodes.  When the assignment is finished, all Linodes must end up with at least one public IPv4 and no more than one private IPv4.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about what IPv4 address to assign, and to which Linode.

try {
    $result = $apiInstance->assignIPs($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->assignIPs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about what IPv4 address to assign, and to which Linode. |

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

## `createFirewallDevice()`

```php
createFirewallDevice($firewall_id, $unknown_base_type): \OpenAPI\Client\Model\FirewallDevices
```

Firewall Device Create

Creates a Firewall Device, which assigns a Firewall to a service (referred to as the Device's `entity`) and applies the Firewall's Rules to the device.  * Currently, only Devices with an entity of type `linode` are accepted.  * A Firewall can be assigned to multiple Linode instances at a time.  * A Linode instance can have one active, assigned Firewall at a time. Additional disabled Firewalls can be assigned to a service, but they cannot be enabled if another active Firewall is already assigned to the same service.  * A `firewall_device_add` Event is generated when the Firewall Device is added successfully.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.
$unknown_base_type = array('key' => new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE()); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE

try {
    $result = $apiInstance->createFirewallDevice($firewall_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->createFirewallDevice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\FirewallDevices**](../Model/FirewallDevices.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createFirewalls()`

```php
createFirewalls($unknown_base_type): \OpenAPI\Client\Model\Firewall
```

Firewall Create

Creates a Firewall to filter network traffic.  * Use the `rules` property to create inbound and outbound access rules.  * Use the `devices` property to assign the Firewall to a service and apply its Rules to the device. Requires `read_write` [User's Grants](/docs/api/account/#users-grants-view) to the device. Currently, Firewalls can only be assigned to Linode instances.  * A Firewall can be assigned to multiple Linode instances at a time.  * A Linode instance can have one active, assigned Firewall at a time. Additional disabled Firewalls can be assigned to a service, but they cannot be enabled if another active Firewall is already assigned to the same service.  * A `firewall_create` Event is generated when this endpoint returns successfully.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Creates a Firewall object that can be applied to a Linode service to filter the service's network traffic.

try {
    $result = $apiInstance->createFirewalls($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->createFirewalls: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Creates a Firewall object that can be applied to a Linode service to filter the service&#39;s network traffic. | [optional]

### Return type

[**\OpenAPI\Client\Model\Firewall**](../Model/Firewall.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteFirewall()`

```php
deleteFirewall($firewall_id): object
```

Firewall Delete

Delete a Firewall resource by its ID. This will remove all of the Firewall's Rules from any Linode services that the Firewall was assigned to.  A `firewall_delete` Event is generated when this endpoint returns successfully.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.

try {
    $result = $apiInstance->deleteFirewall($firewall_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->deleteFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |

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

## `deleteFirewallDevice()`

```php
deleteFirewallDevice($firewall_id, $device_id): object
```

Firewall Device Delete

Removes a Firewall Device, which removes a Firewall from the Linode service it was assigned to by the Device. This will remove all of the Firewall's Rules from the Linode service. If any other Firewalls have been assigned to the Linode service, then those Rules will remain in effect.  A `firewall_device_remove` Event is generated when the Firewall Device is removed successfully.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.
$device_id = 56; // int | ID of the Firewall Device to access.

try {
    $result = $apiInstance->deleteFirewallDevice($firewall_id, $device_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->deleteFirewallDevice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |
 **device_id** | **int**| ID of the Firewall Device to access. |

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

## `getFirewall()`

```php
getFirewall($firewall_id): \OpenAPI\Client\Model\Firewall
```

Firewall View

Get a specific Firewall resource by its ID. The Firewall's Devices will not be returned in the response. Instead, use the [List Firewall Devices](/docs/api/networking/#firewall-devices-list) endpoint to review them.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.

try {
    $result = $apiInstance->getFirewall($firewall_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |

### Return type

[**\OpenAPI\Client\Model\Firewall**](../Model/Firewall.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFirewallDevice()`

```php
getFirewallDevice($firewall_id, $device_id): \OpenAPI\Client\Model\FirewallDevices
```

Firewall Device View

Returns information for a Firewall Device, which assigns a Firewall to a Linode service (referred to as the Device's `entity`). Currently, only Devices with an entity of type `linode` are accepted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.
$device_id = 56; // int | ID of the Firewall Device to access.

try {
    $result = $apiInstance->getFirewallDevice($firewall_id, $device_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getFirewallDevice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |
 **device_id** | **int**| ID of the Firewall Device to access. |

### Return type

[**\OpenAPI\Client\Model\FirewallDevices**](../Model/FirewallDevices.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFirewallDevices()`

```php
getFirewallDevices($firewall_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20045
```

Firewall Devices List

Returns a paginated list of a Firewall's Devices. A Firewall Device assigns a Firewall to a Linode service (referred to as the Device's `entity`). Currently, only Devices with an entity of type `linode` are accepted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getFirewallDevices($firewall_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getFirewallDevices: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20045**](../Model/InlineResponse20045.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFirewallRules()`

```php
getFirewallRules($firewall_id): \OpenAPI\Client\Model\Rules
```

Firewall Rules List

Returns the inbound and outbound Rules for a Firewall.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.

try {
    $result = $apiInstance->getFirewallRules($firewall_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getFirewallRules: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |

### Return type

[**\OpenAPI\Client\Model\Rules**](../Model/Rules.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFirewalls()`

```php
getFirewalls($page, $page_size): \OpenAPI\Client\Model\InlineResponse20021
```

Firewalls List

Returns a paginated list of accessible Firewalls.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getFirewalls($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getFirewalls: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20021**](../Model/InlineResponse20021.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getIP()`

```php
getIP($address): \OpenAPI\Client\Model\IPAddress
```

IP Address View

Returns information about a single IP Address on your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$address = 'address_example'; // string | The address to operate on.

try {
    $result = $apiInstance->getIP($address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getIP: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **address** | **string**| The address to operate on. |

### Return type

[**\OpenAPI\Client\Model\IPAddress**](../Model/IPAddress.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getIPs()`

```php
getIPs(): \OpenAPI\Client\Model\InlineResponse20042
```

IP Addresses List

Returns a paginated list of IP Addresses on your Account, excluding private addresses.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getIPs();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getIPs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20042**](../Model/InlineResponse20042.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getIPv6Pools()`

```php
getIPv6Pools($page, $page_size): \OpenAPI\Client\Model\InlineResponse20043
```

IPv6 Pools List

Displays the IPv6 pools on your Account. A pool of IPv6 addresses are routed to all of your Linodes in a single [Region](/docs/api/regions/#regions-list). Any Linode on your Account may bring up any address in this pool at any time, with no external configuration required.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getIPv6Pools($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getIPv6Pools: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20043**](../Model/InlineResponse20043.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getIPv6Ranges()`

```php
getIPv6Ranges($page, $page_size): \OpenAPI\Client\Model\InlineResponse20044
```

IPv6 Ranges List

Displays the IPv6 ranges on your Account.     * An IPv6 range is a `/64` block of IPv6 addresses routed to a single Linode in a given [Region](/docs/api/regions/#regions-list).    * Your Linode is responsible for routing individual addresses in the range, or handling traffic for all the addresses in the range.    * You must [open a support ticket](/docs/api/support/#support-ticket-open) to request a `/64` block of IPv6 addresses to be added to your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getIPv6Ranges($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getIPv6Ranges: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20044**](../Model/InlineResponse20044.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getVLANs()`

```php
getVLANs($page, $page_size): \OpenAPI\Client\Model\InlineResponse20046
```

VLANs List

Returns a list of all Virtual Local Area Networks (VLANs) on your Account. VLANs provide a mechanism for secure communication between two or more Linodes that are assigned to the same VLAN and are both within the same Layer 2 broadcast domain.  VLANs are created and attached to Linodes by using the `interfaces` property for the following endpoints:  - Linode Create ([POST /linode/instances](/docs/api/linode-instances/#linode-create)) - Configuration Profile Create ([POST /linode/instances/{linodeId}/configs](/docs/api/linode-instances/#configuration-profile-create)) - Configuration Profile Update ([PUT /linode/instances/{linodeId}/configs/{configId}](/docs/api/linode-instances/#configuration-profile-update))  There are several ways to detach a VLAN from a Linode:  - [Update](/docs/api/linode-instances/#configuration-profile-update) the active Configuration Profile to remove the VLAN interface, then [reboot](/docs/api/linode-instances/#linode-reboot) the Linode. - [Create](/docs/api/linode-instances/#configuration-profile-create) a new Configuration Profile without the VLAN interface, then [reboot](/docs/api/linode-instances/#linode-reboot) the Linode into the new Configuration Profile. - [Delete](/docs/api/linode-instances/#linode-delete) the Linode.  **Note:** Only Next Generation Network (NGN) data centers support VLANs. Use the Regions ([/regions](/docs/api/regions/)) endpoint to view the capabilities of data center regions. If a VLAN is attached to your Linode and you attempt to migrate or clone it to a non-NGN data center, the migration or cloning will not initiate. If a Linode cannot be migrated because of an incompatibility, you will be prompted to select a different data center or contact support.  **Note:** See our guide on [Getting Started with VLANs](/docs/guides/getting-started-with-vlans/) to view additional [limitations](/docs/guides/getting-started-with-vlans/#limitations).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getVLANs($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->getVLANs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20046**](../Model/InlineResponse20046.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `shareIPs()`

```php
shareIPs($unknown_base_type): object
```

IP Sharing Configure

Configure shared IPs.  A shared IP may be brought up on a Linode other than the one it lists in its response.  This can be used to allow one Linode to begin serving requests should another become unresponsive.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about what IPs to share with which Linode.

try {
    $result = $apiInstance->shareIPs($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->shareIPs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about what IPs to share with which Linode. |

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

## `updateFirewall()`

```php
updateFirewall($firewall_id, $inline_object14): \OpenAPI\Client\Model\Firewall
```

Firewall Update

Updates information for a Firewall. Some parts of a Firewall's configuration cannot be manipulated by this endpoint:  - A Firewall's Devices cannot be set with this endpoint. Instead, use the [Create Firewall Device](/docs/api/networking/#firewall-device-create) and [Delete Firewall Device](/docs/api/networking/#firewall-device-delete) endpoints to assign and remove this Firewall from Linode services.  - A Firewall's Rules cannot be changed with this endpoint. Instead, use the [Update Firewall Rules](/docs/api/networking/#firewall-rules-update) endpoint to update your Rules.  - A Firewall's status can be set to `enabled` or `disabled` by this endpoint, but it cannot be set to `deleted`. Instead, use the [Delete Firewall](/docs/api/networking/#firewall-delete) endpoint to delete a Firewall.  If a Firewall's status is changed with this endpoint, a corresponding `firewall_enable` or `firewall_disable` Event will be generated.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.
$inline_object14 = new \OpenAPI\Client\Model\InlineObject14(); // \OpenAPI\Client\Model\InlineObject14

try {
    $result = $apiInstance->updateFirewall($firewall_id, $inline_object14);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->updateFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |
 **inline_object14** | [**\OpenAPI\Client\Model\InlineObject14**](../Model/InlineObject14.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Firewall**](../Model/Firewall.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateFirewallRules()`

```php
updateFirewallRules($firewall_id, $unknown_base_type): \OpenAPI\Client\Model\Rules
```

Firewall Rules Update

Updates the inbound and outbound Rules for a Firewall.  **Note:** This command replaces all of a Firewall's `inbound` and/or `outbound` rulesets with the values specified in your request.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firewall_id = 56; // int | ID of the Firewall to access.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The Firewall Rules information to update.

try {
    $result = $apiInstance->updateFirewallRules($firewall_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->updateFirewallRules: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **firewall_id** | **int**| ID of the Firewall to access. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The Firewall Rules information to update. | [optional]

### Return type

[**\OpenAPI\Client\Model\Rules**](../Model/Rules.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateIP()`

```php
updateIP($address, $ip_address): \OpenAPI\Client\Model\IPAddress
```

IP Address RDNS Update

Sets RDNS on an IP Address. Forward DNS must already be set up for reverse DNS to be applied. If you set the RDNS to `null` for public IPv4 addresses, it will be reset to the default _ip.linodeusercontent.com_ RDNS value.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\NetworkingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$address = 'address_example'; // string | The address to operate on.
$ip_address = new \OpenAPI\Client\Model\IPAddress(); // \OpenAPI\Client\Model\IPAddress | The information to update.

try {
    $result = $apiInstance->updateIP($address, $ip_address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkingApi->updateIP: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **address** | **string**| The address to operate on. |
 **ip_address** | [**\OpenAPI\Client\Model\IPAddress**](../Model/IPAddress.md)| The information to update. |

### Return type

[**\OpenAPI\Client\Model\IPAddress**](../Model/IPAddress.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

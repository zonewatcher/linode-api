# OpenAPI\Client\LinodeInstancesApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addLinodeConfig()**](LinodeInstancesApi.md#addLinodeConfig) | **POST** /linode/instances/{linodeId}/configs | Configuration Profile Create
[**addLinodeDisk()**](LinodeInstancesApi.md#addLinodeDisk) | **POST** /linode/instances/{linodeId}/disks | Disk Create
[**addLinodeIP()**](LinodeInstancesApi.md#addLinodeIP) | **POST** /linode/instances/{linodeId}/ips | IPv4 Address Allocate
[**bootLinodeInstance()**](LinodeInstancesApi.md#bootLinodeInstance) | **POST** /linode/instances/{linodeId}/boot | Linode Boot
[**cancelBackups()**](LinodeInstancesApi.md#cancelBackups) | **POST** /linode/instances/{linodeId}/backups/cancel | Backups Cancel
[**cloneLinodeDisk()**](LinodeInstancesApi.md#cloneLinodeDisk) | **POST** /linode/instances/{linodeId}/disks/{diskId}/clone | Disk Clone
[**cloneLinodeInstance()**](LinodeInstancesApi.md#cloneLinodeInstance) | **POST** /linode/instances/{linodeId}/clone | Linode Clone
[**createLinodeInstance()**](LinodeInstancesApi.md#createLinodeInstance) | **POST** /linode/instances | Linode Create
[**createSnapshot()**](LinodeInstancesApi.md#createSnapshot) | **POST** /linode/instances/{linodeId}/backups | Snapshot Create
[**deleteDisk()**](LinodeInstancesApi.md#deleteDisk) | **DELETE** /linode/instances/{linodeId}/disks/{diskId} | Disk Delete
[**deleteLinodeConfig()**](LinodeInstancesApi.md#deleteLinodeConfig) | **DELETE** /linode/instances/{linodeId}/configs/{configId} | Configuration Profile Delete
[**deleteLinodeInstance()**](LinodeInstancesApi.md#deleteLinodeInstance) | **DELETE** /linode/instances/{linodeId} | Linode Delete
[**enableBackups()**](LinodeInstancesApi.md#enableBackups) | **POST** /linode/instances/{linodeId}/backups/enable | Backups Enable
[**getBackup()**](LinodeInstancesApi.md#getBackup) | **GET** /linode/instances/{linodeId}/backups/{backupId} | Backup View
[**getBackups()**](LinodeInstancesApi.md#getBackups) | **GET** /linode/instances/{linodeId}/backups | Backups List
[**getKernel()**](LinodeInstancesApi.md#getKernel) | **GET** /linode/kernels/{kernelId} | Kernel View
[**getKernels()**](LinodeInstancesApi.md#getKernels) | **GET** /linode/kernels | Kernels List
[**getLinodeConfig()**](LinodeInstancesApi.md#getLinodeConfig) | **GET** /linode/instances/{linodeId}/configs/{configId} | Configuration Profile View
[**getLinodeConfigs()**](LinodeInstancesApi.md#getLinodeConfigs) | **GET** /linode/instances/{linodeId}/configs | Configuration Profiles List
[**getLinodeDisk()**](LinodeInstancesApi.md#getLinodeDisk) | **GET** /linode/instances/{linodeId}/disks/{diskId} | Disk View
[**getLinodeDisks()**](LinodeInstancesApi.md#getLinodeDisks) | **GET** /linode/instances/{linodeId}/disks | Disks List
[**getLinodeFirewalls()**](LinodeInstancesApi.md#getLinodeFirewalls) | **GET** /linode/instances/{linodeId}/firewalls | Firewalls List
[**getLinodeIP()**](LinodeInstancesApi.md#getLinodeIP) | **GET** /linode/instances/{linodeId}/ips/{address} | IP Address View
[**getLinodeIPs()**](LinodeInstancesApi.md#getLinodeIPs) | **GET** /linode/instances/{linodeId}/ips | Networking Information List
[**getLinodeInstance()**](LinodeInstancesApi.md#getLinodeInstance) | **GET** /linode/instances/{linodeId} | Linode View
[**getLinodeInstances()**](LinodeInstancesApi.md#getLinodeInstances) | **GET** /linode/instances | Linodes List
[**getLinodeNodeBalancers()**](LinodeInstancesApi.md#getLinodeNodeBalancers) | **GET** /linode/instances/{linodeId}/nodebalancers | Linode NodeBalancers View
[**getLinodeStats()**](LinodeInstancesApi.md#getLinodeStats) | **GET** /linode/instances/{linodeId}/stats | Linode Statistics View
[**getLinodeStatsByYearMonth()**](LinodeInstancesApi.md#getLinodeStatsByYearMonth) | **GET** /linode/instances/{linodeId}/stats/{year}/{month} | Statistics View (year/month)
[**getLinodeTransfer()**](LinodeInstancesApi.md#getLinodeTransfer) | **GET** /linode/instances/{linodeId}/transfer | Network Transfer View
[**getLinodeTransferByYearMonth()**](LinodeInstancesApi.md#getLinodeTransferByYearMonth) | **GET** /linode/instances/{linodeId}/transfer/{year}/{month} | Network Transfer View (year/month)
[**getLinodeVolumes()**](LinodeInstancesApi.md#getLinodeVolumes) | **GET** /linode/instances/{linodeId}/volumes | Linode&#39;s Volumes List
[**migrateLinodeInstance()**](LinodeInstancesApi.md#migrateLinodeInstance) | **POST** /linode/instances/{linodeId}/migrate | DC Migration/Pending Host Migration Initiate
[**mutateLinodeInstance()**](LinodeInstancesApi.md#mutateLinodeInstance) | **POST** /linode/instances/{linodeId}/mutate | Linode Upgrade
[**rebootLinodeInstance()**](LinodeInstancesApi.md#rebootLinodeInstance) | **POST** /linode/instances/{linodeId}/reboot | Linode Reboot
[**rebuildLinodeInstance()**](LinodeInstancesApi.md#rebuildLinodeInstance) | **POST** /linode/instances/{linodeId}/rebuild | Linode Rebuild
[**removeLinodeIP()**](LinodeInstancesApi.md#removeLinodeIP) | **DELETE** /linode/instances/{linodeId}/ips/{address} | IPv4 Address Delete
[**rescueLinodeInstance()**](LinodeInstancesApi.md#rescueLinodeInstance) | **POST** /linode/instances/{linodeId}/rescue | Linode Boot into Rescue Mode
[**resetDiskPassword()**](LinodeInstancesApi.md#resetDiskPassword) | **POST** /linode/instances/{linodeId}/disks/{diskId}/password | Disk Root Password Reset
[**resetLinodePassword()**](LinodeInstancesApi.md#resetLinodePassword) | **POST** /linode/instances/{linodeId}/password | Linode Root Password Reset
[**resizeDisk()**](LinodeInstancesApi.md#resizeDisk) | **POST** /linode/instances/{linodeId}/disks/{diskId}/resize | Disk Resize
[**resizeLinodeInstance()**](LinodeInstancesApi.md#resizeLinodeInstance) | **POST** /linode/instances/{linodeId}/resize | Linode Resize
[**restoreBackup()**](LinodeInstancesApi.md#restoreBackup) | **POST** /linode/instances/{linodeId}/backups/{backupId}/restore | Backup Restore
[**shutdownLinodeInstance()**](LinodeInstancesApi.md#shutdownLinodeInstance) | **POST** /linode/instances/{linodeId}/shutdown | Linode Shut Down
[**updateDisk()**](LinodeInstancesApi.md#updateDisk) | **PUT** /linode/instances/{linodeId}/disks/{diskId} | Disk Update
[**updateLinodeConfig()**](LinodeInstancesApi.md#updateLinodeConfig) | **PUT** /linode/instances/{linodeId}/configs/{configId} | Configuration Profile Update
[**updateLinodeIP()**](LinodeInstancesApi.md#updateLinodeIP) | **PUT** /linode/instances/{linodeId}/ips/{address} | IP Address Update
[**updateLinodeInstance()**](LinodeInstancesApi.md#updateLinodeInstance) | **PUT** /linode/instances/{linodeId} | Linode Update


## `addLinodeConfig()`

```php
addLinodeConfig($linode_id, $unknown_base_type): \OpenAPI\Client\Model\LinodeConfig
```

Configuration Profile Create

Adds a new Configuration profile to a Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up Configuration profiles for.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The parameters to set when creating the Configuration profile. This determines which kernel, devices, how much memory, etc. a Linode boots with.

try {
    $result = $apiInstance->addLinodeConfig($linode_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->addLinodeConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up Configuration profiles for. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The parameters to set when creating the Configuration profile. This determines which kernel, devices, how much memory, etc. a Linode boots with. |

### Return type

[**\OpenAPI\Client\Model\LinodeConfig**](../Model/LinodeConfig.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addLinodeDisk()`

```php
addLinodeDisk($linode_id, $unknown_base_type): \OpenAPI\Client\Model\Disk
```

Disk Create

Adds a new Disk to a Linode.  * You can optionally create a Disk from an Image or an Empty Disk if no Image is provided with a request.  * When creating an Empty Disk, providing a `label` is required.  * If no `label` is provided, an `image` is required instead.  * When creating a Disk from an Image, `root_pass` is required.  * The default filesystem for new Disks is `ext4`. If creating a Disk from an Image, the filesystem of the Image is used unless otherwise specified.  * When deploying a StackScript on a Disk:   * See StackScripts List ([GET /linode/stackscripts](/docs/api/stackscripts/#stackscripts-list)) for     a list of available StackScripts.   * Requires a compatible Image to be supplied.     * See StackScript View ([GET /linode/stackscript/{stackscriptId}](/docs/api/stackscripts/#stackscript-view)) for compatible Images.   * It is recommended to supply SSH keys for the root User using the `authorized_keys` field.   * You may also supply a list of usernames via the `authorized_users` field.     * These users must have an SSH Key associated with their Profiles first. See SSH Key Add ([POST /profile/sshkeys](/docs/api/profile/#ssh-key-add)) for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The parameters to set when creating the Disk.

try {
    $result = $apiInstance->addLinodeDisk($linode_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->addLinodeDisk: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The parameters to set when creating the Disk. |

### Return type

[**\OpenAPI\Client\Model\Disk**](../Model/Disk.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `addLinodeIP()`

```php
addLinodeIP($linode_id, $unknown_base_type): \OpenAPI\Client\Model\IPAddress
```

IPv4 Address Allocate

Allocates a public or private IPv4 address to a Linode. Public IP Addresses, after the one included with each Linode, incur an additional monthly charge. If you need an additional public IP Address you must request one - please [open a support ticket](/docs/api/support/#support-ticket-open). You may not add more than one private IPv4 address to a single Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the address you are creating.

try {
    $result = $apiInstance->addLinodeIP($linode_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->addLinodeIP: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
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

## `bootLinodeInstance()`

```php
bootLinodeInstance($linode_id, $inline_object8): object
```

Linode Boot

Boots a Linode you have permission to modify. If no parameters are given, a Config profile will be chosen for this boot based on the following criteria:  * If there is only one Config profile for this Linode, it will be used. * If there is more than one Config profile, the last booted config will be used. * If there is more than one Config profile and none were the last to be booted (because the   Linode was never booted or the last booted config was deleted) an error will be returned.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode to boot.
$inline_object8 = new \OpenAPI\Client\Model\InlineObject8(); // \OpenAPI\Client\Model\InlineObject8

try {
    $result = $apiInstance->bootLinodeInstance($linode_id, $inline_object8);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->bootLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode to boot. |
 **inline_object8** | [**\OpenAPI\Client\Model\InlineObject8**](../Model/InlineObject8.md)|  | [optional]

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

## `cancelBackups()`

```php
cancelBackups($linode_id): object
```

Backups Cancel

Cancels the Backup service on the given Linode. Deletes all of this Linode's existing backups forever.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode to cancel backup service for.

try {
    $result = $apiInstance->cancelBackups($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->cancelBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode to cancel backup service for. |

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

## `cloneLinodeDisk()`

```php
cloneLinodeDisk($linode_id, $disk_id): \OpenAPI\Client\Model\Disk
```

Disk Clone

Copies a disk, byte-for-byte, into a new Disk belonging to the same Linode. The Linode must have enough storage space available to accept a new Disk of the same size as this one or this operation will fail.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$disk_id = 56; // int | ID of the Disk to clone.

try {
    $result = $apiInstance->cloneLinodeDisk($linode_id, $disk_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->cloneLinodeDisk: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **disk_id** | **int**| ID of the Disk to clone. |

### Return type

[**\OpenAPI\Client\Model\Disk**](../Model/Disk.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `cloneLinodeInstance()`

```php
cloneLinodeInstance($linode_id, $inline_object9): \OpenAPI\Client\Model\Linode
```

Linode Clone

You can clone your Linode's existing Disks or Configuration profiles to another Linode on your Account. In order for this request to complete successfully, your User must have the `add_linodes` grant. Cloning to a new Linode will incur a charge on your Account.  If cloning to an existing Linode, any actions currently running or queued must be completed first before you can clone to it.  Up to five clone operations from any given source Linode can be run concurrently. If more concurrent clones are attempted, an HTTP 400 error will be returned by this endpoint.  Any [tags](/docs/api/tags/#tags-list) existing on the source Linode will be cloned to the target Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to clone.
$inline_object9 = new \OpenAPI\Client\Model\InlineObject9(); // \OpenAPI\Client\Model\InlineObject9

try {
    $result = $apiInstance->cloneLinodeInstance($linode_id, $inline_object9);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->cloneLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to clone. |
 **inline_object9** | [**\OpenAPI\Client\Model\InlineObject9**](../Model/InlineObject9.md)|  |

### Return type

[**\OpenAPI\Client\Model\Linode**](../Model/Linode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createLinodeInstance()`

```php
createLinodeInstance($unknown_base_type): \OpenAPI\Client\Model\Linode
```

Linode Create

Creates a Linode Instance on your Account. In order for this request to complete successfully, your User must have the `add_linodes` grant. Creating a new Linode will incur a charge on your Account.  Linodes can be created using one of the available Types. See Types List ([GET /linode/types](/docs/api/linode-types/#types-list)) to get more information about each Type's specs and cost.  Linodes can be created in any one of our available Regions, which are accessible from the Regions List ([GET /regions](/docs/api/regions/#regions-list)) endpoint.  In an effort to fight spam, Linode restricts outbound connections on ports 25, 465, and 587 on all Linodes for new accounts created after November 5th, 2019. For more information, see [Sending Email on Linode](/docs/email/running-a-mail-server/#sending-email-on-linode).  Linodes can be created in a number of ways:  * Using a Linode Public Image distribution or a Private Image you created based on another Linode.   * Access the Images List ([GET /images](/docs/api/images/#images-list)) endpoint with authentication to view     all available Images.   * The Linode will be `running` after it completes `provisioning`.   * A default config with two Disks, one being a 512 swap disk, is created.     * `swap_size` can be used to customize the swap disk size.   * Requires a `root_pass` be supplied to use for the root User's Account.   * It is recommended to supply SSH keys for the root User using the `authorized_keys` field.   * You may also supply a list of usernames via the `authorized_users` field.     * These users must have an SSH Key associated with your Profile first. See SSH Key Add ([POST /profile/sshkeys](/docs/api/profile/#ssh-key-add)) for more information.  * Using a StackScript.   * See StackScripts List ([GET /linode/stackscripts](/docs/api/stackscripts/#stackscripts-list)) for     a list of available StackScripts.   * The Linode will be `running` after it completes `provisioning`.   * Requires a compatible Image to be supplied.     * See StackScript View ([GET /linode/stackscript/{stackscriptId}](/docs/api/stackscripts/#stackscript-view)) for compatible Images.   * Requires a `root_pass` be supplied to use for the root User's Account.   * It is recommended to supply SSH keys for the root User using the `authorized_keys` field.   * You may also supply a list of usernames via the `authorized_users` field.     * These users must have an SSH Key associated with your Profile first. See SSH Key Add ([POST /profile/sshkeys](/docs/api/profile/#ssh-key-add)) for more information.  * Using one of your other Linode's backups.   * You must create a Linode large enough to accommodate the Backup's size.   * The Disks and Config will match that of the Linode that was backed up.   * The `root_pass` will match that of the Linode that was backed up.  * Attached to a private VLAN.   * Review the `interfaces` property of the [Request Body Schema](/docs/api/linode-instances/#linode-create__request-body-schema) for details.   * For more information, see our guide on [Getting Started with VLANs](/docs/guides/getting-started-with-vlans/).  * Create an empty Linode.   * The Linode will remain `offline` and must be manually started.     * See Linode Boot ([POST /linode/instances/{linodeId}/boot](/docs/api/linode-instances/#linode-boot)).   * Disks and Configs must be created manually.   * This is only recommended for advanced use cases.  **Important**: You must be an unrestricted User in order to add or modify tags on Linodes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = array('key' => new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE()); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The requested initial state of a new Linode.

try {
    $result = $apiInstance->createLinodeInstance($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->createLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The requested initial state of a new Linode. |

### Return type

[**\OpenAPI\Client\Model\Linode**](../Model/Linode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createSnapshot()`

```php
createSnapshot($linode_id, $inline_object6): \OpenAPI\Client\Model\Backup
```

Snapshot Create

Creates a snapshot Backup of a Linode.  **Important:** If you already have a snapshot of this Linode, this is a destructive action. The previous snapshot will be deleted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode the backups belong to.
$inline_object6 = new \OpenAPI\Client\Model\InlineObject6(); // \OpenAPI\Client\Model\InlineObject6

try {
    $result = $apiInstance->createSnapshot($linode_id, $inline_object6);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->createSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode the backups belong to. |
 **inline_object6** | [**\OpenAPI\Client\Model\InlineObject6**](../Model/InlineObject6.md)|  |

### Return type

[**\OpenAPI\Client\Model\Backup**](../Model/Backup.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDisk()`

```php
deleteDisk($linode_id, $disk_id): object
```

Disk Delete

Deletes a Disk you have permission to `read_write`.  **Deleting a Disk is a destructive action and cannot be undone.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$disk_id = 56; // int | ID of the Disk to look up.

try {
    $result = $apiInstance->deleteDisk($linode_id, $disk_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->deleteDisk: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **disk_id** | **int**| ID of the Disk to look up. |

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

## `deleteLinodeConfig()`

```php
deleteLinodeConfig($linode_id, $config_id): object
```

Configuration Profile Delete

Deletes the specified Configuration profile from the specified Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode whose Configuration profile to look up.
$config_id = 56; // int | The ID of the Configuration profile to look up.

try {
    $result = $apiInstance->deleteLinodeConfig($linode_id, $config_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->deleteLinodeConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode whose Configuration profile to look up. |
 **config_id** | **int**| The ID of the Configuration profile to look up. |

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

## `deleteLinodeInstance()`

```php
deleteLinodeInstance($linode_id): object
```

Linode Delete

Deletes a Linode you have permission to `read_write`.  **Deleting a Linode is a destructive action and cannot be undone.**  Additionally, deleting a Linode:    * Gives up any IP addresses the Linode was assigned.   * Deletes all Disks, Backups, Configs, etc.   * Stops billing for the Linode and its associated services. You will be billed for time used     within the billing period the Linode was active.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up

try {
    $result = $apiInstance->deleteLinodeInstance($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->deleteLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up |

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

## `enableBackups()`

```php
enableBackups($linode_id): object
```

Backups Enable

Enables backups for the specified Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode to enable backup service for.

try {
    $result = $apiInstance->enableBackups($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->enableBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode to enable backup service for. |

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

## `getBackup()`

```php
getBackup($linode_id, $backup_id): \OpenAPI\Client\Model\Backup
```

Backup View

Returns information about a Backup.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode the Backup belongs to.
$backup_id = 56; // int | The ID of the Backup to look up.

try {
    $result = $apiInstance->getBackup($linode_id, $backup_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getBackup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode the Backup belongs to. |
 **backup_id** | **int**| The ID of the Backup to look up. |

### Return type

[**\OpenAPI\Client\Model\Backup**](../Model/Backup.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getBackups()`

```php
getBackups($linode_id): \OpenAPI\Client\Model\InlineResponse20018
```

Backups List

Returns information about this Linode's available backups.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode the backups belong to.

try {
    $result = $apiInstance->getBackups($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode the backups belong to. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20018**](../Model/InlineResponse20018.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getKernel()`

```php
getKernel($kernel_id): \OpenAPI\Client\Model\Kernel
```

Kernel View

Returns information about a single Kernel.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$kernel_id = 'kernel_id_example'; // string | ID of the Kernel to look up.

try {
    $result = $apiInstance->getKernel($kernel_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getKernel: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **kernel_id** | **string**| ID of the Kernel to look up. |

### Return type

[**\OpenAPI\Client\Model\Kernel**](../Model/Kernel.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getKernels()`

```php
getKernels($page, $page_size): \OpenAPI\Client\Model\InlineResponse20022
```

Kernels List

Lists available Kernels.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getKernels($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getKernels: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20022**](../Model/InlineResponse20022.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeConfig()`

```php
getLinodeConfig($linode_id, $config_id): \OpenAPI\Client\Model\LinodeConfig
```

Configuration Profile View

Returns information about a specific Configuration profile.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode whose Configuration profile to look up.
$config_id = 56; // int | The ID of the Configuration profile to look up.

try {
    $result = $apiInstance->getLinodeConfig($linode_id, $config_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode whose Configuration profile to look up. |
 **config_id** | **int**| The ID of the Configuration profile to look up. |

### Return type

[**\OpenAPI\Client\Model\LinodeConfig**](../Model/LinodeConfig.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeConfigs()`

```php
getLinodeConfigs($linode_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20019
```

Configuration Profiles List

Lists Configuration profiles associated with a Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up Configuration profiles for.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getLinodeConfigs($linode_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeConfigs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up Configuration profiles for. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20019**](../Model/InlineResponse20019.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeDisk()`

```php
getLinodeDisk($linode_id, $disk_id): \OpenAPI\Client\Model\Disk
```

Disk View

View Disk information for a Disk associated with this Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$disk_id = 56; // int | ID of the Disk to look up.

try {
    $result = $apiInstance->getLinodeDisk($linode_id, $disk_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeDisk: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **disk_id** | **int**| ID of the Disk to look up. |

### Return type

[**\OpenAPI\Client\Model\Disk**](../Model/Disk.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeDisks()`

```php
getLinodeDisks($linode_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20020
```

Disks List

View Disk information for Disks associated with this Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getLinodeDisks($linode_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeDisks: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20020**](../Model/InlineResponse20020.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeFirewalls()`

```php
getLinodeFirewalls($linode_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20021
```

Firewalls List

View Firewall information for Firewalls associated with this Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getLinodeFirewalls($linode_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeFirewalls: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
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

## `getLinodeIP()`

```php
getLinodeIP($linode_id, $address): \OpenAPI\Client\Model\IPAddress
```

IP Address View

View information about the specified IP address associated with the specified Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode to look up.
$address = 'address_example'; // string | The IP address to look up.

try {
    $result = $apiInstance->getLinodeIP($linode_id, $address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeIP: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode to look up. |
 **address** | **string**| The IP address to look up. |

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

## `getLinodeIPs()`

```php
getLinodeIPs($linode_id): object
```

Networking Information List

Returns networking information for a single Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.

try {
    $result = $apiInstance->getLinodeIPs($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeIPs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |

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

## `getLinodeInstance()`

```php
getLinodeInstance($linode_id): \OpenAPI\Client\Model\Linode
```

Linode View

Get a specific Linode by ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up

try {
    $result = $apiInstance->getLinodeInstance($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up |

### Return type

[**\OpenAPI\Client\Model\Linode**](../Model/Linode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeInstances()`

```php
getLinodeInstances($page, $page_size): \OpenAPI\Client\Model\InlineResponse20017
```

Linodes List

Returns a paginated list of Linodes you have permission to view.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getLinodeInstances($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeInstances: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20017**](../Model/InlineResponse20017.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeNodeBalancers()`

```php
getLinodeNodeBalancers($linode_id): \OpenAPI\Client\Model\InlineResponse20023
```

Linode NodeBalancers View

Returns a list of NodeBalancers that are assigned to this Linode and readable by the requesting User.  Read permission to a NodeBalancer can be given to a User by accessing the User's Grants Update ([PUT /account/users/{username}/grants](/docs/api/account/#users-grants-update)) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up

try {
    $result = $apiInstance->getLinodeNodeBalancers($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeNodeBalancers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20023**](../Model/InlineResponse20023.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeStats()`

```php
getLinodeStats($linode_id): \OpenAPI\Client\Model\LinodeStats
```

Linode Statistics View

Returns CPU, IO, IPv4, and IPv6 statistics for your Linode for the past 24 hours.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.

try {
    $result = $apiInstance->getLinodeStats($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeStats: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |

### Return type

[**\OpenAPI\Client\Model\LinodeStats**](../Model/LinodeStats.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeStatsByYearMonth()`

```php
getLinodeStatsByYearMonth($linode_id, $year, $month): \OpenAPI\Client\Model\LinodeStats
```

Statistics View (year/month)

Returns statistics for a specific month. The year/month values must be either a date in the past, or the current month. If the current month, statistics will be retrieved for the past 30 days.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$year = 56; // int | Numeric value representing the year to look up.
$month = 56; // int | Numeric value representing the month to look up.

try {
    $result = $apiInstance->getLinodeStatsByYearMonth($linode_id, $year, $month);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeStatsByYearMonth: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **year** | **int**| Numeric value representing the year to look up. |
 **month** | **int**| Numeric value representing the month to look up. |

### Return type

[**\OpenAPI\Client\Model\LinodeStats**](../Model/LinodeStats.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLinodeTransfer()`

```php
getLinodeTransfer($linode_id): object
```

Network Transfer View

Returns a Linode's network transfer pool statistics for the current month.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.

try {
    $result = $apiInstance->getLinodeTransfer($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |

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

## `getLinodeTransferByYearMonth()`

```php
getLinodeTransferByYearMonth($linode_id, $year, $month): object
```

Network Transfer View (year/month)

Returns a Linode's network transfer statistics for a specific month. The year/month values must be either a date in the past, or the current month.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$year = 56; // int | Numeric value representing the year to look up.
$month = 56; // int | Numeric value representing the month to look up.

try {
    $result = $apiInstance->getLinodeTransferByYearMonth($linode_id, $year, $month);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeTransferByYearMonth: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **year** | **int**| Numeric value representing the year to look up. |
 **month** | **int**| Numeric value representing the month to look up. |

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

## `getLinodeVolumes()`

```php
getLinodeVolumes($linode_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse20024
```

Linode's Volumes List

View Block Storage Volumes attached to this Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getLinodeVolumes($linode_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->getLinodeVolumes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
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

## `migrateLinodeInstance()`

```php
migrateLinodeInstance($linode_id, $unknown_base_type): object
```

DC Migration/Pending Host Migration Initiate

Initiate a pending host migration that has been scheduled by Linode or initiate a cross data center (DC) migration.  A list of pending migrations, if any, can be accessed from [GET /account/notifications](/docs/api/account/#notifications-list). When the migration begins, your Linode will be shutdown if not already off. If the migration initiated the shutdown, it will reboot the Linode when completed.  To initiate a cross DC migration, you must pass a `region` parameter to the request body specifying the target data center region. You can view a list of all available regions and their feature capabilities from [GET /regions](/docs/api/regions/#regions-list). If your Linode has a DC migration already queued or you have initiated a previously scheduled migration, you will not be able to initiate a DC migration until it has completed.  **Note:** Next Generation Network (NGN) data centers do not support IPv6 `/116` pools or IP Failover. If you have these features enabled on your Linode and attempt to migrate to an NGN data center, the migration will not initiate. If a Linode cannot be migrated because of an incompatibility, you will be prompted to select a different data center or contact support.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to migrate.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE

try {
    $result = $apiInstance->migrateLinodeInstance($linode_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->migrateLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to migrate. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)|  | [optional]

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

## `mutateLinodeInstance()`

```php
mutateLinodeInstance($linode_id, $inline_object10): object
```

Linode Upgrade

Linodes created with now-deprecated Types are entitled to a free upgrade to the next generation. A mutating Linode will be allocated any new resources the upgraded Type provides, and will be subsequently restarted if it was currently running. If any actions are currently running or queued, those actions must be completed first before you can initiate a mutate.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to mutate.
$inline_object10 = new \OpenAPI\Client\Model\InlineObject10(); // \OpenAPI\Client\Model\InlineObject10

try {
    $result = $apiInstance->mutateLinodeInstance($linode_id, $inline_object10);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->mutateLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to mutate. |
 **inline_object10** | [**\OpenAPI\Client\Model\InlineObject10**](../Model/InlineObject10.md)|  | [optional]

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

## `rebootLinodeInstance()`

```php
rebootLinodeInstance($linode_id, $unknown_base_type): object
```

Linode Reboot

Reboots a Linode you have permission to modify. If any actions are currently running or queued, those actions must be completed first before you can initiate a reboot.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the linode to reboot.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Optional reboot parameters.

try {
    $result = $apiInstance->rebootLinodeInstance($linode_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->rebootLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the linode to reboot. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Optional reboot parameters. | [optional]

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

## `rebuildLinodeInstance()`

```php
rebuildLinodeInstance($linode_id, $unknown_base_type): \OpenAPI\Client\Model\Linode
```

Linode Rebuild

Rebuilds a Linode you have the `read_write` permission to modify. A rebuild will first shut down the Linode, delete all disks and configs on the Linode, and then deploy a new `image` to the Linode with the given attributes. Additionally:    * Requires an `image` be supplied.   * Requires a `root_pass` be supplied to use for the root User's Account.   * It is recommended to supply SSH keys for the root User using the     `authorized_keys` field.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to rebuild.
$unknown_base_type = array('key' => new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE()); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The requested state your Linode will be rebuilt into.

try {
    $result = $apiInstance->rebuildLinodeInstance($linode_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->rebuildLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to rebuild. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The requested state your Linode will be rebuilt into. |

### Return type

[**\OpenAPI\Client\Model\Linode**](../Model/Linode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `removeLinodeIP()`

```php
removeLinodeIP($linode_id, $address): object
```

IPv4 Address Delete

Deletes a public IPv4 address associated with this Linode. This will fail if it is the Linode's last remaining public IPv4 address. Private IPv4 addresses cannot be removed via this endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode to look up.
$address = 'address_example'; // string | The IP address to look up.

try {
    $result = $apiInstance->removeLinodeIP($linode_id, $address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->removeLinodeIP: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode to look up. |
 **address** | **string**| The IP address to look up. |

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

## `rescueLinodeInstance()`

```php
rescueLinodeInstance($linode_id, $inline_object11): object
```

Linode Boot into Rescue Mode

Rescue Mode is a safe environment for performing many system recovery and disk management tasks. Rescue Mode is based on the Finnix recovery distribution, a self-contained and bootable Linux distribution. You can also use Rescue Mode for tasks other than disaster recovery, such as formatting disks to use different filesystems, copying data between disks, and downloading files from a disk via SSH and SFTP. * Note that \"sdh\" is reserved and unavailable during rescue.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to rescue.
$inline_object11 = new \OpenAPI\Client\Model\InlineObject11(); // \OpenAPI\Client\Model\InlineObject11

try {
    $result = $apiInstance->rescueLinodeInstance($linode_id, $inline_object11);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->rescueLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to rescue. |
 **inline_object11** | [**\OpenAPI\Client\Model\InlineObject11**](../Model/InlineObject11.md)|  | [optional]

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

## `resetDiskPassword()`

```php
resetDiskPassword($linode_id, $disk_id, $unknown_base_type): object
```

Disk Root Password Reset

Resets the password of a Disk you have permission to `read_write`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$disk_id = 56; // int | ID of the Disk to look up.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The new password.

try {
    $result = $apiInstance->resetDiskPassword($linode_id, $disk_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->resetDiskPassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **disk_id** | **int**| ID of the Disk to look up. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The new password. |

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

## `resetLinodePassword()`

```php
resetLinodePassword($linode_id, $unknown_base_type): object
```

Linode Root Password Reset

Resets the root password for this Linode. * Your Linode must be [shut down](/docs/api/linode-instances/#linode-shut-down) for a password reset to complete. * If your Linode has more than one disk (not counting its swap disk), use the [Reset Disk Root Password](/docs/api/linode-instances/#disk-root-password-reset) endpoint to update a specific disk's root password. * A `password_reset` event is generated when a root password reset is successful.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode for which to reset its root password.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | This Linode's new root password.

try {
    $result = $apiInstance->resetLinodePassword($linode_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->resetLinodePassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode for which to reset its root password. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| This Linode&#39;s new root password. | [optional]

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

## `resizeDisk()`

```php
resizeDisk($linode_id, $disk_id, $unknown_base_type): object
```

Disk Resize

Resizes a Disk you have permission to `read_write`.  The Disk must not be in use. If the Disk is in use, the request will succeed but the resize will ultimately fail. For a request to succeed, the Linode must be shut down prior to resizing the Disk, or the Disk must not be assigned to the Linode's active Configuration Profile.  If you are resizing the Disk to a smaller size, it cannot be made smaller than what is required by the total size of the files current on the Disk.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$disk_id = 56; // int | ID of the Disk to look up.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The new size of the Disk.

try {
    $result = $apiInstance->resizeDisk($linode_id, $disk_id, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->resizeDisk: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **disk_id** | **int**| ID of the Disk to look up. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The new size of the Disk. |

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

## `resizeLinodeInstance()`

```php
resizeLinodeInstance($linode_id, $inline_object12): object
```

Linode Resize

Resizes a Linode you have the `read_write` permission to a different Type. If any actions are currently running or queued, those actions must be completed first before you can initiate a resize. Additionally, the following criteria must be met in order to resize a Linode:    * The Linode must not have a pending migration.   * Your Account cannot have an outstanding balance.   * The Linode must not have more disk allocation than the new Type allows.     * In that situation, you must first delete or resize the disk to be smaller.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to resize.
$inline_object12 = new \OpenAPI\Client\Model\InlineObject12(); // \OpenAPI\Client\Model\InlineObject12

try {
    $result = $apiInstance->resizeLinodeInstance($linode_id, $inline_object12);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->resizeLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to resize. |
 **inline_object12** | [**\OpenAPI\Client\Model\InlineObject12**](../Model/InlineObject12.md)|  |

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

## `restoreBackup()`

```php
restoreBackup($linode_id, $backup_id, $inline_object7): object
```

Backup Restore

Restores a Linode's Backup to the specified Linode.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode that the Backup belongs to.
$backup_id = 56; // int | The ID of the Backup to restore.
$inline_object7 = new \OpenAPI\Client\Model\InlineObject7(); // \OpenAPI\Client\Model\InlineObject7

try {
    $result = $apiInstance->restoreBackup($linode_id, $backup_id, $inline_object7);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->restoreBackup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode that the Backup belongs to. |
 **backup_id** | **int**| The ID of the Backup to restore. |
 **inline_object7** | [**\OpenAPI\Client\Model\InlineObject7**](../Model/InlineObject7.md)|  |

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

## `shutdownLinodeInstance()`

```php
shutdownLinodeInstance($linode_id): object
```

Linode Shut Down

Shuts down a Linode you have permission to modify. If any actions are currently running or queued, those actions must be completed first before you can initiate a shutdown.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to shutdown.

try {
    $result = $apiInstance->shutdownLinodeInstance($linode_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->shutdownLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to shutdown. |

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

## `updateDisk()`

```php
updateDisk($linode_id, $disk_id, $disk): \OpenAPI\Client\Model\Disk
```

Disk Update

Updates a Disk that you have permission to `read_write`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up.
$disk_id = 56; // int | ID of the Disk to look up.
$disk = new \OpenAPI\Client\Model\Disk(); // \OpenAPI\Client\Model\Disk | Updates the parameters of a single Disk.

try {
    $result = $apiInstance->updateDisk($linode_id, $disk_id, $disk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->updateDisk: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up. |
 **disk_id** | **int**| ID of the Disk to look up. |
 **disk** | [**\OpenAPI\Client\Model\Disk**](../Model/Disk.md)| Updates the parameters of a single Disk. |

### Return type

[**\OpenAPI\Client\Model\Disk**](../Model/Disk.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateLinodeConfig()`

```php
updateLinodeConfig($linode_id, $config_id, $linode_config): \OpenAPI\Client\Model\LinodeConfig
```

Configuration Profile Update

Updates a Configuration profile.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode whose Configuration profile to look up.
$config_id = 56; // int | The ID of the Configuration profile to look up.
$linode_config = new \OpenAPI\Client\Model\LinodeConfig(); // \OpenAPI\Client\Model\LinodeConfig | The Configuration profile parameters to modify.

try {
    $result = $apiInstance->updateLinodeConfig($linode_id, $config_id, $linode_config);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->updateLinodeConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode whose Configuration profile to look up. |
 **config_id** | **int**| The ID of the Configuration profile to look up. |
 **linode_config** | [**\OpenAPI\Client\Model\LinodeConfig**](../Model/LinodeConfig.md)| The Configuration profile parameters to modify. |

### Return type

[**\OpenAPI\Client\Model\LinodeConfig**](../Model/LinodeConfig.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateLinodeIP()`

```php
updateLinodeIP($linode_id, $address, $unknown_base_type): \OpenAPI\Client\Model\IPAddress
```

IP Address Update

Updates a particular IP Address associated with this Linode. Only allows setting/resetting reverse DNS.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | The ID of the Linode to look up.
$address = 'address_example'; // string | The IP address to look up.
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The information to update for the IP address.

try {
    $result = $apiInstance->updateLinodeIP($linode_id, $address, $unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->updateLinodeIP: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| The ID of the Linode to look up. |
 **address** | **string**| The IP address to look up. |
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The information to update for the IP address. | [optional]

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

## `updateLinodeInstance()`

```php
updateLinodeInstance($linode_id, $linode): \OpenAPI\Client\Model\Linode
```

Linode Update

Updates a Linode that you have permission to `read_write`.  **Important**: You must be an unrestricted User in order to add or modify tags on Linodes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LinodeInstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$linode_id = 56; // int | ID of the Linode to look up
$linode = new \OpenAPI\Client\Model\Linode(); // \OpenAPI\Client\Model\Linode | Any field that is not marked as `readOnly` may be updated. Fields that are marked `readOnly` will be ignored. If any updated field fails to pass validation, the Linode will not be updated.

try {
    $result = $apiInstance->updateLinodeInstance($linode_id, $linode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LinodeInstancesApi->updateLinodeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **linode_id** | **int**| ID of the Linode to look up |
 **linode** | [**\OpenAPI\Client\Model\Linode**](../Model/Linode.md)| Any field that is not marked as &#x60;readOnly&#x60; may be updated. Fields that are marked &#x60;readOnly&#x60; will be ignored. If any updated field fails to pass validation, the Linode will not be updated. |

### Return type

[**\OpenAPI\Client\Model\Linode**](../Model/Linode.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

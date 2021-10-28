# OpenAPI\Client\ProfileApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**addSSHKey()**](ProfileApi.md#addSSHKey) | **POST** /profile/sshkeys | SSH Key Add
[**createPersonalAccessToken()**](ProfileApi.md#createPersonalAccessToken) | **POST** /profile/tokens | Personal Access Token Create
[**deletePersonalAccessToken()**](ProfileApi.md#deletePersonalAccessToken) | **DELETE** /profile/tokens/{tokenId} | Personal Access Token Revoke
[**deleteProfileApp()**](ProfileApi.md#deleteProfileApp) | **DELETE** /profile/apps/{appId} | App Access Revoke
[**deleteSSHKey()**](ProfileApi.md#deleteSSHKey) | **DELETE** /profile/sshkeys/{sshKeyId} | SSH Key Delete
[**getDevices()**](ProfileApi.md#getDevices) | **GET** /profile/devices | Trusted Devices List
[**getPersonalAccessToken()**](ProfileApi.md#getPersonalAccessToken) | **GET** /profile/tokens/{tokenId} | Personal Access Token View
[**getPersonalAccessTokens()**](ProfileApi.md#getPersonalAccessTokens) | **GET** /profile/tokens | Personal Access Tokens List
[**getProfile()**](ProfileApi.md#getProfile) | **GET** /profile | Profile View
[**getProfileApp()**](ProfileApi.md#getProfileApp) | **GET** /profile/apps/{appId} | Authorized App View
[**getProfileApps()**](ProfileApi.md#getProfileApps) | **GET** /profile/apps | Authorized Apps List
[**getProfileGrants()**](ProfileApi.md#getProfileGrants) | **GET** /profile/grants | Grants List
[**getProfileLogin()**](ProfileApi.md#getProfileLogin) | **GET** /profile/logins/{loginId} | Login View
[**getProfileLogins()**](ProfileApi.md#getProfileLogins) | **GET** /profile/logins | Logins List
[**getSSHKey()**](ProfileApi.md#getSSHKey) | **GET** /profile/sshkeys/{sshKeyId} | SSH Key View
[**getSSHKeys()**](ProfileApi.md#getSSHKeys) | **GET** /profile/sshkeys | SSH Keys List
[**getTrustedDevice()**](ProfileApi.md#getTrustedDevice) | **GET** /profile/devices/{deviceId} | Trusted Device View
[**getUserPreferences()**](ProfileApi.md#getUserPreferences) | **GET** /profile/preferences | User Preferences View
[**revokeTrustedDevice()**](ProfileApi.md#revokeTrustedDevice) | **DELETE** /profile/devices/{deviceId} | Trusted Device Revoke
[**tfaConfirm()**](ProfileApi.md#tfaConfirm) | **POST** /profile/tfa-enable-confirm | Two Factor Authentication Confirm/Enable
[**tfaDisable()**](ProfileApi.md#tfaDisable) | **POST** /profile/tfa-disable | Two Factor Authentication Disable
[**tfaEnable()**](ProfileApi.md#tfaEnable) | **POST** /profile/tfa-enable | Two Factor Secret Create
[**updatePersonalAccessToken()**](ProfileApi.md#updatePersonalAccessToken) | **PUT** /profile/tokens/{tokenId} | Personal Access Token Update
[**updateProfile()**](ProfileApi.md#updateProfile) | **PUT** /profile | Profile Update
[**updateSSHKey()**](ProfileApi.md#updateSSHKey) | **PUT** /profile/sshkeys/{sshKeyId} | SSH Key Update
[**updateUserPreferences()**](ProfileApi.md#updateUserPreferences) | **PUT** /profile/preferences | User Preferences Update


## `addSSHKey()`

```php
addSSHKey($ssh_key_request): \OpenAPI\Client\Model\SSHKey
```

SSH Key Add

Adds an SSH Key to your Account profile.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ssh_key_request = new \OpenAPI\Client\Model\SSHKeyRequest(); // \OpenAPI\Client\Model\SSHKeyRequest | Add SSH Key

try {
    $result = $apiInstance->addSSHKey($ssh_key_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->addSSHKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ssh_key_request** | [**\OpenAPI\Client\Model\SSHKeyRequest**](../Model/SSHKeyRequest.md)| Add SSH Key | [optional]

### Return type

[**\OpenAPI\Client\Model\SSHKey**](../Model/SSHKey.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createPersonalAccessToken()`

```php
createPersonalAccessToken($unknown_base_type): \OpenAPI\Client\Model\PersonalAccessToken
```

Personal Access Token Create

Creates a Personal Access Token for your User. The raw token will be returned in the response, but will never be returned again afterward so be sure to take note of it. You may create a token with _at most_ the scopes of your current token. The created token will be able to access your Account until the given expiry, or until it is revoked.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the requested token.

try {
    $result = $apiInstance->createPersonalAccessToken($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->createPersonalAccessToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the requested token. |

### Return type

[**\OpenAPI\Client\Model\PersonalAccessToken**](../Model/PersonalAccessToken.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePersonalAccessToken()`

```php
deletePersonalAccessToken($token_id): object
```

Personal Access Token Revoke

Revokes a Personal Access Token. The token will be invalidated immediately, and requests using that token will fail with a 401. It is possible to revoke access to the token making the request to revoke a token, but keep in mind that doing so could lose you access to the api and require you to create a new token through some other means.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token_id = 56; // int | The ID of the token to access.

try {
    $result = $apiInstance->deletePersonalAccessToken($token_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->deletePersonalAccessToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token_id** | **int**| The ID of the token to access. |

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

## `deleteProfileApp()`

```php
deleteProfileApp($app_id): object
```

App Access Revoke

Expires this app token. This token may no longer be used to access your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_id = 56; // int | The authorized app ID to manage.

try {
    $result = $apiInstance->deleteProfileApp($app_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->deleteProfileApp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_id** | **int**| The authorized app ID to manage. |

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

## `deleteSSHKey()`

```php
deleteSSHKey($ssh_key_id): object
```

SSH Key Delete

Deletes an SSH Key you have access to.  **Note:** deleting an SSH Key will *not* remove it from any Linode or Disk that was deployed with `authorized_keys`. In those cases, the keys must be manually deleted on the Linode or Disk. This endpoint will only delete the key's association from your Profile.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ssh_key_id = 56; // int | The ID of the SSHKey

try {
    $result = $apiInstance->deleteSSHKey($ssh_key_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->deleteSSHKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ssh_key_id** | **int**| The ID of the SSHKey |

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

## `getDevices()`

```php
getDevices(): \OpenAPI\Client\Model\InlineResponse20055
```

Trusted Devices List

Returns a paginated list of active TrustedDevices for your User. Browsers with an active Remember Me Session are logged into your account until the session expires or is revoked.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getDevices();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getDevices: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20055**](../Model/InlineResponse20055.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonalAccessToken()`

```php
getPersonalAccessToken($token_id): \OpenAPI\Client\Model\PersonalAccessToken
```

Personal Access Token View

Returns a single Personal Access Token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token_id = 56; // int | The ID of the token to access.

try {
    $result = $apiInstance->getPersonalAccessToken($token_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getPersonalAccessToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token_id** | **int**| The ID of the token to access. |

### Return type

[**\OpenAPI\Client\Model\PersonalAccessToken**](../Model/PersonalAccessToken.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPersonalAccessTokens()`

```php
getPersonalAccessTokens(): \OpenAPI\Client\Model\InlineResponse20054
```

Personal Access Tokens List

Returns a paginated list of Personal Access Tokens currently active for your User.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getPersonalAccessTokens();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getPersonalAccessTokens: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse20054**](../Model/InlineResponse20054.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfile()`

```php
getProfile(): \OpenAPI\Client\Model\Profile
```

Profile View

Returns information about the current User. This can be used to see who is acting in applications where more than one token is managed. For example, in third-party OAuth applications.  This endpoint is always accessible, no matter what OAuth scopes the acting token has.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getProfile();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\Profile**](../Model/Profile.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfileApp()`

```php
getProfileApp($app_id): \OpenAPI\Client\Model\AuthorizedApp
```

Authorized App View

Returns information about a single app you've authorized to access your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_id = 56; // int | The authorized app ID to manage.

try {
    $result = $apiInstance->getProfileApp($app_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getProfileApp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_id** | **int**| The authorized app ID to manage. |

### Return type

[**\OpenAPI\Client\Model\AuthorizedApp**](../Model/AuthorizedApp.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfileApps()`

```php
getProfileApps($page, $page_size): \OpenAPI\Client\Model\InlineResponse20053
```

Authorized Apps List

This is a collection of OAuth apps that you've given access to your Account, and includes the level of access granted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getProfileApps($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getProfileApps: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20053**](../Model/InlineResponse20053.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfileGrants()`

```php
getProfileGrants(): \OpenAPI\Client\Model\GrantsResponse
```

Grants List

This returns a GrantsResponse describing what the acting User has been granted access to.  For unrestricted users, this will return a  204 and no body because unrestricted users have access to everything without grants.  This will not return information about entities you do not have access to.  This endpoint is useful when writing third-party OAuth applications to see what options you should present to the acting User.  For example, if they do not have `global.add_linodes`, you might not display a button to deploy a new Linode.  Any client may access this endpoint; no OAuth scopes are required.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getProfileGrants();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getProfileGrants: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\GrantsResponse**](../Model/GrantsResponse.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfileLogin()`

```php
getProfileLogin($login_id): \OpenAPI\Client\Model\Login
```

Login View

Returns a login object displaying information about a successful account login from this user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$login_id = 56; // int | The ID of the login object to access.

try {
    $result = $apiInstance->getProfileLogin($login_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getProfileLogin: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **login_id** | **int**| The ID of the login object to access. |

### Return type

[**\OpenAPI\Client\Model\Login**](../Model/Login.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfileLogins()`

```php
getProfileLogins(): \OpenAPI\Client\Model\InlineResponse2004
```

Logins List

Returns a collection of successful account logins from this user during the last 90 days.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getProfileLogins();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getProfileLogins: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse2004**](../Model/InlineResponse2004.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSSHKey()`

```php
getSSHKey($ssh_key_id): \OpenAPI\Client\Model\SSHKey
```

SSH Key View

Returns a single SSH Key object identified by `id` that you have access to view.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ssh_key_id = 56; // int | The ID of the SSHKey

try {
    $result = $apiInstance->getSSHKey($ssh_key_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getSSHKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ssh_key_id** | **int**| The ID of the SSHKey |

### Return type

[**\OpenAPI\Client\Model\SSHKey**](../Model/SSHKey.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSSHKeys()`

```php
getSSHKeys($page, $page_size): \OpenAPI\Client\Model\InlineResponse20056
```

SSH Keys List

Returns a collection of SSH Keys you've added to your Profile.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getSSHKeys($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getSSHKeys: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20056**](../Model/InlineResponse20056.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTrustedDevice()`

```php
getTrustedDevice($device_id): \OpenAPI\Client\Model\TrustedDevice
```

Trusted Device View

Returns a single active TrustedDevice for your User.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$device_id = 56; // int | The ID of the TrustedDevice

try {
    $result = $apiInstance->getTrustedDevice($device_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getTrustedDevice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **device_id** | **int**| The ID of the TrustedDevice |

### Return type

[**\OpenAPI\Client\Model\TrustedDevice**](../Model/TrustedDevice.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUserPreferences()`

```php
getUserPreferences(): object
```

User Preferences View

View a list of user preferences tied to the OAuth client that generated the token making the request. The user preferences endpoints allow consumers of the API to store arbitrary JSON data, such as a user's font size preference or preferred display name. User preferences are available for each OAuth client registered to your account, and as such an account can have multiple user preferences.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getUserPreferences();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->getUserPreferences: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

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

## `revokeTrustedDevice()`

```php
revokeTrustedDevice($device_id): object
```

Trusted Device Revoke

Revoke an active TrustedDevice for your User.  Once a TrustedDevice is revoked, this device will have to log in again before accessing your Linode account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$device_id = 56; // int | The ID of the TrustedDevice

try {
    $result = $apiInstance->revokeTrustedDevice($device_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->revokeTrustedDevice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **device_id** | **int**| The ID of the TrustedDevice |

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

## `tfaConfirm()`

```php
tfaConfirm($unknown_base_type): object
```

Two Factor Authentication Confirm/Enable

Confirms that you can successfully generate Two Factor codes and enables TFA on your Account. Once this is complete, login attempts from untrusted computers will be required to provide a Two Factor code before they are successful.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | The Two Factor code you generated with your Two Factor secret.

try {
    $result = $apiInstance->tfaConfirm($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->tfaConfirm: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| The Two Factor code you generated with your Two Factor secret. |

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

## `tfaDisable()`

```php
tfaDisable(): object
```

Two Factor Authentication Disable

Disables Two Factor Authentication for your User. Once successful, login attempts from untrusted computers will only require a password before being successful. This is less secure, and is discouraged.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->tfaDisable();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->tfaDisable: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

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

## `tfaEnable()`

```php
tfaEnable(): object
```

Two Factor Secret Create

Generates a Two Factor secret for your User. TFA will not be enabled until you have successfully confirmed the code you were given with [tfa-enable-confirm](/docs/api/profile/#two-factor-secret-create) (see below). Once enabled, logins from untrusted computers will be required to provide a TFA code before they are successful.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->tfaEnable();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->tfaEnable: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

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

## `updatePersonalAccessToken()`

```php
updatePersonalAccessToken($token_id, $personal_access_token): \OpenAPI\Client\Model\PersonalAccessToken
```

Personal Access Token Update

Updates a Personal Access Token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token_id = 56; // int | The ID of the token to access.
$personal_access_token = new \OpenAPI\Client\Model\PersonalAccessToken(); // \OpenAPI\Client\Model\PersonalAccessToken | The fields to update.

try {
    $result = $apiInstance->updatePersonalAccessToken($token_id, $personal_access_token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->updatePersonalAccessToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token_id** | **int**| The ID of the token to access. |
 **personal_access_token** | [**\OpenAPI\Client\Model\PersonalAccessToken**](../Model/PersonalAccessToken.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\PersonalAccessToken**](../Model/PersonalAccessToken.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProfile()`

```php
updateProfile($profile): \OpenAPI\Client\Model\Profile
```

Profile Update

Update information in your Profile.  This endpoint requires the \"account:read_write\" OAuth Scope.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$profile = new \OpenAPI\Client\Model\Profile(); // \OpenAPI\Client\Model\Profile | The fields to update.

try {
    $result = $apiInstance->updateProfile($profile);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->updateProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **profile** | [**\OpenAPI\Client\Model\Profile**](../Model/Profile.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\Profile**](../Model/Profile.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSSHKey()`

```php
updateSSHKey($ssh_key_id, $ssh_key): \OpenAPI\Client\Model\SSHKey
```

SSH Key Update

Updates an SSH Key that you have permission to `read_write`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ssh_key_id = 56; // int | The ID of the SSHKey
$ssh_key = new \OpenAPI\Client\Model\SSHKey(); // \OpenAPI\Client\Model\SSHKey | The fields to update.

try {
    $result = $apiInstance->updateSSHKey($ssh_key_id, $ssh_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->updateSSHKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ssh_key_id** | **int**| The ID of the SSHKey |
 **ssh_key** | [**\OpenAPI\Client\Model\SSHKey**](../Model/SSHKey.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\SSHKey**](../Model/SSHKey.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateUserPreferences()`

```php
updateUserPreferences($body): object
```

User Preferences Update

Updates a user's preferences. These preferences are tied to the OAuth client that generated the token making the request. The user preferences endpoints allow consumers of the API to store arbitrary JSON data, such as a user's font size preference or preferred display name. An account may have multiple preferences. Preferences, and the pertaining request body, may contain any arbitrary JSON data that the user would like to store.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfileApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = array('key' => new \stdClass); // object | The user preferences to update or store.

try {
    $result = $apiInstance->updateUserPreferences($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileApi->updateUserPreferences: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | **object**| The user preferences to update or store. |

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

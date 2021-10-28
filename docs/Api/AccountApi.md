# OpenAPI\Client\AccountApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**acceptEntityTransfer()**](AccountApi.md#acceptEntityTransfer) | **POST** /account/entity-transfers/{token}/accept | Entity Transfer Accept
[**acceptServiceTransfer()**](AccountApi.md#acceptServiceTransfer) | **POST** /account/service-transfers/{token}/accept | Service Transfer Accept
[**cancelAccount()**](AccountApi.md#cancelAccount) | **POST** /account/cancel | Account Cancel
[**createClient()**](AccountApi.md#createClient) | **POST** /account/oauth-clients | OAuth Client Create
[**createCreditCard()**](AccountApi.md#createCreditCard) | **POST** /account/credit-card | Credit Card Add/Edit
[**createEntityTransfer()**](AccountApi.md#createEntityTransfer) | **POST** /account/entity-transfers | Entity Transfer Create
[**createPayPalPayment()**](AccountApi.md#createPayPalPayment) | **POST** /account/payments/paypal | PayPal Payment Stage
[**createPayment()**](AccountApi.md#createPayment) | **POST** /account/payments | Payment Make
[**createPaymentMethod()**](AccountApi.md#createPaymentMethod) | **POST** /account/payment-methods | Payment Method Add
[**createPromoCredit()**](AccountApi.md#createPromoCredit) | **POST** /account/promo-codes | Promo Credit Add
[**createServiceTransfer()**](AccountApi.md#createServiceTransfer) | **POST** /account/service-transfers | Service Transfer Create
[**createUser()**](AccountApi.md#createUser) | **POST** /account/users | User Create
[**deleteClient()**](AccountApi.md#deleteClient) | **DELETE** /account/oauth-clients/{clientId} | OAuth Client Delete
[**deleteEntityTransfer()**](AccountApi.md#deleteEntityTransfer) | **DELETE** /account/entity-transfers/{token} | Entity Transfer Cancel
[**deletePaymentMethod()**](AccountApi.md#deletePaymentMethod) | **DELETE** /account/payment-methods/{paymentMethodId} | Payment Method Delete
[**deleteServiceTransfer()**](AccountApi.md#deleteServiceTransfer) | **DELETE** /account/service-transfers/{token} | Service Transfer Cancel
[**deleteUser()**](AccountApi.md#deleteUser) | **DELETE** /account/users/{username} | User Delete
[**enableAccountManged()**](AccountApi.md#enableAccountManged) | **POST** /account/settings/managed-enable | Linode Managed Enable
[**eventRead()**](AccountApi.md#eventRead) | **POST** /account/events/{eventId}/read | Event Mark as Read
[**eventSeen()**](AccountApi.md#eventSeen) | **POST** /account/events/{eventId}/seen | Event Mark as Seen
[**executePayPalPayment()**](AccountApi.md#executePayPalPayment) | **POST** /account/payments/paypal/execute | Staged/Approved PayPal Payment Execute
[**getAccount()**](AccountApi.md#getAccount) | **GET** /account | Account View
[**getAccountLogin()**](AccountApi.md#getAccountLogin) | **GET** /account/logins/{loginId} | Login View
[**getAccountLogins()**](AccountApi.md#getAccountLogins) | **GET** /account/logins | User Logins List All
[**getAccountSettings()**](AccountApi.md#getAccountSettings) | **GET** /account/settings | Account Settings View
[**getClient()**](AccountApi.md#getClient) | **GET** /account/oauth-clients/{clientId} | OAuth Client View
[**getClientThumbnail()**](AccountApi.md#getClientThumbnail) | **GET** /account/oauth-clients/{clientId}/thumbnail | OAuth Client Thumbnail View
[**getClients()**](AccountApi.md#getClients) | **GET** /account/oauth-clients | OAuth Clients List
[**getEntityTransfer()**](AccountApi.md#getEntityTransfer) | **GET** /account/entity-transfers/{token} | Entity Transfer View
[**getEntityTransfers()**](AccountApi.md#getEntityTransfers) | **GET** /account/entity-transfers | Entity Transfers List
[**getEvent()**](AccountApi.md#getEvent) | **GET** /account/events/{eventId} | Event View
[**getEvents()**](AccountApi.md#getEvents) | **GET** /account/events | Events List
[**getInvoice()**](AccountApi.md#getInvoice) | **GET** /account/invoices/{invoiceId} | Invoice View
[**getInvoiceItems()**](AccountApi.md#getInvoiceItems) | **GET** /account/invoices/{invoiceId}/items | Invoice Items List
[**getInvoices()**](AccountApi.md#getInvoices) | **GET** /account/invoices | Invoices List
[**getMaintenance()**](AccountApi.md#getMaintenance) | **GET** /account/maintenance | Maintenance List
[**getNotifications()**](AccountApi.md#getNotifications) | **GET** /account/notifications | Notifications List
[**getPayment()**](AccountApi.md#getPayment) | **GET** /account/payments/{paymentId} | Payment View
[**getPaymentMethod()**](AccountApi.md#getPaymentMethod) | **GET** /account/payment-methods/{paymentMethodId} | Payment Method View
[**getPaymentMethods()**](AccountApi.md#getPaymentMethods) | **GET** /account/payment-methods | Payment Methods List
[**getPayments()**](AccountApi.md#getPayments) | **GET** /account/payments | Payments List
[**getServiceTransfer()**](AccountApi.md#getServiceTransfer) | **GET** /account/service-transfers/{token} | Service Transfer View
[**getServiceTransfers()**](AccountApi.md#getServiceTransfers) | **GET** /account/service-transfers | Service Transfers List
[**getTransfer()**](AccountApi.md#getTransfer) | **GET** /account/transfer | Network Utilization View
[**getUser()**](AccountApi.md#getUser) | **GET** /account/users/{username} | User View
[**getUserGrants()**](AccountApi.md#getUserGrants) | **GET** /account/users/{username}/grants | User&#39;s Grants View
[**getUsers()**](AccountApi.md#getUsers) | **GET** /account/users | Users List
[**makePaymentMethodDefault()**](AccountApi.md#makePaymentMethodDefault) | **POST** /account/payment-methods/{paymentMethodId}/make-default | Payment Method Make Default
[**resetClientSecret()**](AccountApi.md#resetClientSecret) | **POST** /account/oauth-clients/{clientId}/reset-secret | OAuth Client Secret Reset
[**setClientThumbnail()**](AccountApi.md#setClientThumbnail) | **PUT** /account/oauth-clients/{clientId}/thumbnail | OAuth Client Thumbnail Update
[**updateAccount()**](AccountApi.md#updateAccount) | **PUT** /account | Account Update
[**updateAccountSettings()**](AccountApi.md#updateAccountSettings) | **PUT** /account/settings | Account Settings Update
[**updateClient()**](AccountApi.md#updateClient) | **PUT** /account/oauth-clients/{clientId} | OAuth Client Update
[**updateUser()**](AccountApi.md#updateUser) | **PUT** /account/users/{username} | User Update
[**updateUserGrants()**](AccountApi.md#updateUserGrants) | **PUT** /account/users/{username}/grants | User&#39;s Grants Update


## `acceptEntityTransfer()`

```php
acceptEntityTransfer($token): object
```

Entity Transfer Accept

**DEPRECATED**. Please use [Service Transfer Accept](/docs/api/account/#service-transfer-accept).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 'token_example'; // string | The UUID of the Entity Transfer.

try {
    $result = $apiInstance->acceptEntityTransfer($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->acceptEntityTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| The UUID of the Entity Transfer. |

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

## `acceptServiceTransfer()`

```php
acceptServiceTransfer($token): object
```

Service Transfer Accept

Accept a Service Transfer for the provided token to receive the services included in the transfer to your account. At this time, only Linodes can be transferred.  When accepted, email confirmations are sent to the accounts that created and accepted the transfer. A transfer can take up to three hours to complete once accepted. Once a transfer is completed, billing for transferred services ends for the sending account and begins for the receiving account.  This command can only be accessed by the unrestricted users of the account that receives the transfer. Users of the same account that created a transfer cannot accept the transfer.  There are several conditions that must be met in order to accept a transfer request:  1. Only transfers with a `pending` status can be accepted.  1. The account accepting the transfer must have a registered payment method and must not have a past due   balance or other account limitations for the services to be transferred.  1. Both the account that created the transfer and the account that is accepting the transfer must not have any active Terms of Service violations.  1. The service must still be owned by the account that created the transfer.  1. Linodes must not:      * be assigned to a NodeBalancer, Firewall, VLAN, or Managed Service.      * have any attached Block Storage Volumes.      * have any shared IP addresses.      * have any assigned /56, /64, or /116 IPv6 ranges.  Any and all of the above conditions must be cured and maintained by the relevant account prior to the transfer's expiration to allow the transfer to be accepted by the receiving account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 'token_example'; // string | The UUID of the Service Transfer.

try {
    $result = $apiInstance->acceptServiceTransfer($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->acceptServiceTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| The UUID of the Service Transfer. |

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

## `cancelAccount()`

```php
cancelAccount($unknown_base_type): \OpenAPI\Client\Model\InlineResponse200
```

Account Cancel

Cancels an active Linode account. This action will cause Linode to attempt to charge the credit card on file for the remaining balance. An error will occur if Linode fails to charge the credit card on file. Restricted users will not be able to cancel an account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Supply a comment stating the reason that you are cancelling your account.

try {
    $result = $apiInstance->cancelAccount($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->cancelAccount: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Supply a comment stating the reason that you are cancelling your account. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createClient()`

```php
createClient($unknown_base_type): \OpenAPI\Client\Model\OAuthClient
```

OAuth Client Create

Creates an OAuth Client, which can be used to allow users (using their Linode account) to log in to your own application, and optionally grant your application some amount of access to their Linodes or other entities.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the OAuth Client to create.

try {
    $result = $apiInstance->createClient($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the OAuth Client to create. | [optional]

### Return type

[**\OpenAPI\Client\Model\OAuthClient**](../Model/OAuthClient.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createCreditCard()`

```php
createCreditCard($credit_card): object
```

Credit Card Add/Edit

**DEPRECATED**. Please use Payment Method Add ([POST /account/payment-methods](/docs/api/account/#payment-method-add)).  Adds a credit card Payment Method to your account and sets it as the default method.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$credit_card = new \OpenAPI\Client\Model\CreditCard(); // \OpenAPI\Client\Model\CreditCard | Update the credit card information associated with your Account.

try {
    $result = $apiInstance->createCreditCard($credit_card);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createCreditCard: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credit_card** | [**\OpenAPI\Client\Model\CreditCard**](../Model/CreditCard.md)| Update the credit card information associated with your Account. |

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

## `createEntityTransfer()`

```php
createEntityTransfer($inline_object): \OpenAPI\Client\Model\EntityTransfer
```

Entity Transfer Create

**DEPRECATED**. Please use [Service Transfer Create](/docs/api/account/#service-transfer-create).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object = new \OpenAPI\Client\Model\InlineObject(); // \OpenAPI\Client\Model\InlineObject

try {
    $result = $apiInstance->createEntityTransfer($inline_object);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createEntityTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object** | [**\OpenAPI\Client\Model\InlineObject**](../Model/InlineObject.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\EntityTransfer**](../Model/EntityTransfer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createPayPalPayment()`

```php
createPayPalPayment($pay_pal): \OpenAPI\Client\Model\InlineResponse20010
```

PayPal Payment Stage

This begins the process of submitting a Payment via PayPal. After calling this endpoint, you must take the resulting `payment_id` along with the `payer_id` from your PayPal account and [POST /account/payments/paypal-execute](/docs/api/account/#stagedapproved-paypal-payment-execute) to complete the Payment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pay_pal = new \OpenAPI\Client\Model\PayPal(); // \OpenAPI\Client\Model\PayPal | The amount of the Payment to submit via PayPal.

try {
    $result = $apiInstance->createPayPalPayment($pay_pal);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createPayPalPayment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **pay_pal** | [**\OpenAPI\Client\Model\PayPal**](../Model/PayPal.md)| The amount of the Payment to submit via PayPal. |

### Return type

[**\OpenAPI\Client\Model\InlineResponse20010**](../Model/InlineResponse20010.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createPayment()`

```php
createPayment($payment_request): \OpenAPI\Client\Model\Payment
```

Payment Make

Makes a Payment to your Account.  * The requested amount is charged to the default Payment Method if no `payment_method_id` is specified.  * A `payment_submitted` event is generated when a payment is successfully submitted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$payment_request = new \OpenAPI\Client\Model\PaymentRequest(); // \OpenAPI\Client\Model\PaymentRequest | Information about the Payment you are making.

try {
    $result = $apiInstance->createPayment($payment_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createPayment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **payment_request** | [**\OpenAPI\Client\Model\PaymentRequest**](../Model/PaymentRequest.md)| Information about the Payment you are making. |

### Return type

[**\OpenAPI\Client\Model\Payment**](../Model/Payment.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createPaymentMethod()`

```php
createPaymentMethod($inline_object1): object
```

Payment Method Add

Adds a Payment Method to your Account with the option to set it as the default method.  * Adding a default Payment Method removes the default status from any other Payment Method.  * An Account can have up to 6 active Payment Methods.  * Up to 60 Payment Methods can be added each day.  * Prior to adding a Payment Method, ensure that your billing address information is up-to-date with a valid `zip` by using the Account Update ([PUT /account](/docs/api/account/#account-update)) endpoint.  * A `payment_method_add` event is generated when a payment is successfully submitted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object1 = new \OpenAPI\Client\Model\InlineObject1(); // \OpenAPI\Client\Model\InlineObject1

try {
    $result = $apiInstance->createPaymentMethod($inline_object1);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createPaymentMethod: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object1** | [**\OpenAPI\Client\Model\InlineObject1**](../Model/InlineObject1.md)|  |

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

## `createPromoCredit()`

```php
createPromoCredit($inline_object2): \OpenAPI\Client\Model\Promotion
```

Promo Credit Add

Adds an expiring Promo Credit to your account.  The following restrictions apply:  * Your account must be less than 90 days old. * There must not be an existing Promo Credit already on your account. * The requesting User must be unrestricted. Use the User Update   ([PUT /account/users/{username}](/docs/api/account/#user-update)) to change a User's restricted status. * The `promo_code` must be valid and unexpired.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object2 = new \OpenAPI\Client\Model\InlineObject2(); // \OpenAPI\Client\Model\InlineObject2

try {
    $result = $apiInstance->createPromoCredit($inline_object2);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createPromoCredit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object2** | [**\OpenAPI\Client\Model\InlineObject2**](../Model/InlineObject2.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Promotion**](../Model/Promotion.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createServiceTransfer()`

```php
createServiceTransfer($inline_object3): \OpenAPI\Client\Model\ServiceTransfer
```

Service Transfer Create

Creates a transfer request for the specified services. A request can contain any of the specified service types and any number of each service type. At this time, only Linodes can be transferred.  When created successfully, a confirmation email is sent to the account that created this transfer containing a transfer token and instructions on completing the transfer.  When a transfer is [accepted](/docs/api/account/#service-transfer-accept), the requested services are moved to the receiving account. Linode services will not experience interruptions due to the transfer process. Backups for Linodes are transferred as well.  DNS records that are associated with requested services will not be transferred or updated. Please ensure that associated DNS records have been updated or communicated to the recipient prior to the transfer.  A transfer can take up to three hours to complete once accepted. When a transfer is completed, billing for transferred services ends for the sending account and begins for the receiving account.  This command can only be accessed by the unrestricted users of an account.  There are several conditions that must be met in order to successfully create a transfer request:  1. The account creating the transfer must not have a past due balance or active Terms of Service violation.  1. The service must be owned by the account that is creating the transfer.  1. The service must not be assigned to another Service Transfer that is pending or that has been accepted and is incomplete.  1. Linodes must not:      * be assigned to a NodeBalancer, Firewall, VLAN, or Managed Service.      * have any attached Block Storage Volumes.      * have any shared IP addresses.      * have any assigned /56, /64, or /116 IPv6 ranges.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object3 = new \OpenAPI\Client\Model\InlineObject3(); // \OpenAPI\Client\Model\InlineObject3

try {
    $result = $apiInstance->createServiceTransfer($inline_object3);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createServiceTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object3** | [**\OpenAPI\Client\Model\InlineObject3**](../Model/InlineObject3.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\ServiceTransfer**](../Model/ServiceTransfer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createUser()`

```php
createUser($unknown_base_type): \OpenAPI\Client\Model\User
```

User Create

Creates a User on your Account. Once created, a confirmation message containing password creation and login instructions is sent to the User's email address.  The User's account access is determined by whether or not they are restricted, and what grants they have been given.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the User to create.

try {
    $result = $apiInstance->createUser($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->createUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the User to create. | [optional]

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteClient()`

```php
deleteClient($client_id): object
```

OAuth Client Delete

Deletes an OAuth Client registered with Linode. The Client ID and Client secret will no longer be accepted by <a target=\"_top\" href=\"https://login.linode.com\">https://login.linode.com</a>, and all tokens issued to this client will be invalidated (meaning that if your application was using a token, it will no longer work).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 'client_id_example'; // string | The OAuth Client ID to look up.

try {
    $result = $apiInstance->deleteClient($client_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->deleteClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| The OAuth Client ID to look up. |

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

## `deleteEntityTransfer()`

```php
deleteEntityTransfer($token): object
```

Entity Transfer Cancel

**DEPRECATED**. Please use [Service Transfer Cancel](/docs/api/account/#service-transfer-cancel).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 'token_example'; // string | The UUID of the Entity Transfer.

try {
    $result = $apiInstance->deleteEntityTransfer($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->deleteEntityTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| The UUID of the Entity Transfer. |

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

## `deletePaymentMethod()`

```php
deletePaymentMethod($payment_method_id): object
```

Payment Method Delete

Deactivate the specified Payment Method.  The default Payment Method can not be deleted. To add a new default Payment Method, access the Payment Method Add ([POST /account/payment-methods](/docs/api/account/#payment-method-add)) endpoint. To designate an existing Payment Method as the default method, access the Payment Method Make Default ([POST /account/payment-methods/{paymentMethodId}/make-default](/docs/api/account/#payment-method-make-default)) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$payment_method_id = 56; // int | The ID of the Payment Method to look up.

try {
    $result = $apiInstance->deletePaymentMethod($payment_method_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->deletePaymentMethod: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **payment_method_id** | **int**| The ID of the Payment Method to look up. |

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

## `deleteServiceTransfer()`

```php
deleteServiceTransfer($token): object
```

Service Transfer Cancel

Cancels the Service Transfer for the provided token. Once cancelled, a transfer cannot be accepted or otherwise acted on in any way. If cancelled in error, the transfer must be [created](/docs/api/account/#service-transfer-create) again.  When cancelled, an email notification for the cancellation is sent to the account that created this transfer. Transfers can not be cancelled if they are expired or have been accepted.  This command can only be accessed by the unrestricted users of the account that created this transfer.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 'token_example'; // string | The UUID of the Service Transfer.

try {
    $result = $apiInstance->deleteServiceTransfer($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->deleteServiceTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| The UUID of the Service Transfer. |

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

## `deleteUser()`

```php
deleteUser($username): object
```

User Delete

Deletes a User. The deleted User will be immediately logged out and may no longer log in or perform any actions. All of the User's Grants will be removed.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$username = 'username_example'; // string | The username to look up.

try {
    $result = $apiInstance->deleteUser($username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->deleteUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **username** | **string**| The username to look up. |

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

## `enableAccountManged()`

```php
enableAccountManged(): object
```

Linode Managed Enable

Enables Linode Managed for the entire account and sends a welcome email to the account's associated email address. Linode Managed can monitor any service or software stack reachable over TCP or HTTP. See our [Linode Managed guide](/docs/platform/linode-managed/) to learn more.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->enableAccountManged();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->enableAccountManged: ', $e->getMessage(), PHP_EOL;
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

## `eventRead()`

```php
eventRead($event_id): object
```

Event Mark as Read

Marks a single Event as read.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$event_id = 56; // int | The ID of the Event to designate as read.

try {
    $result = $apiInstance->eventRead($event_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->eventRead: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **event_id** | **int**| The ID of the Event to designate as read. |

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

## `eventSeen()`

```php
eventSeen($event_id): object
```

Event Mark as Seen

Marks all Events up to and including this Event by ID as seen.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$event_id = 56; // int | The ID of the Event to designate as seen.

try {
    $result = $apiInstance->eventSeen($event_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->eventSeen: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **event_id** | **int**| The ID of the Event to designate as seen. |

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

## `executePayPalPayment()`

```php
executePayPalPayment($pay_pal_execute): object
```

Staged/Approved PayPal Payment Execute

Given a PaymentID and PayerID - as generated by PayPal during the transaction authorization process - this endpoint executes the Payment to capture the funds and credit your Linode Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pay_pal_execute = new \OpenAPI\Client\Model\PayPalExecute(); // \OpenAPI\Client\Model\PayPalExecute | The details of the Payment to execute.

try {
    $result = $apiInstance->executePayPalPayment($pay_pal_execute);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->executePayPalPayment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **pay_pal_execute** | [**\OpenAPI\Client\Model\PayPalExecute**](../Model/PayPalExecute.md)| The details of the Payment to execute. |

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

## `getAccount()`

```php
getAccount(): \OpenAPI\Client\Model\Account
```

Account View

Returns the contact and billing information related to your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAccount();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\Account**](../Model/Account.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAccountLogin()`

```php
getAccountLogin($login_id): \OpenAPI\Client\Model\Login
```

Login View

Returns a Login object that displays information about a successful login. The logins that can be viewed can be for any user on the account, and are not limited to only the logins of the user that is accessing this API endpoint. This command can only be accessed by the unrestricted users of the account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$login_id = 56; // int | The ID of the login object to access.

try {
    $result = $apiInstance->getAccountLogin($login_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getAccountLogin: ', $e->getMessage(), PHP_EOL;
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

## `getAccountLogins()`

```php
getAccountLogins(): \OpenAPI\Client\Model\InlineResponse2004
```

User Logins List All

Returns a collection of successful logins for all users on the account during the last 90 days. This command can only be accessed by the unrestricted users of an account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAccountLogins();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getAccountLogins: ', $e->getMessage(), PHP_EOL;
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

## `getAccountSettings()`

```php
getAccountSettings(): \OpenAPI\Client\Model\AccountSettings
```

Account Settings View

Returns information related to your Account settings: Managed service subscription, Longview subscription, and network helper.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAccountSettings();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getAccountSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\AccountSettings**](../Model/AccountSettings.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getClient()`

```php
getClient($client_id): \OpenAPI\Client\Model\OAuthClient
```

OAuth Client View

Returns information about a single OAuth client.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 'client_id_example'; // string | The OAuth Client ID to look up.

try {
    $result = $apiInstance->getClient($client_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| The OAuth Client ID to look up. |

### Return type

[**\OpenAPI\Client\Model\OAuthClient**](../Model/OAuthClient.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getClientThumbnail()`

```php
getClientThumbnail($client_id): \SplFileObject
```

OAuth Client Thumbnail View

Returns the thumbnail for this OAuth Client.  This is a publicly-viewable endpoint, and can be accessed without authentication.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$client_id = 'client_id_example'; // string | The OAuth Client ID to look up.

try {
    $result = $apiInstance->getClientThumbnail($client_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getClientThumbnail: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| The OAuth Client ID to look up. |

### Return type

**\SplFileObject**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `image/png`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getClients()`

```php
getClients($page, $page_size): \OpenAPI\Client\Model\InlineResponse2007
```

OAuth Clients List

Returns a paginated list of OAuth Clients registered to your Account.  OAuth Clients allow users to log into applications you write or host using their Linode Account, and may allow them to grant some level of access to their Linodes or other entities to your application.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getClients($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getClients: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2007**](../Model/InlineResponse2007.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEntityTransfer()`

```php
getEntityTransfer($token): \OpenAPI\Client\Model\EntityTransfer
```

Entity Transfer View

**DEPRECATED**. Please use [Service Transfer View](/docs/api/account/#service-transfer-view).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 'token_example'; // string | The UUID of the Entity Transfer.

try {
    $result = $apiInstance->getEntityTransfer($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getEntityTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| The UUID of the Entity Transfer. |

### Return type

[**\OpenAPI\Client\Model\EntityTransfer**](../Model/EntityTransfer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEntityTransfers()`

```php
getEntityTransfers($page, $page_size): PaginationEnvelope
```

Entity Transfers List

**DEPRECATED**. Please use [Service Transfers List](/docs/api/account/#service-transfers-list).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getEntityTransfers($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getEntityTransfers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**PaginationEnvelope**](../Model/PaginationEnvelope.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEvent()`

```php
getEvent($event_id): \OpenAPI\Client\Model\Event
```

Event View

Returns a single Event object.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$event_id = 56; // int | The ID of the Event.

try {
    $result = $apiInstance->getEvent($event_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getEvent: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **event_id** | **int**| The ID of the Event. |

### Return type

[**\OpenAPI\Client\Model\Event**](../Model/Event.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEvents()`

```php
getEvents($page, $page_size): \OpenAPI\Client\Model\InlineResponse2001
```

Events List

Returns a collection of Event objects representing actions taken on your Account from the last 90 days. The Events returned depend on your grants.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getEvents($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getEvents: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getInvoice()`

```php
getInvoice($invoice_id): \OpenAPI\Client\Model\Invoice
```

Invoice View

Returns a single Invoice object.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | The ID of the Invoice.

try {
    $result = $apiInstance->getInvoice($invoice_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| The ID of the Invoice. |

### Return type

[**\OpenAPI\Client\Model\Invoice**](../Model/Invoice.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getInvoiceItems()`

```php
getInvoiceItems($invoice_id, $page, $page_size): \OpenAPI\Client\Model\InlineResponse2003
```

Invoice Items List

Returns a paginated list of Invoice items.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | The ID of the Invoice.
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getInvoiceItems($invoice_id, $page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getInvoiceItems: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| The ID of the Invoice. |
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2003**](../Model/InlineResponse2003.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getInvoices()`

```php
getInvoices($page, $page_size): \OpenAPI\Client\Model\InlineResponse2002
```

Invoices List

Returns a paginated list of Invoices against your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getInvoices($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getInvoices: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getMaintenance()`

```php
getMaintenance(): \OpenAPI\Client\Model\InlineResponse2005
```

Maintenance List

Returns a collection of Maintenance objects for any entity a user has permissions to view.  Currently, Linodes are the only entities available for viewing.  **Beta**: This endpoint is in beta. Please make sure to prepend all requests with `/v4beta` instead of `/v4`, and be aware that this endpoint may receive breaking updates in the future. This notice will be removed when this endpoint is out of beta.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getMaintenance();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getMaintenance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse2005**](../Model/InlineResponse2005.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getNotifications()`

```php
getNotifications(): \OpenAPI\Client\Model\InlineResponse2006
```

Notifications List

Returns a collection of Notification objects representing important, often time-sensitive items related to your Account. You cannot interact directly with Notifications, and a Notification will disappear when the circumstances causing it have been resolved. For example, if you have an important Ticket open, you must respond to the Ticket to dismiss the Notification.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getNotifications();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getNotifications: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\InlineResponse2006**](../Model/InlineResponse2006.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPayment()`

```php
getPayment($payment_id): \OpenAPI\Client\Model\Payment
```

Payment View

Returns information about a specific Payment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$payment_id = 56; // int | The ID of the Payment to look up.

try {
    $result = $apiInstance->getPayment($payment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getPayment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **payment_id** | **int**| The ID of the Payment to look up. |

### Return type

[**\OpenAPI\Client\Model\Payment**](../Model/Payment.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPaymentMethod()`

```php
getPaymentMethod($payment_method_id): \OpenAPI\Client\Model\PaymentMethod
```

Payment Method View

View the details of the specified Payment Method.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$payment_method_id = 56; // int | The ID of the Payment Method to look up.

try {
    $result = $apiInstance->getPaymentMethod($payment_method_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getPaymentMethod: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **payment_method_id** | **int**| The ID of the Payment Method to look up. |

### Return type

[**\OpenAPI\Client\Model\PaymentMethod**](../Model/PaymentMethod.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPaymentMethods()`

```php
getPaymentMethods($page, $page_size): \OpenAPI\Client\Model\InlineResponse2008
```

Payment Methods List

Returns a paginated list of Payment Methods for this Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getPaymentMethods($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getPaymentMethods: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2008**](../Model/InlineResponse2008.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPayments()`

```php
getPayments($page, $page_size): \OpenAPI\Client\Model\InlineResponse2009
```

Payments List

Returns a paginated list of Payments made on this Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getPayments($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getPayments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2009**](../Model/InlineResponse2009.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getServiceTransfer()`

```php
getServiceTransfer($token): \OpenAPI\Client\Model\ServiceTransfer
```

Service Transfer View

Returns the details of the Service Transfer for the provided token.  While a transfer is pending, any unrestricted user *of any account* can access this command. After a transfer has been accepted, it can only be viewed by unrestricted users of the accounts that created and accepted the transfer. If cancelled or expired, only unrestricted users of the account that created the transfer can view it.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = 'token_example'; // string | The UUID of the Service Transfer.

try {
    $result = $apiInstance->getServiceTransfer($token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getServiceTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| The UUID of the Service Transfer. |

### Return type

[**\OpenAPI\Client\Model\ServiceTransfer**](../Model/ServiceTransfer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getServiceTransfers()`

```php
getServiceTransfers($page, $page_size): \OpenAPI\Client\Model\InlineResponse20011
```

Service Transfers List

Returns a collection of all created and accepted Service Transfers for this account, regardless of the user that created or accepted the transfer.  This command can only be accessed by the unrestricted users of an account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getServiceTransfers($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getServiceTransfers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20011**](../Model/InlineResponse20011.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTransfer()`

```php
getTransfer(): \OpenAPI\Client\Model\Transfer
```

Network Utilization View

Returns a Transfer object showing your network utilization, in GB, for the current month.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getTransfer();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getTransfer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\Transfer**](../Model/Transfer.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUser()`

```php
getUser($username): \OpenAPI\Client\Model\User
```

User View

Returns information about a single User on your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$username = 'username_example'; // string | The username to look up.

try {
    $result = $apiInstance->getUser($username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **username** | **string**| The username to look up. |

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUserGrants()`

```php
getUserGrants($username): \OpenAPI\Client\Model\GrantsResponse
```

User's Grants View

Returns the full grants structure for the specified account User (other than the account owner, see below for details). This includes all entities on the Account alongside the level of access this User has to each of them.  The current authenticated User, including the account owner, may view their own grants at the [/profile/grants](/docs/api/profile/#grants-list) endpoint, but will not see entities that they do not have access to.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$username = 'username_example'; // string | The username to look up.

try {
    $result = $apiInstance->getUserGrants($username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getUserGrants: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **username** | **string**| The username to look up. |

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

## `getUsers()`

```php
getUsers($page, $page_size): \OpenAPI\Client\Model\InlineResponse20012
```

Users List

Returns a paginated list of Users on your Account. Users may access all or part of your Account based on their restricted status and grants.  An unrestricted User may access everything on the account, whereas restricted User may only access entities or perform actions they've been given specific grants to.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getUsers($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getUsers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `makePaymentMethodDefault()`

```php
makePaymentMethodDefault($payment_method_id): object
```

Payment Method Make Default

Make the specified Payment Method the default method for automatically processing payments.  Removes the default status from any other Payment Method.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$payment_method_id = 56; // int | The ID of the Payment Method to make default.

try {
    $result = $apiInstance->makePaymentMethodDefault($payment_method_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->makePaymentMethodDefault: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **payment_method_id** | **int**| The ID of the Payment Method to make default. |

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

## `resetClientSecret()`

```php
resetClientSecret($client_id): \OpenAPI\Client\Model\OAuthClient
```

OAuth Client Secret Reset

Resets the OAuth Client secret for a client you own, and returns the OAuth Client with the plaintext secret. This secret is not supposed to be publicly known or disclosed anywhere. This can be used to generate a new secret in case the one you have has been leaked, or to get a new secret if you lost the original. The old secret is expired immediately, and logins to your client with the old secret will fail.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 'client_id_example'; // string | The OAuth Client ID to look up.

try {
    $result = $apiInstance->resetClientSecret($client_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->resetClientSecret: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| The OAuth Client ID to look up. |

### Return type

[**\OpenAPI\Client\Model\OAuthClient**](../Model/OAuthClient.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setClientThumbnail()`

```php
setClientThumbnail($client_id, $body): object
```

OAuth Client Thumbnail Update

Upload a thumbnail for a client you own.  You must upload an image file that will be returned when the thumbnail is retrieved.  This image will be publicly-viewable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 'client_id_example'; // string | The OAuth Client ID to look up.
$body = "/path/to/file.txt"; // \SplFileObject | The image to set as the thumbnail.

try {
    $result = $apiInstance->setClientThumbnail($client_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->setClientThumbnail: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| The OAuth Client ID to look up. |
 **body** | **\SplFileObject****\SplFileObject**| The image to set as the thumbnail. |

### Return type

**object**

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `image/png`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateAccount()`

```php
updateAccount($account): \OpenAPI\Client\Model\Account
```

Account Update

Updates contact and billing information related to your Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account = new \OpenAPI\Client\Model\Account(); // \OpenAPI\Client\Model\Account | Update contact and billing information.

try {
    $result = $apiInstance->updateAccount($account);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->updateAccount: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account** | [**\OpenAPI\Client\Model\Account**](../Model/Account.md)| Update contact and billing information. |

### Return type

[**\OpenAPI\Client\Model\Account**](../Model/Account.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateAccountSettings()`

```php
updateAccountSettings($account_settings): \OpenAPI\Client\Model\AccountSettings
```

Account Settings Update

Updates your Account settings.  To update your Longview subscription plan, send a request to [Update Longview Plan](/docs/api/longview/#longview-plan-update).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_settings = new \OpenAPI\Client\Model\AccountSettings(); // \OpenAPI\Client\Model\AccountSettings | Update Account settings information.

try {
    $result = $apiInstance->updateAccountSettings($account_settings);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->updateAccountSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_settings** | [**\OpenAPI\Client\Model\AccountSettings**](../Model/AccountSettings.md)| Update Account settings information. |

### Return type

[**\OpenAPI\Client\Model\AccountSettings**](../Model/AccountSettings.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateClient()`

```php
updateClient($client_id, $o_auth_client): \OpenAPI\Client\Model\OAuthClient
```

OAuth Client Update

Update information about an OAuth Client on your Account. This can be especially useful to update the `redirect_uri` of your client in the event that the callback url changed in your application.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_id = 'client_id_example'; // string | The OAuth Client ID to look up.
$o_auth_client = new \OpenAPI\Client\Model\OAuthClient(); // \OpenAPI\Client\Model\OAuthClient | The fields to update.

try {
    $result = $apiInstance->updateClient($client_id, $o_auth_client);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->updateClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **client_id** | **string**| The OAuth Client ID to look up. |
 **o_auth_client** | [**\OpenAPI\Client\Model\OAuthClient**](../Model/OAuthClient.md)| The fields to update. | [optional]

### Return type

[**\OpenAPI\Client\Model\OAuthClient**](../Model/OAuthClient.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateUser()`

```php
updateUser($username, $user): \OpenAPI\Client\Model\User
```

User Update

Update information about a User on your Account. This can be used to change the restricted status of a User. When making a User restricted, no grants will be configured by default and you must then set up grants in order for the User to access anything on the Account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$username = 'username_example'; // string | The username to look up.
$user = new \OpenAPI\Client\Model\User(); // \OpenAPI\Client\Model\User | The information to update.

try {
    $result = $apiInstance->updateUser($username, $user);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->updateUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **username** | **string**| The username to look up. |
 **user** | [**\OpenAPI\Client\Model\User**](../Model/User.md)| The information to update. | [optional]

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateUserGrants()`

```php
updateUserGrants($username, $grants_response): \OpenAPI\Client\Model\GrantsResponse
```

User's Grants Update

Update the grants a User has. This can be used to give a User access to new entities or actions, or take access away.  You do not need to include the grant for every entity on the Account in this request; any that are not included will remain unchanged.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$username = 'username_example'; // string | The username to look up.
$grants_response = new \OpenAPI\Client\Model\GrantsResponse(); // \OpenAPI\Client\Model\GrantsResponse | The grants to update. Omitted grants will be left unchanged.

try {
    $result = $apiInstance->updateUserGrants($username, $grants_response);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->updateUserGrants: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **username** | **string**| The username to look up. |
 **grants_response** | [**\OpenAPI\Client\Model\GrantsResponse**](../Model/GrantsResponse.md)| The grants to update. Omitted grants will be left unchanged. |

### Return type

[**\OpenAPI\Client\Model\GrantsResponse**](../Model/GrantsResponse.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

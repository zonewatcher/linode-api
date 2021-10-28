# # Profile

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**uid** | **int** | Your unique ID in our system. This value will never change, and can safely be used to identify your User. | [optional] [readonly]
**username** | **string** | Your username, used for logging in to our system. | [optional] [readonly]
**email** | **string** | Your email address.  This address will be used for communication with Linode as necessary. | [optional]
**timezone** | **string** | The timezone you prefer to see times in. This is not used by the API directly. It is provided for the benefit of clients such as the Linode Cloud Manager and other clients built on the API. All times returned by the API are in UTC. | [optional]
**email_notifications** | **bool** | If true, you will receive email notifications about account activity.  If false, you may still receive business-critical communications through email. | [optional]
**referrals** | [**\OpenAPI\Client\Model\ProfileReferrals**](ProfileReferrals.md) |  | [optional]
**ip_whitelist_enabled** | **bool** | If true, logins for your User will only be allowed from whitelisted IPs. This setting is currently deprecated, and cannot be enabled.  If you disable this setting, you will not be able to re-enable it. | [optional]
**lish_auth_method** | **string** | The authentication methods that are allowed when connecting to [the Linode Shell (Lish)](/docs/platform/manager/using-the-linode-shell-lish/). * &#x60;keys_only&#x60; is the most secure if you intend to use Lish. * &#x60;disabled&#x60; is recommended if you do not intend to use Lish at all. * If this account&#39;s Cloud Manager authentication type is set to a Third-Party Authentication method, &#x60;password_keys&#x60; cannot be used as your Lish authentication method. To view this account&#39;s Cloud Manager &#x60;authentication_type&#x60; field, send a request to the [View Profile](/docs/api/profile/#profile-view) endpoint. | [optional]
**authorized_keys** | **string[]** | The list of SSH Keys authorized to use Lish for your User. This value is ignored if &#x60;lish_auth_method&#x60; is \&quot;disabled.\&quot; | [optional]
**two_factor_auth** | **bool** | If true, logins from untrusted computers will require Two Factor Authentication.  See [/profile/tfa-enable](/docs/api/profile/#two-factor-secret-create) to enable Two Factor Authentication. | [optional]
**restricted** | **bool** | If true, your User has restrictions on what can be accessed on your Account. To get details on what entities/actions you can access/perform, see [/profile/grants](/docs/api/profile/#grants-list). | [optional]
**authentication_type** | **string** | This account&#39;s Cloud Manager authentication type. Authentication types are chosen through Cloud Manager and authorized when logging into your account. These authentication types are either the user&#39;s password (in conjunction with their username), or the name of their indentity provider such as GitHub. For example, if a user:  - Has never used Third-Party Authentication, their authentication type will be &#x60;password&#x60;. - Is using Third-Party Authentication, their authentication type will be the name of their Identity Provider (eg. &#x60;github&#x60;). - Has used Third-Party Authentication and has since revoked it, their authentication type will be &#x60;password&#x60;.   **Note:** This functionality may not yet be available in Cloud Manager. See the [Cloud Manager Changelog](/changelog/cloud-manager/) for the latest updates. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

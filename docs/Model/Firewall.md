# # Firewall

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The Firewall&#39;s unique ID. | [optional] [readonly]
**label** | **string** | The Firewall&#39;s label, for display purposes only.  Firewall labels have the following constraints:    * Must begin and end with an alphanumeric character.   * May only consist of alphanumeric characters, dashes (&#x60;-&#x60;), underscores (&#x60;_&#x60;) or periods (&#x60;.&#x60;).   * Cannot have two dashes (&#x60;--&#x60;), underscores (&#x60;__&#x60;) or periods (&#x60;..&#x60;) in a row.   * Must be between 3 and 32 characters.   * Must be unique. | [optional]
**created** | **\DateTime** | When this Firewall was created. | [optional] [readonly]
**updated** | **\DateTime** | When this Firewall was last updated. | [optional] [readonly]
**status** | **string** | The status of this Firewall.    * When a Firewall is first created its status is &#x60;enabled&#x60;.   * Use the [Update Firewall](/docs/api/networking/#firewall-update) endpoint to set a Firewall&#39;s status to &#x60;enabled&#x60; or &#x60;disabled&#x60;.   * Use the [Delete Firewall](/docs/api/networking/#firewall-delete) endpoint to delete a Firewall. | [optional] [readonly]
**rules** | [**\OpenAPI\Client\Model\FirewallRules**](FirewallRules.md) |  | [optional]
**tags** | **string[]** | An array of tags applied to this object. Tags are for organizational purposes only. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # LongviewClient

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This Client&#39;s unique ID. | [optional] [readonly]
**label** | **string** | This Client&#39;s unique label. This is for display purposes only. | [optional]
**api_key** | **string** | The API key for this Client, used when configuring the Longview Client application on your Linode.  Returns as &#x60;[REDACTED]&#x60; if you do not have read-write access to this client. | [optional] [readonly]
**install_code** | **string** | The install code for this Client, used when configuring the Longview Client application on your Linode.  Returns as &#x60;[REDACTED]&#x60; if you do not have read-write access to this client. | [optional] [readonly]
**apps** | [**\OpenAPI\Client\Model\LongviewClientApps**](LongviewClientApps.md) |  | [optional]
**created** | **\DateTime** | When this Longview Client was created. | [optional] [readonly]
**updated** | **\DateTime** | When this Longview Client was last updated. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

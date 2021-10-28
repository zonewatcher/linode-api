# # AccountSettings

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**managed** | **bool** | Our 24/7 incident response service. This robust, multi-homed monitoring system distributes monitoring checks to ensure that your servers remain online and available at all times. Linode Managed can monitor any service or software stack reachable over TCP or HTTP. Once you add a service to Linode Managed, we&#39;ll monitor it for connectivity, response, and total request time. | [optional] [readonly]
**longview_subscription** | **string** | The Longview Pro tier you are currently subscribed to. The value must be a [Longview Subscription](/docs/api/longview/#longview-subscriptions-list) ID or &#x60;null&#x60; for Longview Free. | [optional] [readonly]
**network_helper** | **bool** | Enables network helper across all users by default for new Linodes and Linode Configs. | [optional]
**backups_enabled** | **bool** | Account-wide backups default.  If &#x60;true&#x60;, all Linodes created will automatically be enrolled in the Backups service.  If &#x60;false&#x60;, Linodes will not be enrolled by default, but may still be enrolled on creation or later. | [optional]
**object_storage** | **string** | A string describing the status of this account&#39;s Object Storage service enrollment. | [optional] [readonly] [default to 'disabled']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # LinodeBackups

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**enabled** | **bool** | If this Linode has the Backup service enabled. To enable backups, see [POST /linode/instances/{linodeId}/backups/enable](/docs/api/linode-instances/#backups-enable). | [optional] [readonly]
**schedule** | [**\OpenAPI\Client\Model\LinodeBackupsSchedule**](LinodeBackupsSchedule.md) |  | [optional]
**last_successful** | **\DateTime** | The last successful backup date. &#39;null&#39; if there was no previous backup. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # Backup

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The unique ID of this Backup. | [optional] [readonly]
**type** | **string** | This indicates whether the Backup is an automatic Backup or manual snapshot taken by the User at a specific point in time. | [optional] [readonly]
**status** | **string** | The current state of a specific Backup. | [optional] [readonly]
**created** | **\DateTime** | The date the Backup was taken. | [optional] [readonly]
**updated** | **\DateTime** | The date the Backup was most recently updated. | [optional] [readonly]
**finished** | **\DateTime** | The date the Backup completed. | [optional] [readonly]
**label** | **string** | A label for Backups that are of type &#x60;snapshot&#x60;. | [optional]
**configs** | **string[]** | A list of the labels of the Configuration profiles that are part of the Backup. | [optional] [readonly]
**disks** | [**\OpenAPI\Client\Model\BackupDisks[]**](BackupDisks.md) | A list of the disks that are part of the Backup. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

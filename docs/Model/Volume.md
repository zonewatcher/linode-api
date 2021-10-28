# # Volume

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The unique ID of this Volume. | [optional] [readonly]
**label** | **string** | The Volume&#39;s label is for display purposes only. | [optional]
**filesystem_path** | **string** | The full filesystem path for the Volume based on the Volume&#39;s label. Path is /dev/disk/by-id/scsi-0Linode_Volume_ + Volume label. | [optional] [readonly]
**status** | **string** | The current status of the volume.  Can be one of:    * &#x60;creating&#x60; - the Volume is being created and is not yet available     for use.   * &#x60;active&#x60; - the Volume is online and available for use.   * &#x60;resizing&#x60; - the Volume is in the process of upgrading     its current capacity.   * &#x60;contact_support&#x60; - there is a problem with your Volume. Please     [open a Support Ticket](/docs/api/support/#support-ticket-open) to resolve the issue. | [optional] [readonly]
**size** | **int** | The Volume&#39;s size, in GiB. | [optional]
**region** | [**\OpenAPI\Client\Model\Id**](Id.md) |  | [optional]
**linode_id** | **int** | If a Volume is attached to a specific Linode, the ID of that Linode will be displayed here. | [optional]
**linode_label** | **string** | If a Volume is attached to a specific Linode, the label of that Linode will be displayed here. | [optional] [readonly]
**created** | **\DateTime** | When this Volume was created. | [optional] [readonly]
**updated** | **\DateTime** | When this Volume was last updated. | [optional] [readonly]
**tags** | **string[]** | An array of Tags applied to this object.  Tags are for organizational purposes only. | [optional]
**hardware_type** | **string** | The storage type of this Volume. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

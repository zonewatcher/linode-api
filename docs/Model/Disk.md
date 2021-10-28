# # Disk

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This Disk&#39;s ID which must be provided for all operations impacting this Disk. | [optional] [readonly]
**label** | **string** | The Disk&#39;s label is for display purposes only. | [optional]
**status** | **string** | A brief description of this Disk&#39;s current state. This field may change without direct action from you, as a result of operations performed to the Disk or the Linode containing the Disk. | [optional] [readonly]
**size** | **int** | The size of the Disk in MB. | [optional]
**filesystem** | **string** | The Disk filesystem can be one of:    * raw - No filesystem, just a raw binary stream.   * swap - Linux swap area.   * ext3 - The ext3 journaling filesystem for Linux.   * ext4 - The ext4 journaling filesystem for Linux.   * initrd - initrd (uncompressed initrd, ext2, max 32 MB). | [optional]
**created** | **\DateTime** | When this Disk was created. | [optional] [readonly]
**updated** | **\DateTime** | When this Disk was last updated. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

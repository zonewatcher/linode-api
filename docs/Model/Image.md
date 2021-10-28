# # Image

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The unique ID of this Image. | [optional] [readonly]
**label** | **string** | A short description of the Image. | [optional]
**created** | **\DateTime** | When this Image was created. | [optional] [readonly]
**updated** | **\DateTime** | When this Image was last updated. | [optional] [readonly]
**created_by** | **string** | The name of the User who created this Image, or \&quot;linode\&quot; for public Images. | [optional] [readonly]
**deprecated** | **bool** | Whether or not this Image is deprecated. Will only be true for deprecated public Images. | [optional] [readonly]
**description** | **string** | A detailed description of this Image. | [optional]
**is_public** | **bool** | True if the Image is a public distribution image. False if Image is private Account-specific Image. | [optional] [readonly]
**size** | **int** | The minimum size this Image needs to deploy. Size is in MB. | [optional] [readonly]
**type** | **string** | How the Image was created.  \&quot;Manual\&quot; Images can be created at any time.  \&quot;Automatic\&quot; Images are created automatically from a deleted Linode. | [optional] [readonly]
**expiry** | **\DateTime** | Only Images created automatically from a deleted Linode (type&#x3D;automatic) will expire. | [optional] [readonly]
**eol** | **\DateTime** | The date of the public Image&#39;s planned end of life. &#x60;None&#x60; for private Images. | [optional] [readonly]
**vendor** | **string** | The upstream distribution vendor. &#x60;None&#x60; for private Images. | [optional] [readonly]
**status** | **string** | The current status of this Image.  Only Images in an \&quot;available\&quot; status can be deployed.  Images in a \&quot;creating\&quot; status are being created from a Linode Disk, and will become \&quot;available\&quot; shortly.  Images in a \&quot;pending_upload\&quot; status are waiting for data to be [uploaded](/docs/api/images/#image-upload), and become \&quot;available\&quot; after the upload and processing are complete. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

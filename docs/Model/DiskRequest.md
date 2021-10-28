# # DiskRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**size** | **int** | The size of the Disk in MB.  Images require a minimum size. Access the Image View ([GET /images/{imageID}](/docs/api/images/#image-view)) endpoint to view its size. | [optional]
**label** | [**\OpenAPI\Client\Model\Label**](Label.md) |  | [optional]
**filesystem** | [**\OpenAPI\Client\Model\Filesystem**](Filesystem.md) |  | [optional]
**image** | **string** | An Image ID to deploy the Linode Disk from.  Access the Images List ([GET /images](/docs/api/images/#images-list)) endpoint with authentication to view all available Images. Official Linode Images start with &#x60;linode/&#x60;, while your Account&#39;s Images start with &#x60;private/&#x60;. Creating a disk from a Private Image requires &#x60;read_only&#x60; or &#x60;read_write&#x60; permissions for that Image. Access the User&#39;s Grant Update ([PUT /account/users/{username}/grants](/docs/api/account/#users-grants-update)) endpoint to adjust permissions for an Account Image. | [optional]
**authorized_keys** | **string[]** | A list of public SSH keys that will be automatically appended to the root user&#39;s &#x60;~/.ssh/authorized_keys&#x60; file when deploying from an Image. | [optional]
**authorized_users** | **string[]** | A list of usernames. If the usernames have associated SSH keys, the keys will be appended to the root users &#x60;~/.ssh/authorized_keys&#x60; file automatically when deploying from an Image. | [optional]
**root_pass** | **string** | This sets the root user&#39;s password on a newly-created Linode Disk when deploying from an Image.  * Must meet a password strength score requirement that is calculated internally by the API. If the strength requirement is not met, you will receive a &#x60;Password does not meet strength requirement&#x60; error. | [optional]
**stackscript_id** | **int** | A StackScript ID that will cause the referenced StackScript to be run during deployment of this Linode. A compatible &#x60;image&#x60; is required to use a StackScript. To get a list of available StackScript and their permitted Images see [/stackscripts](/docs/api/stackscripts/#stackscripts-list). This field cannot be used when deploying from a Backup or a Private Image. | [optional]
**stackscript_data** | **object** | This field is required only if the StackScript being deployed requires input data from the User for successful completion. See [User Defined Fields (UDFs)](/docs/guides/writing-scripts-for-use-with-linode-stackscripts-a-tutorial/#user-defined-fields-udfs) for more details. This field is required to be valid JSON. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

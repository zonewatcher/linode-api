# # LinodeRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**image** | [**\OpenAPI\Client\Model\Image**](Image.md) |  | [optional]
**root_pass** | [**\OpenAPI\Client\Model\RootPass**](RootPass.md) |  | [optional]
**authorized_keys** | [**\OpenAPI\Client\Model\AuthorizedKeys**](AuthorizedKeys.md) |  | [optional]
**authorized_users** | [**\OpenAPI\Client\Model\AuthorizedUsers**](AuthorizedUsers.md) |  | [optional]
**stackscript_id** | [**\OpenAPI\Client\Model\StackscriptId**](StackscriptId.md) |  | [optional]
**stackscript_data** | [**\OpenAPI\Client\Model\StackscriptData**](StackscriptData.md) |  | [optional]
**booted** | **bool** | This field defaults to &#x60;true&#x60; if the Linode is created with an Image or from a Backup. If it is deployed from an Image or a Backup and you wish it to remain &#x60;offline&#x60; after deployment, set this to &#x60;false&#x60;. | [optional] [default to true]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

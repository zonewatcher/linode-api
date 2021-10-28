# # StackScript

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The unique ID of this StackScript. | [optional] [readonly]
**username** | **string** | The User who created the StackScript. | [optional] [readonly]
**user_gravatar_id** | **string** | The Gravatar ID for the User who created the StackScript. | [optional] [readonly]
**label** | **string** | The StackScript&#39;s label is for display purposes only. | [optional]
**description** | **string** | A description for the StackScript. | [optional]
**images** | **string[]** | An array of Image IDs. These are the images that can be deployed with this Stackscript. | [optional]
**deployments_total** | **int** | The total number of times this StackScript has been deployed. | [optional] [readonly]
**deployments_active** | **int** | Count of currently active, deployed Linodes created from this StackScript. | [optional] [readonly]
**is_public** | **bool** | This determines whether other users can use your StackScript. **Once a StackScript is made public, it cannot be made private.** | [optional]
**created** | **\DateTime** | The date this StackScript was created. | [optional] [readonly]
**updated** | **\DateTime** | The date this StackScript was last updated. | [optional] [readonly]
**rev_note** | **string** | This field allows you to add notes for the set of revisions made to this StackScript. | [optional]
**script** | **string** | The script to execute when provisioning a new Linode with this StackScript. | [optional]
**user_defined_fields** | [**\OpenAPI\Client\Model\UserDefinedField[]**](UserDefinedField.md) | This is a list of fields defined with a special syntax inside this StackScript that allow for supplying customized parameters during deployment. See &lt;a target&#x3D;\&quot;_top\&quot; href&#x3D;\&quot;/docs/platform/stackscripts/#variables-and-udfs\&quot;&gt;Variables and UDFs&lt;/a&gt; for more information. | [optional] [readonly]
**mine** | **bool** | Returns &#x60;true&#x60; if this StackScript is owned by the account of the user making the request, and the user making the request is unrestricted or has access to this StackScript. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

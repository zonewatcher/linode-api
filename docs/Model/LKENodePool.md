# # LKENodePool

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**autoscaler** | [**\OpenAPI\Client\Model\LKENodePoolAutoscaler**](LKENodePoolAutoscaler.md) |  | [optional]
**type** | **string** | The Linode Type for all of the nodes in the Node Pool. | [optional]
**count** | **int** | The number of nodes in the Node Pool. | [optional]
**disks** | [**\OpenAPI\Client\Model\LKENodePoolDisks[]**](LKENodePoolDisks.md) | This Node Pool&#39;s custom disk layout. | [optional]
**id** | **int** | This Node Pool&#39;s unique ID. | [optional]
**nodes** | [**\OpenAPI\Client\Model\LKENodeStatus[]**](LKENodeStatus.md) | Status information for the Nodes which are members of this Node Pool. If a Linode has not been provisioned for a given Node slot, the instance_id will be returned as null. | [optional]
**tags** | **string[]** | An array of tags applied to this object. Tags are for organizational purposes only. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # LKENodePoolRequestBody

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**autoscaler** | [**\OpenAPI\Client\Model\LKENodePoolRequestBodyAutoscaler**](LKENodePoolRequestBodyAutoscaler.md) |  | [optional]
**type** | [**\OpenAPI\Client\Model\Type**](Type.md) |  | [optional]
**count** | [**\OpenAPI\Client\Model\Count**](Count.md) |  | [optional]
**disks** | [**\OpenAPI\Client\Model\Items[]**](Items.md) | **Note**: This field should be omitted except for special use cases. The disks specified here are partitions in *addition* to the primary partition and reduce the size of the primary partition, which can lead to stability problems for the Node.  This Node Pool&#39;s custom disk layout. Each item in this array will create a new disk partition for each node in this Node Pool.    * The custom disk layout is applied to each node in this Node Pool.   * The maximum number of custom disk partitions that can be configured is 7.   * Once the requested disk paritions are allocated, the remaining disk space is allocated to the node&#39;s boot disk.   * A Node Pool&#39;s custom disk layout is immutable over the lifetime of the Node Pool. | [optional]
**tags** | [**\OpenAPI\Client\Model\Tags**](Tags.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

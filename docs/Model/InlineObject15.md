# # InlineObject15

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**label** | **string** | The name for this bucket. Must be unique in the cluster you are creating the bucket in, or an error will be returned. Labels will be reserved only for the cluster that active buckets are created and stored in. If you want to reserve this bucket&#39;s label in another cluster, you must create a new bucket with the same label in the new cluster. |
**cluster** | **string** | The ID of the Object Storage Cluster where this bucket should be created. |
**cors_enabled** | **bool** | If true, the bucket will be created with CORS enabled for all origins. For more fine-grained controls of CORS, use the S3 API directly. | [optional] [default to false]
**acl** | **string** | The Access Control Level of the bucket using a canned ACL string. For more fine-grained control of ACLs, use the S3 API directly. | [optional] [default to 'private']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

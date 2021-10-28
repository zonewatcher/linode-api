# # ManagedIssue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This Issue&#39;s unique ID. | [optional] [readonly]
**created** | **\DateTime** | When this Issue was created. Issues are created in response to issues detected with Managed Services, so this is also when the Issue was detected. | [optional] [readonly]
**services** | **int[]** | An array of Managed Service IDs that were affected by this Issue. | [optional] [readonly]
**entity** | [**\OpenAPI\Client\Model\ManagedIssueEntity**](ManagedIssueEntity.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

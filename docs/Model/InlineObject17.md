# # InlineObject17

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**label** | **string** | The new Tag. |
**linodes** | **int[]** | A list of Linode IDs to apply the new Tag to.  You must be allowed to &#x60;read_write&#x60; all of the requested Linodes, or the Tag will not be created and an error will be returned. | [optional]
**domains** | **int[]** | A list of Domain IDs to apply the new Tag to.  You must be allowed to &#x60;read_write&#x60; all of the requested Domains, or the Tag will not be created and an error will be returned. | [optional]
**volumes** | **int[]** | A list of Volume IDs to apply the new Tag to.  You must be allowed to &#x60;read_write&#x60; all of the requested Volumes, or the Tag will not be created and an error will be returned. | [optional]
**nodebalancers** | **int[]** | A list of NodeBalancer IDs to apply the new Tag to. You must be allowed to &#x60;read_write&#x60; all of the requested NodeBalancers, or the Tag will not be created and an error will be returned. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

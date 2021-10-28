# # GrantsResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**global** | [**\OpenAPI\Client\Model\GrantsResponseGlobal**](GrantsResponseGlobal.md) |  | [optional]
**linode** | [**\OpenAPI\Client\Model\Grant[]**](Grant.md) | The grants this User has pertaining to Linodes on this Account. There will be one entry per Linode on the Account. | [optional]
**domain** | [**\OpenAPI\Client\Model\Grant[]**](Grant.md) | The grants this User has pertaining to Domains on this Account. There will be one entry per Domain on the Account. | [optional]
**nodebalancer** | [**\OpenAPI\Client\Model\Grant[]**](Grant.md) | The grants this User has pertaining to NodeBalancers on this Account. There will be one entry per NodeBalancer on the Account. | [optional]
**image** | [**\OpenAPI\Client\Model\Grant[]**](Grant.md) | The grants this User has pertaining to Images on this Account. There will be one entry per Image on the Account. | [optional]
**longview** | [**\OpenAPI\Client\Model\Grant[]**](Grant.md) | The grants this User has pertaining to Longview Clients on this Account. There will be one entry per Longview Client on the Account. | [optional]
**stackscript** | [**\OpenAPI\Client\Model\Grant[]**](Grant.md) | The grants this User has pertaining to StackScripts on this Account.  There will be one entry per StackScript on the Account. | [optional]
**volume** | [**\OpenAPI\Client\Model\Grant[]**](Grant.md) | The grants this User has pertaining to Volumes on this Account. There will be one entry per Volume on the Account. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

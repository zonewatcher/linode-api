# # SupportTicketRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**description** | **string** | The full details of the issue or question. |
**domain_id** | **int** | The ID of the Domain this ticket is regarding, if relevant. | [optional]
**linode_id** | **int** | The ID of the Linode this ticket is regarding, if relevant. | [optional]
**longviewclient_id** | **int** | The ID of the Longview client this ticket is regarding, if relevant. | [optional]
**nodebalancer_id** | **int** | The ID of the NodeBalancer this ticket is regarding, if relevant. | [optional]
**summary** | **string** | The summary or title for this SupportTicket. |
**managed_issue** | **bool** | Designates if this ticket is related to a [Managed service](https://www.linode.com/products/managed/). If &#x60;true&#x60;, the following constraints will apply: * No ID attributes (i.e. &#x60;linode_id&#x60;, &#x60;domain_id&#x60;, etc.) should be provided with this request. * Your account must have a [Managed service enabled](/docs/api/managed/#managed-service-enable). | [optional]
**volume_id** | **int** | The ID of the Volume this ticket is regarding, if relevant. | [optional]
**vlan** | **string** | The label of the VLAN this ticket is regarding, if relevant. To view your VLANs, use the VLANs List ([GET /networking/vlans](/docs/api/networking/#vlans-list)) endpoint.  Requires a specified &#x60;region&#x60; to identify the VLAN. | [optional]
**region** | **string** | The [Region](/docs/api/regions/) ID for the associated VLAN this ticket is regarding.  Only allowed when submitting a VLAN ticket. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # IPAddressPrivate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**address** | **string** | The private IPv4 address. | [optional] [readonly]
**gateway** | **string** | The default gateway for this address. | [optional] [readonly]
**subnet_mask** | **string** | The mask that separates host bits from network bits for this address. | [optional] [readonly]
**prefix** | **int** | The number of bits set in the subnet mask. | [optional] [readonly]
**type** | **string** | The type of address this is. | [optional] [readonly]
**public** | **bool** | Whether this is a public or private IP address. | [optional] [readonly]
**rdns** | **string** | The reverse DNS assigned to this address. | [optional]
**linode_id** | **int** | The ID of the Linode this address currently belongs to. | [optional] [readonly]
**region** | **string** | The Region this address resides in. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

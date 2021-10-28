# # IPAddress

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**address** | **string** | The IP address. | [optional] [readonly]
**gateway** | **string** | The default gateway for this address. | [optional] [readonly]
**subnet_mask** | **string** | The mask that separates host bits from network bits for this address. | [optional] [readonly]
**prefix** | **int** | The number of bits set in the subnet mask. | [optional] [readonly]
**type** | **string** | The type of address this is. | [optional] [readonly]
**public** | **bool** | Whether this is a public or private IP address. | [optional] [readonly]
**rdns** | **string** | The reverse DNS assigned to this address. For public IPv4 addresses, this will be set to a default value provided by Linode if not explicitly set. | [optional]
**linode_id** | **int** | The ID of the Linode this address currently belongs to. For IPv4 addresses, this is by default the Linode that this address was assigned to on creation, and these addresses my be moved using the [/networking/ipv4/assign](/docs/api/networking/#ips-to-linodes-assign) endpoint. For SLAAC and link-local addresses, this value may not be changed. | [optional] [readonly]
**region** | **string** | The Region this IP address resides in. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

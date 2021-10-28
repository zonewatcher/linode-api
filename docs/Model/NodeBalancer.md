# # NodeBalancer

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This NodeBalancer&#39;s unique ID. | [optional] [readonly]
**label** | **string** | This NodeBalancer&#39;s label. These must be unique on your Account. | [optional]
**region** | **string** | The Region where this NodeBalancer is located. NodeBalancers only support backends in the same Region. | [optional] [readonly]
**hostname** | **string** | This NodeBalancer&#39;s hostname, ending with _.nodebalancer.linode.com_ | [optional] [readonly]
**ipv4** | **string** | This NodeBalancer&#39;s public IPv4 address. | [optional] [readonly]
**ipv6** | **string** | This NodeBalancer&#39;s public IPv6 address. | [optional] [readonly]
**created** | **\DateTime** | When this NodeBalancer was created. | [optional] [readonly]
**updated** | **\DateTime** | When this NodeBalancer was last updated. | [optional] [readonly]
**client_conn_throttle** | **int** | Throttle connections per second.  Set to 0 (zero) to disable throttling. | [optional]
**transfer** | [**\OpenAPI\Client\Model\NodeBalancerTransfer**](NodeBalancerTransfer.md) |  | [optional]
**tags** | **string[]** | An array of Tags applied to this object.  Tags are for organizational purposes only. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # FirewallRules

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**inbound** | [**\OpenAPI\Client\Model\FirewallRuleConfig[]**](FirewallRuleConfig.md) | The inbound rules for the firewall, as a JSON array. | [optional]
**outbound** | [**\OpenAPI\Client\Model\FirewallRuleConfig[]**](FirewallRuleConfig.md) | The outbound rules for the firewall, as a JSON array. | [optional]
**inbound_policy** | **string** | The default behavior for inbound traffic. This setting can be overridden by [updating](/docs/api/networking/#firewall-rules-update) the &#x60;inbound.action&#x60; property of the Firewall Rule. | [optional]
**outbound_policy** | **string** | The default behavior for outbound traffic. This setting can be overridden by [updating](/docs/api/networking/#firewall-rules-update) the &#x60;outbound.action&#x60; property of the Firewall Rule. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

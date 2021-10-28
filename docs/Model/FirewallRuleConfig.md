# # FirewallRuleConfig

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**protocol** | **string** | The type of network traffic to allow. | [optional]
**ports** | **string** | A string representing the port or ports on which traffic will be allowed:  - The string may be a single port, a range of ports, or a comma-separated list of single ports and port ranges. A space is permitted following each comma. - A range of ports is inclusive of the start and end values for the range. The end value of the range must be greater than the start value. - Ports must be within 1 and 65535, and may not contain any leading zeroes. For example, port \&quot;080\&quot; is not allowed. - Ports may not be specified if a rule&#39;s protocol is &#x60;ICMP&#x60;. At least one port must be specified if a rule&#39;s protocol is &#x60;TCP&#x60; or &#x60;UDP&#x60;. - The ports string can have up to 15 *pieces*, where a single port is treated as one piece, and a port range is treated as two pieces. For example, the string \&quot;22-24, 80, 443\&quot; has four pieces. | [optional]
**addresses** | [**\OpenAPI\Client\Model\FirewallRuleConfigAddresses**](FirewallRuleConfigAddresses.md) |  | [optional]
**action** | **string** | Controls whether traffic is accepted or dropped by this rule. Overrides the Firewall&#39;s &#x60;inbound_policy&#x60; if this is an inbound rule, or the &#x60;outbound_policy&#x60; if this is an outbound rule. | [optional]
**label** | **string** | Used to identify this rule. For display purposes only. | [optional]
**description** | **string** | Used to describe this rule. For display purposes only. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

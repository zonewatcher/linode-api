# # LinodeAlerts

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**cpu** | **int** | The percentage of CPU usage required to trigger an alert. If the average CPU usage over two hours exceeds this value, we&#39;ll send you an alert. Your Linode&#39;s total CPU capacity is represented as 100%, multiplied by its number of cores.  For example, a two core Linode&#39;s CPU capacity is represented as 200%. If you want to be alerted at 90% of a two core Linode&#39;s CPU capacity, set the alert value to &#x60;180&#x60;.  The default value is 90% multiplied by the number of cores.  If the value is set to &#x60;0&#x60; (zero), the alert is disabled. | [optional]
**network_in** | **int** | The amount of incoming traffic, in Mbit/s, required to trigger an alert. If the average incoming traffic over two hours exceeds this value, we&#39;ll send you an alert. If this is set to &#x60;0&#x60; (zero), the alert is disabled. | [optional]
**network_out** | **int** | The amount of outbound traffic, in Mbit/s, required to trigger an alert. If the average outbound traffic over two hours exceeds this value, we&#39;ll send you an alert. If this is set to &#x60;0&#x60; (zero), the alert is disabled. | [optional]
**transfer_quota** | **int** | The percentage of network transfer that may be used before an alert is triggered. When this value is exceeded, we&#39;ll alert you. If this is set to &#x60;0&#x60; (zero), the alert is disabled. | [optional]
**io** | **int** | The amount of disk IO operation per second required to trigger an alert. If the average disk IO over two hours exceeds this value, we&#39;ll send you an alert. If set to &#x60;0&#x60; (zero), this alert is disabled. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

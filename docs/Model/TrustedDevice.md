# # TrustedDevice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The unique ID for this TrustedDevice | [optional] [readonly]
**created** | **\DateTime** | When this Remember Me session was started.  This corresponds to the time of login with the \&quot;Remember Me\&quot; box checked. | [optional] [readonly]
**expiry** | **\DateTime** | When this TrustedDevice session expires.  Sessions typically last 30 days. | [optional] [readonly]
**user_agent** | **string** | The User Agent of the browser that created this TrustedDevice session. | [optional] [readonly]
**last_authenticated** | **\DateTime** | The last time this TrustedDevice was successfully used to authenticate to &lt;a target&#x3D;\&quot;_top\&quot; href&#x3D;\&quot;https://login.linode.com\&quot;&gt;login.linode.com&lt;/a&gt;. | [optional] [readonly]
**last_remote_addr** | **string** | The last IP Address to successfully authenticate with this TrustedDevice. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

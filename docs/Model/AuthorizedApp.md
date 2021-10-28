# # AuthorizedApp

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This authorization&#39;s ID, used for revoking access. | [optional] [readonly]
**label** | **string** | The name of the application you&#39;ve authorized. | [optional] [readonly]
**thumbnail_url** | **string** | The URL at which this app&#39;s thumbnail may be accessed. | [optional] [readonly]
**scopes** | **string** | The OAuth scopes this app was authorized with.  This defines what parts of your Account the app is allowed to access. | [optional] [readonly]
**created** | **\DateTime** | When this app was authorized. | [optional] [readonly]
**expiry** | **\DateTime** | When the app&#39;s access to your account expires. If &#x60;null&#x60;, the app&#39;s access must be revoked manually. | [optional] [readonly]
**website** | **string** | The website where you can get more information about this app. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

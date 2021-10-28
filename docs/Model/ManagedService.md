# # ManagedService

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This Service&#39;s unique ID. | [optional] [readonly]
**status** | **string** | The current status of this Service. | [optional] [readonly]
**service_type** | **string** | How this Service is monitored. | [optional]
**label** | **string** | The label for this Service. This is for display purposes only. | [optional]
**address** | **string** | The URL at which this Service is monitored.  URL parameters such as &#x60;?no-cache&#x3D;1&#x60; are preserved.  URL fragments/anchors such as &#x60;#monitor&#x60; are **not** preserved. | [optional]
**timeout** | **int** | How long to wait, in seconds, for a response before considering the Service to be down. | [optional]
**body** | **string** | What to expect to find in the response body for the Service to be considered up. | [optional]
**consultation_group** | **string** | The group of ManagedContacts who should be notified or consulted with when an Issue is detected. | [optional]
**notes** | **string** | Any information relevant to the Service that Linode special forces should know when attempting to resolve Issues. | [optional]
**region** | **string** | The Region in which this Service is located. This is required if address is a private IP, and may not be set otherwise. | [optional]
**credentials** | **int[]** | An array of ManagedCredential IDs that should be used when attempting to resolve issues with this Service. | [optional]
**created** | **\DateTime** | When this Managed Service was created. | [optional] [readonly]
**updated** | **\DateTime** | When this Managed Service was last updated. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

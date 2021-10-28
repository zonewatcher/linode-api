# # ObjectStorageObject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | The name of this object or prefix. | [optional]
**etag** | **string** | An MD-5 hash of the object. &#x60;null&#x60; if this object represents a prefix. | [optional]
**last_modified** | **\DateTime** | The date and time this object was last modified. &#x60;null&#x60; if this object represents a prefix. | [optional]
**owner** | **string** | The owner of this object, as a UUID. &#x60;null&#x60; if this object represents a prefix. | [optional]
**size** | **int** | The size of this object, in bytes. &#x60;null&#x60; if this object represents a prefix. | [optional]
**next_marker** | **string** | Returns the value you should pass to the &#x60;marker&#x60; query parameter to get the next page of objects. If there is no next page, &#x60;null&#x60; will be returned. | [optional]
**is_truncated** | **bool** | Designates if there is another page of bucket objects. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

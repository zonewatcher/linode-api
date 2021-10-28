# # ObjectStorageKey

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This keypair&#39;s unique ID | [optional] [readonly]
**label** | **string** | The label given to this key. For display purposes only. | [optional]
**access_key** | **string** | This keypair&#39;s access key. This is not secret. | [optional] [readonly]
**secret_key** | **string** | This keypair&#39;s secret key. Only returned on key creation. | [optional] [readonly]
**limited** | **bool** | Whether or not this key is a limited access key. Will return &#x60;false&#x60; if this key grants full access to all buckets on the user&#39;s account. | [optional] [readonly]
**bucket_access** | [**\OpenAPI\Client\Model\ObjectStorageKeyBucketAccess[]**](ObjectStorageKeyBucketAccess.md) | Defines this key as a Limited Access Key. Limited Access Keys restrict this Object Storage key&#39;s access to only the bucket(s) declared in this array and define their bucket-level permissions.     Limited Access Keys can:    * [list all buckets](/docs/api/object-storage/#object-storage-buckets-list) available on this Account, but cannot perform any actions on a bucket unless it has access to the bucket.     * [create new buckets](/docs/api/object-storage/#object-storage-bucket-create), but do not have any access to the buckets it creates, unless explicitly given access to them.     **Note:** You can create an Object Storage Limited Access Key without access to any buckets.   This is achieved by sending a request with an empty &#x60;bucket_access&#x60; array.     **Note:** If this field is omitted, a regular unlimited access key is issued. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

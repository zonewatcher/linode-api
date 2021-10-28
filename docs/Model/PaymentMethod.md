# # PaymentMethod

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The unique ID of this Payment Method. | [optional]
**type** | **string** | The type of Payment Method. | [optional]
**is_default** | **bool** | Whether this Payment Method is the default method for automatically processing service charges. | [optional]
**created** | **\DateTime** | When the Payment Method was added to the Account. | [optional] [readonly]
**data** | [**\OpenAPI\Client\Model\PaymentMethodData**](PaymentMethodData.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

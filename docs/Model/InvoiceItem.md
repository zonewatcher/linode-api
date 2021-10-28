# # InvoiceItem

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**amount** | **float** | The price, in US dollars, of the Invoice Item. Equal to the unit price multiplied by quantity. | [optional] [readonly]
**tax** | **float** | The amount of tax levied on this Item in US Dollars. | [optional] [readonly]
**total** | **float** | The price of this Item after taxes in US Dollars. | [optional] [readonly]
**from** | **\DateTime** | The date the Invoice Item started, based on month. | [optional] [readonly]
**label** | **string** | The Invoice Item&#39;s display label. | [optional] [readonly]
**quantity** | **int** | The quantity of this Item for the specified Invoice. | [optional] [readonly]
**to** | **\DateTime** | The date the Invoice Item ended, based on month. | [optional] [readonly]
**type** | **string** | The type of service, ether &#x60;hourly&#x60; or &#x60;misc&#x60;. | [optional] [readonly]
**unit_price** | **string** | The monthly service fee in US Dollars for this Item. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

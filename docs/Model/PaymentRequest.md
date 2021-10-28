# # PaymentRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**cvv** | **string** | CVV (Card Verification Value) of the credit card to be used for the Payment. Required if paying by credit card. | [optional]
**usd** | **string** | The amount in US Dollars of the Payment.  * Can begin with or without &#x60;$&#x60;. * Commas (&#x60;,&#x60;) are not accepted. * Must end with a decimal expression, such as &#x60;.00&#x60; or &#x60;.99&#x60;. * Minimum: &#x60;$5.00&#x60; or the Account balance, whichever is lower. * Maximum: &#x60;$2000.00&#x60; or the Account balance up to &#x60;$50000.00&#x60;, whichever is greater. |
**payment_method_id** | **int** | The ID of the Payment Method to apply to the Payment. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

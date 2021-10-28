# # CreditCard

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**card_number** | **string** | Your credit card number. No spaces or dashes allowed. |
**expiry_month** | **int** | A value from 1-12 representing the expiration month of your credit card.    * 1 &#x3D; January   * 2 &#x3D; February   * 3 &#x3D; March   * Etc. |
**expiry_year** | **int** | A four-digit integer representing the expiration year of your credit card.  The combination of &#x60;expiry_month&#x60; and &#x60;expiry_year&#x60; must result in a month/year combination of the current month or in the future. An expiration date set in the past is invalid. |
**cvv** | **string** | CVV (Card Verification Value) of the credit card, typically found on the back of the card. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

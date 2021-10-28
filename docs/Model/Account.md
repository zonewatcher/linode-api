# # Account

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**active_promotions** | [**\OpenAPI\Client\Model\Promotion[]**](Promotion.md) |  | [optional]
**active_since** | **\DateTime** | The datetime of when the account was activated. | [optional] [readonly]
**address_1** | **string** | First line of this Account&#39;s billing address. | [optional]
**address_2** | **string** | Second line of this Account&#39;s billing address. | [optional]
**balance** | **float** | This Account&#39;s balance, in US dollars. | [optional] [readonly]
**balance_uninvoiced** | **float** | This Account&#39;s current estimated invoice in US dollars. This is not your final invoice balance. Transfer charges are not included in the estimate. | [optional] [readonly]
**capabilities** | **string[]** | A list of capabilities your account supports. | [optional] [readonly]
**city** | **string** | The city for this Account&#39;s billing address. | [optional]
**credit_card** | [**\OpenAPI\Client\Model\AccountCreditCard**](AccountCreditCard.md) |  | [optional]
**company** | **string** | The company name associated with this Account. | [optional]
**country** | **string** | The two-letter country code of this Account&#39;s billing address. | [optional]
**email** | **string** | The email address of the person associated with this Account. | [optional]
**first_name** | **string** | The first name of the person associated with this Account. | [optional]
**last_name** | **string** | The last name of the person associated with this Account. | [optional]
**phone** | **string** | The phone number associated with this Account. | [optional]
**state** | **string** | If billing address is in the United States, this is the State portion of the Account&#39;s billing address. If the address is outside the US, this is the Province associated with the Account&#39;s billing address. | [optional]
**tax_id** | **string** | The tax identification number associated with this Account, for tax calculations in some countries. If you do not live in a country that collects tax, this should be &#x60;null&#x60;. | [optional]
**euuid** | **string** | An external unique identifier for this account. | [optional] [readonly]
**zip** | **string** | The zip code of this Account&#39;s billing address. The following restrictions apply:  - May only consist of letters, numbers, spaces, and hyphens. - Must not contain more than 9 letter or number characters. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

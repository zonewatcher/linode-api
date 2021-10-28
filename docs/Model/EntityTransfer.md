# # EntityTransfer

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**token** | **string** | The token used to identify and accept or cancel this transfer. | [optional]
**status** | **string** | The status of the transfer request.  &#x60;accepted&#x60;: The transfer has been accepted by another user and is currently in progress. Transfers can take up to 3 hours to complete.  &#x60;cancelled&#x60;: The transfer has been cancelled by the sender.  &#x60;completed&#x60;: The transfer has completed successfully.  &#x60;failed&#x60;: The transfer has failed after initiation.  &#x60;pending&#x60;: The transfer is ready to be accepted.  &#x60;stale&#x60;: The transfer has exceeded its expiration date. It can no longer be accepted or cancelled. | [optional]
**created** | **\DateTime** | When this transfer was created. | [optional]
**updated** | **\DateTime** | When this transfer was last updated. | [optional]
**is_sender** | **bool** | If the requesting account created this transfer. | [optional]
**expiry** | **\DateTime** | When this transfer expires. Transfers will automatically expire 24 hours after creation. | [optional]
**entities** | [**\OpenAPI\Client\Model\EntityTransferEntities**](EntityTransferEntities.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

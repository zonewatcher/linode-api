# # SupportTicket

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The ID of the Support Ticket. | [optional] [readonly]
**attachments** | **string[]** | A list of filenames representing attached files associated with this Ticket. | [optional] [readonly]
**closed** | **\DateTime** | The date and time this Ticket was closed. | [optional] [readonly]
**closable** | **bool** | Whether the Support Ticket may be closed. | [optional]
**description** | **string** | The full details of the issue or question. | [optional] [readonly]
**entity** | [**\OpenAPI\Client\Model\SupportTicketEntity**](SupportTicketEntity.md) |  | [optional]
**gravatar_id** | **string** | The Gravatar ID of the User who opened this Ticket. | [optional] [readonly]
**opened** | **\DateTime** | The date and time this Ticket was created. | [optional] [readonly]
**opened_by** | **string** | The User who opened this Ticket. | [optional] [readonly]
**status** | **string** | The current status of this Ticket. | [optional] [readonly]
**summary** | **string** | The summary or title for this Ticket. | [optional] [readonly]
**updated** | **\DateTime** | The date and time this Ticket was last updated. | [optional] [readonly]
**updated_by** | **string** | The User who last updated this Ticket. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

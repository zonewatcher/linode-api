# # Event

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The unique ID of this Event. | [optional] [readonly]
**action** | **string** | The action that caused this Event. New actions may be added in the future. | [optional] [readonly]
**created** | **\DateTime** | When this Event was created. | [optional] [readonly]
**duration** | **float** | The total duration in seconds that it takes for the Event to complete. | [optional] [readonly]
**entity** | [**\OpenAPI\Client\Model\EventEntity**](EventEntity.md) |  | [optional]
**secondary_entity** | [**\OpenAPI\Client\Model\EventSecondaryEntity**](EventSecondaryEntity.md) |  | [optional]
**percent_complete** | **int** | A percentage estimating the amount of time remaining for an Event. Returns &#x60;null&#x60; for notification events. | [optional] [readonly]
**rate** | **string** | The rate of completion of the Event. Only some Events will return rate; for example, migration and resize Events. | [optional] [readonly]
**read** | **bool** | If this Event has been read. | [optional] [readonly]
**seen** | **bool** | If this Event has been seen. | [optional] [readonly]
**status** | **string** | The current status of this Event. | [optional] [readonly]
**time_remaining** | **string** | The estimated time remaining until the completion of this Event. This value is only returned for some in-progress migration events. For all other in-progress events, the &#x60;percent_complete&#x60; attribute will indicate about how much more work is to be done. | [optional] [readonly]
**username** | **string** | The username of the User who caused the Event. | [optional] [readonly]
**message** | **string** | Provides additional information about the event. Additional information may include, but is not limited to, a more detailed representation of events which can help diagnose non-obvious failures. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

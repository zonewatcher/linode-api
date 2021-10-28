# # Notification

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**entity** | [**\OpenAPI\Client\Model\NotificationEntity**](NotificationEntity.md) |  | [optional]
**label** | **string** | A short description of this Notification. | [optional] [readonly]
**message** | **string** | A human-readable description of the Notification. | [optional] [readonly]
**body** | **string** | A full description of this Notification, in markdown format.  Not all Notifications include bodies. | [optional] [readonly]
**type** | **string** | The type of Notification this is. | [optional] [readonly]
**severity** | **string** | The severity of this Notification.  This field can be used to decide how prominently to display the Notification, what color to make the display text, etc. | [optional] [readonly]
**when** | **\DateTime** | If this Notification is of an Event that will happen at a fixed, future time, this is when the named action will be taken. For example, if a Linode is to be migrated in response to a Security Advisory, this field will contain the approximate time the Linode will be taken offline for migration. | [optional] [readonly]
**until** | **\DateTime** | If this Notification has a duration, this will be the ending time for the Event/action. For example, if there is scheduled maintenance for one of our systems, &#x60;until&#x60; would be set to the end of the maintenance window. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

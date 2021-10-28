# # Maintenance

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** | The type of maintenance. | [optional]
**status** | **string** | The maintenance status. | [optional]
**reason** | **string** | The reason maintenance is being performed. | [optional]
**when** | **\DateTime** | When the maintenance will begin.  [Filterable](/docs/api/#filtering-and-sorting) with the following parameters:  * A single value in date-time string format (\&quot;%Y-%m-%dT%H:%M:%S\&quot;), which returns only matches to that value.  * A dictionary containing pairs of inequality operator string keys (\&quot;+or\&quot;, \&quot;+gt\&quot;, \&quot;+gte\&quot;, \&quot;+lt\&quot;, \&quot;+lte\&quot;, or \&quot;+neq\&quot;) and single date-time string format values (\&quot;%Y-%m-%dT%H:%M:%S\&quot;). \&quot;+or\&quot; accepts an array of values that may consist of single date-time strings or dictionaries of inequality operator pairs. | [optional]
**entity** | [**\OpenAPI\Client\Model\MaintenanceEntity**](MaintenanceEntity.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # LinodeConfigHelpers

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**updatedb_disabled** | **bool** | Disables updatedb cron job to avoid disk thrashing. | [optional]
**distro** | **bool** | Helps maintain correct inittab/upstart console device. | [optional]
**modules_dep** | **bool** | Creates a modules dependency file for the Kernel you run. | [optional]
**network** | **bool** | Automatically configures static networking. | [optional]
**devtmpfs_automount** | **bool** | Populates the /dev directory early during boot without udev.  Defaults to false. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

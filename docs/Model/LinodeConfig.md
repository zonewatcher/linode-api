# # LinodeConfig

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The ID of this Config. | [optional] [readonly]
**kernel** | **string** | A Kernel ID to boot a Linode with. Defaults to \&quot;linode/latest-64bit\&quot;. | [optional]
**comments** | **string** | Optional field for arbitrary User comments on this Config. | [optional]
**memory_limit** | **int** | Defaults to the total RAM of the Linode. | [optional]
**run_level** | **string** | Defines the state of your Linode after booting. Defaults to &#x60;default&#x60;. | [optional]
**virt_mode** | **string** | Controls the virtualization mode. Defaults to &#x60;paravirt&#x60;. * &#x60;paravirt&#x60; is suitable for most cases. Linodes running in paravirt mode   share some qualities with the host, ultimately making it run faster since   there is less transition between it and the host. * &#x60;fullvirt&#x60; affords more customization, but is slower because 100% of the VM   is virtualized. | [optional]
**interfaces** | [**\OpenAPI\Client\Model\LinodeConfigInterface[]**](LinodeConfigInterface.md) | An array of Network Interfaces to add to this Linode&#39;s Configuration Profile.  Up to three interface objects can be entered in this array. The position in the array determines the interface to which the settings apply:  - First/0:  eth0 - Second/1: eth1 - Third/2:  eth2  When updating a Linode&#39;s interfaces, *each interface must be redefined*. An empty interfaces array results in a default public interface configuration only.  If no public interface is configured, public IP addresses are still assigned to the Linode but will not be usable without manual configuration.  **Note:** Changes to Linode interface configurations can be enabled by rebooting the Linode.  **Note:** Only Next Generation Network (NGN) data centers support VLANs. Use the Regions ([/regions](/docs/api/regions/)) endpoint to view the capabilities of data center regions. If a VLAN is attached to your Linode and you attempt to migrate or clone it to a non-NGN data center, the migration or cloning will not initiate. If a Linode cannot be migrated because of an incompatibility, you will be prompted to select a different data center or contact support.  **Note:** See our guide on [Getting Started with VLANs](/docs/guides/getting-started-with-vlans/) to view additional [limitations](/docs/guides/getting-started-with-vlans/#limitations). | [optional]
**helpers** | [**\OpenAPI\Client\Model\LinodeConfigHelpers**](LinodeConfigHelpers.md) |  | [optional]
**label** | **string** | The Config&#39;s label is for display purposes only. | [optional]
**devices** | [**\OpenAPI\Client\Model\Devices**](Devices.md) |  | [optional]
**root_device** | **string** | The root device to boot. * If no value or an invalid value is provided, root device will default to &#x60;/dev/sda&#x60;. * If the device specified at the root device location is not mounted, the Linode will not boot until a device is mounted. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

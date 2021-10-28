# # Kernel

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The unique ID of this Kernel. | [optional] [readonly]
**label** | **string** | The friendly name of this Kernel. | [optional] [readonly]
**version** | **string** | Linux Kernel version. | [optional] [readonly]
**kvm** | **bool** | If this Kernel is suitable for KVM Linodes. | [optional] [readonly]
**xen** | **bool** | If this Kernel is suitable for Xen Linodes. | [optional] [readonly]
**architecture** | **string** | The architecture of this Kernel. | [optional] [readonly]
**pvops** | **bool** | If this Kernel is suitable for paravirtualized operations. | [optional] [readonly]
**deprecated** | **bool** | If this Kernel is marked as deprecated, this field has a value of true; otherwise, this field is false. | [optional] [readonly]
**built** | **\DateTime** | The date on which this Kernel was built. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

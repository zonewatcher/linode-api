# # LinodeSpecs

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**disk** | **int** | The amount of storage space, in MB, this Linode has access to. A typical Linode will divide this space between a primary disk with an &#x60;image&#x60; deployed to it, and a swap disk, usually 512 MB. This is the default configuration created when deploying a Linode with an &#x60;image&#x60; through [POST /linode/instances](/docs/api/linode-instances/#linode-create). While this configuration is suitable for 99% of use cases, if you need finer control over your Linode&#39;s disks, see the [/linode/instances/{linodeId}/disks](/docs/api/linode-instances/#disks-list) endpoints. | [optional] [readonly]
**memory** | **int** | The amount of RAM, in MB, this Linode has access to. Typically a Linode will choose to boot with all of its available RAM, but this can be configured in a Config profile, see the [/linode/instances/{linodeId}/configs](/docs/api/linode-instances/#configuration-profiles-list) endpoints and the LinodeConfig object for more information. | [optional] [readonly]
**vcpus** | **int** | The number of vcpus this Linode has access to. Typically a Linode will choose to boot with all of its available vcpus, but this can be configured in a Config Profile, see the [/linode/instances/{linodeId}/configs](/docs/api/linode-instances/#configuration-profiles-list) endpoints and the LinodeConfig object for more information. | [optional] [readonly]
**transfer** | **int** | The amount of network transfer this Linode is allotted each month. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

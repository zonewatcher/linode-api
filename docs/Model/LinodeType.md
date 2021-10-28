# # LinodeType

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID representing the Linode Type. | [optional] [readonly]
**label** | **string** | The Linode Type&#39;s label is for display purposes only. | [optional] [readonly]
**disk** | **int** | The Disk size, in MB, of the Linode Type. | [optional] [readonly]
**class** | **string** | The class of the Linode Type. We currently offer five classes of Linodes:    * nanode - Nanode instances are good for low-duty workloads,     where performance isn&#39;t critical. **Note:** As of June 16th, 2020, Nanodes became     1 GB Linodes in the Cloud Manager, however, the API, the CLI, and billing will     continue to refer to these instances as Nanodes.   * standard - Standard Shared instances are good for medium-duty workloads and     are a good mix of performance, resources, and price. **Note:** As of June 16th, 2020,     Standard Linodes in the Cloud Manager became Shared Linodes, however, the API, the CLI, and     billing will continue to refer to these instances as Standard Linodes.   * dedicated - Dedicated CPU instances are good for full-duty workloads     where consistent performance is important.   * gpu - Linodes with dedicated NVIDIA Quadro &amp;reg; RTX 6000 GPUs accelerate highly     specialized applications such as machine learning, AI, and video transcoding.   * highmem - High Memory instances favor RAM over other resources, and can be     good for memory hungry use cases like caching and in-memory databases.     All High Memory plans contain dedicated CPU cores. | [optional] [readonly]
**price** | [**\OpenAPI\Client\Model\LinodeTypePrice**](LinodeTypePrice.md) |  | [optional]
**addons** | [**\OpenAPI\Client\Model\LinodeTypeAddons**](LinodeTypeAddons.md) |  | [optional]
**network_out** | **int** | The Mbits outbound bandwidth allocation. | [optional] [readonly]
**memory** | **int** | Amount of RAM included in this Linode Type. | [optional] [readonly]
**successor** | **string** | The Linode Type that a [mutate](/docs/api/linode-instances/#linode-upgrade) will upgrade to for a Linode of this type.  If \&quot;null\&quot;, a Linode of this type may not mutate. | [optional] [readonly]
**transfer** | **int** | The monthly outbound transfer amount, in MB. | [optional] [readonly]
**vcpus** | **int** | The number of VCPU cores this Linode Type offers. | [optional] [readonly]
**gpus** | **int** | The number of GPUs this Linode Type offers. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

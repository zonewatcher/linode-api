# # LKECluster

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This Kubernetes cluster&#39;s unique ID. | [optional] [readonly]
**created** | **\DateTime** | When this Kubernetes cluster was created. | [optional] [readonly]
**updated** | **\DateTime** | When this Kubernetes cluster was updated. | [optional] [readonly]
**label** | **string** | This Kubernetes cluster&#39;s unique label for display purposes only. Labels have the following constraints:    * UTF-8 characters will be returned by the API using escape     sequences of their Unicode code points. For example, the     Japanese character *か* is 3 bytes in UTF-8 (&#x60;0xE382AB&#x60;). Its     Unicode code point is 2 bytes (&#x60;0x30AB&#x60;). APIv4 supports this     character and the API will return it as the escape sequence     using six 1 byte characters which represent 2 bytes of Unicode     code point (&#x60;\&quot;\\u30ab\&quot;&#x60;).   * 4 byte UTF-8 characters are not supported.   * If the label is entirely composed of UTF-8 characters, the API     response will return the code points using up to 193 1 byte     characters. | [optional]
**region** | **string** | This Kubernetes cluster&#39;s location. | [optional]
**k8s_version** | **string** | The desired Kubernetes version for this Kubernetes cluster in the format of &amp;lt;major&amp;gt;.&amp;lt;minor&amp;gt;, and the latest supported patch version will be deployed. | [optional]
**tags** | **string[]** | An array of tags applied to the Kubernetes cluster. Tags are for organizational purposes only. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

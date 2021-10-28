# # NodeBalancerConfig

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | This config&#39;s unique ID | [optional] [readonly]
**port** | **int** | The port this Config is for. These values must be unique across configs on a single NodeBalancer (you can&#39;t have two configs for port 80, for example).  While some ports imply some protocols, no enforcement is done and you may configure your NodeBalancer however is useful to you. For example, while port 443 is generally used for HTTPS, you do not need SSL configured to have a NodeBalancer listening on port 443. | [optional]
**protocol** | **string** | The protocol this port is configured to serve. * If using &#x60;http&#x60; or &#x60;tcp&#x60; protocol, &#x60;ssl_cert&#x60; and &#x60;ssl_key&#x60; are not supported. * If using &#x60;https&#x60; protocol, &#x60;ssl_cert&#x60; and &#x60;ssl_key&#x60; are required. | [optional]
**algorithm** | **string** | What algorithm this NodeBalancer should use for routing traffic to backends. | [optional]
**stickiness** | **string** | Controls how session stickiness is handled on this port. * If set to &#x60;none&#x60; connections will always be assigned a backend based on the algorithm configured. * If set to &#x60;table&#x60; sessions from the same remote address will be routed to the same   backend.  * For HTTP or HTTPS clients, &#x60;http_cookie&#x60; allows sessions to be   routed to the same backend based on a cookie set by the NodeBalancer. | [optional]
**check** | **string** | The type of check to perform against backends to ensure they are serving requests. This is used to determine if backends are up or down. * If &#x60;none&#x60; no check is performed. * &#x60;connection&#x60; requires only a connection to the backend to succeed. * &#x60;http&#x60; and &#x60;http_body&#x60; rely on the backend serving HTTP, and that   the response returned matches what is expected. | [optional]
**check_interval** | **int** | How often, in seconds, to check that backends are up and serving requests. | [optional]
**check_timeout** | **int** | How long, in seconds, to wait for a check attempt before considering it failed. | [optional]
**check_attempts** | **int** | How many times to attempt a check before considering a backend to be down. | [optional]
**check_path** | **string** | The URL path to check on each backend. If the backend does not respond to this request it is considered to be down. | [optional]
**check_body** | **string** | This value must be present in the response body of the check in order for it to pass. If this value is not present in the response body of a check request, the backend is considered to be down. | [optional]
**check_passive** | **bool** | If true, any response from this backend with a &#x60;5xx&#x60; status code will be enough for it to be considered unhealthy and taken out of rotation. | [optional]
**proxy_protocol** | **string** | ProxyProtocol is a TCP extension that sends initial TCP connection information such as source/destination IPs and ports to backend devices. This information would be lost otherwise. Backend devices must be configured to work with ProxyProtocol if enabled.  * If ommited, or set to &#x60;none&#x60;, the NodeBalancer doesn&#39;t send any auxilary data over TCP connections. This is the default. * If set to &#x60;v1&#x60;, the human-readable header format (Version 1) is used. * If set to &#x60;v2&#x60;, the binary header format (Version 2) is used. | [optional] [default to 'none']
**cipher_suite** | **string** | What ciphers to use for SSL connections served by this NodeBalancer.  * &#x60;legacy&#x60; is considered insecure and should only be used if necessary. | [optional]
**nodebalancer_id** | **int** | The ID for the NodeBalancer this config belongs to. | [optional] [readonly]
**ssl_commonname** | **string** | The read-only common name automatically derived from the SSL certificate assigned to this NodeBalancerConfig. Please refer to this field to verify that the appropriate certificate is assigned to your NodeBalancerConfig. | [optional] [readonly]
**ssl_fingerprint** | **string** | The read-only fingerprint automatically derived from the SSL certificate assigned to this NodeBalancerConfig. Please refer to this field to verify that the appropriate certificate is assigned to your NodeBalancerConfig. | [optional] [readonly]
**ssl_cert** | **string** | The PEM-formatted public SSL certificate (or the combined PEM-formatted SSL certificate and Certificate Authority chain) that should be served on this NodeBalancerConfig&#39;s port.  The contents of this field will not be shown in any responses that display the NodeBalancerConfig. Instead, &#x60;&lt;REDACTED&gt;&#x60; will be printed where the field appears.  The read-only &#x60;ssl_commonname&#x60; and &#x60;ssl_fingerprint&#x60; fields in a NodeBalancerConfig response are automatically derived from your certificate. Please refer to these fields to verify that the appropriate certificate was assigned to your NodeBalancerConfig. | [optional]
**ssl_key** | **string** | The PEM-formatted private key for the SSL certificate set in the &#x60;ssl_cert&#x60; field.  Line breaks must be represented as \&quot;\\n\&quot; in the string.  The contents of this field will not be shown in any responses that display the NodeBalancerConfig. Instead, &#x60;&lt;REDACTED&gt;&#x60; will be printed where the field appears.  The read-only &#x60;ssl_commonname&#x60; and &#x60;ssl_fingerprint&#x60; fields in a NodeBalancerConfig response are automatically derived from your certificate. Please refer to these fields to verify that the appropriate certificate was assigned to your NodeBalancerConfig. | [optional]
**nodes_status** | [**\OpenAPI\Client\Model\NodeBalancerConfigNodesStatus**](NodeBalancerConfigNodesStatus.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
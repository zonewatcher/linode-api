# OpenAPI\Client\ImagesApi

All URIs are relative to https://api.linode.com/v4.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createImage()**](ImagesApi.md#createImage) | **POST** /images | Image Create
[**deleteImage()**](ImagesApi.md#deleteImage) | **DELETE** /images/{imageId} | Image Delete
[**getImage()**](ImagesApi.md#getImage) | **GET** /images/{imageId} | Image View
[**getImages()**](ImagesApi.md#getImages) | **GET** /images | Images List
[**imagesUploadPost()**](ImagesApi.md#imagesUploadPost) | **POST** /images/upload | Image Upload
[**updateImage()**](ImagesApi.md#updateImage) | **PUT** /images/{imageId} | Image Update


## `createImage()`

```php
createImage($unknown_base_type): \OpenAPI\Client\Model\Image
```

Image Create

Captures a private gold-master Image from a Linode Disk.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$unknown_base_type = new \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE(); // \OpenAPI\Client\Model\UNKNOWN_BASE_TYPE | Information about the Image to create.

try {
    $result = $apiInstance->createImage($unknown_base_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->createImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **unknown_base_type** | [**\OpenAPI\Client\Model\UNKNOWN_BASE_TYPE**](../Model/UNKNOWN_BASE_TYPE.md)| Information about the Image to create. | [optional]

### Return type

[**\OpenAPI\Client\Model\Image**](../Model/Image.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteImage()`

```php
deleteImage($image_id): object
```

Image Delete

Deletes a private Image you have permission to `read_write`.   **Deleting an Image is a destructive action and cannot be undone.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$image_id = 'image_id_example'; // string | ID of the Image to look up.

try {
    $result = $apiInstance->deleteImage($image_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->deleteImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **image_id** | **string**| ID of the Image to look up. |

### Return type

**object**

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getImage()`

```php
getImage($image_id): \OpenAPI\Client\Model\Image
```

Image View

Get information about a single Image.  * **Public** Images have IDs that begin with \"linode/\". These distribution images are generally available to all users.  * **Private** Images have IDs that begin with \"private/\". These Images are Account-specific and only accessible to Users with appropriate [Grants](/docs/api/account/#users-grants-view).  * To view a public Image, call this endpoint with or without authentication. To view a private Image, call this endpoint with authentication.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$image_id = 'image_id_example'; // string | ID of the Image to look up.

try {
    $result = $apiInstance->getImage($image_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->getImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **image_id** | **string**| ID of the Image to look up. |

### Return type

[**\OpenAPI\Client\Model\Image**](../Model/Image.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getImages()`

```php
getImages($page, $page_size): \OpenAPI\Client\Model\InlineResponse20015
```

Images List

Returns a paginated list of Images.  * **Public** Images have IDs that begin with \"linode/\". These distribution images are generally available to all users.  * **Private** Images have IDs that begin with \"private/\". These Images are Account-specific and only accessible to Users with appropriate [Grants](/docs/api/account/#users-grants-view).  * To view only public Images, call this endpoint with or without authentication. To view private Images as well, call this endpoint with authentication.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | The page of a collection to return.
$page_size = 100; // int | The number of items to return per page.

try {
    $result = $apiInstance->getImages($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->getImages: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| The page of a collection to return. | [optional] [default to 1]
 **page_size** | **int**| The number of items to return per page. | [optional] [default to 100]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20015**](../Model/InlineResponse20015.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `imagesUploadPost()`

```php
imagesUploadPost($inline_object5): \OpenAPI\Client\Model\InlineResponse20016
```

Image Upload

Initiates an Image upload.  This endpoint creates a new private Image object and returns it along with the URL to which image data can be uploaded.  - Image data must be uploaded within 24 hours of creation or the upload will be cancelled and the image deleted.  - Image uploads should be made as an HTTP PUT request to the URL returned in the `upload_to` response parameter, with a `Content-type: application/octet-stream` header included in the request. For example:        curl -v \\         -H \"Content-Type: application/octet-stream\" \\         --upload-file example.img.gz \\         $UPLOAD_URL \\         --progress-bar \\         --output /dev/null  - Uploaded image data should be compressed in gzip (`.gz`) format. The uncompressed disk should be in raw disk image (`.img`) format. A maximum compressed file size of 5GB is supported for upload at this time.  **Note:** To initiate and complete an Image upload in a single step, see our guide on how to [Upload an Image](/docs/products/tools/images/guides/upload-an-image/) using Cloud Manager or the Linode CLI `image-upload` plugin.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$inline_object5 = new \OpenAPI\Client\Model\InlineObject5(); // \OpenAPI\Client\Model\InlineObject5

try {
    $result = $apiInstance->imagesUploadPost($inline_object5);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->imagesUploadPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inline_object5** | [**\OpenAPI\Client\Model\InlineObject5**](../Model/InlineObject5.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20016**](../Model/InlineResponse20016.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateImage()`

```php
updateImage($image_id, $image): \OpenAPI\Client\Model\Image
```

Image Update

Updates a private Image that you have permission to `read_write`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer authorization: personalAccessToken
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$image_id = 'image_id_example'; // string | ID of the Image to look up.
$image = new \OpenAPI\Client\Model\Image(); // \OpenAPI\Client\Model\Image | The fields to update.

try {
    $result = $apiInstance->updateImage($image_id, $image);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->updateImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **image_id** | **string**| ID of the Image to look up. |
 **image** | [**\OpenAPI\Client\Model\Image**](../Model/Image.md)| The fields to update. |

### Return type

[**\OpenAPI\Client\Model\Image**](../Model/Image.md)

### Authorization

[oauth](../../README.md#oauth), [personalAccessToken](../../README.md#personalAccessToken)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
